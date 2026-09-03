@extends('frontend.layouts.main')
@section('title', __('inkwave.login_pg_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.login_pg_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.login_pg_title')]
    ]
])



<style>
/* ==========================================================================
   Art Courses — Login Page (Gallery Theme)
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
.ag-input.is-invalid {
    border-color: #d93025 !important;
}

.ag-form-extras {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 32px;
}
.ag-form-extras a {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    color: #555555;
    text-decoration: none;
    transition: color 0.3s ease;
}
.ag-form-extras a:hover {
    color: #bc9c5c;
}

.ag-checkbox-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    color: #555555;
    user-select: none;
}
.ag-checkbox-wrap input {
    display: none;
}
.ag-checkbox-mark {
    width: 16px;
    height: 16px;
    border: 1px solid #cccccc;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    background: transparent;
}
.ag-checkbox-wrap input:checked ~ .ag-checkbox-mark {
    background-color: #000000;
    border-color: #000000;
}
.ag-checkbox-wrap input:checked ~ .ag-checkbox-mark::after {
    content: '\2713';
    color: #ffffff;
    font-size: 12px;
}
.ag-checkbox-wrap:hover .ag-checkbox-mark {
    border-color: #bc9c5c;
}

/* Custom Submit Button Styling */
form#frmLogin button[type="submit"].ag-submit-btn {
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
form#frmLogin button[type="submit"].ag-submit-btn:hover {
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
                    <img src="{{ asset('assets/images/login-bg.webp') }}" alt="Login to Artora">
                </div>

                {{-- Form Side --}}
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <span class="ag-eyebrow">{{ __('inkwave.login_pg_badge') }}</span>
                    <h1 class="ag-title">{{ __('inkwave.login_pg_title') }}</h1>

                    <form name="frmLogin" id="frmLogin" action="{{ route('login.submit') }}" method="post">
                        @csrf

                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.login_fld_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('inkwave.login_fld_email') }}" value="{{ old('email') }}" class="ag-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.login_fld_pass') }}</label>
                            <input type="password" name="password" id="password" placeholder="{{ __('inkwave.login_fld_pass') }}" class="ag-input @error('password') is-invalid @enderror">
                            @error('password') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ag-form-extras">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="ag-checkbox-mark"></span>
                                <span class="ag-checkbox-text">Remember Me</span>
                            </label>
                            <a href="{{ route('forgetpwd.form') }}">{{ __('inkwave.login_lost_pwd') }}</a>
                        </div>

                        <div>
                            <button type="submit" name="submit-form" class="ag-submit-btn">{{ __('inkwave.login_btn_submit') }}</button>
                        </div>
                    </form>

                    <div class="ag-divider"><span>{{ __('inkwave.login_or_div') }}</span></div>

                    <p class="ag-alt-action">
                        {{ __('inkwave.login_new_user') }}
                        <a href="{{ route('register.form') }}">{{ __('inkwave.login_create_link') }}</a>
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
        $("#frmLogin").validate({
            errorElement: 'span',
            errorClass: 'ag-error-msg',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle"></i> ');
                error.appendTo(element.closest('.ag-field'));
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            rules: {
                password: { required: true, minlength: 5 },
                email: { required: true, email: true }
            },
            messages: {
                password: {
                    required: "{{ __('inkwave.login_req_pass') }}",
                    minlength: "{{ __('inkwave.login_min_pass') }}"
                },
                email: "{{ __('inkwave.login_req_email') }}"
            }
        });
    });
</script>
@endpush
