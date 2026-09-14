@extends('frontend.layouts.main')
@section('title', __('managenovax.home.hero_title'))
@section('main-content')
@php
    $hmCourses    = \App\Models\Product::where('status', 'active')->count();
    $hmCategories = isset($category_lists) ? $category_lists->count() : 0;
    $hmLevels     = \App\Models\ProductLevel::distinct()->count('skill_level') ?: 4;

    // Featured first, then newest courses to fill up to six cards
    $hmFeatured = collect($featured ?? []);
    if ($hmFeatured->count() < 6 && isset($product_lists)) {
        $hmFeatured = $hmFeatured->concat(
            collect($product_lists)->whereNotIn('id', $hmFeatured->pluck('id'))->take(6 - $hmFeatured->count())
        );
    }

    $hmCur = session('currency');
    $hmSym = $hmCur == 'JPY' ? '&yen;' : ($hmCur == 'HKD' ? 'HK$' : '$');
    $hmTiers = $hmCur == 'JPY'
        ? [['x1', '1'], ['x1.5', '80,000'], ['x2', '160,000'], ['x2.5', '240,000']]
        : ($hmCur == 'HKD'
            ? [['x1', '1'], ['x1.5', '4,000'], ['x2', '8,000'], ['x2.5', '12,000']]
            : [['x1', '1'], ['x1.5', '500'], ['x2', '1,000'], ['x2.5', '1,500']]);
    $hmTierNames = [__('managenovax.credits.tier_standard'), __('managenovax.credits.tier_premium'), __('managenovax.credits.tier_elite'), __('managenovax.credits.tier_vip')];
@endphp

