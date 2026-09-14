@extends('frontend.layouts.main')
@section('title', __('managenovax.receipt.doc_title'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.receipt.doc_title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.dashboard.my_account'), 'url' => route('user')],
        ['name' => __('managenovax.receipt.doc_title')]
    ]
])

<section class="rc">
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
            @endphp

            <div class="rc__grid">

                {{-- ================= RECEIPT ================= --}}
                <article class="rc-ticket">
                    <header class="rc-ticket__head">
                        <div>
                            <span class="rc-ticket__eyebrow"><i class="fas fa-receipt"></i> {{ __('managenovax.receipt.doc_title') }}</span>
                            <h2 class="rc-ticket__num">#{{ $order->order_number }}</h2>
                            <span class="rc-ticket__date"><i class="far fa-calendar"></i> {{ $order->created_at->format('D d M, Y') }} {{ __('managenovax.receipt.at_time') }} {{ $order->created_at->format('g:i a') }}</span>
                        </div>
                        <div class="rc-ticket__stamp {{ $payOk ? 'is-ok' : '' }}" aria-hidden="true">
                            <i class="fas {{ $payOk ? 'fa-check' : 'fa-hourglass-half' }}"></i>
                        </div>
                    </header>

                    <div class="rc-tear" aria-hidden="true"></div>

                    {{-- Items --}}
                    @if(count($items))
                        <h3 class="rc-h"><i class="fas fa-list-ul"></i> {{ __('managenovax.receipt.hdg_items') }}</h3>
                        <ul class="rc-items">
                            @foreach($items as $item)
                                @php
                                    $isCourse = $item->product && $item->product_id < 1000;
                                    $iTitle = $item->product ? $item->product->title : __('managenovax.cart.item_topup');
                                @endphp
                                <li class="rc-item">
                                    <span class="rc-item__icon {{ $isCourse ? 'is-course' : '' }}"><i class="fas {{ $isCourse ? 'fa-graduation-cap' : 'fa-coins' }}"></i></span>
                                    <span class="rc-item__title">{{ $isCourse ? $iTitle : __('managenovax.cart.item_topup') }}</span>
                                    <span class="rc-item__pts"><i class="fas fa-coins"></i> {{ number_format($item->points) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Details --}}
                    <h3 class="rc-h"><i class="fas fa-clipboard-list"></i> {{ __('managenovax.receipt.hdg_info') }}</h3>
                    <dl class="rc-details">
                        <div class="rc-detail">
                            <dt>{{ __('managenovax.receipt.lbl_ref') }}</dt>
                            <dd>{{ $order->order_number }}</dd>
                        </div>
                        <div class="rc-detail">
                            <dt>{{ __('managenovax.receipt.lbl_name') }}</dt>
                            <dd>{{ $order->first_name }} {{ $order->last_name }}</dd>
                        </div>
                        <div class="rc-detail">
                            <dt>{{ __('managenovax.receipt.lbl_email') }}</dt>
                            <dd>{{ $order->email }}</dd>
                        </div>
                        <div class="rc-detail">
                            <dt>{{ __('managenovax.receipt.lbl_qty') }}</dt>
                            <dd>{{ $order->quantity }}</dd>
                        </div>
                        <div class="rc-detail">
                            <dt>{{ __('managenovax.receipt.lbl_method') }}</dt>
                            <dd><i class="far fa-credit-card"></i> {{ __('managenovax.receipt.lbl_card') }}</dd>
                        </div>
                        <div class="rc-detail">
                            <dt>{{ __('managenovax.receipt.lbl_date') }}</dt>
                            <dd>{{ $order->created_at->format('d M Y, g:i a') }}</dd>
                        </div>
                        <div class="rc-detail rc-detail--wide">
                            <dt>{{ __('managenovax.receipt.lbl_trans_id') }}</dt>
                            <dd class="rc-mono">{{ $order->trans_id ?: '—' }}</dd>
                        </div>
                    </dl>
                </article>

                {{-- ================= SUMMARY ================= --}}
                <aside class="rc-side">
                    <div class="rc-total">
                        <span class="rc-total__label">{{ __('managenovax.receipt.lbl_total') }}</span>
                        <strong class="rc-total__value">{!! $totalFmt !!}</strong>
                    </div>

                    <div class="rc-statuses">
                        <div class="rc-status">
                            <span>{{ __('managenovax.receipt.lbl_status') }}</span>
                            <span class="ds-status {{ $orderOk ? 'ds-status--ok' : 'ds-status--wait' }}">{{ ucwords($order->status) }}</span>
                        </div>
                        <div class="rc-status">
                            <span>{{ __('managenovax.receipt.lbl_payment') }}</span>
                            <span class="ds-status {{ $payOk ? 'ds-status--ok' : 'ds-status--wait' }}">{{ ucwords($order->payment_status) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('order.pdf', $order->id) }}" class="ds-btn ds-btn--lime ds-btn--block">
                        <i class="fas fa-download"></i> {{ __('managenovax.receipt.btn_pdf') }}
                    </a>
                    <button type="button" class="ds-btn ds-btn--ghost ds-btn--block" onclick="window.print();">
                        <i class="fas fa-print"></i> {{ __('managenovax.receipt.btn_print') }}
                    </button>
                    <a href="{{ route('user') }}" class="ds-btn ds-btn--outline-light ds-btn--block">
                        <i class="fas fa-arrow-left"></i> {{ __('managenovax.receipt.btn_back') }}
                    </a>
                </aside>
            </div>
        @else
            <div class="cp-empty">
                <div class="cp-empty__art" aria-hidden="true">
                    <span class="cp-empty__ring"></span>
                    <span class="cp-empty__icon"><i class="fas fa-file-invoice"></i></span>
                    <span class="cp-empty__dot cp-empty__dot--1"></span>
                    <span class="cp-empty__dot cp-empty__dot--2"></span>
                    <span class="cp-empty__dot cp-empty__dot--3"></span>
                </div>
                <h2 class="cp-empty__title">{{ __('managenovax.receipt.not_found') }}</h2>
                <p class="cp-empty__desc">{{ __('managenovax.receipt.not_found_msg') }}</p>
                <div class="cp-empty__actions">
                    <a href="{{ route('user') }}" class="cp-btn cp-btn--dark"><i class="fas fa-arrow-left"></i> {{ __('managenovax.receipt.btn_back') }}</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
