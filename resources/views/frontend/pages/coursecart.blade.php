@extends('frontend.layouts.main')
@section('title', __('frontend.coursecart.page_name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.coursecart.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.coursecart.page_name')]
    ]
])

<section class="ct">
    <div class="ct__wrap">

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
                <header class="ct__top">
                    <div>
                        <p class="eyebrow">{{ trans_choice('frontend.coursecart.item_count', $itemCount, ['count' => $itemCount]) }}</p>
                        <h2 class="ct__heading">{{ __('frontend.coursecart.list_title') }}</h2>
                    </div>
                    <a href="{{ route('product-lists') }}" class="ct__back">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        <span>{{ __('frontend.coursecart.browse') }}</span>
                    </a>
                </header>

                <ul class="ct__grid">
                    @foreach($cartItems as $cart)
                        @php
                            $item_title = __('frontend.coursecart.pack');
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

                            $lvl_key = $level ? 'frontend.coursecart.level_names.' . strtolower($level->skill_level) : null;
                            $lvl_label = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                        @endphp

                        <li class="tile">
                            <div class="tile__media {{ $is_course ? '' : 'tile__media--credits' }}">
                                @if($item_photo)
                                    <img src="{{ asset(ltrim($item_photo, '/')) }}" alt="" loading="lazy">
                                @elseif($is_course)
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @else
                                    <span class="tile__amount">
                                        <strong class="num">{{ number_format($cart->points) }}</strong>
                                        <small>{{ __('frontend.coursecart.unit') }}</small>
                                    </span>
                                @endif

                                @if($is_course)
                                    @if($lvl_label)
                                        <span class="tile__chip"><i class="fas fa-signal" aria-hidden="true"></i> {{ $lvl_label }}</span>
                                    @endif
                                @else
                                    <span class="tile__chip tile__chip--accent">{{ __('frontend.coursecart.pack') }}</span>
                                @endif

                                <a href="{{ route('cart-delete', $cart->id) }}" class="tile__drop" aria-label="{{ __('frontend.coursecart.drop') }}: {{ $item_title }}">
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
                                    @if(!$is_course)
                                        {{ __('frontend.coursecart.col_amount') }}: {{ $sym }}{{ number_format($cart['price'], $dec) }}
                                    @else
                                        {{ __('frontend.coursecart.col_price') }}
                                    @endif
                                </span>
                                <strong class="tile__price"><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($cart->points) }}</strong>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="ct-wallet {{ $enough ? '' : 'is-short' }}">
                    <dl class="ct-wallet__stats">
                        <div class="ct-wallet__stat">
                            <dt>{{ __('frontend.coursecart.wallet') }}</dt>
                            <dd><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($points) }}</dd>
                        </div>
                        <div class="ct-wallet__stat">
                            <dt>{{ __('frontend.coursecart.need') }}</dt>
                            <dd>{{ number_format($total_points) }}</dd>
                        </div>
                        @if($enough)
                            <div class="ct-wallet__stat ct-wallet__stat--after">
                                <dt>{{ __('frontend.coursecart.left') }}</dt>
                                <dd>{{ number_format($after) }}</dd>
                            </div>
                        @endif
                    </dl>

                    <div class="ct-wallet__meter">
                        <div class="ct-wallet__track" role="img" aria-label="{{ __('frontend.coursecart.used') }}: {{ $coverage }}%">
                            <span class="ct-wallet__fill" style="width: {{ $coverage }}%"></span>
                        </div>
                        <div class="ct-wallet__row">
                            <span>{{ __('frontend.coursecart.used') }}: <strong>{{ $coverage }}%</strong></span>
                            <a href="{{ route('points.topup') }}" class="ct-wallet__topup">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                                <span>{{ __('frontend.coursecart.go_buy') }}</span>
                            </a>
                        </div>
                    </div>

                    @if(!$enough)
                        <p class="ct-wallet__alert" role="status">
                            <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.short') }}</span>
                        </p>
                    @endif
                </div>

                <div class="ct-bar" aria-labelledby="ctBarTitle">
                    <h2 id="ctBarTitle" class="ct-bar__title">{{ __('frontend.coursecart.sum_title') }}</h2>
                    <dl class="ct-bar__stats">
                        <div class="ct-bar__stat">
                            <dt>{{ __('frontend.coursecart.wallet') }}</dt>
                            <dd><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($points) }}</dd>
                        </div>
                        <div class="ct-bar__stat ct-bar__stat--total">
                            <dt>{{ __('frontend.coursecart.need') }}</dt>
                            <dd>{{ number_format($total_points) }} <small>{{ __('frontend.coursecart.unit') }}</small></dd>
                        </div>
                    </dl>

                    <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>

                    @if($enough)
                        <button type="submit" form="redeemPointsForm" class="btn btn--primary ct-bar__cta">
                            <i class="fas fa-lock-open" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.go_unlock') }}</span>
                        </button>
                    @else
                        <a href="{{ route('points.topup') }}" class="btn btn--primary ct-bar__cta">
                            <i class="fas fa-bolt" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.go_buy') }}</span>
                        </a>
                    @endif
                </div>
            @else
                <div class="ct-empty">
                    <div class="ct-empty__slots" aria-hidden="true">
                        <span></span><span></span><span></span>
                    </div>
                    <span class="ct-empty__icon" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                    <h2 class="ct-empty__title">{{ __('frontend.coursecart.none_title') }}</h2>
                    <p class="ct-empty__desc">{{ __('frontend.coursecart.none_text') }}</p>
                    <p class="ct-empty__balance">
                        <span>{{ __('frontend.coursecart.wallet') }}</span>
                        <strong><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($points) }} {{ __('frontend.coursecart.unit') }}</strong>
                    </p>
                    <div class="ct-empty__actions">
                        <a href="{{ route('product-lists') }}" class="btn btn--primary">
                            <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.none_browse') }}</span>
                        </a>
                        <a href="{{ route('points.topup') }}" class="btn btn--secondary">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.go_buy') }}</span>
                        </a>
                    </div>
                </div>
            @endif
        @else
            <div class="ct-empty">
                <div class="ct-empty__slots" aria-hidden="true">
                    <span></span><span></span><span></span>
                </div>
                <span class="ct-empty__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                <h2 class="ct-empty__title">{{ __('frontend.coursecart.guest_title') }}</h2>
                <p class="ct-empty__desc">{{ __('frontend.coursecart.guest_text') }}</p>
                <div class="ct-empty__actions">
                    <a href="{{ route('login.form') }}" class="btn btn--primary">
                        <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.coursecart.guest_login') }}</span>
                    </a>
                    <a href="{{ route('register.form') }}" class="btn btn--secondary">
                        <i class="fas fa-user-plus" aria-hidden="true"></i>
                        <span>{{ __('frontend.coursecart.guest_join') }}</span>
                    </a>
                </div>
            </div>
        @endauth

    </div>
</section>
@endsection
