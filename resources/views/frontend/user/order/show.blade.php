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

<section class="rcp">
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
            $orderBad = str_contains(strtolower((string) $order->status), 'fail') || strtolower((string) $order->status) === 'cancel';
            $payBad = str_contains(strtolower((string) $order->payment_status), 'fail');
            $statusLabel = function ($value) {
                $key = 'frontend.receipt.state_names.' . strtolower(trim((string) $value));
                return Lang::has($key) ? __($key) : ucwords((string) $value);
            };
            $created = $order->created_at->locale(app()->getLocale());
            $paidWithCredits = str_starts_with((string) $order->order_number, 'ORD-PTS-');
            $creditsUsed = $items->sum('points');
        @endphp

        <div class="rcp__grid">
            <article class="rcp-doc" data-print-area>
                <header class="rcp-doc__band">
                    <div>
                        <span class="rcp-doc__tag"><i class="fas fa-receipt" aria-hidden="true"></i> {{ __('frontend.receipt.tag') }}</span>
                        <p class="rcp-doc__no num">{{ $order->order_number }}</p>
                        <p class="rcp-doc__date">{{ $created->translatedFormat(__('frontend.receipt.fmt_head')) }}</p>
                    </div>
                    <div class="rcp-doc__sum">
                        @if($paidWithCredits)
                            <span>{{ __('frontend.receipt.sum_used') }}</span>
                            <strong><span class="num">{{ number_format($creditsUsed) }}</span> <small>{{ __('frontend.receipt.unit_credits') }}</small></strong>
                        @else
                            <span>{{ __('frontend.receipt.sum_paid') }}</span>
                            <strong class="num">{!! $totalFmt !!}</strong>
                        @endif
                    </div>
                </header>

                <div class="rcp-doc__chips">
                    <div class="rcp-chip">
                        <small>{{ __('frontend.receipt.f_status') }}</small>
                        <span class="rcp-pill {{ $orderOk ? 'is-ok' : ($orderBad ? 'is-err' : 'is-wait') }}"><i class="fas {{ $orderOk ? 'fa-check' : ($orderBad ? 'fa-times' : 'fa-clock') }}" aria-hidden="true"></i> {{ $statusLabel($order->status) }}</span>
                    </div>
                    <div class="rcp-chip">
                        <small>{{ __('frontend.receipt.f_payment') }}</small>
                        <span class="rcp-pill {{ $payOk ? 'is-ok' : ($payBad ? 'is-err' : 'is-wait') }}"><i class="fas {{ $payOk ? 'fa-check' : ($payBad ? 'fa-times' : 'fa-clock') }}" aria-hidden="true"></i> {{ $statusLabel($order->payment_status) }}</span>
                    </div>
                    <div class="rcp-chip">
                        <small>{{ __('frontend.receipt.f_method') }}</small>
                        <span class="rcp-chip__val">
                            @if($paidWithCredits)
                                <i class="fas fa-coins" aria-hidden="true"></i> {{ __('frontend.receipt.pay_credits') }}
                            @else
                                <i class="far fa-credit-card" aria-hidden="true"></i> {{ __('frontend.receipt.pay_card') }}
                            @endif
                        </span>
                    </div>
                </div>

                @if(count($items))
                    <section class="rcp-doc__part" aria-labelledby="invItems">
                        <h2 class="rcp-doc__title" id="invItems">{{ __('frontend.receipt.lines') }}</h2>
                        <ul class="rcp-items">
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
                                <li class="rcp-item">
                                    <span class="rcp-item__icon {{ $isCourse ? '' : 'is-credits' }}" aria-hidden="true">
                                        <i class="fas {{ $isCourse ? 'fa-graduation-cap' : 'fa-coins' }}"></i>
                                    </span>
                                    <span class="rcp-item__text">
                                        <span class="rcp-item__title">{{ $itemTitle }}</span>
                                        @if($itemLevel)
                                            <span class="badge">{{ $itemLevel }}</span>
                                        @endif
                                    </span>
                                    <span class="rcp-item__credits"><span class="num">{{ number_format($item->points) }}</span> {{ __('frontend.receipt.unit_credits') }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="rcp-total">
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

                <section class="rcp-doc__part" aria-labelledby="invInfo">
                    <h2 class="rcp-doc__title" id="invInfo">{{ __('frontend.receipt.details') }}</h2>
                    <dl class="rcp-info">
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
                        <div class="rcp-info__wide">
                            <dt>{{ __('frontend.receipt.f_txn') }}</dt>
                            <dd>
                                <span class="num" data-copy-text>{{ $order->trans_id ?: '—' }}</span>
                                @if($order->trans_id)
                                    <button type="button" class="rz__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.receipt.f_txn')]) }}">
                                        <i class="far fa-copy" aria-hidden="true"></i>
                                        <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                                    </button>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </section>
            </article>

            <aside class="rcp-side">
                <span class="rcp-side__icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
                <p class="rcp-side__no num">{{ $order->order_number }}</p>
                <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--primary btn--block">
                    <i class="fas fa-download" aria-hidden="true"></i>
                    {{ __('frontend.receipt.go_pdf') }}
                </a>
                <button type="button" class="btn btn--ghost btn--block" data-print>
                    <i class="fas fa-print" aria-hidden="true"></i>
                    {{ __('frontend.receipt.go_print') }}
                </button>
                <a href="{{ route('user') }}" class="rcp-side__back">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    {{ __('frontend.receipt.go_back') }}
                </a>
            </aside>
        </div>
    @else
        <div class="ct__empty">
            <span class="ct__empty-icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
            <h2 class="ct__empty-title">{{ __('frontend.receipt.lost') }}</h2>
            <p class="ct__empty-text">{{ __('frontend.receipt.lost_text') }}</p>
            <div class="ct__empty-acts">
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

    document.addEventListener('click', function (event) {
        var copy = event.target.closest('[data-copy]');

        if (!copy) {
            return;
        }

        var source = copy.parentElement.querySelector('[data-copy-text]');
        var label = copy.querySelector('[data-copy-label]');
        var text = source ? source.textContent.trim() : '';

        if (!text) {
            return;
        }

        var done = function () {
            var original = label.textContent;
            copy.classList.add('is-done');
            label.textContent = copy.dataset.done;
            setTimeout(function () {
                copy.classList.remove('is-done');
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
}());
</script>
@endpush
