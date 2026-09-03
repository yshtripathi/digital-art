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
