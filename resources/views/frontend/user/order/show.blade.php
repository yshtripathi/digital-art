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
    @if($order && (int) $order->user_id === (int) auth()->id())
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

        <div class="inv-acts">
            <a href="{{ route('user') }}" class="auth__back">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                {{ __('frontend.receipt.go_back') }}
            </a>
            <div class="inv-acts__right">
                <button type="button" class="btn btn--ghost" data-print>
                    <i class="fas fa-print" aria-hidden="true"></i>
                    {{ __('frontend.receipt.go_print') }}
                </button>
                <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--primary">
                    <i class="fas fa-download" aria-hidden="true"></i>
                    {{ __('frontend.receipt.go_pdf') }}
                </a>
            </div>
        </div>

        <article class="inv-doc">
            <header class="inv-doc__head">
                <div class="inv-doc__id">
                    <span class="inv-doc__tag">
                        <i class="fas fa-receipt" aria-hidden="true"></i>
                        {{ __('frontend.receipt.tag') }}
                    </span>
                    <p class="inv-doc__no num">{{ $order->order_number }}</p>
                    <p class="inv-doc__date">{{ $created->translatedFormat(__('frontend.receipt.fmt_head')) }}</p>
                </div>
                <div class="inv-doc__sum">
                    @if($paidWithCredits)
                        <span class="inv-doc__label">{{ __('frontend.receipt.sum_used') }}</span>
                        <strong class="inv-doc__value"><span class="num">{{ number_format($creditsUsed) }}</span> <small>{{ __('frontend.receipt.unit_credits') }}</small></strong>
                    @else
                        <span class="inv-doc__label">{{ __('frontend.receipt.sum_paid') }}</span>
                        <strong class="inv-doc__value num">{!! $totalFmt !!}</strong>
                    @endif
                </div>
            </header>

            <div class="inv-doc__states">
                <span class="inv-state">
                    <small>{{ __('frontend.receipt.f_status') }}</small>
                    <span class="pill {{ $orderOk ? 'pill--ok' : 'pill--wait' }}"><i class="fas {{ $orderOk ? 'fa-check' : 'fa-clock' }}" aria-hidden="true"></i> {{ $statusLabel($order->status) }}</span>
                </span>
                <span class="inv-state">
                    <small>{{ __('frontend.receipt.f_payment') }}</small>
                    <span class="pill {{ $payOk ? 'pill--ok' : 'pill--wait' }}"><i class="fas {{ $payOk ? 'fa-check' : 'fa-clock' }}" aria-hidden="true"></i> {{ $statusLabel($order->payment_status) }}</span>
                </span>
                <span class="inv-state">
                    <small>{{ __('frontend.receipt.f_method') }}</small>
                    <span class="inv-state__val">
                        @if($paidWithCredits)
                            <i class="fas fa-coins" aria-hidden="true"></i> {{ __('frontend.receipt.pay_credits') }}
                        @else
                            <i class="far fa-credit-card" aria-hidden="true"></i> {{ __('frontend.receipt.pay_card') }}
                        @endif
                    </span>
                </span>
            </div>

            <div class="rs__tear inv-doc__tear" aria-hidden="true"></div>

            @if(count($items))
                <section class="inv-doc__part" aria-labelledby="invItems">
                    <h2 class="inv-doc__title" id="invItems">{{ __('frontend.receipt.lines') }}</h2>
                    <ul class="inv-items">
                        @foreach($items as $item)
                            @php
                                $isCourse = $item->product && $item->product_id < 1000;
                                $itemTitle = $isCourse ? $item->product->title : __('frontend.receipt.pack');
                                $itemLevel = null;
                                $itemTone = 'beginner';
                                if ($isCourse) {
                                    $lvl = \App\Models\ProductLevel::where('course_id', $item->product_id)->where('price_in_points', $item->points)->first();
                                    if ($lvl) {
                                        $lvlName = strtolower($lvl->skill_level);
                                        $lvlKey = 'frontend.receipt.level_names.' . $lvlName;
                                        $itemLevel = Lang::has($lvlKey) ? __($lvlKey) : ucfirst($lvl->skill_level);
                                        $itemTone = in_array($lvlName, ['advanced', 'expert']) ? 'advanced' : ($lvlName === 'intermediate' ? 'intermediate' : 'beginner');
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
                                        <span class="badge badge--{{ $itemTone }}">{{ $itemLevel }}</span>
                                    @endif
                                </span>
                                <span class="inv-item__credits"><span class="num">{{ number_format($item->points) }}</span> {{ __('frontend.receipt.unit_credits') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="inv-total">
                        @if($paidWithCredits)
                            <span>{{ __('frontend.receipt.sum_used') }}</span>
                            <strong><span class="num">{{ number_format($creditsUsed) }}</span> {{ __('frontend.receipt.unit_credits') }}</strong>
                        @else
                            <span>{{ __('frontend.receipt.sum_paid') }}</span>
                            <strong class="num">{!! $totalFmt !!}</strong>
                        @endif
                    </div>
                </section>
            @endif

            <section class="inv-doc__part" aria-labelledby="invInfo">
                <h2 class="inv-doc__title" id="invInfo">{{ __('frontend.receipt.details') }}</h2>
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
        </article>
    @else
        <div class="rs__hero ct__empty">
            <div class="ct__orb" aria-hidden="true">
                <span class="rs__wave"></span>
                <span class="rs__wave rs__wave--late"></span>
                <i class="fas fa-file-invoice"></i>
            </div>
            <h2 class="rs__title">{{ __('frontend.receipt.lost') }}</h2>
            <p class="rs__msg">{{ __('frontend.receipt.lost_text') }}</p>
            <div class="rs__actions">
                <a href="{{ route('user') }}" class="btn btn--primary">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    {{ __('frontend.receipt.go_back') }}
                </a>
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
