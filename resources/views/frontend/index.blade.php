@extends('frontend.layouts.main')
@section('description', __('frontend.home.summary'))

@section('main-content')
@php
    $hoCategories = isset($category_lists) ? $category_lists : collect();

    $hoCourses = collect($product_lists ?? [])->filter(fn ($c) => !empty($c->photo))->values();
    $hoCourses = $hoCourses->where('is_featured', 1)
        ->concat($hoCourses->where('is_featured', '!=', 1))
        ->take(20)
        ->values();

    $hoMaterials = \App\Models\Product::where('status', 'active')->count();
    $hoLevels = \App\Models\ProductLevel::whereIn('course_id', \App\Models\Product::where('status', 'active')->pluck('id'))->count();

    $hoCur = session('currency');
    if ($hoCur == 'JPY') {
        $hoTiers = [['tier_standard', '&yen;1 – &yen;79,999', 'x1'], ['tier_premium', '&yen;80,000 – &yen;159,999', 'x2'], ['tier_elite', '&yen;160,000 – &yen;239,999', 'x2.5'], ['tier_vip', '&yen;240,000+', 'x3']];
    } elseif ($hoCur == 'HKD') {
        $hoTiers = [['tier_standard', 'HK$1 – HK$3,999', 'x1'], ['tier_premium', 'HK$4,000 – HK$7,999', 'x2'], ['tier_elite', 'HK$8,000 – HK$11,999', 'x2.5'], ['tier_vip', 'HK$12,000+', 'x3']];
    } else {
        $hoTiers = [['tier_standard', '$1 – $499', 'x1'], ['tier_premium', '$500 – $999', 'x2'], ['tier_elite', '$1,000 – $1,499', 'x2.5'], ['tier_vip', '$1,500+', 'x3']];
    }

    $hoSteps = [
        ['t' => 's1', 'd' => 's1_text', 'i' => 'fa-compass'],
        ['t' => 's2', 'd' => 's2_text', 'i' => 'fa-signal'],
        ['t' => 's3', 'd' => 's3_text', 'i' => 'fa-lock-open'],
        ['t' => 's4', 'd' => 's4_text', 'i' => 'fa-graduation-cap'],
    ];
    $hoWhy = [
        ['t' => 'p1', 'd' => 'p1_text', 'i' => 'fa-eye'],
        ['t' => 'p2', 'd' => 'p2_text', 'i' => 'fa-coins'],
        ['t' => 'p3', 'd' => 'p3_text', 'i' => 'fa-clock'],
        ['t' => 'p4', 'd' => 'p4_text', 'i' => 'fa-comment-dots'],
    ];
@endphp

<section class="hx" aria-labelledby="hxTitle">
    <div class="hx__media" aria-hidden="true">
        <video class="hx__video" autoplay muted loop playsinline preload="metadata" poster="{{ asset('assets/images/home-hero.webp') }}" data-hp-video>
            <source src="{{ asset('assets/videos/home-hero.mp4') }}" type="video/mp4">
        </video>
    </div>
    <span class="hx__shade" aria-hidden="true"></span>

    <div class="hx__wrap">
        <div class="hx__text">
            <span class="hx__tag">
                <span class="hx__dot" aria-hidden="true"></span>
                {{ __('frontend.home.tag') }}
            </span>
            <h1 id="hxTitle" class="hx__title">{{ __('frontend.home.title') }}</h1>
            <p class="hx__lead">{{ __('frontend.home.lead') }}</p>
            <div class="hx__cta">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <span>{{ __('frontend.home.go_browse') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('points.topup') }}" class="btn btn--ghost hx__ghost">{{ __('frontend.home.go_credits') }}</a>
            </div>
            <p class="hx__safe">
                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                {{ __('frontend.home.safe') }}
            </p>
        </div>

        <ul class="hx__stats">
            <li class="hx-stat">
                <strong class="num">{{ number_format($hoMaterials) }}</strong>
                <span>{{ __('frontend.home.n_materials') }}</span>
            </li>
            <li class="hx-stat">
                <strong class="num">{{ number_format($hoCategories->count()) }}</strong>
                <span>{{ __('frontend.home.n_areas') }}</span>
            </li>
            <li class="hx-stat">
                <strong class="num">{{ number_format($hoLevels) }}</strong>
                <span>{{ __('frontend.home.n_levels') }}</span>
            </li>
        </ul>
    </div>

    <button type="button" class="hx__toggle" aria-label="{{ __('frontend.home.pause') }}" data-pause="{{ __('frontend.home.pause') }}" data-play="{{ __('frontend.home.play') }}" data-hp-toggle>
        <i class="fas fa-pause" aria-hidden="true"></i>
    </button>
