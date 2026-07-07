@extends('frontend.layouts.main')

@section('main-content')

<section class="modern-hero">
    <!-- Background Video -->
    <video class="hero-bg-video" autoplay muted loop playsinline preload="auto">
        <source src="{{ asset('assets/images/h3.webm') }}" type="video/webm">
    </video>
    <div class="hero-overlay"></div>

    <!-- Split hero: text left, image collage right -->
    <div class="auto-container hero-split relative z-10">
        <div class="hero-col hero-col--text">
            <div class="hero-badge-wrapper">
                <span class="hero-badge">{{ __('common.digital_art') ?? 'Digital Art' }}</span>
                <span class="hero-badge">{{ __('inkwave.hero_badge') }}</span>
                <div class="hero-mini-tag">
                    <span class="pulse-dot"></span>
                    <span>{!! __('inkwave.hero_mini_tag') !!}</span>
                </div>
            </div>
            <h1 class="modern-h1">{!! __('inkwave.hero_title_html') !!}</h1>
            <p class="hero-subtitle">{{ __('inkwave.hero_subtitle') }}</p>
            <div class="hero-cta-buttons">
                <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-solid">{{ __('inkwave.hero_btn_primary') }} <i class="fas fa-arrow-right ms-2"></i></a>
                <a href="{{ route('contact') }}" class="modern-btn modern-btn-outline">{{ __('inkwave.hero_btn_secondary') }}</a>
            </div>
        </div>

        <div class="hero-col hero-col--media">
            <div class="hero-collage">
                <figure class="hero-collage__item" style="--d: 0s"><img src="{{ asset('assets/images/i2.webp') }}" alt="Modern ukiyo-e dragon print"></figure>
                <figure class="hero-collage__item" style="--d: .5s"><img src="{{ asset('assets/images/i6.webp') }}" alt="Pop-art print"></figure>
                <figure class="hero-collage__item" style="--d: 1s"><img src="{{ asset('assets/images/i5.webp') }}" alt="White tiger ukiyo-e print"></figure>
                <figure class="hero-collage__item" style="--d: .25s"><img src="{{ asset('assets/images/i3.webp') }}" alt="Anime portrait print"></figure>
                <figure class="hero-collage__item" style="--d: .75s"><img src="{{ asset('assets/images/i4.webp') }}" alt="Neon street-art print"></figure>
                <figure class="hero-collage__item" style="--d: 1.25s"><img src="{{ asset('assets/images/i7.webp') }}" alt="Moonlit street-art print"></figure>
            </div>
        </div>
    </div>
</section>




<!-- ==============================================
     INKWAVE / DIGITAL ART PREMIUM SECTIONS
     ============================================== -->

