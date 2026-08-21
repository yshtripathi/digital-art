@extends('frontend.layouts.main')
@section('title', __('inkwave.cart_pg_title'))
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
   Duolingo Theme - Cart Page
------------------------------------------- */
.duo-cart-wrap {
    background-color: var(--color-paper-white, #ffffff);
    padding: 64px 24px 120px;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
}
.duo-cart-container {
    max-width: 1100px;
    margin: 0 auto;
}
.duo-cart-header {
    color: var(--color-charcoal, #4b4b4b);
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 32px;
}

/* Grid Layout */
.duo-cart-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 48px;
}
@media (max-width: 900px) {
    .duo-cart-grid { grid-template-columns: 1fr; gap: 48px; }
}

/* Cart Items List */
.duo-cart-items {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.duo-cart-item {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    padding: 24px 32px;
    box-shadow: 0 6px 0 #e5e5e5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    transition: transform 0.1s, box-shadow 0.1s;
}
.duo-cart-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 0 #e5e5e5;
}
@media (max-width: 600px) {
    .duo-cart-item { flex-direction: column; align-items: flex-start; padding: 24px; }
}

/* Item Details */
.duo-cart-item__main {
    flex-grow: 1;
}
.duo-cart-item__title {
    display: block;
    font-size: 24px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    text-decoration: none;
    margin-bottom: 12px;
}
.duo-cart-item__title:hover {
    color: var(--color-spark-blue, #1cb0f6);
}
.duo-cart-item__tag {
    display: inline-block;
    background: #f7f7f7;
    color: var(--color-pencil-gray, #777777);
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.053em;
    padding: 6px 16px;
    border-radius: 12px;
    border: 2px solid #e5e5e5;
}

/* Item Meta (Price/Points) */
.duo-cart-item__meta {
    display: flex;
    gap: 32px;
    text-align: right;
}
@media (max-width: 600px) {
    .duo-cart-item__meta { text-align: left; width: 100%; justify-content: space-between; border-top: 2px solid #e5e5e5; padding-top: 16px; margin-top: 8px; }
}
.duo-cart-item__col {
    display: flex;
    flex-direction: column;
}
.duo-cart-item__label {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--color-faded-gray, #afafaf);
    margin-bottom: 4px;
}
.duo-cart-item__val {
    font-size: 20px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
}
.duo-cart-item__val i {
    color: #ffc800; /* Macaw yellow */
    margin-right: 8px;
}

/* Delete Button */
.duo-cart-item__remove {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 56px;
    height: 56px;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    color: #ff4b4b; /* Rose red */
    font-size: 20px;
    box-shadow: 0 4px 0 #e5e5e5;
    transition: transform 0.1s, box-shadow 0.1s, background-color 0.1s;
    flex-shrink: 0;
    text-decoration: none;
}
.duo-cart-item__remove:hover {
    background: #ffecf0;
    border-color: #ff4b4b;
    box-shadow: 0 4px 0 #ff4b4b;
    color: #ff4b4b;
}
.duo-cart-item__remove:active {
    transform: translateY(4px);
    box-shadow: 0 0 0 #ff4b4b;
}
@media (max-width: 600px) {
    .duo-cart-item__remove { position: absolute; top: 24px; right: 24px; }
    .duo-cart-item { position: relative; }
}

/* Order Summary */
.duo-cart-summary {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    padding: 40px;
    box-shadow: 0 12px 0 #e5e5e5;
    position: sticky;
    top: 120px;
}
.duo-cart-summary__h {
    font-size: 28px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 2px solid #e5e5e5;
}
.duo-cart-summary__row {
    display: flex;
    justify-content: space-between;
    font-size: 19px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 16px;
}
.duo-cart-summary__total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 24px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin: 32px 0 40px;
    padding-top: 32px;
    border-top: 2px solid #e5e5e5;
}
.duo-cart-summary__total .amt {
    font-size: 32px;
    color: var(--color-eager-green, #58cc02);
}

/* Buttons */
.duo-cart-btn {
    margin-bottom: 24px;
}
.duo-cart-summary .duo-cart-btn {
    width: 100%;
}
.duo-cart-btn--primary {
    background: var(--color-eager-green, #58cc02);
    color: #ffffff;
    border: 2px solid #46a302;
    box-shadow: 0 4px 0 #46a302;
}
.duo-cart-btn--primary:hover {
    background: #5fe002;
    color: #ffffff;
}
.duo-cart-btn--primary:active {
    transform: translateY(4px);
    box-shadow: 0 0 0 #46a302;
}

.duo-cart-btn--ghost {
    background: transparent;
    color: var(--color-spark-blue, #1cb0f6);
    border: 2px solid #e5e5e5;
    box-shadow: 0 4px 0 #e5e5e5;
}
.duo-cart-btn--ghost:hover {
    background: #f7f7f7;
    color: var(--color-spark-blue, #1cb0f6);
}
.duo-cart-btn--ghost:active {
    transform: translateY(4px);
    box-shadow: 0 0 0 #e5e5e5;
}

/* Empty Cart */
.duo-cart-empty {
    text-align: center;
    padding: 120px 24px;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    box-shadow: 0 12px 0 #e5e5e5;
}
.duo-cart-empty i {
    font-size: 96px;
    color: #e5e5e5;
    margin-bottom: 40px;
}
.duo-cart-empty h3 {
    font-size: 40px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 16px;
}
.duo-cart-empty p {
    font-size: 20px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 48px;
}
.duo-cart-empty .duo-cart-btn {
    max-width: 350px;
    margin: 0 auto;
}

/* Pay Icons */
.duo-cart-pay {
    margin-top: 24px;
    text-align: center;
}
.duo-cart-pay img {
    max-width: 100%;
    height: auto;
}
</style>

<section class="duo-cart-wrap">
    <div class="duo-cart-container">
        <h1 class="duo-cart-header">{{ __('inkwave.cart_pg_title') }}</h1>
        
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

            <div class="duo-cart-grid">
                {{-- Items --}}
                <div class="duo-cart-items">
                    @foreach($cartItems as $cart)
                        @php
                            $item_title = __('inkwave.cart_item_topup');
                            $item_link = '#';
                            if($cart->product) {
                                $item_title = $cart->product->title;
                                $item_link = route('product-detail', $cart->product->slug);
                            }
                        @endphp
                        <div class="duo-cart-item">
                            <div class="duo-cart-item__main">
                                <a href="{{ $item_link }}" class="duo-cart-item__title">{{ $item_title }}</a>
                                <span class="duo-cart-item__tag">{{ $cart->product ? __('inkwave.cart_tag_course') : __('inkwave.cart_tag_credit') }}</span>
                            </div>

                            <div class="duo-cart-item__meta">
                                <div class="duo-cart-item__col">
                                    <span class="duo-cart-item__label">{{ __('inkwave.cart_lbl_pts') }}</span>
                                    <span class="duo-cart-item__val"><i class="fas fa-coins"></i>{{ number_format($cart->points) }}</span>
                                </div>
                                <div class="duo-cart-item__col">
                                    <span class="duo-cart-item__label">{{ __('inkwave.cart_lbl_amt') }}</span>
                                    <span class="duo-cart-item__val">{{ $sym }}{{ number_format($cart['price'], $isJPY ? 0 : 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('cart-delete', $cart->id) }}" class="duo-cart-item__remove" aria-label="{{ __('inkwave.cart_btn_del') }}"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    @endforeach
                </div>

                {{-- Summary --}}
                <aside>
                    <div class="duo-cart-summary">
                        <h3 class="duo-cart-summary__h">{{ __('inkwave.cart_box_summary') }}</h3>
                        
                        @if($discount > 0)
                            <div class="duo-cart-summary__row">
                                <span>{{ __('inkwave.cart_box_promo') }}</span>
                                <span>&minus; {{ $sym }}{{ number_format($discount, $isJPY ? 0 : 2) }}</span>
                            </div>
                        @endif

                        <div class="duo-cart-summary__total">
                            <span class="lbl">{{ __('inkwave.cart_box_total') }}:</span>
                            <span class="amt">{{ $sym }}{{ number_format($total_amount, $isJPY ? 0 : 2) }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="duo-cart-btn duo-cart-btn--primary">{{ __('inkwave.cart_btn_pay') }} <i class="fas fa-arrow-right" style="font-size: 12px;"></i></a>

                        @if(Helper::totalCartPoints() > 0)
                            <a href="{{ route('product-lists') }}" class="duo-cart-btn duo-cart-btn--ghost"><i class="fas fa-arrow-left" style="font-size: 12px;"></i> {{ __('inkwave.cart_btn_shop') }}</a>
                        @endif
                        
                        <div class="duo-cart-pay">
                            <img src="{{ asset('assets/images/payment.webp') }}" alt="Payments">
                        </div>
                    </div>
                </aside>
            </div>
        @else
            <div class="duo-cart-empty">
                <i class="fas fa-shopping-basket"></i>
                <h3>{{ __('inkwave.cart_mt_heading') }}</h3>
                <p>{{ __('inkwave.cart_mt_desc') }}</p>
                <a href="{{ route('product-lists') }}" class="duo-cart-btn duo-cart-btn--primary">{{ __('inkwave.cart_btn_shop') }}</a>
            </div>
        @endif
    </div>
</section>

@endsection
