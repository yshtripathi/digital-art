@php
    // The website name lives in the lang file: one company runs several sites,
    // so the name belongs to the site, not to the company record in miscs.
    $siteName    = __('frontend.head.site');

    $locale      = str_replace('_', '-', app()->getLocale());
    // Each page sets its own plain tab title. Only the home fallback carries the
    // website name, since the home page has no page name of its own.
    $pageTitle   = trim(html_entity_decode($__env->yieldContent('title'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $fullTitle   = $pageTitle !== '' ? $pageTitle : __('frontend.head.home', ['site' => $siteName]);
    $description = trim(html_entity_decode(strip_tags($__env->yieldContent('description')), ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?: __('frontend.head.desc');
    $description = \Illuminate\Support\Str::limit(preg_replace('/\s+/', ' ', $description), 160, '…');
    $shareImage  = $og_image ?? asset('assets/images/logo.webp');
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    {{-- Basics --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#fbf5e7">

    {{-- SEO --}}
    <title>{{ $fullTitle }}</title>
    <meta name="title" content="{{ $fullTitle }}">
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $shareImage }}">
    <meta property="og:locale" content="{{ str_replace('-', '_', $locale) }}">

    {{-- Twitter / X --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $shareImage }}">

    {{-- Icons --}}
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon-64.png') }}" type="image/png" sizes="64x64">

    {{-- Fonts & icon libraries --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500&family=Inter:wght@400;500&display=swap">
    @if(str_starts_with($locale, 'ja'))
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500&display=swap">
    @endif
    <link rel="stylesheet" href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.3/css/flag-icons.min.css">

    {{-- Site styles: design tokens first, then component styles --}}
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}?v={{ filemtime(public_path('css/theme.css')) }}">
    @if(env('CONTENT_PROTECTION_ENABLED', true))
        <link rel="stylesheet" href="{{ asset('css/prevention.css') }}">
    @endif

    @cookieconsentscripts
</head>

<body class="antialiased">
<div class="page-wrapper">

    <div id="preloader" class="pre" role="status">
        <p class="pre__name" aria-hidden="true">{{ $siteName }}</p>

        <div class="pre__stage" aria-hidden="true">
            <svg class="pre__mandala" viewBox="0 0 200 200" focusable="false">
                <circle class="pre__orbit" cx="100" cy="100" r="97"/>
                <g class="pre__dots">
                    @foreach (range(0, 345, 15) as $angle)
                        <circle cx="100" cy="8" r="1.8" transform="rotate({{ $angle }} 100 100)"/>
                    @endforeach
                </g>
                <g class="pre__leaves">
                    @foreach (range(22.5, 337.5, 45) as $angle)
                        <path d="M100 16 L111 50 L100 72 L89 50 Z" transform="rotate({{ $angle }} 100 100)"/>
                    @endforeach
                </g>
                <g class="pre__petals">
                    @foreach (range(0, 315, 45) as $angle)
                        <g transform="rotate({{ $angle }} 100 100)">
                            <ellipse cx="100" cy="42" rx="15" ry="30" class="pre__paper"/>
                            <ellipse cx="100" cy="44" rx="6" ry="19" class="pre__line"/>
                        </g>
                    @endforeach
                </g>
                <g class="pre__rays">
                    @foreach (range(0, 337.5, 22.5) as $angle)
                        <path d="M100 50 L107 78 L100 90 L93 78 Z" transform="rotate({{ $angle }} 100 100)"/>
                    @endforeach
                </g>
                <g class="pre__core">
                    <circle cx="100" cy="100" r="26" class="pre__ink"/>
                    <circle cx="100" cy="100" r="19" class="pre__paper"/>
                    <circle cx="100" cy="100" r="12" class="pre__ink"/>
                    <circle cx="100" cy="100" r="5" class="pre__paper"/>
                </g>
            </svg>
        </div>

        <div class="pre__foot">
            <p class="pre__label">{{ __('frontend.head.loading') }}</p>
            <span class="pre__rail" aria-hidden="true">
                <span class="pre__fill"></span>
            </span>
        </div>
    </div>
