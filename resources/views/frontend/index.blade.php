@extends('frontend.layouts.main')

@section('main-content')

<style>
/* -------------------------------------------
   Duolingo Theme Landing Page - Artora
------------------------------------------- */
.duo-lp-wrap { font-family: 'Nunito', 'Nunito Sans', sans-serif; background: #ffffff; overflow: hidden; padding-top: 48px; }
.duo-lp-wrap a { text-decoration: none !important; }

/* HERO */
.duo-lp-hero { text-align: center; padding: 64px 24px 100px 24px; position: relative; max-width: 800px; margin: 0 auto; }
.duo-lp-hero__title { font-size: 48px; font-weight: 800; color: var(--color-charcoal, #4b4b4b); margin-bottom: 48px; line-height: 1.2; }
.duo-lp-hero__btns { display: flex; flex-direction: column; gap: 16px; align-items: center; max-width: 320px; margin: 0 auto; }
.duo-lp-btn { width: 100%; display: block; border-radius: 16px; padding: 16px; font-size: 16px; font-weight: 800; text-transform: uppercase; cursor: pointer; border: none; transition: all 0.1s; text-align: center; box-sizing: border-box; }
.duo-lp-btn--primary { background: var(--color-eager-green, #58cc02); color: #ffffff !important; border: 2px solid #46a302; box-shadow: 0 4px 0 #46a302; }
.duo-lp-btn--primary:hover { filter: brightness(1.05); }
.duo-lp-btn--primary:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }
.duo-lp-btn--outline { background: #ffffff; color: var(--color-spark-blue, #1cb0f6) !important; border: 2px solid #e5e5e5; box-shadow: 0 4px 0 #e5e5e5; }
.duo-lp-btn--outline:hover { background: #f7f7f7; }
.duo-lp-btn--outline:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }

/* DECORATIVE ICONS */
.duo-lp-mascots { position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: -1; }
.duo-lp-m { position: absolute; font-size: 80px; opacity: 0.15; }
.duo-lp-m-1 { top: 10%; left: -10%; transform: rotate(-15deg); color: var(--color-spark-blue); }
.duo-lp-m-2 { top: 50%; left: -5%; transform: rotate(10deg); color: var(--color-cardinal); }
.duo-lp-m-3 { top: 0%; right: -10%; transform: rotate(20deg); color: var(--color-macaw-yellow); }
.duo-lp-m-4 { top: 60%; right: -5%; transform: rotate(-10deg); color: var(--color-eager-green); }
@media(max-width: 900px) { .duo-lp-mascots { display: none; } }

/* CAROUSEL */
.duo-lp-strip { border-top: 2px solid #e5e5e5; border-bottom: 2px solid #e5e5e5; padding: 24px 0; overflow: hidden; white-space: nowrap; position: relative; }
.duo-lp-strip__inner { display: inline-flex; gap: 48px; padding: 0 24px; animation: duoScroll 30s linear infinite; }
.duo-lp-strip:hover .duo-lp-strip__inner { animation-play-state: paused; }
@keyframes duoScroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
.duo-lp-course { display: inline-flex; align-items: center; gap: 12px; font-size: 18px; font-weight: 800; color: var(--color-pencil-gray); cursor: pointer; transition: color 0.1s; }
.duo-lp-course:hover { color: var(--color-spark-blue); }
.duo-lp-course__img { width: 48px; height: 32px; border-radius: 8px; background: #f7f7f7; display: flex; align-items: center; justify-content: center; overflow: hidden; color: var(--color-spark-blue); border: 2px solid #e5e5e5; }
.duo-lp-course__img img { width: 100%; height: 100%; object-fit: cover; }

/* FEATURE BLOCKS */
.duo-lp-feat { padding: 100px 24px; max-width: 1000px; margin: 0 auto; display: flex; align-items: center; gap: 64px; }
.duo-lp-feat:nth-child(even) { flex-direction: row-reverse; }
@media (max-width: 768px) { .duo-lp-feat, .duo-lp-feat:nth-child(even) { flex-direction: column; text-align: center; gap: 32px; padding: 64px 24px; } }
.duo-lp-feat__text { flex: 1; }
.duo-lp-feat__title { font-size: 40px; font-weight: 800; margin-bottom: 16px; }
.duo-lp-feat__desc { font-size: 18px; font-weight: 700; color: var(--color-pencil-gray); line-height: 1.6; }
.duo-lp-feat__img { flex: 1; display: flex; justify-content: center; }
.duo-lp-feat__box { width: 300px; height: 300px; border-radius: 48px; display: flex; align-items: center; justify-content: center; font-size: 120px; box-shadow: 0 16px 0 rgba(0,0,0,0.05); }

.duo-lp-feat--1 .duo-lp-feat__title { color: var(--color-eager-green); }
.duo-lp-feat--1 .duo-lp-feat__box { background: #d7ffb8; color: var(--color-eager-green); }

.duo-lp-feat--2 .duo-lp-feat__title { color: var(--color-spark-blue); }
.duo-lp-feat--2 .duo-lp-feat__box { background: #eaf7ff; color: var(--color-spark-blue); }

.duo-lp-feat--3 .duo-lp-feat__title { color: var(--color-macaw-yellow); }
.duo-lp-feat--3 .duo-lp-feat__box { background: #fff4cc; color: var(--color-macaw-yellow); }

/* ANYWHERE BLOCK */
.duo-lp-anywhere { background: #eaf7ff; padding: 100px 24px; text-align: center; overflow: hidden; position: relative; }
.duo-lp-anywhere__title { font-size: 48px; font-weight: 800; color: var(--color-spark-blue); margin-bottom: 48px; position: relative; z-index: 2; }
.duo-lp-anywhere__icons { display: flex; justify-content: center; flex-wrap: wrap; gap: 48px; font-size: 80px; color: var(--color-spark-blue); opacity: 0.7; position: relative; z-index: 1; }
.duo-lp-anywhere__icons i { transition: transform 0.3s; }
.duo-lp-anywhere__icons i:hover { transform: scale(1.2) rotate(10deg); }

/* SUPER BLOCK */
.duo-lp-super { background: #1a1a2e; padding: 100px 24px; text-align: center; color: #ffffff; }
.duo-lp-super__title { font-size: 40px; font-weight: 800; margin-bottom: 32px; font-style: italic; background: linear-gradient(90deg, #ffc800, #ff4b4b); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.duo-lp-super__btn { display: inline-block; background: transparent; border: 2px solid #ffffff; color: #ffffff !important; font-size: 16px; font-weight: 800; text-transform: uppercase; padding: 16px 32px; border-radius: 16px; transition: all 0.1s; }
.duo-lp-super__btn:hover { background: rgba(255,255,255,0.1); transform: translateY(-2px); }

/* SUB-BRANDS (CATEGORIES) */
.duo-lp-cats { padding: 100px 24px; max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 48px; }
.duo-lp-cat { border: 2px solid #e5e5e5; border-radius: 32px; padding: 32px; text-align: center; box-shadow: 0 8px 0 #e5e5e5; transition: transform 0.1s, box-shadow 0.1s; display: block; background: #ffffff; }
.duo-lp-cat:hover { transform: translateY(-4px); box-shadow: 0 12px 0 #e5e5e5; }
.duo-lp-cat__icon { font-size: 64px; margin-bottom: 24px; color: var(--color-spark-blue); }
.duo-lp-cat__title { font-size: 24px; font-weight: 800; color: var(--color-charcoal); margin-bottom: 12px; }
.duo-lp-cat__desc { font-size: 16px; font-weight: 700; color: var(--color-pencil-gray); }

/* BOTTOM CTA */
.duo-lp-cta { background: var(--color-eager-green); padding: 100px 24px; text-align: center; }
.duo-lp-cta__title { font-size: 48px; font-weight: 800; color: #ffffff; margin-bottom: 48px; }
.duo-lp-cta .duo-lp-btn--outline { max-width: 300px; margin: 0 auto; color: var(--color-eager-green) !important; border-color: #ffffff; box-shadow: 0 4px 0 #46a302; }
</style>

<div class="duo-lp-wrap">
    
    {{-- 1. HERO SECTION --}}
    <section class="duo-lp-hero">
        <div class="duo-lp-mascots">
            <i class="fas fa-palette duo-lp-m duo-lp-m-1"></i>
            <i class="fas fa-paint-brush duo-lp-m duo-lp-m-2"></i>
            <i class="fas fa-pen-nib duo-lp-m duo-lp-m-3"></i>
            <i class="fas fa-image duo-lp-m duo-lp-m-4"></i>
        </div>
        <h1 class="duo-lp-hero__title">The free, fun, and effective way to learn digital art!</h1>
        <div class="duo-lp-hero__btns">
            <a href="{{ route('product-lists') }}" class="duo-lp-btn duo-lp-btn--primary">Get Started</a>
            @if(Auth::check())
                <a href="{{ route('user') }}" class="duo-lp-btn duo-lp-btn--outline">My Account</a>
            @else
                <a href="{{ route('login.form') }}" class="duo-lp-btn duo-lp-btn--outline">I already have an account</a>
            @endif
        </div>
    </section>

    {{-- 2. CAROUSEL (Products) --}}
    @php
        $carouselProducts = \App\Models\Product::where('status','active')->orderBy('id','DESC')->take(8)->get();
    @endphp
    @if($carouselProducts->count() > 0)
    <section class="duo-lp-strip">
        <div class="duo-lp-strip__inner">
            {{-- Duplicate loop twice for seamless scrolling effect --}}
            @for ($i = 0; $i < 2; $i++)
                @foreach($carouselProducts as $product)
                    @php $pimg = $product->photo ? explode(',', $product->photo)[0] : null; @endphp
                    <a href="{{ route('product-detail', $product->slug) }}" class="duo-lp-course">
                        <div class="duo-lp-course__img">
                            @if($pimg)
                                <img src="{{ url($pimg) }}" alt="{{ $product->title }}" loading="lazy">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        {{ $product->title }}
                    </a>
                @endforeach
            @endfor
        </div>
    </section>
    @endif

    {{-- 3. ALTERNATING FEATURE BLOCKS --}}
    <section class="duo-lp-feat duo-lp-feat--1">
        <div class="duo-lp-feat__text">
            <h2 class="duo-lp-feat__title">free. fun. effective.</h2>
            <p class="duo-lp-feat__desc">{{ __('inkwave.step1_desc') ?? 'Learning with Artora is fun, and research shows that it works! With quick, bite-sized lessons, you’ll earn points and unlock new levels while gaining real-world skills.' }}</p>
        </div>
        <div class="duo-lp-feat__img">
            <div class="duo-lp-feat__box"><i class="fas fa-shapes"></i></div>
        </div>
    </section>

    <section class="duo-lp-feat duo-lp-feat--2">
        <div class="duo-lp-feat__text">
            <h2 class="duo-lp-feat__title">backed by science</h2>
            <p class="duo-lp-feat__desc">{{ __('inkwave.step2_desc') ?? 'We use a combination of research-backed teaching methods and delightful content to create courses that effectively teach drawing, painting, and digital art skills!' }}</p>
        </div>
        <div class="duo-lp-feat__img">
            <div class="duo-lp-feat__box"><i class="fas fa-flask"></i></div>
        </div>
    </section>

    <section class="duo-lp-feat duo-lp-feat--3">
        <div class="duo-lp-feat__text">
            <h2 class="duo-lp-feat__title">stay motivated</h2>
            <p class="duo-lp-feat__desc">{{ __('inkwave.step3_desc') ?? 'We make it easy to form a habit of learning with game-like features, fun challenges, and reminders to keep you on track.' }}</p>
        </div>
        <div class="duo-lp-feat__img">
            <div class="duo-lp-feat__box"><i class="fas fa-fire-alt"></i></div>
        </div>
    </section>

    {{-- 4. ANYWHERE BLOCK --}}
    <section class="duo-lp-anywhere">
        <h2 class="duo-lp-anywhere__title">learn anytime, anywhere</h2>
        <div class="duo-lp-anywhere__icons">
            <i class="fas fa-tablet-alt"></i>
            <i class="fas fa-mobile-alt"></i>
            <i class="fas fa-laptop"></i>
            <i class="fas fa-desktop"></i>
        </div>
    </section>

    {{-- 5. SUPER DUOLINGO (Credits) --}}
    <section class="duo-lp-super">
        <h2 class="duo-lp-super__title">POWER UP WITH CREDITS</h2>
        <a href="{{ route('points.topup') }}" class="duo-lp-super__btn">Try a Top-Up Package</a>
    </section>

    {{-- 6. SUB-BRANDS (Categories) --}}
    @php
        $featuredCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->take(3)->get();
    @endphp
    @if($featuredCategories->count() > 0)
    <div style="background-color: #f7f7f7; padding: 1px 0;">
        <section class="duo-lp-cats">
            @foreach($featuredCategories as $cat)
                <a href="{{ route('product-lists', $cat->slug) }}" class="duo-lp-cat">
                    <div class="duo-lp-cat__icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h3 class="duo-lp-cat__title">artora {{ strtolower($cat->title) }}</h3>
                    <p class="duo-lp-cat__desc">Explore our top-rated courses and expand your skills in {{ $cat->title }}.</p>
                </a>
            @endforeach
        </section>
    </div>
    @endif

    {{-- 7. TOP UP SECTION (Imported from topup.blade.php) --}}
    <style>
    .duo-tu-bg { background-color: #eaf7ff; padding: 2px 0; }
    .duo-tu-container { max-width: 1200px; margin: 48px auto; padding: 100px 24px; }
    .duo-tu-head { text-align: center; margin-bottom: 64px; }
    .duo-tu-eyebrow { font-size: 16px; font-weight: 800; text-transform: uppercase; color: var(--color-spark-blue, #1cb0f6); letter-spacing: 0.1em; margin-bottom: 16px; }
    .duo-tu-title { font-size: 48px; font-weight: 800; color: var(--color-charcoal, #4b4b4b); margin-bottom: 16px; letter-spacing: -0.5px; }
    .duo-tu-sub { font-size: 20px; font-weight: 700; color: var(--color-pencil-gray, #777777); max-width: 600px; margin: 0 auto; }
    .duo-tu-tiers { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 32px; margin-bottom: 32px; }
    .duo-tu-card { background: #ffffff; border: 2px solid #e5e5e5; border-radius: 24px; padding: 40px 24px 32px; text-align: center; box-shadow: 0 8px 0 #e5e5e5; position: relative; transition: transform 0.1s, box-shadow 0.1s; display: flex; flex-direction: column; }
    .duo-tu-card--vip { border-color: var(--color-macaw-yellow, #ffc800); box-shadow: 0 8px 0 var(--color-macaw-yellow, #ffc800); background: #fffcf0; }
    .duo-tu-card:hover { transform: translateY(4px); box-shadow: 0 4px 0 #e5e5e5; }
    .duo-tu-card--vip:hover { box-shadow: 0 4px 0 var(--color-macaw-yellow, #ffc800); }
    .duo-tu-card__flag { position: absolute; top: -16px; left: 50%; transform: translateX(-50%); background: var(--color-macaw-yellow, #ffc800); color: #ffffff; font-size: 14px; font-weight: 800; text-transform: uppercase; padding: 6px 16px; border-radius: 12px; border: 2px solid #ffffff; box-shadow: 0 4px 0 rgba(0,0,0,0.1); white-space: nowrap; }
    .duo-tu-card__icon { font-size: 48px; color: var(--color-spark-blue, #1cb0f6); margin-bottom: 16px; display: block; }
    .duo-tu-card--vip .duo-tu-card__icon { color: var(--color-macaw-yellow, #ffc800); }
    .duo-tu-card__name { font-size: 24px; font-weight: 800; color: var(--color-charcoal, #4b4b4b); margin-bottom: 8px; }
    .duo-tu-card__mult { font-size: 36px; font-weight: 800; color: var(--color-spark-blue, #1cb0f6); }
    .duo-tu-card--vip .duo-tu-card__mult { color: var(--color-macaw-yellow, #ffc800); }
    .duo-tu-card__feats { list-style: none; padding: 0; margin: 24px 0; text-align: left; flex: 1; }
    .duo-tu-card__feats li { font-size: 16px; font-weight: 700; color: var(--color-pencil-gray, #777777); margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .duo-tu-card__feats i { color: var(--color-eager-green, #58cc02); }
    .duo-tu-btn { background: var(--color-spark-blue, #1cb0f6); color: #ffffff !important; border: 2px solid #1899d6; border-radius: 16px; padding: 12px 24px; font-size: 17px; font-weight: 800; text-transform: uppercase; box-shadow: 0 4px 0 #1899d6; cursor: pointer; width: 100%; transition: all 0.1s; margin-top: auto; }
    .duo-tu-btn:hover { filter: brightness(1.05); }
    .duo-tu-btn:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }
    .duo-tu-note { text-align: center; font-size: 16px; font-weight: 700; color: var(--color-pencil-gray, #777777); margin-bottom: 64px; }
    .duo-tu-calc { background: #ffffff; border: 2px solid #e5e5e5; border-radius: 32px; box-shadow: 0 12px 0 #e5e5e5; max-width: 800px; margin: 0 auto; overflow: hidden; }
    .duo-tu-calc__head { background: var(--color-spark-blue, #1cb0f6); padding: 32px; text-align: center; color: #ffffff; border-bottom: 2px solid #1899d6; }
    .duo-tu-calc__title { font-size: 32px; font-weight: 800; margin-bottom: 8px; }
    .duo-tu-calc__body { padding: 48px; }
    @media (max-width: 600px) { .duo-tu-calc__body { padding: 24px; } }
    .duo-tu-form-group { margin-bottom: 32px; }
    .duo-tu-label { display: block; font-size: 18px; font-weight: 800; color: var(--color-charcoal, #4b4b4b); margin-bottom: 12px; }
    .duo-tu-input-wrap { display: flex; align-items: center; background: #f7f7f7; border: 2px solid #e5e5e5; border-radius: 16px; padding: 0 24px; font-size: 24px; font-weight: 800; color: var(--color-charcoal, #4b4b4b); box-shadow: inset 0 4px 0 rgba(0,0,0,0.02); }
    .duo-tu-input-wrap input { border: none; background: transparent; padding: 20px 16px; font-size: 24px; font-weight: 800; color: var(--color-charcoal, #4b4b4b); width: 100%; outline: none; }
    .duo-tu-stats { background: #ffffff; border: 2px solid #e5e5e5; border-radius: 20px; padding: 24px; margin-bottom: 32px; box-shadow: 0 4px 0 #e5e5e5; }
    .duo-tu-stat { display: flex; justify-content: space-between; font-size: 18px; font-weight: 700; color: var(--color-pencil-gray, #777777); margin-bottom: 12px; }
    .duo-tu-stat--total { margin-top: 24px; padding-top: 24px; border-top: 2px dashed #e5e5e5; font-size: 24px; font-weight: 800; color: var(--color-charcoal, #4b4b4b); margin-bottom: 0; }
    .duo-tu-stat--total span:last-child { color: var(--color-macaw-yellow, #ffc800); }
    .duo-tu-buybtn { background: var(--color-eager-green, #58cc02); color: #ffffff !important; border: 2px solid #46a302; border-radius: 16px; padding: 20px; font-size: 22px; font-weight: 800; text-transform: uppercase; box-shadow: 0 6px 0 #46a302; cursor: pointer; width: 100%; transition: all 0.1s; display: flex; align-items: center; justify-content: center; gap: 12px; }
    .duo-tu-buybtn:hover { filter: brightness(1.05); }
    .duo-tu-buybtn:active { transform: translateY(6px); box-shadow: 0 0 0 transparent; }
    </style>

    <div class="duo-tu-bg">
        <div class="duo-tu-container">
            <div class="duo-tu-head">
                <p class="duo-tu-eyebrow"><i class="fas fa-coins"></i> {{ __('inkwave.topup_eyebrow') }}</p>
                <h2 class="duo-tu-title">{{ __('inkwave.topup_heading') }}</h2>
                <p class="duo-tu-sub">{{ __('inkwave.topup_sub') }}</p>
            </div>

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

            <div class="duo-tu-tiers">
                @foreach($tiers as $t)
                    <div class="duo-tu-card @if($t['f']) duo-tu-card--vip @endif">
                        @if($t['f'])<span class="duo-tu-card__flag">{{ __('inkwave.best_value') }}</span>@endif
                        <span class="duo-tu-card__icon"><i class="fas {{ $t['i'] }}"></i></span>
                        <h3 class="duo-tu-card__name">{{ $t['n'] }}</h3>
                        <div class="duo-tu-card__mult">{{ $t['big'] }}</div>
                        <ul class="duo-tu-card__feats">
                            <li><i class="fas fa-check-circle"></i> {{ $t['r'] }}</li>
                            <li><i class="fas fa-check-circle"></i> {{ __('inkwave.bonus_text') }} {{ $t['big'] }}</li>
                        </ul>
                        <button type="button" class="duo-tu-btn" data-topup-focus>{{ __('inkwave.calc_button') }}</button>
                    </div>
                @endforeach
            </div>

            <p class="duo-tu-note">
                @if(session('currency') == 'JPY')
                    {{ __('inkwave.jpy_conversion_note') }}
                @elseif(session('currency') == 'HKD')
                    {{ __('inkwave.hkd_conversion_note') }}
                @else
                    {{ __('inkwave.usd_conversion_note') }}
                @endif
            </p>

            <div class="duo-tu-calc" id="topup">
                <div class="duo-tu-calc__head">
                    <h2 class="duo-tu-calc__title">{{ __('inkwave.calc_title') }}</h2>
                    <p style="font-size:18px; font-weight:700; opacity:0.9;">{{ __('inkwave.calc_tagline') }}</p>
                </div>
                
                <div class="duo-tu-calc__body">
                    <form action="{{ route('points.add-to-cart') }}" method="POST">
                        @csrf
                        
                        <div class="duo-tu-form-group">
                            <label class="duo-tu-label">{{ __('inkwave.calc_input_label') }}</label>
                            <div class="duo-tu-input-wrap">
                                <span>{{ session('currency') == 'JPY' ? '¥' : '$' }}</span>
                                <input type="number" name="amount" id="topup_amount" placeholder="0" min="1" required>
                            </div>
                        </div>

                        <div class="duo-tu-stats">
                            <div class="duo-tu-stat">
                                <span>{{ __('inkwave.calc_base_points') }}</span>
                                <span id="base_points">0</span>
                            </div>
                            <div class="duo-tu-stat">
                                <span>{{ __('inkwave.calc_tier_bonus') }}</span>
                                <span id="multiplier_display">×1</span>
                            </div>
                            <div class="duo-tu-stat duo-tu-stat--total">
                                <span>{{ __('inkwave.calc_youll_get') }}</span>
                                <span><i class="fas fa-coins"></i> <span id="total_points">0</span></span>
                            </div>
                        </div>

                        <button type="submit" class="duo-tu-buybtn">
                            <span>{{ __('inkwave.calc_button') }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        
                        <p style="text-align:center; font-weight:700; color:var(--color-pencil-gray); margin-top:24px;">
                            <i class="fas fa-shield-alt" style="color:var(--color-eager-green);"></i> {{ __('inkwave.calc_trust_message') }}
                        </p>
                    </form>
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
            if(multiplierDisplay) multiplierDisplay.textContent = multiplier === 1 ? 'None' : '×' + multiplier.toFixed(1);
            if(totalPointsDisplay) totalPointsDisplay.textContent = totalPoints.toLocaleString();
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('change', calculatePoints);
    });
</script>
@endpush

@endsection
