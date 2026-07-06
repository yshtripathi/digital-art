@extends('frontend.layouts.main')

@section('main-content')

<section class="modern-hero">
    <!-- Background Video -->
    <video class="hero-bg-video" autoplay muted loop playsinline preload="auto">
        <source src="{{ asset('assets/images/h3.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>

    <!-- Main Content -->
    <div class="auto-container relative z-10 text-center">
        <div class="hero-badge-wrapper flex-column align-items-center gap-2">
            <span class="hero-badge">{{ __('common.digital_art') ?? 'Digital Art' }}</span>
            <div class="hero-mini-tag d-flex align-items-center gap-2 mt-2">
                <span class="pulse-dot"></span>
                <span>Museum Quality Prints &bull; Worldwide Express Delivery</span>
            </div>
        </div>
        <h1 class="modern-h1 mx-auto text-center" style="max-width: 900px; font-size: clamp(48px, 6vw, 72px); line-height: 1.15; letter-spacing: -0.02em;">
            Transform Your Vision into <br/>
            <span class="highlight-art">Masterpiece Artworks</span>
        </h1>
        <p class="hero-subtitle mx-auto text-center mt-4" style="max-width: 680px; font-size: 18px; line-height: 1.6; color: var(--color-graphite, #595855);">
            Experience the next generation of creative expression. Inkwave combines cutting-edge AI rendering with museum-quality curation to deliver flawless, high-resolution digital prints. Your canvas awaits.
        </p>
        
        <!-- CTA Buttons -->
        <div class="hero-cta-buttons justify-content-center">
            <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-solid">
                {{ __('common.sakura_hero_cta') ?? 'Browse Catalog' }} <i class="fas fa-arrow-right ms-2"></i>
            </a>
            <a href="{{ route('contact') }}" class="modern-btn modern-btn-outline">
                {{ __('common.get_in_touch') ?? 'Get In Touch' }}
            </a>
        </div>
    </div>

    <!-- Text above the gallery -->
    <div class="auto-container relative z-10 hero-gallery-block">
        <p class="gallery-eyebrow">The Inkwave Collection</p>
        <h2 class="gallery-heading">Five movements, one gallery wall</h2>

        <!-- Featured Gallery Wall — images shown at their true aspect ratio -->
        <div class="hero-gallery">
            <figure class="hero-gallery-item"><img src="{{ asset('assets/images/i2.png') }}" alt="Modern ukiyo-e dragon print"></figure>
            <figure class="hero-gallery-item"><img src="{{ asset('assets/images/i3.png') }}" alt="Anime portrait print"></figure>
            <figure class="hero-gallery-item"><img src="{{ asset('assets/images/i4.png') }}" alt="Neon street-art print"></figure>
            <figure class="hero-gallery-item"><img src="{{ asset('assets/images/i5.png') }}" alt="White tiger ukiyo-e print"></figure>
            <figure class="hero-gallery-item"><img src="{{ asset('assets/images/i6.jpg') }}" alt="Pop-art print"></figure>
            <figure class="hero-gallery-item"><img src="{{ asset('assets/images/i7.jpg') }}" alt="Moonlit street-art print"></figure>
            <figure class="hero-gallery-item"><img src="{{ asset('assets/images/i8.jpg') }}" alt="Manga line-art print"></figure>
        </div>

        <!-- Text below the gallery -->
        <p class="gallery-caption">
            Every Inkwave piece is an original, high-resolution print — spanning Anime &amp; Manga, Pixel, Pop, Street, and Modern Ukiyo-e. Printed to gallery standard and ready to frame.
        </p>
        <a href="{{ route('product-lists') }}" class="gallery-link">Explore the full catalog</a>
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
        padding-top: 140px !important;
        padding-bottom: 80px !important;
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
        width: 440px !important;  /* Landscape image b1.jpg */
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
        width: 200px !important;  /* Landscape image i1.png */
        height: 150px !important;
        z-index: 5 !important;
        animation: float-up-tl 5.5s ease-in-out infinite !important;
    }

    .collage-top-right {
        right: 20% !important;
        top: 4% !important;
        width: 170px !important;  /* Portrait image i2.png */
        height: 215px !important;
        z-index: 5 !important;
        animation: float-up-tr 6.2s ease-in-out infinite !important;
    }

    .collage-bottom-right {
        right: 18% !important;
        bottom: 4% !important;
        width: 200px !important;  /* Square image i3.png */
        height: 200px !important;
        z-index: 8 !important;
        animation: float-up-br 5.8s ease-in-out infinite !important;
    }

    .collage-far-right {
        right: 3% !important;
        top: 30% !important;
        width: 160px !important;  /* Square image i4.png */
        height: 160px !important;
        z-index: 4 !important;
        animation: float-up-fr 6.5s ease-in-out infinite !important;
    }

    .collage-bottom-left {
        left: 14% !important;
        bottom: 2% !important;
        width: 180px !important;  /* Portrait image i5.png */
        height: 250px !important;
        z-index: 8 !important;
        animation: float-up-bl 5.9s ease-in-out infinite !important;
    }

    .collage-far-left {
        left: 3% !important;
        top: 22% !important;
        width: 150px !important;  /* Portrait image i9.png */
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

<!-- SECTION 1: Featured Masterpieces -->
<section class="inkwave-featured py-120" style="background-color: var(--color-bone, #e7e5e4); border-top: 1px solid rgba(0,0,0,0.05);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge">Curated Gallery</span>
            <h2 class="modern-h2 mt-3" style="font-size: 3rem;">Featured Artworks</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px; font-size: 1.1rem;">
                Explore top tier digital creations rendered with perfection.
            </p>
        </div>
        
        <!-- Grid/Marquee placeholder -->
        <div class="featured-placeholder" style="min-height: 400px; border: 2px dashed #ccc; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-style: italic; color: #888;">
            (Featured Artworks Grid / Carousel will go here)
        </div>
    </div>
</section>

<!-- SECTION 2: How It Works -->
<section class="inkwave-how-it-works py-120" style="background-color: var(--color-putty, #c4c3b6);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge" style="background: rgba(0,0,0,0.05); color: var(--color-ink);">The Process</span>
            <h2 class="modern-h2 mt-3" style="font-size: 3rem;">From Pixel to Print</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px; font-size: 1.1rem; color: #595855 !important;">
                Three simple steps to elevate your digital assets into physical masterpieces.
            </p>
        </div>
        
        <!-- Steps Placeholder -->
        <div class="steps-placeholder" style="min-height: 300px; border: 2px dashed #a09f95; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-style: italic; color: #666;">
            (Step 1, Step 2, Step 3 columns will go here)
        </div>
    </div>
</section>

<!-- SECTION 3: Premium Materials -->
<section class="inkwave-quality py-120" style="background-color: var(--color-bone, #e7e5e4);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge">Museum Quality</span>
            <h2 class="modern-h2 mt-3" style="font-size: 3rem;">Uncompromising Materials</h2>
        </div>
        
        <!-- Materials Placeholder -->
        <div class="materials-placeholder" style="min-height: 400px; border: 2px dashed #ccc; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-style: italic; color: #888;">
            (Images and descriptions of canvas, framing, and paper quality will go here)
        </div>
    </div>
</section>

<!-- POINTS TOP UP SECTION - PREMIUM LUXURY DESIGN -->
<section class="points-topup-section py-6" id="topup" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ __('common.sakura_topup_badge') }}</span>
            <h2 class="modern-h2 mt-3" style="font-size: 42px; font-weight: 900; color: #0a0e27; line-height: 1.2;">{{ __('common.sakura_topup_title') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px; font-size: 16px; color: #666;">
                {{ __('common.sakura_topup_description') }}
            </p>
        </div>

        <div class="row align-items-stretch g-4 justify-content-center" style="max-width: 1300px; margin: 0 auto;">
            <!-- PREMIUM TIER CARDS -->
            <div class="col-lg-5 col-md-12">
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
                            <h3 class="tier-title">{{ __('common.sakura_tiers_title') }}</h3>
                            <p class="tier-subtitle">{{ __('common.sakura_tiers_subtitle') }}</p>
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
            <div class="col-lg-5 col-md-12">
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
                                    <i class="fas fa-image"></i>
                                    <span>{{ __('common.sakura_calc_benefit_tutorials') }}</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-crown"></i>
                                    <span>{{ __('common.sakura_calc_benefit_vip') }}</span>
                                </div>
                            </div>

                            <!-- Premium Button -->
                            <button type="submit" class="btn-premium-checkout">
                                <span class="btn-label">{{ __('common.sakura_calc_button') }}</span>
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
