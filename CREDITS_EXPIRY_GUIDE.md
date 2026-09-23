# Credit Expiry (30 days after deposit) — Implementation Guide

This guide adds credit expiry to the **current** codebase described in
`CREDITS_LEVELS_PORT_GUIDE.md`. Nothing in the existing wallet design changes: the wallet is
still `users.points_balance` plus the `point_transactions` ledger, credit rows are still
`product_id = 1000`, and `PointsController::redeem` still checks `points_balance`.

The feature is added as a separate layer: one migration, one config file, one service, one
console command, and small edits in the two places that already write to the ledger.

---

## 0. In plain words (read this first)

**The rule we want.** Credits a user buys must be used within 30 days. After that they
disappear.

**Why it is not a one-line change.** Today the wallet is a single number per user,
`points_balance`. A single number cannot tell you *which* credits are old. If a user buys
100 credits in January and 100 in March and spends 50, the number says 150, but it does not
say whether the 50 came from January or March. To expire credits fairly we have to remember
each purchase separately.

**The idea.** Treat every purchase as a **lot**. The ledger table `point_transactions`
already has one `credit` line per purchase, so we add two columns to that line:

- `expires_at`: purchase date plus 30 days.
- `remaining`: how much of that purchase is still unspent.

Now the wallet is really the list of lots, and `points_balance` is just the total of them
kept handy for the pages that already read it.

**Three moments where something happens.**

1. **Buying.** When the gateway confirms payment, the new credit line is saved with
   `remaining` equal to the credits bought and `expires_at` 30 days ahead. Same code as
   before, two more fields.
2. **Spending.** When a user unlocks a level, we take the credits from the lot that expires
   soonest, then the next, and so on. This is the "oldest first" rule and it is what makes
   expiry fair: the user always burns their oldest credits before newer ones.
3. **Expiring.** Once a day a command looks for lots whose date has passed and still have
   credits left. It sets them to zero, subtracts the same amount from `points_balance`, and
   writes an `expire` line in the ledger so the history still adds up.

**Why also expire "lazily".** The daily command runs at night. If a lot expires at 09:00
and the user tries to spend it at 10:00, the balance would still include it. So the same
expiry routine is also called right before a redeem and when the dashboard loads, for that
one user only. Expired credits can therefore never be spent, whatever the clock says.

**What the user sees.** The Buy Credits page gets one sentence saying credits expire in
30 days. The dashboard shows a line for each lot that will expire within a week, with the
amount and the date.

**What does not change.** The two carts, the id 1000 rule, the header balance, the course
cart, the middleware, and the admin panel all keep working as before because they read
`points_balance`, which the new code keeps correct.

**The one manual step.** Purchases made before this feature have no lots. The migration
gives them one (expiring 30 days after purchase), but it cannot know how much of each was
already spent. Section 6.1 has a one-off script that trims those lots so they match each
user's current balance. Decide first whether old credits should expire at all
(section 7).

---

## 1. Design

### 1.1 The idea

- Every **credit** row in `point_transactions` is treated as a **lot** (one deposit). Two new
  columns give each lot its own `expires_at` and `remaining` amount.
- When credits are purchased, the new credit row gets `remaining = amount` and
  `expires_at = now + 30 days`.
- When credits are redeemed, the oldest unexpired lots are consumed first (FIFO by
  `expires_at`), reducing `remaining`. The existing `debit` row is still written.
- A daily command finds lots with `expires_at <= now` and `remaining > 0`, sets
  `remaining = 0`, decrements `users.points_balance` by the same total, and writes an
  `expire` row so the ledger stays balanced.
- `users.points_balance` stays the cached total that the header, `PointGatingMiddleware`,
  `coursecart.blade.php` and the dashboard already read. The command keeps it correct once a
  day. The service also expires lazily for the current user right before a redeem and on the
  dashboard, so expired credits can never be spent between runs.

### 1.2 Data flow

```
Purchase (DasGatewayController::payment)
    users.points_balance += N
    point_transactions: type=credit, amount=+N, remaining=N, expires_at=now+30d

Redeem (PointsController::redeem)
    PointExpiryService::expireFor(user)        -- lazy expiry first
    check points_balance >= needed             -- existing check
    users.points_balance -= needed             -- existing
    point_transactions: type=debit, amount=-needed   -- existing
    PointExpiryService::consume(user, needed)  -- reduce lots oldest-first

Daily (php artisan points:expire)
    for each user with expired lots:
        point_transactions: type=expire, amount=-remaining, reference_id=lot id
        lot.remaining = 0
        users.points_balance -= total expired
```

