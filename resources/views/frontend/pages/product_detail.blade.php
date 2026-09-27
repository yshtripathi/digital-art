@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
@php
    $photos = array_values(array_filter(explode(',', (string) $product_detail->photo)));
    $cdCategory = $product_detail->cat_info ?? null;
    $cdLevels = collect($product_detail->levels ?? [])->values();
    $hasLevels = $cdLevels->count() > 0;
    $levelCount = $cdLevels->count();
    $minPoints = $hasLevels ? $cdLevels->min('price_in_points') : 0;
    $levelName = function ($level) {
        $key = 'frontend.course.level_names.' . strtolower((string) $level->skill_level);
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };
    $levelTone = function ($level) {
        $name = strtolower((string) $level->skill_level);
        if (in_array($name, ['advanced', 'expert'])) { return 'advanced'; }
        return $name === 'intermediate' ? 'intermediate' : 'beginner';
    };
    $cdBalance = Auth::check() ? (int) (Auth::user()->points_balance ?? 0) : 0;

    $bcLinks = [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.course.crumb_all'), 'url' => route('product-lists')],
    ];
    if ($cdCategory) {
        $bcLinks[] = ['name' => $cdCategory->title, 'url' => route('product-lists', $cdCategory->slug)];
    }
    $bcLinks[] = ['name' => $product_detail->title];
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => $product_detail->title,
    'links' => $bcLinks,
])

