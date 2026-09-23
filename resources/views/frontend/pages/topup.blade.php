@extends('frontend.layouts.main')
@section('title', __('frontend.topup.title'))
@section('description', __('frontend.topup.meta'))

@section('main-content')
@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.topup.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.topup.title')]
    ]
])

@php
    $cur = session('currency');
    if ($cur == 'JPY') {
        $tiers = [
            ['n' => __('frontend.topup.tier1'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => '&yen;1 - &yen;79,999',        'f' => false],
            ['n' => __('frontend.topup.tier2'), 'i' => 'fa-star',    'big' => 'x2', 'r' => '&yen;80,000 - &yen;159,999',  'f' => false],
            ['n' => __('frontend.topup.tier3'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => '&yen;160,000 - &yen;239,999', 'f' => false],
            ['n' => __('frontend.topup.tier4'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => '&yen;240,000+',               'f' => true],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
        $rateNote = __('frontend.topup.rate_jpy');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n' => __('frontend.topup.tier1'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => 'HK$1 - HK$3,999',      'f' => false],
            ['n' => __('frontend.topup.tier2'), 'i' => 'fa-star',    'big' => 'x2', 'r' => 'HK$4,000 - HK$7,999',  'f' => false],
            ['n' => __('frontend.topup.tier3'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => 'HK$8,000 - HK$11,999', 'f' => false],
            ['n' => __('frontend.topup.tier4'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => 'HK$12,000+',           'f' => true],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rateNote = __('frontend.topup.rate_hkd');
    } else {
        $tiers = [
            ['n' => __('frontend.topup.tier1'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => '$1 - $499',       'f' => false],
            ['n' => __('frontend.topup.tier2'), 'i' => 'fa-star',    'big' => 'x2', 'r' => '$500 - $999',     'f' => false],
            ['n' => __('frontend.topup.tier3'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => '$1,000 - $1,499', 'f' => false],
            ['n' => __('frontend.topup.tier4'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => '$1,500+',         'f' => true],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rateNote = __('frontend.topup.rate_usd');
    }
@endphp

<section class="tp">
    <div class="tp__wrap">

        <header class="tp-intro">
            <p class="tp-intro__text">{{ __('frontend.topup.intro') }}</p>
            <div class="tp-intro__facts">
                <span class="tp-rate">
                    <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                    <span>{{ $rateNote }}</span>
                </span>
                <p class="tp-notice">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>
                    <span><strong>{{ __('frontend.topup.note_title') }}</strong> {{ __('frontend.topup.note_text') }}</span>
                </p>
            </div>
        </header>

        <form action="{{ route('points.add-to-cart') }}" method="POST" class="tp-form" novalidate>
            @csrf

            <div class="tp-calc">
                <div class="tp-calc__head">
                    <span class="tp-calc__icon" aria-hidden="true"><i class="fas fa-calculator"></i></span>
                    <div>
                        <h2 class="tp-calc__title">{{ __('frontend.topup.calc_title') }}</h2>
                        <p class="tp-calc__desc">{{ __('frontend.topup.calc_desc') }}</p>
                    </div>
                </div>

                <label class="tp-label" for="topup_amount">{{ __('frontend.topup.amount') }}</label>
                <div class="tp-amount">
                    <span class="tp-amount__symbol" aria-hidden="true">{!! $symbol !!}</span>
                    <input type="number" name="amount" id="topup_amount" class="tp-amount__input" placeholder="{{ __('frontend.topup.amount_ph') }}" min="1" required inputmode="decimal">
                </div>

                <span class="tp-label tp-label--sm" id="tpQuickLabel">{{ __('frontend.topup.quick') }}</span>
                <div class="tp-quick" role="group" aria-labelledby="tpQuickLabel">
                    @foreach($quick as $q)
                        <button type="button" class="tp-quick__btn" data-amount="{{ $q }}">{!! $symbol !!}{{ number_format($q) }}</button>
                    @endforeach
                </div>

                <div class="tp-tiers">
                    <div class="tp-tiers__head">
                        <h3 class="tp-tiers__title">{{ __('frontend.topup.tiers_title') }}</h3>
                    </div>
                    <ol class="tp-ladder">
                        @foreach($tiers as $t)
                            <li class="tp-tier {{ $t['f'] ? 'tp-tier--best' : '' }}" data-mult="{{ $t['big'] }}">
                                <span class="tp-tier__icon" aria-hidden="true"><i class="fas {{ $t['i'] }}"></i></span>
                                <span class="tp-tier__mult">{{ $t['big'] }}</span>
                                <span class="tp-tier__name">{{ $t['n'] }}</span>
                                <span class="tp-tier__range">{!! $t['r'] !!}</span>
                                @if($t['f'])
                                    <span class="tp-tier__badge">{{ __('frontend.topup.best') }}</span>
                                @endif
                                <span class="tp-tier__match"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.topup.current') }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <aside class="tp-result">
                <div class="tp-result__card">
                    <span class="tp-result__label">{{ __('frontend.topup.total') }}</span>
                    <span class="tp-result__total" id="tpTotalWrap" aria-live="polite">
                        <i class="fas fa-bolt" aria-hidden="true"></i>
                        <strong id="total_points">0</strong>
                    </span>

                    <dl class="tp-result__rows">
                        <div class="tp-result__row">
                            <dt>{{ __('frontend.topup.base') }}</dt>
                            <dd id="base_points">0</dd>
                        </div>
                        <div class="tp-result__row">
                            <dt>{{ __('frontend.topup.multiplier') }}</dt>
                            <dd><span class="tp-result__mult" id="multiplier_display">x1</span></dd>
                        </div>
                    </dl>

                    <button type="submit" class="btn btn--primary btn--block tp-submit">
                        <span>{{ __('frontend.topup.submit') }}</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>

                    <p class="tp-secure">
                        <i class="fas fa-lock" aria-hidden="true"></i>
                        <span>{{ __('frontend.topup.secure') }}</span>
                    </p>
                </div>
            </aside>
        </form>

        <section class="tp-how" aria-labelledby="tpHowTitle">
            <h2 id="tpHowTitle" class="tp-how__title">{{ __('frontend.topup.how_title') }}</h2>
            <ol class="tp-steps">
                <li class="tp-step">
                    <span class="tp-step__icon" aria-hidden="true"><i class="fas fa-hand-pointer"></i></span>
                    <span class="tp-step__num" aria-hidden="true">01</span>
                    <h3 class="tp-step__title">{{ __('frontend.topup.step1_title') }}</h3>
                    <p class="tp-step__desc">{{ __('frontend.topup.step1_desc') }}</p>
                </li>
                <li class="tp-step">
                    <span class="tp-step__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                    <span class="tp-step__num" aria-hidden="true">02</span>
                    <h3 class="tp-step__title">{{ __('frontend.topup.step2_title') }}</h3>
                    <p class="tp-step__desc">{{ __('frontend.topup.step2_desc') }}</p>
                </li>
                <li class="tp-step">
                    <span class="tp-step__icon" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                    <span class="tp-step__num" aria-hidden="true">03</span>
                    <h3 class="tp-step__title">{{ __('frontend.topup.step3_title') }}</h3>
                    <p class="tp-step__desc">{{ __('frontend.topup.step3_desc') }}</p>
                </li>
            </ol>
        </section>

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
                input.setCustomValidity(@json(__('frontend.topup.amount_req')));
                input.reportValidity();
                return;
            }
            const btn = form.querySelector('.tp-submit');
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> <span>' + @json(__('frontend.topup.loading')) + '</span>';

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
