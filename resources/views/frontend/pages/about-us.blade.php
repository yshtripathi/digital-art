@extends('frontend.layouts.main')
@section('title', __('frontend.about.page_name'))
@section('description', __('frontend.about.summary'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.about.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.about.page_name')]
    ]
])

<section class="au" aria-labelledby="auTitle">
    <div class="au__wrap">

        <div class="au-photos">
            <figure class="au-photo">
                <img src="{{ asset('assets/images/about-study.webp') }}" width="1067" height="1600" alt="{{ __('frontend.about.alt_desk') }}" decoding="async">
            </figure>
            <figure class="au-photo">
                <img src="{{ asset('assets/images/about-calm.webp') }}" width="1067" height="1600" alt="{{ __('frontend.about.alt_crown') }}" loading="lazy" decoding="async">
            </figure>
            <figure class="au-photo">
                <img src="{{ asset('assets/images/about-time.webp') }}" width="1067" height="1600" alt="{{ __('frontend.about.alt_clock') }}" loading="lazy" decoding="async">
            </figure>
            <figure class="au-photo">
                <img src="{{ asset('assets/images/about-plan.webp') }}" width="1067" height="1600" alt="{{ __('frontend.about.alt_notes') }}" loading="lazy" decoding="async">
            </figure>
        </div>

        <div class="au-text">
            <p class="au-eyebrow">{{ __('frontend.about.intro_tag') }}</p>
            <h2 id="auTitle" class="au-title">{{ __('frontend.about.intro_title') }}</h2>

            <p class="au-copy">{{ __('frontend.about.intro_p1') }}</p>
            <p class="au-copy">{{ __('frontend.about.intro_p2') }}</p>

            <ul class="au-points">
                <li>{{ __('frontend.about.point_browse') }}</li>
                <li>{{ __('frontend.about.point_split') }}</li>
                <li>{{ __('frontend.about.point_credits') }}</li>
            </ul>

            <p class="au-steps__title">{{ __('frontend.about.path_title') }}</p>
            <ol class="au-steps">
                <li class="au-step"><span class="au-step__num">01</span><span>{{ __('frontend.about.path1') }}</span></li>
                <li class="au-step"><span class="au-step__num">02</span><span>{{ __('frontend.about.path2') }}</span></li>
                <li class="au-step"><span class="au-step__num">03</span><span>{{ __('frontend.about.path3') }}</span></li>
                <li class="au-step"><span class="au-step__num">04</span><span>{{ __('frontend.about.path4') }}</span></li>
            </ol>

            <div class="au-actions">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <span>{{ __('frontend.about.cta_explore') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn btn--ghost">{{ __('frontend.about.cta_contact') }}</a>
            </div>
        </div>

    </div>
</section>

@endsection
