@extends('frontend.layouts.main')
@section('title', __('inkwave.auth_pwd_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.auth_pwd_title'),
    'links' => [
        ['name' => __('inkwave.top_nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.auth_pwd_title')]
    ]
])





<div class="ag-login-page">
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split">
                
                {{-- Image Side --}}
                <div class="ag-split__img">
                    <img src="{{ asset('assets/images/recover-pwd-bg.webp') }}" alt="Recover Password">
                </div>

                {{-- Form Side --}}
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <span class="ag-eyebrow">{{ __('inkwave.auth_pwd_badge') }}</span>
                    <h1 class="ag-title">{{ __('inkwave.auth_pwd_title') }}</h1>

                    <form name="frmForgot" id="frmForgot" action="{{ route('password.email') }}" method="post">
                        @csrf

                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.auth_pwd_lbl_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('inkwave.auth_pwd_ph_email') }}" value="{{ old('email') }}" class="ag-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.auth_pwd_lbl_sec') }}</label>
                                <div class="ag-captcha-box @error('captcha') is-invalid @enderror">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.auth_pwd_ph_sec') }}">
                                    <div class="ag-captcha-box__img">@captcha</div>
                                </div>
                                @error('captcha') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ __('inkwave.auth_pwd_err_sec') }}</span> @enderror
                            </div>
                        @endif

                        <div style="margin-top: 40px;">
                            <button type="submit" name="submit-form" class="ag-submit-btn">{{ __('inkwave.auth_pwd_btn') }}</button>
                        </div>
                    </form>

                    <div class="ag-divider"><span>{{ __('inkwave.auth_pwd_or') }}</span></div>

                    <p class="ag-alt-action">
                        {{ __('inkwave.auth_pwd_remember_prompt') }}
                        <a href="{{ route('login.form') }}">{{ __('inkwave.auth_pwd_signin_link') }}</a>
                    </p>
                    
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmForgot").validate({
            errorElement: 'span',
            errorClass: 'ag-error-msg',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle"></i> ');
                error.appendTo(element.closest('.ag-field'));
            },
            highlight: function(element, errorClass, validClass) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.ag-captcha-box').addClass('is-invalid');
                } else {
                    $(element).addClass('is-invalid');
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                if ($(element).attr('name') === 'captcha') {
                    $(element).closest('.ag-captcha-box').removeClass('is-invalid');
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
                email: "{{ __('inkwave.auth_pwd_req_email') }}",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "{{ __('inkwave.auth_pwd_req_sec') }}"
                @endif
            }
        });
    });
</script>
@endpush
