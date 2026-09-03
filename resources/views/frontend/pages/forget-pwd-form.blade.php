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



<div class="duo-auth-wrapper">
    <div class="duo-container">
        <div class="duo-auth-card">
            
            <div class="duo-form-head">
                <p class="duo-eyebrow">{{ __('inkwave.pwd_forgot_badge') }}</p>
                <h1 class="duo-title">{{ __('inkwave.pwd_forgot_title') }}</h1>
            </div>

            <form name="frmForgot" id="frmForgot" action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="duo-field">
                    <label class="duo-label"><i class="fas fa-envelope"></i> {{ __('inkwave.pwd_fld_email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('inkwave.pwd_fld_email') }}" value="{{ old('email') }}" class="duo-input @error('email') is-invalid @enderror">
                    @error('email') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-shield-alt"></i> {{ __('inkwave.pwd_fld_sec') }}</label>
                        <div class="duo-captcha-box @error('captcha') is-invalid @enderror">
                            <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.pwd_sec_ph') }}">
                            <div class="duo-captcha-box__img">@captcha</div>
                        </div>
                        @error('captcha') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ __('inkwave.pwd_val_sec_err') }}</span> @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="duo-submit"><i class="fas fa-envelope-open"></i> {{ __('inkwave.pwd_btn_submit') }}</button>
            </form>

            <div class="duo-divider"><span>{{ __('inkwave.pwd_or_divider') }}</span></div>

            <p class="duo-alt">
                {{ __('inkwave.pwd_remember_prompt') }}
                <a href="{{ route('login.form') }}">{{ __('inkwave.pwd_sign_in_link') }}</a>
            </p>
            
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmForgot").validate({
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
