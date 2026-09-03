@extends('frontend.layouts.main')
@section('title', __('inkwave.db_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.db_my_account'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.db_my_account')]
    ]
])

<style>
/* ==========================================================================
   Art Courses — User Dashboard (Premium Theme)
   ========================================================================== */
.ag-dash-wrap, .ag-dash-wrap *, .ag-dash-wrap *::before, .ag-dash-wrap *::after {
    box-sizing: border-box;
}
.ag-dash-wrap {
   
    padding: 40px 40px;
    min-height: 80vh;
}
.ag-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 5%;
}

.ag-dash-grid {
    display: grid;
    grid-template-columns: 320px 1fr; /* Reduced sidebar width to give main content more room */
    gap: 48px;
    align-items: start;
}
@media (max-width: 1024px) {
    .ag-dash-grid { grid-template-columns: 1fr; }
}

/* ==========================================================================
   SIDEBAR
   ========================================================================== */
.ag-dash-sidebar {
    background-color: #ffffff;
    padding: 40px 32px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    border-top: 6px solid #000000;
}

.ag-dash-profile {
    text-align: center;
    margin-bottom: 32px;
}
.ag-dash-avatar {
    width: 80px;
    height: 80px;
    background: #000000;
    color: #ffffff;
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 16px auto;
}
.ag-dash-name {
    display: block;
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 20px;
    color: #000000;
    margin-bottom: 4px;
}
.ag-dash-email {
    display: block;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    color: #888888;
}

