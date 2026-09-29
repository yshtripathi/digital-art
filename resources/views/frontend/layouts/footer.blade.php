@php
    $ftSite    = __('frontend.head.site');
    $ftIsJa    = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
    $ftCompany = filled($misc['Company Name'] ?? null) ? $misc['Company Name'] : __('frontend.company.name');
    $ftMail    = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $ftAddress = filled($misc['Company Address'] ?? null) ? $misc['Company Address'] : __('frontend.company.address');
    $ftCats    = (isset($category) && $category instanceof \Illuminate\Support\Collection ? $category : \App\Models\Category::getAllParentWithChild());
    $ftLogo    = file_exists(public_path('assets/images/logo.webp')) ? asset('assets/images/logo.webp') : null;
    $ftPay     = file_exists(public_path('assets/images/payment.webp')) ? asset('assets/images/payment.webp') : null;

    $ftGuides = [];
    foreach ($ftCats as $cat) {
        $ftGuides[] = ['url' => route('product-lists', $cat->slug), 'label' => $ftIsJa && filled($cat->title_jp ?? null) ? $cat->title_jp : $cat->title];
    }

    $ftCompanyLinks = [
        ['url' => route('about-us'),     'label' => __('frontend.footer.about')],
        ['url' => route('contact'),      'label' => __('frontend.footer.contact')],
        ['url' => route('points.topup'), 'label' => __('frontend.footer.buy_credits')],
    ];

    $ftLegal = [
        ['url' => route('pages', 'terms-conditions'), 'label' => __('frontend.footer.terms')],
        ['url' => route('pages', 'privacy-policy'),   'label' => __('frontend.footer.privacy')],
        ['url' => route('pages', 'refund-policy'),    'label' => __('frontend.footer.refund')],
        ['url' => route('pages', 'delivery-policy'),  'label' => __('frontend.footer.delivery')],
    ];

    $ftColumns = [
        ['id' => 'ft-guides',  'title' => __('frontend.footer.guides_title'),  'links' => $ftGuides],
        ['id' => 'ft-company', 'title' => __('frontend.footer.company_title'), 'links' => $ftCompanyLinks],
        ['id' => 'ft-legal',   'title' => __('frontend.footer.legal_title'),   'links' => $ftLegal],
    ];
@endphp

