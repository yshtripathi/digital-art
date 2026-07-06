@extends('frontend.layouts.main')
@section('title', __('inkwave.order_fail_title'))
@section('main-content')

<x-breadcrumb :title="__('inkwave.order_fail_title')" />

<section class="ord-section">
    <img src="{{ asset('assets/images/i1.webp') }}" alt="" aria-hidden="true" class="ord-bg">
    <div class="ord-card">
        <div class="ord-badge ord-badge--err"><i class="fas fa-times"></i></div>
        <h1 class="ord-title">{{ __('inkwave.order_fail_heading') }}</h1>
        <p class="ord-sub">{{ __('inkwave.order_fail_msg') }}</p>

        <div class="ord-help">
            <h6 class="ord-help__title"><i class="fas fa-lightbulb"></i> {{ __('inkwave.order_fail_help_title') }}</h6>
            <ul>
                <li><i class="fas fa-check"></i> <span>{{ __('inkwave.order_fail_help_1') }}</span></li>
                <li><i class="fas fa-check"></i> <span>{{ __('inkwave.order_fail_help_2') }}</span></li>
                <li><i class="fas fa-check"></i> <span>{{ __('inkwave.order_fail_help_3') }}</span></li>
            </ul>
        </div>

        <div class="ord-actions">
            <a href="{{ route('cart') }}" class="ord-btn ord-btn--primary"><i class="fas fa-shopping-cart"></i> {{ __('inkwave.order_fail_cart') }}</a>
            <a href="{{ route('home') }}" class="ord-btn ord-btn--ghost"><i class="fas fa-home"></i> {{ __('inkwave.order_fail_home') }}</a>
        </div>

        <div class="ord-assist">
            <h6>{{ __('inkwave.order_fail_assist_title') }}</h6>
            <p>
                {{ __('inkwave.order_fail_assist_msg1') }}
                <a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}">{{ $misc['Company Email'] ?? '[Company Email]' }}</a>
                {{ __('inkwave.order_fail_assist_msg2') }}
            </p>
        </div>
    </div>
</section>

@endsection

@include('frontend.pages.partials.order-style')
