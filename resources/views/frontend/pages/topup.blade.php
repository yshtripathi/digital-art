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
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'&yen;1 - &yen;79,999',        'f'=>false],
            ['n'=>__('frontend.topup.tier2'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'&yen;80,000 - &yen;159,999',  'f'=>false],
            ['n'=>__('frontend.topup.tier3'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'&yen;160,000 - &yen;239,999', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'&yen;240,000+',           'f'=>true],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
        $rateNote = __('frontend.topup.rate_jpy');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'HK$1 - HK$3,999',       'f'=>false],
            ['n'=>__('frontend.topup.tier2'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'HK$4,000 - HK$7,999',     'f'=>false],
            ['n'=>__('frontend.topup.tier3'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'HK$12,000+',           'f'=>true],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rateNote = __('frontend.topup.rate_hkd');
    } else {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'$1 - $499',       'f'=>false],
            ['n'=>__('frontend.topup.tier2'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'$500 - $999',     'f'=>false],
            ['n'=>__('frontend.topup.tier3'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'$1,000 - $1,499', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'$1,500+',         'f'=>true],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rateNote = __('frontend.topup.rate_usd');
    }
@endphp

{{-- ==========================================================================
     Credit top-up
     Tier cards, then one calculator panel with a live result rail, then the
     three-step explainer. Styles: public/css/theme.css — section 20
     JS hooks kept: #topup_amount, #base_points, #multiplier_display,
     #total_points, .topup-form, .topup-btn, .tu-quick__btn[data-amount],
     .tu-tier[data-mult], .is-current, .is-active, .tu-stats__total.is-pulse
     ========================================================================== --}}
<section class="tu">
    <div class="tu__wrap">

        {{-- Intro --}}
        <div class="tu-intro">
            <p class="tu-intro__desc">{{ __('frontend.topup.intro') }}</p>
            <div class="tu-intro__chips">
                <span class="tu-chip"><i class="fas fa-exchange-alt" aria-hidden="true"></i> {{ $rateNote }}</span>
                <span class="tu-chip tu-chip--warn"><i class="fas fa-exclamation-circle" aria-hidden="true"></i> <strong>{{ __('frontend.topup.note_title') }}</strong> {{ __('frontend.topup.note_text') }}</span>
            </div>
        </div>

        {{-- Tier cards --}}
        <div class="tu-tiers">
            <div class="tu-tiers__head">
                <h2 class="tu-tiers__title">{{ __('frontend.topup.tiers_title') }}</h2>
                <span class="tu-tiers__cols">{{ __('frontend.topup.tiers_cols') }}</span>
            </div>

            <ul class="tu-tiers__grid">
                @foreach($tiers as $index => $t)
                    <li class="tu-tier {{ $t['f'] ? 'tu-tier--best' : '' }}" data-mult="{{ $t['big'] }}">
                        <div class="tu-tier__top">
                            <span class="tu-tier__icon"><i class="fas {{ $t['i'] }}" aria-hidden="true"></i></span>
                            @if($t['f'])
                                <span class="tu-tier__badge">{{ __('frontend.topup.best') }}</span>
                            @endif
                            <span class="tu-tier__current"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.topup.current') }}</span>
                        </div>

                        <p class="tu-tier__mult">{{ $t['big'] }}</p>

                        <div class="tu-tier__meta">
                            <strong class="tu-tier__name">{{ $t['n'] }}</strong>
                            <span class="tu-tier__range">{!! $t['r'] !!}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Calculator --}}
        <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-form tu-calc" novalidate>
            @csrf

            <div class="tu-calc__main">
                <div class="tu-calc__head">
                    <span class="tu-calc__icon"><i class="fas fa-calculator" aria-hidden="true"></i></span>
                    <div>
                        <h2 class="tu-calc__title">{{ __('frontend.topup.calc_title') }}</h2>
                        <p class="tu-calc__desc">{{ __('frontend.topup.calc_desc') }}</p>
                    </div>
                </div>

                <label class="tu-form__label" for="topup_amount">{{ __('frontend.topup.amount') }}</label>
                <div class="tu-amount">
                    <span class="tu-amount__symbol">{!! $symbol !!}</span>
                    <input type="number" name="amount" id="topup_amount" class="tu-amount__input" placeholder="0" min="1" required inputmode="decimal">
                </div>

                <span class="tu-form__label tu-form__label--sm">{{ __('frontend.topup.quick') }}</span>
                <div class="tu-quick">
                    @foreach($quick as $q)
                        <button type="button" class="tu-quick__btn" data-amount="{{ $q }}">{!! $symbol !!}{{ number_format($q) }}</button>
                    @endforeach
                </div>
            </div>

            <div class="tu-calc__side">
                <div class="tu-stats">
                    <div class="tu-stats__row">
                        <span>{{ __('frontend.topup.base') }}:</span>
                        <span id="base_points">0</span>
                    </div>
                    <div class="tu-stats__row">
                        <span>{{ __('frontend.topup.multiplier') }}:</span>
                        <span class="tu-stats__mult" id="multiplier_display">x1</span>
                    </div>
                    <div class="tu-stats__total">
                        <span class="tu-stats__total-label">{{ __('frontend.topup.total') }}:</span>
                        <span class="tu-stats__total-value"><i class="fas fa-bolt" aria-hidden="true"></i> <span id="total_points">0</span></span>
                    </div>
                </div>

                <button type="submit" class="topup-btn tu-submit">
                    <span>{{ __('frontend.topup.submit') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>

                <p class="tu-trust">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.topup.secure') }}
                </p>
            </div>
        </form>

        {{-- How it works --}}
        <div class="tu-how">
            <h2 class="tu-how__title">{{ __('frontend.topup.how_title') }}</h2>
            <ol class="tu-how__steps">
                <li class="tu-step">
                    <span class="tu-step__num">01</span>
                    <span class="tu-step__icon"><i class="fas fa-hand-pointer" aria-hidden="true"></i></span>
                    <h3 class="tu-step__title">{{ __('frontend.topup.step1_title') }}</h3>
                    <p class="tu-step__desc">{{ __('frontend.topup.step1_desc') }}</p>
                </li>
                <li class="tu-step">
                    <span class="tu-step__num">02</span>
                    <span class="tu-step__icon"><i class="fas fa-lock" aria-hidden="true"></i></span>
                    <h3 class="tu-step__title">{{ __('frontend.topup.step2_title') }}</h3>
                    <p class="tu-step__desc">{{ __('frontend.topup.step2_desc') }}</p>
                </li>
                <li class="tu-step">
                    <span class="tu-step__num">03</span>
                    <span class="tu-step__icon"><i class="fas fa-graduation-cap" aria-hidden="true"></i></span>
                    <h3 class="tu-step__title">{{ __('frontend.topup.step3_title') }}</h3>
                    <p class="tu-step__desc">{{ __('frontend.topup.step3_desc') }}</p>
                </li>
            </ol>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    // Live points calculator
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('topup_amount');
        const totalPointsDisplay = document.getElementById('total_points');
        const basePointsDisplay = document.getElementById('base_points');
        const multiplierDisplay = document.getElementById('multiplier_display');
        if (!amountInput) return;

        function calculatePoints() {
            const amount = parseFloat(amountInput.value) || 0;
            let multiplier = 1;
            const isJPY = {{ session('currency') == 'JPY' ? 'true' : 'false' }};
            const isHKD = {{ session('currency') == 'HKD' ? 'true' : 'false' }};
            let basePoints = 0;

            if (isJPY) {
                basePoints = Math.floor(amount / 160);
                if (amount >= 240000) multiplier = 2.5;
                else if (amount >= 160000) multiplier = 2;
                else if (amount >= 80000) multiplier = 1.5;
                else multiplier = 1;
            } else if (isHKD) {
                basePoints = Math.floor(amount / 8);
                if (amount >= 12000) multiplier = 2.5;
                else if (amount >= 8000) multiplier = 2;
                else if (amount >= 4000) multiplier = 1.5;
                else multiplier = 1;
            } else {
                basePoints = Math.floor(amount);
                if (amount >= 1500) multiplier = 2.5;
                else if (amount >= 1000) multiplier = 2;
                else if (amount >= 500) multiplier = 1.5;
                else multiplier = 1;
            }

            const totalPoints = Math.round(basePoints * multiplier);
            if(basePointsDisplay) basePointsDisplay.textContent = basePoints.toLocaleString();
            if(multiplierDisplay) multiplierDisplay.textContent = 'x' + multiplier;
            if(totalPointsDisplay) totalPointsDisplay.textContent = totalPoints.toLocaleString();
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('input', function () { this.setCustomValidity(''); });
        amountInput.addEventListener('change', calculatePoints);

        // Topup (add to cart) - submit without redirect, then reload
        const topupForms = document.querySelectorAll('.topup-form');
        topupForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const amountField = form.querySelector('#topup_amount');
                if (amountField && !((parseFloat(amountField.value) || 0) >= 1)) {
                    amountField.setCustomValidity(@json(__('frontend.topup.amount_req')));
                    amountField.reportValidity();
                    return;
                }
                const submitBtn = form.querySelector('.topup-btn');
                const originalBtnText = submitBtn.innerHTML;
                const originalBtnState = submitBtn.disabled;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + @json(__('frontend.topup.loading'));

                fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                    .then(response => new Promise(resolve => setTimeout(() => resolve(response), 500)))
                    .then(() => { window.location.reload(); })
                    .catch(error => {
                        console.error('Error:', error);
                        submitBtn.disabled = originalBtnState;
                        submitBtn.innerHTML = originalBtnText;
                    });
            });
        });
    });
