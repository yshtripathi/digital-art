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
            <div class="cd-media">
                <figure class="cd-stage">
                    @if(isset($photos[0]))
                        <img id="cdStageImg" class="cd-stage__img" src="{{ asset(ltrim($photos[0], '/')) }}" alt="{{ $product_detail->title }}" fetchpriority="high" decoding="async">
                    @else
                        <span class="cd-stage__empty" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
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
                    <a href="#cdLevels" class="btn btn--primary cd-info__cta">
                        <span>{{ __('frontend.course.levels_title') }}</span>
                        <i class="fas fa-arrow-down" aria-hidden="true"></i>
                    </a>

                    <p class="cd-note">
                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.course.wallet_note') }}</span>
                    </p>
                @endif
            </div>
        </div>

        @if($hasLevels)
            <section id="cdLevels" class="cd-levels" aria-labelledby="cdLevelsTitle">
                <header class="cd-levels__head">
                    <p class="eyebrow">{{ __('frontend.course.levels_note') }}</p>
                    <h2 id="cdLevelsTitle" class="cd-levels__title">{{ __('frontend.course.levels_title') }}</h2>
                    <p class="cd-levels__hint">{{ __('frontend.course.pick_hint') }}</p>
                </header>

                <div class="cd-picker" role="tablist" aria-labelledby="cdLevelsTitle" data-picker>
                    @foreach($cdLevels as $key => $level)
                        <button type="button" class="cd-opt {{ $key === 0 ? 'is-active' : '' }}" role="tab" id="cdTab{{ $level->id }}" aria-controls="cdPanel{{ $level->id }}" aria-selected="{{ $key === 0 ? 'true' : 'false' }}" tabindex="{{ $key === 0 ? '0' : '-1' }}">
                            <span class="cd-opt__top">
                                <span class="cd-opt__num">{{ __('frontend.course.level_num', ['num' => $key + 1]) }}</span>
                                <span class="cd-opt__bars" aria-hidden="true">
                                    @for($b = 1; $b <= 4; $b++)
                                        <span class="{{ $b <= min($key + 1, 4) ? 'is-on' : '' }}"></span>
                                    @endfor
                                </span>
                            </span>
                            <span class="cd-opt__name">{{ $levelName($level) }}</span>
                            <span class="cd-opt__price"><span class="num">{{ number_format($level->price_in_points) }}</span> {{ __('frontend.course.price_unit') }}</span>
                        </button>
                    @endforeach
                </div>

                @foreach($cdLevels as $key => $level)
                    <article class="cd-panel" role="tabpanel" id="cdPanel{{ $level->id }}" aria-labelledby="cdTab{{ $level->id }}" tabindex="0" @if($key !== 0) hidden @endif>
                        <div class="cd-panel__main">
                            <h3 class="cd-panel__name">{{ $levelName($level) }}</h3>

                            <ul class="cd-points">
                                @if($level->learn_info)
                                    <li class="cd-point">
                                        <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                                        <h4 class="cd-point__label">{{ __('frontend.course.point_learn') }}</h4>
                                        <p class="cd-point__desc">{{ $level->learn_info }}</p>
                                    </li>
                                @endif
                                @if($level->purpose)
                                    <li class="cd-point">
                                        <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-bullseye"></i></span>
                                        <h4 class="cd-point__label">{{ __('frontend.course.point_for') }}</h4>
                                        <p class="cd-point__desc">{{ $level->purpose }}</p>
                                    </li>
                                @endif
                                @if($level->outcome)
                                    <li class="cd-point">
                                        <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-award"></i></span>
                                        <h4 class="cd-point__label">{{ __('frontend.course.point_after') }}</h4>
                                        <p class="cd-point__desc">{{ $level->outcome }}</p>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="cd-panel__buy">
                            <span class="cd-panel__label">{{ __('frontend.course.level_num', ['num' => $key + 1]) }}</span>
                            <p class="cd-panel__price">
                                <strong class="num">{{ number_format($level->price_in_points) }}</strong>
                                <small>{{ __('frontend.course.price_unit') }}</small>
                            </p>

                            <form action="{{ route('single-add-to-cart') }}" method="POST" class="cd-form">
                                @csrf
                                <input type="hidden" name="quant[1]" value="1">
                                <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                <input type="hidden" name="price" value="{{ $level->price }}">
                                <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                <input type="hidden" name="level_id" value="{{ $level->id }}">
                                <button type="submit" class="btn btn--primary btn--block cd-form__submit">
                                    <span>{{ __('frontend.course.add_cart') }}</span>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </section>
        @endif

        @if($product_detail->description || $product_detail->summary)
            <section class="cd-about" aria-labelledby="cdAboutTitle">
                <h2 id="cdAboutTitle" class="cd-about__title">{{ __('frontend.course.about_title') }}</h2>
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

        const choose = function (tab, focus) {
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
