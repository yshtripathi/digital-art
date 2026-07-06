@extends('frontend.layouts.main') 
@section('title','About Us')
@section('main-content')

<x-breadcrumb :title="__('common.about')" />

<section class="about-page-section" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); padding: 6rem 60px !important;">
    <div class="auto-container">
        <div class="row align-items-center g-5">
            <!-- Left: Content -->
            <div class="col-xl-6 col-lg-6">
                <div class="content-wrapper ps-xl-5">
                    <span class="modern-badge" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ __('common.sakura_about_badge') }}</span>

                    <h2 class="modern-h2 mt-4 mb-4" style="font-size: 42px; font-weight: 900; color: #0a0e27; line-height: 1.2;">{{ __('common.sakura_about_title') }}</h2>

                    <p class="text-muted lead mb-5" style="font-size: 16px; color: #666; line-height: 1.8;">
                        {{ __('common.sakura_about_description') }}
                    </p>

                    <!-- Features Grid -->
                    <div class="row g-4">
                        <div class="col-12 rounded-4">
                            <div class="feature-item p-4 rounded-4" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border-radius: 20px;">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-box d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; color: white; font-size: 1.5rem; flex-shrink: 0;">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold" style="color: #0a0e27;">{{ __('common.sakura_why_expert_title') }}</h6>
                                </div>
                                <p class="mb-0 small text-muted">{{ __('common.sakura_why_expert_desc') }}</p>
                            </div>
                        </div>

                        <div class="col-12 rounded-4">
                            <div class="feature-item p-4 rounded-4" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border-radius: 20px;">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-box d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #C86BFA 0%, #E85D8E 100%); border-radius: 16px; color: white; font-size: 1.5rem; flex-shrink: 0;">
                                        <i class="fas fa-palette"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold" style="color: #0a0e27;">{{ __('common.licensing') }}</h6>
                                </div>
                                <p class="mb-0 small text-muted">{{ __('common.licensing_desc') }}</p>
                            </div>
                        </div>

                        <div class="col-12 rounded-4">
                            <div class="feature-item p-4 rounded-4" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border-radius: 20px;">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-box d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; color: white; font-size: 1.5rem; flex-shrink: 0;">
                                        <i class="fas fa-laptop-code"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold" style="color: #0a0e27;">{{ __('common.sakura_why_industry_title') }}</h6>
                                </div>
                                <p class="mb-0 small text-muted">{{ __('common.sakura_why_industry_desc') }}</p>
                            </div>
                        </div>

                        <div class="col-12 rounded-4">
                            <div class="feature-item p-4 rounded-4" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border-radius: 20px;">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="icon-box d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #C86BFA 0%, #E85D8E 100%); border-radius: 16px; color: white; font-size: 1.5rem; flex-shrink: 0;">
                                        <i class="fas fa-crown"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold" style="color: #0a0e27;">{{ __('common.sakura_why_projects_title') }}</h6>
                                </div>
                                <p class="mb-0 small text-muted">{{ __('common.sakura_why_projects_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="mt-5">
                        <a href="{{route('product-lists')}}" class="btn-sakura" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 16px; padding: 14px 32px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 4px 15px rgba(232, 93, 142, 0.3);">
                            <i class="fas fa-arrow-right"></i>
                            {{ __('common.discover_more') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Image -->
            <div class="col-xl-6 col-lg-6">
                <div class="image-wrapper" style="position: relative;">
                    <div style="position: absolute; top: -20px; right: -20px; width: 150px; height: 150px; background: radial-gradient(circle, rgba(232, 93, 142, 0.1) 0%, transparent 70%); border-radius: 50%; z-index: 0;"></div>
                    <div style="position: absolute; bottom: -30px; left: -30px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(200, 107, 250, 0.08) 0%, transparent 70%); border-radius: 50%; z-index: 0;"></div>
                    <img src="{{ asset('assets/images/i-3.webp') }}" alt="About Us" class="w-100 rounded-4" style="position: relative; z-index: 1; box-shadow: 0 20px 60px rgba(232, 93, 142, 0.2); transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border-radius: 20px;">
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .feature-item {
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .feature-item:hover {
        transform: translateY(-8px);
        background: rgba(255, 255, 255, 0.8) !important;
        border-color: rgba(232, 93, 142, 0.25) !important;
        box-shadow: 0 15px 40px rgba(232, 93, 142, 0.15);
    }

    .image-wrapper img:hover {
        transform: scale(1.02);
    }

    @media (max-width: 768px) {
        .modern-h2 {
            font-size: 32px !important;
        }

        .feature-item {
            margin-bottom: 10px;
        }
    }
</style>
@endpush

@endsection


