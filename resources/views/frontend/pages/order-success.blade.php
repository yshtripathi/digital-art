@extends('frontend.layouts.main')
@section('title', __('inkwave.credit_ok_title'))
@php
use App\Models\Order;
$order = Order::where('trans_id', $transaction_id)->first();
@endphp
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.credit_ok_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.credit_ok_title')]
    ]
])

<style>
/* ==========================================================================
   Art Courses — Order Success Page
   ========================================================================== */
.ag-page-wrapper, .ag-page-wrapper *, .ag-page-wrapper *::before, .ag-page-wrapper *::after {
    box-sizing: border-box;
}
.ag-page-wrapper {
    padding: 40px 40px;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ag-alert-card {
    background: #ffffff;
    max-width: 650px;
    width: 100%;
    padding: 64px 48px;
    text-align: center;
    box-shadow: 0 30px 60px rgba(0,0,0,0.05);
    border-top: 6px solid #2e7d32; /* Green success border */
}
@media (max-width: 768px) {
    .ag-alert-card { padding: 40px 24px; }
}

.ag-alert-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 32px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 32px;
    background: #e8f5e9;
    color: #2e7d32;
}

.ag-alert-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 36px;
    color: #000000;
    margin-bottom: 16px;
    line-height: 1.2;
}
.ag-alert-desc {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 16px;
    color: #555555;
    line-height: 1.6;
    margin-bottom: 40px;
}

/* Receipt Details */
.ag-receipt-box {
    background: #faf8f5; /* Bone tint */
    border: 1px solid #e5dccb;
    border-top: 4px solid #bc9c5c; /* Gold accent */
    padding: 32px;
    margin-bottom: 40px;
    text-align: left;
}
.ag-receipt-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    border-bottom: 1px dashed rgba(0,0,0,0.1);
    padding-bottom: 8px;
}
.ag-receipt-row:last-child { 
    margin-bottom: 0; 
    border-bottom: none; 
    padding-bottom: 0; 
}
.ag-receipt-row span { color: #888888; text-transform: uppercase; letter-spacing: 0.1em; font-size: 12px; }
.ag-receipt-row strong { color: #000000; font-weight: bold; font-size: 16px; }

.ag-status-pill {
    background: #000000;
    color: #ffffff;
    padding: 4px 12px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

/* Actions */
.ag-alert-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: center;
}
.ag-submit-btn, .ag-ghost-btn {
    padding: 16px 24px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1px solid #000000;
}
.ag-submit-btn { background: #000000; color: #ffffff; }
.ag-submit-btn:hover { background: #ffffff; color: #000000; }
.ag-ghost-btn { background: transparent; color: #000000; }
.ag-ghost-btn:hover { background: #f5f5f5; }

.ag-alert-note {
    margin-top: 40px;
    padding-top: 32px;
    border-top: 1px solid rgba(0,0,0,0.1);
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    color: #888888;
    line-height: 1.6;
}
.ag-alert-note a {
    color: #bc9c5c;
    font-weight: bold;
    text-decoration: underline;
}
</style>

<div class="ag-page-wrapper">
    <div class="ag-alert-card">
        
        <div class="ag-alert-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h1 class="ag-alert-title">{{ __('inkwave.credit_ok_heading') }}</h1>
        <p class="ag-alert-desc">{{ __('inkwave.credit_ok_msg') }}</p>

        @if($order)
            @php
                $currency = match($order->currency) {
                    'USD' => '$',
                    'JPY' => '&yen;',
                    'HKD' => 'HK$',
                    default => '$',
                };
            @endphp
            <div class="ag-receipt-box">
                <div class="ag-receipt-row">
                    <span>{{ __('inkwave.credit_ok_number') }}</span>
                    <strong>{{ $order->order_number }}</strong>
                </div>
                <div class="ag-receipt-row">
                    <span>{{ __('inkwave.credit_ok_amount') }}</span>
                    <strong>{!! $currency !!} {{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</strong>
                </div>
                <div class="ag-receipt-row">
                    <span>{{ __('inkwave.credit_ok_trans') }}</span>
                    <strong>{{ $transaction_id }}</strong>
                </div>
                <div class="ag-receipt-row">
                    <span>{{ __('inkwave.credit_ok_status') }}</span>
                    <span class="ag-status-pill">{{ ucwords($order->payment_status) }}</span>
                </div>
            </div>
        @endif

        <div class="ag-alert-actions">
            @if($order)
                <a href="{{ route('user.order.show', $order->id) }}" class="ag-submit-btn">
                    <i class="fas fa-eye"></i> {{ __('inkwave.credit_ok_view') }}
                </a>
            @endif
            <a href="{{ route('home') }}" class="ag-ghost-btn">
                <i class="fas fa-home"></i> {{ __('inkwave.credit_ok_home') }}
            </a>
            @if($order)
                <a href="{{ route('order.pdf', $order->id) }}" class="ag-ghost-btn">
                    <i class="fas fa-download"></i> {{ __('inkwave.credit_ok_invoice') }}
                </a>
            @endif
        </div>

        @if($email_status == 'inactive' && $order)
            <p class="ag-alert-note">
                {{ __('inkwave.credit_ok_note') }} 
                <a href="{{ route('order.pdf', $order->id) }}">{{ __('inkwave.credit_ok_invoice') }}</a>
            </p>
        @endif
        
    </div>
</div>

@endsection
