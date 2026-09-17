{{-- ==========================================================================
     Site Footer
     Centred newsletter strip above a four-column directory, closed by a rule
     and the copyright row (see design/DESIGN.md — section 3).
     Styles: public/css/theme.css — section 14
     JS hooks kept: .subscribe-form, input[type="email"], .suces_rinfo,
     .scroll-to-top.scroll-to-target
     ========================================================================== --}}
@php
    $footerCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $ftCompany = $misc['Company Name'] ?? __('frontend.company.name');
    $ftPhone   = $misc['Company Phone'] ?? __('frontend.company.phone');
    $ftEmail   = $misc['Company Email'] ?? __('frontend.company.email');
    $ftAddress = $misc['Company Address'] ?? __('frontend.company.address');
@endphp


<footer class="ft">
    <div class="ft__inner">

        {{-- Newsletter strip --}}
        <section class="ft-news" aria-labelledby="ft-news-title">
            <h2 class="ft-news__title" id="ft-news-title">{{ __('frontend.footer.news_title') }}</h2>
            <p class="ft-news__desc">{{ __('frontend.footer.news_desc') }}</p>

            <form class="ft-news__form subscribe-form" novalidate>
                <label class="visually-hidden" for="ft-news-email">{{ __('frontend.footer.news_email') }}</label>
                <span class="ft-news__field">
                    <i class="fas fa-envelope ft-news__field-icon" aria-hidden="true"></i>
                    <input type="email" name="email" id="ft-news-email" class="ft-news__input email" placeholder="{{ __('frontend.footer.news_ph') }}" required>
                </span>
                <button type="submit" class="ft-news__btn">
                    <span>{{ __('frontend.footer.news_btn') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="suces_rinfo" style="display: none;"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.footer.news_success') }}</p>

            <ul class="ft-news__list">
                @foreach(__('frontend.footer.news_points') as $point)
                    <li class="ft-news__point">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <span>{{ $point }}</span>
                    </li>
                @endforeach
            </ul>

            <p class="ft-news__note">{{ __('frontend.footer.news_note') }}</p>
        </section>

        {{-- Directory --}}
        <div class="ft-cols">

            <div class="ft-brand">
                <a href="{{ route('home') }}" class="ft-brand__logo">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $ftCompany }}">
                </a>
                <p class="ft-brand__about">{{ __('frontend.footer.about') }}</p>

                <ul class="ft-facts" aria-label="{{ __('frontend.footer.contact') }}">
                    <li class="ft-fact">
                        <i class="fas fa-building" aria-hidden="true"></i>
                        <span>{{ $ftCompany }}</span>
                    </li>
                    <li>
                        <a href="tel:{{ $ftPhone }}" class="ft-fact ft-link">
                            <i class="fas fa-phone-alt" aria-hidden="true"></i>
                            <span>{{ $ftPhone }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $ftEmail }}" class="ft-fact ft-link">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <span>{{ $ftEmail }}</span>
                        </a>
                    </li>
                    <li class="ft-fact">
                        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                        <span>{{ $ftAddress }}</span>
                    </li>
                </ul>
            </div>

            <nav class="ft-col" aria-label="{{ __('frontend.footer.categories') }}">
                <h2 class="ft-col__label">{{ __('frontend.footer.categories') }}</h2>
                <ul class="ft-col__list">
                    @forelse($footerCategories as $cat)
                        <li><a href="{{ route('product-lists', $cat->slug) }}" class="ft-link">{{ $cat->title }}</a></li>
                    @empty
                        <li><span class="ft-col__empty">{{ __('frontend.footer.no_categories') }}</span></li>
                    @endforelse
                </ul>
            </nav>

            <nav class="ft-col" aria-label="{{ __('frontend.footer.company') }}">
                <h2 class="ft-col__label">{{ __('frontend.footer.company') }}</h2>
                <ul class="ft-col__list">
                    <li><a href="{{ route('product-lists') }}" class="ft-link">{{ __('frontend.footer.all_courses') }}</a></li>
                    <li><a href="{{ route('about-us') }}" class="ft-link">{{ __('frontend.footer.about_us') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="ft-link">{{ __('frontend.footer.contact_us') }}</a></li>
                    @if(Auth::check())
                        <li><a href="{{ route('user') }}" class="ft-link">{{ __('frontend.footer.my_account') }}</a></li>
                        <li><a href="{{ route('user.logout') }}" class="ft-link">{{ __('frontend.footer.logout') }}</a></li>
                    @else
                        <li><a href="{{ route('login.form') }}" class="ft-link">{{ __('frontend.footer.login') }}</a></li>
                        <li><a href="{{ route('register.form') }}" class="ft-link">{{ __('frontend.footer.register') }}</a></li>
                    @endif
                </ul>
            </nav>

            <nav class="ft-col" aria-label="{{ __('frontend.footer.policies') }}">
                <h2 class="ft-col__label">{{ __('frontend.footer.policies') }}</h2>
                <ul class="ft-col__list">
                    <li><a href="{{ route('pages','terms-conditions') }}" class="ft-link">{{ __('frontend.footer.terms') }}</a></li>
                    <li><a href="{{ route('pages','privacy-policy') }}" class="ft-link">{{ __('frontend.footer.privacy') }}</a></li>
                    <li><a href="{{ route('pages','refund-policy') }}" class="ft-link">{{ __('frontend.footer.refund') }}</a></li>
                    <li><a href="{{ route('pages','delivery-policy') }}" class="ft-link">{{ __('frontend.footer.delivery') }}</a></li>
                </ul>
            </nav>
        </div>

        {{-- Closing row --}}
        <div class="ft-bottom">
            <p class="ft-bottom__copy">
                &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $ftCompany }}</a>. {{ __('frontend.footer.rights') }}
            </p>
            <img class="ft-bottom__pay" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.footer.payments') }}" loading="lazy">
        </div>
    </div>
</footer>

</div><!-- End Page Wrapper -->

<!-- Scroll To Top (JS: .scroll-to-target) -->
<div class="scroll-to-top scroll-to-target ft-top" data-target="html" role="button" tabindex="0" aria-label="{{ __('frontend.footer.to_top') }}"><span class="fa fa-arrow-up"></span></div>

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

    // Clear the custom validation message while the user edits the email
    $(".subscribe-form").on('input', 'input[type="email"]', function(){
        this.setCustomValidity('');
    });

    $(".subscribe-form").on('submit', function(event){
        event.preventDefault();

        var $form  = $(this);
        var $email = $form.find('input[type="email"]');
        var value  = ($email.val() || '').trim();
        var isValid = value !== '' && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);

        if (!isValid) {
            if ($email[0] && $email[0].setCustomValidity) {
                $email[0].setCustomValidity(@json(__('frontend.footer.news_invalid')));
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
