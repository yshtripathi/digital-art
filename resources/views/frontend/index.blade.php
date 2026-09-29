@extends('frontend.layouts.main')
@section('description', __('frontend.home.description'))

@section('main-content')
@php
    $hmIsJa = app()->getLocale() == 'ja';
    $hmImg = function ($file) {
        return file_exists(public_path('assets/images/' . $file)) ? asset('assets/images/' . $file) : null;
    };
    $hmVideo = file_exists(public_path('assets/videos/home-hero.mp4')) ? asset('assets/videos/home-hero.mp4') : null;
    $hmPoster = $hmImg('home-hero-poster.webp');
    $hmCollage = collect(range(1, 5))->map(fn ($n) => $hmImg('home-collage-' . $n . '.webp'));

    $hmGuides = collect($product_lists ?? [])->values();
    $hmCats = collect($category_lists ?? [])->values();
    $hmLatest = $hmGuides->take(20)->map(function ($guide) {
        $raw = trim(explode(',', (string) $guide->photo)[0] ?? '');
        $guide->hm_cover = $raw !== '' && file_exists(public_path(ltrim($raw, '/'))) ? asset(ltrim($raw, '/')) : null;
        return $guide;
    });

    $hmIcons = [
        'software-development-engineering'     => 'fa-code',
        'data-automation-ai'                   => 'fa-brain',
        'it-infrastructure-cloud-security'     => 'fa-server',
        'product-design-ux-digital-experience' => 'fa-pencil-ruler',
        'devops-agile-technology-leadership'   => 'fa-infinity',
    ];

    $hmLevels = [
        ['name' => __('frontend.course.level_beginner'),     'w' => 28],
        ['name' => __('frontend.course.level_intermediate'), 'w' => 52],
        ['name' => __('frontend.course.level_advanced'),     'w' => 76],
        ['name' => __('frontend.course.level_expert'),       'w' => 100],
    ];

    $cur = session('currency');
    if ($cur == 'JPY') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-seedling', 'big' => 'x1',   'min' => 1,      'r' => '&yen;1 - &yen;79,999'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 80000,  'r' => '&yen;80,000 - &yen;159,999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 160000, 'r' => '&yen;160,000 - &yen;239,999'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 240000, 'r' => '&yen;240,000+'],
        ];
        $quick = [16000, 80000, 160000, 240000];
        $symbol = '&yen;';
        $rateNote = __('frontend.topup.rate_jpy');
    } elseif ($cur == 'HKD') {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-seedling', 'big' => 'x1',   'min' => 1,     'r' => 'HK$1 - HK$3,999'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 4000,  'r' => 'HK$4,000 - HK$7,999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 8000,  'r' => 'HK$8,000 - HK$11,999'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 12000, 'r' => 'HK$12,000+'],
        ];
        $quick = [800, 4000, 8000, 12000];
        $symbol = 'HK$';
        $rateNote = __('frontend.topup.rate_hkd');
    } else {
        $tiers = [
            ['n' => __('frontend.topup.tier_standard'), 'i' => 'fa-seedling', 'big' => 'x1',   'min' => 1,    'r' => '$1 - $499'],
            ['n' => __('frontend.topup.tier_premium'),  'i' => 'fa-star',    'big' => 'x2',   'min' => 500,  'r' => '$500 - $999'],
            ['n' => __('frontend.topup.tier_elite'),    'i' => 'fa-gem',     'big' => 'x2.5', 'min' => 1000, 'r' => '$1,000 - $1,499'],
            ['n' => __('frontend.topup.tier_vip'),      'i' => 'fa-crown',   'big' => 'x3',   'min' => 1500, 'r' => '$1,500+'],
        ];
        $quick = [100, 500, 1000, 1500];
        $symbol = '$';
        $rateNote = __('frontend.topup.rate_usd');
    }
@endphp

