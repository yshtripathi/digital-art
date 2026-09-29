@extends('frontend.layouts.main')
@section('title', __('frontend.login.tab'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.login.tab'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.login.tab')]
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
                <span class="auth__tag"><i class="fas fa-lock"></i></span>
            </div>

            <div class="auth__body">
                <h2 class="auth__title">{{ __('frontend.login.heading') }}</h2>
                <p class="auth__lead">{{ __('frontend.login.text') }}</p>

                @if(session('loginerror'))
                    <p class="auth__note auth__note--bad" role="alert">{{ session('loginerror') }}</p>
                @endif

                <form name="frmLogin" id="frmLogin" class="auth__form" action="{{ route('login.submit') }}" method="post" novalidate>
                    @csrf

                    <div class="auth-field" style="--i: 0">
                        <label for="email">{{ __('frontend.login.email') }}</label>
                        <input type="email" name="email" id="email" autocomplete="email" class="@error('email') is-invalid @enderror" placeholder="{{ __('frontend.login.email_placeholder') }}" value="{{ old('email') }}">
                        @error('email')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field" style="--i: 1">
                        <label for="password">{{ __('frontend.login.password') }}</label>
                        <div class="auth-pass">
                            <input type="password" name="password" id="password" autocomplete="current-password" class="@error('password') is-invalid @enderror" placeholder="{{ __('frontend.login.password_placeholder') }}">
                            <button type="button" class="auth-pass__eye" data-pass-toggle data-show="{{ __('frontend.login.show') }}" data-hide="{{ __('frontend.login.hide') }}" aria-label="{{ __('frontend.login.show') }}" aria-pressed="false">
                                <i class="far fa-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-row" style="--i: 2">
                        <label class="auth-check" for="remember">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>{{ __('frontend.login.stay_signed_in') }}</span>
                        </label>
                        <a href="{{ route('forgetpwd.form') }}" class="auth-link">{{ __('frontend.login.forgot_link') }}</a>
                    </div>

                    <button type="submit" name="submit-form" class="btn btn--primary btn--block auth__submit" style="--i: 3">{{ __('frontend.login.button') }}</button>
                </form>

                <p class="auth__switch">
                    {{ __('frontend.login.new_here') }}
                    <a href="{{ route('register.form') }}" class="auth-link auth-link--strong">{{ __('frontend.login.register_link') }}</a>
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
        $("#frmLogin").validate({
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
                password: { required: true },
                email: { required: true, email: true }
            },
            messages: {
                password: {
                    required: @json(__('frontend.login.password_required'))
                },
                email: {
                    required: @json(__('frontend.login.email_required')),
                    email: @json(__('frontend.login.email_invalid'))
                }
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
