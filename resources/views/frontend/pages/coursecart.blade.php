@extends('frontend.layouts.main')
@section('title', __('inkwave.cc_title'))
@section('main-content')

<x-breadcrumb :title="__('inkwave.cart_title')" />

@auth
<section class="cc-section">
    <div class="cc-container">
        @php
            $user = auth()->user();
            $points = $user->points_balance ?? 0;
            $cartItems = Helper::cartCount() ? Helper::getAllProductFromCart()->where('order_id', null) : collect();
            $itemCount = $cartItems->count();
        @endphp

        {{-- Credits balance --}}
        <div class="cc-balance">
            <span class="cc-balance__icon"><i class="fas fa-coins"></i></span>
            <div>
                <span class="cc-balance__label">{{ __('inkwave.cc_available_credits') }}</span>
                <span class="cc-balance__amount">{{ number_format($points) }} <small>{{ __('inkwave.cart_type_credits') }}</small></span>
            </div>
        </div>

        <div class="cc-grid">
            {{-- Items --}}
            <div class="cc-items">
                <h2 class="cc-h"><i class="fas fa-palette"></i> {{ __('inkwave.cart_item_summary') }}</h2>

                @if($itemCount)
                    <div class="cc-cards">
                        @foreach($cartItems as $cart)
                            @php
                                $item_title = __('inkwave.cart_credits_topup');
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

                            <div class="cc-card">
                                <a href="{{ route('cart-delete', $cart->id) }}" class="cc-card__remove" title="{{ __('inkwave.cart_label_remove') }}"><i class="fas fa-times"></i></a>

                                <div class="cc-card__img">
                                    <img src="{{ $item_image }}" alt="{{ $item_title }}">
                                </div>

                                <div class="cc-card__body">
                                    <a href="{{ $item_link }}" class="cc-card__title">{{ $item_title }}</a>

                                    <span class="cc-card__pill">
                                        @if($is_course)
                                            <i class="fas fa-star"></i> {{ __('inkwave.cc_skill_level') }}: {{ $level ? ucfirst($level->skill_level) : 'N/A' }}
                                        @else
                                            <i class="fas fa-gift"></i> {{ __('inkwave.cart_credits_topup') }}
                                        @endif
                                    </span>

                                    <div class="cc-card__cost">
                                        @if($is_course)
                                            <span class="cc-card__credits"><i class="fas fa-coins"></i> {{ number_format($cart->points) }} {{ __('inkwave.cart_type_credits') }}</span>
                                        @else
                                            <span class="cc-card__price">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                            <span class="cc-card__sub">({{ number_format($cart->points) }} {{ __('inkwave.cart_type_credits') }})</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="cc-empty">
                        <i class="fas fa-shopping-basket"></i>
                        <h3>{{ __('inkwave.cart_no_items') }}</h3>
                        <p>{{ __('inkwave.cc_empty_msg') }}</p>
                        <a href="{{ route('product-lists') }}" class="cc-btn cc-btn--primary cc-empty__btn"><i class="fas fa-arrow-left"></i> {{ __('inkwave.cart_continue') }}</a>
                    </div>
                @endif
            </div>

            {{-- Summary --}}
            <aside>
                <div class="cc-summary">
                    <h3 class="cc-summary__h"><i class="fas fa-shopping-cart"></i> {{ __('inkwave.cart_order_summary') }}</h3>

                    @if($itemCount)
                        @php $total_points = Helper::totalCartPoints(); @endphp

                        <div class="cc-summary__row">
                            <span>{{ __('inkwave.cart_item_count') }}:</span>
                            <span>{{ $itemCount }}</span>
                        </div>

                        <div class="cc-summary__total">
                            <span class="lbl">{{ __('inkwave.cart_total') }}:</span>
                            <span class="amt">{{ number_format($total_points) }} <small>{{ __('inkwave.cart_type_credits') }}</small></span>
                        </div>

                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">@csrf</form>
                        <button type="button" class="cc-btn cc-btn--primary" onclick="document.getElementById('redeemPointsForm').submit();">
                            <i class="fas fa-lock"></i> {{ __('inkwave.cc_redeem_points') }}
                        </button>
                        <a href="{{ route('product-lists') }}" class="cc-btn cc-btn--ghost"><i class="fas fa-plus"></i> {{ __('inkwave.cart_continue') }}</a>
                    @else
                        <div class="cc-summary__empty">
                            <i class="fas fa-info-circle"></i>
                            <p>{{ __('inkwave.cart_empty_msg') }}</p>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</section>

@else
<section class="cc-section">
    <div class="cc-container">
        <div class="cc-signin">
            <i class="fas fa-lock"></i>
            <h3>{{ __('inkwave.cc_sign_in_req') }}</h3>
            <p>{{ __('inkwave.cc_sign_in_msg') }}</p>
            <a href="{{ route('login.form') }}" class="cc-btn cc-btn--primary cc-signin__btn"><i class="fas fa-sign-in-alt"></i> {{ __('inkwave.login_title') }}</a>
        </div>
    </div>
</section>
@endauth

@endsection


