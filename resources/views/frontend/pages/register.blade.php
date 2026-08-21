@extends('frontend.layouts.main')
@section('title', __('inkwave.register_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.register_title'),
    'links' => [
        ['name' => __('inkwave.menu_home'), 'url' => route('home')],
        ['name' => __('inkwave.register_title')]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme Auth Forms
------------------------------------------- */
.duo-auth-wrapper {
    background-color: var(--color-paper-white, #ffffff);
    padding-bottom: 100px;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
}
.duo-container {
    max-width: 600px;
    margin: 64px auto;
    padding: 0 24px;
}
.duo-auth-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    padding: 48px;
    box-shadow: 0 12px 0 #e5e5e5;
    width: 100%;
}
.duo-form-head {
    text-align: center;
    margin-bottom: 32px;
}
.duo-eyebrow {
    font-size: 15px;
    font-weight: 700;
    color: var(--color-spark-blue, #1cb0f6);
    text-transform: uppercase;
    letter-spacing: 0.053em;
    margin-bottom: 8px;
}
.duo-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin: 0;
}
.duo-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 24px;
}
.duo-row {
    display: flex;
    gap: 24px;
}
.duo-row .duo-field {
    flex: 1;
}
@media (max-width: 600px) {
    .duo-row { flex-direction: column; gap: 0; }
}
.duo-label {
    font-size: 15px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    text-transform: uppercase;
    letter-spacing: 0.053em;
    display: flex;
    align-items: center;
    gap: 8px;
}
.duo-label i {
    color: var(--color-pencil-gray, #777777);
}
.duo-input {
    background: #f7f7f7;
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    padding: 16px;
    font-size: 17px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    outline: none;
    transition: border-color 0.1s, background 0.1s;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    width: 100%;
}
.duo-input::placeholder {
    color: var(--color-pencil-gray, #777777);
    font-weight: 500;
}
.duo-input:focus {
    border-color: var(--color-spark-blue, #1cb0f6);
    background: #ffffff;
}
.duo-input.is-invalid, .duo-captcha-box.is-invalid {
    border-color: #ff4b4b !important;
    background: #fff5f5 !important;
}
.duo-error {
    color: #ff4b4b;
    font-size: 15px;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 4px;
}
.duo-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    background: var(--color-eager-green, #58cc02);
    color: #ffffff;
    border: 2px solid #46a302;
    border-radius: 16px;
    padding: 20px;
    font-size: 19px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.053em;
    box-shadow: 0 6px 0 #46a302;
    cursor: pointer;
    transition: all 0.1s;
    margin-top: 16px;
}
.duo-submit:hover {
    filter: brightness(1.05);
}
.duo-submit:active {
    transform: translateY(6px);
    box-shadow: 0 0 0 #46a302;
}
.duo-captcha-box {
    display: flex;
    gap: 16px;
    align-items: center;
    background: #f7f7f7;
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    padding: 8px;
}
.duo-captcha-box input {
    flex: 1;
    border: none;
    background: transparent;
    padding: 8px 16px;
    font-size: 17px;
    font-weight: 700;
    outline: none;
    color: var(--color-charcoal, #4b4b4b);
}
.duo-captcha-box__img {
    border-radius: 8px;
    overflow: hidden;
}
.duo-divider {
    text-align: center;
    margin: 32px 0;
    position: relative;
}
.duo-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background: #e5e5e5;
    z-index: 1;
}
.duo-divider span {
    background: #ffffff;
    padding: 0 16px;
    color: var(--color-pencil-gray);
    font-size: 15px;
    font-weight: 700;
    position: relative;
    z-index: 2;
    text-transform: uppercase;
}
.duo-alt {
    text-align: center;
    font-size: 17px;
    font-weight: 700;
    color: var(--color-charcoal);
    margin: 0;
}
.duo-alt a {
    color: var(--color-spark-blue);
    text-decoration: none;
    margin-left: 8px;
}
.duo-alt a:hover {
    text-decoration: underline;
}
@media (max-width: 600px) {
    .duo-auth-card { padding: 32px 24px; }
}
</style>

<div class="duo-auth-wrapper">
    <div class="duo-container">
        <div class="duo-auth-card">
            <div class="duo-form-head">
                <p class="duo-eyebrow">{{ __('inkwave.register_badge') }}</p>
                <h1 class="duo-title">{{ __('inkwave.register_title') }}</h1>
            </div>

            <form name="frmRegister" id="frmRegister" action="{{ route('register.submit') }}" method="post">
                @csrf

                <div class="duo-field">
                    <label class="duo-label"><i class="fas fa-user"></i> {{ __('inkwave.form_name') }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ __('inkwave.form_name') }}" value="{{ old('name') }}" class="duo-input @error('name') is-invalid @enderror">
                    @error('name') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                <div class="duo-field">
                    <label class="duo-label"><i class="fas fa-envelope"></i> {{ __('inkwave.form_email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('inkwave.form_email') }}" value="{{ old('email') }}" class="duo-input @error('email') is-invalid @enderror">
                    @error('email') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                <div class="duo-row">
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-lock"></i> {{ __('inkwave.form_password') }}</label>
                        <input type="password" name="password" id="password" placeholder="{{ __('inkwave.form_password') }}" class="duo-input @error('password') is-invalid @enderror">
                        @error('password') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-check-circle"></i> {{ __('inkwave.form_confirm_password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('inkwave.form_confirm_password') }}" class="duo-input @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-shield-alt"></i> {{ __('inkwave.form_captcha') }}</label>
                        <div class="duo-captcha-box @error('captcha') is-invalid @enderror">
                            <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.form_captcha_placeholder') }}">
                            <div class="duo-captcha-box__img">@captcha</div>
                        </div>
                        @error('captcha') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ __('inkwave.val_captcha_error') }}</span> @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="duo-submit"><i class="fas fa-pen-nib"></i> {{ __('inkwave.btn_register') }}</button>
            </form>

            <div class="duo-divider"><span>{{ __('inkwave.or_divider') }}</span></div>

            <p class="duo-alt">
                {{ __('inkwave.existing_user_prompt') }}
                <a href="{{ route('login.form') }}">{{ __('inkwave.sign_in_link') }}</a>
            </p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmRegister").validate({
            errorElement: 'span',
            errorClass: 'duo-error',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle"></i> ');
                if (element.attr('name') === 'captcha') {
                    error.appendTo(element.closest('.duo-field'));
                } else {
                    error.appendTo(element.closest('.duo-field'));
                }
            },
            highlight: function(element, errorClass, validClass) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.duo-captcha-box').addClass('is-invalid');
                } else {
                    $(element).addClass('is-invalid');
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.duo-captcha-box').removeClass('is-invalid');
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
                name: "{{ __('inkwave.val_name_req') }}",
                password: {
                    required: "{{ __('inkwave.val_pass_req') }}",
                    minlength: "{{ __('inkwave.val_pass_min') }}"
                },
                password_confirmation: {
                    required: "{{ __('inkwave.val_pass_confirm_req') }}",
                    minlength: "{{ __('inkwave.val_pass_min') }}",
                    equalTo: "{{ __('inkwave.val_pass_match') }}"
                },
                email: "{{ __('inkwave.val_email_req') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('inkwave.val_captcha_req') }}"
                @endif
            }
        });
    });
</script>
@endpush
