<!-- Main Footer -->
<footer class="main-footer">
    <!-- Newsletter Section (Top) -->
    <div class="newsletter-section border-bottom py-5">
        <div class="auto-container">
            <div class="footer-widget">
                <h4 class="widget-title mb-4">{{ __('common.stay_updated') }}</h4>
                <div class="subscribe-form">
                    <form>
                        <div class="form-group">
                            <input type="email" name="email" class="email" placeholder="{{ __('common.your_email_address') }}" required>
                            <button type="submit" class="theme-btn"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                    <p class="text-success suces_rinfo mt-3" style="display: none;">{{ __('common.thanks_for_subscribing') }}</p>
                </div>
                <p class="newsletter-message mt-4">{{ __('common.subscribe_description') }}</p>
            </div>
        </div>
    </div>

    <!-- 3-Column Grid Section -->
    <div class="widgets-section py-5">
        <div class="auto-container">
            <div class="row g-5">
                <!-- Left: Brand & Contact Info -->
                <div class="footer-column col-xl-4 col-lg-4 col-md-12">
                    <div class="footer-widget about-widget">
                        <div class="pb-3">
                            <a href="{{route('home')}}">
                                <img src="{{url('assets/images/logo.webp')}}" alt="{{ $misc['Company Name'] ?? __('common.company_name') }}" style="max-width: 250px;">
                            </a>
                        </div>

                        <ul class="contact-info">
                            <li><i class="fas fa-envelope"></i> <a href="mailto:{{ $misc['Company Email'] ?? __('common.company_email') }}">{{ $misc['Company Email'] ?? __('common.company_email') }}</a></li>
                            <li><i class="fas fa-map-marker-alt"></i> <span>{{ $misc['Company Address'] ?? __('common.company_Address') }}</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Middle: Platform Links -->
                <div class="footer-column col-xl-4 col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">{{ __('common.platform') }}</h4>
                        <ul class="user-links">
                            <li><a href="{{route('home')}}">{{ __('common.home') }}</a></li>
                            <li><a href="{{route('product-lists')}}">{{ __('common.catalog') }}</a></li>
                            <li><a href="{{route('about-us')}}">{{ __('common.about') }}</a></li>
                            <li><a href="{{route('contact')}}">{{ __('common.contact') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Right: Support Links -->
                <div class="footer-column col-xl-4 col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">{{ __('common.support') }}</h4>
                        <ul class="user-links">
                            <li><a href="{{route('pages','privacy-policy')}}">{{ __('common.privacy_policy') }}</a></li>
                            <li><a href="{{route('pages','terms-conditions')}}">{{ __('common.terms_policy') }}</a></li>
                            <li><a href="{{route('pages','refund-policy')}}">{{ __('common.refund_policy') }}</a></li>
                            <li><a href="{{route('pages','delivery-policy')}}">{{ __('common.delivery_policy') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>


    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="copyright-text">
                    &copy; {{ date('Y') }} <a href="{{route('home')}}">{{ $misc['Company Name'] ?? __('common.company_name') }}</a>. {{ __('common.all_rights_reserved') }}
                </div>
                <div class="payment-icons">
                    <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods" style="height: 25px;">
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
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
     $('.alert:not(.alert-dismissible)').slideUp();
     $('.modern-alert').fadeOut(function() {
       $(this).remove();
     });
 }, 5000);
$(".suces_rinfo").hide();

$(".subscribe-form").on('submit', function(event){
    event.preventDefault();
    $(".suces_rinfo").show();

    // reset form
    $(".subscribe-form form")[0].reset();

    // hide success message after 5 seconds
    setTimeout(function(){
        $(".suces_rinfo").fadeOut();
    }, 5000);
});
</script>
<script>
 
// Disable right click
document.addEventListener('contextmenu', e => e.preventDefault());
 
// Disable common shortcut keys
document.addEventListener('keydown', function(e) {
 
    // Prevent Print Screen
    if (e.key === 'PrintScreen') {
        navigator.clipboard.writeText('');
        alert('Screenshots are disabled.');
        e.preventDefault();
    }
 
    // Prevent Ctrl+Shift+I / DevTools
    if (
        (e.ctrlKey && e.shiftKey && e.key === 'I') ||
        (e.ctrlKey && e.shiftKey && e.key === 'J') ||
        (e.ctrlKey && e.key === 'U') ||
        (e.key === 'F12')
    ) {
        e.preventDefault();
    }
});
 
</script>
<script>
document.addEventListener('contextmenu', event => {
    event.preventDefault();
});
</script>

</body>
</html>