@extends('frontend.layouts.main')
@section('title', __('frontend.receipt.title'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.receipt.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.receipt.account'), 'url' => route('user')],
        ['name' => __('frontend.receipt.title')]
    ]
])

{{-- ==========================================================================
     Receipt — one order
     A single ticket on the drawn canvas: header with stamp, items, details,
     then total, statuses and actions.
     Styles: public/css/theme.css — section 26
     ========================================================================== --}}
<section class="rc">

    @include('frontend.layouts.form-canvas')

    <div class="rc__wrap">
        @if($order)
            @php
                $currency = match($order->currency) {
                    'USD' => '$',
                    'JPY' => '&yen;',
                    'HKD' => 'HK$',
                    default => '$',
                };
                $totalFmt = $currency . number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2);
                $items = $order->cart_info ?? collect();
                $payOk = in_array(strtolower((string) $order->payment_status), ['completed', 'paid', 'success']);
                $orderOk = in_array(strtolower((string) $order->status), ['completed', 'delivered']);
                $statusLabel = function ($value) {
                    $key = 'frontend.receipt.statuses.' . strtolower(trim((string) $value));
                    return Lang::has($key) ? __($key) : ucwords((string) $value);
                };
                $created = $order->created_at->locale(app()->getLocale());
                // Orders unlocked with credits have no card payment
                $paidWithCredits = str_starts_with((string) $order->order_number, 'ORD-PTS-');
            @endphp

            {{-- Receipt --}}
            <article class="rc-ticket">
                <header class="rc-ticket__head">
                    <div>
                        <span class="rc-ticket__eyebrow"><i class="fas fa-receipt"></i> {{ __('frontend.receipt.receipt') }}</span>
                        <h2 class="rc-ticket__num">#{{ $order->order_number }}</h2>
                        <span class="rc-ticket__date"><i class="far fa-calendar"></i> {{ $created->translatedFormat(__('frontend.receipt.head_format')) }}</span>
                    </div>
                    <div class="rc-ticket__stamp {{ $payOk ? 'is-ok' : '' }}" aria-hidden="true">
                        <i class="fas {{ $payOk ? 'fa-check' : 'fa-hourglass-half' }}"></i>
                    </div>
                </header>

                <div class="rc-tear" aria-hidden="true"></div>

                {{-- Items --}}
                @if(count($items))
                    <h3 class="rc-h"><i class="fas fa-list-ul"></i> {{ __('frontend.receipt.items') }}</h3>
                    <ul class="rc-items">
                        @foreach($items as $item)
                            @php
                                $isCourse = $item->product && $item->product_id < 1000;
                                $iTitle = $item->product ? $item->product->title : __('frontend.receipt.package');
                            @endphp
                            <li class="rc-item">
                                <span class="rc-item__icon {{ $isCourse ? 'is-course' : '' }}"><i class="fas {{ $isCourse ? 'fa-graduation-cap' : 'fa-bolt' }}"></i></span>
                                <span class="rc-item__title">{{ $isCourse ? $iTitle : __('frontend.receipt.package') }}</span>
                                <span class="rc-item__pts"><i class="fas fa-bolt"></i> {{ number_format($item->points) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                {{-- Details --}}
                <h3 class="rc-h"><i class="fas fa-clipboard-list"></i> {{ __('frontend.receipt.info') }}</h3>
                <dl class="rc-details">
                    <div class="rc-detail">
                        <dt>{{ __('frontend.receipt.order') }}</dt>
                        <dd>{{ $order->order_number }}</dd>
                    </div>
                    <div class="rc-detail">
                        <dt>{{ __('frontend.receipt.name') }}</dt>
                        <dd>{{ $order->first_name }} {{ $order->last_name }}</dd>
                    </div>
                    <div class="rc-detail">
                        <dt>{{ __('frontend.receipt.email') }}</dt>
                        <dd>{{ $order->email }}</dd>
                    </div>
                    <div class="rc-detail">
                        <dt>{{ __('frontend.receipt.qty') }}</dt>
                        <dd>{{ $order->quantity }}</dd>
                    </div>
                    <div class="rc-detail">
                        <dt>{{ __('frontend.receipt.method') }}</dt>
                        <dd>
                            @if($paidWithCredits)
                                <i class="fas fa-bolt"></i> {{ __('frontend.receipt.credits') }}
                            @else
                                <i class="far fa-credit-card"></i> {{ __('frontend.receipt.card') }}
                            @endif
                        </dd>
                    </div>
                    <div class="rc-detail">
                        <dt>{{ __('frontend.receipt.date') }}</dt>
                        <dd>{{ $created->translatedFormat(__('frontend.receipt.date_format')) }}</dd>
                    </div>
                    <div class="rc-detail rc-detail--wide">
                        <dt>{{ __('frontend.receipt.txn') }}</dt>
                        <dd class="rc-mono">{{ $order->trans_id ?: '—' }}</dd>
                    </div>
                </dl>
            </article>

            {{-- Total, statuses and actions --}}
            <div class="rc-total">
                <span class="rc-total__label">{{ __('frontend.receipt.total') }}:</span>
                <strong class="rc-total__value">{!! $totalFmt !!}</strong>
            </div>

            <div class="rc-statuses">
                <div class="rc-status">
                    <span>{{ __('frontend.receipt.status') }}</span>
                    <span class="ds-status {{ $orderOk ? 'ds-status--ok' : 'ds-status--wait' }}">{{ $statusLabel($order->status) }}</span>
                </div>
                <div class="rc-status">
                    <span>{{ __('frontend.receipt.payment') }}</span>
                    <span class="ds-status {{ $payOk ? 'ds-status--ok' : 'ds-status--wait' }}">{{ $statusLabel($order->payment_status) }}</span>
                </div>
            </div>

            <div class="rc-actions">
                <a href="{{ route('order.pdf', $order->id) }}" class="ds-btn ds-btn--primary">
                    <i class="fas fa-download"></i> {{ __('frontend.receipt.pdf') }}
                </a>
                <button type="button" class="ds-btn ds-btn--ghost" onclick="window.print();">
                    <i class="fas fa-print"></i> {{ __('frontend.receipt.print') }}
                </button>
                <a href="{{ route('user') }}" class="ds-btn ds-btn--ghost">
                    <i class="fas fa-arrow-left"></i> {{ __('frontend.receipt.back') }}
                </a>
            </div>
        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.receipt.missing') }}</h2>
                <p class="bag-empty__desc">{{ __('frontend.receipt.missing_text') }}</p>
                <div class="bag-empty__actions">
                    <a href="{{ route('user') }}" class="bag-btn bag-btn--primary"><i class="fas fa-arrow-left"></i> {{ __('frontend.receipt.back') }}</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
