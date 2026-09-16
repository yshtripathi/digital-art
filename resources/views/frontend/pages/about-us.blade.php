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

<section class="ab">
    <div class="ab__wrap">

        {{-- ================= 1. WHAT THIS IS ================= --}}
        <div class="ab-intro">
            <div class="ab-intro__text">
                <h2 class="ab-intro__title">{{ __('frontend.about.intro_title') }}</h2>

                <div class="ab-intro__cols">
                    <p>{{ __('frontend.about.intro_p1') }}</p>
                    <p>{{ __('frontend.about.intro_p2') }}</p>
                </div>

                <ul class="ab-points">
                    <li>{{ __('frontend.about.point1') }}</li>
                    <li>{{ __('frontend.about.point2') }}</li>
                    <li>{{ __('frontend.about.point3') }}</li>
                </ul>

                <div class="ab-actions">
                    <a href="{{ route('product-lists') }}" class="ab-btn ab-btn--primary">
                        {{ __('frontend.about.courses_btn') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="ab-btn ab-btn--secondary">{{ __('frontend.about.contact_btn') }}</a>
                </div>
            </div>

            <figure class="ab-intro__media">
                <img
                    src="{{ asset('assets/images/about/mentor-learner.webp') }}"
                    srcset="{{ asset('assets/images/about/mentor-learner-sm.webp') }} 440w, {{ asset('assets/images/about/mentor-learner.webp') }} 768w"
                    sizes="(max-width: 63.99rem) 100vw, 38vw"
                    width="768" height="1376"
                    alt="{{ __('frontend.about.intro_alt') }}"
                    loading="lazy" decoding="async">
                <figcaption class="ab-intro__badge">
                    <i class="fas fa-clock" aria-hidden="true"></i> {{ __('frontend.about.badge') }}
                </figcaption>
            </figure>
        </div>

        {{-- ================= 2. NEXT STEP, OVER THE VIDEO ================= --}}
        <div class="ab-how">
            <div class="ab-video__frame">
                <video class="ab-video" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/images/about/classroom-poster.webp') }}" aria-label="{{ __('frontend.about.video_label') }}">
                    <source src="{{ asset('assets/videos/classroom.webm') }}" type="video/webm">
                    <source src="{{ asset('assets/videos/classroom.mp4') }}" type="video/mp4">
                </video>
                <span class="ab-video__veil" aria-hidden="true"></span>

                <button type="button" class="ab-video__toggle" data-ab-video aria-label="{{ __('frontend.about.video_pause') }}">
                    <i class="fas fa-pause" aria-hidden="true"></i>
                </button>

                <div class="ab-over">
                    <h2 class="ab-over__title">{{ __('frontend.about.why_title') }}</h2>
                    <ul class="ab-over__list">
                        <li class="ab-over__item">
                            <span class="ab-over__name">{{ __('frontend.about.why1_title') }}</span>
                            <span class="ab-over__desc">{{ __('frontend.about.why1_desc') }}</span>
                        </li>
                        <li class="ab-over__item">
                            <span class="ab-over__name">{{ __('frontend.about.why2_title') }}</span>
                            <span class="ab-over__desc">{{ __('frontend.about.why2_desc') }}</span>
                        </li>
                        <li class="ab-over__item">
                            <span class="ab-over__name">{{ __('frontend.about.why3_title') }}</span>
                            <span class="ab-over__desc">{{ __('frontend.about.why3_desc') }}</span>
                        </li>
                        <li class="ab-over__item">
                            <span class="ab-over__name">{{ __('frontend.about.why5_title') }}</span>
                            <span class="ab-over__desc">{{ __('frontend.about.why5_desc') }}</span>
                        </li>
                        <li class="ab-over__item">
                            <span class="ab-over__name">{{ __('frontend.about.why4_title') }}</span>
                            <span class="ab-over__desc">{{ __('frontend.about.why4_desc') }}</span>
                        </li>
                    </ul>
                </div>

                <div class="ab-cta">
                    <h2 class="ab-cta__title">{{ __('frontend.about.cta_title') }}</h2>
                    <p class="ab-cta__text">{{ __('frontend.about.cta_text') }}</p>
                    <div class="ab-cta__actions">
                        <a href="{{ route('product-lists') }}" class="ab-btn ab-btn--primary">
                            {{ __('frontend.about.courses_btn') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        <a href="{{ route('contact') }}" class="ab-btn ab-btn--onDark">{{ __('frontend.about.contact_btn') }}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Pause for reduced motion, then wire the play/pause button
        document.querySelectorAll('.ab-video').forEach(function (video) {
            if (reduce) { video.removeAttribute('autoplay'); video.pause(); }
        });
        document.querySelectorAll('[data-ab-video]').forEach(function (btn) {
            var video = btn.parentElement.querySelector('video');
            if (!video) return;
            var sync = function () {
                var paused = video.paused;
                btn.querySelector('i').className = paused ? 'fas fa-play' : 'fas fa-pause';
                btn.setAttribute('aria-label', paused ? @json(__('frontend.about.video_play')) : @json(__('frontend.about.video_pause')));
            };
            btn.addEventListener('click', function () { video.paused ? video.play() : video.pause(); });
            video.addEventListener('play', sync);
            video.addEventListener('pause', sync);
            sync();
        });
    });
</script>
@endpush
