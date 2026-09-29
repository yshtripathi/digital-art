@extends('frontend.layouts.main')
@section('description', __('frontend.home.description'))

@section('main-content')
@php
    $hmMedia = function ($file) {
        return file_exists(public_path('assets/images/' . $file)) ? asset('assets/images/' . $file) : null;
    };
    $hmHero  = $hmMedia('home-hero.webp');
    $hmCatsImg = $hmMedia('home-categories.webp');
    $hmLevelsImg = $hmMedia('home-levels.webp');
    $hmStartImg = $hmMedia('home-start.webp');

    $hmGuides = collect($product_lists ?? [])->values();
    $hmCats = collect($category_lists ?? [])->values();

    $hmMosaic = $hmGuides->map(function ($guide) {
        $raw = trim(explode(',', (string) $guide->photo)[0] ?? '');
        $guide->hm_cover = $raw !== '' && file_exists(public_path(ltrim($raw, '/'))) ? asset(ltrim($raw, '/')) : null;
        return $guide;
    })->filter(fn ($guide) => $guide->hm_cover)->take(6)->values();

    $hmLevels = [
        ['name' => __('frontend.course.level_beginner'),     'text' => __('frontend.home.level_one'),   'h' => 38],
        ['name' => __('frontend.course.level_intermediate'), 'text' => __('frontend.home.level_two'),   'h' => 58],
        ['name' => __('frontend.course.level_advanced'),     'text' => __('frontend.home.level_three'), 'h' => 78],
        ['name' => __('frontend.course.level_expert'),       'text' => __('frontend.home.level_four'),  'h' => 100],
    ];
@endphp

<section class="hm-hero">
    <div class="container">
        <div class="hm-hero__top">
            <div class="hm-hero__copy">
                <span class="tag hm-tag">{{ __('frontend.home.hero_label') }}</span>
                <h1 class="hm-hero__title">{{ __('frontend.home.hero_title') }} <span>{{ __('frontend.home.hero_accent') }}</span></h1>
            </div>
            <div class="hm-hero__side">
                <p class="hm-hero__lead">{{ __('frontend.home.hero_lead') }}</p>
                <div class="hm-hero__acts">
                    <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.home.explore') }}</a>
                    <a href="{{ route('points.topup') }}" class="btn btn--ghost">{{ __('frontend.home.credits_btn') }}</a>
                </div>
            </div>
        </div>

        <div class="hm-hero__media {{ $hmHero ? '' : 'is-empty' }}">
            @if($hmHero)
                <img src="{{ $hmHero }}" alt="" width="1800" height="675" fetchpriority="high" decoding="async">
            @else
                <i class="far fa-image" aria-hidden="true"></i>
            @endif
            <span class="hm-chip hm-chip--a"><strong>4</strong>{{ __('frontend.home.stat_levels') }}</span>
            @if($hmGuides->count())
                <span class="hm-chip hm-chip--b"><strong>{{ $hmGuides->count() }}</strong>{{ __('frontend.home.stat_guides') }}</span>
            @endif
        </div>
    </div>
</section>

@if($hmCats->isNotEmpty())
    <section class="hm-cats" data-reveal>
        <div class="container hm-cats__grid">
            <div class="hm-cats__intro">
                <span class="tag hm-tag">{{ __('frontend.home.cats_label') }}</span>
                <h2 class="hm-cats__title">{{ __('frontend.home.cats_title') }}</h2>
                <p class="hm-cats__text">{{ __('frontend.home.cats_text') }}</p>
                <figure class="hm-cats__media {{ $hmCatsImg ? '' : 'is-empty' }}" aria-hidden="true">
                    @if($hmCatsImg)
                        <img src="{{ $hmCatsImg }}" alt="" width="1000" height="1498" loading="lazy" decoding="async">
                    @else
                        <i class="far fa-image"></i>
                    @endif
                </figure>
            </div>

            <ol class="hm-cats__list">
                @foreach($hmCats as $cat)
                    <li style="--i: {{ $loop->index }}">
                        <a href="{{ route('product-lists', $cat->slug) }}" class="hm-cat">
                            <span class="hm-cat__no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="hm-cat__name">{{ $cat->title }}</span>
                            <span class="hm-cat__count">{{ trans_choice('frontend.home.cats_count', $cat->products_count ?? 0, ['count' => $cat->products_count ?? 0]) }}</span>
                            <span class="hm-cat__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                        </a>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
@endif

