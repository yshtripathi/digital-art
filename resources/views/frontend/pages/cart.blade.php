@extends('frontend.layouts.main')
@section('title', __('frontend.cart.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.cart.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.cart.title')]
    ]
])

<section class="cr">
    <div class="cr__wrap">

        <ol class="cr-steps">
            <li class="cr-step is-current" aria-current="step">
                <span class="cr-step__dot">1</span>
                <span class="cr-step__label">{{ __('frontend.cart.step_cart') }}</span>
            </li>
            <li class="cr-step">
                <span class="cr-step__dot">2</span>
                <span class="cr-step__label">{{ __('frontend.cart.step_pay') }}</span>
            </li>
            <li class="cr-step">
                <span class="cr-step__dot">3</span>
                <span class="cr-step__label">{{ __('frontend.cart.step_done') }}</span>
            </li>
        </ol>

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

            <div class="cr-layout">
                <div class="cr-main">
                    <header class="cr-head">
                        <h2 class="cr-head__title">{{ __('frontend.cart.items_title') }}</h2>
                        <span class="cr-head__count">{{ trans_choice('frontend.cart.items', count($cartItems), ['count' => count($cartItems)]) }}</span>
                    </header>

                    <ul class="cr-list">
                        @foreach($cartItems as $cart)
                            @php
                                $item_title = __('frontend.cart.package');
                                $item_link = null;
                                $item_photo = null;
                                if($cart->product) {
                                    $item_title = $cart->product->title;
                                    $item_link = route('product-detail', $cart->product->slug);
                                    $item_photo = $cart->product->photo ? explode(',', $cart->product->photo)[0] : null;
                                }
                            @endphp

                            <li class="cr-item">
                                <span class="cr-item__media {{ $cart->product ? '' : 'cr-item__media--credits' }}">
                                    @if($item_photo)
                                        <img src="{{ asset(ltrim($item_photo, '/')) }}" alt="" loading="lazy">
                                    @elseif($cart->product)
                                        <i class="fas fa-book-open" aria-hidden="true"></i>
                                    @else
                                        <i class="fas fa-bolt" aria-hidden="true"></i>
                                    @endif
                                </span>

                                <div class="cr-item__body">
                                    <span class="cr-chip {{ $cart->product ? '' : 'cr-chip--accent' }}">
                                        {{ $cart->product ? __('frontend.cart.tag_material') : __('frontend.cart.tag_credits') }}
                                    </span>

                                    @if($item_link)
                                        <a href="{{ $item_link }}" class="cr-item__title">{{ $item_title }}</a>
                                    @else
                                        <span class="cr-item__title">{{ $item_title }}</span>
                                    @endif

                                    <span class="cr-item__meta">
                                        <i class="fas fa-bolt" aria-hidden="true"></i>
                                        {{ number_format($cart->points) }} {{ __('frontend.cart.credits') }}
                                    </span>
                                </div>

                                <div class="cr-item__end">
                                    <span class="cr-item__price">
                                        <small>{{ __('frontend.cart.amount') }}</small>
                                        <strong>{{ $sym }}{{ number_format($cart['price'], $dec) }}</strong>
                                    </span>
                                    <a href="{{ route('cart-delete', $cart->id) }}" class="cr-remove" aria-label="{{ __('frontend.cart.remove') }}: {{ $item_title }}">
                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                        <span>{{ __('frontend.cart.remove') }}</span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    @if(Helper::totalCartPoints() > 0)
                        <a href="{{ route('product-lists') }}" class="cr-back">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            <span>{{ __('frontend.cart.browse_all') }}</span>
                        </a>
                    @endif
                </div>

                <aside class="cr-side" aria-labelledby="crSummaryTitle">
                    <div class="cr-sum">
                        <h2 id="crSummaryTitle" class="cr-sum__title">{{ __('frontend.cart.summary') }}</h2>

                        <dl class="cr-sum__rows">
                            <div class="cr-sum__row">
                                <dt>{{ __('frontend.cart.credits') }}</dt>
                                <dd>{{ number_format($totalCredits) }}</dd>
                            </div>
                            @if($discount > 0)
                                <div class="cr-sum__row cr-sum__row--cut">
                                    <dt>{{ __('frontend.cart.discount') }}</dt>
                                    <dd>&minus; {{ $sym }}{{ number_format($discount, $dec) }}</dd>
                                </div>
                            @endif
                            <div class="cr-sum__row cr-sum__row--total">
                                <dt>{{ __('frontend.cart.total') }}</dt>
                                <dd>{{ $sym }}{{ number_format($total_amount, $dec) }}</dd>
                            </div>
                        </dl>

                        <a href="{{ route('checkout') }}" class="btn btn--primary btn--block cr-sum__cta">
                            <span>{{ __('frontend.cart.checkout') }}</span>
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>

                        <p class="cr-secure">
                            <i class="fas fa-lock" aria-hidden="true"></i>
                            <span>{{ __('frontend.cart.secure') }}</span>
                        </p>

                        <img class="cr-pay" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.cart.payments') }}" loading="lazy">
                    </div>
                </aside>
            </div>
        @else
            <div class="cr-empty">
                <span class="cr-empty__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <h2 class="cr-empty__title">{{ __('frontend.cart.empty_title') }}</h2>
                <p class="cr-empty__desc">{{ __('frontend.cart.empty_text') }}</p>
                <div class="cr-empty__actions">
                    <a href="{{ route('points.topup') }}" class="btn btn--primary">
                        <i class="fas fa-bolt" aria-hidden="true"></i>
                        <span>{{ __('frontend.cart.empty_credits') }}</span>
                    </a>
                    <a href="{{ route('product-lists') }}" class="btn btn--ghost">
                        <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                        <span>{{ __('frontend.cart.empty_materials') }}</span>
                    </a>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
