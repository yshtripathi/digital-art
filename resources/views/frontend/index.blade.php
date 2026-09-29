@extends('frontend.layouts.main')
@section('description', __('frontend.home.description'))

@section('main-content')
@php
    $hoMedia = function ($file) {
        $path = public_path('assets/images/' . $file);
        return file_exists($path) ? asset('assets/images/' . $file) : null;
    };

    $hoCourses = collect($product_lists ?? [])->filter(fn ($c) => !empty($c->photo))->values();
    $hoCourses = $hoCourses->where('is_featured', 1)
        ->concat($hoCourses->where('is_featured', '!=', 1))
        ->take(12)
        ->values();
    $hoCats = collect($category_lists ?? [])->values();

    $hoCur = session('currency');
    if ($hoCur == 'JPY') {
        $hoTiers = [['tier_standard', '&yen;1 – &yen;79,999', 'x1'], ['tier_premium', '&yen;80,000 – &yen;159,999', 'x2'], ['tier_elite', '&yen;160,000 – &yen;239,999', 'x2.5'], ['tier_vip', '&yen;240,000+', 'x3']];
    } elseif ($hoCur == 'HKD') {
        $hoTiers = [['tier_standard', 'HK$1 – HK$3,999', 'x1'], ['tier_premium', 'HK$4,000 – HK$7,999', 'x2'], ['tier_elite', 'HK$8,000 – HK$11,999', 'x2.5'], ['tier_vip', 'HK$12,000+', 'x3']];
    } else {
        $hoTiers = [['tier_standard', '$1 – $499', 'x1'], ['tier_premium', '$500 – $999', 'x2'], ['tier_elite', '$1,000 – $1,499', 'x2.5'], ['tier_vip', '$1,500+', 'x3']];
    }

    $hoSteps = [
        ['t' => 'step_one', 'd' => 'step_one_text', 'i' => 'fa-compass'],
        ['t' => 'step_two', 'd' => 'step_two_text', 'i' => 'fa-balance-scale'],
        ['t' => 'step_three', 'd' => 'step_three_text', 'i' => 'fa-lock-open'],
        ['t' => 'step_four', 'd' => 'step_four_text', 'i' => 'fa-book-reader'],
    ];

    $heroVideo = $hoMedia('home-hero.mp4');
    $heroStill = $hoMedia('home-hero.webp');
    $studyImg  = $hoMedia('home-study.webp');
    $closeVid  = $hoMedia('home-close.mp4');
    $closeImg  = $hoMedia('home-close.webp');
@endphp

