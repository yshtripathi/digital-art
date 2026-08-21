@extends('frontend.layouts.main')

@section('main-content')

<style>
/* -------------------------------------------
   Duolingo Theme Landing Page - Artora
------------------------------------------- */
.duo-lp-wrap { font-family: 'Nunito', 'Nunito Sans', sans-serif; background: #ffffff; overflow: hidden; }
.duo-lp-wrap a { text-decoration: none !important; }

/* HERO */
.duo-lp-hero { text-align: center; padding: 0 24px; position: relative; max-width: 100%; margin: 0 auto; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; overflow: hidden; }
.duo-lp-hero__title { font-size: 48px; font-weight: 800; color: #ffffff; text-shadow: 0 4px 12px rgba(0,0,0,0.5); margin-bottom: 48px; line-height: 1.2; position: relative; z-index: 3; max-width: 800px; }
.duo-lp-hero__btns { display: flex; flex-direction: column; gap: 16px; align-items: center; max-width: 320px; width: 100%; margin: 0 auto; position: relative; z-index: 3; }
.duo-lp-hero__bg-video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; }
.duo-lp-hero__overlay { display: none; } /* Removed per user request */
.duo-lp-btn { width: 100%; display: block; border-radius: 16px; padding: 16px; font-size: 16px; font-weight: 800; text-transform: uppercase; cursor: pointer; border: none; transition: all 0.1s; text-align: center; box-sizing: border-box; }
.duo-lp-btn--primary { background: var(--color-eager-green, #58cc02); color: #ffffff !important; border: 2px solid #46a302; box-shadow: 0 4px 0 #46a302; }
.duo-lp-btn--primary:hover { filter: brightness(1.05); }
.duo-lp-btn--primary:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }
.duo-lp-btn--outline { background: #ffffff; color: var(--color-spark-blue, #1cb0f6) !important; border: 2px solid #e5e5e5; box-shadow: 0 4px 0 #e5e5e5; }
.duo-lp-btn--outline:hover { background: #f7f7f7; }
.duo-lp-btn--outline:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }

/* DECORATIVE ICONS */
.duo-lp-mascots { position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 2; }
.duo-lp-m { position: absolute; font-size: 80px; opacity: 0.25; }
.duo-lp-m-1 { top: 15%; left: 5%; transform: rotate(-15deg); color: var(--color-spark-blue); }
.duo-lp-m-2 { top: 50%; left: 10%; transform: rotate(10deg); color: var(--color-cardinal); }
.duo-lp-m-3 { top: 10%; right: 5%; transform: rotate(20deg); color: var(--color-macaw-yellow); }
.duo-lp-m-4 { top: 60%; right: 10%; transform: rotate(-10deg); color: var(--color-eager-green); }
@media(max-width: 900px) { .duo-lp-mascots { display: none; } }

/* CAROUSEL */
.duo-lp-strip { padding: 48px 0; overflow: hidden; white-space: nowrap; position: relative; background: #ffffff; margin-top: -2px; }
.duo-lp-strip__inner { display: inline-flex; gap: 32px; padding: 0 24px; animation: duoScroll 40s linear infinite; }
.duo-lp-strip--reverse .duo-lp-strip__inner { animation: duoScrollRight 40s linear infinite; }
.duo-lp-strip:hover .duo-lp-strip__inner { animation-play-state: paused; }
@keyframes duoScroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
@keyframes duoScrollRight { 0% { transform: translateX(-50%); } 100% { transform: translateX(0); } }

.duo-lp-course-card { display: inline-flex; flex-direction: column; width: 280px; border: 2px solid #e5e5e5; border-radius: 24px; padding: 16px; background: #ffffff; box-shadow: 0 6px 0 #e5e5e5; transition: transform 0.1s, box-shadow 0.1s; text-align: left; white-space: normal; cursor: pointer; }
.duo-lp-course-card:hover { transform: translateY(-4px); box-shadow: 0 10px 0 #e5e5e5; }
.duo-lp-course-card__img { width: 100%; height: 160px; border-radius: 16px; object-fit: cover; margin-bottom: 16px; background: #f7f7f7; border: 2px solid #e5e5e5; }
.duo-lp-course-card__title { font-size: 18px; font-weight: 800; color: var(--color-charcoal); line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

/* FEATURE BLOCKS */
.duo-lp-feat { padding: 64px 24px; max-width: 1000px; margin: 0 auto; display: flex; align-items: center; gap: 48px; }
.duo-lp-feat:nth-child(even) { flex-direction: row-reverse; }
@media (max-width: 768px) { .duo-lp-feat, .duo-lp-feat:nth-child(even) { flex-direction: column; text-align: center; gap: 32px; padding: 48px 24px; } }
.duo-lp-feat__text { flex: 1; }
.duo-lp-feat__title { font-size: 40px; font-weight: 800; margin-bottom: 16px; }
.duo-lp-feat__desc { font-size: 18px; font-weight: 700; color: var(--color-pencil-gray); line-height: 1.6; }
.duo-lp-feat__img { flex: 1; display: flex; justify-content: center; }
.duo-lp-feat__box { width: 220px; height: 220px; border-radius: 40px; display: flex; align-items: center; justify-content: center; font-size: 80px; box-shadow: 0 12px 0 rgba(0,0,0,0.05); }

.duo-lp-feat--1 .duo-lp-feat__title { color: var(--color-eager-green); }
.duo-lp-feat--1 .duo-lp-feat__box { background: #d7ffb8; color: var(--color-eager-green); }

.duo-lp-feat--2 .duo-lp-feat__title { color: var(--color-spark-blue); }
.duo-lp-feat--2 .duo-lp-feat__box { background: #eaf7ff; color: var(--color-spark-blue); }

.duo-lp-feat--3 .duo-lp-feat__title { color: var(--color-macaw-yellow); }
.duo-lp-feat--3 .duo-lp-feat__box { background: #fff4cc; color: var(--color-macaw-yellow); }

/* ANYWHERE BLOCK */
.duo-lp-anywhere { background: var(--color-spark-blue, #1cb0f6); padding: 80px 24px; text-align: center; overflow: hidden; position: relative; border-radius: 32px; border: 2px solid #1899d6; box-shadow: 0 12px 0 #1899d6; max-width: 1000px; margin: 80px auto; width: calc(100% - 48px); }
.duo-lp-anywhere__title { font-size: 48px; font-weight: 800; color: #ffffff; margin-bottom: 48px; position: relative; z-index: 2; }
.duo-lp-anywhere__icons { display: flex; justify-content: center; flex-wrap: wrap; gap: 48px; font-size: 80px; color: #ffffff; opacity: 0.9; position: relative; z-index: 1; }
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

/* VISUAL CATEGORIES */
.duo-lp-visual-cats { padding: 100px 24px; max-width: 1200px; margin: 0 auto; text-align: center; }
.duo-lp-visual-cats__title { font-size: 40px; font-weight: 800; color: var(--color-charcoal); margin-bottom: 48px; }
.duo-lp-visual-cats__grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 24px; }
@media (max-width: 1024px) { .duo-lp-visual-cats__grid { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 768px) { .duo-lp-visual-cats__grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 480px) { .duo-lp-visual-cats__grid { grid-template-columns: 1fr; } }
.duo-lp-vcat { display: block; border-radius: 32px; overflow: hidden; position: relative; border: 2px solid #e5e5e5; box-shadow: 0 8px 0 #e5e5e5; transition: transform 0.1s, box-shadow 0.1s; cursor: pointer; aspect-ratio: 1; }
.duo-lp-vcat:hover { transform: translateY(-4px); box-shadow: 0 12px 0 #e5e5e5; }
.duo-lp-vcat__img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; background: #f7f7f7; }
.duo-lp-vcat:hover .duo-lp-vcat__img { transform: scale(1.05); }
.duo-lp-vcat__overlay { position: absolute; bottom: 0; left: 0; width: 100%; padding: 48px 24px 24px; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); text-align: left; }
.duo-lp-vcat__title { color: #ffffff; font-size: 24px; font-weight: 800; margin: 0; }

/* BOTTOM CTA */
.duo-lp-cta { background: var(--color-eager-green); padding: 100px 24px; text-align: center; }
.duo-lp-cta__title { font-size: 48px; font-weight: 800; color: #ffffff; margin-bottom: 48px; }
.duo-lp-cta .duo-lp-btn--outline { max-width: 300px; margin: 0 auto; color: var(--color-eager-green) !important; border-color: #ffffff; box-shadow: 0 4px 0 #46a302; }
</style>

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
                        <div class="duo-lp-vcat__img" style="display:flex;align-items:center;justify-content:center;font-size:64px;color:var(--color-spark-blue);"><i class="fas fa-layer-group"></i></div>
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
    <div style="padding: 48px 0; background: #ffffff;">
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
                                <div class="duo-lp-course-card__img" style="display:flex;align-items:center;justify-content:center;font-size:48px;color:var(--color-spark-blue);"><i class="fas fa-book-open"></i></div>
                            @endif
                            <div class="duo-lp-course-card__title">{{ $product->title }}</div>
                        </a>
                    @endforeach
                @endfor
            </div>
        </section>
        
        {{-- Moving Right --}}
        <section class="duo-lp-strip duo-lp-strip--reverse" style="margin-top: 48px;">
            <div class="duo-lp-strip__inner">
                @for ($i = 0; $i < 2; $i++)
                    @foreach($carouselProducts as $product)
                        @php $pimg = $product->photo ? explode(',', $product->photo)[0] : null; @endphp
                        <a href="{{ route('product-detail', $product->slug) }}" class="duo-lp-course-card">
                            @if($pimg)
                                <img src="{{ url($pimg) }}" alt="{{ $product->title }}" class="duo-lp-course-card__img" loading="lazy">
                            @else
                                <div class="duo-lp-course-card__img" style="display:flex;align-items:center;justify-content:center;font-size:48px;color:var(--color-spark-blue);"><i class="fas fa-book-open"></i></div>
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
    .duo-tu-buybtn { background: var(--color-eager-green, #58cc02); color: #ffffff !important; border: 2px solid #46a302; border-radius: 16px; padding: 20px; font-size: 22px; font-weight: 800; text-transform: uppercase; box-shadow: 0 4px 0 #46a302; cursor: pointer; width: 100%; transition: all 0.1s; display: flex; align-items: center; justify-content: center; gap: 12px; }
    .duo-tu-buybtn:hover { filter: brightness(1.05); }
    .duo-tu-buybtn:active { transform: translateY(4px); box-shadow: 0 0 0 transparent; }
    </style>

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
                    <p style="font-size:18px; font-weight:700; opacity:0.9;">{{ __('inkwave.tu_calc_tagline') }}</p>
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
                        
                        <p style="text-align:center; font-weight:700; color:var(--color-pencil-gray); margin-top:24px;">
                            <i class="fas fa-shield-alt" style="color:var(--color-eager-green);"></i> {{ __('inkwave.tu_calc_trust_message') }}
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
