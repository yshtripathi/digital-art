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



<div class="ag-about-page">
    
    {{-- SECTION 1: Hero (Text Block Background: Bone) --}}
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split">
                <div class="ag-split__img">
                    <img src="{{ asset('assets/images/about-aesthetics.webp') }}" alt="Artora Studios Aesthetics">
                </div>
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <h2 class="ag-title">Cultivating Creativity Through Asian Aesthetics</h2>
                    <p class="ag-text ag-text-lead">
                        Welcome to Artora Studios. We are a premium illustration platform dedicated to exploring the rich visual heritage of Japan and Southeast Asia. 
                    </p>
                    <p class="ag-text">
                        Whether you are an emerging artist seeking foundational skills or a seasoned professional looking to refine your technique, our expert-led modules provide a deep dive into regional art styles, bridging the gap between historical reverence and contemporary illustration.
                    </p>
                    
                    <ul class="ag-list-elegant">
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>Master Traditional Tools</strong>
                                Dive deep into classical ink, brush, and digital rendering techniques used by industry veterans.
                            </div>
                        </li>
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>Cinematic Lighting</strong>
                                Explore atmospheric lighting and composition inspired by iconic Asian cinema and animation.
                            </div>
                        </li>
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>Authentic Reference Library</strong>
                                Build a culturally accurate and visually stunning library to ground your artwork in reality.
                            </div>
                        </li>
                    </ul>

                    <div style="margin-top: 40px;">
                        <a href="{{ route('contact') }}" class="ag-btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2: Philosophy (Text Block Background: Dark) --}}
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split ag-split--reverse">
                <div class="ag-split__img ag-split__img--reverse">
                    <img src="{{ asset('assets/images/about-cultural.webp') }}" alt="Travel and Cultural Illustration">
                </div>
                <div class="ag-split__content ag-text-block ag-bg-dark">
                    <h2 class="ag-title ag-title--dark">Preserving Tradition in a Modern World</h2>
                    <p class="ag-text ag-text-lead ag-text--white">
                        We believe that illustration is more than just drawing—it is a powerful tool for preserving and sharing the rich cultural tapestry of Asia. 
                    </p>
                    <p class="ag-text ag-text--dark">
                        Our curriculum goes far beyond surface-level aesthetics. We encourage students to understand the context behind the visuals—the seasonal significance of flora, the architectural logic of heritage sites, and the storytelling woven into local textiles.
                    </p>

                    <ul class="ag-list-elegant ag-list-elegant--dark">
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>Folklore & Mythology</strong>
                                Study the rich history of regional myths to master narrative-driven character design.
                            </div>
                        </li>
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>Anatomical Precision</strong>
                                Render detailed studies of traditional garments, intricate textiles, and historical armor.
                            </div>
                        </li>
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>Atmospheric Environments</strong>
                                Utilize advanced techniques for painting serene, natural, and grand architectural landscapes.
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 3: Curated Disciplines (No Background) --}}
    <section class="ag-section">
        <div class="ag-container">
            <h2 class="ag-title ag-title--center">Our Curated Disciplines</h2>
            
            <div class="ag-grid-3">
                <div class="ag-card">
                    <div class="ag-card__img-wrap">
                        <img src="{{ asset('assets/images/about-architecture.webp') }}" alt="Japanese Architecture">
                    </div>
                    <h4>Japanese Architecture</h4>
                    <p>Master perspective and balance by studying traditional Japanese spaces, interiors, and structures.</p>
                </div>
                
                <div class="ag-card">
                    <div class="ag-card__img-wrap">
                        <img src="{{ asset('assets/images/about-culinary.webp') }}" alt="Culinary Illustration">
                    </div>
                    <h4>Culinary Illustration</h4>
                    <p>Capture the inviting textures, vibrant colors, and dynamic compositions of Asian cuisine.</p>
                </div>
                
                <div class="ag-card">
                    <div class="ag-card__img-wrap">
                        <img src="{{ asset('assets/images/about-nature.webp') }}" alt="Nature Illustration">
                    </div>
                    <h4>Botanical & Nature</h4>
                    <p>Discover the beauty of seasonal plants, serene gardens, and natural landscapes across Asia.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 4: CTA (Text Block Background: Gold) --}}
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-cta-box ag-text-block ag-bg-gold">
                <h2 class="ag-title ag-title--dark">Take the Next Step in Your Art</h2>
                <p class="ag-text ag-text--white">
                    Whether you are refining your technique or starting fresh, our expert-led masterclasses provide the perfect environment to hone your craft.
                </p>
                <div class="ag-cta-actions">
                    <a href="{{ route('product-lists') }}" class="ag-btn-primary">Enroll in Masterclasses</a>
                    <a href="{{ route('contact') }}" class="ag-btn-outline-white ag-btn-secondary">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
