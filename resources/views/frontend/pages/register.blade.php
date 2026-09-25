@extends('frontend.layouts.main')
@section('title', __('frontend.register.page_name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.register.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.register.page_name')]
    ]
])

<section class="auth">
    <div class="auth__card">
        <p class="auth__badge">{{ __('frontend.register.tag') }}</p>
        <h2 class="auth__title">{{ __('frontend.register.form_title') }}</h2>
        <p class="auth__lead">{{ __('frontend.register.intro') }}</p>

        <form name="frmRegister" id="frmRegister" action="{{ route('register.submit') }}" method="post" novalidate>
            @csrf

            <div class="auth__fields">

                <div class="fld">
                    <label class="fld__label" for="name">{{ __('frontend.register.name_label') }}</label>
                    <div class="fld__box">
                        <i class="fas fa-user fld__icon" aria-hidden="true"></i>
                        <input type="text" name="name" id="name" autocomplete="name" class="fld__input @error('name') is-invalid @enderror" placeholder="{{ __('frontend.register.name_hint') }}" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="fld">
                    <label class="fld__label" for="email">{{ __('frontend.register.mail_label') }}</label>
                    <div class="fld__box">
                        <i class="fas fa-envelope fld__icon" aria-hidden="true"></i>
                        <input type="email" name="email" id="email" autocomplete="email" class="fld__input @error('email') is-invalid @enderror" placeholder="{{ __('frontend.register.mail_hint') }}" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="fld fld--pass">
                    <label class="fld__label" for="password">{{ __('frontend.register.pass_label') }}</label>
                    <div class="fld__box">
                        <i class="fas fa-lock fld__icon" aria-hidden="true"></i>
                        <input type="password" name="password" id="password" autocomplete="new-password" class="fld__input @error('password') is-invalid @enderror" placeholder="{{ __('frontend.register.pass_hint') }}">
                        <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.register.pass_show') }}" data-hide="{{ __('frontend.register.pass_hide') }}" aria-label="{{ __('frontend.register.pass_show') }}" aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="fld fld--pass">
                    <label class="fld__label" for="password_confirmation">{{ __('frontend.register.again_label') }}</label>
                    <div class="fld__box">
                        <i class="fas fa-lock fld__icon" aria-hidden="true"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="fld__input @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('frontend.register.again_hint') }}">
                        <button type="button" class="fld__eye" data-pass-toggle data-show="{{ __('frontend.register.pass_show') }}" data-hide="{{ __('frontend.register.pass_hide') }}" aria-label="{{ __('frontend.register.pass_show') }}" aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                    @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="fld">
                        <label class="fld__label" for="captcha">{{ __('frontend.register.code_label') }}</label>
                        <div class="cap @error('captcha') is-invalid @enderror">
                            <div class="fld__box">
                                <i class="fas fa-shield-alt fld__icon" aria-hidden="true"></i>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="fld__input" placeholder="{{ __('frontend.register.code_hint') }}">
                            </div>
                            <div class="cap__img">@captcha</div>
                        </div>
                        @error('captcha')
                            <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ __('frontend.register.code_wrong') }}</span>
                        @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="btn btn--primary btn--block auth__submit">
                    {{ __('frontend.register.send') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>
            </div>
        </form>

        <p class="auth__divider"><span>{{ __('frontend.register.login_prompt') }}</span></p>
        <a href="{{ route('login.form') }}" class="btn btn--ghost btn--block">{{ __('frontend.register.login_link') }}</a>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmRegister").validate({
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
                    required: @json(__('frontend.register.name_empty')),
                    minlength: @json(__('frontend.register.name_short', ['min' => 2]))
                },
                password: {
                    required: @json(__('frontend.register.pass_empty')),
                    minlength: @json(__('frontend.register.pass_short', ['min' => 6]))
                },
                password_confirmation: {
                    required: @json(__('frontend.register.again_empty')),
                    equalTo: @json(__('frontend.register.again_diff'))
                },
                email: {
                    required: @json(__('frontend.register.mail_empty')),
                    email: @json(__('frontend.register.mail_wrong'))
                },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: @json(__('frontend.register.code_empty'))
                @endif
            }
        });
    });
</script>

<script>
    document.addEventListener('click', function (event) {
        var toggle = event.target.closest('[data-pass-toggle]');

        if (toggle) {
            var input = toggle.parentElement.querySelector('input');
            var reveal = input.type === 'password';

            input.type = reveal ? 'text' : 'password';
            toggle.setAttribute('aria-pressed', reveal ? 'true' : 'false');
            toggle.setAttribute('aria-label', reveal ? toggle.dataset.hide : toggle.dataset.show);
            toggle.querySelector('i').className = reveal ? 'fas fa-eye-slash' : 'fas fa-eye';
        }
    });
</script>
@endpush
