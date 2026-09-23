@php
    // The website name lives in the lang file: one company runs several sites,
    // so the name belongs to the site, not to the company record in miscs.
    $siteName    = __('frontend.head.site');

    $locale      = str_replace('_', '-', app()->getLocale());
    // Each page sets its own plain tab title. Only the home fallback carries the
    // website name, since the home page has no page name of its own.
    $pageTitle   = trim(html_entity_decode($__env->yieldContent('title'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $fullTitle   = $pageTitle !== '' ? $pageTitle : __('frontend.head.home', ['site' => $siteName]);
    $description = trim(html_entity_decode(strip_tags($__env->yieldContent('description')), ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?: __('frontend.head.description');
    $description = \Illuminate\Support\Str::limit(preg_replace('/\s+/', ' ', $description), 160, '…');
    $shareImage  = $og_image ?? asset('assets/images/breadcrumb.webp');
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    {{-- Basics --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#f50db4">

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

    {{-- Fonts & icon libraries --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Lora:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap">
    <link rel="stylesheet" href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.3/css/flag-icons.min.css">

    {{-- Site styles: design tokens first, then component styles --}}
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}?v={{ filemtime(public_path('css/variables.css')) }}">
    @if(env('CONTENT_PROTECTION_ENABLED', true))
        <link rel="stylesheet" href="{{ asset('css/prevention.css') }}">
    @endif

    @cookieconsentscripts
</head>

<body class="antialiased">
<div class="page-wrapper">

    {{-- Preloader: a level ladder over an indeterminate rail, since the courses
         themselves are sorted into levels. Faded out by assets/js/script.js.
         The visible label is the accessible name, so there is no aria-label to
         read out twice. Styles: variables.css — 7 --}}
    <div id="preloader" role="status">
        <div class="pre">
            <span class="pre__ladder" aria-hidden="true">
                <span class="pre__step"></span>
                <span class="pre__step"></span>
                <span class="pre__step"></span>
            </span>
            <p class="pre__name">{{ $siteName }}</p>
            <span class="pre__rail" aria-hidden="true">
                <span class="pre__shuttle"></span>
            </span>
            <p class="pre__label">{{ __('frontend.head.loading') }}</p>
        </div>
    </div>
