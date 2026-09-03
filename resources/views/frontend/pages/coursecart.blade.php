@extends('frontend.layouts.main')
@section('title', __('inkwave.cc_pg_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.cart_pg_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.cart_pg_title')]
    ]
])



<div class="duo-cc-wrap">
    <div class="duo-cc-container">
        @auth
            @php
                $user = auth()->user();
                $points = $user->points_balance ?? 0;
                $cartItems = Helper::cartCount() ? Helper::getAllProductFromCart()->where('order_id', null) : collect();
                $itemCount = $cartItems->count();
            @endphp

            {{-- Credits balance --}}
            <div class="duo-cc-balance">
                <div class="duo-cc-balance__icon"><i class="fas fa-coins"></i></div>
                <div class="duo-cc-balance__text">
                    <span class="duo-cc-balance__label">{{ __('inkwave.cc_lbl_balance') }}</span>
                    <span class="duo-cc-balance__amt">{{ number_format($points) }} <small>{{ __('inkwave.cart_tag_credit') }}</small></span>
                </div>
            </div>

            <div class="duo-cc-grid">
                {{-- Items --}}
                <div>
                    <h2 class="duo-cc-h"><i class="fas fa-shopping-basket"></i> {{ __('inkwave.cart_box_summary') }}</h2>

                    @if($itemCount)
                        <div class="duo-cc-cards">
                            @foreach($cartItems as $cart)
                                @php
                                    $item_title = __('inkwave.cart_item_topup');
                                    $item_image = asset('images/placeholder.jpg');
                                    $item_link = '#';
                                    $is_course = false;
                                    $level = null;

                                    if($cart->product) {
                                        $item_title = $cart->product->title;
                                        $item_link = route('product-detail', $cart->product->slug);
                                        $photo_arr = explode(',', $cart->product->photo ?? '');
                                        $item_image = asset($photo_arr[0] ?? 'images/placeholder.jpg');

                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                         ->where('price_in_points', $cart->points)
                                                         ->first();
                                        }
                                    }
                                @endphp

                                <div class="duo-cc-card">
                                    <a href="{{ route('cart-delete', $cart->id) }}" class="duo-cc-card__remove" title="{{ __('inkwave.cart_btn_del') }}"><i class="fas fa-times"></i></a>

                                    <div class="duo-cc-card__img">
                                        <img src="{{ $item_image }}" alt="{{ $item_title }}">
                                    </div>

                                    <div class="duo-cc-card__body">
                                        <a href="{{ $item_link }}" class="duo-cc-card__title">{{ $item_title }}</a>

                                        <span class="duo-cc-card__pill">
                                            @if($is_course)
                                                @php $lvl_key = $level ? strtolower($level->skill_level) . '_course' : ''; @endphp
                                                <i class="fas fa-star"></i> {{ __('inkwave.cc_lbl_level') }}: {{ ($level && Lang::has('inkwave.' . $lvl_key)) ? __('inkwave.' . $lvl_key) : ($level ? ucfirst($level->skill_level) : 'N/A') }}
                                            @else
                                                <i class="fas fa-gift"></i> {{ __('inkwave.cart_item_topup') }}
                                            @endif
                                        </span>

                                        <div class="duo-cc-card__cost">
                                            @if($is_course)
                                                <i class="fas fa-coins"></i> {{ number_format($cart->points) }} {{ __('inkwave.cart_tag_credit') }}
                                            @else
                                                {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                <small>({{ number_format($cart->points) }} {{ __('inkwave.cart_tag_credit') }})</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="duo-cc-box">
                            <i class="fas fa-ghost"></i>
                            <h3>{{ __('inkwave.cart_mt_heading') }}</h3>
                            <p>{{ __('inkwave.cc_mt_desc') }}</p>
                            <a href="{{ route('product-lists') }}" class="duo-cc-btn">{{ __('inkwave.cart_btn_shop') }}</a>
                        </div>
                    @endif
                </div>

                {{-- Summary --}}
                <aside>
                    <div class="duo-cc-summary">
                        <h3 class="duo-cc-summary__h"><i class="fas fa-receipt"></i> {{ __('inkwave.cart_box_summary') }}</h3>

                        @if($itemCount)
                            @php $total_points = Helper::totalCartPoints(); @endphp

                            <div class="duo-cc-summary__row">
                                <span>{{ __('inkwave.cart_item_count') }}:</span>
                                <span>{{ $itemCount }}</span>
                            </div>

                            <div class="duo-cc-summary__total">
                                <span class="lbl">{{ __('inkwave.cart_box_total') }}:</span>
                                <span class="amt">{{ number_format($total_points) }} <small>{{ __('inkwave.cart_tag_credit') }}</small></span>
                            </div>

                            <div class="duo-cc-summary__actions">
                                <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>
                                <button type="button" class="duo-cc-btn" onclick="document.getElementById('redeemPointsForm').submit();">
                                    <i class="fas fa-lock"></i> {{ __('inkwave.cc_btn_redeem') }}
                                </button>
                                <a href="{{ route('product-lists') }}" class="duo-cc-btn duo-cc-btn--ghost"><i class="fas fa-plus"></i> {{ __('inkwave.cart_btn_shop') }}</a>
                            </div>
                        @else
                            <div>
                                <i class="fas fa-info-circle"></i>
                                <p>{{ __('inkwave.cart_mt_desc') }}</p>
                            </div>
                        @endif
                    </div>
                </aside>
            </div>
        @else
            <div class="duo-cc-box">
                <i class="fas fa-lock"></i>
                <h3>{{ __('inkwave.cc_auth_req') }}</h3>
                <p>{{ __('inkwave.cc_auth_msg') }}</p>
                <a href="{{ route('login.form') }}" class="duo-cc-btn"><i class="fas fa-sign-in-alt"></i> {{ __('inkwave.login_pg_title') }}</a>
            </div>
        @endauth
    </div>
</div>
@endsection


