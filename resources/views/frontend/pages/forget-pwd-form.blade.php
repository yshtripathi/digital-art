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
    <div class="auth__shell">
        <aside class="auth__side">
            <div class="pre__orb auth__orb" aria-hidden="true">
                <span class="pre__ring"></span>
                <span class="pre__ring pre__ring--slow"></span>
                <span class="pre__wave"></span>
                <svg class="pre__pulse" viewBox="0 0 120 60" focusable="false">
                    <polyline points="0,34 22,34 30,28 38,40 48,12 58,46 66,30 76,34 88,24 98,26 120,8"/>
                </svg>
            </div>
            <span class="eyebrow">{{ __('frontend.forgot.badge') }}</span>
            <h2 class="auth__title">{{ __('frontend.forgot.heading') }}</h2>
            <p class="auth__lead">{{ __('frontend.forgot.lead') }}</p>
            <ul class="auth__points auth__points--steps">
                @foreach(__('frontend.forgot.steps') as $point)
                    <li>
                        <span class="auth__mark num" aria-hidden="true">{{ $loop->iteration }}</span>
                        <span>{{ $point }}</span>
                    </li>
                @endforeach
            </ul>
        </aside>

        <div class="auth__main">
            <a href="{{ route('login.form') }}" class="auth__back">
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                {{ __('frontend.forgot.go_back') }}
            </a>

            @if(session('status'))
                <p class="msg msg--ok" role="status">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    <span>{{ __('frontend.forgot.sent') }}</span>
                </p>
            @endif

            <form name="frmForgot" id="frmForgot" action="{{ route('password.email') }}" method="post" novalidate>
                @csrf

                <div class="auth__fields">
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
                                <div class="fld__box">
                                    <i class="fas fa-shield-alt fld__icon" aria-hidden="true"></i>
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" class="fld__input" placeholder="{{ __('frontend.forgot.code_hint') }}">
                                </div>
                                <div class="cap__img">@captcha</div>
                            </div>
                            @error('captcha')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ __('frontend.forgot.code_wrong') }}</span>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" name="submit-form" class="btn btn--primary btn--block auth__submit">
                        {{ __('frontend.forgot.submit') }}
                        <i class="fas fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </div>
            </form>
            <p class="auth__divider"><span>{{ __('frontend.forgot.recall') }}</span></p>
            <a href="{{ route('login.form') }}" class="btn btn--ghost btn--block">{{ __('frontend.forgot.go_back') }}</a>
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
