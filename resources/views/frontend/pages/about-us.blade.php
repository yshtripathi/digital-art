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

        <div class="au-text">
            <p class="eyebrow">{{ __('frontend.about.intro_tag') }}</p>
            <h2 id="auTitle" class="au-title">{{ __('frontend.about.intro_title') }}</h2>
            <p class="au-copy au-copy--lead">{{ __('frontend.about.intro_p1') }}</p>
            <p class="au-copy">{{ __('frontend.about.intro_p2') }}</p>

            <ul class="au-points">
                <li><span class="au-points__icon" aria-hidden="true"><i class="fas fa-search"></i></span>{{ __('frontend.about.point_browse') }}</li>
                <li><span class="au-points__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>{{ __('frontend.about.point_split') }}</li>
                <li><span class="au-points__icon" aria-hidden="true"><i class="fas fa-coins"></i></span>{{ __('frontend.about.point_credits') }}</li>
            </ul>
        </div>

        <div class="au-media">
            <figure class="au-video">
                <video class="au-video__el" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/images/about-work.webp') }}" aria-label="{{ __('frontend.about.video_label') }}" data-au-video>
                    <source src="{{ asset('assets/videos/about-work.mp4') }}" type="video/mp4">
                </video>
                <button type="button" class="au-video__toggle" aria-label="{{ __('frontend.about.video_pause') }}" data-pause="{{ __('frontend.about.video_pause') }}" data-play="{{ __('frontend.about.video_play') }}" data-au-toggle>
                    <i class="fas fa-pause" aria-hidden="true"></i>
                </button>
            </figure>
        </div>

    </div>
</section>

<section class="au-path" aria-labelledby="auPathTitle">
    <div class="au-path__box">
        <header class="au-path__head">
            <p class="eyebrow">{{ __('frontend.about.path_tag') }}</p>
            <h2 id="auPathTitle" class="au-path__title">{{ __('frontend.about.path_title') }}</h2>
        </header>

        <ol class="au-flow">
            @foreach([['fa-th-large', 1], ['fa-book-open', 2], ['fa-signal', 3], ['fa-coins', 4]] as [$icon, $n])
                <li class="au-flow__step">
                    <span class="au-flow__num" aria-hidden="true">{{ str_pad($n, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="au-flow__icon" aria-hidden="true"><i class="fas {{ $icon }}"></i></span>
                    <h3 class="au-flow__name">{{ __('frontend.about.path' . $n) }}</h3>
                    <p class="au-flow__text">{{ __('frontend.about.path' . $n . '_text') }}</p>
                </li>
            @endforeach
        </ol>

        <div class="au-path__cta">
            <p class="au-path__ask">{{ __('frontend.about.cta_title') }}</p>
            <div class="au-path__actions">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <span>{{ __('frontend.about.cta_explore') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn au-path__ghost">{{ __('frontend.about.cta_contact') }}</a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var video = document.querySelector('[data-au-video]');
    var toggle = document.querySelector('[data-au-toggle]');
    if (!video || !toggle) { return; }

    var icon = toggle.querySelector('i');

    function paint() {
        var paused = video.paused;
        toggle.setAttribute('aria-label', paused ? toggle.dataset.play : toggle.dataset.pause);
        icon.className = paused ? 'fas fa-play' : 'fas fa-pause';
    }

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        video.removeAttribute('autoplay');
        video.pause();
    }

    toggle.addEventListener('click', function () {
        if (video.paused) { video.play(); } else { video.pause(); }
    });
    video.addEventListener('play', paint);
    video.addEventListener('pause', paint);
    paint();
}());
</script>
@endpush
