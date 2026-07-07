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

<style>
    /* =========================================================
       ABOUT — Structured theme (flat, putty/ink, serif display)
       ========================================================= */
    .abt-container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 40px; }
    .abt-section { padding: 96px 0; }
    .abt-story  { background-color: var(--color-putty, #c4c3b6); }
    .abt-values { background-color: var(--color-bone, #e7e5e4); }
    .abt-craft  { background-color: var(--color-putty, #c4c3b6); }

    /* Shared type */
    .abt-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 11px; font-weight: 600; text-transform: uppercase;
        letter-spacing: 0.18em; color: var(--color-graphite, #595855); margin: 0 0 12px 0;
    }
    .abt-heading {
        font-family: var(--font-davinci, serif);
        font-size: clamp(28px, 3.6vw, 44px); font-weight: 500;
        line-height: 1.12; letter-spacing: -0.01em;
        color: var(--color-ink, #000); margin: 0 0 20px 0;
    }
    .abt-heading--center { text-align: center; margin-left: auto; margin-right: auto; max-width: 640px; }
    .abt-lead {
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 17px; line-height: 1.7; color: var(--color-ink, #000);
        margin: 0 0 16px 0; max-width: 560px;
    }
    .abt-body {
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 15px; line-height: 1.8; color: var(--color-graphite, #595855);
        margin: 0 0 24px 0; max-width: 560px;
    }

    /* Split (text + media) */
    .abt-split { display: flex; align-items: center; gap: 56px; }
    .abt-split--reverse { flex-direction: row-reverse; }
    .abt-split__text { flex: 1 1 48%; min-width: 0; }
    .abt-split__media { flex: 1 1 52%; min-width: 0; }

    .abt-frame {
        margin: 0; overflow: hidden;
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 12px; background-color: var(--color-bone, #e7e5e4);
        box-shadow: none;
    }
    .abt-frame img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .abt-frame--tall { aspect-ratio: 4 / 5; }
    .abt-frame--wide { aspect-ratio: 5 / 4; }

    /* Movement tags */
    .abt-tags { display: flex; flex-wrap: wrap; gap: 8px; }
    .abt-tags span {
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em;
        color: var(--color-ink, #000);
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 28.8px; padding: 6px 14px;
    }

    /* Manifesto video band */
    .abt-manifesto {
        position: relative; overflow: hidden;
        min-height: 460px; display: flex; align-items: center; justify-content: center;
        background-color: var(--color-ink, #000);
        border-top: 1px solid var(--color-vellum, #dfdcd5);
        border-bottom: 1px solid var(--color-vellum, #dfdcd5);
    }
    .abt-manifesto__video {
        position: absolute; inset: 0; width: 100%; height: 100%;
        object-fit: cover; z-index: 1; filter: grayscale(0.15) contrast(1.02);
    }
    .abt-manifesto__veil { position: absolute; inset: 0; z-index: 2; background: rgba(0, 0, 0, 0.5); pointer-events: none; }
    .abt-manifesto__inner { position: relative; z-index: 3; text-align: center; padding-top: 80px; padding-bottom: 80px; }
    .abt-manifesto__label {
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.22em;
        color: rgba(255, 255, 255, 0.6); margin: 0 0 20px 0;
    }
    .abt-manifesto__quote {
        font-family: var(--font-davinci, serif);
        font-size: clamp(24px, 3.4vw, 40px); font-weight: 500; line-height: 1.28;
        letter-spacing: -0.01em; color: var(--color-paper, #fff);
        margin: 0 auto; max-width: 900px;
    }

    /* Values grid */
    .abt-head { text-align: center; margin-bottom: 48px; }
    .abt-values__grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
    }
    .abt-value {
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 12px; padding: 30px 26px; box-shadow: none;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .abt-value:hover { transform: translateY(-6px); }
    .abt-value__icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 46px; height: 46px; margin-bottom: 18px;
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 50%;
        color: var(--color-ink, #000); font-size: 16px;
        background-color: var(--color-bone, #e7e5e4);
    }
    .abt-value__title {
        font-family: var(--font-davinci, serif); font-size: 19px; font-weight: 500;
        color: var(--color-ink, #000); margin: 0 0 10px 0; line-height: 1.25;
    }
    .abt-value__desc {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13.5px; line-height: 1.6;
        color: var(--color-graphite, #595855); margin: 0;
    }

    /* Checklist */
    .abt-checklist { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
    .abt-checklist li {
        display: flex; align-items: center; gap: 12px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px;
        color: var(--color-ink, #000);
    }
    .abt-checklist li i {
        color: var(--color-ink, #000); font-size: 11px; flex-shrink: 0;
        width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 50%;
        background-color: var(--color-paper, #fff);
    }

    /* CTA */
    .abt-cta {
        background-color: var(--color-ink, #000); text-align: center;
        padding: 100px 0;
    }
    .abt-cta__heading {
        font-family: var(--font-davinci, serif); font-size: clamp(30px, 4vw, 52px); font-weight: 500;
        line-height: 1.08; letter-spacing: -0.02em; color: var(--color-paper, #fff); margin: 0 0 14px 0;
    }
    .abt-cta__sub {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; line-height: 1.6;
        color: rgba(255, 255, 255, 0.65); margin: 0 auto 32px auto; max-width: 480px;
    }
    .abt-cta__btn {
        display: inline-flex; align-items: center; gap: 10px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        background-color: var(--color-paper, #fff); color: var(--color-ink, #000);
        border: 1px solid var(--color-paper, #fff); border-radius: 28.8px;
        padding: 14px 28px; text-decoration: none;
        transition: opacity 0.2s ease;
    }
    .abt-cta__btn:hover { opacity: 0.85; color: var(--color-ink, #000); text-decoration: none; }

    /* Responsive */
    @media (max-width: 900px) {
        .abt-section { padding: 64px 0; }
        .abt-split, .abt-split--reverse { flex-direction: column; gap: 36px; }
        .abt-split__text, .abt-split__media { flex-basis: 100%; width: 100%; }
        .abt-lead, .abt-body { max-width: none; }
        .abt-values__grid { grid-template-columns: repeat(2, 1fr); }
        .abt-manifesto { min-height: 380px; }
    }
    @media (max-width: 560px) {
        .abt-container { padding: 0 20px; }
        .abt-values__grid { grid-template-columns: 1fr; }
    }
</style>

@endsection
