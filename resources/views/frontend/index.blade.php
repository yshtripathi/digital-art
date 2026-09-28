@extends('frontend.layouts.main')
@section('description', __('frontend.home.desc'))

@section('main-content')
@php

    $hoCourses = collect($product_lists ?? [])->filter(fn ($c) => !empty($c->photo))->values();
    $hoCourses = $hoCourses->where('is_featured', 1)
        ->concat($hoCourses->where('is_featured', '!=', 1))
        ->take(15)
        ->values();


    $hoCur = session('currency');
    if ($hoCur == 'JPY') {
        $hoTiers = [['tier_standard', '&yen;1 – &yen;79,999', 'x1'], ['tier_premium', '&yen;80,000 – &yen;159,999', 'x2'], ['tier_elite', '&yen;160,000 – &yen;239,999', 'x2.5'], ['tier_vip', '&yen;240,000+', 'x3']];
    } elseif ($hoCur == 'HKD') {
        $hoTiers = [['tier_standard', 'HK$1 – HK$3,999', 'x1'], ['tier_premium', 'HK$4,000 – HK$7,999', 'x2'], ['tier_elite', 'HK$8,000 – HK$11,999', 'x2.5'], ['tier_vip', 'HK$12,000+', 'x3']];
    } else {
        $hoTiers = [['tier_standard', '$1 – $499', 'x1'], ['tier_premium', '$500 – $999', 'x2'], ['tier_elite', '$1,000 – $1,499', 'x2.5'], ['tier_vip', '$1,500+', 'x3']];
    }
    $hoTierIcons = ['fa-feather', 'fa-star', 'fa-gem', 'fa-crown'];

    $hoSteps = [
        ['t' => 'step1', 'd' => 'step1_text', 'i' => 'fa-compass'],
        ['t' => 'step2', 'd' => 'step2_text', 'i' => 'fa-signal'],
        ['t' => 'step3', 'd' => 'step3_text', 'i' => 'fa-lock-open'],
        ['t' => 'step4', 'd' => 'step4_text', 'i' => 'fa-graduation-cap'],
    ];
    $hoWhy = [
        ['t' => 'perk1', 'd' => 'perk1_text', 'i' => 'fa-eye'],
        ['t' => 'perk2', 'd' => 'perk2_text', 'i' => 'fa-wallet'],
        ['t' => 'perk3', 'd' => 'perk3_text', 'i' => 'fa-clock'],
        ['t' => 'perk4', 'd' => 'perk4_text', 'i' => 'fa-layer-group'],
    ];
    $hoImg = fn ($file) => asset('assets/images/' . $file) . '?v=' . filemtime(public_path('assets/images/' . $file));
@endphp

<section class="hm-hero" aria-labelledby="hmTitle" data-hero>
    <div class="hm-hero__in">
        <div class="hm-hero__copy">
            <span class="hm-hero__tag">{{ __('frontend.home.badge') }}</span>
            <h1 id="hmTitle" class="hm-hero__title">
                <span>{{ __('frontend.home.headline') }}</span>
                <span class="hm-hero__mark">{{ __('frontend.home.headline_2') }}</span>
            </h1>
            <p class="hm-hero__lead">{{ __('frontend.home.intro') }}</p>

            <div class="hm-hero__acts">
                <a href="{{ route('product-lists') }}" class="btn hm-go">
                    <span>{{ __('frontend.home.browse') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('points.topup') }}" class="btn btn--ghost">
                    <i class="fas fa-wallet" aria-hidden="true"></i>
                    {{ __('frontend.home.buy') }}
                </a>
            </div>
        </div>

        <div class="hm-hero__art">
            <figure class="hm-frame hm-frame--video">
                <video class="hm-frame__video" autoplay muted loop playsinline preload="metadata" poster="{{ $hoImg('home-video.webp') }}" aria-hidden="true" data-hero-video>
                    <source src="{{ $hoImg('home-video.mp4') }}" type="video/mp4">
                </video>
                <button type="button" class="hm-hero__toggle" aria-pressed="false" data-hero-toggle data-pause="{{ __('frontend.home.video_pause') }}" data-play="{{ __('frontend.home.video_play') }}" aria-label="{{ __('frontend.home.video_pause') }}">
                    <i class="fas fa-pause" aria-hidden="true"></i>
                </button>
            </figure>
            <figure class="hm-frame hm-frame--wide" aria-hidden="true">
                <img src="{{ $hoImg('home-4.webp') }}" alt="" width="1400" height="935" fetchpriority="high" decoding="async">
            </figure>
            <figure class="hm-frame hm-frame--tall" aria-hidden="true">
                <img src="{{ $hoImg('home-5.webp') }}" alt="" width="900" height="1350" decoding="async">
            </figure>

            <span class="hm-chip hm-chip--writing" aria-hidden="true"><i class="fas fa-pen-nib"></i> {{ __('frontend.home.chip_writing') }}</span>
            <span class="hm-chip hm-chip--language" aria-hidden="true"><i class="fas fa-comments"></i> {{ __('frontend.home.chip_language') }}</span>
            <span class="hm-lvls" aria-hidden="true">
                <span class="hm-lvls__bars"><span></span><span></span><span></span><span></span></span>
                <span>{{ __('frontend.home.chip_levels') }}</span>
            </span>
        </div>
    </div>
