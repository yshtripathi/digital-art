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
    $hoFeature = $hoCourses->first();
    $hoMore = $hoCourses->slice(1, 4);

    $hoMaterials = \App\Models\Product::where('status', 'active')->count();
    $hoLevels = \App\Models\ProductLevel::whereIn('course_id', \App\Models\Product::where('status', 'active')->pluck('id'))->count();

    $hoIcon = function ($title) {
        $t = mb_strtolower((string) $title);
        $map = [
            'social' => 'fa-hashtag', 'influenc' => 'fa-hashtag',
            'analytic' => 'fa-chart-line', 'tool' => 'fa-chart-line',
            'content' => 'fa-pen-nib', 'copy' => 'fa-pen-nib',
            'commerce' => 'fa-shopping-cart', 'selling' => 'fa-shopping-cart',
            'sales' => 'fa-handshake', 'negotia' => 'fa-handshake',
            'entrepreneur' => 'fa-rocket', 'growth' => 'fa-rocket',
            'brand' => 'fa-comments', 'communicat' => 'fa-comments',
            'customer' => 'fa-user-friends', 'retention' => 'fa-user-friends',
            'career' => 'fa-briefcase', 'freelanc' => 'fa-briefcase',
            'marketing' => 'fa-bullhorn',
        ];
        foreach ($map as $key => $icon) {
            if (str_contains($t, $key)) { return $icon; }
        }
        return 'fa-layer-group';
    };

    $heroVideo = file_exists(public_path('assets/videos/home-hero.mp4'));
    $heroPoster = file_exists(public_path('assets/images/home-hero.webp'));
    $whyPhoto = file_exists(public_path('assets/images/home-why.webp'));
    $skillsPhoto = file_exists(public_path('assets/images/home-skills.webp'));
    $startPhoto = file_exists(public_path('assets/images/home-start.webp'));
    $flowVideo = file_exists(public_path('assets/videos/home-flow.mp4'));
    $flowPoster = file_exists(public_path('assets/images/home-flow.webp'));

    $hoSteps = [
        ['t' => 'flow1_title', 'd' => 'flow1_text', 'i' => 'fa-compass'],
        ['t' => 'flow2_title', 'd' => 'flow2_text', 'i' => 'fa-signal'],
        ['t' => 'flow3_title', 'd' => 'flow3_text', 'i' => 'fa-lock-open'],
        ['t' => 'flow4_title', 'd' => 'flow4_text', 'i' => 'fa-graduation-cap'],
    ];
    $hoWhy = [
        ['t' => 'why1_title', 'd' => 'why1_text', 'i' => 'fa-eye'],
        ['t' => 'why2_title', 'd' => 'why2_text', 'i' => 'fa-coins'],
        ['t' => 'why3_title', 'd' => 'why3_text', 'i' => 'fa-clock'],
        ['t' => 'why4_title', 'd' => 'why4_text', 'i' => 'fa-briefcase'],
    ];
    $hoMult = [['x1', 33], ['x2', 67], ['x2.5', 83], ['x3', 100]];
@endphp

