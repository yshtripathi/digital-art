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
                <p>{{ __('inkwave.tu_calc_tagline') }}</p>
            </div>
            
            <div class="duo-tu-calc__body">
                <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-form">
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

                    <button type="submit" class="duo-tu-buybtn topup-btn">
                        <span>{{ __('inkwave.tu_calc_button') }}</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    
                    <p>
                        <i class="fas fa-shield-alt"></i> {{ __('inkwave.tu_calc_trust_message') }}
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

        // Topup (add to cart) — submit without redirect, then reload
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