### 1.3 Invariant

For every user, at all times after `expireFor()` has run:

```
users.points_balance == SUM(remaining) over unexpired credit lots
                     == SUM(amount) over all point_transactions rows
```

---

## 2. New files

### 2.1 Migration — `database/migrations/2026_09_22_000001_add_expiry_to_point_transactions_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('point_transactions', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('reference_id');
            $table->integer('remaining')->default(0)->after('expires_at');
            $table->index(['user_id', 'type', 'expires_at'], 'pt_user_type_expires_idx');
        });

        // Backfill: existing deposits become lots that expire 30 days after purchase.
        // If old credits should NEVER expire, replace the DATE_ADD(...) with NULL.
        DB::statement("
            UPDATE point_transactions
               SET remaining  = amount,
                   expires_at = DATE_ADD(created_at, INTERVAL 30 DAY)
             WHERE type = 'credit'
        ");
    }

    public function down()
    {
        Schema::table('point_transactions', function (Blueprint $table) {
            $table->dropIndex('pt_user_type_expires_idx');
            $table->dropColumn(['expires_at', 'remaining']);
        });
    }
};
```

> Backfilled lots do not account for credits already spent before this feature existed.
> After running the migration, run the reconciliation SQL in section 6.1 once so that
> `SUM(remaining)` matches `points_balance` for every user.

### 2.2 Config — `config/points.php`

```php
<?php

