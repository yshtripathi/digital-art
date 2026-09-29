@extends('frontend.layouts.main')
@section('title', __('frontend.failed.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.failed.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.failed.title')]
    ]
])

@php
    $supportAddr = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $supportMail = '<a href="mailto:' . e($supportAddr) . '">' . e($supportAddr) . '</a>';
    $fixes = [__('frontend.failed.check_one'), __('frontend.failed.check_two'), __('frontend.failed.check_three')];
@endphp

<section class="outcome">
    <ol class="steps">
        <li class="steps__item is-done">
            <span class="steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.step_cart') }}</span>
        </li>
        <li class="steps__line is-done" aria-hidden="true"></li>
        <li class="steps__item is-failed" aria-current="step">
            <span class="steps__no"><i class="fas fa-times" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.step_pay') }}</span>
        </li>
        <li class="steps__line" aria-hidden="true"></li>
        <li class="steps__item">
            <span class="steps__no">3</span>
            <span class="steps__label">{{ __('frontend.cart.step_done') }}</span>
        </li>
    </ol>

    <div class="outcome__card outcome__card--fail">
        <div class="outcome__status">
            <span class="seal seal--fail" aria-hidden="true">
                <svg viewBox="0 0 48 48" focusable="false"><path d="M16 16 L32 32"></path><path d="M32 16 L16 32"></path></svg>
            </span>
            <h2 class="outcome__title">{{ __('frontend.failed.heading') }}</h2>
            <p class="outcome__lead">{{ __('frontend.failed.lead') }}</p>

            <div class="outcome__acts">
                <a href="{{ route('points.topup') }}" class="btn outcome__retry" data-retry>
                    <i class="fas fa-redo" aria-hidden="true"></i> {{ __('frontend.failed.retry') }}
                </a>
                <a href="{{ route('home') }}" class="btn btn--outline">
                    <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.failed.home') }}
                </a>
            </div>
        </div>

        <div class="outcome__detail">
            <div class="checks" data-checks>
                <div class="checks__head">
                    <h3 class="checks__title">{{ __('frontend.failed.checks') }}</h3>
                    <span class="checks__count" aria-live="polite" data-checks-count data-template="{{ __('frontend.failed.progress') }}">{{ __('frontend.failed.progress', ['done' => 0, 'total' => count($fixes)]) }}</span>
                </div>
                <div class="checks__bar" aria-hidden="true"><span data-checks-bar></span></div>
                <ul class="checks__list">
                    @foreach($fixes as $fix)
                        <li>
                            <label class="tick checks__item" for="fix-{{ $loop->iteration }}">
                                <input type="checkbox" id="fix-{{ $loop->iteration }}" data-check>
                                <span class="tick__box" aria-hidden="true"><i class="fas fa-check"></i></span>
                                <span>{{ $fix }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="lifeline">
                <span class="lifeline__icon" aria-hidden="true"><i class="fas fa-headset"></i></span>
                <div class="lifeline__body">
                    <h3 class="lifeline__title">{{ __('frontend.failed.help_title') }}</h3>
                    <p class="lifeline__text">{!! str_replace(':email', $supportMail, e(__('frontend.failed.help_text'))) !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var box = document.querySelector('[data-checks]');
    if (!box) { return; }

    var boxes = box.querySelectorAll('[data-check]');
    var count = box.querySelector('[data-checks-count]');
    var bar = box.querySelector('[data-checks-bar]');
    var retry = document.querySelector('[data-retry]');
    var template = count ? count.dataset.template : '';

    function update() {
        var done = 0;
        boxes.forEach(function (input) { if (input.checked) { done++; } });
        if (count) {
            count.textContent = template.replace(':done', done).replace(':total', boxes.length);
        }
        if (bar) {
            bar.style.transform = 'scaleX(' + (boxes.length ? done / boxes.length : 0) + ')';
        }
        box.classList.toggle('is-complete', done === boxes.length);
        if (retry) { retry.classList.toggle('is-ready', done === boxes.length); }
    }

    boxes.forEach(function (input) { input.addEventListener('change', update); });
    update();
}());
</script>
@endpush
