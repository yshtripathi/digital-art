@extends('frontend.layouts.main')
@section('title', __('inkwave.od_title'))

@section('main-content')

<x-breadcrumb :title="__('inkwave.od_title')" />

<section class="od-section">
    <div class="od-container">
        @if($order)
            @php
                $currency = match($order->currency) {
                    'USD' => '$',
                    'JPY' => '¥',
                    'HKD' => 'HK$',
                    default => '$',
                };
                $totalFmt = $currency . ' ' . number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2);
            @endphp

            <div class="od-card">
                {{-- Header --}}
                <div class="od-head">
                    <div>
                        <p class="od-eyebrow">{{ __('inkwave.od_title') }}</p>
                        <h1 class="od-num">#{{ $order->order_number }}</h1>
                    </div>
                    <div class="od-actions">
                        <button type="button" onclick="window.history.back();" class="od-btn od-btn--ghost"><i class="fas fa-arrow-left"></i> {{ __('inkwave.od_back') }}</button>
                        <a href="{{ route('order.pdf', $order->id) }}" class="od-btn od-btn--primary"><i class="fas fa-download"></i> {{ __('inkwave.od_generate_pdf') }}</a>
                    </div>
                </div>

                {{-- Summary strip --}}
                <div class="od-summary">
                    <div class="od-summary__item">
                        <span class="od-summary__label">{{ __('inkwave.od_total_amount') }}</span>
                        <span class="od-summary__amt">{{ $totalFmt }}</span>
                    </div>
                    <div class="od-summary__item">
                        <span class="od-summary__label">{{ __('inkwave.od_order_status') }}</span>
                        <span class="od-tag od-tag--solid">{{ ucwords($order->status) }}</span>
                    </div>
                    <div class="od-summary__item">
                        <span class="od-summary__label">{{ __('inkwave.od_payment_status') }}</span>
                        <span class="od-tag">{{ ucwords($order->payment_status) }}</span>
                    </div>
                </div>

                {{-- Details --}}
                <h2 class="od-h">{{ __('inkwave.od_order_information') }}</h2>
                <div class="od-grid">
                    <div class="od-field">
                        <span class="od-field__label">{{ __('inkwave.od_order_number') }}</span>
                        <span class="od-field__value">{{ $order->order_number }}</span>
                    </div>
                    <div class="od-field">
                        <span class="od-field__label">{{ __('inkwave.od_name') }}</span>
                        <span class="od-field__value">{{ $order->first_name }} {{ $order->last_name }}</span>
                    </div>
                    <div class="od-field">
                        <span class="od-field__label">{{ __('inkwave.od_email') }}</span>
                        <span class="od-field__value">{{ $order->email }}</span>
                    </div>
                    <div class="od-field">
                        <span class="od-field__label">{{ __('inkwave.od_order_date') }}</span>
                        <span class="od-field__value">{{ $order->created_at->format('D d M, Y') }} {{ __('inkwave.od_at_time') }} {{ $order->created_at->format('g:i a') }}</span>
                    </div>
                    <div class="od-field">
                        <span class="od-field__label">{{ __('inkwave.od_quantity') }}</span>
                        <span class="od-field__value">{{ $order->quantity }}</span>
                    </div>
                    <div class="od-field">
                        <span class="od-field__label">{{ __('inkwave.od_payment_method') }}</span>
                        <span class="od-field__value">{{ __('inkwave.od_credit_card') }}</span>
                    </div>
                    <div class="od-field od-field--wide">
                        <span class="od-field__label">{{ __('inkwave.od_transaction_id') }}</span>
                        <span class="od-field__value">{{ $order->trans_id }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
    /* =========================================================
       ORDER DETAIL — Structured theme (receipt layout)
       ========================================================= */
    .od-section { background-color: var(--color-putty, #c4c3b6); padding: 72px 40px; }
    .od-container { max-width: 860px; margin: 0 auto; }
    .od-card { background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 14px; padding: 40px; }

    .od-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 20px; flex-wrap: wrap; padding-bottom: 26px; margin-bottom: 26px; border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .od-eyebrow { font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.16em; color: var(--color-graphite, #595855); margin: 0 0 8px 0; }
    .od-num { font-family: var(--font-davinci, serif); font-size: clamp(26px, 3.4vw, 36px); font-weight: 500; letter-spacing: -0.01em; color: var(--color-ink, #000); margin: 0; }
    .od-actions { display: flex; gap: 10px; flex-wrap: wrap; }
    .od-btn { display: inline-flex; align-items: center; gap: 8px; font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; border-radius: 28.8px; padding: 11px 20px; text-decoration: none; cursor: pointer; border: 1px solid transparent; transition: opacity 0.2s ease, background-color 0.2s ease; }
    .od-btn--primary { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); }
    .od-btn--primary:hover { opacity: 0.85; color: var(--color-paper, #fff); }
    .od-btn--ghost { background-color: transparent; color: var(--color-ink, #000); border-color: var(--color-vellum, #dfdcd5); }
    .od-btn--ghost:hover { background-color: var(--color-bone, #e7e5e4); }

    /* Summary strip */
    .od-summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 34px; }
    .od-summary__item { background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 10px; padding: 18px 20px; }
    .od-summary__label { display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-graphite, #595855); margin-bottom: 8px; }
    .od-summary__amt { font-family: var(--font-davinci, serif); font-size: 24px; font-weight: 500; color: var(--color-ink, #000); }
    .od-tag { display: inline-block; background-color: transparent; color: var(--color-ink, #000); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 28.8px; padding: 5px 14px; font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; }
    .od-tag--solid { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); }

    /* Details grid */
    .od-h { font-family: var(--font-davinci, serif); font-size: 20px; font-weight: 500; color: var(--color-ink, #000); margin: 0 0 18px 0; }
    .od-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .od-field { background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 10px; padding: 16px 18px; }
    .od-field--wide { grid-column: 1 / -1; }
    .od-field__label { display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-graphite, #595855); margin-bottom: 6px; }
    .od-field__value { font-family: var(--font-helvetica-now, sans-serif); font-size: 14.5px; font-weight: 500; color: var(--color-ink, #000); word-break: break-word; }

    @media (max-width: 700px) {
        .od-section { padding: 48px 20px; }
        .od-card { padding: 28px 22px; }
        .od-head { flex-direction: column; }
        .od-actions { width: 100%; }
        .od-btn { flex: 1 1 auto; justify-content: center; }
        .od-summary { grid-template-columns: 1fr; }
        .od-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush
