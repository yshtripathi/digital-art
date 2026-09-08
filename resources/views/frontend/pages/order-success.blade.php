@extends('frontend.layouts.main')
@section('title', __('managenovax.payment.success_title'))
@php
use App\Models\Order;
$order = Order::where('trans_id', $transaction_id)->first();
@endphp
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.payment.success_title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.payment.success_title')]
    ]
])



<div class="ag-page-wrapper">
    <div class="ag-alert-card">
        
        <div class="ag-alert-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h1 class="ag-alert-title">{{ __('managenovax.payment.success_heading') }}</h1>
        <p class="ag-alert-desc">{{ __('managenovax.payment.success_msg') }}</p>

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
                    <span>{{ __('managenovax.payment.success_order_no') }}</span>
                    <strong>{{ $order->order_number }}</strong>
                </div>
                <div class="ag-receipt-row">
                    <span>{{ __('managenovax.payment.success_amount') }}</span>
                    <strong>{!! $currency !!} {{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</strong>
                </div>
                <div class="ag-receipt-row">
                    <span>{{ __('managenovax.payment.success_txn_id') }}</span>
                    <strong>{{ $transaction_id }}</strong>
                </div>
                <div class="ag-receipt-row">
                    <span>{{ __('managenovax.payment.success_status') }}</span>
                    <span class="ag-status-pill">{{ ucwords($order->payment_status) }}</span>
                </div>
            </div>
        @endif

        <div class="ag-alert-actions">
            @if($order)
                <a href="{{ route('user.order.show', $order->id) }}" class="ag-submit-btn">
                    <i class="fas fa-eye"></i> {{ __('managenovax.payment.success_view_order') }}
                </a>
            @endif
            <a href="{{ route('home') }}" class="ag-ghost-btn">
                <i class="fas fa-home"></i> {{ __('managenovax.payment.success_home') }}
            </a>
            @if($order)
                <a href="{{ route('order.pdf', $order->id) }}" class="ag-ghost-btn">
                    <i class="fas fa-download"></i> {{ __('managenovax.payment.success_invoice') }}
                </a>
            @endif
        </div>

        @if($email_status == 'inactive' && $order)
            <p class="ag-alert-note">
                {{ __('managenovax.payment.success_note') }} 
                <a href="{{ route('order.pdf', $order->id) }}">{{ __('managenovax.payment.success_invoice') }}</a>
            </p>
        @endif
        
    </div>
</div>

@endsection
