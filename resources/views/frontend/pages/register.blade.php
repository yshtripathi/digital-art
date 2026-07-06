@extends('frontend.layouts.main')
@section('title','Register')
@section('main-content')

<x-breadcrumb :title="__('common.register')" />

<section class="au-section">
    <div class="au-card">
        @include('frontend.pages.partials.auth-aside')

        <div class="au-main">
            <div class="au-main__head">
                <p class="au-eyebrow">{{ __('common.register_badge') }}</p>
                <h1 class="au-title">{{ __('common.register') }}</h1>
            </div>

            <form name="frmRegister" id="frmRegister" action="{{ route('register.submit') }}" method="post">
                @csrf

                <div class="au-field">
                    <label class="au-label"><i class="fas fa-user"></i> {{ __('common.name') }}</label>
                    <input type="text" name="name" id="name" placeholder="{{ __('common.name') }}" value="{{ old('name') }}" class="au-input @error('name') is-invalid @enderror">
                    @error('name') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                </div>

                <div class="au-field">
                    <label class="au-label"><i class="fas fa-envelope"></i> {{ __('common.email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('common.email') }}" value="{{ old('email') }}" class="au-input @error('email') is-invalid @enderror">
                    @error('email') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                </div>

                <div class="au-row">
                    <div class="au-field">
                        <label class="au-label"><i class="fas fa-lock"></i> {{ __('common.password') }}</label>
                        <input type="password" name="password" id="password" placeholder="{{ __('common.password') }}" class="au-input @error('password') is-invalid @enderror">
                        @error('password') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                    </div>

                    <div class="au-field">
                        <label class="au-label"><i class="fas fa-check-circle"></i> {{ __('common.confirm_password') }}</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('common.confirm_password') }}" class="au-input @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                    </div>
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="au-field au-field--captcha">
                        <label class="au-label">{{ __('common.security_verification') }}</label>
                        <div class="au-captcha">
                            <input type="text" id="captcha" name="captcha" autocomplete="off" class="au-input @error('captcha') is-invalid @enderror" placeholder="{{ __('common.fill_captcha') }}">
                            <div class="au-captcha__img">@captcha</div>
                        </div>
                        @error('captcha') <span class="au-error"><i class="fas fa-info-circle"></i>{{ __('common.captcha_error') }}</span> @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="au-submit"><i class="fas fa-pen-nib"></i> {{ __('common.register') }}</button>
            </form>

            <div class="au-divider"><span>{{ __('common.or') }}</span></div>

            <p class="au-alt">
                {{ __('common.register_already_account') }}
                <a href="{{ route('login.form') }}">{{ __('common.register_sign_in_here') }}</a>
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
        $("#frmRegister").validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                if (element.attr('name') === 'captcha') {
                    error.appendTo(element.closest('.au-field'));
                } else {
                    error.insertAfter(element);
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
                name: "{{ __('common.name_required') }}",
                password: {
                    required: "{{ __('common.password_required') }}",
                    minlength: "{{ __('common.password_min') }}"
                },
                password_confirmation: {
                    required: "{{ __('common.password_confirmation_required') }}",
                    minlength: "{{ __('common.password_confirmation_min') }}",
                    equalTo: "{{ __('common.password_confirmation_equal') }}"
                },
                email: "{{ __('common.email_required') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('common.fill_it') }}"
                @endif
            }
        });
    });
</script>
@endpush
