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

@php $supportEmail = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email'); @endphp

<section class="rs rs--failed">
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
            <span class="steps__no">3</span>
            <span class="steps__label">{{ __('frontend.cart.st_done') }}</span>
        </li>
    </ol>

    <div class="rs__hero">
        <div class="rs__orb" aria-hidden="true">
            <span class="rs__wave"></span>
            <span class="rs__wave rs__wave--late"></span>
            <svg class="rs__mark" viewBox="0 0 52 52" focusable="false">
                <circle class="rs__circle" cx="26" cy="26" r="24"/>
                <path class="rs__draw" d="M18 18 L34 34 M34 18 L18 34"/>
            </svg>
        </div>
        <h2 class="rs__title">{{ __('frontend.failed.heading') }}</h2>
        <p class="rs__msg">{{ __('frontend.failed.lead') }}</p>

        <div class="rs__actions">
            <a href="{{ route('points.topup') }}" class="btn btn--primary">
                <i class="fas fa-redo" aria-hidden="true"></i> {{ __('frontend.failed.retry') }}
            </a>
            <a href="{{ route('home') }}" class="btn btn--ghost">
                <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.failed.go_home') }}
            </a>
        </div>
    </div>

    <div class="rs__grid">
        <div class="rs__card">
            <h3 class="rs__head">{{ __('frontend.failed.fixes') }}</h3>
            <ol class="rs__flow">
                <li>
                    <span class="rs__dot num" aria-hidden="true">1</span>
                    <span>{{ __('frontend.failed.fix1') }}</span>
                </li>
                <li>
                    <span class="rs__dot num" aria-hidden="true">2</span>
                    <span>{{ __('frontend.failed.fix2') }}</span>
                </li>
                <li>
                    <span class="rs__dot num" aria-hidden="true">3</span>
                    <span>{{ __('frontend.failed.fix3') }}</span>
                </li>
            </ol>
        </div>

        <div class="rs__card rs__assist">
            <span class="rs__assist-icon" aria-hidden="true">
                <span class="rs__wave"></span>
                <i class="fas fa-headset"></i>
            </span>
            <h3 class="rs__head">{{ __('frontend.failed.help') }}</h3>
            <p class="rs__assist-text">
                {!! str_replace(':email', '<a href="mailto:' . e($supportEmail) . '">' . e($supportEmail) . '</a>', e(__('frontend.failed.reach'))) !!}
            </p>
        </div>
    </div>
</section>

@endsection

