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

<section class="gate">
    <div class="gate__stack">
        <nav class="gate__tabs" aria-label="{{ __('frontend.header.account_menu') }}">
            <a href="{{ route('login.form') }}" class="gate__tab is-active" aria-current="page">
                <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                <span>{{ __('frontend.header.login') }}</span>
            </a>
            <a href="{{ route('register.form') }}" class="gate__tab">
                <i class="fas fa-user-plus" aria-hidden="true"></i>
                <span>{{ __('frontend.header.register') }}</span>
            </a>
        </nav>

        <div class="gate__card">
            <div class="gate__head">
                <span class="gate__badge" aria-hidden="true"><i class="fas fa-sign-in-alt"></i></span>
                <div>
                    <h2 class="gate__title">{{ __('frontend.login.heading') }}</h2>
                    <p class="gate__lead">{{ __('frontend.login.text') }}</p>
                </div>
            </div>

            @if(session('loginerror'))
                <p class="gate__note gate__note--error" role="alert">
                    <i class="fas fa-exclamation" aria-hidden="true"></i>
                    <span>{{ session('loginerror') }}</span>
                </p>
            @endif

            <form name="frmLogin" id="frmLogin" class="gate__form" action="{{ route('login.submit') }}" method="post" novalidate>
                @csrf

                <div class="entry">
                    <label class="entry__label" for="email">{{ __('frontend.login.email') }}</label>
                    <div class="entry__box @error('email') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-at"></i></span>
                        <input type="email" name="email" id="email" autocomplete="email" class="entry__input" placeholder="{{ __('frontend.login.email_placeholder') }}" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <div class="entry__top">
                        <label class="entry__label" for="password">{{ __('frontend.login.password') }}</label>
                        <a href="{{ route('forgetpwd.form') }}" class="gate__link">{{ __('frontend.login.forgot_link') }}</a>
                    </div>
                    <div class="entry__box @error('password') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" id="password" autocomplete="current-password" class="entry__input" placeholder="{{ __('frontend.login.password_placeholder') }}">
                        <button type="button" class="entry__eye" data-pass-toggle data-show="{{ __('frontend.login.show') }}" data-hide="{{ __('frontend.login.hide') }}" aria-label="{{ __('frontend.login.show') }}" aria-pressed="false">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <label class="tick" for="remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="tick__box" aria-hidden="true"><i class="fas fa-check"></i></span>
                    <span>{{ __('frontend.login.stay_signed_in') }}</span>
                </label>

                <button type="submit" name="submit-form" class="btn btn--block gate__submit">
                    <span>{{ __('frontend.login.button') }}</span>
                    <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="gate__foot">
                {{ __('frontend.login.new_here') }}
                <a href="{{ route('register.form') }}" class="gate__swap">{{ __('frontend.login.register_link') }}</a>
            </p>
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
