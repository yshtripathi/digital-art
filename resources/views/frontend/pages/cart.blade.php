@extends('frontend.layouts.main')
@section('title', __('frontend.cart.page_name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.cart.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.cart.page_name')]
    ]
])

<section class="ct">
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
        @endphp

        <ol class="steps">
            <li class="steps__item is-active" aria-current="step">
                <span class="steps__no">1</span>
                <span class="steps__label">{{ __('frontend.cart.st_cart') }}</span>
            </li>
            <li class="steps__line" aria-hidden="true"></li>
            <li class="steps__item">
                <span class="steps__no">2</span>
                <span class="steps__label">{{ __('frontend.cart.st_pay') }}</span>
            </li>
            <li class="steps__line" aria-hidden="true"></li>
            <li class="steps__item">
                <span class="steps__no">3</span>
                <span class="steps__label">{{ __('frontend.cart.st_done') }}</span>
            </li>
        </ol>

        <div class="ct__grid">
            <div class="ct__main">
                <div class="ct__head">
                    <div>
                        <span class="eyebrow">{{ trans_choice('frontend.cart.item_count', count($cartItems), ['count' => count($cartItems)]) }}</span>
                        <h2 class="ct__title">{{ __('frontend.cart.picked') }}</h2>
                    </div>
                    @if(Helper::totalCartPoints() > 0)
                        <a href="{{ route('product-lists') }}" class="auth__back">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            {{ __('frontend.cart.more') }}
                        </a>
                    @endif
                </div>

                <ul class="ct__list">
                    @foreach($cartItems as $cart)
                        @php
                            $item_title = __('frontend.cart.pack');
                            $item_link = null;
                            $item_photo = null;
                            if($cart->product) {
                                $item_title = $cart->product->title;
                                $item_link = route('product-detail', $cart->product->slug);
                                $item_photo = $cart->product->photo ? explode(',', $cart->product->photo)[0] : null;
                            }
                        @endphp

                        <li class="line" style="--i: {{ $loop->index }}">
                            <span class="line__media {{ $cart->product ? '' : 'line__media--credits' }}">
                                @if($item_photo)
                                    <img src="{{ asset(ltrim($item_photo, '/')) }}" alt="" loading="lazy">
                                @elseif($cart->product)
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @else
                                    <i class="fas fa-coins" aria-hidden="true"></i>
                                @endif
                            </span>

                            <div class="line__body">
                                <span class="badge {{ $cart->product ? '' : 'badge--beginner' }}">
                                    {{ $cart->product ? __('frontend.cart.chip_material') : __('frontend.cart.chip_credits') }}
                                </span>
                                @if($item_link)
                                    <a href="{{ $item_link }}" class="line__title">{{ $item_title }}</a>
                                @else
                                    <span class="line__title">{{ $item_title }}</span>
                                @endif
                                <span class="line__meta">
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                    <span class="num">{{ number_format($cart->points) }}</span> {{ __('frontend.cart.col_credits') }}
                                </span>
                            </div>

                            <div class="line__end">
                                <strong class="line__price num">{{ $sym }}{{ number_format($cart['price'], $dec) }}</strong>
                                <a href="{{ route('cart-delete', $cart->id) }}" class="line__drop" aria-label="{{ __('frontend.cart.drop') }}: {{ $item_title }}">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <aside class="ct__rail">
                <div class="sum">
                    <div class="sum__head">
                        <span class="sum__badge" aria-hidden="true"><i class="fas fa-receipt"></i></span>
                        <h2 class="sum__title">{{ __('frontend.cart.summary') }}</h2>
                    </div>

                    <div class="sum__body">
                        <dl class="ct__stats">
                            <div class="ct__stat">
                                <dt>{{ __('frontend.cart.col_credits') }}</dt>
                                <dd><i class="fas fa-bolt" aria-hidden="true"></i> <span class="num">{{ number_format($totalCredits) }}</span></dd>
                            </div>
                            @if($discount > 0)
                                <div class="ct__stat">
                                    <dt>{{ __('frontend.cart.sum_discount') }}</dt>
                                    <dd class="num">&minus; {{ $sym }}{{ number_format($discount, $dec) }}</dd>
                                </div>
                            @endif
                        </dl>

                        <div class="sum__total">
                            <span>{{ __('frontend.cart.sum_total') }}</span>
                            <strong>{{ $sym }}{{ number_format($total_amount, $dec) }}</strong>
                        </div>
                    </div>

                    <div class="sum__foot">
                        <a href="{{ route('checkout') }}" class="btn btn--primary btn--block sum__pay">
                            {{ __('frontend.cart.go_pay') }}
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>

                        <p class="sum__trust">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                            <span>{{ __('frontend.cart.secure') }}</span>
                        </p>

                        <img class="sum__methods" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.cart.pay_alt') }}" loading="lazy">
                    </div>
                </div>
            </aside>
        </div>
    @else
        <div class="rs__hero ct__empty">
            <div class="ct__orb" aria-hidden="true">
                <span class="rs__wave"></span>
                <span class="rs__wave rs__wave--late"></span>
                <i class="fas fa-shopping-bag"></i>
            </div>
            <h2 class="rs__title">{{ __('frontend.cart.empty_head') }}</h2>
            <p class="rs__msg">{{ __('frontend.cart.empty_text') }}</p>
            <div class="rs__actions">
                <a href="{{ route('points.topup') }}" class="btn btn--primary">
                    <i class="fas fa-bolt" aria-hidden="true"></i>
                    {{ __('frontend.cart.none_buy') }}
                </a>
                <a href="{{ route('product-lists') }}" class="btn btn--ghost">
                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                    {{ __('frontend.cart.none_browse') }}
                </a>
            </div>
        </div>
    @endif
</section>
@endsection
