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

<section class="dash">
    <aside class="dash__side">
        <div class="dash-me">
            <span class="dash-me__avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr($u->name ?? 'U', 0, 1)) }}</span>
            <span class="dash-me__greet">{{ __('frontend.dashboard.greet') }}</span>
            <h2 class="dash-me__name">{{ $u->name }}</h2>
            <p class="dash-me__line"><i class="far fa-envelope" aria-hidden="true"></i> <span>{{ $u->email }}</span></p>
            <p class="dash-me__line"><i class="far fa-calendar" aria-hidden="true"></i> <span>{{ __('frontend.dashboard.since') }} {{ $fmtDate($u->created_at, __('frontend.dashboard.fmt_month')) }}</span></p>
        </div>

        <nav class="dash-nav" role="tablist" aria-label="{{ __('frontend.dashboard.tabs_label') }}">
            <button type="button" role="tab" class="dash-tab is-active" data-tab="purchased" aria-selected="true" aria-controls="panel-purchased">
                <span class="dash-tab__icon" aria-hidden="true"><i class="fas fa-receipt"></i></span>
                <span class="dash-tab__text">{{ __('frontend.dashboard.tab_orders') }}</span>
                <span class="dash-tab__count num">{{ $purchasedCount }}</span>
            </button>
            <button type="button" role="tab" class="dash-tab" data-tab="redeemed" aria-selected="false" aria-controls="panel-redeemed">
                <span class="dash-tab__icon" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                <span class="dash-tab__text">{{ __('frontend.dashboard.tab_library') }}</span>
                <span class="dash-tab__count num">{{ $redeemedCount }}</span>
            </button>
            <button type="button" role="tab" class="dash-tab" data-tab="password" aria-selected="false" aria-controls="panel-password">
                <span class="dash-tab__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                <span class="dash-tab__text">{{ __('frontend.dashboard.tab_security') }}</span>
            </button>
        </nav>

        <a href="{{ route('user.logout') }}" class="dash-out">
            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
            {{ __('frontend.dashboard.sign_out') }}
        </a>
    </aside>

    <div class="dash__main">
        <div class="dash-wallet">
            <span class="dash-wallet__coins" aria-hidden="true">
                <span><i class="fas fa-wallet"></i></span>
                <span><i class="fas fa-pen-nib"></i></span>
                <span><i class="fas fa-microphone"></i></span>
            </span>
            <span class="dash-wallet__label">{{ __('frontend.dashboard.wallet_label') }}</span>
            <p class="dash-wallet__value">
                <span class="num">{{ number_format($u->points_balance ?? 0) }}</span>
            </p>
            <div class="dash-wallet__acts">
                <a href="{{ route('points.topup') }}" class="btn">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                    {{ __('frontend.dashboard.go_buy') }}
                </a>
                <a href="{{ route('product-lists') }}" class="btn btn--ghost">
                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                    {{ __('frontend.dashboard.go_browse') }}
                </a>
            </div>
            <dl class="dash-wallet__stats">
                <div>
                    <dt><i class="fas fa-lock-open" aria-hidden="true"></i> {{ __('frontend.dashboard.stat_levels') }}</dt>
                    <dd class="num">{{ $redeemedCount }}</dd>
                </div>
                <div>
                    <dt><i class="fas fa-receipt" aria-hidden="true"></i> {{ __('frontend.dashboard.stat_orders') }}</dt>
                    <dd class="num">{{ $purchasedCount }}</dd>
                </div>
            </dl>
        </div>

        <div class="dash-panel" id="panel-purchased" role="tabpanel" data-panel="purchased">
            <h2 class="dash-panel__title">{{ __('frontend.dashboard.buys') }}</h2>

            @if($purchasedCount > 0)
                <ul class="dash-feed">
                    @foreach($purchasedOrders as $order)
                        @php
                            $payState = strtolower(trim((string) $order->payment_status));
                            $tone = in_array($payState, ['completed', 'paid', 'success']) ? 'ok' : (in_array($payState, ['failed', 'payment failed']) ? 'err' : 'wait');
                        @endphp
                        <li class="dash-tx dash-tx--{{ $tone }}" style="--i: {{ $loop->index }}">
                            <span class="dash-tx__icon" aria-hidden="true"><i class="fas {{ $tone === 'ok' ? 'fa-arrow-down' : ($tone === 'err' ? 'fa-times' : 'fa-clock') }}"></i></span>
                            <div class="dash-tx__main">
                                <span class="dash-tx__no num">{{ $order->order_number }}</span>
                                <span class="dash-tx__date">
                                    <span class="vh">{{ __('frontend.dashboard.th_date') }}:</span>
                                    {{ $fmtDate($order->created_at, __('frontend.dashboard.fmt_date')) }}
                                </span>
                            </div>
                            <span class="dash-tx__credits">
                                <span class="vh">{{ __('frontend.dashboard.th_credits') }}:</span>
                                <i class="fas fa-wallet" aria-hidden="true"></i>
                                <span class="num">{{ $tone === 'ok' ? '+' : '' }}{{ number_format($order->cart_info->sum('points')) }}</span>
                            </span>
                            <div class="dash-tx__end">
                                <strong class="dash-tx__amount num">
                                    <span class="vh">{{ __('frontend.dashboard.th_amount') }}:</span>
                                    {{ Helper::getCurrencySymbol($order->currency) }}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}
                                </strong>
                                <span class="dash-tx__state">
                                    <span class="vh">{{ __('frontend.dashboard.th_status') }}:</span>
                                    @if($tone === 'ok')
                                        {{ $statusLabel('Completed') }}
                                    @elseif($tone === 'err')
                                        {{ $statusLabel($payState) }}
                                    @else
                                        {{ $statusLabel('Pending') }}
                                    @endif
                                </span>
                            </div>
                            <a href="{{ route('user.order.show', $order->id) }}" class="dash-tx__go" aria-label="{{ __('frontend.dashboard.go_receipt') }}: {{ $order->order_number }}">
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="dash-blank">
                    <span class="dash-blank__icon" aria-hidden="true"><i class="fas fa-receipt"></i></span>
                    <p>{{ __('frontend.dashboard.buys_none') }}</p>
                    <a href="{{ route('points.topup') }}" class="btn">
                        <i class="fas fa-plus" aria-hidden="true"></i>
                        {{ __('frontend.dashboard.go_buy') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="dash-panel" id="panel-redeemed" role="tabpanel" data-panel="redeemed" hidden>
            <h2 class="dash-panel__title">{{ __('frontend.dashboard.lib') }}</h2>

            @if($redeemedCount > 0)
                <ul class="dash-lib">
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
                            $isDone = strtolower($order->status) === 'completed';
                        @endphp
                        <li class="dash-mat" style="--i: {{ $loop->index }}">
                            <div class="dash-mat__media">
                                @if($cimg)
                                    <img src="{{ asset(ltrim($cimg, '/')) }}" alt="" loading="lazy">
                                @else
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @endif
                                <span class="dash-mat__state {{ $isDone ? 'is-ok' : 'is-wait' }}">
                                    <i class="fas {{ $isDone ? 'fa-lock-open' : 'fa-clock' }}" aria-hidden="true"></i>
                                    {{ $isDone ? __('frontend.dashboard.unlocked') : $statusLabel($order->status) }}
                                </span>
                            </div>

                            <div class="dash-mat__body">
                                <div class="dash-mat__tags">
                                    @if($level)
                                        <span class="badge">{{ $levelLabel($level) }}</span>
                                    @endif
                                    <span class="dash-mat__cost"><i class="fas fa-wallet" aria-hidden="true"></i> <span class="num">{{ number_format($cartItem->points) }}</span></span>
                                </div>

                                <h3 class="dash-mat__title">{{ $product ? $product->title : __('frontend.dashboard.gone') }}</h3>

                                <p class="dash-mat__meta">
                                    <span class="num">{{ $order->order_number }}</span>
                                    <span>{{ $fmtDate($order->created_at, __('frontend.dashboard.fmt_date')) }}</span>
                                </p>

                                @if($product)
                                    <a href="{{ route('product-detail', $product->slug) }}" class="dash-mat__go">
                                        {{ __('frontend.dashboard.go_material') }}
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="dash-blank">
                    <span class="dash-blank__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                    <p>{{ __('frontend.dashboard.lib_none') }}</p>
                    <a href="{{ route('product-lists') }}" class="btn">
                        <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                        {{ __('frontend.dashboard.go_browse') }}
                    </a>
                </div>
            @endif
        </div>

        <div class="dash-panel" id="panel-password" role="tabpanel" data-panel="password" hidden>
            <h2 class="dash-panel__title">{{ __('frontend.dashboard.pw_head') }}</h2>

            <div class="dash-pwd">
                <form action="{{ route('change.password') }}" method="POST" id="pwdForm" class="auth__form" novalidate>
                    @csrf

                    <div class="fld">
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

                    <div class="fld">
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

                    <div class="fld">
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

                    <button type="submit" class="btn btn--block auth__submit">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        {{ __('frontend.dashboard.pw_save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var tabs = document.querySelectorAll('.dash-tab[data-tab]');
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
