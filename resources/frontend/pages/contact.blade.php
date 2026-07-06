@extends('frontend.layouts.main')
@section('main-content')
<style>
    .contact-three__input-box {
        margin-bottom: 10px;
    }
    .contact-three__input-title {display: none;}
</style>


<section class="page-title" style="background-image: url(images/background/page-title.jpg);">
		<div class="auto-container">
			<div class="title-outer">
				<h1 class="title">{{ __('common.contact') }}</h1>
				<ul class="page-breadcrumb">
					<li><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
					<li>{{ __('common.contact') }}</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- end main-content -->

	<!--Contact Details Start-->
	<section class="contact-details">
		<div class="container ">
			<div class="row">
				<div class="col-xl-7 col-lg-6">
					<div class="sec-title">
						<span class="sub-title">Send us email</span>
						<h2>Feel free to write</h2>
					</div>
					<!-- Contact Form -->
                                 @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
					<form method="POST" action="{{ route('contact.send') }}" class="contact-three__form" id="contactform">
                           @csrf
                                     
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">
                                        <h4 class="contact-three__input-title">{{ __('common.name') }}</h4>
                                        <div class="contact-three__input-box">
                                             <input type="text" name="name" id="name" placeholder="{{ __('common.enter_name') }}" class="form-control">
                              @error('name')
        <span class="text-danger" id="email-error">{{$message}}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <h4 class="contact-three__input-title">{{ __('common.phone') }} *</h4>
                                        <div class="contact-three__input-box">
                                             <input type="text" name="phone" id="phone" placeholder="{{ __('common.phone') }}"  class="form-control">
                            @error('phone')
                    <span class="text-danger" id="phone-error">{{$message}}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12">
                                        <h4 class="contact-three__input-title">{{ __('common.email') }} *</h4>
                                        <div class="contact-three__input-box">
                                            <input type="email" name="email" id="email" placeholder="{{ __('common.enter_email') }}"  class="form-control">
                            @error('email')
                                                    <span class="text-danger" id="email-error">{{$message}}</span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <h4 class="contact-three__input-title">Subject *</h4>
                                        <div class="contact-three__input-box">
                                            <input type="text" name="subject" id="subject" placeholder="{{ __('common.enter_subject') }}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <h4 class="contact-three__input-title">Message *</h4>
                                        <div class="contact-three__input-box text-message-box">
                                            <textarea name="message" id="message" placeholder="{{ __('common.enter_message') }}"  class="form-control"></textarea>
                                        </div>
                                        <div class="contact-three__btn-box">
                                            <button type="submit" class="theme-btn btn-style-one"><span>{{ __('common.submit') }}</span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
					<!-- Contact Form Validation-->
				</div>
				<div class="col-xl-5 col-lg-6">
					<div class="contact-details__right">
						<div class="sec-title">
							<span class="sub-title">Need any help?</span>
							<h2>Get in touch with us</h2>
							<div class="text">Lorem ipsum is simply free text available dolor sit amet consectetur notted adipisicing elit sed do eiusmod tempor incididunt simply dolore magna.</div>
						</div>
						<ul class="list-unstyled contact-details__info">
							
							<li>
								<div class="icon">
									<span class="lnr-icon-envelope1"></span>
								</div>
								<div class="text">
									<h6>Write email</h6>
									<a href="javascript:void(0)"><span>support@learnmtx.com</span></a>
								</div>
							</li>
							<li>
								<div class="icon">
									<span class="lnr-icon-location"></span>
								</div>
								<div class="text">
									<h6>Visit anytime</h6>
									<span>UNIT 1812, 18/F.,<br> CHINAWEAL CENTRE, 414-424 JAFFE ROAD,<br> CAUSEWAY BAY, HONGKONG</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('styles')
<style>
    
    .error {color:#EF802E !important;}
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#contactform").validate({
            rules: {
                name: "required",
                subject: "required",                
                phone: {
                    required: true,
                    minlength: 10
                },
                email: {
                    required: true,
                    email: true
                },
                message: "required"
            },
            messages: {
                name: "{{ __('common.name_required') }}",
                subject: " {{ __('common.subject_required') }}",
                email: "{{ __('common.email_required') }}",            
                phone: {
                    required: " {{ __('common.phone_required') }}",
                    minlength: "{{ __('common.phone_min') }}"
                },
                message: " {{ __('common.message_required') }}"
            },
           
        });
    });
</script>

@endpush