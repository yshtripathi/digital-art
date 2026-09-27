@php
    $footSite    = __('frontend.head.site');
    $footCompany = filled($misc['Company Name'] ?? null) ? $misc['Company Name'] : __('frontend.company.name');
    $footMail    = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $footAddress = filled($misc['Company Address'] ?? null) ? $misc['Company Address'] : __('frontend.company.address');
    $footJa      = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
@endphp

<footer class="ft" data-ft>
    <div class="ft__tape" aria-hidden="true">
        <div class="ft__track">
            @foreach([1, 2] as $copy)
                @foreach(__('frontend.head.terms') as $term)
                    <span class="pre__term {{ $loop->odd ? 'is-up' : 'is-down' }}">{{ $term }}</span>
                @endforeach
            @endforeach
        </div>
    </div>

    <div class="ft__wrap">
        <section class="ft__news" aria-labelledby="signup-title" data-reveal>
            <div class="ft__news-copy">
                <span class="eyebrow">{{ __('frontend.footer.letter_tag') }}</span>
                <h2 class="ft__title" id="signup-title">{{ __('frontend.footer.news_title') }}</h2>
                <p class="ft__lead">{{ __('frontend.footer.news_text') }}</p>
            </div>

            <div class="ft__news-act">
                <form class="ft__form" novalidate data-signup>
                    <label class="vh" for="signup-email">{{ __('frontend.footer.letter_field') }}</label>
                    <i class="fas fa-envelope ft__form-icon" aria-hidden="true"></i>
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
        </section>

        <div class="ft__main">
            <div class="ft__brand" data-reveal>
                <a href="{{ route('home') }}" class="ft__logo">
                    <img src="{{ asset('assets/images/logo.webp') }}?v={{ filemtime(public_path('assets/images/logo.webp')) }}" alt="{{ $footSite }}" width="890" height="240" loading="lazy">
                </a>
                <p class="ft__about">{{ __('frontend.footer.about') }}</p>
            </div>

            <nav class="ft__col" aria-labelledby="ft-quick" data-reveal>
                <h2 class="ft__label" id="ft-quick">{{ __('frontend.footer.col_links') }}</h2>
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

        <section class="ft__company" aria-labelledby="ft-details" data-reveal>
            <h2 class="vh" id="ft-details">{{ __('frontend.footer.details') }}</h2>
            <dl class="ft__facts">
                <div class="ft__fact">
                    <span class="ft__well" aria-hidden="true"><i class="fas fa-building"></i></span>
                    <div>
                        <dt>{{ __('frontend.footer.info_name') }}</dt>
                        <dd>{{ $footCompany }}</dd>
                    </div>
                </div>
                <div class="ft__fact">
                    <span class="ft__well" aria-hidden="true"><i class="fas fa-envelope"></i></span>
                    <div>
                        <dt>{{ __('frontend.footer.info_mail') }}</dt>
                        <dd>
                            @if(filled($misc['Company Email'] ?? null))
                                <a href="mailto:{{ $footMail }}">{{ $footMail }}</a>
                            @else
                                {{ $footMail }}
                            @endif
                        </dd>
                    </div>
                </div>
                <div class="ft__fact">
                    <span class="ft__well" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                    <div>
                        <dt>{{ __('frontend.footer.info_place') }}</dt>
                        <dd>{{ $footAddress }}</dd>
                    </div>
                </div>
            </dl>
        </section>

        <aside class="ft__risk" aria-labelledby="ft-risk" data-reveal>
            <i class="fas fa-exclamation-triangle ft__risk-icon" aria-hidden="true"></i>
            <p>
                <strong id="ft-risk">{{ __('frontend.footer.risk_title') }}</strong>
                {{ __('frontend.footer.risk') }}
            </p>
        </aside>
    </div>

    <div class="ft__end">
        <div class="ft__end-in">
            <p class="ft__copy">
                &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $footCompany }}</a>. {{ __('frontend.footer.copyright') }}
            </p>
            <div class="ft__langs" aria-label="{{ __('frontend.header.pref_language') }}">
                <a class="ft__lang {{ !$footJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}" @if(!$footJa) aria-current="true" @endif>EN</a>
                <a class="ft__lang {{ $footJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}" @if($footJa) aria-current="true" @endif>JP</a>
            </div>
            <span class="ft__pay">
                <img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.footer.pay_alt') }}" loading="lazy">
            </span>
        </div>
    </div>
</footer>

</div>

<button type="button" class="totop" aria-label="{{ __('frontend.footer.scroll_top') }}" data-totop>
    <span class="totop__ring" aria-hidden="true"></span>
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
