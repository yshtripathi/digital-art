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

                        <a href="{{ route('checkout') }}" class="duo-cart-btn duo-cart-btn--primary">{{ __('inkwave.cart_btn_pay') }} <i class="fas fa-arrow-right"></i></a>

                        @if(Helper::totalCartPoints() > 0)
                            <a href="{{ route('product-lists') }}" class="duo-cart-btn duo-cart-btn--ghost"><i class="fas fa-arrow-left"></i> {{ __('inkwave.cart_btn_shop') }}</a>
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
