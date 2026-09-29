@extends('frontend.layouts.main')
@section('title', __('frontend.cart.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.cart.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.cart.title')]
    ]
])

<section class="pay">
    <div class="container">
        @if(Helper::cartCount())
            @php
                $cartItems = Helper::getAllProductFromCart();
                $subtotal = 0;
                $totalCredits = 0;
                foreach($cartItems as $item) {
                    $subtotal += $item['price'];
                    $totalCredits += $item['points'];
                }
                $discount = session()->has('coupon') ? Session::get('coupon')['value'] : 0;
                $total_amount = $subtotal - $discount;
                $sym = Helper::getCurrencySymbol(session('currency'));
                $dec = session('currency') == 'JPY' ? 0 : 2;
                $payImage = file_exists(public_path('assets/images/payment.webp')) ? asset('assets/images/payment.webp') : null;
            @endphp

            <ol class="pay-steps">
                <li class="pay-steps__item is-active" aria-current="step"><span class="pay-steps__no">1</span>{{ __('frontend.cart.step_cart') }}</li>
                <li class="pay-steps__item"><span class="pay-steps__no">2</span>{{ __('frontend.cart.step_pay') }}</li>
                <li class="pay-steps__item"><span class="pay-steps__no">3</span>{{ __('frontend.cart.step_done') }}</li>
            </ol>

            <div class="pay__grid">
                <div class="pay-card bag" style="--i: 0">
                    <div class="bag__head">
                        <h2 class="pay-card__title bag__title">{{ __('frontend.cart.selected') }}<span class="bag__count">{{ trans_choice('frontend.cart.items', count($cartItems), ['count' => count($cartItems)]) }}</span></h2>
                        <a href="{{ route('product-lists') }}" class="bag__more">{{ __('frontend.cart.browse_more') }}</a>
                    </div>

                    <ul class="bag__list">
                        @foreach($cartItems as $cart)
                            @php
                                $item_title = __('frontend.cart.package');
                                $item_link = null;
                                $item_photo = null;
                                if($cart->product) {
                                    $item_title = $cart->product->title;
                                    $item_link = route('product-detail', $cart->product->slug);
                                    $raw_photo = $cart->product->photo ? trim(explode(',', $cart->product->photo)[0]) : '';
                                    $item_photo = $raw_photo !== '' && file_exists(public_path(ltrim($raw_photo, '/'))) ? asset(ltrim($raw_photo, '/')) : null;
                                }
                            @endphp

                            <li class="bag-item">
                                <span class="bag-item__thumb {{ $cart->product ? '' : 'bag-item__thumb--credits' }}" aria-hidden="true">
                                    @if($item_photo)
                                        <img src="{{ $item_photo }}" alt="" loading="lazy">
                                    @elseif($cart->product)
                                        <i class="fas fa-book-open"></i>
                                    @else
                                        <i class="fas fa-coins"></i>
                                    @endif
                                </span>

                                <div class="bag-item__info">
                                    <span class="tag">{{ $cart->product ? __('frontend.cart.tag_guide') : __('frontend.cart.tag_credits') }}</span>
                                    @if($item_link)
                                        <a href="{{ $item_link }}" class="bag-item__name">{{ $item_title }}</a>
                                    @else
                                        <span class="bag-item__name">{{ $item_title }}</span>
                                    @endif
                                    <span class="bag-item__meta">{{ number_format($cart->points) }} {{ __('frontend.cart.col_credits') }}</span>
                                </div>

                                <strong class="bag-item__price">{{ $sym }}{{ number_format($cart['price'], $dec) }}</strong>

                                <a href="{{ route('cart-delete', $cart->id) }}" class="bag-item__drop" aria-label="{{ __('frontend.cart.remove') }}: {{ $item_title }}">
                                    <i class="fas fa-times" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="pay__rail">
                    <div class="pay-sum">
                        <h2 class="pay-sum__title">{{ __('frontend.cart.totals') }}</h2>

                        <ul class="pay-sum__rows">
                            <li class="pay-sum__row">
                                <span class="pay-sum__item">
                                    <span class="pay-sum__icon" aria-hidden="true"><i class="fas fa-coins"></i></span>
                                    <span>{{ __('frontend.cart.col_credits') }}</span>
                                </span>
                                <span class="pay-sum__price">{{ number_format($totalCredits) }}</span>
                            </li>
                            @if($discount > 0)
                                <li class="pay-sum__row">
                                    <span class="pay-sum__item">
                                        <span class="pay-sum__icon" aria-hidden="true"><i class="fas fa-tag"></i></span>
                                        <span>{{ __('frontend.cart.discount') }}</span>
                                    </span>
                                    <span class="pay-sum__price">&minus; {{ $sym }}{{ number_format($discount, $dec) }}</span>
                                </li>
                            @endif
                        </ul>

                        <p class="pay-sum__total">
                            <span>{{ __('frontend.cart.total') }}</span>
                            <strong>{{ $sym }}{{ number_format($total_amount, $dec) }}</strong>
                        </p>

                        <div class="bag-facts">
                            <p class="bag-facts__title">{{ __('frontend.checkout.before_title') }}</p>
                            <ul class="bag-facts__list">
                                <li><i class="far fa-clock" aria-hidden="true"></i><span>{{ __('frontend.checkout.note_delivery') }}</span></li>
                                <li><i class="far fa-calendar-check" aria-hidden="true"></i><span>{{ __('frontend.checkout.note_validity') }}</span></li>
                            </ul>
                        </div>

                        <a href="{{ route('checkout') }}" class="btn btn--primary btn--block">{{ __('frontend.cart.checkout') }}</a>
                        <a href="{{ route('points.topup') }}" class="btn btn--dark btn--block bag__second">{{ __('frontend.cart.buy_credits') }}</a>

                        <p class="pay-sum__secure">
                            <i class="fas fa-shield-alt" aria-hidden="true"></i>
                            <span>{{ __('frontend.cart.secure_note') }}</span>
                        </p>

                        @if($payImage)
                            <img class="pay-sum__methods" src="{{ $payImage }}" alt="{{ __('frontend.cart.payments') }}" width="220" height="30" loading="lazy">
                        @endif
                    </div>
                </aside>
            </div>
        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.cart.empty_title') }}</h2>
                <p class="bag-empty__text">{{ __('frontend.cart.empty_text') }}</p>
                <div class="bag-empty__acts">
                    <a href="{{ route('points.topup') }}" class="btn btn--primary">{{ __('frontend.cart.buy_credits') }}</a>
                    <a href="{{ route('product-lists') }}" class="btn btn--dark">{{ __('frontend.cart.browse') }}</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
