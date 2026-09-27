@php
    $siteName    = __('frontend.head.site');

    $locale      = str_replace('_', '-', app()->getLocale());
    $pageTitle   = trim(html_entity_decode($__env->yieldContent('title'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $fullTitle   = $pageTitle !== '' ? $pageTitle : __('frontend.head.home', ['site' => $siteName]);
    $description = trim(html_entity_decode(strip_tags($__env->yieldContent('description')), ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?: __('frontend.head.summary');
    $description = \Illuminate\Support\Str::limit(preg_replace('/\s+/', ' ', $description), 160, '…');
    $shareImage  = $og_image ?? asset('assets/images/logo.webp');
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#070b0a">

    <title>{{ $fullTitle }}</title>
    <meta name="title" content="{{ $fullTitle }}">
    <meta name="description" content="{{ $description }}">
    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $shareImage }}">
    <meta property="og:locale" content="{{ str_replace('-', '_', $locale) }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $shareImage }}">

    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}?v={{ filemtime(public_path('assets/images/favicon.ico')) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}?v={{ filemtime(public_path('assets/images/favicon.ico')) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon-64.png') }}?v={{ filemtime(public_path('assets/images/favicon-64.png')) }}" type="image/png" sizes="64x64">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon-64.png') }}?v={{ filemtime(public_path('assets/images/favicon-64.png')) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap">
    @if(str_starts_with($locale, 'ja'))
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Noto+Serif+JP:wght@500;600&display=swap">
    @endif
    <link rel="stylesheet" href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.3/css/flag-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/jademind.css') }}?v={{ filemtime(public_path('css/jademind.css')) }}">
    @if(env('CONTENT_PROTECTION_ENABLED', true))
        <link rel="stylesheet" href="{{ asset('css/prevention.css') }}">
    @endif

    @cookieconsentscripts
</head>

<body class="antialiased">
<div class="page-wrapper">

    <div id="preloader" class="pre" aria-hidden="true">
        <div class="pre__glow"></div>
        <div class="pre__grid"></div>
        @foreach([1, 2] as $row)
            <div class="pre__tape pre__tape--{{ $row }}">
                <div class="pre__track">
                    @foreach([1, 2] as $copy)
                        @foreach(__('frontend.head.terms') as $term)
                            <span class="pre__term {{ $loop->odd ? 'is-up' : 'is-down' }}">{{ $term }}</span>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="pre__core">
            <div class="pre__orb">
                <span class="pre__ring"></span>
                <span class="pre__ring pre__ring--slow"></span>
                <span class="pre__wave"></span>
                <svg class="pre__pulse" viewBox="0 0 120 60" focusable="false">
                    <polyline points="0,34 22,34 30,28 38,40 48,12 58,46 66,30 76,34 88,24 98,26 120,8"/>
                </svg>
            </div>
            <p class="pre__topic">{{ __('frontend.head.topic') }}</p>
            <p class="pre__name">{{ $siteName }}</p>
            <div class="pre__lines">
                @foreach(__('frontend.head.lines') as $line)
                    <span>{{ $line }}</span>
                @endforeach
            </div>
            <div class="pre__progress"><span></span></div>
        </div>
    </div>
