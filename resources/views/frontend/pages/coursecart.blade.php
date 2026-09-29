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

<section class="basket">
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
            $blocks = (int) floor($coverage / 10);
            $levelSteps = ['beginner' => 1, 'intermediate' => 2, 'advanced' => 3, 'expert' => 4];
        @endphp

        @if($itemCount)
            <div class="equation {{ $enough ? '' : 'is-short' }}">
                <div class="equation__term">
                    <span class="equation__label">{{ __('frontend.coursecart.balance') }}</span>
                    <strong class="equation__value">{{ number_format($points) }}</strong>
                    <span class="equation__unit">{{ __('frontend.coursecart.credits') }}</span>
                </div>
                <span class="equation__op" aria-hidden="true"><i class="fas fa-minus"></i></span>
                <div class="equation__term">
                    <span class="equation__label">{{ __('frontend.coursecart.needed') }}</span>
                    <strong class="equation__value">{{ number_format($total_points) }}</strong>
                    <span class="equation__unit">{{ __('frontend.coursecart.credits') }}</span>
                </div>
                <span class="equation__op" aria-hidden="true"><i class="fas fa-equals"></i></span>
                <div class="equation__term equation__term--result">
                    <span class="equation__label">{{ __('frontend.coursecart.after') }}</span>
                    <strong class="equation__value">{{ $after < 0 ? '−' : '' }}{{ number_format(abs($after)) }}</strong>
                    <span class="equation__unit">{{ __('frontend.coursecart.credits') }}</span>
                </div>
            </div>

            <div class="basket__grid">
                <div class="basket__main">
                    <div class="basket__head">
                        <div>
                            <h2 class="basket__title">{{ __('frontend.coursecart.selected') }}</h2>
                            <span class="basket__count">{{ trans_choice('frontend.coursecart.items', $itemCount, ['count' => $itemCount]) }}</span>
                        </div>
                        <a href="{{ route('product-lists') }}" class="basket__more">
                            {{ __('frontend.coursecart.browse_more') }}
                            <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                        </a>
                    </div>

                    <ul class="stubs">
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

                                $lvl_name = $level ? strtolower($level->skill_level) : null;
                                $lvl_key = $level ? 'frontend.coursecart.level_' . str_replace(' ', '_', trim($lvl_name)) : null;
                                $lvl_label = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                                $lvl_step = $lvl_name ? ($levelSteps[$lvl_name] ?? 0) : 0;
                            @endphp

                            <li class="stub" style="--i: {{ $loop->index }}">
                                <span class="stub__media {{ $is_course ? '' : 'stub__media--credits' }}">
                                    @if($item_photo)
                                        <img src="{{ asset(ltrim($item_photo, '/')) }}" alt="" loading="lazy">
                                    @elseif($is_course)
                                        <i class="fas fa-book-open" aria-hidden="true"></i>
                                    @else
                                        <i class="fas fa-coins" aria-hidden="true"></i>
                                    @endif
                                </span>

                                <div class="stub__body">
                                    @if($is_course && $lvl_label)
                                        <span class="stub__level">
                                            @if($lvl_step)
                                                <span class="pips" aria-hidden="true">
                                                    @for($pip = 1; $pip <= 4; $pip++)
                                                        <span class="{{ $pip <= $lvl_step ? 'is-on' : '' }}"></span>
                                                    @endfor
                                                </span>
                                            @endif
                                            {{ $lvl_label }}
                                        </span>
                                    @elseif(!$is_course)
                                        <span class="stub__tag">{{ __('frontend.coursecart.package') }}</span>
                                    @endif
                                    @if($item_link)
                                        <a href="{{ $item_link }}" class="stub__title">{{ $item_title }}</a>
                                    @else
                                        <span class="stub__title">{{ $item_title }}</span>
                                    @endif
                                    @if(!$is_course)
                                        <span class="stub__meta">{{ __('frontend.coursecart.col_price') }}: {{ $sym }}{{ number_format($cart['price'], $dec) }}</span>
                                    @endif
                                </div>

                                <div class="stub__side">
                                    <strong class="stub__price"><i class="fas fa-coins" aria-hidden="true"></i> {{ number_format($cart->points) }}</strong>
                                    <span class="stub__unit">{{ __('frontend.coursecart.credits') }}</span>
                                    <a href="{{ route('cart-delete', $cart->id) }}" class="stub__drop" aria-label="{{ __('frontend.coursecart.remove') }}: {{ $item_title }}">
                                        <i class="far fa-trash-alt" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <aside class="sumup {{ $enough ? '' : 'is-short' }}">
                    <p class="sumup__caption">{{ __('frontend.coursecart.totals') }}</p>

                    <div class="cover">
                        <div class="cover__top">
                            <span>{{ __('frontend.coursecart.covered') }}:</span>
                            <strong>{{ $coverage }}%</strong>
                        </div>
                        <div class="cover__blocks" role="img" aria-label="{{ __('frontend.coursecart.covered') }}: {{ $coverage }}%">
                            @for($block = 1; $block <= 10; $block++)
                                <span class="{{ $block <= $blocks ? 'is-on' : '' }}" style="--i: {{ $block }}"></span>
                            @endfor
                        </div>
                    </div>

                    @if(!$enough)
                        <p class="sumup__alert" role="status">
                            <i class="fas fa-exclamation" aria-hidden="true"></i>
                            <span>{{ __('frontend.coursecart.not_enough') }}</span>
                        </p>
                    @endif

                    <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>

                    @if($enough)
                        <button type="submit" form="redeemPointsForm" class="btn btn--block sumup__go">
                            <span><i class="fas fa-lock-open" aria-hidden="true"></i> {{ __('frontend.coursecart.unlock') }}</span>
                            <span class="sumup__go-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                        </button>
                        <a href="{{ route('points.topup') }}" class="btn btn--outline btn--block">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                            {{ __('frontend.coursecart.buy_credits') }}
                        </a>
                    @else
                        <a href="{{ route('points.topup') }}" class="btn btn--block sumup__go">
                            <span><i class="fas fa-coins" aria-hidden="true"></i> {{ __('frontend.coursecart.buy_credits') }}</span>
                            <span class="sumup__go-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                        </a>
                    @endif
                </aside>
            </div>
        @else
            <div class="dropzone">
                <span class="dropzone__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                <h2 class="dropzone__title">{{ __('frontend.coursecart.empty_title') }}</h2>
                <p class="dropzone__text">{{ __('frontend.coursecart.empty_text') }}</p>
                <p class="dropzone__balance">
                    <span>{{ __('frontend.coursecart.balance') }}</span>
                    <strong><i class="fas fa-coins" aria-hidden="true"></i> {{ number_format($points) }} {{ __('frontend.coursecart.credits') }}</strong>
                </p>
                <div class="dropzone__acts">
                    <a href="{{ route('product-lists') }}" class="btn">
                        <i class="fas fa-book-open" aria-hidden="true"></i>
                        {{ __('frontend.coursecart.browse') }}
                    </a>
                    <a href="{{ route('points.topup') }}" class="btn btn--outline">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        {{ __('frontend.coursecart.buy_credits') }}
                    </a>
                </div>
            </div>
        @endif
    @else
        <div class="dropzone">
            <span class="dropzone__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
            <h2 class="dropzone__title">{{ __('frontend.coursecart.guest_title') }}</h2>
            <p class="dropzone__text">{{ __('frontend.coursecart.guest_text') }}</p>
            <div class="dropzone__acts">
                <a href="{{ route('login.form') }}" class="btn">
                    <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                    {{ __('frontend.coursecart.login') }}
                </a>
                <a href="{{ route('register.form') }}" class="btn btn--outline">
                    <i class="fas fa-user-plus" aria-hidden="true"></i>
                    {{ __('frontend.coursecart.register') }}
                </a>
            </div>
        </div>
    @endauth
</section>
@endsection
