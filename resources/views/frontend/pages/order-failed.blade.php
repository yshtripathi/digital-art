@extends('frontend.layouts.main')
@section('title', __('managenovax.payment.fail_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.payment.fail_title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.payment.fail_title')]
    ]
])

@php $supportEmail = $misc['Company Email'] ?? '[Company Email]'; @endphp

<section class="rs rs--failed">
    <div class="rs__grid">

        {{-- Status hero --}}
        <div class="rs-hero">
            <div class="rs-status" aria-hidden="true">
                <span class="rs-status__ring"></span>
                <span class="rs-status__icon"><i class="fas fa-times"></i></span>
            </div>

            <h2 class="rs-hero__title">{{ __('managenovax.payment.fail_heading') }}</h2>
            <p class="rs-hero__msg">{{ __('managenovax.payment.fail_msg') }}</p>

            <div class="rs-actions">
                <a href="{{ route('cart') }}" class="rs-btn rs-btn--lime">
                    <i class="fas fa-shopping-cart"></i> {{ __('managenovax.payment.fail_cart') }}
                </a>
                <a href="{{ route('home') }}" class="rs-btn rs-btn--outline">
                    <i class="fas fa-home"></i> {{ __('managenovax.payment.fail_home') }}
                </a>
            </div>
        </div>

        {{-- Help --}}
        <div class="rs-help">
            <span class="rs-help__eyebrow"><i class="fas fa-exclamation-triangle"></i> {{ __('managenovax.payment.fail_help_title') }}</span>

            <ol class="rs-steps">
                <li class="rs-step"><span class="rs-step__num">1</span><span>{{ __('managenovax.payment.fail_help_1') }}</span></li>
                <li class="rs-step"><span class="rs-step__num">2</span><span>{{ __('managenovax.payment.fail_help_2') }}</span></li>
                <li class="rs-step"><span class="rs-step__num">3</span><span>{{ __('managenovax.payment.fail_help_3') }}</span></li>
            </ol>

            <div class="rs-assist">
                <span class="rs-assist__icon" aria-hidden="true"><i class="fas fa-headset"></i></span>
                <div>
                    <h3 class="rs-assist__title">{{ __('managenovax.payment.fail_assist_title') }}</h3>
                    <p class="rs-assist__msg">
                        {{ __('managenovax.payment.fail_assist_msg1') }}
                        <a href="mailto:{{ $supportEmail }}">{{ $supportEmail }}</a>
                        {{ __('managenovax.payment.fail_assist_msg2') }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
