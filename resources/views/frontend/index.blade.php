@extends('frontend.layouts.main')

@section('main-content')



<div class="duo-lp-wrap">
    
    {{-- 1. HERO SECTION --}}
    

    <section class="art-hero" style="background-image: url('{{ asset('assets/images/hero.webp') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="art-hero-container">
            <div class="art-hero-left">
                <video autoplay loop muted playsinline>
                    <source src="{{ asset('assets/videos/hero.webm') }}" type="video/webm">
                </video>
            </div>
            <div class="art-hero-right">
                <h1>{{ __('managenovax.home.hero_title') }}</h1>
                <p>{{ __('managenovax.home.hero_desc') }}</p>
                <div class="art-hero-btns">
                    <a href="{{ route('product-lists') }}" class="art-hero-btn">{{ __('managenovax.home.hero_btn_start') }}</a>
                    @if(Auth::check())
                        <a href="{{ route('user') }}" class="art-hero-btn art-hero-btn-outline">{{ __('managenovax.home.hero_btn_account') }}</a>
                    @else
                        <a href="{{ route('login.form') }}" class="art-hero-btn art-hero-btn-outline">{{ __('managenovax.home.hero_btn_login') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- 1.5 ABOUT / COLLAGE SECTION --}}
    

    <section class="art-about">
        <div class="art-about-container">
            <div class="art-about-left">
                <img src="{{ asset('assets/images/hero-1.webp') }}" alt="Art Course" class="art-about-img art-about-img-1" loading="lazy">
                <img src="{{ asset('assets/images/hero-2.webp') }}" alt="Art Materials" class="art-about-img art-about-img-2" loading="lazy">
                <img src="{{ asset('assets/images/hero-3.webp') }}" alt="Student Working" class="art-about-img art-about-img-3" loading="lazy">
            </div>
            <div class="art-about-right">
                <h2>{{ __('managenovax.home.about_title') }}</h2>
                <p>{{ __('managenovax.home.about_desc_1') }}</p>
                <p>{{ __('managenovax.home.about_desc_2') }}</p>
                <ul class="art-about-list">
                    <li><i class="fas fa-check-circle"></i> {!! __('managenovax.home.about_feat_1') !!}</li>
                    <li><i class="fas fa-check-circle"></i> {!! __('managenovax.home.about_feat_2') !!}</li>
                    <li><i class="fas fa-check-circle"></i> {!! __('managenovax.home.about_feat_3') !!}</li>
                </ul>
                <a href="{{ route('product-lists') }}" class="art-hero-btn">{{ __('managenovax.home.about_btn') }}</a>
            </div>
        </div>
    </section>

    {{-- 2. PRODUCTS CAROUSEL --}}
    @php
        $visualProducts = \App\Models\Product::where('status','active')->get();
    @endphp
    @if($visualProducts->count() > 0)
    

    <section class="art-cat-carousel-section">
        <h2>{{ __('managenovax.home.products_title') }}</h2>
        <div class="art-cat-layout">
            <button class="art-cat-nav-btn" id="artCatPrevBtn" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
            <div class="art-cat-scroll-container" id="artCatScrollContainer">
                @foreach($visualProducts as $product)
                    @php 
                        $pimg = $product->photo ? explode(',', $product->photo)[0] : null; 
                    @endphp
                    <div class="art-cat-scroll-card">
                        <div class="art-cat-scroll-img">
                            @if($pimg)
                                <img src="{{ url($pimg) }}" alt="{{ $product->title }}" loading="lazy">
                            @else
                                <div class="placeholder"><i class="fas fa-layer-group"></i></div>
                            @endif
                        </div>
                        <div class="art-cat-scroll-content">
                            <h3>{{ $product->title }}</h3>
                            <p>{{ $product->summary ?? \Illuminate\Support\Str::limit(strip_tags($product->description), 100, '...') }}</p>
                            <a href="{{ route('product-detail', $product->slug) }}" class="art-hero-btn">{{ __('managenovax.home.products_btn') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="art-cat-nav-btn" id="artCatNextBtn" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const scrollContainer = document.getElementById('artCatScrollContainer');
            const prevBtn = document.getElementById('artCatPrevBtn');
            const nextBtn = document.getElementById('artCatNextBtn');
            if(scrollContainer && prevBtn && nextBtn) {
                // Calculate scroll amount dynamically based on card width + gap
                const scrollAmount = () => {
                    const card = scrollContainer.querySelector('.art-cat-scroll-card');
                    return card ? card.offsetWidth + 30 : 400; // 30 is the gap
                };

                prevBtn.addEventListener('click', () => {
                    scrollContainer.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
                });
                nextBtn.addEventListener('click', () => {
                    scrollContainer.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
                });
            }
        });
    </script>
    @endif

    {{-- 3. HOW IT WORKS (CARDS) --}}
    

    <section class="art-how-section">
        <h2 class="art-how-title">{{ __('managenovax.home.steps_title') }}</h2>
        <div class="art-how-grid">
            <div class="art-how-card">
                <div class="art-how-icon">
                    <i class="fas fa-compass"></i>
                </div>
                <h3>{{ __('managenovax.home.steps_1_title') }}</h3>
                <p>{{ __('managenovax.home.steps_1_desc') }}</p>
            </div>
            <div class="art-how-card">
                <div class="art-how-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <h3>{{ __('managenovax.home.steps_2_title') }}</h3>
                <p>{{ __('managenovax.home.steps_2_desc') }}</p>
            </div>
            <div class="art-how-card">
                <div class="art-how-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h3>{{ __('managenovax.home.steps_3_title') }}</h3>
                <p>{{ __('managenovax.home.steps_3_desc') }}</p>
            </div>
        </div>
    </section>




        {{-- 6. INSPIRATION GALLERY (Remaining Assets) --}}
    
    <section class="art-inspiration-section">
        <h2>{{ __('managenovax.home.inspire_title') }}</h2>
        <p>{{ __('managenovax.home.inspire_desc') }}</p>
        <div class="art-insp-grid">
            <div class="art-insp-item">
                <video src="{{ asset('assets/videos/inspire.webm') }}" autoplay loop muted playsinline></video>
            </div>
            <div class="art-insp-item">
                <img src="{{ asset('assets/images/hero-4.webp') }}" alt="Creative Inspiration" loading="lazy">
            </div>
        </div>
    </section>

    {{-- 5. TOP UP SECTION (Imported from topup.blade.php) --}}
    

    <div class="ag-topup-page">
        <div class="ag-container">
            
            <div class="ag-topup-head">
                <h2 class="ag-page-title">{{ __('managenovax.credits.pg_title') }}</h2>
                <p class="ag-page-desc">{{ __('managenovax.credits.pg_desc') }}</p>
            </div>

            @php
                $cur = session('currency');
                if ($cur == 'JPY') {
                    $tiers = [
                        ['n'=>__('managenovax.credits.tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'&yen;1 - &yen;79,999',        'f'=>false],
                        ['n'=>__('managenovax.credits.tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'&yen;80,000 - &yen;159,999',  'f'=>false],
                        ['n'=>__('managenovax.credits.tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'&yen;160,000 - &yen;239,999', 'f'=>false],
                        ['n'=>__('managenovax.credits.tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'&yen;240,000+',           'f'=>true],
                    ];
                } elseif ($cur == 'HKD') {
                    $tiers = [
                        ['n'=>__('managenovax.credits.tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'HK$1 - HK$3,999',       'f'=>false],
                        ['n'=>__('managenovax.credits.tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'HK$4,000 - HK$7,999',     'f'=>false],
                        ['n'=>__('managenovax.credits.tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
                        ['n'=>__('managenovax.credits.tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'HK$12,000+',           'f'=>true],
                    ];
                } else {
                    $tiers = [
                        ['n'=>__('managenovax.credits.tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'$1 - $499',       'f'=>false],
                        ['n'=>__('managenovax.credits.tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'$500 - $999',     'f'=>false],
                        ['n'=>__('managenovax.credits.tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'$1,000 - $1,499', 'f'=>false],
                        ['n'=>__('managenovax.credits.tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'$1,500+',         'f'=>true],
                    ];
                }
            @endphp

            <div class="ag-split-grid">
                
                <div class="ag-table-card">
                    <h2 class="ag-section-title">{{ __('managenovax.credits.table_title') }}</h2>
                    
                    <div class="ag-table-wrap">
                        <table class="ag-tiers-table">
                            <thead>
                                <tr>
                                    <th>{{ __('managenovax.credits.table_col1') }}</th>
                                    <th>{{ __('managenovax.credits.table_col2') }}</th>
                                    <th>{{ __('managenovax.credits.table_col3') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tiers as $t)
                                    <tr class="{{ $t['f'] ? 'vip-row' : '' }}">
                                        <td>
                                            <i class="fas {{ $t['i'] }}"></i> 
                                            <strong>{{ $t['n'] }}</strong>
                                            @if($t['f']) <span class="ag-badge">{{ __('managenovax.credits.best_value') }}</span> @endif
                                        </td>
                                        <td>{!! $t['r'] !!}</td>
                                        <td><span class="ag-highlight">{{ $t['big'] }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <p class="ag-note">
                        @if(session('currency') == 'JPY')
                            {{ __('managenovax.credits.jpy_note') }}
                        @elseif(session('currency') == 'HKD')
                            {{ __('managenovax.credits.hkd_note') }}
                        @else
                            {{ __('managenovax.credits.usd_note') }}
                        @endif
                    </p>
                    <div class="ag-disclaimer-box">
                        <i class="fas fa-exclamation-circle"></i> 
                        <div>
                            <strong>{{ __('managenovax.credits.disclaimer_title') }}</strong> {{ __('managenovax.credits.disclaimer_text') }}
                        </div>
                    </div>
                </div>

                <div>
                    <div class="ag-calc-card">
                        <h2 class="ag-calc-title"><i class="fas fa-calculator"></i> {{ __('managenovax.credits.calc_title') }}</h2>
                        <p class="ag-calc-desc">{{ __('managenovax.credits.calc_desc') }}</p>
                        
                        <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-form">
                            @csrf
                            
                            <div class="ag-form-group">
                                <label class="ag-label">{{ __('managenovax.credits.calc_label') }}</label>
                                <div class="ag-input-wrap">
                                    <span class="ag-currency-symbol">{!! session('currency') == 'JPY' ? '&yen;' : '$' !!}</span>
                                    <input type="number" name="amount" id="topup_amount" class="ag-input" placeholder="0" min="1" required>
                                </div>
                            </div>

                            <div class="ag-calc-stats">
                                <div class="ag-calc-row">
                                    <span>{{ __('managenovax.credits.calc_base') }}:</span>
                                    <span id="base_points">0</span>
                                </div>
                                <div class="ag-calc-row">
                                    <span>{{ __('managenovax.credits.calc_bonus') }}:</span>
                                    <span id="multiplier_display">x1</span>
                                </div>
                                <div class="ag-calc-row ag-calc-total">
                                    <span>{{ __('managenovax.credits.calc_total') }}:</span>
                                    <span><i class="fas fa-coins"></i> <span id="total_points">0</span></span>
                                </div>
                            </div>

                            <button type="submit" class="ag-submit-btn topup-btn">
                                <span>{{ __('managenovax.credits.calc_btn') }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                            
                            <p class="ag-trust-note">
                                <i class="fas fa-shield-alt"></i> {{ __('managenovax.credits.trust_msg') }}
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>



</div>
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
            if(multiplierDisplay) multiplierDisplay.textContent = multiplier === 1 ? '×1' : '×' + multiplier.toFixed(1);
            if(totalPointsDisplay) totalPointsDisplay.textContent = totalPoints.toLocaleString();
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

@endsection
