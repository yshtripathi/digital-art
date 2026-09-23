# Credits (Points) Wallet + Course Levels + Dual Cart — Port Guide

This document is a complete copy of the credits/levels/dual-cart system used in this
project, written so it can be dropped into another Laravel monolith that has the same
base tables (`users`, `products`, `categories`, `carts`, `orders`) but **no** points wallet
and **no** level table.

Every code block below is copied verbatim from this repository. Where a file is new,
the full file is given. Where an existing file is changed, the exact block to add or
replace is given.

---

## 0. In plain words (read this first)

**What the site sells.** Courses. Each course is split into skill levels (Beginner,
Intermediate, Advanced…). A user does not buy a course with money. A user buys **credits**
with money, then spends credits to unlock one level of one course.

**Why credits instead of direct payment.** One card payment can buy many credits, and
bigger payments get a bonus multiplier (pay 500, get 750 credits). The user then unlocks
levels one at a time without paying again. It also means all money handling happens in one
place (the credit purchase), and unlocking courses never touches the payment gateway.

**The two carts.** Because money and credits are different things, the site keeps them
apart:

| Cart | What goes in it | How it is paid |
|---|---|---|
| Credit cart (`/cart`) | A credit package | Card payment at checkout |
| Course cart (`/coursecart`) | Course levels | Deducted from the user's credit balance |

You cannot put a credit package and a course level in the cart at the same time. The code
blocks it in both directions.

**How the code tells them apart.** Both carts are the same database table, `carts`. Every
row has a `product_id`. Real courses have ids under 1000. A row with `product_id = 1000` is
a credit package. That single number is the whole trick, and it is used in eight places
(listed in section 8.1).

**Where the balance lives.** Each user has one number, `users.points_balance`. Every
change to it is also written as a line in `point_transactions` (plus for a purchase, minus
for a redeem), so you can always see how a balance came to be.

**What a level is.** A row in `product_levels` linked to a course. It has its own
description and its own price in credits (`price_in_points`). When a user adds a level to
the course cart, that credit price is copied onto the cart row.

**What happens step by step.**

1. User opens *Buy Credits*, types an amount. The page shows how many credits they get.
2. They add it to the credit cart and pay by card.
3. When the payment gateway says "paid", the site adds the credits to `points_balance` and
   writes a `credit` line in the ledger. It checks first that it has not already done so
   for this order.
4. User opens a course, picks a level, adds it to the course cart.
5. The course cart shows credits needed versus credits owned. If enough, an *Unlock*
   button appears.
6. Unlock subtracts the credits, writes a `debit` line, and creates an order with number
   `ORD-PTS-…` and zero money. That order is the record that the user owns the level.
7. The dashboard lists credit purchases (orders whose cart row is id 1000) and unlocked
   levels (orders whose cart rows are real courses).

**Why this document exists.** To move that behaviour into another Laravel site that has
products, carts and orders but no credits and no levels. Sections 2 to 7 are the exact
files to add or change. Section 8 is the data you must insert by hand because there is no
admin screen for levels or tiers.

---

## 1. How the system works

### 1.1 Two carts in one table

There is one `carts` table. A cart row belongs to one of two carts by its `product_id`:

| Cart | Route | Rows | Total column | Next step |
|---|---|---|---|---|
| Credit cart | `/cart` | `product_id >= 1000` | `amount` (money) | `/checkout` → card payment |
| Course cart | `/coursecart` | `product_id < 1000` | `points` (credits) | `POST /points/redeem` |

`product_id = 1000` is a **reserved id** meaning "credit top-up". It is never a real
product. Real course ids must stay below 1000.

The two carts cannot be mixed. `PointsController::addToCart` refuses when a course row
exists; `CartController::addToCart` and `CartController::singleAddToCart` refuse when a
credit row exists. All three use `Cart::where('user_id', …)->where('order_id', null)`.

### 1.2 Flow A — buy credits (money in)

1. `topup.blade.php` posts `amount` to `points.add-to-cart`.
2. `PointsController::addToCart` converts the amount to USD, applies the tier multiplier
   (x1 / x1.5 / x2 / x2.5 at 500 / 1000 / 1500 USD) and saves one cart row with
   `product_id = 1000`, `price` = money, `points` = credits to grant.
3. `/checkout` is behind `PointGatingMiddleware`. `OrderController::store` creates an
   `orders` row (`payment_status = Pending`) and stamps `order_id` on the cart rows.
4. The gateway returns to `/cart/payment`. `DasGatewayController::payment` verifies the
   transaction, marks the order `Completed`, sums `points` on cart rows with
   `product_id >= 1000`, increments `users.points_balance` and inserts a `credit` row in
   `point_transactions` with `reference_id = order id`. The `alreadyCredited` check makes
   this idempotent.

### 1.3 Flow B — redeem credits for a course level (credits out)

1. `product_detail.blade.php` lists `$product->levels`. Picking a level swaps the
   description panel and the hidden form fields, then posts `level_id` to
   `single-add-to-cart`.
2. `CartController::singleAddToCart` loads the level row and copies `price`, `price_jp`,
   `price_hk`, `price_in_points` onto the cart row (`points = price_in_points`).
3. `coursecart.blade.php` compares `Helper::totalCartPoints()` with `points_balance` and
   shows "Unlock" or "Buy credits".
4. `PointsController::redeem` runs in a DB transaction: decrement balance, insert a
   `debit` row in `point_transactions`, create an order with zero money totals and number
   prefix `ORD-PTS-`, attach the cart rows.

### 1.4 Levels

`product_levels` is a child table of `products` keyed by `course_id`. Each level carries its
own text (skill level, purpose, learn info, outcome, each with a `_jp` twin) and its own
`price`, `price_jp`, `price_hk`, `price_in_points`. `Product::levels()` is a `hasMany`.

There is **no admin UI for levels** in this project. Level rows are inserted directly in
the database (see section 8).

### 1.5 User dashboard

`HomeController::index` splits the user's orders into purchased (first cart row has
`product_id == 1000`) and redeemed (first cart row has `product_id < 1000`).

---

## 2. Database

### 2.1 Migrations that exist in this repo (copy as-is)

#### `database/migrations/2026_05_12_000001_add_points_balance_to_users_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPointsBalanceToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $blueprint) {
            $blueprint->integer('points_balance')->default(0)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $blueprint) {
            $blueprint->dropColumn('points_balance');
        });
    }
}

```

#### `database/migrations/2026_05_12_000002_create_point_transactions_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_transactions', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->unsignedInteger('user_id');
            $blueprint->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $blueprint->integer('amount'); // Positive for credit, negative for debit
            $blueprint->string('type'); // 'credit', 'debit'
            $blueprint->string('description')->nullable();
            $blueprint->string('reference_id')->nullable(); // Order ID or Course ID
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_transactions');
    }
}

```

#### `database/migrations/2026_05_12_000003_add_price_in_points_to_products_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceInPointsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $blueprint) {
            $blueprint->integer('price_in_points')->default(0)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $blueprint) {
            $blueprint->dropColumn('price_in_points');
        });
    }
}

```

#### `database/migrations/2026_05_12_124154_create_product_levels_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('skill_level')->nullable();
            $table->string('skill_level_jp')->nullable();
            $table->text('purpose')->nullable();
            $table->text('purpose_jp')->nullable();
            $table->text('learn_info')->nullable();
            $table->text('learn_info_jp')->nullable();
            $table->text('outcome')->nullable();
            $table->text('outcome_jp')->nullable();
            $table->float('price')->default(0);
            $table->float('price_jp')->default(0);
            $table->float('price_hk')->default(0);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_levels');
    }
}

```

#### `database/migrations/2026_05_12_125228_add_price_in_points_to_product_levels_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceInPointsToProductLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_levels', function (Blueprint $table) {
            $table->integer('price_in_points')->nullable()->after('price_hk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_levels', function (Blueprint $table) {
            $table->dropColumn('price_in_points');
        });
    }
}

```

> `point_transactions.user_id` is `unsignedInteger`. If the target `users.id` is
> `bigIncrements` (Laravel default), change it to `unsignedBigInteger` or the foreign key
> will fail on MySQL 8.

### 2.2 Columns the code uses that have NO migration in this repo (must be created)

These columns were added directly in the database here. The target app needs them, so
create the following migrations.

#### `database/migrations/xxxx_add_credit_columns_to_carts_table.php` (new)

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->float('price_jp')->nullable()->after('price');
            $table->float('price_hk')->nullable()->after('price_jp');
            $table->float('amount_jp')->nullable()->after('amount');
            $table->float('amount_hk')->nullable()->after('amount_jp');
            $table->integer('points')->default(0)->after('amount_hk');
            $table->string('currency', 10)->nullable()->after('points');
        });
        // product_id = 1000 is a reserved id with no products row, so the FK must go.
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn(['price_jp', 'price_hk', 'amount_jp', 'amount_hk', 'points', 'currency']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
        });
    }
};
```

#### `database/migrations/xxxx_add_currency_columns_to_products_table.php` (new)

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->float('price_jp')->default(0)->after('price');
            $table->float('price_hk')->default(0)->after('price_jp');
            // Only needed if you copy Product::getProductBySlug() as-is (Japanese locale)
            $table->string('title_jp')->nullable();
            $table->text('summary_jp')->nullable();
            $table->longText('description_jp')->nullable();
            $table->longText('extra_description')->nullable();
            $table->longText('extra_description_jp')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['price_jp', 'price_hk', 'title_jp', 'summary_jp', 'description_jp', 'extra_description', 'extra_description_jp']);
        });
    }
};
```

#### `database/migrations/xxxx_add_payment_columns_to_orders_table.php` (new)

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Code writes 'Pending', 'Completed', 'Failed', 'Payment Failed', 'New',
            // 'credit_card' — the original enums are too narrow.
            $table->string('status', 30)->default('new')->change();
            $table->string('payment_status', 30)->default('unpaid')->change();
            $table->string('payment_method', 30)->default('cod')->change();
            $table->string('currency', 10)->nullable()->after('total_amount');
            $table->string('trans_id')->nullable()->after('currency');
            $table->float('sub_total_jp')->nullable()->after('sub_total');
            $table->float('sub_total_hk')->nullable()->after('sub_total_jp');
            $table->float('total_amount_jp')->nullable()->after('total_amount');
            $table->float('total_amount_hk')->nullable()->after('total_amount_jp');
            $table->float('delivery_charge')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['currency', 'trans_id', 'sub_total_jp', 'sub_total_hk', 'total_amount_jp', 'total_amount_hk', 'delivery_charge']);
        });
    }
};
```

> `->change()` needs `doctrine/dbal` on Laravel 10: `composer require doctrine/dbal`.

---

## 3. New files (full copies)

### 3.1 Model

#### `app/Models/ProductLevel.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLevel extends Model
{
    protected $table = 'product_levels';

    protected $fillable = [
        'course_id',
        'skill_level',
        'skill_level_jp',
        'purpose',
        'purpose_jp',
        'learn_info',
        'learn_info_jp',
        'outcome',
        'outcome_jp',
        'price',
        'price_jp',
        'price_hk',
        'price_in_points'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'course_id', 'id');
    }
}

