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

<style>
/* ==========================================================================
   Art Courses — About Us Page (4 Sections, Gallery Style)
   ========================================================================== */

/* Reusable Layout Wrappers */
.ag-section {
    padding: 40px 40px; /* Keep elegant spacing between sections */
}

/* Colored Text Blocks */
.ag-text-block {
    padding: 64px 80px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.05);
}
.ag-bg-bone {
    background-color: #f5f5f5;
}
.ag-bg-white {
    background-color: #ffffff;
    border: 1px solid rgba(0,0,0,0.05);
}
.ag-bg-dark {
    background-color: #111111;
}
.ag-bg-gold {
    background-color: #bc9c5c;
}

.ag-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 5%;
}

/* Split Layout (Hero & Philosophy) */
.ag-split {
    display: flex;
    align-items: center;
    gap: 80px;
}
.ag-split--reverse {
    flex-direction: row-reverse;
}
.ag-split__img {
    flex: 1;
    position: relative;
}
.ag-split__img::after {
    content: '';
    position: absolute;
    top: 24px;
    left: 24px;
    right: -24px;
    bottom: -24px;
    border: 1px solid #bc9c5c;
    z-index: 0;
}
.ag-split__img--reverse::after {
    left: -24px;
    right: 24px;
}
.ag-split__img img {
    width: 100%;
    max-height: 600px;
    object-fit: cover;
    display: block;
    position: relative;
    z-index: 1;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}
.ag-split__content {
    flex: 1.2; /* Slightly wider text block to accommodate padding */
}

/* Typography */
.ag-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 48px !important;
    color: #000000 !important;
    margin-bottom: 32px !important;
    line-height: 1.2 !important;
    letter-spacing: 0.02em !important;
}
.ag-title--dark { color: #ffffff !important; }
.ag-title--center { text-align: center !important; margin-bottom: 80px !important; }

.ag-text {
    font-family: var(--font-arial, Arial, sans-serif) !important;
    font-size: 16px !important;
    color: #444444 !important;
    line-height: 1.9 !important;
    margin-bottom: 24px !important;
    letter-spacing: 0.01em;
}
.ag-text-lead {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 24px !important;
    font-style: italic;
    color: #111111 !important;
    line-height: 1.6 !important;
    margin-bottom: 32px !important;
}
.ag-text--white { color: #ffffff !important; }
.ag-text--dark { color: #cccccc !important; }

/* Elegant Lists */
.ag-list-elegant {
    list-style: none;
    padding: 0;
    margin: 40px 0;
    border-top: 1px solid rgba(0,0,0,0.08);
}
.ag-list-elegant li {
    font-family: var(--font-arial, Arial, sans-serif) !important;
    font-size: 16px;
    color: #333333;
    padding: 20px 0;
    margin-bottom: 0;
    border-bottom: 1px solid rgba(0,0,0,0.08);
    display: flex;
    align-items: flex-start;
    gap: 20px;
    line-height: 1.7;
}
.ag-list-elegant--dark {
    border-top-color: rgba(255,255,255,0.15);
}
.ag-list-elegant--dark li {
    color: #cccccc;
    border-bottom-color: rgba(255,255,255,0.15);
}
.ag-list-elegant--dark strong {
    color: #ffffff;
}

.ag-bullet-icon {
    width: 6px;
    height: 6px;
    background-color: #bc9c5c;
    display: inline-block;
    margin-top: 10px;
    transform: rotate(45deg);
    flex-shrink: 0;
}
.ag-list-elegant strong {
    color: #000000;
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 18px;
    font-weight: 700;
    display: block;
    margin-bottom: 4px;
    letter-spacing: 0.02em;
}

/* 3-Column Grid */
.ag-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}
.ag-card {
    text-align: center;
    background: #ffffff;
    padding-bottom: 32px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.03);
}
.ag-card__img-wrap {
    overflow: hidden;
    margin-bottom: 32px;
}
.ag-card__img-wrap img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
    transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}
.ag-card:hover .ag-card__img-wrap img {
    transform: scale(1.05);
}
.ag-card h4 {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 24px !important;
    margin-bottom: 16px !important;
    color: #000000 !important;
    padding: 0 24px;
}
.ag-card p {
    font-family: var(--font-arial, Arial, sans-serif) !important;
    font-size: 14px !important;
    color: #666666 !important;
    line-height: 1.7 !important;
    padding: 0 24px;
    margin: 0;
}

/* CTA Section */
.ag-cta-box {
    text-align: center;
    max-width: 900px;
    margin: 0 auto;
}
.ag-cta-actions {
    display: flex;
    justify-content: center;
    gap: 24px;
    margin-top: 40px;
}

@media (max-width: 992px) {
    .ag-split, .ag-split--reverse { flex-direction: column; gap: 64px; }
    .ag-title { font-size: 36px !important; }
    .ag-grid-3 { grid-template-columns: 1fr; }
    .ag-section { padding: 100px 0; }
    .ag-cta-actions { flex-direction: column; }
    .ag-text-block { padding: 40px 24px; }
}
</style>

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
