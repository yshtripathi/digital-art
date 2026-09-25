@php
    $footCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $footCompany = $misc['Company Name'] ?? __('frontend.company.name');
    $footEmail   = $misc['Company Email'] ?? __('frontend.company.email');
    $footAddress = $misc['Company Address'] ?? __('frontend.company.address');
@endphp


<footer class="ft" data-ft>
    <section class="ft__news band--indigo" aria-labelledby="signup-title">
        <div class="ft__mandala" aria-hidden="true" data-ft-spin>
            <svg viewBox="0 0 400 400" focusable="false">
                <circle class="ml__orbit" cx="200" cy="200" r="197"/>
                <g class="ml__dots">
                    @foreach (range(0, 350, 10) as $angle)
                        <circle cx="200" cy="14" r="2.6" transform="rotate({{ $angle }} 200 200)"/>
                    @endforeach
                </g>
                <g class="ml__outer">
                    @foreach (range(0, 345, 15) as $angle)
                        <ellipse cx="200" cy="46" rx="12" ry="30" transform="rotate({{ $angle }} 200 200)"/>
                    @endforeach
                </g>
                <g class="ml__mid">
                    @foreach (range(0, 330, 30) as $angle)
                        <g transform="rotate({{ $angle }} 200 200)">
                            <ellipse cx="200" cy="96" rx="24" ry="50" class="ml__paper"/>
                            <ellipse cx="200" cy="100" rx="9" ry="32" class="ml__line"/>
                        </g>
                    @endforeach
                </g>
                <g class="ml__rays">
                    @foreach (range(0, 345, 15) as $angle)
                        <path d="M200 124 L208 152 L200 166 L192 152 Z" transform="rotate({{ $angle }} 200 200)"/>
                    @endforeach
                </g>
                <g class="ml__core">
                    <circle cx="200" cy="200" r="42" class="ml__ink"/>
                    <circle cx="200" cy="200" r="32" class="ml__paper"/>
                    <circle cx="200" cy="200" r="22" class="ml__sun"/>
                    <circle cx="200" cy="200" r="12" class="ml__ink"/>
                    <circle cx="200" cy="200" r="4" class="ml__paper"/>
                </g>
            </svg>
        </div>

        <div class="ft__news-in">
            <p class="eyebrow">{{ __('frontend.footer.news_label') }}</p>
            <h2 class="ft__title" id="signup-title">{{ __('frontend.footer.news_head') }}</h2>
            <p class="ft__lead">{{ __('frontend.footer.news_text') }}</p>

            <form class="ft__form" novalidate data-signup>
                <label class="vh" for="signup-email">{{ __('frontend.footer.news_email') }}</label>
                <input type="email" name="email" id="signup-email" class="ft__input" placeholder="{{ __('frontend.footer.news_ph') }}" autocomplete="email" required>
                <button type="submit" class="btn btn--primary">
                    {{ __('frontend.footer.news_btn') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </button>
            </form>

            <p class="ft__ok" role="status" hidden data-signup-ok>
                <span class="ft__ok-mark" aria-hidden="true"><span class="rosette"></span></span>
                <span>{{ __('frontend.footer.news_success') }}</span>
            </p>
        </div>
    </section>

    <div class="ft__garland" aria-hidden="true">
        @for ($i = 0; $i < 28; $i++)
            <span style="--i: {{ $i }}"></span>
        @endfor
    </div>

    <div class="ft__base band--coffee">
        <div class="ft__grid">
            <div class="ft__brand ft__reveal">
                <a href="{{ route('home') }}" class="ft__logo">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $footCompany }}" loading="lazy">
                </a>
                <p class="ft__about">{{ __('frontend.footer.intro') }}</p>

                <ul class="ft__facts" aria-label="{{ __('frontend.footer.contact') }}">
                    <li>{{ $footCompany }}</li>
                    <li><a href="mailto:{{ $footEmail }}">{{ $footEmail }}</a></li>
                    <li>{{ $footAddress }}</li>
                </ul>
            </div>

            <nav class="ft__col ft__col--wide ft__reveal" aria-label="{{ __('frontend.footer.categories') }}">
                <h2 class="ft__label">{{ __('frontend.footer.categories') }}</h2>
                <ul class="ft__links ft__links--two">
                    @forelse($footCategories as $cat)
                        <li><a href="{{ route('product-lists', $cat->slug) }}" class="ft__link">{{ $cat->title }}</a></li>
                    @empty
                        <li><span class="ft__empty">{{ __('frontend.footer.no_cats') }}</span></li>
                    @endforelse
                </ul>
            </nav>

            <nav class="ft__col ft__reveal" aria-label="{{ __('frontend.footer.company') }}">
                <h2 class="ft__label">{{ __('frontend.footer.company') }}</h2>
                <ul class="ft__links">
                    <li><a href="{{ route('product-lists') }}" class="ft__link">{{ __('frontend.footer.all_materials') }}</a></li>
                    <li><a href="{{ route('about-us') }}" class="ft__link">{{ __('frontend.footer.about_us') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="ft__link">{{ __('frontend.footer.contact_us') }}</a></li>
                    @auth
                        <li><a href="{{ route('user') }}" class="ft__link">{{ __('frontend.footer.my_account') }}</a></li>
                        <li><a href="{{ route('user.logout') }}" class="ft__link">{{ __('frontend.footer.logout') }}</a></li>
                    @else
                        <li><a href="{{ route('login.form') }}" class="ft__link">{{ __('frontend.footer.login') }}</a></li>
                        <li><a href="{{ route('register.form') }}" class="ft__link">{{ __('frontend.footer.register') }}</a></li>
                    @endauth
                </ul>
            </nav>

            <nav class="ft__col ft__reveal" aria-label="{{ __('frontend.footer.policies') }}">
                <h2 class="ft__label">{{ __('frontend.footer.policies') }}</h2>
                <ul class="ft__links">
                    <li><a href="{{ route('pages','terms-conditions') }}" class="ft__link">{{ __('frontend.footer.terms') }}</a></li>
                    <li><a href="{{ route('pages','privacy-policy') }}" class="ft__link">{{ __('frontend.footer.privacy') }}</a></li>
                    <li><a href="{{ route('pages','refund-policy') }}" class="ft__link">{{ __('frontend.footer.refund') }}</a></li>
                    <li><a href="{{ route('pages','delivery-policy') }}" class="ft__link">{{ __('frontend.footer.access') }}</a></li>
                </ul>
            </nav>
        </div>

        <div class="ft__end">
            <p class="ft__copy">
                &copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $footCompany }}</a>. {{ __('frontend.footer.rights') }}
            </p>
            <span class="ft__seal" aria-hidden="true"><span class="rosette"></span></span>
            <img class="ft__pay" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.footer.payments') }}" loading="lazy">
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
    var foot = document.querySelector('[data-ft]');
    var spin = document.querySelector('[data-ft-spin]');
    var ticking = false;

    function paint() {
        ticking = false;
        var max = document.documentElement.scrollHeight - window.innerHeight;
        var progress = max > 0 ? Math.min(window.scrollY / max, 1) : 0;

        if (rise) {
            rise.classList.toggle('is-shown', window.scrollY > 320);
            rise.style.setProperty('--p', (progress * 100).toFixed(1));
        }

        if (spin && !calm.matches) {
            var box = spin.getBoundingClientRect();
            if (box.bottom > 0 && box.top < window.innerHeight) {
                var travel = (window.innerHeight - box.top) / (window.innerHeight + box.height);
                spin.style.setProperty('--spin', (travel * 120).toFixed(2) + 'deg');
            }
        }
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

    if (foot) {
        var parts = foot.querySelectorAll('.ft__news, .ft__garland, .ft__base');

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
    }
}());
</script>

@if(env('CONTENT_PROTECTION_ENABLED', true))
<script src="{{ asset('js/prevention.js') }}"></script>
@endif

@stack('scripts')

</body>
</html>