```

### 3.2 Controller

#### `app/Http/Controllers/PointsController.php`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\User;
use DB;
use Auth;
use Helper;
use Illuminate\Support\Str;

class PointsController extends Controller
{
    /**
     * Display the user's points dashboard with transaction history.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $transactions = DB::table('point_transactions')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('frontend.pages.points-dashboard', compact('user', 'transactions'));
    }

    /**
     * Show the top-up page with available point bundles.
     */
    public function topup()
    {
        // Available point bundles for purchase
        $bundles = [
            ['id' => 1001, 'points' => 100, 'price' => 100, 'title' => 'Starter Pack', 'description' => 'Perfect for a single course.'],
            ['id' => 1002, 'points' => 1000, 'price' => 500, 'title' => 'Growth Pack', 'description' => 'Get 2x points on your purchase.'],
            ['id' => 1003, 'points' => 2500, 'price' => 1000, 'title' => 'Pro Pack', 'description' => 'Get 2.5x points on your purchase.'],
            ['id' => 1004, 'points' => 4500, 'price' => 1500, 'title' => 'Elite Pack', 'description' => 'Get 3x points on your purchase.'],
        ];
        
        return view('frontend.pages.topup', compact('bundles'));
    }

    /**
     * Add a point bundle or custom point amount to the cart.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        if (!session('guest')) {
            session(['guest' => rand(100000, 999999)]);
        }
        $user_id = Auth::id() ?? session('guest');

        // Business Rule: Prevent mixing points and courses in the same transaction
        $existing_item = Cart::where('user_id', $user_id)->where('order_id', null)->pluck('product_id')->first();
        if (isset($existing_item) && $existing_item < 1000) {
            return back()->with('error', __('common.cannot_add_points_with_courses'));
        }

        $input_amount = (float)$request->amount;
        
        // Fixed exchange rates for multi-currency support
        $usd_rate_jp = 160.0;
        $usd_rate_hk = 8.0;

        // Convert the input amount to USD based on session currency
        if (session('currency') == 'JPY') {
            $usd_amount = $input_amount / $usd_rate_jp;
        } elseif (session('currency') == 'HKD') {
            $usd_amount = $input_amount / $usd_rate_hk;
        } else {
            $usd_amount = $input_amount;
        }
        
        // Progressive multiplier logic: the more you spend, the more bonus points you receive
        $points = match(true) {
            $usd_amount >= 1500 => round($usd_amount * 2.5),
            $usd_amount >= 1000 => round($usd_amount * 2),
            $usd_amount >= 500 => round($usd_amount * 1.5),
            default => round($usd_amount)
        };

        $already_cart = Cart::where('user_id', $user_id)->where('order_id', null)->where('product_id', 1000)->first();

        if ($already_cart) {
            $new_usd_amount = $already_cart->price + $usd_amount;
            
            // Re-calculate points based on the new total tier
            $total_points = match(true) {
                $new_usd_amount >= 1500 => round($new_usd_amount * 2.5),
                $new_usd_amount >= 1000 => round($new_usd_amount * 2),
                $new_usd_amount >= 500 => round($new_usd_amount * 1.5),
                default => round($new_usd_amount)
            };

            $already_cart->price = $new_usd_amount;
            $already_cart->price_jp = $new_usd_amount * $usd_rate_jp;
            $already_cart->price_hk = $new_usd_amount * $usd_rate_hk;
            $already_cart->amount = $already_cart->price;
            $already_cart->amount_jp = $already_cart->price_jp;
            $already_cart->amount_hk = $already_cart->price_hk;
            $already_cart->points = $total_points;
            $already_cart->save();
        } else {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->product_id = 1000; // Reserved ID for points
            $cart->price = $usd_amount;
            $cart->price_jp = $usd_amount * $usd_rate_jp;
            $cart->price_hk = $usd_amount * $usd_rate_hk;
            $cart->quantity = 1;
            $cart->amount = $cart->price;
            $cart->amount_jp = $cart->price_jp;
            $cart->amount_hk = $cart->price_hk;
            $cart->points = $points;
            $cart->save();
        }

        return redirect()->route('cart')->with('success', __('common.points_added_to_cart'));
    }

    /**
     * Redeem points to enroll in courses.
     */
    public function redeem(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login.form')->with('error', __('common.login_to_redeem_points'));
        }

        // Calculate total points required for the current cart
        $totalPointsNeeded = Helper::totalCartPoints();
        
        if ($totalPointsNeeded <= 0) {
            return back()->with('error', __('common.cart_no_course_enrollments'));
        }

        // Security Check: Ensure user has enough accumulated points
        if ($user->points_balance < $totalPointsNeeded) {
            return redirect()->route('points.topup')->with('error', __('common.insufficient_points'));
        }

        try {
            DB::beginTransaction();

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

            // 3. Create a professional order record
            $cartItems = Cart::where('user_id', $user->id)->where('order_id', null)->get();
            
            $order = new Order();
            $order->order_number = 'ORD-PTS-' . strtoupper(Str::random(10));
            $order->user_id = $user->id;
            $order->sub_total = 0; // Point-based purchase has 0 cash subtotal
            $order->total_amount = 0;
            $order->quantity = $cartItems->sum('quantity');
            $order->payment_status = 'Completed';
            $order->status = 'Completed';
            
            // Populate essential billing info from user profile
            $order->first_name = $user->name;
            $order->last_name = $user->last_name ?? '';
            $order->email = $user->email;
            $order->address1 = $user->address ?? 'Digital Enrollment';
            $order->phone = $user->phone ?? 'N/A';
            $order->country = $user->country ?? 'N/A';
            $order->post_code = $user->post_code ?? '0000';
            $order->save();

            // 4. Link cart items to the new order to finalize the transaction
            Cart::where('user_id', $user->id)->where('order_id', null)->update(['order_id' => $order->id]);

            DB::commit();

            return redirect()->route('coursecart')->with('success', __('common.enrollment_successful'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('common.enrollment_error'));
        }
    }
}

```

### 3.3 Middleware

#### `app/Http/Middleware/PointGatingMiddleware.php`

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class PointGatingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Please login to continue.');
        }

        $user = Auth::user();
        
        // Check if user is trying to access a course purchase or checkout with courses
        if ($request->routeIs('checkout')) {
            $user_id = $user->id;
            $cartItems = Cart::where('user_id', $user_id)->where('order_id', null)->get();
            
            foreach ($cartItems as $item) {
                // Assuming product_id < 1000 are courses (as per reference app logic)
                if ($item->product_id < 1000) {
                    $course = $item->product;
                    if($course) {
                        $priceInPoints = $course->price_in_points ?? $course->price; // Fallback to USD price if points not set
                        
                        if ($user->points_balance < $priceInPoints) {
                            return redirect()->route('points.topup')->with('error', 'Insufficient points to purchase ' . $course->title . '. Please top up your balance.');
                        }
                    }
                }
            }
        }

        return $next($request);
    }
}

```

---

## 4. Modified files (exact blocks)

### 4.1 `app/Http/Kernel.php`

Add to `$middlewareAliases` (Laravel 10) or `$routeMiddleware` (older):

```php
'points.gate' => \App\Http\Middleware\PointGatingMiddleware::class,
```

### 4.2 `app/Models/Product.php`

Add `price_jp`, `price_hk` to `$fillable` and add the relation:

```php
public function levels()
{
    return $this->hasMany(ProductLevel::class, 'course_id', 'id');
}
```

The product loader used by the detail page eager-loads levels. Copy this pattern into
the method that fetches a product by slug (this repo's `Product::getProductBySlug`):

```php
return Product::with([
    'levels' => function($query) {
        $query->select(
            'id',
            'course_id',
            'skill_level',
            'purpose',
            'learn_info',
            'outcome',
            'price as price',
            'price_in_points'
        );
    },
    'cat_info',
    'rel_prods',
    'getReview'
])->where('slug', $slug)->first();
```

(For the `ja` locale the same query selects `skill_level_jp as skill_level`,
`purpose_jp as purpose`, `learn_info_jp as learn_info`, `outcome_jp as outcome`.)

### 4.3 `app/Models/Cart.php` — full file

#### `app/Models/Cart.php`

```php
<?php

namespace App\Models;
use App;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=['user_id','product_id','order_id','quantity', 'amount', 'amount_jp', 'currency', 'price', 'price_jp', 'status'];
    
    // public function product(){
    //     return $this->hasOne('App\Models\Product','id','product_id');
    // }
    // public static function getAllProductFromCart(){
    //     return Cart::with('product')->where('user_id',auth()->user()->id)->get();
    // }
    public function product()
    {
        // return $this->belongsTo(Product::class, 'product_id');

        $currentLocale = App::getLocale();

        if($currentLocale == "ja") {
            // return $this->hasOne('App\Models\Category', 'id', 'cat_id')
            // ->select(['id', 'title_jp as title']);
            return $this->belongsTo(Product::class, 'product_id')
            ->select(['id','title_jp as title','slug', 'stock', 'photo', 'price']);
            return $this->belongsTo(Product::class, 'product_id');
        }
       
        else {
            return $this->belongsTo(Product::class, 'product_id');
        }
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}

```

> `$fillable` should also include `price_hk`, `amount_hk`, `points` (they are set by
> property assignment here, so it works without them).

### 4.4 `app/Models/Order.php` — full file

#### `app/Models/Order.php`

```php
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id','order_number','sub_total','quantity','delivery_charge','status','total_amount', 'currency','first_name','last_name','country','post_code','address1','address2','phone','email','payment_method','payment_status', 'trans_id','shipping_id','coupon'];

    public function cart_info(){
        return $this->hasMany('App\Models\Cart','order_id','id');
    }
    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }
    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }
    public function cart(){
        return $this->hasMany(Cart::class, 'order_id', 'id');
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}

```

### 4.5 `app/User.php`

Nothing to add to `$fillable`; `points_balance` is only changed through
`increment()` / `decrement()`. Read it with `auth()->user()->points_balance`.

### 4.6 `app/Http/Helpers.php`

Add this static method to the `Helper` class:

```php
public static function totalCartPoints($user_id = '')
{
    if (Auth::check()) {
        $user_id = auth()->user()->id;
    } else {
        $user_id = session('guest');
    }
    return Cart::where('user_id', $user_id)->where('order_id', null)
               ->where('product_id', '<', 1000)
               ->sum('points');
}
```

The existing helpers `cartCount()`, `getAllProductFromCart()`, `totalCartPrice()`,
`totalCartQuantity()` are used unchanged by both carts.

### 4.7 `app/Http/Controllers/CartController.php` — full file

Two things changed from the stock template: the anti-mixing check (`product_id >= 1000`)
in `addToCart` and `singleAddToCart`, and `singleAddToCart` reading the level row and
copying its prices and `price_in_points` onto the cart.

#### `app/Http/Controllers/CartController.php`

```php
<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Str;
use Helper;
use Illuminate\Support\Facades\Session;use DB;
class CartController extends Controller
{
    protected $product=null;
    public function __construct(Product $product){
        $this->product=$product;
    }

