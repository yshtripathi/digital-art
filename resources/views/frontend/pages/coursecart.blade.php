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

@push('styles')
<style>
    /* =========================================================
       COURSE / CREDITS CART — Structured theme
       ========================================================= */
    .cc-section { background-color: var(--color-putty, #c4c3b6); padding: 72px 40px; }
    .cc-container { max-width: 1160px; margin: 0 auto; }

    /* Credits balance bar */
    .cc-balance {
        display: flex; align-items: center; gap: 16px;
        background-color: var(--color-ink, #000); color: var(--color-paper, #fff);
        border-radius: 14px; padding: 20px 26px; margin-bottom: 24px;
    }
    .cc-balance__icon {
        width: 46px; height: 46px; flex-shrink: 0; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background-color: rgba(255, 255, 255, 0.12); color: var(--color-paper, #fff); font-size: 18px;
    }
    .cc-balance__label { display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255, 255, 255, 0.6); margin-bottom: 2px; }
    .cc-balance__amount { font-family: var(--font-davinci, serif); font-size: 26px; font-weight: 500; color: var(--color-paper, #fff); }
    .cc-balance__amount small { font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; color: rgba(255, 255, 255, 0.6); }

    .cc-grid { display: grid; grid-template-columns: 1.7fr 1fr; gap: 28px; align-items: start; }

    .cc-items { background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 14px; padding: 30px; }
    .cc-h { font-family: var(--font-davinci, serif); font-size: 20px; font-weight: 500; color: var(--color-ink, #000); margin: 0 0 20px 0; display: flex; align-items: center; gap: 10px; }
    .cc-h i { font-size: 15px; }

    /* NEW card design — horizontal thumbnail card */
    .cc-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .cc-card {
        position: relative; display: flex; gap: 16px; padding: 16px;
        background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 12px; transition: transform 0.3s ease, border-color 0.2s ease;
    }
    .cc-card:hover { transform: translateY(-4px); border-color: var(--color-graphite, #595855); }
    .cc-card__remove {
        position: absolute; top: 10px; right: 10px; z-index: 2;
        width: 28px; height: 28px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5);
        color: var(--color-graphite, #595855); font-size: 12px; transition: all 0.2s ease;
    }
    .cc-card__remove:hover { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); }
    .cc-card__img { width: 92px; height: 92px; flex-shrink: 0; overflow: hidden; border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 9px; background-color: var(--color-bone, #e7e5e4); }
    .cc-card__img img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .cc-card__body { flex: 1 1 auto; min-width: 0; padding-right: 20px; }
    .cc-card__title {
        display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; font-weight: 600;
        color: var(--color-ink, #000); text-decoration: none; line-height: 1.35; margin-bottom: 8px; word-break: break-word;
    }
    .cc-card__title:hover { text-decoration: underline; }
    .cc-card__pill {
        display: inline-flex; align-items: center; gap: 6px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-ink, #000);
        background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 28.8px; padding: 4px 10px; margin-bottom: 12px;
    }
    .cc-card__cost { display: flex; flex-wrap: wrap; align-items: baseline; gap: 6px; }
    .cc-card__credits, .cc-card__price { font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; font-weight: 700; color: var(--color-ink, #000); }
    .cc-card__credits i { color: var(--color-graphite, #595855); margin-right: 3px; }
    .cc-card__sub { font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; color: var(--color-graphite, #595855); }

    /* Summary */
    .cc-summary { position: sticky; top: 96px; background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 14px; padding: 28px; }
    .cc-summary__h { font-family: var(--font-davinci, serif); font-size: 20px; font-weight: 500; color: var(--color-ink, #000); margin: 0 0 20px 0; display: flex; align-items: center; gap: 10px; }
    .cc-summary__h i { font-size: 15px; }
    .cc-summary__row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-graphite, #595855); border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .cc-summary__row span:last-child { color: var(--color-ink, #000); font-weight: 600; }
    .cc-summary__total { display: flex; justify-content: space-between; align-items: baseline; padding: 18px 0 22px 0; }
    .cc-summary__total .lbl { font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-graphite, #595855); }
    .cc-summary__total .amt { font-family: var(--font-davinci, serif); font-size: 26px; font-weight: 500; color: var(--color-ink, #000); }
    .cc-summary__total .amt small { font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; color: var(--color-graphite, #595855); }
    .cc-summary__empty { text-align: center; padding: 20px 0; }
    .cc-summary__empty i { font-size: 24px; color: var(--color-graphite, #595855); opacity: 0.4; margin-bottom: 10px; }
    .cc-summary__empty p { font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-graphite, #595855); margin: 0; }

    /* Buttons */
    .cc-btn {
        display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-sizing: border-box;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        border-radius: 28.8px; padding: 14px; text-decoration: none; cursor: pointer; border: 1px solid transparent;
        transition: opacity 0.2s ease, background-color 0.2s ease;
    }
    .cc-btn--primary { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); margin-bottom: 12px; }
    .cc-btn--primary:hover { opacity: 0.85; color: var(--color-paper, #fff); }
    .cc-btn--ghost { background-color: transparent; color: var(--color-ink, #000); border-color: var(--color-vellum, #dfdcd5); }
    .cc-btn--ghost:hover { background-color: var(--color-bone, #e7e5e4); color: var(--color-ink, #000); }

    /* Empty / sign-in */
    .cc-empty { text-align: center; padding: 56px 20px; }
    .cc-empty i { font-size: 44px; color: var(--color-graphite, #595855); opacity: 0.35; margin-bottom: 18px; }
    .cc-empty h3 { font-family: var(--font-davinci, serif); font-size: 22px; font-weight: 500; color: var(--color-ink, #000); margin: 0 0 8px 0; }
    .cc-empty p { font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-graphite, #595855); margin: 0 0 22px 0; }
    .cc-empty__btn, .cc-signin__btn { width: auto; display: inline-flex; padding: 13px 26px; }

    .cc-signin {
        max-width: 560px; margin: 0 auto; text-align: center;
        background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 14px; padding: 72px 40px;
    }
    .cc-signin i { font-size: 44px; color: var(--color-graphite, #595855); opacity: 0.4; margin-bottom: 20px; }
    .cc-signin h3 { font-family: var(--font-davinci, serif); font-size: 24px; font-weight: 500; color: var(--color-ink, #000); margin: 0 0 8px 0; }
    .cc-signin p { font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-graphite, #595855); margin: 0 auto 24px auto; max-width: 380px; }

    @media (max-width: 900px) {
        .cc-section { padding: 48px 20px; }
        .cc-grid { grid-template-columns: 1fr; gap: 20px; }
        .cc-summary { position: static; }
    }
    @media (max-width: 560px) {
        .cc-items { padding: 22px; }
        .cc-cards { grid-template-columns: 1fr; }
    }
</style>
@endpush
