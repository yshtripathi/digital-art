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
                $enough = $points >= $total_points;
                $after = $points - $total_points;
            @endphp

            @if($itemCount)
                <div class="bag">
                    <div class="bag__head">
                        <h2 class="bag__title">{{ __('frontend.coursecart.selected') }}</h2>
                        <span class="bag__count">{{ trans_choice('frontend.coursecart.items', $itemCount, ['count' => $itemCount]) }}</span>
                    </div>

                    <ul class="bag__list">
                        @foreach($cartItems as $cart)
                            @php
                                $item_title = $cart->product ? $cart->product->title : __('frontend.coursecart.package');
                                $is_course = $cart->product && $cart->product_id < 1000;
                                $raw_photo = $cart->product ? trim(explode(',', $cart->product->photo ?? '')[0]) : '';
                                $item_photo = $raw_photo !== '' && file_exists(public_path(ltrim($raw_photo, '/'))) ? asset(ltrim($raw_photo, '/')) : null;
                                $lvl_label = null;
                                if($is_course) {
                                    $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                 ->where('price_in_points', $cart->points)
                                                 ->first();
                                    if($level) {
                                        $lvl_key = 'frontend.coursecart.level_' . str_replace(' ', '_', strtolower(trim($level->skill_level)));
                                        $lvl_label = Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level);
                                    }
                                }
                            @endphp
                            <li class="bag-item" style="--i: {{ $loop->index }}">
                                <span class="bag-item__thumb" aria-hidden="true">
                                    @if($item_photo)
                                        <img src="{{ $item_photo }}" alt="" loading="lazy">
                                    @else
                                        <i class="fas {{ $is_course ? 'fa-book-open' : 'fa-coins' }}"></i>
                                    @endif
                                </span>
                                <div class="bag-item__info">
                                    @if($lvl_label)
                                        <span class="bag-item__level">{{ $lvl_label }}</span>
                                    @endif
                                    <span class="bag-item__name">{{ $item_title }}</span>
                                </div>
                                <strong class="bag-item__price">{{ number_format($cart->points) }} <small>{{ __('frontend.coursecart.credits') }}</small></strong>
                                <a href="{{ route('cart-delete', $cart->id) }}" class="bag-item__drop" aria-label="{{ __('frontend.coursecart.remove') }}: {{ $item_title }}">
                                    <i class="fas fa-times" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="bag-stats">
                        <div class="bag-stat">
                            <span class="bag-stat__label">{{ __('frontend.coursecart.balance') }}</span>
                            <strong class="bag-stat__value">{{ number_format($points) }} <small>{{ __('frontend.coursecart.credits') }}</small></strong>
                        </div>
                        <div class="bag-stat">
                            <span class="bag-stat__label">{{ __('frontend.coursecart.needed') }}</span>
                            <strong class="bag-stat__value">{{ number_format($total_points) }} <small>{{ __('frontend.coursecart.credits') }}</small></strong>
                        </div>
                    </div>

                    @if($enough)
                        <p class="bag-status bag-status--ok">
                            <i class="fas fa-check" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.after') }}: <strong>{{ number_format($after) }} {{ __('frontend.coursecart.credits') }}</strong></span>
                        </p>
                    @else
                        <p class="bag-status bag-status--short" role="status">
                            <i class="fas fa-exclamation" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.short_by', ['count' => number_format($total_points - $points)]) }}</span>
                        </p>
                    @endif

                    <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>

                    <div class="bag__acts">
                        @if($enough)
                            <button type="submit" form="redeemPointsForm" class="btn btn--primary">
                                <i class="fas fa-lock-open" aria-hidden="true"></i>
                                <span>{{ __('frontend.coursecart.unlock') }}</span>
                            </button>
                            <a href="{{ route('points.topup') }}" class="btn btn--ghost">{{ __('frontend.coursecart.buy_credits') }}</a>
                        @else
                            <a href="{{ route('points.topup') }}" class="btn btn--primary">{{ __('frontend.coursecart.buy_credits') }}</a>
                        @endif
                    </div>
                </div>
            @else
                <div class="bag-empty">
                    <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                    <h2 class="bag-empty__title">{{ __('frontend.coursecart.empty_title') }}</h2>
                    <p class="bag-empty__text">{{ __('frontend.coursecart.empty_text') }}</p>
                    <div class="bag-empty__acts">
                        <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.coursecart.browse') }}</a>
                        <a href="{{ route('points.topup') }}" class="btn btn--ghost">{{ __('frontend.coursecart.buy_credits') }}</a>
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
                    <a href="{{ route('register.form') }}" class="btn btn--ghost">{{ __('frontend.coursecart.register') }}</a>
                </div>
            </div>
        @endauth
    </div>
</section>
@endsection
