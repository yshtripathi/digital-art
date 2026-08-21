@extends('frontend.layouts.main')
@section('title', __('inkwave.cc_pg_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.cart_pg_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.cart_pg_title')]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme Course Cart - Artora
------------------------------------------- */
.duo-cc-wrap {
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    background: #ffffff;
    padding-bottom: 100px;
}
.duo-cc-wrap a {
    text-decoration: none !important;
}
.duo-cc-container {
    max-width: 1200px;
    margin: 48px auto;
    padding: 0 24px;
}

/* Auth / Empty State */
.duo-cc-box {
    text-align: center;
    padding: 64px 24px;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    box-shadow: 0 8px 0 #e5e5e5;
    max-width: 600px;
    margin: 0 auto;
}
.duo-cc-box i {
    font-size: 80px;
    color: #e5e5e5;
    margin-bottom: 24px;
}
.duo-cc-box h3 {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 16px;
}
.duo-cc-box p {
    font-size: 18px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 32px;
}
.duo-cc-btn {
    background: var(--color-eager-green, #58cc02);
    color: #ffffff !important;
    border: 2px solid #46a302;
    box-shadow: 0 4px 0 #46a302;
    margin-bottom: 16px;
}
.duo-cc-btn--ghost {
    background: #ffffff;
    color: var(--color-spark-blue, #1cb0f6) !important;
    border: 2px solid #e5e5e5;
    box-shadow: 0 4px 0 #e5e5e5;
}
.duo-cc-btn--ghost:hover {
    background: #f7f7f7 !important;
}
.duo-cc-summary .duo-cc-btn {
    width: 100%;
}

/* Balance Header */
.duo-cc-balance {
    background: var(--color-spark-blue, #1cb0f6);
    border: 2px solid #1899d6;
    border-radius: 32px;
    padding: 32px 48px;
    box-shadow: 0 12px 0 #1899d6;
    margin-bottom: 64px;
    display: flex;
    align-items: center;
    gap: 32px;
    color: #ffffff;
}
@media (max-width: 600px) {
    .duo-cc-balance { flex-direction: column; text-align: center; padding: 32px; }
}
.duo-cc-balance__icon {
    width: 100px;
    height: 100px;
    background: #ffffff;
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    color: var(--color-macaw-yellow, #ffc800);
    box-shadow: 0 6px 0 rgba(0,0,0,0.1);
    flex-shrink: 0;
}
.duo-cc-balance__text {
    flex: 1;
}
.duo-cc-balance__label {
    font-size: 20px;
    font-weight: 800;
    text-transform: uppercase;
    opacity: 0.9;
    margin-bottom: 4px;
    display: block;
}
.duo-cc-balance__amt {
    font-size: 48px;
    font-weight: 800;
    color: #ffffff;
    text-shadow: 0 4px 0 rgba(0,0,0,0.1);
}

/* Grid Layout */
.duo-cc-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 48px;
    align-items: start;
}
@media (max-width: 900px) {
    .duo-cc-grid { grid-template-columns: 1fr; gap: 32px; }
}

/* Cart Items */
.duo-cc-h {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.duo-cc-cards {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.duo-cc-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 8px 0 #e5e5e5;
    display: flex;
    gap: 24px;
    position: relative;
    transition: transform 0.1s, box-shadow 0.1s;
}
.duo-cc-card:hover {
    transform: translateY(2px);
    box-shadow: 0 6px 0 #e5e5e5;
}
@media (max-width: 600px) {
    .duo-cc-card { flex-direction: column; }
}
.duo-cc-card__img {
    width: 200px;
    height: 120px;
    border-radius: 16px;
    border: 2px solid #e5e5e5;
    overflow: hidden;
    flex-shrink: 0;
    background: #f7f7f7;
}
.duo-cc-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.duo-cc-card__body {
    flex: 1;
    display: flex;
    flex-direction: column;
}
.duo-cc-card__remove {
    position: absolute;
    top: -16px;
    right: -16px;
    width: 44px;
    height: 44px;
    background: var(--color-pencil-gray, #777777);
    color: #ffffff !important;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    box-shadow: 0 4px 0 #4b4b4b;
    transition: all 0.1s;
    border: 2px solid #ffffff;
    z-index: 2;
}
.duo-cc-card__remove:hover {
    background: var(--color-cardinal, #ff4b4b);
    box-shadow: 0 4px 0 #cc0000;
}
.duo-cc-card__remove:active {
    transform: translateY(4px);
    box-shadow: 0 0 0 transparent;
}
.duo-cc-card__title {
    font-size: 24px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b) !important;
    margin-bottom: 12px;
    display: block;
    transition: color 0.2s, text-shadow 0.2s;
}
.duo-cc-card__title:hover {
    color: var(--color-spark-blue, #1cb0f6) !important;
    text-shadow: 0 0 8px rgba(28, 176, 246, 0.3);
}
.duo-cc-card__pill {
    display: inline-block;
    background: #f7f7f7;
    border: 2px solid #e5e5e5;
    border-radius: 12px;
    padding: 8px 16px;
    font-size: 15px;
    font-weight: 800;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: auto;
    align-self: flex-start;
}
.duo-cc-card__cost {
    margin-top: 16px;
    font-size: 24px;
    font-weight: 800;
    color: var(--color-macaw-yellow, #ffc800);
}
.duo-cc-card__cost i {
    margin-right: 8px;
}

/* Summary */
.duo-cc-summary {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    padding: 32px;
    box-shadow: 0 12px 0 #e5e5e5;
}
.duo-cc-summary__h {
    font-size: 24px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 2px dashed #e5e5e5;
    display: flex;
    align-items: center;
    gap: 12px;
}
.duo-cc-summary__row {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 16px;
}
.duo-cc-summary__total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 2px solid #e5e5e5;
    margin-bottom: 32px;
}
.duo-cc-summary__total .lbl {
    font-size: 20px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
}
.duo-cc-summary__total .amt {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-macaw-yellow, #ffc800);
}
.duo-cc-summary__actions {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
</style>

<div class="duo-cc-wrap">
    <div class="duo-cc-container">
        @auth
            @php
                $user = auth()->user();
                $points = $user->points_balance ?? 0;
                $cartItems = Helper::cartCount() ? Helper::getAllProductFromCart()->where('order_id', null) : collect();
                $itemCount = $cartItems->count();
            @endphp

            {{-- Credits balance --}}
            <div class="duo-cc-balance">
                <div class="duo-cc-balance__icon"><i class="fas fa-coins"></i></div>
                <div class="duo-cc-balance__text">
                    <span class="duo-cc-balance__label">{{ __('inkwave.cc_lbl_balance') }}</span>
                    <span class="duo-cc-balance__amt">{{ number_format($points) }} <small style="font-size:24px;">{{ __('inkwave.cart_tag_credit') }}</small></span>
                </div>
            </div>

            <div class="duo-cc-grid">
                {{-- Items --}}
                <div>
                    <h2 class="duo-cc-h"><i class="fas fa-shopping-basket"></i> {{ __('inkwave.cart_box_summary') }}</h2>

                    @if($itemCount)
                        <div class="duo-cc-cards">
                            @foreach($cartItems as $cart)
                                @php
                                    $item_title = __('inkwave.cart_item_topup');
                                    $item_image = asset('images/placeholder.jpg');
                                    $item_link = '#';
                                    $is_course = false;
                                    $level = null;

                                    if($cart->product) {
                                        $item_title = $cart->product->title;
                                        $item_link = route('product-detail', $cart->product->slug);
                                        $photo_arr = explode(',', $cart->product->photo ?? '');
                                        $item_image = asset($photo_arr[0] ?? 'images/placeholder.jpg');

                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                         ->where('price_in_points', $cart->points)
                                                         ->first();
                                        }
                                    }
                                @endphp

                                <div class="duo-cc-card">
                                    <a href="{{ route('cart-delete', $cart->id) }}" class="duo-cc-card__remove" title="{{ __('inkwave.cart_btn_del') }}"><i class="fas fa-times"></i></a>

                                    <div class="duo-cc-card__img">
                                        <img src="{{ $item_image }}" alt="{{ $item_title }}">
                                    </div>

                                    <div class="duo-cc-card__body">
                                        <a href="{{ $item_link }}" class="duo-cc-card__title">{{ $item_title }}</a>

                                        <span class="duo-cc-card__pill">
                                            @if($is_course)
                                                <i class="fas fa-star"></i> {{ __('inkwave.cc_lbl_level') }}: {{ $level ? ucfirst($level->skill_level) : 'N/A' }}
                                            @else
                                                <i class="fas fa-gift"></i> {{ __('inkwave.cart_item_topup') }}
                                            @endif
                                        </span>

                                        <div class="duo-cc-card__cost">
                                            @if($is_course)
                                                <i class="fas fa-coins"></i> {{ number_format($cart->points) }} {{ __('inkwave.cart_tag_credit') }}
                                            @else
                                                {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                <small style="color:var(--color-pencil-gray);font-size:16px;">({{ number_format($cart->points) }} {{ __('inkwave.cart_tag_credit') }})</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="duo-cc-box">
                            <i class="fas fa-ghost"></i>
                            <h3>{{ __('inkwave.cart_mt_heading') }}</h3>
                            <p>{{ __('inkwave.cc_mt_desc') }}</p>
                            <a href="{{ route('product-lists') }}" class="duo-cc-btn">{{ __('inkwave.cart_btn_shop') }}</a>
                        </div>
                    @endif
                </div>

                {{-- Summary --}}
                <aside>
                    <div class="duo-cc-summary">
                        <h3 class="duo-cc-summary__h"><i class="fas fa-receipt"></i> {{ __('inkwave.cart_box_summary') }}</h3>

                        @if($itemCount)
                            @php $total_points = Helper::totalCartPoints(); @endphp

                            <div class="duo-cc-summary__row">
                                <span>{{ __('inkwave.cart_item_count') }}:</span>
                                <span>{{ $itemCount }}</span>
                            </div>

                            <div class="duo-cc-summary__total">
                                <span class="lbl">{{ __('inkwave.cart_box_total') }}:</span>
                                <span class="amt">{{ number_format($total_points) }} <small style="font-size:18px;">{{ __('inkwave.cart_tag_credit') }}</small></span>
                            </div>

                            <div class="duo-cc-summary__actions">
                                <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">@csrf</form>
                                <button type="button" class="duo-cc-btn" onclick="document.getElementById('redeemPointsForm').submit();">
                                    <i class="fas fa-lock"></i> {{ __('inkwave.cc_btn_redeem') }}
                                </button>
                                <a href="{{ route('product-lists') }}" class="duo-cc-btn duo-cc-btn--ghost"><i class="fas fa-plus"></i> {{ __('inkwave.cart_btn_shop') }}</a>
                            </div>
                        @else
                            <div style="text-align:center; padding: 24px 0;">
                                <i class="fas fa-info-circle" style="font-size:48px; color:#e5e5e5; margin-bottom:16px;"></i>
                                <p style="font-size:18px; font-weight:700; color:var(--color-pencil-gray);">{{ __('inkwave.cart_mt_desc') }}</p>
                            </div>
                        @endif
                    </div>
                </aside>
            </div>
        @else
            <div class="duo-cc-box">
                <i class="fas fa-lock"></i>
                <h3>{{ __('inkwave.cc_auth_req') }}</h3>
                <p>{{ __('inkwave.cc_auth_msg') }}</p>
                <a href="{{ route('login.form') }}" class="duo-cc-btn"><i class="fas fa-sign-in-alt"></i> {{ __('inkwave.login_pg_title') }}</a>
            </div>
        @endauth
    </div>
</div>
@endsection


