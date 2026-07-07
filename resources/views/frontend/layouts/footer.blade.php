<!-- Main Footer -->
<footer class="main-footer">
    <!-- Newsletter Section (Top) -->
    <div class="newsletter-section">
        <div class="newsletter-container">
            <div class="footer-widget">
                <h4 class="widget-title">{{ __('inkwave.newsletter_title') }}</h4>
                <p class="newsletter-message">{{ __('inkwave.newsletter_subtitle') }}</p>
                <div class="subscribe-form">
                    <form>
                        <div class="form-group">
                            <input type="email" name="email" class="email" placeholder="{{ __('inkwave.email_placeholder') }}" required>
                            <button type="submit" class="subscribe-btn" aria-label="Subscribe">
                                {{ __('inkwave.subscribe_action') }} <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                    <p class="text-success suces_rinfo mt-3" style="display: none;">{{ __('inkwave.subscribe_success') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 3-Column Grid Section -->
    <div class="widgets-section">
        <div class="widgets-container">
            <div class="widgets-grid">
                <!-- Left: Brand & Contact Info -->
                <div class="footer-column">
                    <div class="footer-widget about-widget">
                        <div class="pb-3">
                            <a href="{{route('home')}}" class="footer-logo-link">
                                <img src="{{asset('assets/images/logo.webp')}}" alt="{{ $misc['Company Name'] ?? __('inkwave.fallback_company_name') }}" class="footer-logo-img">
                            </a>
                        </div>
                        <p class="brand-bio mb-4">{{ __('inkwave.brand_mission') }}</p>
                        <ul class="contact-info">
                            <li>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ $misc['Company Email'] ?? __('inkwave.fallback_email') }}">{{ $misc['Company Email'] ?? __('inkwave.fallback_email') }}</a>
                            </li>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $misc['Company Address'] ?? __('inkwave.fallback_address') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Column 2: Platform Links -->
                <div class="footer-column">
                    <div class="footer-widget">
                        <h4>{{ __('inkwave.menu_explore') }}</h4>
                        <ul class="user-links">
                            <li><a href="{{route('home')}}">{{ __('inkwave.menu_home') }}</a></li>
                            <li><a href="{{route('product-lists')}}">{{ __('inkwave.menu_catalog') }}</a></li>
                            <li><a href="{{route('about-us')}}">{{ __('inkwave.menu_about') }}</a></li>
                            <li><a href="{{route('contact')}}">{{ __('inkwave.menu_contact') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 3: Quick Categories -->
                <div class="footer-column">
                    <div class="footer-widget">
                        <h4>{{ __('inkwave.menu_collections') }}</h4>
                        <ul class="user-links">
                            <li><a href="{{route('product-lists', ['category' => 'anime-manga'])}}">{{ __('inkwave.collection_anime') }}</a></li>
                            <li><a href="{{route('product-lists', ['category' => 'pixel-art'])}}">{{ __('inkwave.collection_pixel') }}</a></li>
                            <li><a href="{{route('product-lists', ['category' => 'pop-art'])}}">{{ __('inkwave.collection_pop') }}</a></li>
                            <li><a href="{{route('product-lists', ['category' => 'street-art'])}}">{{ __('inkwave.collection_street') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 4: Support Links -->
                <div class="footer-column">
                    <div class="footer-widget">
                        <h4>{{ __('inkwave.menu_assistance') }}</h4>
                        <ul class="user-links">
                            <li><a href="{{route('pages','privacy-policy')}}">{{ __('inkwave.legal_privacy') }}</a></li>
                            <li><a href="{{route('pages','terms-conditions')}}">{{ __('inkwave.legal_terms') }}</a></li>
                            <li><a href="{{route('pages','refund-policy')}}">{{ __('inkwave.legal_refund') }}</a></li>
                            <li><a href="{{route('pages','delivery-policy')}}">{{ __('inkwave.legal_delivery') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="bottom-container">
            <div class="copyright-text">
                &copy; {{ date('Y') }} <a href="{{route('home')}}">{{ $misc['Company Name'] ?? __('inkwave.fallback_company_name') }}</a>. {{ __('inkwave.rights_reserved') }}
            </div>
            <div class="payment-icons">
                <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods">
            </div>
        </div>
    </div>
</footer>



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