    public function addToCart(Request $request){
        // dd($request->all());
        if (empty($request->slug)) {
            request()->session()->flash('error',__('common.invalid_products'));
            return back();
        }

        //$product = Product::where('slug', $request->slug)->first();
        $product = Product::getProductBySlug($request->slug);

         //return $product;
        if (empty($product)) {
            request()->session()->flash('error',__('common.invalid_products'));
            return back();
        }

        // Business Rule: Prevent mixing products and points in the same transaction
        $existing_items = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->pluck('product_id')->toArray();
        if (!empty($existing_items)) {
            $hasPoints = in_array(true, array_map(function($id) { return $id >= 1000; }, $existing_items));
            if ($hasPoints) {
                return back()->with('error', __('common.cannot_add_products_with_points'));
            }
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
        // return $already_cart;
        if($already_cart) {
            // dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + 1;
            $already_cart->amount = $product->price + $already_cart->amount;
            $already_cart->amount_jp = $product->price_jp + $already_cart->amount_jp;
            $already_cart->amount_hk = $product->price_hk + $already_cart->amount_hk;
            // return $already_cart->quantity;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0)
                return back()->with('error',__('common.stock_not_sufficient'));
            $already_cart->save();
            
        }
        else
        {
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->currency = session("currency", "USD");
            $cart->price = $product->price;
            $cart->price_jp = $product->price_jp;
            $cart->price_hk = $product->price_hk;
            $cart->quantity = 1;
            $cart->amount = $cart->price * $cart->quantity;
            $cart->amount_jp = $cart->price_jp * $cart->quantity;
            $cart->amount_hk = $cart->price_hk * $cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error',__('common.stock_not_sufficient'));
            $cart->save();
            $wishlist=Wishlist::where('user_id',auth()->user()->id)->where('cart_id',null)->update(['cart_id'=>$cart->id]);
        }
        request()->session()->flash('success',__('common.product_added_to_cart'));
        return redirect()->route('cart');       
    }  

    public function singleAddToCart(Request $request){
        $request->validate([
            'slug'      =>  'required',
            'quant'      =>  'required',
        ]);
        // dd($request->quant[1]);
 //return $request;

            //$cart->price = $product->price;
            //$cart->price_jp = $product->price_jp;
            //$cart->price_hk = $product->price_hk;
        
        //$product = Product::where('slug', $request->slug)->first();
        $product = Product::getProductBySlug($request->slug);
        $level = DB::table('product_levels')->find($request->level_id); //return $level;
        if($request->price){
            $true_price = $level->price;
            $true_price_jp = $level->price_jp;
            $true_price_hk = $level->price_hk;
            $true_points = $level->price_in_points;
        }
        
        
 //return $product;
        if($product->stock <$request->quant[1]){
            return back()->with('error',__('common.out_of_stock'));
        }
        if ( ($request->quant[1] < 1) || empty($product) ) {
            request()->session()->flash('error',__('common.invalid_products'));
            return back();
        }

        // Business Rule: Prevent mixing products and points in the same transaction
        if (Auth::check()) {
            $user_id = auth()->user()->id;
        } else {
            if (!session('guest')) {
                Session::put('guest', rand(100000, 999999));
            }
            $user_id = session('guest');
        }

        $existing_items = Cart::where('user_id', $user_id)->where('order_id', null)->pluck('product_id')->toArray();
        if (!empty($existing_items)) {
            $hasPoints = in_array(true, array_map(function($id) { return $id >= 1000; }, $existing_items));
            if ($hasPoints) {
                return back()->with('error', __('common.cannot_add_products_with_points'));
            }
        }

if (Auth::check()) {
        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $product->id)->first();
}

else {

    if (!session('guest')) {
    Session::put('guest', rand(100000, 999999));
     }
    $guest= session('guest');   
     
        $already_cart = Cart::where('user_id', $guest)->where('order_id',null)->where('product_id', $product->id)->first();
}
        // return $already_cart;
//$already_cart='';

        if($already_cart) {
            return back()->with('error',__('common.product_already_in_cart'));
            $already_cart->quantity = $already_cart->quantity + $request->quant[1];
            // $already_cart->price = ($product->price * $request->quant[1]) + $already_cart->price ;
            $already_cart->amount = ($true_price * $request->quant[1])+ $already_cart->amount;
            $already_cart->amount_jp = ($true_price_jp * $request->quant[1])+ $already_cart->amount_jp;
            $already_cart->amount_hk = ($true_price_hk * $request->quant[1])+ $already_cart->amount_hk;

            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error',__('common.stock_not_sufficient'));

            $already_cart->save();
            
        }
        else
        {
            
            $cart = new Cart;
            $cart->user_id = auth()->user()->id ?? $guest;
            $cart->product_id = $product->id;
            // $cart->currency = session("currency", "USD");
            $cart->price = $true_price;
            $cart->price_jp = $true_price_jp;
            $cart->price_hk = $true_price_hk;
            $cart->points = $true_points;
            $cart->quantity = $request->quant[1];
            $cart->amount = $cart->price * $cart->quantity;
            $cart->amount_jp = $cart->price_jp * $cart->quantity;
            $cart->amount_hk = $cart->price_hk * $cart->quantity;
            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error',__('common.stock_not_sufficient'));
            // return $cart;
            $cart->save();
        }
        request()->session()->flash('success',__('common.product_added_to_cart'));
        return redirect()->route('coursecart');       
    } 
    
    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success',__('common.cart_removed_successfully'));
            return back();  
        }
        request()->session()->flash('error',__('common.error_try_again'));
        return back();       
    }     

    public function cartUpdate(Request $request){
        // dd($request->all());
        if($request->quant){
            $error = array();
            $success = '';
            // return $request->quant;
            foreach ($request->quant as $k=>$quant) {
                // return $k;
                $id = $request->qty_id[$k];
                // return $id;
                $cart = Cart::find($id);
                // return $cart;
                if($quant > 0 && $cart) {
                    // return $quant;

                    /*if($cart->product->stock < $quant){
                        request()->session()->flash('error',__('common.out_of_stock'));
                        return back();
                    }*/

                    //$cart->quantity = ($cart->product->stock > $quant) ? $quant  : $cart->product->stock;
                    $cart->quantity = $quant;
                    // return $cart;
                    
                    //if ($cart->product->stock <=0) continue;
                    $after_price=($cart->product->price-($cart->product->price*$cart->product->discount)/100);
                    $cart->amount = $after_price * $quant;
                    // return $cart->price;



                    $updatAmount = ($cart->product->price) * $quant;
                    $updatAmount_JP = ($cart->product->price_jp) * $quant;
                    $updatAmount_HK = ($cart->product->price_hk) * $quant;
                    Cart::where('id', $id)->update(['quantity' => $quant, 'amount' => $updatAmount, 'amount_jp' => $updatAmount_JP,'amount_hk' => $updatAmount_HK]);

                    

                    //$cart->save();
                    $success = __('common.cart_successfully_updated');
                }else{
                    $error[] = __('common.cart_invalid');
                }
            }
            return back()->with($error)->with('success', $success);
        }else{
            return back()->with('error',__('common.cart_invalid'));
        }    
    }

    // public function addToCart(Request $request){
    //     // return $request->all();
    //     if(Auth::check()){
    //         $qty=$request->quantity;
    //         $this->product=$this->product->find($request->pro_id);
    //         if($this->product->stock < $qty){
    //             return response(['status'=>false,'msg'=>'Out of stock','data'=>null]);
    //         }
    //         if(!$this->product){
    //             return response(['status'=>false,'msg'=>'Product not found','data'=>null]);
    //         }
    //         // $session_id=session('cart')['session_id'];
    //         // if(empty($session_id)){
    //         //     $session_id=Str::random(30);
    //         //     // dd($session_id);
    //         //     session()->put('session_id',$session_id);
    //         // }
    //         $current_item=array(
    //             'user_id'=>auth()->user()->id,
    //             'id'=>$this->product->id,
    //             // 'session_id'=>$session_id,
    //             'title'=>$this->product->title,
    //             'summary'=>$this->product->summary,
    //             'link'=>route('product-detail',$this->product->slug),
    //             'price'=>$this->product->price,
    //             'photo'=>$this->product->photo,
    //         );
            
    //         $price=$this->product->price;
    //         if($this->product->discount){
    //             $price=($price-($price*$this->product->discount)/100);
    //         }
    //         $current_item['price']=$price;

    //         $cart=session('cart') ? session('cart') : null;

    //         if($cart){
    //             // if anyone alreay order products
    //             $index=null;
    //             foreach($cart as $key=>$value){
    //                 if($value['id']==$this->product->id){
    //                     $index=$key;
    //                 break;
    //                 }
    //             }
    //             if($index!==null){
    //                 $cart[$index]['quantity']=$qty;
    //                 $cart[$index]['amount']=ceil($qty*$price);
    //                 if($cart[$index]['quantity']<=0){
    //                     unset($cart[$index]);
    //                 }
    //             }
    //             else{
    //                 $current_item['quantity']=$qty;
    //                 $current_item['amount']=ceil($qty*$price);
    //                 $cart[]=$current_item;
    //             }
    //         }
    //         else{
    //             $current_item['quantity']=$qty;
    //             $current_item['amount']=ceil($qty*$price);
    //             $cart[]=$current_item;
    //         }

    //         session()->put('cart',$cart);
    //         return response(['status'=>true,'msg'=>'Cart successfully updated','data'=>$cart]);
    //     }
    //     else{
    //         return response(['status'=>false,'msg'=>'You need to login first','data'=>null]);
    //     }
    // }

    // public function removeCart(Request $request){
    //     $index=$request->index;
    //     // return $index;
    //     $cart=session('cart');
    //     unset($cart[$index]);
    //     session()->put('cart',$cart);
    //     return redirect()->back()->with('success','Successfully remove item');
    // }

    public function checkout(Request $request){
        // return $request;
        $cart=session('cart');
        // return $cart;
        // $cart_index=\Str::random(10);
        // $sub_total=0;
        // foreach($cart as $cart_item){
        //     $sub_total+=$cart_item['amount'];
        //     $data=array(
        //         'cart_id'=>$cart_index,
        //         'user_id'=>$request->user()->id,
        //         'product_id'=>$cart_item['id'],
        //         'quantity'=>$cart_item['quantity'],
        //         'amount'=>$cart_item['amount'],
        //         'status'=>'new',
        //         'price'=>$cart_item['price'],
        //     );

        //     $cart=new Cart();
        //     $cart->fill($data);
        //     $cart->save();
        // }
        return view('frontend.pages.checkout');
    }
}

```

### 4.8 `app/Http/Controllers/OrderController.php::store`

This creates the money order for the credit cart. It is the stock template method
extended with per-currency totals and the DAS gateway call. Copy the whole method.

**OrderController::store** (lines 47-304 of `app/Http/Controllers/OrderController.php`)

```php
    public function store(Request $request)
    {

        //dd($request);


        // return $request->all();
        $this->validate($request,[
            'first_name'=>'string|required',
            'last_name'=>'string',
            'address1'=>'string|required',
            'address2'=>'string|nullable',
            'coupon'=>'nullable|numeric',
            'phone'=>'numeric|required',
            'city' => 'required|string',
            'post_code' => 'required|string',
            'email'=>'string|required',
            'state' => 'required|string',
            'country' => 'required|not_in:0,""',
            //'captcha' => 'required|captcha'
        ]);
        // return $request->all();

        if(empty(Cart::where('user_id',auth()->user()->id)->where('order_id',null)->first())){
            request()->session()->flash('error',__('common.cart_empty'));
            return back();
        }
        
        $order = new Order();
        $order_data = $request->all();
        $order_data['order_number'] = 'ORD-'.strtoupper(Str::random(10));
        $order_data['user_id'] = $request->user()->id;
        $order_data['shipping_id'] = $request->shipping;
        $shipping = Shipping::where('id',$order_data['shipping_id'])->pluck('price');
        $currency = session("currency");
      

        if($currency == "USD") {
            $order_data['sub_total'] = Helper::totalCartPrice();
        }
        else if($currency == "JPY") {
            $order_data['sub_total_jp'] = Helper::totalCartPrice();
        }
        else if($currency == "HKD") {
            $order_data['sub_total_hk'] = Helper::totalCartPrice();
        }
        $order_data['quantity']=Helper::cartCount();

        $order_data['currency'] = session("currency");

        if(session('coupon')){
            $order_data['coupon']=session('coupon')['value'];
        }
        if($request->shipping){
            if(session('coupon')) {
                if($currency == "USD") {
                    $order_data['total_amount'] = Helper::totalCartPrice()+$shipping[0]-session('coupon')['value'];
                }
                else if($currency == "JPY") {
                    $order_data['total_amount_jp'] = Helper::totalCartPrice()+$shipping[0]-session('coupon')['value'];
                }
                else if($currency == "HKD") {
                    $order_data['total_amount_hk'] = Helper::totalCartPrice()+$shipping[0]-session('coupon')['value'];
                }

                $order_data['total_amount'] = Helper::totalCartPrice()+$shipping[0]-session('coupon')['value'];
            }
            else{
                if($currency == "USD") {
                    $order_data['total_amount'] = Helper::totalCartPrice()+$shipping[0];
                }
                else if($currency == "JPY") {
                    $order_data['total_amount_jp'] = Helper::totalCartPrice()+$shipping[0];
                }
                else if($currency == "HKD") {
                    $order_data['total_amount_hk'] = Helper::totalCartPrice()+$shipping[0];
                }

                $order_data['total_amount'] = Helper::totalCartPrice()+$shipping[0];
            }
        }
        else{
            if(session('coupon')) {
                if($currency == "USD") {
                    $order_data['total_amount'] = Helper::totalCartPrice()-session('coupon')['value'];
                }
                else if($currency == "JPY") {
                    $order_data['total_amount_jp'] = Helper::totalCartPrice()-session('coupon')['value'];
                }
                else if($currency == "HKD") {
                    $order_data['total_amount_hk'] = Helper::totalCartPrice()-session('coupon')['value'];
                }

                $order_data['total_amount'] = Helper::totalCartPrice()-session('coupon')['value'];
            }
            else{
                if($currency == "USD") {
                    $order_data['total_amount'] = Helper::totalCartPrice();
                }
                else if($currency == "JPY") {
                    $order_data['total_amount_jp'] = Helper::totalCartPrice();
                }
                else if($currency == "HKD") {
                    $order_data['total_amount_hk'] = Helper::totalCartPrice();
                }

                $order_data['total_amount'] = Helper::totalCartPrice();
            }
        }
        // return $order_data['total_amount'];
        $order_data['status']="New";
        $order_data['payment_method'] = 'credit_card';
        $order_data['payment_status'] = 'Pending';
        $order->fill($order_data);

        $status = $order->save();
        if($order) {
            // dd($order->id);
            $users=User::where('role','admin')->first();
            $details=[
                'title'=>'New order created',
                'actionURL'=>route('order.show', $order->id),
                'fas'=>'fa-file-alt'
            ];

            Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);


            $order_info = Order::find($order->id);
		  
            $country = $order_info['country'];
            $email = $order_info['email'];
            $amount = $order_info['total_amount'];
            $currency = session("currency", "USD");
            $address_1 = $order_info["address1"];
            $phone = $order_info['phone'];
            $city = $order_info['country'];
            $postcode = $order_info['post_code'];
            $zone = $order_info['country'];
            $invoice_ref = 'ORD-'.strtoupper(uniqid());
            $merchant_ip = $_SERVER['REMOTE_ADDR'];
            $visit_ip = "127.0.0.1";
            $comment = "Payment from ecshop-marketing.com";

            $cData = array();
			$cData['number'] = substr(preg_replace('/\D/', '', $request->input('card_number', '')), 0, 16);
            $cData['expiry_month'] = request('expiry_month');
			$cData['expiry_year'] = request('expiry_year');

            if(trim(request('cvv')) == "") {
				request()->session()->flash('error',__('common.invalid_cvc'));
                return back();
			}
			else {
			    $cData['cvc'] = (request('cvv') != null)? request('cvv') : "";
			}

            $cData['name'] = trim($request->input('name', $request->input('name_on_card', '')));
			$cData['card_type'] = (request('card_type') != null)? request('card_type') : "";
            $merchantID = env('DASMID');
            $url = env('PAYMENT_URL');

            $headers = array(
                "Authorization: BASIC ".env('SECRET_KEY'),
                'x-api-key: '.env('X_API_KEY'),
                "Content-Type: application/json"
            );

            $card = array(
                    "cvc" => $cData['cvc'],
                    "expiry_month" => $cData['expiry_month'],
                    "expiry_year" => $cData['expiry_year'],
                    "name" => $cData['name'],
                    "number" => $cData['number']
                );

            $billing_address = array(
                                "country" => $country,
                                "email" => $email,
                                "address1" => $address_1,
                                "phone_number" => $phone,
                                "city" => $city,
                                "state" => $zone,
                                "postal_code" => $postcode
                            );

            $shipping_address = array(
                                "country" => $country,
                                "email" => $email,
                                "address1" => $address_1,
                                "phone_number" => $phone,
                                "city" => $city,
                                "state" => $zone,
                                "postal_code" => $postcode
                            );

            $return_url = array(
                        "webhook_url" => env("WEBSITE_URL")."/cart/payment?payment_status=webhook&oid=".$order->id,
                        "success_url" => env("WEBSITE_URL")."/cart/payment?payment_status=success&oid=".$order->id,
                        "decline_url" => env("WEBSITE_URL")."/cart/payment?payment_status=failed&oid=".$order->id,
                    );


            $post_vals = array(
                "amount" => $amount,
                "currency" => $currency,
                "card" => $card,
                "merchant_txn_ref" => "TOWAGAMEORD".$order->id,
                "customer_ip" => $visit_ip,
                "merchant_id" => $merchantID,
                "return_url" => $return_url,
                "billing_address" => $billing_address,
                "shipping_address" => $shipping_address,
                "time_zone" => "Asia/Kuala_Lumpur"
            );

            $post_data = json_encode($post_vals);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);

            $curl_response = curl_exec($curl);

            curl_close ($curl);

            $result = json_decode($curl_response);

            /*print "<pre>";
            print $url."<br>";
            print_r($post_data);
            print_r($headers);
            print_r($result);
            exit();*/

            if($result && count(get_object_vars($result)) > 1) {
				if($result->success == true) {
                    //session()->forget('cart');
                    //session()->forget('coupon');

                    if (!empty($result->redirect_url)) {
                        return redirect()->away($result->redirect_url);
                    }
                    else { 
                        return redirect("/cart/payment?payment_status=success&oid=".$order->id."&transaction_id=".$result->transaction_details->id);
                    }
				}
				else {
                    return redirect("/cart/payment?payment_status=failed&oid=".$order->id."&transaction_id=".$result->transaction_details->id)->with('order', $order);
				}
			} else {
				return redirect("/cart/payment?payment_status=failed&oid=".$order->id."&transaction_id=");
			}
        }
    }

