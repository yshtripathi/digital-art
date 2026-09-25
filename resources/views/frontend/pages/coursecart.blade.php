@extends('frontend.layouts.main')
@section('title', __('frontend.coursecart.name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.coursecart.name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.coursecart.name')]
    ]
])

<section class="cr">
    <div class="cr__wrap">

        <ol class="steps">
            <li class="steps__item is-active" aria-current="step">
                <span class="steps__no">1</span>
                <span class="steps__label">{{ __('frontend.coursecart.step_cart') }}</span>
            </li>
            <li class="steps__line" aria-hidden="true"></li>
            <li class="steps__item">
                <span class="steps__no">2</span>
                <span class="steps__label">{{ __('frontend.coursecart.step_unlock') }}</span>
            </li>
            <li class="steps__line" aria-hidden="true"></li>
            <li class="steps__item">
                <span class="steps__no">3</span>
                <span class="steps__label">{{ __('frontend.coursecart.step_learn') }}</span>
            </li>
        </ol>

        @auth
            @php
                $user = auth()->user();
                $points = $user->points_balance ?? 0;
                $cartItems = Helper::cartCount() ? Helper::getAllProductFromCart()->where('order_id', null) : collect();
                $itemCount = $cartItems->count();
                $total_points = $itemCount ? Helper::totalCartPoints() : 0;
                $coverage = $total_points > 0 ? min(100, round(($points / $total_points) * 100)) : 100;
                $enough = $points >= $total_points;
                $after = $points - $total_points;
                $sym = Helper::getCurrencySymbol(session('currency'));
                $dec = session('currency') == 'JPY' ? 0 : 2;
            @endphp

            @if($itemCount)
                <div class="cr-layout">
                    <div class="cr-main">
                        @if(!$enough)
                            <p class="cr-alert" role="status">
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                <span>{{ __('frontend.coursecart.low') }}</span>
                            </p>
                        @endif

                        <header class="cr-head">
                            <h2 class="cr-head__title">{{ __('frontend.coursecart.items_head') }}</h2>
                            <span class="cr-head__count">{{ trans_choice('frontend.coursecart.items', $itemCount, ['count' => $itemCount]) }}</span>
                        </header>

                        <ul class="cr-list">
                            @foreach($cartItems as $cart)
                                @php
                                    $item_title = __('frontend.coursecart.package');
                                    $item_photo = null;
                                    $item_link = null;
                                    $is_course = false;
                                    $level = null;

                                    if($cart->product) {
                                        $item_title = $cart->product->title;
                                        $item_link = route('product-detail', $cart->product->slug);
                                        $photo_arr = explode(',', $cart->product->photo ?? '');
                                        $item_photo = $photo_arr[0] ?: null;

                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                         ->where('price_in_points', $cart->points)
                                                         ->first();
                                        }
                                    }

                                    $lvl_key = $level ? 'frontend.coursecart.levels.' . strtolower($level->skill_level) : null;
                                    $lvl_label = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                                @endphp

                                <li class="cr-item">
                                    <span class="cr-item__media {{ $is_course ? '' : 'cr-item__media--credits' }}">
                                        @if($item_photo)
                                            <img src="{{ asset(ltrim($item_photo, '/')) }}" alt="" loading="lazy">
                                        @elseif($is_course)
                                            <i class="fas fa-book-open" aria-hidden="true"></i>
                                        @else
                                            <i class="fas fa-bolt" aria-hidden="true"></i>
                                        @endif
                                    </span>

                                    <div class="cr-item__body">
                                        @if($is_course)
                                            @if($lvl_label)
                                                <span class="cr-chip"><i class="fas fa-signal" aria-hidden="true"></i> {{ $lvl_label }}</span>
                                            @endif
                                        @else
                                            <span class="cr-chip cr-chip--accent">{{ __('frontend.coursecart.package') }}</span>
                                        @endif

                                        @if($item_link)
                                            <a href="{{ $item_link }}" class="cr-item__title">{{ $item_title }}</a>
                                        @else
                                            <span class="cr-item__title">{{ $item_title }}</span>
                                        @endif

                                        @if(!$is_course)
                                            <span class="cr-item__meta">
                                                {{ __('frontend.coursecart.amount') }}: {{ $sym }}{{ number_format($cart['price'], $dec) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="cr-item__end">
                                        <span class="cr-item__price">
                                            <small>{{ __('frontend.coursecart.price') }}</small>
                                            <strong><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($cart->points) }}</strong>
                                        </span>
                                        <a href="{{ route('cart-delete', $cart->id) }}" class="cr-remove" aria-label="{{ __('frontend.coursecart.remove') }}: {{ $item_title }}">
                                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                            <span>{{ __('frontend.coursecart.remove') }}</span>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('product-lists') }}" class="cr-back">
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.browse_more') }}</span>
                        </a>
                    </div>

                    <aside class="cr-side" aria-labelledby="crSummaryTitle">
                        <div class="cr-wallet band--indigo">
                            <span class="cr-wallet__label">{{ __('frontend.coursecart.balance') }}</span>
                            <span class="cr-wallet__amount">
                                <i class="fas fa-bolt" aria-hidden="true"></i>
                                <strong>{{ number_format($points) }}</strong>
                                <small>{{ __('frontend.coursecart.credits') }}</small>
                            </span>
                            <div class="cr-meter" role="img" aria-label="{{ __('frontend.coursecart.coverage') }}: {{ $coverage }}%">
                                <span class="cr-meter__fill {{ $enough ? '' : 'is-short' }}" style="width: {{ $coverage }}%"></span>
                            </div>
                            <span class="cr-wallet__note">{{ __('frontend.coursecart.coverage') }}: {{ $coverage }}%</span>
                            <a href="{{ route('points.topup') }}" class="cr-wallet__topup">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                                <span>{{ __('frontend.coursecart.buy') }}</span>
                            </a>
                        </div>

                        <div class="cr-sum band--coffee">
                            <h2 id="crSummaryTitle" class="cr-sum__title">{{ __('frontend.coursecart.summary') }}</h2>

                            <dl class="cr-sum__rows">
                                <div class="cr-sum__row">
                                    <dt>{{ __('frontend.coursecart.balance') }}</dt>
                                    <dd>{{ number_format($points) }}</dd>
                                </div>
                                <div class="cr-sum__row cr-sum__row--total">
                                    <dt>{{ __('frontend.coursecart.total') }}</dt>
                                    <dd>{{ number_format($total_points) }} <small>{{ __('frontend.coursecart.credits') }}</small></dd>
                                </div>
                                @if($enough)
                                    <div class="cr-sum__row cr-sum__row--after">
                                        <dt>{{ __('frontend.coursecart.after') }}</dt>
                                        <dd>{{ number_format($after) }}</dd>
                                    </div>
                                @endif
                            </dl>

                            <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>

                            @if($enough)
                                <button type="submit" form="redeemPointsForm" class="btn btn--primary btn--block cr-sum__cta">
                                    <i class="fas fa-lock-open" aria-hidden="true"></i>
                                    <span>{{ __('frontend.coursecart.unlock') }}</span>
                                </button>
                            @else
                                <a href="{{ route('points.topup') }}" class="btn btn--primary btn--block cr-sum__cta">
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                    <span>{{ __('frontend.coursecart.buy') }}</span>
                                </a>
                            @endif
                        </div>
                    </aside>
                </div>
            @else
                <div class="cr-empty">
                    <span class="cr-empty__icon" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                    <h2 class="cr-empty__title">{{ __('frontend.coursecart.empty_head') }}</h2>
                    <p class="cr-empty__desc">{{ __('frontend.coursecart.empty_text') }}</p>
                    <div class="cr-empty__balance">
                        <span>{{ __('frontend.coursecart.balance') }}</span>
                        <strong><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($points) }} {{ __('frontend.coursecart.credits') }}</strong>
                    </div>
                    <div class="cr-empty__actions">
                        <a href="{{ route('product-lists') }}" class="btn btn--primary">
                            <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.empty_link') }}</span>
                        </a>
                        <a href="{{ route('points.topup') }}" class="btn btn--ghost">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.buy') }}</span>
                        </a>
                    </div>
                </div>
            @endif
        @else
            <div class="cr-empty">
                <span class="cr-empty__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                <h2 class="cr-empty__title">{{ __('frontend.coursecart.auth_head') }}</h2>
                <p class="cr-empty__desc">{{ __('frontend.coursecart.auth_text') }}</p>
                <div class="cr-empty__actions">
                    <a href="{{ route('login.form') }}" class="btn btn--primary">
                        <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.coursecart.login') }}</span>
                    </a>
                    <a href="{{ route('register.form') }}" class="btn btn--ghost">
                        <i class="fas fa-user-plus" aria-hidden="true"></i>
                        <span>{{ __('frontend.coursecart.register') }}</span>
                    </a>
                </div>
            </div>
        @endauth

    </div>
</section>
@endsection
