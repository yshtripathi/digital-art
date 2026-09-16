@extends('frontend.layouts.main')

@section('title', __('frontend.home.tab'))
@section('description', __('frontend.home.meta'))

@section('main-content')
@php
    $hmCategories = isset($category_lists) ? $category_lists : collect();

    // Every active course goes in the carousel, featured ones leading.
    // A course with no photo is skipped — its slide would be an empty band.
    $hmWithPhoto = collect($product_lists ?? [])->filter(fn ($c) => !empty($c->photo))->values();
    $hmFeatured  = $hmWithPhoto->where('is_featured', 1)
        ->concat($hmWithPhoto->where('is_featured', '!=', 1))
        ->values();

    // Same tiers, quick amounts and symbol as the top-up page
    $cur = session('currency');
    if ($cur == 'JPY') {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'&yen;1 - &yen;79,999',        'f'=>false],
            ['n'=>__('frontend.topup.tier2'), 'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'&yen;80,000 - &yen;159,999',  'f'=>false],
            ['n'=>__('frontend.topup.tier3'), 'i'=>'fa-gem',     'big'=>'x2',   'r'=>'&yen;160,000 - &yen;239,999', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'), 'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'&yen;240,000+',               'f'=>true],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'HK$1 - HK$3,999',      'f'=>false],
            ['n'=>__('frontend.topup.tier2'), 'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'HK$4,000 - HK$7,999',  'f'=>false],
            ['n'=>__('frontend.topup.tier3'), 'i'=>'fa-gem',     'big'=>'x2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'), 'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'HK$12,000+',           'f'=>true],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
    } else {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'$1 - $499',       'f'=>false],
            ['n'=>__('frontend.topup.tier2'), 'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'$500 - $999',     'f'=>false],
            ['n'=>__('frontend.topup.tier3'), 'i'=>'fa-gem',     'big'=>'x2',   'r'=>'$1,000 - $1,499', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'), 'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'$1,500+',         'f'=>true],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
    }
@endphp

