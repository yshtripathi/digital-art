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

<section class="fm fm--login">
    <div class="fm__wrap">

        <div class="fm__head">
            <p class="fm__kicker">{{ __('frontend.login.label') }}</p>
            <h2 class="au-title">{{ __('frontend.login.heading') }}</h2>
            <p class="fm__copy">{{ __('frontend.login.aside') }}</p>
        </div>

        <div class="au-card">
            <div class="au-card__inner">

                @if(session('loginerror'))
                    <div class="au-alert" role="alert"><i class="fas fa-exclamation-circle"></i> {{ session('loginerror') }}</div>
                @endif

                <form name="frmLogin" id="frmLogin" class="au-form" action="{{ route('login.submit') }}" method="post" novalidate>
                    @csrf

                    <div class="au-field">
                        <label class="au-label" for="email">{{ __('frontend.login.email') }}</label>
                        <div class="au-input">
                            <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ __('frontend.login.email_ph') }}" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                        </div>
                        @error('email') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-field">
                        <label class="au-label" for="password">{{ __('frontend.login.password') }}</label>
                        <div class="au-input au-input--pass">
                            <i class="fas fa-lock au-input__icon" aria-hidden="true"></i>
                            <input type="password" name="password" id="password" autocomplete="current-password" placeholder="{{ __('frontend.login.password_ph') }}" class="@error('password') is-invalid @enderror">
                            <button type="button" class="au-eye" data-au-toggle data-show="{{ __('frontend.login.show') }}" data-hide="{{ __('frontend.login.hide') }}" aria-label="{{ __('frontend.login.show') }}" aria-pressed="false"><i class="fas fa-eye"></i></button>
                        </div>
                        @error('password') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-extras">
                        <label class="au-check">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            {{ __('frontend.login.remember') }}
                        </label>
                        <a href="{{ route('forgetpwd.form') }}" class="au-link">{{ __('frontend.login.forgot') }}</a>
                    </div>

                    <button type="submit" name="submit-form" class="au-submit">
                        {{ __('frontend.login.submit') }} <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

            </div>
        </div>

        <p class="au-alt">
            {{ __('frontend.login.new') }}
            <a href="{{ route('register.form') }}">{{ __('frontend.login.register') }}</a>
        </p>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmLogin").validate({
            errorElement: 'span',
            errorClass: 'au-error',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle"></i> ');
                error.appendTo(element.closest('.au-field'));
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
                    email: @json(__('frontend.login.email_valid'))
                }
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
</script>
@endpush
