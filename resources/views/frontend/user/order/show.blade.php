@extends('frontend.layouts.main')
@section('title', __('frontend.receipt.page_name'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.receipt.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.receipt.crumb'), 'url' => route('user')],
        ['name' => __('frontend.receipt.page_name')]
    ]
])

<section class="rcpt">
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
                $key = 'frontend.receipt.state_names.' . strtolower(trim((string) $value));
                return Lang::has($key) ? __($key) : ucwords((string) $value);
            };
            $created = $order->created_at->locale(app()->getLocale());
            $paidWithCredits = str_starts_with((string) $order->order_number, 'ORD-PTS-');
            $creditsUsed = $items->sum('points');
        @endphp

        <div class="rcpt__grid">

            <article class="ticket">
                <header class="ticket__head">
                    <div>
                        <span class="ticket__eyebrow">
                            <i class="fas fa-receipt" aria-hidden="true"></i>
                            {{ __('frontend.receipt.tag') }}
                        </span>
                        <p class="ticket__no">{{ $order->order_number }}</p>
                        <span class="ticket__date">
                            <i class="far fa-calendar" aria-hidden="true"></i>
                            {{ $created->translatedFormat(__('frontend.receipt.fmt_head')) }}
                        </span>
                    </div>

                    <span class="ticket__stamp {{ $payOk ? 'is-ok' : '' }}" aria-hidden="true">
                        <i class="fas {{ $payOk ? 'fa-check' : 'fa-hourglass-half' }}"></i>
                    </span>
                </header>

                <div class="tear" aria-hidden="true"></div>

                @if(count($items))
                    <h2 class="ticket__h">
                        <i class="fas fa-list-ul" aria-hidden="true"></i>
                        {{ __('frontend.receipt.items_head') }}
                    </h2>

                    <ul class="items">
                        @foreach($items as $item)
                            @php
                                $isCourse = $item->product && $item->product_id < 1000;
                                $itemTitle = $isCourse ? $item->product->title : __('frontend.receipt.pack');
                                $itemLevel = null;
                                if ($isCourse) {
                                    $lvl = \App\Models\ProductLevel::where('course_id', $item->product_id)->where('price_in_points', $item->points)->first();
                                    if ($lvl) {
                                        $lvlKey = 'frontend.receipt.level_names.' . strtolower($lvl->skill_level);
                                        $itemLevel = Lang::has($lvlKey) ? __($lvlKey) : ucfirst($lvl->skill_level);
                                    }
                                }
                            @endphp
                            <li class="item">
                                <span class="item__icon">
                                    <i class="fas {{ $isCourse ? 'fa-graduation-cap' : 'fa-bolt' }}" aria-hidden="true"></i>
                                </span>
                                <span class="item__title">
                                    {{ $itemTitle }}
                                    @if($itemLevel)
                                        <span class="item__level">{{ $itemLevel }}</span>
                                    @endif
                                </span>
                                <span class="chip">
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                    {{ number_format($item->points) }} {{ __('frontend.receipt.unit_credits') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <h2 class="ticket__h">
                    <i class="fas fa-clipboard-list" aria-hidden="true"></i>
                    {{ __('frontend.receipt.info_head') }}
                </h2>

                <dl class="details">
                    <div class="detail">
                        <dt>{{ __('frontend.receipt.f_order') }}</dt>
                        <dd>{{ $order->order_number }}</dd>
                    </div>
                    <div class="detail">
                        <dt>{{ __('frontend.receipt.f_name') }}</dt>
                        <dd>{{ $order->first_name }} {{ $order->last_name }}</dd>
                    </div>
                    <div class="detail">
                        <dt>{{ __('frontend.receipt.f_email') }}</dt>
                        <dd>{{ $order->email }}</dd>
                    </div>
                    <div class="detail">
                        <dt>{{ __('frontend.receipt.f_qty') }}</dt>
                        <dd class="num">{{ $order->quantity }}</dd>
                    </div>
                    <div class="detail">
                        <dt>{{ __('frontend.receipt.f_method') }}</dt>
                        <dd>
                            @if($paidWithCredits)
                                <i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.receipt.pay_credits') }}
                            @else
                                <i class="far fa-credit-card" aria-hidden="true"></i> {{ __('frontend.receipt.pay_card') }}
                            @endif
                        </dd>
                    </div>
                    <div class="detail">
                        <dt>{{ __('frontend.receipt.f_date') }}</dt>
                        <dd>{{ $created->translatedFormat(__('frontend.receipt.fmt_date')) }}</dd>
                    </div>
                    <div class="detail detail--wide">
                        <dt>{{ __('frontend.receipt.f_txn') }}</dt>
                        <dd class="num">{{ $order->trans_id ?: '—' }}</dd>
                    </div>
                </dl>
            </article>

            <aside class="rcpt__rail band--coffee">

                <div class="total">
                    @if($paidWithCredits)
                        <span class="total__label">{{ __('frontend.receipt.sum_used') }}</span>
                        <strong class="total__value"><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($creditsUsed) }} {{ __('frontend.receipt.unit_credits') }}</strong>
                    @else
                        <span class="total__label">{{ __('frontend.receipt.sum_paid') }}</span>
                        <strong class="total__value">{!! $totalFmt !!}</strong>
                    @endif
                </div>

                <div class="stats">
                    <div class="stats__row">
                        <span>{{ __('frontend.receipt.f_status') }}</span>
                        @if($orderOk)
                            <span class="state state--ok"><i class="fas fa-check" aria-hidden="true"></i> {{ $statusLabel($order->status) }}</span>
                        @else
                            <span class="state state--wait"><i class="fas fa-clock" aria-hidden="true"></i> {{ $statusLabel($order->status) }}</span>
                        @endif
                    </div>
                    <div class="stats__row">
                        <span>{{ __('frontend.receipt.f_payment') }}</span>
                        @if($payOk)
                            <span class="state state--ok"><i class="fas fa-check" aria-hidden="true"></i> {{ $statusLabel($order->payment_status) }}</span>
                        @else
                            <span class="state state--wait"><i class="fas fa-clock" aria-hidden="true"></i> {{ $statusLabel($order->payment_status) }}</span>
                        @endif
                    </div>
                </div>

                <div class="rcpt__actions">
                    <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--primary btn--block">
                        <i class="fas fa-download" aria-hidden="true"></i>
                        {{ __('frontend.receipt.go_pdf') }}
                    </a>
                    <button type="button" class="btn btn--ghost btn--block" data-print>
                        <i class="fas fa-print" aria-hidden="true"></i>
                        {{ __('frontend.receipt.go_print') }}
                    </button>
                    <a href="{{ route('user') }}" class="btn btn--quiet btn--block">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        {{ __('frontend.receipt.go_back') }}
                    </a>
                </div>
            </aside>
        </div>
    @else
        <div class="rcpt__grid">
            <div class="ticket">
                <div class="blank">
                    <span class="blank__icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
                    <h2 class="ticket__no">{{ __('frontend.receipt.none_title') }}</h2>
                    <p>{{ __('frontend.receipt.none_text') }}</p>
                    <a href="{{ route('user') }}" class="btn btn--primary">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        {{ __('frontend.receipt.go_back') }}
                    </a>
                </div>
            </div>
        </div>
    @endif
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var button = document.querySelector('[data-print]');

    if (button) {
        button.addEventListener('click', function () {
            window.print();
        });
    }
}());
</script>
@endpush
