@extends('frontend.layouts.main')
@section('title', __('inkwave.about_page_title'))
@section('main-content')

{{-- Breadcrumb --}}
@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.about_page_title'),
    'links' => [
        ['name' => __('inkwave.top_nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.about_page_title')]
    ]
])

<div class="ag-about-page">
    
    {{-- SECTION 1: Hero (Text Block Background: Bone) --}}
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split">
                <div class="ag-split__img">
                    <img src="{{ asset('assets/images/about-aesthetics.webp') }}" alt="Aesthetics">
                </div>
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <h2 class="ag-title">{{ __('inkwave.about_hero_title') }}</h2>
                    <p class="ag-text ag-text-lead">
                        {{ __('inkwave.about_hero_lead') }}
                    </p>
                    <p class="ag-text">
                        {{ __('inkwave.about_hero_body') }}
                    </p>
                    
                    <ul class="ag-list-elegant">
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>{{ __('inkwave.about_hero_point1_title') }}</strong>
                                {{ __('inkwave.about_hero_point1_desc') }}
                            </div>
                        </li>
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>{{ __('inkwave.about_hero_point2_title') }}</strong>
                                {{ __('inkwave.about_hero_point2_desc') }}
                            </div>
                        </li>
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>{{ __('inkwave.about_hero_point3_title') }}</strong>
                                {{ __('inkwave.about_hero_point3_desc') }}
                            </div>
                        </li>
                    </ul>

                    <div style="margin-top: 40px;">
                        <a href="{{ route('contact') }}" class="ag-btn-primary">{{ __('inkwave.about_cta_btn_contact') }}</a>
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
                    <img src="{{ asset('assets/images/about-cultural.webp') }}" alt="Philosophy">
                </div>
                <div class="ag-split__content ag-text-block ag-bg-dark">
                    <h2 class="ag-title ag-title--dark">{{ __('inkwave.about_phil_title') }}</h2>
                    <p class="ag-text ag-text-lead ag-text--white">
                        {{ __('inkwave.about_phil_lead') }}
                    </p>
                    <p class="ag-text ag-text--dark">
                        {{ __('inkwave.about_phil_body') }}
                    </p>

                    <ul class="ag-list-elegant ag-list-elegant--dark">
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>{{ __('inkwave.about_phil_point1_title') }}</strong>
                                {{ __('inkwave.about_phil_point1_desc') }}
                            </div>
                        </li>
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>{{ __('inkwave.about_phil_point2_title') }}</strong>
                                {{ __('inkwave.about_phil_point2_desc') }}
                            </div>
                        </li>
                        <li>
                            <span class="ag-bullet-icon"></span>
                            <div>
                                <strong>{{ __('inkwave.about_phil_point3_title') }}</strong>
                                {{ __('inkwave.about_phil_point3_desc') }}
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
            <h2 class="ag-title ag-title--center">{{ __('inkwave.about_disc_title') }}</h2>
            
            <div class="ag-grid-3">
                <div class="ag-card">
                    <div class="ag-card__img-wrap">
                        <img src="{{ asset('assets/images/about-architecture.webp') }}" alt="Architecture">
                    </div>
                    <h4>{{ __('inkwave.about_disc1_title') }}</h4>
                    <p>{{ __('inkwave.about_disc1_desc') }}</p>
                </div>
                
                <div class="ag-card">
                    <div class="ag-card__img-wrap">
                        <img src="{{ asset('assets/images/about-culinary.webp') }}" alt="Sustainable">
                    </div>
                    <h4>{{ __('inkwave.about_disc2_title') }}</h4>
                    <p>{{ __('inkwave.about_disc2_desc') }}</p>
                </div>
                
                <div class="ag-card">
                    <div class="ag-card__img-wrap">
                        <img src="{{ asset('assets/images/about-nature.webp') }}" alt="Residential">
                    </div>
                    <h4>{{ __('inkwave.about_disc3_title') }}</h4>
                    <p>{{ __('inkwave.about_disc3_desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 4: CTA (Text Block Background: Gold) --}}
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-cta-box ag-text-block ag-bg-gold">
                <h2 class="ag-title ag-title--dark">{{ __('inkwave.about_cta_title') }}</h2>
                <p class="ag-text ag-text--white">
                    {{ __('inkwave.about_cta_body') }}
                </p>
                <div class="ag-cta-actions">
                    <a href="{{ route('product-lists') }}" class="ag-btn-primary">{{ __('inkwave.about_cta_btn_enroll') }}</a>
                    <a href="{{ route('contact') }}" class="ag-btn-outline-white ag-btn-secondary">{{ __('inkwave.about_cta_btn_contact') }}</a>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
