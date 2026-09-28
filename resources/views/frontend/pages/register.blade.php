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

<section class="gate">
    <div class="gate__stack">
        <nav class="gate__tabs" aria-label="{{ __('frontend.header.acct_menu') }}">
            <a href="{{ route('login.form') }}" class="gate__tab">
                <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                <span>{{ __('frontend.header.acct_login') }}</span>
            </a>
            <a href="{{ route('register.form') }}" class="gate__tab is-active" aria-current="page">
                <i class="fas fa-user-plus" aria-hidden="true"></i>
                <span>{{ __('frontend.header.acct_join') }}</span>
            </a>
        </nav>

        <div class="gate__card">
            <div class="gate__head">
                <span class="gate__badge" aria-hidden="true"><i class="fas fa-user-plus"></i></span>
                <div>
                    <h2 class="gate__title">{{ __('frontend.register.title') }}</h2>
                    <p class="gate__lead">{{ __('frontend.register.intro') }}</p>
                </div>
            </div>

            <form name="frmRegister" id="frmRegister" class="gate__form" action="{{ route('register.submit') }}" method="post" novalidate>
                @csrf

                <div class="entry">
                    <label class="entry__label" for="name">{{ __('frontend.register.name_label') }}</label>
                    <div class="entry__box @error('name') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" id="name" autocomplete="name" class="entry__input" placeholder="{{ __('frontend.register.name_hint') }}" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="email">{{ __('frontend.register.mail_label') }}</label>
                    <div class="entry__box @error('email') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-at"></i></span>
                        <input type="email" name="email" id="email" autocomplete="email" class="entry__input" placeholder="{{ __('frontend.register.mail_hint') }}" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="password">{{ __('frontend.register.pass_label') }}</label>
                    <div class="entry__box @error('password') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" id="password" autocomplete="new-password" class="entry__input" placeholder="{{ __('frontend.register.pass_hint') }}">
                        <button type="button" class="entry__eye" data-pass-toggle data-show="{{ __('frontend.register.pass_show') }}" data-hide="{{ __('frontend.register.pass_hide') }}" aria-label="{{ __('frontend.register.pass_show') }}" aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="password_confirmation">{{ __('frontend.register.again_label') }}</label>
                    <div class="entry__box @error('password_confirmation') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-redo-alt"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="entry__input" placeholder="{{ __('frontend.register.again_hint') }}">
                        <button type="button" class="entry__eye" data-pass-toggle data-show="{{ __('frontend.register.pass_show') }}" data-hide="{{ __('frontend.register.pass_hide') }}" aria-label="{{ __('frontend.register.pass_show') }}" aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="entry">
                        <label class="entry__label" for="captcha">{{ __('frontend.register.code_label') }}</label>
                        <div class="entry__cap">
                            <div class="cap__img">@captcha</div>
                            <div class="entry__box @error('captcha') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-shield-alt"></i></span>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="entry__input" placeholder="{{ __('frontend.register.code_hint') }}">
                            </div>
                        </div>
                        @error('captcha')
                            <span class="entry__err">{{ __('frontend.register.code_wrong') }}</span>
                        @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="btn btn--block gate__submit">
                    <span>{{ __('frontend.register.submit') }}</span>
                    <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="gate__foot">
                {{ __('frontend.register.has_acct') }}
                <a href="{{ route('login.form') }}" class="gate__swap">{{ __('frontend.register.login') }}</a>
            </p>
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
            errorClass: 'entry__err',
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('.entry'));
            },
            highlight: function(element) {
                $(element).closest('.entry__box').addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).closest('.entry__box').removeClass('is-invalid');
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
