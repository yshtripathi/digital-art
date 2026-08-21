<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    {{-- SEO Meta --}}
    <title>@yield('title', '[Website Name] – Online Courses in Tech, Career, Creative & Life Skills')</title>
    <meta name="title" content="[Website Name] – Online Courses">
    <meta name="description" content="[Website Name] offers practical online courses in languages, career development, technology, creative arts, and everyday life skills. Learn step by step, anytime.">
    <meta name="keywords" content="online courses, language learning, career skills, coding, technology courses, creative arts, digital art, life skills, personal finance, self-improvement, [Website Name]">
    <meta name="author" content="[Website Name]">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', '[Website Name] – Online Courses')">
    <meta property="og:description" content="[Website Name] offers practical online courses in languages, career development, technology, creative arts, and everyday life skills. Learn step by step, anytime.">
    @if(isset($og_image))
    <meta property="og:image" content="{{ $og_image }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="[Website Name]">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@[Website Name]">
    <meta name="twitter:creator" content="@[Website Name]">
    <meta name="twitter:title" content="@yield('title', '[Website Name] – Online Courses')">
    <meta name="twitter:description" content="[Website Name] offers practical online courses in languages, career development, technology, creative arts, and everyday life skills. Learn step by step, anytime.">
    @if(isset($og_image))
    <meta name="twitter:image" content="{{ $og_image }}">
    @endif

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ url('assets/images/favicon.png') }}" type="image/png">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css">
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Google Fonts: Nunito (display) + Nunito Sans (body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&family=Nunito+Sans:wght@500;700&display=swap" rel="stylesheet">

    {{-- Application Styles (contains Duolingo Theme Variables & Bootstrap) --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Structured theme (Renaissance gallery on putty paper) --}}
    <link href="{{ url('css/structured.css') }}" rel="stylesheet">
    @if(env('CONTENT_PROTECTION_ENABLED', true))
    <link href="{{ url('css/prevention.css') }}" rel="stylesheet">
    @endif

    {{-- Global Button Consistency Fix (Duolingo Theme) --}}
    <style>
        .btn, .ui-btn, .art-btn-login, .art-btn-register, .duo-tu-buybtn, .duo-tu-btn, .duo-cta-banner__btn, .duo-lp-super__btn, button[type="submit"], .duo-od-btn, .duo-dash-navbtn, .duo-cart-btn, .duo-cc-btn {
            font-family: 'Nunito', 'Nunito Sans', sans-serif !important;
            font-size: 16px !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            padding: 12px 24px !important;
            border-radius: 16px !important;
            outline: none !important;
            transition: all 0.1s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            line-height: 1.5 !important;
        }
        .btn:focus, .ui-btn:focus, button:focus {
            outline: none !important;
        }
        .btn:hover, .ui-btn:hover, .art-btn-login:hover, .art-btn-register:hover, .duo-tu-buybtn:hover, .duo-tu-btn:hover, .duo-cta-banner__btn:hover, .duo-lp-super__btn:hover, button[type="submit"]:hover, .duo-od-btn:hover, .duo-dash-navbtn:hover, .duo-cart-btn:hover, .duo-cc-btn:hover {
            text-decoration: none !important;
            filter: brightness(1.05) !important;
            transform: translateY(-2px);
            outline: none !important;
        }
        .btn:active, .ui-btn:active, .art-btn-login:active, .art-btn-register:active, .duo-tu-buybtn:active, .duo-tu-btn:active, .duo-cta-banner__btn:active, .duo-lp-super__btn:active, button[type="submit"]:active, .duo-od-btn:active, .duo-dash-navbtn:active, .duo-cart-btn:active, .duo-cc-btn:active {
            transform: translateY(4px) !important;
            box-shadow: 0 0 0 transparent !important;
            outline: none !important;
        }

        /* Exempt specific minimal icon buttons from standard button styling */
        .btn-close, .art-cart-btn, .mobile-nav-toggler, .close-btn, .btn-link {
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
            padding: 0 !important;
            white-space: normal !important;
        }
    </style>

    {{-- Preloader Styles — Artora Studios loader (Redesigned) --}}
    <style>
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        .st-preloader {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }
        .st-preloader__logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #1cb0f6; /* Spark Blue */
            box-shadow: 0 12px 24px rgba(28, 176, 246, 0.2);
            animation: pulseImage 2s infinite alternate ease-in-out;
        }
        .st-preloader__label {
            color: #4b4b4b; /* Charcoal */
            font-family: 'Nunito', 'Nunito Sans', sans-serif;
            font-weight: 800;
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            animation: fadeInOut 1.5s infinite alternate;
        }
        .st-preloader__bar {
            width: 200px;
            height: 8px;
            background-color: #eaf7ff;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }
        .st-preloader__bar span {
            display: block;
            height: 100%;
            background-color: #1cb0f6; /* Spark Blue */
            width: 0%;
            border-radius: 8px;
            animation: duoLoadingBar 2s ease-in-out forwards;
        }

        @keyframes pulseImage {
            0% { transform: scale(1); box-shadow: 0 8px 16px rgba(28, 176, 246, 0.2); }
            100% { transform: scale(1.08); box-shadow: 0 16px 32px rgba(28, 176, 246, 0.4); }
        }
        @keyframes fadeInOut {
            0% { opacity: 0.4; }
            100% { opacity: 1; }
        }
        @keyframes duoLoadingBar {
            0% { width: 0%; }
            40% { width: 70%; }
            100% { width: 100%; }
        }
    </style>

    @cookieconsentscripts
</head>

<body>
<div class="page-wrapper">

    {{-- Preloader --}}
    <div id="preloader">
        <div class="st-preloader">
            <div class="st-preloader__circle">
                <img class="st-preloader__logo" src="{{ asset('assets/images/preloader.jpeg') }}" alt="[Website Name]">
            </div>
            <div class="st-preloader__label">Getting Ready...</div>
            <div class="st-preloader__bar"><span></span></div>
        </div>
    </div>
