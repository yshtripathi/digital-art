@extends('frontend.layouts.main')
@section('title', __('inkwave.cart_title'))
@section('main-content')

<x-breadcrumb :title="__('inkwave.cart_title')" />

<section class="cart-wrap">
    <div class="cart-container">
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

            <div class="cart-grid">
                {{-- Items --}}
                <div class="cart-items">
                    <h2 class="cart-h"><i class="fas fa-shopping-cart"></i> {{ __('inkwave.cart_item_summary') }}</h2>

                    <div class="cart-list">
                        @foreach($cartItems as $cart)
                            @php
                                $item_title = __('inkwave.cart_credits_topup');
                                $item_link = '#';
                                if($cart->product) {
                                    $item_title = $cart->product->title;
                                    $item_link = route('product-detail', $cart->product->slug);
                                }
                            @endphp
                            <div class="cart-item">
                                <div class="cart-item__main">
                                    <a href="{{ $item_link }}" class="cart-item__title">{{ $item_title }}</a>
                                    <span class="cart-item__tag">{{ $cart->product ? __('inkwave.cart_type_art') : __('inkwave.cart_type_credits') }}</span>
                                </div>

                                <div class="cart-item__meta">
                                    <div class="cart-item__col">
                                        <span class="cart-item__label">{{ __('inkwave.cart_label_points') }}</span>
                                        <span class="cart-item__val"><i class="fas fa-coins"></i>{{ number_format($cart->points) }} {{ __('inkwave.cart_type_credits') }}</span>
                                    </div>
                                    <div class="cart-item__col">
                                        <span class="cart-item__label">{{ __('inkwave.cart_label_price') }}</span>
                                        <span class="cart-item__val">{{ $sym }}{{ number_format($cart['price'], $isJPY ? 0 : 2) }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('cart-delete', $cart->id) }}" class="cart-item__remove" aria-label="{{ __('inkwave.cart_label_remove') }}"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Summary --}}
                <aside>
                    <div class="cart-summary__card">
                        <h3 class="cart-summary__h">{{ __('inkwave.cart_order_summary') }}</h3>

                        
                        @if($discount > 0)
                            <div class="cart-summary__row">
                                <span>{{ __('inkwave.cart_coupon') }}</span>
                                <span>&minus; {{ $sym }}{{ number_format($discount, $isJPY ? 0 : 2) }}</span>
                            </div>
                        @endif

                        <div class="cart-summary__total">
                            <span class="lbl">{{ __('inkwave.cart_total') }}:</span>
                            <span class="amt">{{ $sym }}{{ number_format($total_amount, $isJPY ? 0 : 2) }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="cart-btn cart-btn--primary">{{ __('inkwave.cart_checkout') }} <i class="fas fa-arrow-right"></i></a>

                        @if(Helper::totalCartPoints() > 0)
                            <a href="{{ route('product-lists') }}" class="cart-btn cart-btn--ghost"><i class="fas fa-arrow-left"></i> {{ __('inkwave.cart_continue') }}</a>
                        @endif

                        <div class="cart-pay">
                            <img src="{{ asset('assets/images/payment.webp') }}" alt="Payments">
                        </div>
                    </div>
                </aside>
            </div>
        @else
            <div class="cart-empty">
                <i class="fas fa-shopping-basket"></i>
                <h3>{{ __('inkwave.cart_no_items') }}</h3>
                <p>{{ __('inkwave.cart_empty_msg') }}</p>
                <a href="{{ route('product-lists') }}" class="cart-btn cart-btn--primary cart-empty__btn">{{ __('inkwave.cart_continue') }} <i class="fas fa-arrow-right"></i></a>
            </div>
        @endif
    </div>
</section>

@endsection