```

### 4.9 Payment success handler — `app/Http/Controllers/DasGatewayController.php::payment`

This is where purchased credits are added to the wallet. The block to port is the one
that begins `// Credit purchased points once`. If the target app uses another gateway,
put the same block in its success/webhook handler after the order is marked paid.

#### `app/Http/Controllers/DasGatewayController.php`

```php
<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use DB;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Mail;
class DasGatewayController extends Controller
{
    public function payment(Request $request) {
        $order_data = $request->all();
 
        $cart = Cart::where('user_id',auth()->user()->id)->where('order_id', $order_data["oid"])->get()->toArray();
       
        $data = [];
       
        // return $cart;
        $data['items'] = array_map(function ($item) use($cart) {
            $name=Product::where('id',$item['product_id'])->pluck('title');
            return [
                'name' =>$name ,
                'price' => $item['price'],
                'desc'  => 'Thank you for using credit card',
                'qty' => $item['quantity']
            ];
        }, $cart);
 
        $data['invoice_id'] = 'ORD-'.strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.failed');
 
        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }
 
        $data['total'] = $total;
 
 
        //Get Transaction Status
        $url = env("PAYMENT_STATUS_URL")."/".$order_data["transaction_id"];
 
        $headers = array(
            "Authorization: BASIC ".env('SECRET_KEY'),
            'x-api-key: '.env('X_API_KEY'),
            "Content-Type: application/json",
            "x-secret-key: We@ve"
        );
 
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
 
        $curl_response = curl_exec($curl);
        curl_close ($curl);
        $result = json_decode($curl_response);
 
        $orderInfo = Order::where('user_id', auth()->user()->id)->where('id', $order_data["oid"])->first();
        //dd($result);
 
        if($result->success) {
            // Mail::to(auth()->user()->email)->bcc('ashutosh.singh@unlink-technologies.com')->send(new OrderConfirmationMail($orderInfo));
            $email_status = DB::table('miscs')->where('name', 'Email Status')->value('value') ?? 'inactive';
        if ($email_status !== 'active') {$email_status='inactive';}
         else {
                   try {
  Mail::to(auth()->user()->email)->bcc('bccunlink@gmail.com')->send(new OrderConfirmationMail($orderInfo));
                          $email_status='active';
                        } catch (\Exception $e) {
                      \Log::error($e->getMessage());
                          $email_status='inactive';
                        }
            }
            Order::where('user_id', auth()->user()->id)->where('id', $order_data["oid"])->update(["payment_status" => "Completed", "trans_id" => $order_data["transaction_id"], "status" => "Completed"]);
            
            // Credit purchased points once. Point top-ups are stored on cart.points.
            $order = Order::with('cart')->find($order_data["oid"]);
            $pointsToCredit = $order->cart
                ->where('product_id', '>=', 1000)
                ->sum('points');

            $alreadyCredited = DB::table('point_transactions')
                ->where('user_id', auth()->id())
                ->where('type', 'credit')
                ->where('reference_id', $order->id)
                ->exists();

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

            return view('frontend.pages.order-success')->with('transaction_id', $order_data["transaction_id"])->with('orderInfo', $orderInfo)->with('email_status', $email_status);
        }
        else {
            Order::where('user_id', auth()->user()->id)->where('id', $order_data["oid"])->update(["payment_status" => "Failed", "trans_id" => $order_data["transaction_id"], "status" => "Payment Failed"]);
            return view('frontend.pages.order-failed')->with('order', $order_data)->with('orderInfo', $orderInfo);
        }
    }

   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $order_data = $request->all();
        dd($order_data);
        return view('frontend.pages.order-success')->with('order', $order_data);
    }

    public function failed(Request $request)
    {
        $order_data = $request->all();
        return view('frontend.pages.order-failed')->with('order', $order_data);
    }
}

```

### 4.10 `app/Http/Controllers/HomeController.php::index`

Splits orders into credit purchases and course redemptions for the dashboard.

**HomeController::index** (lines 33-59 of `app/Http/Controllers/HomeController.php`)

```php
    public function index() {
        if(auth()->user()->role == "user") {
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
                ->with('redeemedOrders', $redeemedOrders);
        }
        else {
            return view('user.index');
        }
    }

```

---

## 5. Routes (`routes/web.php`)

```php
use App\Http\Controllers\PointsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DasGatewayController;
use App\Http\Controllers\HomeController;

// Cart section
Route::get('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart');
Route::get('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart-delete');
Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');

Route::get('/cart', function () {
    return view('frontend.pages.cart');
})->name('cart');

Route::get('/coursecart', function () {
    return view('frontend.pages.coursecart');
})->name('coursecart');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware(['user', 'points.gate']);

// Points System Routes
Route::group(['middleware' => ['auth']], function() {
    Route::get('/points/topup', [PointsController::class, 'topup'])->name('points.topup');
    Route::post('/points/add-to-cart', [PointsController::class, 'addToCart'])->name('points.add-to-cart');
    Route::post('/points/redeem', [PointsController::class, 'redeem'])->name('points.redeem');
});

// Order + payment
Route::post('cart/order', [OrderController::class, 'store'])->name('cart.order');
Route::get('cart/payment', [DasGatewayController::class, 'payment'])->name('cart.payment');
Route::get('payment/failed', [DasGatewayController::class, 'failed'])->name('payment.failed');
Route::get('payment/success', [DasGatewayController::class, 'success'])->name('payment.success');

// User dashboard
Route::group(['prefix' => '/user', 'middleware' => ['user']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('user');
    Route::get('/order/show/{id}', "HomeController@orderShow")->name('user.order.show');
});
```

---

## 6. Frontend views

### 6.1 `resources/views/frontend/pages/topup.blade.php` (new, full file)

#### `resources/views/frontend/pages/topup.blade.php`

