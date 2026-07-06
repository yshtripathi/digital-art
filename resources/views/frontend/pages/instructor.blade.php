@extends('frontend.layouts.main')
@section('title', __('common.artists'))
@section('main-content')

<div class="tl-breadcrumb about-banner pt-120 pb-120">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.artists') }}</h1></div>
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

<section class="instructor-section pt-120 pb-120 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="modern-card border-0 shadow-sm bg-white p-5 p-lg-6" style="border-radius: 30px;">
                        <h3 class="fw-800 text-dark mb-4">{{ __('common.chromatique_collection_title') }}</h3>
                        <p class="fw-bold text-primary mb-3">{{ __('common.chromatique_collection_tagline') }}</p>
                        <p class="text-muted lh-lg mb-3">{{ __('common.chromatique_collection_desc1') }}</p>
                        <p class="text-muted lh-lg mb-4">{{ __('common.chromatique_collection_desc2') }}</p>

                        <h5 class="fw-bold text-dark mb-3">{{ __('common.chromatique_categories_title') }}</h5>
                        <ul class="text-muted lh-lg mb-4">
                            <li class="mb-2"><strong>{{ __('common.chromatique_cat_nature_label') }}</strong>：{{ __('common.chromatique_cat_nature_desc') }}</li>
                            <li class="mb-2"><strong>{{ __('common.chromatique_cat_landscape_label') }}</strong>：{{ __('common.chromatique_cat_landscape_desc') }}</li>
                            <li class="mb-2"><strong>{{ __('common.chromatique_cat_fantasy_label') }}</strong>：{{ __('common.chromatique_cat_fantasy_desc') }}</li>
                            <li class="mb-2"><strong>{{ __('common.chromatique_cat_abstract_label') }}</strong>：{{ __('common.chromatique_cat_abstract_desc') }}</li>
                            <li class="mb-2"><strong>{{ __('common.chromatique_cat_modern_label') }}</strong>：{{ __('common.chromatique_cat_modern_desc') }}</li>
                        </ul>
                        <p class="fw-bold text-dark pt-3 border-top">{{ __('common.chromatique_collection_footer') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