</section>

<div class="hx-tape" aria-hidden="true">
    <div class="hx-tape__track">
        @foreach([1, 2] as $copy)
            @foreach(__('frontend.head.terms') as $term)
                <span class="pre__term {{ $loop->odd ? 'is-up' : 'is-down' }}">{{ $term }}</span>
            @endforeach
        @endforeach
    </div>
</div>

@if($hoCourses->count())
    <section class="hb" aria-labelledby="hbTitle">
        <div class="hb__wrap">
            <header class="hb__head">
                <div>
                    <span class="eyebrow">{{ __('frontend.home.feat_tag') }}</span>
                    <h2 id="hbTitle" class="hb__title">{{ __('frontend.home.feat_title') }}</h2>
                </div>
                <a href="{{ route('product-lists') }}" class="auth__back hb__all">
                    {{ __('frontend.home.feat_all') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </header>

            <div class="hk" data-deck>
                <ul class="hk__stage" aria-roledescription="carousel" aria-label="{{ __('frontend.home.feat_title') }}">
                    @foreach($hoCourses as $course)
                        @php
                            $pimg = explode(',', $course->photo)[0];
                            $lvCount = $course->levels ? $course->levels->count() : 0;
                            $minPoints = $lvCount ? $course->levels->min('price_in_points') : 0;
                            $catTitle = optional($course->cat_info)->title;
                        @endphp
                        <li class="hk-card" data-deck-card aria-roledescription="slide" aria-label="{{ $loop->iteration }} / {{ $hoCourses->count() }}">
                            <a href="{{ route('product-detail', $course->slug) }}" class="hk-card__link">
                                <span class="hk-card__media">
                                    <img src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="896" loading="{{ $loop->index < 3 ? 'eager' : 'lazy' }}" decoding="async">
                                    <span class="hk-card__num num" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    @if($lvCount)
                                        <span class="cg-card__signal">
                                            <span class="cg-card__bars" aria-hidden="true">
                                                @for($b = 1; $b <= 4; $b++)
                                                    <span class="{{ $b <= min($lvCount, 4) ? 'is-on' : '' }}"></span>
                                                @endfor
                                            </span>
                                            {{ trans_choice('frontend.home.levels', $lvCount, ['count' => $lvCount]) }}
                                        </span>
                                    @endif
                                </span>
                                <span class="hk-card__body">
                                    @if($catTitle)
                                        <span class="cg-card__cat">{{ $catTitle }}</span>
                                    @endif
                                    <span class="hk-card__title">{{ $course->title }}</span>
                                    @if($course->summary)
                                        <span class="hk-card__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 130) }}</span>
                                    @endif
                                    <span class="cg-card__foot">
                                        @if($minPoints)
                                            <span class="cg-card__price">
                                                <small>{{ __('frontend.home.from') }}</small>
                                                <strong><span class="num">{{ number_format($minPoints) }}</span> <em>{{ __('frontend.home.unit') }}</em></strong>
                                            </span>
                                        @endif
                                        <span class="cg-card__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                        <span class="vh">{{ __('frontend.home.feat_open') }}</span>
                                    </span>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="hk__controls">
                    <button type="button" class="hk__arrow" aria-label="{{ __('frontend.home.feat_prev') }}" data-deck-prev>
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    </button>
                    <div class="hk__dots">
                        @foreach($hoCourses as $course)
                            <button type="button" class="hk__dot" aria-label="{{ $loop->iteration }} / {{ $hoCourses->count() }}" data-deck-dot="{{ $loop->index }}"><span></span></button>
                        @endforeach
                    </div>
                    <span class="hk__count num" aria-live="polite" data-deck-count>01 / {{ str_pad($hoCourses->count(), 2, '0', STR_PAD_LEFT) }}</span>
                    <button type="button" class="hk__arrow" aria-label="{{ __('frontend.home.feat_next') }}" data-deck-next>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endif

<section class="hs" aria-labelledby="hsTitle">
    <img class="hs__candles" src="{{ asset('assets/images/home-candles.webp') }}" alt="" width="1800" height="692" loading="lazy" decoding="async">
    <div class="hs__wrap">
        <header class="hs__head">
            <span class="eyebrow">{{ __('frontend.home.steps_tag') }}</span>
            <h2 id="hsTitle" class="hs__title">{{ __('frontend.home.steps_title') }}</h2>
            <p class="hs__text">{{ __('frontend.home.steps_text') }}</p>
        </header>

        <ol class="hs-stairs">
            @foreach($hoSteps as $i => $s)
                <li class="hs-step" style="--i: {{ $i }}">
                    <span class="hs-step__top">
                        <span class="hs-step__icon" aria-hidden="true"><i class="fas {{ $s['i'] }}"></i></span>
                        <span class="hs-step__num num" aria-hidden="true">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    </span>
                    <h3 class="hs-step__title">{{ __('frontend.home.' . $s['t']) }}</h3>
                    <p class="hs-step__text">{{ __('frontend.home.' . $s['d']) }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

<section class="hc" aria-labelledby="hcTitle">
    <div class="hc__wrap">
        <figure class="hc__visual">
            <img src="{{ asset('assets/images/home-credits.webp') }}" alt="{{ __('frontend.home.cred_img') }}" width="900" height="1317" loading="lazy" decoding="async">
        </figure>

        <div class="hc__body">
            <span class="eyebrow">{{ __('frontend.home.cred_tag') }}</span>
            <h2 id="hcTitle" class="hc__title">{{ __('frontend.home.cred_title') }}</h2>
            <p class="hc__text">{{ __('frontend.home.cred_text') }}</p>

            <div class="hc-card">
                <div class="hc-card__top">
                    <span class="hc-card__label">
                        <i class="fas fa-receipt" aria-hidden="true"></i>
                        {{ __('frontend.home.cred_card') }}
                    </span>
                    <span class="hc-card__valid">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        {{ rtrim(__('frontend.topup.valid_days'), '.。') }}
                    </span>
                </div>
                <div class="rs__tear hc-card__tear" aria-hidden="true"></div>
                <table class="hc-card__table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('frontend.topup.th_tier') }}</th>
                            <th scope="col">{{ __('frontend.topup.th_pay') }}</th>
                            <th scope="col">{{ __('frontend.topup.res_mult') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hoTiers as [$tier, $range, $mult])
                            <tr class="{{ $loop->last ? 'is-top' : '' }}">
                                <th scope="row">{{ __('frontend.topup.' . $tier) }}</th>
                                <td class="num">{!! $range !!}</td>
                                <td><span class="hc-card__mult num">{{ $mult }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('points.topup') }}" class="btn btn--primary">
                <span>{{ __('frontend.home.cred_go') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<section class="hy" aria-labelledby="hyTitle">
    <div class="hy__wrap">
        <figure class="hy__photo">
            <img src="{{ asset('assets/images/home-why.webp') }}" alt="{{ __('frontend.home.plus_photo') }}" width="1400" height="933" loading="lazy" decoding="async">
            <figcaption class="hy__chip">
                <i class="fas fa-eye" aria-hidden="true"></i>
                {{ __('frontend.home.p1') }}
            </figcaption>
        </figure>

        <div class="hy__body">
            <span class="eyebrow">{{ __('frontend.home.plus_tag') }}</span>
            <h2 id="hyTitle" class="hy__title">{{ __('frontend.home.plus_title') }}</h2>
            <ul class="hy-grid">
                @foreach($hoWhy as $w)
                    <li class="hy-card" style="--i: {{ $loop->index }}">
                        <span class="hy-card__head">
                            <span class="hy-card__icon" aria-hidden="true"><i class="fas {{ $w['i'] }}"></i></span>
                            <span class="hy-card__num num" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </span>
                        <strong class="hy-card__name">{{ __('frontend.home.' . $w['t']) }}</strong>
                        <span class="hy-card__text">{{ __('frontend.home.' . $w['d']) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<section class="he" aria-labelledby="heTitle">
    <div class="he__band">
        <div class="he__body">
            <span class="eyebrow">{{ __('frontend.home.close_tag') }}</span>
            <h2 id="heTitle" class="he__title">{{ __('frontend.home.close_title') }}</h2>
            <p class="he__text">{{ __('frontend.home.close_text') }}</p>
            <div class="he__cta">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <span>{{ __('frontend.home.go_browse') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                @guest
                    <a href="{{ route('register.form') }}" class="btn btn--ghost">{{ __('frontend.home.close_join') }}</a>
                @else
                    <a href="{{ route('points.topup') }}" class="btn btn--ghost">{{ __('frontend.home.go_credits') }}</a>
                @endguest
            </div>
        </div>
        <figure class="he__photo">
            <img src="{{ asset('assets/images/home-cta.webp') }}" alt="{{ __('frontend.home.close_photo') }}" width="1920" height="1280" loading="lazy" decoding="async">
        </figure>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var deck = document.querySelector('[data-deck]');
    if (deck) {
        var cards = Array.prototype.slice.call(deck.querySelectorAll('[data-deck-card]'));
        var dots = Array.prototype.slice.call(deck.querySelectorAll('[data-deck-dot]'));
        var count = deck.querySelector('[data-deck-count]');
        var total = cards.length;
        var active = 0;
        var timer = null;
        var pad = function (n) { return (n < 10 ? '0' : '') + n; };
        var narrow = window.matchMedia('(max-width: 767.98px)');

        var render = function () {
            var shift = narrow.matches ? 78 : 62;
            cards.forEach(function (card, i) {
                var d = i - active;
                if (d > total / 2) { d -= total; }
                if (d < -total / 2) { d += total; }
                var far = Math.abs(d);
                var on = d === 0;
                card.style.setProperty('--x', (d * shift) + '%');
                card.style.setProperty('--s', Math.max(0.6, 1 - far * 0.14));
                card.style.setProperty('--r', (d * -16) + 'deg');
                card.style.setProperty('--z', 10 - far);
                card.style.setProperty('--o', far > 2 ? 0 : 1 - far * 0.3);
                card.classList.toggle('is-active', on);
                card.classList.toggle('is-hidden', far > 2);
                card.setAttribute('aria-hidden', on ? 'false' : 'true');
                var link = card.querySelector('a');
                if (link) { link.setAttribute('tabindex', on ? '0' : '-1'); }
            });
            dots.forEach(function (dot, i) {
                dot.classList.toggle('is-active', i === active);
                dot.setAttribute('aria-current', i === active ? 'true' : 'false');
            });
            if (count) { count.textContent = pad(active + 1) + ' / ' + pad(total); }
        };

        var go = function (to) {
            active = (to + total) % total;
            render();
        };

        var stop = function () { clearInterval(timer); timer = null; };
        var play = function () {
            stop();
            if (calm || total < 2) { return; }
            timer = setInterval(function () { go(active + 1); }, 5000);
        };

        deck.querySelector('[data-deck-prev]').addEventListener('click', function () { go(active - 1); });
        deck.querySelector('[data-deck-next]').addEventListener('click', function () { go(active + 1); });
        dots.forEach(function (dot, i) { dot.addEventListener('click', function () { go(i); }); });

        cards.forEach(function (card, i) {
            card.addEventListener('click', function (event) {
                if (i !== active) {
                    event.preventDefault();
                    go(i);
                }
            });
        });

        deck.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowLeft') { event.preventDefault(); go(active - 1); }
            if (event.key === 'ArrowRight') { event.preventDefault(); go(active + 1); }
        });

        var startX = null;
        deck.addEventListener('pointerdown', function (event) { startX = event.clientX; });
        deck.addEventListener('pointerup', function (event) {
            if (startX === null) { return; }
            var moved = event.clientX - startX;
            if (Math.abs(moved) > 50) { go(active + (moved < 0 ? 1 : -1)); }
            startX = null;
        });

        deck.addEventListener('mouseenter', stop);
        deck.addEventListener('mouseleave', play);
        deck.addEventListener('focusin', stop);
        deck.addEventListener('focusout', play);
        window.addEventListener('resize', render);

        render();
        play();
    }

    document.querySelectorAll('[data-hp-video]').forEach(function (video) {
        var toggle = document.querySelector('[data-hp-toggle]');
        if (!toggle) { return; }

        var icon = toggle.querySelector('i');

        var paint = function () {
            toggle.setAttribute('aria-label', video.paused ? toggle.dataset.play : toggle.dataset.pause);
            icon.className = video.paused ? 'fas fa-play' : 'fas fa-pause';
        };

        if (calm) {
            video.removeAttribute('autoplay');
            video.pause();
        }

        toggle.addEventListener('click', function () {
            if (video.paused) { video.play(); } else { video.pause(); }
        });
        video.addEventListener('play', paint);
        video.addEventListener('pause', paint);
        paint();
    });
}());
</script>
@endpush