<section class="hm-hero">
    <div class="container hm-hero__grid">
        <div class="hm-hero__copy">
            <p class="eyebrow">{{ __('frontend.home.hero_label') }}</p>
            <h1 class="hm-hero__title">{{ __('frontend.home.hero_title') }} <span>{{ __('frontend.home.hero_accent') }}</span></h1>
            <p class="hm-hero__lead">{{ __('frontend.home.hero_lead') }}</p>
            <div class="hm-hero__acts">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.home.explore') }}</a>
                <a href="#hm-calc" class="btn btn--ghost">{{ __('frontend.home.credits_btn') }}</a>
            </div>
        </div>

        <div class="hm-hero__stage">
            <div class="hm-video {{ $hmVideo ? '' : 'is-empty' }}">
                @if($hmVideo)
                    <video src="{{ $hmVideo }}" @if($hmPoster) poster="{{ $hmPoster }}" @endif autoplay muted loop playsinline preload="metadata" aria-hidden="true"></video>
                @else
                    <span class="hm-video__slot" aria-hidden="true"><i class="fas fa-play"></i></span>
                @endif
            </div>

            <div class="hm-ladder" aria-hidden="true">
                <p class="hm-ladder__head"><i class="fas fa-layer-group"></i>{{ __('frontend.home.stat_levels') }}</p>
                <ol class="hm-ladder__list">
                    @foreach($hmLevels as $lvl)
                        <li style="--w: {{ $lvl['w'] }}%; --i: {{ $loop->index }}">
                            <span class="hm-ladder__name">{{ $lvl['name'] }}</span>
                            <span class="hm-ladder__bar"><span></span></span>
                        </li>
                    @endforeach
                </ol>
            </div>

            <span class="hm-float" aria-hidden="true"><i class="fas fa-coins"></i>{{ $rateNote }}</span>
        </div>
    </div>
</section>

@if($hmCats->isNotEmpty())
    <section class="hm-subjects" data-reveal>
        <div class="container">
            <div class="hm-head">
                <div>
                    <p class="eyebrow">{{ __('frontend.home.cats_label') }}</p>
                    <h2 class="hm-head__title">{{ __('frontend.home.cats_title') }}</h2>
                </div>
                <p class="hm-head__text">{{ __('frontend.home.cats_text') }}</p>
            </div>

            <ul class="hm-subjects__grid">
                @foreach($hmCats as $cat)
                    @php
                        $catTitle = $hmIsJa && filled($cat->title_jp ?? null) ? $cat->title_jp : $cat->title;
                        $catCount = $cat->products_count ?? 0;
                        $catRaw = trim((string) ($cat->photo ?? ''));
                        $catImg = $catRaw !== '' && file_exists(public_path(ltrim($catRaw, '/'))) ? asset(ltrim($catRaw, '/')) : null;
                    @endphp
                    <li style="--i: {{ $loop->index }}">
                        <a href="{{ route('product-lists', $cat->slug) }}" class="hm-subject">
                            <span class="hm-subject__top">
                                <span class="hm-subject__icon" aria-hidden="true"><i class="fas {{ $hmIcons[$cat->slug] ?? 'fa-layer-group' }}"></i></span>
                                <span class="hm-subject__no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </span>
                            <span class="hm-subject__name">{{ $catTitle }}</span>
                            <span class="hm-subject__foot">
                                <span>{{ trans_choice('frontend.home.cats_count', $catCount, ['count' => $catCount]) }}</span>
                                <span class="hm-subject__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                            </span>
                            <span class="hm-subject__media {{ $catImg ? '' : 'is-empty' }}" aria-hidden="true">
                                @if($catImg)
                                    <img src="{{ $catImg }}" alt="" width="400" height="400" loading="lazy" decoding="async">
                                @else
                                    <i class="far fa-image"></i>
                                @endif
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

@if($hmLatest->isNotEmpty())
    <section class="hm-latest" data-reveal>
        <div class="container">
            <div class="hm-head">
                <div>
                    <p class="eyebrow">{{ __('frontend.home.new_label') }}</p>
                    <h2 class="hm-head__title">{{ __('frontend.home.new_title') }}</h2>
                </div>
                <div class="hm-rail__nav">
                    <a href="{{ route('product-lists') }}" class="hm-head__link">{{ __('frontend.home.new_all') }} <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    <button type="button" class="hm-rail__btn" data-rail-prev aria-label="{{ __('frontend.catalog.prev') }}"><i class="fas fa-arrow-left" aria-hidden="true"></i></button>
                    <button type="button" class="hm-rail__btn" data-rail-next aria-label="{{ __('frontend.catalog.next') }}"><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>

            <ul class="hm-rail" data-rail>
                @foreach($hmLatest as $guide)
                    @php
                        $gLevels = collect($guide->levels ?? []);
                        $gFrom = $gLevels->count() ? $gLevels->min('price_in_points') : 0;
                        $gTitle = $hmIsJa && filled($guide->title_jp ?? null) ? $guide->title_jp : $guide->title;
                    @endphp
                    <li class="shop-item" style="--i: {{ $loop->index }}">
                        <a href="{{ route('product-detail', $guide->slug) }}" class="shop-item__link">
                            <span class="shop-item__media media-frame {{ $guide->hm_cover ? '' : 'is-empty' }}">
                                @if($guide->hm_cover)
                                    <img src="{{ $guide->hm_cover }}" alt="" width="800" height="800" loading="lazy" decoding="async">
                                @else
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @endif
                                @if($gLevels->count())
                                    <span class="shop-item__levels"><i class="fas fa-layer-group" aria-hidden="true"></i>{{ trans_choice('frontend.catalog.levels', $gLevels->count(), ['count' => $gLevels->count()]) }}</span>
                                @endif
                            </span>
                            <span class="shop-item__body">
                                <span class="shop-item__name">{{ $gTitle }}</span>
                                <span class="shop-item__foot">
                                    <span class="shop-item__price">
                                        @if($gFrom)
                                            {{ __('frontend.home.from') }} <strong>{{ number_format($gFrom) }}</strong> {{ __('frontend.home.credits') }}
                                        @else
                                            {{ __('frontend.catalog.no_levels') }}
                                        @endif
                                    </span>
                                    <span class="shop-item__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="hm-rail__bar" aria-hidden="true"><span data-rail-bar></span></div>
        </div>
    </section>
@endif

<section class="hm-calc" id="hm-calc" data-reveal>
    <div class="container tu">
        <div class="hm-head">
            <div>
                <p class="eyebrow">{{ __('frontend.home.calc_label') }}</p>
                <h2 class="hm-head__title">{{ __('frontend.home.calc_title') }}</h2>
            </div>
            <p class="hm-head__text">{{ __('frontend.home.calc_text') }}</p>
        </div>

        <div class="tu-tiers">
            <div class="tu-grid">
                @foreach($tiers as $t)
                    <article class="tu-row" data-mult="{{ $t['big'] }}" data-min="{{ $t['min'] }}" data-name="{{ $t['n'] }}">
                        <div class="tu-row__top">
                            <span class="tu-row__icon" aria-hidden="true"><i class="fas {{ $t['i'] }}"></i></span>
                            <span class="tu-row__match">{{ __('frontend.topup.your_tier') }}</span>
                            @if($loop->last)
                                <span class="tu-row__best">{{ __('frontend.topup.top_tier') }}</span>
                            @endif
                        </div>
                        <h3 class="tu-row__name">{{ $t['n'] }}</h3>
                        <p class="tu-row__range">{!! $t['r'] !!}</p>
                        <p class="tu-row__mult"><strong>{{ $t['big'] }}</strong> <span>{{ __('frontend.topup.multiplier') }}</span></p>
                    </article>
                @endforeach
            </div>

            <ul class="tu-notes">
                <li class="tu-notes__item">
                    <span class="tu-notes__icon" aria-hidden="true"><i class="fas fa-exchange-alt"></i></span>
                    <span class="tu-notes__text">
                        <small>{{ __('frontend.topup.rate_label') }}</small>
                        <strong>{{ $rateNote }}</strong>
                    </span>
                </li>
                <li class="tu-notes__item">
                    <span class="tu-notes__icon" aria-hidden="true"><i class="far fa-calendar-check"></i></span>
                    <span class="tu-notes__text">
                        <small>{{ __('frontend.topup.validity_label') }}</small>
                        <strong>{{ rtrim(__('frontend.topup.validity'), '.。') }}</strong>
                    </span>
                </li>
                <li class="tu-notes__item">
                    <span class="tu-notes__icon" aria-hidden="true"><i class="fas fa-unlock-alt"></i></span>
                    <span class="tu-notes__text">
                        <small>{{ __('frontend.topup.use_label') }}</small>
                        <strong>{{ rtrim(__('frontend.topup.use'), '.。') }}</strong>
                    </span>
                </li>
            </ul>
        </div>

        <form action="{{ route('points.add-to-cart') }}" method="POST" class="tu-calc" data-credit-form novalidate>
            @csrf

            <div class="tu-calc__main">
                <h3 class="tu__title">{{ __('frontend.topup.calc_title') }}</h3>

                <label class="tu-calc__label" for="topup_amount">{{ __('frontend.topup.amount') }}</label>
                <div class="tu-input">
                    <span class="tu-input__sym" aria-hidden="true">{!! $symbol !!}</span>
                    <input type="number" name="amount" id="topup_amount" placeholder="{{ __('frontend.topup.amount_placeholder') }}" min="1" required inputmode="decimal">
                    <span class="tu-input__mult" data-live-mult aria-hidden="true">x1</span>
                </div>

                <span class="tu-calc__label" id="keysLabel">{{ __('frontend.topup.presets') }}</span>
                <div class="tu-keys" role="group" aria-labelledby="keysLabel">
                    @foreach($quick as $q)
                        <button type="button" class="tu-key" data-amount="{{ $q }}">
                            <span>{!! $symbol !!}{{ number_format($q) }}</span>
                            <small>{{ $tiers[$loop->index]['big'] }}</small>
                        </button>
                    @endforeach
                </div>

                <p class="tu-hint" aria-live="polite" data-hint>
                    <i class="far fa-lightbulb" aria-hidden="true"></i>
                    <span data-hint-text>{{ __('frontend.topup.tip_start') }}</span>
                </p>
            </div>

            <div class="tu-calc__out">
                <p class="tu-result__label">{{ __('frontend.topup.you_get') }}</p>
                <p class="tu-result__total" id="tpTotalWrap" aria-live="polite">
                    <strong id="total_points">0</strong>
                    <span>{{ __('frontend.topup.credits') }}</span>
                </p>
                <dl class="tu-result__lines" aria-label="{{ __('frontend.topup.breakdown') }}">
                    <div><dt>{{ __('frontend.topup.row_amount') }}</dt><dd id="amount_display">{!! $symbol !!}0</dd></div>
                    <div><dt>{{ __('frontend.topup.row_base') }}</dt><dd id="base_points">0</dd></div>
                    <div><dt>{{ __('frontend.topup.row_multiplier') }}</dt><dd id="multiplier_display">x1</dd></div>
                </dl>

                @auth
                    <button type="submit" class="btn btn--primary btn--block tu-calc__submit">
                        <i class="fas fa-cart-plus" aria-hidden="true"></i>
                        <span>{{ __('frontend.topup.add') }}</span>
                    </button>
                @else
                    <a href="{{ route('login.form') }}" class="btn btn--primary btn--block tu-calc__submit">
                        <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.home.calc_login') }}</span>
                    </a>
                @endauth

                <p class="tu-calc__secure">
                    <i class="fas fa-lock" aria-hidden="true"></i>
                    <span>{{ __('frontend.topup.secure') }}</span>
                </p>
            </div>
        </form>
    </div>
