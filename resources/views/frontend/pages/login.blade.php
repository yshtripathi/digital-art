@extends('frontend.layouts.main')
@section('title', __('inkwave.login_pg_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.login_pg_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.login_pg_title')]
    ]
])





<div class="ag-login-page">
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split">
                
                {{-- Image Side --}}
                <div class="ag-split__img">
                    <img src="{{ asset('assets/images/login-bg.webp') }}" alt="Login to Artora">
                </div>

                {{-- Form Side --}}
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <span class="ag-eyebrow">{{ __('inkwave.login_pg_badge') }}</span>
                    <h1 class="ag-title">{{ __('inkwave.login_pg_title') }}</h1>

                    <form name="frmLogin" id="frmLogin" action="{{ route('login.submit') }}" method="post">
                        @csrf

                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.login_fld_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('inkwave.login_fld_email') }}" value="{{ old('email') }}" class="ag-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.login_fld_pass') }}</label>
                            <input type="password" name="password" id="password" placeholder="{{ __('inkwave.login_fld_pass') }}" class="ag-input @error('password') is-invalid @enderror">
                            @error('password') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ag-form-extras">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="ag-checkbox-mark"></span>
                                <span class="ag-checkbox-text">Remember Me</span>
                            </label>
                            <a href="{{ route('forgetpwd.form') }}">{{ __('inkwave.login_lost_pwd') }}</a>
                        </div>

                        <div>
                            <button type="submit" name="submit-form" class="ag-submit-btn">{{ __('inkwave.login_btn_submit') }}</button>
                        </div>
                    </form>

                    <div class="ag-divider"><span>{{ __('inkwave.login_or_div') }}</span></div>

                    <p class="ag-alt-action">
                        {{ __('inkwave.login_new_user') }}
                        <a href="{{ route('register.form') }}">{{ __('inkwave.login_create_link') }}</a>
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
        $("#frmLogin").validate({
            errorElement: 'span',
            errorClass: 'ag-error-msg',
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle"></i> ');
                error.appendTo(element.closest('.ag-field'));
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            rules: {
                password: { required: true, minlength: 5 },
                email: { required: true, email: true }
            },
            messages: {
                password: {
                    required: "{{ __('inkwave.login_req_pass') }}",
                    minlength: "{{ __('inkwave.login_min_pass') }}"
                },
                email: "{{ __('inkwave.login_req_email') }}"
            }
        });
    });
</script>
@endpush
