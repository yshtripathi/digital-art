@props([
    'title'     => '',      // Page heading (H1)
    'current'   => null,    // Current crumb label — defaults to the title
    'parent'    => null,    // Optional middle crumb label
    'parentUrl' => null,    // Optional middle crumb URL
])
@php $current = $current ?? $title; @endphp

{{-- ==========================================================================
     Breadcrumb — Structured theme (dark gallery room over a muted video)
     Background: b1.webm (main) with b1.webp as poster + hard fallback image.
     Flat surfaces, hairline border, serif title, hexagon separators.
     ========================================================================== --}}
<section class="st-breadcrumb" role="region" aria-label="Page header"
         style="background-image: url('{{ asset('assets/images/b1.webp') }}');">

    {{-- Main background video; poster (b1.webp) shows until/if the video plays --}}
    <video class="st-breadcrumb__media" autoplay muted loop playsinline preload="auto"
           poster="{{ asset('assets/images/b1.webp') }}">
        <source src="{{ asset('assets/images/b1.webm') }}" type="video/webm">
    </video>

    {{-- Flat ink veil so the white type stays legible over the imagery --}}
    <span class="st-breadcrumb__veil" aria-hidden="true"></span>

    <div class="st-breadcrumb__inner">
        
        <h1 class="st-breadcrumb__title">{{ $title }}</h1>

        <nav class="st-breadcrumb__nav" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">{{ __('common.home') }}</a>
            @if($parent)
                <span class="st-breadcrumb__sep" aria-hidden="true"></span>
                <a href="{{ $parentUrl ?? '#' }}">{{ $parent }}</a>
            @endif
            <span class="st-breadcrumb__sep" aria-hidden="true"></span>
            <span class="st-breadcrumb__current" aria-current="page">{{ $current }}</span>
        </nav>
    </div>
</section>

@once
<style>
    .st-breadcrumb {
        position: relative;
        width: 100%;
        min-height: 340px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: var(--color-ink, #000000);
        background-size: cover;          /* b1.webp ultimate fallback if <video> fails entirely */
        background-position: center;
        border-bottom: 1px solid var(--color-vellum, #dfdcd5);
    }

    .st-breadcrumb__media {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
        opacity: 1;                       /* only the video shows — b1.webp (poster / bg) is a fallback for load-fail */
        filter: grayscale(0.15) contrast(1.02);
        animation: st-bc-zoom 18s ease-in-out infinite alternate;  /* slow Ken Burns drift */
    }

    .st-breadcrumb__veil {
        position: absolute;
        inset: 0;
        z-index: 2;
        background: rgba(0, 0, 0, 0.42);  /* flat ink veil — no gradient */
        pointer-events: none;
    }

    .st-breadcrumb__inner {
        position: relative;
        z-index: 3;
        width: 100%;
        max-width: 1320px;
        margin: 0 auto;
        padding: 80px 48px;
        text-align: center;
        animation: st-bc-fade 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    .st-breadcrumb__eyebrow {
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.22em;
        color: rgba(255, 255, 255, 0.6);
        margin: 0 0 12px 0;
    }

    .st-breadcrumb__title {
        font-family: var(--font-davinci, 'Playfair Display', serif);
        font-size: clamp(34px, 5vw, 52px);
        font-weight: 500;
        line-height: 1.05;
        letter-spacing: -0.02em;
        color: var(--color-paper, #ffffff);
        margin: 0;
    }

    .st-breadcrumb__nav {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    .st-breadcrumb__nav a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .st-breadcrumb__nav a:hover { color: var(--color-paper, #ffffff); }
    .st-breadcrumb__current { color: var(--color-paper, #ffffff); }

    /* Hexagon separator — the theme's secondary brand shape */
    .st-breadcrumb__sep {
        display: inline-block;
        width: 5px;
        height: 5px;
        color: rgba(255, 255, 255, 0.4);
        background: currentColor;
        clip-path: polygon(50% 0, 100% 25%, 100% 75%, 50% 100%, 0 75%, 0 25%);
    }

    @keyframes st-bc-zoom {
        from { transform: scale(1); }
        to   { transform: scale(1.08); }
    }
    @keyframes st-bc-fade {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .st-breadcrumb { min-height: 240px; }
        .st-breadcrumb__inner { padding: 52px 24px; }
    }
    @media (prefers-reduced-motion: reduce) {
        .st-breadcrumb__media,
        .st-breadcrumb__inner { animation: none; }
    }
</style>
@endonce
