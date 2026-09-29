@extends('frontend.layouts.main')
@section('title', __('frontend.register.tab'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.register.tab'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.register.tab')]
    ]
])

@php
    $authImage = file_exists(public_path('assets/images/auth-art.webp')) ? asset('assets/images/auth-art.webp') : null;
    $authLogo  = file_exists(public_path('assets/images/logo.webp')) ? asset('assets/images/logo.webp') : null;
@endphp

<section class="auth">
    <div class="container">
        <div class="auth__card">
            <div class="auth__art {{ $authImage ? '' : 'is-empty' }}">
                <a href="{{ route('home') }}" class="auth__logo" aria-label="{{ __('frontend.head.site') }}">
                    @if($authLogo)
                        <img src="{{ $authLogo }}" alt="{{ __('frontend.head.site') }}" width="716" height="210">
                    @else
                        <span>{{ __('frontend.head.site') }}</span>
                    @endif
                </a>

                <div class="auth__pic" aria-hidden="true">
                    @if($authImage)
                        <img src="{{ $authImage }}" alt="" width="1200" height="1200">
                    @endif
                </div>

                <div class="auth__side">
                    <p class="auth__side-title">{{ __('frontend.register.side_title') }}</p>
                    <ol class="auth__points">
                        <li style="--i: 0">{{ __('frontend.register.side_1') }}</li>
                        <li style="--i: 1">{{ __('frontend.register.side_2') }}</li>
                        <li style="--i: 2">{{ __('frontend.register.side_3') }}</li>
                    </ol>
                </div>
            </div>

            <div class="auth__body">
                <h2 class="auth__title">{{ __('frontend.register.heading') }}</h2>
                <p class="auth__lead">{{ __('frontend.register.text') }}</p>

                <form name="frmRegister" id="frmRegister" class="auth__form" action="{{ route('register.submit') }}" method="post" novalidate>
                    @csrf

                    <div class="auth-field" style="--i: 0">
                        <label for="name">{{ __('frontend.register.name') }}</label>
                        <input type="text" name="name" id="name" autocomplete="name" class="@error('name') is-invalid @enderror" placeholder="{{ __('frontend.register.name_placeholder') }}" value="{{ old('name') }}">
                        @error('name')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field" style="--i: 1">
                        <label for="email">{{ __('frontend.register.email') }}</label>
                        <input type="email" name="email" id="email" autocomplete="email" class="@error('email') is-invalid @enderror" placeholder="{{ __('frontend.register.email_placeholder') }}" value="{{ old('email') }}">
                        @error('email')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field" style="--i: 2">
                        <label for="password">{{ __('frontend.register.password') }}</label>
                        <div class="auth-pass">
                            <input type="password" name="password" id="password" autocomplete="new-password" class="@error('password') is-invalid @enderror" placeholder="{{ __('frontend.register.password_placeholder') }}">
                            <button type="button" class="auth-pass__eye" data-pass-toggle data-show="{{ __('frontend.register.show') }}" data-hide="{{ __('frontend.register.hide') }}" aria-label="{{ __('frontend.register.show') }}" aria-pressed="false">
                                <i class="far fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field" style="--i: 3">
                        <label for="password_confirmation">{{ __('frontend.register.confirm') }}</label>
                        <div class="auth-pass">
                            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="@error('password_confirmation') is-invalid @enderror" placeholder="{{ __('frontend.register.confirm_placeholder') }}">
                            <button type="button" class="auth-pass__eye" data-pass-toggle data-show="{{ __('frontend.register.show') }}" data-hide="{{ __('frontend.register.hide') }}" aria-label="{{ __('frontend.register.show') }}" aria-pressed="false">
                                <i class="far fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="auth-field" style="--i: 4">
                            <label for="captcha">{{ __('frontend.register.captcha') }}</label>
                            <div class="auth-cap">
                                <div class="auth-cap__img cap__img">@captcha</div>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="@error('captcha') is-invalid @enderror" placeholder="{{ __('frontend.register.captcha_placeholder') }}">
                            </div>
                            @error('captcha')
                                <span class="auth-err">{{ __('frontend.register.captcha_invalid') }}</span>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" name="submit-form" class="btn btn--primary btn--block auth__submit" style="--i: 5">{{ __('frontend.register.button') }}</button>
                </form>

                <p class="auth__switch">
                    {{ __('frontend.register.have_account') }}
                    <a href="{{ route('login.form') }}" class="auth-link auth-link--strong">{{ __('frontend.register.login_link') }}</a>
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
        $("#frmRegister").validate({
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
                name: { required: true, minlength: 2 },
                password: { required: true, minlength: 6 },
                password_confirmation: { required: true, equalTo: "#password" },
                email: { required: true, email: true },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                name: {
                    required: @json(__('frontend.register.name_required')),
                    minlength: @json(__('frontend.register.name_min', ['min' => 2]))
                },
                password: {
                    required: @json(__('frontend.register.password_required')),
                    minlength: @json(__('frontend.register.password_min', ['min' => 6]))
                },
                password_confirmation: {
                    required: @json(__('frontend.register.confirm_required')),
                    equalTo: @json(__('frontend.register.confirm_mismatch'))
                },
                email: {
                    required: @json(__('frontend.register.email_required')),
                    email: @json(__('frontend.register.email_invalid'))
                },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: @json(__('frontend.register.captcha_required'))
                @endif
            }
        });
    });
</script>

<script>
    document.addEventListener('click', function (event) {
        var button = event.target.closest('[data-pass-toggle]');
        if (!button) { return; }

        var input = button.parentElement.querySelector('input');
        var reveal = input.type === 'password';

        input.type = reveal ? 'text' : 'password';
        button.setAttribute('aria-pressed', reveal ? 'true' : 'false');
        button.setAttribute('aria-label', reveal ? button.dataset.hide : button.dataset.show);
        button.querySelector('i').className = reveal ? 'far fa-eye-slash' : 'far fa-eye';
    });
</script>
@endpush
