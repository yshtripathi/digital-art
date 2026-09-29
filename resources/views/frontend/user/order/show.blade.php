@extends('frontend.layouts.main')
@section('title', __('frontend.receipt.title'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.receipt.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.receipt.account'), 'url' => route('user')],
        ['name' => __('frontend.receipt.title')]
    ]
])

<section class="bill">
    @if($order && (int) $order->user_id === (int) auth()->id())
        @php
            $totalFmt = Helper::getCurrencySymbol($order->currency) . number_format($order->total_amount, $order->currency == 'JPY' ? 0 : 2);
            $items = $order->cart_info ?? collect();
            $payOk = in_array(strtolower((string) $order->payment_status), ['completed', 'paid', 'success']);
            $orderOk = in_array(strtolower((string) $order->status), ['completed', 'delivered']);
            $orderBad = str_contains(strtolower((string) $order->status), 'fail') || strtolower((string) $order->status) === 'cancel';
            $payBad = str_contains(strtolower((string) $order->payment_status), 'fail');
            $statusLabel = function ($value) {
                $key = 'frontend.receipt.state_' . str_replace(' ', '_', strtolower(trim((string) $value)));
                return Lang::has($key) ? __($key) : ucwords((string) $value);
            };
            $created = $order->created_at->locale(app()->getLocale());
            $paidWithCredits = str_starts_with((string) $order->order_number, 'ORD-PTS-');
            $creditsUsed = $items->sum('points');
        @endphp

        <div class="bill__grid">
            <article class="bill__doc">
                <header class="bill__head">
                    <div class="bill__id">
                        <span class="bill__tag"><i class="fas fa-receipt" aria-hidden="true"></i>{{ __('frontend.receipt.label') }}</span>
                        <h2 class="bill__no">{{ $order->order_number }}</h2>
                        <p class="bill__date"><i class="far fa-calendar" aria-hidden="true"></i>{{ $created->translatedFormat(__('frontend.receipt.heading_format')) }}</p>
                    </div>
                    <div class="bill__sum">
                        @if($paidWithCredits)
                            <span>{{ __('frontend.receipt.total_credits') }}</span>
                            <strong>{{ number_format($creditsUsed) }} <small>{{ __('frontend.receipt.credits') }}</small></strong>
                        @else
                            <span>{{ __('frontend.receipt.total_paid') }}</span>
                            <strong>{{ $totalFmt }}</strong>
                        @endif
                    </div>
                </header>

                <dl class="bill__status">
                    <div>
                        <dt>{{ __('frontend.receipt.order_status') }}</dt>
                        <dd><span class="pill {{ $orderOk ? 'pill--ok' : ($orderBad ? 'pill--err' : 'pill--wait') }}"><i class="fas {{ $orderOk ? 'fa-check' : ($orderBad ? 'fa-times' : 'fa-clock') }}" aria-hidden="true"></i>{{ $statusLabel($order->status) }}</span></dd>
                    </div>
                    <div>
                        <dt>{{ __('frontend.receipt.payment_status') }}</dt>
                        <dd><span class="pill {{ $payOk ? 'pill--ok' : ($payBad ? 'pill--err' : 'pill--wait') }}"><i class="fas {{ $payOk ? 'fa-check' : ($payBad ? 'fa-times' : 'fa-clock') }}" aria-hidden="true"></i>{{ $statusLabel($order->payment_status) }}</span></dd>
                    </div>
                    <div>
                        <dt>{{ __('frontend.receipt.method') }}</dt>
                        <dd class="bill__method">
                            @if($paidWithCredits)
                                <i class="fas fa-coins" aria-hidden="true"></i>{{ __('frontend.receipt.paid_credits') }}
                            @else
                                <i class="far fa-credit-card" aria-hidden="true"></i>{{ __('frontend.receipt.card') }}
                            @endif
                        </dd>
                    </div>
                </dl>

                @if(count($items))
                    <section class="bill__part" aria-labelledby="billItems">
                        <h3 class="bill__title" id="billItems">{{ __('frontend.receipt.items_title') }}</h3>
                        <div class="ledger">
                            <table class="ledger__table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('frontend.receipt.col_item') }}</th>
                                        <th scope="col">{{ __('frontend.receipt.col_level') }}</th>
                                        <th scope="col" class="is-num">{{ __('frontend.receipt.col_credits') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        @php
                                            $isCourse = $item->product && $item->product_id < 1000;
                                            $itemTitle = $isCourse ? $item->product->title : __('frontend.receipt.package');
                                            $itemLevel = null;
                                            if ($isCourse) {
                                                $lvl = \App\Models\ProductLevel::where('course_id', $item->product_id)->where('price_in_points', $item->points)->first();
                                                if ($lvl) {
                                                    $lvlKey = 'frontend.receipt.level_' . str_replace(' ', '_', strtolower(trim((string) $lvl->skill_level)));
                                                    $itemLevel = Lang::has($lvlKey) ? __($lvlKey) : ucfirst($lvl->skill_level);
                                                }
                                            }
                                        @endphp
                                        <tr>
                                            <td data-label="{{ __('frontend.receipt.col_item') }}">
                                                <span class="ledger__item">
                                                    <span class="ledger__thumb {{ $isCourse ? '' : 'is-credits' }}" aria-hidden="true"><i class="fas {{ $isCourse ? 'fa-book-open' : 'fa-coins' }}"></i></span>
                                                    <span class="ledger__title">{{ $itemTitle }}</span>
                                                </span>
                                            </td>
                                            <td data-label="{{ __('frontend.receipt.col_level') }}">
                                                @if($itemLevel)
                                                    <span class="ledger__level">{{ $itemLevel }}</span>
                                                @else
                                                    <span class="ledger__dash">—</span>
                                                @endif
                                            </td>
                                            <td data-label="{{ __('frontend.receipt.col_credits') }}" class="is-num"><span class="ledger__credits"><i class="fas fa-coins" aria-hidden="true"></i>{{ number_format($item->points) }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row" colspan="2">{{ $paidWithCredits ? __('frontend.receipt.total_credits') : __('frontend.receipt.total_paid') }}:</th>
                                        <td class="is-num">
                                            @if($paidWithCredits)
                                                <strong>{{ number_format($creditsUsed) }} {{ __('frontend.receipt.credits') }}</strong>
                                            @else
                                                <strong>{{ $totalFmt }}</strong>
                                            @endif
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </section>
                @endif

                <section class="bill__part" aria-labelledby="billInfo">
                    <h3 class="bill__title" id="billInfo">{{ __('frontend.receipt.info_title') }}</h3>
                    <dl class="bill__info">
                        <div>
                            <dt>{{ __('frontend.receipt.name') }}</dt>
                            <dd>{{ $order->first_name }} {{ $order->last_name }}</dd>
                        </div>
                        <div>
                            <dt>{{ __('frontend.receipt.email') }}</dt>
                            <dd>{{ $order->email }}</dd>
                        </div>
                        <div>
                            <dt>{{ __('frontend.receipt.quantity') }}</dt>
                            <dd>{{ $order->quantity }}</dd>
                        </div>
                        <div>
                            <dt>{{ __('frontend.receipt.date') }}</dt>
                            <dd>{{ $created->translatedFormat(__('frontend.receipt.date_format')) }}</dd>
                        </div>
                        <div class="bill__info-wide">
                            <dt>{{ __('frontend.receipt.transaction') }}</dt>
                            <dd class="bill__txn">
                                <span data-copy-text>{{ $order->trans_id ?: '—' }}</span>
                                @if($order->trans_id)
                                    <button type="button" class="fact__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.receipt.transaction')]) }}">
                                        <i class="far fa-copy" aria-hidden="true"></i>
                                        <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                                    </button>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </section>
            </article>

            <aside class="bill__side">
                <div class="bill__panel">
                    <span class="bill__panel-icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
                    <p class="bill__panel-no">{{ $order->order_number }}</p>
                    <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--block">
                        <i class="fas fa-file-download" aria-hidden="true"></i>
                        {{ __('frontend.receipt.pdf') }}
                    </a>
                    <button type="button" class="btn btn--outline btn--block" data-print>
                        <i class="fas fa-print" aria-hidden="true"></i>
                        {{ __('frontend.receipt.print') }}
                    </button>
                </div>
                <a href="{{ route('user') }}" class="bill__back">
                    <i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i>
                    {{ __('frontend.receipt.back') }}
                </a>
            </aside>
        </div>
    @else
        <div class="nomatch nomatch--page">
            <span class="nomatch__icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
            <h2 class="nomatch__title">{{ __('frontend.receipt.missing_title') }}</h2>
            <p class="nomatch__text">{{ __('frontend.receipt.missing_text') }}</p>
            <a href="{{ route('user') }}" class="btn">
                <i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i>
                {{ __('frontend.receipt.back') }}
            </a>
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
