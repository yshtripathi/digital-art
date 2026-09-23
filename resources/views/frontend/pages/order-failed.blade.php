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

{{-- ==========================================================================
     Order failed
     Centred column: status medallion, recovery steps card, and action buttons.
     Styles: public/css/variables.css — Section 18
     ========================================================================== --}}
<section class="res res--failed">
    <div class="res__wrap">

        <span class="res-mark" aria-hidden="true">
            <span class="res-mark__ring"></span>
            <span class="res-mark__icon"><i class="fas fa-times"></i></span>
        </span>

        <h1 class="res-title">{{ __('frontend.failed.heading') }}</h1>
        <p class="res-msg">{{ __('frontend.failed.message') }}</p>

        <div class="res-help">
            <h2 class="res-help__title">{{ __('frontend.failed.help_title') }}</h2>

            <ol class="res-steps">
                <li class="res-step"><span class="res-step__num">1</span><span>{{ __('frontend.failed.try1') }}</span></li>
                <li class="res-step"><span class="res-step__num">2</span><span>{{ __('frontend.failed.try2') }}</span></li>
                <li class="res-step"><span class="res-step__num">3</span><span>{{ __('frontend.failed.try3') }}</span></li>
            </ol>

            <div class="res-assist">
                <span class="res-assist__icon" aria-hidden="true"><i class="fas fa-headset"></i></span>
                <div>
                    <h3 class="res-assist__title">{{ __('frontend.failed.assist_title') }}</h3>
                    <p class="res-assist__msg">
                        {!! str_replace(':email', '<a href="mailto:' . e($supportEmail) . '">' . e($supportEmail) . '</a>', e(__('frontend.failed.assist_text'))) !!}
                    </p>
                </div>
            </div>
        </div>

        <div class="res-actions">
            <a href="{{ route('points.topup') }}" class="btn btn--primary">
                <i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.failed.retry') }}
            </a>
            <a href="{{ route('home') }}" class="btn btn--ghost">
                <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.failed.home') }}
            </a>
        </div>

    </div>
</section>

@endsection

