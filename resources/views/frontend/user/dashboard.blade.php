@extends('frontend.layouts.main')
@section('title', __('frontend.dashboard.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.dashboard.account'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.dashboard.account')]
    ]
])

@php
    $u = Auth::user();
    $purchasedCount = isset($purchasedOrders) ? count($purchasedOrders) : 0;
    $redeemedCount = isset($redeemedOrders) ? count($redeemedOrders) : 0;
    $levelLabel = function ($level) {
        $key = 'frontend.dashboard.levels.' . strtolower((string) $level->skill_level);
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };
    $statusLabel = function ($value) {
        $key = 'frontend.dashboard.statuses.' . strtolower(trim((string) $value));
        return Lang::has($key) ? __($key) : ucwords((string) $value);
    };
    $fmtDate = fn ($date, $format) => $date->locale(app()->getLocale())->translatedFormat($format);
@endphp

<section class="dash">
    <div class="dash__grid">

        <aside class="dash__rail">

            <div class="who">
                <span class="who__avatar" aria-hidden="true">{{ mb_substr($u->name ?? 'U', 0, 1) }}</span>
                <p class="who__name">{{ $u->name }}</p>
                <p class="who__email">{{ $u->email }}</p>
                <span class="who__since">
                    <i class="far fa-calendar" aria-hidden="true"></i>
                    {{ __('frontend.dashboard.member') }} {{ $fmtDate($u->created_at, __('frontend.dashboard.member_format')) }}
                </span>
            </div>

            <nav class="dnav" role="tablist" aria-label="{{ __('frontend.dashboard.tabs') }}">
                <button type="button" role="tab" class="dnav__item is-active" data-tab="purchased" aria-selected="true" aria-controls="panel-purchased">
                    <i class="fas fa-receipt" aria-hidden="true"></i>
                    <span>{{ __('frontend.dashboard.tab_purchases') }}</span>
                    <span class="dnav__count">{{ $purchasedCount }}</span>
                </button>
                <button type="button" role="tab" class="dnav__item" data-tab="redeemed" aria-selected="false" aria-controls="panel-redeemed">
                    <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                    <span>{{ __('frontend.dashboard.tab_materials') }}</span>
                    <span class="dnav__count">{{ $redeemedCount }}</span>
                </button>
                <button type="button" role="tab" class="dnav__item" data-tab="password" aria-selected="false" aria-controls="panel-password">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <span>{{ __('frontend.dashboard.tab_password') }}</span>
                </button>
            </nav>

            <div class="dash__actions">
                <a href="{{ route('points.topup') }}" class="btn btn--primary">
                    <i class="fas fa-bolt" aria-hidden="true"></i>
                    {{ __('frontend.dashboard.buy') }}
                </a>
                <a href="{{ route('user.logout') }}" class="btn btn--ghost">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                    {{ __('frontend.dashboard.logout') }}
                </a>
            </div>
        </aside>

        <div class="dash__main">

            <div class="figs">
                <div class="fig fig--credits">
                    <span class="fig__icon"><i class="fas fa-bolt" aria-hidden="true"></i></span>
                    <span class="fig__label">{{ __('frontend.dashboard.credits') }}</span>
                    <span class="fig__value">{{ number_format($u->points_balance ?? 0) }}</span>
                    <a href="{{ route('points.topup') }}" class="fig__link">
                        {{ __('frontend.dashboard.buy') }}
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="fig">
                    <span class="fig__icon"><i class="fas fa-graduation-cap" aria-hidden="true"></i></span>
                    <span class="fig__label">{{ __('frontend.dashboard.unlocked_levels') }}</span>
                    <span class="fig__value">{{ $redeemedCount }}</span>
                    <a href="{{ route('product-lists') }}" class="fig__link">
                        {{ __('frontend.dashboard.browse_all') }}
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="fig">
                    <span class="fig__icon"><i class="fas fa-receipt" aria-hidden="true"></i></span>
                    <span class="fig__label">{{ __('frontend.dashboard.purchases') }}</span>
                    <span class="fig__value">{{ $purchasedCount }}</span>
                </div>
            </div>

            <div class="panel" id="panel-purchased" role="tabpanel" data-panel="purchased">
                <div class="panel__head">
                    <span class="panel__num"><i class="fas fa-receipt" aria-hidden="true"></i></span>
                    <h2 class="panel__title">{{ __('frontend.dashboard.purchases_title') }}</h2>
                </div>
                <div class="panel__body">
                    @if($purchasedCount > 0)
                        <ul class="orders">
                            @foreach($purchasedOrders as $order)
                                <li class="order">
                                    <span class="order__icon"><i class="fas fa-bolt" aria-hidden="true"></i></span>

                                    <span>
                                        <span class="order__no">{{ $order->order_number }}</span>
                                        <span class="order__date">{{ $fmtDate($order->created_at, __('frontend.dashboard.date_format')) }}</span>
                                    </span>

                                    <span class="order__facts">
                                        <span class="chip">
                                            <i class="fas fa-bolt" aria-hidden="true"></i>
                                            {{ number_format($order->cart_info->sum('points')) }}
                                        </span>

                                        <span class="order__price">{!! $order->currency=='JPY' ? '&yen;' : Helper::getCurrencySymbol($order->currency) !!}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</span>

                                        @if($order->payment_status === 'Completed')
                                            <span class="state state--ok"><i class="fas fa-check" aria-hidden="true"></i> {{ $statusLabel('Completed') }}</span>
                                        @elseif($order->payment_status === 'Failed')
                                            <span class="state state--err"><i class="fas fa-times" aria-hidden="true"></i> {{ $statusLabel('Failed') }}</span>
                                        @else
                                            <span class="state state--wait"><i class="fas fa-clock" aria-hidden="true"></i> {{ $statusLabel('Pending') }}</span>
                                        @endif
                                    </span>

                                    <a href="{{ route('user.order.show', $order->id) }}" class="btn btn--ghost btn--sm">
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                        {{ __('frontend.dashboard.view') }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="blank">
                            <span class="blank__icon" aria-hidden="true"><i class="fas fa-box-open"></i></span>
                            <p>{{ __('frontend.dashboard.purchases_none') }}</p>
                            <a href="{{ route('points.topup') }}" class="btn btn--primary">
                                <i class="fas fa-bolt" aria-hidden="true"></i>
                                {{ __('frontend.dashboard.buy') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="panel" id="panel-redeemed" role="tabpanel" data-panel="redeemed" hidden>
                <div class="panel__head">
                    <span class="panel__num"><i class="fas fa-graduation-cap" aria-hidden="true"></i></span>
                    <h2 class="panel__title">{{ __('frontend.dashboard.materials_title') }}</h2>
                </div>
                <div class="panel__body">
                    @if($redeemedCount > 0)
                        <ul class="courses">
                            @foreach($redeemedOrders as $order)
                                @php
                                    $cartItem = $order->cart_info->first();
                                    $level = null;
                                    if($cartItem) {
                                        $level = \App\Models\ProductLevel::where('course_id', $cartItem->product_id)
                                                                         ->where('price_in_points', $cartItem->points)
                                                                         ->first();
                                    }
                                    $product = $cartItem ? $cartItem->product : null;
                                    $cimg = $product && $product->photo ? explode(',', $product->photo)[0] : null;
                                @endphp
                                <li class="course">
                                    <div class="course__media">
                                        @if($cimg)
                                            <img src="{{ asset(ltrim($cimg, '/')) }}" alt="" loading="lazy">
                                        @else
                                            <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                                        @endif

                                        @if(strtolower($order->status) === 'completed')
                                            <span class="state state--ok course__status"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.dashboard.badge') }}</span>
                                        @else
                                            <span class="state state--wait course__status"><i class="fas fa-clock" aria-hidden="true"></i> {{ $statusLabel($order->status) }}</span>
                                        @endif
                                    </div>

                                    <div class="course__body">
                                        <div class="course__tags">
                                            @if($level)
                                                <span class="chip chip--text"><i class="fas fa-signal" aria-hidden="true"></i> {{ $levelLabel($level) }}</span>
                                            @endif
                                            <span class="chip">
                                                <i class="fas fa-bolt" aria-hidden="true"></i>
                                                {{ number_format($order->cart_info->sum('points')) }}
                                            </span>
                                        </div>

                                        <h3 class="course__title">{{ $product ? $product->title : __('frontend.dashboard.no_material') }}</h3>

                                        <div class="course__meta">
                                            <span><i class="fas fa-hashtag" aria-hidden="true"></i> {{ $order->order_number }}</span>
                                            <span><i class="far fa-calendar" aria-hidden="true"></i> {{ $fmtDate($order->created_at, __('frontend.dashboard.date_format')) }}</span>
                                        </div>

                                        @if($product)
                                            <a href="{{ route('product-detail', $product->slug) }}" class="btn btn--ghost btn--sm course__btn">
                                                {{ __('frontend.dashboard.view_material') }}
                                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="blank">
                            <span class="blank__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                            <p>{{ __('frontend.dashboard.materials_empty') }}</p>
                            <a href="{{ route('product-lists') }}" class="btn btn--primary">
                                <i class="fas fa-graduation-cap" aria-hidden="true"></i>
                                {{ __('frontend.dashboard.browse_all') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="panel" id="panel-password" role="tabpanel" data-panel="password" hidden>
                <div class="panel__head">
                    <span class="panel__num"><i class="fas fa-lock" aria-hidden="true"></i></span>
                    <h2 class="panel__title">{{ __('frontend.dashboard.password_title') }}</h2>
                </div>
                <div class="panel__body">
                    <div class="pwd">
                        <form action="{{ route('change.password') }}" method="POST" id="pwdForm" novalidate>
                            @csrf

                            <div class="pwd__fields">
                                <div class="fld fld--pass">
                                    <label class="fld__label" for="current_password">{{ __('frontend.dashboard.current') }}</label>
                                    <div class="fld__box">
                                        <i class="fas fa-lock fld__icon" aria-hidden="true"></i>
                                        <input type="password" id="current_password" name="current_password" autocomplete="current-password" class="fld__input @error('current_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.current_ph') }}">
                                        <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false">
                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    @error('current_password')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="pwd__pair">
                                    <div class="fld fld--pass">
                                        <label class="fld__label" for="new_password">{{ __('frontend.dashboard.new') }}</label>
                                        <div class="fld__box">
                                            <i class="fas fa-key fld__icon" aria-hidden="true"></i>
                                            <input type="password" id="new_password" name="new_password" autocomplete="new-password" class="fld__input @error('new_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.new_ph') }}">
                                            <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        @error('new_password')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                    </div>

                                    <div class="fld fld--pass">
                                        <label class="fld__label" for="new_confirm_password">{{ __('frontend.dashboard.confirm') }}</label>
                                        <div class="fld__box">
                                            <i class="fas fa-key fld__icon" aria-hidden="true"></i>
                                            <input type="password" id="new_confirm_password" name="new_confirm_password" autocomplete="new-password" class="fld__input @error('new_confirm_password') is-invalid @enderror" placeholder="{{ __('frontend.dashboard.confirm_ph') }}">
                                            <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false">
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        @error('new_confirm_password')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn--primary">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    {{ __('frontend.dashboard.save') }}
                                </button>
                            </div>
                        </form>

                        <aside class="tips">
                            <span class="tips__icon" aria-hidden="true"><i class="fas fa-shield-alt"></i></span>
                            <h3 class="tips__title">{{ __('frontend.dashboard.tip_title') }}</h3>
                            <ul class="tips__list">
                                <li><i class="fas fa-check" aria-hidden="true"></i> <span>{{ __('frontend.dashboard.tip1') }}</span></li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> <span>{{ __('frontend.dashboard.tip2') }}</span></li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> <span>{{ __('frontend.dashboard.tip3') }}</span></li>
                            </ul>
                        </aside>
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

    var tabs = document.querySelectorAll('.dnav__item[data-tab]');
    var panels = document.querySelectorAll('.panel[data-panel]');

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
            current: @json(__('frontend.dashboard.current_req')),
            fresh: @json(__('frontend.dashboard.new_req')),
            short: @json(__('frontend.dashboard.new_min', ['min' => 8])),
            match: @json(__('frontend.dashboard.match'))
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
