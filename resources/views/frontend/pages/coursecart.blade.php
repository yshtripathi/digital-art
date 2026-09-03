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

<style>
/* ==========================================================================
   Art Courses — Course Cart (Card-based Split Layout)
   ========================================================================== */
.ag-cart-page, .ag-cart-page *, .ag-cart-page *::before, .ag-cart-page *::after {
    box-sizing: border-box;
}
.ag-cart-page {
    padding: 40px 40px;
}
.ag-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 5%;
}

.ag-page-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 48px !important;
    color: #000000 !important;
    margin-bottom: 64px !important;
    text-align: center;
}

/* Credits Balance Banner */
.ag-balance-banner {
    background-color: #000000;
    padding: 32px 48px;
    margin-bottom: 64px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 32px;
}
.ag-balance-banner__icon {
    font-size: 48px;
    color: #bc9c5c;
}
.ag-balance-banner__text {
    display: flex;
    flex-direction: column;
}
.ag-balance-banner__label {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: #aaaaaa;
    margin-bottom: 8px;
}
.ag-balance-banner__amt {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 36px;
    color: #ffffff;
    line-height: 1;
}
.ag-balance-banner__amt small {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    color: #bc9c5c;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-left: 8px;
}
@media (max-width: 768px) {
    .ag-balance-banner { flex-direction: column; text-align: center; padding: 32px; }
}

/* Grid Layout */
.ag-cart-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 64px;
    align-items: start;
}
@media (max-width: 1100px) { .ag-cart-grid { grid-template-columns: 1fr; gap: 48px; } }

/* Items List - Card Style */
.ag-cart-card {
    background-color: #f5f5f5; /* Bone */
    padding: 32px;
    margin-bottom: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 32px;
    border-left: 4px solid transparent;
    transition: all 0.3s ease;
}
.ag-cart-card:hover {
    border-left-color: #bc9c5c;
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
}
@media (max-width: 768px) {
    .ag-cart-card { flex-direction: column; align-items: flex-start; gap: 24px; padding: 24px; }
}

