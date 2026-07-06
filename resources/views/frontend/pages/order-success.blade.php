@extends('frontend.layouts.main')
@section('title','Order Success')
@php
use App\Models\Order;
$order = Order::where('trans_id', $transaction_id)->first();
@endphp
@section('main-content')

<x-breadcrumb :title="__('common.order_success')" />

<section class="ord-section">
    <img src="{{ asset('assets/images/i1.png') }}" alt="" aria-hidden="true" class="ord-bg">
    <div class="ord-card">
        <div class="ord-badge ord-badge--ok"><i class="fas fa-check"></i></div>
        <h1 class="ord-title">{{ __('common.order_successful') }}</h1>
        <p class="ord-sub">{{ __('common.thank_you_order') }} {{ __('common.enrollment_confirmed') }}</p>

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
                    <span class="ord-detail__label">{{ __('common.order_number') }}</span>
                    <span class="ord-detail__value">{{ $order->order_number }}</span>
                </div>
                <div class="ord-detail">
                    <span class="ord-detail__label">{{ __('common.total_amount') }}</span>
                    <span class="ord-detail__value">{{ $currency }} {{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</span>
                </div>
                <div class="ord-detail">
                    <span class="ord-detail__label">{{ __('common.transaction_id') }}</span>
                    <span class="ord-detail__value">{{ $transaction_id }}</span>
                </div>
                <div class="ord-detail">
                    <span class="ord-detail__label">{{ __('common.payment_status') }}</span>
                    <span class="ord-detail__value"><span class="ord-pill">{{ ucwords($order->payment_status) }}</span></span>
                </div>
            </div>
        @endif

        <div class="ord-actions">
            @if($order)
                <a href="{{ route('user.order.show', $order->id) }}" class="ord-btn ord-btn--primary"><i class="fas fa-eye"></i> {{ __('common.view_details') }}</a>
            @endif
            <a href="{{ route('home') }}" class="ord-btn ord-btn--ghost"><i class="fas fa-home"></i> {{ __('common.home') }}</a>
            @if($order)
                <a href="{{ route('order.pdf', $order->id) }}" class="ord-btn ord-btn--ghost"><i class="fas fa-download"></i> {{ __('common.download_pdf_invoice') }}</a>
            @endif
        </div>

        @if($email_status == 'inactive' && $order)
            <p class="ord-note">{{ __('common.high_traffic') }} <a href="{{ route('order.pdf', $order->id) }}">{{ __('common.download_pdf_invoice') }}</a></p>
        @endif
    </div>
</section>

@endsection

@include('frontend.pages.partials.order-style')
