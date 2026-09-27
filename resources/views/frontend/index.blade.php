@extends('frontend.layouts.main')
@section('description', __('frontend.home.meta'))

@section('main-content')
@php
    $hoCategories = isset($category_lists) ? $category_lists : collect();

    $hoCourses = collect($product_lists ?? [])->filter(fn ($c) => !empty($c->photo))->values();
    $hoCourses = $hoCourses->where('is_featured', 1)
        ->concat($hoCourses->where('is_featured', '!=', 1))
        ->take(15)
        ->values();
    $hoPages = $hoCourses->chunk(5)->values();

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
    $hoTierIcons = ['fa-feather', 'fa-star', 'fa-gem', 'fa-crown'];

    $hoSteps = [
        ['t' => 'how1', 'd' => 'how1_text', 'i' => 'fa-compass'],
        ['t' => 'how2', 'd' => 'how2_text', 'i' => 'fa-signal'],
        ['t' => 'how3', 'd' => 'how3_text', 'i' => 'fa-lock-open'],
        ['t' => 'how4', 'd' => 'how4_text', 'i' => 'fa-graduation-cap'],
    ];
    $hoWhy = [
        ['t' => 'why1', 'd' => 'why1_text', 'i' => 'fa-eye'],
        ['t' => 'why2', 'd' => 'why2_text', 'i' => 'fa-coins'],
        ['t' => 'why3', 'd' => 'why3_text', 'i' => 'fa-clock'],
        ['t' => 'why4', 'd' => 'why4_text', 'i' => 'fa-shield-alt'],
    ];
    $hoGlyphs = ['₿', 'Ξ', '₮', '◎', 'Ł', 'Ð', '₳'];
    $hoPills = collect(__('frontend.head.terms'))->take(6)->values();
    $hoPillSpots = [[62, 18], [86, 30], [58, 62], [90, 70], [70, 86], [78, 8]];
@endphp

