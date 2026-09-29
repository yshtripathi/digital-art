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

<section class="pay">
    <div class="container">
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

            <div class="pay__grid">
                <article class="pay-card rc" style="--i: 0">
                    <header class="rc__head">
                        <div>
                            <span class="tag">{{ __('frontend.receipt.label') }}</span>
                            <h2 class="rc__no">{{ $order->order_number }}</h2>
                            <p class="rc__date">{{ $created->translatedFormat(__('frontend.receipt.heading_format')) }}</p>
                        </div>
                        <div class="rc__total">
                            <span>{{ $paidWithCredits ? __('frontend.receipt.total_credits') : __('frontend.receipt.total_paid') }}</span>
                            @if($paidWithCredits)
                                <strong>{{ number_format($creditsUsed) }} <small>{{ __('frontend.receipt.credits') }}</small></strong>
                            @else
                                <strong>{{ $totalFmt }}</strong>
                            @endif
                        </div>
                    </header>

                    <dl class="rc__states">
                        <div>
                            <dt>{{ __('frontend.receipt.order_status') }}</dt>
                            <dd><span class="st {{ $orderOk ? 'st--ok' : ($orderBad ? 'st--err' : 'st--wait') }}">{{ $statusLabel($order->status) }}</span></dd>
                        </div>
                        <div>
                            <dt>{{ __('frontend.receipt.payment_status') }}</dt>
                            <dd><span class="st {{ $payOk ? 'st--ok' : ($payBad ? 'st--err' : 'st--wait') }}">{{ $statusLabel($order->payment_status) }}</span></dd>
                        </div>
                        <div>
                            <dt>{{ __('frontend.receipt.method') }}</dt>
                            <dd class="rc__method">
                                <i class="{{ $paidWithCredits ? 'fas fa-coins' : 'far fa-credit-card' }}" aria-hidden="true"></i>
                                {{ $paidWithCredits ? __('frontend.receipt.paid_credits') : __('frontend.receipt.card') }}
                            </dd>
                        </div>
                    </dl>

                    @if(count($items))
                        <h3 class="rc__title">{{ __('frontend.receipt.items_title') }}</h3>
                        <div class="dt">
                            <table>
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
                                            <td>
                                                <span class="dt__item">
                                                    <span class="dt__thumb {{ $isCourse ? '' : 'is-credits' }}" aria-hidden="true"><i class="fas {{ $isCourse ? 'fa-book-open' : 'fa-coins' }}"></i></span>
                                                    <span class="dt__title">{{ $itemTitle }}</span>
                                                </span>
                                            </td>
                                            <td>
                                                @if($itemLevel)
                                                    <span class="tag tag--active">{{ $itemLevel }}</span>
                                                @else
                                                    <span class="dt__dash">—</span>
                                                @endif
                                            </td>
                                            <td class="is-num">{{ number_format($item->points) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row" colspan="2">{{ $paidWithCredits ? __('frontend.receipt.total_credits') : __('frontend.receipt.total_paid') }}</th>
                                        <td class="is-num"><strong>{{ $paidWithCredits ? number_format($creditsUsed) . ' ' . __('frontend.receipt.credits') : $totalFmt }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endif

                    <h3 class="rc__title">{{ __('frontend.receipt.info_title') }}</h3>
                    <dl class="rc__info">
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
                        <div class="rc__info-wide">
                            <dt>{{ __('frontend.receipt.transaction') }}</dt>
                            <dd class="rc__txn">
                                <span data-copy-text>{{ $order->trans_id ?: '—' }}</span>
                                @if($order->trans_id)
                                    <button type="button" class="res-fact__copy" data-copy data-done="{{ __('frontend.success.copied') }}" aria-label="{{ __('frontend.success.copy', ['item' => __('frontend.receipt.transaction')]) }}">
                                        <i class="far fa-copy" aria-hidden="true"></i>
                                        <span data-copy-label>{{ __('frontend.success.copy_btn') }}</span>
                                    </button>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </article>

                <aside class="pay__rail">
                    <div class="pay-sum rc-side">
                        <span class="res-help__icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
                        <p class="rc-side__no">{{ $order->order_number }}</p>
                        <a href="{{ route('order.pdf', $order->id) }}" class="btn btn--primary btn--block">
                            <i class="fas fa-download" aria-hidden="true"></i>
                            <span>{{ __('frontend.receipt.pdf') }}</span>
                        </a>
                        <button type="button" class="btn btn--dark btn--block" data-print>
                            <i class="fas fa-print" aria-hidden="true"></i>
                            <span>{{ __('frontend.receipt.print') }}</span>
                        </button>
                        <a href="{{ route('user') }}" class="pay-sum__back">{{ __('frontend.receipt.back') }}</a>
                    </div>
                </aside>
            </div>
        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-file-invoice"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.receipt.missing_title') }}</h2>
                <p class="bag-empty__text">{{ __('frontend.receipt.missing_text') }}</p>
                <div class="bag-empty__acts">
                    <a href="{{ route('user') }}" class="btn btn--primary">{{ __('frontend.receipt.back') }}</a>
                </div>
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
