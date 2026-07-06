<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    {{-- SEO Meta --}}
    <title>@yield('title', 'Inkwave – Premium Anime, Pixel, Pop, Street & Ukiyo-e Art')</title>
    <meta name="title" content="Inkwave – Premium Digital Art Prints">
    <meta name="description" content="Inkwave offers high-resolution premium digital art prints across Anime & Manga, Pixel Art, Pop Art, Street Art, and Modern Ukiyo-e collections — expressive, collectible, and ready to display.">
    <meta name="keywords" content="digital art, premium art prints, anime art, manga art, pixel art, retro game art, pop art, halftone art, street art, graffiti art, ukiyo-e, modern woodblock print, japanese art, inkwave">
    <meta name="author" content="Inkwave">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Inkwave – Premium Digital Art Prints')">
    <meta property="og:description" content="Premium digital art prints spanning Anime & Manga, Pixel Art, Pop Art, Street Art, and Modern Ukiyo-e — high-resolution collectible artwork ready to display.">
    @if(isset($og_image))
    <meta property="og:image" content="{{ $og_image }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Inkwave">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@inkwave">
    <meta name="twitter:creator" content="@inkwave">
    <meta name="twitter:title" content="@yield('title', 'Inkwave – Premium Digital Art Prints')">
    <meta name="twitter:description" content="Premium digital art prints spanning Anime & Manga, Pixel Art, Pop Art, Street Art, and Modern Ukiyo-e — high-resolution collectible artwork ready to display.">
    @if(isset($og_image))
    <meta name="twitter:image" content="{{ $og_image }}">
    @endif

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('assets/images/favicon.ico') }}" type="image/x-icon">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css">
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Google Fonts: Playfair Display (display serif) + Inter (utility grotesk) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Playfair+Display:wght@400;500&display=swap" rel="stylesheet">

    {{-- Structured theme (Renaissance gallery on putty paper) --}}
    <link href="{{ url('css/structured.css') }}" rel="stylesheet">

    {{-- Preloader Styles — Inkwave gallery loader (flat, no gradients, no shadows) --}}
    <style>
        #preloader {
            position: fixed;
            inset: 0;
            background: var(--color-putty, #c4c3b6);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .st-preloader {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            animation: st-pre-in 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) both;
        }
        /* Serif brand wordmark — the gallery voice */
        .st-preloader__mark {
            font-family: var(--font-davinci, 'Playfair Display', Georgia, serif);
            font-size: clamp(44px, 9vw, 88px);
            font-weight: 500;
            letter-spacing: -0.03em;
            line-height: 1;
            color: var(--color-ink, #000000);
        }
        /* Museum wall-label caption */
        .st-preloader__label {
            font-family: var(--font-helvetica-now, 'Inter', sans-serif);
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--color-graphite, #595855);
            animation: st-pre-pulse 1.6s ease-in-out infinite;
        }
        /* Hairline indeterminate progress — ink segment sweeping a vellum track */
        .st-preloader__bar {
            position: relative;
            width: 160px;
            height: 2px;
            background: var(--color-vellum, #dfdcd5);
            overflow: hidden;
        }
        .st-preloader__bar span {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 40%;
            background: var(--color-ink, #000000);
            animation: st-pre-slide 1.2s cubic-bezier(0.65, 0, 0.35, 1) infinite;
        }
        @keyframes st-pre-slide {
            0%   { transform: translateX(-100%); }
            100% { transform: translateX(400%); }
        }
        @keyframes st-pre-pulse {
            0%, 100% { opacity: 0.4; }
            50%      { opacity: 1; }
        }
        @keyframes st-pre-in {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @media (prefers-reduced-motion: reduce) {
            .st-preloader,
            .st-preloader__label,
            .st-preloader__bar span { animation: none; }
        }
    </style>

    @cookieconsentscripts
</head>

<body>
<div class="page-wrapper">

    {{-- Preloader --}}
    <div id="preloader">
        <div class="st-preloader">
            <div class="st-preloader__mark">Inkwave</div>
            <div class="st-preloader__label">Curating the collection</div>
            <div class="st-preloader__bar"><span></span></div>
        </div>
    </div>
