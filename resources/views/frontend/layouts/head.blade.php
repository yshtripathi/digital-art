<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    {{-- SEO Meta --}}
    <title>@yield('title', 'Art Courses Platform – Illustration & Spatial Art')</title>
    <meta name="title" content="Art Courses Platform – Illustration & Spatial Art">
    <meta name="description" content="Premium illustration and spatial art education. Explore courses in Japanese Architecture, Culinary Art, Fashion Illustration, and more.">
    <meta name="keywords" content="art courses, japanese architecture, culinary illustration, fashion illustration, botanical art, travel illustration">
    <meta name="author" content="Art Courses Platform">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Art Courses Platform – Illustration & Spatial Art')">
    <meta property="og:description" content="Premium illustration and spatial art education. Explore courses in Japanese Architecture, Culinary Art, Fashion Illustration, and more.">
    @if(isset($og_image))
    <meta property="og:image" content="{{ $og_image }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Art Courses Platform">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@ArtCourses">
    <meta name="twitter:creator" content="@ArtCourses">
    <meta name="twitter:title" content="@yield('title', 'Art Courses Platform – Illustration & Spatial Art')">
    <meta name="twitter:description" content="Premium illustration and spatial art education. Explore courses in Japanese Architecture, Culinary Art, Fashion Illustration, and more.">
    @if(isset($og_image))
    <meta name="twitter:image" content="{{ $og_image }}">
    @endif

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ url('assets/images/favicon.png') }}" type="image/png">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css">
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Google Fonts: Bodoni Moda --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:ital,opsz,wght@0,6..96,400;0,6..96,700;1,6..96,400&display=swap" rel="stylesheet">

    {{-- Art Courses Theme Styles --}}
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">

    @if(env('CONTENT_PROTECTION_ENABLED', true))
    <link href="{{ asset('css/prevention.css') }}" rel="stylesheet">
    @endif

    {{-- Global Button Consistency Fix (Art Courses Theme) --}}
    

    {{-- Preloader Styles — Art Courses Theme --}}
    

    @cookieconsentscripts
</head>

<body>
<div class="page-wrapper">

    {{-- Preloader --}}
    <div id="preloader">
        <div class="st-preloader">
            <div class="st-preloader__circle">
                <img class="st-preloader__logo" src="{{ asset('assets/images/favicon.png') }}" alt="Art Courses">
            </div>
            <div class="st-preloader__label">Curating...</div>
        </div>
    </div>
