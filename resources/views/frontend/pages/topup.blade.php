@extends('frontend.layouts.main')

@section('title', __('inkwave.topup_heading'))

@section('main-content')
<x-breadcrumb :title="__('inkwave.topup_heading')" />

<section class="points-topup-section" id="topup">
    <div class="auto-container">
        <div class="topup-head">
            <p class="topup-eyebrow">{{ __('inkwave.topup_eyebrow') }}</p>
            <h2 class="topup-heading">{{ __('inkwave.topup_heading') }}</h2>
            <p class="topup-sub">{{ __('inkwave.topup_sub') }}</p>
        </div>

        <div class="topup-layout">
            @php
                $cur = session('currency');
                if ($cur == 'JPY') {
                    $tiers = [
                        ['n'=>__('inkwave.tier_standard'), 'i'=>'fa-feather', 'big'=>'×1',   'r'=>'¥1 - ¥79,999',        'f'=>false],
                        ['n'=>__('inkwave.tier_premium'),  'i'=>'fa-star',    'big'=>'×1.5', 'r'=>'¥80,000 - ¥159,999',  'f'=>false],
                        ['n'=>__('inkwave.tier_elite'),    'i'=>'fa-gem',     'big'=>'×2',   'r'=>'¥160,000 - ¥239,999', 'f'=>false],
                        ['n'=>__('inkwave.tier_vip'),      'i'=>'fa-crown',   'big'=>'×2.5', 'r'=>'¥240,000+',           'f'=>true],
                    ];
                } elseif ($cur == 'HKD') {
                    $tiers = [
                        ['n'=>__('inkwave.tier_standard'), 'i'=>'fa-feather', 'big'=>'×1',   'r'=>'HK$1 - HK$3,999',       'f'=>false],
                        ['n'=>__('inkwave.tier_premium'),  'i'=>'fa-star',    'big'=>'×1.5', 'r'=>'HK$4,000 - HK$7,999',     'f'=>false],
                        ['n'=>__('inkwave.tier_elite'),    'i'=>'fa-gem',     'big'=>'×2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
                        ['n'=>__('inkwave.tier_vip'),      'i'=>'fa-crown',   'big'=>'×2.5', 'r'=>'HK$12,000+',           'f'=>true],
                    ];
                } else {
                    $tiers = [
                        ['n'=>__('inkwave.tier_standard'), 'i'=>'fa-feather', 'big'=>'×1',   'r'=>'$1 - $499',       'f'=>false],
                        ['n'=>__('inkwave.tier_premium'),  'i'=>'fa-star',    'big'=>'×1.5', 'r'=>'$500 - $999',     'f'=>false],
                        ['n'=>__('inkwave.tier_elite'),    'i'=>'fa-gem',     'big'=>'×2',   'r'=>'$1,000 - $1,499', 'f'=>false],
                        ['n'=>__('inkwave.tier_vip'),      'i'=>'fa-crown',   'big'=>'×2.5', 'r'=>'$1,500+',         'f'=>true],
                    ];
                }
            @endphp

            <div class="tier-cards">
                @foreach($tiers as $t)
                    <div class="tier-card @if($t['f']) tier-card--featured @endif">
                        @if($t['f'])<span class="tier-card__flag">{{ __('inkwave.best_value') }}</span>@endif
                        <span class="tier-card__icon"><i class="fas {{ $t['i'] }}"></i></span>
                        <h3 class="tier-card__name">{{ $t['n'] }}</h3>
                        <div class="tier-card__price">
                            <span class="tier-card__mult">{{ $t['big'] }}</span>
                            <span class="tier-card__per">{{ __('inkwave.bonus_text') }}</span>
                        </div>
                        <ul class="tier-card__feats">
                            <li><i class="fas fa-check-circle"></i> {{ $t['r'] }}</li>
                            <li><i class="fas fa-check-circle"></i> {{ __('inkwave.bonus_text') }} {{ $t['big'] }}</li>
                        </ul>
                        <button type="button" class="tier-card__btn" data-topup-focus>{{ __('inkwave.calc_button') }}</button>
                    </div>
                @endforeach
            </div>

            <p class="tier-note">
                @if(session('currency') == 'JPY')
                    {{ __('inkwave.jpy_conversion_note') }}
                @elseif(session('currency') == 'HKD')
                    {{ __('inkwave.hkd_conversion_note') }}
                @else
                    {{ __('inkwave.usd_conversion_note') }}
                @endif
            </p>

            <div class="calc-center">
                <div class="ink-calc">
                    <div class="ink-calc__head">
                        <div>
                            <h2 class="ink-calc__title">{{ __('inkwave.calc_title') }}</h2>
                            <p class="ink-calc__tag">{{ __('inkwave.calc_tagline') }}</p>
                        </div>
                        <span class="ink-calc__cur">{{ session('currency') == 'JPY' ? '¥' : '$' }}</span>
                    </div>

                    <form action="{{ route('points.add-to-cart') }}" method="POST" class="luxury-calc-form ink-calc__form">
                        @csrf

                        <label class="ink-calc__label">{{ __('inkwave.calc_input_label') }}</label>
                        <div class="ink-calc__field">
                            <span class="ink-calc__prefix">{{ session('currency') == 'JPY' ? '¥' : '$' }}</span>
                            <input type="number" name="amount" id="topup_amount" class="ink-calc__input" placeholder="0" min="1" required>
                        </div>

                        <div class="ink-calc__rows">
                            <div class="ink-calc__row">
                                <span>{{ __('inkwave.calc_base_points') }}</span>
                                <span id="base_points">0</span>
                            </div>
                            <div class="ink-calc__row">
                                <span>{{ __('inkwave.calc_tier_bonus') }}</span>
                                <span id="multiplier_display" class="ink-calc__mult">×1</span>
                            </div>
                            <div class="ink-calc__row ink-calc__row--total">
                                <span>{{ __('inkwave.calc_youll_get') }}</span>
                                <span id="total_points">0</span>
                            </div>
                        </div>

                        <div class="ink-calc__display">
                            <span class="ink-calc__big" id="total_points_large">0</span>
                            <span class="ink-calc__unit">{{ __('inkwave.calc_points_unit') }}</span>
                        </div>

                        <ul class="ink-calc__benefits">
                            <li><i class="fas fa-check"></i> {{ __('inkwave.calc_benefit_access') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('inkwave.calc_benefit_tutorials') }}</li>
                            <li><i class="fas fa-check"></i> {{ __('inkwave.calc_benefit_vip') }}</li>
                        </ul>

                        <button type="submit" class="btn-premium-checkout ink-calc__btn">
                            <span class="btn-label">{{ __('inkwave.calc_button') }}</span>
                            <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </form>

                    <p class="ink-calc__trust"><i class="fas fa-check-circle"></i> {{ __('inkwave.calc_trust_message') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



@push('scripts')
<script>
    // Tier card buttons focus the amount input
    (function () {
        document.querySelectorAll('.tier-card__btn[data-topup-focus]').forEach(function (b) {
            b.addEventListener('click', function () {
                var a = document.getElementById('topup_amount');
                if (a) { a.scrollIntoView({ behavior: 'smooth', block: 'center' }); setTimeout(function () { a.focus(); }, 350); }
            });
        });
    })();

    // Live points calculator
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('topup_amount');
        const totalPointsDisplay = document.getElementById('total_points');
        const totalPointsLarge = document.getElementById('total_points_large');
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
            basePointsDisplay.textContent = basePoints.toLocaleString();
            multiplierDisplay.textContent = multiplier === 1 ? 'None' : '×' + multiplier.toFixed(1);
            totalPointsDisplay.textContent = totalPoints.toLocaleString();
            totalPointsLarge.textContent = totalPoints.toLocaleString();
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('change', calculatePoints);
    });
</script>
@endpush
