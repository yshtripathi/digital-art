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
            @endphp

            <div class="bag">
                <div class="bag__head">
                    <h2 class="bag__title">{{ __('frontend.cart.selected') }}</h2>
                    <span class="bag__count">{{ trans_choice('frontend.cart.items', count($cartItems), ['count' => count($cartItems)]) }}</span>
                </div>

                <ul class="bag__list">
                    @foreach($cartItems as $cart)
                        @php
                            $item_title = $cart->product ? $cart->product->title : __('frontend.cart.package');
                        @endphp
                        <li class="bag-item" style="--i: {{ $loop->index }}">
                            <span class="bag-item__icon" aria-hidden="true"><i class="fas {{ $cart->product ? 'fa-book-open' : 'fa-coins' }}"></i></span>
                            <div class="bag-item__info">
                                <span class="bag-item__name">{{ $item_title }}</span>
                                <span class="bag-item__meta">{{ number_format($cart->points) }} {{ __('frontend.cart.col_credits') }}</span>
                            </div>
                            <strong class="bag-item__price">{{ $sym }}{{ number_format($cart['price'], $dec) }}</strong>
                            <a href="{{ route('cart-delete', $cart->id) }}" class="bag-item__drop" aria-label="{{ __('frontend.cart.remove') }}: {{ $item_title }}">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="bag__sum">
                    <p class="bag__row">
                        <span>{{ __('frontend.cart.col_credits') }}</span>
                        <span>{{ number_format($totalCredits) }}</span>
                    </p>
                    @if($discount > 0)
                        <p class="bag__row">
                            <span>{{ __('frontend.cart.discount') }}</span>
                            <span>&minus; {{ $sym }}{{ number_format($discount, $dec) }}</span>
                        </p>
                    @endif
                    <p class="bag__row bag__row--total">
                        <span>{{ __('frontend.cart.total') }}</span>
                        <strong>{{ $sym }}{{ number_format($total_amount, $dec) }}</strong>
                    </p>
                </div>

                <div class="bag__acts">
                    <a href="{{ route('checkout') }}" class="btn btn--primary">{{ __('frontend.cart.checkout') }}</a>
                    <a href="{{ route('points.topup') }}" class="btn btn--ghost">{{ __('frontend.cart.buy_credits') }}</a>
                </div>
            </div>
        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.cart.empty_title') }}</h2>
                <p class="bag-empty__text">{{ __('frontend.cart.empty_text') }}</p>
                <div class="bag-empty__acts">
                    <a href="{{ route('points.topup') }}" class="btn btn--primary">{{ __('frontend.cart.buy_credits') }}</a>
                    <a href="{{ route('product-lists') }}" class="btn btn--ghost">{{ __('frontend.cart.browse') }}</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
