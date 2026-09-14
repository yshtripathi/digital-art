@extends('frontend.layouts.main')
@section('title', __('frontend.coursecart.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.coursecart.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.coursecart.title')]
    ]
])

<section class="cp cc">
    <div class="cp__wrap">

        @auth
            @php
                $user = auth()->user();
                $points = $user->points_balance ?? 0;
                $cartItems = Helper::cartCount() ? Helper::getAllProductFromCart()->where('order_id', null) : collect();
                $itemCount = $cartItems->count();
            @endphp

            {{-- Credits balance --}}
            <div class="cc-balance">
                <span class="cc-balance__icon" aria-hidden="true"><i class="fas fa-coins"></i></span>
                <div class="cc-balance__text">
                    <span class="cc-balance__label">{{ __('frontend.coursecart.balance') }}</span>
                    <span class="cc-balance__amt">{{ number_format($points) }} <small>{{ __('frontend.coursecart.credits') }}</small></span>
                </div>
                <a href="{{ route('points.topup') }}" class="cp-btn cp-btn--lime cc-balance__btn">
                    <i class="fas fa-plus"></i> {{ __('frontend.coursecart.buy') }}
                </a>
            </div>

            @if($itemCount)
                @php
                    $total_points = Helper::totalCartPoints();
                    $remaining = $points - $total_points;
                    $coverage = $points > 0 ? min(100, round($total_points / $points * 100)) : 100;
                @endphp

                <div class="cp__grid">

                    {{-- Items --}}
                    <div class="cp-items">
                        <div class="cp-items__head">
                            <h2 class="cp-items__title">{{ __('frontend.coursecart.items_title') }}</h2>
                            <span class="cp-count">{{ trans_choice('frontend.coursecart.items', $itemCount, ['count' => $itemCount]) }}</span>
                        </div>

                        <ul class="cp-list">
                            @foreach($cartItems as $cart)
                                @php
                                    $item_title = __('frontend.coursecart.package');
                                    $item_photo = null;
                                    $item_link = '#';
                                    $is_course = false;
                                    $level = null;

                                    if($cart->product) {
                                        $item_title = $cart->product->title;
                                        $item_link = route('product-detail', $cart->product->slug);
                                        $photo_arr = explode(',', $cart->product->photo ?? '');
                                        $item_photo = $photo_arr[0] ?? null;

                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                         ->where('price_in_points', $cart->points)
                                                         ->first();
                                        }
                                    }

                                    $lvl_slug = $level ? strtolower($level->skill_level) : '';
                                    $lvl_key = 'frontend.coursecart.levels.' . $lvl_slug;
                                    $lvl_label = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                                @endphp

                                <li class="cp-item">
                                    <div class="cp-item__thumb {{ $is_course ? '' : 'cp-item__thumb--credits' }}">
                                        @if($item_photo)
                                            <img src="{{ asset($item_photo) }}" alt="" loading="lazy">
                                        @elseif($is_course)
                                            <i class="fas fa-book-open"></i>
                                        @else
                                            <i class="fas fa-coins"></i>
                                        @endif
                                    </div>

                                    <div class="cp-item__body">
                                        @if($is_course)
                                            @if($lvl_label)
                                                <span class="cp-tag cc-level cc-level--{{ $lvl_slug }}">
                                                    <i class="fas fa-signal"></i> {{ $lvl_label }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="cp-tag cp-tag--credit"><i class="fas fa-gift"></i> {{ __('frontend.coursecart.package') }}</span>
                                        @endif

                                        @if($cart->product)
                                            <a href="{{ $item_link }}" class="cp-item__title">{{ $item_title }}</a>
                                        @else
                                            <span class="cp-item__title">{{ $item_title }}</span>
                                        @endif

                                        <div class="cp-item__meta">
                                            @if($is_course)
                                                <span class="cp-meta">
                                                    <span class="cp-meta__label">{{ __('frontend.coursecart.price') }}</span>
                                                    <span class="cp-meta__value"><i class="fas fa-coins"></i> {{ number_format($cart->points) }}</span>
                                                </span>
                                            @else
                                                <span class="cp-meta">
                                                    <span class="cp-meta__label">{{ __('frontend.coursecart.amount') }}</span>
                                                    <span class="cp-meta__value">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                                </span>
                                                <span class="cp-meta">
                                                    <span class="cp-meta__value"><i class="fas fa-coins"></i> {{ number_format($cart->points) }} {{ __('frontend.coursecart.credits') }}</span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ route('cart-delete', $cart->id) }}" class="cp-item__remove" aria-label="{{ __('frontend.coursecart.remove') }}: {{ $item_title }}">
                                        <i class="fas fa-trash-alt"></i><span>{{ __('frontend.coursecart.remove') }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Summary --}}
                    <aside class="cp-summary">
                        <h2 class="cp-summary__title"><i class="fas fa-receipt"></i> {{ __('frontend.coursecart.summary') }}</h2>

                        <div class="cp-summary__rows">
                            <div class="cp-summary__row">
                                <span>{{ __('frontend.coursecart.item_count') }}</span>
                                <span>{{ $itemCount }}</span>
                            </div>
                            <div class="cp-summary__row">
                                <span>{{ __('frontend.coursecart.balance') }}</span>
                                <span>{{ number_format($points) }}</span>
                            </div>
                        </div>

                        <div class="cp-summary__total">
                            <span>{{ __('frontend.coursecart.total') }}:</span>
                            <strong>{{ number_format($total_points) }} <small class="cc-unit">{{ __('frontend.coursecart.credits') }}</small></strong>
                        </div>

                        <div class="cc-coverage {{ $remaining < 0 ? 'is-low' : '' }}">
                            <div class="cc-coverage__head">
                                <span>{{ __('frontend.coursecart.coverage') }}</span>
                                <span>{{ $coverage }}%</span>
                            </div>
                            <div class="cc-coverage__bar"><span style="width: {{ $coverage }}%"></span></div>
                            <div class="cc-coverage__after">
                                <span>{{ __('frontend.coursecart.after') }}</span>
                                <strong>{{ number_format($remaining) }}</strong>
                            </div>
                            @if($remaining < 0)
                                <p class="cc-coverage__warn">
                                    <i class="fas fa-exclamation-triangle"></i> {{ __('frontend.coursecart.low') }}
                                    <a href="{{ route('points.topup') }}">{{ __('frontend.coursecart.buy') }}</a>
                                </p>
                            @endif
                        </div>

                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>
                        <button type="button" class="cp-btn cp-btn--lime cc-redeem" onclick="document.getElementById('redeemPointsForm').submit();">
                            <i class="fas fa-lock"></i> {{ __('frontend.coursecart.unlock') }}
                        </button>
                        <a href="{{ route('product-lists') }}" class="cp-btn cp-btn--outline">
                            <i class="fas fa-plus"></i> {{ __('frontend.coursecart.browse') }}
                        </a>
                    </aside>
                </div>
            @else
                <div class="cp-empty">
                    <div class="cp-empty__art" aria-hidden="true">
                        <span class="cp-empty__ring"></span>
                        <span class="cp-empty__icon"><i class="fas fa-graduation-cap"></i></span>
                        <span class="cp-empty__dot cp-empty__dot--1"></span>
                        <span class="cp-empty__dot cp-empty__dot--2"></span>
                        <span class="cp-empty__dot cp-empty__dot--3"></span>
                    </div>
                    <h2 class="cp-empty__title">{{ __('frontend.coursecart.empty_title') }}</h2>
                    <p class="cp-empty__desc">{{ __('frontend.coursecart.empty_desc') }}</p>
                    <div class="cp-empty__actions">
                        <a href="{{ route('product-lists') }}" class="cp-btn cp-btn--dark">
                            <i class="fas fa-graduation-cap"></i> {{ __('frontend.coursecart.empty_btn') }}
                        </a>
                    </div>
                </div>
            @endif

        @else
            <div class="cp-empty">
                <div class="cp-empty__art" aria-hidden="true">
                    <span class="cp-empty__ring"></span>
                    <span class="cp-empty__icon cc-lock"><i class="fas fa-lock"></i></span>
                    <span class="cp-empty__dot cp-empty__dot--1"></span>
                    <span class="cp-empty__dot cp-empty__dot--2"></span>
                    <span class="cp-empty__dot cp-empty__dot--3"></span>
                </div>
                <h2 class="cp-empty__title">{{ __('frontend.coursecart.auth_title') }}</h2>
                <p class="cp-empty__desc">{{ __('frontend.coursecart.auth_desc') }}</p>
                <div class="cp-empty__actions">
                    <a href="{{ route('login.form') }}" class="cp-btn cp-btn--lime">
                        <i class="fas fa-sign-in-alt"></i> {{ __('frontend.coursecart.login') }}
                    </a>
                    <a href="{{ route('register.form') }}" class="cp-btn cp-btn--dark">
                        <i class="fas fa-user-plus"></i> {{ __('frontend.coursecart.register') }}
                    </a>
                </div>
            </div>
        @endauth

    </div>
</section>
@endsection
