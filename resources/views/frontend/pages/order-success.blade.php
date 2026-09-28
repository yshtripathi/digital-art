@extends('frontend.layouts.main')
@section('title', __('frontend.success.page_name'))
@php
    $transaction_id = $transaction_id ?? null;
    $email_status   = $email_status ?? null;
    $order = $transaction_id ? \App\Models\Order::with('cart_info')->where('trans_id', $transaction_id)->first() : null;
    $supportMail = filled($misc['Company Email'] ?? null)
        ? '<a href="mailto:' . e(trim($misc['Company Email'])) . '">' . e(trim($misc['Company Email'])) . '</a>'
        : e(__('frontend.company.email'));
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

<section class="rz">
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

    <div class="rz__card rz__card--ok">
        <span class="rz__levels" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
        <div class="rz__top">
            <span class="rz__mark" aria-hidden="true"><i class="fas fa-check"></i></span>
            <h2 class="rz__title">{{ __('frontend.success.heading') }}</h2>
            <p class="rz__lead">{{ __('frontend.success.lead') }}</p>
        </div>

        @if($order)
            <div class="rz__receipt">
                <div class="rz__amount">
                    <span>{{ __('frontend.success.r_amount') }}</span>
                    <strong class="num">{{ $currency }}{{ number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2) }}</strong>
                    <span class="rz__pill {{ $isPaid ? 'rz__pill--paid' : 'rz__pill--wait' }}">
                        <i class="fas {{ $isPaid ? 'fa-check-circle' : 'fa-clock' }}" aria-hidden="true"></i>
                        {{ __('frontend.success.r_status') }}: {{ $statusText }}
                    </span>
                </div>

                <dl class="rz__rows">
                    <div class="rz__row">
                        <dt>{{ __('frontend.success.r_order') }}</dt>
                        <dd>
                            <span class="num" data-copy-text>{{ $order->order_number }}</span>
                            <button type="button" class="rz__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.success.r_order')]) }}">
                                <i class="far fa-copy" aria-hidden="true"></i>
                                <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                            </button>
                        </dd>
                    </div>
                    <div class="rz__row">
                        <dt>{{ __('frontend.success.r_txn') }}</dt>
                        <dd>
                            <span class="num" data-copy-text>{{ $transaction_id }}</span>
                            <button type="button" class="rz__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.success.r_txn')]) }}">
                                <i class="far fa-copy" aria-hidden="true"></i>
                                <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                            </button>
                        </dd>
                    </div>
                    <div class="rz__row">
                        <dt>{{ __('frontend.success.r_date') }}</dt>
                        <dd class="num">{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '' }}</dd>
                    </div>
                    @if($orderCredits > 0)
                        <div class="rz__row">
                            <dt>{{ __('frontend.success.r_credits') }}</dt>
                            <dd><i class="fas fa-wallet rz__coin" aria-hidden="true"></i> <span class="num">{{ number_format($orderCredits) }}</span></dd>
                        </div>
                    @endif
                    @if(filled($order->email))
                        <div class="rz__row">
                            <dt>{{ __('frontend.success.r_mail') }}</dt>
                            <dd>{{ $order->email }}</dd>
                        </div>
                    @endif
                </dl>

                @if($email_status == 'inactive')
                    <p class="rz__note">
                        <i class="fas fa-info-circle" aria-hidden="true"></i>
                        <span>{{ __('frontend.success.mail_failed') }}</span>
                    </p>
                @endif
            </div>
        @endif

        <div class="rz__acts">
            @if($order)
                <a href="{{ route('user.order.show', $order->id) }}" class="btn">
                    <i class="fas fa-receipt" aria-hidden="true"></i> {{ __('frontend.success.go_receipt') }}
                </a>
                <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--ghost">
                    <i class="fas fa-download" aria-hidden="true"></i> {{ __('frontend.success.r_invoice') }}
                </a>
            @endif
            <a href="{{ route('home') }}" class="{{ $order ? 'rz__home' : 'btn' }}">
                <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.success.go_home') }}
            </a>
        </div>

        <div class="rz__section">
            <h3 class="rz__head">{{ __('frontend.success.next') }}</h3>
            <ol class="rz__flow">
                <li>
                    <span class="rz__dot" aria-hidden="true"><i class="fas fa-clock"></i></span>
                    <span>{{ __('frontend.success.next1') }}</span>
                </li>
                <li>
                    <span class="rz__dot" aria-hidden="true"><i class="fas fa-hourglass-half"></i></span>
                    <span>{{ __('frontend.success.next2') }}</span>
                </li>
                <li>
                    <span class="rz__dot" aria-hidden="true"><i class="fas fa-envelope"></i></span>
                    <span>{!! str_replace(':email', $supportMail, e(__('frontend.success.next3'))) !!}</span>
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