.ag-dash-stats {
    background: #faf8f5; /* Bone tint */
    border: 1px solid #e5dccb;
    border-top: 4px solid #bc9c5c;
    padding: 20px;
    margin-bottom: 32px;
}
.ag-dash-stat {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    margin-bottom: 12px;
    border-bottom: 1px dashed rgba(0,0,0,0.1);
    padding-bottom: 8px;
}
.ag-dash-stat:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
.ag-dash-stat span:first-child { color: #888888; text-transform: uppercase; letter-spacing: 0.1em; font-size: 11px; }
.ag-dash-stat span:last-child { color: #000000; font-weight: bold; font-size: 14px; }
.ag-dash-stat i { color: #bc9c5c; margin-right: 4px; }

.ag-dash-nav {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.ag-dash-navbtn {
    background: transparent;
    border: 1px solid rgba(0,0,0,0.1);
    padding: 14px 20px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    font-weight: bold;
    color: #555555;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: left;
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
}
.ag-dash-navbtn i { font-size: 14px; color: #888888; transition: color 0.3s; }
.ag-dash-navbtn:hover { background: #faf8f5; color: #000000; border-color: #000000; }
.ag-dash-navbtn.active { background: #000000; color: #ffffff; border-color: #000000; }
.ag-dash-navbtn.active i { color: #bc9c5c; }

/* Logout Specific */
.ag-dash-navbtn--logout { margin-top: 16px; border-color: #d93025; color: #d93025; }
.ag-dash-navbtn--logout i { color: #d93025; }
.ag-dash-navbtn--logout:hover { background: #d93025; color: #ffffff; border-color: #d93025; }
.ag-dash-navbtn--logout:hover i { color: #ffffff; }


/* ==========================================================================
   MAIN CONTENT
   ========================================================================== */
.ag-dash-main {
    min-width: 0; /* CRITICAL FIX: Allows the 1fr column to shrink without breaking the grid */
}
.ag-dash-panel {
    display: none;
}
.ag-dash-panel.active {
    display: block;
    animation: fadeIn 0.4s ease forwards;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.ag-dash-card {
    background-color: #ffffff;
    padding: 40px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.05);
}
.ag-dash-h {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 28px;
    color: #000000;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding-bottom: 16px;
}
.ag-dash-h i { color: #bc9c5c; font-size: 20px; }

/* Tables */
.ag-dash-tablewrap { 
    overflow-x: auto; 
    width: 100%;
}
.ag-dash-table {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--font-arial, Arial, sans-serif);
}
.ag-dash-table th, .ag-dash-table td {
    padding: 16px 20px; /* Reduced padding */
    border: none;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    text-align: left;
    white-space: nowrap; /* Ensures words do not break into 2 lines */
}
.ag-dash-table th {
    background: #f5f5f5; /* Bone */
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 13px; /* Reduced font */
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #000000;
}
.ag-dash-table td { font-size: 14px; color: #333333; vertical-align: middle; }
.ag-dash-table .is-strong { font-weight: bold; color: #000000; font-size: 14px; }

/* Status Tags */
.ag-dash-tag {
    display: inline-block;
    padding: 6px 12px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    background: #eeeeee;
    color: #555555;
    font-weight: bold;
}
.ag-dash-tag--ok { background: #e8f5e9; color: #2e7d32; }
.ag-dash-tag--err { background: #fce8e6; color: #d93025; }
.ag-dash-tag--muted { background: transparent; border: 1px solid #dddddd; }

/* Points Pill */
.ag-dash-pill {
    display: inline-block;
    background: #000000;
    color: #ffffff;
    padding: 6px 12px;
    font-size: 12px;
    font-weight: bold;
}
.ag-dash-pill i { color: #bc9c5c; margin-right: 4px; }

.ag-dash-view {
    color: #bc9c5c;
    font-size: 16px;
    transition: color 0.3s ease;
}
.ag-dash-view:hover { color: #000000; }

/* Empty State */
.ag-dash-empty {
    text-align: center;
    padding: 64px 24px;
    color: #888888;
    font-family: var(--font-arial, Arial, sans-serif);
}
.ag-dash-empty i { font-size: 48px; color: #dddddd; margin-bottom: 16px; display: block; }
.ag-dash-empty p { font-size: 16px; }

/* Forms */
.ag-dash-field { margin-bottom: 32px; }
.ag-dash-label {
    display: block;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #888888;
    margin-bottom: 12px;
    font-weight: bold;
}
.ag-dash-input {
    width: 100%;
    border: 1px solid rgba(0,0,0,0.1);
    background: #f9f9f9;
    padding: 16px 20px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px;
    color: #000000;
    transition: border-color 0.3s;
    outline: none;
}
.ag-dash-input:focus { border-color: #000000; background: #ffffff; }
.ag-dash-error {
    display: block;
    color: #d93025;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    margin-top: 8px;
}
.ag-dash-error i { margin-right: 4px; }

button[type="submit"].ag-dash-submit {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #000000 !important;
    color: #ffffff !important;
    border: 1px solid #000000 !important;
    padding: 20px 40px !important;
    font-family: var(--font-arial, Arial, sans-serif) !important;
    font-size: 14px !important;
    font-weight: bold !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
}
button[type="submit"].ag-dash-submit:hover {
    background: #ffffff !important;
    color: #000000 !important;
}
</style>


<div class="ag-dash-wrap">
    @php $u = Auth::user(); @endphp
    <div class="ag-container">

        <div class="ag-dash-grid">
            
            {{-- ================= SIDEBAR ================= --}}
            <aside class="ag-dash-sidebar">
                <div class="ag-dash-profile">
                    <div class="ag-dash-avatar">{{ strtoupper(substr($u->name ?? 'U', 0, 1)) }}</div>
                    <span class="ag-dash-name">{{ $u->name }}</span>
                    <span class="ag-dash-email">{{ $u->email }}</span>
                </div>

                <div class="ag-dash-stats">
                    <div class="ag-dash-stat">
                        <span>{{ __('inkwave.db_available_points') }}</span>
                        <span><i class="fas fa-coins"></i> {{ number_format($u->points_balance ?? 0) }}</span>
                    </div>
                    <div class="ag-dash-stat">
                        <span>{{ __('inkwave.db_courses_enrolled') }}</span>
                        <span>{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</span>
                    </div>
                    <div class="ag-dash-stat">
                        <span>{{ __('inkwave.db_member_since') }}</span>
                        <span>{{ $u->created_at->format('M Y') }}</span>
                    </div>
                </div>

                <nav class="ag-dash-nav">
                    <button type="button" class="ag-dash-navbtn active" data-tab="purchased"><i class="fas fa-gift"></i> {{ __('inkwave.db_points_purchased') }}</button>
                    <button type="button" class="ag-dash-navbtn" data-tab="redeemed"><i class="fas fa-book-reader"></i> {{ __('inkwave.db_points_redeemed') }}</button>
                    <button type="button" class="ag-dash-navbtn" data-tab="password"><i class="fas fa-lock"></i> {{ __('inkwave.db_change_password') }}</button>
                    <a href="{{ route('user.logout') }}" class="ag-dash-navbtn ag-dash-navbtn--logout"><i class="fas fa-sign-out-alt"></i> {{ __('inkwave.db_logout') }}</a>
                </nav>
            </aside>

            {{-- ================= CONTENT ================= --}}
            <div class="ag-dash-main">

                {{-- Purchases --}}
                <div class="ag-dash-panel active" data-panel="purchased">
                    <div class="ag-dash-card">
                        <h2 class="ag-dash-h"><i class="fas fa-gift"></i> {{ __('inkwave.db_points_purchased_wallet') }}</h2>
                        @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                            <div class="ag-dash-tablewrap">
                                <table class="ag-dash-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('inkwave.db_order_number') }}</th>
                                            <th>{{ __('inkwave.db_points_bought') }}</th>
                                            <th>{{ __('inkwave.db_price_paid') }}</th>
                                            <th>{{ __('inkwave.db_payment_status') }}</th>
                                            <th>{{ __('inkwave.db_date') }}</th>
                                            <th>{{ __('inkwave.db_action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($purchasedOrders as $order)
                                            <tr>
                                                <td class="is-strong">{{ $order->order_number }}</td>
                                                <td><span class="ag-dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                                <td class="is-strong">{!! $order->currency=='JPY' ? '&yen;' : Helper::getCurrencySymbol($order->currency) !!}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</td>
                                                <td>
                                                    @if($order->payment_status === 'Completed')
                                                        <span class="ag-dash-tag ag-dash-tag--ok">{{ __('inkwave.db_paid') }}</span>
                                                    @elseif($order->payment_status === 'Failed')
                                                        <span class="ag-dash-tag ag-dash-tag--err">{{ __('inkwave.db_failed') }}</span>
                                                    @else
                                                        <span class="ag-dash-tag">{{ __('inkwave.db_pending') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td><a href="{{ route('user.order.show', $order->id) }}" class="ag-dash-view"><i class="fas fa-eye"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="ag-dash-empty">
                                <i class="fas fa-box-open"></i>
                                <p>{{ __('inkwave.db_no_past_orders') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Redeemed --}}
                <div class="ag-dash-panel" data-panel="redeemed">
                    <div class="ag-dash-card">
                        <h2 class="ag-dash-h"><i class="fas fa-book-reader"></i> {{ __('inkwave.db_points_redeemed_courses') }}</h2>
                        @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                            <div class="ag-dash-tablewrap">
                                <table class="ag-dash-table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('inkwave.db_order_number') }}</th>
                                            <th>{{ __('inkwave.db_course_name') }}</th>
                                            <th>{{ __('inkwave.db_level') }}</th>
                                            <th>{{ __('inkwave.db_points_used') }}</th>
                                            <th>{{ __('inkwave.db_payment_status') }}</th>
                                            <th>{{ __('inkwave.db_date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($redeemedOrders as $order)
                                            @php
                                                $cartItem = $order->cart_info->first();
                                                $level = null;
                                                if($cartItem) {
                                                    $level = \App\Models\ProductLevel::where('course_id', $cartItem->product_id)
                                                                                     ->where('price_in_points', $cartItem->points)
                                                                                     ->first();
                                                }
                                            @endphp
                                            <tr>
                                                <td class="is-strong">{{ $order->order_number }}</td>
                                                <td class="is-strong">{{ $cartItem && $cartItem->product ? $cartItem->product->title : 'N/A' }}</td>
                                                <td>
                                                    @if($level)<span class="ag-dash-tag">{{ ucfirst($level->skill_level) }}</span>@else<span class="ag-dash-tag ag-dash-tag--muted">N/A</span>@endif
                                                </td>
                                                <td><span class="ag-dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                                <td>
                                                    @if(strtolower($order->status) === 'completed')
                                                        <span class="ag-dash-tag ag-dash-tag--ok">{{ __('inkwave.db_redeemed') }}</span>
                                                    @else
                                                        <span class="ag-dash-tag">{{ $order->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="ag-dash-empty">
                                <i class="fas fa-box-open"></i>
                                <p>{{ __('inkwave.db_no_past_orders') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Change password --}}
                <div class="ag-dash-panel" data-panel="password">
                    <div class="ag-dash-card">
                        <h2 class="ag-dash-h"><i class="fas fa-lock"></i> {{ __('inkwave.db_change_password') }}</h2>
                        <form action="{{ route('change.password') }}" method="POST">
                            @csrf
                            <div class="ag-dash-field">
                                <label class="ag-dash-label" for="current_password">{{ __('inkwave.db_current_password') }}</label>
                                <input type="password" id="current_password" name="current_password" placeholder="{{ __('inkwave.db_current_password_placeholder') }}" class="ag-dash-input @error('current_password') is-invalid @enderror">
                                @error('current_password')<span class="ag-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                            </div>
                            <div class="ag-dash-field">
                                <label class="ag-dash-label" for="new_password">{{ __('inkwave.db_new_password') }}</label>
                                <input type="password" id="new_password" name="new_password" placeholder="{{ __('inkwave.db_new_password_placeholder') }}" class="ag-dash-input @error('new_password') is-invalid @enderror">
                                @error('new_password')<span class="ag-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                            </div>
                            <div class="ag-dash-field">
                                <label class="ag-dash-label" for="new_confirm_password">{{ __('inkwave.db_confirm_password') }}</label>
                                <input type="password" id="new_confirm_password" name="new_confirm_password" placeholder="{{ __('inkwave.db_confirm_password_placeholder') }}" class="ag-dash-input @error('new_confirm_password') is-invalid @enderror">
                                @error('new_confirm_password')<span class="ag-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                            </div>
                            <button type="submit" class="ag-dash-submit"><i class="fas fa-check"></i> {{ __('inkwave.db_update_password') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var btns = document.querySelectorAll('.ag-dash-navbtn[data-tab]');
        var panels = document.querySelectorAll('.ag-dash-panel');
        btns.forEach(function (b) {
            b.addEventListener('click', function () {
                var t = this.getAttribute('data-tab');
                btns.forEach(function (x) { x.classList.remove('active'); });
                panels.forEach(function (p) { p.classList.remove('active'); });
                this.classList.add('active');
                var panel = document.querySelector('.ag-dash-panel[data-panel="' + t + '"]');
                if (panel) panel.classList.add('active');
            });
        });
        // If there are validation errors on the password form, open that tab
        @if($errors->any())
            var passTab = document.querySelector('.ag-dash-navbtn[data-tab="password"]');
            if (passTab) passTab.click();
        @endif
    })();
</script>
@endpush
