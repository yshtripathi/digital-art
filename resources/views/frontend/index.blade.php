@extends('frontend.layouts.main')
@section('description', __('frontend.home.summary'))

@section('main-content')
@php
    $hoCategories = isset($category_lists) ? $category_lists : collect();

    $hoCourses = collect($product_lists ?? [])->filter(fn ($c) => !empty($c->photo))->values();
    $hoCourses = $hoCourses->where('is_featured', 1)
        ->concat($hoCourses->where('is_featured', '!=', 1))
        ->take(5)
        ->values();

    $cur = session('currency');
    if ($cur == 'JPY') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => '&yen;1 - &yen;79,999',        'f' => false],
            ['n' => __('frontend.topup.tier_premium'), 'i' => 'fa-star',    'big' => 'x2', 'r' => '&yen;80,000 - &yen;159,999',  'f' => false],
            ['n' => __('frontend.topup.tier_elite'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => '&yen;160,000 - &yen;239,999', 'f' => false],
            ['n' => __('frontend.topup.tier_vip'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => '&yen;240,000+',               'f' => true],
        ];
        $rateNote = __('frontend.topup.rate_yen');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => 'HK$1 - HK$3,999',      'f' => false],
            ['n' => __('frontend.topup.tier_premium'), 'i' => 'fa-star',    'big' => 'x2', 'r' => 'HK$4,000 - HK$7,999',  'f' => false],
            ['n' => __('frontend.topup.tier_elite'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => 'HK$8,000 - HK$11,999', 'f' => false],
            ['n' => __('frontend.topup.tier_vip'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => 'HK$12,000+',           'f' => true],
        ];
        $rateNote = __('frontend.topup.rate_hk');
    } else {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-feather', 'big' => 'x1',   'r' => '$1 - $499',       'f' => false],
            ['n' => __('frontend.topup.tier_premium'), 'i' => 'fa-star',    'big' => 'x2', 'r' => '$500 - $999',     'f' => false],
            ['n' => __('frontend.topup.tier_elite'), 'i' => 'fa-gem',     'big' => 'x2.5',   'r' => '$1,000 - $1,499', 'f' => false],
            ['n' => __('frontend.topup.tier_vip'), 'i' => 'fa-crown',   'big' => 'x3', 'r' => '$1,500+',         'f' => true],
        ];
        $rateNote = __('frontend.topup.rate_dollar');
    }

    $hoSteps = [
        ['t' => 'flow1_title', 'd' => 'flow1_text', 'i' => 'fa-layer-group'],
        ['t' => 'flow2_title', 'd' => 'flow2_text', 'i' => 'fa-book-open'],
        ['t' => 'flow3_title', 'd' => 'flow3_text', 'i' => 'fa-signal'],
        ['t' => 'flow4_title', 'd' => 'flow4_text', 'i' => 'fa-lock-open'],
    ];
@endphp

@php
    $hoMaterials = \App\Models\Product::where('status', 'active')->count();
    $hoFeature = $hoCourses->first();
    $hoMore = $hoCourses->slice(1, 4);
@endphp

<section class="hm">
    <div class="hm__wrap hm-bento">

        <div class="hm-tile hm-tile--hero band--coffee">
            <video class="hm-video" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/images/home-pattern.webp') }}" aria-hidden="true" data-hm-video>
                <source src="{{ asset('assets/videos/home-pattern.mp4') }}" type="video/mp4">
            </video>
            <span class="hm-video__veil" aria-hidden="true"></span>
            <div class="hm-hero__body">
                <p class="hm-badge">{{ __('frontend.home.hero_tag') }}</p>
                <h1 class="hm-title">{{ __('frontend.home.hero_head') }}</h1>
                <p class="hm-lead">{{ __('frontend.home.hero_body') }}</p>
                <div class="hm-actions">
                    <a href="{{ route('product-lists') }}" class="btn btn--primary">
                        <span>{{ __('frontend.home.cta_explore') }}</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('points.topup') }}" class="btn btn--ghost">
                        <i class="fas fa-bolt" aria-hidden="true"></i>
                        <span>{{ __('frontend.home.cta_credits') }}</span>
                    </a>
                </div>
            </div>
            <button type="button" class="hm-video__toggle" data-hm-toggle aria-label="{{ __('frontend.home.motion_pause') }}">
                <i class="fas fa-pause" aria-hidden="true"></i>
            </button>
        </div>

        <figure class="hm-tile hm-tile--photo hm-tile--look">
            <img src="{{ asset('assets/images/home-look.webp') }}" width="1067" height="1600" alt="{{ __('frontend.home.alt_hero') }}" fetchpriority="high" decoding="async">
            <figcaption class="hm-cap">{{ __('frontend.home.cap_levels') }}</figcaption>
        </figure>

        <a href="{{ route('product-lists') }}" class="hm-tile hm-tile--stat band--coffee">
            <span class="hm-stat__num">{{ number_format($hoMaterials) }}</span>
            <span class="hm-stat__label">{{ trans_choice('frontend.home.stat_materials', $hoMaterials) }}</span>
            <i class="fas fa-arrow-right hm-stat__go" aria-hidden="true"></i>
        </a>

        <a href="{{ route('product-lists') }}" class="hm-tile hm-tile--stat hm-tile--sand">
            <span class="hm-stat__num">{{ number_format($hoCategories->count()) }}</span>
            <span class="hm-stat__label">{{ trans_choice('frontend.home.stat_topics', $hoCategories->count()) }}</span>
            <i class="fas fa-arrow-right hm-stat__go" aria-hidden="true"></i>
        </a>

        <figure class="hm-tile hm-tile--photo hm-tile--walk">
            <img src="{{ asset('assets/images/home-walk.webp') }}" width="1067" height="1600" alt="{{ __('frontend.home.alt_street') }}" decoding="async">
            <figcaption class="hm-cap">{{ __('frontend.home.cap_pace') }}</figcaption>
        </figure>

    </div>