<section class="cd">
    <div class="cd__wrap">

        <div class="cd-hero">
            <div class="cd-info">
                @if($cdCategory)
                    <a href="{{ route('product-lists', $cdCategory->slug) }}" class="cd-cat">
                        <i class="fas fa-layer-group" aria-hidden="true"></i>
                        {{ $cdCategory->title }}
                    </a>
                @endif

                <h2 class="cd-title">{{ $product_detail->title }}</h2>

                @if($product_detail->summary)
                    <p class="cd-lede">{{ $product_detail->summary }}</p>
                @endif

                <dl class="cd-glance" aria-label="{{ __('frontend.course.glance') }}">
                    @if($hasLevels)
                        <div class="cd-glance__item">
                            <dt>{{ __('frontend.course.glance_lv') }}</dt>
                            <dd class="num">{{ $levelCount }}</dd>
                        </div>
                        <div class="cd-glance__item">
                            <dt>{{ __('frontend.course.glance_from') }}</dt>
                            <dd><span class="num">{{ number_format($minPoints) }}</span> <small>{{ __('frontend.course.price_unit') }}</small></dd>
                        </div>
                    @endif
                    @if($cdCategory)
                        <div class="cd-glance__item">
                            <dt>{{ __('frontend.course.glance_cat') }}</dt>
                            <dd class="cd-glance__text">{{ $cdCategory->title }}</dd>
                        </div>
                    @endif
                </dl>

                @if($hasLevels)
                    <div class="cd-info__acts">
                        <a href="#cdLevels" class="btn btn--primary">
                            <span>{{ __('frontend.course.pick') }}</span>
                            <i class="fas fa-arrow-down" aria-hidden="true"></i>
                        </a>
                        @auth
                            <span class="cd-wallet">
                                <i class="fas fa-coins" aria-hidden="true"></i>
                                <span>{{ __('frontend.course.wallet') }}</span>
                                <strong class="num">{{ number_format($cdBalance) }}</strong>
                            </span>
                        @endauth
                    </div>
                @endif
            </div>

            <div class="cd-media">
                <figure class="cd-stage">
                    @if(isset($photos[0]))
                        <img id="cdStageImg" class="cd-stage__img" src="{{ asset(ltrim($photos[0], '/')) }}" alt="{{ $product_detail->title }}" fetchpriority="high" decoding="async">
                    @else
                        <span class="cd-stage__empty" aria-hidden="true"><i class="fas fa-chart-line"></i></span>
                    @endif
                    @if($hasLevels)
                        <figcaption class="cd-stage__tag">
                            <span class="cg-card__bars" aria-hidden="true">
                                @for($b = 1; $b <= 4; $b++)
                                    <span class="{{ $b <= min($levelCount, 4) ? 'is-on' : '' }}"></span>
                                @endfor
                            </span>
                            {{ trans_choice('frontend.catalog.level_count', $levelCount, ['count' => $levelCount]) }}
                        </figcaption>
                    @endif
                </figure>

                @if(count($photos) > 1)
                    <div class="cd-thumbs">
                        @foreach($photos as $i => $ph)
                            <button type="button" class="cd-thumb {{ $i === 0 ? 'is-active' : '' }}" data-src="{{ asset(ltrim($ph, '/')) }}" aria-label="{{ __('frontend.course.photo_show') }} {{ $i + 1 }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
                                <img src="{{ asset(ltrim($ph, '/')) }}" alt="" loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if($hasLevels)
            <section id="cdLevels" class="cd-levels" aria-labelledby="cdLevelsTitle">
                <header class="cd-levels__head">
                    <span class="eyebrow">{{ __('frontend.course.each') }}</span>
                    <h2 id="cdLevelsTitle" class="cd-levels__title">{{ __('frontend.course.pick') }}</h2>
                    <p class="cd-levels__hint">{{ __('frontend.course.hint') }}</p>
                </header>

                <div class="cd-path" role="tablist" aria-labelledby="cdLevelsTitle" data-picker style="--steps: {{ $levelCount }}">
                    <span class="cd-path__track" aria-hidden="true"><span class="cd-path__fill" data-path-fill></span></span>
                    @foreach($cdLevels as $key => $level)
                        <button type="button" class="cd-step cd-step--{{ $levelTone($level) }} {{ $key === 0 ? 'is-active' : '' }}" role="tab" id="cdTab{{ $level->id }}" aria-controls="cdPanel{{ $level->id }}" aria-selected="{{ $key === 0 ? 'true' : 'false' }}" tabindex="{{ $key === 0 ? '0' : '-1' }}" data-index="{{ $key }}">
                            <span class="cd-step__node num" aria-hidden="true">{{ $key + 1 }}</span>
                            <span class="cd-step__card">
                                <span class="cd-step__num">{{ __('frontend.course.level_num', ['num' => $key + 1]) }}</span>
                                <span class="cd-step__name">{{ $levelName($level) }}</span>
                                <span class="cd-step__price"><span class="num">{{ number_format($level->price_in_points) }}</span> {{ __('frontend.course.price_unit') }}</span>
                            </span>
                        </button>
                    @endforeach
                </div>

                @foreach($cdLevels as $key => $level)
                    @php
                        $lvPrice = (int) $level->price_in_points;
                        $lvEnough = $cdBalance >= $lvPrice;
                        $lvCover = $lvPrice > 0 ? min(100, round($cdBalance / $lvPrice * 100)) : 100;
                    @endphp
                    <article class="cd-panel cd-panel--{{ $levelTone($level) }}" role="tabpanel" id="cdPanel{{ $level->id }}" aria-labelledby="cdTab{{ $level->id }}" tabindex="0" @if($key !== 0) hidden @endif>
                        <div class="cd-panel__main">
                            <div class="cd-panel__head">
                                <span class="badge badge--{{ $levelTone($level) }}">{{ __('frontend.course.level_num', ['num' => $key + 1]) }}</span>
                                <h3 class="cd-panel__name">{{ $levelName($level) }}</h3>
                            </div>

                            <ol class="cd-points">
                                @if($level->learn_info)
                                    <li class="cd-point">
                                        <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                                        <div>
                                            <h4 class="cd-point__label">{{ __('frontend.course.covers') }}</h4>
                                            <p class="cd-point__desc">{{ $level->learn_info }}</p>
                                        </div>
                                    </li>
                                @endif
                                @if($level->purpose)
                                    <li class="cd-point">
                                        <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-user-check"></i></span>
                                        <div>
                                            <h4 class="cd-point__label">{{ __('frontend.course.suits') }}</h4>
                                            <p class="cd-point__desc">{{ $level->purpose }}</p>
                                        </div>
                                    </li>
                                @endif
                                @if($level->outcome)
                                    <li class="cd-point">
                                        <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-flag-checkered"></i></span>
                                        <div>
                                            <h4 class="cd-point__label">{{ __('frontend.course.apply') }}</h4>
                                            <p class="cd-point__desc">{{ $level->outcome }}</p>
                                        </div>
                                    </li>
                                @endif
                            </ol>
                        </div>

                        <aside class="cd-buy">
                            <span class="cd-buy__label">{{ __('frontend.course.level_num', ['num' => $key + 1]) }} · {{ $levelName($level) }}</span>
                            <p class="cd-buy__price">
                                <strong class="num">{{ number_format($lvPrice) }}</strong>
                                <small>{{ __('frontend.course.price_unit') }}</small>
                            </p>

                            @auth
                                <div class="cd-buy__meter {{ $lvEnough ? 'is-ok' : 'is-short' }}">
                                    <div class="cd-buy__row">
                                        <span>{{ __('frontend.course.wallet') }}</span>
                                        <strong class="num">{{ number_format($cdBalance) }}</strong>
                                    </div>
                                    <span class="cd-buy__track" aria-hidden="true"><span style="width: {{ $lvCover }}%"></span></span>
                                    <p class="cd-buy__state">
                                        <i class="fas {{ $lvEnough ? 'fa-check-circle' : 'fa-exclamation-circle' }}" aria-hidden="true"></i>
                                        @if($lvEnough)
                                            {{ __('frontend.course.bal_ok') }}
                                        @else
                                            {{ __('frontend.course.bal_short', ['num' => number_format($lvPrice - $cdBalance)]) }}
                                        @endif
                                    </p>
                                </div>
                            @endauth

                            <form action="{{ route('single-add-to-cart') }}" method="POST" class="cd-form">
                                @csrf
                                <input type="hidden" name="quant[1]" value="1">
                                <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                <input type="hidden" name="price" value="{{ $level->price }}">
                                <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                <input type="hidden" name="level_id" value="{{ $level->id }}">
                                <button type="submit" class="btn btn--primary btn--block cd-form__submit">
                                    <span>{{ __('frontend.course.add') }}</span>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </button>
                            </form>

                            @auth
                                @if(!$lvEnough)
                                    <a href="{{ route('points.topup') }}" class="btn btn--ghost btn--block">
                                        <i class="fas fa-plus" aria-hidden="true"></i>
                                        {{ __('frontend.header.acct_topup') }}
                                    </a>
                                @endif
                            @endauth

                            <p class="cd-buy__note">
                                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                                <span>{{ __('frontend.course.spend') }}</span>
                            </p>
                        </aside>
                    </article>
                @endforeach
            </section>
        @endif

        @if($product_detail->description || $product_detail->summary)
            <section class="cd-about" aria-labelledby="cdAboutTitle">
                <div class="cd-about__side">
                    <span class="cd-about__icon" aria-hidden="true"><i class="fas fa-book-reader"></i></span>
                    <h2 id="cdAboutTitle" class="cd-about__title">{{ __('frontend.course.overview') }}</h2>
                </div>
                <div class="cd-prose">
                    @if($product_detail->description)
                        {!! nl2br(e($product_detail->description)) !!}
                    @else
                        {{ $product_detail->summary }}
                    @endif
                </div>
            </section>
        @endif

    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const stage = document.getElementById('cdStageImg');
    const thumbs = document.querySelectorAll('.cd-thumb');
    thumbs.forEach(function (t) {
        t.addEventListener('click', function () {
            if (stage && this.dataset.src) stage.src = this.dataset.src;
            thumbs.forEach(function (x) {
                x.classList.remove('is-active');
                x.setAttribute('aria-pressed', 'false');
            });
            this.classList.add('is-active');
            this.setAttribute('aria-pressed', 'true');
        });
    });

    const picker = document.querySelector('[data-picker]');
    if (picker) {
        const tabs = Array.prototype.slice.call(picker.querySelectorAll('[role="tab"]'));

        const fill = function (tab) {
            const at = tabs.indexOf(tab);
            picker.style.setProperty('--fill', tabs.length > 1 ? at / (tabs.length - 1) : 0);
            tabs.forEach(function (t, i) { t.classList.toggle('is-past', i < at); });
        };

        const choose = function (tab, focus) {
            fill(tab);
            tabs.forEach(function (t) {
                const on = t === tab;
                t.classList.toggle('is-active', on);
                t.setAttribute('aria-selected', on ? 'true' : 'false');
                t.setAttribute('tabindex', on ? '0' : '-1');
                const panel = document.getElementById(t.getAttribute('aria-controls'));
                if (panel) { panel.hidden = !on; }
            });
            tab.scrollIntoView({ block: 'nearest', inline: 'nearest', behavior: 'smooth' });
            if (focus) { tab.focus(); }
        };

        fill(tabs[0]);

        tabs.forEach(function (tab, i) {
            tab.addEventListener('click', function () { choose(tab, false); });
            tab.addEventListener('keydown', function (e) {
                let next = null;
                if (e.key === 'ArrowRight') { next = tabs[(i + 1) % tabs.length]; }
                if (e.key === 'ArrowLeft') { next = tabs[(i - 1 + tabs.length) % tabs.length]; }
                if (e.key === 'Home') { next = tabs[0]; }
                if (e.key === 'End') { next = tabs[tabs.length - 1]; }
                if (next) { e.preventDefault(); choose(next, true); }
            });
        });
    }

    document.querySelectorAll('.cd-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const btn = form.querySelector('.cd-form__submit');
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> <span>' + @json(__('frontend.course.adding')) + '</span>';

            fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                .then(function (response) { return new Promise(function (resolve) { setTimeout(function () { resolve(response); }, 500); }); })
                .then(function () { window.location.reload(); })
                .catch(function () {
                    btn.disabled = false;
                    btn.innerHTML = original;
                });
        });
    });
});
</script>
@endpush
