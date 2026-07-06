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

<style>
    /* =========================================
       MODERN HERO - PHOTO COLLAGE & STATS
       ========================================= */
    .modern-hero {
        width: 100% !important;
        position: relative !important;
        overflow: hidden !important;
        background-color: var(--color-putty, #c4c3b6) !important; /* flat putty canvas — no gradient per DESIGN.md */
        padding-top: 104px !important;
        padding-bottom: 56px !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
    }

    .hero-bg-video {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transform: translate(-50%, -50%) !important;
        z-index: 1 !important;
        opacity: 0.85 !important;
        filter: grayscale(0.12) contrast(1.03) !important; /* muted gallery tone, video stays visible */
    }

    .hero-overlay {
        position: absolute !important;
        inset: 0 !important;
        background: rgba(196, 195, 182, 0.42) !important; /* subtle flat putty veil — readable, video visible */
        z-index: 2 !important;
        pointer-events: none !important;
    }

    /* =========================================
       HERO GALLERY WALL — centered, aspect-true
       ========================================= */
    .hero-gallery-block {
        margin-top: 64px !important;
    }
    .gallery-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.18em !important;
        color: var(--color-graphite, #595855) !important;
        text-align: center !important;
        margin: 0 0 10px 0 !important;
    }
    .gallery-heading {
        font-family: var(--font-davinci, serif) !important;
        font-size: clamp(26px, 3.2vw, 40px) !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        letter-spacing: -0.01em !important;
        line-height: 1.1 !important;
        text-align: center !important;
        margin: 0 auto 36px auto !important;
        max-width: 720px !important;
    }
    .hero-gallery {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 16px !important;
        max-width: 1180px !important;
        margin: 0 auto !important;
    }
    .hero-gallery-item {
        height: 280px !important;
        margin: 0 !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important;       /* theme card radius */
        overflow: hidden !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        box-shadow: none !important;         /* flat — no shadow */
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .hero-gallery-item img {
        height: 100% !important;
        width: auto !important;              /* preserve each image's real height : width */
        display: block !important;
        object-fit: contain !important;
    }
    .hero-gallery-item:hover {
        transform: translateY(-6px) !important;
    }
    .gallery-caption {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 15px !important;
        line-height: 1.7 !important;
        color: var(--color-graphite, #595855) !important;
        text-align: center !important;
        max-width: 640px !important;
        margin: 40px auto 20px auto !important;
    }
    .gallery-link {
        display: inline-block !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.08em !important;
        color: var(--color-ink, #000000) !important;
        text-decoration: none !important;
        border-bottom: 1px solid var(--color-ink, #000000) !important;
        padding-bottom: 3px !important;
        transition: opacity 0.2s ease !important;
    }
    .gallery-link:hover {
        opacity: 0.6 !important;
    }
    @media (max-width: 768px) {
        .hero-gallery-item { height: 180px !important; }
    }
    @media (max-width: 480px) {
        .hero-gallery-item { height: 140px !important; }
    }

    .modern-hero .auto-container {
        position: relative !important;
        z-index: 3 !important;
        text-align: center !important; /* Bootstrap utilities aren't loaded — center here */
    }

    .hero-badge-wrapper {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 10px !important;
        justify-content: center !important;
        margin-bottom: 16px !important;
    }

    .hero-mini-tag {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        font-size: 11px !important;
        color: var(--color-graphite, #595855) !important;
        font-weight: 500 !important;
        letter-spacing: 0.05em !important;
        text-transform: uppercase !important;
    }

    .pulse-dot {
        width: 6px !important;
        height: 6px !important;
        background-color: var(--color-ink, #000000) !important;
        border-radius: 50% !important;
        display: inline-block !important;
        animation: pulse-glow 1.5s infinite ease-in-out !important;
    }

    @keyframes pulse-glow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.3); }
    }

    .hero-badge {
        display: inline-block !important;
        background-color: var(--color-paper, #ffffff) !important;
        color: var(--color-ink, #000000) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        padding: 6px 16px !important;
        border-radius: 20px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.15em !important;
    }

    .modern-h1 {
        font-family: var(--font-davinci, serif) !important;
        font-size: 56px !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        line-height: 1.15 !important;
        letter-spacing: -0.02em !important;
        margin: 16px auto 20px auto !important;
        text-align: center !important;
    }

    .hero-subtitle {
        font-size: 15px !important;
        color: var(--color-graphite, #595855) !important;
        line-height: 1.7 !important;
        margin: 0 auto 30px auto !important;
        text-align: center !important;
    }

    .hero-cta-buttons {
        display: flex !important;
        gap: 16px !important;
        margin-bottom: 40px !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
    }

    .modern-btn {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        padding: 12px 32px !important;
        border-radius: 24px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
        cursor: pointer !important;
    }

    .modern-btn-solid {
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-ink, #000000) !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .modern-btn-solid::before {
        content: "" !important;
        position: absolute !important;
        top: 0 !important;
        left: -100% !important;
        width: 100% !important;
        height: 100% !important;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent) !important;
        transition: all 0.6s ease !important;
    }

    .modern-btn-solid:hover::before {
        left: 100% !important;
    }

    .modern-btn-solid:hover {
        background-color: transparent !important;
        color: var(--color-ink, #000000) !important;
    }

    .modern-btn-outline {
        background-color: transparent !important;
        color: var(--color-ink, #000000) !important;
        border: 1px solid var(--color-ink, #000000) !important;
    }

    .modern-btn-outline:hover {
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
    }

    .highlight-art {
        font-family: var(--font-davinci, serif) !important;
        font-style: italic !important;
        color: var(--color-ink, #000000) !important; /* flat ink — no gradient/saturated color per DESIGN.md */
        display: inline-block !important;
        padding-right: 0.1em !important;
    }

    /* Floating Image Collage animations with custom rotation tilt effects */
    @keyframes float-up-tl {
        0% { transform: translateY(0px) rotate(-3deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
        50% { transform: translateY(-12px) rotate(-1deg); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); }
        100% { transform: translateY(0px) rotate(-3deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
    }
    @keyframes float-up-tr {
        0% { transform: translateY(0px) rotate(2deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
        50% { transform: translateY(-12px) rotate(4deg); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); }
        100% { transform: translateY(0px) rotate(2deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
    }
    @keyframes float-up-br {
        0% { transform: translateY(0px) rotate(-1.5deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
        50% { transform: translateY(-12px) rotate(0.5deg); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); }
        100% { transform: translateY(0px) rotate(-1.5deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
    }
    @keyframes float-up-fr {
        0% { transform: translateY(0px) rotate(4deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
        50% { transform: translateY(-12px) rotate(2deg); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); }
        100% { transform: translateY(0px) rotate(4deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
    }
    @keyframes float-up-bl {
        0% { transform: translateY(0px) rotate(1deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
        50% { transform: translateY(-12px) rotate(3deg); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); }
        100% { transform: translateY(0px) rotate(1deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
    }
    @keyframes float-up-fl {
        0% { transform: translateY(0px) rotate(-2deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
        50% { transform: translateY(-12px) rotate(-4deg); box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08); }
        100% { transform: translateY(0px) rotate(-2deg); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }
    }

    .hero-collage-container {
        height: 600px !important;
        position: relative !important;
        width: 100% !important;
        max-width: 1200px !important;
        margin: 50px auto !important;
        z-index: 3 !important;
    }

    .collage-wrapper {
        position: relative !important;
        width: 100% !important;
        height: 100% !important;
    }

    .collage-item {
        position: absolute !important;
        overflow: hidden !important;
        background-color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 12px !important;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, border-color 0.4s ease !important;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.06) !important;
    }

    .collage-item img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    /* Elevate and glow hover effect on all images */
    .collage-item:hover {
        transform: scale(1.1) rotate(0deg) !important;
        animation-play-state: paused !important;
        z-index: 99 !important;
        box-shadow: 0 35px 70px rgba(0, 0, 0, 0.2) !important;
        border-color: rgba(255, 255, 255, 0.8) !important;
    }

    .collage-item:hover img {
        transform: scale(1.05) !important;
    }

    /* Absolute Placement matching actual asset horizontal / vertical aspect ratios */
    .collage-center {
        left: 50% !important;
        top: 50% !important;
        width: 440px !important;  /* Landscape image b1.webp */
        height: 260px !important;
        border-radius: 16px !important;
        z-index: 10 !important;
    }

    @keyframes float-up-center {
        0% { transform: translate(-50%, -50%) translateY(0px); box-shadow: 0 25px 50px rgba(0,0,0,0.1); }
        50% { transform: translate(-50%, -50%) translateY(-15px); box-shadow: 0 35px 65px rgba(0,0,0,0.15); }
        100% { transform: translate(-50%, -50%) translateY(0px); box-shadow: 0 25px 50px rgba(0,0,0,0.1); }
    }
    .collage-center.animate-float-up {
        animation: float-up-center 6s ease-in-out infinite !important;
    }
    .collage-center:hover {
        transform: translate(-50%, -50%) scale(1.08) !important;
        animation: none !important;
    }

    .collage-top-left {
        left: 18% !important;
        top: 6% !important;
        width: 200px !important;  /* Landscape image i1.webp */
        height: 150px !important;
        z-index: 5 !important;
        animation: float-up-tl 5.5s ease-in-out infinite !important;
    }

    .collage-top-right {
        right: 20% !important;
        top: 4% !important;
        width: 170px !important;  /* Portrait image i2.webp */
        height: 215px !important;
        z-index: 5 !important;
        animation: float-up-tr 6.2s ease-in-out infinite !important;
    }

    .collage-bottom-right {
        right: 18% !important;
        bottom: 4% !important;
        width: 200px !important;  /* Square image i3.webp */
        height: 200px !important;
        z-index: 8 !important;
        animation: float-up-br 5.8s ease-in-out infinite !important;
    }

    .collage-far-right {
        right: 3% !important;
        top: 30% !important;
        width: 160px !important;  /* Square image i4.webp */
        height: 160px !important;
        z-index: 4 !important;
        animation: float-up-fr 6.5s ease-in-out infinite !important;
    }

    .collage-bottom-left {
        left: 14% !important;
        bottom: 2% !important;
        width: 180px !important;  /* Portrait image i5.webp */
        height: 250px !important;
        z-index: 8 !important;
        animation: float-up-bl 5.9s ease-in-out infinite !important;
    }

    .collage-far-left {
        left: 3% !important;
        top: 22% !important;
        width: 150px !important;  /* Portrait image i9.webp */
        height: 240px !important;
        z-index: 4 !important;
        animation: float-up-fl 6.4s ease-in-out infinite !important;
    }

    /* Stats Section Styling */
    .hero-stats-container {
        border-top: 1px solid var(--color-vellum, #dfdcd5) !important;
        padding-top: 32px !important;
        margin-top: 40px !important;
    }

    .stat-box .stat-value {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 36px !important;
        font-weight: 700 !important;
        color: var(--color-ink, #000000) !important;
        margin: 0 !important;
    }

    .stat-box .stat-label {
        font-size: 13px !important;
        color: var(--color-graphite, #595855) !important;
        margin: 4px 0 0 0 !important;
    }

    .stat-divider {
        width: 1px !important;
        height: 40px !important;
        background-color: var(--color-vellum, #dfdcd5) !important;
    }

    /* Compatible Formats Ticker Styling */
    .hero-formats-ticker {
        margin-top: 50px !important;
        border-top: 1px dashed var(--color-vellum, #dfdcd5) !important;
        padding-top: 24px !important;
    }

    .formats-title {
        font-size: 10px !important;
        font-weight: 600 !important;
        letter-spacing: 0.15em !important;
        color: var(--color-graphite, #595855) !important;
        text-transform: uppercase !important;
        margin-bottom: 0 !important;
    }

    .format-tag {
        font-size: 12.5px !important;
        color: var(--color-ink, #000000) !important;
        background-color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        padding: 6px 14px !important;
        border-radius: 16px !important;
        font-weight: 550 !important;
        display: inline-flex !important;
        align-items: center !important;
        transition: all 0.25s ease !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02) !important;
    }

    .format-tag:hover {
        transform: translateY(-2px) !important;
        border-color: var(--color-ink, #000000) !important;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.05) !important;
    }

    /* Responsive adjustments */
    @media (max-width: 1199px) {
        .hero-collage-container {
            height: 480px !important;
        }
        .collage-center {
            width: 320px !important;
            height: 200px !important;
        }
        .collage-top-left { width: 160px !important; height: 120px !important; left: 12% !important; }
        .collage-top-right { width: 130px !important; height: 160px !important; right: 14% !important; }
        .collage-bottom-left { width: 140px !important; height: 190px !important; left: 10% !important; }
        .collage-bottom-right { width: 150px !important; height: 150px !important; right: 12% !important; }
        .collage-far-left { width: 120px !important; height: 190px !important; left: 1% !important; }
        .collage-far-right { width: 120px !important; height: 120px !important; right: 1% !important; }
    }

    @media (max-width: 991px) {
        .hero-collage-container {
            height: 400px !important;
        }
        .collage-center {
            width: 280px !important;
            height: 175px !important;
        }
        .collage-top-left { width: 120px !important; height: 90px !important; left: 8% !important; }
        .collage-top-right { width: 100px !important; height: 125px !important; right: 10% !important; }
        .collage-bottom-left { width: 100px !important; height: 140px !important; left: 6% !important; }
        .collage-bottom-right { width: 110px !important; height: 110px !important; right: 8% !important; }
        .collage-far-left, .collage-far-right {
            display: none !important;
        }
    }

    @media (max-width: 575px) {
        .modern-h1 {
            font-size: 36px !important;
        }
        .hero-collage-container {
            height: 260px !important;
        }
        .collage-center {
            width: 220px !important;
            height: 140px !important;
        }
        .collage-top-left, .collage-top-right, .collage-bottom-left, .collage-bottom-right {
            display: none !important;
        }
        .hero-stats-container {
            flex-direction: column !important;
            gap: 20px !important;
        }
    }
</style>


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

<style>
    /* =========================================
       SECTION 2 — CATEGORY CARDS (vertical, image-only, title on hover)
       ========================================= */
    .inkwave-categories {
        padding: 96px 40px !important;
    }
    .inkwave-categories .cat-section-head {
        text-align: center !important;
        margin-bottom: 48px !important;
    }
    .cat-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.18em !important;
        color: var(--color-graphite, #595855) !important;
        margin: 0 0 10px 0 !important;
    }
    .cat-heading {
        font-family: var(--font-davinci, serif) !important;
        font-size: clamp(28px, 3.5vw, 44px) !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        letter-spacing: -0.01em !important;
        line-height: 1.1 !important;
        margin: 0 !important;
    }
    .cat-grid {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;      /* short last row (e.g. 2 cards) centers */
        gap: 20px !important;
        max-width: 1100px !important;
        margin: 0 auto !important;
    }
    .cat-card {
        position: relative !important;
        display: block !important;
        flex: 0 1 calc(33.333% - 14px) !important;   /* three per row */
        max-width: calc(33.333% - 14px) !important;
        aspect-ratio: 3 / 4 !important;          /* vertical / portrait card */
        overflow: hidden !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important;           /* theme card radius */
        background-color: var(--color-putty, #c4c3b6) !important;
        text-decoration: none !important;
        box-shadow: none !important;             /* flat — no shadow */
    }
    .cat-card__img {
        position: absolute !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .cat-card:hover .cat-card__img { transform: scale(1.06) !important; }
    .cat-card__placeholder {
        position: absolute !important;
        inset: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: var(--color-graphite, #595855) !important;
        font-size: 40px !important;
        background-color: var(--color-bone, #e7e5e4) !important;
    }
    .cat-card__veil {
        position: absolute !important;
        inset: 0 !important;
        background: rgba(0, 0, 0, 0.35) !important;   /* flat ink veil, reveals on hover */
        opacity: 0 !important;
        transition: opacity 0.4s ease !important;
        z-index: 1 !important;
    }
    .cat-card:hover .cat-card__veil { opacity: 1 !important; }
    .cat-card__content {
        position: absolute !important;
        inset: 0 !important;                          /* cover whole card so the full summary fits */
        display: flex !important;
        flex-direction: column !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 24px !important;
        text-align: center !important;
        opacity: 0 !important;                        /* title + summary hidden until hover */
        transform: translateY(14px) !important;
        transition: opacity 0.4s ease, transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
        z-index: 2 !important;
        overflow-y: auto !important;                  /* a very long summary can scroll, never clips */
    }
    .cat-card:hover .cat-card__content {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }
    .cat-card__title {
        font-family: var(--font-davinci, serif) !important;
        font-size: 22px !important;
        font-weight: 500 !important;
        line-height: 1.15 !important;
        color: var(--color-paper, #ffffff) !important;
        margin: 0 !important;
    }
    .cat-card__summary {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important;
        line-height: 1.55 !important;
        color: rgba(255, 255, 255, 0.85) !important;
        margin: 0 !important;
        max-width: 92% !important;                    /* full summary — no truncation */
    }
    /* Touch devices have no hover — keep titles readable */
    @media (hover: none) {
        .cat-card__veil { opacity: 0.4 !important; }
        .cat-card__content { opacity: 1 !important; transform: none !important; }
    }
    @media (max-width: 768px) {
        .inkwave-categories { padding: 60px 20px !important; }
        .cat-grid { gap: 14px !important; }
        .cat-card { flex-basis: calc(50% - 7px) !important; max-width: calc(50% - 7px) !important; }
        .cat-card__title { font-size: 18px !important; }
        .cat-card__content { padding: 16px !important; }
    }
    @media (max-width: 480px) {
        .cat-card { flex-basis: 100% !important; max-width: 100% !important; }
    }
</style>

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

<style>
    /* =========================================
       SECTION 3 — HOW IT WORKS (three steps in a row)
       ========================================= */
    .inkwave-how-it-works { padding: 96px 40px !important; }
    .steps-head { text-align: center !important; margin-bottom: 48px !important; }
    .steps-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.18em !important;
        color: var(--color-graphite, #595855) !important;
        margin: 0 0 10px 0 !important;
    }
    .steps-heading {
        font-family: var(--font-davinci, serif) !important;
        font-size: clamp(28px, 3.5vw, 44px) !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        letter-spacing: -0.01em !important;
        line-height: 1.1 !important;
        margin: 0 0 14px 0 !important;
    }
    .steps-sub {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 15px !important;
        line-height: 1.6 !important;
        color: var(--color-graphite, #595855) !important;
        max-width: 560px !important;
        margin: 0 auto !important;
    }
    .steps-grid {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
        gap: 24px !important;
        max-width: 1100px !important;
        margin: 0 auto !important;
    }
    .step-card {
        flex: 0 1 calc(33.333% - 16px) !important;   /* three in a row */
        max-width: calc(33.333% - 16px) !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important;
        padding: 36px 28px !important;
        text-align: center !important;
        box-shadow: none !important;                 /* flat — no shadow */
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .step-card:hover { transform: translateY(-6px) !important; }
    .step-num {
        display: block !important;
        font-family: var(--font-davinci, serif) !important;
        font-size: 40px !important;
        font-weight: 500 !important;
        line-height: 1 !important;
        color: var(--color-ink, #000000) !important;
        margin-bottom: 18px !important;
    }
    .step-title {
        font-family: var(--font-davinci, serif) !important;
        font-size: 22px !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        margin: 0 0 12px 0 !important;
    }
    .step-desc {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 14px !important;
        line-height: 1.6 !important;
        color: var(--color-graphite, #595855) !important;
        margin: 0 !important;
    }
    @media (max-width: 768px) {
        .inkwave-how-it-works { padding: 60px 20px !important; }
        .step-card { flex-basis: 100% !important; max-width: 100% !important; }
    }
</style>

<!-- SECTION 4: Products Carousel -->
<section class="inkwave-products" style="background-color: var(--color-bone, #e7e5e4);">
    <div class="prod-head">
        <p class="prod-eyebrow">{{ __('inkwave.prod_eyebrow') }}</p>
        <h2 class="prod-heading">{{ __('inkwave.prod_heading') }}</h2>
    </div>

    @php
        $carouselProducts = \App\Models\Product::where('status','active')->orderBy('id','DESC')->get();
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
                </a>
            @empty
                <p class="prod-empty">{{ __('inkwave.prod_empty') }}</p>
            @endforelse
        </div>

        <button class="prod-nav prod-nav--next" type="button" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>

<style>
    /* =========================================
       SECTION 4 — PRODUCTS CAROUSEL (image + title only)
       ========================================= */
    .inkwave-products { padding: 96px 0 !important; }
    .inkwave-products .prod-head {
        text-align: center !important;
        margin-bottom: 48px !important;
        padding: 0 40px !important;
    }
    .prod-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.18em !important;
        color: var(--color-graphite, #595855) !important;
        margin: 0 0 10px 0 !important;
    }
    .prod-heading {
        font-family: var(--font-davinci, serif) !important;
        font-size: clamp(28px, 3.5vw, 44px) !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        letter-spacing: -0.01em !important;
        line-height: 1.1 !important;
        margin: 0 !important;
    }

    .prod-carousel {
        position: relative !important;
        max-width: 1280px !important;
        margin: 0 auto !important;
        padding: 0 56px !important;
    }
    .prod-track {
        display: flex !important;
        gap: 20px !important;
        overflow-x: auto !important;
        scroll-snap-type: x mandatory !important;
        scroll-behavior: smooth !important;
        padding: 4px 4px 10px 4px !important;
        scrollbar-width: none !important;          /* Firefox */
        -ms-overflow-style: none !important;       /* IE / Edge */
    }
    .prod-track::-webkit-scrollbar { display: none !important; }  /* Chrome / Safari */

    .prod-slide {
        flex: 0 0 auto !important;
        width: 260px !important;
        scroll-snap-align: start !important;
        text-decoration: none !important;
        display: block !important;
    }
    .prod-slide__img {
        position: relative !important;
        width: 100% !important;
        aspect-ratio: 3 / 4 !important;
        overflow: hidden !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important;             /* theme card radius */
        background-color: var(--color-putty, #c4c3b6) !important;
        box-shadow: none !important;               /* flat — no shadow */
    }
    .prod-slide__img img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .prod-slide:hover .prod-slide__img img { transform: scale(1.06) !important; }
    .prod-slide__ph {
        position: absolute !important;
        inset: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: var(--color-graphite, #595855) !important;
        font-size: 32px !important;
        background-color: var(--color-bone, #e7e5e4) !important;
    }
    .prod-slide__title {
        font-family: var(--font-davinci, serif) !important;
        font-size: 16px !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        line-height: 1.35 !important;
        margin: 14px 4px 0 4px !important;
        text-align: center !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
    }

    /* Prev / next capsule buttons */
    .prod-nav {
        position: absolute !important;
        top: 44% !important;
        transform: translateY(-50%) !important;
        width: 44px !important;
        height: 44px !important;
        border-radius: 50% !important;
        background-color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        color: var(--color-ink, #000000) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 14px !important;
        cursor: pointer !important;
        z-index: 3 !important;
        transition: background-color 0.2s ease !important;
    }
    .prod-nav:hover { background-color: var(--color-bone, #e7e5e4) !important; }
    .prod-nav--prev { left: 6px !important; }
    .prod-nav--next { right: 6px !important; }

    .prod-empty {
        text-align: center !important;
        width: 100% !important;
        color: var(--color-graphite, #595855) !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
    }

    @media (max-width: 768px) {
        .inkwave-products { padding: 60px 0 !important; }
        .prod-carousel { padding: 0 20px !important; }
        .prod-slide { width: 200px !important; }
        .prod-nav { display: none !important; }     /* touch-scroll on mobile */
    }
</style>

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
                        ['n'=>__('inkwave.tier_standard'), 'i'=>'fa-feather', 'big'=>'×1',   'r'=>'HK$1 - HK$499',       'f'=>false],
                        ['n'=>__('inkwave.tier_premium'),  'i'=>'fa-star',    'big'=>'×1.5', 'r'=>'HK$500 - HK$999',     'f'=>false],
                        ['n'=>__('inkwave.tier_elite'),    'i'=>'fa-gem',     'big'=>'×2',   'r'=>'HK$1,000 - HK$1,499', 'f'=>false],
                        ['n'=>__('inkwave.tier_vip'),      'i'=>'fa-crown',   'big'=>'×2.5', 'r'=>'HK$1,500+',           'f'=>true],
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

<style>
    /* =========================================
       PREMIUM TIER CARDS - LUXURY DESIGN
       ========================================= */

    .premium-tier-section {
        background: #ffffff;
        border-radius: 20px;
        padding: 28px 32px;
        box-shadow: 0 2px 8px rgba(21, 145, 220, 0.06);
        border: 1px solid rgba(232, 93, 142, 0.12);
    }

    /* Header */
    .tier-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .header-icon {
        width: 40px;
        height: 40px;
        background: rgba(21, 145, 220, 0.08);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .tier-title {
        font-size: 20px;
        font-weight: 800;
        color: #0a0e27;
        margin: 0;
    }

    .tier-subtitle {
        font-size: 13px;
        color: #666;
        margin: 4px 0 0 0;
        font-weight: 500;
    }

    /* Tier Cards Grid */
    .tier-cards-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 12px;
    }

    .tier-card {
        background: #f8fafc;
        border: 1px solid #e8eef8;
        border-radius: 12px;
        padding: 14px;
        position: relative;
    }

    .tier-badge-large {
        display: inline-flex;
        width: 32px;
        height: 32px;
        background: #f0f4ff;
        color: #E85D8E;
        border-radius: 8px;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 6px;
        border: none;
    }

    .tier-badge-premium {
        background: #f0f4ff;
    }

    .tier-badge-elite {
        background: #f0f4ff;
    }

    .tier-badge-vip {
        background: #f0f4ff;
    }

    .tier-card-label {
        font-size: 15px;
        font-weight: 700;
        color: #0a0e27;
        margin: 0 0 6px 0;
    }

    .tier-range-text {
        font-size: 12px;
        color: #666;
        margin-bottom: 10px;
        font-weight: 500;
    }

    .tier-multiplier {
        display: flex;
        align-items: baseline;
        gap: 4px;
        margin-bottom: 8px;
    }

    .multiplier-text {
        font-size: 18px;
        font-weight: 700;
        color: #666;
    }

    .multiplier-active {
        color: #E85D8E;
        font-weight: 800;
    }

    .multiplier-label {
        font-size: 11px;
        color: #999;
        text-transform: uppercase;
        font-weight: 600;
    }

    .tier-indicator-bar {
        width: 100%;
        height: 3px;
        background: #e8eef8;
        border-radius: 2px;
        overflow: hidden;
    }

    .tier-indicator-fill {
        height: 100%;
        background: #E85D8E;
    }

    .currency-note {
        font-size: 12px;
        color: #E85D8E;
        background: rgba(21, 145, 220, 0.06);
        padding: 10px 14px;
        border-radius: 8px;
        display: inline-block;
        font-weight: 600;
    }

    /* =========================================
       LUXURY CALCULATOR - PREMIUM DESIGN
       ========================================= */

    .luxury-calculator-wrapper {
        position: relative;
        height: 100%;
    }

    .calc-bg-blob {
        display: none;
    }

    .luxury-calculator {
        background: #ffffff;
        border: 1px solid rgba(232, 93, 142, 0.12);
        border-radius: 20px;
        padding: 28px 32px;
        box-shadow: 0 2px 8px rgba(21, 145, 220, 0.06);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    /* Calculator Header */
    .calc-header-premium {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 18px;
    }

    .calc-title-premium {
        font-size: 20px;
        font-weight: 800;
        color: #0a0e27;
        margin: 0 0 4px 0;
    }

    .calc-tagline {
        font-size: 13px;
        color: #666;
        margin: 0;
        font-weight: 500;
    }

    .calc-currency-badge {
        width: 40px;
        height: 40px;
        background: #E85D8E;
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        box-shadow: none;
    }

    /* Form Styling */
    .luxury-calc-form {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .premium-input-section {
        margin-bottom: 16px;
    }

    .input-label-premium {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #E85D8E;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 10px;
    }

    .premium-amount-input-wrapper {
        position: relative;
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        padding-bottom: 8px;
        border-bottom: 3px solid rgba(232, 93, 142, 0.2);
        transition: border-color 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        gap: 8px;
        white-space: nowrap;
    }

    .premium-amount-input-wrapper:focus-within {
        border-bottom-color: #E85D8E;
    }

    .input-currency {
        font-size: 28px;
        font-weight: 700;
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        white-space: nowrap;
        flex-shrink: 0;
        margin-right: 0;
    }

    .premium-amount-input {
        flex: 1;
        font-size: 36px;
        font-weight: 800;
        color: #0a0e27;
        background: transparent;
        border: none;
        padding: 12px 0;
        outline: none;
        letter-spacing: -0.5px;
        width: auto;
        min-width: 0;
    }

    .premium-amount-input:focus {
        outline: none;
    }

    /* Points Breakdown */
    .points-breakdown-card {
        background: rgba(255,255,255,0.6);
        border: 1.5px solid rgba(232, 93, 142, 0.15);
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 16px;
    }

    .breakdown-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 13px;
    }

    .breakdown-row.breakdown-total {
        margin-bottom: 0;
    }

    .breakdown-label {
        color: #0a0e27;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .breakdown-value {
        font-weight: 700;
        color: #E85D8E;
        font-size: 14px;
    }

    .bonus-badge {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        font-size: 15px;
    }

    .breakdown-divider {
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, rgba(232, 93, 142, 0.3) 50%, transparent 100%);
        margin: 10px 0;
    }

    .breakdown-value-total {
        font-size: 16px;
        font-weight: 800;
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Large Points Display */
    .points-display-premium {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 20px;
        padding: 14px 16px;
        background: rgba(255,255,255,0.6);
        border-radius: 14px;
        border: 1.5px solid rgba(232, 93, 142, 0.2);
        box-shadow: 0 8px 20px rgba(232, 93, 142, 0.08);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .points-display-premium:hover {
        border-color: rgba(232, 93, 142, 0.3);
        box-shadow: 0 12px 30px rgba(232, 93, 142, 0.15);
    }

    .points-number {
        font-size: 36px;
        font-weight: 900;
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -1px;
    }

    .points-unit {
        font-size: 12px;
        color: #E85D8E;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Benefits */
    .benefits-section {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .benefit-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 14px 12px;
        background: rgba(255,255,255,0.6);
        border-radius: 14px;
        border: 1.5px solid rgba(232, 93, 142, 0.15);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .benefit-item:hover {
        background: rgba(255,255,255,0.8);
        border-color: rgba(232, 93, 142, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(232, 93, 142, 0.1);
    }

    .benefit-item i {
        font-size: 16px;
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
    }

    .benefit-item span {
        font-size: 11px;
        color: #0a0e27;
        font-weight: 600;
        text-align: center;
        line-height: 1.3;
    }

    /* Premium Button */
    .btn-premium-checkout {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        color: white;
        border: none;
        border-radius: 16px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(232, 93, 142, 0.25);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        margin-bottom: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-premium-checkout:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 50px rgba(232, 93, 142, 0.4);
    }

    .btn-premium-checkout:active {
        transform: translateY(-2px);
    }

    .btn-label {
        font-weight: 700;
    }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .btn-shine {
        display: none;
    }

    /* Trust Badge */
    .trust-indicator {
        text-align: center;
        font-size: 11px;
        color: #888;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    .trust-indicator i {
        color: #E85D8E;
        font-size: 12px;
    }

    /* =========================================
       RESPONSIVE DESIGN
       ========================================= */

    @media (max-width: 768px) {
        .premium-tier-section,
        .luxury-calculator {
            padding: 24px 20px;
        }

        .calc-title-premium {
            font-size: 16px;
        }

        .premium-amount-input {
            font-size: 24px;
        }

        .points-number {
            font-size: 32px;
        }

        .tier-title {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .premium-tier-section,
        .luxury-calculator {
            padding: 20px 16px;
        }

        .tier-section-header {
            gap: 10px;
            margin-bottom: 16px;
        }

        .header-icon {
            width: 36px;
            height: 36px;
        }

        .tier-title {
            font-size: 16px;
        }

        .tier-subtitle {
            font-size: 11px;
        }

        .calc-title-premium {
            font-size: 15px;
        }

        .calc-tagline {
            font-size: 11px;
        }

        .premium-amount-input {
            font-size: 22px;
        }

        .points-number {
            font-size: 30px;
        }

        .tier-cards-grid {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .tier-card {
            padding: 12px;
        }

        .btn-premium-checkout {
            padding: 10px 16px;
            font-size: 13px;
        }

        .calc-header-premium {
            flex-direction: column;
            gap: 10px;
        }

        .calc-currency-badge {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }
    }
</style>

<style>
    /* =========================================
       SECTION 5 — TOP-UP TABLE + CALCULATOR (Structured theme redesign)
       Overrides the legacy pink/luxury styles above. Markup + IDs unchanged.
       ========================================= */
    .points-topup-section { padding: 96px 40px !important; }
    .points-topup-section .row {
        display: flex !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
        align-items: stretch !important;
        gap: 24px !important;
        max-width: 1200px !important;
        margin: 0 auto !important;
    }
    .points-topup-section .col-lg-5,
    .points-topup-section .col-md-12 {
        flex: 1 1 460px !important;
        max-width: 560px !important;
        width: auto !important;
        padding: 0 !important;
    }

    /* Section header */
    .topup-head { text-align: center !important; margin-bottom: 48px !important; }
    .topup-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important; font-weight: 600 !important;
        text-transform: uppercase !important; letter-spacing: 0.18em !important;
        color: var(--color-graphite, #595855) !important; margin: 0 0 10px 0 !important;
    }
    .topup-heading {
        font-family: var(--font-davinci, serif) !important;
        font-size: clamp(28px, 3.5vw, 44px) !important; font-weight: 500 !important;
        color: var(--color-ink, #000000) !important; letter-spacing: -0.01em !important;
        line-height: 1.1 !important; margin: 0 0 14px 0 !important;
    }
    .topup-sub {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 15px !important; line-height: 1.6 !important;
        color: var(--color-graphite, #595855) !important;
        max-width: 560px !important; margin: 0 auto !important;
    }

    /* Card surfaces — flat, hairline border, no shadow */
    .premium-tier-section,
    .luxury-calculator {
        background-color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important;
        box-shadow: none !important;
        padding: 32px !important;
        height: 100% !important;
    }
    .luxury-calculator-wrapper { position: relative !important; height: 100% !important; }
    .calc-bg-blob { display: none !important; }

    /* Tier header */
    .tier-section-header {
        display: flex !important; align-items: center !important; gap: 14px !important;
        margin-bottom: 24px !important; padding-bottom: 20px !important;
        border-bottom: 1px solid var(--color-vellum, #dfdcd5) !important;
    }
    .header-icon {
        width: 40px !important; height: 40px !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important;
        display: flex !important; align-items: center !important; justify-content: center !important;
        flex-shrink: 0 !important;
    }
    .tier-title {
        font-family: var(--font-davinci, serif) !important;
        font-size: 20px !important; font-weight: 500 !important;
        color: var(--color-ink, #000000) !important; margin: 0 !important;
    }
    .tier-subtitle {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important; color: var(--color-graphite, #595855) !important;
        margin: 4px 0 0 0 !important; font-weight: 400 !important;
    }

    /* Tier table */
    .tier-table-wrapper { overflow-x: auto !important; }
    .tier-table {
        width: 100% !important; border-collapse: collapse !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
    }
    .tier-table thead th {
        font-size: 10px !important; font-weight: 600 !important;
        text-transform: uppercase !important; letter-spacing: 0.1em !important;
        color: var(--color-graphite, #595855) !important;
        text-align: left !important;
        padding: 0 12px 12px 12px !important;
        border-bottom: 1px solid var(--color-vellum, #dfdcd5) !important;
        background: transparent !important;
    }
    .tier-table td {
        font-size: 13px !important;
        color: var(--color-ink, #000000) !important;
        padding: 14px 12px !important;
        border-bottom: 1px solid var(--color-vellum, #dfdcd5) !important;
        background: transparent !important;
        vertical-align: middle !important;
    }
    .tier-table tbody tr:last-child td { border-bottom: none !important; }
    .tier-row { background: transparent !important; }
    .tier-row:hover td { background-color: var(--color-bone, #e7e5e4) !important; }
    .tier-cell-tier {
        display: flex !important; align-items: center !important; gap: 10px !important;
        font-weight: 500 !important;
    }
    .tier-badge {
        display: inline-flex !important; align-items: center !important; justify-content: center !important;
        width: 22px !important; height: 22px !important;
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
        border-radius: 50% !important;
        font-size: 11px !important; font-weight: 600 !important;
        flex-shrink: 0 !important;
    }
    .tier-cell-range { color: var(--color-graphite, #595855) !important; white-space: nowrap !important; }
    .tier-cell-bonus { font-weight: 600 !important; color: var(--color-ink, #000000) !important; text-align: right !important; }
    .currency-note {
        margin-top: 16px !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11.5px !important; line-height: 1.5 !important;
        color: var(--color-graphite, #595855) !important;
    }

    /* Calculator header */
    .calc-header-premium {
        display: flex !important; align-items: flex-start !important; justify-content: space-between !important;
        gap: 16px !important; margin-bottom: 24px !important; padding-bottom: 20px !important;
        border-bottom: 1px solid var(--color-vellum, #dfdcd5) !important;
    }
    .calc-title-premium {
        font-family: var(--font-davinci, serif) !important;
        font-size: 22px !important; font-weight: 500 !important;
        color: var(--color-ink, #000000) !important; margin: 0 !important;
    }
    .calc-tagline {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important; color: var(--color-graphite, #595855) !important; margin: 4px 0 0 0 !important;
    }
    .calc-currency-badge {
        width: 40px !important; height: 40px !important; flex-shrink: 0 !important;
        background-color: var(--color-ink, #000000) !important; color: var(--color-paper, #ffffff) !important;
        border-radius: 50% !important;
        display: flex !important; align-items: center !important; justify-content: center !important;
        font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 16px !important; font-weight: 600 !important;
    }

    /* Amount input */
    .premium-input-section { margin-bottom: 20px !important; }
    .input-label-premium {
        display: block !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important; font-weight: 600 !important;
        text-transform: uppercase !important; letter-spacing: 0.08em !important;
        color: var(--color-graphite, #595855) !important; margin-bottom: 8px !important;
    }
    .premium-amount-input-wrapper { position: relative !important; }
    .premium-amount-input {
        width: 100% !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 24px !important; font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important;
        padding: 14px 44px 14px 16px !important;
        outline: none !important; box-shadow: none !important;
        transition: border-color 0.2s ease !important;
    }
    .premium-amount-input:focus { border-color: var(--color-ink, #000000) !important; }
    .input-currency {
        position: absolute !important; right: 16px !important; top: 50% !important;
        transform: translateY(-50%) !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 18px !important; font-weight: 600 !important;
        color: var(--color-graphite, #595855) !important;
    }

    /* Breakdown */
    .points-breakdown-card {
        background-color: var(--color-bone, #e7e5e4) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important; padding: 18px !important; margin-bottom: 20px !important;
        box-shadow: none !important;
    }
    .breakdown-row { display: flex !important; align-items: center !important; justify-content: space-between !important; padding: 6px 0 !important; }
    .breakdown-label { font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 13px !important; color: var(--color-graphite, #595855) !important; }
    .breakdown-value { font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 14px !important; font-weight: 600 !important; color: var(--color-ink, #000000) !important; }
    .bonus-badge {
        background-color: var(--color-ink, #000000) !important; color: var(--color-paper, #ffffff) !important;
        padding: 2px 10px !important; border-radius: 28.8px !important; font-size: 12px !important;
    }
    .breakdown-divider { height: 1px !important; background-color: var(--color-vellum, #dfdcd5) !important; margin: 10px 0 !important; border: none !important; }
    .breakdown-total .breakdown-label { color: var(--color-ink, #000000) !important; font-weight: 600 !important; }
    .breakdown-value-total { font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 18px !important; font-weight: 700 !important; color: var(--color-ink, #000000) !important; }

    /* Large points display — ink room */
    .points-display-premium {
        text-align: center !important;
        background-color: var(--color-ink, #000000) !important;
        border-radius: 9px !important; padding: 24px !important; margin-bottom: 20px !important;
        display: flex !important; flex-direction: column !important; align-items: center !important; gap: 4px !important;
    }
    .points-number {
        font-family: var(--font-davinci, serif) !important;
        font-size: 44px !important; font-weight: 500 !important; line-height: 1 !important;
        color: var(--color-paper, #ffffff) !important;
    }
    .points-unit {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important; text-transform: uppercase !important; letter-spacing: 0.18em !important;
        color: rgba(255, 255, 255, 0.6) !important;
    }

    /* Benefits */
    .benefits-section { margin-bottom: 24px !important; display: flex !important; flex-direction: column !important; gap: 10px !important; }
    .benefit-item {
        display: flex !important; align-items: center !important; gap: 10px !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important; color: var(--color-graphite, #595855) !important;
    }
    .benefit-item i { color: var(--color-ink, #000000) !important; font-size: 12px !important; width: 16px !important; text-align: center !important; }

    /* Checkout button — ink pill */
    .btn-premium-checkout {
        position: relative !important; overflow: hidden !important; width: 100% !important;
        display: inline-flex !important; align-items: center !important; justify-content: center !important; gap: 10px !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important; font-weight: 600 !important;
        text-transform: uppercase !important; letter-spacing: 0.05em !important;
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-ink, #000000) !important;
        border-radius: 28.8px !important;
        padding: 14px 24px !important;
        cursor: pointer !important; box-shadow: none !important;
        transition: opacity 0.2s ease !important;
    }
    .btn-premium-checkout:hover { opacity: 0.85 !important; }
    .btn-premium-checkout:disabled { opacity: 0.6 !important; cursor: default !important; }
    .btn-shine { display: none !important; }

    /* Trust indicator */
    .trust-indicator {
        margin-top: 16px !important;
        display: flex !important; align-items: center !important; justify-content: center !important; gap: 8px !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 12px !important; color: var(--color-graphite, #595855) !important;
    }
    .trust-indicator i { color: var(--color-ink, #000000) !important; }

    @media (max-width: 768px) {
        .points-topup-section { padding: 60px 20px !important; }
        .points-topup-section .col-lg-5,
        .points-topup-section .col-md-12 { flex-basis: 100% !important; max-width: 100% !important; }
        .premium-tier-section, .luxury-calculator { padding: 24px !important; }
    }
</style>

<style>
    /* =========================================
       SECTION 5 — TIER PRICING CARDS (reference-style, four across)
       ========================================= */
    .topup-layout { max-width: 1200px !important; margin: 0 auto !important; }
    .tier-cards {
        display: grid !important;
        grid-template-columns: repeat(4, 1fr) !important;   /* four in a row */
        gap: 20px !important;
        align-items: stretch !important;
    }
    .tier-card {
        position: relative !important;
        display: flex !important;
        flex-direction: column !important;
        background-color: var(--color-ink, #000000) !important;
        border: 1px solid rgba(255, 255, 255, 0.14) !important;
        border-radius: 14px !important;
        padding: 28px 24px !important;
        box-shadow: none !important;
    }
    .tier-card--featured {
        border-color: var(--color-paper, #ffffff) !important;
        border-width: 1.5px !important;
    }
    .tier-card__flag {
        position: absolute !important;
        top: -11px !important;
        right: 18px !important;
        background-color: var(--color-paper, #ffffff) !important;
        color: var(--color-ink, #000000) !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 10px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.08em !important;
        padding: 4px 12px !important;
        border-radius: 28.8px !important;
    }
    .tier-card__icon {
        width: 44px !important;
        height: 44px !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: var(--color-paper, #ffffff) !important;
        font-size: 16px !important;
        margin-bottom: 20px !important;
    }
    .tier-card__name {
        font-family: var(--font-davinci, serif) !important;
        font-size: 22px !important;
        font-weight: 500 !important;
        color: var(--color-paper, #ffffff) !important;
        margin: 0 0 16px 0 !important;
    }
    .tier-card__price {
        display: flex !important;
        align-items: baseline !important;
        gap: 8px !important;
        margin-bottom: 20px !important;
        padding-bottom: 20px !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
    }
    .tier-card__mult {
        font-family: var(--font-davinci, serif) !important;
        font-size: 40px !important;
        font-weight: 500 !important;
        line-height: 1 !important;
        color: var(--color-paper, #ffffff) !important;
    }
    .tier-card__per {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        color: rgba(255, 255, 255, 0.55) !important;
    }
    .tier-card__feats {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 0 24px 0 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 12px !important;
        flex-grow: 1 !important;
    }
    .tier-card__feats li {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important;
        color: rgba(255, 255, 255, 0.8) !important;
        line-height: 1.4 !important;
    }
    .tier-card__feats li i { color: var(--color-paper, #ffffff) !important; font-size: 13px !important; flex-shrink: 0 !important; }
    .tier-card__btn {
        width: 100% !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        background-color: transparent !important;
        color: var(--color-paper, #ffffff) !important;
        border: 1px solid rgba(255, 255, 255, 0.4) !important;
        border-radius: 28.8px !important;
        padding: 12px 18px !important;
        cursor: pointer !important;
        margin-top: auto !important;
    }
    .tier-card--featured .tier-card__btn {
        background-color: var(--color-paper, #ffffff) !important;
        color: var(--color-ink, #000000) !important;
        border-color: var(--color-paper, #ffffff) !important;
    }
    .tier-note {
        text-align: center !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 12px !important;
        color: var(--color-graphite, #595855) !important;
        margin: 24px auto 0 auto !important;
        max-width: 720px !important;
    }
    .calc-center { max-width: 560px !important; margin: 56px auto 0 auto !important; }

    /* ===== Remove legacy button shine + ALL hover effects in this section ===== */
    .btn-shine { display: none !important; }
    .btn-premium-checkout::before,
    .btn-premium-checkout::after { display: none !important; content: none !important; }
    .btn-premium-checkout:hover { opacity: 1 !important; transform: none !important; box-shadow: none !important; }
    .premium-tier-section:hover,
    .luxury-calculator:hover,
    .luxury-calculator-wrapper:hover,
    .points-breakdown-card:hover,
    .points-display-premium:hover,
    .tier-card:hover,
    .tier-card__btn:hover,
    .premium-amount-input:hover {
        transform: none !important;
        box-shadow: none !important;
    }

    @media (max-width: 992px) { .tier-cards { grid-template-columns: repeat(2, 1fr) !important; } }
    @media (max-width: 560px) { .tier-cards { grid-template-columns: 1fr !important; } }
</style>

<style>
    /* =========================================
       HERO SPLIT — text left, collage right
       ========================================= */
    .modern-hero .auto-container.hero-split {
        display: flex !important;
        align-items: center !important;
        gap: 48px !important;
        text-align: left !important;
        max-width: 1240px !important;
        margin: 0 auto !important;
    }
    .hero-col--text {
        flex: 1 1 46% !important;
        min-width: 0 !important;
        animation: st-hero-in 0.8s cubic-bezier(0.16, 1, 0.3, 1) both !important;
    }
    .hero-col--media { flex: 1 1 54% !important; min-width: 0 !important; }

    .hero-split .hero-badge-wrapper {
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 10px !important;
        margin-bottom: 22px !important;
    }
    .hero-split .hero-mini-tag { justify-content: flex-start !important; }
    .hero-split .modern-h1 {
        text-align: left !important;
        margin: 0 0 18px 0 !important;
        max-width: none !important;
        font-size: clamp(34px, 4vw, 54px) !important;
        line-height: 1.12 !important;
    }
    .hero-split .hero-subtitle {
        text-align: left !important;
        margin: 0 0 28px 0 !important;
        max-width: 520px !important;
        font-size: 16px !important;
    }
    .hero-split .hero-cta-buttons { justify-content: flex-start !important; margin-bottom: 0 !important; }

    .hero-collage {
        position: relative;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        aspect-ratio: 1 / 1;
    }
    .hero-collage__item {
        position: absolute;
        margin: 0;
        overflow: hidden;
        border: 5px solid var(--color-paper, #ffffff);   /* white photo frame — flat collage depth */
        border-radius: 4px;
        background-color: var(--color-bone, #e7e5e4);
        box-shadow: none;
        transform: rotate(var(--r, 0deg));
        animation: st-collage-float 6.5s ease-in-out infinite;
        animation-delay: var(--d, 0s);
    }
    .hero-collage__item img { width: 100%; height: 100%; object-fit: cover; display: block; }
    /* scattered, overlapping placement — a real collage */
    .hero-collage__item:nth-child(1) { left: 3%;  top: 2%;  width: 40%; aspect-ratio: 3/4; --r: -6deg; z-index: 3; }
    .hero-collage__item:nth-child(2) { left: 56%; top: 0;   width: 38%; aspect-ratio: 1/1; --r: 5deg;  z-index: 2; }
    .hero-collage__item:nth-child(3) { left: 27%; top: 30%; width: 44%; aspect-ratio: 4/5; --r: -2deg; z-index: 6; }
    .hero-collage__item:nth-child(4) { left: 1%;  top: 56%; width: 38%; aspect-ratio: 1/1; --r: 4deg;  z-index: 4; }
    .hero-collage__item:nth-child(5) { left: 58%; top: 54%; width: 40%; aspect-ratio: 1/1; --r: -5deg; z-index: 3; }
    .hero-collage__item:nth-child(6) { left: 62%; top: 26%; width: 28%; aspect-ratio: 3/4; --r: 8deg;  z-index: 1; }

    @keyframes st-collage-float {
        0%, 100% { transform: rotate(var(--r, 0deg)) translateY(0); }
        50%      { transform: rotate(var(--r, 0deg)) translateY(-7px); }
    }
    @keyframes st-hero-in { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }

    @media (max-width: 900px) {
        .modern-hero .auto-container.hero-split { flex-direction: column !important; text-align: center !important; gap: 36px !important; }
        .hero-split .modern-h1, .hero-split .hero-subtitle { text-align: center !important; margin-left: auto !important; margin-right: auto !important; }
        .hero-split .hero-badge-wrapper { align-items: center !important; }
        .hero-split .hero-mini-tag { justify-content: center !important; }
        .hero-split .hero-cta-buttons { justify-content: center !important; }
        .hero-col--text, .hero-col--media { flex-basis: 100% !important; width: 100% !important; }
    }
    @media (prefers-reduced-motion: reduce) { .hero-collage__item { animation: none; } }

    /* =========================================
       CALCULATOR REDESIGN — fresh classes (legacy pink cannot reach these).
       High-specificity selectors (.calc-center .ink-calc …) win outright.
       ========================================= */
    .calc-center .ink-calc {
        background-color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 14px !important;
        padding: 30px !important;
        box-shadow: none !important;
    }
    .ink-calc__head {
        display: flex !important; align-items: flex-start !important; justify-content: space-between !important;
        gap: 16px !important; padding-bottom: 20px !important; margin-bottom: 22px !important;
        border-bottom: 1px solid var(--color-vellum, #dfdcd5) !important;
    }
    .ink-calc__title { font-family: var(--font-davinci, serif) !important; font-size: 22px !important; font-weight: 500 !important; color: var(--color-ink, #000) !important; margin: 0 !important; }
    .ink-calc__tag { font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 13px !important; color: var(--color-graphite, #595855) !important; margin: 4px 0 0 0 !important; }
    .ink-calc__cur {
        flex-shrink: 0 !important; width: 40px !important; height: 40px !important; border-radius: 50% !important;
        background-color: var(--color-ink, #000) !important; color: var(--color-paper, #fff) !important;
        display: flex !important; align-items: center !important; justify-content: center !important;
        font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 16px !important; font-weight: 600 !important;
    }
    .ink-calc__label {
        display: block !important; font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important; font-weight: 600 !important; text-transform: uppercase !important; letter-spacing: 0.08em !important;
        color: var(--color-graphite, #595855) !important; margin-bottom: 8px !important;
    }
    .ink-calc__field {
        display: flex !important; align-items: center !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important; padding: 0 16px !important; margin-bottom: 22px !important;
        transition: border-color 0.2s ease !important;
    }
    .ink-calc__field:focus-within { border-color: var(--color-ink, #000) !important; }
    .ink-calc__prefix { font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 20px !important; font-weight: 600 !important; color: var(--color-graphite, #595855) !important; margin-right: 8px !important; }
    .ink-calc__input {
        flex: 1 !important; width: 100% !important; border: none !important; outline: none !important; background: transparent !important;
        font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 26px !important; font-weight: 500 !important;
        color: var(--color-ink, #000) !important; padding: 14px 0 !important; box-shadow: none !important;
    }
    .ink-calc__rows {
        background-color: var(--color-bone, #e7e5e4) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important; padding: 16px 18px !important; margin-bottom: 22px !important;
    }
    .ink-calc__row {
        display: flex !important; align-items: center !important; justify-content: space-between !important; padding: 6px 0 !important;
        font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 13px !important; color: var(--color-graphite, #595855) !important;
    }
    .ink-calc__row > span:last-child:not(.ink-calc__mult) { color: var(--color-ink, #000) !important; font-weight: 600 !important; }
    .ink-calc__mult {
        background-color: var(--color-ink, #000) !important; color: var(--color-paper, #fff) !important;
        padding: 2px 10px !important; border-radius: 28.8px !important; font-size: 12px !important;
    }
    .ink-calc__row--total { margin-top: 8px !important; padding-top: 12px !important; border-top: 1px solid var(--color-vellum, #dfdcd5) !important; }
    .ink-calc__row--total > span { font-size: 15px !important; color: var(--color-ink, #000) !important; font-weight: 700 !important; }
    .ink-calc__display {
        background-color: var(--color-ink, #000) !important; border-radius: 9px !important;
        padding: 22px !important; margin-bottom: 22px !important; text-align: center !important;
        display: flex !important; flex-direction: column !important; align-items: center !important; gap: 4px !important;
    }
    .ink-calc__big { font-family: var(--font-davinci, serif) !important; font-size: 44px !important; font-weight: 500 !important; line-height: 1 !important; color: var(--color-paper, #fff) !important; }
    .ink-calc__unit { font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 11px !important; text-transform: uppercase !important; letter-spacing: 0.18em !important; color: rgba(255, 255, 255, 0.6) !important; }
    .ink-calc__benefits { list-style: none !important; padding: 0 !important; margin: 0 0 22px 0 !important; display: flex !important; flex-direction: column !important; gap: 10px !important; }
    .ink-calc__benefits li { display: flex !important; align-items: center !important; gap: 10px !important; font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 13px !important; color: var(--color-graphite, #595855) !important; }
    .ink-calc__benefits li i { color: var(--color-ink, #000) !important; font-size: 11px !important; }
    .calc-center .ink-calc .btn-premium-checkout {
        width: 100% !important; display: inline-flex !important; align-items: center !important; justify-content: center !important; gap: 10px !important;
        font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 13px !important; font-weight: 600 !important;
        text-transform: uppercase !important; letter-spacing: 0.05em !important;
        background: var(--color-ink, #000) !important; background-color: var(--color-ink, #000) !important; background-image: none !important;
        color: var(--color-paper, #fff) !important;
        border: 1px solid var(--color-ink, #000) !important; border-radius: 28.8px !important;
        padding: 15px 24px !important; cursor: pointer !important; box-shadow: none !important;
    }
    .ink-calc__trust {
        display: flex !important; align-items: center !important; justify-content: center !important; gap: 8px !important;
        margin: 16px 0 0 0 !important;
        font-family: var(--font-helvetica-now, sans-serif) !important; font-size: 12px !important; color: var(--color-graphite, #595855) !important;
    }
    .ink-calc__trust i { color: var(--color-ink, #000) !important; }
</style>

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



<style>
    /* =========================================
       PREMIUM CATEGORY CARDS
       ========================================= */

    .category-section {
        position: relative;
        overflow: hidden;
    }

    .category-card-premium {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(21, 145, 220, 0.08);
        border: 1px solid rgba(232, 93, 142, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .category-card-premium:hover {
        box-shadow: 0 12px 32px rgba(232, 93, 142, 0.15);
        transform: translateY(-4px);
        border-color: rgba(21, 145, 220, 0.2);
    }

    .category-card-image {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        background: linear-gradient(135deg, #f0f4ff 0%, #e8f1f9 100%);
    }

    .category-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .category-card-premium:hover .category-img {
        transform: scale(1.05);
    }

    .category-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #E85D8E;
        background: linear-gradient(135deg, #f0f4ff 0%, #e8f1f9 100%);
    }

    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(10, 14, 39, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(2px);
    }

    .category-card-premium:hover .category-overlay {
        opacity: 1;
    }

    .category-explore-btn {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(232, 93, 142, 0.3);
    }

    .category-explore-btn:hover {
        background: linear-gradient(135deg, #d64577 0%, #b857e8 100%);
        box-shadow: 0 6px 16px rgba(232, 93, 142, 0.4);
        transform: translateY(-2px);
        color: white;
    }

    .category-card-content {
        padding: 20px 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .category-title {
        font-size: 16px;
        font-weight: 700;
        color: #0a0e27;
        margin: 0 0 12px 0;
    }

    .category-title a {
        color: #0a0e27;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .category-title a:hover {
        color: #E85D8E;
    }

    .category-count {
        font-size: 12px;
        color: #E85D8E;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0 0 10px 0;
    }

    .category-count i {
        font-size: 11px;
    }

    .category-description {
        font-size: 13px;
        color: #666;
        margin: 0;
        line-height: 1.5;
    }

    /* =========================================
       RESPONSIVE DESIGN
       ========================================= */

    @media (max-width: 768px) {
        .category-card-image {
            height: 180px;
        }

        .category-card-content {
            padding: 16px 14px;
        }

        .category-title {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .category-card-image {
            height: 160px;
        }

        .category-card-content {
            padding: 14px 12px;
        }

        .category-title {
            font-size: 13px;
        }

        .category-count {
            font-size: 11px;
        }

        .category-explore-btn {
            padding: 8px 14px;
            font-size: 12px;
        }
    }
</style>

@endsection
