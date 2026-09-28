@extends('frontend.layouts.main')
@section('title', __('frontend.forgot.page_name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.forgot.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.forgot.page_name')]
    ]
])

<section class="auth">
    <div class="auth__card">
        <div class="auth__head">
            <span class="auth__levels" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
            <h2 class="auth__title">{{ __('frontend.forgot.title') }}</h2>
            <p class="auth__lead">{{ __('frontend.forgot.intro') }}</p>
        </div>

        @if(session('status'))
            <p class="auth__msg auth__msg--ok" role="status">
                <i class="fas fa-check-circle" aria-hidden="true"></i>
                <span>{{ __('frontend.forgot.done') }}</span>
            </p>
        @endif

        <form name="frmForgot" id="frmForgot" class="auth__form" action="{{ route('password.email') }}" method="post" novalidate>
            @csrf

            <div class="fld">
                <label class="fld__label" for="email">{{ __('frontend.forgot.mail_label') }}</label>
                <div class="fld__box">
                    <i class="fas fa-envelope fld__icon" aria-hidden="true"></i>
                    <input type="email" name="email" id="email" autocomplete="email" class="fld__input @error('email') is-invalid @enderror" placeholder="{{ __('frontend.forgot.mail_hint') }}" value="{{ old('email') }}">
                </div>
                @error('email')
                    <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                @enderror
            </div>

            @if(env('CAPTCHA_ENABLED', true))
                <div class="fld">
                    <label class="fld__label" for="captcha">{{ __('frontend.forgot.code_label') }}</label>
                    <div class="cap @error('captcha') is-invalid @enderror">
                        <div class="cap__img">@captcha</div>
                        <div class="fld__box">
                            <i class="fas fa-shield-alt fld__icon" aria-hidden="true"></i>
                            <input type="text" id="captcha" name="captcha" autocomplete="off" class="fld__input" placeholder="{{ __('frontend.forgot.code_hint') }}">
                        </div>
                    </div>
                    @error('captcha')
                        <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ __('frontend.forgot.code_wrong') }}</span>
                    @enderror
                </div>
            @endif

            <button type="submit" name="submit-form" class="btn btn--block auth__submit">{{ __('frontend.forgot.send_link') }}</button>
        </form>

        <p class="auth__foot">
            {{ __('frontend.forgot.remember') }}
            <a href="{{ route('login.form') }}">{{ __('frontend.forgot.login') }}</a>
        </p>
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
                    required: @json(__('frontend.forgot.mail_empty')),
                    email: @json(__('frontend.forgot.mail_wrong'))
                },
                @if(env('CAPTCHA_ENABLED', true))
                captcha: @json(__('frontend.forgot.code_empty'))
                @endif
            }
        });
    });
</script>
@endpush
