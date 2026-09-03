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



<div class="duo-auth-wrapper">
    <div class="duo-container">
        <div class="duo-auth-card">
            <div class="duo-form-head">
                <p class="duo-eyebrow">{{ __('inkwave.reg_pg_badge') }}</p>
                <h1 class="duo-title">{{ __('inkwave.reg_pg_title') }}</h1>
            </div>

            <form name="frmRegister" id="frmRegister" action="{{ route('register.submit') }}" method="post">
                @csrf

                <div class="duo-field">
                    <label class="duo-label"><i class="fas fa-user"></i> {{ __('inkwave.reg_fld_name') }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ __('inkwave.reg_fld_name') }}" value="{{ old('name') }}" class="duo-input @error('name') is-invalid @enderror">
                    @error('name') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                <div class="duo-field">
                    <label class="duo-label"><i class="fas fa-envelope"></i> {{ __('inkwave.reg_fld_email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('inkwave.reg_fld_email') }}" value="{{ old('email') }}" class="duo-input @error('email') is-invalid @enderror">
                    @error('email') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                <div class="duo-row">
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-lock"></i> {{ __('inkwave.reg_fld_pass') }}</label>
                        <input type="password" name="password" id="password" placeholder="{{ __('inkwave.reg_fld_pass') }}" class="duo-input @error('password') is-invalid @enderror">
                        @error('password') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-check-circle"></i> {{ __('inkwave.reg_fld_conf_pass') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('inkwave.reg_fld_conf_pass') }}" class="duo-input @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-shield-alt"></i> {{ __('inkwave.reg_fld_sec') }}</label>
                        <div class="duo-captcha-box @error('captcha') is-invalid @enderror">
                            <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.reg_sec_ph') }}">
                            <div class="duo-captcha-box__img">@captcha</div>
                        </div>
                        @error('captcha') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ __('inkwave.reg_val_sec_err') }}</span> @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="duo-submit"><i class="fas fa-user-plus"></i> {{ __('inkwave.reg_btn_submit') }}</button>
            </form>

            <div class="duo-divider"><span>{{ __('inkwave.reg_or_div') }}</span></div>

            <p class="duo-alt">
                {{ __('inkwave.reg_existing_user') }}
                <a href="{{ route('login.form') }}">{{ __('inkwave.reg_sign_in_link') }}</a>
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
