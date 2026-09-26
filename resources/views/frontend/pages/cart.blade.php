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
    <div class="ct__wrap">

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

            <header class="ct__top">
                <div>
                    <p class="eyebrow">{{ trans_choice('frontend.cart.item_count', count($cartItems), ['count' => count($cartItems)]) }}</p>
                    <h2 class="ct__heading">{{ __('frontend.cart.list_title') }}</h2>
                </div>
                @if(Helper::totalCartPoints() > 0)
                    <a href="{{ route('product-lists') }}" class="ct__back">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        <span>{{ __('frontend.cart.browse') }}</span>
                    </a>
                @endif
            </header>

            <ul class="ct__grid">
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

                    <li class="tile">
                        <div class="tile__media {{ $cart->product ? '' : 'tile__media--credits' }}">
                            @if($item_photo)
                                <img src="{{ asset(ltrim($item_photo, '/')) }}" alt="" loading="lazy">
                            @elseif($cart->product)
                                <i class="fas fa-book-open" aria-hidden="true"></i>
                            @else
                                <span class="tile__amount">
                                    <strong class="num">{{ number_format($cart->points) }}</strong>
                                    <small>{{ __('frontend.cart.col_credits') }}</small>
                                </span>
                            @endif

                            <span class="tile__chip {{ $cart->product ? '' : 'tile__chip--accent' }}">
                                {{ $cart->product ? __('frontend.cart.chip_material') : __('frontend.cart.chip_credits') }}
                            </span>

                            <a href="{{ route('cart-delete', $cart->id) }}" class="tile__drop" aria-label="{{ __('frontend.cart.drop') }}: {{ $item_title }}">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </a>
                        </div>

                        <div class="tile__body">
                            @if($item_link)
                                <a href="{{ $item_link }}" class="tile__title">{{ $item_title }}</a>
                            @else
                                <span class="tile__title">{{ $item_title }}</span>
                            @endif
                        </div>

                        <div class="tile__foot">
                            <span class="tile__meta">
                                <i class="fas fa-bolt" aria-hidden="true"></i>
                                {{ number_format($cart->points) }} {{ __('frontend.cart.col_credits') }}
                            </span>
                            <strong class="tile__price">{{ $sym }}{{ number_format($cart['price'], $dec) }}</strong>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="ct-bar" aria-labelledby="ctBarTitle">
                <h2 id="ctBarTitle" class="ct-bar__title">{{ __('frontend.cart.sum_title') }}</h2>
                <dl class="ct-bar__stats">
                    <div class="ct-bar__stat">
                        <dt>{{ __('frontend.cart.col_credits') }}</dt>
                        <dd><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($totalCredits) }}</dd>
                    </div>
                    @if($discount > 0)
                        <div class="ct-bar__stat">
                            <dt>{{ __('frontend.cart.sum_discount') }}</dt>
                            <dd>&minus; {{ $sym }}{{ number_format($discount, $dec) }}</dd>
                        </div>
                    @endif
                    <div class="ct-bar__stat ct-bar__stat--total">
                        <dt>{{ __('frontend.cart.sum_total') }}</dt>
                        <dd>{{ $sym }}{{ number_format($total_amount, $dec) }}</dd>
                    </div>
                </dl>
                <a href="{{ route('checkout') }}" class="btn btn--primary ct-bar__cta">
                    <span>{{ __('frontend.cart.go_pay') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            <div class="ct__trust">
                <p>
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <span>{{ __('frontend.cart.secure_note') }}</span>
                </p>
                <img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.cart.pay_alt') }}" loading="lazy">
            </div>
        @else
            <div class="ct-empty">
                <div class="ct-empty__slots" aria-hidden="true">
                    <span></span><span></span><span></span>
                </div>
                <span class="ct-empty__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <h2 class="ct-empty__title">{{ __('frontend.cart.none_title') }}</h2>
                <p class="ct-empty__desc">{{ __('frontend.cart.none_text') }}</p>
                <div class="ct-empty__actions">
                    <a href="{{ route('points.topup') }}" class="btn btn--primary">
                        <i class="fas fa-bolt" aria-hidden="true"></i>
                        <span>{{ __('frontend.cart.none_buy') }}</span>
                    </a>
                    <a href="{{ route('product-lists') }}" class="btn btn--secondary">
                        <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                        <span>{{ __('frontend.cart.none_browse') }}</span>
                    </a>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
