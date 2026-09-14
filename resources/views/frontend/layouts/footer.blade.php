{{-- ==========================================================================
     [Website Name] — Site Footer
     Lime newsletter card + maroon footer panel (see design and content/DESIGN.md).
     Styles: public/css/main.css
     JS hooks kept: .subscribe-form, input[type="email"], .suces_rinfo, .scroll-to-top.scroll-to-target
     ========================================================================== --}}
@php
    $footerCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $ftCompany = $misc['Company Name'] ?? __('managenovax.footer.company_fallback');
    $ftPhone   = $misc['Company Phone'] ?? __('managenovax.footer.phone_fallback');
    $ftEmail   = $misc['Company Email'] ?? __('managenovax.footer.email_fallback');
    $ftAddress = $misc['Company Address'] ?? __('managenovax.footer.address_fallback');
@endphp


<footer class="ft">
    <div class="ft__wrap">

        {{-- Newsletter --}}
        <section class="ft-news" aria-labelledby="ft-news-title">
            <div>
                <span class="ft-news__eyebrow"><i class="fas fa-envelope-open-text"></i> {{ __('managenovax.footer.newsletter_btn') }}</span>
                <h4 class="ft-news__title" id="ft-news-title">{{ __('managenovax.footer.newsletter_title') }}</h4>
                <p class="ft-news__desc">{{ __('managenovax.footer.newsletter_desc') }}</p>
            </div>

            <div class="ft-news__side">
                <form class="ft-news__form subscribe-form">
                    <input type="email" name="email" class="ft-news__input email" placeholder="{{ __('managenovax.footer.newsletter_ph') }}" aria-label="{{ __('managenovax.footer.newsletter_ph') }}" required>
                    <button type="submit" class="ft-news__btn">
                        {{ __('managenovax.footer.newsletter_btn') }} <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
                <p class="suces_rinfo" style="display: none;"><i class="fas fa-check"></i> {{ __('managenovax.footer.newsletter_success') }}</p>
            </div>
        </section>

        {{-- Main footer --}}
        <div class="ft-main">
            <div class="ft-main__grid">

                {{-- Brand + contact --}}
                <div class="ft-brand">
                    <a href="{{ route('home') }}" class="ft-brand__logo">
                        <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $ftCompany }}">
                    </a>
                    <p class="ft-brand__desc">{{ __('managenovax.footer.brand_desc') }}</p>
                    <ul class="ft-contact">
                        <li>
                            <span class="ft-contact__item">
                                <span class="ft-contact__icon"><i class="fas fa-building"></i></span>
                                <span class="ft-contact__text">{{ $ftCompany }}</span>
                            </span>
                        </li>
                        <li>
                            <a href="tel:{{ $ftPhone }}" class="ft-contact__item">
                                <span class="ft-contact__icon"><i class="fas fa-phone-alt"></i></span>
                                <span class="ft-contact__text">{{ $ftPhone }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ $ftEmail }}" class="ft-contact__item">
                                <span class="ft-contact__icon"><i class="fas fa-envelope"></i></span>
                                <span class="ft-contact__text">{{ $ftEmail }}</span>
                            </a>
                        </li>
                        <li>
                            <span class="ft-contact__item">
                                <span class="ft-contact__icon"><i class="fas fa-map-marker-alt"></i></span>
                                <span class="ft-contact__text">{{ $ftAddress }}</span>
                            </span>
                        </li>
                    </ul>
                </div>

                {{-- Categories --}}
                <nav aria-label="{{ __('managenovax.footer.categories') }}">
                    <h5 class="ft-col__title">{{ __('managenovax.footer.categories') }}</h5>
                    <ul class="ft-links">
                        @forelse($footerCategories as $cat)
                            <li><a href="{{ route('product-lists', $cat->slug) }}" class="ft-link">{{ $cat->title }}</a></li>
                        @empty
                            <li><span class="ft-links__empty">{{ __('managenovax.header.no_categories') }}</span></li>
                        @endforelse
                    </ul>
                </nav>

                {{-- Company & account --}}
                <nav aria-label="{{ __('managenovax.footer.company_account') }}">
                    <h5 class="ft-col__title">{{ __('managenovax.footer.company_account') }}</h5>
                    <ul class="ft-links">
                        <li><a href="{{ route('product-lists') }}" class="ft-link">{{ __('managenovax.footer.courses') }}</a></li>
                        <li><a href="{{ route('about-us') }}" class="ft-link">{{ __('managenovax.footer.about') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="ft-link">{{ __('managenovax.footer.contact') }}</a></li>
                        @if(Auth::check())
                            <li><a href="{{ route('user') }}" class="ft-link">{{ __('managenovax.footer.my_account') }}</a></li>
                            <li><a href="{{ route('user.logout') }}" class="ft-link">{{ __('managenovax.footer.logout') }}</a></li>
                        @else
                            <li><a href="{{ route('login.form') }}" class="ft-link">{{ __('managenovax.footer.login') }}</a></li>
                            <li><a href="{{ route('register.form') }}" class="ft-link">{{ __('managenovax.footer.register') }}</a></li>
                        @endif
                    </ul>
                </nav>

                {{-- Policies --}}
                <nav aria-label="{{ __('managenovax.footer.policies') }}">
                    <h5 class="ft-col__title">{{ __('managenovax.footer.policies') }}</h5>
                    <ul class="ft-links">
                        <li><a href="{{ route('pages','terms-conditions') }}" class="ft-link">{{ __('managenovax.footer.terms') }}</a></li>
                        <li><a href="{{ route('pages','privacy-policy') }}" class="ft-link">{{ __('managenovax.footer.privacy') }}</a></li>
                        <li><a href="{{ route('pages','refund-policy') }}" class="ft-link">{{ __('managenovax.footer.refund') }}</a></li>
                        <li><a href="{{ route('pages','delivery-policy') }}" class="ft-link">{{ __('managenovax.footer.delivery') }}</a></li>
                    </ul>
                </nav>
            </div>

            <div class="ft-mark" aria-hidden="true">{{ $ftCompany }}</div>

            <div class="ft-bottom">
                <div>
                    {!! __('managenovax.footer.copyright', ['year' => date('Y'), 'company' => '<a href="' . route('home') . '">' . e($ftCompany) . '</a>']) !!}
                </div>
                <div class="ft-pay">
                    <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods">
                </div>
            </div>
        </div>

    </div>
</footer>

</div><!-- End Page Wrapper -->

<!-- Scroll To Top (JS: .scroll-to-target) -->
<div class="scroll-to-top scroll-to-target ft-top" data-target="html" role="button" tabindex="0" aria-label="Back to top"><span class="fa fa-arrow-up"></span></div>

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

</body>
</html>
