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
