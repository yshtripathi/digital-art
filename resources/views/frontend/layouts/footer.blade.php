@php
    $footSite       = __('frontend.head.site');
    $footCompany    = filled($misc['Company Name'] ?? null) ? $misc['Company Name'] : __('frontend.company.name');
    $footMail       = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $footAddress    = filled($misc['Company Address'] ?? null) ? $misc['Company Address'] : __('frontend.company.address');
@endphp

<footer class="ft" data-ft>
    <div class="ft__news" data-reveal>
        <div class="ft__news-copy">
            <span class="ft__news-icon" aria-hidden="true"><i class="far fa-paper-plane"></i></span>
            <div>
                <p class="ft__news-tag">{{ __('frontend.footer.letter_tag') }}</p>
                <h2 class="ft__news-title" id="signup-title">{{ __('frontend.footer.news_title') }}</h2>
                <p class="ft__news-line">{{ __('frontend.footer.news_line') }}</p>
            </div>
        </div>

        <div class="ft__news-act" data-signup-box>
            <form class="ft__form" novalidate aria-labelledby="signup-title" data-signup>
                <label class="vh" for="signup-email">{{ __('frontend.footer.letter_field') }}</label>
                <span class="ft__field">
                    <i class="far fa-envelope" aria-hidden="true"></i>
                    <input type="email" name="email" id="signup-email" class="ft__input" placeholder="{{ __('frontend.footer.letter_ph') }}" autocomplete="email" required>
                </span>
                <button type="submit" class="ft__send">
                    <span>{{ __('frontend.footer.letter_send') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>
            <p class="ft__bad" role="alert" hidden data-signup-bad>{{ __('frontend.footer.letter_bad') }}</p>
            <p class="ft__ok" role="status" hidden data-signup-ok>
                <span class="ft__ok-mark" aria-hidden="true"><i class="fas fa-check"></i></span>
                <span>{{ __('frontend.footer.letter_done') }}</span>
            </p>
        </div>
    </div>

    <div class="ft__main">
        <div class="ft__brand" data-reveal>
            <a href="{{ route('home') }}" class="ft__logo">
                <img src="{{ asset('assets/images/logo.webp') }}?v={{ filemtime(public_path('assets/images/logo.webp')) }}" alt="{{ $footSite }}" width="998" height="240" loading="lazy">
            </a>
            <p class="ft__about">{{ __('frontend.footer.about') }}</p>
            <div class="ft__levels" aria-hidden="true">
                <span></span><span></span><span></span><span></span>
            </div>
        </div>

        <nav class="ft__col" aria-labelledby="ft-quick" data-reveal style="--d: 1">
            <h2 class="ft__label" id="ft-quick">{{ __('frontend.footer.col_links') }}</h2>
            <ul class="ft__links">
                <li><a href="{{ route('product-lists') }}" class="ft__link"><span>{{ __('frontend.footer.link_all') }}</span></a></li>
                <li><a href="{{ route('points.topup') }}" class="ft__link"><span>{{ __('frontend.footer.link_credits') }}</span></a></li>
                <li><a href="{{ route('about-us') }}" class="ft__link"><span>{{ __('frontend.footer.link_about') }}</span></a></li>
                <li><a href="{{ route('contact') }}" class="ft__link"><span>{{ __('frontend.footer.link_contact') }}</span></a></li>
                @auth
                    <li><a href="{{ route('user') }}" class="ft__link"><span>{{ __('frontend.footer.link_account') }}</span></a></li>
                @endauth
            </ul>
        </nav>

        <nav class="ft__col" aria-labelledby="ft-policies" data-reveal style="--d: 2">
            <h2 class="ft__label" id="ft-policies">{{ __('frontend.footer.col_policies') }}</h2>
            <ul class="ft__links ft__links--policies">
                <li><a href="{{ route('pages','terms-conditions') }}" class="ft__link"><span>{{ __('frontend.footer.link_terms') }}</span></a></li>
                <li><a href="{{ route('pages','privacy-policy') }}" class="ft__link"><span>{{ __('frontend.footer.link_privacy') }}</span></a></li>
                <li><a href="{{ route('pages','refund-policy') }}" class="ft__link"><span>{{ __('frontend.footer.link_refund') }}</span></a></li>
                <li><a href="{{ route('pages','delivery-policy') }}" class="ft__link"><span>{{ __('frontend.footer.link_access') }}</span></a></li>
            </ul>
        </nav>

        <div class="ft__col" data-reveal style="--d: 3">
            <h2 class="ft__label" id="ft-details">{{ __('frontend.footer.details') }}</h2>
            <dl class="ft__facts" aria-labelledby="ft-details">
                <div class="ft__fact">
                    <span class="ft__well" aria-hidden="true"><i class="far fa-building"></i></span>
                    <div>
                        <dt>{{ __('frontend.footer.info_name') }}</dt>
                        <dd>{{ $footCompany }}</dd>
                    </div>
                </div>
                <div class="ft__fact">
                    <span class="ft__well" aria-hidden="true"><i class="far fa-envelope"></i></span>
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
        </div>
    </div>

    <p class="ft__mark" aria-hidden="true" data-reveal>
        @foreach(mb_str_split($footSite) as $markIndex => $markChar)<span style="--i: {{ $markIndex }}">{{ $markChar === ' ' ? "\u{00A0}" : $markChar }}</span>@endforeach
    </p>

    <div class="ft__end">
        <p class="ft__copy">
            &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $footCompany }}</a>. {{ __('frontend.footer.copyright') }}
        </p>
        <span class="ft__pay"><img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.footer.pay_alt') }}" width="220" height="30" loading="lazy"></span>
    </div>
</footer>

</div>

<button type="button" class="totop" aria-label="{{ __('frontend.footer.scroll_top') }}" data-totop>
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

    var box = document.querySelector('[data-signup-box]');
    var form = document.querySelector('[data-signup]');
    var done = document.querySelector('[data-signup-ok]');
    var bad = document.querySelector('[data-signup-bad]');
    var timer;

    if (form && box) {
        var field = form.querySelector('input[type="email"]');

        field.addEventListener('input', function () {
            box.classList.remove('is-bad');
            field.removeAttribute('aria-invalid');
            if (bad) { bad.hidden = true; }
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var value = (field.value || '').trim();

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                box.classList.remove('is-bad');
                void box.offsetWidth;
                box.classList.add('is-bad');
                field.setAttribute('aria-invalid', 'true');
                if (bad) { bad.hidden = false; }
                field.focus();
                return;
            }

            form.reset();
            if (bad) { bad.hidden = true; }
            if (done) { done.hidden = false; }

            clearTimeout(timer);
            timer = setTimeout(function () {
                if (done) { done.hidden = true; }
            }, 5000);
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
