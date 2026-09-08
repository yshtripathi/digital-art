@extends('frontend.layouts.main')
@section('title', __('managenovax.cart.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.cart.title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.cart.title')]
    ]
])



<div class="ag-cart-page">
    <div class="ag-container">
        <h1 class="ag-page-title">{{ __('managenovax.cart.title') }}</h1>
        
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
                            $item_title = __('managenovax.cart.item_topup');
                            $item_link = '#';
                            if($cart->product) {
                                $item_title = $cart->product->title;
                                $item_link = route('product-detail', $cart->product->slug);
                            }
                        @endphp
                        <div class="ag-cart-card">
                            <div class="ag-cart-card__main">
                                <a href="{{ $item_link }}" class="ag-cart-card__title">{{ $item_title }}</a>
                                <span class="ag-cart-card__tag">{{ $cart->product ? __('managenovax.cart.tag_course') : __('managenovax.cart.tag_credit') }}</span>
                            </div>

                            <div class="ag-cart-card__meta">
                                <div class="ag-cart-card__col">
                                    <span class="ag-cart-card__label">{{ __('managenovax.cart.lbl_pts') }}</span>
                                    <span class="ag-cart-card__val"><i class="fas fa-coins"></i>{{ number_format($cart->points) }}</span>
                                </div>
                                <div class="ag-cart-card__col">
                                    <span class="ag-cart-card__label">{{ __('managenovax.cart.lbl_amt') }}</span>
                                    <span class="ag-cart-card__val">{{ $sym }}{{ number_format($cart['price'], $isJPY ? 0 : 2) }}</span>
                                </div>
                            </div>

                            <a href="{{ route('cart-delete', $cart->id) }}" class="ag-cart-card__remove" aria-label="{{ __('managenovax.cart.btn_del') }}" title="Remove Item"><i class="fas fa-times"></i></a>
                        </div>
                    @endforeach
                </div>

                {{-- Right Side: Summary --}}
                <aside>
                    <div class="ag-summary-card">
                        <h3 class="ag-summary-title"><i class="fas fa-shopping-bag"></i> {{ __('managenovax.cart.box_summary') }}</h3>
                        
                        {{-- Explicitly removed Subtotal row per request --}}

                        @if($discount > 0)
                            <div class="ag-summary-row">
                                <span>{{ __('managenovax.cart.box_promo') }}</span>
                                <span>&minus; {{ $sym }}{{ number_format($discount, $isJPY ? 0 : 2) }}</span>
                            </div>
                        @endif

                        <div class="ag-summary-total">
                            <span>{{ __('managenovax.cart.box_total') }}:</span>
                            <span>{{ $sym }}{{ number_format($total_amount, $isJPY ? 0 : 2) }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="ag-primary-btn">{{ __('managenovax.cart.btn_pay') }} <i class="fas fa-arrow-right" style="margin-left:8px;"></i></a>

                        @if(Helper::totalCartPoints() > 0)
                            <a href="{{ route('product-lists') }}" class="ag-ghost-btn"><i class="fas fa-arrow-left" style="margin-right:8px;"></i> {{ __('managenovax.cart.btn_shop') }}</a>
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
                <h3>{{ __('managenovax.cart.mt_heading') }}</h3>
                <p>{{ __('managenovax.cart.mt_desc') }}</p>
                <a href="{{ route('product-lists') }}" class="ag-primary-btn" style="display:inline-block !important; margin-top:0;">{{ __('managenovax.cart.btn_shop') }}</a>
            </div>
        @endif
    </div>
</div>
@endsection