<footer class="ft">
    <div class="container">
        <section class="ft-news" aria-labelledby="ft-news-title" data-news>
            <div class="ft-news__copy">
                <p class="eyebrow ft-news__label">{{ __('frontend.footer.news_label') }}</p>
                <h2 class="ft-news__title" id="ft-news-title">{{ __('frontend.footer.news_title') }}</h2>
                <p class="ft-news__text">{{ __('frontend.footer.news_text') }}</p>
            </div>

            <div class="ft-news__side">
                <form class="ft-news__form" novalidate data-news-form>
                    <label class="vh" for="ft-news-email">{{ __('frontend.footer.news_field') }}</label>
                    <div class="ft-news__field">
                        <i class="far fa-envelope ft-news__icon" aria-hidden="true"></i>
                        <input type="email" name="email" id="ft-news-email" placeholder="{{ __('frontend.footer.news_placeholder') }}" autocomplete="email" required aria-describedby="ft-news-bad">
                        <button type="submit" class="ft-news__btn">
                            <span>{{ __('frontend.footer.news_button') }}</span>
                            <span class="ft-news__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i><i class="fas fa-arrow-right"></i></span>
                        </button>
                    </div>
                    <p class="ft-news__bad" id="ft-news-bad" role="alert" hidden data-news-bad data-empty="{{ __('frontend.footer.news_empty') }}" data-invalid="{{ __('frontend.footer.news_invalid') }}">{{ __('frontend.footer.news_invalid') }}</p>
                </form>
                <p class="ft-news__ok" role="status" hidden data-news-ok>
                    <span class="ft-news__tick" aria-hidden="true"><i class="fas fa-check"></i></span>
                    <span>{{ __('frontend.footer.news_success') }}</span>
                </p>
            </div>
        </section>

        <div class="ft-main">
            <div class="ft-brand">
                <a href="{{ route('home') }}" class="ft-logo" aria-label="{{ $ftSite }}">
                    @if($ftLogo)
                        <img src="{{ $ftLogo }}" alt="{{ $ftSite }}" width="716" height="210" loading="lazy">
                    @else
                        <span>{{ $ftSite }}</span>
                    @endif
                </a>
                <p class="ft-brand__intro">{{ __('frontend.footer.intro') }}</p>
                <ul class="ft-reach">
                    <li class="ft-reach__item">
                        <span class="ft-reach__icon" aria-hidden="true"><i class="far fa-building"></i></span>
                        <span><span class="vh">{{ __('frontend.footer.company') }}: </span>{{ $ftCompany }}</span>
                    </li>
                    <li>
                        <a href="mailto:{{ $ftMail }}" class="ft-reach__item ft-reach__item--link">
                            <span class="ft-reach__icon" aria-hidden="true"><i class="far fa-envelope"></i></span>
                            <span><span class="vh">{{ __('frontend.footer.email') }}: </span>{{ $ftMail }}</span>
                        </a>
                    </li>
                    <li class="ft-reach__item">
                        <span class="ft-reach__icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                        <span><span class="vh">{{ __('frontend.footer.address') }}: </span>{{ $ftAddress }}</span>
                    </li>
                </ul>
            </div>

            <div class="ft-cols">
                @foreach($ftColumns as $col)
                    @continue(empty($col['links']))
                    <nav class="ft-col" aria-labelledby="{{ $col['id'] }}">
                        <p class="ft-col__title" id="{{ $col['id'] }}">{{ $col['title'] }}</p>
                        <ul class="ft-col__list">
                            @foreach($col['links'] as $link)
                                <li><a href="{{ $link['url'] }}" class="ft-link" data-text="{{ $link['label'] }}"><span>{{ $link['label'] }}</span></a></li>
                            @endforeach
                        </ul>
                    </nav>
                @endforeach
            </div>
        </div>

        <p class="ft-mark" aria-hidden="true">{{ $ftSite }}</p>

        <div class="ft-base">
            <p class="ft-base__copy">&copy; {{ date('Y') }} <a href="{{ route('home') }}" class="ft-base__home">{{ $ftCompany }}</a>. {{ __('frontend.footer.rights') }}</p>
            <div class="ft-base__end">
                @if($ftPay)
                    <img class="ft-base__pay" src="{{ $ftPay }}" alt="{{ __('frontend.footer.payments') }}" width="220" height="30" loading="lazy">
                @endif
            </div>
        </div>
    </div>

    <button type="button" class="ft-up" aria-label="{{ __('frontend.footer.top') }}" data-to-top>
        <i class="fas fa-arrow-up" aria-hidden="true"></i>
    </button>
</footer>


</div>

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
    var box = document.querySelector('[data-news]');
    var form = document.querySelector('[data-news-form]');
    var done = document.querySelector('[data-news-ok]');
    var bad = document.querySelector('[data-news-bad]');
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
                box.classList.add('is-bad');
                field.setAttribute('aria-invalid', 'true');
                if (bad) {
                    bad.textContent = value === '' ? bad.getAttribute('data-empty') : bad.getAttribute('data-invalid');
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

    var toTop = document.querySelector('[data-to-top]');
    if (toTop) {
        toTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: calm.matches ? 'auto' : 'smooth' });
        });

        var upTicking = false;
        var showUp = function () {
            upTicking = false;
            toTop.classList.toggle('is-shown', window.scrollY > 480);
        };
        window.addEventListener('scroll', function () {
            if (!upTicking) { upTicking = true; requestAnimationFrame(showUp); }
        }, { passive: true });
        showUp();
    }
}());
</script>

@if(env('CONTENT_PROTECTION_ENABLED', true))
<script src="{{ asset('js/prevention.js') }}"></script>
@endif

@stack('scripts')

</body>
</html>
