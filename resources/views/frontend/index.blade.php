@extends('frontend.layouts.main')

@section('main-content')

<section class="modern-hero">
    <!-- Background Video -->
    <video class="hero-bg-video" autoplay muted loop playsinline preload="auto">
        <source src="{{ asset('assets/images/hero.mp4') }}" type="video/mp4">
    </video>

    <div class="modern-hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="modern-blob modern-blob-1"></div>
    <div class="modern-blob modern-blob-2"></div>

    <div class="auto-container">
        <div class="hero-content-wrapper">
            <!-- Centered Hero Content -->
            <div class="hero-center-content">
                <div class="hero-badge-wrapper">
                    <span class="hero-badge">{{ __('common.digital_art') }}</span>
                </div>

                <h1 class="modern-h1">
                    {{ __('common.sakura_hero_title') }}
                </h1>

                <p class="hero-subtitle">
                    {{ __('common.sakura_hero_subtitle') }}
                </p>

                <!-- CTA Buttons -->
                <div class="hero-cta-buttons">
                    <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-solid">
                        {{ __('common.sakura_hero_cta') }} <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="modern-btn modern-btn-outline">
                        {{ __('common.get_in_touch') }}
                    </a>
                </div>
            </div>

           
        </div>
    </div>
</section>

<style>
    /* =========================================
       MODERN HERO - VERTICAL VIDEO + CONTENT
       ========================================= */

    .modern-hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--bg-soft) 0%, var(--bg-secondary) 100%);
    }

    /* Background Video */
    .hero-bg-video {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
        z-index: 0;
        opacity: 0.6;
    }

    .modern-hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);
        z-index: 0;
        opacity: 0.5;
    }

    /* Overlay for readability */
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, rgba(232, 93, 142, 0.15) 100%);
        z-index: 1;
    }

    .modern-blob {
        position: absolute;
        border-radius: 50%;
        opacity: 0;
        z-index: 1;
        display: none;
    }

    .modern-blob-1 {
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(232, 93, 142, 0.15), transparent);
        top: -100px;
        right: -100px;
    }

    .modern-blob-2 {
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(200, 107, 250, 0.1), transparent);
        bottom: -50px;
        left: -50px;
    }

    .auto-container {
        position: relative;
        z-index: 3;
        width: 100%;
    }

    /* Hero Content Wrapper - Centered Layout */
    .hero-content-wrapper {
        display: flex;
        flex-direction: column;
        gap: 4rem;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        padding: 4rem 3rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Centered Text Section */
    .hero-center-content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        animation: slideInDown 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-align: center;
        max-width: 800px;
    }

    /* Features Grid */
    .hero-features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        width: 100%;
        animation: slideInUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s backwards;
    }

    /* Simple Feature Cards */
    .simple-feature {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
        text-align: center;
        animation: fadeInUp 0.6s ease-out backwards;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .simple-feature:hover {
        transform: translateY(-8px);
    }

    .simple-feature:nth-child(1) { animation-delay: 0.2s; }
    .simple-feature:nth-child(2) { animation-delay: 0.3s; }
    .simple-feature:nth-child(3) { animation-delay: 0.4s; }
    .simple-feature:nth-child(4) { animation-delay: 0.5s; }

    .feature-number {
        font-size: 2.5rem;
        font-weight: 900;
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    .simple-feature h5 {
        margin: 0;
        font-size: 1.1rem;
        font-weight: 700;
        color: #0a0e27;
        letter-spacing: -0.3px;
    }

    .simple-feature p {
        margin: 0;
        font-size: 0.9rem;
        color: #999;
        font-weight: 500;
        line-height: 1.5;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .hero-badge-wrapper {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        justify-content: center;
    }

    .hero-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(232, 93, 142, 0.12), rgba(200, 107, 250, 0.08));
        color: #E85D8E;
        padding: 0.7rem 1.8rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        border: 1.5px solid rgba(232, 93, 142, 0.3);
        box-shadow: 0 4px 15px rgba(232, 93, 142, 0.1);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        animation: fadeIn 0.8s ease-out backwards;
    }

    .hero-badge:hover {
        border-color: rgba(232, 93, 142, 0.5);
        box-shadow: 0 8px 25px rgba(232, 93, 142, 0.2);
        background: linear-gradient(135deg, rgba(232, 93, 142, 0.18), rgba(200, 107, 250, 0.12));
        transform: translateY(-2px);
    }

    .modern-h1 {
        font-size: 3.2rem;
        font-weight: 900;
        color: #0a0e27;
        line-height: 1.15;
        letter-spacing: -0.02em;
        margin: 0.5rem 0 1rem 0;
        animation: slideInDown 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s backwards;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .modern-h1:hover {
        color: #E85D8E;
    }

    .hero-subtitle {
        font-size: 1rem;
        color: #666;
        line-height: 1.8;
        margin: 0 0 1.5rem 0;
        font-weight: 500;
        animation: fadeIn 0.8s ease-out 0.2s backwards;
    }


    /* CTA Buttons */
    .hero-cta-buttons {
        display: flex;
        gap: 1rem;
        margin: 2rem 0 2.5rem 0;
        flex-wrap: wrap;
        animation: fadeInUp 0.8s ease-out 0.4s backwards;
        justify-content: center;
    }

    .modern-btn {
        padding: 1rem 2.5rem;
        border-radius: 16px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .modern-btn-solid {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        color: white;
        box-shadow: 0 10px 30px rgba(232, 93, 142, 0.3);
    }

    .modern-btn-solid:hover {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(232, 93, 142, 0.4);
    }

    .modern-btn-solid:active {
        transform: translateY(-1px);
    }

    .modern-btn-outline {
        background: white;
        color: #E85D8E;
        border: 2px solid #E85D8E;
    }

    .modern-btn-outline:hover {
        background: white;
        color: #E85D8E;
        border-color: #E85D8E;
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(232, 93, 142, 0.2);
    }

    /* Avatar Stack */
    .hero-avatar-stack {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(232, 93, 142, 0.15);
    }

    .avatar-group {
        display: flex;
        align-items: center;
    }

    .avatar-group img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 3px solid white;
        margin-right: -12px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease;
    }

    .avatar-group img:hover {
        transform: scale(1.1);
        margin-right: -8px;
    }

    .avatar-text {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin: 0;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    /* =========================================
       RESPONSIVE DESIGN
       ========================================= */

    @media (max-width: 1024px) {
        .hero-content-wrapper {
            gap: 3.5rem;
            padding: 3rem 2rem;
        }

        .modern-h1 {
            font-size: 2.8rem;
        }

        .hero-center-content {
            max-width: 700px;
        }

        .hero-features-grid {
            gap: 1.5rem;
        }

        .feature-number {
            font-size: 2.2rem;
        }

        .simple-feature h5 {
            font-size: 1rem;
        }

        .simple-feature p {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 768px) {
        .modern-hero {
            min-height: auto;
            padding: 2rem 0;
        }

        .hero-content-wrapper {
            gap: 3rem;
            padding: 2.5rem 1.5rem;
            max-width: 100%;
        }

        .modern-h1 {
            font-size: 2.2rem;
        }

        .hero-subtitle {
            font-size: 0.95rem;
        }

        .hero-center-content {
            max-width: 100%;
        }

        .hero-badge-wrapper {
            justify-content: center;
        }

        .hero-cta-buttons {
            flex-direction: column;
            justify-content: center;
        }

        .modern-btn {
            width: 100%;
            justify-content: center;
        }

        .hero-badge {
            font-size: 0.75rem;
            padding: 0.6rem 1.5rem;
        }

        .hero-features-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .feature-number {
            font-size: 2rem;
        }

        .simple-feature h5 {
            font-size: 0.95rem;
        }

        .simple-feature p {
            font-size: 0.8rem;
        }
    }

    @media (max-width: 480px) {
        .modern-h1 {
            font-size: 1.8rem;
        }

        .hero-subtitle {
            font-size: 0.9rem;
        }

        .hero-content-wrapper {
            gap: 2.5rem;
            padding: 2rem 1rem;
        }

        .hero-features-grid {
            grid-template-columns: 1fr;
            gap: 1.2rem;
        }

        .feature-number {
            font-size: 1.8rem;
        }

        .simple-feature h5 {
            font-size: 0.9rem;
        }

        .simple-feature p {
            font-size: 0.75rem;
        }

        .hero-badge {
            font-size: 0.7rem;
            padding: 0.5rem 1rem;
        }

        .modern-btn {
            padding: 0.9rem 2rem;
            font-size: 0.85rem;
        }

        .modern-blob-1 {
            width: 200px;
            height: 200px;
        }

        .modern-blob-2 {
            width: 150px;
            height: 150px;
        }
    }
</style>

<section class="category-section pt-120 pb-120" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge">{{ __('common.sakura_category_badge') }}</span>
            <h2 class="modern-h2 mt-3">{{ __('common.sakura_category_title') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px;">
                {{ __('common.sakura_category_subtitle') }}
            </p>
        </div>

        <!-- Category Carousel Container -->
        <div class="category-carousel-wrapper">
            <!-- Left Navigation -->
            <button class="carousel-nav carousel-nav-left" id="categoryPrev">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Carousel Track -->
            <div class="carousel-container">
                <div class="carousel-track" id="categoryTrack">
                    @if(isset($category_lists) && $category_lists->count() > 0)
                        @foreach($category_lists as $category)
                            <div class="carousel-slide">
                                <div class="category-card-premium">
                                    <!-- Image on Top -->
                                    <div class="category-card-image position-relative watermark-overlay">
                                        @if($category->photo)
                                            <img src="{{ $category->photo }}" alt="{{ $category->title }}" class="category-img">
                                        @else
                                            <div class="category-img-placeholder">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                       
                                    </div>

                                    <!-- Title and Summary Below -->
                                    <div class="category-card-content">
                                        <h3 class="category-title">
                                            <a href="{{ route('product-lists', $category->slug) }}">
                                                {{ $category->title }}
                                            </a>
                                        </h3>
                                       
                                        @if($category->summary)
                                            <p class="category-description">
                                                {{ $category->summary }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Right Navigation -->
            <button class="carousel-nav carousel-nav-right" id="categoryNext">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <!-- Carousel Indicators -->
        <div class="premium-carousel-indicators" id="categoryIndicators"></div>
    </div>
</section>

<style>
    /* =========================================
       CATEGORY CAROUSEL - MODERN DESIGN
       ========================================= */

    .category-carousel-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        position: relative;
    }

    /* Carousel Container */
    .carousel-container {
        flex: 1;
        max-width: 1200px;
        overflow: hidden;
        border-radius: 20px;
    }

    /* Carousel Track */
    .carousel-track {
        display: flex;
        gap: 1.5rem;
        padding: 1rem;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Carousel Slides */
    .carousel-slide {
        flex: 0 0 calc(25% - 1.125rem);
        min-width: 280px;
    }

    /* Navigation Buttons */
    .carousel-nav {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--gradient-sakura);
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(232, 93, 142, 0.3);
        flex-shrink: 0;
    }

    .carousel-nav:hover {
        transform: translateY(-2px) scale(1.1);
        box-shadow: 0 12px 35px rgba(232, 93, 142, 0.4);
    }

    .carousel-nav:active {
        transform: scale(0.95);
    }

    /* Category Card - Updated Design */
    .category-card-premium {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(21, 145, 220, 0.08);
        border: 1px solid rgba(232, 93, 142, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .category-card-premium:hover {
        box-shadow: 0 12px 35px rgba(232, 93, 142, 0.15);
        transform: translateY(-6px);
        border-color: rgba(21, 145, 220, 0.2);
    }

    /* Image on Top */
    .category-card-image {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(135deg, #f0f4ff 0%, #e8f1f9 100%);
        flex-shrink: 0;
    }

    .category-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .category-card-premium:hover .category-img {
        transform: scale(1.08);
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
        backdrop-filter: blur(4px);
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

    /* Card Content - Title and Summary Below */
    .category-card-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .category-title {
        font-size: 16px;
        font-weight: 700;
        color: #0a0e27;
        margin: 0;
        line-height: 1.4;
    }

    .category-title a {
        color: #0a0e27;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .category-title a:hover {
        color: #E85D8E;
    }

    .category-course-count {
        font-size: 12px;
        color: #E85D8E;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
    }

    .category-course-count i {
        font-size: 11px;
    }

    .category-description {
        font-size: 13px;
        color: #666;
        margin: 0;
        line-height: 1.6;
        overflow-wrap: break-word;
        white-space: normal;
        hyphens: none;
        flex: 1;
        text-align: left;
        /* Truncate with an ellipsis (…) after a set number of lines */
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 6;
        line-clamp: 6;
        overflow: hidden;
    }

    /* Premium Carousel Indicators */
    .premium-carousel-indicators {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 4rem;
        padding-top: 1.5rem;
        position: relative;
        z-index: 10;
        clear: both;
    }

    .premium-carousel-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(232, 93, 142, 0.3);
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }

    .premium-carousel-indicator.active {
        background: #E85D8E;
        width: 30px;
        border-radius: 5px;
    }

    .premium-carousel-indicator:hover {
        background: #E85D8E;
    }

    /* =========================================
       RESPONSIVE CAROUSEL
       ========================================= */

    @media (max-width: 1024px) {
        .carousel-slide {
            flex: 0 0 calc(33.333% - 1rem);
        }

        .carousel-nav {
            width: 44px;
            height: 44px;
            font-size: 1rem;
        }
    }

    @media (max-width: 768px) {
        .carousel-slide {
            flex: 0 0 calc(50% - 0.75rem);
        }

        .category-carousel-wrapper {
            gap: 1rem;
        }

        .carousel-nav {
            width: 40px;
            height: 40px;
            font-size: 0.9rem;
        }

        .carousel-track {
            gap: 1rem;
            padding: 0.5rem;
        }

        .category-card-content {
            padding: 1.2rem;
        }

        .category-title {
            font-size: 15px;
        }

        .category-description {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .carousel-slide {
            flex: 0 0 calc(100% - 0.5rem);
        }

        .carousel-nav {
            width: 36px;
            height: 36px;
            font-size: 0.8rem;
        }

        .carousel-nav-left {
            position: absolute;
            left: -20px;
        }

        .carousel-nav-right {
            position: absolute;
            right: -20px;
        }

        .carousel-container {
            max-width: 100%;
        }
    }
</style>

<script>
    // Category Carousel - Loop Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('categoryTrack');
        const prevBtn = document.getElementById('categoryPrev');
        const nextBtn = document.getElementById('categoryNext');
        const indicatorsContainer = document.getElementById('categoryIndicators');

        if (!track) return;

        const slides = Array.from(track.querySelectorAll('.carousel-slide'));
        const totalSlides = slides.length;
        if (totalSlides === 0) return;

        let currentPosition = 0;
        let isTransitioning = false;
        let cardsPerView = 4;
        let step = 0;       // pixels to shift per position (slide width + gap)
        let maxPosition = 0; // last position that still fills the viewport

        // How many cards are visible at the current breakpoint (mirrors the CSS).
        function getCardsPerView() {
            const w = window.innerWidth;
            if (w <= 480) return 1;
            if (w <= 768) return 2;
            if (w <= 1024) return 3;
            return 4;
        }

        // Measure the real slide width (including the flex gap) from the DOM,
        // so the transform stays pixel-perfect regardless of CSS gap/calc().
        function measure() {
            cardsPerView = getCardsPerView();
            const gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap) || 0;
            step = slides[0].offsetWidth + gap;
            maxPosition = Math.max(0, totalSlides - cardsPerView);
            if (currentPosition > maxPosition) currentPosition = maxPosition;
        }

        // Build one indicator per scrollable position.
        function buildIndicators() {
            if (!indicatorsContainer) return;
            indicatorsContainer.innerHTML = '';
            for (let i = 0; i <= maxPosition; i++) {
                const indicator = document.createElement('button');
                indicator.className = `premium-carousel-indicator ${i === currentPosition ? 'active' : ''}`;
                indicator.addEventListener('click', () => goToSlide(i));
                indicatorsContainer.appendChild(indicator);
            }
        }

        function updateCarousel(animate = true) {
            track.style.transition = animate
                ? 'transform 0.5s cubic-bezier(0.4, 0, 0.2, 1)'
                : 'none';
            track.style.transform = `translateX(${-currentPosition * step}px)`;

            if (indicatorsContainer) {
                indicatorsContainer.querySelectorAll('.premium-carousel-indicator')
                    .forEach((ind, index) => ind.classList.toggle('active', index === currentPosition));
            }
        }

        function goToSlide(index) {
            if (isTransitioning) return;
            isTransitioning = true;
            currentPosition = Math.min(Math.max(index, 0), maxPosition);
            updateCarousel();
            setTimeout(() => { isTransitioning = false; }, 500);
        }

        function moveNext() {
            if (isTransitioning) return;
            isTransitioning = true;
            // Advance one card; once the last card is reached, loop back to the start.
            currentPosition = currentPosition >= maxPosition ? 0 : currentPosition + 1;
            updateCarousel();
            setTimeout(() => { isTransitioning = false; }, 500);
        }

        function movePrev() {
            if (isTransitioning) return;
            isTransitioning = true;
            // Go back one card; from the start, jump to the end.
            currentPosition = currentPosition <= 0 ? maxPosition : currentPosition - 1;
            updateCarousel();
            setTimeout(() => { isTransitioning = false; }, 500);
        }

        nextBtn.addEventListener('click', moveNext);
        prevBtn.addEventListener('click', movePrev);

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') moveNext();
            if (e.key === 'ArrowLeft') movePrev();
        });

        // Recalculate on resize so the layout stays correct across breakpoints.
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                measure();
                buildIndicators();
                updateCarousel(false);
            }, 150);
        });

        // Initial setup
        measure();
        buildIndicators();
        updateCarousel(false);

        // Auto-loop carousel (optional)
        // setInterval(moveNext, 5000);
    });
</script>

<section class="about-info py-6" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="auto-container">
        <div class="row align-items-center g-5" style="max-width: 1400px; margin: 0 auto;">
            <!-- LEFT: Image -->
            <div class="col-xl-5 col-lg-5 col-md-12 d-flex justify-content-center" style="padding: 3rem 2rem;">
                <div class="modern-img-wrapper" style="border-radius: 24px; overflow: hidden; box-shadow: 0 40px 100px rgba(232, 93, 142, 0.2); border: 3px solid rgba(232, 93, 142, 0.1); width: 100%; max-width: 100%; animation: slideInLeft 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);">
                    <img src="{{ asset('assets/images/i-2.webp') }}" alt="Digital Arts" class="w-100" style="display: block; transition: transform 0.5s ease; object-fit: cover; width: 100%; height: 100%;">
                </div>
            </div>

            <!-- RIGHT: Content -->
            <div class="col-xl-7 col-lg-7 col-md-12 d-flex flex-column justify-content-center" style="padding: 3rem 2rem;">
                <span class="modern-badge mb-3" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; align-self: flex-start; animation: fadeIn 0.8s ease-out backwards;">{{ __('common.sakura_about_badge') }}</span>
                <h2 class="modern-h2 mb-4" style="font-size: 42px; font-weight: 900; color: #0a0e27; line-height: 1.2; animation: slideInDown 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s backwards;">{{ __('common.sakura_about_title') }}</h2>
                <p class="mb-5 text-muted" style="font-size: 16px; color: #666; font-weight: 500; line-height: 1.8; animation: fadeInUp 0.8s ease-out 0.2s backwards;">{{ __('common.sakura_about_description') }}</p>

                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center gap-4 p-5" style="background: rgba(255, 255, 255, 0.8); border: 1.5px solid rgba(232, 93, 142, 0.15); border-radius: 20px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); backdrop-filter: blur(10px); animation: fadeInUp 0.8s ease-out 0.3s backwards; min-height: 140px;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: white; font-size: 28px; flex-shrink: 0; box-shadow: 0 8px 20px rgba(232, 93, 142, 0.2);">
                                <i class="fas fa-image"></i>
                            </div>
                            <div>
                                <p class="mb-2 fw-bold" style="font-size: 17px; color: #0a0e27; line-height: 1.4;">{{ __('common.sakura_about_quality') }}</p>
                                <p class="mb-0" style="font-size: 14px; color: #666; line-height: 1.5;">{{ __('common.sakura_about_quality_desc') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex align-items-center gap-4 p-5" style="background: rgba(255, 255, 255, 0.8); border: 1.5px solid rgba(232, 93, 142, 0.15); border-radius: 20px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); backdrop-filter: blur(10px); animation: fadeInUp 0.8s ease-out 0.4s backwards; min-height: 140px;">
                            <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: white; font-size: 28px; flex-shrink: 0; box-shadow: 0 8px 20px rgba(232, 93, 142, 0.2);">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            <div>
                                <p class="mb-2 fw-bold" style="font-size: 17px; color: #0a0e27; line-height: 1.4;">{{ __('common.sakura_about_licensing') }}</p>
                                <p class="mb-0" style="font-size: 14px; color: #666; line-height: 1.5;">{{ __('common.sakura_about_licensing_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-info py-6" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ __('common.sakura_artworks_badge') }}</span>
            <h2 class="modern-h2 mt-3" style="font-size: 42px; font-weight: 900; color: #0a0e27; line-height: 1.2;">{{ __('common.sakura_artworks_title') }}</h2>
            <p class="text-muted mx-auto mt-3" style="max-width: 600px; font-size: 16px; color: #666;">{{ __('common.sakura_artworks_subtitle') }}</p>
        </div>

        <!-- Initial Products (6) -->
        <div class="row g-4 justify-content-center" id="initialProducts" style="max-width: 1200px; margin: 0 auto;">
            @php $products = Helper::getRandomProduct(6); @endphp

            @foreach($products as $product)
                <div class="col-lg-4 col-md-6">
                    <div class="product-course-card" style="border-radius: 20px; overflow: hidden; background: white; box-shadow: 0 10px 40px rgba(232, 93, 142, 0.12); border: 1.5px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); display: flex; flex-direction: column; height: 100%; cursor: pointer;">
                        <div class="course-img-container position-relative watermark-overlay" style="width: 100%; height: 220px; overflow: hidden; background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 100%);">
                            @php $photo = explode(',', $product->photo); @endphp
                            <img src="{{ $photo[0] }}" alt="{{ $product->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);">
                        </div>

                        <div class="course-content" style="padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column;">
                            <h4 class="course-title" style="font-size: 18px; font-weight: 700; color: #0a0e27; margin-bottom: 1rem;"><a href="{{ route('product-detail', $product->slug) }}" style="text-decoration: none; color: inherit; transition: color 0.3s ease;">{{ $product->title }}</a></h4>
                            <p class="course-summary" style="font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 1rem; flex-grow: 1; word-wrap: break-word; overflow-wrap: break-word;">{{ Str::limit($product->summary, 150) }}</p>

                            <div class="course-footer" style="margin-top: auto;">
                                <a href="{{ route('product-detail', $product->slug) }}" class="course-explore-btn" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 600; font-size: 14px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(232, 93, 142, 0.3);">
                                    {{ __('common.download_artwork') }} <i class="fas fa-chevron-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- All Products (Hidden initially) -->
        <div class="row g-4 d-none justify-content-center" id="allProductsContainer" style="max-width: 1200px; margin: 0 auto;">
            @php $allProducts = \App\Models\Product::where('status','active')->orderBy('created_at','DESC')->get(); @endphp

            @foreach($allProducts as $product)
                <div class="col-lg-4 col-md-6">
                    <div class="product-course-card" style="border-radius: 20px; overflow: hidden; background: white; box-shadow: 0 10px 40px rgba(232, 93, 142, 0.12); border: 1.5px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); display: flex; flex-direction: column; height: 100%; cursor: pointer;">
                        <div class="course-img-container position-relative watermark-overlay" style="width: 100%; height: 220px; overflow: hidden; background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 100%);">
                            @php $photo = explode(',', $product->photo); @endphp
                            <img src="{{ $photo[0] }}" alt="{{ $product->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);">
                        </div>

                        <div class="course-content" style="padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column;">
                            <h4 class="course-title" style="font-size: 18px; font-weight: 700; color: #0a0e27; margin-bottom: 1rem;"><a href="{{ route('product-detail', $product->slug) }}" style="text-decoration: none; color: inherit; transition: color 0.3s ease;">{{ $product->title }}</a></h4>
                            <p class="course-summary" style="font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 1rem; flex-grow: 1; word-wrap: break-word; overflow-wrap: break-word;">{{ Str::limit($product->summary, 150) }}</p>

                            <div class="course-footer" style="margin-top: auto;">
                                <a href="{{ route('product-detail', $product->slug) }}" class="course-explore-btn" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 600; font-size: 14px; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(232, 93, 142, 0.3);">
                                    {{ __('common.download_artwork') }} <i class="fas fa-chevron-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <button id="exploreAllBtn" class="modern-btn modern-btn-solid" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; padding: 12px 32px; border-radius: 50px; border: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 15px rgba(232, 93, 142, 0.3); transition: all 0.3s ease; cursor: pointer;">
                {{ __('common.sakura_artworks_cta') }} <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </div>
    </div>
</section>

<style>
    /* Product Card Hover Effects */
    .product-course-card:hover {
        box-shadow: 0 15px 50px rgba(232, 93, 142, 0.25) !important;
        transform: translateY(-8px);
        border-color: rgba(232, 93, 142, 0.3) !important;
    }

    .product-course-card:hover img {
        transform: scale(1.1);
    }

    .product-course-card:hover .course-explore-btn {
        background: linear-gradient(135deg, #d64577 0%, #b857e8 100%);
        box-shadow: 0 6px 16px rgba(232, 93, 142, 0.4);
        transform: translateY(-2px);
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Centered Product Section */
    #initialProducts, #allProductsContainer {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr);
        justify-items: center;
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Hide all products by default */
    #allProductsContainer.d-none {
        display: none !important;
    }

    #initialProducts > div, #allProductsContainer > div {
        animation: slideInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) backwards;
        width: 100%;
    }

    #initialProducts > div:nth-child(1) { animation-delay: 0.1s; }
    #initialProducts > div:nth-child(2) { animation-delay: 0.2s; }
    #initialProducts > div:nth-child(3) { animation-delay: 0.3s; }
    #initialProducts > div:nth-child(4) { animation-delay: 0.4s; }
    #initialProducts > div:nth-child(5) { animation-delay: 0.5s; }
    #initialProducts > div:nth-child(6) { animation-delay: 0.6s; }

    @media (max-width: 1024px) {
        #initialProducts, #allProductsContainer {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        #initialProducts, #allProductsContainer {
            grid-template-columns: 1fr;
        }
    }

    .course-summary {
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
        hyphens: auto;
    }
</style>

<script>
    document.getElementById('exploreAllBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const initialProducts = document.getElementById('initialProducts');
        const allProductsContainer = document.getElementById('allProductsContainer');
        const btn = this;

        if (allProductsContainer.classList.contains('d-none')) {
            // Show all products
            allProductsContainer.classList.remove('d-none');
            btn.innerHTML = '{{ __("common.sakura_artworks_cta") }} <i class="fas fa-chevron-up ms-2"></i>';
            btn.style.background = 'linear-gradient(135deg, #d64577 0%, #b857e8 100%)';
            // Scroll to products
            setTimeout(() => {
                allProductsContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        } else {
            // Hide all products
            allProductsContainer.classList.add('d-none');
            btn.innerHTML = '{{ __("common.sakura_artworks_cta") }} <i class="fas fa-arrow-right ms-2"></i>';
            btn.style.background = 'linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%)';
        }
    });
</script>

<section class="why-choose-section py-6" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="auto-container">
        <div class="text-center mb-5">
            <span class="modern-badge" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block; animation: fadeIn 0.8s ease-out backwards;">{{ __('common.sakura_why_badge') }}</span>
            <h2 class="modern-h2 mt-3" style="font-size: 42px; font-weight: 900; color: #0a0e27; line-height: 1.2; animation: slideInDown 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s backwards;">{{ __('common.sakura_why_title') }}</h2>
            <p style="font-size: 16px; color: #666; margin-top: 1.5rem; animation: fadeInUp 0.8s ease-out 0.2s backwards; max-width: 600px; margin-left: auto; margin-right: auto;">{{ __('common.sakura_why_description') ?? 'Discover the benefits of Chromatique Art' }}</p>
        </div>

        <div class="row g-4 justify-content-center" style="max-width: 1200px; margin: 0 auto;">
            <div class="col-lg-4 col-md-6">
                <div class="why-choose-card" style="background: rgba(255,255,255,0.6); border-radius: 20px; padding: 2.5rem 2rem; text-align: center; box-shadow: 0 10px 40px rgba(232, 93, 142, 0.12); border: 1.5px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); display: flex; flex-direction: column; align-items: center; gap: 1.5rem; animation: slideInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s backwards; height: 100%;">
                    <div class="why-icon-box" style="width: 80px; height: 80px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: white; font-size: 36px; flex-shrink: 0; box-shadow: 0 10px 30px rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                        <i class="fas fa-palette"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #0a0e27; margin-bottom: 0.75rem;">{{ __('common.sakura_why_expert_title') }}</h3>
                        <p style="font-size: 15px; color: #666; line-height: 1.6; margin: 0;">{{ __('common.sakura_why_expert_desc') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-choose-card" style="background: rgba(255,255,255,0.6); border-radius: 20px; padding: 2.5rem 2rem; text-align: center; box-shadow: 0 10px 40px rgba(232, 93, 142, 0.12); border: 1.5px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); display: flex; flex-direction: column; align-items: center; gap: 1.5rem; animation: slideInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s backwards; height: 100%;">
                    <div class="why-icon-box" style="width: 80px; height: 80px; background: linear-gradient(135deg, #C86BFA 0%, #E85D8E 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: white; font-size: 36px; flex-shrink: 0; box-shadow: 0 10px 30px rgba(200, 107, 250, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                        <i class="fas fa-award"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #0a0e27; margin-bottom: 0.75rem;">{{ __('common.sakura_why_industry_title') }}</h3>
                        <p style="font-size: 15px; color: #666; line-height: 1.6; margin: 0;">{{ __('common.sakura_why_industry_desc') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="why-choose-card" style="background: rgba(255,255,255,0.6); border-radius: 20px; padding: 2.5rem 2rem; text-align: center; box-shadow: 0 10px 40px rgba(232, 93, 142, 0.12); border: 1.5px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); display: flex; flex-direction: column; align-items: center; gap: 1.5rem; animation: slideInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.3s backwards; height: 100%;">
                    <div class="why-icon-box" style="width: 80px; height: 80px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: white; font-size: 36px; flex-shrink: 0; box-shadow: 0 10px 30px rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                        <i class="fas fa-images"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 20px; font-weight: 700; color: #0a0e27; margin-bottom: 0.75rem;">{{ __('common.sakura_why_projects_title') }}</h3>
                        <p style="font-size: 15px; color: #666; line-height: 1.6; margin: 0;">{{ __('common.sakura_why_projects_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .why-choose-card {
        height: 100%;
    }

    .why-choose-card:hover {
        box-shadow: 0 30px 80px rgba(232, 93, 142, 0.3) !important;
        border-color: rgba(232, 93, 142, 0.3) !important;
        transform: translateY(-12px);
        background: rgba(255,255,255,0.9) !important;
    }

    .why-choose-card:hover .why-icon-box {
        transform: scale(1.15) rotateZ(-5deg);
        box-shadow: 0 15px 50px rgba(232, 93, 142, 0.35) !important;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<section class="tech-hero-section" style="position: relative; min-height: 600px; display: flex; align-items: center; justify-content: center; overflow: visible;">
    <video class="tech-hero-video" autoplay loop muted playsinline preload="auto" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1;">
        <source src="{{ asset('assets/images/h1.mp4') }}" type="video/mp4">
    </video>
    <div class="tech-hero-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(232, 93, 142, 0.4) 0%, rgba(200, 107, 250, 0.3) 100%); z-index: 2;"></div>
</section>

<!-- Tech Hero Button Below -->
<div class="tech-hero-button-container" style="display: flex; justify-content: center; align-items: center; padding: 3rem 2rem; background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-contrast" style="background: transparent; color: #E85D8E; padding: 14px 40px; border-radius: 16px; border: 2.5px solid #E85D8E; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 8px 20px rgba(232, 93, 142, 0.15); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); cursor: pointer; text-transform: uppercase; letter-spacing: 0.5px; font-size: 14px;">
        {{ __('common.sakura_tech_hero_cta') }} <i class="fas fa-arrow-right ms-2"></i>
    </a>
</div>

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
