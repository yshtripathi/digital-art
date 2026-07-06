@extends('frontend.layouts.main')
@section('title', 'Order Failed')
@section('main-content')

<x-breadcrumb :title="__('common.failed')" />

<section class="ord-section">
    <img src="{{ asset('assets/images/i1.png') }}" alt="" aria-hidden="true" class="ord-bg">
    <div class="ord-card">
        <div class="ord-badge ord-badge--err"><i class="fas fa-times"></i></div>
        <h1 class="ord-title">{{ __('common.payment_error') }}</h1>
        <p class="ord-sub">{{ __('common.payment_failure_message') }}</p>

        <div class="ord-help">
            <h6 class="ord-help__title"><i class="fas fa-lightbulb"></i> {{ __('common.what_you_can_do') }}</h6>
            <ul>
                <li><i class="fas fa-check"></i> <span>{{ __('common.check_payment_details') }}</span></li>
                <li><i class="fas fa-check"></i> <span>{{ __('common.contact_bank') }}</span></li>
                <li><i class="fas fa-check"></i> <span>{{ __('common.try_different_payment') }}</span></li>
            </ul>
        </div>

        <div class="ord-actions">
            <a href="{{ route('cart') }}" class="ord-btn ord-btn--primary"><i class="fas fa-shopping-cart"></i> {{ __('common.cart') }}</a>
            <a href="{{ route('home') }}" class="ord-btn ord-btn--ghost"><i class="fas fa-home"></i> {{ __('common.home') }}</a>
        </div>

        <div class="ord-assist">
            <h6>{{ __('common.need_assistance') }}</h6>
            <p>
                {{ __('common.reach_out') }}
                <a href="mailto:{{ __('common.company_email') }}">{{ __('common.company_email') }}</a>.
                {{ __('common.we_are_here') }}
            </p>
        </div>
    </div>
</section>

@endsection

@include('frontend.pages.partials.order-style')