@if($hmMosaic->isNotEmpty())
    <section class="hm-new" data-reveal>
        <div class="container">
            <div class="hm-new__head">
                <span class="tag hm-tag">{{ __('frontend.home.new_label') }}</span>
                <h2 class="hm-new__title">{{ __('frontend.home.new_title') }}</h2>
            </div>

            <div class="hm-mosaic">
                @foreach($hmMosaic as $guide)
                    @php
                        $gLevels = collect($guide->levels ?? []);
                        $gFrom = $gLevels->count() ? $gLevels->min('price_in_points') : 0;
                    @endphp
                    <a href="{{ route('product-detail', $guide->slug) }}" class="hm-tile hm-tile--{{ $loop->iteration }} media-frame" style="--i: {{ $loop->index }}">
                        <img src="{{ $guide->hm_cover }}" alt="" loading="lazy" decoding="async">
                        <span class="hm-tile__info">
                            <span class="hm-tile__name">{{ $guide->title }}</span>
                            @if($gFrom)
                                <span class="hm-tile__price">{{ __('frontend.home.from') }} {{ number_format($gFrom) }} {{ __('frontend.home.credits') }}</span>
                            @endif
                        </span>
                    </a>
                @endforeach
                <a href="{{ route('product-lists') }}" class="hm-tile hm-tile--all" style="--i: {{ $hmMosaic->count() }}">
                    <span class="hm-tile__all-icon" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                    <span class="hm-tile__all-text">{{ __('frontend.home.new_all') }}</span>
                </a>
            </div>
        </div>
    </section>
@endif

<section class="hm-levels" data-reveal>
    <div class="container">
        <div class="hm-levels__card">
            <figure class="hm-levels__media {{ $hmStartImg ? '' : 'is-empty' }}" aria-hidden="true">
                @if($hmStartImg)
                    <img src="{{ $hmStartImg }}" alt="" width="1400" height="2098" loading="lazy" decoding="async">
                @else
                    <i class="far fa-image"></i>
                @endif
            </figure>

            <div class="hm-levels__body">
                <span class="tag hm-tag">{{ __('frontend.home.levels_label') }}</span>
                <h2 class="hm-levels__title">{{ __('frontend.home.levels_title') }}</h2>
                <p class="hm-levels__text">{{ __('frontend.home.levels_text') }}</p>

                <ol class="hm-stairs">
                    @foreach($hmLevels as $lvl)
                        <li class="hm-stair" style="--h: {{ $lvl['h'] }}; --i: {{ $loop->index }}">
                            <span class="hm-stair__bar"><span class="hm-stair__no">{{ $loop->iteration }}</span></span>
                            <strong class="hm-stair__name">{{ $lvl['name'] }}</strong>
                            <span class="hm-stair__text">{{ $lvl['text'] }}</span>
                        </li>
                    @endforeach
                </ol>

                <a href="{{ route('points.topup') }}" class="btn btn--primary">{{ __('frontend.home.levels_btn') }}</a>
            </div>
        </div>
    </div>
</section>

<section class="hm-end" data-reveal>
    <div class="container">
        <div class="hm-end__card">
            <div class="hm-end__copy">
                <span class="tag hm-tag">{{ __('frontend.home.hero_label') }}</span>
                <h2 class="hm-end__title">{{ __('frontend.home.end_title') }}</h2>
                <p class="hm-end__text">{{ __('frontend.home.end_text') }}</p>
                <div class="hm-end__acts">
                    @guest
                        <a href="{{ route('register.form') }}" class="btn btn--primary">{{ __('frontend.home.register') }}</a>
                    @else
                        <a href="{{ route('user') }}" class="btn btn--primary">{{ __('frontend.header.account') }}</a>
                    @endguest
                    <a href="{{ route('product-lists') }}" class="btn btn--dark">{{ __('frontend.home.explore') }}</a>
                </div>
            </div>
            <figure class="hm-end__media {{ $hmLevelsImg ? '' : 'is-empty' }}" aria-hidden="true">
                @if($hmLevelsImg)
                    <img src="{{ $hmLevelsImg }}" alt="" width="1200" height="800" loading="lazy" decoding="async">
                @else
                    <i class="far fa-image"></i>
                @endif
            </figure>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var blocks = document.querySelectorAll('[data-reveal]');
    if (!blocks.length) { return; }

    if (!('IntersectionObserver' in window)) {
        blocks.forEach(function (block) { block.classList.add('is-in'); });
        return;
    }

    var watch = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-in');
                watch.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    blocks.forEach(function (block) { watch.observe(block); });
}());
</script>
@endpush
