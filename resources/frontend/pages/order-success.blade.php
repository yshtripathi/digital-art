@extends('frontend.layouts.main')
@section('main-content')

<div class="tl-breadcrumb pt-60 pb-60">
    <!-- Video Background -->
    <video autoplay muted loop playsinline>
        <source src="{{ asset('images/breadcrumb.mp4') }}" type="video/mp4">
    </video>
    <!-- Animated bubble elements -->
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>

    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt">
                    <h1 class="tl-breadcrumb-title">{{ __('common.order_successful') }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.order_successful') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="cls-order section-space" style="position: relative; overflow: hidden;">
    <!-- Decorative Blobs -->
    <div class="modern-blob modern-blob-1" style="top: -100px; left: -100px; width: 400px; height: 400px; background: rgba(75, 184, 250, 0.08);"></div>
    <div class="modern-blob modern-blob-2" style="bottom: -100px; right: -100px; width: 400px; height: 400px; background: rgba(21, 145, 220, 0.08);"></div>

    <div class="container position-relative py-8 py-lg-9">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="modern-card shadow-xl overflow-hidden" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-radius: 20px; border: 1px solid rgba(0, 0, 0, 0.05);">
                    <!-- Success Header -->
                    <div class="p-5 text-center" style="background: linear-gradient(135deg, rgba(75, 184, 250, 0.1) 0%, rgba(21, 145, 220, 0.05) 100%); border-bottom: 1px solid rgba(21, 145, 220, 0.1);">
                        <div class="mb-4">
                            <div style="width: 80px; height: 80px; margin: 0 auto; border-radius: 50%; background: rgba(75, 184, 250, 0.2); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                            </div>
                        </div>
                        <h2 class="text-success fw-bold mb-2" style="font-size: 28px;">{{ __('common.order_successful') }}</h2>
                        <p class="text-muted mb-0">{{ __('common.thank_you_order') }}</p>
                    </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <!-- Invoice Details -->
                        <div class="mb-5 p-4 rounded-3" style="background: rgba(21, 145, 220, 0.05); border-left: 4px solid var(--primary);">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="text-muted small mb-1">{{ __('common.invoice_number') }}</p>
                                    <h4 class="fw-bold mb-0" style="color: var(--primary);">{{ $transaction_id }}</h4>
                                </div>
                                <i class="fas fa-file-invoice-dollar text-primary" style="font-size: 32px; opacity: 0.3;"></i>
                            </div>
                        </div>

                        <!-- Confirmation Message -->
                        <div class="mb-5">
                            <h5 class="fw-bold mb-3" style="color: var(--text-dark);">{{ __('common.order_confirmation') }}</h5>
                            <p class="text-muted mb-3">{{ __('common.order_confirmation') }} <strong class="text-dark">{{ $transaction_id }}</strong></p>
                            <p class="text-muted">{{ __('common.team_contact') }}</p>
                        </div>

                        <!-- Divider -->
                        <div class="my-4 d-flex align-items-center">
                            <div style="flex: 1; height: 1px; background: rgba(0, 0, 0, 0.1);"></div>
                        </div>

                        <!-- Support Info -->
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3" style="color: var(--text-dark);">{{ __('common.need_assistance') }}</h5>
                            <p class="text-muted">{{ __('common.reach_out_for_help') }} <a href="mailto:{{ $misc['Company Email'] ?? __('common.company_email') }}" class="text-primary fw-bold text-decoration-none">{{ $misc['Company Email'] ?? __('common.company_email') }}</a>.</p>
                        </div>

                        <!-- What's Next -->
                        <div class="p-4 rounded-3 mb-5" style="background: rgba(75, 184, 250, 0.05); border: 1px solid rgba(75, 184, 250, 0.15);">
                            <h6 class="fw-bold mb-3 text-dark">What's Next?</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2 d-flex align-items-start">
                                    <span class="badge bg-primary rounded-circle me-2" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px;">1</span>
                                    <span class="text-muted">Your points have been credited</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <span class="badge bg-primary rounded-circle me-2" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px;">2</span>
                                    <span class="text-muted">You can access premium content immediately</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <span class="badge bg-primary rounded-circle me-2" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-size: 12px;">3</span>
                                    <span class="text-muted">Check your email for receipt and details</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-3">
                            <a href="{{ route('home') }}" class="modern-btn modern-btn-solid w-100 py-3 fw-bold shadow-lg rounded-3" style="font-size: 15px; letter-spacing: 0.5px; text-decoration: none;">
                                <i class="fas fa-home me-2"></i>{{ __('common.return_home') }}
                            </a>
                            <a href="{{ route('account') }}" class="modern-btn modern-btn-outline w-100 py-3 fw-bold rounded-3" style="font-size: 15px; letter-spacing: 0.5px; text-decoration: none; border: 2px solid rgba(21, 145, 220, 0.3); color: var(--primary);">
                                <i class="fas fa-user-circle me-2"></i>{{ __('common.view_account') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .modern-card {
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        animation: slideInUp 0.6s ease-out;
    }

    .modern-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(21, 145, 220, 0.15) !important;
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

    .modern-blob {
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        animation: blob-animation 7s infinite;
    }

    @keyframes blob-animation {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }
</style>
@endpush