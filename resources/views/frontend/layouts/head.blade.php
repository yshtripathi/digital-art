<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '[Website Name] – Premium Masterclasses in Illustration & Architecture')</title>
    <meta name="title" content="@yield('title', '[Website Name] – Premium Masterclasses in Illustration & Architecture')">
    <meta name="description" content="Premium illustration masterclasses. Master Japanese Architecture, Food & Culinary Arts, Fashion Styling, Botanical, and Travel Illustration. Learn Bento Illustration, Japanese Streetscapes, and more.">
    <meta name="keywords" content="art courses, japanese architecture, culinary illustration, fashion illustration, botanical art, travel illustration, japanese interior sketching, traditional japanese architecture, japanese garden illustration, japanese streetscape drawing, bento illustration, streetwear fashion, online masterclass">
    <meta name="author" content="[Website Name]">

    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', '[Website Name] – Premium Masterclasses in Illustration & Architecture')">
    <meta property="og:description" content="Premium illustration masterclasses. Master Japanese Architecture, Food & Culinary Arts, Fashion Styling, Botanical, and Travel Illustration. Learn Bento Illustration, Japanese Streetscapes, and more.">
    @if(isset($og_image))
    <meta property="og:image" content="{{ $og_image }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="[Website Name]">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', '[Website Name] – Premium Masterclasses in Illustration & Architecture')">
    <meta name="twitter:description" content="Premium illustration masterclasses. Master Japanese Architecture, Food & Culinary Arts, Fashion Styling, Botanical, and Travel Illustration. Learn Bento Illustration, Japanese Streetscapes, and more.">
    @if(isset($og_image))
    <meta name="twitter:image" content="{{ $og_image }}">
    @endif

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css">
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,700;1,6..96,400&display=swap" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}?v={{ time() }}" rel="stylesheet">
    @if(env('CONTENT_PROTECTION_ENABLED', true))
    <link href="{{ asset('css/prevention.css') }}" rel="stylesheet">
    @endif

    @cookieconsentscripts
</head>

<body class="antialiased">
<div class="page-wrapper">

    <div id="preloader">
        <div class="art-preloader-inner">
            <div class="art-preloader-line"></div>
            <div class="art-preloader-text">Curating the Gallery...</div>
        </div>
    </div>

