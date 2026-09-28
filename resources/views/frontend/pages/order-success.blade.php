@extends('frontend.layouts.main')
@section('title', __('frontend.success.page_name'))
@php
    $transaction_id = $transaction_id ?? null;
    $email_status   = $email_status ?? null;
    $order = $transaction_id ? \App\Models\Order::with('cart_info')->where('trans_id', $transaction_id)->first() : null;
    $supportAddr = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $supportMail = '<a href="mailto:' . e($supportAddr) . '">' . e($supportAddr) . '</a>';
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
        $currency = Helper::getCurrencySymbol($order->currency);
        $isPaid = in_array(strtolower((string) $order->payment_status), ['paid', 'completed', 'success']);
        $statusKey = 'frontend.success.state_names.' . strtolower((string) $order->payment_status);
        $statusText = Lang::has($statusKey) ? __($statusKey) : ucwords((string) $order->payment_status);
        $orderCredits = $order->cart_info->sum('points');
    @endphp
@endif

<section class="outcome">
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
        <li class="steps__item is-done is-active" aria-current="step">
            <span class="steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.st_done') }}</span>
        </li>
    </ol>

    <div class="outcome__card outcome__card--ok">
        <div class="outcome__status">
            <span class="seal" aria-hidden="true">
                <svg viewBox="0 0 48 48" focusable="false"><path d="M13 25 L21 33 L36 16"></path></svg>
            </span>
            <h2 class="outcome__title">{{ __('frontend.success.heading') }}</h2>
            <p class="outcome__lead">{{ __('frontend.success.lead') }}</p>

            @if($order)
                <div class="outcome__amount">
                    <span class="outcome__amount-label">{{ __('frontend.success.r_amount') }}</span>
                    <strong class="outcome__amount-value">{{ $currency }}{{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</strong>
                    <span class="state-chip {{ $isPaid ? 'state-chip--ok' : 'state-chip--wait' }}">
                        <i class="fas {{ $isPaid ? 'fa-check' : 'fa-clock' }}" aria-hidden="true"></i>
                        {{ __('frontend.success.r_status') }}: {{ $statusText }}
                    </span>
                </div>
            @endif
        </div>

        <div class="outcome__detail">
            @if($order)
                <dl class="facts">
                    <div class="fact fact--wide">
                        <dt>{{ __('frontend.success.r_order') }}</dt>
                        <dd>
                            <span class="fact__value" data-copy-text>{{ $order->order_number }}</span>
                            <button type="button" class="fact__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.success.r_order')]) }}">
                                <i class="far fa-copy" aria-hidden="true"></i>
                                <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                            </button>
                        </dd>
                    </div>
                    <div class="fact fact--wide">
                        <dt>{{ __('frontend.success.r_txn') }}</dt>
                        <dd>
                            <span class="fact__value" data-copy-text>{{ $transaction_id }}</span>
                            <button type="button" class="fact__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.success.r_txn')]) }}">
                                <i class="far fa-copy" aria-hidden="true"></i>
                                <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                            </button>
                        </dd>
                    </div>
                    <div class="fact">
                        <dt>{{ __('frontend.success.r_date') }}</dt>
                        <dd><span class="fact__value">{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '' }}</span></dd>
                    </div>
                    @if($orderCredits > 0)
                        <div class="fact">
                            <dt>{{ __('frontend.success.r_credits') }}</dt>
                            <dd><span class="fact__value fact__value--credits"><i class="fas fa-coins" aria-hidden="true"></i> {{ number_format($orderCredits) }}</span></dd>
                        </div>
                    @endif
                    @if(filled($order->email))
                        <div class="fact fact--wide">
                            <dt>{{ __('frontend.success.r_mail') }}</dt>
                            <dd><span class="fact__value">{{ $order->email }}</span></dd>
                        </div>
                    @endif
                </dl>

                @if($email_status == 'inactive')
                    <p class="outcome__note">
                        <i class="fas fa-exclamation" aria-hidden="true"></i>
                        <span>{{ __('frontend.success.mail_failed') }}</span>
                    </p>
                @endif
            @endif

            <div class="outcome__acts">
                @if($order)
                    <a href="{{ route('user.order.show', $order->id) }}" class="btn">
                        <i class="fas fa-receipt" aria-hidden="true"></i> {{ __('frontend.success.go_receipt') }}
                    </a>
                    <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--outline">
                        <i class="fas fa-file-download" aria-hidden="true"></i> {{ __('frontend.success.r_invoice') }}
                    </a>
                @endif
                <a href="{{ route('home') }}" class="{{ $order ? 'outcome__home' : 'btn' }}">
                    <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.success.go_home') }}
                </a>
            </div>
        </div>
    </div>

    <div class="journey">
        <h3 class="journey__title">{{ __('frontend.success.next') }}</h3>
        <ol class="journey__list">
            <li class="journey__step" style="--i: 0">
                <span class="journey__node" aria-hidden="true"><i class="far fa-clock"></i></span>
                <span class="journey__no" aria-hidden="true">01</span>
                <p class="journey__text">{{ __('frontend.success.next1') }}</p>
            </li>
            <li class="journey__step" style="--i: 1">
                <span class="journey__node" aria-hidden="true"><i class="fas fa-hourglass-half"></i></span>
                <span class="journey__no" aria-hidden="true">02</span>
                <p class="journey__text">{{ __('frontend.success.next2') }}</p>
            </li>
            <li class="journey__step" style="--i: 2">
                <span class="journey__node" aria-hidden="true"><i class="far fa-envelope"></i></span>
                <span class="journey__no" aria-hidden="true">03</span>
                <p class="journey__text">{!! str_replace(':email', $supportMail, e(__('frontend.success.next3'))) !!}</p>
            </li>
        </ol>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('click', function (event) {
        var button = event.target.closest('[data-copy]');

        if (!button) {
            return;
        }

        var source = button.parentElement.querySelector('[data-copy-text]');
        var label = button.querySelector('[data-copy-label]');
        var text = source ? source.textContent.trim() : '';

        if (!text) {
            return;
        }

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