return [
    // Days a credit deposit stays usable. 0 or null = never expire.
    'expiry_days' => env('POINTS_EXPIRY_DAYS', 30),

    // Days ahead to warn the user on the dashboard.
    'warn_days'   => env('POINTS_EXPIRY_WARN_DAYS', 7),
];
```

Add to `.env`:

```
POINTS_EXPIRY_DAYS=30
POINTS_EXPIRY_WARN_DAYS=7
```

### 2.3 Service — `app/Services/PointExpiryService.php`

```php
<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class PointExpiryService
{
    /**
     * Expiry timestamp for a deposit made now. Null when expiry is disabled.
     */
    public function expiresAt(): ?Carbon
    {
        $days = (int) config('points.expiry_days');
        return $days > 0 ? now()->addDays($days) : null;
    }

    /**
     * Zero out expired lots for one user, decrement the cached balance and
     * write one 'expire' ledger row per lot. Returns total credits expired.
     */
    public function expireFor(int $userId): int
    {
        return DB::transaction(function () use ($userId) {
            $lots = DB::table('point_transactions')
                ->where('user_id', $userId)
                ->where('type', 'credit')
                ->where('remaining', '>', 0)
                ->whereNotNull('expires_at')
                ->where('expires_at', '<=', now())
                ->lockForUpdate()
                ->get();

            $total = 0;

            foreach ($lots as $lot) {
                $total += $lot->remaining;

                DB::table('point_transactions')->insert([
                    'user_id'      => $userId,
                    'amount'       => -$lot->remaining,
                    'type'         => 'expire',
                    'description'  => 'Credits expired',
                    'reference_id' => $lot->id,
                    'expires_at'   => null,
                    'remaining'    => 0,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                DB::table('point_transactions')
                    ->where('id', $lot->id)
                    ->update(['remaining' => 0, 'updated_at' => now()]);
            }

            if ($total > 0) {
                DB::table('users')->where('id', $userId)->decrement('points_balance', $total);
            }

            return $total;
        });
    }

    /**
     * Consume $points from the oldest unexpired lots (FIFO by expires_at).
     * Must be called inside the caller's DB transaction, after the balance check.
     */
    public function consume(int $userId, int $points): void
    {
        $lots = DB::table('point_transactions')
            ->where('user_id', $userId)
            ->where('type', 'credit')
            ->where('remaining', '>', 0)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->orderByRaw('expires_at IS NULL, expires_at ASC') // dated lots first, oldest first
            ->lockForUpdate()
            ->get();

        foreach ($lots as $lot) {
            if ($points <= 0) {
                break;
            }
            $take = min($lot->remaining, $points);

            DB::table('point_transactions')
                ->where('id', $lot->id)
                ->update(['remaining' => $lot->remaining - $take, 'updated_at' => now()]);

            $points -= $take;
        }

        if ($points > 0) {
            // points_balance said we had enough but the lots did not cover it.
            throw new RuntimeException('Insufficient unexpired credits.');
        }
    }

    /**
     * Sum of unexpired remaining credits (the true spendable balance).
     */
    public function availableBalance(int $userId): int
    {
        return (int) DB::table('point_transactions')
            ->where('user_id', $userId)
            ->where('type', 'credit')
            ->where('remaining', '>', 0)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->sum('remaining');
    }

    /**
     * Lots that will expire within the warning window, for the dashboard.
     */
    public function expiringSoon(int $userId)
    {
        $days = (int) config('points.warn_days', 7);

        return DB::table('point_transactions')
            ->select('id', 'remaining', 'expires_at')
            ->where('user_id', $userId)
            ->where('type', 'credit')
            ->where('remaining', '>', 0)
            ->whereNotNull('expires_at')
            ->whereBetween('expires_at', [now(), now()->addDays($days)])
            ->orderBy('expires_at')
            ->get();
    }
}
```

### 2.4 Command — `app/Console/Commands/ExpirePoints.php`

```php
<?php

namespace App\Console\Commands;

use App\Services\PointExpiryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExpirePoints extends Command
{
    protected $signature   = 'points:expire {--user= : Only run for one user id}';
    protected $description = 'Expire credit deposits older than the configured number of days';

    public function handle(PointExpiryService $service): int
    {
        $query = DB::table('point_transactions')
            ->where('type', 'credit')
            ->where('remaining', '>', 0)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', now());

        if ($this->option('user')) {
            $query->where('user_id', (int) $this->option('user'));
        }

        $userIds = $query->distinct()->pluck('user_id');
        $grand   = 0;

        foreach ($userIds as $userId) {
            $expired = $service->expireFor((int) $userId);
            $grand  += $expired;
            $this->line("user {$userId}: expired {$expired} credits");
        }

        $this->info("Done. {$userIds->count()} users, {$grand} credits expired.");

        return self::SUCCESS;
    }
}
```

---

## 3. Existing files to change

### 3.1 `app/Console/Kernel.php`

Register the command and schedule it daily.

```php
protected $commands = [
    \App\Console\Commands\ClearSmtpCache::class,
    \App\Console\Commands\ExpirePoints::class,
];

protected function schedule(Schedule $schedule)
{
    $schedule->command('points:expire')->dailyAt('00:10')->withoutOverlapping();
}
```

Server cron (once, so Laravel's scheduler runs):

```
* * * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1
```

### 3.2 `app/Http/Controllers/DasGatewayController.php` — `payment()`

Current block:

```php
if($pointsToCredit > 0 && !$alreadyCredited) {
    $user = auth()->user();
    $user->increment('points_balance', $pointsToCredit);

    DB::table('point_transactions')->insert([
        'user_id' => $user->id,
        'amount' => $pointsToCredit,
        'type' => 'credit',
        'description' => 'Points purchase',
        'reference_id' => $order->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
```

Replace with:

```php
if($pointsToCredit > 0 && !$alreadyCredited) {
    $expiry = app(\App\Services\PointExpiryService::class);
    $user = auth()->user();
    $user->increment('points_balance', $pointsToCredit);

    DB::table('point_transactions')->insert([
        'user_id' => $user->id,
        'amount' => $pointsToCredit,
        'type' => 'credit',
        'description' => 'Points purchase',
        'reference_id' => $order->id,
        'expires_at' => $expiry->expiresAt(),   // NEW
        'remaining' => $pointsToCredit,          // NEW
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
```

### 3.3 `app/Http/Controllers/PointsController.php` — `redeem()`

Add the import at the top of the file:

```php
use App\Services\PointExpiryService;
```

Change the method signature and add two calls. Current opening of the method:

```php
public function redeem(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login.form')->with('error', __('common.login_to_redeem_points'));
    }

    // Calculate total points required for the current cart
    $totalPointsNeeded = Helper::totalCartPoints();
```

New opening:

```php
public function redeem(Request $request, PointExpiryService $expiry)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login.form')->with('error', __('common.login_to_redeem_points'));
    }

    // Expire anything that lapsed since the last daily run, then re-read the balance
    $expiry->expireFor($user->id);
    $user->refresh();

    // Calculate total points required for the current cart
    $totalPointsNeeded = Helper::totalCartPoints();
```

Inside the transaction, current step 1 and 2:

```php
// 1. Deduct points from user wallet
$user->decrement('points_balance', $totalPointsNeeded);

// 2. Log the transaction for audit history
DB::table('point_transactions')->insert([
    'user_id' => $user->id,
    'amount' => -$totalPointsNeeded,
    'type' => 'debit',
    'description' => 'Course Enrollment via Points',
    'created_at' => now(),
    'updated_at' => now(),
]);
```

New:

```php
// 1. Deduct points from user wallet
$user->decrement('points_balance', $totalPointsNeeded);

// 1b. Consume the oldest unexpired lots first (throws if lots do not cover it)
$expiry->consume($user->id, $totalPointsNeeded);

// 2. Log the transaction for audit history
DB::table('point_transactions')->insert([
    'user_id' => $user->id,
    'amount' => -$totalPointsNeeded,
    'type' => 'debit',
    'description' => 'Course Enrollment via Points',
    'expires_at' => null,
    'remaining' => 0,
    'created_at' => now(),
    'updated_at' => now(),
]);
```

The method already wraps these steps in `DB::beginTransaction()` / `DB::rollBack()`, so a
`RuntimeException` from `consume()` rolls back the decrement and the order and lands in the
existing `catch`, which shows `common.enrollment_error`.

### 3.4 `app/Http/Controllers/HomeController.php` — `index()`

Add the import:

```php
use App\Services\PointExpiryService;
```

Change the method:

```php
public function index(PointExpiryService $expiry) {
    if(auth()->user()->role == "user") {
        $expiry->expireFor(auth()->id());
        auth()->user()->refresh();

        // Get all orders with cart info
        $allOrders = Order::with('cart_info')
            ->orderBy('id', 'DESC')
            ->where('user_id', auth()->user()->id)
            ->get();

        // Split into purchased (wallet top-ups) and redeemed (course enrollments)
        $purchasedOrders = $allOrders->filter(function($order) {
            $cartItem = $order->cart_info->first();
            return $cartItem && $cartItem->product_id == 1000;
        });

        $redeemedOrders = $allOrders->filter(function($order) {
            $cartItem = $order->cart_info->first();
            return $cartItem && $cartItem->product_id < 1000;
        });

        return view('frontend.user.dashboard')
            ->with('purchasedOrders', $purchasedOrders)
            ->with('redeemedOrders', $redeemedOrders)
            ->with('expiringLots', $expiry->expiringSoon(auth()->id()));
    }
    else {
        return view('user.index');
    }
}
```

### 3.5 `resources/views/frontend/user/dashboard.blade.php`

Directly under the balance stat card (the block that prints
`{{ number_format($u->points_balance ?? 0) }}`), add:

```blade
@if(isset($expiringLots) && $expiringLots->count())
    <ul class="ds-expiry">
        @foreach($expiringLots as $lot)
            <li class="ds-expiry__row">
                <i class="fas fa-hourglass-half" aria-hidden="true"></i>
                {{ __('frontend.dashboard.expiring', [
                    'count' => number_format($lot->remaining),
                    'date'  => \Carbon\Carbon::parse($lot->expires_at)->locale(app()->getLocale())->translatedFormat(__('frontend.dashboard.date_format')),
                ]) }}
            </li>
        @endforeach
    </ul>
@endif
```

### 3.6 `resources/views/frontend/pages/topup.blade.php`

In the intro chips, the warning chip currently reads:

```blade
<span class="tu-chip tu-chip--warn"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> <strong>{{ __('frontend.topup.note_title') }}</strong> {{ __('frontend.topup.note_text') }}</span>
```

Add a second chip after it:

```blade
<span class="tu-chip tu-chip--warn"><i class="fas fa-hourglass-half" aria-hidden="true"></i> {{ __('frontend.topup.expiry_note', ['days' => config('points.expiry_days')]) }}</span>
```

### 3.7 `resources/views/frontend/pages/coursecart.blade.php`

No change required. It reads `$user->points_balance`, which is correct after the lazy
expiry on the dashboard or the daily run. If you want the course cart itself to be exact
to the second, add at the top of the `@auth` block:

```blade
@php app(\App\Services\PointExpiryService::class)->expireFor(auth()->id()); $user = auth()->user()->fresh(); @endphp
```

### 3.8 Language files

`resources/lang/en/frontend.php`, inside `'dashboard' => [ … ]`:

```php
'expiring' => ':count credits expire on :date',
```

Inside `'topup' => [ … ]`:

```php
'expiry_note' => 'Credits expire :days days after purchase. Unused credits are removed automatically.',
```

`resources/lang/ja/frontend.php`, same keys:

```php
// dashboard
'expiring' => ':count クレジットは :date に失効します',
// topup
'expiry_note' => 'クレジットは購入から :days 日で失効します。未使用のクレジットは自動的に削除されます。',
```

### 3.9 CSS — `public/css/theme.css`

Append to section 19 (dashboard):

```css
.ds-expiry { list-style: none; margin: 8px 0 0; padding: 0; }
.ds-expiry__row { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--warn, #b45309); }
```

---

## 4. Routes

None. The command runs from the scheduler and the service is called from existing
controllers.

---

## 5. Order of work

1. Add `config/points.php` and the two `.env` keys.
2. Add `PointExpiryService` and `ExpirePoints`; register the command and the schedule in
   `Kernel.php`.
3. Run the migration. Then run the reconciliation SQL in section 6.1.
4. Edit `DasGatewayController::payment` (new columns on the credit insert).
5. Edit `PointsController::redeem` (lazy expire + `consume()`).
6. Edit `HomeController::index` and the dashboard view.
7. Add the top-up notice and language keys.
8. Set up the server cron.
9. Test (section 6.2).

---

## 6. Operations

### 6.1 Reconcile lots with balances after the backfill

Old deposits were backfilled with `remaining = amount`, ignoring credits already spent.
Run once so lots match each user's cached balance, consuming oldest lots first:

```sql
-- Report users whose lots do not match their balance
SELECT u.id, u.points_balance,
       COALESCE(SUM(CASE WHEN pt.type='credit' THEN pt.remaining END),0) AS lot_total
  FROM users u
  LEFT JOIN point_transactions pt ON pt.user_id = u.id
 GROUP BY u.id, u.points_balance
HAVING lot_total <> u.points_balance;
```

For each user in that report, reduce `remaining` on their oldest lots until the sum equals
`points_balance`. A one-off PHP snippet in `php artisan tinker`:

```php
foreach (\App\User::all() as $u) {
    $excess = DB::table('point_transactions')->where('user_id',$u->id)->where('type','credit')->sum('remaining') - $u->points_balance;
    $lots = DB::table('point_transactions')->where('user_id',$u->id)->where('type','credit')->where('remaining','>',0)->orderBy('expires_at')->get();
    foreach ($lots as $lot) {
        if ($excess <= 0) break;
        $take = min($lot->remaining, $excess);
        DB::table('point_transactions')->where('id',$lot->id)->decrement('remaining', $take);
        $excess -= $take;
    }
}
```

### 6.2 Test checklist

1. Buy credits with a sandbox card. Confirm the new credit row has `remaining = amount` and
   `expires_at = created_at + 30 days`.
2. Redeem a level. Confirm the oldest lot's `remaining` dropped by the level's
   `price_in_points` and a `debit` row was written.
3. In the database, set one lot's `expires_at` to yesterday. Run `php artisan points:expire`.
   Confirm: `remaining = 0`, an `expire` row with `amount = -remaining` and
   `reference_id = lot id`, and `points_balance` reduced by the same number.
4. Set a lot to expire yesterday again, do **not** run the command, and try to redeem a
   level that only that lot could pay for. The lazy `expireFor()` in `redeem()` must run
   first and redirect to the top-up page with `common.insufficient_points`.
5. Run `points:expire` twice in a row. The second run must expire 0 credits.
6. Set `POINTS_EXPIRY_DAYS=0`. New deposits must get `expires_at = NULL` and never expire.

### 6.3 Manual commands

```
php artisan points:expire            # all users
php artisan points:expire --user=12  # one user
php artisan schedule:list            # confirm the daily entry
```

---

## 7. Decisions to make before going live

| Question | Default in this guide | Alternative |
|---|---|---|
| Do credits bought before the feature expire? | Yes, 30 days after their purchase date (backfill) | Set `expires_at = NULL` in the backfill so they never expire |
| Which lot is spent first? | Oldest `expires_at` first | Newest first (change `orderByRaw`) |
| Warn the user? | Dashboard list of lots expiring within 7 days | Also send a mail from `ExpirePoints` the day before |
| Where does the 30 come from? | `config/points.php` via `.env` | A row in the `miscs` table so admins can change it |
