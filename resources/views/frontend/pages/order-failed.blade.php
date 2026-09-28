@extends('frontend.layouts.main')
@section('title', __('frontend.failed.page_name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.failed.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.failed.page_name')]
    ]
])

@php
    $supportAddr = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $supportMail = '<a href="mailto:' . e($supportAddr) . '">' . e($supportAddr) . '</a>';
@endphp

<section class="rz">
    <ol class="steps">
        <li class="steps__item is-done">
            <span class="steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.st_cart') }}</span>
        </li>
        <li class="steps__line is-done" aria-hidden="true"></li>
        <li class="steps__item is-failed" aria-current="step">
            <span class="steps__no"><i class="fas fa-times" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.st_pay') }}</span>
        </li>
        <li class="steps__line" aria-hidden="true"></li>
        <li class="steps__item">
            <span class="steps__no num">3</span>
            <span class="steps__label">{{ __('frontend.cart.st_done') }}</span>
        </li>
    </ol>

    <div class="rz__card rz__card--fail">
        <span class="rz__levels" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
        <div class="rz__top">
            <span class="rz__mark" aria-hidden="true"><i class="fas fa-times"></i></span>
            <h2 class="rz__title">{{ __('frontend.failed.heading') }}</h2>
            <p class="rz__lead">{{ __('frontend.failed.lead') }}</p>
        </div>

        <div class="rz__acts">
            <a href="{{ route('points.topup') }}" class="btn">
                <i class="fas fa-redo" aria-hidden="true"></i> {{ __('frontend.failed.retry') }}
            </a>
            <a href="{{ route('home') }}" class="btn btn--ghost">
                <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.failed.go_home') }}
            </a>
        </div>

        <div class="rz__section">
            <h3 class="rz__head">{{ __('frontend.failed.fixes') }}</h3>
            <ol class="rz__flow">
                <li>
                    <span class="rz__dot num" aria-hidden="true">1</span>
                    <span>{{ __('frontend.failed.fix1') }}</span>
                </li>
                <li>
                    <span class="rz__dot num" aria-hidden="true">2</span>
                    <span>{{ __('frontend.failed.fix2') }}</span>
                </li>
                <li>
                    <span class="rz__dot num" aria-hidden="true">3</span>
                    <span>{{ __('frontend.failed.fix3') }}</span>
                </li>
            </ol>
        </div>

        <div class="rz__help">
            <span class="rz__help-icon" aria-hidden="true"><i class="fas fa-headset"></i></span>
            <div>
                <h3 class="rz__help-title">{{ __('frontend.failed.help') }}</h3>
                <p class="rz__help-text">
                    {!! str_replace(':email', $supportMail, e(__('frontend.failed.reach'))) !!}
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