</section>

@if($hoCategories->count())
    <section class="hm-ticker band--indigo" aria-label="{{ __('frontend.home.ticker_label') }}">
        <div class="hm-ticker__track">
            @foreach([false, true] as $copy)
                <ul class="hm-ticker__list" @if($copy) aria-hidden="true" @endif>
                    @foreach($hoCategories as $cat)
                        <li>
                            <a href="{{ route('product-lists', $cat->slug) }}" class="hm-ticker__pill" @if($copy) tabindex="-1" @endif>
                                <span class="rosette" aria-hidden="true"></span>
                                {{ $cat->title }}
                                <span class="hm-ticker__count">{{ $cat->products_count ?? 0 }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </section>
@endif

@if($hoFeature)
    <section class="hm-sec hm-sec--band band--indigo" aria-labelledby="hmFeaturedTitle">
        <div class="hm__wrap">
            <header class="hm-head">
                <div>
                    <h2 id="hmFeaturedTitle" class="hm-head__title">{{ __('frontend.home.picks_title') }}</h2>
                    <p class="hm-head__desc">{{ __('frontend.home.picks_text') }}</p>
                </div>
                <a href="{{ route('product-lists') }}" class="btn btn--ghost">
                    <span>{{ __('frontend.home.picks_all') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </header>

            <div class="hm-mag">
                @foreach(collect([$hoFeature])->concat($hoMore) as $course)
                    @php
                        $img = explode(',', $course->photo)[0];
                        $lvCount = $course->levels ? $course->levels->count() : 0;
                        $minPts = $lvCount ? $course->levels->min('price_in_points') : null;
                        $catName = optional($course->cat_info)->title;
                        $isLead = $loop->first;
                    @endphp
                    <a href="{{ route('product-detail', $course->slug) }}" class="hm-card {{ $isLead ? 'hm-card--lead' : '' }}">
                        <span class="hm-card__media">
                            <img src="{{ asset(ltrim($img, '/')) }}" alt="" loading="lazy" decoding="async">
                            @if($catName)
                                <span class="hm-card__cat">{{ $catName }}</span>
                            @endif
                        </span>
                        <span class="hm-card__body">
                            @if($lvCount)
                                <span class="hm-card__levels">{{ trans_choice('frontend.catalog.level_count', $lvCount, ['count' => $lvCount]) }}</span>
                            @endif
                            <span class="hm-card__title">{{ $course->title }}</span>
                            @if($isLead && $course->summary)
                                <span class="hm-card__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 170) }}</span>
                            @endif
                            <span class="hm-card__foot">
                                @if($lvCount)
                                    <span class="hm-card__price">
                                        <small>{{ __('frontend.home.price_from') }}</small>
                                        <strong><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($minPts) }}</strong>
                                        <small>{{ __('frontend.home.price_unit') }}</small>
                                    </span>
                                @else
                                    <span class="hm-card__price"><small>{{ __('frontend.catalog.levels_soon') }}</small></span>
                                @endif
                                <span class="hm-card__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section class="hm-sec" aria-labelledby="hmDuoTitle">
    <div class="hm__wrap">
        <header class="hm-head">
            <div>
                <p class="hm-badge hm-badge--dark">{{ __('frontend.home.fit_tag') }}</p>
                <h2 id="hmDuoTitle" class="hm-head__title">{{ __('frontend.home.fit_title') }}</h2>
            </div>
        </header>

        <div class="hm-duo">
            <figure class="hm-duo__photo">
                <img src="{{ asset('assets/images/home-credits.webp') }}" width="1063" height="1600" alt="{{ __('frontend.home.alt_coins') }}" loading="lazy" decoding="async">
            </figure>

            <div class="hm-duo__cards">
                <article class="hm-duo__card band--coffee">
                    <span class="hm-duo__icon" aria-hidden="true"><i class="fas fa-bolt"></i></span>
                    <h3 class="hm-duo__title">{{ __('frontend.home.fit1_title') }}</h3>
                    <p class="hm-duo__text">{{ __('frontend.home.fit1_text') }}</p>
                    <a href="{{ route('points.topup') }}" class="btn btn--primary">
                        <span>{{ __('frontend.home.cta_credits') }}</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </article>

                <article class="hm-duo__card">
                    <span class="hm-duo__icon" aria-hidden="true"><i class="fas fa-laptop"></i></span>
                    <h3 class="hm-duo__title">{{ __('frontend.home.fit2_title') }}</h3>
                    <p class="hm-duo__text">{{ __('frontend.home.fit2_text') }}</p>
                    <a href="{{ route('product-lists') }}" class="btn btn--primary">
                        <span>{{ __('frontend.home.cta_explore') }}</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </article>
            </div>

            <figure class="hm-duo__photo hm-duo__photo--low">
                <img src="{{ asset('assets/images/home-anywhere.webp') }}" width="1067" height="1600" alt="{{ __('frontend.home.alt_pair') }}" loading="lazy" decoding="async">
            </figure>
        </div>
    </div>
</section>

<section class="hm-sec hm-sec--last" aria-labelledby="hmStepsTitle">
    <div class="hm__wrap hm-trio">

        <div class="hm-tile hm-tile--steps">
            <p class="hm-badge hm-badge--dark">{{ __('frontend.home.flow_tag') }}</p>
            <h2 id="hmStepsTitle" class="hm-head__title">{{ __('frontend.home.flow_title') }}</h2>
            <ol class="hm-path">
                @foreach($hoSteps as $i => $s)
                    <li class="hm-path__step">
                        <span class="hm-path__num" aria-hidden="true">{{ sprintf('%02d', $i + 1) }}</span>
                        <span class="hm-path__text">
                            <span class="hm-path__title">{{ __('frontend.home.' . $s['t']) }}</span>
                            <span class="hm-path__desc">{{ __('frontend.home.' . $s['d']) }}</span>
                        </span>
                    </li>
                @endforeach
            </ol>
        </div>

        <figure class="hm-tile hm-tile--photo hm-tile--pause">
            <img src="{{ asset('assets/images/home-pause.webp') }}" width="1067" height="1600" alt="{{ __('frontend.home.alt_rest') }}" loading="lazy" decoding="async">
            <figcaption class="hm-cap">{{ __('frontend.home.cap_rest') }}</figcaption>
        </figure>

        <div class="hm-tile hm-tile--credits band--indigo">
            <div class="hm-credits">
                <p class="hm-badge">{{ $rateNote }}</p>
                <h2 class="hm-credits__title">{{ __('frontend.topup.tiers_heading') }}</h2>
                <ul class="hm-tiers">
                    @foreach($tiers as $t)
                        <li class="hm-tier {{ $t['f'] ? 'hm-tier--best' : '' }}">
                            <span class="hm-tier__name">{{ $t['n'] }}</span>
                            <span class="hm-tier__range">{!! $t['r'] !!}</span>
                            <span class="hm-tier__mult">{{ $t['big'] }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('points.topup') }}" class="btn btn--primary btn--block">
                    <i class="fas fa-bolt" aria-hidden="true"></i>
                    <span>{{ __('frontend.home.cta_credits') }}</span>
                </a>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var videos = Array.prototype.slice.call(document.querySelectorAll('[data-hm-video]'));
    var toggle = document.querySelector('[data-hm-toggle]');

    if (!videos.length || !toggle) {
        return;
    }

    var icon = toggle.querySelector('i');
    var labels = { play: @json(__('frontend.home.motion_play')), pause: @json(__('frontend.home.motion_pause')) };
    var paused = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function apply() {
        videos.forEach(function (video) {
            if (paused) {
                video.removeAttribute('autoplay');
                video.pause();
            } else {
                var run = video.play();
                if (run && run.catch) { run.catch(function () {}); }
            }
        });
        icon.className = paused ? 'fas fa-play' : 'fas fa-pause';
        toggle.setAttribute('aria-label', paused ? labels.play : labels.pause);
    }

    toggle.addEventListener('click', function () {
        paused = !paused;
        apply();
    });

    if (paused) { apply(); }
}());
</script>
@endpush
