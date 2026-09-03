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
