@extends('frontend.layouts.main')
@section('title', __('inkwave.pwd_forgot_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.pwd_forgot_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.pwd_forgot_title')]
    ]
])



<style>
/* ==========================================================================
   Art Courses — Forgot Password Page (Gallery Theme)
   ========================================================================== */

/* Reusable Layout Wrappers */
.ag-section {
    padding: 40px 40px;
}

/* Colored Text Blocks */
.ag-text-block {
    padding: 64px 80px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.05);
}
.ag-bg-bone {
    background-color: #f5f5f5;
}

.ag-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 5%;
}

/* Split Layout */
.ag-split {
    display: flex;
    align-items: center;
    gap: 80px;
}
.ag-split__img {
    flex: 1;
    position: relative;
}
.ag-split__img::after {
    content: '';
    position: absolute;
    top: 24px;
    left: 24px;
    right: -24px;
    bottom: -24px;
    border: 1px solid #bc9c5c;
    z-index: 0;
}
.ag-split__img img {
    width: 100%;
    max-height: 700px;
    object-fit: cover;
    display: block;
    position: relative;
    z-index: 1;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}
.ag-split__content {
    flex: 1.2;
}

/* Typography */
.ag-eyebrow {
    font-family: var(--font-arial, Arial, sans-serif) !important;
    font-size: 13px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.2em !important;
    color: #bc9c5c !important;
    margin-bottom: 12px !important;
    display: block;
}
.ag-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 48px !important;
    color: #000000 !important;
    margin-bottom: 32px !important;
    line-height: 1.2 !important;
    letter-spacing: 0.02em !important;
}

/* Form styling */
.ag-field {
    margin-bottom: 24px;
    position: relative;
}
.ag-label {
    display: block;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #000000;
    margin-bottom: 12px;
    font-weight: bold;
}
.ag-input {
    width: 100%;
    border: 1px solid rgba(0,0,0,0.15);
    background: transparent;
    padding: 18px 24px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px;
    color: #000000;
    border-radius: 0;
    transition: all 0.3s ease;
}
.ag-input:focus {
    outline: none;
    border-color: #bc9c5c;
    box-shadow: inset 0 0 0 1px #bc9c5c;
}
.ag-input::placeholder {
    color: #aaaaaa;
}
.ag-error-msg {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #d93025;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    margin-top: 8px;
}
.ag-input.is-invalid, .ag-captcha-box.is-invalid {
    border-color: #d93025 !important;
}

/* Captcha styling */
.ag-captcha-box {
    display: flex;
    align-items: center;
    gap: 16px;
    border: 1px solid rgba(0,0,0,0.15);
    background: transparent;
    padding: 8px 16px;
}
.ag-captcha-box input {
    border: none;
    background: transparent;
    flex: 1;
    padding: 10px 8px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px;
    color: #000;
}
.ag-captcha-box input:focus {
    outline: none;
}
.ag-captcha-box__img img {
    height: 40px;
    display: block;
}

/* Custom Submit Button Styling */
form#frmForgot button[type="submit"].ag-submit-btn {
    background: #000000 !important;
    color: #ffffff !important;
    border: 1px solid #000000 !important;
    font-family: Arial, sans-serif !important;
    font-size: 13px !important;
    font-weight: bold !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    padding: 16px 24px !important;
    white-space: nowrap !important;
    display: inline-block !important;
    text-align: center !important;
    border-radius: 0 !important;
    outline: none !important;
    box-shadow: none !important;
    width: 100%;
}
form#frmForgot button[type="submit"].ag-submit-btn:hover {
    background: #ffffff !important;
    color: #000000 !important;
    border-bottom-color: #000000 !important;
}

.ag-divider {
    text-align: center;
    margin: 40px 0;
    position: relative;
}
.ag-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: rgba(0,0,0,0.1);
    z-index: 1;
}
.ag-divider span {
    position: relative;
    z-index: 2;
    background: #f5f5f5; /* matches bone */
    padding: 0 16px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    color: #888888;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.ag-alt-action {
    text-align: center;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    color: #555555;
}
.ag-alt-action a {
    color: #000000;
    font-weight: bold;
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: all 0.3s ease;
    margin-left: 8px;
}
.ag-alt-action a:hover {
    color: #bc9c5c;
    border-bottom-color: #bc9c5c;
}

@media (max-width: 992px) {
    .ag-split { flex-direction: column; gap: 64px; }
    .ag-title { font-size: 36px !important; }
    .ag-text-block { padding: 40px 24px; }
}
</style>

<div class="ag-login-page">
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split">
                
                {{-- Image Side --}}
                <div class="ag-split__img">
                    <img src="{{ asset('assets/images/sqlx_1f3x_230126.jpg') }}" alt="Recover Password">
                </div>

                {{-- Form Side --}}
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <span class="ag-eyebrow">{{ __('inkwave.pwd_forgot_badge') }}</span>
                    <h1 class="ag-title">{{ __('inkwave.pwd_forgot_title') }}</h1>

                    <form name="frmForgot" id="frmForgot" action="{{ route('password.email') }}" method="post">
                        @csrf

                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.pwd_fld_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('inkwave.pwd_fld_email') }}" value="{{ old('email') }}" class="ag-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.pwd_fld_sec') }}</label>
                                <div class="ag-captcha-box @error('captcha') is-invalid @enderror">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.pwd_sec_ph') }}">
                                    <div class="ag-captcha-box__img">@captcha</div>
                                </div>
                                @error('captcha') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ __('inkwave.pwd_val_sec_err') }}</span> @enderror
                            </div>
                        @endif

                        <div style="margin-top: 40px;">
                            <button type="submit" name="submit-form" class="ag-submit-btn">{{ __('inkwave.pwd_btn_submit') }}</button>
                        </div>
                    </form>

                    <div class="ag-divider"><span>{{ __('inkwave.pwd_or_divider') }}</span></div>

                    <p class="ag-alt-action">
                        {{ __('inkwave.pwd_remember_prompt') }}
                        <a href="{{ route('login.form') }}">{{ __('inkwave.pwd_sign_in_link') }}</a>
                    </p>
                    
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmForgot").validate({
            errorElement: 'span',
            errorClass: 'ag-error-msg',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle"></i> ');
                error.appendTo(element.closest('.ag-field'));
            },
            highlight: function(element, errorClass, validClass) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.ag-captcha-box').addClass('is-invalid');
                } else {
                    $(element).addClass('is-invalid');
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.ag-captcha-box').removeClass('is-invalid');
                } else {
                    $(element).removeClass('is-invalid');
                }
            },
            rules: {
                email: { required: true, email: true },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                email: "{{ __('inkwave.pwd_req_email') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('inkwave.pwd_req_sec') }}"
                @endif
            }
        });
    });
</script>
@endpush
