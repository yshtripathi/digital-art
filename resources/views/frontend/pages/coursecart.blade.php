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

{{-- ==========================================================================
     Course cart
     Single centred column: unlock steps, balance strip,
     ticket rows, sticky summary bar.
     Styles: public/css/theme.css — section 18
     ========================================================================== --}}
<section class="bag">
    <div class="bag__wrap">

        <ol class="bag-steps">
            <li class="bag-step is-active">
                <span class="bag-step__no">1</span>
                <span class="bag-steps__label">{{ __('frontend.coursecart.step_cart') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">2</span>
                <span class="bag-steps__label">{{ __('frontend.coursecart.step_unlock') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">3</span>
                <span class="bag-steps__label">{{ __('frontend.coursecart.step_learn') }}</span>
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
            @endphp

            {{-- Balance and coverage --}}
            <div class="bag-balance">
                <span class="bag-balance__icon" aria-hidden="true"><i class="fas fa-bolt"></i></span>
                <div class="bag-balance__text">
                    <span class="bag-balance__label">{{ __('frontend.coursecart.balance') }}</span>
                    <span class="bag-balance__amt">{{ number_format($points) }} <small>{{ __('frontend.coursecart.credits') }}</small></span>

                    @if($itemCount)
                        <div class="bag-meter" role="img" aria-label="{{ __('frontend.coursecart.coverage') }}: {{ $coverage }}%">
                            <span class="bag-meter__fill {{ $enough ? '' : 'is-short' }}" style="width: {{ $coverage }}%"></span>
                        </div>
                        <span class="bag-meter__note">
                            {{ __('frontend.coursecart.coverage') }}: {{ $coverage }}%
                        </span>
                    @endif
                </div>
                <a href="{{ route('points.topup') }}" class="bag-btn bag-btn--primary bag-balance__btn">
                    <i class="fas fa-plus" aria-hidden="true"></i> {{ __('frontend.coursecart.buy') }}
                </a>
            </div>

            @if($itemCount)
                @if(!$enough)
                    <p class="bag-warn"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> {{ __('frontend.coursecart.low') }}</p>
                @endif

                <div class="bag-panel">
                    <div class="bag-panel__head">
                        <h2 class="bag-panel__title">{{ __('frontend.coursecart.items_title') }}</h2>
                        <span class="bag-count">{{ trans_choice('frontend.coursecart.items', $itemCount, ['count' => $itemCount]) }}</span>
                    </div>

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

                            $lvl_slug  = $level ? strtolower($level->skill_level) : '';
                            $lvl_key   = 'frontend.coursecart.levels.' . $lvl_slug;
                            $lvl_label = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                        @endphp

                        <div class="bag-row">
                            <span class="bag-row__thumb {{ $is_course ? '' : 'bag-row__thumb--credits' }}">
                                @if($item_photo)
                                    <img src="{{ asset($item_photo) }}" alt="" loading="lazy">
                                @elseif($is_course)
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @else
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                @endif
                            </span>

                            <div class="bag-row__body">
                                @if($is_course)
                                    @if($lvl_label)
                                        <span class="badge"><i class="fas fa-signal" aria-hidden="true"></i> {{ $lvl_label }}</span>
                                    @endif
                                @else
                                    <span class="badge badge--brand">{{ __('frontend.coursecart.package') }}</span>
                                @endif

                                @if($cart->product)
                                    <a href="{{ $item_link }}" class="bag-row__title">{{ $item_title }}</a>
                                @else
                                    <span class="bag-row__title">{{ $item_title }}</span>
                                @endif

                                <span class="bag-row__meta">
                                    @if(!$is_course)
                                        <span>{{ __('frontend.coursecart.amount') }}: {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                    @endif
                                </span>
                            </div>

                            <span class="bag-row__amount">
                                <i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($cart->points) }}
                                <small>{{ __('frontend.coursecart.price') }}</small>
                            </span>

                            <a href="{{ route('cart-delete', $cart->id) }}" class="bag-row__remove" aria-label="{{ __('frontend.coursecart.remove') }}: {{ $item_title }}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i><span>{{ __('frontend.coursecart.remove') }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>

                <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>

                <div class="bag-bar">
                    <div class="bag-bar__figures">
                        <span class="bag-bar__label">{{ __('frontend.coursecart.total') }}:</span>
                        <span class="bag-bar__total">{{ number_format($total_points) }} <small>{{ __('frontend.coursecart.credits') }}</small></span>
                        @if($enough)
                            <span class="bag-bar__cut">{{ __('frontend.coursecart.after') }}: {{ number_format($after) }}</span>
                        @endif
                    </div>

                    <div class="bag-bar__actions">
                        <a href="{{ route('product-lists') }}" class="bag-btn bag-btn--ghost">
                            <i class="fas fa-plus" aria-hidden="true"></i> {{ __('frontend.coursecart.browse') }}
                        </a>
                        @if($enough)
                            <button type="submit" form="redeemPointsForm" class="bag-btn bag-btn--primary">
                                <i class="fas fa-lock-open" aria-hidden="true"></i> {{ __('frontend.coursecart.unlock') }}
                            </button>
                        @else
                            <a href="{{ route('points.topup') }}" class="bag-btn bag-btn--primary">
                                <i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.coursecart.buy') }}
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <div class="bag-empty">
                    <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                    <h2 class="bag-empty__title">{{ __('frontend.coursecart.empty_title') }}</h2>
                    <p class="bag-empty__desc">{{ __('frontend.coursecart.empty_desc') }}</p>
                    <div class="bag-empty__actions">
                        <a href="{{ route('product-lists') }}" class="bag-btn bag-btn--primary">
                            <i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ __('frontend.coursecart.empty_btn') }}
                        </a>
                    </div>
                </div>
            @endif

        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.coursecart.auth_title') }}</h2>
                <p class="bag-empty__desc">{{ __('frontend.coursecart.auth_desc') }}</p>
                <div class="bag-empty__actions">
                    <a href="{{ route('login.form') }}" class="bag-btn bag-btn--primary">
                        <i class="fas fa-sign-in-alt" aria-hidden="true"></i> {{ __('frontend.coursecart.login') }}
                    </a>
                    <a href="{{ route('register.form') }}" class="bag-btn bag-btn--ghost">
                        <i class="fas fa-user-plus" aria-hidden="true"></i> {{ __('frontend.coursecart.register') }}
                    </a>
                </div>
            </div>
        @endauth

    </div>
</section>
@endsection
