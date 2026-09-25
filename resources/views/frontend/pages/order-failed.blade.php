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

@php $supportEmail = $misc['Company Email'] ?? __('frontend.company.email'); @endphp

<section class="rs rs--failed">
    <div class="rs__wrap">

        <div class="rs__status band--coffee">
            <span class="rs__badge" aria-hidden="true"><i class="fas fa-times"></i></span>
            <h2 class="rs__title">{{ __('frontend.failed.head') }}</h2>
            <p class="rs__msg">{{ __('frontend.failed.text') }}</p>

            <div class="rs__actions">
                <a href="{{ route('points.topup') }}" class="btn btn--primary btn--block">
                    <i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.failed.go_retry') }}
                </a>
                <a href="{{ route('home') }}" class="btn btn--ghost btn--block">
                    <i class="fas fa-home" aria-hidden="true"></i> {{ __('frontend.failed.go_home') }}
                </a>
            </div>
        </div>

        <div class="rs__panel">
            <h3 class="rs__head">{{ __('frontend.failed.tips_head') }}</h3>

            <ol class="rs__steps">
                <li class="rs__step"><span class="rs__num">1</span><span>{{ __('frontend.failed.tip1') }}</span></li>
                <li class="rs__step"><span class="rs__num">2</span><span>{{ __('frontend.failed.tip2') }}</span></li>
                <li class="rs__step"><span class="rs__num">3</span><span>{{ __('frontend.failed.tip3') }}</span></li>
            </ol>

            <div class="rs__assist">
                <span class="rs__assist-icon" aria-hidden="true"><i class="fas fa-headset"></i></span>
                <div>
                    <h4 class="rs__assist-title">{{ __('frontend.failed.help_head') }}</h4>
                    <p class="rs__assist-text">
                        {!! str_replace(':email', '<a href="mailto:' . e($supportEmail) . '">' . e($supportEmail) . '</a>', e(__('frontend.failed.help_text'))) !!}
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

