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
