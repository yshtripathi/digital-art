@extends('frontend.layouts.main')
@section('title', __('inkwave.mycart_course_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.mycart_title'),
    'links' => [
        ['name' => __('inkwave.top_nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.mycart_title')]
    ]
])



<div class="ag-cart-page">
    <div class="ag-container">
        
        <h1 class="ag-page-title">{{ __('inkwave.mycart_title') }}</h1>

        @auth
            @php
                $user = auth()->user();
                $points = $user->points_balance ?? 0;
                $cartItems = Helper::cartCount() ? Helper::getAllProductFromCart()->where('order_id', null) : collect();
                $itemCount = $cartItems->count();
            @endphp

            {{-- Credits balance --}}
            <div class="ag-balance-banner">
                <div class="ag-balance-banner__icon"><i class="fas fa-coins"></i></div>
                <div class="ag-balance-banner__text">
                    <span class="ag-balance-banner__label">{{ __('inkwave.mycart_lbl_balance') }}</span>
                    <span class="ag-balance-banner__amt">{{ number_format($points) }} <small>{{ __('inkwave.mycart_tag_credit') }}</small></span>
                </div>
            </div>

            @if($itemCount)
                <div class="ag-cart-grid">
                    
                    {{-- Items --}}
                    <div class="ag-cart-items">
                        @foreach($cartItems as $cart)
                            @php
                                $item_title = __('inkwave.mycart_item_topup');
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

                            <div class="ag-cart-card">
                                
                                <div class="ag-cart-card__img">
                                    <img src="{{ $item_image }}" alt="{{ $item_title }}">
                                </div>

                                <div class="ag-cart-card__main">
                                    <a href="{{ $item_link }}" class="ag-cart-card__title">{{ $item_title }}</a>

                                    <span class="ag-cart-card__tag">
                                        @if($is_course)
                                            @php $lvl_key = $level ? strtolower($level->skill_level) . '_course' : ''; @endphp
                                            <i class="fas fa-star"></i> {{ __('inkwave.mycart_lbl_level') }}: {{ ($level && Lang::has('inkwave.' . $lvl_key)) ? __('inkwave.' . $lvl_key) : ($level ? ucfirst($level->skill_level) : 'N/A') }}
                                        @else
                                            <i class="fas fa-gift"></i> {{ __('inkwave.mycart_item_topup') }}
                                        @endif
                                    </span>
                                </div>

                                <div class="ag-cart-card__meta">
                                    <div class="ag-cart-card__col">
                                        @if($is_course)
                                            <span class="ag-cart-card__label">{{ __('inkwave.mycart_tag_credit') }}</span>
                                            <span class="ag-cart-card__val"><i class="fas fa-coins"></i> {{ number_format($cart->points) }}</span>
                                        @else
                                            <span class="ag-cart-card__val">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                            <span class="ag-cart-card__subval">({{ number_format($cart->points) }} {{ __('inkwave.mycart_tag_credit') }})</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('cart-delete', $cart->id) }}" class="ag-cart-card__remove" title="{{ __('inkwave.mycart_btn_del') }}"><i class="fas fa-times"></i></a>
                                </div>
                                
                            </div>
                        @endforeach
                    </div>

                    {{-- Summary --}}
                    <aside>
                        <div class="ag-summary-card">
                            <h3 class="ag-summary-title"><i class="fas fa-receipt"></i> {{ __('inkwave.mycart_box_summary') }}</h3>

                            @php $total_points = Helper::totalCartPoints(); @endphp

                            <div class="ag-summary-row">
                                <span>{{ __('inkwave.mycart_item_count') }}:</span>
                                <span>{{ $itemCount }}</span>
                            </div>

                            <div class="ag-summary-total">
                                <span class="lbl">{{ __('inkwave.mycart_box_total') }}:</span>
                                <span class="amt">{{ number_format($total_points) }} <small>{{ __('inkwave.mycart_tag_credit') }}</small></span>
                            </div>

                            <div class="ag-summary-actions">
                                <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>
                                <button type="button" class="ag-primary-btn" onclick="document.getElementById('redeemPointsForm').submit();">
                                    <i class="fas fa-lock"></i> {{ __('inkwave.mycart_btn_redeem') }}
                                </button>
                                <a href="{{ route('product-lists') }}" class="ag-ghost-btn"><i class="fas fa-plus"></i> {{ __('inkwave.mycart_btn_shop') }}</a>
                            </div>
                        </div>
                    </aside>
                </div>
            @else
                <div class="ag-cart-empty">
                    <i class="fas fa-ghost"></i>
                    <h3>{{ __('inkwave.mycart_mt_heading') }}</h3>
                    <p>{{ __('inkwave.mycart_mt_course_desc') }}</p>
                    <a href="{{ route('product-lists') }}" class="ag-primary-btn" style="display:inline-block !important; width:250px; margin: 0 auto;">{{ __('inkwave.mycart_btn_shop') }}</a>
                </div>
            @endif

        @else
            <div class="ag-cart-empty">
                <i class="fas fa-lock"></i>
                <h3>{{ __('inkwave.mycart_auth_req') }}</h3>
                <p>{{ __('inkwave.mycart_auth_msg') }}</p>
                <a href="{{ route('login.form') }}" class="ag-primary-btn" style="display:inline-block !important; width:250px; margin: 0 auto;">
                    <i class="fas fa-sign-in-alt"></i> {{ __('inkwave.auth_login_title') }}
                </a>
            </div>
        @endauth
    </div>
</div>
@endsection
