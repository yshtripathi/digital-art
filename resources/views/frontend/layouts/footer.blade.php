<!-- Main Footer -->
<footer class="main-footer">
    <!-- Newsletter Section (Top) -->
    <div class="newsletter-section">
        <div class="newsletter-container">
            <div class="footer-widget">
                <h4 class="widget-title">{{ __('common.stay_updated') }}</h4>
                <p class="newsletter-message">{{ __('common.subscribe_description') }}</p>
                <div class="subscribe-form">
                    <form>
                        <div class="form-group">
                            <input type="email" name="email" class="email" placeholder="{{ __('common.your_email_address') }}" required>
                            <button type="submit" class="subscribe-btn" aria-label="Subscribe">
                                {{ __('common.subscribe') ?? 'Subscribe' }} <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                    <p class="text-success suces_rinfo mt-3" style="display: none;">{{ __('common.thanks_for_subscribing') }}</p>
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
                                <img src="{{asset('assets/images/logo.webp')}}" alt="{{ $misc['Company Name'] ?? __('common.company_name') }}" class="footer-logo-img">
                            </a>
                        </div>
                        <p class="brand-bio mb-4">Discover, collect, and trade premium digital art prints from global creators.</p>
                        <ul class="contact-info">
                            <li>
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ $misc['Company Email'] ?? __('common.company_email') }}">{{ $misc['Company Email'] ?? __('common.company_email') }}</a>
                            </li>
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $misc['Company Address'] ?? __('common.company_Address') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Column 2: Platform Links -->
                <div class="footer-column">
                    <div class="footer-widget">
                        <h4>{{ __('common.platform') }}</h4>
                        <ul class="user-links">
                            <li><a href="{{route('home')}}">{{ __('common.home') }}</a></li>
                            <li><a href="{{route('product-lists')}}">{{ __('common.catalog') }}</a></li>
                            <li><a href="{{route('about-us')}}">{{ __('common.about') }}</a></li>
                            <li><a href="{{route('contact')}}">{{ __('common.contact') }}</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 3: Quick Categories -->
                <div class="footer-column">
                    <div class="footer-widget">
                        <h4>{{ __('common.categories') ?? 'Categories' }}</h4>
                        <ul class="user-links">
                            <li><a href="{{route('product-lists', ['category' => 'anime-manga'])}}">Anime & Manga</a></li>
                            <li><a href="{{route('product-lists', ['category' => 'pixel-art'])}}">Pixel Art</a></li>
                            <li><a href="{{route('product-lists', ['category' => 'pop-art'])}}">Pop Art</a></li>
                            <li><a href="{{route('product-lists', ['category' => 'street-art'])}}">Street Art</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Column 4: Support Links -->
                <div class="footer-column">
                    <div class="footer-widget">
                        <h4>{{ __('common.support') }}</h4>
                        <ul class="user-links">
                            <li><a href="{{route('pages','privacy-policy')}}">{{ __('common.privacy_policy') }}</a></li>
                            <li><a href="{{route('pages','terms-conditions')}}">{{ __('common.terms_policy') }}</a></li>
                            <li><a href="{{route('pages','refund-policy')}}">{{ __('common.refund_policy') }}</a></li>
                            <li><a href="{{route('pages','delivery-policy')}}">{{ __('common.delivery_policy') }}</a></li>
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
                &copy; {{ date('Y') }} <a href="{{route('home')}}">{{ $misc['Company Name'] ?? __('common.company_name') }}</a>. {{ __('common.all_rights_reserved') }}
            </div>
            <div class="payment-icons">
                <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods">
            </div>
        </div>
    </div>
</footer>