.ag-cart-card__img {
    width: 120px;
    flex-shrink: 0;
    border: 1px solid rgba(0,0,0,0.1);
    background: #ffffff;
}
.ag-cart-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.ag-cart-card__main { flex: 1; }
.ag-cart-card__title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 26px !important;
    color: #000000 !important;
    text-decoration: none !important;
    display: block;
    margin-bottom: 12px;
    transition: color 0.3s ease;
    line-height: 1.2;
}
.ag-cart-card__title:hover { color: #bc9c5c !important; }

.ag-cart-card__tag {
    display: inline-block;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #ffffff;
    background-color: #000000;
    padding: 6px 12px;
}
.ag-cart-card__tag i {
    color: #bc9c5c;
    margin-right: 4px;
}

.ag-cart-card__meta {
    display: flex;
    gap: 48px;
    margin-left: auto;
    text-align: right;
    align-items: flex-end;
}
@media (max-width: 768px) { .ag-cart-card__meta { margin: 0; width: 100%; justify-content: space-between; text-align: left; } }

.ag-cart-card__col { display: flex; flex-direction: column; gap: 8px; }
.ag-cart-card__label { font-family: var(--font-arial, Arial, sans-serif); font-size: 11px; text-transform: uppercase; letter-spacing: 0.15em; color: #888888; }
.ag-cart-card__val { font-family: var(--font-arial, Arial, sans-serif); font-size: 18px; font-weight: bold; color: #000000; display: flex; align-items: center; gap: 6px; }
.ag-cart-card__val i { color: #bc9c5c; }
.ag-cart-card__subval { font-family: var(--font-arial, Arial, sans-serif); font-size: 12px; color: #888888; }

.ag-cart-card__remove {
    position: static;
    color: #aaaaaa;
    font-size: 20px;
    transition: all 0.3s ease;
    margin-left: 32px;
    margin-bottom: 2px;
}
.ag-cart-card__remove:hover { color: #d93025; }
@media (max-width: 768px) { .ag-cart-card__remove { align-self: flex-end; margin-left: 0; margin-top: -32px; } }

/* Order Summary Box */
.ag-summary-card {
    background-color: #f5f5f5; /* Bone */
    padding: 40px;
    position: sticky;
    top: 140px;
}
.ag-summary-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 28px !important;
    color: #000000 !important;
    margin-bottom: 32px !important;
    line-height: 1.2 !important;
    display: flex;
    align-items: center;
    gap: 12px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding-bottom: 16px;
}
.ag-summary-title i { color: #bc9c5c; font-size: 24px; }

.ag-summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 0;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    color: #555555;
}
.ag-summary-total {
    padding-top: 16px;
    margin-top: 8px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 22px;
    font-weight: bold;
    color: #000000;
    display: flex;
    justify-content: space-between;
}
.ag-summary-total small { font-size: 14px; color: #bc9c5c; text-transform: uppercase; margin-left: 8px; }

/* Buttons */
.ag-primary-btn {
    background: #000000 !important; color: #ffffff !important; border: 1px solid #000000 !important; font-family: Arial, sans-serif !important; font-size: 13px !important; font-weight: bold !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; cursor: pointer !important; transition: all 0.3s ease !important; padding: 20px 24px !important; white-space: nowrap !important; display: block !important; text-align: center !important; border-radius: 0 !important; text-decoration: none !important; margin-top: 32px; width: 100%;
}
.ag-primary-btn:hover { background: #ffffff !important; color: #000000 !important; }
.ag-primary-btn i { margin-right: 8px; }

.ag-ghost-btn { display: block; text-align: center; font-family: var(--font-arial, Arial, sans-serif); font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; color: #000000; text-decoration: none; border: 1px solid rgba(0,0,0,0.2); padding: 16px; margin-top: 16px; transition: all 0.3s ease; width: 100%; }
.ag-ghost-btn:hover { border-color: #000000; background: rgba(0,0,0,0.02); }
.ag-ghost-btn i { margin-right: 8px; }

/* Empty / Auth States */
.ag-cart-empty { text-align: center; padding: 80px 40px; background-color: #f5f5f5; max-width: 600px; margin: 0 auto; }
.ag-cart-empty i { font-size: 48px; color: #bc9c5c; margin-bottom: 24px; }
.ag-cart-empty h3 { font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important; font-size: 32px !important; color: #000000 !important; margin-bottom: 16px !important; }
.ag-cart-empty p { font-family: var(--font-arial, Arial, sans-serif); color: #555555; margin-bottom: 32px; }
</style>

<div class="ag-cart-page">
    <div class="ag-container">
        
        <h1 class="ag-page-title">{{ __('inkwave.cart_pg_title') }}</h1>

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
                    <span class="ag-balance-banner__label">{{ __('inkwave.cc_lbl_balance') }}</span>
                    <span class="ag-balance-banner__amt">{{ number_format($points) }} <small>{{ __('inkwave.cart_tag_credit') }}</small></span>
                </div>
            </div>

            @if($itemCount)
                <div class="ag-cart-grid">
                    
                    {{-- Items --}}
                    <div class="ag-cart-items">
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

                            <div class="ag-cart-card">
                                
                                <div class="ag-cart-card__img">
                                    <img src="{{ $item_image }}" alt="{{ $item_title }}">
                                </div>

                                <div class="ag-cart-card__main">
                                    <a href="{{ $item_link }}" class="ag-cart-card__title">{{ $item_title }}</a>

                                    <span class="ag-cart-card__tag">
                                        @if($is_course)
                                            @php $lvl_key = $level ? strtolower($level->skill_level) . '_course' : ''; @endphp
                                            <i class="fas fa-star"></i> {{ __('inkwave.cc_lbl_level') }}: {{ ($level && Lang::has('inkwave.' . $lvl_key)) ? __('inkwave.' . $lvl_key) : ($level ? ucfirst($level->skill_level) : 'N/A') }}
                                        @else
                                            <i class="fas fa-gift"></i> {{ __('inkwave.cart_item_topup') }}
                                        @endif
                                    </span>
                                </div>

                                <div class="ag-cart-card__meta">
                                    <div class="ag-cart-card__col">
                                        @if($is_course)
                                            <span class="ag-cart-card__label">{{ __('inkwave.cart_tag_credit') }}</span>
                                            <span class="ag-cart-card__val"><i class="fas fa-coins"></i> {{ number_format($cart->points) }}</span>
                                        @else
                                            <span class="ag-cart-card__val">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</span>
                                            <span class="ag-cart-card__subval">({{ number_format($cart->points) }} {{ __('inkwave.cart_tag_credit') }})</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('cart-delete', $cart->id) }}" class="ag-cart-card__remove" title="{{ __('inkwave.cart_btn_del') }}"><i class="fas fa-times"></i></a>
                                </div>
                                
                            </div>
                        @endforeach
                    </div>

                    {{-- Summary --}}
                    <aside>
                        <div class="ag-summary-card">
                            <h3 class="ag-summary-title"><i class="fas fa-receipt"></i> {{ __('inkwave.cart_box_summary') }}</h3>

                            @php $total_points = Helper::totalCartPoints(); @endphp

                            <div class="ag-summary-row">
                                <span>{{ __('inkwave.cart_item_count') }}:</span>
                                <span>{{ $itemCount }}</span>
                            </div>

                            <div class="ag-summary-total">
                                <span class="lbl">{{ __('inkwave.cart_box_total') }}:</span>
                                <span class="amt">{{ number_format($total_points) }} <small>{{ __('inkwave.cart_tag_credit') }}</small></span>
                            </div>

                            <div class="ag-summary-actions">
                                <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST">@csrf</form>
                                <button type="button" class="ag-primary-btn" onclick="document.getElementById('redeemPointsForm').submit();">
                                    <i class="fas fa-lock"></i> {{ __('inkwave.cc_btn_redeem') }}
                                </button>
                                <a href="{{ route('product-lists') }}" class="ag-ghost-btn"><i class="fas fa-plus"></i> {{ __('inkwave.cart_btn_shop') }}</a>
                            </div>
                        </div>
                    </aside>
                </div>
            @else
                <div class="ag-cart-empty">
                    <i class="fas fa-ghost"></i>
                    <h3>{{ __('inkwave.cart_mt_heading') }}</h3>
                    <p>{{ __('inkwave.cc_mt_desc') }}</p>
                    <a href="{{ route('product-lists') }}" class="ag-primary-btn" style="display:inline-block !important; width:250px; margin: 0 auto;">{{ __('inkwave.cart_btn_shop') }}</a>
                </div>
            @endif

        @else
            <div class="ag-cart-empty">
                <i class="fas fa-lock"></i>
                <h3>{{ __('inkwave.cc_auth_req') }}</h3>
                <p>{{ __('inkwave.cc_auth_msg') }}</p>
                <a href="{{ route('login.form') }}" class="ag-primary-btn" style="display:inline-block !important; width:250px; margin: 0 auto;">
                    <i class="fas fa-sign-in-alt"></i> {{ __('inkwave.login_pg_title') }}
                </a>
            </div>
        @endauth
    </div>
</div>
@endsection
