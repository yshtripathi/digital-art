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
                        ['n'=>__('inkwave.tier_standard'), 'i'=>'fa-feather', 'big'=>'×1',   'r'=>'HK$1 - HK$499',       'f'=>false],
                        ['n'=>__('inkwave.tier_premium'),  'i'=>'fa-star',    'big'=>'×1.5', 'r'=>'HK$500 - HK$999',     'f'=>false],
                        ['n'=>__('inkwave.tier_elite'),    'i'=>'fa-gem',     'big'=>'×2',   'r'=>'HK$1,000 - HK$1,499', 'f'=>false],
                        ['n'=>__('inkwave.tier_vip'),      'i'=>'fa-crown',   'big'=>'×2.5', 'r'=>'HK$1,500+',           'f'=>true],
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

@push('styles')
<style>
    /* =========================================================
       TOP-UP — Structured theme (tier cards + calculator)
       ========================================================= */
    .points-topup-section { background-color: var(--color-putty, #c4c3b6); padding: 84px 40px; }
    .topup-head { text-align: center; margin-bottom: 48px; }
    .topup-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.18em; color: var(--color-graphite, #595855); margin: 0 0 10px 0;
    }
    .topup-heading {
        font-family: var(--font-davinci, serif); font-size: clamp(28px, 3.5vw, 44px); font-weight: 500;
        color: var(--color-ink, #000); letter-spacing: -0.01em; line-height: 1.1; margin: 0 0 14px 0;
    }
    .topup-sub {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; line-height: 1.6;
        color: var(--color-graphite, #595855); max-width: 560px; margin: 0 auto;
    }
    .topup-layout { max-width: 1200px; margin: 0 auto; }

    /* Tier pricing cards */
    .tier-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; align-items: stretch; }
    .tier-card {
        position: relative; display: flex; flex-direction: column;
        background-color: var(--color-ink, #000); border: 1px solid rgba(255, 255, 255, 0.14);
        border-radius: 14px; padding: 28px 24px; box-shadow: none;
    }
    .tier-card--featured { border-color: var(--color-paper, #fff); border-width: 1.5px; }
    .tier-card__flag {
        position: absolute; top: -11px; right: 18px;
        background-color: var(--color-paper, #fff); color: var(--color-ink, #000);
        font-family: var(--font-helvetica-now, sans-serif); font-size: 10px; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.08em; padding: 4px 12px; border-radius: 28.8px;
    }
    .tier-card__icon {
        width: 44px; height: 44px; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 50%;
        display: flex; align-items: center; justify-content: center; color: var(--color-paper, #fff); font-size: 16px; margin-bottom: 20px;
    }
    .tier-card__name { font-family: var(--font-davinci, serif); font-size: 22px; font-weight: 500; color: var(--color-paper, #fff); margin: 0 0 16px 0; }
    .tier-card__price { display: flex; align-items: baseline; gap: 8px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.12); }
    .tier-card__mult { font-family: var(--font-davinci, serif); font-size: 40px; font-weight: 500; line-height: 1; color: var(--color-paper, #fff); }
    .tier-card__per { font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; text-transform: uppercase; letter-spacing: 0.1em; color: rgba(255, 255, 255, 0.55); }
    .tier-card__feats { list-style: none; padding: 0; margin: 0 0 24px 0; display: flex; flex-direction: column; gap: 12px; flex-grow: 1; }
    .tier-card__feats li { display: flex; align-items: center; gap: 10px; font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; color: rgba(255, 255, 255, 0.8); line-height: 1.4; }
    .tier-card__feats li i { color: var(--color-paper, #fff); font-size: 13px; flex-shrink: 0; }
    .tier-card__btn {
        width: 100%; font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em; background-color: transparent; color: var(--color-paper, #fff);
        border: 1px solid rgba(255, 255, 255, 0.4); border-radius: 28.8px; padding: 12px 18px; cursor: pointer; margin-top: auto;
    }
    .tier-card--featured .tier-card__btn { background-color: var(--color-paper, #fff); color: var(--color-ink, #000); border-color: var(--color-paper, #fff); }
    .tier-note { text-align: center; font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; color: var(--color-graphite, #595855); margin: 24px auto 0 auto; max-width: 720px; }
    .calc-center { max-width: 560px; margin: 56px auto 0 auto; }

    /* Calculator (fresh ink-calc classes) */
    .calc-center .ink-calc { background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 14px; padding: 30px; box-shadow: none; }
    .ink-calc__head { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; padding-bottom: 20px; margin-bottom: 22px; border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .ink-calc__title { font-family: var(--font-davinci, serif); font-size: 22px; font-weight: 500; color: var(--color-ink, #000); margin: 0; }
    .ink-calc__tag { font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; color: var(--color-graphite, #595855); margin: 4px 0 0 0; }
    .ink-calc__cur { flex-shrink: 0; width: 40px; height: 40px; border-radius: 50%; background-color: var(--color-ink, #000); color: var(--color-paper, #fff); display: flex; align-items: center; justify-content: center; font-family: var(--font-helvetica-now, sans-serif); font-size: 16px; font-weight: 600; }
    .ink-calc__label { display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--color-graphite, #595855); margin-bottom: 8px; }
    .ink-calc__field { display: flex; align-items: center; background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 9px; padding: 0 16px; margin-bottom: 22px; transition: border-color 0.2s ease; }
    .ink-calc__field:focus-within { border-color: var(--color-ink, #000); }
    .ink-calc__prefix { font-family: var(--font-helvetica-now, sans-serif); font-size: 20px; font-weight: 600; color: var(--color-graphite, #595855); margin-right: 8px; }
    .ink-calc__input { flex: 1; width: 100%; border: none; outline: none; background: transparent; font-family: var(--font-helvetica-now, sans-serif); font-size: 26px; font-weight: 500; color: var(--color-ink, #000); padding: 14px 0; box-shadow: none; }
    .ink-calc__rows { background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 9px; padding: 16px 18px; margin-bottom: 22px; }
    .ink-calc__row { display: flex; align-items: center; justify-content: space-between; padding: 6px 0; font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; color: var(--color-graphite, #595855); }
    .ink-calc__row > span:last-child:not(.ink-calc__mult) { color: var(--color-ink, #000); font-weight: 600; }
    .ink-calc__mult { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); padding: 2px 10px; border-radius: 28.8px; font-size: 12px; }
    .ink-calc__row--total { margin-top: 8px; padding-top: 12px; border-top: 1px solid var(--color-vellum, #dfdcd5); }
    .ink-calc__row--total > span { font-size: 15px; color: var(--color-ink, #000); font-weight: 700; }
    .ink-calc__display { background-color: var(--color-ink, #000); border-radius: 9px; padding: 22px; margin-bottom: 22px; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 4px; }
    .ink-calc__big { font-family: var(--font-davinci, serif); font-size: 44px; font-weight: 500; line-height: 1; color: var(--color-paper, #fff); }
    .ink-calc__unit { font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; text-transform: uppercase; letter-spacing: 0.18em; color: rgba(255, 255, 255, 0.6); }
    .ink-calc__benefits { list-style: none; padding: 0; margin: 0 0 22px 0; display: flex; flex-direction: column; gap: 10px; }
    .ink-calc__benefits li { display: flex; align-items: center; gap: 10px; font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; color: var(--color-graphite, #595855); }
    .ink-calc__benefits li i { color: var(--color-ink, #000); font-size: 11px; }
    .calc-center .ink-calc .btn-premium-checkout {
        width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        background: var(--color-ink, #000); background-color: var(--color-ink, #000); background-image: none;
        color: var(--color-paper, #fff); border: 1px solid var(--color-ink, #000); border-radius: 28.8px;
        padding: 15px 24px; cursor: pointer; box-shadow: none;
    }
    .calc-center .ink-calc .btn-premium-checkout:hover { opacity: 0.9; }
    .ink-calc__trust { display: flex; align-items: center; justify-content: center; gap: 8px; margin: 16px 0 0 0; font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; color: var(--color-graphite, #595855); }
    .ink-calc__trust i { color: var(--color-ink, #000); }

    @media (max-width: 992px) { .tier-cards { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 560px) {
        .points-topup-section { padding: 56px 20px; }
        .tier-cards { grid-template-columns: 1fr; }
    }
</style>
@endpush

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
            let basePoints = 0;

            if (isJPY) {
                basePoints = Math.floor(amount / 160);
                if (amount >= 240000) multiplier = 2.5;
                else if (amount >= 160000) multiplier = 2;
                else if (amount >= 80000) multiplier = 1.5;
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