<!-- SECTION 2: Category Cards -->
<section class="inkwave-categories" style="background-color: var(--color-bone, #e7e5e4); border-top: 1px solid var(--color-vellum, #dfdcd5);">
    <div class="auto-container">
        <div class="cat-section-head">
            <p class="cat-eyebrow">{{ __('inkwave.cat_eyebrow') }}</p>
            <h2 class="cat-heading">{{ __('inkwave.cat_heading') }}</h2>
        </div>

        @php
            $featuredCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
        @endphp
        
        <div class="cat-grid">
            @forelse($featuredCategories as $cat)
                <a href="{{ route('product-lists', $cat->slug) }}" class="cat-card" aria-label="{{ $cat->title }}">
                    @if($cat->photo)
                        <img src="{{ $cat->photo }}" alt="{{ $cat->title }}" class="cat-card__img">
                    @else
                        <span class="cat-card__placeholder"><i class="fas fa-palette"></i></span>
                    @endif
                    <span class="cat-card__veil" aria-hidden="true"></span>
                    <span class="cat-card__content">
                        <span class="cat-card__title">{{ $cat->title }}</span>
                        @if($cat->summary)
                            <span class="cat-card__summary">{{ $cat->summary }}</span>
                        @endif
                    </span>
                </a>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open mb-3" style="font-size: 48px; color: #E85D8E; opacity: 0.5;"></i>
                    <p style="color: #666; font-size: 15px;">{{ __('inkwave.prod_empty') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>



<!-- SECTION 2: How It Works -->
<section class="inkwave-how-it-works py-120" style="background-color: var(--color-putty, #c4c3b6);">
    <div class="auto-container">
        <div class="steps-head">
            <p class="steps-eyebrow">{{ __('inkwave.process_eyebrow') }}</p>
            <h2 class="steps-heading">{{ __('inkwave.process_heading') }}</h2>
            <p class="steps-sub">{{ __('inkwave.process_sub') }}</p>
        </div>

        <div class="steps-grid">
            <div class="step-card">
                <span class="step-num">{{ __('inkwave.step1_num') }}</span>
                <h3 class="step-title">{{ __('inkwave.step1_title') }}</h3>
                <p class="step-desc">{{ __('inkwave.step1_desc') }}</p>
            </div>
            <div class="step-card">
                <span class="step-num">{{ __('inkwave.step2_num') }}</span>
                <h3 class="step-title">{{ __('inkwave.step2_title') }}</h3>
                <p class="step-desc">{{ __('inkwave.step2_desc') }}</p>
            </div>
            <div class="step-card">
                <span class="step-num">{{ __('inkwave.step3_num') }}</span>
                <h3 class="step-title">{{ __('inkwave.step3_title') }}</h3>
                <p class="step-desc">{{ __('inkwave.step3_desc') }}</p>
            </div>
        </div>
    </div>
</section>



<!-- SECTION 4: Products Carousel -->
<section class="inkwave-products" style="background-color: var(--color-bone, #e7e5e4);">
    <div class="prod-head">
        <p class="prod-eyebrow">{{ __('inkwave.prod_eyebrow') }}</p>
        <h2 class="prod-heading">{{ __('inkwave.prod_heading') }}</h2>
    </div>

    @php
        $carouselProducts = \App\Models\Product::with('levels')->where('status','active')->orderBy('id','DESC')->get();
    @endphp

    <div class="prod-carousel">
        <button class="prod-nav prod-nav--prev" type="button" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>

        <div class="prod-track" id="prodTrack">
            @forelse($carouselProducts as $product)
                @php $pimg = $product->photo ? explode(',', $product->photo)[0] : null; @endphp
                <a href="{{ route('product-detail', $product->slug) }}" class="prod-slide">
                    <div class="prod-slide__img">
                        @if($pimg)
                            <img src="{{ url($pimg) }}" alt="{{ $product->title }}" loading="lazy">
                        @else
                            <span class="prod-slide__ph"><i class="fas fa-image"></i></span>
                        @endif
                    </div>
                    <h3 class="prod-slide__title">{{ $product->title }}</h3>
                    @if($product->levels && $product->levels->count() > 0)
                        <p class="prod-slide__price">
                            {{ __('inkwave.starting_from') }} <strong>{{ number_format($product->levels->min('price_in_points')) }}</strong> {{ __('inkwave.pd_credits') }}
                        </p>
                    @endif
                </a>
            @empty
                <p class="prod-empty">{{ __('inkwave.prod_empty') }}</p>
            @endforelse
        </div>

        <button class="prod-nav prod-nav--next" type="button" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>



<script>
    (function () {
        var track = document.getElementById('prodTrack');
        if (!track) return;
        var prev = document.querySelector('.prod-nav--prev');
        var next = document.querySelector('.prod-nav--next');
        function page() {
            var slide = track.querySelector('.prod-slide');
            var w = slide ? slide.offsetWidth + 20 : track.clientWidth * 0.8;
            var visible = Math.max(1, Math.floor(track.clientWidth / w));
            return w * visible;
        }
        if (next) next.addEventListener('click', function () { track.scrollBy({ left: page(), behavior: 'smooth' }); });
        if (prev) prev.addEventListener('click', function () { track.scrollBy({ left: -page(), behavior: 'smooth' }); });
    })();
</script>

<!-- POINTS TOP UP SECTION - PREMIUM LUXURY DESIGN -->
<section class="points-topup-section py-6" id="topup" style="background-color: var(--color-putty, #c4c3b6);">
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









<script>
    (function () {
        document.querySelectorAll('.tier-card__btn[data-topup-focus]').forEach(function (b) {
            b.addEventListener('click', function () {
                var a = document.getElementById('topup_amount');
                if (a) {
                    a.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    setTimeout(function () { a.focus(); }, 350);
                }
            });
        });
    })();
</script>

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

        // Handle premium top-up form submission without redirect
        const topupForm = document.querySelector('.luxury-calc-form');
        if (topupForm) {
            topupForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitBtn = topupForm.querySelector('.btn-premium-checkout');
                const btnLabel = submitBtn.querySelector('.btn-label');
                const btnIcon = submitBtn.querySelector('.btn-icon');
                const originalBtnText = btnLabel ? btnLabel.innerHTML : 'Checkout';
                const originalBtnIcon = btnIcon ? btnIcon.innerHTML : '';

                // Show loading state
                submitBtn.disabled = true;
                if (btnLabel) btnLabel.innerHTML = 'Loading...';
                if (btnIcon) btnIcon.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                // Fetch the form
                fetch(topupForm.action, {
                    method: 'POST',
                    body: new FormData(topupForm),
                    redirect: 'manual'
                })
                .then(response => {
                    // Wait 500ms for cart update to complete
                    return new Promise(resolve => {
                        setTimeout(() => {
                            resolve(response);
                        }, 500);
                    });
                })
                .then(response => {
                    // Reload the page to show success message
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Reset button state on error
                    submitBtn.disabled = false;
                    if (btnLabel) btnLabel.innerHTML = originalBtnText;
                    if (btnIcon) btnIcon.innerHTML = originalBtnIcon;
                });
            });
        }
    });
</script>





@endsection
