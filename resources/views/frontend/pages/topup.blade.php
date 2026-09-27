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
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => '&yen;1 - &yen;79,999',        'f' => false],
            ['n' => __('frontend.topup.tier_premium'), 'i' => 'fa-star',    'big' => 'x2', 'r' => '&yen;80,000 - &yen;159,999',  'f' => false],
            ['n' => __('frontend.topup.tier_elite'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => '&yen;160,000 - &yen;239,999', 'f' => false],
            ['n' => __('frontend.topup.tier_vip'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => '&yen;240,000+',               'f' => true],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
        $rateNote = __('frontend.topup.rate_yen');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => 'HK$1 - HK$3,999',      'f' => false],
            ['n' => __('frontend.topup.tier_premium'), 'i' => 'fa-star',    'big' => 'x2', 'r' => 'HK$4,000 - HK$7,999',  'f' => false],
            ['n' => __('frontend.topup.tier_elite'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => 'HK$8,000 - HK$11,999', 'f' => false],
            ['n' => __('frontend.topup.tier_vip'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => 'HK$12,000+',           'f' => true],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rateNote = __('frontend.topup.rate_hk');
    } else {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => '$1 - $499',       'f' => false],
            ['n' => __('frontend.topup.tier_premium'), 'i' => 'fa-star',    'big' => 'x2', 'r' => '$500 - $999',     'f' => false],
            ['n' => __('frontend.topup.tier_elite'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => '$1,000 - $1,499', 'f' => false],
            ['n' => __('frontend.topup.tier_vip'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => '$1,500+',         'f' => true],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rateNote = __('frontend.topup.rate_dollar');
    }
@endphp

<section class="tp">
    <div class="tp__intro">
        <span class="eyebrow">{{ __('frontend.topup.eyebrow') }}</span>
        <p class="tp__lead">{{ __('frontend.topup.lead') }}</p>
        <ul class="tp__chips">
            <li><i class="fas fa-exchange-alt" aria-hidden="true"></i> {{ $rateNote }}</li>
            <li><i class="fas fa-calendar-alt" aria-hidden="true"></i> {{ rtrim(__('frontend.topup.valid_days'), '.。') }}</li>
        </ul>
    </div>

    <div class="tp-rates">
        <h2 class="tp-rates__title">{{ __('frontend.topup.ladder') }}</h2>
        <div class="tp-rates__frame">
            <table class="tp-rates__table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('frontend.topup.th_tier') }}</th>
                        <th scope="col">{{ __('frontend.topup.th_pay') }}</th>
                        <th scope="col">{{ __('frontend.topup.res_mult') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tiers as $t)
                        <tr class="tp-tier {{ $t['f'] ? 'tp-tier--best' : '' }}" data-mult="{{ $t['big'] }}">
                            <th scope="row">
                                <div class="tp-tier__cell">
                                    <span class="tp-tier__name">
                                        <span class="tp-tier__icon" aria-hidden="true"><i class="fas {{ $t['i'] }}"></i></span>
                                        {{ $t['n'] }}
                                    </span>
                                    @if($t['f'])
                                        <span class="tp-tier__badge">{{ __('frontend.topup.tier_best') }}</span>
                                    @endif
                                    <span class="tp-tier__match"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.topup.tier_match') }}</span>
                                </div>
                            </th>
                            <td class="tp-tier__range num">{!! $t['r'] !!}</td>
                            <td><span class="tp-tier__mult num">{{ $t['big'] }}</span></td>
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
    const tiers = document.querySelectorAll('.tp-tier');
    const quickBtns = document.querySelectorAll('.tp-quick__btn');
    const isJPY = {{ session('currency') == 'JPY' ? 'true' : 'false' }};
    const isHKD = {{ session('currency') == 'HKD' ? 'true' : 'false' }};
    if (!input) return;

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

        tiers.forEach(function (tier) {
            tier.classList.toggle('is-match', amount > 0 && tier.dataset.mult === mult);
        });
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
