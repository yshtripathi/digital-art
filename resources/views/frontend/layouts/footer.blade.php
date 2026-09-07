<footer class="ag-footer">
    <div class="ag-footer-inner">
        
        <!-- Newsletter Section -->
        <div class="ag-newsletter">
            <h4>{{ __('inkwave.footer_newsletter_title') }}</h4>
            <p>{{ __('inkwave.footer_newsletter_desc') }}</p>
            <form class="ag-newsletter-form subscribe-form">
                <input type="email" name="email" class="email" placeholder="{{ __('inkwave.footer_newsletter_placeholder') }}" required>
                <button type="submit" class="ag-btn-primary" aria-label="Subscribe" style="padding: 13px 24px !important; letter-spacing: 0.1em !important; font-size: 11px !important;">
                    {{ __('inkwave.footer_newsletter_btn') }}
                </button>
            </form>
            <p class="suces_rinfo" style="display: none;">{{ __('inkwave.footer_newsletter_success') }}</p>
        </div>

        <!-- Widgets Grid -->
        <div class="ag-footer-grid">
            
            <!-- Column 1: Brand -->
            <div class="ag-footer-col">
                <a href="{{route('home')}}" class="ag-footer-logo">
                    <img src="{{asset('assets/images/logo.png')}}" alt="{{ $misc['Company Name'] ?? __('inkwave.footer_company_fallback') }}" style="height: 50px; width: auto; object-fit: contain; aspect-ratio: auto;">
                </a>
                <p class="ag-footer-text" style="margin-bottom: 24px;">{{ __('inkwave.footer_brand_desc') }}</p>
                <ul class="ag-footer-links">
                    <li>
                        <span class="ag-footer-text">
                            <i class="fas fa-building"></i> 
                            {{ $misc['Company Name'] ?? __('inkwave.footer_company_fallback') }}
                        </span>
                    </li>
                    <li>
                        <a href="tel:{{ $misc['Company Phone'] ?? __('inkwave.footer_phone_fallback') }}">
                            <i class="fas fa-phone-alt"></i> 
                            {{ $misc['Company Phone'] ?? __('inkwave.footer_phone_fallback') }}
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $misc['Company Email'] ?? __('inkwave.footer_email_fallback') }}">
                            <i class="fas fa-envelope"></i> 
                            {{ $misc['Company Email'] ?? __('inkwave.footer_email_fallback') }}
                        </a>
                    </li>
                    <li>
                        <span class="ag-footer-text">
                            <i class="fas fa-map-marker-alt"></i> 
                            {{ $misc['Company Address'] ?? __('inkwave.footer_address_fallback') }}
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Column 2: Explore -->
            <div class="ag-footer-col">
                <h5>{{ __('inkwave.footer_nav_explore') }}</h5>
                <ul class="ag-footer-links">
                    <li><a href="{{route('home')}}">{{ __('inkwave.footer_nav_home') }}</a></li>
                    <li><a href="{{route('product-lists')}}">{{ __('inkwave.footer_nav_catalog') }}</a></li>
                    <li><a href="{{route('about-us')}}">{{ __('inkwave.footer_nav_about') }}</a></li>
                    <li><a href="{{route('contact')}}">{{ __('inkwave.footer_nav_contact') }}</a></li>
                </ul>
            </div>

            <!-- Column 3: Collections -->
            <div class="ag-footer-col">
                <h5>{{ __('inkwave.footer_nav_categories') }}</h5>
                <ul class="ag-footer-links">
                    @php
                        $footerCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
                    @endphp
                    @forelse($footerCategories as $cat)
                        <li><a href="{{ route('product-lists', $cat->slug) }}">{{ $cat->title }}</a></li>
                    @empty
                        <li><span class="ag-footer-text">{{ __('inkwave.nav_no_categories') }}</span></li>
                    @endforelse
                </ul>
            </div>

            <!-- Column 4: Assistance -->
            <div class="ag-footer-col">
                <h5>{{ __('inkwave.footer_nav_support') }}</h5>
                <ul class="ag-footer-links">
                    <li><a href="{{route('pages','privacy-policy')}}">{{ __('inkwave.footer_legal_privacy') }}</a></li>
                    <li><a href="{{route('pages','terms-conditions')}}">{{ __('inkwave.footer_legal_terms') }}</a></li>
                    <li><a href="{{route('pages','refund-policy')}}">{{ __('inkwave.footer_legal_refund') }}</a></li>
                    <li><a href="{{route('pages','delivery-policy')}}">{{ __('inkwave.footer_legal_delivery') }}</a></li>
                </ul>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="ag-footer-bottom">
            <div>
                &copy; {{ date('Y') }} <a href="{{route('home')}}">{{ $misc['Company Name'] ?? __('inkwave.footer_company_fallback') }}</a>. {{ __('inkwave.footer_copyright_rights') }}
            </div>
            <div class="ag-footer-payment">
                <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods">
            </div>
        </div>

    </div>
</footer>

</div><!-- End Page Wrapper -->

<!-- Scroll To Top (Invisible until scrolled) -->
<div class="scroll-to-top scroll-to-target" data-target="html" style="background:#bc9c5c; color:#fff; border-radius:50%;"><span class="fa fa-angle-up"></span></div>

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

        if (!isValid) {
            if ($email[0] && $email[0].reportValidity) {
                $email[0].reportValidity();
            }
            $email.trigger('focus');
            return;
        }

        clearTimeout(subTimer);
        $(".suces_rinfo").stop(true, true).fadeIn(200).css('display', 'inline-block');

        var formEl = $form.is('form') ? $form[0] : $form.find('form')[0];
        if (formEl) { formEl.reset(); }

        subTimer = setTimeout(function(){
            $(".suces_rinfo").fadeOut(400);
        }, 4000);
    });
</script>
@if(env('CONTENT_PROTECTION_ENABLED', true))
<script src="{{ asset('js/prevention.js') }}"></script>
@endif

<!-- =======================================================
     Flowing Ribbons Background Effect (Gallery Theme)
     ======================================================= -->
<script src="{{ asset('assets/js/ribbons.js') }}"></script>

</body>
</html>
