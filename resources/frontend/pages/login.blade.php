@extends('frontend.layouts.main')
@section('main-content')
<style>
    .error {color:#F2A68D; }
</style>

     <section class="course-frm">
        <div class="container">
            <div class="row align-items-center">
                   <div class="col-md-6 col-12">
                      <div class="auth-frm">
                          @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('loginerror'))
    <div class="alert alert-danger">
        {{ session('loginerror') }}
    </div>
@endif
                    <form name="frmLogin" id="frmLogin" 
            action="{{route('login.submit')}}" method="post" class="login-page__form">
                                @csrf           
                        <h3 class="mb-5">{{ __('common.login') }}</h3>
                        <div class="mb-2">
                            <label class="fw-bold text-dark mb-2">{{ __('common.email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('common.email') }}" value="{{old('email')}}" class="form-control">
                                            @error('email')
                                                <span class="text-danger">{{$message}}</span>
                            @enderror
</div>
 <div class="mb-2">
                            <label class="fw-bold text-dark mb-2">{{ __('common.password') }}</label>
                           <input type="password" name="password" id="password" placeholder="{{ __('common.password') }}" value="{{old('password')}}"  class="form-control">
                                            @error('password')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
</div>
  <button class="theme-btn btn-style-one bg-theme-color4 mt-4 mb-5" type="submit" name="submit-form">{{ __('common.login') }}</button>
                          </form>
                     <p>{{ __('common.dont_have_account') }} <a href="{{route('register.form')}}">{{ __('common.sign_up') }}</a></p>      <a href="{{route('forgetpwd.form')}}" >{{ __('common.lost_password_text') }}?</a>
</div>
</div>
<div class="col-md-5 col-12 offset-md-1 text-center d-none d-xl-block d-lg-block">
       <img src="{{url('assets/images/login.gif')}}" class="mx-auto" alt="login-img">
</div>

</div>
</div>
</section>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#frmLogin").validate({
			rules: {
				password: {
					required: true,
					minlength: 5
				},
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				password: {
					required: "{{ __('common.password_required') }}",
					minlength: "{{ __('common.password_confirmation_min') }}"
				},
				email: "{{ __('common.email_required') }}"
			}
		});
    });
</script>
@endpush
