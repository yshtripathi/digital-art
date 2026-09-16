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

<section class="au au--forgot">
    <div class="au__grid">

        <div class="au-card">
            <div class="au-card__inner">
                <h2 class="au-title">{{ __('frontend.forgot.heading') }}</h2>

                @if(session('status'))
                    <div class="au-alert au-alert--success" role="status"><i class="fas fa-check-circle"></i> {{ __('frontend.forgot.sent') }}</div>
                @endif

                <form name="frmForgot" id="frmForgot" class="au-form" action="{{ route('password.email') }}" method="post" novalidate>
                    @csrf

                    <div class="au-field">
                        <label class="au-label" for="email">{{ __('frontend.forgot.email') }}</label>
                        <div class="au-input">
                            <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ __('frontend.forgot.email_ph') }}" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                        </div>
                        @error('email') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="au-field">
                            <label class="au-label" for="captcha">{{ __('frontend.forgot.captcha') }}</label>
                            <div class="au-captcha @error('captcha') is-invalid @enderror">
                                <div class="au-input au-captcha__field">
                                    <i class="fas fa-shield-alt au-input__icon" aria-hidden="true"></i>
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('frontend.forgot.captcha_ph') }}">
                                </div>
                                <div class="au-captcha__img">@captcha</div>
                                <button type="button" class="au-captcha__refresh" data-au-captcha aria-label="{{ __('frontend.forgot.refresh') }}"><i class="fas fa-sync-alt"></i></button>
                            </div>
                            @error('captcha') <span class="au-error"><i class="fas fa-info-circle"></i> {{ __('frontend.forgot.captcha_bad') }}</span> @enderror
                        </div>
                    @endif

                    <button type="submit" name="submit-form" class="au-submit">
                        {{ __('frontend.forgot.submit') }} <i class="fas fa-paper-plane"></i>
                    </button>
                </form>

                <p class="au-alt">
                    {{ __('frontend.forgot.remember') }}
                    <a href="{{ route('login.form') }}">{{ __('frontend.forgot.login') }}</a>
                </p>
            </div>
        </div>

        @include('frontend.layouts.auth-panel', [
            'kicker' => __('frontend.forgot.label'),
            'copy'   => __('frontend.forgot.aside'),
        ])

    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmForgot").validate({
            errorElement: 'span',
            errorClass: 'au-error',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle"></i> ');
                error.appendTo(element.closest('.au-field'));
            },
            highlight: function(element) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.au-captcha').addClass('is-invalid');
                } else {
                    $(element).addClass('is-invalid');
                }
            },
            unhighlight: function(element) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.au-captcha').removeClass('is-invalid');
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
    // Refresh captcha image
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-au-captcha]');
        if (!btn) return;
        var img = btn.parentElement.querySelector('.au-captcha__img img');
        if (img) img.click();
    });
</script>
@endpush
