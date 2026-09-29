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
    $abImage = file_exists(public_path('assets/images/about.webp')) ? asset('assets/images/about.webp') : null;
    $abSteps2 = file_exists(public_path('assets/images/about-steps.webp')) ? asset('assets/images/about-steps.webp') : null;
    $abPoints = [__('frontend.about.point_one'), __('frontend.about.point_two'), __('frontend.about.point_three')];
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
        <div class="ab-media" aria-hidden="true">
            <span class="ab-media__back"></span>
            <figure class="ab-media__frame {{ $abImage ? '' : 'is-empty' }}">
                @if($abImage)
                    <img src="{{ $abImage }}" alt="" width="1200" height="1500" loading="lazy" decoding="async">
                @else
                    <i class="far fa-image"></i>
                @endif
            </figure>
            <span class="ab-media__chip"><strong>4</strong>{{ __('frontend.about.levels_badge') }}</span>
        </div>

        <div class="ab-copy">
            <span class="tag">{{ __('frontend.about.eyebrow') }}</span>
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
    </div>
</section>

<section class="ab-how" aria-labelledby="abHowTitle">
    <div class="container">
        <div class="ab-how__card" data-reveal>
            <figure class="ab-how__media {{ $abSteps2 ? '' : 'is-empty' }}" aria-hidden="true">
                @if($abSteps2)
                    <img src="{{ $abSteps2 }}" alt="" width="1000" height="1500" loading="lazy" decoding="async">
                @else
                    <i class="far fa-image"></i>
                @endif
            </figure>

            <div class="ab-how__body">
                <header class="ab-how__head">
                    <span class="tag">{{ __('frontend.about.steps_label') }}</span>
                    <h2 id="abHowTitle" class="ab-how__title">{{ __('frontend.about.steps_heading') }}</h2>
                </header>

                <ol class="ab-steps">
                    @foreach($abSteps as $step)
                        <li class="ab-step" style="--i: {{ $loop->index }}">
                            <span class="ab-step__no" aria-hidden="true">{{ $loop->iteration }}</span>
                            <div class="ab-step__card">
                                <h3 class="ab-step__name"><i class="fas {{ $step['icon'] }}" aria-hidden="true"></i>{{ $step['title'] }}</h3>
                                <p class="ab-step__text">{{ $step['text'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

            <ul class="ab-facts">
                @foreach($abFacts as $fact)
                    <li class="ab-fact" style="--i: {{ $loop->index }}">
                        <span class="ab-fact__icon" aria-hidden="true"><i class="fas {{ $fact['icon'] }}"></i></span>
                        <strong class="ab-fact__title">{{ __('frontend.about.' . $fact['key']) }}</strong>
                        <span class="ab-fact__text">{{ __('frontend.about.' . $fact['key'] . '_text') }}</span>
                    </li>
                @endforeach
            </ul>
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
    }, { threshold: 0.25 });

    blocks.forEach(function (block) { watch.observe(block); });
}());
</script>
@endpush
