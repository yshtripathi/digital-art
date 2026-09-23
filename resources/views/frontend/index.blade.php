@extends('frontend.layouts.main')
@section('description', __('frontend.home.meta'))

@section('main-content')
@php
    $hoCategories = isset($category_lists) ? $category_lists : collect();

    $hoCourses = collect($product_lists ?? [])->filter(fn ($c) => !empty($c->photo))->values();
    $hoCourses = $hoCourses->where('is_featured', 1)
        ->concat($hoCourses->where('is_featured', '!=', 1))
        ->take(12)
        ->values();

    $cur = session('currency');
    if ($cur == 'JPY') {
        $tiers = [
            ['n' => __('frontend.topup.tier1'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => '&yen;1 - &yen;79,999',        'f' => false],
            ['n' => __('frontend.topup.tier2'), 'i' => 'fa-star',    'big' => 'x2', 'r' => '&yen;80,000 - &yen;159,999',  'f' => false],
            ['n' => __('frontend.topup.tier3'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => '&yen;160,000 - &yen;239,999', 'f' => false],
            ['n' => __('frontend.topup.tier4'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => '&yen;240,000+',               'f' => true],
        ];
        $rateNote = __('frontend.topup.rate_jpy');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n' => __('frontend.topup.tier1'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => 'HK$1 - HK$3,999',      'f' => false],
            ['n' => __('frontend.topup.tier2'), 'i' => 'fa-star',    'big' => 'x2', 'r' => 'HK$4,000 - HK$7,999',  'f' => false],
            ['n' => __('frontend.topup.tier3'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => 'HK$8,000 - HK$11,999', 'f' => false],
            ['n' => __('frontend.topup.tier4'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => 'HK$12,000+',           'f' => true],
        ];
        $rateNote = __('frontend.topup.rate_hkd');
    } else {
        $tiers = [
            ['n' => __('frontend.topup.tier1'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => '$1 - $499',       'f' => false],
            ['n' => __('frontend.topup.tier2'), 'i' => 'fa-star',    'big' => 'x2', 'r' => '$500 - $999',     'f' => false],
            ['n' => __('frontend.topup.tier3'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => '$1,000 - $1,499', 'f' => false],
            ['n' => __('frontend.topup.tier4'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => '$1,500+',         'f' => true],
        ];
        $rateNote = __('frontend.topup.rate_usd');
    }

    $hoSteps = [
        ['n' => 1, 'i' => 'fa-layer-group'],
        ['n' => 2, 'i' => 'fa-book-open'],
        ['n' => 3, 'i' => 'fa-signal'],
        ['n' => 6, 'i' => 'fa-lock-open'],
    ];
@endphp

<section class="ho-hero" aria-labelledby="hoHeroTitle">
    <span class="ho-fx" aria-hidden="true">
        <span class="ho-fx__shoot ho-fx__shoot--1"></span>
        <span class="ho-fx__shoot ho-fx__shoot--2"></span>
        <span class="ho-fx__shoot ho-fx__shoot--3"></span>
        <span class="ho-fx__spark ho-fx__spark--1"></span>
        <span class="ho-fx__spark ho-fx__spark--2"></span>
        <span class="ho-fx__spark ho-fx__spark--3"></span>
        <span class="ho-fx__spark ho-fx__spark--4"></span>
        <span class="ho-fx__icon ho-fx__icon--1"><i class="fas fa-heart"></i></span>
        <span class="ho-fx__icon ho-fx__icon--2 ho-fx__icon--fill"><i class="fab fa-instagram"></i></span>
        <span class="ho-fx__icon ho-fx__icon--3"><i class="fas fa-play"></i></span>
        <span class="ho-fx__icon ho-fx__icon--4"><i class="fab fa-tiktok"></i></span>
        <span class="ho-fx__icon ho-fx__icon--5 ho-fx__icon--fill"><i class="fas fa-camera-retro"></i></span>
        <span class="ho-fx__icon ho-fx__icon--6"><i class="fas fa-comment-dots"></i></span>
    </span>

    <div class="ho__wrap ho-hero__grid">

        <div class="ho-hero__text">
            <p class="ho-hero__badge">
                <span class="ho-hero__badge-icon" aria-hidden="true"><i class="fas fa-magic"></i></span>
                {{ __('frontend.home.hero_eyebrow') }}
            </p>
            <h1 id="hoHeroTitle" class="ho-hero__title">
                <span class="ho-hero__ink">{{ __('frontend.home.hero_title') }}</span>
                <svg class="ho-hero__squiggle" viewBox="0 0 300 16" preserveAspectRatio="none" aria-hidden="true" focusable="false"><path d="M3 11c28-8 52-8 76-2s50 7 76 0 52-8 76-1 40 6 66 0"/></svg>
            </h1>
            <p class="ho-hero__desc">{{ __('frontend.home.hero_desc') }}</p>

            <div class="ho-hero__actions">
                <a href="{{ route('product-lists') }}" class="btn btn--primary ho-hero__cta">
                    <span>{{ __('frontend.home.hero_explore') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('points.topup') }}" class="btn btn--ghost">
                    <i class="fas fa-bolt" aria-hidden="true"></i>
                    <span>{{ __('frontend.home.credits_btn') }}</span>
                </a>
            </div>
        </div>

        <div class="ho-collage">
            <figure class="ho-collage__item ho-collage__item--tall">
                <img src="{{ asset('assets/images/home-hero-mobile.webp') }}" width="800" height="1200"
                     alt="{{ __('frontend.home.hero_alt2') }}" fetchpriority="high" decoding="async">
            </figure>
            <figure class="ho-collage__item ho-collage__item--wide">
                <img src="{{ asset('assets/images/home-hero-studio.webp') }}" width="1200" height="800"
                     alt="{{ __('frontend.home.hero_alt1') }}" fetchpriority="high" decoding="async">
            </figure>
            <figure class="ho-collage__item ho-collage__item--small">
                <img src="{{ asset('assets/images/home-hero-workshop.webp') }}" width="1000" height="665"
                     alt="{{ __('frontend.home.hero_alt3') }}" decoding="async">
            </figure>

            <ul class="ho-floats">
                <li class="ho-float ho-float--levels">
                    <span class="ho-float__icon" aria-hidden="true"><i class="fas fa-signal"></i></span>
                    <span>{{ __('frontend.home.card_levels') }}</span>
                </li>
                <li class="ho-float ho-float--pace">
                    <span class="ho-float__icon" aria-hidden="true"><i class="fas fa-clock"></i></span>
                    <span>{{ __('frontend.home.card_pace') }}</span>
                </li>
                <li class="ho-float ho-float--credits">
                    <span class="ho-float__icon ho-float__icon--accent" aria-hidden="true"><i class="fas fa-bolt"></i></span>
                    <span>{{ __('frontend.home.card_credits') }}</span>
                </li>
            </ul>
            <span class="ho-collage__ring" aria-hidden="true"></span>
            <span class="ho-collage__blob" aria-hidden="true"></span>
            <span class="ho-bubble ho-bubble--heart" aria-hidden="true"><i class="fas fa-heart"></i></span>
            <span class="ho-bubble ho-bubble--play" aria-hidden="true"><i class="fas fa-play"></i></span>
            <span class="ho-bubble ho-bubble--star" aria-hidden="true"><i class="fas fa-star"></i></span>
        </div>

    </div>
</section>

@if($hoCategories->count())
    <section class="ho-sec" aria-labelledby="hoCatsTitle">
        <div class="ho__wrap">
            <header class="ho-head">
                <div>
                    <h2 id="hoCatsTitle" class="ho-head__title">{{ __('frontend.home.cats_title') }}</h2>
                    <p class="ho-head__desc">{{ __('frontend.home.cats_desc') }}</p>
                </div>
                <a href="{{ route('product-lists') }}" class="ho-link">
                    <span>{{ __('frontend.home.cats_all') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </header>

            <ul class="ho-cats">
                @foreach($hoCategories as $cat)
                    <li>
                        <a href="{{ route('product-lists', $cat->slug) }}" class="ho-cat">
                            <span class="ho-cat__media">
                                @if($cat->photo)
                                    <img src="{{ asset(ltrim($cat->photo, '/')) }}" alt="" loading="lazy" decoding="async">
                                @else
                                    <span class="ho-cat__empty" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                                @endif
                            </span>
                            <span class="ho-cat__body">
                                <span class="ho-cat__name">{{ $cat->title }}</span>
                                <span class="ho-cat__count">{{ trans_choice('frontend.home.cats_count', $cat->products_count ?? 0, ['count' => $cat->products_count ?? 0]) }}</span>
                            </span>
                            <span class="ho-cat__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

@if($hoCourses->count())
    <section class="ho-sec ho-sec--tint" aria-labelledby="hoCoursesTitle" data-slider>
        <div class="ho__wrap">
            <header class="ho-head">
                <div>
                    <h2 id="hoCoursesTitle" class="ho-head__title">{{ __('frontend.home.featured_title') }}</h2>
                    <p class="ho-head__desc">{{ __('frontend.home.featured_desc') }}</p>
                </div>
                <div class="ho-arrows">
                    <button type="button" class="ho-arrow" data-slider-prev aria-label="{{ __('frontend.home.prev') }}">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="ho-arrow" data-slider-next aria-label="{{ __('frontend.home.next') }}">
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </header>

            <ul class="ho-track" data-slider-track>
                @foreach($hoCourses as $course)
                    @php
                        $img = explode(',', $course->photo)[0];
                        $lvCount = $course->levels ? $course->levels->count() : 0;
                        $minPts = $lvCount ? $course->levels->min('price_in_points') : null;
                        $catName = optional($course->cat_info)->title;
                    @endphp
                    <li class="ho-slide" data-slide>
                        <a href="{{ route('product-detail', $course->slug) }}" class="ho-course">
                            <span class="ho-course__media">
                                <img src="{{ asset(ltrim($img, '/')) }}" alt="" loading="lazy" decoding="async">
                                @if($catName)
                                    <span class="ho-course__cat">{{ $catName }}</span>
                                @endif
                            </span>
                            <span class="ho-course__body">
                                @if($lvCount)
                                    <span class="ho-course__levels">
                                        <i class="fas fa-signal" aria-hidden="true"></i>
                                        {{ trans_choice('frontend.catalog.levels', $lvCount, ['count' => $lvCount]) }}
                                    </span>
                                @endif
                                <span class="ho-course__title">{{ $course->title }}</span>
                                <span class="ho-course__foot">
                                    @if($lvCount)
                                        <span class="ho-course__price">
                                            <small>{{ __('frontend.home.from') }}</small>
                                            <strong><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($minPts) }}</strong>
                                            <small>{{ __('frontend.home.credits') }}</small>
                                        </span>
                                    @else
                                        <span class="ho-course__price"><small>{{ __('frontend.catalog.no_levels') }}</small></span>
                                    @endif
                                    <span class="ho-course__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="ho-foot">
                <a href="{{ route('product-lists') }}" class="btn btn--ghost">
                    <span>{{ __('frontend.home.cats_all') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
@endif

<section class="ho-sec" aria-labelledby="hoStepsTitle">
    <div class="ho__wrap">
        <header class="ho-head ho-head--center">
            <div>
                <p class="ho-eyebrow">{{ __('frontend.home.steps_label') }}</p>
                <h2 id="hoStepsTitle" class="ho-head__title">{{ __('frontend.home.steps_title') }}</h2>
                <p class="ho-head__desc">{{ __('frontend.home.steps_desc') }}</p>
            </div>
        </header>

        <ol class="ho-steps">
            @foreach($hoSteps as $i => $s)
                <li class="ho-step {{ $loop->last ? 'ho-step--accent' : '' }}">
                    <span class="ho-step__top">
                        <span class="ho-step__icon" aria-hidden="true"><i class="fas {{ $s['i'] }}"></i></span>
                        <span class="ho-step__num" aria-hidden="true">{{ sprintf('%02d', $i + 1) }}</span>
                    </span>
                    <h3 class="ho-step__title">{{ __('frontend.home.step' . $s['n'] . '_title') }}</h3>
                    <p class="ho-step__desc">{{ __('frontend.home.step' . $s['n'] . '_desc') }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="ho-sec ho-sec--tint ho-watch" aria-labelledby="hoWatchTitle">
    <div class="ho__wrap ho-watch__grid">
        <div class="ho-watch__media">
            <div class="ho-reel">
                <video class="ho-reel__video" autoplay muted loop playsinline preload="metadata"
                       poster="{{ asset('assets/images/home-study-poster.webp') }}" aria-hidden="true">
                    <source src="{{ asset('assets/videos/home-study.mp4') }}" type="video/mp4">
                </video>
                <button type="button" class="ho-reel__toggle" data-video-toggle aria-label="{{ __('frontend.home.video_pause') }}">
                    <i class="fas fa-pause" aria-hidden="true"></i>
                </button>
            </div>
            <span class="ho-watch__blob" aria-hidden="true"></span>
            <span class="ho-watch__dots" aria-hidden="true"></span>
        </div>

        <div class="ho-watch__text">
            <p class="ho-eyebrow">{{ __('frontend.home.watch_label') }}</p>
            <h2 id="hoWatchTitle" class="ho-head__title">{{ __('frontend.home.watch_title') }}</h2>
            <p class="ho-head__desc">{{ __('frontend.home.watch_desc') }}</p>

            <ul class="ho-watch__list">
                <li class="ho-watch__item">
                    <span class="ho-watch__icon" aria-hidden="true"><i class="fas fa-laptop"></i></span>
                    <span>{{ __('frontend.home.watch_point1') }}</span>
                </li>
                <li class="ho-watch__item">
                    <span class="ho-watch__icon" aria-hidden="true"><i class="fas fa-redo-alt"></i></span>
                    <span>{{ __('frontend.home.watch_point2') }}</span>
                </li>
                <li class="ho-watch__item">
                    <span class="ho-watch__icon" aria-hidden="true"><i class="fas fa-list-ul"></i></span>
                    <span>{{ __('frontend.home.watch_point3') }}</span>
                </li>
            </ul>

            <a href="{{ route('product-lists') }}" class="btn btn--primary ho-watch__cta">
                <span>{{ __('frontend.home.hero_explore') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<section class="ho-credits" aria-labelledby="hoCreditsTitle">
    <div class="ho__wrap ho-credits__grid">
        <div class="ho-credits__text">
            <p class="ho-eyebrow ho-eyebrow--light">{{ $rateNote }}</p>
            <h2 id="hoCreditsTitle" class="ho-credits__title">{{ __('frontend.topup.tiers_title') }}</h2>
            <p class="ho-credits__desc">{{ __('frontend.topup.intro') }}</p>
            <a href="{{ route('points.topup') }}" class="ho-credits__cta">
                <i class="fas fa-bolt" aria-hidden="true"></i>
                <span>{{ __('frontend.home.credits_btn') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        <ol class="ho-tiers">
            @foreach($tiers as $t)
                <li class="ho-tier {{ $t['f'] ? 'ho-tier--best' : '' }}">
                    <span class="ho-tier__icon" aria-hidden="true"><i class="fas {{ $t['i'] }}"></i></span>
                    <span class="ho-tier__mult">{{ $t['big'] }}</span>
                    <span class="ho-tier__name">{{ $t['n'] }}</span>
                    <span class="ho-tier__range">{!! $t['r'] !!}</span>
                    @if($t['f'])
                        <span class="ho-tier__badge">{{ __('frontend.topup.best') }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-slider]').forEach(function (slider) {
        const track = slider.querySelector('[data-slider-track]');
        const slides = track ? track.querySelectorAll('[data-slide]') : [];
        const prev = slider.querySelector('[data-slider-prev]');
        const next = slider.querySelector('[data-slider-next]');
        if (!slides.length || !prev || !next) return;

        function step() {
            const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
            return slides[0].getBoundingClientRect().width + gap;
        }

        function update() {
            const max = track.scrollWidth - track.clientWidth;
            slider.classList.toggle('is-static', max <= 1);
            prev.disabled = track.scrollLeft <= 1;
            next.disabled = track.scrollLeft >= max - 1;
        }

        prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
        next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: 'smooth' }); });

        let ticking = false;
        track.addEventListener('scroll', function () {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(function () { update(); ticking = false; });
        }, { passive: true });
        window.addEventListener('resize', update);
        update();
    });

    document.querySelectorAll('[data-video-toggle]').forEach(function (btn) {
        const video = btn.parentElement.querySelector('video');
        if (!video) return;
        const icon = btn.querySelector('i');
        const labels = { play: @json(__('frontend.home.video_play')), pause: @json(__('frontend.home.video_pause')) };

        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            video.removeAttribute('autoplay');
            video.pause();
        }

        function sync() {
            icon.className = video.paused ? 'fas fa-play' : 'fas fa-pause';
            btn.setAttribute('aria-label', video.paused ? labels.play : labels.pause);
        }

        btn.addEventListener('click', function () {
            if (video.paused) video.play(); else video.pause();
        });
        video.addEventListener('play', sync);
        video.addEventListener('pause', sync);
        sync();
    });
});
</script>
@endpush
