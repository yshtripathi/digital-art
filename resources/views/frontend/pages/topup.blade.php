@extends('frontend.layouts.main')

@section('title', __('common.points_top_up'))

@section('main-content')
<div class="tl-breadcrumb topup-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.top_up_points') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.top_up_points') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- POINTS TOP UP SECTION - MODERN CHROMATIQUE ART DESIGN -->
<section class="points-topup-section py-6" id="topup" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ __('common.points_top_up') }}</span>
            <h2 class="modern-h2 mt-3" style="font-size: 42px; font-weight: 900; color: #0a0e27; line-height: 1.2;">{{ __('common.maximize_value') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px; font-size: 16px; color: #666;">
                {{ __('common.topup_description') }}
            </p>
        </div>

        <div class="row align-items-stretch g-5 justify-content-center">
            <!-- PREMIUM TIER TABLE -->
            <div class="col-xl-5 col-lg-6">
                <div class="premium-tier-section">
                    <!-- Section Header -->
                    <div class="tier-section-header">
                        <div class="header-icon">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                <path d="M16 2L20.123 12.038H30.879L22.378 17.962L26.501 28L16 22.076L5.499 28L9.622 17.962L1.121 12.038H11.877L16 2Z" fill="url(#tierGradient)"/>
                                <defs>
                                    <linearGradient id="tierGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#E85D8E;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#C86BFA;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="header-text">
                            <h3 class="tier-title">{{ __('common.tier_rewards') }}</h3>
                            <p class="tier-subtitle">{{ __('common.bigger_purchases') }}</p>
                        </div>
                    </div>

                    <!-- Tier Table -->
                    <div class="tier-table-wrapper">
                        <table class="tier-table">
                            <thead>
                                <tr>
                                    <th>{{ __('common.tier') }}</th>
                                    <th>{{ __('common.range') }}</th>
                                    <th>{{ __('common.bonus') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(session('currency') == 'JPY')
                                    <tr class="tier-row tier-row-1">
                                        <td class="tier-cell-tier"><span class="tier-badge">1</span> {{ __('common.tier_standard') }}</td>
                                        <td class="tier-cell-range">¥ 1 - ¥ 79,999</td>
                                        <td class="tier-cell-bonus">×1</td>
                                    </tr>
                                    <tr class="tier-row tier-row-2">
                                        <td class="tier-cell-tier"><span class="tier-badge">2</span> {{ __('common.tier_premium') }}</td>
                                        <td class="tier-cell-range">¥ 80,000 - ¥ 159,999</td>
                                        <td class="tier-cell-bonus">×1.5</td>
                                    </tr>
                                    <tr class="tier-row tier-row-3">
                                        <td class="tier-cell-tier"><span class="tier-badge">3</span> {{ __('common.tier_elite') }}</td>
                                        <td class="tier-cell-range">¥ 160,000 - ¥ 239,999</td>
                                        <td class="tier-cell-bonus">×2</td>
                                    </tr>
                                    <tr class="tier-row tier-row-4">
                                        <td class="tier-cell-tier"><span class="tier-badge">4</span> {{ __('common.tier_vip') }}</td>
                                        <td class="tier-cell-range">¥ 240,000+</td>
                                        <td class="tier-cell-bonus">×2.5</td>
                                    </tr>
                                @else
                                    <tr class="tier-row tier-row-1">
                                        <td class="tier-cell-tier"><span class="tier-badge">1</span> {{ __('common.tier_standard') }}</td>
                                        @if(session('currency') == 'HKD')
                                            <td class="tier-cell-range">HK$1 - HK$499</td>
                                        @else
                                            <td class="tier-cell-range">$1 - $499</td>
                                        @endif
                                        <td class="tier-cell-bonus">{{ __('common.none') }}</td>
                                    </tr>
                                    <tr class="tier-row tier-row-2">
                                        <td class="tier-cell-tier"><span class="tier-badge">2</span> {{ __('common.tier_premium') }}</td>
                                        @if(session('currency') == 'HKD')
                                            <td class="tier-cell-range">HK$500 - HK$999</td>
                                        @else
                                            <td class="tier-cell-range">$500 - $999</td>
                                        @endif
                                        <td class="tier-cell-bonus">×1.5</td>
                                    </tr>
                                    <tr class="tier-row tier-row-3">
                                        <td class="tier-cell-tier"><span class="tier-badge">3</span> {{ __('common.tier_elite') }}</td>
                                        @if(session('currency') == 'HKD')
                                            <td class="tier-cell-range">HK$1,000 - HK$1,499</td>
                                        @else
                                            <td class="tier-cell-range">$1,000 - $1,499</td>
                                        @endif
                                        <td class="tier-cell-bonus">×2</td>
                                    </tr>
                                    <tr class="tier-row tier-row-4">
                                        <td class="tier-cell-tier"><span class="tier-badge">4</span> {{ __('common.tier_vip') }}</td>
                                        @if(session('currency') == 'HKD')
                                            <td class="tier-cell-range">HK$1,500+</td>
                                        @else
                                            <td class="tier-cell-range">$1,500+</td>
                                        @endif
                                        <td class="tier-cell-bonus">×2.5</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="currency-note">
                        @if(session('currency') == 'JPY')
                            {{ __('common.jpy_conversion_note') }}
                        @elseif(session('currency') == 'HKD')
                            {{ __('common.hkd_conversion_note') }}
                        @else
                            {{ __('common.usd_conversion_note') }}
                        @endif
                    </div>
                </div>
            </div>

            <!-- PREMIUM LUXURY CALCULATOR -->
            <div class="col-xl-5 col-lg-6">
                <div class="luxury-calculator-wrapper">
                    <!-- Decorative background elements -->
                    <div class="calc-bg-blob calc-blob-1"></div>
                    <div class="calc-bg-blob calc-blob-2"></div>

                    <div class="luxury-calculator">
                        <!-- Header -->
                        <div class="calc-header-premium">
                            <div class="calc-header-top">
                                <h2 class="calc-title-premium">{{ __('common.sakura_calc_title') }}</h2>
                                <p class="calc-tagline">{{ __('common.sakura_calc_tagline') }}</p>
                            </div>
                            <div class="calc-currency-badge">{{ session('currency') == 'JPY' ? '¥' : '$' }}</div>
                        </div>

                        <!-- Main Form -->
                        <form action="{{ route('points.add-to-cart') }}" method="POST" class="luxury-calc-form">
                            @csrf

                            <!-- Amount Input with Premium Styling -->
                            <div class="premium-input-section">
                                <label class="input-label-premium">{{ __('common.sakura_calc_input_label') }}</label>
                                <div class="premium-amount-input-wrapper">
                                    <input
                                        type="number"
                                        name="amount"
                                        id="topup_amount"
                                        class="premium-amount-input"
                                        placeholder="0"
                                        min="1"
                                        required
                                    >
                                    <span class="input-currency">{{ session('currency') == 'JPY' ? '¥' : '$' }}</span>
                                </div>
                            </div>

                            <!-- Points Breakdown Card -->
                            <div class="points-breakdown-card">
                                <div class="breakdown-row">
                                    <span class="breakdown-label">{{ __('common.sakura_calc_base_points') }}</span>
                                    <span class="breakdown-value" id="base_points">0</span>
                                </div>
                                <div class="breakdown-row">
                                    <span class="breakdown-label">{{ __('common.sakura_calc_tier_bonus') }}</span>
                                    <span class="breakdown-value bonus-badge" id="multiplier_display">×1</span>
                                </div>
                                <div class="breakdown-divider"></div>
                                <div class="breakdown-row breakdown-total">
                                    <span class="breakdown-label">{{ __('common.sakura_calc_youll_get') }}</span>
                                    <span class="breakdown-value-total" id="total_points">0</span>
                                </div>
                            </div>

                            <!-- Large Points Display -->
                            <div class="points-display-premium">
                                <span class="points-number" id="total_points_large">0</span>
                                <span class="points-unit">{{ __('common.sakura_calc_points_unit') }}</span>
                            </div>

                            <!-- Benefits Checklist -->
                            <div class="benefits-section">
                                <div class="benefit-item">
                                    <i class="fas fa-star"></i>
                                    <span>{{ __('common.sakura_calc_benefit_access') }}</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-palette"></i>
                                    <span>{{ __('common.sakura_calc_benefit_tutorials') }}</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-crown"></i>
                                    <span>{{ __('common.sakura_calc_benefit_vip') }}</span>
                                </div>
                            </div>

                            <!-- Premium Button -->
                            <button type="submit" class="btn-premium-checkout">
                                <span class="btn-label">{{ __('common.add_to_cart') }}</span>
                                <span class="btn-icon"><i class="fas fa-arrow-right"></i></span>
                                <span class="btn-shine"></span>
                            </button>
                        </form>

                        <!-- Trust Badge -->
                        <div class="trust-indicator">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('common.sakura_calc_trust_message') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('topup_amount');
        const totalPointsDisplay = document.getElementById('total_points');
        const totalPointsLarge = document.getElementById('total_points_large');
        const basePointsDisplay = document.getElementById('base_points');
        const multiplierDisplay = document.getElementById('multiplier_display');

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

            // Update displays
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

