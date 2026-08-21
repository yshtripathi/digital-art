@extends('frontend.layouts.main')
@section('title', __('inkwave.receipt_title'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.receipt_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.db_my_account'), 'url' => route('user')],
        ['name' => __('inkwave.receipt_title')]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme Order Details - Artora
------------------------------------------- */
.duo-od-wrap {
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    background: #ffffff;
    padding-bottom: 100px;
}
.duo-od-wrap a { text-decoration: none !important; }

.duo-od-container {
    max-width: 800px;
    margin: 48px auto;
    padding: 0 24px;
}

.duo-od-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    padding: 48px;
    box-shadow: 0 12px 0 #e5e5e5;
}
@media (max-width: 600px) { .duo-od-card { padding: 24px; } }

/* Header */
.duo-od-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 32px;
    padding-bottom: 32px;
    border-bottom: 2px dashed #e5e5e5;
}
@media (max-width: 600px) { .duo-od-head { flex-direction: column; gap: 24px; } }

.duo-od-eyebrow {
    font-size: 16px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 8px;
}
.duo-od-num {
    font-size: 40px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
}

.duo-od-actions {
    display: flex;
    gap: 12px;
}
@media (max-width: 600px) { .duo-od-actions { width: 100%; flex-wrap: wrap; } .duo-od-actions a, .duo-od-actions button { flex:1; text-align:center; justify-content:center; } }

.duo-od-btn {
    border-radius: 16px;
    padding: 14px 24px;
    font-size: 16px;
    font-weight: 800;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.1s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: none;
    outline: none;
}
.duo-od-btn--ghost {
    background: #ffffff;
    color: var(--color-pencil-gray, #777777) !important;
    border: 2px solid #e5e5e5;
    box-shadow: 0 4px 0 #e5e5e5;
}
.duo-od-btn--ghost:hover { background: #f7f7f7; }
.duo-od-btn--ghost:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }

.duo-od-btn--primary {
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff !important;
    border: 2px solid #1899d6;
    box-shadow: 0 4px 0 #1899d6;
}
.duo-od-btn--primary:hover { filter: brightness(1.05); }
.duo-od-btn--primary:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }

/* Summary Strip */
.duo-od-summary {
    background: #f7f7f7;
    border-radius: 24px;
    padding: 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 48px;
    border: 2px solid #e5e5e5;
}
@media (max-width: 600px) { .duo-od-summary { flex-direction: column; gap: 24px; align-items: flex-start; } }

.duo-od-summary__item {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.duo-od-summary__label {
    font-size: 16px;
    font-weight: 800;
    color: var(--color-pencil-gray, #777777);
}
.duo-od-summary__amt {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-macaw-yellow, #ffc800);
}

.duo-od-tag {
    display: inline-block;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 12px;
    padding: 8px 16px;
    font-size: 15px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
}
.duo-od-tag--solid {
    background: var(--color-eager-green, #58cc02);
    border-color: var(--color-eager-green, #58cc02);
    color: #ffffff;
}

/* Grid Details */
.duo-od-h {
    font-size: 24px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.duo-od-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}
@media (max-width: 600px) { .duo-od-grid { grid-template-columns: 1fr; } }

.duo-od-field {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.duo-od-field--wide {
    grid-column: 1 / -1;
}
.duo-od-field__label {
    font-size: 14px;
    font-weight: 800;
    color: var(--color-pencil-gray, #777777);
    text-transform: uppercase;
}
.duo-od-field__value {
    font-size: 18px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
}
</style>

<div class="duo-od-wrap">
    <div class="duo-od-container">
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

            <div class="duo-od-card">
                {{-- Header --}}
                <div class="duo-od-head">
                    <div>
                        <p class="duo-od-eyebrow">{{ __('inkwave.receipt_title') }}</p>
                        <h1 class="duo-od-num">#{{ $order->order_number }}</h1>
                    </div>
                    <div class="duo-od-actions">
                        <button type="button" onclick="window.history.back();" class="duo-od-btn duo-od-btn--ghost"><i class="fas fa-arrow-left"></i> {{ __('inkwave.receipt_back') }}</button>
                        <a href="{{ route('order.pdf', $order->id) }}" class="duo-od-btn duo-od-btn--primary"><i class="fas fa-download"></i> {{ __('inkwave.receipt_generate_pdf') }}</a>
                    </div>
                </div>

                {{-- Summary strip --}}
                <div class="duo-od-summary">
                    <div class="duo-od-summary__item">
                        <span class="duo-od-summary__label">{{ __('inkwave.receipt_total_amount') }}</span>
                        <span class="duo-od-summary__amt">{{ $totalFmt }}</span>
                    </div>
                    <div class="duo-od-summary__item">
                        <span class="duo-od-summary__label">{{ __('inkwave.receipt_order_status') }}</span>
                        <span class="duo-od-tag duo-od-tag--solid">{{ ucwords($order->status) }}</span>
                    </div>
                    <div class="duo-od-summary__item">
                        <span class="duo-od-summary__label">{{ __('inkwave.receipt_payment_status') }}</span>
                        <span class="duo-od-tag"><i class="fas fa-check-circle" style="color:var(--color-eager-green);margin-right:4px;"></i> {{ ucwords($order->payment_status) }}</span>
                    </div>
                </div>

                {{-- Details --}}
                <h2 class="duo-od-h"><i class="fas fa-clipboard-list"></i> {{ __('inkwave.receipt_order_information') }}</h2>
                <div class="duo-od-grid">
                    <div class="duo-od-field">
                        <span class="duo-od-field__label">{{ __('inkwave.receipt_order_number') }}</span>
                        <span class="duo-od-field__value">{{ $order->order_number }}</span>
                    </div>
                    <div class="duo-od-field">
                        <span class="duo-od-field__label">{{ __('inkwave.receipt_name') }}</span>
                        <span class="duo-od-field__value">{{ $order->first_name }} {{ $order->last_name }}</span>
                    </div>
                    <div class="duo-od-field">
                        <span class="duo-od-field__label">{{ __('inkwave.receipt_email') }}</span>
                        <span class="duo-od-field__value">{{ $order->email }}</span>
                    </div>
                    <div class="duo-od-field">
                        <span class="duo-od-field__label">{{ __('inkwave.receipt_order_date') }}</span>
                        <span class="duo-od-field__value">{{ $order->created_at->format('D d M, Y') }} {{ __('inkwave.receipt_at_time') }} {{ $order->created_at->format('g:i a') }}</span>
                    </div>
                    <div class="duo-od-field">
                        <span class="duo-od-field__label">{{ __('inkwave.receipt_quantity') }}</span>
                        <span class="duo-od-field__value">{{ $order->quantity }}</span>
                    </div>
                    <div class="duo-od-field">
                        <span class="duo-od-field__label">{{ __('inkwave.receipt_payment_method') }}</span>
                        <span class="duo-od-field__value"><i class="far fa-credit-card"></i> {{ __('inkwave.receipt_credit_card') }}</span>
                    </div>
                    <div class="duo-od-field duo-od-field--wide">
                        <span class="duo-od-field__label">{{ __('inkwave.receipt_transaction_id') }}</span>
                        <span class="duo-od-field__value">{{ $order->trans_id }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection


