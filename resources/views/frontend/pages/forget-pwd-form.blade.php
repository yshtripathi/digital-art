@extends('frontend.layouts.main')
@section('title','Forgot Password')
@section('main-content')

<x-breadcrumb :title="__('common.forgetpwd')" />

<section class="au-section">
    <div class="au-card">
        @include('frontend.pages.partials.auth-aside')

        <div class="au-main">
            <div class="au-main__head">
                <p class="au-eyebrow">{{ __('common.forgot_badge') }}</p>
                <h1 class="au-title">{{ __('common.forgot_title') }}</h1>
            </div>

            <form name="frmForgot" id="frmForgot" action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="au-field">
                    <label class="au-label"><i class="fas fa-envelope"></i> {{ __('common.email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('common.email') }}" value="{{ old('email') }}" class="au-input @error('email') is-invalid @enderror">
                    @error('email') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
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

                <button type="submit" name="submit-form" class="au-submit"><i class="fas fa-envelope-open"></i> {{ __('common.send_reset_link') }}</button>
            </form>

            <div class="au-divider"><span>{{ __('common.or') }}</span></div>

            <p class="au-alt">
                {{ __('common.forgot_remember') }}
                <a href="{{ route('login.form') }}">{{ __('common.forgot_sign_in_now') }}</a>
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
        $("#frmForgot").validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                if (element.attr('name') === 'captcha') {
                    error.appendTo(element.closest('.au-field'));
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                email: { required: true, email: true },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                email: "{{ __('common.email_required') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('common.fill_it') }}"
                @endif
            }
        });
    });
</script>
@endpush
