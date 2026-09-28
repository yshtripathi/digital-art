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
    $auMedia = function ($file) {
        $path = public_path('assets/images/' . $file);
        return file_exists($path) ? asset('assets/images/' . $file) : null;
    };
    $auMain  = $auMedia('about-1.webp');
    $auSmall = $auMedia('about-2.webp');
    $auStill = $auMedia('about-3.webp');
    $auVideo = $auMedia('about-video.mp4');
    $auSteps = [
        ['icon' => 'fa-search',     'title' => __('frontend.about.step1_t'), 'text' => __('frontend.about.step1')],
        ['icon' => 'fa-list-ul',    'title' => __('frontend.about.step2_t'), 'text' => __('frontend.about.step2')],
        ['icon' => 'fa-lock-open',  'title' => __('frontend.about.step3_t'), 'text' => __('frontend.about.step3')],
    ];
@endphp

<section class="story" aria-labelledby="auTitle">
    <div class="story__wrap">
        <div class="story__media" aria-hidden="true">
            <figure class="frame frame--main {{ $auMain ? '' : 'is-empty' }}">
                @if($auMain)
                    <img src="{{ $auMain }}" alt="" width="1600" height="1067" loading="lazy" decoding="async">
                @else
                    <span class="frame__hint"><i class="far fa-image"></i></span>
                @endif
            </figure>
            <figure class="frame frame--small {{ $auSmall ? '' : 'is-empty' }}">
                @if($auSmall)
                    <img src="{{ $auSmall }}" alt="" width="800" height="1000" loading="lazy" decoding="async">
                @else
                    <span class="frame__hint"><i class="far fa-image"></i></span>
                @endif
            </figure>
            <span class="story__badge">
                <strong>4</strong>
                <span>{{ __('frontend.about.badge') }}</span>
            </span>
        </div>

        <div class="story__copy">
            <p class="story__tag">{{ __('frontend.about.label') }}</p>
            <h2 id="auTitle" class="story__title">{{ __('frontend.about.title') }}</h2>
            <p class="story__lead">{{ __('frontend.about.lead') }}</p>
            <p class="story__text">{{ __('frontend.about.body') }}</p>

            <ul class="story__points">
                <li><span class="story__tick" aria-hidden="true"><i class="fas fa-check"></i></span>{{ __('frontend.about.point1') }}</li>
                <li><span class="story__tick" aria-hidden="true"><i class="fas fa-check"></i></span>{{ __('frontend.about.point2') }}</li>
                <li><span class="story__tick" aria-hidden="true"><i class="fas fa-check"></i></span>{{ __('frontend.about.point3') }}</li>
            </ul>

            <div class="story__acts">
                <a href="{{ route('product-lists') }}" class="btn">
                    <span>{{ __('frontend.about.go_browse') }}</span>
                    <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn btn--outline">{{ __('frontend.about.go_contact') }}</a>
            </div>
        </div>
    </div>
</section>

<section class="flow" aria-labelledby="auHowTitle">
    <div class="flow__wrap">
        <header class="flow__head">
            <p class="flow__tag">{{ __('frontend.about.how_label') }}</p>
            <h2 id="auHowTitle" class="flow__title">{{ __('frontend.about.how_title') }}</h2>
        </header>

        <div class="flow__grid">
            <figure class="frame frame--video {{ ($auVideo || $auStill) ? '' : 'is-empty' }}" aria-hidden="true">
                @if($auVideo)
                    <video src="{{ $auVideo }}" @if($auStill) poster="{{ $auStill }}" @endif autoplay muted loop playsinline preload="metadata" data-about-video></video>
                @elseif($auStill)
                    <img src="{{ $auStill }}" alt="" width="1600" height="900" loading="lazy" decoding="async">
                @else
                    <span class="frame__hint frame__hint--play"><i class="fas fa-play"></i></span>
                @endif
            </figure>

            <ol class="flow__steps">
                @foreach($auSteps as $step)
                    <li class="flow__step">
                        <span class="flow__no" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="flow__body">
                            <h3 class="flow__name"><i class="fas {{ $step['icon'] }}" aria-hidden="true"></i>{{ $step['title'] }}</h3>
                            <p class="flow__text">{{ $step['text'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var video = document.querySelector('[data-about-video]');
    if (!video) { return; }

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        video.removeAttribute('autoplay');
        video.pause();
    }
}());
</script>
@endpush
