@extends('frontend.layouts.main')
@section('title', __('inkwave.about_page_title'))
@section('main-content')

<x-breadcrumb :title="__('inkwave.about_page_title')" />

{{-- ============================================================
     SECTION 1 — OUR STORY (text + image a1.webp)
     ============================================================ --}}
<section class="abt-section abt-story">
    <div class="abt-container abt-split">
        <div class="abt-split__text">
            <p class="abt-eyebrow">{{ __('inkwave.about_intro_eyebrow') }}</p>
            <h2 class="abt-heading">{{ __('inkwave.about_intro_heading') }}</h2>
            <p class="abt-lead">{{ __('inkwave.about_intro_lead') }}</p>
            <p class="abt-body">{{ __('inkwave.about_intro_body') }}</p>

            <div class="abt-tags">
                <span>{{ __('inkwave.about_tag_anime') }}</span>
                <span>{{ __('inkwave.about_tag_pixel') }}</span>
                <span>{{ __('inkwave.about_tag_pop') }}</span>
                <span>{{ __('inkwave.about_tag_street') }}</span>
                <span>{{ __('inkwave.about_tag_ukiyo') }}</span>
            </div>
        </div>

        <div class="abt-split__media">
            <figure class="abt-frame abt-frame--tall">
                <img src="{{ asset('assets/images/a1.webp') }}" alt="{{ __('inkwave.about_intro_heading') }}" loading="lazy">
            </figure>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 2 — PHILOSOPHY (full-bleed video h2.webm)
     ============================================================ --}}
<section class="abt-manifesto">
    <video class="abt-manifesto__video" autoplay muted loop playsinline preload="auto" poster="{{ asset('assets/images/a2.webp') }}">
        <source src="{{ asset('assets/images/h2.webm') }}" type="video/webm">
    </video>
    <span class="abt-manifesto__veil" aria-hidden="true"></span>
    <div class="abt-container abt-manifesto__inner">
        <p class="abt-manifesto__label">{{ __('inkwave.about_manifesto_label') }}</p>
        <p class="abt-manifesto__quote">
            {{ __('inkwave.about_manifesto_quote') }}
        </p>
    </div>
</section>

{{-- ============================================================
     SECTION 3 — WHAT SETS US APART (value cards)
     ============================================================ --}}
<section class="abt-section abt-values">
    <div class="abt-container">
        <div class="abt-head">
            <p class="abt-eyebrow">{{ __('inkwave.about_standards_eyebrow') }}</p>
            <h2 class="abt-heading abt-heading--center">{{ __('inkwave.about_standards_heading') }}</h2>
        </div>

        <div class="abt-values__grid">
            <div class="abt-value">
                <span class="abt-value__icon"><i class="fas fa-image"></i></span>
                <h3 class="abt-value__title">{{ __('inkwave.about_standard_1_title') }}</h3>
                <p class="abt-value__desc">{{ __('inkwave.about_standard_1_desc') }}</p>
            </div>
            <div class="abt-value">
                <span class="abt-value__icon"><i class="fas fa-certificate"></i></span>
                <h3 class="abt-value__title">{{ __('inkwave.about_standard_2_title') }}</h3>
                <p class="abt-value__desc">{{ __('inkwave.about_standard_2_desc') }}</p>
            </div>
            <div class="abt-value">
                <span class="abt-value__icon"><i class="fas fa-palette"></i></span>
                <h3 class="abt-value__title">{{ __('inkwave.about_standard_3_title') }}</h3>
                <p class="abt-value__desc">{{ __('inkwave.about_standard_3_desc') }}</p>
            </div>
            <div class="abt-value">
                <span class="abt-value__icon"><i class="fas fa-download"></i></span>
                <h3 class="abt-value__title">{{ __('inkwave.about_standard_4_title') }}</h3>
                <p class="abt-value__desc">{{ __('inkwave.about_standard_4_desc') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 4 — THE CRAFT (image a2.webp + text, reversed)
     ============================================================ --}}
<section class="abt-section abt-craft">
    <div class="abt-container abt-split abt-split--reverse">
        <div class="abt-split__media">
            <figure class="abt-frame abt-frame--wide">
                <img src="{{ asset('assets/images/a2.webp') }}" alt="{{ __('inkwave.about_process_heading') }}" loading="lazy">
            </figure>
        </div>

        <div class="abt-split__text">
            <p class="abt-eyebrow">{{ __('inkwave.about_process_eyebrow') }}</p>
            <h2 class="abt-heading">{{ __('inkwave.about_process_heading') }}</h2>
            <p class="abt-body">{{ __('inkwave.about_process_body') }}</p>
            <ul class="abt-checklist">
                <li><i class="fas fa-check"></i> {{ __('inkwave.about_process_check_1') }}</li>
                <li><i class="fas fa-check"></i> {{ __('inkwave.about_process_check_2') }}</li>
                <li><i class="fas fa-check"></i> {{ __('inkwave.about_process_check_3') }}</li>
            </ul>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 5 — CTA (ink room)
     ============================================================ --}}
<section class="abt-cta">
    <div class="abt-container">
        <h2 class="abt-cta__heading">{{ __('inkwave.about_cta_heading') }}</h2>
        <p class="abt-cta__sub">{{ __('inkwave.about_cta_sub') }}</p>
        <a href="{{ route('product-lists') }}" class="abt-cta__btn">{{ __('inkwave.about_cta_btn') }} <i class="fas fa-arrow-right"></i></a>
    </div>
</section>



@endsection
