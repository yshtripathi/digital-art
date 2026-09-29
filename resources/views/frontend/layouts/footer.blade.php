@php
    $footSite    = __('frontend.head.site');
    $footCompany = filled($misc['Company Name'] ?? null) ? $misc['Company Name'] : __('frontend.company.name');
    $footMail    = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $footAddress = filled($misc['Company Address'] ?? null) ? $misc['Company Address'] : __('frontend.company.address');
    $footCats    = (isset($category) && $category instanceof \Illuminate\Support\Collection ? $category : \App\Models\Category::getAllParentWithChild());

    $footLearn = [
        ['url' => route('product-lists'), 'label' => __('frontend.footer.all_materials')],
        ['url' => route('points.topup'),  'label' => __('frontend.footer.buy_credits')],
        ['url' => route('about-us'),      'label' => __('frontend.footer.about')],
        ['url' => route('contact'),       'label' => __('frontend.footer.contact')],
    ];
    if (Auth::check()) {
        $footLearn[] = ['url' => route('user'), 'label' => __('frontend.footer.account')];
    }

    $footLegal = [
        ['url' => route('pages', 'terms-conditions'), 'label' => __('frontend.footer.terms')],
        ['url' => route('pages', 'privacy-policy'),   'label' => __('frontend.footer.privacy')],
        ['url' => route('pages', 'refund-policy'),    'label' => __('frontend.footer.refund')],
        ['url' => route('pages', 'delivery-policy'),  'label' => __('frontend.footer.delivery')],
    ];
@endphp

<footer class="foot">
    <div class="foot__wrap">
        <section class="letter" aria-labelledby="letter-title">
            <div class="letter__copy">
                <p class="letter__tag">
                    <i class="far fa-envelope-open" aria-hidden="true"></i>
                    {{ __('frontend.footer.news_label') }}
                </p>
                <h2 class="letter__title" id="letter-title">{{ __('frontend.footer.news_title') }}</h2>
                <p class="letter__line">{{ __('frontend.footer.news_text') }}</p>
            </div>

            <div class="letter__act" data-letter>
                <form class="letter__form" novalidate data-letter-form>
                    <label class="letter__label" for="letter-email">{{ __('frontend.footer.news_field') }}</label>
                    <div class="letter__row">
                        <input type="email" name="email" id="letter-email" class="letter__input" placeholder="{{ __('frontend.footer.news_placeholder') }}" autocomplete="email" required aria-describedby="letter-bad">
                        <button type="submit" class="letter__send">
                            <span>{{ __('frontend.footer.news_button') }}</span>
                            <span class="letter__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div>
                    <p class="letter__bad" id="letter-bad" role="alert" hidden data-letter-bad data-empty="{{ __('frontend.footer.news_empty') }}" data-invalid="{{ __('frontend.footer.news_invalid') }}">
                        <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                        <span data-letter-msg>{{ __('frontend.footer.news_invalid') }}</span>
                    </p>
                </form>
                <p class="letter__ok" role="status" hidden data-letter-ok>
                    <span class="letter__stamp" aria-hidden="true"><i class="fas fa-check"></i></span>
                    <span>{{ __('frontend.footer.news_success') }}</span>
                </p>
            </div>
        </section>

        <div class="foot__grid">
            <div class="foot__brand">
                <a href="{{ route('home') }}" class="foot__logo">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $footSite }}" width="869" height="144" loading="lazy">
                </a>
                <p class="foot__about">{{ __('frontend.footer.intro') }}</p>
                @if($footCats->isNotEmpty())
                    <p class="foot__head" id="foot-cats">{{ __('frontend.footer.categories') }}</p>
                    <ul class="foot__tags" aria-labelledby="foot-cats">
                        @foreach($footCats as $cat)
                            <li><a href="{{ route('product-lists', $cat->slug) }}" class="foot__tag"><span class="foot__dot" aria-hidden="true"></span>{{ $cat->title }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <nav class="foot__col" aria-labelledby="foot-learn">
                <p class="foot__head" id="foot-learn">{{ __('frontend.footer.learn_title') }}</p>
                <ul class="foot__links">
                    @foreach($footLearn as $link)
                        <li><a href="{{ $link['url'] }}" class="foot__link"><span class="foot__roll" data-text="{{ $link['label'] }}"><span>{{ $link['label'] }}</span></span><i class="fas fa-long-arrow-alt-right foot__go" aria-hidden="true"></i></a></li>
                    @endforeach
                </ul>
            </nav>

            <nav class="foot__col" aria-labelledby="foot-legal">
                <p class="foot__head" id="foot-legal">{{ __('frontend.footer.legal_title') }}</p>
                <ul class="foot__links">
                    @foreach($footLegal as $link)
                        <li><a href="{{ $link['url'] }}" class="foot__link"><span class="foot__roll" data-text="{{ $link['label'] }}"><span>{{ $link['label'] }}</span></span><i class="fas fa-long-arrow-alt-right foot__go" aria-hidden="true"></i></a></li>
                    @endforeach
                </ul>
            </nav>

            <div class="foot__col">
                <p class="foot__head" id="foot-reach">{{ __('frontend.footer.contact_title') }}</p>
                <dl class="reach" aria-labelledby="foot-reach">
                    <div class="reach__item">
                        <span class="reach__icon" aria-hidden="true"><i class="far fa-building"></i></span>
                        <div>
                            <dt>{{ __('frontend.footer.company') }}</dt>
                            <dd>{{ $footCompany }}</dd>
                        </div>
                    </div>
                    <div class="reach__item">
                        <span class="reach__icon" aria-hidden="true"><i class="far fa-envelope"></i></span>
                        <div>
                            <dt>{{ __('frontend.footer.email') }}</dt>
                            <dd><a href="mailto:{{ $footMail }}" class="reach__mail">{{ $footMail }}</a></dd>
                        </div>
                    </div>
                    <div class="reach__item">
                        <span class="reach__icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                        <div>
                            <dt>{{ __('frontend.footer.address') }}</dt>
                            <dd>{{ $footAddress }}</dd>
                        </div>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div class="foot__base">
        <div class="foot__base-in">
            <p class="foot__copy">&copy; {{ date('Y') }} <a href="{{ route('home') }}">{{ $footCompany }}</a>. {{ __('frontend.footer.rights') }}</p>
            <span class="foot__pay"><img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.footer.payments') }}" width="220" height="30" loading="lazy"></span>
        </div>
    </div>
</footer>

</div>

<button type="button" class="lift" aria-label="{{ __('frontend.footer.top') }}" data-lift>
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

    var box = document.querySelector('[data-letter]');
    var form = document.querySelector('[data-letter-form]');
    var done = document.querySelector('[data-letter-ok]');
    var bad = document.querySelector('[data-letter-bad]');
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
                if (bad) {
                    var msg = bad.querySelector('[data-letter-msg]');
                    if (msg) { msg.textContent = value === '' ? bad.getAttribute('data-empty') : bad.getAttribute('data-invalid'); }
                    bad.hidden = false;
                }
                field.focus();
                return;
            }

            form.reset();
            if (bad) { bad.hidden = true; }
            box.classList.add('is-done');
            if (done) { done.hidden = false; }

            clearTimeout(timer);
            timer = setTimeout(function () {
                box.classList.remove('is-done');
                if (done) { done.hidden = true; }
            }, 5000);
        });
    }

    var lift = document.querySelector('[data-lift]');
    var ticking = false;

    function paint() {
        ticking = false;
        if (!lift) { return; }
        var max = document.documentElement.scrollHeight - window.innerHeight;
        var progress = max > 0 ? Math.min(window.scrollY / max, 1) : 0;
        lift.classList.toggle('is-shown', window.scrollY > 320);
        lift.style.setProperty('--p', progress.toFixed(3));
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

    if (lift) {
        lift.addEventListener('click', function () {
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