<section class="hp-hero">
    <div class="hp-hero__wrap">
        <div class="hp-hero__text">
            <p class="hp-hero__tag">{{ __('frontend.home.hero_tag') }}</p>
            <h1 class="hp-hero__title">{{ __('frontend.home.hero_head') }}</h1>
            <p class="hp-hero__lead">{{ __('frontend.home.hero_body') }}</p>
            <div class="hp-hero__cta">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <span>{{ __('frontend.home.cta_explore') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('points.topup') }}" class="btn btn--secondary">{{ __('frontend.home.cta_credits') }}</a>
            </div>
        </div>

        <div class="hp-hero__visual">
            @if($heroVideo)
                <figure class="hp-hero__frame">
                    <video class="hp-hero__video" autoplay muted loop playsinline preload="metadata" @if($heroPoster) poster="{{ asset('assets/images/home-hero.webp') }}" @endif aria-label="{{ __('frontend.home.hero_video') }}" data-hp-video>
                        <source src="{{ asset('assets/videos/home-hero.mp4') }}" type="video/mp4">
                    </video>
                    <button type="button" class="hp-hero__toggle" aria-label="{{ __('frontend.home.motion_pause') }}" data-pause="{{ __('frontend.home.motion_pause') }}" data-play="{{ __('frontend.home.motion_play') }}" data-hp-toggle>
                        <i class="fas fa-pause" aria-hidden="true"></i>
                    </button>
                </figure>
            @else
                <div class="hp-hero__frame hp-hero__frame--chart" aria-hidden="true">
                    <svg class="hp-chart" viewBox="0 0 480 320" focusable="false">
                        <path class="hp-chart__grid" d="M32 70 H456 M32 140 H456 M32 210 H456"/>
                        <path class="hp-chart__axis" d="M32 24 V280 H456"/>
                        <rect class="hp-chart__bar" x="64" y="210" width="56" height="70" rx="8"/>
                        <rect class="hp-chart__bar" x="156" y="165" width="56" height="115" rx="8"/>
                        <rect class="hp-chart__bar" x="248" y="118" width="56" height="162" rx="8"/>
                        <rect class="hp-chart__bar" x="340" y="68" width="56" height="212" rx="8"/>
                        <polyline class="hp-chart__trend" points="44,236 92,188 184,142 276,96 368,48 430,30"/>
                        <circle class="hp-chart__ring" cx="430" cy="30" r="12"/>
                        <circle class="hp-chart__goal" cx="430" cy="30" r="12"/>
                    </svg>
                </div>
            @endif

            <ul class="hp-hero__stats">
                <li class="hp-stat hp-stat--a">
                    <strong class="num">{{ number_format($hoMaterials) }}</strong>
                    <span>{{ __('frontend.home.stat_materials') }}</span>
                </li>
                <li class="hp-stat hp-stat--b">
                    <strong class="num">{{ number_format($hoCategories->count()) }}</strong>
                    <span>{{ __('frontend.home.stat_categories') }}</span>
                </li>
                <li class="hp-stat hp-stat--c">
                    <strong class="num">{{ number_format($hoLevels) }}</strong>
                    <span>{{ __('frontend.home.stat_levels') }}</span>
                </li>
            </ul>
        </div>
    </div>
</section>

@if($hoCategories->count())
    <section class="hp-sec hp-sec--white" aria-labelledby="hpCatsTitle">
        <div class="hp-sec__wrap">
            <header class="hp-head">
                <div>
                    <p class="eyebrow">{{ __('frontend.home.cats_tag') }}</p>
                    <h2 id="hpCatsTitle" class="hp-head__title">{{ __('frontend.home.cats_title') }}</h2>
                </div>
                <p class="hp-head__text">{{ __('frontend.home.cats_text') }}</p>
            </header>

            <ul class="hp-cats {{ $skillsPhoto ? 'has-photo' : '' }}">
                @if($skillsPhoto)
                    <li class="hp-cats__photo">
                        <figure class="hp-cats__figure">
                            <img src="{{ asset('assets/images/home-skills.webp') }}" alt="{{ __('frontend.home.skills_photo') }}" width="1000" height="1429" loading="lazy" decoding="async">
                            <figcaption class="hp-cats__note">{{ __('frontend.home.skills_note') }}</figcaption>
                        </figure>
                    </li>
                @endif
                @foreach($hoCategories as $cat)
                    <li>
                        <a href="{{ route('product-lists', $cat->slug) }}" class="hp-cat">
                            <span class="hp-cat__icon" aria-hidden="true"><i class="fas {{ $hoIcon($cat->title) }}"></i></span>
                            <span class="hp-cat__name">{{ $cat->title }}</span>
                            <span class="hp-cat__count">{{ trans_choice('frontend.home.cats_count', $cat->products_count, ['count' => $cat->products_count]) }}</span>
                            <i class="fas fa-arrow-right hp-cat__go" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

