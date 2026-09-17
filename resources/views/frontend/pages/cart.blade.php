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

{{-- ==========================================================================
     Credit cart
     Single centred column: purchase steps, ticket rows,
     sticky summary bar.
     Styles: public/css/theme.css — section 18
     ========================================================================== --}}
<section class="bag">
    <div class="bag__wrap">

        <ol class="bag-steps">
            <li class="bag-step is-active">
                <span class="bag-step__no">1</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_cart') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">2</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_pay') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">3</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_done') }}</span>
            </li>
        </ol>

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

            <div class="bag-panel">
                <div class="bag-panel__head">
                    <h2 class="bag-panel__title">{{ __('frontend.cart.items_title') }}</h2>
                    <span class="bag-count">{{ trans_choice('frontend.cart.items', count($cartItems), ['count' => count($cartItems)]) }}</span>
                </div>

                @foreach($cartItems as $cart)
                    @php
                        $item_title = __('frontend.cart.package');
                        $item_link = '#';
                        $item_photo = null;
                        if($cart->product) {
                            $item_title = $cart->product->title;
                            $item_link = route('product-detail', $cart->product->slug);
                            $item_photo = $cart->product->photo ? explode(',', $cart->product->photo)[0] : null;
                        }
                    @endphp

                    <div class="bag-row">
                        <span class="bag-row__thumb {{ $cart->product ? '' : 'bag-row__thumb--credits' }}">
                            @if($item_photo)
                                <img src="{{ asset($item_photo) }}" alt="" loading="lazy">
                            @elseif($cart->product)
                                <i class="fas fa-book-open" aria-hidden="true"></i>
                            @else
                                <i class="fas fa-bolt" aria-hidden="true"></i>
                            @endif
                        </span>

                        <div class="bag-row__body">
                            <span class="badge {{ $cart->product ? '' : 'badge--brand' }}">
                                {{ $cart->product ? __('frontend.cart.tag_course') : __('frontend.cart.tag_credits') }}
                            </span>

                            @if($cart->product)
                                <a href="{{ $item_link }}" class="bag-row__title">{{ $item_title }}</a>
                            @else
                                <span class="bag-row__title">{{ $item_title }}</span>
                            @endif

                            <span class="bag-row__meta">
                                <span><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($cart->points) }} {{ __('frontend.cart.credits') }}</span>
                            </span>
                        </div>

                        <span class="bag-row__amount">
                            {{ $sym }}{{ number_format($cart['price'], $isJPY ? 0 : 2) }}
                            <small>{{ __('frontend.cart.amount') }}</small>
                        </span>

                        <a href="{{ route('cart-delete', $cart->id) }}" class="bag-row__remove" aria-label="{{ __('frontend.cart.remove') }}: {{ $item_title }}">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i><span>{{ __('frontend.cart.remove') }}</span>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="bag-bar">
                <div class="bag-bar__figures">
                    <span class="bag-bar__label">{{ __('frontend.cart.total') }}:</span>
                    <span class="bag-bar__total">{{ $sym }}{{ number_format($total_amount, $isJPY ? 0 : 2) }}</span>
                    @if($discount > 0)
                        <span class="bag-bar__cut">&minus; {{ $sym }}{{ number_format($discount, $isJPY ? 0 : 2) }} {{ __('frontend.cart.discount') }}</span>
                    @endif
                </div>

                <div class="bag-bar__actions">
                    @if(Helper::totalCartPoints() > 0)
                        <a href="{{ route('product-lists') }}" class="bag-btn bag-btn--ghost">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i> {{ __('frontend.cart.browse') }}
                        </a>
                    @endif
                    <a href="{{ route('checkout') }}" class="bag-btn bag-btn--primary">
                        {{ __('frontend.cart.checkout') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            <div class="bag-foot">
                <p class="bag-foot__trust"><i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.cart.secure') }}</p>
                <img class="bag-foot__pay" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.cart.payments') }}" loading="lazy">
            </div>
        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.cart.empty_title') }}</h2>
                <p class="bag-empty__desc">{{ __('frontend.cart.empty_desc') }}</p>
                <div class="bag-empty__actions">
                    <a href="{{ route('product-lists') }}" class="bag-btn bag-btn--ghost">
                        <i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ __('frontend.cart.empty_courses') }}
                    </a>
                    <a href="{{ route('points.topup') }}" class="bag-btn bag-btn--primary">
                        <i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.cart.empty_credits') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
