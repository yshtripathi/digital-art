@extends('frontend.layouts.main')
@section('title', __('managenovax.payment.success_title'))
@php
    use App\Models\Order;
    $transaction_id = $transaction_id ?? null;
    $email_status   = $email_status ?? null;
    $order = $transaction_id ? Order::where('trans_id', $transaction_id)->first() : null;
@endphp
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.payment.success_title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.payment.success_title')]
    ]
])

<section class="rs rs--success">
    <div class="rs__grid {{ $order ? '' : 'rs__grid--single' }}">

        {{-- Status hero --}}
        <div class="rs-hero">
            <div class="rs-confetti" aria-hidden="true">
                <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
            </div>

            <div class="rs-status" aria-hidden="true">
                <span class="rs-status__ring"></span>
                <span class="rs-status__ring rs-status__ring--delay"></span>
                <span class="rs-status__icon"><i class="fas fa-check"></i></span>
            </div>

            <h2 class="rs-hero__title">{{ __('managenovax.payment.success_heading') }}</h2>
            <p class="rs-hero__msg">{{ __('managenovax.payment.success_msg') }}</p>

            <div class="rs-actions">
                @if($order)
                    <a href="{{ route('user.order.show', $order->id) }}" class="rs-btn rs-btn--dark">
                        <i class="fas fa-eye"></i> {{ __('managenovax.payment.success_view_order') }}
                    </a>
                @endif
                <a href="{{ route('home') }}" class="rs-btn rs-btn--outline">
                    <i class="fas fa-home"></i> {{ __('managenovax.payment.success_home') }}
                </a>
            </div>
        </div>

        {{-- Receipt --}}
        @if($order)
            @php
                $currency = match($order->currency) {
                    'USD' => '$',
                    'JPY' => '&yen;',
                    'HKD' => 'HK$',
                    default => '$',
                };
                $isPaid = in_array(strtolower((string) $order->payment_status), ['paid', 'completed', 'success']);
            @endphp
            <div class="rs-receipt">
                <div class="rs-receipt__top">
                    <span class="rs-receipt__label">{{ __('managenovax.payment.success_order_no') }}</span>
                    <strong class="rs-receipt__number">{{ $order->order_number }}</strong>
                </div>

                <div class="rs-receipt__tear" aria-hidden="true"></div>

                <dl class="rs-receipt__rows">
                    <div class="rs-receipt__row rs-receipt__row--total">
                        <dt>{{ __('managenovax.payment.success_amount') }}</dt>
                        <dd>{!! $currency !!}{{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</dd>
                    </div>
                    <div class="rs-receipt__row">
                        <dt>{{ __('managenovax.payment.success_txn_id') }}</dt>
                        <dd class="rs-receipt__mono">{{ $transaction_id }}</dd>
                    </div>
                    <div class="rs-receipt__row">
                        <dt>{{ __('managenovax.payment.success_status') }}</dt>
                        <dd><span class="rs-pill {{ $isPaid ? 'rs-pill--ok' : 'rs-pill--wait' }}">{{ ucwords($order->payment_status) }}</span></dd>
                    </div>
                </dl>

                <a href="{{ route('order.pdf', $order->id) }}" class="rs-btn rs-btn--lime rs-btn--block">
                    <i class="fas fa-download"></i> {{ __('managenovax.payment.success_invoice') }}
                </a>

                @if($email_status == 'inactive')
                    <p class="rs-note">
                        <i class="fas fa-info-circle"></i>
                        <span>
                            {{ __('managenovax.payment.success_note') }}
                            <a href="{{ route('order.pdf', $order->id) }}">{{ __('managenovax.payment.success_invoice') }}</a>
                        </span>
                    </p>
                @endif
            </div>
        @endif

    </div>
</section>

@endsection
