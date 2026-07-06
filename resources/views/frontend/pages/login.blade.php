@extends('frontend.layouts.main')
@section('title','Login')
@section('main-content')

<x-breadcrumb :title="__('common.login')" />

<section class="au-section">
    <div class="au-card">
        @include('frontend.pages.partials.auth-aside')

        <div class="au-main">
            <div class="au-main__head">
                <p class="au-eyebrow">{{ __('common.login_badge') }}</p>
                <h1 class="au-title">{{ __('common.login') }}</h1>
            </div>

            <form name="frmLogin" id="frmLogin" action="{{ route('login.submit') }}" method="post">
                @csrf

                <div class="au-field">
                    <label class="au-label"><i class="fas fa-envelope"></i> {{ __('common.email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('common.email') }}" value="{{ old('email') }}" class="au-input @error('email') is-invalid @enderror">
                    @error('email') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                </div>

                <div class="au-field">
                    <label class="au-label"><i class="fas fa-lock"></i> {{ __('common.password') }}</label>
                    <input type="password" name="password" id="password" placeholder="{{ __('common.password') }}" class="au-input @error('password') is-invalid @enderror">
                    @error('password') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                </div>

                <div class="au-forgot">
                    <a href="{{ route('forgetpwd.form') }}">{{ __('common.lost_password_text') }}</a>
                </div>

                <button type="submit" name="submit-form" class="au-submit"><i class="fas fa-sign-in-alt"></i> {{ __('common.login') }}</button>
            </form>

            <div class="au-divider"><span>{{ __('common.or') }}</span></div>

            <p class="au-alt">
                {{ __('common.login_new_user') }}
                <a href="{{ route('register.form') }}">{{ __('common.login_create_profile') }}</a>
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
                    required: "{{ __('common.password_required') }}",
                    minlength: "{{ __('common.password_confirmation_min') }}"
                },
                email: "{{ __('common.email_required') }}"
            }
        });
    });
</script>
@endpush
