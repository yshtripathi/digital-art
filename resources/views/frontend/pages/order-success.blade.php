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
