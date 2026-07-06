@extends('frontend.layouts.main')
@section('title', 'Cart')
@section('main-content')

<x-breadcrumb :title="__('common.cart')" />

<section class="cart-wrap">
    <div class="cart-container">
        @if(Helper::cartCount())
            @php
                $cartItems = Helper::getAllProductFromCart();
                $subtotal = 0;
                foreach($cartItems as $item) { $subtotal += $item['price']; }
                $discount = session()->has('coupon') ? Session::get('coupon')['value'] : 0;
                $total_amount = $subtotal - $discount;
                $sym = Helper::getCurrencySymbol(session('currency'));
                $isJPY = session('currency') == 'JPY';
            @endphp

            <div class="cart-grid">
                {{-- Items --}}
                <div class="cart-items">
                    <h2 class="cart-h"><i class="fas fa-shopping-cart"></i> {{ __('common.item_summary') }}</h2>

                    <div class="cart-list">
                        @foreach($cartItems as $cart)
                            @php
                                $item_title = __('common.points_top_up') ?? 'Credits Top Up';
                                $item_link = '#';
                                if($cart->product) {
                                    $item_title = $cart->product->title;
                                    $item_link = route('product-detail', $cart->product->slug);
                                }
                            @endphp
                            <div class="cart-item">
                                <div class="cart-item__main">
                                    <a href="{{ $item_link }}" class="cart-item__title">{{ $item_title }}</a>
                                    <span class="cart-item__tag">{{ $cart->product ? __('common.art_category') : __('common.credits') }}</span>
                                </div>

                                <div class="cart-item__meta">
                                    <div class="cart-item__col">
                                        <span class="cart-item__label">{{ __('common.points') }}</span>
                                        <span class="cart-item__val"><i class="fas fa-coins"></i>{{ number_format($cart->points) }} {{ __('common.credits') }}</span>
                                    </div>
                                    <div class="cart-item__col">
                                        <span class="cart-item__label">{{ __('common.price') }}</span>
                                        <span class="cart-item__val">{{ $sym }}{{ number_format($cart['price'], $isJPY ? 0 : 2) }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('cart-delete', $cart->id) }}" class="cart-item__remove" aria-label="{{ __('common.remove') }}"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Summary --}}
                <aside>
                    <div class="cart-summary__card">
                        <h3 class="cart-summary__h">{{ __('common.order_summary') }}</h3>

                        <div class="cart-summary__row">
                            <span>{{ __('common.total') }}</span>
                            <span>{{ $sym }}{{ number_format($subtotal, $isJPY ? 0 : 2) }}</span>
                        </div>
                        @if($discount > 0)
                            <div class="cart-summary__row">
                                <span>{{ __('common.coupon') ?? 'Discount' }}</span>
                                <span>&minus; {{ $sym }}{{ number_format($discount, $isJPY ? 0 : 2) }}</span>
                            </div>
                        @endif

                        <div class="cart-summary__total">
                            <span class="lbl">{{ __('common.total') }}</span>
                            <span class="amt">{{ $sym }}{{ number_format($total_amount, $isJPY ? 0 : 2) }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="cart-btn cart-btn--primary">{{ __('common.checkout') }} <i class="fas fa-arrow-right"></i></a>

                        @if(Helper::totalCartPoints() > 0)
                            <a href="{{ route('product-lists') }}" class="cart-btn cart-btn--ghost"><i class="fas fa-arrow-left"></i> {{ __('common.continue_shopping') }}</a>
                        @endif

                        <div class="cart-pay">
                            <img src="{{ asset('assets/images/payment.webp') }}" alt="Payments">
                        </div>
                    </div>
                </aside>
            </div>
        @else
            <div class="cart-empty">
                <i class="fas fa-shopping-basket"></i>
                <h3>{{ __('common.no_cart_available') }}</h3>
                <p>{{ __('common.summary_empty') }}</p>
                <a href="{{ route('product-lists') }}" class="cart-btn cart-btn--primary cart-empty__btn">{{ __('common.continue_shopping') }} <i class="fas fa-arrow-right"></i></a>
            </div>
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
    /* =========================================================
       CART — Structured theme (items list + sticky summary)
       ========================================================= */
    .cart-wrap { background-color: var(--color-putty, #c4c3b6); padding: 72px 40px; }
    .cart-container { max-width: 1160px; margin: 0 auto; }

    .cart-grid { display: grid; grid-template-columns: 1.7fr 1fr; gap: 28px; align-items: start; }

    /* Items panel */
    .cart-items {
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 14px; padding: 32px;
    }
    .cart-h {
        font-family: var(--font-davinci, serif); font-size: 22px; font-weight: 500;
        color: var(--color-ink, #000); margin: 0 0 20px 0;
        display: flex; align-items: center; gap: 10px;
    }
    .cart-h i { font-size: 15px; }
    .cart-list { display: flex; flex-direction: column; }
    .cart-item {
        display: flex; align-items: center; gap: 20px;
        padding: 18px 0; border-bottom: 1px solid var(--color-vellum, #dfdcd5);
    }
    .cart-item:last-child { border-bottom: none; padding-bottom: 0; }
    .cart-item:first-child { padding-top: 0; }
    .cart-item__main { flex: 1 1 auto; min-width: 0; }
    .cart-item__title {
        display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; font-weight: 600;
        color: var(--color-ink, #000); text-decoration: none; margin-bottom: 7px; word-break: break-word;
    }
    .cart-item__title:hover { text-decoration: underline; }
    .cart-item__tag {
        display: inline-block; font-family: var(--font-helvetica-now, sans-serif);
        font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em;
        color: var(--color-ink, #000); background-color: var(--color-bone, #e7e5e4);
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 28.8px; padding: 3px 10px;
    }
    .cart-item__meta { display: flex; gap: 28px; flex-shrink: 0; }
    .cart-item__col { display: flex; flex-direction: column; gap: 4px; text-align: right; }
    .cart-item__label {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-graphite, #595855);
    }
    .cart-item__val {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; font-weight: 600;
        color: var(--color-ink, #000); white-space: nowrap;
    }
    .cart-item__val i { color: var(--color-graphite, #595855); margin-right: 5px; }
    .cart-item__remove {
        flex-shrink: 0; width: 38px; height: 38px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5);
        color: var(--color-ink, #000); font-size: 14px; transition: all 0.2s ease;
    }
    .cart-item__remove:hover { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); }

    /* Summary */
    .cart-summary__card {
        position: sticky; top: 96px;
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 14px; padding: 28px;
    }
    .cart-summary__h {
        font-family: var(--font-davinci, serif); font-size: 20px; font-weight: 500;
        color: var(--color-ink, #000); margin: 0 0 18px 0;
    }
    .cart-summary__row {
        display: flex; justify-content: space-between; align-items: center; padding: 8px 0;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-graphite, #595855);
    }
    .cart-summary__row span:last-child { color: var(--color-ink, #000); font-weight: 600; }
    .cart-summary__total {
        display: flex; justify-content: space-between; align-items: baseline;
        padding: 16px 0 20px 0; margin-top: 8px; border-top: 1px solid var(--color-vellum, #dfdcd5);
    }
    .cart-summary__total .lbl {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px;
        text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-graphite, #595855);
    }
    .cart-summary__total .amt { font-family: var(--font-davinci, serif); font-size: 28px; font-weight: 500; color: var(--color-ink, #000); }

    .cart-btn {
        display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        border-radius: 28.8px; padding: 14px; text-decoration: none; box-sizing: border-box;
        transition: opacity 0.2s ease, background-color 0.2s ease;
    }
    .cart-btn--primary { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border: 1px solid var(--color-ink, #000); }
    .cart-btn--primary:hover { opacity: 0.85; color: var(--color-paper, #fff); }
    .cart-btn--ghost { background-color: transparent; color: var(--color-ink, #000); border: 1px solid var(--color-vellum, #dfdcd5); margin-top: 12px; }
    .cart-btn--ghost:hover { background-color: var(--color-bone, #e7e5e4); color: var(--color-ink, #000); }

    .cart-pay { text-align: center; margin-top: 22px; }
    .cart-pay img { max-height: 30px; width: auto; opacity: 0.55; }

    /* Empty state */
    .cart-empty {
        max-width: 620px; margin: 0 auto; text-align: center;
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 14px; padding: 72px 32px;
    }
    .cart-empty i { font-size: 46px; color: var(--color-graphite, #595855); opacity: 0.4; margin-bottom: 22px; }
    .cart-empty h3 { font-family: var(--font-davinci, serif); font-size: 24px; font-weight: 500; color: var(--color-ink, #000); margin: 0 0 8px 0; }
    .cart-empty p { font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-graphite, #595855); margin: 0 0 24px 0; }
    .cart-empty__btn { width: auto; display: inline-flex; padding: 13px 28px; }

    @media (max-width: 900px) {
        .cart-wrap { padding: 48px 20px; }
        .cart-grid { grid-template-columns: 1fr; gap: 20px; }
        .cart-summary__card { position: static; }
    }
    @media (max-width: 520px) {
        .cart-items { padding: 24px; }
        .cart-item { flex-wrap: wrap; gap: 14px; }
        .cart-item__meta { gap: 20px; }
        .cart-item__col { text-align: left; }
    }
</style>
@endpush
