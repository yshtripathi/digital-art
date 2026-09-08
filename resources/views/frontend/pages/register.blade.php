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





<div class="ag-login-page">
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split">
                
                {{-- Image Side --}}
                <div class="ag-split__img">
                    <img src="{{ asset('assets/images/registration.webp') }}" alt="Join Artora">
                </div>

                {{-- Form Side --}}
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <span class="ag-eyebrow">{{ __('managenovax.auth.reg_badge') }}</span>
                    <h1 class="ag-title">{{ __('managenovax.auth.reg_title') }}</h1>

                    <form name="frmRegister" id="frmRegister" action="{{ route('register.submit') }}" method="post">
                        @csrf

                        <div class="ag-field">
                            <label class="ag-label">{{ __('managenovax.auth.reg_lbl_name') }}</label>
                            <input type="text" name="name" id="name" placeholder="{{ __('managenovax.auth.reg_ph_name') }}" value="{{ old('name') }}" class="ag-input @error('name') is-invalid @enderror">
                            @error('name') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ag-field">
                            <label class="ag-label">{{ __('managenovax.auth.reg_lbl_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('managenovax.auth.reg_ph_email') }}" value="{{ old('email') }}" class="ag-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ag-grid-2">
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.auth.reg_lbl_pass') }}</label>
                                <input type="password" name="password" id="password" placeholder="{{ __('managenovax.auth.reg_ph_pass') }}" class="ag-input @error('password') is-invalid @enderror">
                                @error('password') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                            </div>

                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.auth.reg_lbl_conf_pass') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('managenovax.auth.reg_ph_conf_pass') }}" class="ag-input @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.auth.reg_lbl_sec') }}</label>
                                <div class="ag-captcha-box @error('captcha') is-invalid @enderror">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('managenovax.auth.reg_ph_sec') }}">
                                    <div class="ag-captcha-box__img">@captcha</div>
                                </div>
                                @error('captcha') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ __('managenovax.auth.reg_err_sec') }}</span> @enderror
                            </div>
                        @endif

                        <div style="margin-top: 24px;">
                            <button type="submit" name="submit-form" class="ag-submit-btn">{{ __('managenovax.auth.reg_btn') }}</button>
                        </div>
                    </form>

                    <div class="ag-divider"><span>{{ __('managenovax.auth.reg_or') }}</span></div>

                    <p class="ag-alt-action">
                        {{ __('managenovax.auth.reg_exist_prompt') }}
                        <a href="{{ route('login.form') }}">{{ __('managenovax.auth.reg_signin_link') }}</a>
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
        $("#frmRegister").validate({
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
@endpush
