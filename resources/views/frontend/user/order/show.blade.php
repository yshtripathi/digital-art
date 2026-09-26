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

<section class="inv">
    <div class="inv__wrap">
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

        <header class="inv-top">
            <div class="inv-top__id">
                <span class="inv-top__tag">
                    <i class="fas fa-receipt" aria-hidden="true"></i>
                    {{ __('frontend.receipt.tag') }}
                </span>
                <p class="inv-top__no">{{ $order->order_number }}</p>
                <p class="inv-top__date">{{ $created->translatedFormat(__('frontend.receipt.fmt_head')) }}</p>
                <div class="inv-top__pills">
                    <span class="inv-top__pill">
                        <small>{{ __('frontend.receipt.f_status') }}</small>
                        <span class="pill {{ $orderOk ? 'pill--ok' : 'pill--wait' }}"><i class="fas {{ $orderOk ? 'fa-check' : 'fa-clock' }}" aria-hidden="true"></i> {{ $statusLabel($order->status) }}</span>
                    </span>
                    <span class="inv-top__pill">
                        <small>{{ __('frontend.receipt.f_payment') }}</small>
                        <span class="pill {{ $payOk ? 'pill--ok' : 'pill--wait' }}"><i class="fas {{ $payOk ? 'fa-check' : 'fa-clock' }}" aria-hidden="true"></i> {{ $statusLabel($order->payment_status) }}</span>
                    </span>
                </div>
            </div>

            <div class="inv-top__sum">
                @if($paidWithCredits)
                    <span class="inv-top__label">{{ __('frontend.receipt.sum_used') }}</span>
                    <strong class="inv-top__value num">{{ number_format($creditsUsed) }} <small>{{ __('frontend.receipt.unit_credits') }}</small></strong>
                @else
                    <span class="inv-top__label">{{ __('frontend.receipt.sum_paid') }}</span>
                    <strong class="inv-top__value num">{!! $totalFmt !!}</strong>
                @endif

                <div class="inv-top__acts">
                    <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--primary">
                        <i class="fas fa-download" aria-hidden="true"></i>
                        {{ __('frontend.receipt.go_pdf') }}
                    </a>
                    <button type="button" class="btn inv-top__ghost" data-print>
                        <i class="fas fa-print" aria-hidden="true"></i>
                        {{ __('frontend.receipt.go_print') }}
                    </button>
                </div>
            </div>
        </header>

        <div class="inv-body">
            @if(count($items))
                <section class="inv-card" aria-labelledby="invItems">
                    <h2 class="inv-card__title" id="invItems">{{ __('frontend.receipt.items_head') }}</h2>
                    <ul class="inv-items">
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
                            <li class="inv-item">
                                <span class="inv-item__icon {{ $isCourse ? '' : 'inv-item__icon--credits' }}" aria-hidden="true">
                                    <i class="fas {{ $isCourse ? 'fa-graduation-cap' : 'fa-coins' }}"></i>
                                </span>
                                <span class="inv-item__text">
                                    <span class="inv-item__title">{{ $itemTitle }}</span>
                                    @if($itemLevel)
                                        <span class="inv-item__level">{{ $itemLevel }}</span>
                                    @endif
                                </span>
                                <span class="inv-item__credits"><span class="num">{{ number_format($item->points) }}</span> {{ __('frontend.receipt.unit_credits') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            <section class="inv-card" aria-labelledby="invInfo">
                <h2 class="inv-card__title" id="invInfo">{{ __('frontend.receipt.info_head') }}</h2>
                <dl class="inv-info">
                    <div>
                        <dt>{{ __('frontend.receipt.f_name') }}</dt>
                        <dd>{{ $order->first_name }} {{ $order->last_name }}</dd>
                    </div>
                    <div>
                        <dt>{{ __('frontend.receipt.f_email') }}</dt>
                        <dd>{{ $order->email }}</dd>
                    </div>
                    <div>
                        <dt>{{ __('frontend.receipt.f_method') }}</dt>
                        <dd>
                            @if($paidWithCredits)
                                <i class="fas fa-coins" aria-hidden="true"></i> {{ __('frontend.receipt.pay_credits') }}
                            @else
                                <i class="far fa-credit-card" aria-hidden="true"></i> {{ __('frontend.receipt.pay_card') }}
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt>{{ __('frontend.receipt.f_qty') }}</dt>
                        <dd class="num">{{ $order->quantity }}</dd>
                    </div>
                    <div>
                        <dt>{{ __('frontend.receipt.f_date') }}</dt>
                        <dd>{{ $created->translatedFormat(__('frontend.receipt.fmt_date')) }}</dd>
                    </div>
                    <div class="inv-info__wide">
                        <dt>{{ __('frontend.receipt.f_txn') }}</dt>
                        <dd class="num">{{ $order->trans_id ?: '—' }}</dd>
                    </div>
                </dl>
            </section>
        </div>

        <a href="{{ route('user') }}" class="inv-back">
            <i class="fas fa-arrow-left" aria-hidden="true"></i>
            {{ __('frontend.receipt.go_back') }}
        </a>
    @else
        <div class="acct-blank inv-none">
            <span class="acct-blank__icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
            <h2 class="inv-none__title">{{ __('frontend.receipt.none_title') }}</h2>
            <p>{{ __('frontend.receipt.none_text') }}</p>
            <a href="{{ route('user') }}" class="btn btn--primary">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                {{ __('frontend.receipt.go_back') }}
            </a>
        </div>
    @endif
    </div>
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
