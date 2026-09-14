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

<section class="cp">
    <div class="cp__wrap">
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

            <div class="cp__grid">

                {{-- Items --}}
                <div class="cp-items">
                    <div class="cp-items__head">
                        <h2 class="cp-items__title">{{ __('managenovax.cart.title') }}</h2>
                        <span class="cp-count">{{ count($cartItems) }} {{ __('managenovax.cart.item_count') }}</span>
                    </div>

                    <ul class="cp-list">
                        @foreach($cartItems as $cart)
                            @php
                                $item_title = __('managenovax.cart.item_topup');
                                $item_link = '#';
                                $item_photo = null;
                                if($cart->product) {
                                    $item_title = $cart->product->title;
                                    $item_link = route('product-detail', $cart->product->slug);
                                    $item_photo = $cart->product->photo ? explode(',', $cart->product->photo)[0] : null;
                                }
                            @endphp
                            <li class="cp-item">
                                <div class="cp-item__thumb {{ $cart->product ? '' : 'cp-item__thumb--credits' }}">
                                    @if($item_photo)
                                        <img src="{{ asset($item_photo) }}" alt="" loading="lazy">
                                    @elseif($cart->product)
                                        <i class="fas fa-book-open"></i>
                                    @else
                                        <i class="fas fa-coins"></i>
                                    @endif
                                </div>

                                <div class="cp-item__body">
                                    <span class="cp-tag {{ $cart->product ? 'cp-tag--course' : 'cp-tag--credit' }}">
                                        {{ $cart->product ? __('managenovax.cart.tag_course') : __('managenovax.cart.tag_credit') }}
                                    </span>
                                    @if($cart->product)
                                        <a href="{{ $item_link }}" class="cp-item__title">{{ $item_title }}</a>
                                    @else
                                        <span class="cp-item__title">{{ $item_title }}</span>
                                    @endif

                                    <div class="cp-item__meta">
                                        <span class="cp-meta">
                                            <span class="cp-meta__label">{{ __('managenovax.cart.lbl_pts') }}</span>
                                            <span class="cp-meta__value"><i class="fas fa-coins"></i> {{ number_format($cart->points) }}</span>
                                        </span>
                                        <span class="cp-meta">
                                            <span class="cp-meta__label">{{ __('managenovax.cart.lbl_amt') }}</span>
                                            <span class="cp-meta__value">{{ $sym }}{{ number_format($cart['price'], $isJPY ? 0 : 2) }}</span>
                                        </span>
                                    </div>
                                </div>

                                <a href="{{ route('cart-delete', $cart->id) }}" class="cp-item__remove" aria-label="{{ __('managenovax.cart.btn_del') }}: {{ $item_title }}">
                                    <i class="fas fa-trash-alt"></i><span>{{ __('managenovax.cart.btn_del') }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Summary --}}
                <aside class="cp-summary">
                    <h2 class="cp-summary__title"><i class="fas fa-receipt"></i> {{ __('managenovax.cart.box_summary') }}</h2>

                    <div class="cp-summary__rows">
                        <div class="cp-summary__row">
                            <span>{{ __('managenovax.cart.item_count') }}</span>
                            <span>{{ count($cartItems) }}</span>
                        </div>

                        {{-- Subtotal row intentionally not shown --}}

                        @if($discount > 0)
                            <div class="cp-summary__row cp-summary__row--discount">
                                <span>{{ __('managenovax.cart.box_promo') }}</span>
                                <span>&minus; {{ $sym }}{{ number_format($discount, $isJPY ? 0 : 2) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="cp-summary__total">
                        <span>{{ __('managenovax.cart.box_total') }}</span>
                        <strong>{{ $sym }}{{ number_format($total_amount, $isJPY ? 0 : 2) }}</strong>
                    </div>

                    <a href="{{ route('checkout') }}" class="cp-btn cp-btn--lime">
                        {{ __('managenovax.cart.btn_pay') }} <i class="fas fa-arrow-right"></i>
                    </a>

                    @if(Helper::totalCartPoints() > 0)
                        <a href="{{ route('product-lists') }}" class="cp-btn cp-btn--outline">
                            <i class="fas fa-arrow-left"></i> {{ __('managenovax.cart.btn_shop') }}
                        </a>
                    @endif

                    <p class="cp-summary__trust"><i class="fas fa-shield-alt"></i> {{ __('managenovax.credits.trust_msg') }}</p>

                    <div class="cp-summary__pay">
                        <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment methods">
                    </div>
                </aside>

            </div>
        @else
            {{-- Empty state --}}
            <div class="cp-empty">
                <div class="cp-empty__art" aria-hidden="true">
                    <span class="cp-empty__ring"></span>
                    <span class="cp-empty__icon"><i class="fas fa-shopping-basket"></i></span>
                    <span class="cp-empty__dot cp-empty__dot--1"></span>
                    <span class="cp-empty__dot cp-empty__dot--2"></span>
                    <span class="cp-empty__dot cp-empty__dot--3"></span>
                </div>
                <h2 class="cp-empty__title">{{ __('managenovax.cart.mt_heading') }}</h2>
                <p class="cp-empty__desc">{{ __('managenovax.cart.mt_desc') }}</p>
                <div class="cp-empty__actions">
                    <a href="{{ route('product-lists') }}" class="cp-btn cp-btn--dark">
                        <i class="fas fa-graduation-cap"></i> {{ __('managenovax.cart.btn_shop') }}
                    </a>
                    <a href="{{ route('points.topup') }}" class="cp-btn cp-btn--lime">
                        <i class="fas fa-coins"></i> {{ __('managenovax.credits.pg_title') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
