@extends('frontend.layouts.main')
@section('title', __('frontend.failed.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.failed.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.failed.title')]
    ]
])

@php $supportEmail = $misc['Company Email'] ?? __('frontend.company.email'); @endphp

<section class="rs rs--failed">
    <div class="rs__grid">

        {{-- Status hero --}}
        <div class="rs-hero">
            <div class="rs-status" aria-hidden="true">
                <span class="rs-status__ring"></span>
                <span class="rs-status__icon"><i class="fas fa-times"></i></span>
            </div>

            <h2 class="rs-hero__title">{{ __('frontend.failed.heading') }}</h2>
            <p class="rs-hero__msg">{{ __('frontend.failed.message') }}</p>

            <div class="rs-actions">
                <a href="{{ route('points.topup') }}" class="rs-btn rs-btn--lime">
                    <i class="fas fa-coins"></i> {{ __('frontend.failed.retry') }}
                </a>
                <a href="{{ route('home') }}" class="rs-btn rs-btn--outline">
                    <i class="fas fa-home"></i> {{ __('frontend.failed.home') }}
                </a>
            </div>
        </div>

        {{-- Help --}}
        <div class="rs-help">
            <span class="rs-help__eyebrow"><i class="fas fa-exclamation-triangle"></i> {{ __('frontend.failed.help_title') }}</span>

            <ol class="rs-steps">
                <li class="rs-step"><span class="rs-step__num">1</span><span>{{ __('frontend.failed.help1') }}</span></li>
                <li class="rs-step"><span class="rs-step__num">2</span><span>{{ __('frontend.failed.help2') }}</span></li>
                <li class="rs-step"><span class="rs-step__num">3</span><span>{{ __('frontend.failed.help3') }}</span></li>
            </ol>

            <div class="rs-assist">
                <span class="rs-assist__icon" aria-hidden="true"><i class="fas fa-headset"></i></span>
                <div>
                    <h3 class="rs-assist__title">{{ __('frontend.failed.assist_title') }}</h3>
                    <p class="rs-assist__msg">
                        {!! str_replace(':email', '<a href="mailto:' . e($supportEmail) . '">' . e($supportEmail) . '</a>', e(__('frontend.failed.assist_text'))) !!}
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