```blade
@extends('frontend.layouts.main')
@section('title', __('frontend.topup.title'))
@section('description', __('frontend.topup.meta'))

@section('main-content')
@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.topup.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.topup.title')]
    ]
])

@php
    $cur = session('currency');
    if ($cur == 'JPY') {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'&yen;1 - &yen;79,999',        'f'=>false],
            ['n'=>__('frontend.topup.tier2'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'&yen;80,000 - &yen;159,999',  'f'=>false],
            ['n'=>__('frontend.topup.tier3'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'&yen;160,000 - &yen;239,999', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'&yen;240,000+',           'f'=>true],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
        $rateNote = __('frontend.topup.rate_jpy');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'HK$1 - HK$3,999',       'f'=>false],
            ['n'=>__('frontend.topup.tier2'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'HK$4,000 - HK$7,999',     'f'=>false],
            ['n'=>__('frontend.topup.tier3'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'HK$12,000+',           'f'=>true],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rateNote = __('frontend.topup.rate_hkd');
    } else {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'$1 - $499',       'f'=>false],
            ['n'=>__('frontend.topup.tier2'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'$500 - $999',     'f'=>false],
            ['n'=>__('frontend.topup.tier3'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'$1,000 - $1,499', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'$1,500+',         'f'=>true],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rateNote = __('frontend.topup.rate_usd');
    }
@endphp

{{-- ==========================================================================
     Credit top-up
     Tier cards, then one calculator panel with a live result rail, then the
     three-step explainer. Styles: public/css/theme.css — section 20
     JS hooks kept: #topup_amount, #base_points, #multiplier_display,
     #total_points, .topup-form, .topup-btn, .tu-quick__btn[data-amount],
     .tu-tier[data-mult], .is-current, .is-active, .tu-stats__total.is-pulse
     ========================================================================== --}}
<section class="tu">
    <div class="tu__wrap">

        {{-- Intro --}}
        <div class="tu-intro">
            <p class="tu-intro__desc">{{ __('frontend.topup.intro') }}</p>
            <div class="tu-intro__chips">
                <span class="tu-chip"><i class="fas fa-exchange-alt" aria-hidden="true"></i> {{ $rateNote }}</span>
                <span class="tu-chip tu-chip--warn"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> <strong>{{ __('frontend.topup.note_title') }}</strong> {{ __('frontend.topup.note_text') }}</span>
            </div>
        </div>

        {{-- Tier cards --}}
        <div class="tu-tiers">
            <div class="tu-tiers__head">
                <h2 class="tu-tiers__title">{{ __('frontend.topup.tiers_title') }}</h2>
                <span class="tu-tiers__cols">{{ __('frontend.topup.tiers_cols') }}</span>
            </div>

            <ul class="tu-tiers__grid">
                @foreach($tiers as $index => $t)
                    <li class="tu-tier {{ $t['f'] ? 'tu-tier--best' : '' }}" data-mult="{{ $t['big'] }}">
                        <div class="tu-tier__top">
                            <span class="tu-tier__icon"><i class="fas {{ $t['i'] }}" aria-hidden="true"></i></span>
                            @if($t['f'])
                                <span class="tu-tier__badge">{{ __('frontend.topup.best') }}</span>
                            @endif
                            <span class="tu-tier__current"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.topup.current') }}</span>
                        </div>

                        <p class="tu-tier__mult">{{ $t['big'] }}</p>

                        <div class="tu-tier__meta">
                            <strong class="tu-tier__name">{{ $t['n'] }}</strong>
                            <span class="tu-tier__range">{!! $t['r'] !!}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Calculator --}}
        <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-form tu-calc" novalidate>
            @csrf

            <div class="tu-calc__main">
                <div class="tu-calc__head">
                    <span class="tu-calc__icon"><i class="fas fa-calculator" aria-hidden="true"></i></span>
                    <div>
                        <h2 class="tu-calc__title">{{ __('frontend.topup.calc_title') }}</h2>
                        <p class="tu-calc__desc">{{ __('frontend.topup.calc_desc') }}</p>
                    </div>
                </div>

                <label class="tu-form__label" for="topup_amount">{{ __('frontend.topup.amount') }}</label>
                <div class="tu-amount">
                    <span class="tu-amount__symbol">{!! $symbol !!}</span>
                    <input type="number" name="amount" id="topup_amount" class="tu-amount__input" placeholder="{{ __('frontend.topup.amount_ph') }}" min="1" required inputmode="decimal">
                </div>

                <span class="tu-form__label tu-form__label--sm">{{ __('frontend.topup.quick') }}</span>
                <div class="tu-quick">
                    @foreach($quick as $q)
                        <button type="button" class="tu-quick__btn" data-amount="{{ $q }}">{!! $symbol !!}{{ number_format($q) }}</button>
                    @endforeach
                </div>
            </div>

            <div class="tu-calc__side">
                <div class="tu-stats">
                    <div class="tu-stats__row">
                        <span>{{ __('frontend.topup.base') }}:</span>
                        <span id="base_points">0</span>
                    </div>
                    <div class="tu-stats__row">
                        <span>{{ __('frontend.topup.multiplier') }}:</span>
                        <span class="tu-stats__mult" id="multiplier_display">x1</span>
                    </div>
                    <div class="tu-stats__total">
                        <span class="tu-stats__total-label">{{ __('frontend.topup.total') }}:</span>
                        <span class="tu-stats__total-value"><i class="fas fa-bolt" aria-hidden="true"></i> <span id="total_points">0</span></span>
                    </div>
                </div>

                <button type="submit" class="topup-btn tu-submit">
                    <span>{{ __('frontend.topup.submit') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>

                <p class="tu-trust">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.topup.secure') }}
                </p>
            </div>
        </form>

        {{-- How it works --}}
        <div class="tu-how">
            <h2 class="tu-how__title">{{ __('frontend.topup.how_title') }}</h2>
            <ol class="tu-how__steps">
                <li class="tu-step">
                    <span class="tu-step__num">01</span>
                    <span class="tu-step__icon"><i class="fas fa-hand-pointer" aria-hidden="true"></i></span>
                    <h3 class="tu-step__title">{{ __('frontend.topup.step1_title') }}</h3>
                    <p class="tu-step__desc">{{ __('frontend.topup.step1_desc') }}</p>
                </li>
                <li class="tu-step">
                    <span class="tu-step__num">02</span>
                    <span class="tu-step__icon"><i class="fas fa-lock" aria-hidden="true"></i></span>
                    <h3 class="tu-step__title">{{ __('frontend.topup.step2_title') }}</h3>
                    <p class="tu-step__desc">{{ __('frontend.topup.step2_desc') }}</p>
                </li>
                <li class="tu-step">
                    <span class="tu-step__num">03</span>
                    <span class="tu-step__icon"><i class="fas fa-graduation-cap" aria-hidden="true"></i></span>
                    <h3 class="tu-step__title">{{ __('frontend.topup.step3_title') }}</h3>
                    <p class="tu-step__desc">{{ __('frontend.topup.step3_desc') }}</p>
                </li>
            </ol>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    // Live points calculator
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('topup_amount');
        const totalPointsDisplay = document.getElementById('total_points');
        const basePointsDisplay = document.getElementById('base_points');
        const multiplierDisplay = document.getElementById('multiplier_display');
        if (!amountInput) return;

        function calculatePoints() {
            const amount = parseFloat(amountInput.value) || 0;
            let multiplier = 1;
            const isJPY = {{ session('currency') == 'JPY' ? 'true' : 'false' }};
            const isHKD = {{ session('currency') == 'HKD' ? 'true' : 'false' }};
            let basePoints = 0;

            if (isJPY) {
                basePoints = Math.floor(amount / 160);
                if (amount >= 240000) multiplier = 2.5;
                else if (amount >= 160000) multiplier = 2;
                else if (amount >= 80000) multiplier = 1.5;
                else multiplier = 1;
            } else if (isHKD) {
                basePoints = Math.floor(amount / 8);
                if (amount >= 12000) multiplier = 2.5;
                else if (amount >= 8000) multiplier = 2;
                else if (amount >= 4000) multiplier = 1.5;
                else multiplier = 1;
            } else {
                basePoints = Math.floor(amount);
                if (amount >= 1500) multiplier = 2.5;
                else if (amount >= 1000) multiplier = 2;
                else if (amount >= 500) multiplier = 1.5;
                else multiplier = 1;
            }

            const totalPoints = Math.round(basePoints * multiplier);
            if(basePointsDisplay) basePointsDisplay.textContent = basePoints.toLocaleString();
            if(multiplierDisplay) multiplierDisplay.textContent = 'x' + multiplier;
            if(totalPointsDisplay) totalPointsDisplay.textContent = totalPoints.toLocaleString();
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('input', function () { this.setCustomValidity(''); });
        amountInput.addEventListener('change', calculatePoints);

        // Topup (add to cart) - submit without redirect, then reload
        const topupForms = document.querySelectorAll('.topup-form');
        topupForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const amountField = form.querySelector('#topup_amount');
                if (amountField && !((parseFloat(amountField.value) || 0) >= 1)) {
                    amountField.setCustomValidity(@json(__('frontend.topup.amount_req')));
                    amountField.reportValidity();
                    return;
                }
                const submitBtn = form.querySelector('.topup-btn');
                const originalBtnText = submitBtn.innerHTML;
                const originalBtnState = submitBtn.disabled;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + @json(__('frontend.topup.loading'));

                fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                    .then(response => new Promise(resolve => setTimeout(() => resolve(response), 500)))
                    .then(() => { window.location.reload(); })
                    .catch(error => {
                        console.error('Error:', error);
                        submitBtn.disabled = originalBtnState;
                        submitBtn.innerHTML = originalBtnText;
                    });
            });
        });
    });
</script>

<script>
    // UI only: quick amounts, current-tier highlight and total pulse.
    // Reads the calculator's output; the calculation above is unchanged.
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('topup_amount');
        const multiplier = document.getElementById('multiplier_display');
        const total = document.getElementById('total_points');
        if (!input || !multiplier || !total) return;

        document.querySelectorAll('.tu-quick__btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                input.value = btn.dataset.amount;
                input.dispatchEvent(new Event('input', { bubbles: true }));
                input.focus();
            });
        });

        const tiers = document.querySelectorAll('.tu-tier');
        const quickBtns = document.querySelectorAll('.tu-quick__btn');
        const totalWrap = total.closest('.tu-stats__total');

        new MutationObserver(function () {
            const hasAmount = (parseFloat(input.value) || 0) > 0;
            tiers.forEach(function (tier) {
                tier.classList.toggle('is-current', hasAmount && tier.dataset.mult === multiplier.textContent.trim());
            });
            quickBtns.forEach(function (btn) {
                btn.classList.toggle('is-active', btn.dataset.amount === input.value);
            });
            totalWrap.classList.remove('is-pulse');
            void totalWrap.offsetWidth;
            totalWrap.classList.add('is-pulse');
        }).observe(total, { childList: true, characterData: true, subtree: true });
    });
</script>
@endpush

```

### 6.2 `resources/views/frontend/pages/coursecart.blade.php` (new, full file)

#### `resources/views/frontend/pages/coursecart.blade.php`

```blade
@extends('frontend.layouts.main')
@section('title', __('frontend.coursecart.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.coursecart.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.coursecart.title')]
    ]
])

{{-- ==========================================================================
     Course cart
     Single centred column: unlock steps, balance strip,
     ticket rows, sticky summary bar.
     Styles: public/css/theme.css — section 18
     ========================================================================== --}}
<section class="bag">
    <div class="bag__wrap">

        <ol class="bag-steps">
            <li class="bag-step is-active">
                <span class="bag-step__no">1</span>
                <span class="bag-steps__label">{{ __('frontend.coursecart.step_cart') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">2</span>
                <span class="bag-steps__label">{{ __('frontend.coursecart.step_unlock') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">3</span>
                <span class="bag-steps__label">{{ __('frontend.coursecart.step_learn') }}</span>
            </li>
        </ol>

        @auth
            @php
                $user = auth()->user();
                $points = $user->points_balance ?? 0;
                $cartItems = Helper::cartCount() ? Helper::getAllProductFromCart()->where('order_id', null) : collect();
                $itemCount = $cartItems->count();
                $total_points = $itemCount ? Helper::totalCartPoints() : 0;
                $coverage = $total_points > 0 ? min(100, round(($points / $total_points) * 100)) : 100;
                $enough = $points >= $total_points;
                $after = $points - $total_points;
            @endphp

            {{-- Balance and coverage --}}
            <div class="bag-balance">
                <span class="bag-balance__icon" aria-hidden="true"><i class="fas fa-bolt"></i></span>
                <div class="bag-balance__text">
                    <span class="bag-balance__label">{{ __('frontend.coursecart.balance') }}</span>
                    <span class="bag-balance__amt">{{ number_format($points) }} <small>{{ __('frontend.coursecart.credits') }}</small></span>

                    @if($itemCount)
                        <div class="bag-meter" role="img" aria-label="{{ __('frontend.coursecart.coverage') }}: {{ $coverage }}%">
                            <span class="bag-meter__fill {{ $enough ? '' : 'is-short' }}" style="width: {{ $coverage }}%"></span>
                        </div>
                        <span class="bag-meter__note">
                            {{ __('frontend.coursecart.coverage') }}: {{ $coverage }}%
                        </span>
                    @endif
                </div>
                <a href="{{ route('points.topup') }}" class="bag-btn bag-btn--primary bag-balance__btn">
                    <i class="fas fa-plus" aria-hidden="true"></i> {{ __('frontend.coursecart.buy') }}
                </a>
            </div>

            @if($itemCount)
                @if(!$enough)
                    <p class="bag-warn"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> {{ __('frontend.coursecart.low') }}</p>
                @endif

                <div class="bag-panel">
                    <div class="bag-panel__head">
                        <h2 class="bag-panel__title">{{ __('frontend.coursecart.items_title') }}</h2>
                        <span class="bag-count">{{ trans_choice('frontend.coursecart.items', $itemCount, ['count' => $itemCount]) }}</span>
                    </div>

                    @foreach($cartItems as $cart)
                        @php
                            $item_title = __('frontend.coursecart.package');
                            $item_photo = null;
                            $item_link = '#';
                            $is_course = false;
                            $level = null;

                            if($cart->product) {
                                $item_title = $cart->product->title;
                                $item_link = route('product-detail', $cart->product->slug);
                                $photo_arr = explode(',', $cart->product->photo ?? '');
                                $item_photo = $photo_arr[0] ?? null;

                                if($cart->product_id < 1000) {
                                    $is_course = true;
                                    $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                 ->where('price_in_points', $cart->points)
                                                 ->first();
                                }
                            }

                            $lvl_slug  = $level ? strtolower($level->skill_level) : '';
                            $lvl_key   = 'frontend.coursecart.levels.' . $lvl_slug;
                            $lvl_label = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                        @endphp

                        <div class="bag-row">
                            <span class="bag-row__thumb {{ $is_course ? '' : 'bag-row__thumb--credits' }}">
                                @if($item_photo)
                                    <img src="{{ asset($item_photo) }}" alt="" loading="lazy">
                                @elseif($is_course)
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @else
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                @endif
                            </span>

                            <div class="bag-row__body">
                                @if($is_course)
                                    @if($lvl_label)
                                        <span class="badge"><i class="fas fa-signal" aria-hidden="true"></i> {{ $lvl_label }}</span>
                                    @endif
                                @else
                                    <span class="badge badge--brand">{{ __('frontend.coursecart.package') }}</span>
                                @endif

                                @if($cart->product)
                                    <a href="{{ $item_link }}" class="bag-row__title">{{ $item_title }}</a>
                                @else
                                    <span class="bag-row__title">{{ $item_title }}</span>
                                @endif

                                <span class="bag-row__meta">
                                    @if(!$is_course)
                                        <span>{{ __('frontend.coursecart.amount') }}: {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                    @endif
                                </span>
                            </div>

                            <span class="bag-row__amount">
                                <i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($cart->points) }}
                                <small>{{ __('frontend.coursecart.price') }}</small>
                            </span>

                            <a href="{{ route('cart-delete', $cart->id) }}" class="bag-row__remove" aria-label="{{ __('frontend.coursecart.remove') }}: {{ $item_title }}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i><span>{{ __('frontend.coursecart.remove') }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>

                <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>

                <div class="bag-bar">
                    <div class="bag-bar__figures">
                        <span class="bag-bar__label">{{ __('frontend.coursecart.total') }}:</span>
                        <span class="bag-bar__total">{{ number_format($total_points) }} <small>{{ __('frontend.coursecart.credits') }}</small></span>
                        @if($enough)
                            <span class="bag-bar__cut">{{ __('frontend.coursecart.after') }}: {{ number_format($after) }}</span>
                        @endif
                    </div>

                    <div class="bag-bar__actions">
                        <a href="{{ route('product-lists') }}" class="bag-btn bag-btn--ghost">
                            <i class="fas fa-plus" aria-hidden="true"></i> {{ __('frontend.coursecart.browse') }}
                        </a>
                        @if($enough)
                            <button type="submit" form="redeemPointsForm" class="bag-btn bag-btn--primary">
                                <i class="fas fa-lock-open" aria-hidden="true"></i> {{ __('frontend.coursecart.unlock') }}
                            </button>
                        @else
                            <a href="{{ route('points.topup') }}" class="bag-btn bag-btn--primary">
                                <i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.coursecart.buy') }}
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <div class="bag-empty">
                    <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                    <h2 class="bag-empty__title">{{ __('frontend.coursecart.empty_title') }}</h2>
                    <p class="bag-empty__desc">{{ __('frontend.coursecart.empty_desc') }}</p>
                    <div class="bag-empty__actions">
                        <a href="{{ route('product-lists') }}" class="bag-btn bag-btn--primary">
                            <i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ __('frontend.coursecart.empty_btn') }}
                        </a>
                    </div>
                </div>
            @endif

        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.coursecart.auth_title') }}</h2>
                <p class="bag-empty__desc">{{ __('frontend.coursecart.auth_desc') }}</p>
                <div class="bag-empty__actions">
                    <a href="{{ route('login.form') }}" class="bag-btn bag-btn--primary">
                        <i class="fas fa-sign-in-alt" aria-hidden="true"></i> {{ __('frontend.coursecart.login') }}
                    </a>
                    <a href="{{ route('register.form') }}" class="bag-btn bag-btn--ghost">
                        <i class="fas fa-user-plus" aria-hidden="true"></i> {{ __('frontend.coursecart.register') }}
                    </a>
                </div>
            </div>
        @endauth

    </div>
</section>
@endsection

```

