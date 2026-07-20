<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    {{-- SEO Meta --}}
    <title>@yield('title', 'Artora Studios – Online Art Courses in Anime, Manga & Illustration')</title>
    <meta name="title" content="Artora Studios – Online Art Courses">
    <meta name="description" content="Artora Studios offers online art courses taught by professional artists across Anime & Manga Illustration, Character Design & Concept Art, Pixel Art & Game Graphics, Modern Japanese Illustration, and Visual Storytelling & Comic Art — learn step by step, anytime.">
    <meta name="keywords" content="online art courses, anime illustration course, manga art course, character design, concept art, pixel art, game graphics, japanese illustration, comic art, visual storytelling, learn to draw, artora studios">
    <meta name="author" content="Artora Studios">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Artora Studios – Online Art Courses')">
    <meta property="og:description" content="Online art courses spanning Anime & Manga Illustration, Character Design & Concept Art, Pixel Art & Game Graphics, Modern Japanese Illustration, and Visual Storytelling & Comic Art — learn from professional artists, step by step.">
    @if(isset($og_image))
    <meta property="og:image" content="{{ $og_image }}">
    @endif
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Artora Studios">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@artorastudios">
    <meta name="twitter:creator" content="@artorastudios">
    <meta name="twitter:title" content="@yield('title', 'Artora Studios – Online Art Courses')">
    <meta name="twitter:description" content="Online art courses spanning Anime & Manga Illustration, Character Design & Concept Art, Pixel Art & Game Graphics, Modern Japanese Illustration, and Visual Storytelling & Comic Art — learn from professional artists, step by step.">
    @if(isset($og_image))
    <meta name="twitter:image" content="{{ $og_image }}">
    @endif

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ url('assets/images/favicon.png') }}" type="image/png">

    {{-- Stylesheets --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css">
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Google Fonts: Playfair Display (display serif) + Inter (utility grotesk) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Playfair+Display:wght@400;500&display=swap" rel="stylesheet">

    {{-- Structured theme (Renaissance gallery on putty paper) --}}
    <link href="{{ url('css/structured.css') }}" rel="stylesheet">
    @if(env('CONTENT_PROTECTION_ENABLED', true))
    <link href="{{ url('css/prevention.css') }}" rel="stylesheet">
    @endif

    {{-- Preloader Styles — Artora Studios loader (flat, no gradients, no shadows) --}}
    

    @cookieconsentscripts
</head>

<body>
<div class="page-wrapper">

    {{-- Preloader --}}
    <div id="preloader">
        <div class="st-preloader">
            <div class="st-preloader__mark">Artora Studios</div>
            <div class="st-preloader__label">Loading your studio</div>
            <div class="st-preloader__bar"><span></span></div>
        </div>
    </div>
