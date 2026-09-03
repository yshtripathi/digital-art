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
/* ==========================================================================
   Art Courses — Top Up (Credits) Page - Premium Table Layout
   ========================================================================== */
.ag-topup-page, .ag-topup-page *, .ag-topup-page *::before, .ag-topup-page *::after {
    box-sizing: border-box;
}
.ag-topup-page {
    padding: 40px 40px;
    min-height: 80vh;
}
.ag-container {
    max-width: 1200px; /* Reduced max-width to constrain table */
    margin: 0 auto;
    padding: 0 5%;
}

.ag-topup-head {
    text-align: center;
    margin-bottom: 64px;
}
.ag-page-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 56px !important;
    color: #000000 !important;
    margin-bottom: 16px !important;
    line-height: 1.1;
}
.ag-page-desc {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 16px;
    color: #555555;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.ag-split-grid {
    display: flex;
    flex-direction: column;
    gap: 64px;
    max-width: 900px; /* Constrained for vertical stacking */
    margin: 0 auto;
}

/* ==========================================================================
   TOP COLUMN: Tiers Table
   ========================================================================== */
.ag-table-card {
    background-color: #ffffff; /* White card */
    padding: 48px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    border-top: 6px solid #000000;
}
.ag-section-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 32px;
    color: #000000;
    margin-bottom: 32px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding-bottom: 16px;
}
.ag-table-wrap {
    overflow-x: auto;
    margin-bottom: 32px;
}
.ag-tiers-table {
    width: 100%;
    background-color: #ffffff;
    border-collapse: collapse;
    font-family: var(--font-arial, Arial, sans-serif);
}
.ag-tiers-table th, .ag-tiers-table td {
    padding: 20px 24px;
    border: none;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    text-align: left;
    white-space: nowrap;
}
.ag-tiers-table th {
    background: #f5f5f5; /* Bone header */
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #000000;
}
.ag-tiers-table td {
    font-size: 15px;
    color: #333333;
    vertical-align: middle;
}
.ag-tiers-table i {
    color: #bc9c5c;
    margin-right: 12px;
    font-size: 20px;
}
.ag-tiers-table strong {
    font-size: 16px;
    color: #000000;
}
.ag-badge {
    display: inline-block;
    background: #000000;
    color: #ffffff;
    font-size: 11px;
    padding: 6px 10px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-left: 16px;
    vertical-align: middle;
}
.ag-highlight {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 24px;
    color: #bc9c5c;
    font-weight: bold;
}
.vip-row td {
    background: #faf8f5;
}

.ag-note {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    color: #888888;
    font-style: italic;
    line-height: 1.6;
    margin-bottom: 12px;
}

.ag-disclaimer-box {
    background-color: #faf8f5; /* Subtle tint */
    border-left: 4px solid #bc9c5c;
    padding: 16px 24px;
    margin-top: 24px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    color: #000000;
    display: flex;
    align-items: center;
    gap: 12px;
}
.ag-disclaimer-box i {
    color: #bc9c5c;
    font-size: 24px;
}

/* ==========================================================================
   BOTTOM COLUMN: Calculator Form
   ========================================================================== */
.ag-calc-card {
    background: #ffffff; /* White card */
    padding: 48px;
    border-top: 6px solid #000000;
    box-shadow: 0 20px 40px rgba(0,0,0,0.05);
}
.ag-calc-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 36px;
    color: #000000;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.ag-calc-title i { color: #bc9c5c; font-size: 28px; }
.ag-calc-desc {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px;
    color: #555555;
    margin-bottom: 40px;
}

.ag-form-group { margin-bottom: 40px; }
.ag-label {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #888888;
    display: block;
    margin-bottom: 12px;
    font-weight: bold;
}
.ag-input-wrap {
    display: flex;
    align-items: center;
    background: #f5f5f5; /* Inverted to Bone */
    border: 1px solid rgba(0,0,0,0.1);
    transition: border-color 0.3s ease;
}
.ag-input-wrap:focus-within {
    border-color: #000000;
}
.ag-currency-symbol {
    padding: 20px 24px;
    background: #eeeeee;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 20px;
    color: #555555;
    font-weight: bold;
    border-right: 1px solid rgba(0,0,0,0.1);
}
.ag-input {
    flex: 1;
    border: none;
    outline: none;
    padding: 20px;
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 32px;
    color: #000000;
    width: 100%;
    background: transparent;
}

.ag-calc-stats {
    background: #f5f5f5; /* Inverted to Bone */
    padding: 32px;
    margin-bottom: 40px;
    border: 1px solid rgba(0,0,0,0.05);
}
.ag-calc-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px;
    color: #555555;
}
.ag-calc-total {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid rgba(0,0,0,0.1);
    margin-bottom: 0;
    font-size: 18px;
    font-weight: bold;
    color: #000000;
}
.ag-calc-total span:last-child {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 40px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #000000;
    line-height: 1;
}
.ag-calc-total i {
    color: #bc9c5c;
    font-size: 32px;
}

button[type="submit"].ag-submit-btn {
    width: 100%;
    background: #000000 !important;
    color: #ffffff !important;
    border: 1px solid #000000 !important;
    font-family: Arial, sans-serif !important;
    font-size: 14px !important;
    font-weight: bold !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    padding: 24px !important;
    display: flex !important;
    justify-content: center;
    align-items: center;
    gap: 12px;
}
button[type="submit"].ag-submit-btn:hover {
    background: #ffffff !important;
    color: #000000 !important;
}