### 6.3 `resources/views/frontend/pages/cart.blade.php` (replace, full file)

#### `resources/views/frontend/pages/cart.blade.php`

```blade
@extends('frontend.layouts.main')
@section('title', __('frontend.cart.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.cart.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.cart.title')]
    ]
])

{{-- ==========================================================================
     Credit cart
     Single centred column: purchase steps, ticket rows,
     sticky summary bar.
     Styles: public/css/theme.css — section 18
     ========================================================================== --}}
<section class="bag">
    <div class="bag__wrap">

        <ol class="bag-steps">
            <li class="bag-step is-active">
                <span class="bag-step__no">1</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_cart') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">2</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_pay') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">3</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_done') }}</span>
            </li>
        </ol>

        @if(Helper::cartCount())
            @php
                $cartItems = Helper::getAllProductFromCart();
                $subtotal = 0;
                foreach($cartItems as $item) { $subtotal += $item['price']; }
                $discount = session()->has('coupon') ? Session::get('coupon')['value'] : 0;
                $total_amount = $subtotal - $discount;
                $sym = Helper::getCurrencySymbol(session('currency'));
                $isJPY = session('currency') == 'JPY';
            @endphp

            <div class="bag-panel">
                <div class="bag-panel__head">
                    <h2 class="bag-panel__title">{{ __('frontend.cart.items_title') }}</h2>
                    <span class="bag-count">{{ trans_choice('frontend.cart.items', count($cartItems), ['count' => count($cartItems)]) }}</span>
                </div>

                @foreach($cartItems as $cart)
                    @php
                        $item_title = __('frontend.cart.package');
                        $item_link = '#';
                        $item_photo = null;
                        if($cart->product) {
                            $item_title = $cart->product->title;
                            $item_link = route('product-detail', $cart->product->slug);
                            $item_photo = $cart->product->photo ? explode(',', $cart->product->photo)[0] : null;
                        }
                    @endphp

                    <div class="bag-row">
                        <span class="bag-row__thumb {{ $cart->product ? '' : 'bag-row__thumb--credits' }}">
                            @if($item_photo)
                                <img src="{{ asset($item_photo) }}" alt="" loading="lazy">
                            @elseif($cart->product)
                                <i class="fas fa-book-open" aria-hidden="true"></i>
                            @else
                                <i class="fas fa-bolt" aria-hidden="true"></i>
                            @endif
                        </span>

                        <div class="bag-row__body">
                            <span class="badge {{ $cart->product ? '' : 'badge--brand' }}">
                                {{ $cart->product ? __('frontend.cart.tag_course') : __('frontend.cart.tag_credits') }}
                            </span>

                            @if($cart->product)
                                <a href="{{ $item_link }}" class="bag-row__title">{{ $item_title }}</a>
                            @else
                                <span class="bag-row__title">{{ $item_title }}</span>
                            @endif

                            <span class="bag-row__meta">
                                <span><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($cart->points) }} {{ __('frontend.cart.credits') }}</span>
                            </span>
                        </div>

                        <span class="bag-row__amount">
                            {{ $sym }}{{ number_format($cart['price'], $isJPY ? 0 : 2) }}
                            <small>{{ __('frontend.cart.amount') }}</small>
                        </span>

                        <a href="{{ route('cart-delete', $cart->id) }}" class="bag-row__remove" aria-label="{{ __('frontend.cart.remove') }}: {{ $item_title }}">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i><span>{{ __('frontend.cart.remove') }}</span>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="bag-bar">
                <div class="bag-bar__figures">
                    <span class="bag-bar__label">{{ __('frontend.cart.total') }}:</span>
                    <span class="bag-bar__total">{{ $sym }}{{ number_format($total_amount, $isJPY ? 0 : 2) }}</span>
                    @if($discount > 0)
                        <span class="bag-bar__cut">&minus; {{ $sym }}{{ number_format($discount, $isJPY ? 0 : 2) }} {{ __('frontend.cart.discount') }}</span>
                    @endif
                </div>

                <div class="bag-bar__actions">
                    @if(Helper::totalCartPoints() > 0)
                        <a href="{{ route('product-lists') }}" class="bag-btn bag-btn--ghost">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i> {{ __('frontend.cart.browse') }}
                        </a>
                    @endif
                    <a href="{{ route('checkout') }}" class="bag-btn bag-btn--primary">
                        {{ __('frontend.cart.checkout') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <div class="bag-foot">
                <p class="bag-foot__trust"><i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.cart.secure') }}</p>
                <img class="bag-foot__pay" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.cart.payments') }}" loading="lazy">
            </div>
        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.cart.empty_title') }}</h2>
                <p class="bag-empty__desc">{{ __('frontend.cart.empty_desc') }}</p>
                <div class="bag-empty__actions">
                    <a href="{{ route('product-lists') }}" class="bag-btn bag-btn--ghost">
                        <i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ __('frontend.cart.empty_courses') }}
                    </a>
                    <a href="{{ route('points.topup') }}" class="bag-btn bag-btn--primary">
                        <i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.cart.empty_credits') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

```

### 6.4 `resources/views/frontend/pages/product_detail.blade.php` — level picker

Add at the top of `main-content`:

**Level variables** (lines 7-15 of `resources/views/frontend/pages/product_detail.blade.php`)

```blade
@php
    $photos = array_values(array_filter(explode(',', (string) $product_detail->photo)));
    $pdCategory = $product_detail->cat_info ?? null;
    $pdLevels = $product_detail->levels ?? collect();
    $hasLevels = $pdLevels && count($pdLevels);
    $levelName = function ($level) {
        $key = 'frontend.course.names.' . strtolower((string) $level->skill_level);
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };

```

Level description panels and the buy box with one form per level:

**Level panels + buy box** (lines 82-176 of `resources/views/frontend/pages/product_detail.blade.php`)

```blade
                {{-- What the level you picked covers — updates with the choice --}}
                @if($hasLevels)
                    <div class="pd-what">
                        <h2 class="pd-what__title">{{ __('frontend.course.about_level') }}</h2>

                        @foreach($pdLevels as $key => $level)
                            <div class="pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" @if($key !== 0) hidden @endif>
                                <p class="pd-what__for">{{ $levelName($level) }}</p>
                                <ul class="pd-feats">
                                    @if($level->learn_info)
                                        <li class="pd-feat">
                                            <span class="pd-feat__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                                            <span class="pd-feat__body">
                                                <span class="pd-feat__label">{{ __('frontend.course.learn') }}</span>
                                                <span class="pd-feat__desc">{{ $level->learn_info }}</span>
                                            </span>
                                        </li>
                                    @endif
                                    @if($level->purpose)
                                        <li class="pd-feat">
                                            <span class="pd-feat__icon" aria-hidden="true"><i class="fas fa-bullseye"></i></span>
                                            <span class="pd-feat__body">
                                                <span class="pd-feat__label">{{ __('frontend.course.purpose') }}</span>
                                                <span class="pd-feat__desc">{{ $level->purpose }}</span>
                                            </span>
                                        </li>
                                    @endif
                                    @if($level->outcome)
                                        <li class="pd-feat">
                                            <span class="pd-feat__icon" aria-hidden="true"><i class="fas fa-award"></i></span>
                                            <span class="pd-feat__body">
                                                <span class="pd-feat__label">{{ __('frontend.course.outcome') }}</span>
                                                <span class="pd-feat__desc">{{ $level->outcome }}</span>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Pick a level and unlock it — the only place either happens --}}
            @if($hasLevels)
                <aside class="pd-buy">
                    <p class="pd-buy__title">{{ __('frontend.course.choose') }}</p>

                    <ul class="pd-levels">
                        @foreach($pdLevels as $key => $level)
                            <li>
                                <button type="button" class="pd-compare__row {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" aria-pressed="{{ $key === 0 ? 'true' : 'false' }}">
                                    <span class="pd-levels__tick" aria-hidden="true"><i class="fas fa-check"></i></span>
                                    <span class="pd-levels__name">{{ $levelName($level) }}</span>
                                    <span class="pd-levels__price">
                                        <strong>{{ number_format($level->price_in_points) }}</strong>
                                        <small>{{ __('frontend.course.credits') }}</small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    @foreach($pdLevels as $key => $level)
                        <div class="pd-buy__level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" @if($key !== 0) hidden @endif>
                            <div class="pd-buy__cost">
                                <span class="pd-buy__label">{{ __('frontend.course.level') }}: {{ $levelName($level) }}</span>
                                <span class="pd-buy__price">
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                    <strong>{{ number_format($level->price_in_points) }}</strong>
                                    <small>{{ __('frontend.course.credits') }}</small>
                                </span>
                            </div>

                            <form action="{{ route('single-add-to-cart') }}" method="POST" class="enroll-form">
                                @csrf
                                <input type="hidden" name="quant[1]" value="1">
                                <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                <input type="hidden" name="price" value="{{ $level->price }}">
                                <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                <input type="hidden" name="level_id" value="{{ $level->id }}">
                                <button type="submit" class="pd-enroll enroll-btn">
                                    <span>{{ __('frontend.course.add') }}</span>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach

                    <ul class="pd-buy__includes">
                        <li><i class="fas fa-signal" aria-hidden="true"></i> {{ trans_choice('frontend.course.levels', count($pdLevels), ['count' => count($pdLevels)]) }}</li>
                        @if($pdCategory)
                            <li><i class="fas fa-layer-group" aria-hidden="true"></i> {{ __('frontend.course.category_label') }} {{ $pdCategory->title }}</li>
                        @endif

```