@if($hoFeature)
    <section class="hp-sec hp-sec--sage" aria-labelledby="hpPicksTitle">
        <div class="hp-sec__wrap">
            <header class="hp-head">
                <div>
                    <p class="eyebrow">{{ __('frontend.home.picks_tag') }}</p>
                    <h2 id="hpPicksTitle" class="hp-head__title">{{ __('frontend.home.picks_title') }}</h2>
                </div>
                <a href="{{ route('product-lists') }}" class="hp-head__link">
                    {{ __('frontend.home.picks_all') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </header>

            <ul class="hp-picks">
                @foreach(collect([$hoFeature])->concat($hoMore) as $course)
                    @php
                        $pimg = explode(',', $course->photo)[0];
                        $lvCount = $course->levels ? $course->levels->count() : 0;
                        $minPoints = $lvCount ? $course->levels->min('price_in_points') : 0;
                        $catTitle = optional($course->cat_info)->title;
                    @endphp
                    <li class="hp-pick {{ $loop->first ? 'hp-pick--lead' : '' }}">
                        <a href="{{ route('product-detail', $course->slug) }}" class="hp-pick__link">
                            <span class="hp-pick__media cg-card__media">
                                <img src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="896" loading="lazy" decoding="async">
                            </span>
                            <span class="hp-pick__body">
                                @if($catTitle)
                                    <span class="hp-pick__cat">{{ $catTitle }}</span>
                                @endif
                                <span class="hp-pick__title">{{ $course->title }}</span>
                                @if($loop->first && $course->summary)
                                    <span class="hp-pick__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 150) }}</span>
                                @endif
                                <span class="hp-pick__foot">
                                    @if($minPoints)
                                        <span class="hp-pick__price">
                                            <small>{{ __('frontend.home.price_from') }}</small>
                                            <strong class="num">{{ number_format($minPoints) }} <em>{{ __('frontend.home.price_unit') }}</em></strong>
                                        </span>
                                    @endif
                                    @if($lvCount)
                                        <span class="hp-pick__levels">{{ trans_choice('frontend.home.level_count', $lvCount, ['count' => $lvCount]) }}</span>
                                    @endif
                                    <span class="vh">{{ __('frontend.home.picks_open') }}</span>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

<section class="hp-sec hp-sec--mint" aria-labelledby="hpFlowTitle">
    <div class="hp-sec__wrap">
        <header class="hp-head hp-head--center">
            <p class="eyebrow">{{ __('frontend.home.flow_tag') }}</p>
            <h2 id="hpFlowTitle" class="hp-head__title">{{ __('frontend.home.flow_title') }}</h2>
        </header>

        @if($flowVideo)
            <figure class="hp-reel">
                <video class="hp-reel__video" autoplay muted loop playsinline preload="metadata" @if($flowPoster) poster="{{ asset('assets/images/home-flow.webp') }}" @endif aria-label="{{ __('frontend.home.flow_video') }}" data-hp-video>
                    <source src="{{ asset('assets/videos/home-flow.mp4') }}" type="video/mp4">
                </video>
                <button type="button" class="hp-hero__toggle" aria-label="{{ __('frontend.home.motion_pause') }}" data-pause="{{ __('frontend.home.motion_pause') }}" data-play="{{ __('frontend.home.motion_play') }}" data-hp-toggle>
                    <i class="fas fa-pause" aria-hidden="true"></i>
                </button>
            </figure>
        @endif

        <ol class="hp-flow">
            @foreach($hoSteps as $i => $s)
                <li class="hp-flow__step">
                    <span class="hp-flow__dot" aria-hidden="true"><i class="fas {{ $s['i'] }}"></i></span>
                    <span class="hp-flow__num" aria-hidden="true">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="hp-flow__title">{{ __('frontend.home.' . $s['t']) }}</h3>
                    <p class="hp-flow__text">{{ __('frontend.home.' . $s['d']) }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="hp-credits" aria-labelledby="hpCreditsTitle">
    <div class="hp-credits__box">
        <div class="hp-credits__text">
            <p class="eyebrow">{{ __('frontend.home.credits_tag') }}</p>
            <h2 id="hpCreditsTitle" class="hp-credits__title">{{ __('frontend.home.credits_title') }}</h2>
            <p class="hp-credits__lead">{{ __('frontend.home.credits_text') }}</p>
            <p class="hp-credits__note">
                <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                {{ __('frontend.topup.valid_days') }}
            </p>
            <a href="{{ route('points.topup') }}" class="btn btn--primary">
                <span>{{ __('frontend.home.credits_go') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        <ol class="hp-mult" aria-label="{{ __('frontend.topup.tiers_heading') }}">
            @foreach($hoMult as [$label, $rise])
                <li class="hp-mult__col {{ $loop->last ? 'is-top' : '' }}" style="--rise: {{ $rise }}%">
                    <span class="hp-mult__bar" aria-hidden="true"></span>
                    <span class="hp-mult__label">{{ $label }}</span>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="hp-sec hp-sec--white" aria-labelledby="hpWhyTitle">
    <div class="hp-sec__wrap hp-why">
        <div class="hp-why__visual {{ $whyPhoto ? '' : 'hp-why__visual--plain' }}">
            @if($whyPhoto)
                <img src="{{ asset('assets/images/home-why.webp') }}" alt="{{ __('frontend.home.why_photo') }}" width="1100" height="1650" loading="lazy" decoding="async">
            @else
                <span class="hp-why__mark" aria-hidden="true">
                    <i class="fas fa-chart-line"></i>
                </span>
            @endif
        </div>

        <div class="hp-why__text">
            <p class="eyebrow">{{ __('frontend.home.why_tag') }}</p>
            <h2 id="hpWhyTitle" class="hp-head__title">{{ __('frontend.home.why_title') }}</h2>
            <ul class="hp-why__list">
                @foreach($hoWhy as $w)
                    <li class="hp-why__item">
                        <span class="hp-why__icon" aria-hidden="true"><i class="fas {{ $w['i'] }}"></i></span>
                        <span>
                            <strong class="hp-why__name">{{ __('frontend.home.' . $w['t']) }}</strong>
                            <span class="hp-why__desc">{{ __('frontend.home.' . $w['d']) }}</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<section class="hp-end" aria-labelledby="hpEndTitle">
    <div class="hp-end__card {{ $startPhoto ? 'has-photo' : '' }}">
        @if($startPhoto)
            <figure class="hp-end__photo">
                <img src="{{ asset('assets/images/home-start.webp') }}" alt="{{ __('frontend.home.start_photo') }}" width="1600" height="900" loading="lazy" decoding="async">
            </figure>
        @endif
        <div class="hp-end__body">
        <h2 id="hpEndTitle" class="hp-end__title">{{ __('frontend.home.end_title') }}</h2>
        <p class="hp-end__text">{{ __('frontend.home.end_text') }}</p>
        <div class="hp-end__cta">
            <a href="{{ route('product-lists') }}" class="btn btn--primary">
                <span>{{ __('frontend.home.cta_explore') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
            @guest
                <a href="{{ route('register.form') }}" class="btn btn--secondary">{{ __('frontend.home.end_join') }}</a>
            @else
                <a href="{{ route('points.topup') }}" class="btn btn--secondary">{{ __('frontend.home.cta_credits') }}</a>
            @endguest
        </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    document.querySelectorAll('[data-hp-video]').forEach(function (video) {
        var toggle = video.parentElement.querySelector('[data-hp-toggle]');
        if (!toggle) { return; }

        var icon = toggle.querySelector('i');

        var paint = function () {
            toggle.setAttribute('aria-label', video.paused ? toggle.dataset.play : toggle.dataset.pause);
            icon.className = video.paused ? 'fas fa-play' : 'fas fa-pause';
        };

        if (calm) {
            video.removeAttribute('autoplay');
            video.pause();
        }

        toggle.addEventListener('click', function () {
            if (video.paused) { video.play(); } else { video.pause(); }
        });
        video.addEventListener('play', paint);
        video.addEventListener('pause', paint);
        paint();
    });
}());
</script>
@endpush
