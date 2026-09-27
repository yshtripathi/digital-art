@extends('frontend.layouts.main')
@section('title', __('frontend.success.page_name'))
@php
    use App\Models\Order;
    $transaction_id = $transaction_id ?? null;
    $email_status   = $email_status ?? null;
    $order = $transaction_id ? Order::where('trans_id', $transaction_id)->first() : null;
    $supportEmail = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
@endphp
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.success.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.success.page_name')]
    ]
])

@if($order)
    @php
        $currency = match($order->currency) {
            'USD' => '$',
            'JPY' => '&yen;',
            'HKD' => 'HK$',
            default => '$',
        };
        $isPaid = in_array(strtolower((string) $order->payment_status), ['paid', 'completed', 'success']);
        $statusKey = 'frontend.success.state_names.' . strtolower((string) $order->payment_status);
        $statusText = Lang::has($statusKey) ? __($statusKey) : ucwords((string) $order->payment_status);
    @endphp
@endif

<section class="rs rs--success">
    <ol class="steps">
        <li class="steps__item is-done">
            <span class="steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.st_cart') }}</span>
        </li>
        <li class="steps__line is-done" aria-hidden="true"></li>
        <li class="steps__item is-done">
            <span class="steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.st_pay') }}</span>
        </li>
        <li class="steps__line is-done" aria-hidden="true"></li>
        <li class="steps__item is-done" aria-current="step">
            <span class="steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.st_done') }}</span>
        </li>
    </ol>

    <div class="rs__hero">
        <div class="rs__orb" aria-hidden="true">
            <span class="rs__wave"></span>
            <span class="rs__wave rs__wave--late"></span>
            <svg class="rs__mark" viewBox="0 0 52 52" focusable="false">
                <circle class="rs__circle" cx="26" cy="26" r="24"/>
                <path class="rs__draw" d="M15 27 L22 34 L37 18"/>
            </svg>
        </div>
        <h2 class="rs__title">{{ __('frontend.success.heading') }}</h2>
        <p class="rs__msg">{{ __('frontend.success.lead') }}</p>

        <div class="rs__actions">
            @if($order)
                <a href="{{ route('user.order.show', $order->id) }}" class="btn btn--primary">
                    <i class="fas fa-eye" aria-hidden="true"></i> {{ __('frontend.success.go_receipt') }}
                </a>
            @endif
            <a href="{{ route('home') }}" class="btn btn--ghost">
                <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.success.go_home') }}
            </a>
        </div>
    </div>

    <div class="rs__grid {{ $order ? '' : 'rs__grid--single' }}">
        @if($order)
            <div class="rs__ticket">
                <div class="rs__ticket-top">
                    <p class="rs__label">{{ __('frontend.success.r_order') }}</p>
                    <p class="rs__number num">{{ $order->order_number }}</p>
                </div>

                <div class="rs__tear" aria-hidden="true"></div>

                <div class="rs__ticket-body">
                    <dl class="rs__rows">
                        <div class="rs__row rs__row--total">
                            <dt>{{ __('frontend.success.r_amount') }}</dt>
                            <dd class="num">{!! $currency !!}{{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</dd>
                        </div>
                        <div class="rs__row">
                            <dt>{{ __('frontend.success.r_txn') }}</dt>
                            <dd class="num">{{ $transaction_id }}</dd>
                        </div>
                        <div class="rs__row">
                            <dt>{{ __('frontend.success.r_status') }}</dt>
                            <dd>
                                <span class="rs__pill {{ $isPaid ? 'rs__pill--paid' : 'rs__pill--wait' }}">
                                    <i class="fas {{ $isPaid ? 'fa-check-circle' : 'fa-clock' }}" aria-hidden="true"></i>
                                    {{ $statusText }}
                                </span>
                            </dd>
                        </div>
                    </dl>

                    <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--secondary btn--block">
                        <i class="fas fa-download" aria-hidden="true"></i> {{ __('frontend.success.r_invoice') }}
                    </a>

                    @if($email_status == 'inactive')
                        <p class="rs__note">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                            <span>
                                {{ __('frontend.success.mail_failed') }}
                                <a href="{{ route('order.pdf', $order->id) }}">{{ __('frontend.success.r_invoice') }}</a>
                            </span>
                        </p>
                    @endif
                </div>
            </div>
        @endif

        <div class="rs__card">
            <h3 class="rs__head">{{ __('frontend.success.next') }}</h3>
            <ol class="rs__flow">
                <li>
                    <span class="rs__dot" aria-hidden="true"><i class="fas fa-clock"></i></span>
                    <span>{{ __('frontend.success.next1') }}</span>
                </li>
                <li>
                    <span class="rs__dot" aria-hidden="true"><i class="fas fa-hourglass-half"></i></span>
                    <span>{{ __('frontend.success.next2') }}</span>
                </li>
                <li>
                    <span class="rs__dot" aria-hidden="true"><i class="fas fa-envelope"></i></span>
                    <span>{!! str_replace(':email', '<a href="mailto:' . e($supportEmail) . '">' . e($supportEmail) . '</a>', e(__('frontend.success.next3'))) !!}</span>
                </li>
            </ol>
        </div>
    </div>
</section>

@endsection
