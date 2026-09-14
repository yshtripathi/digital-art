@extends('frontend.layouts.main')
@section('title', __('managenovax.about.page_title'))

@section('main-content')
@php
    $abCourses    = \App\Models\Product::where('status', 'active')->count();
    $abCategories = \App\Models\Category::where('status', 'active')->where('is_parent', 1)->count();
    $abLevels     = \App\Models\ProductLevel::distinct()->count('skill_level') ?: 4;
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.about.page_title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.about.page_title')]
    ]
])

<section class="ab">
    <div class="ab__wrap">

        {{-- ================= 1. WHO WE ARE ================= --}}
        <div class="ab-intro">
            <div class="ab-intro__text">
                <span class="ab-eyebrow">{{ __('managenovax.about.eyebrow') }}</span>
                <h2 class="ab-intro__title">{{ __('managenovax.about.intro_title') }}</h2>
                <p class="ab-intro__p">{{ __('managenovax.about.intro_p1') }}</p>
                <p class="ab-intro__p">{{ __('managenovax.about.intro_p2') }}</p>
                <ul class="ab-points">
                    <li><span class="ab-points__icon"><i class="fas fa-check"></i></span> {{ __('managenovax.about.point_1') }}</li>
                    <li><span class="ab-points__icon"><i class="fas fa-check"></i></span> {{ __('managenovax.about.point_2') }}</li>
                    <li><span class="ab-points__icon"><i class="fas fa-check"></i></span> {{ __('managenovax.about.point_3') }}</li>
                </ul>
                <div class="ab-actions">
                    <a href="{{ route('product-lists') }}" class="ab-btn ab-btn--lime">{{ __('managenovax.about.cta_btn_enroll') }} <i class="fas fa-arrow-right"></i></a>
                    <a href="{{ route('contact') }}" class="ab-btn ab-btn--outline">{{ __('managenovax.about.cta_btn_contact') }}</a>
                </div>
            </div>

            <figure class="ab-intro__media">
                <img
                    src="{{ asset('assets/images/about/learn-together.webp') }}"
                    srcset="{{ asset('assets/images/about/learn-together-sm.webp') }} 700w, {{ asset('assets/images/about/learn-together.webp') }} 1200w"
                    sizes="(max-width: 991px) 100vw, 45vw"
                    width="1200" height="1800"
                    alt="{{ __('managenovax.about.intro_title') }}"
                    loading="lazy">
                <figcaption class="ab-intro__badge"><i class="fas fa-clock"></i> {{ __('managenovax.about.photo_badge') }}</figcaption>
                <span class="ab-intro__ring" aria-hidden="true"></span>
            </figure>
        </div>

        {{-- ================= 2. NUMBERS ================= --}}
        <div class="ab-stats">
            <h2 class="ab-stats__title">{{ __('managenovax.about.stats_title') }}</h2>
            <ul class="ab-stats__grid">
                <li class="ab-stat">
                    <strong class="ab-stat__num" data-count="{{ $abCourses }}">{{ $abCourses }}</strong>
                    <span class="ab-stat__label"><i class="fas fa-book-open"></i> {{ __('managenovax.about.stat_courses') }}</span>
                </li>
                <li class="ab-stat">
                    <strong class="ab-stat__num" data-count="{{ $abCategories }}">{{ $abCategories }}</strong>
                    <span class="ab-stat__label"><i class="fas fa-layer-group"></i> {{ __('managenovax.about.stat_categories') }}</span>
                </li>
                <li class="ab-stat">
                    <strong class="ab-stat__num" data-count="{{ $abLevels }}">{{ $abLevels }}</strong>
                    <span class="ab-stat__label"><i class="fas fa-signal"></i> {{ __('managenovax.about.stat_levels') }}</span>
                </li>
                <li class="ab-stat">
                    <strong class="ab-stat__num">24/7</strong>
                    <span class="ab-stat__label"><i class="fas fa-laptop"></i> {{ __('managenovax.about.stat_access') }}</span>
                </li>
            </ul>
        </div>

        {{-- ================= 3. LEARNING JOURNEY ================= --}}
        <div class="ab-journey">
            <div class="ab-journey__media">
                <video class="ab-video" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/images/about/journey-poster.webp') }}" aria-label="{{ __('managenovax.about.video_label') }}">
                    <source src="{{ asset('assets/videos/inspire.webm') }}" type="video/webm">
                </video>
                <button type="button" class="ab-video__toggle" data-ab-video aria-label="Pause video"><i class="fas fa-pause"></i></button>
            </div>

            <div class="ab-journey__content">
                <span class="ab-eyebrow ab-eyebrow--dark">{{ __('managenovax.about.journey_eyebrow') }}</span>
                <h2 class="ab-journey__title">{{ __('managenovax.about.journey_title') }}</h2>

                <ol class="ab-steps">
                    <li class="ab-step">
                        <span class="ab-step__num">01</span>
                        <span class="ab-step__icon"><i class="fas fa-search"></i></span>
                        <div>
                            <h3 class="ab-step__title">{{ __('managenovax.about.step1_title') }}</h3>
                            <p class="ab-step__desc">{{ __('managenovax.about.step1_desc') }}</p>
                        </div>
                    </li>
                    <li class="ab-step">
                        <span class="ab-step__num">02</span>
                        <span class="ab-step__icon"><i class="fas fa-sliders-h"></i></span>
                        <div>
                            <h3 class="ab-step__title">{{ __('managenovax.about.step2_title') }}</h3>
                            <p class="ab-step__desc">{{ __('managenovax.about.step2_desc') }}</p>
                        </div>
                    </li>
                    <li class="ab-step">
                        <span class="ab-step__num">03</span>
                        <span class="ab-step__icon"><i class="fas fa-play"></i></span>
                        <div>
                            <h3 class="ab-step__title">{{ __('managenovax.about.step3_title') }}</h3>
                            <p class="ab-step__desc">{{ __('managenovax.about.step3_desc') }}</p>
                        </div>
                    </li>
                    <li class="ab-step">
                        <span class="ab-step__num">04</span>
                        <span class="ab-step__icon"><i class="fas fa-chart-line"></i></span>
                        <div>
                            <h3 class="ab-step__title">{{ __('managenovax.about.step4_title') }}</h3>
                            <p class="ab-step__desc">{{ __('managenovax.about.step4_desc') }}</p>
                        </div>
                    </li>
                </ol>
            </div>

            <div class="ab-path">
                <div class="ab-path__track" aria-hidden="true">
                    <span class="ab-path__lvl ab-path__lvl--beginner">{{ __('managenovax.course.skill_beginner') }}</span>
                    <i class="fas fa-chevron-right"></i>
                    <span class="ab-path__lvl ab-path__lvl--intermediate">{{ __('managenovax.course.skill_intermediate') }}</span>
                    <i class="fas fa-chevron-right"></i>
                    <span class="ab-path__lvl ab-path__lvl--advanced">{{ __('managenovax.course.skill_advanced') }}</span>
                    <i class="fas fa-chevron-right"></i>
                    <span class="ab-path__lvl ab-path__lvl--expert">{{ __('managenovax.course.skill_expert') }}</span>
                </div>
                <p class="ab-path__caption">{{ __('managenovax.about.path_caption') }}</p>
            </div>
        </div>

        {{-- ================= 4. WHY US + CTA ================= --}}
        <div class="ab-why">
            <div class="ab-why__card">
                <h2 class="ab-why__title">{{ __('managenovax.about.why_title') }}</h2>
                <ul class="ab-reasons">
                    <li class="ab-reason">
                        <span class="ab-reason__icon ab-reason__icon--lime"><i class="fas fa-sitemap"></i></span>
                        <h3 class="ab-reason__title">{{ __('managenovax.about.why1_title') }}</h3>
                        <p class="ab-reason__desc">{{ __('managenovax.about.why1_desc') }}</p>
                    </li>
                    <li class="ab-reason">
                        <span class="ab-reason__icon ab-reason__icon--cobalt"><i class="fas fa-globe"></i></span>
                        <h3 class="ab-reason__title">{{ __('managenovax.about.why2_title') }}</h3>
                        <p class="ab-reason__desc">{{ __('managenovax.about.why2_desc') }}</p>
                    </li>
                    <li class="ab-reason">
                        <span class="ab-reason__icon ab-reason__icon--saffron"><i class="fas fa-coins"></i></span>
                        <h3 class="ab-reason__title">{{ __('managenovax.about.why3_title') }}</h3>
                        <p class="ab-reason__desc">{{ __('managenovax.about.why3_desc') }}</p>
                    </li>
                    <li class="ab-reason">
                        <span class="ab-reason__icon ab-reason__icon--maroon"><i class="fas fa-headset"></i></span>
                        <h3 class="ab-reason__title">{{ __('managenovax.about.why4_title') }}</h3>
                        <p class="ab-reason__desc">{{ __('managenovax.about.why4_desc') }}</p>
                    </li>
                </ul>
            </div>

            <div class="ab-cta">
                <div class="ab-cta__media">
                    <img src="{{ asset('assets/images/about/start-learning.webp') }}" width="1000" height="1000" alt="{{ __('managenovax.about.cta_title') }}" loading="lazy">
                </div>
                <div class="ab-cta__content">
                    <h2 class="ab-cta__title">{{ __('managenovax.about.cta_title') }}</h2>
                    <p class="ab-cta__body">{{ __('managenovax.about.cta_body') }}</p>
                    <div class="ab-cta__actions">
                        <a href="{{ route('product-lists') }}" class="ab-btn ab-btn--lime">{{ __('managenovax.about.cta_btn_enroll') }} <i class="fas fa-arrow-right"></i></a>
                        <a href="{{ route('contact') }}" class="ab-btn ab-btn--white">{{ __('managenovax.about.cta_btn_contact') }}</a>
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

        // Videos: pause for reduced motion, play/pause buttons
        document.querySelectorAll('.ab-video').forEach(function (video) {
            if (reduce) { video.removeAttribute('autoplay'); video.pause(); }
        });
        document.querySelectorAll('[data-ab-video]').forEach(function (btn) {
            var video = btn.parentElement.querySelector('video');
            var sync = function () {
                var paused = video.paused;
                btn.querySelector('i').className = paused ? 'fas fa-play' : 'fas fa-pause';
                btn.setAttribute('aria-label', paused ? 'Play video' : 'Pause video');
            };
            btn.addEventListener('click', function () { video.paused ? video.play() : video.pause(); });
            video.addEventListener('play', sync);
            video.addEventListener('pause', sync);
            sync();
        });

        // Count-up numbers when the stats band scrolls into view
        var nums = document.querySelectorAll('.ab-stat__num[data-count]');
        if (!nums.length || reduce || !('IntersectionObserver' in window)) return;
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var el = entry.target, end = parseInt(el.dataset.count, 10) || 0, start = null;
                var step = function (t) {
                    if (!start) start = t;
                    var p = Math.min((t - start) / 900, 1);
                    el.textContent = Math.round(end * (1 - Math.pow(1 - p, 3)));
                    if (p < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
                io.unobserve(el);
            });
        }, { threshold: 0.5 });
        nums.forEach(function (n) { io.observe(n); });
    });
</script>
@endpush
