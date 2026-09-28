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
    <meta name="theme-color" content="#693edf">

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

    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}?v={{ (file_exists(public_path('assets/images/favicon.ico')) ? filemtime(public_path('assets/images/favicon.ico')) : 0) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}?v={{ (file_exists(public_path('assets/images/favicon.ico')) ? filemtime(public_path('assets/images/favicon.ico')) : 0) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon-64.png') }}?v={{ (file_exists(public_path('assets/images/favicon-64.png')) ? filemtime(public_path('assets/images/favicon-64.png')) : 0) }}" type="image/png" sizes="64x64">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon-64.png') }}?v={{ (file_exists(public_path('assets/images/favicon-64.png')) ? filemtime(public_path('assets/images/favicon-64.png')) : 0) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap">
    @if(str_starts_with($locale, 'ja'))
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600&display=swap">
    @endif
    <link rel="stylesheet" href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons@7.2.3/css/flag-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/word-craftsman.css') }}?v={{ (file_exists(public_path('css/word-craftsman.css')) ? filemtime(public_path('css/word-craftsman.css')) : 0) }}">
    @if(env('CONTENT_PROTECTION_ENABLED', true))
        <link rel="stylesheet" href="{{ asset('css/prevention.css') }}?v={{ (file_exists(public_path('css/prevention.css')) ? filemtime(public_path('css/prevention.css')) : 0) }}">
    @endif

    @cookieconsentscripts
</head>

<body class="antialiased">
<div class="page-wrapper">

    @php
        $preInitials = collect(preg_split('/\s+/u', trim($siteName)))->filter()->take(2)->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))->implode('');
        $preCategories = (isset($category) && $category instanceof \Illuminate\Support\Collection ? $category : \App\Models\Category::getAllParentWithChild())->take(5);
    @endphp
    <div id="preloader" class="pre" aria-hidden="true">
        <div class="pre__core">
            <span class="pre__mark">{{ $preInitials }}</span>
            <p class="pre__title"><span class="pre__name">{{ $siteName }}</span></p>
            <span class="pre__steps"><span style="--i: 0"></span><span style="--i: 1"></span><span style="--i: 2"></span><span style="--i: 3"></span><span style="--i: 4"></span></span>
            @if($preCategories->isNotEmpty())
                <ul class="pre__cats">
                    @foreach($preCategories as $preIndex => $preCategory)
                        <li class="pre__cat" style="--i: {{ $preIndex }}">{{ $preCategory->title }}</li>
                    @endforeach
                </ul>
            @endif
            <p class="pre__topic">{{ __('frontend.head.topic') }}</p>
        </div>
    </div>