Script that keeps the level list and the buy box in sync:

**Level switching JS** (lines 203-223 of `resources/views/frontend/pages/product_detail.blade.php`)

```blade
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ---- Level selection (the level list and the buy box stay in sync) ----
    const triggers = document.querySelectorAll('.pd-compare__row');
    const panels = document.querySelectorAll('.pd-level, .pd-buy__level');

    function selectLevel(id) {
        triggers.forEach(t => {
            const on = t.getAttribute('data-level-id') === id;
            t.classList.toggle('active', on);
            t.setAttribute('aria-pressed', on ? 'true' : 'false');
        });
        panels.forEach(p => {
            const on = p.getAttribute('data-level-id') === id;
            p.hidden = !on;
            p.classList.remove('active');
            if (on) setTimeout(() => p.classList.add('active'), 10);
        });
    }
    triggers.forEach(t => t.addEventListener('click', function () { selectLevel(this.getAttribute('data-level-id')); }));

```

### 6.5 `resources/views/frontend/layouts/header.blade.php` — balance pill and cart drawer

**Header variables** (lines 16-17 of `resources/views/frontend/layouts/header.blade.php`)

```blade
    $hdCartQty        = Helper::totalCartQuantity();
    $hdBalance        = Auth::check() ? (Auth::user()->points_balance ?? 0) : 0;

```

**Balance pill** (lines 138-145 of `resources/views/frontend/layouts/header.blade.php`)

```blade

            @if(Auth::check())
                {{-- Credit balance --}}
                <a href="{{ route('points.topup') }}" class="ak-credits ak--desktop" aria-label="{{ number_format($hdBalance) }} {{ __('frontend.header.credits') }}. {{ __('frontend.header.balance') }}">
                    <i class="fas fa-bolt" aria-hidden="true"></i>
                    <span class="ak-num">{{ number_format($hdBalance) }}</span>
                </a>
            @endif

```

**Cart slide-over items** (lines 320-365 of `resources/views/frontend/layouts/header.blade.php`)

```blade
    <div class="ak-cart__scroll">
        @if(Helper::cartCount())
            <ul class="ak-cart__list">
                @foreach(Helper::getAllProductFromCart() as $cart)
                    @php
                        $isPoints = !$cart->product || $cart->product_id >= 1000;
                        $item_title = __('frontend.header.cart_credits');
                        $item_photo = null;
                        $item_level = null;

                        if($cart->product && $cart->product_id < 1000) {
                            $photo_arr = explode(',', $cart->product->photo);
                            $item_photo = $photo_arr[0];
                            $item_title = $cart->product->title;

                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                         ->where('price_in_points', $cart->points)
                                         ->first();
                            $lvl_key = $level ? 'frontend.header.levels.' . strtolower($level->skill_level) : null;
                            $item_level = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                        }
                    @endphp

                    <li class="ak-cart__item">
                        @if($isPoints)
                            <span class="ak-cart__img ak-cart__img--credits"><i class="fas fa-bolt" aria-hidden="true"></i></span>
                        @else
                            <span class="ak-cart__img"><img src="{{ asset($item_photo) }}" alt="" loading="lazy"></span>
                        @endif

                        <div class="ak-cart__info">
                            <p class="ak-cart__name">{{ $item_title }}</p>
                            @if($item_level)
                                <span class="badge ak-cart__level">{{ $item_level }}</span>
                            @endif
                            <p class="ak-cart__meta">
                                <span class="ak-num">{{ $cart->quantity }}</span> ×
                                <span class="ak-num">{{ number_format($cart->points) }}</span> {{ __('frontend.header.credits') }}
                            </p>
                            @if($isPoints)
                                <p class="ak-cart__price ak-num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            @endif
                        </div>

                        <a href="{{ route('cart-delete',$cart->id) }}" class="ak-cart__remove" aria-label="{{ __('frontend.header.cart_remove') }}">
                            <i class="fas fa-times" aria-hidden="true"></i>

```

### 6.6 `resources/views/frontend/pages/checkout.blade.php` — order summary row

**Checkout credits row** (lines 64-78 of `resources/views/frontend/pages/checkout.blade.php`)

```blade
                @if(Helper::getAllProductFromCart())
                    @foreach(Helper::getAllProductFromCart() as $key => $cart)
                        @php
                            $user_id = auth()->check() ? auth()->id() : session('guest');
                            $points = App\Models\Cart::where('user_id', $user_id)->where('order_id', null)->pluck('points')->first();
                        @endphp
                        <div class="co-order__row">
                            <span class="co-order__item">
                                <span class="co-order__icon"><i class="fas fa-bolt" aria-hidden="true"></i></span>
                                {{ number_format($points, 0, '.', ',') }} {{ __('frontend.checkout.credits') }}
                            </span>
                            <span class="co-order__price">{{ $coSymbol }}{{ number_format($cart['price'], $coDecimals, '.', ',') }}</span>
                        </div>
                    @endforeach
                @endif

```

### 6.7 `resources/views/frontend/user/dashboard.blade.php`

The controller passes `$purchasedOrders` and `$redeemedOrders`. Balance card and tabs:

**Dashboard variables** (lines 13-26 of `resources/views/frontend/user/dashboard.blade.php`)

```blade
@php
    $u = Auth::user();
    $purchasedCount = isset($purchasedOrders) ? count($purchasedOrders) : 0;
    $redeemedCount = isset($redeemedOrders) ? count($redeemedOrders) : 0;
    $levelLabel = function ($level) {
        $key = 'frontend.dashboard.levels.' . strtolower((string) $level->skill_level);
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };
    $statusLabel = function ($value) {
        $key = 'frontend.dashboard.statuses.' . strtolower(trim((string) $value));
        return Lang::has($key) ? __($key) : ucwords((string) $value);
    };
    $fmtDate = fn ($date, $format) => $date->locale(app()->getLocale())->translatedFormat($format);
@endphp

```

**Balance stat** (lines 52-56 of `resources/views/frontend/user/dashboard.blade.php`)

```blade
                <span class="ds-stat__icon"><i class="fas fa-bolt"></i></span>
                <span class="ds-stat__label">{{ __('frontend.dashboard.credits') }}</span>
                <strong class="ds-stat__value">{{ number_format($u->points_balance ?? 0) }}</strong>
                <a href="{{ route('points.topup') }}" class="ds-stat__link">{{ __('frontend.dashboard.buy') }} <i class="fas fa-arrow-right"></i></a>
            </div>

```

**Tabs and purchases panel** (lines 76-135 of `resources/views/frontend/user/dashboard.blade.php`)

```blade
        <div class="ds-tabs" role="tablist" aria-label="{{ __('frontend.dashboard.tabs') }}">
            <button type="button" role="tab" class="ds-tab active" data-tab="purchased" aria-selected="true">
                <i class="fas fa-gift"></i> {{ __('frontend.dashboard.tab_purchases') }} <span class="ds-tab__count">{{ $purchasedCount }}</span>
            </button>
            <button type="button" role="tab" class="ds-tab" data-tab="redeemed" aria-selected="false">
                <i class="fas fa-book-reader"></i> {{ __('frontend.dashboard.tab_courses') }} <span class="ds-tab__count">{{ $redeemedCount }}</span>
            </button>
            <button type="button" role="tab" class="ds-tab" data-tab="password" aria-selected="false">
                <i class="fas fa-lock"></i> {{ __('frontend.dashboard.tab_password') }}
            </button>
        </div>

        {{-- ================= PURCHASES ================= --}}
        <div class="ds-panel active" data-panel="purchased" role="tabpanel">
            <div class="ds-card">
                <h2 class="ds-card__title">{{ __('frontend.dashboard.purchases_title') }}</h2>

                @if($purchasedCount > 0)
                    <ul class="ds-list">
                        @foreach($purchasedOrders as $order)
                            <li class="ds-row">
                                <span class="ds-row__cell ds-row__order" data-label="{{ __('frontend.dashboard.order') }}">
                                    <span class="ds-row__icon"><i class="fas fa-bolt"></i></span>
                                    {{ $order->order_number }}
                                </span>
                                <span class="ds-row__cell" data-label="{{ __('frontend.dashboard.amount_credits') }}">
                                    <span class="ds-pill"><i class="fas fa-bolt"></i> {{ number_format($order->cart_info->sum('points')) }}</span>
                                </span>
                                <span class="ds-row__cell ds-row__strong" data-label="{{ __('frontend.dashboard.price') }}">
                                    {!! $order->currency=='JPY' ? '&yen;' : Helper::getCurrencySymbol($order->currency) !!}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}
                                </span>
                                <span class="ds-row__cell" data-label="{{ __('frontend.dashboard.status') }}">
                                    @if($order->payment_status === 'Completed')
                                        <span class="ds-status ds-status--ok">{{ $statusLabel('Completed') }}</span>
                                    @elseif($order->payment_status === 'Failed')
                                        <span class="ds-status ds-status--err">{{ $statusLabel('Failed') }}</span>
                                    @else
                                        <span class="ds-status ds-status--wait">{{ $statusLabel('Pending') }}</span>
                                    @endif
                                </span>
                                <span class="ds-row__cell ds-row__muted" data-label="{{ __('frontend.dashboard.date') }}">{{ $fmtDate($order->created_at, __('frontend.dashboard.date_format')) }}</span>
                                <span class="ds-row__cell ds-row__action">
                                    <a href="{{ route('user.order.show', $order->id) }}" class="ds-btn ds-btn--inverse ds-btn--sm">
                                        <i class="fas fa-eye"></i> {{ __('frontend.dashboard.view') }}
                                    </a>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="ds-empty">
                        <span class="ds-empty__icon"><i class="fas fa-box-open"></i></span>
                        <p>{{ __('frontend.dashboard.purchases_empty') }}</p>
                        <a href="{{ route('points.topup') }}" class="ds-btn ds-btn--primary"><i class="fas fa-bolt"></i> {{ __('frontend.dashboard.buy') }}</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- ================= ENROLLED COURSES ================= --}}

```

### 6.8 CSS

All styles for these pages live in `public/css/theme.css`:

| Section | Lines | Covers |
|---|---|---|
| 18. Cart pages | from line 3782 | `.bag*` classes used by `cart.blade.php` and `coursecart.blade.php` |
| 20. Credit top-up | from line 4695 | `.tu*` classes used by `topup.blade.php` |

Copy both sections into the target theme stylesheet. Product-detail classes (`.pd-*`),
header classes (`.ak-*`) and dashboard classes (`.ds-*`) are in the same file.

---

## 7. Language files

Add these groups to `resources/lang/en/frontend.php` (and the `ja` twin).

### 7.1 `frontend.topup`

```php
    'topup' => [
        'meta'         => 'Buy credits to unlock course levels. Enter an amount to see the credits and the multiplier you would receive, then add them to your cart.',
        'title'        => 'Buy Credits',
        'intro'        => 'Credits are what unlock course levels. Enter the amount you want to spend and the calculator shows the credits it comes to before anything reaches your cart. Larger single purchases are matched to a higher multiplier.',
        'rate_usd'     => '1 credit = $1',
        'rate_jpy'     => '1 credit = ¥160',
        'rate_hkd'     => '1 credit = HK$8',
        'note_title'   => 'Worth knowing:',
        'note_text'    => 'Credits are spent on this website to unlock course levels, and have no use anywhere else.',
        'tiers_title'  => 'Multipliers by purchase amount',
        'tiers_cols'   => 'Tier · Multiplier · Purchase amount',
        'tier1'        => 'Standard',
        'tier2'        => 'Premium',
        'tier3'        => 'Elite',
        'tier4'        => 'VIP',
        'best'         => 'Highest multiplier',
        'current'      => 'Matches your amount',
        'calc_title'   => 'Work out your credits',
        'calc_desc'    => 'Enter an amount to see the credits it comes to, before you add anything to your cart.',
        'amount'       => 'Amount to spend',
        'amount_ph'    => 'Enter an amount to spend',
        'quick'        => 'Common amounts',
        'base'         => 'Base credits',
        'multiplier'   => 'Multiplier',
        'total'        => 'Credits you will receive',
        'submit'       => 'Add Credits to Cart',
        'loading'      => 'Adding to cart…',
        'amount_req'   => 'Please enter an amount of at least 1.',
        'secure'       => 'Payment is handled by our payment provider over an encrypted connection.',
        'how_title'    => 'How buying credits works',
        'step1_title'  => 'Choose an amount',
        'step1_desc'   => 'Type an amount, or pick one of the common amounts. The multiplier and the credit total update as you type.',
        'step2_title'  => 'Pay at checkout',
        'step2_desc'   => 'Complete the checkout. Your credits appear in your account once the payment is confirmed.',
        'step3_title'  => 'Unlock a level',
        'step3_desc'   => 'Spend your credits on the levels you want, then open them from your account and start learning.',
    ],
```

