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
    <div class="tp__wrap">
        <header class="tp__intro">
            <div class="tp__intro-copy">
                <span class="tp__levels" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
                <h2 class="tp__title">{{ __('frontend.topup.title') }}</h2>
                <p class="tp__lead">{{ __('frontend.topup.lead') }}</p>
            </div>
            <ul class="tp__facts">
                <li class="tp__fact" style="--i: 0">
                    <span class="tp__fact-icon" aria-hidden="true"><i class="fas fa-exchange-alt"></i></span>
                    <span class="tp__fact-text">
                        <small>{{ __('frontend.topup.fact_rate') }}</small>
                        <strong>{{ $rateNote }}</strong>
                    </span>
                </li>
                <li class="tp__fact" style="--i: 1">
                    <span class="tp__fact-icon tp__fact-icon--alt" aria-hidden="true"><i class="fas fa-calendar-alt"></i></span>
                    <span class="tp__fact-text">
                        <small>{{ __('frontend.topup.fact_valid') }}</small>
                        <strong>{{ rtrim(__('frontend.topup.valid_days'), '.。') }}</strong>
                    </span>
                </li>
                <li class="tp__fact" style="--i: 2">
                    <span class="tp__fact-icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                    <span class="tp__fact-text">
                        <small>{{ __('frontend.topup.fact_use') }}</small>
                        <strong>{{ rtrim(__('frontend.topup.note'), '.。') }}</strong>
                    </span>
                </li>
            </ul>
        </header>

        <div class="tp-table">
            <div class="tp-table__head">
                <h3 class="tp-table__title">{{ __('frontend.topup.ladder') }}</h3>
                <p class="tp-table__text">{{ __('frontend.topup.table_text') }}</p>
            </div>
            <div class="tp-table__scroll">
                <table class="tp-tiers">
                    <caption class="vh">{{ __('frontend.topup.ladder') }}</caption>
                    <thead>
                        <tr>
                            <th scope="col">{{ __('frontend.topup.col_tier') }}</th>
                            <th scope="col">{{ __('frontend.topup.col_range') }}</th>
                            <th scope="col">{{ __('frontend.topup.col_mult') }}</th>
                            <th scope="col"><span class="vh">{{ __('frontend.topup.col_status') }}</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tiers as $t)
                            <tr class="tp-tier {{ $loop->last ? 'tp-tier--top' : '' }}" data-mult="{{ $t['big'] }}" data-min="{{ $t['min'] }}" data-name="{{ $t['n'] }}" style="--i: {{ $loop->index }}">
                                <th scope="row">
                                    <span class="tp-tier__name">
                                        <span class="tp-tier__icon" aria-hidden="true"><i class="fas {{ $t['i'] }}"></i></span>
                                        {{ $t['n'] }}
                                    </span>
                                </th>
                                <td class="tp-tier__range num">{!! $t['r'] !!}</td>
                                <td><strong class="tp-tier__mult num">{{ $t['big'] }}</strong></td>
                                <td class="tp-tier__state">
                                    @if($loop->last)
                                        <span class="tp-tier__best">{{ __('frontend.topup.tier_best') }}</span>
                                    @endif
                                    <span class="tp-tier__match"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.topup.tier_match') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <form action="{{ route('points.add-to-cart') }}" method="POST" class="tp-form" novalidate>
            @csrf

            <div class="tp-calc">
                <div class="tp-calc__input">
                    <p class="tp-calc__kicker">{{ __('frontend.topup.calc_kicker') }}</p>
                    <h3 class="tp-calc__title">{{ __('frontend.topup.calc_title') }}</h3>
                    <p class="tp-calc__text">{{ __('frontend.topup.calc_text') }}</p>

                    <label class="tp__label" for="topup_amount">{{ __('frontend.topup.amount_label') }}</label>
                    <div class="tp-amount">
                        <span class="tp-amount__symbol" aria-hidden="true">{!! $symbol !!}</span>
                        <input type="number" name="amount" id="topup_amount" class="tp-amount__input num" placeholder="{{ __('frontend.topup.amount_hint') }}" min="1" required inputmode="decimal">
                    </div>

                    <span class="tp__label" id="tpQuickLabel">{{ __('frontend.topup.quick_label') }}</span>
                    <div class="tp-quick" role="group" aria-labelledby="tpQuickLabel">
                        @foreach($quick as $q)
                            <button type="button" class="tp-quick__btn num" data-amount="{{ $q }}">
                                <span>{!! $symbol !!}{{ number_format($q) }}</span>
                                <small>{{ $tiers[$loop->index]['big'] }}</small>
                            </button>
                        @endforeach
                    </div>

                    <p class="tp-hint" aria-live="polite" data-hint>
                        <i class="fas fa-lightbulb" aria-hidden="true"></i>
                        <span data-hint-text>{{ __('frontend.topup.hint_start') }}</span>
                    </p>
                </div>

                <div class="tp-result">
                    <p class="tp-result__label">{{ __('frontend.topup.you_get') }}</p>
                    <p class="tp-result__total" id="tpTotalWrap" aria-live="polite">
                        <strong id="total_points" class="num">0</strong>
                        <span>{{ __('frontend.topup.unit') }}</span>
                    </p>

                    <table class="tp-bill">
                        <caption class="vh">{{ __('frontend.topup.bill_caption') }}</caption>
                        <tbody>
                            <tr>
                                <th scope="row">{{ __('frontend.topup.res_amount') }}</th>
                                <td id="amount_display" class="num">{!! $symbol !!}0</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('frontend.topup.res_base') }}</th>
                                <td id="base_points" class="num">0</td>
                            </tr>
                            <tr>
                                <th scope="row">{{ __('frontend.topup.res_mult') }}</th>
                                <td id="multiplier_display" class="num">x1</td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn--block tp-submit">
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

    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('topup_amount');
    const totalOut = document.getElementById('total_points');
    const baseOut = document.getElementById('base_points');
    const multOut = document.getElementById('multiplier_display');
    const amountOut = document.getElementById('amount_display');
    const totalWrap = document.getElementById('tpTotalWrap');
    const tiers = Array.prototype.slice.call(document.querySelectorAll('.tp-tier'));
    const quickBtns = document.querySelectorAll('.tp-quick__btn');
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
        amountOut.textContent = symbol + amount.toLocaleString();

        let current = -1;
        tiers.forEach(function (tier, i) {
            const reached = amount > 0 && amount >= mins[i];
            tier.classList.toggle('is-reached', reached);
            if (reached) current = i;
        });
        tiers.forEach(function (tier, i) {
            tier.classList.toggle('is-match', i === current);
        });

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
