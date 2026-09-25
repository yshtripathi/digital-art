@extends('frontend.layouts.main')
@section('title', __('frontend.success.page_name'))
@php
    use App\Models\Order;
    $transaction_id = $transaction_id ?? null;
    $email_status   = $email_status ?? null;
    $order = $transaction_id ? Order::where('trans_id', $transaction_id)->first() : null;
    $supportEmail = $misc['Company Email'] ?? __('frontend.company.email');
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
    <div class="rs__wrap">

        <div class="rs__status band--indigo">
            <span class="rs__badge" aria-hidden="true"><i class="fas fa-check"></i></span>
            <h2 class="rs__title">{{ __('frontend.success.head') }}</h2>
            <p class="rs__msg">{{ __('frontend.success.text') }}</p>

            <div class="rs__actions">
                @if($order)
                    <a href="{{ route('user.order.show', $order->id) }}" class="btn btn--primary btn--block">
                        <i class="fas fa-eye" aria-hidden="true"></i> {{ __('frontend.success.go_order') }}
                    </a>
                @endif
                <a href="{{ route('home') }}" class="btn btn--ghost btn--block">
                    <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.success.go_home') }}
                </a>
            </div>
        </div>

        <div class="rs__panel">
            @if($order)
                <div class="rs__receipt">
                    <p class="rs__label">{{ __('frontend.success.r_order') }}</p>
                    <p class="rs__number num">{{ $order->order_number }}</p>

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

                    <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--ghost btn--block">
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
            @endif

            <div class="rs__next">
                <h3 class="rs__head">{{ __('frontend.success.next_head') }}</h3>
                <ul class="rs__list">
                    <li><i class="fas fa-clock" aria-hidden="true"></i><span>{{ __('frontend.success.next1') }}</span></li>
                    <li><i class="fas fa-hourglass-half" aria-hidden="true"></i><span>{{ __('frontend.success.next2') }}</span></li>
                    <li><i class="fas fa-envelope" aria-hidden="true"></i><span>{!! str_replace(':email', '<a href="mailto:' . e($supportEmail) . '">' . e($supportEmail) . '</a>', e(__('frontend.success.next3'))) !!}</span></li>
                </ul>
            </div>
        </div>

    </div>
</section>

@endsection
