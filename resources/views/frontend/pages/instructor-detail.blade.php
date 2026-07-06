@extends('frontend.layouts.main')
@section('title', $instructor_data->instructor_name)
@section('main-content')

<div class="tl-breadcrumb about-banner pt-120 pb-120">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ $instructor_data->instructor_name }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.artists') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="instructor-detail-section pt-120 pb-120 bg-light">
    <div class="container">
        <div class="row g-5">
            <div class="col-xl-4 col-lg-4">
                <div class="modern-card border-0 shadow-sm bg-white p-5" style="border-radius: 30px;">
                    <h3 class="fw-800 text-dark mb-2">{{ $instructor_data->instructor_name }}</h3>
                    <p class="text-primary fw-bold mb-4">{{ $instructor_data->instructor_designation }}</p>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8">
                <div class="modern-card border-0 shadow-sm bg-white p-5 p-lg-6" style="border-radius: 30px;">
                    <div class="instructor-bio">
                        {!! $instructor_data->instructor_desc !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection


