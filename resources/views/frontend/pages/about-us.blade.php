@extends('frontend.layouts.main')
@section('title', __('frontend.about.title'))
@section('description', __('frontend.about.meta'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.about.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.about.title')]
    ]
])

{{-- ==========================================================================
     About us — two sections only
     1. Why the platform exists, beside a three-photo collage
     2. How learning is organised, as four steps closing on a call to action
     Styles: public/css/theme.css — section 27
     ========================================================================== --}}

{{-- ===================== 1. WHY THIS EXISTS ===================== --}}
<section class="ab">
    <div class="ab__wrap">
        <div class="ab-intro">

            <div class="ab-intro__text">
                <p class="ab-label">{{ __('frontend.about.why_label') }}</p>
                <h2 class="ab-title">{{ __('frontend.about.why_title') }}</h2>

                <p class="ab-copy">{{ __('frontend.about.why_p1') }}</p>
                <p class="ab-copy">{{ __('frontend.about.why_p2') }}</p>

                <ul class="ab-points">
                    <li><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.about.point1') }}</li>
                    <li><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.about.point2') }}</li>
                    <li><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.about.point3') }}</li>
                </ul>

                <div class="ab-actions">
                    <a href="{{ route('product-lists') }}" class="ab-btn ab-btn--primary">
                        {{ __('frontend.about.courses_btn') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="ab-btn ab-btn--ghost">{{ __('frontend.about.contact_btn') }}</a>
                </div>
            </div>

            {{-- Three-photo collage --}}
            <div class="ab-collage">
                <figure class="ab-collage__item ab-collage__item--tall">
                    <img src="{{ asset('assets/images/about-study-together.webp') }}" width="900" height="1350"
                         alt="{{ __('frontend.about.alt1') }}" loading="lazy" decoding="async">
                </figure>
                <figure class="ab-collage__item ab-collage__item--top">
                    <img src="{{ asset('assets/images/about-lesson-headphones.webp') }}" width="800" height="800"
                         alt="{{ __('frontend.about.alt3') }}" loading="lazy" decoding="async">
                </figure>
                <figure class="ab-collage__item ab-collage__item--bottom">
                    <img src="{{ asset('assets/images/about-study-at-home.webp') }}" width="800" height="1200"
                         alt="{{ __('frontend.about.alt2') }}" loading="lazy" decoding="async">
                </figure>
            </div>
        </div>
    </div>
</section>

{{-- ===================== 2. HOW IT IS ORGANISED ===================== --}}
<section class="ab ab--how">
    <div class="ab__wrap">

        <div class="ab-how__head">
            <p class="ab-label">{{ __('frontend.about.how_label') }}</p>
            <h2 class="ab-title">{{ __('frontend.about.how_title') }}</h2>
            <p class="ab-copy">{{ __('frontend.about.how_desc') }}</p>
        </div>

        <ol class="ab-steps">
            <li class="ab-step">
                <span class="ab-step__no">01</span>
                <h3 class="ab-step__title">{{ __('frontend.about.step1_title') }}</h3>
                <p class="ab-step__desc">{{ __('frontend.about.step1_desc') }}</p>
            </li>
            <li class="ab-step">
                <span class="ab-step__no">02</span>
                <h3 class="ab-step__title">{{ __('frontend.about.step2_title') }}</h3>
                <p class="ab-step__desc">{{ __('frontend.about.step2_desc') }}</p>
            </li>
            <li class="ab-step">
                <span class="ab-step__no">03</span>
                <h3 class="ab-step__title">{{ __('frontend.about.step3_title') }}</h3>
                <p class="ab-step__desc">{{ __('frontend.about.step3_desc') }}</p>
            </li>
            <li class="ab-step ab-step--brand">
                <span class="ab-step__no">04</span>
                <h3 class="ab-step__title">{{ __('frontend.about.step4_title') }}</h3>
                <p class="ab-step__desc">{{ __('frontend.about.step4_desc') }}</p>
            </li>
        </ol>

        <div class="ab-cta">
            <div class="ab-cta__text">
                <h2 class="ab-cta__title">{{ __('frontend.about.cta_title') }}</h2>
                <p class="ab-cta__desc">{{ __('frontend.about.cta_text') }}</p>
            </div>
            <div class="ab-cta__actions">
                <a href="{{ route('product-lists') }}" class="ab-btn ab-btn--inverse">
                    {{ __('frontend.about.courses_btn') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="ab-btn ab-btn--outline">{{ __('frontend.about.contact_btn') }}</a>
            </div>
        </div>
    </div>
</section>

@endsection
