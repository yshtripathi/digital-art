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

        <div class="pay__grid">
            <div class="pay-card res res--fail" style="--i: 0">
                <div class="res__head">
                    <span class="res__mark" aria-hidden="true"><i class="fas fa-times"></i></span>
                    <div>
                        <h2 class="res__title">{{ __('frontend.failed.heading') }}</h2>
                        <p class="res__lead">{{ __('frontend.failed.lead') }}</p>
                    </div>
                </div>

                <div class="res__box">
                    <p class="res__box-title">{{ __('frontend.failed.checks') }}</p>
                    <ul class="res__checks">
                        @foreach($fixes as $fix)
                            <li><i class="fas fa-circle" aria-hidden="true"></i><span>{{ $fix }}</span></li>
                        @endforeach
                    </ul>
                </div>

                <div class="res__acts">
                    <a href="{{ route('points.topup') }}" class="btn btn--primary">
                        <i class="fas fa-redo" aria-hidden="true"></i>
                        <span>{{ __('frontend.failed.retry') }}</span>
                    </a>
                    <a href="{{ route('home') }}" class="btn btn--dark">{{ __('frontend.failed.home') }}</a>
                </div>
            </div>

            <aside class="pay__rail">
                <div class="pay-sum res-help">
                    <span class="res-help__icon" aria-hidden="true"><i class="fas fa-headset"></i></span>
                    <h2 class="pay-sum__title">{{ __('frontend.failed.help_title') }}</h2>
                    <p class="res-help__text">{!! str_replace(':email', $supportMail, e(__('frontend.failed.help_text'))) !!}</p>
                    <a href="{{ route('contact') }}" class="btn btn--dark btn--block">{{ __('frontend.header.contact') }}</a>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection
