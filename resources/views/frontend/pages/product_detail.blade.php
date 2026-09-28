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
    $cdBalance = Auth::check() ? (int) (Auth::user()->points_balance ?? 0) : 0;

    $bcLinks = [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.course.crumb_all'), 'url' => route('product-lists')],
    ];
    if ($cdCategory) {
        $bcLinks[] = ['name' => $cdCategory->title, 'url' => route('product-lists', $cdCategory->slug)];
    }
    $bcLinks[] = ['name' => $product_detail->title];

    $catIndex = $cdCategory ? \App\Models\Category::getAllParentWithChild()->search(fn ($c) => $c->id === $cdCategory->id) : false;
    $catClass = $catIndex !== false ? 'cat-n' . ($catIndex % 5) : '';
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => '',
    'links' => $bcLinks,
])

<section class="study">
    <div class="study__wrap">
        <div class="study__hero">
            <div class="viewer">
                <div class="viewer__stage cd-stage">
                    @if(isset($photos[0]))
                        <img id="cdStageImg" src="{{ asset(ltrim($photos[0], '/')) }}" alt="{{ $product_detail->title }}" fetchpriority="high" decoding="async">
                    @else
                        <span class="viewer__empty" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                    @endif
                </div>

                @if(count($photos) > 1)
                    <div class="viewer__thumbs">
                        @foreach($photos as $i => $ph)
                            <button type="button" class="viewer__thumb cd-thumb {{ $i === 0 ? 'is-active' : '' }}" data-src="{{ asset(ltrim($ph, '/')) }}" aria-label="{{ __('frontend.course.photo_show') }} {{ $i + 1 }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
                                <img src="{{ asset(ltrim($ph, '/')) }}" alt="" loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="study__info">
                @if($cdCategory)
                    <a href="{{ route('product-lists', $cdCategory->slug) }}" class="study__cat {{ $catClass }}">
                        <span class="study__mark" aria-hidden="true"></span>
                        {{ $cdCategory->title }}
                    </a>
                @endif

                <h1 class="study__title">{{ $product_detail->title }}</h1>

                @if($product_detail->summary)
                    <p class="study__lede">{{ $product_detail->summary }}</p>
                @endif

                @if($hasLevels)
                    <ul class="study__facts" aria-label="{{ __('frontend.course.glance') }}">
                        <li>
                            <span class="study__fact-icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                            <span><small>{{ __('frontend.course.glance_lv') }}</small><strong>{{ $levelCount }}</strong></span>
                        </li>
                        <li>
                            <span class="study__fact-icon" aria-hidden="true"><i class="fas fa-coins"></i></span>
                            <span><small>{{ __('frontend.course.glance_from') }}</small><strong>{{ number_format($minPoints) }} <em>{{ __('frontend.course.price_unit') }}</em></strong></span>
                        </li>
                        @auth
                            <li class="study__fact--wallet">
                                <span class="study__fact-icon" aria-hidden="true"><i class="fas fa-wallet"></i></span>
                                <span><small>{{ __('frontend.course.wallet') }}</small><strong>{{ number_format($cdBalance) }} <em>{{ __('frontend.course.price_unit') }}</em></strong></span>
                            </li>
                        @endauth
                    </ul>

                    <a href="#cdLevels" class="btn study__go">
                        <span>{{ __('frontend.course.pick') }}</span>
                        <i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
        </div>

        @if($product_detail->description)
            <section class="brief" aria-labelledby="cdAboutTitle">
                <h2 id="cdAboutTitle" class="brief__title">{{ __('frontend.course.overview') }}</h2>
                <div class="brief__text">{!! nl2br(e($product_detail->description)) !!}</div>
            </section>
        @endif

        @if($hasLevels)
            <section id="cdLevels" class="tiers" aria-labelledby="cdLevelsTitle" data-tiers>
                <header class="tiers__head">
                    <p class="tiers__eyebrow">{{ __('frontend.course.each') }}</p>
                    <h2 id="cdLevelsTitle" class="tiers__title">{{ __('frontend.course.pick') }}</h2>
                    <p class="tiers__hint">{{ __('frontend.course.hint') }}</p>
                </header>

                <div class="switch" role="tablist" aria-labelledby="cdLevelsTitle" data-tier-tabs>
                    @foreach($cdLevels as $key => $level)
                        <button type="button" class="switch__step {{ $key === 0 ? 'is-on' : '' }}" role="tab" id="tab-{{ $level->id }}" aria-controls="lvl-{{ $level->id }}" aria-selected="{{ $key === 0 ? 'true' : 'false' }}" tabindex="{{ $key === 0 ? '0' : '-1' }}" data-tier-tab>
                            <span class="switch__no">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="switch__text">
                                <span class="switch__name">{{ $levelName($level) }}</span>
                                <span class="switch__price">{{ number_format($level->price_in_points) }} {{ __('frontend.course.price_unit') }}</span>
                            </span>
                        </button>
                    @endforeach
                </div>

                @foreach($cdLevels as $key => $level)
                    @php
                        $lvPrice = (int) $level->price_in_points;
                        $lvEnough = $cdBalance >= $lvPrice;
                        $lvDetails = array_filter([
                            ['icon' => 'fa-book-open',        'title' => __('frontend.course.covers'), 'text' => $level->learn_info],
                            ['icon' => 'fa-user-check',       'title' => __('frontend.course.suits'),  'text' => $level->purpose],
                            ['icon' => 'fa-flag-checkered',   'title' => __('frontend.course.apply'),  'text' => $level->outcome],
                        ], fn ($row) => filled($row['text']));
                    @endphp
                    <article class="tier" id="lvl-{{ $level->id }}" role="tabpanel" aria-labelledby="tab-{{ $level->id }}" data-tier-panel>
                        <div class="tier__main">
                            <div class="tier__top">
                                <span class="tier__rank" aria-hidden="true">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div>
                                    <p class="tier__of">{{ __('frontend.course.level_num', ['num' => $key + 1]) }} / {{ $levelCount }}</p>
                                    <h3 class="tier__name">{{ $levelName($level) }}</h3>
                                </div>
                            </div>

                            @if(count($lvDetails))
                                <div class="tier__info">
                                    @foreach($lvDetails as $row)
                                        <div class="tier__block">
                                            <span class="tier__icon" aria-hidden="true"><i class="fas {{ $row['icon'] }}"></i></span>
                                            <h4 class="tier__label">{{ $row['title'] }}</h4>
                                            <p class="tier__text">{{ $row['text'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <aside class="tier__buy">
                            <p class="tier__price">
                                <strong>{{ number_format($lvPrice) }}</strong>
                                <span>{{ __('frontend.course.price_unit') }}</span>
                            </p>

                            @auth
                                <p class="tier__bal {{ $lvEnough ? 'is-ok' : 'is-short' }}">
                                    <i class="fas {{ $lvEnough ? 'fa-check' : 'fa-exclamation' }}" aria-hidden="true"></i>
                                    <span>
                                        @if($lvEnough)
                                            {{ __('frontend.course.bal_ok') }}
                                        @else
                                            {{ __('frontend.course.bal_short', ['num' => number_format($lvPrice - $cdBalance)]) }}
                                        @endif
                                    </span>
                                </p>
                            @endauth

                            <form action="{{ route('single-add-to-cart') }}" method="POST" class="cd-form">
                                @csrf
                                <input type="hidden" name="quant[1]" value="1">
                                <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                <input type="hidden" name="price" value="{{ $level->price }}">
                                <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                <input type="hidden" name="level_id" value="{{ $level->id }}">
                                <button type="submit" class="btn btn--block cd-form__submit">
                                    <i class="fas fa-cart-plus" aria-hidden="true"></i>
                                    <span>{{ __('frontend.course.add') }}</span>
                                </button>
                            </form>

                            @auth
                                @if(!$lvEnough)
                                    <a href="{{ route('points.topup') }}" class="btn btn--outline btn--block">
                                        <i class="fas fa-plus" aria-hidden="true"></i>
                                        {{ __('frontend.header.acct_topup') }}
                                    </a>
                                @endif
                            @endauth
                        </aside>
                    </article>
                @endforeach

                <p class="tiers__note">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    <span>{{ __('frontend.course.spend') }}</span>
                </p>
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
            if (stage && this.dataset.src) {
                stage.classList.remove('is-swap');
                void stage.offsetWidth;
                stage.classList.add('is-swap');
                stage.src = this.dataset.src;
            }
            thumbs.forEach(function (x) {
                x.classList.remove('is-active');
                x.setAttribute('aria-pressed', 'false');
            });
            this.classList.add('is-active');
            this.setAttribute('aria-pressed', 'true');
        });
    });

    const root = document.querySelector('[data-tiers]');
    if (root) {
        const tabs = Array.prototype.slice.call(root.querySelectorAll('[data-tier-tab]'));
        const panels = Array.prototype.slice.call(root.querySelectorAll('[data-tier-panel]'));
        root.classList.add('is-tabbed');

        const show = function (index, focus, animate) {
            tabs.forEach(function (tab, i) {
                const on = i === index;
                tab.classList.toggle('is-on', on);
                tab.classList.toggle('is-past', i < index);
                tab.setAttribute('aria-selected', on ? 'true' : 'false');
                tab.tabIndex = on ? 0 : -1;
                if (on && focus) { tab.focus(); }
            });
            panels.forEach(function (panel, i) {
                panel.hidden = i !== index;
                if (i === index && animate) {
                    panel.classList.remove('is-enter');
                    void panel.offsetWidth;
                    panel.classList.add('is-enter');
                }
            });
        };

        tabs.forEach(function (tab, i) {
            tab.addEventListener('click', function () { show(i, false, true); });
            tab.addEventListener('keydown', function (event) {
                let next = null;
                if (event.key === 'ArrowRight') { next = (i + 1) % tabs.length; }
                if (event.key === 'ArrowLeft') { next = (i - 1 + tabs.length) % tabs.length; }
                if (event.key === 'Home') { next = 0; }
                if (event.key === 'End') { next = tabs.length - 1; }
                if (next !== null) { event.preventDefault(); show(next, true, true); }
            });
        });

        const fromHash = panels.findIndex(function (panel) { return '#' + panel.id === window.location.hash; });
        show(fromHash > -1 ? fromHash : 0, false, false);
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
