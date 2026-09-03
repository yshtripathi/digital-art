@extends('frontend.layouts.main')
@section('title', __('inkwave.reg_pg_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.reg_pg_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.reg_pg_title')]
    ]
])



<style>
/* ==========================================================================
   Art Courses — Register Page (Gallery Theme)
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
    max-height: 850px;
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
.ag-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

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
form#frmRegister button[type="submit"].ag-submit-btn {
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
form#frmRegister button[type="submit"].ag-submit-btn:hover {
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
    .ag-grid-2 { grid-template-columns: 1fr; gap: 0; }
}
</style>

<div class="ag-login-page">
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split">
                
                {{-- Image Side --}}
                <div class="ag-split__img">
                    <img src="{{ asset('assets/images/register-bg.webp') }}" alt="Join Artora">
                </div>

                {{-- Form Side --}}
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <span class="ag-eyebrow">{{ __('inkwave.reg_pg_badge') }}</span>
                    <h1 class="ag-title">{{ __('inkwave.reg_pg_title') }}</h1>

                    <form name="frmRegister" id="frmRegister" action="{{ route('register.submit') }}" method="post">
                        @csrf

                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.reg_fld_name') }}</label>
                            <input type="text" name="name" id="name" placeholder="{{ __('inkwave.reg_fld_name') }}" value="{{ old('name') }}" class="ag-input @error('name') is-invalid @enderror">
                            @error('name') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.reg_fld_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('inkwave.reg_fld_email') }}" value="{{ old('email') }}" class="ag-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ag-grid-2">
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.reg_fld_pass') }}</label>
                                <input type="password" name="password" id="password" placeholder="{{ __('inkwave.reg_fld_pass') }}" class="ag-input @error('password') is-invalid @enderror">
                                @error('password') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                            </div>

                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.reg_fld_conf_pass') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('inkwave.reg_fld_conf_pass') }}" class="ag-input @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.reg_fld_sec') }}</label>
                                <div class="ag-captcha-box @error('captcha') is-invalid @enderror">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.reg_sec_ph') }}">
                                    <div class="ag-captcha-box__img">@captcha</div>
                                </div>
                                @error('captcha') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ __('inkwave.reg_val_sec_err') }}</span> @enderror
                            </div>
                        @endif

                        <div style="margin-top: 24px;">
                            <button type="submit" name="submit-form" class="ag-submit-btn">{{ __('inkwave.reg_btn_submit') }}</button>
                        </div>
                    </form>

                    <div class="ag-divider"><span>{{ __('inkwave.reg_or_div') }}</span></div>

                    <p class="ag-alt-action">
                        {{ __('inkwave.reg_existing_user') }}
                        <a href="{{ route('login.form') }}">{{ __('inkwave.reg_sign_in_link') }}</a>
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
        $("#frmRegister").validate({
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
                name: { required: true, minlength: 5 },
                password: { required: true, minlength: 5 },
                password_confirmation: { required: true, minlength: 5, equalTo: "#password" },
                email: { required: true, email: true },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                name: "{{ __('inkwave.reg_req_name') }}",
                password: {
                    required: "{{ __('inkwave.reg_req_pass') }}",
                    minlength: "{{ __('inkwave.reg_min_pass') }}"
                },
                password_confirmation: {
                    required: "{{ __('inkwave.reg_req_conf_pass') }}",
                    minlength: "{{ __('inkwave.reg_min_pass') }}",
                    equalTo: "{{ __('inkwave.reg_match_pass') }}"
                },
                email: "{{ __('inkwave.reg_req_email') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('inkwave.reg_req_sec') }}"
                @endif
            }
        });
    });
</script>
@endpush
