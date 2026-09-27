@extends('frontend.layouts.main')
@section('title', __('frontend.topup.page_name'))
@section('description', __('frontend.topup.meta'))

@section('main-content')
@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.topup.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.topup.page_name')]
    ]
])

@php
    $cur = session('currency');
    if ($cur == 'JPY') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'min' => 1,      'r' => '&yen;1 - &yen;79,999'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 80000,  'r' => '&yen;80,000 - &yen;159,999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 160000, 'r' => '&yen;160,000 - &yen;239,999'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 240000, 'r' => '&yen;240,000+'],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
        $rateNote = __('frontend.topup.rate_yen');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'min' => 1,     'r' => 'HK$1 - HK$3,999'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 4000,  'r' => 'HK$4,000 - HK$7,999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 8000,  'r' => 'HK$8,000 - HK$11,999'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 12000, 'r' => 'HK$12,000+'],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rateNote = __('frontend.topup.rate_hk');
    } else {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'min' => 1,    'r' => '$1 - $499'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 500,  'r' => '$500 - $999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 1000, 'r' => '$1,000 - $1,499'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 1500, 'r' => '$1,500+'],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rateNote = __('frontend.topup.rate_dollar');
    }
@endphp

<section class="tp">
    <div class="tp__intro">
        <p class="tp__lead">{{ __('frontend.topup.lead') }}</p>
        <ul class="tp__chips">
            <li><i class="fas fa-exchange-alt" aria-hidden="true"></i> {{ $rateNote }}</li>
            <li><i class="fas fa-calendar-alt" aria-hidden="true"></i> {{ rtrim(__('frontend.topup.valid_days'), '.。') }}</li>
        </ul>
    </div>

    <div class="tp-ladder">
        <div class="tp-ladder__head">
            <span class="tp-ladder__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
            <h2 class="tp-ladder__title">{{ __('frontend.topup.ladder') }}</h2>
        </div>

        <div class="tp-track" aria-hidden="true">
            <span class="tp-track__fill" data-fill></span>
            <span class="tp-track__pin" data-pin></span>
            @foreach($tiers as $t)
                @if(!$loop->first)
                    <span class="tp-track__stop" style="--at: {{ $loop->index * 25 }}%"></span>
                @endif
            @endforeach
        </div>

        <ol class="tp-tiers">
            @foreach($tiers as $t)
                <li class="tp-tier {{ $loop->last ? 'tp-tier--top' : '' }}" data-mult="{{ $t['big'] }}" data-min="{{ $t['min'] }}" data-name="{{ $t['n'] }}">
                    <div class="tp-tier__top">
                        <span class="tp-tier__icon" aria-hidden="true"><i class="fas {{ $t['i'] }}"></i></span>
                        <span class="tp-tier__name">{{ $t['n'] }}</span>
                    </div>
                    <strong class="tp-tier__mult num">{{ $t['big'] }}</strong>
                    <span class="tp-tier__range num">{!! $t['r'] !!}</span>
                    @if($loop->last)
                        <span class="tp-tier__best">{{ __('frontend.topup.tier_best') }}</span>
                    @endif
                    <span class="tp-tier__match"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.topup.tier_match') }}</span>
                </li>
            @endforeach
        </ol>

        <p class="tp-ladder__hint" aria-live="polite" data-hint>
            <i class="fas fa-arrow-up" aria-hidden="true"></i>
            <span data-hint-text>{{ __('frontend.topup.hint_start') }}</span>
        </p>
    </div>

    <form action="{{ route('points.add-to-cart') }}" method="POST" class="tp-form" novalidate>
        @csrf

        <div class="tp-calc">
            <div class="tp-calc__input">
                <label class="tp__label" for="topup_amount">{{ __('frontend.topup.amount_label') }}</label>
                <div class="tp-amount">
                    <span class="tp-amount__symbol" aria-hidden="true">{!! $symbol !!}</span>
                    <input type="number" name="amount" id="topup_amount" class="tp-amount__input num" placeholder="{{ __('frontend.topup.amount_hint') }}" min="1" required inputmode="decimal">
                </div>

                <span class="tp__label" id="tpQuickLabel">{{ __('frontend.topup.quick_label') }}</span>
                <div class="tp-quick" role="group" aria-labelledby="tpQuickLabel">
                    @foreach($quick as $q)
                        <button type="button" class="tp-quick__btn num" data-amount="{{ $q }}">{!! $symbol !!}{{ number_format($q) }}</button>
                    @endforeach
                </div>

                <p class="tp__notice">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                    <span><strong>{{ __('frontend.topup.note_head') }}</strong> {{ __('frontend.topup.note') }}</span>
                </p>
            </div>

            <div class="tp-result">
                <span class="tp-result__label">{{ __('frontend.topup.you_get') }}</span>
                <span class="tp-result__total" id="tpTotalWrap" aria-live="polite">
                    <i class="fas fa-coins" aria-hidden="true"></i>
                    <strong id="total_points" class="num">0</strong>
                </span>

                <div class="tp-result__eq">
                    <span class="tp-result__cell">
                        <small>{{ __('frontend.topup.res_base') }}</small>
                        <b id="base_points" class="num">0</b>
                    </span>
                    <span class="tp-result__op" aria-hidden="true">&times;</span>
                    <span class="tp-result__cell">
                        <small>{{ __('frontend.topup.res_mult') }}</small>
                        <b id="multiplier_display" class="num">x1</b>
                    </span>
                </div>

                <button type="submit" class="btn btn--primary btn--block tp-submit">
                    <span>{{ __('frontend.topup.add') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>

                <p class="tp-result__secure">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <span>{{ __('frontend.topup.secure') }}</span>
                </p>
            </div>
        </div>
    </form>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('topup_amount');
    const totalOut = document.getElementById('total_points');
    const baseOut = document.getElementById('base_points');
    const multOut = document.getElementById('multiplier_display');
    const totalWrap = document.getElementById('tpTotalWrap');
    const tiers = Array.prototype.slice.call(document.querySelectorAll('.tp-tier'));
    const quickBtns = document.querySelectorAll('.tp-quick__btn');
    const fill = document.querySelector('[data-fill]');
    const pin = document.querySelector('[data-pin]');
    const hint = document.querySelector('[data-hint]');
    const hintText = document.querySelector('[data-hint-text]');
    const symbol = @json(html_entity_decode($symbol));
    const words = {
        start: @json(__('frontend.topup.hint_start')),
        next: @json(__('frontend.topup.hint_next')),
        top: @json(__('frontend.topup.hint_top'))
    };
    const isJPY = {{ session('currency') == 'JPY' ? 'true' : 'false' }};
    const isHKD = {{ session('currency') == 'HKD' ? 'true' : 'false' }};
    if (!input) return;

    const mins = tiers.map(function (tier) { return parseFloat(tier.dataset.min); });

    function position(amount) {
        if (amount <= 0) return 0;
        for (let i = mins.length - 1; i >= 0; i--) {
            if (amount >= mins[i]) {
                const start = i === 0 ? 0 : mins[i];
                const end = i < mins.length - 1 ? mins[i + 1] : mins[i] * 1.34;
                const part = Math.min((amount - start) / (end - start), 1);
                return Math.min((i + part) * 25, 100);
            }
        }
        return 0;
    }

    function calculate() {
        const amount = parseFloat(input.value) || 0;
        const usd = isJPY ? amount / 160 : (isHKD ? amount / 8 : amount);
        let multiplier = 1;
        if (usd >= 1500) multiplier = 3;
        else if (usd >= 1000) multiplier = 2.5;
        else if (usd >= 500) multiplier = 2;

        const base = Math.round(usd);
        const total = Math.round(usd * multiplier);
        const mult = 'x' + multiplier;
        baseOut.textContent = base.toLocaleString();
        multOut.textContent = mult;
        totalOut.textContent = total.toLocaleString();

        let current = -1;
        tiers.forEach(function (tier, i) {
            const reached = amount > 0 && amount >= mins[i];
            tier.classList.toggle('is-reached', reached);
            if (reached) current = i;
        });
        tiers.forEach(function (tier, i) {
            tier.classList.toggle('is-match', i === current);
        });

        const at = position(amount);
        fill.style.width = at + '%';
        pin.style.left = at + '%';
        pin.classList.toggle('is-on', amount > 0);

        if (amount <= 0) {
            hintText.textContent = words.start;
            hint.classList.remove('is-top');
        } else if (current >= tiers.length - 1) {
            hintText.textContent = words.top;
            hint.classList.add('is-top');
        } else {
            const next = tiers[current + 1];
            const gap = Math.max(mins[current + 1] - amount, 0);
            hintText.textContent = words.next
                .replace(':amount', symbol + gap.toLocaleString())
                .replace(':tier', next.dataset.name)
                .replace(':mult', next.dataset.mult);
            hint.classList.remove('is-top');
        }

        quickBtns.forEach(function (btn) {
            btn.classList.toggle('is-active', btn.dataset.amount === input.value);
        });
        totalWrap.classList.remove('is-pulse');
        void totalWrap.offsetWidth;
        totalWrap.classList.add('is-pulse');
    }

    input.addEventListener('input', function () {
        this.setCustomValidity('');
        calculate();
    });
    input.addEventListener('change', calculate);

    quickBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            input.value = btn.dataset.amount;
            input.dispatchEvent(new Event('input', { bubbles: true }));
            input.focus();
        });
    });

    document.querySelectorAll('.tp-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!((parseFloat(input.value) || 0) >= 1)) {
                input.setCustomValidity(@json(__('frontend.topup.amount_empty')));
                input.reportValidity();
                return;
            }
            const btn = form.querySelector('.tp-submit');
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> <span>' + @json(__('frontend.topup.adding')) + '</span>';

            fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                .then(function (response) { return new Promise(function (resolve) { setTimeout(function () { resolve(response); }, 500); }); })
                .then(function () { window.location.reload(); })
                .catch(function () {
                    btn.disabled = false;
                    btn.innerHTML = original;
                });
        });
    });
});
</script>
@endpush