<section class="hm-hero" aria-labelledby="hmTitle">
    <div class="hm-hero__pills" aria-hidden="true">
        @foreach($hoPills as $pill)
            <span class="hm-pill" style="--x: {{ $hoPillSpots[$loop->index][0] }}%; --y: {{ $hoPillSpots[$loop->index][1] }}%; --d: {{ $loop->index * -1.4 }}s">
                <span class="hm-pill__dot"></span>{{ $pill }}
            </span>
        @endforeach
    </div>

    <div class="hm-hero__copy">
        <span class="hm-hero__tag" data-rise><i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.home.hero_tag') }}</span>
        <h1 id="hmTitle" class="hm-hero__title" data-rise>{{ __('frontend.home.hero_title') }}</h1>
        <p class="hm-hero__lead" data-rise>{{ __('frontend.home.hero_lead') }}</p>

        <div class="hm-hero__acts" data-rise>
            <a href="{{ route('product-lists') }}" class="btn btn--primary">
                <span>{{ __('frontend.home.hero_go') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
            <a href="{{ route('points.topup') }}" class="btn btn--ghost">
                <i class="fas fa-coins" aria-hidden="true"></i>
                {{ __('frontend.home.hero_buy') }}
            </a>
        </div>

        <dl class="hm-stats" data-rise>
            <div class="hm-stat">
                <dt>{{ __('frontend.home.stat_mat') }}</dt>
                <dd class="num" data-count="{{ $hoMaterials }}">{{ number_format($hoMaterials) }}</dd>
            </div>
            <div class="hm-stat">
                <dt>{{ __('frontend.home.stat_cat') }}</dt>
                <dd class="num" data-count="{{ $hoCategories->count() }}">{{ number_format($hoCategories->count()) }}</dd>
            </div>
            <div class="hm-stat">
                <dt>{{ __('frontend.home.stat_lvl') }}</dt>
                <dd class="num" data-count="{{ $hoLevels }}">{{ number_format($hoLevels) }}</dd>
            </div>
        </dl>

        <p class="hm-hero__note" data-rise>
            <i class="fas fa-shield-alt" aria-hidden="true"></i>
            {{ __('frontend.home.hero_note') }}
        </p>
    </div>
</section>

@if($hoCourses->count())
    <section class="hm-pick" aria-labelledby="hmPickTitle" data-deck>
        <div class="hm-head" data-rise>
            <div>
                <span class="hm-head__tag">{{ __('frontend.home.pick_tag') }}</span>
                <h2 id="hmPickTitle" class="hm-head__title">{{ __('frontend.home.pick_title') }}</h2>
            </div>
            <div class="hm-deck__nav">
                @if($hoPages->count() > 1)
                    <button type="button" class="hm-deck__arrow" aria-label="{{ __('frontend.home.pick_prev') }}" data-deck-prev><i class="fas fa-arrow-left" aria-hidden="true"></i></button>
                    <div class="hm-deck__dots" role="tablist" aria-label="{{ __('frontend.home.pick_title') }}">
                        @foreach($hoPages as $p => $page)
                            <button type="button" class="hm-deck__dot {{ $p === 0 ? 'is-active' : '' }}" role="tab" aria-selected="{{ $p === 0 ? 'true' : 'false' }}" aria-label="{{ $p + 1 }} / {{ $hoPages->count() }}" data-deck-dot="{{ $p }}">
                                <span class="num">{{ str_pad($p + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="hm-deck__bar" aria-hidden="true"><span></span></span>
                            </button>
                        @endforeach
                    </div>
                    <button type="button" class="hm-deck__arrow" aria-label="{{ __('frontend.home.pick_next') }}" data-deck-next><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                @endif
                <a href="{{ route('product-lists') }}" class="hm-deck__all">
                    {{ __('frontend.home.pick_all') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <div class="hm-deck" data-deck-stage>
            @foreach($hoPages as $p => $page)
                <ul class="hm-page {{ $p === 0 ? 'is-active' : '' }}" data-deck-page @if($p !== 0) aria-hidden="true" @endif>
                    @foreach($page->values() as $t => $course)
                        @php
                            $pimg = explode(',', $course->photo)[0];
                            $lvCount = $course->levels ? $course->levels->count() : 0;
                            $minPoints = $lvCount ? $course->levels->min('price_in_points') : 0;
                            $catTitle = optional($course->cat_info)->title;
                            $isBig = $t === 0;
                        @endphp
                        <li class="hm-tile {{ $isBig ? 'hm-tile--big' : '' }}" style="--i: {{ $t }}">
                            <a href="{{ route('product-detail', $course->slug) }}" class="hm-tile__link" @if($p !== 0) tabindex="-1" @endif>
                                <img class="hm-tile__img" src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="896" loading="{{ $p === 0 ? 'eager' : 'lazy' }}" decoding="async">
                                <span class="hm-tile__shade" aria-hidden="true"></span>
                                <span class="hm-tile__top">
                                    @if($catTitle)
                                        <span class="hm-tile__cat">{{ $catTitle }}</span>
                                    @endif
                                    <span class="hm-tile__num num" aria-hidden="true">{{ str_pad($p * 5 + $t + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </span>
                                <span class="hm-tile__body">
                                    <span class="hm-tile__title">{{ $course->title }}</span>
                                    @if($isBig && $course->summary)
                                        <span class="hm-tile__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 150) }}</span>
                                    @endif
                                    <span class="hm-tile__meta">
                                        @if($lvCount)
                                            <span class="hm-tile__lv">
                                                <span class="mat__meter" aria-hidden="true">
                                                    @for($b = 1; $b <= min($lvCount, 6); $b++)
                                                        <span style="--b: {{ $b }}"></span>
                                                    @endfor
                                                </span>
                                                {{ trans_choice('frontend.home.levels', $lvCount, ['count' => $lvCount]) }}
                                            </span>
                                        @endif
                                        @if($minPoints)
                                            <span class="hm-tile__price">
                                                <i class="fas fa-coins" aria-hidden="true"></i>
                                                <small>{{ __('frontend.home.from') }}</small>
                                                <strong class="num">{{ number_format($minPoints) }}</strong>
                                                <em>{{ __('frontend.home.unit') }}</em>
                                            </span>
                                        @endif
                                    </span>
                                </span>
                                <span class="hm-tile__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                <span class="vh">{{ __('frontend.home.pick_open') }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </section>
@endif

<section class="hm-how" aria-labelledby="hmHowTitle">
    <div class="hm-head" data-rise>
        <div>
            <span class="hm-head__tag">{{ __('frontend.home.how_tag') }}</span>
            <h2 id="hmHowTitle" class="hm-head__title">{{ __('frontend.home.how_title') }}</h2>
            <p class="hm-head__text">{{ __('frontend.home.how_text') }}</p>
        </div>
    </div>

    <div class="hm-how__grid">
        <ol class="hm-chain">
            @foreach($hoSteps as $s)
                <li class="hm-step" style="--i: {{ $loop->index }}" data-rise>
                    <span class="hm-step__icon" aria-hidden="true"><i class="fas {{ $s['i'] }}"></i></span>
                    <span class="hm-step__num num" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <h3 class="hm-step__title">{{ __('frontend.home.' . $s['t']) }}</h3>
                    <p class="hm-step__text">{{ __('frontend.home.' . $s['d']) }}</p>
                </li>
            @endforeach
        </ol>

        <aside class="hm-why" aria-labelledby="hmWhyTitle" data-rise>
            <span class="hm-head__tag">{{ __('frontend.home.why_tag') }}</span>
            <h3 id="hmWhyTitle" class="hm-why__title">{{ __('frontend.home.why_title') }}</h3>
            <ul class="hm-why__list">
                @foreach($hoWhy as $w)
                    <li>
                        <span class="hm-why__icon" aria-hidden="true"><i class="fas {{ $w['i'] }}"></i></span>
                        <span>
                            <strong>{{ __('frontend.home.' . $w['t']) }}</strong>
                            <span>{{ __('frontend.home.' . $w['d']) }}</span>
                        </span>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</section>

<section class="hm-credits" aria-labelledby="hmCreditsTitle">
    <div class="hm-credits__box" data-rise>
        <div class="hm-credits__copy">
            <span class="hm-head__tag">{{ __('frontend.home.wal_tag') }}</span>
            <h2 id="hmCreditsTitle" class="hm-head__title">{{ __('frontend.home.wal_title') }}</h2>
            <p class="hm-head__text">{{ __('frontend.home.wal_text') }}</p>
            <a href="{{ route('points.topup') }}" class="btn btn--primary">
                <i class="fas fa-calculator" aria-hidden="true"></i>
                {{ __('frontend.home.wal_go') }}
            </a>
        </div>

        <div class="hm-bars" role="list" aria-label="{{ __('frontend.home.wal_card') }}">
            @foreach($hoTiers as [$tier, $range, $mult])
                <div class="hm-bar {{ $loop->last ? 'is-top' : '' }}" role="listitem" style="--p: {{ [0.34, 0.58, 0.76, 1][$loop->index] }}; --i: {{ $loop->index }}">
                    <span class="hm-bar__track">
                        <strong class="hm-bar__mult num">{{ $mult }}</strong>
                        <span class="hm-bar__col" aria-hidden="true">
                            <i class="fas {{ $hoTierIcons[$loop->index] }}"></i>
                        </span>
                    </span>
                    <span class="hm-bar__name">{{ __('frontend.topup.' . $tier) }}</span>
                    <span class="hm-bar__range num">{!! $range !!}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="hm-end" data-rise>
        <div>
            <span class="hm-head__tag">{{ __('frontend.home.end_tag') }}</span>
            <h2 class="hm-end__title">{{ __('frontend.home.end_title') }}</h2>
            <p class="hm-end__text">{{ __('frontend.home.end_text') }}</p>
        </div>
        <div class="hm-end__acts">
            <a href="{{ route('product-lists') }}" class="btn btn--primary">
                <span>{{ __('frontend.home.hero_go') }}</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
            @guest
                <a href="{{ route('register.form') }}" class="btn btn--ghost">{{ __('frontend.home.end_join') }}</a>
            @else
                <a href="{{ route('points.topup') }}" class="btn btn--ghost">{{ __('frontend.home.hero_buy') }}</a>
            @endguest
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var risers = document.querySelectorAll('[data-rise]');
    if ('IntersectionObserver' in window && !calm) {
        var watch = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    watch.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        risers.forEach(function (el) { el.classList.add('is-wait'); watch.observe(el); });
    }

    var counters = document.querySelectorAll('[data-count]');
    counters.forEach(function (el) {
        var goal = parseInt(el.getAttribute('data-count'), 10) || 0;
        if (calm || goal === 0) { return; }
        var start = null;
        el.textContent = '0';
        var step = function (time) {
            if (!start) { start = time; }
            var done = Math.min((time - start) / 1400, 1);
            var eased = 1 - Math.pow(1 - done, 3);
            el.textContent = Math.round(goal * eased).toLocaleString();
            if (done < 1) { requestAnimationFrame(step); }
        };
        setTimeout(function () { requestAnimationFrame(step); }, 400);
    });

    var deck = document.querySelector('[data-deck]');
    if (deck) {
        var pages = Array.prototype.slice.call(deck.querySelectorAll('[data-deck-page]'));
        var dots = Array.prototype.slice.call(deck.querySelectorAll('[data-deck-dot]'));
        var stage = deck.querySelector('[data-deck-stage]');
        var current = 0;
        var timer = null;
        var wait = 7000;

        var show = function (index, dir) {
            if (!pages.length) { return; }
            var next = (index + pages.length) % pages.length;
            if (next === current && pages[next].classList.contains('is-active')) { return; }
            stage.setAttribute('data-dir', dir || (next > current ? 'next' : 'prev'));
            pages.forEach(function (page, i) {
                var on = i === next;
                page.classList.toggle('is-active', on);
                page.classList.toggle('is-leaving', i === current && !on);
                if (on) { page.removeAttribute('aria-hidden'); } else { page.setAttribute('aria-hidden', 'true'); }
                page.querySelectorAll('a').forEach(function (link) {
                    if (on) { link.removeAttribute('tabindex'); } else { link.setAttribute('tabindex', '-1'); }
                });
            });
            dots.forEach(function (dot, i) {
                var on = i === next;
                dot.classList.toggle('is-active', on);
                dot.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            current = next;
            restart();
        };

        var restart = function () {
            clearTimeout(timer);
            deck.classList.remove('is-timing');
            void deck.offsetWidth;
            if (calm || pages.length < 2 || deck.classList.contains('is-held')) { return; }
            deck.classList.add('is-timing');
            timer = setTimeout(function () { show(current + 1, 'next'); }, wait);
        };

        var prev = deck.querySelector('[data-deck-prev]');
        var next = deck.querySelector('[data-deck-next]');
        if (prev) { prev.addEventListener('click', function () { show(current - 1, 'prev'); }); }
        if (next) { next.addEventListener('click', function () { show(current + 1, 'next'); }); }
        dots.forEach(function (dot) {
            dot.addEventListener('click', function () { show(parseInt(dot.getAttribute('data-deck-dot'), 10)); });
        });

        var hold = function () { deck.classList.add('is-held'); clearTimeout(timer); deck.classList.remove('is-timing'); };
        var release = function () { deck.classList.remove('is-held'); restart(); };
        stage.addEventListener('mouseenter', hold);
        stage.addEventListener('mouseleave', release);
        stage.addEventListener('focusin', hold);
        stage.addEventListener('focusout', release);

        var startX = null;
        stage.addEventListener('pointerdown', function (event) { startX = event.clientX; });
        stage.addEventListener('pointerup', function (event) {
            if (startX === null) { return; }
            var moved = event.clientX - startX;
            startX = null;
            if (Math.abs(moved) > 50) { show(current + (moved < 0 ? 1 : -1), moved < 0 ? 'next' : 'prev'); }
        });

        deck.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowRight') { show(current + 1, 'next'); }
            if (event.key === 'ArrowLeft') { show(current - 1, 'prev'); }
        });

        if ('IntersectionObserver' in window) {
            new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) { release(); } else { hold(); }
                });
            }, { threshold: 0.3 }).observe(stage);
        } else {
            restart();
        }
    }
}());
</script>
@endpush
