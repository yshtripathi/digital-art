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
/* ==========================================================================
   Art Courses — Cart Page (Card-based Split Layout)
   ========================================================================== */
.ag-cart-page, .ag-cart-page *, .ag-cart-page *::before, .ag-cart-page *::after {
    box-sizing: border-box;
}
.ag-cart-page {
    padding: 40px 40px;
}
.ag-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 5%;
}

.ag-page-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 48px !important;
    color: #000000 !important;
    margin-bottom: 64px !important;
    text-align: center;
}

/* Grid Layout */
.ag-cart-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 64px;
    align-items: start;
}
@media (max-width: 1100px) { .ag-cart-grid { grid-template-columns: 1fr; gap: 48px; } }

/* Items List - Card Style */
.ag-cart-card {
    background-color: #f5f5f5; /* Bone */
    padding: 40px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-left: 4px solid transparent;
    transition: all 0.3s ease;
}
.ag-cart-card:hover {
    border-left-color: #bc9c5c;
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
}
@media (max-width: 768px) {
    .ag-cart-card { flex-direction: column; align-items: flex-start; gap: 24px; padding: 32px 24px; }
}

.ag-cart-card__main { flex: 1; }
.ag-cart-card__title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 26px !important;
    color: #000000 !important;
    text-decoration: none !important;
    display: block;
    margin-bottom: 12px;
    transition: color 0.3s ease;
}
.ag-cart-card__title:hover { color: #bc9c5c !important; }

.ag-cart-card__tag {
    display: inline-block;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: #ffffff;
    background-color: #000000;
    padding: 6px 12px;
}

.ag-cart-card__meta {
    display: flex;
    gap: 48px;
    margin-left: auto;
    text-align: right;
    align-items: flex-end;
}
@media (max-width: 768px) { .ag-cart-card__meta { margin: 0; width: 100%; justify-content: space-between; text-align: left; } }

.ag-cart-card__col { display: flex; flex-direction: column; gap: 8px; }
.ag-cart-card__label { font-family: var(--font-arial, Arial, sans-serif); font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: #888888; }
.ag-cart-card__val { font-family: var(--font-arial, Arial, sans-serif); font-size: 18px; font-weight: bold; color: #000000; display: flex; align-items: center; gap: 6px; }
.ag-cart-card__val i { color: #bc9c5c; }

.ag-cart-card__remove {
    position: static;
    color: #aaaaaa;
    font-size: 20px;
    transition: all 0.3s ease;
    margin-left: 32px;
    margin-bottom: 2px;
}
.ag-cart-card__remove:hover { color: #d93025; }
@media (max-width: 768px) { .ag-cart-card__remove { align-self: flex-end; margin-left: 0; margin-top: -32px; } }

/* Order Summary Box */
.ag-summary-card {
    background-color: #f5f5f5; /* Bone */
    padding: 40px;
    position: sticky;
    top: 140px;
}
.ag-summary-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 28px !important;
    color: #000000 !important;
    margin-bottom: 32px !important;
    line-height: 1.2 !important;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding-bottom: 16px;
}
.ag-summary-title i { color: #bc9c5c; font-size: 24px; }

.ag-summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    color: #d93025; /* Used for promo */
}
.ag-summary-total {
    padding-top: 16px;
    margin-top: 8px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 22px;
    font-weight: bold;
    color: #000000;
    display: flex;
    justify-content: space-between;
}

/* Buttons */
.ag-primary-btn {
    background: #000000 !important; color: #ffffff !important; border: 1px solid #000000 !important; font-family: Arial, sans-serif !important; font-size: 13px !important; font-weight: bold !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; cursor: pointer !important; transition: all 0.3s ease !important; padding: 20px 24px !important; white-space: nowrap !important; display: block !important; text-align: center !important; border-radius: 0 !important; text-decoration: none !important; margin-top: 32px;
}
.ag-primary-btn:hover { background: #ffffff !important; color: #000000 !important; }

.ag-ghost-btn { display: block; text-align: center; font-family: var(--font-arial, Arial, sans-serif); font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; color: #000000; text-decoration: none; border: 1px solid rgba(0,0,0,0.2); padding: 16px; margin-top: 16px; transition: all 0.3s ease; }
.ag-ghost-btn:hover { border-color: #000000; background: rgba(0,0,0,0.02); }

.ag-payment-methods { margin-top: 32px; text-align: center; }
.ag-payment-methods img { max-width: 100%; height: auto; opacity: 0.8; }

/* Empty State */
.ag-cart-empty { text-align: center; padding: 80px 40px; background-color: #f5f5f5; max-width: 600px; margin: 0 auto; }
.ag-cart-empty i { font-size: 48px; color: #bc9c5c; margin-bottom: 24px; }
.ag-cart-empty h3 { font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important; font-size: 32px !important; color: #000000 !important; margin-bottom: 16px !important; }
.ag-cart-empty p { font-family: var(--font-arial, Arial, sans-serif); color: #555555; margin-bottom: 32px; }
</style>

<div class="ag-cart-page">
    <div class="ag-container">
        <h1 class="ag-page-title">{{ __('inkwave.cart_pg_title') }}</h1>
        
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

            <div class="ag-cart-grid">
                
                {{-- Left Side: Items --}}
                <div class="ag-cart-items">
                    @foreach($cartItems as $cart)
                        @php
                            $item_title = __('inkwave.cart_item_topup');
                            $item_link = '#';
                            if($cart->product) {
                                $item_title = $cart->product->title;
                                $item_link = route('product-detail', $cart->product->slug);
                            }
                        @endphp
                        <div class="ag-cart-card">
                            <div class="ag-cart-card__main">
                                <a href="{{ $item_link }}" class="ag-cart-card__title">{{ $item_title }}</a>
                                <span class="ag-cart-card__tag">{{ $cart->product ? __('inkwave.cart_tag_course') : __('inkwave.cart_tag_credit') }}</span>
                            </div>

                            <div class="ag-cart-card__meta">
                                <div class="ag-cart-card__col">
                                    <span class="ag-cart-card__label">{{ __('inkwave.cart_lbl_pts') }}</span>
                                    <span class="ag-cart-card__val"><i class="fas fa-coins"></i>{{ number_format($cart->points) }}</span>
                                </div>
                                <div class="ag-cart-card__col">
                                    <span class="ag-cart-card__label">{{ __('inkwave.cart_lbl_amt') }}</span>
                                    <span class="ag-cart-card__val">{{ $sym }}{{ number_format($cart['price'], $isJPY ? 0 : 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('cart-delete', $cart->id) }}" class="ag-cart-card__remove" aria-label="{{ __('inkwave.cart_btn_del') }}" title="Remove Item"><i class="fas fa-times"></i></a>
                        </div>
                    @endforeach
                </div>

                {{-- Right Side: Summary --}}
                <aside>
                    <div class="ag-summary-card">
                        <h3 class="ag-summary-title"><i class="fas fa-shopping-bag"></i> {{ __('inkwave.cart_box_summary') }}</h3>
                        
                        {{-- Explicitly removed Subtotal row per request --}}

                        @if($discount > 0)
                            <div class="ag-summary-row">
                                <span>{{ __('inkwave.cart_box_promo') }}</span>
                                <span>&minus; {{ $sym }}{{ number_format($discount, $isJPY ? 0 : 2) }}</span>
                            </div>
                        @endif

                        <div class="ag-summary-total">
                            <span>{{ __('inkwave.cart_box_total') }}:</span>
                            <span>{{ $sym }}{{ number_format($total_amount, $isJPY ? 0 : 2) }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="ag-primary-btn">{{ __('inkwave.cart_btn_pay') }} <i class="fas fa-arrow-right" style="margin-left:8px;"></i></a>

                        @if(Helper::totalCartPoints() > 0)
                            <a href="{{ route('product-lists') }}" class="ag-ghost-btn"><i class="fas fa-arrow-left" style="margin-right:8px;"></i> {{ __('inkwave.cart_btn_shop') }}</a>
                        @endif
                        
                        <div class="ag-payment-methods">
                            <img src="{{ asset('assets/images/payment.webp') }}" alt="Payments">
                        </div>
                    </div>
                </aside>

            </div>
        @else
            <div class="ag-cart-empty">
                <i class="fas fa-shopping-basket"></i>
                <h3>{{ __('inkwave.cart_mt_heading') }}</h3>
                <p>{{ __('inkwave.cart_mt_desc') }}</p>
                <a href="{{ route('product-lists') }}" class="ag-primary-btn" style="display:inline-block !important; margin-top:0;">{{ __('inkwave.cart_btn_shop') }}</a>
            </div>
        @endif
    </div>
</div>
@endsection
