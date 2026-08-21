@extends('frontend.layouts.main')
@section('title', __('inkwave.dash_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.dash_my_account'),
    'links' => [
        ['name' => __('inkwave.menu_home'), 'url' => route('home')],
        ['name' => __('inkwave.dash_my_account')]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme Dashboard - Artora
------------------------------------------- */
.duo-dash-wrap {
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    background: #ffffff;
    padding-bottom: 100px;
}
.duo-dash-wrap a { text-decoration: none !important; }

.duo-dash-container {
    max-width: 1200px;
    margin: 48px auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 48px;
    align-items: start;
}
@media (max-width: 900px) {
    .duo-dash-container { grid-template-columns: 1fr; }
}

/* Sidebar */
.duo-dash-side {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.duo-dash-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 8px 0 #e5e5e5;
}

.duo-dash-profile {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 24px;
}
.duo-dash-avatar {
    width: 80px;
    height: 80px;
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff;
    font-size: 32px;
    font-weight: 800;
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    box-shadow: 0 4px 0 #1899d6;
}
.duo-dash-name {
    font-size: 20px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
}
.duo-dash-email {
    font-size: 15px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
}

.duo-dash-stats {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 2px dashed #e5e5e5;
}
.duo-dash-stat {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.duo-dash-stat span:first-child {
    font-size: 15px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
}
.duo-dash-stat span:last-child {
    font-size: 18px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
}

.duo-dash-nav {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.duo-dash-navbtn {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    padding: 16px 20px;
    font-size: 16px;
    font-weight: 800;
    color: var(--color-pencil-gray, #777777);
    text-align: left;
    cursor: pointer;
    transition: all 0.1s;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 4px 0 transparent;
}
.duo-dash-navbtn:hover {
    background: #f7f7f7;
    transform: translateY(-2px);
    box-shadow: 0 4px 0 #e5e5e5;
}
.duo-dash-navbtn:active {
    transform: translateY(2px);
    box-shadow: 0 0 0 transparent;
}
.duo-dash-navbtn.active {
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff;
    border-color: #1899d6;
    box-shadow: 0 4px 0 #1899d6;
    transform: none;
}
.duo-dash-navbtn.active:active {
    transform: translateY(4px);
    box-shadow: 0 0 0 transparent;
}
.duo-dash-navbtn--logout {
    margin-top: 16px;
    color: var(--color-cardinal, #ff4b4b) !important;
}
.duo-dash-navbtn--logout:hover {
    background: #fff0f0;
    border-color: var(--color-cardinal, #ff4b4b);
    box-shadow: 0 4px 0 var(--color-cardinal, #ff4b4b);
}

/* Main Content */
.duo-dash-panel {
    display: none;
}
.duo-dash-panel.active {
    display: block;
    animation: slideIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
@keyframes slideIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.duo-dash-h {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 12px;
}

/* Table */
.duo-dash-tablewrap {
    overflow-x: auto;
}
.duo-dash-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 16px;
}
.duo-dash-table th {
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--color-pencil-gray, #777777);
    padding: 0 16px;
    text-align: left;
    white-space: nowrap;
}
.duo-dash-table td {
    background: #f7f7f7;
    padding: 20px 16px;
    font-size: 16px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    border-top: 2px solid #e5e5e5;
    border-bottom: 2px solid #e5e5e5;
    white-space: nowrap;
}
.duo-dash-table td.is-strong {
    font-weight: 800;
}
.duo-dash-table td:first-child {
    border-left: 2px solid #e5e5e5;
    border-top-left-radius: 16px;
    border-bottom-left-radius: 16px;
}
.duo-dash-table td:last-child {
    border-right: 2px solid #e5e5e5;
    border-top-right-radius: 16px;
    border-bottom-right-radius: 16px;
}

.duo-dash-tag {
    display: inline-block;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 12px;
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 800;
    color: var(--color-pencil-gray, #777777);
}
.duo-dash-tag--ok {
    border-color: var(--color-eager-green, #58cc02);
    color: var(--color-eager-green, #58cc02);
}
.duo-dash-tag--err {
    border-color: var(--color-cardinal, #ff4b4b);
    color: var(--color-cardinal, #ff4b4b);
}
.duo-dash-tag--muted {
    opacity: 0.5;
}

.duo-dash-pill {
    background: var(--color-macaw-yellow, #ffc800);
    color: #ffffff;
    font-weight: 800;
    padding: 6px 12px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: inset 0 -2px 0 rgba(0,0,0,0.1);
}

.duo-dash-view {
    color: var(--color-spark-blue, #1cb0f6) !important;
    font-weight: 800;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    padding: 8px 16px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.1s;
}
.duo-dash-view:hover {
    border-color: var(--color-spark-blue, #1cb0f6);
    background: #eaf7ff;
}

/* Empty State */
.duo-dash-empty {
    text-align: center;
    padding: 64px 24px;
    color: var(--color-pencil-gray, #777777);
}
.duo-dash-empty i {
    font-size: 80px;
    color: #e5e5e5;
    margin-bottom: 24px;
}
.duo-dash-empty p {
    font-size: 20px;
    font-weight: 800;
}

/* Form */
.duo-dash-field {
    margin-bottom: 24px;
}
.duo-dash-label {
    display: block;
    font-size: 16px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 12px;
}
.duo-dash-input {
    width: 100%;
    background: #f7f7f7;
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    padding: 16px 20px;
    font-size: 16px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    outline: none;
    box-shadow: inset 0 4px 0 rgba(0,0,0,0.02);
}
.duo-dash-input:focus {
    border-color: var(--color-spark-blue, #1cb0f6);
    background: #ffffff;
}
.duo-dash-error {
    color: var(--color-cardinal, #ff4b4b);
    font-size: 14px;
    font-weight: 700;
    margin-top: 8px;
    display: block;
}
.duo-dash-submit {
    background: var(--color-eager-green, #58cc02);
    color: #ffffff;
    border: 2px solid #46a302;
    border-radius: 16px;
    padding: 16px 32px;
    font-size: 17px;
    font-weight: 800;
    text-transform: uppercase;
    box-shadow: 0 6px 0 #46a302;
    cursor: pointer;
    transition: all 0.1s;
    display: inline-flex;
    align-items: center;
    gap: 12px;
}
.duo-dash-submit:hover { filter: brightness(1.05); }
.duo-dash-submit:active { transform: translateY(6px); box-shadow: 0 0 0 transparent; }
</style>

<div class="duo-dash-wrap">
    @php $u = Auth::user(); @endphp
    <div class="duo-dash-container">

        {{-- ================= SIDEBAR ================= --}}
        <aside class="duo-dash-side">
            <div class="duo-dash-card">
                <div class="duo-dash-profile">
                    <span class="duo-dash-avatar">{{ strtoupper(substr($u->name ?? 'U', 0, 1)) }}</span>
                    <span class="duo-dash-name">{{ $u->name }}</span>
                    <span class="duo-dash-email">{{ $u->email }}</span>
                </div>

                <div class="duo-dash-stats">
                    <div class="duo-dash-stat">
                        <span>{{ __('inkwave.dash_available_points') }}</span>
                        <span><i class="fas fa-coins" style="color:var(--color-macaw-yellow);"></i> {{ number_format($u->points_balance ?? 0) }}</span>
                    </div>
                    <div class="duo-dash-stat">
                        <span>{{ __('inkwave.dash_artworks_enrolled') }}</span>
                        <span>{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</span>
                    </div>
                    <div class="duo-dash-stat">
                        <span>{{ __('inkwave.dash_member_since') }}</span>
                        <span>{{ $u->created_at->format('M Y') }}</span>
                    </div>
                </div>

                <nav class="duo-dash-nav">
                    <button type="button" class="duo-dash-navbtn active" data-tab="purchased"><i class="fas fa-gift"></i> {{ __('inkwave.dash_points_purchased') }}</button>
                    <button type="button" class="duo-dash-navbtn" data-tab="redeemed"><i class="fas fa-palette"></i> {{ __('inkwave.dash_points_redeemed') }}</button>
                    <button type="button" class="duo-dash-navbtn" data-tab="password"><i class="fas fa-lock"></i> {{ __('inkwave.dash_change_password') }}</button>
                    <a href="{{ route('user.logout') }}" class="duo-dash-navbtn duo-dash-navbtn--logout"><i class="fas fa-sign-out-alt"></i> {{ __('inkwave.dash_logout') }}</a>
                </nav>
            </div>
        </aside>

        {{-- ================= CONTENT ================= --}}
        <div class="duo-dash-main">

            {{-- Purchases --}}
            <div class="duo-dash-panel active" data-panel="purchased">
                <div class="duo-dash-card">
                    <h2 class="duo-dash-h"><i class="fas fa-gift"></i> {{ __('inkwave.dash_points_purchased_wallet') }}</h2>
                    @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                        <div class="duo-dash-tablewrap">
                            <table class="duo-dash-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('inkwave.dash_order_number') }}</th>
                                        <th>{{ __('inkwave.dash_points_bought') }}</th>
                                        <th>{{ __('inkwave.dash_price_paid') }}</th>
                                        <th>{{ __('inkwave.dash_payment_status') }}</th>
                                        <th>{{ __('inkwave.dash_date') }}</th>
                                        <th>{{ __('inkwave.dash_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchasedOrders as $order)
                                        <tr>
                                            <td class="is-strong">{{ $order->order_number }}</td>
                                            <td><span class="duo-dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                            <td class="is-strong">{{ Helper::getCurrencySymbol($order->currency) }}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</td>
                                            <td>
                                                @if($order->payment_status === 'Completed')
                                                    <span class="duo-dash-tag duo-dash-tag--ok">{{ __('inkwave.dash_paid') }}</span>
                                                @elseif($order->payment_status === 'Failed')
                                                    <span class="duo-dash-tag duo-dash-tag--err">{{ __('inkwave.dash_failed') }}</span>
                                                @else
                                                    <span class="duo-dash-tag">{{ __('inkwave.dash_pending') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td><a href="{{ route('user.order.show', $order->id) }}" class="duo-dash-view"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="duo-dash-empty">
                            <i class="fas fa-box-open"></i>
                            <p>{{ __('inkwave.dash_no_past_orders') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Redeemed --}}
            <div class="duo-dash-panel" data-panel="redeemed">
                <div class="duo-dash-card">
                    <h2 class="duo-dash-h"><i class="fas fa-palette"></i> {{ __('inkwave.dash_points_redeemed_courses') }}</h2>
                    @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                        <div class="duo-dash-tablewrap">
                            <table class="duo-dash-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('inkwave.dash_order_number') }}</th>
                                        <th>{{ __('inkwave.dash_artwork_name') }}</th>
                                        <th>{{ __('inkwave.dash_level') }}</th>
                                        <th>{{ __('inkwave.dash_points_used') }}</th>
                                        <th>{{ __('inkwave.dash_payment_status') }}</th>
                                        <th>{{ __('inkwave.dash_date') }}</th>
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
                                                @if($level)<span class="duo-dash-tag">{{ ucfirst($level->skill_level) }}</span>@else<span class="duo-dash-tag duo-dash-tag--muted">N/A</span>@endif
                                            </td>
                                            <td><span class="duo-dash-pill"><i class="fas fa-coins"></i> {{ number_format($order->cart_info->sum('points')) }}</span></td>
                                            <td>
                                                @if(strtolower($order->status) === 'completed')
                                                    <span class="duo-dash-tag duo-dash-tag--ok">{{ __('inkwave.dash_redeemed') }}</span>
                                                @else
                                                    <span class="duo-dash-tag">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="duo-dash-empty">
                            <i class="fas fa-box-open"></i>
                            <p>{{ __('inkwave.dash_no_past_orders') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Change password --}}
            <div class="duo-dash-panel" data-panel="password">
                <div class="duo-dash-card">
                    <h2 class="duo-dash-h"><i class="fas fa-lock"></i> {{ __('inkwave.dash_change_password') }}</h2>
                    <form action="{{ route('change.password') }}" method="POST">
                        @csrf
                        <div class="duo-dash-field">
                            <label class="duo-dash-label" for="current_password">{{ __('inkwave.dash_current_password') }}</label>
                            <input type="password" id="current_password" name="current_password" placeholder="{{ __('inkwave.dash_current_password_placeholder') }}" class="duo-dash-input @error('current_password') is-invalid @enderror">
                            @error('current_password')<span class="duo-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                        </div>
                        <div class="duo-dash-field">
                            <label class="duo-dash-label" for="new_password">{{ __('inkwave.dash_new_password') }}</label>
                            <input type="password" id="new_password" name="new_password" placeholder="{{ __('inkwave.dash_new_password_placeholder') }}" class="duo-dash-input @error('new_password') is-invalid @enderror">
                            @error('new_password')<span class="duo-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                        </div>
                        <div class="duo-dash-field" style="margin-bottom: 32px;">
                            <label class="duo-dash-label" for="new_confirm_password">{{ __('inkwave.dash_confirm_password') }}</label>
                            <input type="password" id="new_confirm_password" name="new_confirm_password" placeholder="{{ __('inkwave.dash_confirm_password_placeholder') }}" class="duo-dash-input @error('new_confirm_password') is-invalid @enderror">
                            @error('new_confirm_password')<span class="duo-dash-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="duo-dash-submit"><i class="fas fa-check"></i> {{ __('inkwave.dash_update_password') }}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var btns = document.querySelectorAll('.duo-dash-navbtn[data-tab]');
        var panels = document.querySelectorAll('.duo-dash-panel');
        btns.forEach(function (b) {
            b.addEventListener('click', function () {
                var t = this.getAttribute('data-tab');
                btns.forEach(function (x) { x.classList.remove('active'); });
                panels.forEach(function (p) { p.classList.remove('active'); });
                this.classList.add('active');
                var panel = document.querySelector('.duo-dash-panel[data-panel="' + t + '"]');
                if (panel) panel.classList.add('active');
            });
        });
        // If there are validation errors on the password form, open that tab
        @if($errors->any())
            var passTab = document.querySelector('.duo-dash-navbtn[data-tab="password"]');
            if (passTab) passTab.click();
        @endif
    })();
</script>
@endpush
