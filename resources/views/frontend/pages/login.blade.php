@extends('frontend.layouts.main')
@section('title','Login')
@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.login') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.login') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="auth-section" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); padding: 6rem 60px !important;">
    <div class="auto-container">
        <div class="row align-items-center g-5" style="max-width: 500px; margin-left: auto; margin-right: auto;">
            <div class="col-12">
                <div class="auth-card border-0 shadow-xl overflow-hidden" style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(20px); border-radius: 20px; border: 1px solid rgba(232, 93, 142, 0.1);">
                    <!-- Header Section -->
                    <div class="auth-card-header p-5 text-center" style="border-bottom: 1px solid rgba(232, 93, 142, 0.1);">
                        <div class="mb-3 d-flex justify-content-center">
                            <div class="icon-box d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; color: white; font-size: 1.8rem;">
                                <i class="fas fa-palette"></i>
                            </div>
                        </div>
                        <span class="modern-badge" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ __('common.login_badge') }}</span>
                         </div>

                    <!-- Content Section -->
                    <div class="p-5">
                        <form name="frmLogin" id="frmLogin" action="{{route('login.submit')}}" method="post">
                            @csrf

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center" style="color: #0a0e27;">
                                    <i class="fas fa-envelope me-2" style="font-size: 12px; color: #E85D8E;"></i>
                                    {{ __('common.email') }}
                                </label>
                                <input type="email" name="email" id="email" placeholder="{{ __('common.email') }}" value="{{old('email')}}" class="form-control form-control-lg bg-white border-1 py-3 px-4 rounded-3 @error('email') is-invalid @enderror" style="border-color: rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                @error('email')
                                    <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="mb-2">
                                <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center" style="color: #0a0e27;">
                                    <i class="fas fa-lock me-2" style="font-size: 12px; color: #E85D8E;"></i>
                                    {{ __('common.password') }}
                                </label>
                                <input type="password" name="password" id="password" placeholder="{{ __('common.password') }}" class="form-control form-control-lg bg-white border-1 py-3 px-4 rounded-3 @error('password') is-invalid @enderror" style="border-color: rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                @error('password')
                                    <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                @enderror
                            </div>

                            <!-- Forgot Password Link -->
                            <div class="text-end mb-4">
                                <a href="{{route('forgetpwd.form')}}" class="small fw-bold text-decoration-none hover-underline" style="color: #E85D8E;">{{ __('common.lost_password_text') }}</a>
                            </div>

                            <!-- Login Button -->
                            <div class="mt-5">
                                <button class="btn-sakura w-100 py-3 fw-bold rounded-3" type="submit" name="submit-form" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 16px; padding: 14px 32px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 4px 15px rgba(232, 93, 142, 0.3); font-size: 15px; letter-spacing: 0.5px;">
                                    <i class="fas fa-sign-in-alt"></i> {{ __('common.login') }}
                                </button>
                            </div>
                        </form>

                        <!-- Divider -->
                        <div class="my-4 d-flex align-items-center">
                            <div style="flex: 1; height: 1px; background: rgba(232, 93, 142, 0.1);"></div>
                            <span class="mx-3 small text-muted">{{ __('common.or') }}</span>
                            <div style="flex: 1; height: 1px; background: rgba(232, 93, 142, 0.1);"></div>
                        </div>

                        <!-- Sign Up Link -->
                        <div class="text-center">
                            <p class="mb-0" style="font-size: 14px; color: #666;">
                                {{ __('common.login_new_user') }}
                                <a href="{{route('register.form')}}" class="fw-bold text-decoration-none hover-underline" style="color: #E85D8E; transition: all 0.3s ease;">{{ __('common.login_create_profile') }}</a>
                            </p>
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
    .auth-card {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        animation: slideInUp 0.6s ease-out;
    }

    .auth-card:hover {
        transform: translateY(-8px);
        background: rgba(255, 255, 255, 0.8) !important;
        border-color: rgba(232, 93, 142, 0.25) !important;
        box-shadow: 0 15px 40px rgba(232, 93, 142, 0.15);
    }

    .form-control {
        font-size: 15px;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        border: 1px solid rgba(232, 93, 142, 0.2) !important;
    }

    .form-control:focus {
        background-color: white !important;
        border-color: #E85D8E !important;
        box-shadow: 0 0 0 4px rgba(232, 93, 142, 0.15) !important;
    }

    .form-control::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }

    .form-control-lg {
        border-radius: 16px;
    }

    .error {
        color: #dc3545 !important;
        font-size: 13px;
        margin-top: 5px;
        font-weight: 500;
    }

    .hover-underline:hover {
        text-decoration: underline !important;
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

    .alert {
        border-radius: 16px;
        padding: 15px 20px;
        font-weight: 500;
    }

    .alert-success {
        background-color: rgba(232, 93, 142, 0.1) !important;
        border-color: rgba(232, 93, 142, 0.3) !important;
        color: #E85D8E !important;
    }

    .alert-danger {
        background-color: rgba(239, 68, 68, 0.1) !important;
        border-color: rgba(239, 68, 68, 0.3) !important;
        color: #dc3545 !important;
    }

    @media (max-width: 768px) {
        .auth-section {
            padding: 4rem 2rem !important;
        }
    }

    @media (max-width: 480px) {
        .auth-section {
            padding: 3rem 1rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmLogin").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                password: {
                    required: "{{ __('common.password_required') }}",
                    minlength: "{{ __('common.password_confirmation_min') }}"
                },
                email: "{{ __('common.email_required') }}"
            }
        });
    });
</script>
@endpush


