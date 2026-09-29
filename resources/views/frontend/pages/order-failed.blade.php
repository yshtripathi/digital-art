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

<section class="pay">
    <div class="container">
        <ol class="pay-steps">
            <li class="pay-steps__item is-done"><span class="pay-steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>{{ __('frontend.cart.step_cart') }}</li>
            <li class="pay-steps__item is-failed" aria-current="step"><span class="pay-steps__no"><i class="fas fa-times" aria-hidden="true"></i></span>{{ __('frontend.cart.step_pay') }}</li>
            <li class="pay-steps__item"><span class="pay-steps__no">3</span>{{ __('frontend.cart.step_done') }}</li>
        </ol>

        <div class="rs rs--fail">
            <div class="rs__hero">
                <svg class="rs__mark" viewBox="0 0 52 52" aria-hidden="true">
                    <circle class="rs__ring" cx="26" cy="26" r="24" pathLength="1"/>
                    <path class="rs__sign" d="M18 18 L34 34 M34 18 L18 34" pathLength="1"/>
                </svg>
                <h2 class="rs__title">{{ __('frontend.failed.heading') }}</h2>
                <p class="rs__lead">{{ __('frontend.failed.lead') }}</p>
            </div>

            <div class="rs__checks">
                <p class="rs__checks-title">{{ __('frontend.failed.checks') }}</p>
                <ol class="rs__checks-list">
                    @foreach($fixes as $fix)
                        <li style="--i: {{ $loop->index }}">{{ $fix }}</li>
                    @endforeach
                </ol>
            </div>

            <div class="rs__acts">
                <a href="{{ route('points.topup') }}" class="btn btn--primary rs__retry">
                    <i class="fas fa-redo" aria-hidden="true"></i>
                    <span>{{ __('frontend.failed.retry') }}</span>
                </a>
                <a href="{{ route('home') }}" class="btn btn--ghost">{{ __('frontend.failed.home') }}</a>
            </div>
        </div>

        <div class="rs-help">
            <span class="rs-help__icon" aria-hidden="true"><i class="fas fa-headset"></i></span>
            <div class="rs-help__body">
                <h2 class="rs-help__title">{{ __('frontend.failed.help_title') }}</h2>
                <p class="rs-help__text">{!! str_replace(':email', $supportMail, e(__('frontend.failed.help_text'))) !!}</p>
            </div>
            <a href="{{ route('contact') }}" class="btn btn--primary rs-help__btn">{{ __('frontend.header.contact') }}</a>
        </div>
    </div>
</section>

@endsection