<section class="lead" aria-labelledby="hmTitle">
    <div class="lead__wrap">
        <div class="lead__copy">
            <p class="lead__tag"><span class="lead__dot" aria-hidden="true"></span>{{ __('frontend.home.eyebrow') }}</p>
            <h1 id="hmTitle" class="lead__title">
                <span>{{ __('frontend.home.title') }}</span>
                <span class="lead__accent">{{ __('frontend.home.title_accent') }}</span>
            </h1>
            <p class="lead__text">{{ __('frontend.home.lead') }}</p>

            <div class="lead__acts">
                <a href="{{ route('product-lists') }}" class="btn lead__go">
                    <span>{{ __('frontend.home.explore') }}</span>
                    <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('points.topup') }}" class="btn btn--outline">
                    <i class="fas fa-coins" aria-hidden="true"></i>
                    {{ __('frontend.home.credits_btn') }}
                </a>
            </div>
        </div>

        <div class="lead__media">
            <figure class="frame frame--hero {{ ($heroVideo || $heroStill) ? '' : 'is-empty' }}">
                @if($heroVideo)
                    <video src="{{ $heroVideo }}" @if($heroStill) poster="{{ $heroStill }}" @endif autoplay muted loop playsinline preload="metadata" aria-hidden="true" data-hero-video></video>
                    <button type="button" class="lead__toggle" aria-pressed="false" data-hero-toggle data-play="{{ __('frontend.home.play') }}" data-pause="{{ __('frontend.home.pause') }}" aria-label="{{ __('frontend.home.pause') }}">
                        <i class="fas fa-pause" aria-hidden="true"></i>
                    </button>
                @elseif($heroStill)
                    <img src="{{ $heroStill }}" alt="" width="1000" height="1250" fetchpriority="high" decoding="async">
                @else
                    <span class="frame__hint frame__hint--play" aria-hidden="true"><i class="fas fa-play"></i></span>
                @endif
            </figure>

            @if($hoCats->isNotEmpty())
                <ul class="lead__chips" aria-hidden="true">
                    @foreach($hoCats->take(3) as $cat)
                        <li class="lead__chip cat-n{{ $loop->index % 5 }}" style="--i: {{ $loop->index }}"><span class="lead__chip-mark"></span>{{ $cat->title }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>

@if($hoCats->isNotEmpty())
    <div class="ribbon" aria-hidden="true">
        <div class="ribbon__track">
            @for($loopTwice = 0; $loopTwice < 2; $loopTwice++)
                <ul class="ribbon__list">
                    @foreach($hoCats as $cat)
                        <li class="cat-n{{ $loop->index % 5 }}"><span class="ribbon__mark"></span>{{ $cat->title }}</li>
                        <li class="ribbon__star"><i class="fas fa-asterisk"></i></li>
                    @endforeach
                </ul>
            @endfor
        </div>
    </div>

@endif

@if($hoCourses->count())
    <section class="reel" aria-labelledby="hmFeatTitle" data-reel>
        <div class="reel__wrap">
            <header class="reel__head">
                <div>
                    <p class="reel__tag">{{ __('frontend.home.picks_label') }}</p>
                    <h2 id="hmFeatTitle" class="reel__title">{{ __('frontend.home.picks_title') }}</h2>
                </div>
                <div class="reel__nav">
                    <button type="button" class="reel__btn" data-reel-prev aria-label="{{ __('frontend.home.prev') }}"><i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i></button>
                    <button type="button" class="reel__btn" data-reel-next aria-label="{{ __('frontend.home.next') }}"><i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i></button>
                    <a href="{{ route('product-lists') }}" class="reel__all">{{ __('frontend.home.all') }}</a>
                </div>
            </header>

            <ul class="reel__track" data-reel-track>
                @foreach($hoCourses as $course)
                    @php
                        $pimg = explode(',', $course->photo)[0];
                        $lvCount = $course->levels ? $course->levels->count() : 0;
                        $minPoints = $lvCount ? $course->levels->min('price_in_points') : 0;
                    @endphp
                    <li class="reel__item">
                        <a href="{{ route('product-detail', $course->slug) }}" class="reel__card">
                            <span class="reel__media">
                                <img src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="750" loading="lazy" decoding="async">
                                <span class="reel__no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </span>
                            <span class="reel__body">
                                <span class="reel__name">{{ $course->title }}</span>
                                <span class="reel__meta">
                                    @if($lvCount)
                                        <span>{{ trans_choice('frontend.home.level_count', $lvCount, ['count' => $lvCount]) }}</span>
                                    @endif
                                    @if($minPoints)
                                        <span class="reel__price">{{ __('frontend.home.starts_at') }} <strong>{{ number_format($minPoints) }}</strong> {{ __('frontend.home.credits') }}</span>
                                    @endif
                                </span>
                            </span>
                            <span class="vh">{{ __('frontend.home.open') }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

<section class="scene" aria-labelledby="hmStoryTitle">
    <div class="scene__wrap">
        <figure class="frame scene__media {{ $studyImg ? '' : 'is-empty' }}" aria-hidden="true">
            @if($studyImg)
                <img src="{{ $studyImg }}" alt="" width="2100" height="900" loading="lazy" decoding="async">
            @else
                <span class="frame__hint"><i class="far fa-image"></i></span>
            @endif
        </figure>

        <div class="scene__card">
            <p class="scene__tag">{{ __('frontend.home.study_label') }}</p>
            <h2 id="hmStoryTitle" class="scene__title">{{ __('frontend.home.study_title') }}</h2>
            <p class="scene__text">{{ __('frontend.home.study_text') }}</p>
            <ul class="scene__list">
                <li><i class="fas fa-check" aria-hidden="true"></i>{{ __('frontend.home.study_one') }}</li>
                <li><i class="fas fa-check" aria-hidden="true"></i>{{ __('frontend.home.study_two') }}</li>
                <li><i class="fas fa-check" aria-hidden="true"></i>{{ __('frontend.home.study_three') }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="fold" aria-labelledby="hmFlowTitle" data-fold>
    <div class="fold__wrap">
        <header class="fold__head">
            <p class="fold__tag">{{ __('frontend.home.steps_label') }}</p>
            <h2 id="hmFlowTitle" class="fold__title">{{ __('frontend.home.steps_title') }}</h2>
            <p class="fold__text">{{ __('frontend.home.steps_text') }}</p>
        </header>

        <ol class="fold__list">
            @foreach($hoSteps as $step)
                <li class="fold__item {{ $loop->first ? 'is-open' : '' }}" tabindex="0" data-fold-item>
                    <span class="fold__no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="fold__icon" aria-hidden="true"><i class="fas {{ $step['i'] }}"></i></span>
                    <span class="fold__body">
                        <span class="fold__name">{{ __('frontend.home.' . $step['t']) }}</span>
                        <span class="fold__desc">{{ __('frontend.home.' . $step['d']) }}</span>
                    </span>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="ladder2" aria-labelledby="hmCredTitle">
    <div class="ladder2__wrap">
        <div class="ladder2__copy">
            <p class="ladder2__tag">{{ __('frontend.home.credit_label') }}</p>
            <h2 id="hmCredTitle" class="ladder2__title">{{ __('frontend.home.credit_title') }}</h2>
            <p class="ladder2__text">{{ __('frontend.home.credit_text') }}</p>
            <a href="{{ route('points.topup') }}" class="btn">
                <i class="fas fa-calculator" aria-hidden="true"></i>
                {{ __('frontend.home.credit_btn') }}
            </a>
        </div>

        <ul class="tiles" aria-label="{{ __('frontend.home.credit_tiers') }}">
            @foreach($hoTiers as $tier)
                <li class="tiles__item {{ $loop->last ? 'tiles__item--top' : '' }}">
                    <span class="tiles__mult">{{ $tier[2] }}</span>
                    <span class="tiles__name">{{ __('frontend.topup.' . $tier[0]) }}</span>
                    <span class="tiles__range">{!! $tier[1] !!}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>

<section class="finale" aria-labelledby="hmCloseTitle">
    <figure class="frame finale__media {{ ($closeVid || $closeImg) ? '' : 'is-empty' }}" aria-hidden="true">
        @if($closeVid)
            <video src="{{ $closeVid }}" @if($closeImg) poster="{{ $closeImg }}" @endif autoplay muted loop playsinline preload="metadata" data-close-video></video>
        @elseif($closeImg)
            <img src="{{ $closeImg }}" alt="" width="2000" height="900" loading="lazy" decoding="async">
        @endif
    </figure>
    <div class="finale__body">
        <p class="finale__tag">{{ __('frontend.home.end_label') }}</p>
        <h2 id="hmCloseTitle" class="finale__title">{{ __('frontend.home.end_title') }}</h2>
        <p class="finale__text">{{ __('frontend.home.end_text') }}</p>
        <div class="finale__acts">
            <a href="{{ route('product-lists') }}" class="btn btn--light">
                <span>{{ __('frontend.home.explore') }}</span>
                <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
            </a>
            @guest
                <a href="{{ route('register.form') }}" class="btn btn--outline-light">{{ __('frontend.home.register') }}</a>
            @else
                <a href="{{ route('points.topup') }}" class="btn btn--outline-light">{{ __('frontend.home.credits_btn') }}</a>
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

    document.querySelectorAll('[data-hero-video], [data-close-video]').forEach(function (video) {
        if (calm) { video.removeAttribute('autoplay'); video.pause(); }
    });

    var toggle = document.querySelector('[data-hero-toggle]');
    var hero = document.querySelector('[data-hero-video]');
    if (toggle && hero) {
        var sync = function () {
            var paused = hero.paused;
            toggle.setAttribute('aria-pressed', paused ? 'true' : 'false');
            toggle.setAttribute('aria-label', paused ? toggle.dataset.play : toggle.dataset.pause);
            toggle.querySelector('i').className = paused ? 'fas fa-play' : 'fas fa-pause';
        };
        toggle.addEventListener('click', function () {
            if (hero.paused) { hero.play(); } else { hero.pause(); }
        });
        hero.addEventListener('play', sync);
        hero.addEventListener('pause', sync);
        sync();
    }

    var reel = document.querySelector('[data-reel]');
    if (reel) {
        var track = reel.querySelector('[data-reel-track]');
        var prev = reel.querySelector('[data-reel-prev]');
        var next = reel.querySelector('[data-reel-next]');
        var step = function () {
            var item = track.querySelector('.reel__item');
            return item ? item.getBoundingClientRect().width + 20 : 300;
        };
        var edges = function () {
            prev.disabled = track.scrollLeft <= 4;
            next.disabled = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
        };
        prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: calm ? 'auto' : 'smooth' }); });
        next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: calm ? 'auto' : 'smooth' }); });
        track.addEventListener('scroll', edges, { passive: true });
        window.addEventListener('resize', edges);
        edges();
    }

    var items = document.querySelectorAll('[data-fold-item]');
    var openItem = function (item) {
        items.forEach(function (other) { other.classList.toggle('is-open', other === item); });
    };
    items.forEach(function (item) {
        item.addEventListener('mouseenter', function () { openItem(item); });
        item.addEventListener('focus', function () { openItem(item); });
        item.addEventListener('click', function () { openItem(item); });
    });
}());
</script>
@endpush
