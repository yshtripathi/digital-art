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

<section class="au au--story" aria-labelledby="auStoryTitle">
    <div class="au__wrap au-story">

        <div class="au-mosaic">
            <figure class="au-mosaic__item au-mosaic__item--main">
                <img src="{{ asset('assets/images/about-learner.webp') }}" width="1000" height="1500"
                     alt="{{ __('frontend.about.alt1') }}" loading="lazy" decoding="async">
            </figure>
            <figure class="au-mosaic__item au-mosaic__item--top">
                <img src="{{ asset('assets/images/about-lesson.webp') }}" width="800" height="1120"
                     alt="{{ __('frontend.about.alt3') }}" loading="lazy" decoding="async">
            </figure>
            <figure class="au-mosaic__item au-mosaic__item--bottom">
                <img src="{{ asset('assets/images/about-reading.webp') }}" width="800" height="1200"
                     alt="{{ __('frontend.about.alt2') }}" loading="lazy" decoding="async">
            </figure>
            <span class="au-mosaic__glow" aria-hidden="true"></span>
        </div>

        <div class="au-story__text">
            <p class="au-eyebrow">{{ __('frontend.about.why_label') }}</p>
            <h2 id="auStoryTitle" class="au-title">{{ __('frontend.about.why_title') }}</h2>

            <p class="au-copy">{{ __('frontend.about.why_p1') }}</p>
            <p class="au-copy">{{ __('frontend.about.why_p2') }}</p>

            <ul class="au-checks">
                <li class="au-check">
                    <span class="au-check__icon" aria-hidden="true"><i class="fas fa-check"></i></span>
                    <span>{{ __('frontend.about.point1') }}</span>
                </li>
                <li class="au-check">
                    <span class="au-check__icon" aria-hidden="true"><i class="fas fa-check"></i></span>
                    <span>{{ __('frontend.about.point2') }}</span>
                </li>
                <li class="au-check">
                    <span class="au-check__icon" aria-hidden="true"><i class="fas fa-check"></i></span>
                    <span>{{ __('frontend.about.point3') }}</span>
                </li>
            </ul>

            <div class="au-actions">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <span>{{ __('frontend.about.courses_btn') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn btn--ghost">{{ __('frontend.about.contact_btn') }}</a>
            </div>
        </div>

    </div>
</section>

<section class="au au--flow" aria-labelledby="auFlowTitle">
    <div class="au__wrap">

        <header class="au-flow__head">
            <p class="au-eyebrow au-eyebrow--light">{{ __('frontend.about.how_label') }}</p>
            <h2 id="auFlowTitle" class="au-title au-title--light">{{ __('frontend.about.how_title') }}</h2>
            <p class="au-copy au-copy--light">{{ __('frontend.about.how_desc') }}</p>
        </header>

        <ol class="au-path">
            <li class="au-node">
                <span class="au-node__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                <span class="au-node__num" aria-hidden="true">01</span>
                <h3 class="au-node__title">{{ __('frontend.about.step1_title') }}</h3>
                <p class="au-node__desc">{{ __('frontend.about.step1_desc') }}</p>
            </li>
            <li class="au-node">
                <span class="au-node__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                <span class="au-node__num" aria-hidden="true">02</span>
                <h3 class="au-node__title">{{ __('frontend.about.step2_title') }}</h3>
                <p class="au-node__desc">{{ __('frontend.about.step2_desc') }}</p>
            </li>
            <li class="au-node">
                <span class="au-node__icon" aria-hidden="true"><i class="fas fa-signal"></i></span>
                <span class="au-node__num" aria-hidden="true">03</span>
                <h3 class="au-node__title">{{ __('frontend.about.step3_title') }}</h3>
                <p class="au-node__desc">{{ __('frontend.about.step3_desc') }}</p>
            </li>
            <li class="au-node au-node--accent">
                <span class="au-node__icon" aria-hidden="true"><i class="fas fa-bolt"></i></span>
                <span class="au-node__num" aria-hidden="true">04</span>
                <h3 class="au-node__title">{{ __('frontend.about.step4_title') }}</h3>
                <p class="au-node__desc">{{ __('frontend.about.step4_desc') }}</p>
            </li>
        </ol>

        <div class="au-cta">
            <div class="au-cta__text">
                <h3 class="au-cta__title">{{ __('frontend.about.cta_title') }}</h3>
                <p class="au-cta__desc">{{ __('frontend.about.cta_text') }}</p>
            </div>
            <div class="au-cta__actions">
                <a href="{{ route('product-lists') }}" class="au-cta__btn au-cta__btn--solid">
                    <span>{{ __('frontend.about.courses_btn') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="au-cta__btn au-cta__btn--line">{{ __('frontend.about.contact_btn') }}</a>
            </div>
        </div>

    </div>
</section>

@endsection
