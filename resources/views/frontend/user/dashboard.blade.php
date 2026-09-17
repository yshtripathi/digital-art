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

{{-- ==========================================================================
     Account dashboard
     Profile bar, stat cards and pill tabs.
     Styles: public/css/theme.css — section 25
     JS hooks kept: .ds-tab[data-tab], .ds-panel[data-panel], .active,
     [data-au-toggle]
     ========================================================================== --}}
<section class="ds">
    <div class="ds__wrap">

        {{-- Profile --}}
        <div class="ds-hello">
            <span class="ds-hello__avatar">{{ strtoupper(mb_substr($u->name ?? 'U', 0, 1)) }}</span>
            <div class="ds-hello__text">
                <span class="ds-hello__eyebrow">{{ __('frontend.dashboard.welcome') }}</span>
                <h2 class="ds-hello__name">{{ $u->name }}</h2>
                <span class="ds-hello__email"><i class="fas fa-envelope"></i> {{ $u->email }}</span>
            </div>
            <a href="{{ route('user.logout') }}" class="ds-hello__logout"><i class="fas fa-sign-out-alt"></i> {{ __('frontend.dashboard.logout') }}</a>
        </div>

        {{-- Figures --}}
        <div class="ds-stats">
            <div class="ds-stat ds-stat--credits">
                <span class="ds-stat__icon"><i class="fas fa-bolt"></i></span>
                <span class="ds-stat__label">{{ __('frontend.dashboard.credits') }}</span>
                <strong class="ds-stat__value">{{ number_format($u->points_balance ?? 0) }}</strong>
                <a href="{{ route('points.topup') }}" class="ds-stat__link">{{ __('frontend.dashboard.buy') }} <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="ds-stat ds-stat--courses">
                <span class="ds-stat__icon"><i class="fas fa-graduation-cap"></i></span>
                <span class="ds-stat__label">{{ __('frontend.dashboard.unlocked') }}</span>
                <strong class="ds-stat__value">{{ $redeemedCount }}</strong>
                <a href="{{ route('product-lists') }}" class="ds-stat__link">{{ __('frontend.dashboard.browse') }} <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="ds-stat ds-stat--orders">
                <span class="ds-stat__icon"><i class="fas fa-receipt"></i></span>
                <span class="ds-stat__label">{{ __('frontend.dashboard.purchases') }}</span>
                <strong class="ds-stat__value">{{ $purchasedCount }}</strong>
            </div>
            <div class="ds-stat ds-stat--member">
                <span class="ds-stat__icon"><i class="fas fa-calendar-alt"></i></span>
                <span class="ds-stat__label">{{ __('frontend.dashboard.member') }}</span>
                <strong class="ds-stat__value ds-stat__value--sm">{{ $fmtDate($u->created_at, __('frontend.dashboard.member_format')) }}</strong>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="ds-tabs" role="tablist" aria-label="{{ __('frontend.dashboard.tabs') }}">
            <button type="button" role="tab" class="ds-tab active" data-tab="purchased" aria-selected="true">
                <i class="fas fa-gift"></i> {{ __('frontend.dashboard.tab_purchases') }} <span class="ds-tab__count">{{ $purchasedCount }}</span>
            </button>
            <button type="button" role="tab" class="ds-tab" data-tab="redeemed" aria-selected="false">
                <i class="fas fa-book-reader"></i> {{ __('frontend.dashboard.tab_courses') }} <span class="ds-tab__count">{{ $redeemedCount }}</span>
            </button>
            <button type="button" role="tab" class="ds-tab" data-tab="password" aria-selected="false">
                <i class="fas fa-lock"></i> {{ __('frontend.dashboard.tab_password') }}
            </button>
        </div>

        {{-- ================= PURCHASES ================= --}}
        <div class="ds-panel active" data-panel="purchased" role="tabpanel">
            <div class="ds-card">
                <h2 class="ds-card__title">{{ __('frontend.dashboard.purchases_title') }}</h2>

                @if($purchasedCount > 0)
                    <ul class="ds-list">
                        @foreach($purchasedOrders as $order)
                            <li class="ds-row">
                                <span class="ds-row__cell ds-row__order" data-label="{{ __('frontend.dashboard.order') }}">
                                    <span class="ds-row__icon"><i class="fas fa-bolt"></i></span>
                                    {{ $order->order_number }}
                                </span>
                                <span class="ds-row__cell" data-label="{{ __('frontend.dashboard.amount_credits') }}">
                                    <span class="ds-pill"><i class="fas fa-bolt"></i> {{ number_format($order->cart_info->sum('points')) }}</span>
                                </span>
                                <span class="ds-row__cell ds-row__strong" data-label="{{ __('frontend.dashboard.price') }}">
                                    {!! $order->currency=='JPY' ? '&yen;' : Helper::getCurrencySymbol($order->currency) !!}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}
                                </span>
                                <span class="ds-row__cell" data-label="{{ __('frontend.dashboard.status') }}">
                                    @if($order->payment_status === 'Completed')
                                        <span class="ds-status ds-status--ok">{{ $statusLabel('Completed') }}</span>
                                    @elseif($order->payment_status === 'Failed')
                                        <span class="ds-status ds-status--err">{{ $statusLabel('Failed') }}</span>
                                    @else
                                        <span class="ds-status ds-status--wait">{{ $statusLabel('Pending') }}</span>
                                    @endif
                                </span>
                                <span class="ds-row__cell ds-row__muted" data-label="{{ __('frontend.dashboard.date') }}">{{ $fmtDate($order->created_at, __('frontend.dashboard.date_format')) }}</span>
                                <span class="ds-row__cell ds-row__action">
                                    <a href="{{ route('user.order.show', $order->id) }}" class="ds-btn ds-btn--inverse ds-btn--sm">
                                        <i class="fas fa-eye"></i> {{ __('frontend.dashboard.view') }}
                                    </a>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="ds-empty">
                        <span class="ds-empty__icon"><i class="fas fa-box-open"></i></span>
                        <p>{{ __('frontend.dashboard.purchases_empty') }}</p>
                        <a href="{{ route('points.topup') }}" class="ds-btn ds-btn--primary"><i class="fas fa-bolt"></i> {{ __('frontend.dashboard.buy') }}</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- ================= ENROLLED COURSES ================= --}}
        <div class="ds-panel" data-panel="redeemed" role="tabpanel" hidden>
            <div class="ds-card">
                <h2 class="ds-card__title">{{ __('frontend.dashboard.courses_title') }}</h2>

                @if($redeemedCount > 0)
                    <ul class="ds-courses">
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
                            <li class="ds-course">
                                <div class="ds-course__media">
                                    @if($cimg)
                                        <img src="{{ asset(ltrim($cimg, '/')) }}" alt="" loading="lazy">
                                    @else
                                        <span class="ds-course__ph"><i class="fas fa-graduation-cap"></i></span>
                                    @endif
                                    @if(strtolower($order->status) === 'completed')
                                        <span class="ds-status ds-status--ok ds-course__status">{{ __('frontend.dashboard.badge') }}</span>
                                    @else
                                        <span class="ds-status ds-status--wait ds-course__status">{{ $statusLabel($order->status) }}</span>
                                    @endif
                                </div>
                                <div class="ds-course__body">
                                    <div class="ds-course__tags">
                                        @if($level)
                                            <span class="badge badge--brand"><i class="fas fa-signal"></i> {{ $levelLabel($level) }}</span>
                                        @else
                                            <span class="badge">{{ __('frontend.dashboard.no_level') }}</span>
                                        @endif
                                        <span class="ds-pill"><i class="fas fa-bolt"></i> {{ number_format($order->cart_info->sum('points')) }}</span>
                                    </div>
                                    <h3 class="ds-course__title">{{ $product ? $product->title : __('frontend.dashboard.no_course') }}</h3>
                                    <div class="ds-course__meta">
                                        <span><i class="fas fa-hashtag"></i> {{ $order->order_number }}</span>
                                        <span><i class="far fa-calendar"></i> {{ $fmtDate($order->created_at, __('frontend.dashboard.date_format')) }}</span>
                                    </div>
                                    @if($product)
                                        <a href="{{ route('product-detail', $product->slug) }}" class="ds-btn ds-btn--secondary ds-btn--sm ds-course__btn">
                                            {{ __('frontend.dashboard.view_course') }} <i class="fas fa-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="ds-empty">
                        <span class="ds-empty__icon"><i class="fas fa-book-open"></i></span>
                        <p>{{ __('frontend.dashboard.courses_empty') }}</p>
                        <a href="{{ route('product-lists') }}" class="ds-btn ds-btn--inverse"><i class="fas fa-graduation-cap"></i> {{ __('frontend.dashboard.browse') }}</a>
                    </div>
                @endif
            </div>
        </div>

        {{-- ================= CHANGE PASSWORD ================= --}}
        <div class="ds-panel" data-panel="password" role="tabpanel" hidden>
            <div class="ds-pwd">
                <div class="ds-card">
                    <h2 class="ds-card__title">{{ __('frontend.dashboard.password_title') }}</h2>
                    <form action="{{ route('change.password') }}" method="POST" class="au-form">
                        @csrf
                        <div class="au-field">
                            <label class="au-label" for="current_password">{{ __('frontend.dashboard.current') }}</label>
                            <div class="au-input au-input--pass">
                                <i class="fas fa-lock au-input__icon" aria-hidden="true"></i>
                                <input type="password" id="current_password" name="current_password" autocomplete="current-password" placeholder="{{ __('frontend.dashboard.current_ph') }}" class="@error('current_password') is-invalid @enderror">
                                <button type="button" class="au-eye" data-au-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false"><i class="fas fa-eye"></i></button>
                            </div>
                            @error('current_password')<span class="au-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                        </div>
                        <div class="au-row">
                            <div class="au-field">
                                <label class="au-label" for="new_password">{{ __('frontend.dashboard.new') }}</label>
                                <div class="au-input au-input--pass">
                                    <i class="fas fa-key au-input__icon" aria-hidden="true"></i>
                                    <input type="password" id="new_password" name="new_password" autocomplete="new-password" placeholder="{{ __('frontend.dashboard.new_ph') }}" class="@error('new_password') is-invalid @enderror">
                                    <button type="button" class="au-eye" data-au-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false"><i class="fas fa-eye"></i></button>
                                </div>
                                @error('new_password')<span class="au-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                            </div>
                            <div class="au-field">
                                <label class="au-label" for="new_confirm_password">{{ __('frontend.dashboard.confirm') }}</label>
                                <div class="au-input au-input--pass">
                                    <i class="fas fa-key au-input__icon" aria-hidden="true"></i>
                                    <input type="password" id="new_confirm_password" name="new_confirm_password" autocomplete="new-password" placeholder="{{ __('frontend.dashboard.confirm_ph') }}" class="@error('new_confirm_password') is-invalid @enderror">
                                    <button type="button" class="au-eye" data-au-toggle data-show="{{ __('frontend.dashboard.show') }}" data-hide="{{ __('frontend.dashboard.hide') }}" aria-label="{{ __('frontend.dashboard.show') }}" aria-pressed="false"><i class="fas fa-eye"></i></button>
                                </div>
                                @error('new_confirm_password')<span class="au-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</span>@enderror
                            </div>
                        </div>
                        <button type="submit" class="au-submit"><i class="fas fa-check"></i> {{ __('frontend.dashboard.save') }}</button>
                    </form>
                </div>

                <aside class="ds-tip">
                    <span class="ds-tip__icon"><i class="fas fa-shield-alt"></i></span>
                    <h3 class="ds-tip__title">{{ __('frontend.dashboard.tip_title') }}</h3>
                    <ul class="ds-tip__list">
                        <li><i class="fas fa-check"></i> {{ __('frontend.dashboard.tip1') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('frontend.dashboard.tip2') }}</li>
                        <li><i class="fas fa-check"></i> {{ __('frontend.dashboard.tip3') }}</li>
                    </ul>
                </aside>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    (function () {
        var btns = document.querySelectorAll('.ds-tab[data-tab]');
        var panels = document.querySelectorAll('.ds-panel');
        btns.forEach(function (b) {
            b.addEventListener('click', function () {
                var t = this.getAttribute('data-tab');
                btns.forEach(function (x) { x.classList.remove('active'); x.setAttribute('aria-selected', 'false'); });
                panels.forEach(function (p) { p.classList.remove('active'); p.hidden = true; });
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
                var panel = document.querySelector('.ds-panel[data-panel="' + t + '"]');
                if (panel) { panel.hidden = false; panel.classList.add('active'); }
            });
        });
        // If there are validation errors on the password form, open that tab
        @if($errors->any())
            var passTab = document.querySelector('.ds-tab[data-tab="password"]');
            if (passTab) passTab.click();
        @endif

        // Show / hide password
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-au-toggle]');
            if (!btn) return;
            var input = btn.parentElement.querySelector('input');
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.setAttribute('aria-pressed', show ? 'true' : 'false');
            btn.setAttribute('aria-label', show ? btn.dataset.hide : btn.dataset.show);
            btn.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
        });
    })();
</script>
@endpush
