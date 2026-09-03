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
