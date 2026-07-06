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
                               <form name="frmRegister" id="frmRegister" action="{{route('register.submit')}}" method="post">  
            @csrf
                        <h3 class="mb-5">Create an account</h3>
                        <div class="mb-2">
                            <label class="fw-bold text-dark mb-2">{{ __('common.name') }}</label>
                            <input type="text" name="name" id="name" placeholder="{{ __('common.name') }}" class="form-control" value="{{old('name')}}">
                                                @error('name')
                                                    <span class="text-danger" id="name-error">{{$message}}</span>
                                                @enderror
</div>
 <div class="mb-2">
                            <label class="fw-bold text-dark mb-2">{{ __('common.email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('common.email') }}" value="{{old('email')}}" class="form-control" required>
                                            @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror  
</div>
 <div class="mb-2">
                            <label class="fw-bold text-dark mb-2">{{ __('common.password') }}</label>
                           <input type="password" name="password" id="password" placeholder="{{ __('common.password') }}" value="{{old('password')}}" class="form-control toggle-password-input" required>
                                            @error('password')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
</div>
                                   <div class="mb-2">
                            <label class="fw-bold text-dark mb-2">{{ __('common.confirm_password') }}</label>
                          <input type="password" name="password_confirmation" id="password_confirmation" placeholder="{{ __('common.confirm_password') }}" class="form-control" >
                                                @error('password_confirmation')
                                                    <span class="text-danger" id="password_confirmation-error">{{$message}}</span>
                                                @enderror
</div>
  <button class="theme-btn btn-style-one bg-theme-color4 mt-4 mb-1 w-100" type="submit" name="submit-form">Login Now</button>
                          </form> 
                           <p>Already have an account? <a href="{{route('login.form')}}">Login Here</a></p>
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
        $("#frmRegister").validate({
			rules: {
              name: {
					required: true,
					minlength: 5
				},
				password: {
					required: true,
					minlength: 5
				},
              password_confirmation: {
					required: true,
					minlength: 5,
                  equalTo: "#password"
				},
				email: {
					required: true,
					email: true
				},
                terms:"required",
			},
			messages: {
              name: "{{ __('common.name_required') }}",
				password: {
					required: "{{ __('common.password_required') }}",
					minlength: "{{ __('common.password_min') }}"
				},
              password_confirmation: {
					required: "{{ __('common.password_confirmation_required') }}",
					minlength: "{{ __('common.password_confirmation_min') }}",
                    equalTo: "Passwords do not match."
				},
				email: "{{ __('common.email_required') }}",
               terms: "Please accept our terms and conditions"  
			}
		});
    });
</script>
@endpush
