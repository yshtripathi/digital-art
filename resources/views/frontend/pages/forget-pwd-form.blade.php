@extends('frontend.layouts.main')
@section('title', __('managenovax.auth.pwd_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.auth.pwd_title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.auth.pwd_title')]
    ]
])

<section class="au au--forgot">
    <div class="au__grid">

        {{-- Colour-block side panel (CSS-only illustration, no images) --}}
        <aside class="au-aside">
            <div class="au-art" aria-hidden="true">
                <div class="au-art__card">
                    <div class="au-art__row">
                        <span class="au-art__dot"><i class="fas fa-key"></i></span>
                        <span class="au-art__lines">
                            <span class="au-art__line"></span>
                            <span class="au-art__line au-art__line--short"></span>
                        </span>
                    </div>
                    <div class="au-art__progress"><span></span></div>
                    <div class="au-art__chips">
                        <span class="au-art__chip"></span>
                        <span class="au-art__chip"></span>
                        <span class="au-art__chip"></span>
                    </div>
                </div>
                <span class="au-art__badge"><i class="fas fa-check"></i></span>
                <span class="au-art__stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </span>
            </div>

            <p class="au-aside__headline">{{ __('managenovax.auth.pwd_title') }}</p>
        </aside>

        <div class="au-card">
            <div class="au-card__inner">
                <span class="au-eyebrow">{{ __('managenovax.auth.pwd_badge') }}</span>
                <h2 class="au-title">{{ __('managenovax.auth.pwd_title') }}</h2>

                <form name="frmForgot" id="frmForgot" class="au-form" action="{{ route('password.email') }}" method="post" novalidate>
                    @csrf

                    <div class="au-field">
                        <label class="au-label" for="email">{{ __('managenovax.auth.pwd_lbl_email') }}</label>
                        <div class="au-input">
                            <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ __('managenovax.auth.pwd_ph_email') }}" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                        </div>
                        @error('email') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="au-field">
                            <label class="au-label" for="captcha">{{ __('managenovax.auth.pwd_lbl_sec') }}</label>
                            <div class="au-captcha @error('captcha') is-invalid @enderror">
                                <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('managenovax.auth.pwd_ph_sec') }}">
                                <div class="au-captcha__img">@captcha</div>
                                <button type="button" class="au-captcha__refresh" data-au-captcha aria-label="Refresh code"><i class="fas fa-sync-alt"></i></button>
                            </div>
                            @error('captcha') <span class="au-error"><i class="fas fa-info-circle"></i> {{ __('managenovax.auth.pwd_err_sec') }}</span> @enderror
                        </div>
                    @endif

                    <button type="submit" name="submit-form" class="au-submit">
                        {{ __('managenovax.auth.pwd_btn') }} <i class="fas fa-paper-plane"></i>
                    </button>
                </form>

                <div class="au-divider">{{ __('managenovax.auth.pwd_or') }}</div>

                <div class="au-alt">
                    <span>{{ __('managenovax.auth.pwd_remember_prompt') }}</span>
                    <a href="{{ route('login.form') }}">{{ __('managenovax.auth.pwd_signin_link') }}</a>
                </div>
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
                email: "{{ __('managenovax.auth.pwd_req_email') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('managenovax.auth.pwd_req_sec') }}"
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