<div class="hm">

    {{-- ================= 1. HERO ================= --}}
    <section class="hm-hero">
        <div class="hm-hero__inner">
            <div class="hm-hero__content">
                <span class="hm-eyebrow">{{ __('managenovax.home.hero_eyebrow') }}</span>
                <h1 class="hm-hero__title">{{ __('managenovax.home.hero_title') }}</h1>
                <p class="hm-hero__desc">{{ __('managenovax.home.hero_desc') }}</p>

                <form class="hm-search" action="{{ route('product-lists') }}" method="GET" role="search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" name="q" placeholder="{{ __('managenovax.home.hero_search_ph') }}" aria-label="{{ __('managenovax.home.hero_search_ph') }}">
                    <button type="submit">{{ __('managenovax.home.hero_search_btn') }}</button>
                </form>

                <div class="hm-hero__actions">
                    <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--dark">{{ __('managenovax.home.hero_btn_start') }} <i class="fas fa-arrow-right"></i></a>
                    @auth
                        <a href="{{ route('user') }}" class="hm-btn hm-btn--outline">{{ __('managenovax.home.hero_btn_account') }}</a>
                    @else
                        <a href="{{ route('register.form') }}" class="hm-btn hm-btn--outline">{{ __('managenovax.home.hero_btn_signup') }}</a>
                    @endauth
                </div>
            </div>

            <div class="hm-hero__media">
                <div class="hm-hero__frame">
                    <video class="hm-video" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/images/home/hero-poster.webp') }}" aria-label="{{ __('managenovax.home.hero_title') }}">
                        <source src="{{ asset('assets/videos/hero.webm') }}" type="video/webm">
                    </video>
                    <button type="button" class="hm-video__toggle" data-hm-video aria-label="Pause video"><i class="fas fa-pause"></i></button>
                </div>
                <span class="hm-float hm-float--1"><i class="fas fa-signal"></i> {{ __('managenovax.home.hero_card_levels') }}</span>
                <span class="hm-float hm-float--2"><i class="fas fa-clock"></i> {{ __('managenovax.home.hero_card_access') }}</span>
                <span class="hm-float hm-float--3"><i class="fas fa-coins"></i> {{ __('managenovax.home.hero_card_credits') }}</span>
                <span class="hm-hero__ring" aria-hidden="true"></span>
            </div>
        </div>
    </section>

    <div class="hm__wrap">

        {{-- ================= 2. STATS ================= --}}
        <ul class="hm-stats">
            <li class="hm-stat"><strong data-count="{{ $hmCourses }}">{{ $hmCourses }}</strong><span><i class="fas fa-book-open"></i> {{ __('managenovax.home.stat_courses') }}</span></li>
            <li class="hm-stat"><strong data-count="{{ $hmCategories }}">{{ $hmCategories }}</strong><span><i class="fas fa-layer-group"></i> {{ __('managenovax.home.stat_categories') }}</span></li>
            <li class="hm-stat"><strong data-count="{{ $hmLevels }}">{{ $hmLevels }}</strong><span><i class="fas fa-signal"></i> {{ __('managenovax.home.stat_levels') }}</span></li>
            <li class="hm-stat"><strong>24/7</strong><span><i class="fas fa-laptop"></i> {{ __('managenovax.home.stat_access') }}</span></li>
        </ul>

        {{-- ================= 3. CATEGORIES ================= --}}
        @if(isset($category_lists) && $category_lists->count())
            <section class="hm-cats hm-reveal">
                <div class="hm-head hm-head--light">
                    <div>
                        <span class="hm-eyebrow hm-eyebrow--lime">{{ __('managenovax.home.cats_eyebrow') }}</span>
                        <h2 class="hm-head__title">{{ __('managenovax.home.cats_title') }}</h2>
                    </div>
                    <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--white">{{ __('managenovax.home.cats_all') }} <i class="fas fa-arrow-right"></i></a>
                </div>
                <ul class="hm-cats__grid">
                    @foreach($category_lists as $i => $cat)
                        <li>
                            <a href="{{ route('product-lists', $cat->slug) }}" class="hm-cat hm-cat--{{ ($i % 4) + 1 }}">
                                <span class="hm-cat__media">
                                    @if($cat->photo)
                                        <img src="{{ asset(ltrim($cat->photo, '/')) }}" alt="" loading="lazy">
                                    @else
                                        <i class="fas fa-layer-group"></i>
                                    @endif
                                </span>
                                <span class="hm-cat__body">
                                    <span class="hm-cat__title">{{ $cat->title }}</span>
                                    <span class="hm-cat__count">{{ __('managenovax.home.cats_courses', ['count' => $cat->products_count ?? 0]) }}</span>
                                </span>
                                <span class="hm-cat__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        {{-- ================= 4. FEATURED COURSES ================= --}}
        @if($hmFeatured->count())
            <section class="hm-featured hm-reveal">
                <div class="hm-head">
                    <div>
                        <span class="hm-eyebrow">{{ __('managenovax.home.featured_eyebrow') }}</span>
                        <h2 class="hm-head__title">{{ __('managenovax.home.featured_title') }}</h2>
                    </div>
                    <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--dark">{{ __('managenovax.home.featured_all') }} <i class="fas fa-arrow-right"></i></a>
                </div>
                <ul class="pl-grid">
                    @foreach($hmFeatured as $course)
                        @php
                            $cimg = $course->photo ? explode(',', $course->photo)[0] : null;
                            $cLevels = $course->levels;
                            $cCount = $cLevels ? $cLevels->count() : 0;
                            $cMin = $cCount ? $cLevels->min('price_in_points') : null;
                            $cCat = optional($course->cat_info)->title;
                        @endphp
                        <li class="pl-card-wrap">
                            <a href="{{ route('product-detail', $course->slug) }}" class="pl-card">
                                <div class="pl-card__media">
                                    @if($cimg)
                                        <img src="{{ asset(ltrim($cimg, '/')) }}" alt="{{ $course->title }}" loading="lazy">
                                    @else
                                        <span class="pl-card__placeholder"><i class="fas fa-graduation-cap"></i></span>
                                    @endif
                                    @if($cCat)
                                        <span class="pl-card__cat">{{ $cCat }}</span>
                                    @endif
                                </div>
                                <div class="pl-card__body">
                                    @if($cCount)
                                        <span class="pl-card__levels"><i class="fas fa-signal"></i> {{ $cCount }} {{ __('managenovax.catalog.levels_label') }}</span>
                                    @endif
                                    <h3 class="pl-card__title">{{ $course->title }}</h3>
                                    @if($course->summary)
                                        <p class="pl-card__summary">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 120) }}</p>
                                    @endif
                                    <div class="pl-card__foot">
                                        @if($cMin !== null)
                                            <span class="pl-card__price">
                                                <small>{{ __('managenovax.catalog.starting_from') }}</small>
                                                <strong><i class="fas fa-coins"></i> {{ number_format($cMin) }}</strong>
                                                <small>{{ __('managenovax.catalog.credits_label') }}</small>
                                            </span>
                                        @else
                                            <span class="pl-card__price"><strong class="pl-card__free">{{ __('managenovax.catalog.free_label') }}</strong></span>
                                        @endif
                                        <span class="pl-card__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        {{-- ================= 5. HOW IT WORKS ================= --}}
        <section class="hm-steps hm-reveal">
            <div class="hm-steps__media">
                <img src="{{ asset('assets/images/home/how-it-works.webp') }}" width="1200" height="800" alt="{{ __('managenovax.home.steps_title') }}" loading="lazy">
                <span class="hm-steps__badge"><i class="fas fa-play"></i> {{ __('managenovax.home.step4_title') }}</span>
            </div>
            <div class="hm-steps__content">
                <span class="hm-eyebrow hm-eyebrow--lime">{{ __('managenovax.home.steps_eyebrow') }}</span>
                <h2 class="hm-steps__title">{{ __('managenovax.home.steps_title') }}</h2>
                <ol class="hm-steps__list">
                    @foreach([['fa-search', 1], ['fa-sliders-h', 2], ['fa-coins', 3], ['fa-graduation-cap', 4]] as [$icon, $n])
                        <li class="hm-step">
                            <span class="hm-step__num">0{{ $n }}</span>
                            <span class="hm-step__icon"><i class="fas {{ $icon }}"></i></span>
                            <div>
                                <h3 class="hm-step__title">{{ __('managenovax.home.step' . $n . '_title') }}</h3>
                                <p class="hm-step__desc">{{ __('managenovax.home.step' . $n . '_desc') }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
            <div class="ab-path hm-steps__path">
                <div class="ab-path__track" aria-hidden="true">
                    <span class="ab-path__lvl ab-path__lvl--beginner">{{ __('managenovax.course.skill_beginner') }}</span>
                    <i class="fas fa-chevron-right"></i>
                    <span class="ab-path__lvl ab-path__lvl--intermediate">{{ __('managenovax.course.skill_intermediate') }}</span>
                    <i class="fas fa-chevron-right"></i>
                    <span class="ab-path__lvl ab-path__lvl--advanced">{{ __('managenovax.course.skill_advanced') }}</span>
                    <i class="fas fa-chevron-right"></i>
                    <span class="ab-path__lvl ab-path__lvl--expert">{{ __('managenovax.course.skill_expert') }}</span>
                </div>
                <p class="ab-path__caption">{{ __('managenovax.home.path_caption') }}</p>
            </div>
        </section>

        {{-- ================= 6. WHY + CREDITS ================= --}}
        <section class="hm-why hm-reveal">
            <div class="hm-why__card">
                <span class="hm-eyebrow">{{ __('managenovax.home.why_eyebrow') }}</span>
                <h2 class="hm-head__title">{{ __('managenovax.home.why_title') }}</h2>
                <ul class="ab-reasons hm-why__grid">
                    @foreach([['fa-sitemap', 'lime'], ['fa-globe', 'cobalt'], ['fa-tools', 'saffron'], ['fa-headset', 'maroon']] as $i => [$icon, $tone])
                        <li class="ab-reason">
                            <span class="ab-reason__icon ab-reason__icon--{{ $tone }}"><i class="fas {{ $icon }}"></i></span>
                            <h3 class="ab-reason__title">{{ __('managenovax.home.why' . ($i + 1) . '_title') }}</h3>
                            <p class="ab-reason__desc">{{ __('managenovax.home.why' . ($i + 1) . '_desc') }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="hm-credits">
                <div class="hm-credits__media">
                    <img src="{{ asset('assets/images/home/credits.webp') }}" width="800" height="800" alt="" loading="lazy">
                    <span class="hm-credits__coin" aria-hidden="true"><i class="fas fa-coins"></i></span>
                </div>
                <div class="hm-credits__body">
                    <h2 class="hm-credits__title">{{ __('managenovax.home.credits_title') }}</h2>
                    <p class="hm-credits__desc">{{ __('managenovax.home.credits_desc') }}</p>
                    <ul class="hm-tiers">
                        @foreach($hmTiers as $t => [$mult, $from])
                            <li class="hm-tier {{ $t === 3 ? 'is-best' : '' }}">
                                <span class="hm-tier__mult">{{ $mult }}</span>
                                <span class="hm-tier__name">{{ $hmTierNames[$t] }}</span>
                                <span class="hm-tier__from">{!! $hmSym !!}{{ $from }}+</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('points.topup') }}" class="hm-btn hm-btn--dark hm-btn--block">{{ __('managenovax.home.credits_btn') }} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        {{-- ================= 7. FINAL CTA ================= --}}
        <section class="hm-cta hm-reveal">
            <div class="hm-cta__content">
                <h2 class="hm-cta__title">{{ __('managenovax.home.cta_title') }}</h2>
                <p class="hm-cta__desc">{{ __('managenovax.home.cta_desc') }}</p>
                <div class="hm-cta__actions">
                    <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--lime">{{ __('managenovax.home.cta_btn_courses') }} <i class="fas fa-arrow-right"></i></a>
                    <a href="{{ route('contact') }}" class="hm-btn hm-btn--outline-light">{{ __('managenovax.home.cta_btn_contact') }}</a>
                </div>
            </div>
            <div class="hm-cta__media">
                <img src="{{ asset('assets/images/home/start-today.webp') }}" width="1200" height="600" alt="" loading="lazy">
            </div>
        </section>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Hero video: pause for reduced motion + play/pause button
        document.querySelectorAll('[data-hm-video]').forEach(function (btn) {
            var video = btn.parentElement.querySelector('video');
            if (!video) return;
            if (reduce) { video.removeAttribute('autoplay'); video.pause(); }
            var sync = function () {
                btn.querySelector('i').className = video.paused ? 'fas fa-play' : 'fas fa-pause';
                btn.setAttribute('aria-label', video.paused ? 'Play video' : 'Pause video');
            };
            btn.addEventListener('click', function () { video.paused ? video.play() : video.pause(); });
            video.addEventListener('play', sync);
            video.addEventListener('pause', sync);
            sync();
        });

        if (!('IntersectionObserver' in window)) {
            document.querySelectorAll('.hm-reveal').forEach(function (el) { el.classList.add('is-visible'); });
            return;
        }

        // Reveal sections on scroll
        var revealIO = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                revealIO.unobserve(entry.target);
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.hm-reveal').forEach(function (el) {
            if (reduce) el.classList.add('is-visible'); else revealIO.observe(el);
        });

        // Count-up stats
        if (reduce) return;
        var countIO = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var el = entry.target, end = parseInt(el.dataset.count, 10) || 0, start = null;
                var step = function (t) {
                    if (!start) start = t;
                    var p = Math.min((t - start) / 900, 1);
                    el.textContent = Math.round(end * (1 - Math.pow(1 - p, 3)));
                    if (p < 1) requestAnimationFrame(step);
                };
                requestAnimationFrame(step);
                countIO.unobserve(el);
            });
        }, { threshold: 0.6 });
        document.querySelectorAll('.hm-stat strong[data-count]').forEach(function (n) { countIO.observe(n); });
    });
</script>
@endpush
