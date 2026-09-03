<!-- Main Duolingo Theme Footer -->


<footer class="art-footer">
    <div class="art-footer-container">
        
        <!-- Newsletter Section -->
        <div class="art-footer-newsletter subscribe-form-wrapper">
            <h4>{{ __('inkwave.ft_newsletter_title') }}</h4>
            <p>{{ __('inkwave.ft_newsletter_subtitle') }}</p>
            <form class="art-newsletter-form subscribe-form">
                <input type="email" name="email" class="email" placeholder="{{ __('inkwave.ft_email_placeholder') }}" required>
                <button type="submit" aria-label="Subscribe">
                    {{ __('inkwave.ft_subscribe_action') }}
                </button>
            </form>
            <p class="suces_rinfo mt-3">{{ __('inkwave.ft_subscribe_success') }}</p>
        </div>

        <!-- Widgets Grid -->
        <div class="art-footer-grid">
            
            <!-- Column 1: Brand -->
            <div class="art-footer-column">
                <a href="{{route('home')}}" class="art-footer-logo">
                    <img src="{{asset('assets/images/logo.png')}}" alt="{{ $misc['Company Name'] ?? __('inkwave.ft_fallback_company_name') }}">
                </a>
                <p class="art-footer-brand-bio">{{ __('inkwave.ft_brand_mission') }}</p>
                <ul class="art-footer-contact">
                    <li><i class="fas fa-building mt-1"></i> <span>{{ $misc['Company Name'] ?? __('inkwave.ft_fallback_company_name') }}</span></li>
                    <li><i class="fas fa-envelope mt-1"></i> <a href="mailto:{{ $misc['Company Email'] ?? __('inkwave.ft_fallback_email') }}">{{ $misc['Company Email'] ?? __('inkwave.ft_fallback_email') }}</a></li>
                    <li><i class="fas fa-map-marker-alt mt-1"></i> <span>{{ $misc['Company Address'] ?? __('inkwave.ft_fallback_address') }}</span></li>
                </ul>
            </div>

            <!-- Column 2: Explore -->
            <div class="art-footer-column">
                <h4>{{ __('inkwave.ft_menu_explore') }}</h4>
                <ul class="art-footer-links">
                    <li><a href="{{route('home')}}">{{ __('inkwave.ft_menu_home') }}</a></li>
                    <li><a href="{{route('product-lists')}}">{{ __('inkwave.ft_menu_catalog') }}</a></li>
                    <li><a href="{{route('about-us')}}">{{ __('inkwave.ft_menu_about') }}</a></li>
                    <li><a href="{{route('contact')}}">{{ __('inkwave.ft_menu_contact') }}</a></li>
                </ul>
            </div>

            <!-- Column 3: Collections -->
            <div class="art-footer-column">
                <h4>{{ __('inkwave.ft_menu_collections') }}</h4>
                <ul class="art-footer-links">
                    @php
                        $footerCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
                    @endphp
                    @forelse($footerCategories as $cat)
                        <li><a href="{{ route('product-lists', $cat->slug) }}">{{ $cat->title }}</a></li>
                    @empty
                        <li><span>{{ __('inkwave.nav_no_categories') }}</span></li>
                    @endforelse
                </ul>
            </div>

            <!-- Column 4: Assistance -->
            <div class="art-footer-column">
                <h4>{{ __('inkwave.ft_menu_assistance') }}</h4>
                <ul class="art-footer-links">
                    <li><a href="{{route('pages','privacy-policy')}}">{{ __('inkwave.ft_legal_privacy') }}</a></li>
                    <li><a href="{{route('pages','terms-conditions')}}">{{ __('inkwave.ft_legal_terms') }}</a></li>
                    <li><a href="{{route('pages','refund-policy')}}">{{ __('inkwave.ft_legal_refund') }}</a></li>
                    <li><a href="{{route('pages','delivery-policy')}}">{{ __('inkwave.ft_legal_delivery') }}</a></li>
                </ul>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="art-footer-bottom">
            <div class="art-footer-copyright">
                &copy; {{ date('Y') }} <a href="{{route('home')}}">{{ $misc['Company Name'] ?? __('inkwave.ft_fallback_company_name') }}</a>. {{ __('inkwave.ft_rights_reserved') }}
            </div>
            <div class="art-footer-payment">
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
    var subTimer;

    $(".subscribe-form").on('submit', function(event){
        event.preventDefault();

        var $form  = $(this);
        var $email = $form.find('input[type="email"]');
        var value  = ($email.val() || '').trim();
        var isValid = value !== '' && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);

        // Only show the success message for a filled, valid email
        if (!isValid) {
            if ($email[0] && $email[0].reportValidity) {
                $email[0].reportValidity();
            }
            $email.trigger('focus');
            return;
        }

        // show the message, cancelling any previous auto-hide timer
        clearTimeout(subTimer);
        $(".suces_rinfo").stop(true, true).fadeIn(200);

        // reset the actual <form> element (this handler is bound to the wrapper div)
        var formEl = $form.is('form') ? $form[0] : $form.find('form')[0];
        if (formEl) { formEl.reset(); }

        // auto-hide the message after a few seconds
        subTimer = setTimeout(function(){
            $(".suces_rinfo").fadeOut(400);
        }, 4000);
    });
</script>
@if(env('CONTENT_PROTECTION_ENABLED', true))
<script src="{{ asset('js/prevention.js') }}"></script>
@endif
</body>
</html>