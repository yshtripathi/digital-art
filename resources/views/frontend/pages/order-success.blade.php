@extends('frontend.layouts.main')
@section('title', __('frontend.success.title'))
@php
    use App\Models\Order;
    $transaction_id = $transaction_id ?? null;
    $email_status   = $email_status ?? null;
    $order = $transaction_id ? Order::where('trans_id', $transaction_id)->first() : null;
    $supportEmail = $misc['Company Email'] ?? __('frontend.company.email');
@endphp
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.success.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.success.title')]
    ]
])

{{-- ==========================================================================
     Order success
     Centred column: status medallion, ticket receipt,
     actions. Styles: public/css/variables.css — Section 18
     ========================================================================== --}}
<section class="res res--success">
    <div class="res__wrap">

        <span class="res-mark" aria-hidden="true">
            <span class="res-mark__ring"></span>
            <span class="res-mark__icon"><i class="fas fa-check"></i></span>
        </span>

        <h1 class="res-title">{{ __('frontend.success.heading') }}</h1>
        <p class="res-msg">{{ __('frontend.success.msg') }}</p>

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

            <div class="res-ticket">
                <div class="res-ticket__top">
                    <div>
                        <span class="res-ticket__label">{{ __('frontend.success.order_no') }}</span>
                        <strong class="res-ticket__number num">{{ $order->order_number }}</strong>
                    </div>
                    <span class="ticket__stamp is-ok" aria-hidden="true">
                        <i class="fas fa-check"></i>
                    </span>
                </div>

                <div class="tear" aria-hidden="true"></div>

                <dl class="res-ticket__rows">
                    <div class="res-ticket__row res-ticket__row--total">
                        <dt>{{ __('frontend.success.amount') }}</dt>
                        <dd class="num">{!! $currency !!}{{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</dd>
                    </div>
                    <div class="res-ticket__row">
                        <dt>{{ __('frontend.success.txn') }}</dt>
                        <dd class="num res-mono">{{ $transaction_id }}</dd>
                    </div>
                    <div class="res-ticket__row">
                        <dt>{{ __('frontend.success.status') }}</dt>
                        <dd>
                            <span class="res-badge {{ $isPaid ? 'res-badge--success' : 'res-badge--warning' }}">
                                <i class="fas {{ $isPaid ? 'fa-check-circle' : 'fa-clock' }}" aria-hidden="true"></i>
                                {{ $statusText }}
                            </span>
                        </dd>
                    </div>
                </dl>

                <div class="res-ticket__foot">
                    <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--ghost btn--block">
                        <i class="fas fa-download" aria-hidden="true"></i> {{ __('frontend.success.invoice') }}
                    </a>

                    @if($email_status == 'inactive')
                        <p class="res-note">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                            <span>
                                {{ __('frontend.success.no_email') }}
                                <a href="{{ route('order.pdf', $order->id) }}">{{ __('frontend.success.invoice') }}</a>
                            </span>
                        </p>
                    @endif
                </div>
            </div>
        @endif

        <div class="res-help res-next">
            <h2 class="res-help__title">{{ __('frontend.success.next_title') }}</h2>
            <ul class="res-next__list">
                <li><i class="fas fa-clock" aria-hidden="true"></i><span>{{ __('frontend.success.next_time') }}</span></li>
                <li><i class="fas fa-hourglass-half" aria-hidden="true"></i><span>{{ __('frontend.success.next_delay') }}</span></li>
                <li><i class="fas fa-envelope" aria-hidden="true"></i><span>{!! str_replace(':email', '<a href="mailto:' . e($supportEmail) . '">' . e($supportEmail) . '</a>', e(__('frontend.success.next_help'))) !!}</span></li>
            </ul>
        </div>

        <div class="res-actions">
            @if($order)
                <a href="{{ route('user.order.show', $order->id) }}" class="btn btn--primary">
                    <i class="fas fa-eye" aria-hidden="true"></i> {{ __('frontend.success.view_order') }}
                </a>
            @endif
            <a href="{{ route('home') }}" class="btn btn--ghost">
                <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.success.home') }}
            </a>
        </div>

    </div>
</section>

@endsection
