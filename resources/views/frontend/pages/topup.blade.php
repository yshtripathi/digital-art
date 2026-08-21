@extends('frontend.layouts.main')
@section('title', __('inkwave.tu_heading'))

@section('main-content')
@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.tu_heading'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.tu_heading')]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme Topup - Artora
------------------------------------------- */
.duo-tu-wrap {
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    background: #ffffff;
    padding-bottom: 100px;
}
.duo-tu-wrap a { text-decoration: none !important; }

.duo-tu-container {
    max-width: 1200px;
    margin: 48px auto;
    padding: 0 24px;
}

/* Header */
.duo-tu-head {
    text-align: center;
    margin-bottom: 64px;
}
.duo-tu-eyebrow {
    font-size: 16px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--color-spark-blue, #1cb0f6);
    letter-spacing: 0.1em;
    margin-bottom: 16px;
}
.duo-tu-title {
    font-size: 48px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.duo-tu-sub {
    font-size: 20px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    max-width: 600px;
    margin: 0 auto;
}

/* Tiers Grid */
.duo-tu-tiers {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 32px;
    margin-bottom: 32px;
}
.duo-tu-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    padding: 40px 24px 32px;
    text-align: center;
    box-shadow: 0 8px 0 #e5e5e5;
    position: relative;
    transition: transform 0.1s, box-shadow 0.1s;
    display: flex;
    flex-direction: column;
}
.duo-tu-card--vip {
    border-color: var(--color-macaw-yellow, #ffc800);
    box-shadow: 0 8px 0 var(--color-macaw-yellow, #ffc800);
    background: #fffcf0;
}
.duo-tu-card:hover {
    transform: translateY(4px);
    box-shadow: 0 4px 0 #e5e5e5;
}
.duo-tu-card--vip:hover {
    box-shadow: 0 4px 0 var(--color-macaw-yellow, #ffc800);
}
.duo-tu-card__flag {
    position: absolute;
    top: -16px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--color-macaw-yellow, #ffc800);
    color: #ffffff;
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 12px;
    border: 2px solid #ffffff;
    box-shadow: 0 4px 0 rgba(0,0,0,0.1);
    white-space: nowrap;
}
.duo-tu-card__icon {
    font-size: 48px;
    color: var(--color-spark-blue, #1cb0f6);
    margin-bottom: 16px;
    display: block;
}
.duo-tu-card--vip .duo-tu-card__icon {
    color: var(--color-macaw-yellow, #ffc800);
}
.duo-tu-card__name {
    font-size: 24px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 8px;
}
.duo-tu-card__mult {
    font-size: 36px;
    font-weight: 800;
    color: var(--color-spark-blue, #1cb0f6);
}
.duo-tu-card--vip .duo-tu-card__mult {
    color: var(--color-macaw-yellow, #ffc800);
}
.duo-tu-card__feats {
    list-style: none;
    padding: 0;
    margin: 24px 0;
    text-align: left;
    flex: 1;
}
.duo-tu-card__feats li {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.duo-tu-card__feats i {
    color: var(--color-eager-green, #58cc02);
}
.duo-tu-btn {
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff !important;
    border: 2px solid #1899d6;
    border-radius: 16px;
    padding: 12px 24px;
    font-size: 17px;
    font-weight: 800;
    text-transform: uppercase;
    box-shadow: 0 4px 0 #1899d6;
    cursor: pointer;
    width: 100%;
    transition: all 0.1s;
    margin-top: auto;
}
.duo-tu-btn:hover { filter: brightness(1.05); }
.duo-tu-btn:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }

.duo-tu-note {
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 64px;
}

/* Calculator Block */
.duo-tu-calc {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    box-shadow: 0 12px 0 #e5e5e5;
    max-width: 800px;
    margin: 0 auto;
    overflow: hidden;
}
.duo-tu-calc__head {
    background: var(--color-spark-blue, #1cb0f6);
    padding: 32px;
    text-align: center;
    color: #ffffff;
    border-bottom: 2px solid #1899d6;
}
.duo-tu-calc__title {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 8px;
}
.duo-tu-calc__body {
    padding: 48px;
}
@media (max-width: 600px) { .duo-tu-calc__body { padding: 24px; } }

.duo-tu-form-group {
    margin-bottom: 32px;
}
.duo-tu-label {
    display: block;
    font-size: 18px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 12px;
}
.duo-tu-input-wrap {
    display: flex;
    align-items: center;
    background: #f7f7f7;
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    padding: 0 24px;
    font-size: 24px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    box-shadow: inset 0 4px 0 rgba(0,0,0,0.02);
}
.duo-tu-input-wrap input {
    border: none;
    background: transparent;
    padding: 20px 16px;
    font-size: 24px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    width: 100%;
    outline: none;
}
.duo-tu-stats {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 20px;
    padding: 24px;
    margin-bottom: 32px;
    box-shadow: 0 4px 0 #e5e5e5;
}
.duo-tu-stat {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 12px;
}
.duo-tu-stat--total {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 2px dashed #e5e5e5;
    font-size: 24px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 0;
}
.duo-tu-stat--total span:last-child {
    color: var(--color-macaw-yellow, #ffc800);
}
.duo-tu-buybtn {
    background: var(--color-eager-green, #58cc02);
    color: #ffffff !important;
    border: 2px solid #46a302;
    border-radius: 16px;
    padding: 20px;
    font-size: 22px;
    font-weight: 800;
    text-transform: uppercase;
    box-shadow: 0 6px 0 #46a302;
    cursor: pointer;
    width: 100%;
    transition: all 0.1s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.duo-tu-buybtn:hover { filter: brightness(1.05); }
.duo-tu-buybtn:active { transform: translateY(6px); box-shadow: 0 0 0 transparent; }
</style>

<div class="duo-tu-wrap">
    <div class="duo-tu-container">
        
        <div class="duo-tu-head">
            <p class="duo-tu-eyebrow"><i class="fas fa-coins"></i> {{ __('inkwave.tu_eyebrow') }}</p>
            <h1 class="duo-tu-title">{{ __('inkwave.tu_heading') }}</h1>
            <p class="duo-tu-sub">{{ __('inkwave.tu_sub') }}</p>
        </div>

        @php
            $cur = session('currency');
            if ($cur == 'JPY') {
                $tiers = [
                    ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'×1',   'r'=>'¥1 - ¥79,999',        'f'=>false],
                    ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'×1.5', 'r'=>'¥80,000 - ¥159,999',  'f'=>false],
                    ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'×2',   'r'=>'¥160,000 - ¥239,999', 'f'=>false],
                    ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'×2.5', 'r'=>'¥240,000+',           'f'=>true],
                ];
            } elseif ($cur == 'HKD') {
                $tiers = [
                    ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'×1',   'r'=>'HK$1 - HK$3,999',       'f'=>false],
                    ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'×1.5', 'r'=>'HK$4,000 - HK$7,999',     'f'=>false],
                    ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'×2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
                    ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'×2.5', 'r'=>'HK$12,000+',           'f'=>true],
                ];
            } else {
                $tiers = [
                    ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'×1',   'r'=>'$1 - $499',       'f'=>false],
                    ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'×1.5', 'r'=>'$500 - $999',     'f'=>false],
                    ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'×2',   'r'=>'$1,000 - $1,499', 'f'=>false],
                    ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'×2.5', 'r'=>'$1,500+',         'f'=>true],
                ];
            }
        @endphp

        <div class="duo-tu-tiers">
            @foreach($tiers as $t)
                <div class="duo-tu-card @if($t['f']) duo-tu-card--vip @endif">
                    @if($t['f'])<span class="duo-tu-card__flag">{{ __('inkwave.tu_best_value') }}</span>@endif
                    <span class="duo-tu-card__icon"><i class="fas {{ $t['i'] }}"></i></span>
                    <h3 class="duo-tu-card__name">{{ $t['n'] }}</h3>
                    <div class="duo-tu-card__mult">{{ $t['big'] }}</div>
                    <ul class="duo-tu-card__feats">
                        <li><i class="fas fa-check-circle"></i> {{ $t['r'] }}</li>
                        <li><i class="fas fa-check-circle"></i> {{ __('inkwave.tu_bonus_text') }} {{ $t['big'] }}</li>
                    </ul>
                    <button type="button" class="duo-tu-btn" data-topup-focus>{{ __('inkwave.tu_calc_button') }}</button>
                </div>
            @endforeach
        </div>

        <p class="duo-tu-note">
            @if(session('currency') == 'JPY')
                {{ __('inkwave.tu_jpy_conversion_note') }}
            @elseif(session('currency') == 'HKD')
                {{ __('inkwave.tu_hkd_conversion_note') }}
            @else
                {{ __('inkwave.tu_usd_conversion_note') }}
            @endif
        </p>

        <div class="duo-tu-calc" id="topup">
            <div class="duo-tu-calc__head">
                <h2 class="duo-tu-calc__title">{{ __('inkwave.tu_calc_title') }}</h2>
                <p style="font-size:18px; font-weight:700; opacity:0.9;">{{ __('inkwave.tu_calc_tagline') }}</p>
            </div>
            
            <div class="duo-tu-calc__body">
                <form action="{{ route('points.add-to-cart') }}" method="POST">
                    @csrf
                    
                    <div class="duo-tu-form-group">
                        <label class="duo-tu-label">{{ __('inkwave.tu_calc_input_label') }}</label>
                        <div class="duo-tu-input-wrap">
                            <span>{{ session('currency') == 'JPY' ? '¥' : '$' }}</span>
                            <input type="number" name="amount" id="topup_amount" placeholder="0" min="1" required>
                        </div>
                    </div>

                    <div class="duo-tu-stats">
                        <div class="duo-tu-stat">
                            <span>{{ __('inkwave.tu_calc_base_points') }}:</span>
                            <span id="base_points">0</span>
                        </div>
                        <div class="duo-tu-stat">
                            <span>{{ __('inkwave.tu_calc_tier_bonus') }}:</span>
                            <span id="multiplier_display">×1</span>
                        </div>
                        <div class="duo-tu-stat duo-tu-stat--total">
                            <span>{{ __('inkwave.tu_calc_youll_get') }}:</span>
                            <span><i class="fas fa-coins"></i> <span id="total_points">0</span></span>
                        </div>
                    </div>

                    <button type="submit" class="duo-tu-buybtn">
                        <span>{{ __('inkwave.tu_calc_button') }}</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    
                    <p style="text-align:center; font-weight:700; color:var(--color-pencil-gray); margin-top:24px;">
                        <i class="fas fa-shield-alt" style="color:var(--color-eager-green);"></i> {{ __('inkwave.tu_calc_trust_message') }}
                    </p>
                </form>
            </div>
        </div>
        
    </div>
</div>
@endsection



@push('scripts')
<script>
    // Tier card buttons focus the amount input
    (function () {
        document.querySelectorAll('.duo-tu-btn[data-topup-focus]').forEach(function (b) {
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
            if(basePointsDisplay) basePointsDisplay.textContent = basePoints.toLocaleString();
            if(multiplierDisplay) multiplierDisplay.textContent = multiplier === 1 ? 'None' : '×' + multiplier.toFixed(1);
            if(totalPointsDisplay) totalPointsDisplay.textContent = totalPoints.toLocaleString();
            if(totalPointsLarge) totalPointsLarge.textContent = totalPoints.toLocaleString();
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('change', calculatePoints);
    });
</script>
@endpush
