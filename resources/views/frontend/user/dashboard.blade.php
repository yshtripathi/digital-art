@extends('frontend.layouts.main')
@section('title', __('frontend.dashboard.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.dashboard.account'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.dashboard.account')]
    ]
])

@php
    $u = Auth::user();
    $purchasedCount = isset($purchasedOrders) ? count($purchasedOrders) : 0;
    $unlockedItems = collect($redeemedOrders ?? [])->flatMap(fn ($order) => $order->cart_info->map(fn ($item) => ['order' => $order, 'item' => $item]));
    $redeemedCount = $unlockedItems->count();
    $levelLabel = function ($level) {
        $key = 'frontend.dashboard.level_' . str_replace(' ', '_', strtolower(trim((string) $level->skill_level)));
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };
    $statusLabel = function ($value) {
        $key = 'frontend.dashboard.state_' . str_replace(' ', '_', strtolower(trim((string) $value)));
        return Lang::has($key) ? __($key) : ucwords((string) $value);
    };
    $fmtDate = fn ($date, $format) => $date->locale(app()->getLocale())->translatedFormat($format);
    $initial = mb_strtoupper(mb_substr($u->name ?? 'U', 0, 1));
@endphp

<section class="pay">
    <div class="container">
        <div class="dash">
            <aside class="dash-side">
                <div class="dash-me">
                    <span class="dash-me__avatar" aria-hidden="true">{{ $initial }}</span>
                    <p class="dash-me__greet">{{ __('frontend.dashboard.welcome') }}</p>
                    <h2 class="dash-me__name">{{ $u->name }}</h2>
                    <p class="dash-me__line"><i class="far fa-envelope" aria-hidden="true"></i><span>{{ $u->email }}</span></p>
                    <p class="dash-me__line"><i class="far fa-calendar" aria-hidden="true"></i><span>{{ __('frontend.dashboard.member_since') }} {{ $fmtDate($u->created_at, __('frontend.dashboard.month_format')) }}</span></p>

                    <div class="dash-bal">
                        <span class="dash-bal__label">{{ __('frontend.dashboard.balance') }}</span>
                        <strong class="dash-bal__value">{{ number_format($u->points_balance ?? 0) }}</strong>
                        <a href="{{ route('points.topup') }}" class="btn btn--primary btn--block">{{ __('frontend.dashboard.buy_credits') }}</a>
                    </div>
                </div>

                <nav class="dash-nav" role="tablist" aria-label="{{ __('frontend.dashboard.sections') }}">
                    <button type="button" role="tab" class="dash-nav__btn is-on" id="tab-orders" data-tab="orders" aria-selected="true" aria-controls="panel-orders">
                        <i class="fas fa-receipt" aria-hidden="true"></i>
                        <span>{{ __('frontend.dashboard.tab_purchases') }}</span>
                        <span class="dash-nav__count">{{ $purchasedCount }}</span>
                    </button>
                    <button type="button" role="tab" class="dash-nav__btn" id="tab-library" data-tab="library" aria-selected="false" aria-controls="panel-library" tabindex="-1">
                        <i class="fas fa-book-open" aria-hidden="true"></i>
                        <span>{{ __('frontend.dashboard.tab_library') }}</span>
                        <span class="dash-nav__count">{{ $redeemedCount }}</span>
                    </button>
                    <button type="button" role="tab" class="dash-nav__btn" id="tab-security" data-tab="security" aria-selected="false" aria-controls="panel-security" tabindex="-1">
                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.dashboard.tab_password') }}</span>
                    </button>
                    <a href="{{ route('user.logout') }}" class="dash-nav__out">
                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.dashboard.logout') }}</span>
                    </a>
                </nav>
            </aside>

            <div class="dash-main">
                <div class="pay-card dash-panel" id="panel-orders" role="tabpanel" aria-labelledby="tab-orders" data-panel="orders" style="--i: 0">
                    <div class="dash-panel__head">
                        <h3 class="dash-panel__title">{{ __('frontend.dashboard.purchases_title') }}</h3>
                        @if($purchasedCount > 0)
                            <label class="dash-find">
                                <i class="fas fa-search" aria-hidden="true"></i>
                                <span class="vh">{{ __('frontend.dashboard.search_orders') }}</span>
                                <input type="search" class="dash-find__input" placeholder="{{ __('frontend.dashboard.search_orders') }}" data-find="orders" autocomplete="off">
                            </label>
                        @endif
                    </div>

                    @if($purchasedCount > 0)
                        <div class="dt">
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('frontend.dashboard.col_order') }}</th>
                                        <th scope="col">{{ __('frontend.dashboard.col_date') }}</th>
                                        <th scope="col" class="is-num">{{ __('frontend.dashboard.col_credits') }}</th>
                                        <th scope="col" class="is-num">{{ __('frontend.dashboard.col_amount') }}</th>
                                        <th scope="col">{{ __('frontend.dashboard.col_status') }}</th>
                                        <th scope="col" class="is-end"><span class="vh">{{ __('frontend.dashboard.col_action') }}</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchasedOrders as $order)
                                        @php
                                            $payState = strtolower(trim((string) $order->payment_status));
                                            $tone = in_array($payState, ['completed', 'paid', 'success']) ? 'ok' : (in_array($payState, ['failed', 'payment failed']) ? 'err' : 'wait');
                                        @endphp
                                        <tr data-row="orders" data-key="{{ \Illuminate\Support\Str::lower($order->order_number) }}">
                                            <td><span class="dt__code">{{ $order->order_number }}</span></td>
                                            <td>{{ $fmtDate($order->created_at, __('frontend.dashboard.date_format')) }}</td>
                                            <td class="is-num">{{ $tone === 'ok' ? '+' : '' }}{{ number_format($order->cart_info->sum('points')) }}</td>
                                            <td class="is-num"><strong>{{ Helper::getCurrencySymbol($order->currency) }}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</strong></td>
                                            <td>
                                                <span class="st st--{{ $tone }}">
                                                    @if($tone === 'ok')
                                                        {{ $statusLabel('Completed') }}
                                                    @elseif($tone === 'err')
                                                        {{ $statusLabel($payState) }}
                                                    @else
                                                        {{ $statusLabel('Pending') }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="is-end">
                                                <a href="{{ route('user.order.show', $order->id) }}" class="dt__open">{{ __('frontend.dashboard.view_receipt') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p class="dash-none" hidden data-none="orders">{{ __('frontend.dashboard.no_results') }}</p>
                    @else
                        <div class="dash-empty">
                            <span class="dash-empty__icon" aria-hidden="true"><i class="fas fa-receipt"></i></span>
                            <p>{{ __('frontend.dashboard.purchases_empty') }}</p>
                            <a href="{{ route('points.topup') }}" class="btn btn--primary">{{ __('frontend.dashboard.buy_credits') }}</a>
                        </div>
                    @endif
                </div>

                <div class="pay-card dash-panel" id="panel-library" role="tabpanel" aria-labelledby="tab-library" data-panel="library" hidden style="--i: 0">
                    <div class="dash-panel__head">
                        <h3 class="dash-panel__title">{{ __('frontend.dashboard.library_title') }}</h3>
                        @if($redeemedCount > 0)
                            <label class="dash-find">
                                <i class="fas fa-search" aria-hidden="true"></i>
                                <span class="vh">{{ __('frontend.dashboard.search_library') }}</span>
                                <input type="search" class="dash-find__input" placeholder="{{ __('frontend.dashboard.search_library') }}" data-find="library" autocomplete="off">
                            </label>
                        @endif
                    </div>

                    @if($redeemedCount > 0)
                        <div class="dt">
                            <table>
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('frontend.dashboard.col_guide') }}</th>
                                        <th scope="col">{{ __('frontend.dashboard.col_level') }}</th>
                                        <th scope="col" class="is-num">{{ __('frontend.dashboard.col_credits') }}</th>
                                        <th scope="col">{{ __('frontend.dashboard.col_date') }}</th>
                                        <th scope="col">{{ __('frontend.dashboard.col_status') }}</th>
                                        <th scope="col" class="is-end"><span class="vh">{{ __('frontend.dashboard.col_action') }}</span></th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            $rawImg = $product && $product->photo ? trim(explode(',', $product->photo)[0]) : '';
                                            $cimg = $rawImg !== '' && file_exists(public_path(ltrim($rawImg, '/'))) ? asset(ltrim($rawImg, '/')) : null;
                                            $isDone = strtolower($order->status) === 'completed';
                                            $title = $product ? $product->title : __('frontend.dashboard.unavailable');
                                        @endphp
                                        <tr data-row="library" data-key="{{ \Illuminate\Support\Str::lower($title . ' ' . $order->order_number) }}">
                                            <td>
                                                <span class="dt__item">
                                                    <span class="dt__thumb">
                                                        @if($cimg)
                                                            <img src="{{ $cimg }}" alt="" loading="lazy">
                                                        @else
                                                            <i class="fas fa-book-open" aria-hidden="true"></i>
                                                        @endif
                                                    </span>
                                                    <span>
                                                        <span class="dt__title">{{ $title }}</span>
                                                        <span class="dt__sub">{{ $order->order_number }}</span>
                                                    </span>
                                                </span>
                                            </td>
                                            <td>
                                                @if($level)
                                                    <span class="tag tag--active">{{ $levelLabel($level) }}</span>
                                                @else
                                                    <span class="dt__dash">—</span>
                                                @endif
                                            </td>
                                            <td class="is-num">{{ number_format($cartItem->points) }}</td>
                                            <td>{{ $fmtDate($order->created_at, __('frontend.dashboard.date_format')) }}</td>
                                            <td>
                                                <span class="st {{ $isDone ? 'st--ok' : 'st--wait' }}">{{ $isDone ? __('frontend.dashboard.unlocked') : $statusLabel($order->status) }}</span>
                                            </td>
                                            <td class="is-end">
                                                @if($product)
                                                    <a href="{{ route('product-detail', $product->slug) }}" class="dt__open">{{ __('frontend.dashboard.open_guide') }}</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p class="dash-none" hidden data-none="library">{{ __('frontend.dashboard.no_results') }}</p>
                    @else
                        <div class="dash-empty">
                            <span class="dash-empty__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                            <p>{{ __('frontend.dashboard.library_empty') }}</p>
                            <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.dashboard.browse') }}</a>
                        </div>
                    @endif
                </div>

                <div class="pay-card dash-panel" id="panel-security" role="tabpanel" aria-labelledby="tab-security" data-panel="security" hidden style="--i: 0">
                    <div class="dash-panel__head">
                        <h3 class="dash-panel__title">{{ __('frontend.dashboard.password_title') }}</h3>
                    </div>

                    <div class="dash-pwd">
                        <form action="{{ route('change.password') }}" method="POST" id="pwdForm" class="dash-pwd__form" novalidate>
                            @csrf

                            <div class="pay-field">
                                <label for="current_password">{{ __('frontend.dashboard.current') }}</label>
                                <div class="auth-pass">
                                    <input type="password" id="current_password" name="current_password" autocomplete="current-password" class="@error('current_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.current_placeholder') }}">
                                    <button type="button" class="auth-pass__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false"><i class="far fa-eye" aria-hidden="true"></i></button>
                                </div>
                                @error('current_password')<span class="auth-err">{{ $message }}</span>@enderror
                            </div>

                            <div class="pay-field">
                                <label for="new_password">{{ __('frontend.dashboard.new') }}</label>
                                <div class="auth-pass">
                                    <input type="password" id="new_password" name="new_password" autocomplete="new-password" class="@error('new_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.new_placeholder') }}">
                                    <button type="button" class="auth-pass__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false"><i class="far fa-eye" aria-hidden="true"></i></button>
                                </div>
                                <div class="dash-meter" aria-hidden="true" data-meter data-level="0">
                                    <span class="dash-meter__bars"><span></span><span></span><span></span></span>
                                    <span class="dash-meter__text">{{ __('frontend.dashboard.meter') }}: <strong data-meter-label>—</strong></span>
                                </div>
                                @error('new_password')<span class="auth-err">{{ $message }}</span>@enderror
                            </div>

                            <div class="pay-field">
                                <label for="new_confirm_password">{{ __('frontend.dashboard.confirm') }}</label>
                                <div class="auth-pass">
                                    <input type="password" id="new_confirm_password" name="new_confirm_password" autocomplete="new-password" class="@error('new_confirm_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.confirm_placeholder') }}">
                                    <button type="button" class="auth-pass__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false"><i class="far fa-eye" aria-hidden="true"></i></button>
                                </div>
                                @error('new_confirm_password')<span class="auth-err">{{ $message }}</span>@enderror
                            </div>

                            <button type="submit" class="btn btn--primary btn--block">{{ __('frontend.dashboard.save') }}</button>
                        </form>

                        <div class="dash-rules">
                            <p class="dash-rules__title">{{ __('frontend.dashboard.checklist') }}</p>
                            <ul class="dash-rules__list">
                                <li data-rule="len"><span aria-hidden="true"><i class="fas fa-check"></i></span>{{ __('frontend.dashboard.rule_length') }}</li>
                                <li data-rule="new"><span aria-hidden="true"><i class="fas fa-check"></i></span>{{ __('frontend.dashboard.rule_different') }}</li>
                                <li data-rule="match"><span aria-hidden="true"><i class="fas fa-check"></i></span>{{ __('frontend.dashboard.rule_same') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var tabs = Array.prototype.slice.call(document.querySelectorAll('.dash-nav__btn[data-tab]'));
    var panels = document.querySelectorAll('[data-panel]');

    function open(name, focus) {
        tabs.forEach(function (tab) {
            var on = tab.getAttribute('data-tab') === name;
            tab.classList.toggle('is-on', on);
            tab.setAttribute('aria-selected', on ? 'true' : 'false');
            tab.tabIndex = on ? 0 : -1;
            if (on && focus) { tab.focus(); }
        });
        panels.forEach(function (panel) {
            panel.hidden = panel.getAttribute('data-panel') !== name;
        });
        if (history.replaceState) { history.replaceState(null, '', '#' + name); }
    }

    tabs.forEach(function (tab, i) {
        tab.addEventListener('click', function () { open(tab.getAttribute('data-tab'), false); });
        tab.addEventListener('keydown', function (event) {
            var next = null;
            if (event.key === 'ArrowRight') { next = tabs[(i + 1) % tabs.length]; }
            if (event.key === 'ArrowLeft') { next = tabs[(i - 1 + tabs.length) % tabs.length]; }
            if (next) { event.preventDefault(); open(next.getAttribute('data-tab'), true); }
        });
    });

    var start = (window.location.hash || '').replace('#', '');
    @if($errors->any())
        start = 'security';
    @endif
    if (['orders', 'library', 'security'].indexOf(start) !== -1) { open(start, false); }

    document.querySelectorAll('[data-find]').forEach(function (input) {
        var group = input.dataset.find;
        var rows = document.querySelectorAll('[data-row="' + group + '"]');
        var none = document.querySelector('[data-none="' + group + '"]');
        input.addEventListener('input', function () {
            var term = input.value.trim().toLowerCase();
            var shown = 0;
            rows.forEach(function (row) {
                var match = !term || row.dataset.key.indexOf(term) !== -1;
                row.hidden = !match;
                if (match) { shown++; }
            });
            if (none) { none.hidden = shown !== 0; }
        });
    });

    var pwdForm = document.getElementById('pwdForm');

    if (pwdForm) {
        var current = document.getElementById('current_password');
        var fresh = document.getElementById('new_password');
        var again = document.getElementById('new_confirm_password');
        var meter = document.querySelector('[data-meter]');
        var meterLabel = document.querySelector('[data-meter-label]');
        var words = [@json(__('frontend.dashboard.weak')), @json(__('frontend.dashboard.fair')), @json(__('frontend.dashboard.strong'))];
        var rules = {
            len: document.querySelector('[data-rule="len"]'),
            fresh: document.querySelector('[data-rule="new"]'),
            match: document.querySelector('[data-rule="match"]')
        };
        var pwdText = {
            current: @json(__('frontend.dashboard.current_required')),
            fresh: @json(__('frontend.dashboard.new_required')),
            short: @json(__('frontend.dashboard.new_min', ['min' => 8])),
            match: @json(__('frontend.dashboard.mismatch'))
        };

        var check = function () {
            var value = fresh.value;
            var score = 0;
            if (value.length >= 8) { score++; }
            if (/[A-Za-z]/.test(value) && /\d/.test(value)) { score++; }
            if (value.length >= 12 || /[^A-Za-z0-9]/.test(value)) { score++; }
            if (meter) {
                meter.dataset.level = value ? String(Math.max(score, 1)) : '0';
                meterLabel.textContent = value ? words[Math.max(score, 1) - 1] : '—';
            }
            rules.len.classList.toggle('is-met', value.length >= 8);
            rules.fresh.classList.toggle('is-met', !!value && value !== current.value);
            rules.match.classList.toggle('is-met', !!value && value === again.value);
        };

        [current, fresh, again].forEach(function (field) { field.addEventListener('input', check); });

        var clearNote = function (field) {
            field.classList.remove('is-invalid');
            field.closest('.pay-field').querySelectorAll('[data-live-error]').forEach(function (note) { note.remove(); });
        };

        var addNote = function (field, text) {
            field.classList.add('is-invalid');
            var note = document.createElement('span');
            note.className = 'auth-err';
            note.setAttribute('data-live-error', '');
            note.appendChild(document.createTextNode(text));
            field.closest('.pay-field').appendChild(note);
        };

        pwdForm.addEventListener('submit', function (event) {
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
        button.querySelector('i').className = reveal ? 'far fa-eye-slash' : 'far fa-eye';
    });
}());
</script>
@endpush
