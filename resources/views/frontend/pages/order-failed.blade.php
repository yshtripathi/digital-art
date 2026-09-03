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



<div class="ag-page-wrapper">
    <div class="ag-alert-card">
        
        <div class="ag-alert-icon">
            <i class="fas fa-times"></i>
        </div>
        
        <h1 class="ag-alert-title">{{ __('inkwave.credit_fail_heading') }}</h1>
        <p class="ag-alert-desc">{{ __('inkwave.credit_fail_msg') }}</p>

        <div class="ag-alert-help">
            <h6><i class="fas fa-exclamation-triangle"></i> {{ __('inkwave.credit_fail_help_title') }}</h6>
            <ul>
                <li><i class="fas fa-arrow-right"></i> <span>{{ __('inkwave.credit_fail_help_1') }}</span></li>
                <li><i class="fas fa-arrow-right"></i> <span>{{ __('inkwave.credit_fail_help_2') }}</span></li>
                <li><i class="fas fa-arrow-right"></i> <span>{{ __('inkwave.credit_fail_help_3') }}</span></li>
            </ul>
        </div>

        <div class="ag-alert-actions">
            <a href="{{ route('cart') }}" class="ag-submit-btn">
                <i class="fas fa-shopping-cart"></i> {{ __('inkwave.credit_fail_cart') }}
            </a>
            <a href="{{ route('home') }}" class="ag-ghost-btn">
                <i class="fas fa-home"></i> {{ __('inkwave.credit_fail_home') }}
            </a>
        </div>

        <div class="ag-alert-assist">
            <h6>{{ __('inkwave.credit_fail_assist_title') }}</h6>
            <p>
                {{ __('inkwave.credit_fail_assist_msg1') }}
                <a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}">{{ $misc['Company Email'] ?? '[Company Email]' }}</a>
                {{ __('inkwave.credit_fail_assist_msg2') }}
            </p>
        </div>
        
    </div>
</div>

@endsection
