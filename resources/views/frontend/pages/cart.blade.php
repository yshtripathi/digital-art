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

<section class="basket">
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

        <div class="basket__grid">
            <div class="basket__main">
                <div class="basket__head">
                    <div>
                        <h2 class="basket__title">{{ __('frontend.cart.picked') }}</h2>
                        <span class="basket__count">{{ trans_choice('frontend.cart.item_count', count($cartItems), ['count' => count($cartItems)]) }}</span>
                    </div>
                    @if(Helper::totalCartPoints() > 0)
                        <a href="{{ route('product-lists') }}" class="basket__more">
                            {{ __('frontend.cart.more') }}
                            <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>

                <ul class="stubs">
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

                        <li class="stub" style="--i: {{ $loop->index }}">
                            <span class="stub__media {{ $cart->product ? '' : 'stub__media--credits' }}">
                                @if($item_photo)
                                    <img src="{{ asset(ltrim($item_photo, '/')) }}" alt="" loading="lazy">
                                @elseif($cart->product)
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @else
                                    <i class="fas fa-coins" aria-hidden="true"></i>
                                @endif
                            </span>

                            <div class="stub__body">
                                <span class="stub__tag">{{ $cart->product ? __('frontend.cart.chip_material') : __('frontend.cart.chip_credits') }}</span>
                                @if($item_link)
                                    <a href="{{ $item_link }}" class="stub__title">{{ $item_title }}</a>
                                @else
                                    <span class="stub__title">{{ $item_title }}</span>
                                @endif
                                <span class="stub__meta">
                                    <i class="fas fa-coins" aria-hidden="true"></i>
                                    {{ number_format($cart->points) }} {{ __('frontend.cart.col_credits') }}
                                </span>
                            </div>

                            <div class="stub__side">
                                <strong class="stub__price">{{ $sym }}{{ number_format($cart['price'], $dec) }}</strong>
                                <a href="{{ route('cart-delete', $cart->id) }}" class="stub__drop" aria-label="{{ __('frontend.cart.drop') }}: {{ $item_title }}">
                                    <i class="far fa-trash-alt" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <aside class="sumup">
                <p class="sumup__caption">{{ __('frontend.cart.summary') }}</p>

                <dl class="sumup__rows">
                    <div class="sumup__row">
                        <dt>{{ __('frontend.cart.col_credits') }}:</dt>
                        <dd><i class="fas fa-coins" aria-hidden="true"></i> {{ number_format($totalCredits) }}</dd>
                    </div>
                    @if($discount > 0)
                        <div class="sumup__row sumup__row--off">
                            <dt>{{ __('frontend.cart.sum_discount') }}:</dt>
                            <dd>&minus; {{ $sym }}{{ number_format($discount, $dec) }}</dd>
                        </div>
                    @endif
                </dl>

                <div class="sumup__total">
                    <span>{{ __('frontend.cart.sum_total') }}:</span>
                    <strong>{{ $sym }}{{ number_format($total_amount, $dec) }}</strong>
                </div>

                <a href="{{ route('checkout') }}" class="btn btn--block sumup__go">
                    <span>{{ __('frontend.cart.go_pay') }}</span>
                    <span class="sumup__go-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                </a>
                <a href="{{ route('points.topup') }}" class="btn btn--outline btn--block">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                    {{ __('frontend.cart.none_buy') }}
                </a>

                <div class="sumup__trust">
                    <p><i class="fas fa-lock" aria-hidden="true"></i> <span>{{ __('frontend.cart.secure') }}</span></p>
                    <img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.cart.pay_alt') }}" loading="lazy">
                </div>
            </aside>
        </div>
    @else
        <div class="dropzone">
            <span class="dropzone__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
            <h2 class="dropzone__title">{{ __('frontend.cart.empty_head') }}</h2>
            <p class="dropzone__text">{{ __('frontend.cart.empty_text') }}</p>
            <div class="dropzone__acts">
                <a href="{{ route('points.topup') }}" class="btn">
                    <i class="fas fa-coins" aria-hidden="true"></i>
                    {{ __('frontend.cart.none_buy') }}
                </a>
                <a href="{{ route('product-lists') }}" class="btn btn--outline">
                    <i class="fas fa-book-open" aria-hidden="true"></i>
                    {{ __('frontend.cart.none_browse') }}
                </a>
            </div>
        </div>
    @endif
</section>
@endsection
