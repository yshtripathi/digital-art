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

<section class="gate">
    <div class="gate__stack">
        <nav class="gate__tabs" aria-label="{{ __('frontend.header.account_menu') }}">
            <a href="{{ route('login.form') }}" class="gate__tab">
                <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                <span>{{ __('frontend.header.login') }}</span>
            </a>
            <a href="{{ route('register.form') }}" class="gate__tab is-active" aria-current="page">
                <i class="fas fa-user-plus" aria-hidden="true"></i>
                <span>{{ __('frontend.header.register') }}</span>
            </a>
        </nav>

        <div class="gate__card">
            <div class="gate__head">
                <span class="gate__badge" aria-hidden="true"><i class="fas fa-user-plus"></i></span>
                <div>
                    <h2 class="gate__title">{{ __('frontend.register.heading') }}</h2>
                    <p class="gate__lead">{{ __('frontend.register.text') }}</p>
                </div>
            </div>

            <form name="frmRegister" id="frmRegister" class="gate__form" action="{{ route('register.submit') }}" method="post" novalidate>
                @csrf

                <div class="entry">
                    <label class="entry__label" for="name">{{ __('frontend.register.name') }}</label>
                    <div class="entry__box @error('name') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" id="name" autocomplete="name" class="entry__input" placeholder="{{ __('frontend.register.name_placeholder') }}" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="email">{{ __('frontend.register.email') }}</label>
                    <div class="entry__box @error('email') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-at"></i></span>
                        <input type="email" name="email" id="email" autocomplete="email" class="entry__input" placeholder="{{ __('frontend.register.email_placeholder') }}" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="password">{{ __('frontend.register.password') }}</label>
                    <div class="entry__box @error('password') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" id="password" autocomplete="new-password" class="entry__input" placeholder="{{ __('frontend.register.password_placeholder') }}">
                        <button type="button" class="entry__eye" data-pass-toggle data-show="{{ __('frontend.register.show') }}" data-hide="{{ __('frontend.register.hide') }}" aria-label="{{ __('frontend.register.show') }}" aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="password_confirmation">{{ __('frontend.register.confirm') }}</label>
                    <div class="entry__box @error('password_confirmation') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-redo-alt"></i></span>
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="entry__input" placeholder="{{ __('frontend.register.confirm_placeholder') }}">
                        <button type="button" class="entry__eye" data-pass-toggle data-show="{{ __('frontend.register.show') }}" data-hide="{{ __('frontend.register.hide') }}" aria-label="{{ __('frontend.register.show') }}" aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="entry">
                        <label class="entry__label" for="captcha">{{ __('frontend.register.captcha') }}</label>
                        <div class="entry__cap">
                            <div class="cap__img">@captcha</div>
                            <div class="entry__box @error('captcha') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-shield-alt"></i></span>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="entry__input" placeholder="{{ __('frontend.register.captcha_placeholder') }}">
                            </div>
                        </div>
                        @error('captcha')
                            <span class="entry__err">{{ __('frontend.register.captcha_invalid') }}</span>
                        @enderror
                    </div>
                @endif

                <button type="submit" name="submit-form" class="btn btn--block gate__submit">
                    <span>{{ __('frontend.register.button') }}</span>
                    <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="gate__foot">
                {{ __('frontend.register.have_account') }}
                <a href="{{ route('login.form') }}" class="gate__swap">{{ __('frontend.register.login_link') }}</a>
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
