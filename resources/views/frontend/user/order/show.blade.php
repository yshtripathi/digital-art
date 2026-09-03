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
                        <span class="duo-od-tag"><i class="fas fa-check-circle"></i> {{ ucwords($order->payment_status) }}</span>
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


