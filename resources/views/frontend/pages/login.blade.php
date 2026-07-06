@extends('frontend.layouts.main')
@section('title', __('inkwave.login_title'))
@section('main-content')

<x-breadcrumb :title="__('inkwave.login_title')" />

<section class="au-section">
    <div class="au-card">
        @include('frontend.pages.partials.auth-aside')

        <div class="au-main">
            <div class="au-main__head">
                <p class="au-eyebrow">{{ __('inkwave.login_badge') }}</p>
                <h1 class="au-title">{{ __('inkwave.login_title') }}</h1>
            </div>

            <form name="frmLogin" id="frmLogin" action="{{ route('login.submit') }}" method="post">
                @csrf

                <div class="au-field">
                    <label class="au-label"><i class="fas fa-envelope"></i> {{ __('inkwave.form_email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('inkwave.form_email') }}" value="{{ old('email') }}" class="au-input @error('email') is-invalid @enderror">
                    @error('email') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                </div>

                <div class="au-field">
                    <label class="au-label"><i class="fas fa-lock"></i> {{ __('inkwave.form_password') }}</label>
                    <input type="password" name="password" id="password" placeholder="{{ __('inkwave.form_password') }}" class="au-input @error('password') is-invalid @enderror">
                    @error('password') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                </div>

                <div class="au-forgot">
                    <a href="{{ route('forgetpwd.form') }}">{{ __('inkwave.lost_password') }}</a>
                </div>

                <button type="submit" name="submit-form" class="au-submit"><i class="fas fa-sign-in-alt"></i> {{ __('inkwave.btn_login') }}</button>
            </form>

            <div class="au-divider"><span>{{ __('inkwave.or_divider') }}</span></div>

            <p class="au-alt">
                {{ __('inkwave.new_user_prompt') }}
                <a href="{{ route('register.form') }}">{{ __('inkwave.create_profile_link') }}</a>
            </p>
        </div>
    </div>
</section>

@endsection

@include('frontend.pages.partials.auth-style')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmLogin").validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                if (element.attr('name') === 'captcha') {
                    error.appendTo(element.closest('.au-field'));
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                password: { required: true, minlength: 5 },
                email: { required: true, email: true }
            },
            messages: {
                password: {
                    required: "{{ __('inkwave.val_pass_req') }}",
                    minlength: "{{ __('inkwave.val_pass_min') }}"
                },
                email: "{{ __('inkwave.val_email_req') }}"
            }
        });
    });
</script>
@endpush
