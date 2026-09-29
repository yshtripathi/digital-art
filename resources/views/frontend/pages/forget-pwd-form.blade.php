@extends('frontend.layouts.main')
@section('title', __('frontend.forgot.tab'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.forgot.tab'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.forgot.tab')]
    ]
])

@php
    $authImage = file_exists(public_path('assets/images/auth.webp')) ? asset('assets/images/auth.webp') : null;
@endphp

<section class="auth">
    <div class="container">
        <div class="auth__card">
            <div class="auth__art {{ $authImage ? '' : 'is-empty' }}" aria-hidden="true">
                @if($authImage)
                    <img src="{{ $authImage }}" alt="" width="1000" height="1498">
                @endif
                <span class="auth__tag"><i class="fas fa-key"></i></span>
            </div>

            <div class="auth__body">
                <h2 class="auth__title">{{ __('frontend.forgot.heading') }}</h2>
                <p class="auth__lead">{{ __('frontend.forgot.text') }}</p>

                @if(session('status'))
                    <p class="auth__note auth__note--ok" role="status">{{ __('frontend.forgot.sent') }}</p>
                @endif

                <form name="frmForgot" id="frmForgot" class="auth__form" action="{{ route('password.email') }}" method="post" novalidate>
                    @csrf

                    <div class="auth-field" style="--i: 0">
                        <label for="email">{{ __('frontend.forgot.email') }}</label>
                        <input type="email" name="email" id="email" autocomplete="email" class="@error('email') is-invalid @enderror" placeholder="{{ __('frontend.forgot.email_placeholder') }}" value="{{ old('email') }}">
                        @error('email')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="auth-field" style="--i: 1">
                            <label for="captcha">{{ __('frontend.forgot.captcha') }}</label>
                            <div class="auth-cap">
                                <div class="auth-cap__img cap__img">@captcha</div>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="@error('captcha') is-invalid @enderror" placeholder="{{ __('frontend.forgot.captcha_placeholder') }}">
                            </div>
                            @error('captcha')
                                <span class="auth-err">{{ __('frontend.forgot.captcha_invalid') }}</span>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" name="submit-form" class="btn btn--primary btn--block auth__submit" style="--i: 2">{{ __('frontend.forgot.button') }}</button>
                </form>

                <p class="auth__switch">
                    {{ __('frontend.forgot.remembered') }}
                    <a href="{{ route('login.form') }}" class="auth-link auth-link--strong">{{ __('frontend.forgot.login_link') }}</a>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmForgot").validate({
            errorElement: 'span',
            errorClass: 'auth-err',
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('.auth-field'));
            },
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            },
            rules: {
                email: { required: true, email: true },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                email: {
                    required: @json(__('frontend.forgot.email_required')),
                    email: @json(__('frontend.forgot.email_invalid'))
                },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: @json(__('frontend.forgot.captcha_required'))
                @endif
            }
        });
    });
</script>
@endpush
