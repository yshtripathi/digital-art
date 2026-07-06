<!-- Main Footer -->
	<footer class="main-footer">
		<!--Widgets Section-->
		<div class="widgets-section">
			<div class="auto-container">
				<div class="row">
					<!--Footer Column-->
					<div class="footer-column col-xl-4 col-lg-12 col-md-6 col-sm-12">
						<div class="footer-widget about-widget">
							<div class="logo"><a href="{{route('home')}}"><img src="{{url('assets/images/logo-2.png')}}" alt="" ></a></div>
							<div class="text">Fueling Your Future with 75+ Courses</div>
							<div class="subscribe-form">
									<form>
										<div class="form-group">
											<input type="email" name="email" class="email" value="" placeholder="Email Address" required>
											<button type="submit" class="theme-btn btn-style-one"><i class="fa fa-long-arrow-alt-right"></i></button>
										</div>
									</form>
                                 <p class="text-white">Thanks for subscribing to our newsletter.</p>
								</div>
						</div>
					</div>

					<!--Footer Column-->
					<div class="footer-column col-xl-2 col-lg-4 col-md-6 col-sm-12">
						<div class="footer-widget">
							<h4 class="widget-title">Quick Links</h4>
							<ul class="user-links">
								<li><a href="{{route('home')}}">{{ __('common.home') }} </a></li>
								<li><a href="{{route('product-lists')}}">{{ __('common.courses') }}  </a></li>
								<li><a href="{{route('about-us')}}">{{ __('common.about') }} </a></li>
								<li><a href="{{route('instructor')}}">{{ __('common.instructors') }}</a></li>
								<li><a href="{{route('contact')}}">{{ __('common.contact') }} </a></li>
								
							</ul>
						</div>
					</div>

					<!--Footer Column-->
					<div class="footer-column col-xl-2 col-lg-4 col-md-6 col-sm-12">
						<div class="footer-widget">
							<h4 class="widget-title">Support</h4>
							<ul class="user-links">
								<li><a href="{{route('pages','privacy-policy')}}">  {{ __('common.privacy_policy') }}</a></li>
                                            <li><a href="{{route('pages','terms-conditions')}}"> 
                                        {{ __('common.terms_policy') }}</a></li>
                                            <li><a href="{{route('pages','refund-policy')}}"> {{ __('common.refund_policy') }}</a>
                                            </li>
                                            <li><a href="{{route('pages','delivery-policy')}}"> 
                                                    {{ __('common.delivery_policy') }}</a></li>
                                          
								
							</ul>
						</div>
					</div>

					<!--Footer Column-->
					<div class="footer-column col-xl-4 col-lg-4 col-md-6 col-sm-12">
						<div class="footer-widget contact-widget">
							<h4 class="widget-title">Contact</h4>
							<div class="widget-content">
								<ul class="contact-info">
									<!-- <li><i class="fa fa-phone-square"></i> <a href="tel:+926668880000">+92 (0088) 6823</a></li> -->
									<li><i class="fa fa-envelope"></i> <a href="mailto:support@learnmtx.com">Support@learnmtx.com</a></li>
									<li><i class="fa fa-map-marker-alt"></i> UNIT 1812, 18/F., CHINAWEAL CENTRE, 414-424 JAFFE ROAD, CAUSEWAY BAY, HONGKONG</li>
								</ul>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--Footer Bottom-->
		<div class="footer-bottom">
			<div class="auto-container">
				<div class="inner-container">
					<div class="row">
				      <div class="col-lg-6 col-12">		
					   <div class="copyright-text">&copy; Copyright  2025 <a href="{{route('home')}}">Learnmtx.com</a>. All Rights Reserved.</div>
                        </div>  
						  <div class="col-lg-6 col-12">		
					          <img src="{{url('assets/images/payment.png')}}" alt="payment-icn" class="img-fluid">
                        </div>  
					</div>
				 </div>
			</div>
		</div>
	</footer>
	<!--End Main Footer -->

</div><!-- End Page Wrapper -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
<script src="{{url('assets/js/jquery.js')}}"></script> 
<script src="{{url('assets/js/popper.min.js')}}"></script>
<!--Revolution Slider-->
<script src="{{url('assets/plugins/revolution/js/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{url('assets/plugins/revolution/js/extensions/revolution.extension.video.min.js')}}"></script>
<script src="{{url('assets/js/main-slider-script.js')}}"></script>
<!--Revolution Slider-->
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/jquery.fancybox.js')}}"></script>
<script src="{{url('assets/js/jquery-ui.js')}}"></script>
<script src="{{url('assets/js/wow.js')}}"></script>
<script src="{{url('assets/js/appear.js')}}"></script>
<script src="{{url('assets/js/jquery.countdown.js')}}"></script>
<script src="{{url('assets/js/select2.min.js')}}"></script>
<script src="{{url('assets/js/swiper.min.js')}}"></script>
<script src="{{url('assets/js/owl.js')}}"></script>
<script src="{{url('assets/js/script.js')}}"></script>
<script>
 setTimeout(function() {   
     $('.alert').slideUp();    
	}, 4000);
    
    $(".text-white").hide();
$(".fa-long-arrow-alt-right").on('click',function(event){
    event.preventDefault();
      $(".text-white").show();
   $(".subscribe-form form")[0].reset();
});
     
</script>
</body>
</html>