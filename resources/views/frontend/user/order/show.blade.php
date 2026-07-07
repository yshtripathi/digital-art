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


