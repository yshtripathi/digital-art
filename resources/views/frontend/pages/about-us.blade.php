@extends('frontend.layouts.main')
@section('title', __('frontend.about.title'))
@section('description', __('frontend.about.desc'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.about.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.about.title')]
    ]
])

<section class="au" aria-labelledby="auTitle">
    <div class="au__wrap">

        <div class="au-photos">
            <figure class="au-photo">
                <img src="{{ asset('assets/images/about-study.webp') }}" width="1067" height="1600" alt="{{ __('frontend.about.alt_study') }}" decoding="async">
            </figure>
            <figure class="au-photo">
                <img src="{{ asset('assets/images/about-calm.webp') }}" width="1067" height="1600" alt="{{ __('frontend.about.alt_calm') }}" loading="lazy" decoding="async">
            </figure>
            <figure class="au-photo">
                <img src="{{ asset('assets/images/about-time.webp') }}" width="1067" height="1600" alt="{{ __('frontend.about.alt_time') }}" loading="lazy" decoding="async">
            </figure>
            <figure class="au-photo">
                <img src="{{ asset('assets/images/about-plan.webp') }}" width="1067" height="1600" alt="{{ __('frontend.about.alt_plan') }}" loading="lazy" decoding="async">
            </figure>
        </div>

        <div class="au-text">
            <p class="au-eyebrow">{{ __('frontend.about.why_label') }}</p>
            <h2 id="auTitle" class="au-title">{{ __('frontend.about.why_title') }}</h2>

            <p class="au-copy">{{ __('frontend.about.why_text1') }}</p>
            <p class="au-copy">{{ __('frontend.about.why_p2') }}</p>

            <ul class="au-points">
                <li>{{ __('frontend.about.point1') }}</li>
                <li>{{ __('frontend.about.point_levels') }}</li>
                <li>{{ __('frontend.about.point3') }}</li>
            </ul>

            <p class="au-steps__title">{{ __('frontend.about.how_title') }}</p>
            <ol class="au-steps">
                <li class="au-step"><span class="au-step__num">01</span><span>{{ __('frontend.about.step1_title') }}</span></li>
                <li class="au-step"><span class="au-step__num">02</span><span>{{ __('frontend.about.step2_name') }}</span></li>
                <li class="au-step"><span class="au-step__num">03</span><span>{{ __('frontend.about.step3_title') }}</span></li>
                <li class="au-step"><span class="au-step__num">04</span><span>{{ __('frontend.about.step4_title') }}</span></li>
            </ol>

            <div class="au-actions">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <span>{{ __('frontend.about.browse_btn') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn btn--ghost">{{ __('frontend.about.contact_btn') }}</a>
            </div>
        </div>

    </div>
</section>

@endsection
