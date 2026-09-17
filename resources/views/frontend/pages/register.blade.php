@extends('frontend.layouts.main')
@section('title', __('frontend.register.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.register.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.register.title')]
    ]
])

<section class="fm fm--register">
    <div class="fm__wrap">

        <div class="fm__head">
            <p class="fm__kicker">{{ __('frontend.register.label') }}</p>
            <h2 class="au-title">{{ __('frontend.register.heading') }}</h2>
            <p class="fm__copy">{{ __('frontend.register.aside') }}</p>
        </div>

        <div class="au-card">
            <div class="au-card__inner">

                <form name="frmRegister" id="frmRegister" class="au-form" action="{{ route('register.submit') }}" method="post" novalidate>
                    @csrf

                    <div class="au-field">
                        <label class="au-label" for="name">{{ __('frontend.register.name') }}</label>
                        <div class="au-input">
                            <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="name" id="name" autocomplete="name" placeholder="{{ __('frontend.register.name_ph') }}" value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
                        </div>
                        @error('name') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-field">
                        <label class="au-label" for="email">{{ __('frontend.register.email') }}</label>
                        <div class="au-input">
                            <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ __('frontend.register.email_ph') }}" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                        </div>
                        @error('email') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-row">
                        <div class="au-field">
                            <label class="au-label" for="password">{{ __('frontend.register.password') }}</label>
                            <div class="au-input au-input--pass">
                                <i class="fas fa-lock au-input__icon" aria-hidden="true"></i>
                                <input type="password" name="password" id="password" autocomplete="new-password" placeholder="{{ __('frontend.register.password_ph') }}" class="@error('password') is-invalid @enderror">
                                <button type="button" class="au-eye" data-au-toggle data-show="{{ __('frontend.register.show') }}" data-hide="{{ __('frontend.register.hide') }}" aria-label="{{ __('frontend.register.show') }}" aria-pressed="false"><i class="fas fa-eye"></i></button>
                            </div>
                            @error('password') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="au-field">
                            <label class="au-label" for="password_confirmation">{{ __('frontend.register.confirm') }}</label>
                            <div class="au-input au-input--pass">
                                <i class="fas fa-lock au-input__icon" aria-hidden="true"></i>
                                <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" placeholder="{{ __('frontend.register.confirm_ph') }}" class="@error('password_confirmation') is-invalid @enderror">
                                <button type="button" class="au-eye" data-au-toggle data-show="{{ __('frontend.register.show') }}" data-hide="{{ __('frontend.register.hide') }}" aria-label="{{ __('frontend.register.show') }}" aria-pressed="false"><i class="fas fa-eye"></i></button>
                            </div>
                            @error('password_confirmation') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="au-field">
                            <label class="au-label" for="captcha">{{ __('frontend.register.captcha') }}</label>
                            <div class="au-captcha @error('captcha') is-invalid @enderror">
                                <div class="au-input au-captcha__field">
                                    <i class="fas fa-shield-alt au-input__icon" aria-hidden="true"></i>
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('frontend.register.captcha_ph') }}">
                                </div>
                                <div class="au-captcha__img">@captcha</div>
                                <button type="button" class="au-captcha__refresh" data-au-captcha aria-label="{{ __('frontend.register.refresh') }}"><i class="fas fa-sync-alt"></i></button>
                            </div>
                            @error('captcha') <span class="au-error"><i class="fas fa-info-circle"></i> {{ __('frontend.register.captcha_bad') }}</span> @enderror
                        </div>
                    @endif

                    <button type="submit" name="submit-form" class="au-submit">
                        {{ __('frontend.register.submit') }} <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

            </div>
        </div>

        <p class="au-alt">
            {{ __('frontend.register.have') }}
            <a href="{{ route('login.form') }}">{{ __('frontend.register.login') }}</a>
        </p>
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
                    required: @json(__('frontend.register.name_req')),
                    minlength: @json(__('frontend.register.name_min', ['min' => 2]))
                },
                password: {
                    required: @json(__('frontend.register.password_req')),
                    minlength: @json(__('frontend.register.password_min', ['min' => 6]))
                },
                password_confirmation: {
                    required: @json(__('frontend.register.confirm_req')),
                    equalTo: @json(__('frontend.register.match'))
                },
                email: {
                    required: @json(__('frontend.register.email_req')),
                    email: @json(__('frontend.register.email_valid'))
                },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: @json(__('frontend.register.captcha_req'))
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
        btn.setAttribute('aria-label', show ? btn.dataset.hide : btn.dataset.show);
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
