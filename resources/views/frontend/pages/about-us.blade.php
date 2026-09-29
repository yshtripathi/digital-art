@extends('frontend.layouts.main')
@section('title', __('frontend.about.name'))
@section('description', __('frontend.about.description'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.about.name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.about.name')]
    ]
])

@php
    $abPoints = [__('frontend.about.point_one'), __('frontend.about.point_two'), __('frontend.about.point_three')];
    $abLevels = [
        ['name' => __('frontend.header.beginner'),     'h' => 34],
        ['name' => __('frontend.header.intermediate'), 'h' => 56],
        ['name' => __('frontend.header.advanced'),     'h' => 78],
        ['name' => __('frontend.header.expert'),       'h' => 100],
    ];
    $abFacts = [
        ['icon' => 'fa-layer-group', 'key' => 'fact_one'],
        ['icon' => 'fa-eye',         'key' => 'fact_two'],
        ['icon' => 'fa-clock',       'key' => 'fact_three'],
        ['icon' => 'fa-coins',       'key' => 'fact_four'],
        ['icon' => 'fa-language',    'key' => 'fact_five'],
    ];
    $abSteps = [
        ['icon' => 'fa-search',    'title' => __('frontend.about.step_one'),   'text' => __('frontend.about.step_one_text')],
        ['icon' => 'fa-list-ul',   'title' => __('frontend.about.step_two'),   'text' => __('frontend.about.step_two_text')],
        ['icon' => 'fa-lock-open', 'title' => __('frontend.about.step_three'), 'text' => __('frontend.about.step_three_text')],
    ];
@endphp

<section class="ab" aria-labelledby="abTitle">
    <div class="container ab__grid">
        <div class="ab-copy">
            <p class="eyebrow">{{ __('frontend.about.eyebrow') }}</p>
            <h2 id="abTitle" class="ab-copy__title">{{ __('frontend.about.heading') }}</h2>
            <p class="ab-copy__lead">{{ __('frontend.about.intro') }}</p>
            <p class="ab-copy__text">{{ __('frontend.about.detail') }}</p>

            <ul class="ab-copy__points">
                @foreach($abPoints as $point)
                    <li style="--i: {{ $loop->index }}"><span aria-hidden="true"><i class="fas fa-check"></i></span>{{ $point }}</li>
                @endforeach
            </ul>

            <div class="ab-copy__acts">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.about.browse') }}</a>
                <a href="{{ route('contact') }}" class="btn btn--ghost">{{ __('frontend.about.contact') }}</a>
            </div>
        </div>

        <div class="ab-viz" data-reveal aria-hidden="true">
            <div class="ab-viz__top">
                <span class="ab-viz__badge"><strong>4</strong> {{ __('frontend.about.levels_badge') }}</span>
                <span class="ab-viz__dots"><span></span><span></span><span></span></span>
            </div>
            <div class="ab-viz__chart">
                <svg class="ab-viz__path" viewBox="0 0 400 200" preserveAspectRatio="none">
                    <path d="M 50 132 L 150 88 L 250 44 L 350 0" pathLength="1"/>
                </svg>
                @foreach($abLevels as $level)
                    <div class="ab-bar" style="--h: {{ $level['h'] }}%; --i: {{ $loop->index }}">
                        <span class="ab-bar__fill">
                            <span class="ab-bar__no">0{{ $loop->iteration }}</span>
                            @if($loop->last)
                                <i class="fas fa-flag-checkered ab-bar__flag"></i>
                            @endif
                        </span>
                        <span class="ab-bar__name">{{ $level['name'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="ab-viz__legend">
                <span><i class="fas fa-eye"></i>{{ __('frontend.about.fact_two') }}</span>
                <span><i class="fas fa-coins"></i>{{ __('frontend.about.fact_four') }}</span>
            </div>
        </div>
    </div>
</section>

<section class="ab-how" aria-labelledby="abHowTitle">
    <div class="container">
        <header class="ab-how__head">
            <p class="eyebrow">{{ __('frontend.about.steps_label') }}</p>
            <h2 id="abHowTitle" class="ab-how__title">{{ __('frontend.about.steps_heading') }}</h2>
        </header>

        <ol class="ab-steps">
            @foreach($abSteps as $step)
                <li class="ab-step" style="--i: {{ $loop->index }}">
                    <span class="ab-step__no" aria-hidden="true"><i class="fas {{ $step['icon'] }}"></i></span>
                    <h3 class="ab-step__name">{{ $step['title'] }}</h3>
                    <p class="ab-step__text">{{ $step['text'] }}</p>
                </li>
            @endforeach
        </ol>

        <ul class="ab-facts">
            @foreach($abFacts as $fact)
                <li class="ab-fact">
                    <span class="ab-fact__icon" aria-hidden="true"><i class="fas {{ $fact['icon'] }}"></i></span>
                    <span>
                        <strong class="ab-fact__title">{{ __('frontend.about.' . $fact['key']) }}</strong>
                        <span class="ab-fact__text">{{ __('frontend.about.' . $fact['key'] . '_text') }}</span>
                    </span>
                </li>
            @endforeach
        </ul>
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
    }, { threshold: 0.25 });

    blocks.forEach(function (block) { watch.observe(block); });
}());
</script>
@endpush
