@extends('frontend.layouts.main')
@section('title', __('managenovax.auth.reg_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.auth.reg_title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.auth.reg_title')]
    ]
])

<section class="au au--register">
    <div class="au__grid">

        {{-- Colour-block side panel (CSS-only illustration, no images) --}}
        <aside class="au-aside">
            <div class="au-art" aria-hidden="true">
                <div class="au-art__card">
                    <div class="au-art__row">
                        <span class="au-art__dot"><i class="fas fa-user-plus"></i></span>
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

            <p class="au-aside__headline">{{ __('managenovax.auth.reg_title') }}</p>
        </aside>

        <div class="au-card">
            <div class="au-card__inner">
                <span class="au-eyebrow">{{ __('managenovax.auth.reg_badge') }}</span>
                <h2 class="au-title">{{ __('managenovax.auth.reg_title') }}</h2>

                <form name="frmRegister" id="frmRegister" class="au-form" action="{{ route('register.submit') }}" method="post" novalidate>
                    @csrf

                    <div class="au-field">
                        <label class="au-label" for="name">{{ __('managenovax.auth.reg_lbl_name') }}</label>
                        <div class="au-input">
                            <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="name" id="name" autocomplete="name" placeholder="{{ __('managenovax.auth.reg_ph_name') }}" value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
                        </div>
                        @error('name') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-field">
                        <label class="au-label" for="email">{{ __('managenovax.auth.reg_lbl_email') }}</label>
                        <div class="au-input">
                            <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ __('managenovax.auth.reg_ph_email') }}" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                        </div>
                        @error('email') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-row">
                        <div class="au-field">
                            <label class="au-label" for="password">{{ __('managenovax.auth.reg_lbl_pass') }}</label>
                            <div class="au-input au-input--pass">
                                <i class="fas fa-lock au-input__icon" aria-hidden="true"></i>
                                <input type="password" name="password" id="password" autocomplete="new-password" placeholder="{{ __('managenovax.auth.reg_ph_pass') }}" class="@error('password') is-invalid @enderror">
                                <button type="button" class="au-eye" data-au-toggle aria-label="Show password" aria-pressed="false"><i class="fas fa-eye"></i></button>
                            </div>
                            @error('password') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="au-field">
                            <label class="au-label" for="password_confirmation">{{ __('managenovax.auth.reg_lbl_conf_pass') }}</label>
                            <div class="au-input au-input--pass">
                                <i class="fas fa-lock au-input__icon" aria-hidden="true"></i>
                                <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" placeholder="{{ __('managenovax.auth.reg_ph_conf_pass') }}" class="@error('password_confirmation') is-invalid @enderror">
                                <button type="button" class="au-eye" data-au-toggle aria-label="Show password" aria-pressed="false"><i class="fas fa-eye"></i></button>
                            </div>
                            @error('password_confirmation') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="au-field">
                            <label class="au-label" for="captcha">{{ __('managenovax.auth.reg_lbl_sec') }}</label>
                            <div class="au-captcha @error('captcha') is-invalid @enderror">
                                <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('managenovax.auth.reg_ph_sec') }}">
                                <div class="au-captcha__img">@captcha</div>
                                <button type="button" class="au-captcha__refresh" data-au-captcha aria-label="Refresh code"><i class="fas fa-sync-alt"></i></button>
                            </div>
                            @error('captcha') <span class="au-error"><i class="fas fa-info-circle"></i> {{ __('managenovax.auth.reg_err_sec') }}</span> @enderror
                        </div>
                    @endif

                    <button type="submit" name="submit-form" class="au-submit">
                        {{ __('managenovax.auth.reg_btn') }} <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="au-divider">{{ __('managenovax.auth.reg_or') }}</div>

                <div class="au-alt">
                    <span>{{ __('managenovax.auth.reg_exist_prompt') }}</span>
                    <a href="{{ route('login.form') }}">{{ __('managenovax.auth.reg_signin_link') }}</a>
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
        $("#frmRegister").validate({
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
                name: { required: true, minlength: 5 },
                password: { required: true, minlength: 5 },
                password_confirmation: { required: true, minlength: 5, equalTo: "#password" },
                email: { required: true, email: true },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                name: "{{ __('managenovax.auth.reg_req_name') }}",
                password: {
                    required: "{{ __('managenovax.auth.reg_req_pass') }}",
                    minlength: "{{ __('managenovax.auth.reg_min_pass') }}"
                },
                password_confirmation: {
                    required: "{{ __('managenovax.auth.reg_req_conf_pass') }}",
                    minlength: "{{ __('managenovax.auth.reg_min_pass') }}",
                    equalTo: "{{ __('managenovax.auth.reg_match_pass') }}"
                },
                email: "{{ __('managenovax.auth.reg_req_email') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('managenovax.auth.reg_req_sec') }}"
                @endif
            }
        });
    });
</script>

<script>
    // Show / hide password
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-au-toggle]');
        if (!btn) return;
        var input = btn.parentElement.querySelector('input');
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.setAttribute('aria-pressed', show ? 'true' : 'false');
        btn.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
    });

    // Refresh captcha image
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-au-captcha]');
        if (!btn) return;
        var img = btn.parentElement.querySelector('.au-captcha__img img');
        if (img) img.click();
    });
</script>
@endpush