.ag-trust-note {
    text-align: center;
    margin-top: 24px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    color: #888888;
}
.ag-trust-note i {
    color: #bc9c5c;
    margin-right: 8px;
}
</style>

<div class="ag-topup-page">
    <div class="ag-container">
        
        <div class="ag-topup-head">
            <h1 class="ag-page-title">{{ __('inkwave.tu_heading') }}</h1>
            <p class="ag-page-desc">{{ __('inkwave.tu_sub') }}</p>
        </div>

        @php
            $cur = session('currency');
            if ($cur == 'JPY') {
                $tiers = [
                    ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'&yen;1 - &yen;79,999',        'f'=>false],
                    ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'&yen;80,000 - &yen;159,999',  'f'=>false],
                    ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'&yen;160,000 - &yen;239,999', 'f'=>false],
                    ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'&yen;240,000+',           'f'=>true],
                ];
            } elseif ($cur == 'HKD') {
                $tiers = [
                    ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'HK$1 - HK$3,999',       'f'=>false],
                    ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'HK$4,000 - HK$7,999',     'f'=>false],
                    ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
                    ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'HK$12,000+',           'f'=>true],
                ];
            } else {
                $tiers = [
                    ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'$1 - $499',       'f'=>false],
                    ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'$500 - $999',     'f'=>false],
                    ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'$1,000 - $1,499', 'f'=>false],
                    ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'$1,500+',         'f'=>true],
                ];
            }
        @endphp

        <div class="ag-split-grid">
            
            {{-- =========================================================
                 LEFT: Credits / Tiers Table
                 ========================================================= --}}
            <div class="ag-table-card">
                <h2 class="ag-section-title">Credit Tiers & Bonuses</h2>
                
                <div class="ag-table-wrap">
                    <table class="ag-tiers-table">
                        <thead>
                            <tr>
                                <th>Tier</th>
                                <th>Purchase Range</th>
                                <th>Bonus Multiplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tiers as $t)
                                <tr class="{{ $t['f'] ? 'vip-row' : '' }}">
                                    <td>
                                        <i class="fas {{ $t['i'] }}"></i> 
                                        <strong>{{ $t['n'] }}</strong>
                                        @if($t['f']) <span class="ag-badge">{{ __('inkwave.tu_best_value') }}</span> @endif
                                    </td>
                                    <td>{{ $t['r'] }}</td>
                                    <td><span class="ag-highlight">{{ $t['big'] }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <p class="ag-note">
                    @if(session('currency') == 'JPY')
                        {{ __('inkwave.tu_jpy_conversion_note') }}
                    @elseif(session('currency') == 'HKD')
                        {{ __('inkwave.tu_hkd_conversion_note') }}
                    @else
                        {{ __('inkwave.tu_usd_conversion_note') }}
                    @endif
                </p>
                <div class="ag-disclaimer-box">
                    <i class="fas fa-exclamation-circle"></i> 
                    <div>
                        <strong>Note:</strong> Credits purchased are strictly for use on this website and are non-transferable and non-refundable.
                    </div>
                </div>
            </div>

            {{-- =========================================================
                 RIGHT: Calculator Form
                 ========================================================= --}}
            <div>
                <div class="ag-calc-card">
                    <h2 class="ag-calc-title"><i class="fas fa-calculator"></i> {{ __('inkwave.tu_calc_title') }}</h2>
                    <p class="ag-calc-desc">{{ __('inkwave.tu_calc_tagline') }}</p>
                    
                    <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-form">
                        @csrf
                        
                        <div class="ag-form-group">
                            <label class="ag-label">{{ __('inkwave.tu_calc_input_label') }}</label>
                            <div class="ag-input-wrap">
                                <span class="ag-currency-symbol">{!! session('currency') == 'JPY' ? '&yen;' : '$' !!}</span>
                                <input type="number" name="amount" id="topup_amount" class="ag-input" placeholder="0" min="1" required>
                            </div>
                        </div>

                        <div class="ag-calc-stats">
                            <div class="ag-calc-row">
                                <span>{{ __('inkwave.tu_calc_base_points') }}:</span>
                                <span id="base_points">0</span>
                            </div>
                            <div class="ag-calc-row">
                                <span>{{ __('inkwave.tu_calc_tier_bonus') }}:</span>
                                <span id="multiplier_display">x1</span>
                            </div>
                            <div class="ag-calc-row ag-calc-total">
                                <span>{{ __('inkwave.tu_calc_youll_get') }}:</span>
                                <span><i class="fas fa-coins"></i> <span id="total_points">0</span></span>
                            </div>
                        </div>

                        <button type="submit" class="ag-submit-btn topup-btn">
                            <span>{{ __('inkwave.tu_calc_button') }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        
                        <p class="ag-trust-note">
                            <i class="fas fa-shield-alt"></i> {{ __('inkwave.tu_calc_trust_message') }}
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
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
        amountInput.addEventListener('change', calculatePoints);

        // Topup (add to cart) - submit without redirect, then reload
        const topupForms = document.querySelectorAll('.topup-form');
        topupForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const submitBtn = form.querySelector('.topup-btn');
                const originalBtnText = submitBtn.innerHTML;
                const originalBtnState = submitBtn.disabled;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';

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
@endpush
