@extends('frontend.layouts.main')
@section('title', 'About Us')
@section('main-content')

{{-- Breadcrumb --}}
@include('frontend.layouts.breadcrumb', [
    'title' => 'About Us',
    'links' => [
        ['name' => 'Home', 'url' => route('home')],
        ['name' => 'About Us']
    ]
])

<div class="ag-about-wrapper">
    
    {{-- Hero Section --}}
    <section class="ag-about-hero">
        <div class="ag-about-hero__image">
            <img src="{{ asset('assets/images/i1.jpg') }}" alt="Artora Studios">
        </div>
        <div class="ag-about-hero__content">
            <h2 class="ag-about-title">Cultivating Creativity Through Asian Aesthetics</h2>
            <p class="ag-about-text">
                Welcome to Artora Studios. We are dedicated to exploring the rich visual heritage of Japan and Southeast Asia through modern illustration. From the intricate details of traditional architecture to the vibrant energy of culinary arts, fashion, and botanical nature, our courses are designed to inspire and elevate your creative journey.
            </p>
            <p class="ag-about-text">
                Whether you are a beginner looking to understand perspective and balance, or an advanced artist refining your visual storytelling and cultural illustration, our curated curriculum provides the tools and inspiration you need.
            </p>
        </div>
    </section>

    {{-- Focus Areas (Categories from CSV) --}}
    <section class="ag-about-focus">
        <h3 class="ag-about-subtitle">What We Explore</h3>
        <div class="ag-about-grid">
            
            <div class="ag-about-card">
                <div class="ag-about-card__img-wrap">
                    <img src="{{ asset('assets/images/i6.jpg') }}" alt="Japanese Architecture & Spatial Art">
                </div>
                <h4>Japanese Architecture & Spatial Art</h4>
                <p>Master perspective and balance by studying traditional Japanese spaces, interiors, and architectural structures.</p>
            </div>
            
            <div class="ag-about-card">
                <div class="ag-about-card__img-wrap">
                    <img src="{{ asset('assets/images/i7.jpg') }}" alt="Food & Culinary Illustration">
                </div>
                <h4>Food & Culinary Illustration</h4>
                <p>Capture the inviting textures, colors, and compositions of Asian cuisine and vibrant dining scenes.</p>
            </div>
            
            <div class="ag-about-card">
                <div class="ag-about-card__img-wrap">
                    <img src="{{ asset('assets/images/i8.jpg') }}" alt="Botanical & Nature Illustration">
                </div>
                <h4>Botanical & Nature Illustration</h4>
                <p>Discover the beauty of seasonal plants, serene gardens, and natural landscapes across Asia.</p>
            </div>
            
            <div class="ag-about-card">
                <div class="ag-about-card__img-wrap">
                    <img src="{{ asset('assets/images/i10.jpg') }}" alt="Travel & Cultural Illustration">
                </div>
                <h4>Travel & Cultural Illustration</h4>
                <p>Turn personal travel experiences, historic landmarks, and cultural traditions into expressive visual storytelling.</p>
            </div>

        </div>
    </section>

    {{-- CTA Banner --}}
    <section class="ag-about-cta">
        <div class="ag-about-cta__box">
            <h2>Begin Your Artistic Journey</h2>
            <p>Join our community of creators and start mastering new illustration techniques today.</p>
            <a href="{{ route('product-lists') }}" class="ag-btn-solid">Explore Courses</a>
        </div>
    </section>

</div>

@endsection
