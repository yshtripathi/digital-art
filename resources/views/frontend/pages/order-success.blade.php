@extends('frontend.layouts.main')
@section('title', __('frontend.success.title'))
@php
    $transaction_id = $transaction_id ?? null;
    $email_status   = $email_status ?? null;
    $order = $transaction_id ? \App\Models\Order::with('cart_info')->where('trans_id', $transaction_id)->first() : null;
    $supportAddr = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $supportMail = '<a href="mailto:' . e($supportAddr) . '">' . e($supportAddr) . '</a>';
@endphp
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.success.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.success.title')]
    ]
])

@if($order)
    @php
        $currency = Helper::getCurrencySymbol($order->currency);
        $isPaid = in_array(strtolower((string) $order->payment_status), ['paid', 'completed', 'success']);
        $statusKey = 'frontend.success.state_' . str_replace(' ', '_', strtolower(trim((string) $order->payment_status)));
        $statusText = Lang::has($statusKey) ? __($statusKey) : ucwords((string) $order->payment_status);
        $orderCredits = $order->cart_info->sum('points');
    @endphp
@endif

<section class="pay">
    <div class="container">
        <ol class="pay-steps">
            <li class="pay-steps__item is-done"><span class="pay-steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>{{ __('frontend.cart.step_cart') }}</li>
            <li class="pay-steps__item is-done"><span class="pay-steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>{{ __('frontend.cart.step_pay') }}</li>
            <li class="pay-steps__item is-done is-now" aria-current="step"><span class="pay-steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>{{ __('frontend.cart.step_done') }}</li>
        </ol>

        <div class="rs rs--ok">
            <div class="rs__hero">
                <svg class="rs__mark" viewBox="0 0 52 52" aria-hidden="true">
                    <circle class="rs__ring" cx="26" cy="26" r="24" pathLength="1"/>
                    <path class="rs__sign" d="M15 27 L22 34 L37 19" pathLength="1"/>
                </svg>
                <h2 class="rs__title">{{ __('frontend.success.heading') }}</h2>
                <p class="rs__lead">{{ __('frontend.success.lead') }}</p>
            </div>

            @if($order)
                <div class="rs__amount">
                    <span class="rs__amount-label">{{ __('frontend.success.amount_paid') }}</span>
                    <strong class="rs__amount-value">{{ $currency }}{{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</strong>
                    <span class="st {{ $isPaid ? 'st--ok' : 'st--wait' }}">{{ __('frontend.success.status') }}: {{ $statusText }}</span>
                </div>

                <dl class="rs__facts">
                    <div class="rs-fact">
                        <dt>{{ __('frontend.success.order_no') }}</dt>
                        <dd>
                            <span data-copy-text>{{ $order->order_number }}</span>
                            <button type="button" class="res-fact__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.success.order_no')]) }}">
                                <i class="far fa-copy" aria-hidden="true"></i>
                                <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                            </button>
                        </dd>
                    </div>
                    <div class="rs-fact">
                        <dt>{{ __('frontend.success.transaction') }}</dt>
                        <dd>
                            <span data-copy-text>{{ $transaction_id }}</span>
                            <button type="button" class="res-fact__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.success.transaction')]) }}">
                                <i class="far fa-copy" aria-hidden="true"></i>
                                <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                            </button>
                        </dd>
                    </div>
                    <div class="rs-fact">
                        <dt>{{ __('frontend.success.date') }}</dt>
                        <dd><span>{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '' }}</span></dd>
                    </div>
                    @if($orderCredits > 0)
                        <div class="rs-fact">
                            <dt>{{ __('frontend.success.credits_added') }}</dt>
                            <dd><span>{{ number_format($orderCredits) }}</span></dd>
                        </div>
                    @endif
                    @if(filled($order->email))
                        <div class="rs-fact rs-fact--wide">
                            <dt>{{ __('frontend.success.billing_email') }}</dt>
                            <dd><span>{{ $order->email }}</span></dd>
                        </div>
                    @endif
                </dl>

                @if($email_status == 'inactive')
                    <p class="rs__note">{{ __('frontend.success.email_failed') }}</p>
                @endif
            @endif

            <div class="rs__acts">
                @if($order)
                    <a href="{{ route('user.order.show', $order->id) }}" class="btn btn--primary">{{ __('frontend.success.receipt') }}</a>
                    <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--ghost">
                        <i class="fas fa-download" aria-hidden="true"></i>
                        <span>{{ __('frontend.success.invoice') }}</span>
                    </a>
                @endif
                <a href="{{ route('home') }}" class="{{ $order ? 'rs__home' : 'btn btn--primary' }}">{{ __('frontend.success.home') }}</a>
            </div>
        </div>

        <div class="rs-next">
            <h2 class="rs-next__title">{{ __('frontend.success.next_title') }}</h2>
            <ol class="rs-next__list">
                <li class="rs-next__item" style="--i: 0">
                    <span class="rs-next__no" aria-hidden="true">1</span>
                    <p>{{ __('frontend.success.next_one') }}</p>
                </li>
                <li class="rs-next__item" style="--i: 1">
                    <span class="rs-next__no" aria-hidden="true">2</span>
                    <p>{{ __('frontend.success.next_two') }}</p>
                </li>
                <li class="rs-next__item" style="--i: 2">
                    <span class="rs-next__no" aria-hidden="true">3</span>
                    <p>{!! str_replace(':email', $supportMail, e(__('frontend.success.next_three'))) !!}</p>
                </li>
            </ol>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (event) {
        var button = event.target.closest('[data-copy]');
        if (!button) { return; }

        var source = button.parentElement.querySelector('[data-copy-text]');
        var label = button.querySelector('[data-copy-label]');
        var text = source ? source.textContent.trim() : '';
        if (!text) { return; }

        var done = function () {
            var original = label.textContent;
            button.classList.add('is-done');
            label.textContent = button.dataset.done;
            setTimeout(function () {
                button.classList.remove('is-done');
                label.textContent = original;
            }, 2000);
        };

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(done);
            return;
        }

        var area = document.createElement('textarea');
        area.value = text;
        area.setAttribute('readonly', '');
        area.style.position = 'fixed';
        area.style.opacity = '0';
        document.body.appendChild(area);
        area.select();
        document.execCommand('copy');
        document.body.removeChild(area);
        done();
    });
</script>
@endpush
