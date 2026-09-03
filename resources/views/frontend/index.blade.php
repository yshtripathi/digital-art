@extends('frontend.layouts.main')

@section('main-content')



<div class="duo-lp-wrap">
    
    {{-- 1. HERO SECTION --}}
    <style>
        .art-hero {
            position: relative;
            width: 100%;
            min-height: 60vh;
            display: flex;
            align-items: center;
            background-image: url('{{ asset('assets/photos/i6.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 120px 40px;
            box-sizing: border-box;
        }
        .art-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.65);
            z-index: 1;
        }
        .art-hero-container {
            position: relative;
            z-index: 2;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            gap: 40px;
        }
        .art-hero-left {
            flex: 1 1 45%;
            display: flex;
            justify-content: center;
        }
        .art-hero-left video {
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .art-hero-right {
            flex: 1 1 45%;
            color: #ffffff;
        }
        .art-hero-right h1 {
            font-family: 'Bodoni Moda', serif;
            font-size: 52px;
            line-height: 1.2;
            margin-bottom: 24px;
            font-weight: 400;
        }
        .art-hero-right p {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 32px;
            color: #e0e0e0;
            max-width: 90%;
        }
        .art-hero-btns {
            display: flex;
            gap: 16px;
        }
        .art-hero-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 32px;
            font-family: 'Bodoni Moda', serif;
            font-size: 14px;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #000000;
            background-color: #bc9c5c;
            border: 1px solid #bc9c5c;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .art-hero-btn:hover {
            background-color: transparent;
            color: #bc9c5c;
        }
        .art-hero-btn-outline {
            background-color: transparent;
            color: #ffffff;
            border-color: #ffffff;
        }
        .art-hero-btn-outline:hover {
            border-color: #bc9c5c;
            color: #bc9c5c;
        }
        @media (max-width: 991px) {
            .art-hero-container {
                flex-direction: column-reverse;
                text-align: center;
                margin-top: 40px;
            }
            .art-hero-right h1 {
                font-size: 36px;
            }
            .art-hero-right p {
                max-width: 100%;
            }
            .art-hero-btns {
                justify-content: center;
            }
        }
    </style>

    <section class="art-hero">
        <div class="art-hero-container">
            <div class="art-hero-left">
                <video autoplay loop muted playsinline>
                    <source src="{{ asset('assets/photos/v2.mp4') }}" type="video/mp4">
                </video>
            </div>
            <div class="art-hero-right">
                <h1>{{ __('inkwave.home_hero_title') }}</h1>
                <p>Immerse yourself in world-class art courses. Learn from masters, refine your skills, and unleash your creativity with our curated collection of expert-led programs.</p>
                <div class="art-hero-btns">
                    <a href="{{ route('product-lists') }}" class="art-hero-btn">{{ __('inkwave.home_hero_btn_start') }}</a>
                    @if(Auth::check())
                        <a href="{{ route('user') }}" class="art-hero-btn art-hero-btn-outline">{{ __('inkwave.home_hero_btn_account') }}</a>
                    @else
                        <a href="{{ route('login.form') }}" class="art-hero-btn art-hero-btn-outline">{{ __('inkwave.home_hero_btn_login') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- 1.5 ABOUT / COLLAGE SECTION --}}
    <style>
        .art-about {
            padding: 100px 40px;
           
            color: #0a0a0a;
        }
        .art-about-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 64px;
        }
        .art-about-left {
            flex: 1 1 45%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: auto auto;
            gap: 16px;
        }
        .art-about-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .art-about-img-1 {
            grid-column: 1 / 2;
            grid-row: 1 / 3;
            min-height: 400px;
        }
        .art-about-img-2 {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            min-height: 192px;
        }
        .art-about-img-3 {
            grid-column: 2 / 3;
            grid-row: 2 / 3;
            min-height: 192px;
        }
        .art-about-right {
             background-color: #f6f6f6; 
             padding: 32px;
            flex: 1 1 45%;
        }
        .art-about-right h2 {
            font-family: 'Bodoni Moda', serif;
            font-size: 42px;
            line-height: 1.2;
            margin-bottom: 24px;
            font-weight: 400;
        }
        .art-about-right p {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 24px;
            color: #555555;
        }
        .art-about-list {
            list-style: none;
            padding: 0;
            margin-bottom: 32px;
        }
        .art-about-list li {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: #333333;
        }
        .art-about-list li i {
            color: #bc9c5c;
            margin-top: 4px;
        }
        @media (max-width: 991px) {
            .art-about-container {
                flex-direction: column;
            }
            .art-about-left {
                width: 100%;
            }
        }
    </style>

    <section class="art-about">
        <div class="art-about-container">
            <div class="art-about-left">
                <img src="{{ asset('assets/photos/i1.webp') }}" alt="Art Course" class="art-about-img art-about-img-1" loading="lazy">
                <img src="{{ asset('assets/photos/i2.jpg') }}" alt="Art Materials" class="art-about-img art-about-img-2" loading="lazy">
                <img src="{{ asset('assets/photos/i3.jpg') }}" alt="Student Working" class="art-about-img art-about-img-3" loading="lazy">
            </div>
            <div class="art-about-right">
                <h2>Master the Fine Arts with Industry Professionals</h2>
                <p>Whether you're picking up a brush for the first time or refining your advanced techniques, our platform brings the world's most renowned art studios directly to your screen.</p>
                <p>Experience hands-on learning through high-definition video tutorials, comprehensive resources, and real-time feedback.</p>
                <ul class="art-about-list">
                    <li><i class="fas fa-check-circle"></i> <strong>Expert Guidance:</strong> Learn from award-winning contemporary artists.</li>
                    <li><i class="fas fa-check-circle"></i> <strong>Flexible Learning:</strong> Access your courses 24/7 from any device.</li>
                    <li><i class="fas fa-check-circle"></i> <strong>Vibrant Community:</strong> Connect with thousands of passionate creators worldwide.</li>
                </ul>
                <a href="{{ route('product-lists') }}" class="art-hero-btn">Explore Courses</a>
            </div>
        </div>
    </section>

    {{-- 2. PRODUCTS CAROUSEL --}}
    @php
        $visualProducts = \App\Models\Product::where('status','active')->get();
    @endphp
    @if($visualProducts->count() > 0)
    <style>
        .art-cat-carousel-section {
            padding: 100px 40px;
            position: relative;
            text-align: center;
        }
        .art-cat-carousel-section h2 {
            font-family: 'Bodoni Moda', serif;
            font-size: 42px;
            color: #0a0a0a;
            margin-bottom: 60px;
            font-weight: 400;
        }
        .art-cat-layout {
            max-width: 1500px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .art-cat-nav-btn {
            flex: 0 0 56px;
            height: 56px;
            background: #ffffff;
            color: #0a0a0a;
            border: 1px solid rgba(0,0,0,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            font-size: 20px;
        }
        .art-cat-nav-btn:hover {
            background: #bc9c5c;
            color: #ffffff;
            border-color: #bc9c5c;
        }
        .art-cat-scroll-container {
            flex: 1;
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            gap: 30px;
            padding-bottom: 20px;
            scrollbar-width: none;
        }
        .art-cat-scroll-container::-webkit-scrollbar {
            display: none;
        }
        .art-cat-scroll-card {
            flex: 0 0 calc(33.333% - 20px);
            scroll-snap-align: start;
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: left;
            display: flex;
            flex-direction: column;
        }
        .art-cat-scroll-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }
        .art-cat-scroll-img {
            height: 250px;
            width: 100%;
        }
        .art-cat-scroll-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .art-cat-scroll-img .placeholder {
            width: 100%;
            height: 100%;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: #ffffff;
        }
        .art-cat-scroll-content {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .art-cat-scroll-content h3 {
            font-family: 'Bodoni Moda', serif;
            font-size: 28px;
            color: #0a0a0a;
            margin-bottom: 16px;
            font-weight: 400;
        }
        .art-cat-scroll-content p {
            font-family: Arial, sans-serif;
            font-size: 15px;
            color: #555555;
            line-height: 1.6;
            margin-bottom: 24px;
            flex: 1;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        .art-cat-scroll-content .art-hero-btn {
            align-self: flex-start;
        }
        @media (max-width: 991px) {
            .art-cat-scroll-card {
                flex: 0 0 calc(50% - 15px);
            }
            .art-cat-nav-btn {
                display: none;
            }
        }
        @media (max-width: 767px) {
            .art-cat-scroll-card {
                flex: 0 0 100%;
            }
        }
    </style>

    <section class="art-cat-carousel-section">
        <h2>Explore Products</h2>
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
                            <a href="{{ route('product-detail', $product->slug) }}" class="art-hero-btn">View Product</a>
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
    <style>
        .art-how-section {
            padding: 100px 40px;
            text-align: center;
        }
        .art-how-title {
            font-family: 'Bodoni Moda', serif;
            font-size: 42px;
            color: #0a0a0a;
            margin-bottom: 60px;
            font-weight: 400;
        }
        .art-how-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }
        .art-how-card {
            background-color: #ffffff;
            padding: 50px 30px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0,0,0,0.03);
            text-align: center;
        }
        .art-how-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }
        .art-how-icon {
            width: 80px;
            height: 80px;
            background-color: rgba(188, 156, 92, 0.1);
            color: #bc9c5c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 24px auto;
        }
        .art-how-card h3 {
            font-family: 'Bodoni Moda', serif;
            font-size: 24px;
            color: #0a0a0a;
            margin-bottom: 16px;
            font-weight: 400;
        }
        .art-how-card p {
            font-family: Arial, sans-serif;
            font-size: 15px;
            color: #555555;
            line-height: 1.6;
        }
        @media (max-width: 991px) {
            .art-how-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 767px) {
            .art-how-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="art-how-section">
        <h2 class="art-how-title">How It Works</h2>
        <div class="art-how-grid">
            <div class="art-how-card">
                <div class="art-how-icon">
                    <i class="fas fa-compass"></i>
                </div>
                <h3>1. Explore Courses</h3>
                <p>Browse our curated selection of fine art courses. Filter by category, difficulty, or instructor to find the perfect fit for your creative journey.</p>
            </div>
            <div class="art-how-card">
                <div class="art-how-icon">
                    <i class="fas fa-play-circle"></i>
                </div>
                <h3>2. Learn from Masters</h3>
                <p>Watch high-definition video tutorials and follow step-by-step instructions from award-winning contemporary artists and professionals.</p>
            </div>
            <div class="art-how-card">
                <div class="art-how-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h3>3. Start Creating</h3>
                <p>Apply what you've learned to your own projects. Practice at your own pace and refine your unique artistic voice.</p>
            </div>
        </div>
    </section>




        {{-- 6. INSPIRATION GALLERY (Remaining Assets) --}}
    <style>
        .art-inspiration-section {
            padding: 100px 40px;
            background-color: #000000;
            color: #ffffff;
            text-align: center;
        }
        .art-inspiration-section h2 {
            font-family: 'Bodoni Moda', serif;
            font-size: 42px;
            margin-bottom: 20px;
            font-weight: 400;
        }
        .art-inspiration-section p {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #cccccc;
            max-width: 600px;
            margin: 0 auto 60px;
            line-height: 1.6;
        }
        .art-insp-grid {
            display: flex;
            gap: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }
        .art-insp-item {
            flex: 1;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }
        .art-insp-item img, .art-insp-item video {
            width: 100%;
            height: 500px;
            object-fit: cover;
            display: block;
        }
        @media (max-width: 991px) {
            .art-insp-grid {
                flex-direction: column;
            }
            .art-insp-item img, .art-insp-item video {
                height: 400px;
            }
        }
    </style>
    <section class="art-inspiration-section">
        <h2>Endless Inspiration</h2>
        <p>Immerse yourself in the creative process. Join a community of artists and start shaping your vision today.</p>
        <div class="art-insp-grid">
            <div class="art-insp-item">
                <video src="{{ asset('assets/photos/v1.mp4') }}" autoplay loop muted playsinline></video>
            </div>
            <div class="art-insp-item">
                <img src="{{ asset('assets/photos/i5.png') }}" alt="Creative Inspiration" loading="lazy">
            </div>
        </div>
    </section>

    {{-- 5. TOP UP SECTION (Imported from topup.blade.php) --}}
    <style>
    /* ==========================================================================
       Art Courses — Top Up (Credits) Page - Premium Table Layout
       ========================================================================== */
    .ag-topup-page, .ag-topup-page *, .ag-topup-page *::before, .ag-topup-page *::after {
        box-sizing: border-box;
    }
    .ag-topup-page {
        padding: 80px 40px;
    }
    .ag-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 5%;
    }

    .ag-topup-head {
        text-align: center;
        margin-bottom: 64px;
    }
    .ag-page-title {
        font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
        font-size: 56px !important;
        color: #000000 !important;
        margin-bottom: 16px !important;
        line-height: 1.1;
    }
    .ag-page-desc {
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 16px;
        color: #555555;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .ag-split-grid {
        display: flex;
        flex-direction: column;
        gap: 64px;
        max-width: 900px;
        margin: 0 auto;
    }

    /* ==========================================================================
       TOP COLUMN: Tiers Table
       ========================================================================== */
    .ag-table-card {
        background-color: #ffffff;
        padding: 48px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border-top: 6px solid #000000;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .ag-section-title {
        font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
        font-size: 32px;
        color: #000000;
        margin-bottom: 32px;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        padding-bottom: 16px;
    }
    .ag-table-wrap {
        overflow-x: auto;
        margin-bottom: 32px;
    }
    .ag-tiers-table {
        width: 100%;
        background-color: #ffffff;
        border-collapse: collapse;
        font-family: var(--font-arial, Arial, sans-serif);
    }
    .ag-tiers-table th, .ag-tiers-table td {
        padding: 20px 24px;
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        text-align: left;
        white-space: nowrap;
    }
    .ag-tiers-table th {
        background: #f5f5f5;
        font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #000000;
    }
    .ag-tiers-table td {
        font-size: 15px;
        color: #333333;
        vertical-align: middle;
    }
    .ag-tiers-table i {
        color: #bc9c5c;
        margin-right: 12px;
        font-size: 20px;
    }
    .ag-tiers-table strong {
        font-size: 16px;
        color: #000000;
    }
    .ag-badge {
        display: inline-block;
        background: #000000;
        color: #ffffff;
        font-size: 11px;
        padding: 6px 10px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-left: 16px;
        vertical-align: middle;
    }
    .ag-highlight {
        font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
        font-size: 24px;
        color: #bc9c5c;
        font-weight: bold;
    }
    .vip-row td {
        background: #faf8f5;
    }

    .ag-note {
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 13px;
        color: #888888;
        font-style: italic;
        line-height: 1.6;
        margin-bottom: 12px;
    }

    .ag-disclaimer-box {
        background-color: #faf8f5;
        border-left: 4px solid #bc9c5c;
        padding: 16px 24px;
        margin-top: 24px;
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 14px;
        color: #000000;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .ag-disclaimer-box i {
        color: #bc9c5c;
        font-size: 24px;
    }

    /* ==========================================================================
       BOTTOM COLUMN: Calculator Form
       ========================================================================== */
    .ag-calc-card {
        background: #ffffff;
        padding: 48px;
        border-top: 6px solid #000000;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }
    .ag-calc-title {
        font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
        font-size: 36px;
        color: #000000;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .ag-calc-title i { color: #bc9c5c; font-size: 28px; }
    .ag-calc-desc {
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 15px;
        color: #555555;
        margin-bottom: 40px;
    }

    .ag-form-group { margin-bottom: 40px; }
    .ag-label {
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: #888888;
        display: block;
        margin-bottom: 12px;
        font-weight: bold;
    }
    .ag-input-wrap {
        display: flex;
        align-items: center;
        background: #f5f5f5;
        border: 1px solid rgba(0,0,0,0.1);
        transition: border-color 0.3s ease;
    }
    .ag-input-wrap:focus-within {
        border-color: #000000;
    }
    .ag-currency-symbol {
        padding: 20px 24px;
        background: #eeeeee;
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 20px;
        color: #555555;
        font-weight: bold;
        border-right: 1px solid rgba(0,0,0,0.1);
    }
    .ag-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 20px;
        font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
        font-size: 32px;
        color: #000000;
        width: 100%;
        background: transparent;
    }

    .ag-calc-stats {
        background: #f5f5f5;
        padding: 32px;
        margin-bottom: 40px;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .ag-calc-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 15px;
        color: #555555;
    }
    .ag-calc-total {
        margin-top: 24px;
        padding-top: 24px;
        border-top: 1px solid rgba(0,0,0,0.1);
        margin-bottom: 0;
        font-size: 18px;
        font-weight: bold;
        color: #000000;
    }
    .ag-calc-total span:last-child {
        font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
        font-size: 40px;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #000000;
        line-height: 1;
    }
    .ag-calc-total i {
        color: #bc9c5c;
        font-size: 32px;
    }

    button[type="submit"].ag-submit-btn {
        width: 100%;
        background: #000000 !important;
        color: #ffffff !important;
        border: 1px solid #000000 !important;
        font-family: Arial, sans-serif !important;
        font-size: 14px !important;
        font-weight: bold !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        padding: 24px !important;
        display: flex !important;
        justify-content: center;
        align-items: center;
        gap: 12px;
    }
    button[type="submit"].ag-submit-btn:hover {
        background: #ffffff !important;
        color: #000000 !important;
    }

    .ag-trust-note {
        text-align: center;
        margin-top: 24px;
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 13px;
        color: #888888;
    }
    .ag-trust-note i {
        color: #bc9c5c;
        margin-right: 8px;
    }
    </style>

    <div class="ag-topup-page">
        <div class="ag-container">
            
            <div class="ag-topup-head">
                <h2 class="ag-page-title">{{ __('inkwave.tu_heading') }}</h2>
                <p class="ag-page-desc">{{ __('inkwave.tu_sub') }}</p>
            </div>

            @php
                $cur = session('currency');
                if ($cur == 'JPY') {
                    $tiers = [
                        ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'&yen;1 - &yen;79,999',        'f'=>false],
                        ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'&yen;80,000 - &yen;159,999',  'f'=>false],
                        ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'&yen;160,000 - &yen;239,999', 'f'=>false],
                        ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'&yen;240,000+',           'f'=>true],
                    ];
                } elseif ($cur == 'HKD') {
                    $tiers = [
                        ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'HK$1 - HK$3,999',       'f'=>false],
                        ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'HK$4,000 - HK$7,999',     'f'=>false],
                        ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
                        ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'HK$12,000+',           'f'=>true],
                    ];
                } else {
                    $tiers = [
                        ['n'=>__('inkwave.tu_tier_standard'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'$1 - $499',       'f'=>false],
                        ['n'=>__('inkwave.tu_tier_premium'),  'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'$500 - $999',     'f'=>false],
                        ['n'=>__('inkwave.tu_tier_elite'),    'i'=>'fa-gem',     'big'=>'x2',   'r'=>'$1,000 - $1,499', 'f'=>false],
                        ['n'=>__('inkwave.tu_tier_vip'),      'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'$1,500+',         'f'=>true],
                    ];
                }
            @endphp

            <div class="ag-split-grid">
                
                <div class="ag-table-card">
                    <h2 class="ag-section-title">Credit Tiers & Bonuses</h2>
                    
                    <div class="ag-table-wrap">
                        <table class="ag-tiers-table">
                            <thead>
                                <tr>
                                    <th>Tier</th>
                                    <th>Purchase Range</th>
                                    <th>Bonus Multiplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tiers as $t)
                                    <tr class="{{ $t['f'] ? 'vip-row' : '' }}">
                                        <td>
                                            <i class="fas {{ $t['i'] }}"></i> 
                                            <strong>{{ $t['n'] }}</strong>
                                            @if($t['f']) <span class="ag-badge">{{ __('inkwave.tu_best_value') }}</span> @endif
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
                            {{ __('inkwave.tu_jpy_conversion_note') }}
                        @elseif(session('currency') == 'HKD')
                            {{ __('inkwave.tu_hkd_conversion_note') }}
                        @else
                            {{ __('inkwave.tu_usd_conversion_note') }}
                        @endif
                    </p>
                    <div class="ag-disclaimer-box">
                        <i class="fas fa-exclamation-circle"></i> 
                        <div>
                            <strong>Note:</strong> Credits purchased are strictly for use on this website and are non-transferable and non-refundable.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="ag-calc-card">
                        <h2 class="ag-calc-title"><i class="fas fa-calculator"></i> {{ __('inkwave.tu_calc_title') }}</h2>
                        <p class="ag-calc-desc">{{ __('inkwave.tu_calc_tagline') }}</p>
                        
                        <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-form">
                            @csrf
                            
                            <div class="ag-form-group">
                                <label class="ag-label">{{ __('inkwave.tu_calc_input_label') }}</label>
                                <div class="ag-input-wrap">
                                    <span class="ag-currency-symbol">{!! session('currency') == 'JPY' ? '&yen;' : '$' !!}</span>
                                    <input type="number" name="amount" id="topup_amount" class="ag-input" placeholder="0" min="1" required>
                                </div>
                            </div>

                            <div class="ag-calc-stats">
                                <div class="ag-calc-row">
                                    <span>{{ __('inkwave.tu_calc_base_points') }}:</span>
                                    <span id="base_points">0</span>
                                </div>
                                <div class="ag-calc-row">
                                    <span>{{ __('inkwave.tu_calc_tier_bonus') }}:</span>
                                    <span id="multiplier_display">x1</span>
                                </div>
                                <div class="ag-calc-row ag-calc-total">
                                    <span>{{ __('inkwave.tu_calc_youll_get') }}:</span>
                                    <span><i class="fas fa-coins"></i> <span id="total_points">0</span></span>
                                </div>
                            </div>

                            <button type="submit" class="ag-submit-btn topup-btn">
                                <span>{{ __('inkwave.tu_calc_button') }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                            
                            <p class="ag-trust-note">
                                <i class="fas fa-shield-alt"></i> {{ __('inkwave.tu_calc_trust_message') }}
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
