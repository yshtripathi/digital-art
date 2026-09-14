@extends('frontend.layouts.main')
@section('title', __('frontend.success.title'))
@php
    use App\Models\Order;
    $transaction_id = $transaction_id ?? null;
    $email_status   = $email_status ?? null;
    $order = $transaction_id ? Order::where('trans_id', $transaction_id)->first() : null;
@endphp
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.success.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.success.title')]
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

            <h2 class="rs-hero__title">{{ __('frontend.success.heading') }}</h2>
            <p class="rs-hero__msg">{{ __('frontend.success.message') }}</p>

            <div class="rs-actions">
                @if($order)
                    <a href="{{ route('user.order.show', $order->id) }}" class="rs-btn rs-btn--dark">
                        <i class="fas fa-eye"></i> {{ __('frontend.success.view_order') }}
                    </a>
                @endif
                <a href="{{ route('home') }}" class="rs-btn rs-btn--outline">
                    <i class="fas fa-home"></i> {{ __('frontend.success.home') }}
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
                $statusKey = 'frontend.success.statuses.' . strtolower((string) $order->payment_status);
                $statusText = Lang::has($statusKey) ? __($statusKey) : ucwords((string) $order->payment_status);
            @endphp
            <div class="rs-receipt">
                <div class="rs-receipt__top">
                    <span class="rs-receipt__label">{{ __('frontend.success.order_no') }}</span>
                    <strong class="rs-receipt__number">{{ $order->order_number }}</strong>
                </div>

                <div class="rs-receipt__tear" aria-hidden="true"></div>

                <dl class="rs-receipt__rows">
                    <div class="rs-receipt__row rs-receipt__row--total">
                        <dt>{{ __('frontend.success.amount') }}</dt>
                        <dd>{!! $currency !!}{{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</dd>
                    </div>
                    <div class="rs-receipt__row">
                        <dt>{{ __('frontend.success.txn') }}</dt>
                        <dd class="rs-receipt__mono">{{ $transaction_id }}</dd>
                    </div>
                    <div class="rs-receipt__row">
                        <dt>{{ __('frontend.success.status') }}</dt>
                        <dd><span class="rs-pill {{ $isPaid ? 'rs-pill--ok' : 'rs-pill--wait' }}">{{ $statusText }}</span></dd>
                    </div>
                </dl>

                <a href="{{ route('order.pdf', $order->id) }}" class="rs-btn rs-btn--lime rs-btn--block">
                    <i class="fas fa-download"></i> {{ __('frontend.success.invoice') }}
                </a>

                @if($email_status == 'inactive')
                    <p class="rs-note">
                        <i class="fas fa-info-circle"></i>
                        <span>
                            {{ __('frontend.success.no_email') }}
                            <a href="{{ route('order.pdf', $order->id) }}">{{ __('frontend.success.invoice') }}</a>
                        </span>
                    </p>
                @endif
            </div>
        @endif

    </div>
</section>

@endsection
