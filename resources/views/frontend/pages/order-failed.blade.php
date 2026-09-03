@extends('frontend.layouts.main')
@section('title', __('inkwave.credit_fail_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.credit_fail_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.credit_fail_title')]
    ]
])



<div class="duo-order-wrapper">
    <div class="duo-container">
        <div class="duo-order-card">
            
            <div class="duo-order-badge duo-order-badge--err">
                <i class="fas fa-times"></i>
            </div>
            
            <h1 class="duo-order-title">{{ __('inkwave.credit_fail_heading') }}</h1>
            <p class="duo-order-sub">{{ __('inkwave.credit_fail_msg') }}</p>

            <div class="duo-order-help">
                <h6 class="duo-order-help__title"><i class="fas fa-lightbulb"></i> {{ __('inkwave.credit_fail_help_title') }}</h6>
                <ul>
                    <li><i class="fas fa-check"></i> <span>{{ __('inkwave.credit_fail_help_1') }}</span></li>
                    <li><i class="fas fa-check"></i> <span>{{ __('inkwave.credit_fail_help_2') }}</span></li>
                    <li><i class="fas fa-check"></i> <span>{{ __('inkwave.credit_fail_help_3') }}</span></li>
                </ul>
            </div>

            <div class="duo-order-actions">
                <a href="{{ route('cart') }}" class="duo-btn duo-btn--primary"><i class="fas fa-shopping-cart"></i> {{ __('inkwave.credit_fail_cart') }}</a>
                <a href="{{ route('home') }}" class="duo-btn duo-btn--ghost"><i class="fas fa-home"></i> {{ __('inkwave.credit_fail_home') }}</a>
            </div>

            <div class="duo-order-assist">
                <h6>{{ __('inkwave.credit_fail_assist_title') }}</h6>
                <p>
                    {{ __('inkwave.credit_fail_assist_msg1') }}
                    <a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}">{{ $misc['Company Email'] ?? '[Company Email]' }}</a>
                    {{ __('inkwave.credit_fail_assist_msg2') }}
                </p>
            </div>
            
        </div>
    </div>
</div>

@endsection
