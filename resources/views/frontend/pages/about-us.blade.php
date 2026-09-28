@extends('frontend.layouts.main')
@section('title', __('frontend.about.page_name'))
@section('description', __('frontend.about.desc'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.about.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.about.page_name')]
    ]
])

@php
    $auImg = fn ($file) => asset('assets/images/' . $file) . '?v=' . filemtime(public_path('assets/images/' . $file));
@endphp

<section class="au" aria-labelledby="auTitle">
    <div class="au__wrap">
        <div class="au-collage" aria-hidden="true">
            <figure class="au-shot au-shot--tall">
                <img src="{{ $auImg('about-1.webp') }}" alt="" width="900" height="1350" loading="lazy" decoding="async">
            </figure>
            <figure class="au-shot au-shot--square">
                <img src="{{ $auImg('about-2.webp') }}" alt="" width="900" height="900" loading="lazy" decoding="async">
            </figure>
            <figure class="au-shot au-shot--wide">
                <img src="{{ $auImg('about-3.webp') }}" alt="" width="1200" height="800" loading="lazy" decoding="async">
            </figure>

            <span class="au-tile au-tile--writing"><i class="fas fa-pen-nib"></i></span>
            <span class="au-tile au-tile--language"><i class="fas fa-headphones"></i></span>

            <span class="au-badge">
                <strong>4</strong>
                <span>{{ __('frontend.about.badge') }}</span>
                <span class="au-badge__bars"><span></span><span></span><span></span><span></span></span>
            </span>
        </div>

        <div class="au-copy">
            <span class="au-copy__tag">{{ __('frontend.about.label') }}</span>
            <h2 id="auTitle" class="au-copy__title">{{ __('frontend.about.title') }}</h2>
            <p class="au-copy__lead">{{ __('frontend.about.lead') }}</p>
            <p class="au-copy__text">{{ __('frontend.about.body') }}</p>

            <ul class="au-points">
                <li style="--i: 0"><span class="au-points__icon" aria-hidden="true"><i class="fas fa-search"></i></span> {{ __('frontend.about.point1') }}</li>
                <li style="--i: 1"><span class="au-points__icon au-points__icon--alt" aria-hidden="true"><i class="fas fa-layer-group"></i></span> {{ __('frontend.about.point2') }}</li>
                <li style="--i: 2"><span class="au-points__icon" aria-hidden="true"><i class="fas fa-wallet"></i></span> {{ __('frontend.about.point3') }}</li>
            </ul>

            <div class="au-copy__acts">
                <a href="{{ route('product-lists') }}" class="btn au-copy__go">
                    <span>{{ __('frontend.about.go_browse') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn btn--ghost">{{ __('frontend.about.go_contact') }}</a>
            </div>
        </div>
    </div>
</section>

@endsection