</section>

<section class="hm-collage" data-reveal>
    <div class="container hm-collage__grid">
        <div class="hm-collage__frames" aria-hidden="true">
            @foreach($hmCollage as $shot)
                <figure class="hm-shot hm-shot--{{ $loop->iteration }} {{ $shot ? '' : 'is-empty' }}" style="--i: {{ $loop->index }}">
                    @if($shot)
                        <img src="{{ $shot }}" alt="" loading="lazy" decoding="async">
                    @else
                        <i class="far fa-image"></i>
                    @endif
                </figure>
            @endforeach
        </div>

        <div class="hm-collage__copy">
            <p class="eyebrow">{{ __('frontend.home.collage_label') }}</p>
            <h2 class="hm-head__title">{{ __('frontend.home.collage_title') }}</h2>
            <p class="hm-collage__text">{{ __('frontend.home.collage_text') }}</p>
            <ul class="hm-collage__points">
                <li><span aria-hidden="true"><i class="fas fa-user-lock"></i></span>{{ __('frontend.home.collage_one') }}</li>
                <li><span aria-hidden="true"><i class="far fa-clock"></i></span>{{ __('frontend.home.collage_two') }}</li>
                <li><span aria-hidden="true"><i class="fas fa-layer-group"></i></span>{{ __('frontend.home.collage_three') }}</li>
            </ul>
            <div class="hm-collage__acts">
                @guest
                    <a href="{{ route('register.form') }}" class="btn btn--primary">{{ __('frontend.home.register') }}</a>
                @else
                    <a href="{{ route('user') }}" class="btn btn--primary">{{ __('frontend.header.account') }}</a>
                @endguest
                <a href="{{ route('product-lists') }}" class="btn btn--ghost">{{ __('frontend.home.explore') }}</a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var blocks = document.querySelectorAll('[data-reveal]');
    if (blocks.length) {
        if (!('IntersectionObserver' in window)) {
            blocks.forEach(function (block) { block.classList.add('is-in'); });
        } else {
            var watch = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-in');
                        watch.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            blocks.forEach(function (block) { watch.observe(block); });
        }
    }

    var rail = document.querySelector('[data-rail]');
    if (rail) {
        var prev = document.querySelector('[data-rail-prev]');
        var next = document.querySelector('[data-rail-next]');
        var bar = document.querySelector('[data-rail-bar]');
        var step = function () {
            var card = rail.querySelector('li');
            return card ? card.getBoundingClientRect().width + 24 : 300;
        };
        var sync = function () {
            var max = rail.scrollWidth - rail.clientWidth;
            var ratio = max > 0 ? rail.scrollLeft / max : 1;
            if (bar) {
                bar.style.width = (rail.clientWidth / rail.scrollWidth * 100) + '%';
                bar.style.transform = 'translateX(' + (ratio * (rail.scrollWidth / rail.clientWidth - 1) * 100) + '%)';
            }
            if (prev) { prev.disabled = rail.scrollLeft <= 2; }
            if (next) { next.disabled = rail.scrollLeft >= max - 2; }
        };
        if (prev) { prev.addEventListener('click', function () { rail.scrollBy({ left: -step(), behavior: 'smooth' }); }); }
        if (next) { next.addEventListener('click', function () { rail.scrollBy({ left: step(), behavior: 'smooth' }); }); }
        rail.addEventListener('scroll', function () { requestAnimationFrame(sync); }, { passive: true });
        window.addEventListener('resize', sync);
        sync();
    }

    var input = document.getElementById('topup_amount');
    if (!input) { return; }

    var totalOut = document.getElementById('total_points');
    var baseOut = document.getElementById('base_points');
    var multOut = document.getElementById('multiplier_display');
    var amountOut = document.getElementById('amount_display');
    var totalWrap = document.getElementById('tpTotalWrap');
    var liveMult = document.querySelector('[data-live-mult]');
    var tiers = Array.prototype.slice.call(document.querySelectorAll('.tu-row'));
    var keys = document.querySelectorAll('.tu-key');
    var hint = document.querySelector('[data-hint]');
    var hintText = document.querySelector('[data-hint-text]');
    var symbol = @json(html_entity_decode($symbol));
    var words = {
        start: @json(__('frontend.topup.tip_start')),
        next: @json(__('frontend.topup.tip_next')),
        top: @json(__('frontend.topup.tip_top'))
    };
    var isJPY = {{ session('currency') == 'JPY' ? 'true' : 'false' }};
    var isHKD = {{ session('currency') == 'HKD' ? 'true' : 'false' }};
    var mins = tiers.map(function (tier) { return parseFloat(tier.dataset.min); });

    function calculate() {
        var amount = parseFloat(input.value) || 0;
        var usd = isJPY ? amount / 160 : (isHKD ? amount / 8 : amount);
        var multiplier = 1;
        if (usd >= 1500) { multiplier = 3; }
        else if (usd >= 1000) { multiplier = 2.5; }
        else if (usd >= 500) { multiplier = 2; }

        var mult = 'x' + multiplier;
        baseOut.textContent = Math.round(usd).toLocaleString();
        multOut.textContent = mult;
        if (liveMult) { liveMult.textContent = mult; liveMult.classList.toggle('is-up', multiplier > 1); }
        totalOut.textContent = Math.round(usd * multiplier).toLocaleString();
        amountOut.textContent = symbol + amount.toLocaleString();

        var current = -1;
        tiers.forEach(function (tier, i) {
            var reached = amount > 0 && amount >= mins[i];
            tier.classList.toggle('is-reached', reached);
            if (reached) { current = i; }
        });
        tiers.forEach(function (tier, i) { tier.classList.toggle('is-match', i === current); });

        if (amount <= 0) {
            hintText.textContent = words.start;
            hint.classList.remove('is-top');
        } else if (current >= tiers.length - 1) {
            hintText.textContent = words.top;
            hint.classList.add('is-top');
        } else {
            var next = tiers[current + 1];
            var gap = Math.max(mins[current + 1] - amount, 0);
            hintText.textContent = words.next
                .replace(':amount', symbol + gap.toLocaleString())
                .replace(':tier', next.dataset.name)
                .replace(':mult', next.dataset.mult);
            hint.classList.remove('is-top');
        }

        keys.forEach(function (key) { key.classList.toggle('is-active', key.dataset.amount === input.value); });
        totalWrap.classList.remove('is-tick');
        void totalWrap.offsetWidth;
        totalWrap.classList.add('is-tick');
    }

    input.addEventListener('input', function () { this.setCustomValidity(''); calculate(); });
    input.addEventListener('change', calculate);

    keys.forEach(function (key) {
        key.addEventListener('click', function () {
            input.value = key.dataset.amount;
            input.dispatchEvent(new Event('input', { bubbles: true }));
            input.focus();
        });
    });

    var form = document.querySelector('[data-credit-form]');
    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            if (!((parseFloat(input.value) || 0) >= 1)) {
                input.setCustomValidity(@json(__('frontend.topup.amount_required')));
                input.reportValidity();
                return;
            }
            var btn = form.querySelector('button.tu-calc__submit');
            if (!btn) { return; }
            var original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> <span>' + @json(__('frontend.topup.adding')) + '</span>';

            fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                .then(function (response) { return new Promise(function (resolve) { setTimeout(function () { resolve(response); }, 500); }); })
                .then(function () { window.location.href = @json(route('cart')); })
                .catch(function () {
                    btn.disabled = false;
                    btn.innerHTML = original;
                });
        });
    }
}());
</script>
@endpush