<div class="hm">

    {{-- ================= 1. FEATURED CAROUSEL ================= --}}
    @if($hmFeatured->count())
        <section class="hc" data-carousel aria-roledescription="carousel" aria-label="{{ __('frontend.home.featured_title') }}">

            {{-- Slides: the course still fills the band, its details sit over it --}}
            @foreach($hmFeatured as $i => $course)
                @php
                    $hcImg = explode(',', $course->photo)[0];
                    $hcLevels = $course->levels ? $course->levels->count() : 0;
                    $hcMin = $hcLevels ? $course->levels->min('price_in_points') : null;
                @endphp
                <article class="hc-slide {{ $i === 0 ? 'is-active' : '' }}" data-slide="{{ $i }}" @if($i !== 0) hidden @endif>
                    <img class="hc-slide__img" src="{{ asset(ltrim($hcImg, '/')) }}" alt=""
                         @if($i === 0) fetchpriority="high" @else loading="lazy" @endif decoding="async">
                    <span class="hc-slide__veil" aria-hidden="true"></span>

                    <div class="hc-slide__body">
                        <p class="hc-slide__kicker">
                            @if(optional($course->cat_info)->title)
                                {{ $course->cat_info->title }}
                            @else
                                {{ __('frontend.home.hero_label') }}
                            @endif
                        </p>

                        <h2 class="hc-slide__title">{{ $course->title }}</h2>

                        @if($course->summary)
                            <p class="hc-slide__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 260) }}</p>
                        @endif

                        @if($hcLevels)
                            <p class="hc-slide__meta">
                                {{ __('frontend.home.from') }}
                                <strong>{{ number_format($hcMin) }}</strong>
                                {{ __('frontend.home.credits') }}
                            </p>
                        @endif

                        <a href="{{ route('product-detail', $course->slug) }}" class="hm-btn hm-btn--primary">
                            {{ __('frontend.home.hero_courses') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
            @endforeach

            {{-- Thumbnail picker --}}
            @if($hmFeatured->count() > 1)
                <div class="hc-picker">
                    <button type="button" class="hc-picker__arrow" data-prev aria-label="{{ __('frontend.home.prev') }}">
                        <i class="fas fa-chevron-left" aria-hidden="true"></i>
                    </button>

                    <ul class="hc-thumbs" data-strip>
                        @foreach($hmFeatured as $i => $course)
                            <li>
                                <button type="button" class="hc-thumb {{ $i === 0 ? 'is-active' : '' }}" data-go="{{ $i }}"
                                        aria-label="{{ $course->title }}" aria-current="{{ $i === 0 ? 'true' : 'false' }}">
                                    <img src="{{ asset(ltrim(explode(',', $course->photo)[0], '/')) }}" alt="" loading="lazy" decoding="async">
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <button type="button" class="hc-picker__arrow" data-next aria-label="{{ __('frontend.home.next') }}">
                        <i class="fas fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            @endif

            <div class="hc-progress" aria-hidden="true"><span data-progress></span></div>
        </section>
    @endif

    <div class="hm__wrap">

        {{-- ================= 2. COLLAGE ================= --}}
        <section class="hg">
            <h1 class="hg__title">{{ __('frontend.home.hero_title') }}</h1>

            <ul class="hg__grid">
                <li class="hg__item hg__item--1">
                    <figure class="hg-tile">
                        <img src="{{ asset('assets/images/home/audio-studio.webp') }}"
                             srcset="{{ asset('assets/images/home/audio-studio-sm.webp') }} 520w, {{ asset('assets/images/home/audio-studio.webp') }} 900w"
                             sizes="(max-width: 63.99rem) 100vw, 30vw"
                             width="900" height="900" alt="" loading="lazy" decoding="async">
                        <figcaption class="hg-tile__caption">{{ __('frontend.home.card_levels') }}</figcaption>
                    </figure>
                </li>

                <li class="hg__item hg__item--2">
                    <figure class="hg-tile hg-tile--tall">
                        <img src="{{ asset('assets/images/home/homework-help.webp') }}"
                             srcset="{{ asset('assets/images/home/homework-help-sm.webp') }} 460w, {{ asset('assets/images/home/homework-help.webp') }} 800w"
                             sizes="(max-width: 63.99rem) 100vw, 30vw"
                             width="800" height="1200" alt="" loading="lazy" decoding="async">
                        <figcaption class="hg-tile__caption">{{ __('frontend.home.card_pace') }}</figcaption>
                    </figure>
                </li>

                <li class="hg__item hg__item--3">
                    <figure class="hg-tile">
                        <img src="{{ asset('assets/images/home/design-cafe.webp') }}"
                             srcset="{{ asset('assets/images/home/design-cafe-sm.webp') }} 520w, {{ asset('assets/images/home/design-cafe.webp') }} 900w"
                             sizes="(max-width: 63.99rem) 100vw, 30vw"
                             width="900" height="900" alt="" loading="lazy" decoding="async">
                        <figcaption class="hg-tile__caption">{{ __('frontend.home.card_credits') }}</figcaption>
                    </figure>
                </li>
            </ul>
        </section>

        {{-- ================= 3. CATEGORIES ================= --}}
        @if($hmCategories->count())
            <section class="hm-cats">
                <div class="hm-head">
                    <div>
                        <h2 class="hm-head__title">{{ __('frontend.home.cats_title') }}</h2>
                        <p class="hm-head__desc">{{ __('frontend.home.hero_desc') }}</p>
                    </div>
                    <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--secondary">
                        {{ __('frontend.home.cats_all') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>

                {{-- Category carousel: still on the left, its details on the right --}}
                <div class="cx" data-carousel aria-roledescription="carousel" aria-label="{{ __('frontend.home.cats_title') }}">
                    @foreach($hmCategories as $i => $cat)
                        <article class="cx-slide {{ $i === 0 ? 'is-active' : '' }}" data-slide="{{ $i }}" @if($i !== 0) hidden @endif>
                            <div class="cx-slide__media">
                                @if($cat->photo)
                                    <img src="{{ asset(ltrim($cat->photo, '/')) }}" alt=""
                                         @if($i !== 0) loading="lazy" @endif decoding="async">
                                @else
                                    <span class="cx-slide__ph" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                                @endif
                            </div>

                            <div class="cx-slide__body">
                                <p class="cx-slide__kicker">{{ __('frontend.home.cats_label') }}</p>
                                <h3 class="cx-slide__title">{{ $cat->title }}</h3>

                                @if($cat->summary)
                                    <p class="cx-slide__desc">{{ \Illuminate\Support\Str::limit(strip_tags($cat->summary), 220) }}</p>
                                @endif

                                <p class="cx-slide__count">
                                    {{ trans_choice('frontend.home.cats_count', $cat->products_count ?? 0, ['count' => $cat->products_count ?? 0]) }}
                                </p>

                                <a href="{{ route('product-lists', $cat->slug) }}" class="hm-btn hm-btn--primary">
                                    {{ __('frontend.home.cats_all') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach

                    @if($hmCategories->count() > 1)
                        <div class="cx-nav">
                            <button type="button" class="cx-nav__arrow" data-prev aria-label="{{ __('frontend.home.prev') }}">
                                <i class="fas fa-chevron-left" aria-hidden="true"></i>
                            </button>
                            <p class="cx-nav__count">
                                <span data-counter>1</span> / {{ $hmCategories->count() }}
                            </p>
                            <button type="button" class="cx-nav__arrow" data-next aria-label="{{ __('frontend.home.next') }}">
                                <i class="fas fa-chevron-right" aria-hidden="true"></i>
                            </button>

                            <div class="cx-progress" aria-hidden="true"><span data-progress></span></div>
                        </div>
                    @endif
                </div>
            </section>
        @endif

        {{-- ================= 4. BUY CREDITS ================= --}}
        <section class="hm-how">
            <div class="hm-head">
                <div>
                    <h2 class="hm-head__title">{{ __('frontend.topup.tiers_title') }}</h2>
                    <p class="hm-head__desc">{{ __('frontend.topup.intro') }}</p>
                </div>
                <a href="{{ route('points.topup') }}" class="hm-btn hm-btn--secondary">
                    {{ __('frontend.home.credits_btn') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            <div class="tu__grid">

                {{-- Rate axis --}}
                <div class="tu-tiers">
                    <ul class="tu-tiers__grid">
                        @foreach($tiers as $index => $t)
                            <li class="tu-tier {{ $t['f'] ? 'tu-tier--best' : '' }}" data-mult="{{ $t['big'] }}">
                                <div class="tu-tier__top">
                                    <span class="tu-tier__icon"><i class="fas {{ $t['i'] }}" aria-hidden="true"></i></span>
                                    @if($t['f'])
                                        <span class="tu-tier__badge">{{ __('frontend.topup.best') }}</span>
                                    @endif
                                    <span class="tu-tier__current"><i class="fas fa-check" aria-hidden="true"></i> {{ __('frontend.topup.current') }}</span>
                                </div>
                                <p class="tu-tier__mult">{{ $t['big'] }}</p>
                                <div class="tu-tier__meta">
                                    <strong class="tu-tier__name">{{ $t['n'] }}</strong>
                                    <span class="tu-tier__range">{!! $t['r'] !!}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Calculator --}}
                <div class="tu-calc">
                    <div class="tu-calc__head">
                        <span class="tu-calc__icon"><i class="fas fa-calculator" aria-hidden="true"></i></span>
                        <div>
                            <h2 class="tu-calc__title">{{ __('frontend.topup.calc_title') }}</h2>
                            <p class="tu-calc__desc">{{ __('frontend.topup.calc_desc') }}</p>
                        </div>
                    </div>

                    <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-form tu-form" novalidate>
                        @csrf

                        <label class="tu-form__label" for="topup_amount">{{ __('frontend.topup.amount') }}</label>
                        <div class="tu-amount">
                            <span class="tu-amount__symbol">{!! $symbol !!}</span>
                            <input type="number" name="amount" id="topup_amount" class="tu-amount__input" placeholder="0" min="1" required inputmode="decimal">
                        </div>

                        <span class="tu-form__label tu-form__label--sm">{{ __('frontend.topup.quick') }}</span>
                        <div class="tu-quick">
                            @foreach($quick as $q)
                                <button type="button" class="tu-quick__btn" data-amount="{{ $q }}">{!! $symbol !!}{{ number_format($q) }}</button>
                            @endforeach
                        </div>

                        <div class="tu-stats">
                            <div class="tu-stats__row">
                                <span>{{ __('frontend.topup.base') }}:</span>
                                <span id="base_points">0</span>
                            </div>
                            <div class="tu-stats__row">
                                <span>{{ __('frontend.topup.multiplier') }}:</span>
                                <span class="tu-stats__mult" id="multiplier_display">x1</span>
                            </div>
                            <div class="tu-stats__total">
                                <span class="tu-stats__total-label">{{ __('frontend.topup.total') }}:</span>
                                <span class="tu-stats__total-value"><i class="fas fa-coins" aria-hidden="true"></i> <span id="total_points">0</span></span>
                            </div>
                        </div>

                        <button type="submit" class="topup-btn tu-submit">
                            <span>{{ __('frontend.topup.submit') }}</span>
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </button>

                        <p class="tu-trust">
                            <i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.topup.secure') }}
                        </p>
                    </form>
                </div>
            </div>
        </section>

        {{-- ================= 5. WHY LEARN HERE ================= --}}
        <section class="hw">
            <div class="hw__main">
                <div class="hw-video">
                    <video class="hw-video__el" autoplay muted loop playsinline preload="metadata"
                           poster="{{ asset('assets/images/home/study-online-poster.webp') }}"
                           aria-label="{{ __('frontend.home.video_label') }}">
                        <source src="{{ asset('assets/videos/study-online.webm') }}" type="video/webm">
                        <source src="{{ asset('assets/videos/study-online.mp4') }}" type="video/mp4">
                    </video>
                    <button type="button" class="hw-video__toggle" data-video-toggle aria-label="{{ __('frontend.home.video_pause') }}">
                        <i class="fas fa-pause" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="hw__text">
                    <h2 class="hw__title">{{ __('frontend.home.why_title') }}</h2>
                    <ul class="hw-points">
                        @for($w = 1; $w <= 3; $w++)
                            <li class="hw-point">
                                <span class="hw-point__name">{{ __('frontend.home.why' . $w . '_title') }}</span>
                                <span class="hw-point__desc">{{ __('frontend.home.why' . $w . '_desc') }}</span>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>

            {{-- Portrait still, running the full height of the band --}}
            <figure class="hw__figure">
                <img src="{{ asset('assets/images/home/homework-help.webp') }}"
                     srcset="{{ asset('assets/images/home/homework-help-sm.webp') }} 460w, {{ asset('assets/images/home/homework-help.webp') }} 800w"
                     sizes="(max-width: 63.99rem) 100vw, 32vw"
                     width="800" height="1200" alt="" loading="lazy" decoding="async">
            </figure>
        </section>

        {{-- ================= 6. FINAL CTA ================= --}}
        <section class="hm-cta">
            <h2 class="hm-cta__title">{{ __('frontend.home.cta_title') }}</h2>
            <p class="hm-cta__desc">{{ __('frontend.home.cta_desc') }}</p>
            <div class="hm-cta__actions">
                <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--primary">
                    {{ __('frontend.home.cta_courses') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="hm-btn hm-btn--onDark">{{ __('frontend.home.cta_contact') }}</a>
            </div>
        </section>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // One carousel driver, shared by the course band and the category block.
    // Thumbnails, arrows, the counter, the progress bar and the timer all read
    // from a single index.
    document.addEventListener('DOMContentLoaded', function () {
        var DELAY = 5000;

        document.querySelectorAll('[data-carousel]').forEach(function (root) {
            var slides = Array.prototype.slice.call(root.querySelectorAll('[data-slide]'));
            if (slides.length < 2) return;

            var thumbs   = Array.prototype.slice.call(root.querySelectorAll('[data-go]'));
            var strip    = root.querySelector('[data-strip]');
            var counter  = root.querySelector('[data-counter]');
            var progress = root.querySelector('[data-progress]');
            var prev     = root.querySelector('[data-prev]');
            var next     = root.querySelector('[data-next]');
            var index    = 0;
            var timer    = null;

            function restartBar() {
                if (!progress) return;
                // Re-trigger the countdown animation from zero
                progress.style.animation = 'none';
                void progress.offsetWidth;
                progress.style.animation = '';
            }

            function show(to) {
                index = (to + slides.length) % slides.length;

                slides.forEach(function (slide, i) {
                    var on = i === index;
                    slide.hidden = !on;
                    slide.classList.toggle('is-active', on);
                });

                thumbs.forEach(function (thumb, i) {
                    var on = i === index;
                    thumb.classList.toggle('is-active', on);
                    thumb.setAttribute('aria-current', on ? 'true' : 'false');
                    // Keep the active thumbnail in view as the strip scrolls
                    if (on && strip) {
                        strip.scrollTo({
                            left: thumb.offsetLeft - (strip.clientWidth - thumb.offsetWidth) / 2,
                            behavior: 'smooth'
                        });
                    }
                });

                if (counter) counter.textContent = index + 1;
                restartBar();
            }

            function stop() {
                if (timer) { clearInterval(timer); timer = null; }
                root.classList.add('is-paused');
            }

            function play() {
                stop();
                root.classList.remove('is-paused');
                restartBar();
                timer = setInterval(function () { show(index + 1); }, DELAY);
            }

            // A manual move restarts the clock rather than cutting a slide short
            function go(to) { show(to); play(); }

            thumbs.forEach(function (thumb, i) {
                thumb.addEventListener('click', function () { go(i); });
            });
            if (prev) prev.addEventListener('click', function () { go(index - 1); });
            if (next) next.addEventListener('click', function () { go(index + 1); });

            root.addEventListener('keydown', function (e) {
                if (e.key === 'ArrowLeft')  { go(index - 1); }
                if (e.key === 'ArrowRight') { go(index + 1); }
            });

            // Hovering does not stop the rotation — it keeps its 5s rhythm.
            // Focus still holds it, so tabbing through the controls is possible.
            root.addEventListener('focusin', stop);
            root.addEventListener('focusout', play);

            document.addEventListener('visibilitychange', function () {
                if (document.hidden) { stop(); } else { play(); }
            });

            play();
        });
    });
</script>
<script>
    // Live points calculator
    document.addEventListener('DOMContentLoaded', function() {
        const amountInput = document.getElementById('topup_amount');
        const totalPointsDisplay = document.getElementById('total_points');
        const basePointsDisplay = document.getElementById('base_points');
        const multiplierDisplay = document.getElementById('multiplier_display');
        if (!amountInput) return;

        function calculatePoints() {
            const amount = parseFloat(amountInput.value) || 0;
            let multiplier = 1;
            const isJPY = {{ session('currency') == 'JPY' ? 'true' : 'false' }};
            const isHKD = {{ session('currency') == 'HKD' ? 'true' : 'false' }};
            let basePoints = 0;

            if (isJPY) {
                basePoints = Math.floor(amount / 160);
                if (amount >= 240000) multiplier = 2.5;
                else if (amount >= 160000) multiplier = 2;
                else if (amount >= 80000) multiplier = 1.5;
                else multiplier = 1;
            } else if (isHKD) {
                basePoints = Math.floor(amount / 8);
                if (amount >= 12000) multiplier = 2.5;
                else if (amount >= 8000) multiplier = 2;
                else if (amount >= 4000) multiplier = 1.5;
                else multiplier = 1;
            } else {
                basePoints = Math.floor(amount);
                if (amount >= 1500) multiplier = 2.5;
                else if (amount >= 1000) multiplier = 2;
                else if (amount >= 500) multiplier = 1.5;
                else multiplier = 1;
            }

            const totalPoints = Math.round(basePoints * multiplier);
            if(basePointsDisplay) basePointsDisplay.textContent = basePoints.toLocaleString();
            if(multiplierDisplay) multiplierDisplay.textContent = 'x' + multiplier;
            if(totalPointsDisplay) totalPointsDisplay.textContent = totalPoints.toLocaleString();
        }

        amountInput.addEventListener('input', calculatePoints);
        amountInput.addEventListener('input', function () { this.setCustomValidity(''); });
        amountInput.addEventListener('change', calculatePoints);

        // Topup (add to cart) - submit without redirect, then reload
        const topupForms = document.querySelectorAll('.topup-form');
        topupForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const amountField = form.querySelector('#topup_amount');
                if (amountField && !((parseFloat(amountField.value) || 0) >= 1)) {
                    amountField.setCustomValidity(@json(__('frontend.topup.amount_req')));
                    amountField.reportValidity();
                    return;
                }
                const submitBtn = form.querySelector('.topup-btn');
                const originalBtnText = submitBtn.innerHTML;
                const originalBtnState = submitBtn.disabled;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + @json(__('frontend.topup.loading'));

                fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                    .then(response => new Promise(resolve => setTimeout(() => resolve(response), 500)))
                    .then(() => { window.location.reload(); })
                    .catch(error => {
                        console.error('Error:', error);
                        submitBtn.disabled = originalBtnState;
                        submitBtn.innerHTML = originalBtnText;
                    });
            });
        });
    });
</script>

<script>
    // UI only: quick amounts, current-tier highlight and total pulse.
    // Reads the calculator's output; the calculation above is unchanged.
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('topup_amount');
        const multiplier = document.getElementById('multiplier_display');
        const total = document.getElementById('total_points');
        if (!input || !multiplier || !total) return;

        document.querySelectorAll('.tu-quick__btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                input.value = btn.dataset.amount;
                input.dispatchEvent(new Event('input', { bubbles: true }));
                input.focus();
            });
        });

        const tiers = document.querySelectorAll('.tu-tier');
        const quickBtns = document.querySelectorAll('.tu-quick__btn');
        const totalWrap = total.closest('.tu-stats__total');

        new MutationObserver(function () {
            const hasAmount = (parseFloat(input.value) || 0) > 0;
            tiers.forEach(function (tier) {
                tier.classList.toggle('is-current', hasAmount && tier.dataset.mult === multiplier.textContent.trim());
            });
            quickBtns.forEach(function (btn) {
                btn.classList.toggle('is-active', btn.dataset.amount === input.value);
            });
            totalWrap.classList.remove('is-pulse');
            void totalWrap.offsetWidth;
            totalWrap.classList.add('is-pulse');
        }).observe(total, { childList: true, characterData: true, subtree: true });
    });
</script>

<script>
    // Play / pause for the section video, and hold still under reduced motion
    document.addEventListener('DOMContentLoaded', function () {
        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        document.querySelectorAll('[data-video-toggle]').forEach(function (btn) {
            var video = btn.parentElement.querySelector('video');
            if (!video) return;
            if (reduce) { video.removeAttribute('autoplay'); video.pause(); }

            var sync = function () {
                btn.querySelector('i').className = video.paused ? 'fas fa-play' : 'fas fa-pause';
                btn.setAttribute('aria-label', video.paused ? @json(__('frontend.home.video_play')) : @json(__('frontend.home.video_pause')));
            };
            btn.addEventListener('click', function () { video.paused ? video.play() : video.pause(); });
            video.addEventListener('play', sync);
            video.addEventListener('pause', sync);
            sync();
        });
    });
</script>
@endpush
