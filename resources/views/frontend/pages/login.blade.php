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



<div class="duo-auth-wrapper">
    <div class="duo-container">
        <div class="duo-auth-card">
            
            <div class="duo-form-head">
                <p class="duo-eyebrow">{{ __('inkwave.login_pg_badge') }}</p>
                <h1 class="duo-title">{{ __('inkwave.login_pg_title') }}</h1>
            </div>

            <form name="frmLogin" id="frmLogin" action="{{ route('login.submit') }}" method="post">
                @csrf

                <div class="duo-field">
                    <label class="duo-label"><i class="fas fa-envelope"></i> {{ __('inkwave.login_fld_email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('inkwave.login_fld_email') }}" value="{{ old('email') }}" class="duo-input @error('email') is-invalid @enderror">
                    @error('email') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                <div class="duo-field">
                    <label class="duo-label"><i class="fas fa-lock"></i> {{ __('inkwave.login_fld_pass') }}</label>
                    <input type="password" name="password" id="password" placeholder="{{ __('inkwave.login_fld_pass') }}" class="duo-input @error('password') is-invalid @enderror">
                    @error('password') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                <div class="duo-forgot">
                    <a href="{{ route('forgetpwd.form') }}">{{ __('inkwave.login_lost_pwd') }}</a>
                </div>

                <button type="submit" name="submit-form" class="duo-submit"><i class="fas fa-sign-in-alt"></i> {{ __('inkwave.login_btn_submit') }}</button>
            </form>

            <div class="duo-divider"><span>{{ __('inkwave.login_or_div') }}</span></div>

            <p class="duo-alt">
                {{ __('inkwave.login_new_user') }}
                <a href="{{ route('register.form') }}">{{ __('inkwave.login_create_link') }}</a>
            </p>
            
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmLogin").validate({
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