</script>

<script>
    // UI only: quick amounts, current-tier highlight and total pulse.
    // Reads the calculator's output; the calculation above is unchanged.
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('topup_amount');
        const multiplier = document.getElementById('multiplier_display');
        const total = document.getElementById('total_points');
        if (!input || !multiplier || !total) return;

        document.querySelectorAll('.tu-quick__btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                input.value = btn.dataset.amount;
                input.dispatchEvent(new Event('input', { bubbles: true }));
                input.focus();
            });
        });

        const tiers = document.querySelectorAll('.tu-tier');
        const quickBtns = document.querySelectorAll('.tu-quick__btn');
        const totalWrap = total.closest('.tu-stats__total');

        new MutationObserver(function () {
            const hasAmount = (parseFloat(input.value) || 0) > 0;
            tiers.forEach(function (tier) {
                tier.classList.toggle('is-current', hasAmount && tier.dataset.mult === multiplier.textContent.trim());
            });
            quickBtns.forEach(function (btn) {
                btn.classList.toggle('is-active', btn.dataset.amount === input.value);
            });
            totalWrap.classList.remove('is-pulse');
            void totalWrap.offsetWidth;
            totalWrap.classList.add('is-pulse');
        }).observe(total, { childList: true, characterData: true, subtree: true });
    });
</script>
@endpush
