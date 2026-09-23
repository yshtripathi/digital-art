@extends('frontend.layouts.main')
@section('title', __('frontend.login.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.login.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.login.title')]
    ]
])

<section class="auth">
    <div class="auth__split">

        <div class="auth__art">
            <a href="{{ route('home') }}" class="auth__logo">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $misc['Company Name'] ?? __('frontend.company.name') }}">
            </a>
            <div class="auth__art-inner">
                <p class="auth__badge">{{ __('frontend.login.label') }}</p>
                <p class="auth__lead">{{ __('frontend.login.lead') }}</p>
            </div>
        </div>

        <div class="auth__form">
            <div class="auth__inner">

                <a href="{{ route('home') }}" class="auth__back">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    {{ __('frontend.header.home') }}
                </a>

                <h1 class="auth__title">{{ __('frontend.login.heading') }}</h1>

                @if(session('loginerror'))
                    <p class="msg msg--error" role="alert">
                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                        <span>{{ session('loginerror') }}</span>
                    </p>
                @endif

                <form name="frmLogin" id="frmLogin" action="{{ route('login.submit') }}" method="post" novalidate>
                    @csrf

                    <div class="auth__fields">

                        <div class="fld">
                            <label class="fld__label" for="email">{{ __('frontend.login.email') }}</label>
                            <div class="fld__box">
                                <i class="fas fa-envelope fld__icon" aria-hidden="true"></i>
                                <input type="email" name="email" id="email" autocomplete="email" class="fld__input @error('email') is-invalid @enderror" placeholder="{{ __('frontend.login.email_ph') }}" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="fld fld--pass">
                            <label class="fld__label" for="password">{{ __('frontend.login.password') }}</label>
                            <div class="fld__box">
                                <i class="fas fa-lock fld__icon" aria-hidden="true"></i>
                                <input type="password" name="password" id="password" autocomplete="current-password" class="fld__input @error('password') is-invalid @enderror" placeholder="{{ __('frontend.login.password_ph') }}">
                                <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.login.show') }}" data-hide="{{ __('frontend.login.hide') }}" aria-label="{{ __('frontend.login.show') }}" aria-pressed="false">
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="auth__opts">
                            <label class="auth__check">
                                <span class="tick">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                </span>
                                {{ __('frontend.login.remember') }}
                            </label>
                            <a href="{{ route('forgetpwd.form') }}" class="auth__link">{{ __('frontend.login.forgot') }}</a>
                        </div>

                        <button type="submit" name="submit-form" class="btn btn--primary auth__submit">
                            {{ __('frontend.login.submit') }}
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>

                <p class="auth__divider">{{ __('frontend.login.new') }}</p>

                <a href="{{ route('register.form') }}" class="btn btn--ghost auth__alt">{{ __('frontend.login.register') }}</a>
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
            errorClass: 'fld__err',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle" aria-hidden="true"></i> ');
                error.appendTo(element.closest('.fld'));
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
                    required: @json(__('frontend.login.password_req'))
                },
                email: {
                    required: @json(__('frontend.login.email_req')),
                    email: @json(__('frontend.login.email_bad'))
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('click', function (event) {
        var button = event.target.closest('[data-pass-toggle]');

        if (!button) {
            return;
        }

        var input = button.parentElement.querySelector('input');
        var reveal = input.type === 'password';

        input.type = reveal ? 'text' : 'password';
        button.setAttribute('aria-pressed', reveal ? 'true' : 'false');
        button.setAttribute('aria-label', reveal ? button.dataset.hide : button.dataset.show);
        button.querySelector('i').className = reveal ? 'fas fa-eye-slash' : 'fas fa-eye';
    });
</script>
@endpush
