@extends('frontend.layouts.main')

@section('main-content')



<div class="duo-lp-wrap">
    
    {{-- 1. HERO SECTION --}}
    <section class="duo-lp-hero" id="interactiveHero">
        {{-- BACKGROUND VIDEO --}}
        <video class="duo-lp-hero__bg-video" autoplay loop muted playsinline>
            <source src="{{ asset('assets/images/v1.mp4') }}" type="video/mp4">
        </video>
        
        {{-- OVERLAY to keep text readable --}}
        <div class="duo-lp-hero__overlay"></div>

        <div class="duo-lp-mascots" id="parallaxScene">
            <i class="fas fa-book-open duo-lp-m duo-lp-m-1" data-speed="3"></i>
            <i class="fas fa-laptop duo-lp-m duo-lp-m-2" data-speed="-5"></i>
            <i class="fas fa-language duo-lp-m duo-lp-m-3" data-speed="4"></i>
            <i class="fas fa-image duo-lp-m duo-lp-m-4" data-speed="-3"></i>
        </div>
        <h1 class="duo-lp-hero__title">{{ __('inkwave.home_hero_title') }}</h1>
        <div class="duo-lp-hero__btns">
            <a href="{{ route('product-lists') }}" class="duo-lp-btn duo-lp-btn--primary">{{ __('inkwave.home_hero_btn_start') }}</a>
            @if(Auth::check())
                <a href="{{ route('user') }}" class="duo-lp-btn duo-lp-btn--outline">{{ __('inkwave.home_hero_btn_account') }}</a>
            @else
                <a href="{{ route('login.form') }}" class="duo-lp-btn duo-lp-btn--outline">{{ __('inkwave.home_hero_btn_login') }}</a>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hero = document.getElementById('interactiveHero');
            const icons = document.querySelectorAll('.duo-lp-m');

            // Parallax mouse effect
            hero.addEventListener('mousemove', (e) => {
                const x = (window.innerWidth - e.pageX * 2) / 100;
                const y = (window.innerHeight - e.pageY * 2) / 100;

                icons.forEach(icon => {
                    const speed = icon.getAttribute('data-speed');
                    const xOffset = x * speed;
                    const yOffset = y * speed;
                    
                    // We extract the original rotation from the class logic, but here we just append translate
                    // To keep it simple, we just apply transform
                    icon.style.transform = `translate(${xOffset}px, ${yOffset}px) scale(1.1)`;
                });
            });

            // Reset on mouse leave
            hero.addEventListener('mouseleave', () => {
                icons.forEach(icon => {
                    icon.style.transform = `translate(0px, 0px) scale(1)`;
                });
            });
            
            // Add click "pop" animation
            icons.forEach(icon => {
                icon.style.pointerEvents = 'auto'; // allow clicking the background icons
                icon.style.cursor = 'pointer';
                icon.style.transition = 'transform 0.2s ease-out, opacity 0.2s';
                
                icon.addEventListener('click', () => {
                    icon.style.transform = `scale(1.5) rotate(15deg)`;
                    icon.style.opacity = '1';
                    setTimeout(() => {
                        icon.style.transform = `scale(1)`;
                        icon.style.opacity = '0.25';
                    }, 300);
                });
            });
        });
    </script>

    {{-- 2. VISUAL CATEGORIES --}}
    @php
        $visualCats = \App\Models\Category::where('status','active')->where('is_parent',1)->take(5)->get();
    @endphp
    @if($visualCats->count() > 0)
    <section class="duo-lp-visual-cats">
        <h2 class="duo-lp-visual-cats__title">{{ __('inkwave.home_cat_title') }}</h2>
        <div class="duo-lp-visual-cats__grid">
            @foreach($visualCats as $cat)
                @php $cimg = $cat->photo ? explode(',', $cat->photo)[0] : null; @endphp
                <a href="{{ route('product-lists', $cat->slug) }}" class="duo-lp-vcat">
                    @if($cimg)
                        <img src="{{ url($cimg) }}" alt="{{ $cat->title }}" class="duo-lp-vcat__img" loading="lazy">
                    @else
                        <div class="duo-lp-vcat__img"><i class="fas fa-layer-group"></i></div>
                    @endif
                    <div class="duo-lp-vcat__overlay">
                        <h3 class="duo-lp-vcat__title">{{ $cat->title }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- 3. ALTERNATING FEATURE BLOCKS --}}
    <section class="duo-lp-feat duo-lp-feat--1">
        <div class="duo-lp-feat__text">
            <h2 class="duo-lp-feat__title">{{ __('inkwave.home_feat1_title') }}</h2>
            <p class="duo-lp-feat__desc">{{ __('inkwave.home_feat1_desc') }}</p>
        </div>
        <div class="duo-lp-feat__img">
            <div class="duo-lp-feat__box"><i class="fas fa-shapes"></i></div>
        </div>
    </section>

    <section class="duo-lp-feat duo-lp-feat--2">
        <div class="duo-lp-feat__text">
            <h2 class="duo-lp-feat__title">{{ __('inkwave.home_feat2_title') }}</h2>
            <p class="duo-lp-feat__desc">{{ __('inkwave.home_feat2_desc') }}</p>
        </div>
        <div class="duo-lp-feat__img">
            <div class="duo-lp-feat__box"><i class="fas fa-flask"></i></div>
        </div>
    </section>

    <section class="duo-lp-feat duo-lp-feat--3">
        <div class="duo-lp-feat__text">
            <h2 class="duo-lp-feat__title">{{ __('inkwave.home_feat3_title') }}</h2>
            <p class="duo-lp-feat__desc">{{ __('inkwave.home_feat3_desc') }}</p>
        </div>
        <div class="duo-lp-feat__img">
            <div class="duo-lp-feat__box"><i class="fas fa-fire"></i></div>
        </div>
    </section>



    {{-- 3.6 SECONDARY CAROUSEL (Products moving Right & Left) --}}
    @php
        $carouselProducts = \App\Models\Product::where('status','active')->orderBy('id','DESC')->take(8)->get();
        $carouselProductsRow2 = \App\Models\Product::where('status','active')->orderBy('id','ASC')->take(8)->get();
    @endphp
    @if($carouselProductsRow2->count() > 0)
    <div>
        {{-- Moving Left --}}
        <section class="duo-lp-strip">
            <div class="duo-lp-strip__inner">
                @for ($i = 0; $i < 2; $i++)
                    @foreach($carouselProductsRow2 as $product)
                        @php $pimg = $product->photo ? explode(',', $product->photo)[0] : null; @endphp
                        <a href="{{ route('product-detail', $product->slug) }}" class="duo-lp-course-card">
                            @if($pimg)
                                <img src="{{ url($pimg) }}" alt="{{ $product->title }}" class="duo-lp-course-card__img" loading="lazy">
                            @else
                                <div class="duo-lp-course-card__img"><i class="fas fa-book-open"></i></div>
                            @endif
                            <div class="duo-lp-course-card__title">{{ $product->title }}</div>
                        </a>
                    @endforeach
                @endfor
            </div>
        </section>
        
        {{-- Moving Right --}}
        <section class="duo-lp-strip duo-lp-strip--reverse">
            <div class="duo-lp-strip__inner">
                @for ($i = 0; $i < 2; $i++)
                    @foreach($carouselProducts as $product)
                        @php $pimg = $product->photo ? explode(',', $product->photo)[0] : null; @endphp
                        <a href="{{ route('product-detail', $product->slug) }}" class="duo-lp-course-card">
                            @if($pimg)
                                <img src="{{ url($pimg) }}" alt="{{ $product->title }}" class="duo-lp-course-card__img" loading="lazy">
                            @else
                                <div class="duo-lp-course-card__img"><i class="fas fa-book-open"></i></div>
                            @endif
                            <div class="duo-lp-course-card__title">{{ $product->title }}</div>
                        </a>
                    @endforeach
                @endfor
            </div>
        </section>
    </div>
    @endif



    {{-- 5. SUPER DUOLINGO (Credits) --}}
    <section class="duo-lp-super">
        <h2 class="duo-lp-super__title">{{ __('inkwave.home_super_title') }}</h2>
        <a href="{{ route('points.topup') }}" class="duo-lp-super__btn">{{ __('inkwave.home_super_btn') }}</a>
    </section>

    {{-- 7. TOP UP SECTION (Imported from topup.blade.php) --}}
    

    <div class="duo-tu-bg">
        <div class="duo-tu-container">
            <div class="duo-tu-head">
                <p class="duo-tu-eyebrow"><i class="fas fa-coins"></i> {{ __('inkwave.tu_eyebrow') }}</p>
                <h2 class="duo-tu-title">{{ __('inkwave.tu_heading') }}</h2>
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

    {{-- 6. ANYWHERE BLOCK --}}
    <section class="duo-lp-anywhere">
        <h2 class="duo-lp-anywhere__title">{{ __('inkwave.home_anywhere_title') }}</h2>
        <div class="duo-lp-anywhere__icons">
            <i class="fas fa-tablet-alt"></i>
            <i class="fas fa-mobile-alt"></i>
            <i class="fas fa-laptop"></i>
            <i class="fas fa-desktop"></i>
        </div>
    </section>

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
