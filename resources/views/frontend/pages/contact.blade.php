@extends('frontend.layouts.main')
@section('title','Contact Us')
@section('main-content')

<div class="tl-breadcrumb contact-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.contact') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.contact') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="contact-section" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); padding: 6rem 60px !important;">
    <div class="auto-container">
        <!-- Company Details Section - Top -->
        <div class="row align-items-center g-5 mb-5" style="text-align: center;">
            <div class="col-12">
                <span class="modern-badge" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ __('common.get_in_touch') }}</span>
                <h2 class="modern-h2 mt-4 mb-5" style="font-size: 42px; font-weight: 900; color: #0a0e27; line-height: 1.2;">{{ __('common.contact_header') }}</h2>
            </div>
        </div>

        <!-- Contact Info Cards -->
        <div class="row g-4 mb-5" style="max-width: 1000px; margin-left: auto; margin-right: auto;">
            <div class="col-md-4 rounded-4">
                <div class="contact-info-card p-4 rounded-4" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border-radius: 20px;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-box d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; color: white; font-size: 1.5rem; flex-shrink: 0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: #0a0e27;">{{ __('common.email') }}</h6>
                        </div>
                    </div>
                    <a href="mailto:{{ $misc['Company Email'] ?? __('common.company_email') }}" class="text-muted text-decoration-none small">{{ $misc['Company Email'] ?? __('common.company_email') }}</a>
                </div>
            </div>

            <div class="col-md-4 rounded-4">
                <div class="contact-info-card p-4 rounded-4" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border-radius: 20px;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-box d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #C86BFA 0%, #E85D8E 100%); border-radius: 16px; color: white; font-size: 1.5rem; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: #0a0e27;">{{ __('common.our_location') }}</h6>
                        </div>
                    </div>
                    <span class="text-muted small">{{ $misc['Company Address'] ?? __('common.company_Address') }}</span>
                </div>
            </div>

            <div class="col-md-4 rounded-4">
                <div class="contact-info-card p-4 rounded-4" style="background: rgba(255, 255, 255, 0.6); border: 1px solid rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); border-radius: 20px;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="icon-box d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); border-radius: 16px; color: white; font-size: 1.5rem; flex-shrink: 0;">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: #0a0e27;">{{ __('common.company') }}</h6>
                        </div>
                    </div>
                    <span class="text-muted small">{{ $misc['Company Name'] ?? __('common.company_name') }}</span>
                </div>
            </div>
        </div>

        <!-- Contact Form Section -->
        <div class="row align-items-center g-5" style="max-width: 700px; margin-left: auto; margin-right: auto;">
            <div class="col-12">
                <div class="contact-card border-0 shadow-xl overflow-hidden" style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(20px); border-radius: 20px; border: 1px solid rgba(232, 93, 142, 0.1);">
                    <div class="p-5">
                        <div class="mb-5">
                            <span class="modern-badge" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.08); padding: 8px 14px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">{{ __('common.contact') }}</span>
                            <h3 class="modern-h2 mt-3 mb-0" style="font-size: 32px; font-weight: 900; color: #0a0e27;">{{ __('common.send_message') }}</h3>
                        </div>

                        <form method="POST" action="{{ route('contact.send') }}" id="contactform" onsubmit="return handleSubmit(event)">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center" style="color: #0a0e27;">
                                        <i class="fas fa-user me-2" style="font-size: 12px; color: #E85D8E;"></i>
                                        {{ __('common.name') }}
                                    </label>
                                    <input type="text" name="name" id="name" placeholder="{{ __('common.enter_name') }}" class="form-control form-control-lg bg-white border-1 py-3 px-4 rounded-3 @error('name') is-invalid @enderror" style="border-color: rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                    @error('name')
                                        <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center" style="color: #0a0e27;">
                                        <i class="fas fa-envelope me-2" style="font-size: 12px; color: #E85D8E;"></i>
                                        {{ __('common.email') }}
                                    </label>
                                    <input type="email" name="email" id="email" placeholder="{{ __('common.enter_email') }}" class="form-control form-control-lg bg-white border-1 py-3 px-4 rounded-3 @error('email') is-invalid @enderror" style="border-color: rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                    @error('email')
                                        <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center" style="color: #0a0e27;">
                                        <i class="fas fa-phone me-2" style="font-size: 12px; color: #E85D8E;"></i>
                                        {{ __('common.phone') }}
                                    </label>
                                    <input type="text" name="phone" id="phone" placeholder="{{ __('common.phone') }}" class="form-control form-control-lg bg-white border-1 py-3 px-4 rounded-3 @error('phone') is-invalid @enderror" style="border-color: rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    @error('phone')
                                        <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center" style="color: #0a0e27;">
                                        <i class="fas fa-tag me-2" style="font-size: 12px; color: #E85D8E;"></i>
                                        {{ __('common.your_subject') }}
                                    </label>
                                    <input type="text" name="subject" id="subject" placeholder="{{ __('common.enter_subject') }}" class="form-control form-control-lg bg-white border-1 py-3 px-4 rounded-3" style="border-color: rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                </div>

                                <div class="col-12">
                                    <label class="small fw-bold text-uppercase opacity-75 mb-2 d-flex align-items-center" style="color: #0a0e27;">
                                        <i class="fas fa-message me-2" style="font-size: 12px; color: #E85D8E;"></i>
                                        {{ __('common.your_message') }}
                                    </label>
                                    <textarea name="message" id="message" rows="4" placeholder="{{ __('common.enter_message') }}" class="form-control form-control-lg bg-white border-1 py-3 px-4 rounded-3" style="border-color: rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);"></textarea>
                                </div>

                                @if(env('CAPTCHA_ENABLED', true))
                                    <div class="col-12 pt-3">
                                        <label class="small fw-bold text-uppercase opacity-75 mb-2 d-block" style="color: #0a0e27;">{{ __('common.security_verification') }}</label>
                                        <div class="row align-items-center g-3">
                                            <div class="col-md-8">
                                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="form-control form-control-lg bg-white border-1 py-3 px-4 rounded-3" placeholder="{{ __('common.fill_captcha') }}" style="border-color: rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                            </div>
                                            <div class="col-md-4 cpatcha-imgs text-center">
                                                @captcha
                                            </div>
                                        </div>
                                        @error('captcha')
                                            <span class="text-danger small mt-2 d-block"><i class="fas fa-info-circle me-1"></i>{{ __('common.captcha_error') }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn-sakura w-100 py-3 fw-bold rounded-3" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 16px; padding: 14px 32px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); box-shadow: 0 4px 15px rgba(232, 93, 142, 0.3); font-size: 15px; letter-spacing: 0.5px;">
                                        <i class="fas fa-paper-plane"></i> {{ __('common.send_message') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .contact-card {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .contact-card:hover {
        transform: translateY(-8px);
        background: rgba(255, 255, 255, 0.8) !important;
        border-color: rgba(232, 93, 142, 0.25) !important;
        box-shadow: 0 15px 40px rgba(232, 93, 142, 0.15);
    }

    .contact-info-card {
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .contact-info-card:hover {
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

    .cpatcha-imgs img {
        border-radius: 16px;
        border: 1px solid rgba(232, 93, 142, 0.2);
    }

    @media (max-width: 768px) {
        .contact-section {
            padding: 4rem 2rem !important;
        }
    }

    @media (max-width: 480px) {
        .contact-section {
            padding: 3rem 1rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function handleSubmit(event) {
        event.preventDefault();

        // Get form values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();

        // Clear previous error messages
        document.querySelectorAll('.custom-error-message').forEach(el => el.remove());
        document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));

        let hasErrors = false;
        const errors = [];

        // Validation checks
        if (!name) {
            errors.push({ field: 'name', message: '{{ __('common.validate_name') }}' });
            hasErrors = true;
        }

        if (!email) {
            errors.push({ field: 'email', message: '{{ __('common.validate_email') }}' });
            hasErrors = true;
        } else if (!isValidEmail(email)) {
            errors.push({ field: 'email', message: '{{ __('common.validate_email_invalid') }}' });
            hasErrors = true;
        }

        if (!phone) {
            errors.push({ field: 'phone', message: '{{ __('common.validate_phone') }}' });
            hasErrors = true;
        }

        if (!subject) {
            errors.push({ field: 'subject', message: '{{ __('common.validate_subject') }}' });
            hasErrors = true;
        }

        if (!message) {
            errors.push({ field: 'message', message: '{{ __('common.validate_message') }}' });
            hasErrors = true;
        }

        // Show error messages
        if (hasErrors) {
            errors.forEach(error => {
                const field = document.getElementById(error.field);
                if (field) {
                    field.classList.add('is-invalid');
                    const errorDiv = document.createElement('span');
                    errorDiv.className = 'text-danger small mt-2 d-block custom-error-message';
                    errorDiv.innerHTML = `<i class="fas fa-info-circle me-1"></i>${error.message}`;
                    field.parentElement.appendChild(errorDiv);
                }
            });
            return false;
        }

        // If no errors, submit the form
        document.getElementById('contactform').submit();
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Add real-time validation
    document.getElementById('name')?.addEventListener('change', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
    });

    document.getElementById('email')?.addEventListener('change', function() {
        const isValid = this.value.trim() && isValidEmail(this.value.trim());
        this.classList.toggle('is-invalid', !isValid);
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && isValid) errorMsg.remove();
    });

    document.getElementById('phone')?.addEventListener('change', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
    });

    document.getElementById('subject')?.addEventListener('change', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
    });

    document.getElementById('message')?.addEventListener('change', function() {
        this.classList.toggle('is-invalid', !this.value.trim());
        const errorMsg = this.parentElement.querySelector('.custom-error-message');
        if (errorMsg && this.value.trim()) errorMsg.remove();
    });
</script>
@endpush

