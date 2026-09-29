@php
    $siteName    = __('frontend.head.site');

    $locale      = str_replace('_', '-', app()->getLocale());
    $pageTitle   = trim(html_entity_decode($__env->yieldContent('title'), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $fullTitle   = $pageTitle !== '' ? $pageTitle : __('frontend.head.home', ['site' => $siteName]);
    $description = trim(html_entity_decode(strip_tags($__env->yieldContent('description')), ENT_QUOTES | ENT_HTML5, 'UTF-8')) ?: __('frontend.head.description');
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
    <meta name="theme-color" content="#000000">

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

    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon-64.png') }}" type="image/png" sizes="64x64">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@400;600&family=Manrope:wght@200;400;500;700&display=swap">
    @if(str_starts_with($locale, 'ja'))
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap">
    @endif
    <link rel="stylesheet" href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.3/css/flag-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/craft-courses.css') }}">
    @if(env('CONTENT_PROTECTION_ENABLED', true))
        <link rel="stylesheet" href="{{ asset('css/prevention.css') }}">
    @endif

    @cookieconsentscripts
</head>

<body class="antialiased">
<div class="page-wrapper">

    <div class="loom" id="loom" aria-hidden="true">
        <div class="loom__inner">
            <svg class="loom__thread" viewBox="0 0 160 64" fill="none">
                <path class="loom__path" pathLength="1" d="M4 44 C 28 44 34 12 58 12 C 82 12 84 54 66 54 C 48 54 56 22 84 22 C 110 22 118 44 156 44"/>
                <circle class="loom__knot" cx="156" cy="44" r="4"/>
            </svg>
            <span class="loom__name">{{ $siteName }}</span>
        </div>
    </div>
    <script>
        (function () {
            var loom = document.getElementById('loom');
            if (!loom) return;
            var start = Date.now();
            var done = false;
            function leave() {
                if (done) return;
                done = true;
                setTimeout(function () {
                    loom.classList.add('loom--leaving');
                    setTimeout(function () {
                        if (loom.parentNode) loom.parentNode.removeChild(loom);
                    }, 800);
                }, Math.max(0, 1300 - (Date.now() - start)));
            }
            if (document.readyState === 'complete') {
                leave();
            } else {
                window.addEventListener('load', leave);
                setTimeout(leave, 4000);
            }
        })();
    </script>
