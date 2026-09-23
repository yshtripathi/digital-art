@php
    $footCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $footCompany = $misc['Company Name'] ?? __('frontend.company.name');
    $footEmail   = $misc['Company Email'] ?? __('frontend.company.email');
    $footAddress = $misc['Company Address'] ?? __('frontend.company.address');
@endphp


<footer class="foot">
    <div class="foot__inner">

        <div class="foot__lead">

            <div class="ident">
                <a href="{{ route('home') }}" class="ident__logo">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $footCompany }}">
                </a>

                <p class="ident__about">{{ __('frontend.footer.intro') }}</p>

                <ul class="ident__facts" aria-label="{{ __('frontend.footer.contact') }}">
                    <li>
                        <span class="ident__fact">
                            <span class="ident__tile"><i class="fas fa-building" aria-hidden="true"></i></span>
                            <span>{{ $footCompany }}</span>
                        </span>
                    </li>
                    <li>
                        <a href="mailto:{{ $footEmail }}" class="ident__fact">
                            <span class="ident__tile"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                            <span>{{ $footEmail }}</span>
                        </a>
                    </li>
                    <li>
                        <span class="ident__fact">
                            <span class="ident__tile"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></span>
                            <span>{{ $footAddress }}</span>
                        </span>
                    </li>
                </ul>
            </div>

            <section class="signup" aria-labelledby="signup-title">
                <h2 class="signup__title" id="signup-title">{{ __('frontend.footer.news_head') }}</h2>
                <p class="signup__desc">{{ __('frontend.footer.news_text') }}</p>

                <form class="signup__form" novalidate data-signup>
                    <label class="vh" for="signup-email">{{ __('frontend.footer.news_email') }}</label>
                    <span class="signup__field">
                        <i class="fas fa-envelope" aria-hidden="true"></i>
                        <input type="email" name="email" id="signup-email" class="signup__input" placeholder="{{ __('frontend.footer.news_ph') }}" required>
                    </span>
                    <button type="submit" class="btn btn--primary">
                        {{ __('frontend.footer.news_btn') }}
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <p class="signup__ok" role="status" hidden data-signup-ok>
                    <i class="fas fa-check" aria-hidden="true"></i>
                    <span>{{ __('frontend.footer.news_success') }}</span>
                </p>

                <ul class="signup__list">
                    @foreach(__('frontend.footer.news_list') as $point)
                        <li class="signup__point">
                            <i class="fas fa-check" aria-hidden="true"></i>
                            <span>{{ $point }}</span>
                        </li>
                    @endforeach
                </ul>

                <p class="signup__note">{{ __('frontend.footer.news_note') }}</p>
            </section>
        </div>

        <div class="foot__dir">

            <nav class="dir" aria-label="{{ __('frontend.footer.categories') }}">
                <h2 class="dir__label">{{ __('frontend.footer.categories') }}</h2>
                <ul class="dir__list">
                    @forelse($footCategories as $cat)
                        <li><a href="{{ route('product-lists', $cat->slug) }}" class="dir__link">{{ $cat->title }}</a></li>
                    @empty
                        <li><span class="dir__empty">{{ __('frontend.footer.no_cats') }}</span></li>
                    @endforelse
                </ul>
            </nav>

            <nav class="dir" aria-label="{{ __('frontend.footer.company') }}">
                <h2 class="dir__label">{{ __('frontend.footer.company') }}</h2>
                <ul class="dir__list">
                    <li><a href="{{ route('product-lists') }}" class="dir__link">{{ __('frontend.footer.all_materials') }}</a></li>
                    <li><a href="{{ route('about-us') }}" class="dir__link">{{ __('frontend.footer.about_us') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="dir__link">{{ __('frontend.footer.contact_us') }}</a></li>
                    @auth
                        <li><a href="{{ route('user') }}" class="dir__link">{{ __('frontend.footer.my_account') }}</a></li>
                        <li><a href="{{ route('user.logout') }}" class="dir__link">{{ __('frontend.footer.logout') }}</a></li>
                    @else
                        <li><a href="{{ route('login.form') }}" class="dir__link">{{ __('frontend.footer.login') }}</a></li>
                        <li><a href="{{ route('register.form') }}" class="dir__link">{{ __('frontend.footer.register') }}</a></li>
                    @endauth
                </ul>
            </nav>

            <nav class="dir" aria-label="{{ __('frontend.footer.policies') }}">
                <h2 class="dir__label">{{ __('frontend.footer.policies') }}</h2>
                <ul class="dir__list">
                    <li><a href="{{ route('pages','terms-conditions') }}" class="dir__link">{{ __('frontend.footer.terms') }}</a></li>
                    <li><a href="{{ route('pages','privacy-policy') }}" class="dir__link">{{ __('frontend.footer.privacy') }}</a></li>
                    <li><a href="{{ route('pages','refund-policy') }}" class="dir__link">{{ __('frontend.footer.refund') }}</a></li>
                    <li><a href="{{ route('pages','delivery-policy') }}" class="dir__link">{{ __('frontend.footer.access') }}</a></li>
                </ul>
            </nav>
        </div>

        <div class="foot__end">
            <p class="foot__copy">
                &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $footCompany }}</a>. {{ __('frontend.footer.rights') }}
            </p>
            <img class="foot__pay" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.footer.payments') }}" loading="lazy">
        </div>
    </div>
</footer>

</div>

<button type="button" class="totop" aria-label="{{ __('frontend.footer.to_top') }}" data-totop>
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</button>

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
        $('.alert:not(.alert-dismissible)').slideUp();
        $('.modern-alert').fadeOut(function() {
            $(this).remove();
        });
    }, 5000);
</script>

<script>
(function () {
    'use strict';

    var calm = window.matchMedia('(prefers-reduced-motion: reduce)');

    var form = document.querySelector('[data-signup]');
    var done = document.querySelector('[data-signup-ok]');
    var timer;

    if (form) {
        var field = form.querySelector('input[type="email"]');

        field.addEventListener('input', function () {
            field.setCustomValidity('');
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var value = (field.value || '').trim();

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                field.setCustomValidity(@json(__('frontend.footer.news_invalid')));
                field.reportValidity();
                field.focus();
                return;
            }

            form.reset();

            if (done) {
                done.hidden = false;
                clearTimeout(timer);
                timer = setTimeout(function () { done.hidden = true; }, 4000);
            }
        });
    }

    var rise = document.querySelector('[data-totop]');

    if (rise) {
        var reveal = function () {
            rise.classList.toggle('is-shown', window.scrollY > 320);
        };
        window.addEventListener('scroll', reveal, { passive: true });
        reveal();

        rise.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: calm.matches ? 'auto' : 'smooth' });
        });
    }
}());
</script>

@if(env('CONTENT_PROTECTION_ENABLED', true))
<script src="{{ asset('js/prevention.js') }}"></script>
@endif

@stack('scripts')

</body>
</html>
