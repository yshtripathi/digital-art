@extends('frontend.layouts.main')
@section('title', __('inkwave.order_ok_title'))
@php
use App\Models\Order;
$order = Order::where('trans_id', $transaction_id)->first();
@endphp
@section('main-content')

<x-breadcrumb :title="__('inkwave.order_ok_title')" />

<section class="ord-section">
    <img src="{{ asset('assets/images/i1.webp') }}" alt="" aria-hidden="true" class="ord-bg">
    <div class="ord-card">
        <div class="ord-badge ord-badge--ok"><i class="fas fa-check"></i></div>
        <h1 class="ord-title">{{ __('inkwave.order_ok_heading') }}</h1>
        <p class="ord-sub">{{ __('inkwave.order_ok_msg') }}</p>

        @if($order)
            @php
                $currency = match($order->currency) {
                    'USD' => '$',
                    'JPY' => '¥',
                    'HKD' => 'HK$',
                    default => '$',
                };
            @endphp
            <div class="ord-details">
                <div class="ord-detail">
                    <span class="ord-detail__label">{{ __('inkwave.order_ok_number') }}</span>
                    <span class="ord-detail__value">{{ $order->order_number }}</span>
                </div>
                <div class="ord-detail">
                    <span class="ord-detail__label">{{ __('inkwave.order_ok_amount') }}</span>
                    <span class="ord-detail__value">{{ $currency }} {{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</span>
                </div>
                <div class="ord-detail">
                    <span class="ord-detail__label">{{ __('inkwave.order_ok_trans') }}</span>
                    <span class="ord-detail__value">{{ $transaction_id }}</span>
                </div>
                <div class="ord-detail">
                    <span class="ord-detail__label">{{ __('inkwave.order_ok_status') }}</span>
                    <span class="ord-detail__value"><span class="ord-pill">{{ ucwords($order->payment_status) }}</span></span>
                </div>
            </div>
        @endif

        <div class="ord-actions">
            @if($order)
                <a href="{{ route('user.order.show', $order->id) }}" class="ord-btn ord-btn--primary"><i class="fas fa-eye"></i> {{ __('inkwave.order_ok_view') }}</a>
            @endif
            <a href="{{ route('home') }}" class="ord-btn ord-btn--ghost"><i class="fas fa-home"></i> {{ __('inkwave.order_ok_home') }}</a>
            @if($order)
                <a href="{{ route('order.pdf', $order->id) }}" class="ord-btn ord-btn--ghost"><i class="fas fa-download"></i> {{ __('inkwave.order_ok_invoice') }}</a>
            @endif
        </div>

        @if($email_status == 'inactive' && $order)
            <p class="ord-note">{{ __('inkwave.order_ok_note') }} <a href="{{ route('order.pdf', $order->id) }}">{{ __('inkwave.order_ok_invoice') }}</a></p>
        @endif
    </div>
</section>

@endsection

@include('frontend.pages.partials.order-style')
