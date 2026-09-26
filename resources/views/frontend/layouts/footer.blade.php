@php
    $footCompany = $misc['Company Name'] ?? __('frontend.company.name');
    $footEmail   = $misc['Company Email'] ?? __('frontend.company.email');
    $footAddress = $misc['Company Address'] ?? __('frontend.company.address');
@endphp


<footer class="ft" data-ft>
    <section class="ft__news" aria-labelledby="signup-title">
        <div class="ft__card" data-reveal>
            <div class="ft__news-in">
                <p class="eyebrow">{{ __('frontend.footer.letter_tag') }}</p>
                <h2 class="ft__title" id="signup-title">{{ __('frontend.footer.letter_title') }}</h2>
                <p class="ft__lead">{{ __('frontend.footer.letter_text') }}</p>

                <form class="ft__form" novalidate data-signup>
                    <label class="vh" for="signup-email">{{ __('frontend.footer.letter_field') }}</label>
                    <input type="email" name="email" id="signup-email" class="ft__input" placeholder="{{ __('frontend.footer.letter_ph') }}" autocomplete="email" required>
                    <button type="submit" class="btn btn--primary ft__send">
                        {{ __('frontend.footer.letter_send') }}
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <p class="ft__ok" role="status" hidden data-signup-ok>
                    <i class="fas fa-check-circle" aria-hidden="true"></i>
                    <span>{{ __('frontend.footer.letter_done') }}</span>
                </p>
            </div>

            <svg class="ft__chart" viewBox="0 0 240 180" aria-hidden="true" focusable="false">
                <path class="ft__grid" d="M20 40 H228 M20 80 H228 M20 120 H228"/>
                <path class="ft__axis" d="M20 12 V160 H228"/>
                <rect class="ft__bar" x="36" y="120" width="28" height="40" rx="4"/>
                <rect class="ft__bar" x="82" y="96" width="28" height="64" rx="4"/>
                <rect class="ft__bar" x="128" y="72" width="28" height="88" rx="4"/>
                <rect class="ft__bar" x="174" y="40" width="28" height="120" rx="4"/>
                <polyline class="ft__trend" points="26,134 50,106 96,82 142,58 188,26"/>
                <circle class="ft__goal" cx="188" cy="26" r="8"/>
            </svg>
        </div>
    </section>

    <div class="ft__base">
        <div class="ft__grid-wrap">
            <div class="ft__brand" data-reveal>
                <a href="{{ route('home') }}" class="ft__logo">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $footCompany }}" loading="lazy">
                </a>

                <div class="ft__facts">
                    <h2 class="ft__label">{{ __('frontend.footer.details') }}</h2>
                    <dl class="ft__info">
                        <div class="ft__fact">
                            <i class="fas fa-building" aria-hidden="true"></i>
                            <div>
                                <dt>{{ __('frontend.footer.info_name') }}</dt>
                                <dd>{{ $footCompany }}</dd>
                            </div>
                        </div>
                        <div class="ft__fact">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                            <div>
                                <dt>{{ __('frontend.footer.info_mail') }}</dt>
                                <dd><a href="mailto:{{ trim($footEmail) }}">{{ trim($footEmail) }}</a></dd>
                            </div>
                        </div>
                        <div class="ft__fact">
                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <div>
                                <dt>{{ __('frontend.footer.info_place') }}</dt>
                                <dd>{{ $footAddress }}</dd>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>

            <nav class="ft__col" aria-labelledby="ft-quick" data-reveal>
                <h2 class="ft__label" id="ft-quick">{{ __('frontend.footer.col_company') }}</h2>
                <ul class="ft__links">
                    <li><a href="{{ route('product-lists') }}" class="ft__link">{{ __('frontend.footer.link_all') }}</a></li>
                    <li><a href="{{ route('points.topup') }}" class="ft__link">{{ __('frontend.footer.link_credits') }}</a></li>
                    <li><a href="{{ route('about-us') }}" class="ft__link">{{ __('frontend.footer.link_about') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="ft__link">{{ __('frontend.footer.link_contact') }}</a></li>
                    @auth
                        <li><a href="{{ route('user') }}" class="ft__link">{{ __('frontend.footer.link_account') }}</a></li>
                    @endauth
                </ul>
            </nav>

            <nav class="ft__col" aria-labelledby="ft-policies" data-reveal>
                <h2 class="ft__label" id="ft-policies">{{ __('frontend.footer.col_policies') }}</h2>
                <ul class="ft__links">
                    <li><a href="{{ route('pages','terms-conditions') }}" class="ft__link">{{ __('frontend.footer.link_terms') }}</a></li>
                    <li><a href="{{ route('pages','privacy-policy') }}" class="ft__link">{{ __('frontend.footer.link_privacy') }}</a></li>
                    <li><a href="{{ route('pages','refund-policy') }}" class="ft__link">{{ __('frontend.footer.link_refund') }}</a></li>
                    <li><a href="{{ route('pages','delivery-policy') }}" class="ft__link">{{ __('frontend.footer.link_access') }}</a></li>
                </ul>
            </nav>
        </div>

        <div class="ft__end">
            <p class="ft__copy">
                &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $footCompany }}</a>. {{ __('frontend.footer.copyright') }}
            </p>
            <span class="ft__pay">
                <img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.footer.pay_alt') }}" loading="lazy">
            </span>
        </div>
    </div>
</footer>

</div>

<button type="button" class="totop" aria-label="{{ __('frontend.footer.scroll_top') }}" data-totop>
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
    <span class="totop__bar" aria-hidden="true"></span>
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
                field.setCustomValidity(@json(__('frontend.footer.letter_bad')));
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
    var ticking = false;

    function paint() {
        ticking = false;
        if (!rise) { return; }
        var max = document.documentElement.scrollHeight - window.innerHeight;
        var progress = max > 0 ? Math.min(window.scrollY / max, 1) : 0;
        rise.classList.toggle('is-shown', window.scrollY > 320);
        rise.style.setProperty('--p', (progress * 100).toFixed(1) + '%');
    }

    function queue() {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(paint);
        }
    }

    window.addEventListener('scroll', queue, { passive: true });
    window.addEventListener('resize', queue);
    paint();

    if (rise) {
        rise.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: calm.matches ? 'auto' : 'smooth' });
        });
    }

    var parts = document.querySelectorAll('[data-ft] [data-reveal]');

    if ('IntersectionObserver' in window) {
        var watch = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    watch.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        parts.forEach(function (el) { watch.observe(el); });
    } else {
        parts.forEach(function (el) { el.classList.add('is-in'); });
    }
}());
</script>

@if(env('CONTENT_PROTECTION_ENABLED', true))
<script src="{{ asset('js/prevention.js') }}"></script>
@endif

@stack('scripts')

</body>
</html>