### 7.2 `frontend.coursecart`

```php
    'coursecart' => [
        'step_cart'    => 'Cart',
        'step_unlock'  => 'Unlock',
        'step_learn'   => 'Start learning',
        'title'        => 'Course Cart',
        'balance'      => 'Your credit balance',
        'credits'      => 'credits',
        'buy'          => 'Buy Credits',
        'items_title'  => 'Course levels in your cart',
        'items'        => ':count item|:count items',
        'package'      => 'Credit Package',
        'price'        => 'Credits',
        'amount'       => 'Amount',
        'remove'       => 'Remove',
        'total'        => 'Credits needed',
        'coverage'     => 'Balance used',
        'after'        => 'Balance after unlocking',
        'low'          => 'You do not have enough credits to unlock these levels. Buy more credits and then come back to finish.',
        'unlock'       => 'Unlock with Credits',
        'browse'       => 'Browse More Courses',
        'empty_title'  => 'Your course cart is empty',
        'empty_desc'   => 'Open any course, choose a skill level and add it to your cart. You can then unlock it here using your credits.',
        'empty_btn'    => 'Browse Courses',
        'auth_title'   => 'Please log in to see your course cart',
        'auth_desc'    => 'Your course cart and credit balance are linked to your account. Log in, or create a free account, to add levels and unlock them with credits.',
        'login'        => 'Log In',
        'register'     => 'Create Account',
        'levels' => [
            'beginner'     => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced'     => 'Advanced',
            'expert'       => 'Expert',
        ],
    ],
```

### 7.3 `frontend.cart`

```php
    'cart' => [
        'step_cart'   => 'Cart',
        'step_pay'    => 'Payment',
        'step_done'   => 'Credits added',
        'title'       => 'Cart',
        'items_title' => 'Your cart',
        'items'       => ':count item|:count items',
        'package'     => 'Credit Package',
        'tag_course'  => 'Course',
        'tag_credits' => 'Credits',
        'credits'     => 'Credits',
        'amount'      => 'Amount',
        'remove'      => 'Remove',
        'discount'    => 'Discount',
        'total'       => 'Total',
        'checkout'    => 'Proceed to Checkout',
        'browse'      => 'Browse Courses',
        'secure'      => 'Payments are processed by our payment provider over a secure, encrypted connection.',
        'payments'    => 'Accepted payment methods',
        'empty_title' => 'Your cart is empty',
        'empty_desc'  => 'Buy credits to unlock course levels, or browse the courses first to decide where you would like to start.',
        'empty_courses' => 'Browse Courses',
        'empty_credits' => 'Buy Credits',
    ],
```

### 7.4 `frontend.course`

```php
    'course' => [
        'courses'      => 'Courses',
        'levels'       => ':count skill level|:count skill levels',
        'category'     => 'Course',
        'image'        => 'Show image',
        'credits'      => 'credits',
        'about'        => 'About this course',
        'about_level'  => 'What this level covers',
        'choose'       => 'Choose your skill level',
        'learn'        => 'What you will learn',
        'purpose'      => 'Purpose of this level',
        'outcome'      => 'Expected outcome',
        'level'        => 'Selected level',
        'add'          => 'Add Level to Cart',
        'loading'      => 'Adding to cart…',
        'category_label' => 'Category:',
        'unlock'       => 'Each level is unlocked separately with credits',
        'note'         => 'Levels are unlocked with credits from your account balance. You can buy more credits whenever you need them.',
        'no_levels'    => 'Levels coming soon',
        'names' => [
            'beginner'     => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced'     => 'Advanced',
            'expert'       => 'Expert',
        ],
    ],
```

### 7.5 `frontend.dashboard`

```php
    'dashboard' => [
        'title'         => 'Dashboard',
        'account'       => 'My Account',
        'welcome'       => 'Welcome back',
        'logout'        => 'Logout',
        'credits'       => 'Available credits',
        'buy'           => 'Buy Credits',
        'unlocked'      => 'Course levels unlocked',
        'browse'        => 'Browse Courses',
        'purchases'     => 'Credit purchases',
        'member'        => 'Member since',
        'tabs'          => 'Account sections',
        'tab_purchases' => 'Credit Purchases',
        'tab_courses'   => 'My Courses',
        'tab_password'  => 'Change Password',
        'purchases_title' => 'Your credit purchase history',
        'order'         => 'Order number',
        'amount_credits' => 'Credits',
        'price'         => 'Amount paid',
        'status'        => 'Payment status',
        'date'          => 'Date',
        'view'          => 'View Receipt',
        'purchases_empty' => 'You have not bought any credits yet. Buy credits to start unlocking course levels.',
        'courses_title' => 'Course levels you have unlocked',
        'badge'         => 'Unlocked',
        'no_level'      => 'Level not found',
        'no_course'     => 'Course no longer available',
        'view_course'   => 'View Course',
        'courses_empty' => 'You have not unlocked any course levels yet. Choose a course, add a level to your cart and unlock it with your credits.',
        'password_title' => 'Change your password',
        'current'       => 'Current password',
        'current_ph'    => 'Enter your current password',
        'new'           => 'New password',
        'new_ph'        => 'Enter a new password',
        'confirm'       => 'Confirm new password',
        'confirm_ph'    => 'Re-enter your new password',
        'show'          => 'Show password',
        'hide'          => 'Hide password',
        'save'          => 'Update Password',
        'tip_title'     => 'Tips for a strong password',
        'tip1'          => 'Use at least 8 characters',
        'tip2'          => 'Combine upper and lower case letters, numbers and symbols',
        'tip3'          => 'Avoid reusing a password you use on other websites',
        'date_format'   => 'd M Y',
        'member_format' => 'M Y',
        'statuses' => [
            'completed'      => 'Completed',
            'pending'        => 'Pending',
            'failed'         => 'Failed',
            'payment failed' => 'Payment failed',
            'new'            => 'New',
            'process'        => 'Processing',
            'delivered'      => 'Delivered',
            'cancel'         => 'Cancelled',
        ],
        'levels' => [
            'beginner'     => 'Beginner',
            'intermediate' => 'Intermediate',
            'advanced'     => 'Advanced',
            'expert'       => 'Expert',
        ],
    ],
```

### 7.6 `frontend.header` keys used by the balance pill and cart drawer

```php
        'balance'       => 'Your credit balance. Select to buy more credits.',
        'buy_credits'   => 'Buy Credits',
        'credits'       => 'credits',
        'cart'          => 'Your Cart',
        'cart_open'     => 'Open cart',
        'cart_close'    => 'Close cart',
        'cart_remove'   => 'Remove this item from your cart',
        'cart_credits'  => 'Credit Package',
        'cart_empty'    => 'Your cart is empty. Browse our courses or buy credits to get started.',
        'balance_label' => 'Your credit balance',
        'credits'        => 'credits',
        'credits'     => 'credits',
'levels' => ['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced', 'expert' => 'Expert'],
```

### 7.7 `resources/lang/en/common.php` keys

```php
  'product_added_to_cart' => 'Course successfully added to cart.',
  'stock_not_sufficient' => 'Stock not sufficient!',
  'cart_removed_successfully' => 'Credits removed from cart successfully.',
  'insufficient_points' => 'You don\'t have enough credits. Please top up your credits to complete this purchase.',
  'invalid_products' => 'Invalid Products',
  'out_of_stock' => 'Out of stock, You can add other products.',
  'product_already_in_cart' => 'This product is already in your cart.',
  'cannot_add_products_with_points' => 'You cannot add courses to a cart containing credits. Please checkout or clear your cart first.',
  'cannot_add_points_with_courses' => 'You cannot add credits to a cart containing courses. Please checkout or clear your cart first.',
  'points_added_to_cart' => 'Credits added to cart successfully.',
  'login_to_redeem_points' => 'Please log in to redeem your credits.',
  'cart_no_course_enrollments' => 'Your cart does not contain any courses.',
  'enrollment_successful' => 'Congratulations! You have successfully enrolled using your credits. Check your dashboard to access your courses.',
  'enrollment_error' => 'An error occurred during enrollment: :error',
  'cart_empty' => 'Cart is Empty!',
  'points' => 'Credits',
```

---

## 8. Data setup (no admin UI exists for these)

### 8.1 Reserved product id

Make sure no real product ever gets `id >= 1000`. If the target `products` table already
has ids that high, raise the threshold consistently in every place listed below.

Places that hard-code `1000`:

| File | Use |
|---|---|
| `app/Http/Controllers/PointsController.php` | `product_id = 1000` on credit rows; `< 1000` mixing check |
| `app/Http/Controllers/CartController.php` | `>= 1000` mixing check (twice) |
| `app/Http/Middleware/PointGatingMiddleware.php` | `< 1000` course check |
| `app/Http/Controllers/DasGatewayController.php` | `>= 1000` points to credit |
| `app/Http/Controllers/HomeController.php` | `== 1000` / `< 1000` dashboard split |
| `app/Http/Helpers.php` | `< 1000` in `totalCartPoints()` |
| `resources/views/frontend/pages/coursecart.blade.php` | `< 1000` |
| `resources/views/frontend/layouts/header.blade.php` | `>= 1000` / `< 1000` |

### 8.2 Insert levels for a course

```sql
INSERT INTO product_levels
  (course_id, skill_level, skill_level_jp, purpose, purpose_jp, learn_info, learn_info_jp,
   outcome, outcome_jp, price, price_jp, price_hk, price_in_points, created_at, updated_at)
VALUES
  (1, 'Beginner',     '初級', 'Purpose…', '目的…', 'You will learn…', '学ぶ内容…', 'Outcome…', '成果…',  50,  8000,  400,  50, NOW(), NOW()),
  (1, 'Intermediate', '中級', 'Purpose…', '目的…', 'You will learn…', '学ぶ内容…', 'Outcome…', '成果…', 100, 16000,  800, 100, NOW(), NOW()),
  (1, 'Advanced',     '上級', 'Purpose…', '目的…', 'You will learn…', '学ぶ内容…', 'Outcome…', '成果…', 150, 24000, 1200, 150, NOW(), NOW());
```

`skill_level` values must be `Beginner`, `Intermediate`, `Advanced` or `Expert` so the
translation keys `frontend.course.names.*`, `frontend.coursecart.levels.*`,
`frontend.header.levels.*` and `frontend.dashboard.levels.*` resolve.

### 8.3 Exchange rates and tiers

Fixed inside `PointsController::addToCart` and repeated in the top-up page JavaScript:

| Currency | Rate to USD | Tier thresholds (local) |
|---|---|---|
| USD | 1 | 500 / 1000 / 1500 |
| JPY | 160 | 80,000 / 160,000 / 240,000 |
| HKD | 8 | 4,000 / 8,000 / 12,000 |

Multipliers: x1, x1.5, x2, x2.5. Change them in both places together.

### 8.4 `.env` keys used by the payment flow

```
PAYMENT_URL=
PAYMENT_STATUS_URL=
SECRET_KEY=
X_API_KEY=
DASMID=
WEBSITE_URL=
```

---

## 9. Implementation order

1. Run the migrations in section 2 (existing five, then the three new ones).
2. Add `ProductLevel` model, `PointsController`, `PointGatingMiddleware`; register the
   alias in `Kernel.php`.
3. Update `Product`, `Cart`, `Order` models and `Helper::totalCartPoints()`.
4. Replace `CartController`, add the `store` method changes in `OrderController`, and add
   the crediting block to the payment success handler.
5. Update `HomeController::index`.
6. Add routes from section 5.
7. Add the views: `topup`, `coursecart`, `cart`; patch `product_detail`, `header`,
   `checkout`, `dashboard`; copy CSS sections 18 and 20.
8. Add the language groups from section 7.
9. Insert `product_levels` rows for each course (section 8.2).
10. Test: buy credits with a sandbox card and confirm `points_balance` increases exactly
    once even if the success URL is hit twice; add a level to the course cart and redeem;
    confirm the mixing rules block both directions.
