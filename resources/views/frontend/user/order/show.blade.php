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
/* ==========================================================================
   Art Courses — Order Details Receipt (Premium Theme)
   ========================================================================== */
.ag-page-wrapper, .ag-page-wrapper *, .ag-page-wrapper *::before, .ag-page-wrapper *::after {
    box-sizing: border-box;
}
.ag-page-wrapper {
   
    padding: 40px 40px;
    min-height: 80vh;
}
.ag-container {
    max-width: 1000px; /* Slightly wider than success alert, for detailed receipt */
    margin: 0 auto;
    padding: 0 5%;
}

.ag-receipt-card {
    background: #ffffff;
    padding: 64px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.05);
    border-top: 8px solid #000000; /* Solid Black Top */
}
@media (max-width: 768px) {
    .ag-receipt-card { padding: 40px 24px; }
}

/* Header */
.ag-receipt-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 48px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding-bottom: 32px;
}
@media (max-width: 768px) {
    .ag-receipt-head { flex-direction: column; gap: 24px; }
}
.ag-receipt-eyebrow {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #888888;
    margin-bottom: 8px;
    font-weight: bold;
    display: block;
}
.ag-receipt-num {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 48px;
    color: #000000;
    margin: 0;
    line-height: 1.1;
}

/* Actions */
.ag-receipt-actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
}
.ag-receipt-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 16px 24px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
}
.ag-receipt-btn--ghost {
    background: transparent;
    color: #000000;
    border: 1px solid #000000;
}
.ag-receipt-btn--ghost:hover {
    background: #f5f5f5;
}
.ag-receipt-btn--primary {
    background: #000000;
    color: #ffffff;
    border: 1px solid #000000;
}
.ag-receipt-btn--primary:hover {
    background: #ffffff;
    color: #000000;
}

/* Summary Strip */
.ag-receipt-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    background: #faf8f5; /* Subtle Bone/Gold tint */
    border: 1px solid #e5dccb;
    border-top: 4px solid #bc9c5c;
    padding: 32px;
    margin-bottom: 48px;
    gap: 32px;
}
@media (max-width: 768px) {
    .ag-receipt-summary { grid-template-columns: 1fr; gap: 24px; }
}
.ag-summary-item {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.ag-summary-label {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #888888;
    font-weight: bold;
}
.ag-summary-val {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 32px;
    color: #000000;
    font-weight: bold;
}
.ag-receipt-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    background: #eeeeee;
    color: #333333;
    width: fit-content;
}
.ag-receipt-tag--solid {
    background: #000000;
    color: #ffffff;
}
.ag-receipt-tag i { color: #2e7d32; font-size: 14px; }

/* Details Grid */
.ag-receipt-h {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 28px;
    color: #000000;
    margin-bottom: 32px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.ag-receipt-h i { color: #bc9c5c; font-size: 24px; }

.ag-details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px 48px;
}
@media (max-width: 768px) {
    .ag-details-grid { grid-template-columns: 1fr; gap: 24px; }
}
.ag-detail-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
    border-bottom: 1px dashed rgba(0,0,0,0.1);
    padding-bottom: 16px;
}
.ag-detail-field--wide {
    grid-column: 1 / -1;
}
.ag-detail-label {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #888888;
    font-weight: bold;
}
.ag-detail-value {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 16px;
    color: #000000;
    font-weight: bold;
}
.ag-detail-value i {
    color: #bc9c5c;
    margin-right: 6px;
}
</style>

<div class="ag-page-wrapper">
    <div class="ag-container">
        @if($order)
            @php
                $currency = match($order->currency) {
                    'USD' => '$',
                    'JPY' => '&yen;',
                    'HKD' => 'HK$',
                    default => '$',
                };
                $totalFmt = $currency . ' ' . number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2);
            @endphp

            <div class="ag-receipt-card">
                {{-- Header --}}
                <div class="ag-receipt-head">
                    <div>
                        <span class="ag-receipt-eyebrow">{{ __('inkwave.receipt_title') }}</span>
                        <h1 class="ag-receipt-num">#{{ $order->order_number }}</h1>
                    </div>
                    <div class="ag-receipt-actions">
                        <button type="button" onclick="window.history.back();" class="ag-receipt-btn ag-receipt-btn--ghost">
                            <i class="fas fa-arrow-left"></i> {{ __('inkwave.receipt_back') }}
                        </button>
                        <a href="{{ route('order.pdf', $order->id) }}" class="ag-receipt-btn ag-receipt-btn--primary">
                            <i class="fas fa-download"></i> {{ __('inkwave.receipt_generate_pdf') }}
                        </a>
                    </div>
                </div>

                {{-- Summary strip --}}
                <div class="ag-receipt-summary">
                    <div class="ag-summary-item">
                        <span class="ag-summary-label">{{ __('inkwave.receipt_total_amount') }}</span>
                        <span class="ag-summary-val">{!! $totalFmt !!}</span>
                    </div>
                    <div class="ag-summary-item">
                        <span class="ag-summary-label">{{ __('inkwave.receipt_order_status') }}</span>
                        <span class="ag-receipt-tag ag-receipt-tag--solid">{{ ucwords($order->status) }}</span>
                    </div>
                    <div class="ag-summary-item">
                        <span class="ag-summary-label">{{ __('inkwave.receipt_payment_status') }}</span>
                        <span class="ag-receipt-tag"><i class="fas fa-check-circle"></i> {{ ucwords($order->payment_status) }}</span>
                    </div>
                </div>

                {{-- Details --}}
                <h2 class="ag-receipt-h"><i class="fas fa-clipboard-list"></i> {{ __('inkwave.receipt_order_information') }}</h2>
                
                <div class="ag-details-grid">
                    <div class="ag-detail-field">
                        <span class="ag-detail-label">{{ __('inkwave.receipt_order_number') }}</span>
                        <span class="ag-detail-value">{{ $order->order_number }}</span>
                    </div>
                    <div class="ag-detail-field">
                        <span class="ag-detail-label">{{ __('inkwave.receipt_name') }}</span>
                        <span class="ag-detail-value">{{ $order->first_name }} {{ $order->last_name }}</span>
                    </div>
                    <div class="ag-detail-field">
                        <span class="ag-detail-label">{{ __('inkwave.receipt_email') }}</span>
                        <span class="ag-detail-value">{{ $order->email }}</span>
                    </div>
                    <div class="ag-detail-field">
                        <span class="ag-detail-label">{{ __('inkwave.receipt_order_date') }}</span>
                        <span class="ag-detail-value">{{ $order->created_at->format('D d M, Y') }} {{ __('inkwave.receipt_at_time') }} {{ $order->created_at->format('g:i a') }}</span>
                    </div>
                    <div class="ag-detail-field">
                        <span class="ag-detail-label">{{ __('inkwave.receipt_quantity') }}</span>
                        <span class="ag-detail-value">{{ $order->quantity }}</span>
                    </div>
                    <div class="ag-detail-field">
                        <span class="ag-detail-label">{{ __('inkwave.receipt_payment_method') }}</span>
                        <span class="ag-detail-value"><i class="far fa-credit-card"></i> {{ __('inkwave.receipt_credit_card') }}</span>
                    </div>
                    <div class="ag-detail-field ag-detail-field--wide">
                        <span class="ag-detail-label">{{ __('inkwave.receipt_transaction_id') }}</span>
                        <span class="ag-detail-value">{{ $order->trans_id }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