</section>

@if($hoCourses->count())
    <section class="hm-pick" aria-labelledby="hmPickTitle" data-rail>
        <div class="hm-head" data-rise>
            <div>
                <span class="hm-head__tag">{{ __('frontend.home.feat_tag') }}</span>
                <h2 id="hmPickTitle" class="hm-head__title">{{ __('frontend.home.feat_title') }}</h2>
            </div>
            <div class="hm-rail__nav">
                <button type="button" class="hm-rail__arrow" aria-label="{{ __('frontend.home.pick_prev') }}" data-rail-prev disabled><i class="fas fa-arrow-left" aria-hidden="true"></i></button>
                <button type="button" class="hm-rail__arrow" aria-label="{{ __('frontend.home.pick_next') }}" data-rail-next><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                <a href="{{ route('product-lists') }}" class="hm-rail__all">
                    {{ __('frontend.home.feat_all') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <ul class="hm-rail" data-rail-track>
            @foreach($hoCourses as $course)
                @php
                    $pimg = explode(',', $course->photo)[0];
                    $lvCount = $course->levels ? $course->levels->count() : 0;
                    $minPoints = $lvCount ? $course->levels->min('price_in_points') : 0;
                    $catTitle = optional($course->cat_info)->title;
                    $tone = $catTitle && str_contains(mb_strtolower($catTitle), 'lang') ? 'language' : 'writing';
                @endphp
                <li class="hm-card hm-card--{{ $tone }}" style="--i: {{ $loop->index % 4 }}">
                    <a href="{{ route('product-detail', $course->slug) }}" class="hm-card__link" draggable="false">
                        <span class="hm-card__media">
                            <img src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="896" loading="{{ $loop->index < 4 ? 'eager' : 'lazy' }}" decoding="async" draggable="false">
                            @if($catTitle)
                                <span class="hm-card__cat">{{ $catTitle }}</span>
                            @endif
                            <span class="hm-card__num" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </span>
                        <span class="hm-card__body">
                            <span class="hm-card__title">{{ $course->title }}</span>
                            @if($lvCount)
                                <span class="hm-card__lv">
                                    <span class="mat__meter" aria-hidden="true">
                                        @for($b = 1; $b <= min($lvCount, 6); $b++)
                                            <span style="--b: {{ $b }}"></span>
                                        @endfor
                                    </span>
                                    {{ trans_choice('frontend.home.levels', $lvCount, ['count' => $lvCount]) }}
                                </span>
                            @endif
                            <span class="hm-card__foot">
                                @if($minPoints)
                                    <span class="hm-card__price">
                                        <small>{{ __('frontend.home.from') }}</small>
                                        <strong>{{ number_format($minPoints) }}</strong>
                                        <em>{{ __('frontend.home.unit') }}</em>
                                    </span>
                                @endif
                                <span class="hm-card__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                            </span>
                        </span>
                        <span class="vh">{{ __('frontend.home.pick_open') }}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="hm-rail__bar" aria-hidden="true"><span data-rail-bar></span></div>
    </section>
@endif

<section class="hm-story" aria-labelledby="hmStoryTitle">
    <div class="hm-story__in">
        <div class="hm-mosaic" aria-hidden="true">
            <figure class="hm-mosaic__shot hm-mosaic__shot--a" data-rise>
                <img src="{{ $hoImg('home-1.webp') }}" alt="" width="1400" height="1154" loading="lazy" decoding="async">
            </figure>
            <figure class="hm-mosaic__shot hm-mosaic__shot--b" data-rise style="--i: 1">
                <img src="{{ $hoImg('home-3.webp') }}" alt="" width="900" height="1350" loading="lazy" decoding="async">
            </figure>
            <figure class="hm-mosaic__shot hm-mosaic__shot--c" data-rise style="--i: 2">
                <img src="{{ $hoImg('home-2.webp') }}" alt="" width="1400" height="934" loading="lazy" decoding="async">
            </figure>
            <span class="hm-mosaic__tile hm-mosaic__tile--writing"><i class="fas fa-feather-alt"></i></span>
            <span class="hm-mosaic__tile hm-mosaic__tile--language"><i class="fas fa-headset"></i></span>
        </div>

        <div class="hm-story__copy" data-rise>
            <span class="hm-head__tag">{{ __('frontend.home.story_tag') }}</span>
            <h2 id="hmStoryTitle" class="hm-head__title">{{ __('frontend.home.story_title') }}</h2>
            <p class="hm-head__text">{{ __('frontend.home.story_text') }}</p>
            <ul class="hm-story__list">
                <li style="--i: 0"><span class="hm-story__icon" aria-hidden="true"><i class="fas fa-align-left"></i></span> {{ __('frontend.home.story1') }}</li>
                <li style="--i: 1"><span class="hm-story__icon hm-story__icon--alt" aria-hidden="true"><i class="fas fa-layer-group"></i></span> {{ __('frontend.home.story2') }}</li>
                <li style="--i: 2"><span class="hm-story__icon" aria-hidden="true"><i class="fas fa-lock-open"></i></span> {{ __('frontend.home.story3') }}</li>
            </ul>
            <a href="{{ route('product-lists') }}" class="btn hm-go">
                <span>{{ __('frontend.home.feat_all') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<section class="hm-how" aria-labelledby="hmHowTitle">
    <div class="hm-head" data-rise>
        <div>
            <span class="hm-head__tag">{{ __('frontend.home.flow_tag') }}</span>
            <h2 id="hmHowTitle" class="hm-head__title">{{ __('frontend.home.flow_title') }}</h2>
            <p class="hm-head__text">{{ __('frontend.home.flow_text') }}</p>
        </div>
    </div>

    <div class="hm-how__grid">
        <ol class="hm-chain">
            @foreach($hoSteps as $s)
                <li class="hm-step" style="--i: {{ $loop->index }}" data-rise>
                    <span class="hm-step__icon" aria-hidden="true"><i class="fas {{ $s['i'] }}"></i></span>
                    <span class="hm-step__num num" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="hm-step__title">{{ __('frontend.home.' . $s['t']) }}</h3>
                    <p class="hm-step__text">{{ __('frontend.home.' . $s['d']) }}</p>
                </li>
            @endforeach
        </ol>

        <aside class="hm-why" aria-labelledby="hmWhyTitle" data-rise>
            <span class="hm-head__tag">{{ __('frontend.home.perk_tag') }}</span>
            <h3 id="hmWhyTitle" class="hm-why__title">{{ __('frontend.home.perk_title') }}</h3>
            <ul class="hm-why__list">
                @foreach($hoWhy as $w)
                    <li>
                        <span class="hm-why__icon" aria-hidden="true"><i class="fas {{ $w['i'] }}"></i></span>
                        <span>
                            <strong>{{ __('frontend.home.' . $w['t']) }}</strong>
                            <span>{{ __('frontend.home.' . $w['d']) }}</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</section>

<section class="hm-credits" aria-labelledby="hmCreditsTitle">
    <div class="hm-credits__box" data-rise>
        <div class="hm-credits__copy">
            <span class="hm-head__tag">{{ __('frontend.home.cred_tag') }}</span>
            <h2 id="hmCreditsTitle" class="hm-head__title">{{ __('frontend.home.cred_title') }}</h2>
            <p class="hm-head__text">{{ __('frontend.home.cred_text') }}</p>
            <a href="{{ route('points.topup') }}" class="btn hm-go">
                <i class="fas fa-calculator" aria-hidden="true"></i>
                {{ __('frontend.home.cred_go') }}
            </a>
        </div>

        <ul class="hm-passes" aria-label="{{ __('frontend.home.cred_chart') }}">
            @foreach($hoTiers as [$tier, $range, $mult])
                <li class="hm-pass {{ $loop->last ? 'is-top' : '' }}" style="--i: {{ $loop->index }}" data-rise>
                    <span class="hm-pass__head">
                        <span class="hm-pass__icon" aria-hidden="true"><i class="fas {{ $hoTierIcons[$loop->index] }}"></i></span>
                        <span class="hm-pass__name">{{ __('frontend.topup.' . $tier) }}</span>
                        @if($loop->last)
                            <span class="hm-pass__best">{{ __('frontend.topup.tier_best') }}</span>
                        @endif
                    </span>
                    <strong class="hm-pass__mult">{{ $mult }}</strong>
                    <span class="hm-pass__cut" aria-hidden="true"></span>
                    <span class="hm-pass__foot">
                        <span class="hm-pass__range">{!! $range !!}</span>
                        <span class="hm-pass__meter" aria-hidden="true">
                            @for($m = 0; $m < 4; $m++)
                                <span class="{{ $m <= $loop->index ? 'is-on' : '' }}"></span>
                            @endfor
                        </span>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="hm-end" data-rise>
        <div>
            <span class="hm-head__tag">{{ __('frontend.home.close_tag') }}</span>
            <h2 class="hm-end__title">{{ __('frontend.home.close_title') }}</h2>
            <p class="hm-end__text">{{ __('frontend.home.close_text') }}</p>
        </div>
        <div class="hm-end__acts">
            <a href="{{ route('product-lists') }}" class="btn hm-go">
                <span>{{ __('frontend.home.browse') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
            @guest
                <a href="{{ route('register.form') }}" class="btn btn--ghost">{{ __('frontend.home.join') }}</a>
            @else
                <a href="{{ route('points.topup') }}" class="btn btn--ghost">{{ __('frontend.home.buy') }}</a>
            @endguest
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var risers = document.querySelectorAll('[data-rise]');
    if ('IntersectionObserver' in window && !calm) {
        var watch = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    watch.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        risers.forEach(function (el) { el.classList.add('is-wait'); watch.observe(el); });
    }

    var heroVideo = document.querySelector('[data-hero-video]');
    var heroToggle = document.querySelector('[data-hero-toggle]');
    if (heroVideo && heroToggle) {
        var setPaused = function (paused) {
            if (paused) { heroVideo.pause(); } else { heroVideo.play().catch(function () {}); }
            heroToggle.setAttribute('aria-pressed', paused ? 'true' : 'false');
            heroToggle.setAttribute('aria-label', paused ? heroToggle.dataset.play : heroToggle.dataset.pause);
            heroToggle.querySelector('i').className = paused ? 'fas fa-play' : 'fas fa-pause';
        };
        if (calm) { setPaused(true); }
        heroToggle.addEventListener('click', function () { setPaused(!heroVideo.paused); });
    }

    var rail = document.querySelector('[data-rail]');
    if (rail) {
        var track = rail.querySelector('[data-rail-track]');
        var railPrev = rail.querySelector('[data-rail-prev]');
        var railNext = rail.querySelector('[data-rail-next]');
        var railBar = rail.querySelector('[data-rail-bar]');

        var stepSize = function () {
            var card = track.querySelector('.hm-card');
            if (!card) { return track.clientWidth; }
            var gap = parseFloat(getComputedStyle(track).columnGap) || 0;
            return card.getBoundingClientRect().width + gap;
        };

        var sync = function () {
            var max = track.scrollWidth - track.clientWidth;
            var at = max > 0 ? track.scrollLeft / max : 1;
            var seen = track.scrollWidth > 0 ? track.clientWidth / track.scrollWidth : 1;
            if (railBar) {
                railBar.style.width = Math.max(seen * 100, 8) + '%';
                railBar.style.transform = 'translateX(' + (at * (100 / Math.max(seen, 0.08) - 100)) + '%)';
            }
            if (railPrev) { railPrev.disabled = track.scrollLeft <= 2; }
            if (railNext) { railNext.disabled = track.scrollLeft >= max - 2; }
        };

        if (railPrev) { railPrev.addEventListener('click', function () { track.scrollBy({ left: -stepSize(), behavior: calm ? 'auto' : 'smooth' }); }); }
        if (railNext) { railNext.addEventListener('click', function () { track.scrollBy({ left: stepSize(), behavior: calm ? 'auto' : 'smooth' }); }); }

        track.addEventListener('scroll', sync, { passive: true });
        window.addEventListener('resize', sync);

        var dragX = null;
        var dragLeft = 0;
        var moved = false;
        track.addEventListener('pointerdown', function (event) {
            if (event.pointerType !== 'mouse') { return; }
            dragX = event.clientX;
            dragLeft = track.scrollLeft;
            moved = false;
            track.classList.add('is-grab');
        });
        window.addEventListener('pointermove', function (event) {
            if (dragX === null) { return; }
            var delta = event.clientX - dragX;
            if (Math.abs(delta) > 4) { moved = true; }
            track.scrollLeft = dragLeft - delta;
        });
        window.addEventListener('pointerup', function () {
            if (dragX === null) { return; }
            dragX = null;
            track.classList.remove('is-grab');
        });
        track.addEventListener('click', function (event) {
            if (moved) { event.preventDefault(); moved = false; }
        }, true);

        track.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowRight') { track.scrollBy({ left: stepSize(), behavior: 'smooth' }); }
            if (event.key === 'ArrowLeft') { track.scrollBy({ left: -stepSize(), behavior: 'smooth' }); }
        });

        sync();
    }
}());
</script>
@endpush
