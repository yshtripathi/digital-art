@extends('frontend.layouts.main')
@section('title', __('frontend.coursecart.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.coursecart.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.coursecart.title')]
    ]
])

<section class="pay">
    <div class="container">
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
                $levelSteps = ['beginner' => 1, 'intermediate' => 2, 'advanced' => 3, 'expert' => 4];
            @endphp

            @if($itemCount)
                <div class="pay__grid">
                    <div class="pay-card bag" style="--i: 0">
                        <div class="bag__head">
                            <h2 class="pay-card__title bag__title">{{ __('frontend.coursecart.selected') }}<span class="bag__count">{{ trans_choice('frontend.coursecart.items', $itemCount, ['count' => $itemCount]) }}</span></h2>
                            <a href="{{ route('product-lists') }}" class="bag__more">{{ __('frontend.coursecart.browse_more') }}</a>
                        </div>

                        <ul class="bag__list">
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
                                        $raw_photo = trim(explode(',', $cart->product->photo ?? '')[0]);
                                        $item_photo = $raw_photo !== '' && file_exists(public_path(ltrim($raw_photo, '/'))) ? asset(ltrim($raw_photo, '/')) : null;

                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                         ->where('price_in_points', $cart->points)
                                                         ->first();
                                        }
                                    }

                                    $lvl_name = $level ? strtolower(trim($level->skill_level)) : null;
                                    $lvl_key = $level ? 'frontend.coursecart.level_' . str_replace(' ', '_', $lvl_name) : null;
                                    $lvl_label = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                                    $lvl_step = $lvl_name ? ($levelSteps[$lvl_name] ?? 0) : 0;
                                @endphp

                                <li class="bag-item">
                                    <span class="bag-item__thumb {{ $is_course ? '' : 'bag-item__thumb--credits' }}" aria-hidden="true">
                                        @if($item_photo)
                                            <img src="{{ $item_photo }}" alt="" loading="lazy">
                                        @elseif($is_course)
                                            <i class="fas fa-book-open"></i>
                                        @else
                                            <i class="fas fa-coins"></i>
                                        @endif
                                    </span>

                                    <div class="bag-item__info">
                                        @if($is_course && $lvl_label)
                                            <span class="tag tag--active">{{ $lvl_step ? $lvl_label . ' · ' . $lvl_step . '/4' : $lvl_label }}</span>
                                        @elseif(!$is_course)
                                            <span class="tag">{{ __('frontend.coursecart.package') }}</span>
                                        @endif
                                        @if($item_link)
                                            <a href="{{ $item_link }}" class="bag-item__name">{{ $item_title }}</a>
                                        @else
                                            <span class="bag-item__name">{{ $item_title }}</span>
                                        @endif
                                        @if(!$is_course)
                                            <span class="bag-item__meta">{{ __('frontend.coursecart.col_price') }}: {{ $sym }}{{ number_format($cart['price'], $dec) }}</span>
                                        @endif
                                    </div>

                                    <strong class="bag-item__price">{{ number_format($cart->points) }} <small>{{ __('frontend.coursecart.credits') }}</small></strong>

                                    <a href="{{ route('cart-delete', $cart->id) }}" class="bag-item__drop" aria-label="{{ __('frontend.coursecart.remove') }}: {{ $item_title }}">
                                        <i class="fas fa-times" aria-hidden="true"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <aside class="pay__rail">
                        <div class="pay-sum">
                            <h2 class="pay-sum__title">{{ __('frontend.coursecart.totals') }}</h2>

                            <dl class="bag-ledger">
                                <div class="bag-ledger__row">
                                    <dt>{{ __('frontend.coursecart.balance') }}:</dt>
                                    <dd>{{ number_format($points) }}</dd>
                                </div>
                                <div class="bag-ledger__row">
                                    <dt>{{ __('frontend.coursecart.needed') }}:</dt>
                                    <dd>&minus; {{ number_format($total_points) }}</dd>
                                </div>
                                <div class="bag-ledger__row bag-ledger__row--after {{ $enough ? '' : 'is-short' }}">
                                    <dt>{{ __('frontend.coursecart.after') }}:</dt>
                                    <dd>{{ $after < 0 ? '−' : '' }}{{ number_format(abs($after)) }} <small>{{ __('frontend.coursecart.credits') }}</small></dd>
                                </div>
                            </dl>

                            <div class="bag-meter {{ $enough ? '' : 'is-short' }}">
                                <div class="bag-meter__top">
                                    <span>{{ __('frontend.coursecart.covered') }}</span>
                                    <strong>{{ $coverage }}%</strong>
                                </div>
                                <div class="bag-meter__bar" role="progressbar" aria-valuenow="{{ $coverage }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ __('frontend.coursecart.covered') }}">
                                    <span style="--fill: {{ $coverage / 100 }}"></span>
                                </div>
                            </div>

                            @if(!$enough)
                                <p class="bag-alert" role="status">{{ __('frontend.coursecart.not_enough') }}</p>
                            @endif

                            <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>

                            @if($enough)
                                <button type="submit" form="redeemPointsForm" class="btn btn--primary btn--block">
                                    <i class="fas fa-lock-open" aria-hidden="true"></i>
                                    <span>{{ __('frontend.coursecart.unlock') }}</span>
                                </button>
                                <a href="{{ route('points.topup') }}" class="btn btn--dark btn--block bag__second">{{ __('frontend.coursecart.buy_credits') }}</a>
                            @else
                                <a href="{{ route('points.topup') }}" class="btn btn--primary btn--block">{{ __('frontend.coursecart.buy_credits') }}</a>
                            @endif
                        </div>
                    </aside>
                </div>
            @else
                <div class="bag-empty">
                    <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                    <h2 class="bag-empty__title">{{ __('frontend.coursecart.empty_title') }}</h2>
                    <p class="bag-empty__text">{{ __('frontend.coursecart.empty_text') }}</p>
                    <p class="bag-empty__balance"><i class="fas fa-coins" aria-hidden="true"></i> {{ __('frontend.coursecart.balance') }}: <strong>{{ number_format($points) }} {{ __('frontend.coursecart.credits') }}</strong></p>
                    <div class="bag-empty__acts">
                        <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.coursecart.browse') }}</a>
                        <a href="{{ route('points.topup') }}" class="btn btn--dark">{{ __('frontend.coursecart.buy_credits') }}</a>
                    </div>
                </div>
            @endif
        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.coursecart.guest_title') }}</h2>
                <p class="bag-empty__text">{{ __('frontend.coursecart.guest_text') }}</p>
                <div class="bag-empty__acts">
                    <a href="{{ route('login.form') }}" class="btn btn--primary">{{ __('frontend.coursecart.login') }}</a>
                    <a href="{{ route('register.form') }}" class="btn btn--dark">{{ __('frontend.coursecart.register') }}</a>
                </div>
            </div>
        @endauth
    </div>
</section>
@endsection
