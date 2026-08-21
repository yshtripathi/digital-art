@extends('frontend.layouts.main')
@section('title', __('inkwave.about_page_title'))
@section('main-content')

{{-- Inject the new Breadcrumb component --}}
@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.about_page_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.about_page_title')]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme About Page - New Layout
------------------------------------------- */
.duo-about-wrapper {
    background-color: var(--color-paper-white, #ffffff);
    padding-bottom: 100px;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
}
.duo-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 24px;
}

/* SECTION 1: Giant Hero Card */
.duo-hero-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 12px 0 #e5e5e5;
    margin: 64px auto;
    text-align: center;
}
.duo-hero-card__img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-bottom: 2px solid #e5e5e5;
}
.duo-hero-card__body {
    padding: 48px;
    background-color: var(--color-studio-purple, #f3e8ff);
}
.duo-hero-card__eyebrow {
    font-size: 17px;
    font-weight: 700;
    color: var(--color-spark-blue, #1cb0f6);
    text-transform: uppercase;
    letter-spacing: 0.053em;
    margin-bottom: 16px;
}
.duo-hero-card__title {
    font-size: 48px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    line-height: 1.2;
    margin-bottom: 24px;
    letter-spacing: -0.02em;
}
.duo-hero-card__desc {
    font-size: 19px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    line-height: 1.5;
    max-width: 700px;
    margin: 0 auto 32px;
}
.duo-tags {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}
.duo-tag {
    background: var(--color-paper-white, #ffffff);
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    padding: 12px 24px;
    font-size: 15px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
}

/* SECTION 2: Vertical Value List */
.duo-values-section {
    padding: 64px 0;
}
.duo-values-header {
    text-align: center;
    margin-bottom: 64px;
}
.duo-values-header h2 {
    font-size: 40px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
}
.duo-values-list {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.duo-value-item {
    display: flex;
    align-items: center;
    gap: 32px;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 6px 0 #e5e5e5;
    transition: transform 0.1s;
}
.duo-value-item:hover {
    transform: translateX(8px);
}
.duo-value-item:nth-child(1) {
    background-color: var(--color-cloud-blue, #eaf7ff);
}
.duo-value-item:nth-child(2) {
    background-color: var(--color-corp-mint, #e0f7e9);
}
.duo-value-item:nth-child(3) {
    background-color: var(--color-soft-amber, #ffecb3);
}
.duo-value-item:nth-child(4) {
    background-color: var(--color-muted-coral, #ffcdd2);
}
.duo-value-item__icon {
    flex-shrink: 0;
    width: 80px;
    height: 80px;
    background: var(--color-spark-blue, #1cb0f6);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: #ffffff;
    border: 2px solid #1899d6;
    box-shadow: 0 4px 0 #1899d6;
}
/* Alternate icon colors for fun */
.duo-value-item:nth-child(2) .duo-value-item__icon {
    background: var(--color-eager-green, #58cc02);
    border-color: #46a302;
    box-shadow: 0 4px 0 #46a302;
}
.duo-value-item:nth-child(3) .duo-value-item__icon {
    background: #ff4b4b; /* Rose Red */
    border-color: #d13a3a;
    box-shadow: 0 4px 0 #d13a3a;
}
.duo-value-item:nth-child(4) .duo-value-item__icon {
    background: #ffc800; /* Sunflower */
    border-color: #d6a700;
    box-shadow: 0 4px 0 #d6a700;
}

.duo-value-item__content {
    flex: 1;
}
.duo-value-item__title {
    font-size: 24px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 8px;
    margin-top: 0;
}
.duo-value-item__desc {
    font-size: 17px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    margin: 0;
    line-height: 1.5;
}

/* SECTION 3: Slim CTA Banner */
.duo-cta-banner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--color-spark-blue, #1cb0f6);
    border-radius: 32px;
    padding: 48px;
    margin-top: 64px;
    border: 2px solid #1899d6;
    box-shadow: 0 8px 0 #1899d6;
}
.duo-cta-banner__text h2 {
    font-size: 40px;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 8px 0;
}
.duo-cta-banner__text p {
    font-size: 19px;
    font-weight: 500;
    color: #eaf7ff;
    margin: 0;
}
.duo-cta-banner__btn {
    flex-shrink: 0;
    background: #ffffff;
    color: var(--color-spark-blue, #1cb0f6);
    padding: 20px 40px;
    border-radius: 24px;
    font-size: 19px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.053em;
    text-decoration: none;
    border: 2px solid #e5e5e5;
    box-shadow: 0 6px 0 #e5e5e5;
    transition: all 0.1s;
}
.duo-cta-banner__btn:hover {
    background: #f7f7f7;
    color: var(--color-spark-blue, #1cb0f6);
}
.duo-cta-banner__btn:active {
    transform: translateY(6px);
    box-shadow: 0 0 0 #e5e5e5;
}

@media (max-width: 768px) {
    .duo-hero-card__body { padding: 32px 24px; }
    .duo-hero-card__title { font-size: 32px; }
    .duo-value-item { flex-direction: column; text-align: center; gap: 16px; }
    .duo-cta-banner { flex-direction: column; text-align: center; gap: 32px; }
}
</style>

<div class="duo-about-wrapper">

    {{-- SECTION 1: Giant Hero Card --}}
    <section class="duo-container">
        <div class="duo-hero-card">
            <video class="duo-hero-card__img" autoplay loop muted playsinline>
                <source src="{{ asset('assets/images/v3.mp4') }}" type="video/mp4">
            </video>
            <div class="duo-hero-card__body">
                <p class="duo-hero-card__eyebrow">{{ __('inkwave.about_intro_eyebrow') }}</p>
                <h2 class="duo-hero-card__title">{{ __('inkwave.about_intro_heading') }}</h2>
                <p class="duo-hero-card__desc">
                    {{ __('inkwave.about_intro_lead') }} {{ __('inkwave.about_intro_body') }}
                </p>
                <div class="duo-tags">
                    <span class="duo-tag">{{ __('inkwave.about_tag_talk') }}</span>
                    <span class="duo-tag">{{ __('inkwave.about_tag_career') }}</span>
                    <span class="duo-tag">{{ __('inkwave.about_tag_tech') }}</span>
                    <span class="duo-tag">{{ __('inkwave.about_tag_creative') }}</span>
                    <span class="duo-tag">{{ __('inkwave.about_tag_life') }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2: Vertical Value List --}}
    <section class="duo-values-section duo-container">
        <div class="duo-values-header">
            <h2>{{ __('inkwave.about_standards_heading') }}</h2>
        </div>

        <div class="duo-values-list">
            <div class="duo-value-item">
                <div class="duo-value-item__icon"><i class="fas fa-image"></i></div>
                <div class="duo-value-item__content">
                    <h3 class="duo-value-item__title">{{ __('inkwave.about_standard_1_title') }}</h3>
                    <p class="duo-value-item__desc">{{ __('inkwave.about_standard_1_desc') }}</p>
                </div>
            </div>
            
            <div class="duo-value-item">
                <div class="duo-value-item__icon"><i class="fas fa-certificate"></i></div>
                <div class="duo-value-item__content">
                    <h3 class="duo-value-item__title">{{ __('inkwave.about_standard_2_title') }}</h3>
                    <p class="duo-value-item__desc">{{ __('inkwave.about_standard_2_desc') }}</p>
                </div>
            </div>

            <div class="duo-value-item">
                <div class="duo-value-item__icon"><i class="fas fa-star"></i></div>
                <div class="duo-value-item__content">
                    <h3 class="duo-value-item__title">{{ __('inkwave.about_standard_3_title') }}</h3>
                    <p class="duo-value-item__desc">{{ __('inkwave.about_standard_3_desc') }}</p>
                </div>
            </div>

            <div class="duo-value-item">
                <div class="duo-value-item__icon"><i class="fas fa-download"></i></div>
                <div class="duo-value-item__content">
                    <h3 class="duo-value-item__title">{{ __('inkwave.about_standard_4_title') }}</h3>
                    <p class="duo-value-item__desc">{{ __('inkwave.about_standard_4_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 3: Slim CTA Banner --}}
    <section class="duo-container">
        <div class="duo-cta-banner">
            <div class="duo-cta-banner__text">
                <h2>{{ __('inkwave.about_cta_heading') }}</h2>
                <p>{{ __('inkwave.about_cta_sub') }}</p>
            </div>
            <a href="{{ route('product-lists') }}" class="duo-cta-banner__btn">
                {{ __('inkwave.about_cta_btn') }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

</div>

@endsection
