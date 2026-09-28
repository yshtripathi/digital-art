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
            <div class="ct__sheet">
                <div class="ct__head">
                    <span class="ct__head-icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                    <div class="ct__head-text">
                        <h2 class="ct__title">{{ __('frontend.coursecart.picked') }}</h2>
                        <span class="ct__count">{{ trans_choice('frontend.coursecart.item_count', $itemCount, ['count' => $itemCount]) }}</span>
                    </div>
                    <a href="{{ route('product-lists') }}" class="ct__more">
                        {{ __('frontend.coursecart.more') }}
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>

                <ul class="ct__list ct__list--wide">
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

                            $lvl_name = $level ? strtolower($level->skill_level) : null;
                            $lvl_key = $level ? 'frontend.coursecart.level_names.' . $lvl_name : null;
                            $lvl_label = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                        @endphp

                        <li class="line" style="--i: {{ $loop->index }}">
                            <span class="line__media {{ $is_course ? '' : 'line__media--credits' }}">
                                @if($item_photo)
                                    <img src="{{ asset(ltrim($item_photo, '/')) }}" alt="" loading="lazy">
                                @elseif($is_course)
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @else
                                    <i class="fas fa-wallet" aria-hidden="true"></i>
                                @endif
                            </span>

                            <div class="line__body">
                                @if($is_course)
                                    @if($lvl_label)
                                        <span class="badge">{{ $lvl_label }}</span>
                                    @endif
                                @else
                                    <span class="badge">{{ __('frontend.coursecart.pack') }}</span>
                                @endif
                                @if($item_link)
                                    <a href="{{ $item_link }}" class="line__title">{{ $item_title }}</a>
                                @else
                                    <span class="line__title">{{ $item_title }}</span>
                                @endif
                                @if(!$is_course)
                                    <span class="line__meta">{{ __('frontend.coursecart.col_amount') }}: <span class="num">{{ $sym }}{{ number_format($cart['price'], $dec) }}</span></span>
                                @endif
                            </div>

                            <strong class="line__price"><i class="fas fa-wallet" aria-hidden="true"></i> <span class="num">{{ number_format($cart->points) }}</span> <span class="line__unit">{{ __('frontend.coursecart.unit') }}</span></strong>

                            <a href="{{ route('cart-delete', $cart->id) }}" class="line__drop" aria-label="{{ __('frontend.coursecart.drop') }}: {{ $item_title }}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="ct__foot">
                    <p class="ct__caption">{{ __('frontend.coursecart.summary') }}</p>

                    <dl class="ct__stats ct__stats--wallet">
                        <div class="ct__stat">
                            <dt>{{ __('frontend.coursecart.wallet') }}:</dt>
                            <dd><i class="fas fa-wallet" aria-hidden="true"></i> <span class="num">{{ number_format($points) }}</span> <span class="ct__unit">{{ __('frontend.coursecart.unit') }}</span></dd>
                        </div>
                        <div class="ct__stat">
                            <dt>{{ __('frontend.coursecart.need') }}:</dt>
                            <dd><span class="num">{{ number_format($total_points) }}</span> <span class="ct__unit">{{ __('frontend.coursecart.unit') }}</span></dd>
                        </div>
                        @if($enough)
                            <div class="ct__stat ct__stat--after">
                                <dt>{{ __('frontend.coursecart.left') }}</dt>
                                <dd><span class="num">{{ number_format($after) }}</span> <span class="ct__unit">{{ __('frontend.coursecart.unit') }}</span></dd>
                            </div>
                        @endif
                    </dl>

                    <div class="ct__meter {{ $enough ? '' : 'is-short' }}">
                        <div class="ct__meter-top">
                            <span>{{ __('frontend.coursecart.used') }}</span>
                            <strong class="num">{{ $coverage }}%</strong>
                        </div>
                        <div class="ct__meter-bar" role="img" aria-label="{{ __('frontend.coursecart.used') }}: {{ $coverage }}%">
                            <span style="width: {{ $coverage }}%"></span>
                        </div>
                    </div>

                    @if(!$enough)
                        <p class="ct__alert" role="status">
                            <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.low') }}</span>
                        </p>
                    @endif

                    <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>

                    <div class="ct__acts">
                        @if($enough)
                            <button type="submit" form="redeemPointsForm" class="btn ct__go">
                                <i class="fas fa-lock-open" aria-hidden="true"></i>
                                {{ __('frontend.coursecart.go_unlock') }}
                            </button>
                            <a href="{{ route('points.topup') }}" class="btn btn--ghost">
                                <i class="fas fa-plus" aria-hidden="true"></i>
                                {{ __('frontend.coursecart.go_buy') }}
                            </a>
                        @else
                            <a href="{{ route('points.topup') }}" class="btn ct__go">
                                <i class="fas fa-wallet" aria-hidden="true"></i>
                                {{ __('frontend.coursecart.go_buy') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="ct__empty">
                <span class="ct__empty-icon" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                <h2 class="ct__empty-title">{{ __('frontend.coursecart.empty_head') }}</h2>
                <p class="ct__empty-text">{{ __('frontend.coursecart.empty_text') }}</p>
                <p class="ct__balance">
                    <span>{{ __('frontend.coursecart.wallet') }}</span>
                    <strong><i class="fas fa-wallet" aria-hidden="true"></i> <span class="num">{{ number_format($points) }}</span> {{ __('frontend.coursecart.unit') }}</strong>
                </p>
                <div class="ct__empty-acts">
                    <a href="{{ route('product-lists') }}" class="btn">
                        <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                        {{ __('frontend.coursecart.none_browse') }}
                    </a>
                    <a href="{{ route('points.topup') }}" class="btn btn--ghost">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        {{ __('frontend.coursecart.go_buy') }}
                    </a>
                </div>
            </div>
        @endif
    @else
        <div class="ct__empty">
            <span class="ct__empty-icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
            <h2 class="ct__empty-title">{{ __('frontend.coursecart.guest_head') }}</h2>
            <p class="ct__empty-text">{{ __('frontend.coursecart.guest_body') }}</p>
            <div class="ct__empty-acts">
                <a href="{{ route('login.form') }}" class="btn">
                    <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                    {{ __('frontend.coursecart.guest_login') }}
                </a>
                <a href="{{ route('register.form') }}" class="btn btn--ghost">
                    <i class="fas fa-user-plus" aria-hidden="true"></i>
                    {{ __('frontend.coursecart.guest_join') }}
                </a>
            </div>
        </div>
    @endauth
</section>
@endsection
