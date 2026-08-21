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
/* -------------------------------------------
   Duolingo Theme Order Pages
------------------------------------------- */
.duo-order-wrapper {
    background-color: var(--color-paper-white, #ffffff);
    padding-bottom: 100px;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
}
.duo-container {
    max-width: 600px;
    margin: 64px auto;
    padding: 0 24px;
}
.duo-order-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    padding: 48px;
    box-shadow: 0 12px 0 #e5e5e5;
    text-align: center;
}
.duo-order-badge {
    width: 96px;
    height: 96px;
    border-radius: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    margin: 0 auto 32px;
    color: #ffffff;
}
.duo-order-badge--ok {
    background: var(--color-eager-green, #58cc02);
    border: 2px solid #46a302;
    box-shadow: 0 6px 0 #46a302;
}
.duo-order-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin: 0 0 16px 0;
}
.duo-order-sub {
    font-size: 19px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    margin: 0 0 32px 0;
    line-height: 1.5;
}
/* Details box */
.duo-order-details {
    background: #f7f7f7;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    padding: 24px;
    margin-bottom: 32px;
    text-align: left;
}
.duo-order-detail {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 2px solid #e5e5e5;
}
.duo-order-detail:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.duo-order-detail:first-child {
    padding-top: 0;
}
.duo-order-label {
    font-size: 15px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    text-transform: uppercase;
    letter-spacing: 0.053em;
}
.duo-order-value {
    font-size: 17px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
}
.duo-pill {
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    border: 2px solid #1899d6;
}
/* Actions */
.duo-order-actions {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.duo-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    padding: 20px;
    border-radius: 16px;
    font-size: 19px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.053em;
    cursor: pointer;
    transition: all 0.1s;
    text-decoration: none;
}
.duo-btn--primary {
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff;
    border: 2px solid #1899d6;
    box-shadow: 0 6px 0 #1899d6;
}
.duo-btn--primary:active {
    transform: translateY(6px);
    box-shadow: 0 0 0 #1899d6;
}
.duo-btn--ghost {
    background: #ffffff;
    color: var(--color-charcoal, #4b4b4b);
    border: 2px solid #e5e5e5;
    box-shadow: 0 6px 0 #e5e5e5;
}
.duo-btn--ghost:hover {
    background: #f7f7f7;
}
.duo-btn--ghost:active {
    transform: translateY(6px);
    box-shadow: 0 0 0 #e5e5e5;
}
.duo-note {
    font-size: 15px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    margin-top: 32px;
    padding-top: 32px;
    border-top: 2px solid #e5e5e5;
}
.duo-note a {
    color: var(--color-spark-blue, #1cb0f6);
    font-weight: 700;
    text-decoration: none;
}
</style>

<div class="duo-order-wrapper">
    <div class="duo-container">
        <div class="duo-order-card">
            
            <div class="duo-order-badge duo-order-badge--ok">
                <i class="fas fa-check"></i>
            </div>
            
            <h1 class="duo-order-title">{{ __('inkwave.credit_ok_heading') }}</h1>
            <p class="duo-order-sub">{{ __('inkwave.credit_ok_msg') }}</p>

            @if($order)
                @php
                    $currency = match($order->currency) {
                        'USD' => '$',
                        'JPY' => '¥',
                        'HKD' => 'HK$',
                        default => '$',
                    };
                @endphp
                <div class="duo-order-details">
                    <div class="duo-order-detail">
                        <span class="duo-order-label">{{ __('inkwave.credit_ok_number') }}</span>
                        <span class="duo-order-value">{{ $order->order_number }}</span>
                    </div>
                    <div class="duo-order-detail">
                        <span class="duo-order-label">{{ __('inkwave.credit_ok_amount') }}</span>
                        <span class="duo-order-value">{{ $currency }} {{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</span>
                    </div>
                    <div class="duo-order-detail">
                        <span class="duo-order-label">{{ __('inkwave.credit_ok_trans') }}</span>
                        <span class="duo-order-value">{{ $transaction_id }}</span>
                    </div>
                    <div class="duo-order-detail">
                        <span class="duo-order-label">{{ __('inkwave.credit_ok_status') }}</span>
                        <span class="duo-order-value"><span class="duo-pill">{{ ucwords($order->payment_status) }}</span></span>
                    </div>
                </div>
            @endif

            <div class="duo-order-actions">
                @if($order)
                    <a href="{{ route('user.order.show', $order->id) }}" class="duo-btn duo-btn--primary"><i class="fas fa-eye"></i> {{ __('inkwave.credit_ok_view') }}</a>
                @endif
                <a href="{{ route('home') }}" class="duo-btn duo-btn--ghost"><i class="fas fa-home"></i> {{ __('inkwave.credit_ok_home') }}</a>
                @if($order)
                    <a href="{{ route('order.pdf', $order->id) }}" class="duo-btn duo-btn--ghost"><i class="fas fa-download"></i> {{ __('inkwave.credit_ok_invoice') }}</a>
                @endif
            </div>

            @if($email_status == 'inactive' && $order)
                <p class="duo-note">{{ __('inkwave.credit_ok_note') }} <a href="{{ route('order.pdf', $order->id) }}">{{ __('inkwave.credit_ok_invoice') }}</a></p>
            @endif
            
        </div>
    </div>
</div>

@endsection