<style>
    @keyframes footer-slide-up {
        from {
            opacity: 0;
            transform: translateY(24px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ==========================================================================
       Redesigned Premium Footer Styling (Ink Black / Minimalist Gallery Theme)
       ========================================================================== */
    .main-footer {
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        border-top: 1px solid var(--color-vellum, #dfdcd5) !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .main-footer .footer-column {
        animation: footer-slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) both !important;
    }
    .main-footer .footer-column:nth-child(1) { animation-delay: 0.1s !important; }
    .main-footer .footer-column:nth-child(2) { animation-delay: 0.2s !important; }
    .main-footer .footer-column:nth-child(3) { animation-delay: 0.3s !important; }
    .main-footer .footer-column:nth-child(4) { animation-delay: 0.4s !important; }

    .footer-logo-img {
        max-height: 48px !important;
        width: auto !important;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }
    .footer-logo-link:hover .footer-logo-img {
        transform: scale(1.05) !important;
    }

    .main-footer a {
        color: rgba(255, 255, 255, 0.6) !important;
        text-decoration: none !important;
        transition: color 0.3s ease !important;
    }

    .main-footer a:hover {
        color: var(--color-paper, #ffffff) !important;
    }

    /* Newsletter Section (Top) */
    .main-footer .newsletter-section {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        padding: 60px 40px !important;
    }

    .main-footer .newsletter-container {
        max-width: 1200px !important;
        margin: 0 auto !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        text-align: center !important;
    }

    .main-footer .widget-title {
        font-family: var(--font-davinci, serif) !important;
        font-size: 22px !important;
        font-weight: 500 !important;
        letter-spacing: -0.01em !important;
        color: var(--color-paper, #ffffff) !important;
        text-transform: none !important;
        margin-bottom: 12px !important;
    }

    .main-footer .newsletter-message {
        font-size: 13.5px !important;
        color: rgba(255, 255, 255, 0.5) !important;
        max-width: 480px !important;
        margin: 0 auto !important;
        line-height: 1.5 !important;
    }

    .main-footer .subscribe-form {
        width: 100% !important;
        max-width: 480px !important;
        margin: 24px auto 0 auto !important;
    }

    .main-footer .subscribe-form .form-group {
        display: flex !important;
        gap: 12px !important;
        align-items: center !important;
        width: 100% !important;
        position: relative !important;
    }

    .main-footer .subscribe-form .form-group::after {
        content: "" !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: calc(100% - 110px) !important;
        height: 1px !important;
        background-color: var(--color-paper, #ffffff) !important;
        transform: scaleX(0) !important;
        transform-origin: left !important;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .main-footer .subscribe-form .form-group:focus-within::after {
        transform: scaleX(1) !important;
    }

    .main-footer .subscribe-form input[type="email"] {
        flex-grow: 1 !important;
        background: transparent !important;
        border: none !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3) !important;
        outline: none !important;
        color: var(--color-paper, #ffffff) !important;
        font-size: 14px !important;
        padding: 8px 0 !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        transition: border-color 0.3s ease !important;
    }

    .main-footer .subscribe-form input[type="email"]:focus {
        border-color: var(--color-paper, #ffffff) !important;
    }

    .main-footer .subscribe-form input[type="email"]::placeholder {
        color: rgba(255, 255, 255, 0.3) !important;
    }

    .main-footer .subscribe-btn {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        background-color: var(--color-paper, #ffffff) !important;
        color: var(--color-ink, #000000) !important;
        border: 1px solid var(--color-paper, #ffffff) !important;
        border-radius: 28.8px !important; /* theme pill radius for filled action buttons */
        padding: 0 20px !important;
        height: 32px !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        white-space: nowrap !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .main-footer .subscribe-btn:hover {
        background-color: transparent !important;
        color: var(--color-paper, #ffffff) !important;
    }

    /* Widgets Section (Middle Grid) */
    .main-footer .widgets-section {
        padding: 60px 40px !important;
    }

    .main-footer .widgets-container {
        max-width: 1200px !important;
        margin: 0 auto !important;
    }

    .main-footer .widgets-grid {
        display: grid !important;
        grid-template-columns: 1.5fr 1fr 1fr 1fr !important;
        gap: 40px !important;
    }

    .main-footer .brand-bio {
        font-size: 13.5px !important;
        color: rgba(255, 255, 255, 0.5) !important;
        line-height: 1.5 !important;
    }

    @media (max-width: 991px) {
        .main-footer .widgets-grid {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }
    }

    .main-footer .footer-widget h4 {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        color: var(--color-paper, #ffffff) !important;
        margin-bottom: 20px !important;
    }

    .main-footer .footer-logo {
        font-family: var(--font-davinci, serif) !important;
        font-size: 24px !important;
        font-weight: 500 !important;
        color: var(--color-paper, #ffffff) !important;
        text-decoration: none !important;
        letter-spacing: -0.5px !important;
        display: inline-block !important;
        margin-bottom: 20px !important;
        transition: opacity 0.3s ease !important;
    }
    .main-footer .footer-logo:hover {
        opacity: 0.7 !important;
    }

    .main-footer .contact-info,
    .main-footer .user-links {
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .main-footer .contact-info li {
        font-size: 13.5px !important;
        color: rgba(255, 255, 255, 0.5) !important;
        margin-bottom: 12px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .main-footer .contact-info li i {
        color: var(--color-paper, #ffffff) !important;
        font-size: 12px !important;
        width: 16px !important;
        text-align: center !important;
    }

    .main-footer .user-links li {
        margin-bottom: 10px !important;
    }

    .main-footer .user-links li a {
        font-size: 13.5px !important;
        display: inline-block !important;
        position: relative !important;
        padding-bottom: 2px !important;
    }

    .main-footer .user-links li a::after {
        content: "" !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 1px !important;
        background-color: var(--color-paper, #ffffff) !important;
        transform: scaleX(0) !important;
        transform-origin: left !important;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .main-footer .user-links li a:hover::after {
        transform: scaleX(1) !important;
    }

    /* Footer Bottom Section */
    .main-footer .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        padding: 40px !important;
        background-color: var(--color-ink, #000000) !important;
    }

    .main-footer .bottom-container {
        max-width: 1200px !important;
        margin: 0 auto !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        flex-wrap: wrap !important;
        gap: 20px !important;
    }

    @media (max-width: 767px) {
        .main-footer .bottom-container {
            flex-direction: column !important;
            text-align: center !important;
        }
    }

    .main-footer .copyright-text {
        font-size: 12px !important;
        color: rgba(255, 255, 255, 0.4) !important;
    }

    .main-footer .payment-icons {
        opacity: 1 !important;
    }

    .main-footer .payment-icons img {
        height: 20px !important;
        width: auto !important;
    }

    /* Scroll To Top Button (Minimalist Capsule) */
    .scroll-to-top {
        display: none;
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 40px;
        height: 40px;
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 50% !important;
        text-align: center !important;
        line-height: 38px !important; /* Centers icon vertically */
        z-index: 999 !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
    }

    .scroll-to-top:hover {
        background-color: var(--color-paper, #ffffff) !important;
        color: var(--color-ink, #000000) !important;
        transform: translateY(-4px) !important;
    }

    .scroll-to-top span {
        font-size: 16px !important;
        line-height: 1 !important;
    }
</style>

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