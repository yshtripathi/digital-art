@extends('frontend.layouts.main')
@section('title', __('inkwave.forgot_title'))
@section('main-content')

<x-breadcrumb :title="__('inkwave.forgot_title')" />

<section class="au-section">
    <div class="au-card">
        @include('frontend.pages.partials.auth-aside')

        <div class="au-main">
            <div class="au-main__head">
                <p class="au-eyebrow">{{ __('inkwave.forgot_badge') }}</p>
                <h1 class="au-title">{{ __('inkwave.forgot_title') }}</h1>
            </div>

            <form name="frmForgot" id="frmForgot" action="{{ route('password.email') }}" method="post">
                @csrf

                <div class="au-field">
                    <label class="au-label"><i class="fas fa-envelope"></i> {{ __('inkwave.form_email') }}</label>
                    <input type="email" name="email" id="email" placeholder="{{ __('inkwave.form_email') }}" value="{{ old('email') }}" class="au-input @error('email') is-invalid @enderror">
                    @error('email') <span class="au-error"><i class="fas fa-info-circle"></i>{{ $message }}</span> @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="au-field au-field--captcha">
                        <label class="au-label">{{ __('inkwave.form_captcha') }}</label>
                        <div class="au-captcha">
                            <input type="text" id="captcha" name="captcha" autocomplete="off" class="au-input @error('captcha') is-invalid @enderror" placeholder="{{ __('inkwave.form_captcha_placeholder') }}">
                            <div class="au-captcha__img">@captcha</div>
                        </div>
                        @error('captcha') <span class="au-error"><i class="fas fa-info-circle"></i>{{ __('inkwave.val_captcha_error') }}</span> @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="au-submit"><i class="fas fa-envelope-open"></i> {{ __('inkwave.btn_forgot') }}</button>
            </form>

            <div class="au-divider"><span>{{ __('inkwave.or_divider') }}</span></div>

            <p class="au-alt">
                {{ __('inkwave.remember_password_prompt') }}
                <a href="{{ route('login.form') }}">{{ __('inkwave.sign_in_link') }}</a>
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
                email: "{{ __('inkwave.val_email_req') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('inkwave.val_captcha_req') }}"
                @endif
            }
        });
    });
</script>
@endpush
