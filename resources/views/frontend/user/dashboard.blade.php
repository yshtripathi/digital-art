@extends('frontend.layouts.main')
@section('title', __('frontend.dashboard.page_name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.dashboard.crumb'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.dashboard.crumb')]
    ]
])

@php
    $u = Auth::user();
    $purchasedCount = isset($purchasedOrders) ? count($purchasedOrders) : 0;
    $unlockedItems = collect($redeemedOrders ?? [])->flatMap(fn ($order) => $order->cart_info->map(fn ($item) => ['order' => $order, 'item' => $item]));
    $redeemedCount = $unlockedItems->count();
    $levelLabel = function ($level) {
        $key = 'frontend.dashboard.level_names.' . strtolower((string) $level->skill_level);
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };
    $statusLabel = function ($value) {
        $key = 'frontend.dashboard.state_names.' . strtolower(trim((string) $value));
        return Lang::has($key) ? __($key) : ucwords((string) $value);
    };
    $fmtDate = fn ($date, $format) => $date->locale(app()->getLocale())->translatedFormat($format);
@endphp

<section class="acct">
    <div class="acct-hero">
        <div class="acct-me">
            <span class="acct-me__avatar" aria-hidden="true">
                <span class="rs__wave"></span>
                {{ mb_strtoupper(mb_substr($u->name ?? 'U', 0, 1)) }}
            </span>
            <div class="acct-me__text">
                <span class="eyebrow">{{ __('frontend.dashboard.greet') }}</span>
                <h2 class="acct-me__name">{{ $u->name }}</h2>
                <p class="acct-me__meta">
                    <span><i class="far fa-envelope" aria-hidden="true"></i> {{ $u->email }}</span>
                    <span><i class="far fa-calendar" aria-hidden="true"></i> {{ __('frontend.dashboard.since') }} {{ $fmtDate($u->created_at, __('frontend.dashboard.fmt_month')) }}</span>
                </p>
            </div>
        </div>

        <div class="acct-wallet">
            <svg class="acct-wallet__line" viewBox="0 0 200 60" preserveAspectRatio="none" aria-hidden="true" focusable="false">
                <polyline points="0,48 22,44 40,50 62,34 84,38 106,24 128,30 150,16 172,20 200,6" vector-effect="non-scaling-stroke"/>
            </svg>
            <span class="acct-wallet__label">{{ __('frontend.dashboard.wallet_label') }}</span>
            <span class="acct-wallet__value num">{{ number_format($u->points_balance ?? 0) }}</span>
            <a href="{{ route('points.topup') }}" class="btn btn--primary">
                <i class="fas fa-plus" aria-hidden="true"></i>
                {{ __('frontend.dashboard.go_buy') }}
            </a>
        </div>
    </div>

    <ul class="acct-stats">
        <li class="acct-stat">
            <span class="acct-stat__icon" aria-hidden="true"><i class="fas fa-coins"></i></span>
            <span class="acct-stat__text">
                <span class="acct-stat__label">{{ __('frontend.dashboard.wallet_label') }}</span>
                <span class="acct-stat__value num">{{ number_format($u->points_balance ?? 0) }}</span>
            </span>
        </li>
        <li class="acct-stat">
            <span class="acct-stat__icon" aria-hidden="true"><i class="fas fa-lock-open"></i></span>
            <span class="acct-stat__text">
                <span class="acct-stat__label">{{ __('frontend.dashboard.stat_levels') }}</span>
                <span class="acct-stat__value num">{{ $redeemedCount }}</span>
            </span>
        </li>
        <li class="acct-stat">
            <span class="acct-stat__icon" aria-hidden="true"><i class="fas fa-receipt"></i></span>
            <span class="acct-stat__text">
                <span class="acct-stat__label">{{ __('frontend.dashboard.stat_orders') }}</span>
                <span class="acct-stat__value num">{{ $purchasedCount }}</span>
            </span>
        </li>
    </ul>

    <div class="acct-bar">
        <div class="acct-tabs" role="tablist" aria-label="{{ __('frontend.dashboard.tabs_label') }}">
            <button type="button" role="tab" class="acct-tab is-active" data-tab="purchased" aria-selected="true" aria-controls="panel-purchased">
                <i class="fas fa-receipt" aria-hidden="true"></i>
                <span>{{ __('frontend.dashboard.tab_orders') }}</span>
                <span class="acct-tab__count num">{{ $purchasedCount }}</span>
            </button>
            <button type="button" role="tab" class="acct-tab" data-tab="redeemed" aria-selected="false" aria-controls="panel-redeemed">
                <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                <span>{{ __('frontend.dashboard.tab_library') }}</span>
                <span class="acct-tab__count num">{{ $redeemedCount }}</span>
            </button>
            <button type="button" role="tab" class="acct-tab" data-tab="password" aria-selected="false" aria-controls="panel-password">
                <i class="fas fa-lock" aria-hidden="true"></i>
                <span>{{ __('frontend.dashboard.tab_security') }}</span>
            </button>
        </div>
        <a href="{{ route('user.logout') }}" class="acct-out">
            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
            {{ __('frontend.dashboard.sign_out') }}
        </a>
    </div>

    <div class="acct-panel" id="panel-purchased" role="tabpanel" data-panel="purchased">
        <h2 class="acct-panel__title">{{ __('frontend.dashboard.buys') }}</h2>

        @if($purchasedCount > 0)
            <div class="acct-ledger">
                <div class="acct-ledger__head" aria-hidden="true">
                    <span>{{ __('frontend.receipt.tag') }}</span>
                    <span>{{ __('frontend.dashboard.th_credits') }}</span>
                    <span>{{ __('frontend.dashboard.th_amount') }}</span>
                    <span>{{ __('frontend.dashboard.th_status') }}</span>
                    <span></span>
                </div>
                <ul class="acct-ledger__rows">
                    @foreach($purchasedOrders as $order)
                        @php $payState = strtolower(trim((string) $order->payment_status)); @endphp
                        <li class="acct-row" style="--i: {{ $loop->index }}">
                            <div class="acct-row__id">
                                <span class="acct-row__icon" aria-hidden="true"><i class="fas fa-coins"></i></span>
                                <span>
                                    <span class="acct-row__no num">{{ $order->order_number }}</span>
                                    <span class="acct-row__date">
                                        <span class="vh">{{ __('frontend.dashboard.th_date') }}:</span>
                                        {{ $fmtDate($order->created_at, __('frontend.dashboard.fmt_date')) }}
                                    </span>
                                </span>
                            </div>
                            <div class="acct-row__fig">
                                <small>{{ __('frontend.dashboard.th_credits') }}</small>
                                <strong class="num"><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($order->cart_info->sum('points')) }}</strong>
                            </div>
                            <div class="acct-row__fig">
                                <small>{{ __('frontend.dashboard.th_amount') }}</small>
                                <strong class="num">{!! $order->currency=='JPY' ? '&yen;' : Helper::getCurrencySymbol($order->currency) !!}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</strong>
                            </div>
                            <div class="acct-row__state">
                                <span class="vh">{{ __('frontend.dashboard.th_status') }}:</span>
                                @if(in_array($payState, ['completed', 'paid', 'success']))
                                    <span class="pill pill--ok"><i class="fas fa-check" aria-hidden="true"></i> {{ $statusLabel('Completed') }}</span>
                                @elseif(in_array($payState, ['failed', 'payment failed']))
                                    <span class="pill pill--err"><i class="fas fa-times" aria-hidden="true"></i> {{ $statusLabel($payState) }}</span>
                                @else
                                    <span class="pill pill--wait"><i class="fas fa-clock" aria-hidden="true"></i> {{ $statusLabel('Pending') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('user.order.show', $order->id) }}" class="acct-row__go" aria-label="{{ __('frontend.dashboard.go_receipt') }}: {{ $order->order_number }}">
                                <span>{{ __('frontend.dashboard.go_receipt') }}</span>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="acct-blank">
                <span class="acct-blank__icon" aria-hidden="true"><span class="rs__wave"></span><i class="fas fa-receipt"></i></span>
                <p>{{ __('frontend.dashboard.buys_none') }}</p>
                <a href="{{ route('points.topup') }}" class="btn btn--primary">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                    {{ __('frontend.dashboard.go_buy') }}
                </a>
            </div>
        @endif
    </div>

    <div class="acct-panel" id="panel-redeemed" role="tabpanel" data-panel="redeemed" hidden>
        <h2 class="acct-panel__title">{{ __('frontend.dashboard.lib') }}</h2>

        @if($redeemedCount > 0)
            <ul class="acct-lib">
                @foreach($unlockedItems as $unlocked)
                    @php
                        $order = $unlocked['order'];
                        $cartItem = $unlocked['item'];
                        $level = null;
                        if($cartItem) {
                            $level = \App\Models\ProductLevel::where('course_id', $cartItem->product_id)
                                                             ->where('price_in_points', $cartItem->points)
                                                             ->first();
                        }
                        $product = $cartItem ? $cartItem->product : null;
                        $cimg = $product && $product->photo ? explode(',', $product->photo)[0] : null;
                        $lvName = $level ? strtolower((string) $level->skill_level) : '';
                        $lvTone = in_array($lvName, ['advanced', 'expert']) ? 'advanced' : ($lvName === 'intermediate' ? 'intermediate' : 'beginner');
                    @endphp
                    <li class="acct-mat" style="--i: {{ $loop->index }}">
                        <div class="acct-mat__media">
                            @if($cimg)
                                <img src="{{ asset(ltrim($cimg, '/')) }}" alt="" loading="lazy">
                            @else
                                <i class="fas fa-chart-line" aria-hidden="true"></i>
                            @endif

                            @if(strtolower($order->status) === 'completed')
                                <span class="pill pill--ok acct-mat__state"><i class="fas fa-lock-open" aria-hidden="true"></i> {{ __('frontend.dashboard.unlocked') }}</span>
                            @else
                                <span class="pill pill--wait acct-mat__state"><i class="fas fa-clock" aria-hidden="true"></i> {{ $statusLabel($order->status) }}</span>
                            @endif
                        </div>

                        <div class="acct-mat__body">
                            <div class="acct-mat__tags">
                                @if($level)
                                    <span class="badge badge--{{ $lvTone }}">{{ $levelLabel($level) }}</span>
                                @endif
                                <span class="acct-mat__cost"><i class="fas fa-bolt" aria-hidden="true"></i> <span class="num">{{ number_format($cartItem->points) }}</span></span>
                            </div>

                            <h3 class="acct-mat__title">{{ $product ? $product->title : __('frontend.dashboard.gone') }}</h3>

                            <p class="acct-mat__meta">
                                <span class="num">{{ $order->order_number }}</span>
                                <span>{{ $fmtDate($order->created_at, __('frontend.dashboard.fmt_date')) }}</span>
                            </p>

                            @if($product)
                                <a href="{{ route('product-detail', $product->slug) }}" class="acct-mat__go">
                                    {{ __('frontend.dashboard.go_material') }}
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="acct-blank">
                <span class="acct-blank__icon" aria-hidden="true"><span class="rs__wave"></span><i class="fas fa-book-open"></i></span>
                <p>{{ __('frontend.dashboard.lib_none') }}</p>
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                    {{ __('frontend.dashboard.go_browse') }}
                </a>
            </div>
        @endif
    </div>

    <div class="acct-panel" id="panel-password" role="tabpanel" data-panel="password" hidden>
        <h2 class="acct-panel__title">{{ __('frontend.dashboard.pw_head') }}</h2>

        <div class="acct-pwd">
            <form action="{{ route('change.password') }}" method="POST" id="pwdForm" class="acct-pwd__form" novalidate>
                @csrf

                <div class="auth__fields">
                    <div class="fld fld--pass">
                        <label class="fld__label" for="current_password">{{ __('frontend.dashboard.pw_now') }}</label>
                        <div class="fld__box">
                            <i class="fas fa-lock fld__icon" aria-hidden="true"></i>
                            <input type="password" id="current_password" name="current_password" autocomplete="current-password" class="fld__input @error('current_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.pw_now_hint') }}">
                            <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.pass_show') }}" data-hide="{{ __('frontend.dashboard.pass_hide') }}" aria-label="{{ __('frontend.dashboard.pass_show') }}" aria-pressed="false">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        @error('current_password')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                    </div>

                    <div class="fld fld--pass">
                        <label class="fld__label" for="new_password">{{ __('frontend.dashboard.pw_new') }}</label>
                        <div class="fld__box">
                            <i class="fas fa-key fld__icon" aria-hidden="true"></i>
                            <input type="password" id="new_password" name="new_password" autocomplete="new-password" class="fld__input @error('new_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.pw_new_hint') }}">
                            <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.pass_show') }}" data-hide="{{ __('frontend.dashboard.pass_hide') }}" aria-label="{{ __('frontend.dashboard.pass_show') }}" aria-pressed="false">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        @error('new_password')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                    </div>

                    <div class="fld fld--pass">
                        <label class="fld__label" for="new_confirm_password">{{ __('frontend.dashboard.pw_again') }}</label>
                        <div class="fld__box">
                            <i class="fas fa-key fld__icon" aria-hidden="true"></i>
                            <input type="password" id="new_confirm_password" name="new_confirm_password" autocomplete="new-password" class="fld__input @error('new_confirm_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.pw_again_hint') }}">
                            <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.pass_show') }}" data-hide="{{ __('frontend.dashboard.pass_hide') }}" aria-label="{{ __('frontend.dashboard.pass_show') }}" aria-pressed="false">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        @error('new_confirm_password')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                    </div>

                    <button type="submit" class="btn btn--primary btn--block auth__submit">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        {{ __('frontend.dashboard.pw_save') }}
                    </button>
                </div>
            </form>

            <aside class="acct-tips">
                <span class="acct-tips__icon" aria-hidden="true"><i class="fas fa-shield-alt"></i></span>
                <h3 class="acct-tips__title">{{ __('frontend.dashboard.tips') }}</h3>
                <ul class="acct-tips__list">
                    <li><i class="fas fa-check" aria-hidden="true"></i><span>{{ __('frontend.dashboard.tip_length') }}</span></li>
                    <li><i class="fas fa-check" aria-hidden="true"></i><span>{{ __('frontend.dashboard.tip2') }}</span></li>
                    <li><i class="fas fa-check" aria-hidden="true"></i><span>{{ __('frontend.dashboard.tip3') }}</span></li>
                </ul>
            </aside>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var tabs = document.querySelectorAll('.acct-tab[data-tab]');
    var panels = document.querySelectorAll('[data-panel]');

    function open(name) {
        tabs.forEach(function (tab) {
            var on = tab.getAttribute('data-tab') === name;
            tab.classList.toggle('is-active', on);
            tab.setAttribute('aria-selected', on ? 'true' : 'false');
        });

        panels.forEach(function (panel) {
            panel.hidden = panel.getAttribute('data-panel') !== name;
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            open(tab.getAttribute('data-tab'));
        });
    });

    @if($errors->any())
        open('password');
    @endif

    var pwdForm = document.getElementById('pwdForm');

    if (pwdForm) {
        var pwdText = {
            current: @json(__('frontend.dashboard.pw_now_empty')),
            fresh: @json(__('frontend.dashboard.pw_new_empty')),
            short: @json(__('frontend.dashboard.pw_new_short', ['min' => 8])),
            match: @json(__('frontend.dashboard.pw_diff'))
        };

        var clearNote = function (field) {
            field.classList.remove('is-invalid');
            var note = field.closest('.fld').querySelector('[data-live-error]');
            if (note) { note.remove(); }
        };

        var addNote = function (field, text) {
            field.classList.add('is-invalid');
            var note = document.createElement('span');
            note.className = 'fld__err';
            note.setAttribute('data-live-error', '');
            note.innerHTML = '<i class="fas fa-info-circle" aria-hidden="true"></i> ';
            note.appendChild(document.createTextNode(text));
            field.closest('.fld').appendChild(note);
        };

        pwdForm.addEventListener('submit', function (event) {
            var current = document.getElementById('current_password');
            var fresh = document.getElementById('new_password');
            var again = document.getElementById('new_confirm_password');
            var first = null;

            [current, fresh, again].forEach(clearNote);

            var fail = function (field, text) {
                addNote(field, text);
                first = first || field;
            };

            if (!current.value) { fail(current, pwdText.current); }
            if (!fresh.value) { fail(fresh, pwdText.fresh); }
            else if (fresh.value.length < 8) { fail(fresh, pwdText.short); }
            if (again.value !== fresh.value) { fail(again, pwdText.match); }

            if (first) {
                event.preventDefault();
                first.focus();
            }
        });
    }

    document.addEventListener('click', function (event) {
        var button = event.target.closest('[data-pass-toggle]');

        if (!button) {
            return;
        }

        var input = button.parentElement.querySelector('input');
        var reveal = input.type === 'password';

        input.type = reveal ? 'text' : 'password';
        button.setAttribute('aria-pressed', reveal ? 'true' : 'false');
        button.setAttribute('aria-label', reveal ? button.dataset.hide : button.dataset.show);
        button.querySelector('i').className = reveal ? 'fas fa-eye-slash' : 'fas fa-eye';
    });
}());
</script>
@endpush
