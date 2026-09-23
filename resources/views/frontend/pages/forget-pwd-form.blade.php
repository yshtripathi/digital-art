@extends('frontend.layouts.main')
@section('title', __('frontend.forgot.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.forgot.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.forgot.title')]
    ]
])

<section class="auth">
    <div class="auth__split">

        <div class="auth__art">
            <a href="{{ route('home') }}" class="auth__logo">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $misc['Company Name'] ?? __('frontend.company.name') }}">
            </a>
            <div class="auth__art-inner">
                <p class="auth__badge">{{ __('frontend.forgot.label') }}</p>
                <p class="auth__lead">{{ __('frontend.forgot.lead') }}</p>
            </div>
        </div>

        <div class="auth__form">
            <div class="auth__inner">

                <a href="{{ route('home') }}" class="auth__back">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    {{ __('frontend.header.home') }}
                </a>

                <h1 class="auth__title">{{ __('frontend.forgot.heading') }}</h1>

                @if(session('status'))
                    <p class="msg msg--ok" role="status">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        <span>{{ __('frontend.forgot.sent') }}</span>
                    </p>
                @endif

                <form name="frmForgot" id="frmForgot" action="{{ route('password.email') }}" method="post" novalidate>
                    @csrf

                    <div class="auth__fields">

                        <div class="fld">
                            <label class="fld__label" for="email">{{ __('frontend.forgot.email') }}</label>
                            <div class="fld__box">
                                <i class="fas fa-envelope fld__icon" aria-hidden="true"></i>
                                <input type="email" name="email" id="email" autocomplete="email" class="fld__input @error('email') is-invalid @enderror" placeholder="{{ __('frontend.forgot.email_ph') }}" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="fld">
                                <label class="fld__label" for="captcha">{{ __('frontend.forgot.captcha') }}</label>
                                <div class="cap @error('captcha') is-invalid @enderror">
                                    <div class="fld__box">
                                        <i class="fas fa-shield-alt fld__icon" aria-hidden="true"></i>
                                        <input type="text" id="captcha" name="captcha" autocomplete="off" class="fld__input" placeholder="{{ __('frontend.forgot.captcha_ph') }}">
                                    </div>
                                    <div class="cap__img">@captcha</div>
                                    <button type="button" class="cap__refresh" data-captcha-refresh aria-label="{{ __('frontend.forgot.refresh') }}">
                                        <i class="fas fa-sync-alt" aria-hidden="true"></i>
                                    </button>
                                </div>
                                @error('captcha')
                                    <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ __('frontend.forgot.captcha_bad') }}</span>
                                @enderror
                            </div>
                        @endif

                        <button type="submit" name="submit-form" class="btn btn--primary auth__submit">
                            {{ __('frontend.forgot.send') }}
                            <i class="fas fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>

                <p class="auth__divider">{{ __('frontend.forgot.remember') }}</p>

                <a href="{{ route('login.form') }}" class="btn btn--ghost auth__alt">{{ __('frontend.forgot.login') }}</a>
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
            errorClass: 'fld__err',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle" aria-hidden="true"></i> ');
                error.appendTo(element.closest('.fld'));
            },
            highlight: function(element) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.cap').addClass('is-invalid');
                } else {
                    $(element).addClass('is-invalid');
                }
            },
            unhighlight: function(element) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.cap').removeClass('is-invalid');
                } else {
                    $(element).removeClass('is-invalid');
                }
            },
            rules: {
                email: { required: true, email: true },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                email: {
                    required: @json(__('frontend.forgot.email_req')),
                    email: @json(__('frontend.forgot.email_valid'))
                },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: @json(__('frontend.forgot.captcha_req'))
                @endif
            }
        });
    });
</script>

<script>
    document.addEventListener('click', function (event) {
        var refresh = event.target.closest('[data-captcha-refresh]');

        if (!refresh) {
            return;
        }

        var image = refresh.parentElement.querySelector('.cap__img img');

        if (image) {
            image.click();
        }
    });
</script>
@endpush
