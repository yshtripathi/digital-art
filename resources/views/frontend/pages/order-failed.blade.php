@extends('frontend.layouts.main')
@section('title', 'Order Failed')
@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title"><i class="fas fa-times-circle me-3" style="color: #E85D8E;"></i>{{ __('common.payment_unsuccessful') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.failed') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="failed-section pt-100 pb-100" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9">
                <div class="modern-failed-card p-5 border-0 shadow-lg" style="border-radius: 28px; border: 1.5px solid rgba(232, 93, 142, 0.1); background: rgba(255, 255, 255, 0.6); box-shadow: 0 30px 80px rgba(232, 93, 142, 0.2); animation: slideInUp 0.6s ease-out;">
                    <div class="text-center mb-5">
                        <div class="failed-icon-container d-inline-block position-relative mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: linear-gradient(135deg, rgba(232, 93, 142, 0.15) 0%, rgba(200, 107, 250, 0.1) 100%); border: 2px solid rgba(232, 93, 142, 0.2);">
                                <i class="fas fa-times-circle" style="font-size: 60px; color: #E85D8E;"></i>
                            </div>
                        </div>

                        <h2 class="fw-bold mb-2" style="font-size: 32px; letter-spacing: -1px; color: #0a0e27;">{{ __('common.payment_error') }}</h2>
                        <p class="text-muted mb-5" style="font-size: 16px; line-height: 1.6; color: #666;">{{ __('common.payment_failure_message') }}</p>
                    </div>

                    <div class="help-card p-4 rounded-3 mb-5" style="background: rgba(232, 93, 142, 0.08); border-left: 4px solid #E85D8E;">
                        <h6 class="fw-bold mb-3" style="font-size: 14px; color: #E85D8E; text-transform: uppercase; letter-spacing: 0.5px;"><i class="fas fa-lightbulb me-2"></i> {{ __('common.what_you_can_do') }}</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 small d-flex gap-2" style="color: #0a0e27;">
                                <i class="fas fa-check" style="color: #E85D8E; flex-shrink: 0; margin-top: 2px; font-size: 12px;"></i>
                                <span>{{ __('common.check_payment_details') }}</span>
                            </li>
                            <li class="mb-2 small d-flex gap-2" style="color: #0a0e27;">
                                <i class="fas fa-check" style="color: #E85D8E; flex-shrink: 0; margin-top: 2px; font-size: 12px;"></i>
                                <span>{{ __('common.contact_bank') }}</span>
                            </li>
                            <li class="small d-flex gap-2" style="color: #0a0e27;">
                                <i class="fas fa-check" style="color: #E85D8E; flex-shrink: 0; margin-top: 2px; font-size: 12px;"></i>
                                <span>{{ __('common.try_different_payment') }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center mt-5">
                        <a href="{{ route('cart') }}" class="btn rounded-3 px-5 py-3 fw-bold" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            <i class="fas fa-shopping-cart me-2"></i>{{ __('common.cart') }}
                        </a>
                        <a href="{{ route('home') }}" class="btn rounded-3 px-5 py-3 fw-bold" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; border: 2px solid rgba(232, 93, 142, 0.3); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            <i class="fas fa-home me-2"></i>{{ __('common.home') }}
                        </a>
                    </div>

                    <div class="mt-5 pt-4 border-top" style="border-color: rgba(232, 93, 142, 0.1);">
                        <h6 class="fw-bold mb-3" style="font-size: 14px; color: #0a0e27;">{{ __('common.need_assistance') }}</h6>
                        <p class="small text-muted mb-0" style="line-height: 1.6; color: #666;">
                            {{ __('common.reach_out') }}
                            <a href="mailto:{{ __('common.company_email') }}" class="fw-bold" style="color: #E85D8E; text-decoration: none;">{{ __('common.company_email') }}</a>.
                            {{ __('common.we_are_here') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .failed-section {
        background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);
    }

    .modern-failed-card {
        animation: slideInUp 0.6s ease-out;
    }

    .failed-icon-container i {
        animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .help-card {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .help-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(232, 93, 142, 0.15);
        border-left-color: #C86BFA !important;
    }

    .btn {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(232, 93, 142, 0.3);
    }

    @media (max-width: 768px) {
        .failed-section {
            padding-top: 60px !important;
            padding-bottom: 60px !important;
        }

        .modern-failed-card {
            padding: 30px !important;
        }

        .d-flex.flex-md-row {
            flex-direction: column !important;
        }

        .btn {
            width: 100%;
        }
    }
</style>
@endpush

