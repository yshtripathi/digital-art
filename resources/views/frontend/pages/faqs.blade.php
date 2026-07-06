@extends('frontend.layouts.main')
@section('main-content')

<div class="tl-breadcrumb about-banner pt-120 pb-120">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.faqs') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.faqs') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="faq-section pt-120 pb-120 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div id="accordion" class="accordion-wrapper">
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseOne">
                                    <span>1. {{ __('common.faq_q1') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a1') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseTwo">
                                    <span>2. {{ __('common.faq_q2') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a2') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseThree">
                                    <span>3. {{ __('common.faq_q3') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a3') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseFour">
                                    <span>4. {{ __('common.faq_q4') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a4') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseFive">
                                    <span>5. {{ __('common.faq_q5') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a5') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseSix">
                                    <span>6. {{ __('common.faq_q6') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a6') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseSeven">
                                    <span>7. {{ __('common.faq_q7') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a7') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseEight">
                                    <span>8. {{ __('common.faq_q8') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseEight" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a8') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseNine">
                                    <span>9. {{ __('common.faq_q9') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseNine" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a9') }}
                            </div>
                        </div>
                    </div>
                    <div class="modern-card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="accordion-header p-4 bg-white">
                            <h2 class="accordion-title mb-0">
                                <a class="accordion-link fw-bold text-dark text-decoration-none d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapseTen">
                                    <span>10. {{ __('common.faq_q10') }}</span>
                                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseTen" class="collapse" data-parent="#accordion">
                            <div class="accordion-body p-4 border-top text-muted">
                                {{ __('common.faq_a10') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

