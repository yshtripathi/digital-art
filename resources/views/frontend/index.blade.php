@extends('frontend.layouts.main')
@section('description', __('frontend.home.meta'))

@section('main-content')
@php
    $hmCategories = isset($category_lists) ? $category_lists : collect();

    // Courses for the rail below the hero. Featured first, and a course with
    // no photo is skipped — its card would be an empty frame.
    $hmCourses = collect($product_lists ?? [])->filter(fn ($c) => !empty($c->photo))->values();
    $hmCourses = $hmCourses->where('is_featured', 1)
        ->concat($hmCourses->where('is_featured', '!=', 1))
        ->take(12)
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
        $rate = 160;
        $steps = [[240000, 2.5], [160000, 2], [80000, 1.5]];
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'HK$1 - HK$3,999',      'f'=>false],
            ['n'=>__('frontend.topup.tier2'), 'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'HK$4,000 - HK$7,999',  'f'=>false],
            ['n'=>__('frontend.topup.tier3'), 'i'=>'fa-gem',     'big'=>'x2',   'r'=>'HK$8,000 - HK$11,999', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'), 'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'HK$12,000+',           'f'=>true],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rate = 8;
        $steps = [[12000, 2.5], [8000, 2], [4000, 1.5]];
    } else {
        $tiers = [
            ['n'=>__('frontend.topup.tier1'), 'i'=>'fa-feather', 'big'=>'x1',   'r'=>'$1 - $499',       'f'=>false],
            ['n'=>__('frontend.topup.tier2'), 'i'=>'fa-star',    'big'=>'x1.5', 'r'=>'$500 - $999',     'f'=>false],
            ['n'=>__('frontend.topup.tier3'), 'i'=>'fa-gem',     'big'=>'x2',   'r'=>'$1,000 - $1,499', 'f'=>false],
            ['n'=>__('frontend.topup.tier4'), 'i'=>'fa-crown',   'big'=>'x2.5', 'r'=>'$1,500+',         'f'=>true],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rate = 1;
        $steps = [[1500, 2.5], [1000, 2], [500, 1.5]];
    }
@endphp

<div class="hm">

    {{-- ================= 1. HERO ================= --}}
    {{-- Full-bleed video band: one headline, one paragraph, two real actions.
         Styles: public/css/theme.css — section 28
         JS hooks kept: [data-video-toggle] (shared play/pause script) --}}
    <section class="hh">
        <div class="hh__media" aria-hidden="true">
            <video class="hh__video" autoplay muted loop playsinline preload="metadata"
                   poster="{{ asset('assets/images/hero-learning-poster.webp') }}">
                <source src="{{ asset('assets/videos/hero-learning.webm') }}" type="video/webm">
                <source src="{{ asset('assets/videos/hero-learning.mp4') }}" type="video/mp4">
            </video>
            <span class="hh__veil"></span>
            <span class="hh__grid"></span>
        </div>

        <div class="hh__inner">
            <p class="hh__eyebrow">{{ __('frontend.home.hero_eyebrow') }}</p>
            <h1 class="hh__title">{{ __('frontend.home.hero_title') }}</h1>
            <p class="hh__desc">{{ __('frontend.home.hero_desc') }}</p>

            <div class="hh__actions">
                <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--primary">
                    {{ __('frontend.home.hero_explore') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('points.topup') }}" class="hm-btn hm-btn--onDark">
                    {{ __('frontend.home.credits_btn') }}
                </a>
            </div>

            <ul class="hh__facts">
                <li><i class="fas fa-layer-group" aria-hidden="true"></i> {{ __('frontend.home.card_levels') }}</li>
                <li><i class="fas fa-clock" aria-hidden="true"></i> {{ __('frontend.home.card_pace') }}</li>
                <li><i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.home.card_credits') }}</li>
            </ul>
        </div>

        <button type="button" class="hh__toggle" data-video-toggle aria-label="{{ __('frontend.home.video_pause') }}">
            <i class="fas fa-pause" aria-hidden="true"></i>
        </button>
    </section>

    <div class="hm__wrap">

        {{-- ================= 2. COURSE RAIL ================= --}}
        @if($hmCourses->count())
            <section class="hp" aria-label="{{ __('frontend.home.featured_title') }}">
                <div class="hm-head">
                    <div>
                        <h2 class="hm-head__title">{{ __('frontend.home.featured_title') }}</h2>
                        <p class="hm-head__desc">{{ __('frontend.home.featured_desc') }}</p>
                    </div>

                    <div class="hp-tools">
                        @if($hmCourses->count() > 1)
                            <button type="button" class="hp-arrow" data-rail-prev aria-label="{{ __('frontend.home.prev') }}">
                                <i class="fas fa-chevron-left" aria-hidden="true"></i>
                            </button>
                            <button type="button" class="hp-arrow" data-rail-next aria-label="{{ __('frontend.home.next') }}">
                                <i class="fas fa-chevron-right" aria-hidden="true"></i>
                            </button>
                        @endif
                        <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--secondary">
                            {{ __('frontend.home.cats_all') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>

                <ul class="hp-track" data-rail>
                    @foreach($hmCourses as $course)
                        @php
                            $hpImg = explode(',', $course->photo)[0];
                            $hpLevels = $course->levels ? $course->levels->count() : 0;
                            $hpMin = $hpLevels ? $course->levels->min('price_in_points') : null;
                            $hpCat = optional($course->cat_info)->title;
                        @endphp
                        <li class="hp-card">
                            <a href="{{ route('product-detail', $course->slug) }}" class="hp-card__link">
                                <span class="hp-card__media">
                                    <img src="{{ asset(ltrim($hpImg, '/')) }}" alt="" loading="lazy" decoding="async">
                                </span>

                                <span class="hp-card__tags">
                                    @if($hpCat)
                                        <span class="badge">{{ $hpCat }}</span>
                                    @endif
                                    @if($hpLevels)
                                        <span class="badge badge--brand">
                                            <i class="fas fa-signal" aria-hidden="true"></i>
                                            {{ trans_choice('frontend.catalog.levels', $hpLevels, ['count' => $hpLevels]) }}
                                        </span>
                                    @endif
                                </span>

                                <span class="hp-card__title">{{ $course->title }}</span>

                                @if($course->summary)
                                    <span class="hp-card__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 96) }}</span>
                                @endif

                                <span class="hp-card__foot">
                                    @if($hpLevels)
                                        <span class="hp-card__price">
                                            <i class="fas fa-bolt" aria-hidden="true"></i>
                                            <span class="hp-card__from">{{ __('frontend.home.from') }}</span>
                                            <strong>{{ number_format($hpMin) }}</strong>
                                            {{ __('frontend.home.credits') }}
                                        </span>
                                    @else
                                        <span class="hp-card__price">{{ __('frontend.catalog.no_levels') }}</span>
                                    @endif
                                    <span class="hp-card__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

        {{-- ================= 3. HOW IT WORKS ================= --}}
        <section class="hs">
            <div class="hs__grid">

                {{-- Two-photo collage --}}
                <div class="hs-collage">
                    <figure class="hs-collage__item hs-collage__item--tall">
                        <img src="{{ asset('assets/images/home-planning-session.webp') }}" width="900" height="1350"
                             alt="{{ __('frontend.home.steps_alt1') }}" loading="lazy" decoding="async">
                    </figure>
                    <figure class="hs-collage__item hs-collage__item--square">
                        <img src="{{ asset('assets/images/home-online-class.webp') }}" width="800" height="800"
                             alt="{{ __('frontend.home.steps_alt2') }}" loading="lazy" decoding="async">
                    </figure>
                </div>

                {{-- Six steps --}}
                <div class="hs__text">
                    <p class="hs__label">{{ __('frontend.home.steps_label') }}</p>
                    <h2 class="hm-head__title">{{ __('frontend.home.steps_title') }}</h2>
                    <p class="hm-head__desc">{{ __('frontend.home.steps_desc') }}</p>

                    <ol class="hs-steps">
                        @for($n = 1; $n <= 6; $n++)
                            <li class="hs-step">
                                <span class="hs-step__no">{{ sprintf('%02d', $n) }}</span>
                                <span class="hs-step__body">
                                    <span class="hs-step__title">{{ __('frontend.home.step' . $n . '_title') }}</span>
                                    <span class="hs-step__desc">{{ __('frontend.home.step' . $n . '_desc') }}</span>
                                </span>
                            </li>
                        @endfor
                    </ol>
                </div>
            </div>
        </section>

        {{-- ================= 4. CREDITS ================= --}}
        <section class="hm-credits">
            <div class="hm-head">
                <div>
                    <h2 class="hm-head__title">{{ __('frontend.topup.tiers_title') }}</h2>
                    <p class="hm-head__desc">{{ __('frontend.topup.intro') }}</p>
                </div>
                <a href="{{ route('points.topup') }}" class="hm-btn hm-btn--secondary">
                    {{ __('frontend.home.credits_btn') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>

            {{-- Tier cards --}}
            <ul class="tu-tiers__grid">
                @foreach($tiers as $t)
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

            {{-- Calculator --}}
            <form action="{{ route('points.add-to-cart') }}" method="POST" class="topup-form tu-calc" novalidate>
                @csrf

                <div class="tu-calc__main">
                    <div class="tu-calc__head">
                        <span class="tu-calc__icon"><i class="fas fa-calculator" aria-hidden="true"></i></span>
                        <div>
                            <h3 class="tu-calc__title">{{ __('frontend.topup.calc_title') }}</h3>
                            <p class="tu-calc__desc">{{ __('frontend.topup.calc_desc') }}</p>
                        </div>
                    </div>

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
                </div>

                <div class="tu-calc__side">
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
                            <span class="tu-stats__total-value"><i class="fas fa-bolt" aria-hidden="true"></i> <span id="total_points">0</span></span>
                        </div>
                    </div>

                    <button type="submit" class="topup-btn tu-submit">
                        <span>{{ __('frontend.topup.submit') }}</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>

                    <p class="tu-trust">
                        <i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.topup.secure') }}
                    </p>
                </div>
            </form>
        </section>

        {{-- ================= 5. CATEGORIES ================= --}}
        @if($hmCategories->count())
            <section class="hcat">
                <div class="hm-head">
                    <div>
                        <h2 class="hm-head__title">{{ __('frontend.home.cats_title') }}</h2>
                        <p class="hm-head__desc">{{ __('frontend.home.cats_desc') }}</p>
                    </div>
                    <a href="{{ route('product-lists') }}" class="hm-btn hm-btn--secondary">
                        {{ __('frontend.home.cats_all') }} <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>

                <ul class="hcat__row">
                    @foreach($hmCategories as $cat)
                        <li>
                            <a href="{{ route('product-lists', $cat->slug) }}" class="hcat-card">
                                <span class="hcat-card__media">
                                    @if($cat->photo)
                                        <img src="{{ asset(ltrim($cat->photo, '/')) }}" alt="" loading="lazy" decoding="async">
                                    @else
                                        <span class="hcat-card__ph" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                                    @endif
                                </span>
                                <span class="hcat-card__name">{{ $cat->title }}</span>
                                <span class="hcat-card__count">
                                    {{ trans_choice('frontend.home.cats_count', $cat->products_count ?? 0, ['count' => $cat->products_count ?? 0]) }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Course rail: the arrows page the track by one view and switch off at
    // each end. The track itself scrolls and snaps without any of this.
    document.addEventListener('DOMContentLoaded', function () {
        var track = document.querySelector('[data-rail]');
        if (!track) return;

        var root = track.closest('section');
        var prev = root.querySelector('[data-rail-prev]');
        var next = root.querySelector('[data-rail-next]');
        if (!prev || !next) return;

        function step() {
            var card = track.querySelector('li');
            if (!card) return track.clientWidth;
            var gap = parseFloat(getComputedStyle(track).columnGap) || 0;
            var unit = card.offsetWidth + gap;
            return unit * Math.max(1, Math.round(track.clientWidth / unit));
        }

        function sync() {
            prev.disabled = track.scrollLeft <= 2;
            next.disabled = track.scrollLeft >= track.scrollWidth - track.clientWidth - 2;
        }

        prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
        next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: 'smooth' }); });
        track.addEventListener('scroll', sync, { passive: true });
        window.addEventListener('resize', sync);
        sync();
    });
</script>

<script>
    // Credits: the amount drives the figures, the tier highlight and the
    // quick-amount state in one pass, and the form adds the pack to the cart.
    document.addEventListener('DOMContentLoaded', function () {
        var amount = document.getElementById('topup_amount');
        if (!amount) return;

        var form  = amount.closest('.topup-form');
        var base  = document.getElementById('base_points');
        var mult  = document.getElementById('multiplier_display');
        var total = document.getElementById('total_points');
        var totalWrap = total.closest('.tu-stats__total');
        var tiers = document.querySelectorAll('.tu-tier');
        var quick = document.querySelectorAll('.tu-quick__btn');

        var RATE = {{ $rate }};
        var STEPS = @json($steps);

        function update() {
            var value = parseFloat(amount.value) || 0;
            var points = Math.floor(value / RATE);
            var factor = 1;

            for (var i = 0; i < STEPS.length; i++) {
                if (value >= STEPS[i][0]) { factor = STEPS[i][1]; break; }
            }

            base.textContent = points.toLocaleString();
            mult.textContent = 'x' + factor;
            total.textContent = Math.round(points * factor).toLocaleString();

            tiers.forEach(function (tier) {
                tier.classList.toggle('is-current', value > 0 && tier.dataset.mult === 'x' + factor);
            });
            quick.forEach(function (btn) {
                btn.classList.toggle('is-active', btn.dataset.amount === amount.value);
            });

            totalWrap.classList.remove('is-pulse');
            void totalWrap.offsetWidth;
            totalWrap.classList.add('is-pulse');
        }

        amount.addEventListener('input', function () { this.setCustomValidity(''); update(); });

        quick.forEach(function (btn) {
            btn.addEventListener('click', function () {
                amount.value = btn.dataset.amount;
                amount.focus();
                update();
            });
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!((parseFloat(amount.value) || 0) >= 1)) {
                amount.setCustomValidity(@json(__('frontend.topup.amount_req')));
                amount.reportValidity();
                return;
            }

            var btn = form.querySelector('.topup-btn');
            var label = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + @json(__('frontend.topup.loading'));

            fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                .then(function () { window.location.reload(); })
                .catch(function () { btn.disabled = false; btn.innerHTML = label; });
        });
    });
</script>

<script>
    // Hero video: play / pause, and hold on the poster under reduced motion.
    document.addEventListener('DOMContentLoaded', function () {
        var btn = document.querySelector('[data-video-toggle]');
        var video = btn && btn.closest('section').querySelector('video');
        if (!video) return;

        if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            video.removeAttribute('autoplay');
            video.pause();
        }

        function sync() {
            btn.querySelector('i').className = video.paused ? 'fas fa-play' : 'fas fa-pause';
            btn.setAttribute('aria-label', video.paused ? @json(__('frontend.home.video_play')) : @json(__('frontend.home.video_pause')));
        }

        btn.addEventListener('click', function () { video.paused ? video.play() : video.pause(); });
        video.addEventListener('play', sync);
        video.addEventListener('pause', sync);
        sync();
    });
</script>
@endpush
