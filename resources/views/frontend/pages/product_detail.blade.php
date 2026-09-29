@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
@php
    $photos = collect(explode(',', (string) $product_detail->photo))
        ->map(fn ($ph) => trim($ph))
        ->filter(fn ($ph) => $ph !== '' && file_exists(public_path(ltrim($ph, '/'))))
        ->map(fn ($ph) => asset(ltrim($ph, '/')))
        ->values();
    $cdCategory = $product_detail->cat_info ?? null;
    $cdLevels = collect($product_detail->levels ?? [])->values();
    $hasLevels = $cdLevels->count() > 0;
    $levelCount = $cdLevels->count();
    $minPoints = $hasLevels ? $cdLevels->min('price_in_points') : 0;
    $levelName = function ($level) {
        $key = 'frontend.course.level_' . str_replace(' ', '_', strtolower(trim((string) $level->skill_level)));
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };
    $cdBalance = Auth::check() ? (int) (Auth::user()->points_balance ?? 0) : 0;

    $bcLinks = [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.course.all'), 'url' => route('product-lists')],
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

<section class="pd">
    <div class="container">
        <div class="pd__top">
            <div class="pd-gallery">
                <div class="pd-gallery__stage cd-stage {{ $photos->isEmpty() ? 'is-empty' : '' }}">
                    @if($photos->isNotEmpty())
                        <img id="cdStageImg" src="{{ $photos[0] }}" alt="{{ $product_detail->title }}" width="900" height="900" fetchpriority="high" decoding="async">
                    @else
                        <i class="fas fa-book-open" aria-hidden="true"></i>
                    @endif
                </div>

                @if($photos->count() > 1)
                    <div class="pd-gallery__thumbs">
                        @foreach($photos as $i => $ph)
                            <button type="button" class="pd-gallery__thumb cd-thumb {{ $i === 0 ? 'is-active' : '' }}" data-src="{{ $ph }}" aria-label="{{ __('frontend.course.show_image') }} {{ $i + 1 }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
                                <img src="{{ $ph }}" alt="" width="120" height="120" loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="pd-info">
                @if($cdCategory)
                    <a href="{{ route('product-lists', $cdCategory->slug) }}" class="pd-info__cat">{{ $cdCategory->title }}</a>
                @endif

                <h2 class="pd-info__title">{{ $product_detail->title }}</h2>

                @if($product_detail->summary)
                    <p class="pd-info__lede">{{ $product_detail->summary }}</p>
                @endif

                @if($hasLevels)
                    <ul class="pd-chips" aria-label="{{ __('frontend.course.summary') }}">
                        <li><i class="fas fa-layer-group" aria-hidden="true"></i>{{ __('frontend.course.levels') }}: <strong>{{ $levelCount }}</strong></li>
                        <li><i class="fas fa-coins" aria-hidden="true"></i>{{ __('frontend.course.from') }}: <strong>{{ number_format($minPoints) }} {{ __('frontend.course.credits') }}</strong></li>
                        @auth
                            <li class="pd-chips__bal"><i class="fas fa-wallet" aria-hidden="true"></i>{{ __('frontend.course.balance') }}: <strong>{{ number_format($cdBalance) }}</strong></li>
                        @endauth
                    </ul>

                    <div class="pd-levels" id="cdLevels" data-tiers>
                        <div class="pd-levels__head">
                            <h3 class="pd-levels__title" id="cdLevelsTitle">{{ __('frontend.course.choose') }}</h3>
                            <p class="pd-levels__note">{{ __('frontend.course.note') }}</p>
                        </div>

                        <div class="pd-picks" role="tablist" aria-labelledby="cdLevelsTitle">
                            @foreach($cdLevels as $key => $level)
                                <button type="button" class="pd-pick {{ $key === 0 ? 'is-on' : '' }}" role="tab" id="tab-{{ $level->id }}" aria-controls="lvl-{{ $level->id }}" aria-selected="{{ $key === 0 ? 'true' : 'false' }}" tabindex="{{ $key === 0 ? '0' : '-1' }}" data-tier-tab>
                                    <span class="pd-pick__top">
                                        <span class="pd-pick__no">{{ $key + 1 }}</span>
                                        <span class="pd-pick__meter" aria-hidden="true">
                                            @for($bar = 1; $bar <= max($levelCount, 1); $bar++)
                                                <span class="{{ $bar <= $key + 1 ? 'is-on' : '' }}"></span>
                                            @endfor
                                        </span>
                                    </span>
                                    <span class="pd-pick__name">{{ $levelName($level) }}</span>
                                    <span class="pd-pick__price"><strong>{{ number_format($level->price_in_points) }}</strong> {{ __('frontend.course.credits') }}</span>
                                </button>
                            @endforeach
                        </div>

                        @foreach($cdLevels as $key => $level)
                            @php
                                $lvPrice = (int) $level->price_in_points;
                                $lvEnough = $cdBalance >= $lvPrice;
                                $lvDetails = array_filter([
                                    ['icon' => 'fa-book-open',      'title' => __('frontend.course.topics'),  'text' => $level->learn_info],
                                    ['icon' => 'fa-user-check',     'title' => __('frontend.course.purpose'), 'text' => $level->purpose],
                                    ['icon' => 'fa-flag-checkered', 'title' => __('frontend.course.outcome'), 'text' => $level->outcome],
                                ], fn ($row) => filled($row['text']));
                            @endphp
                            <article class="pd-panel" id="lvl-{{ $level->id }}" role="tabpanel" aria-labelledby="tab-{{ $level->id }}" data-tier-panel @if($key !== 0) hidden @endif>
                                <div class="pd-panel__head">
                                    <div>
                                        <p class="pd-panel__step">{{ __('frontend.course.step', ['num' => $key + 1]) }} / {{ $levelCount }}</p>
                                        <h4 class="pd-panel__name">{{ $levelName($level) }}</h4>
                                    </div>
                                    <p class="pd-panel__price"><strong>{{ number_format($lvPrice) }}</strong> <span>{{ __('frontend.course.credits') }}</span></p>
                                </div>

                                @if(count($lvDetails))
                                    <dl class="pd-panel__rows">
                                        @foreach($lvDetails as $row)
                                            <div class="pd-panel__row">
                                                <dt><i class="fas {{ $row['icon'] }}" aria-hidden="true"></i>{{ $row['title'] }}</dt>
                                                <dd>{{ $row['text'] }}</dd>
                                            </div>
                                        @endforeach
                                    </dl>
                                @endif

                                @auth
                                    <p class="pd-panel__bal {{ $lvEnough ? 'is-ok' : 'is-short' }}">
                                        <i class="fas {{ $lvEnough ? 'fa-check-circle' : 'fa-exclamation-circle' }}" aria-hidden="true"></i>
                                        <span>{{ $lvEnough ? __('frontend.course.enough') : __('frontend.course.short', ['num' => number_format($lvPrice - $cdBalance)]) }}</span>
                                    </p>
                                @endauth

                                <form action="{{ route('single-add-to-cart') }}" method="POST" class="cd-form pd-panel__form">
                                    @csrf
                                    <input type="hidden" name="quant[1]" value="1">
                                    <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                    <input type="hidden" name="price" value="{{ $level->price }}">
                                    <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                    <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                    <input type="hidden" name="level_id" value="{{ $level->id }}">
                                    <button type="submit" class="btn btn--primary btn--block cd-form__submit">
                                        <i class="fas fa-cart-plus" aria-hidden="true"></i>
                                        <span>{{ __('frontend.course.add_level') }}</span>
                                    </button>
                                    @auth
                                        @if(!$lvEnough)
                                            <a href="{{ route('points.topup') }}" class="btn btn--dark btn--block">{{ __('frontend.header.buy_credits') }}</a>
                                        @endif
                                    @endauth
                                </form>
                            </article>
                        @endforeach

                        <p class="pd-levels__foot">
                            <i class="fas fa-shield-alt" aria-hidden="true"></i>
                            <span>{{ __('frontend.course.spend_note') }}</span>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        @if($product_detail->description || $hasLevels)
            <section class="pd-about" aria-labelledby="cdAboutTitle">
                <div class="pd-about__body">
                    <h2 id="cdAboutTitle" class="pd-about__title">{{ __('frontend.course.about') }}</h2>
                    @if($product_detail->description)
                        <div class="pd-about__text">{!! nl2br(e($product_detail->description)) !!}</div>
                    @elseif($product_detail->summary)
                        <div class="pd-about__text">{{ $product_detail->summary }}</div>
                    @endif
                </div>

                <aside class="pd-glance">
                    <p class="pd-glance__title">{{ __('frontend.course.glance') }}</p>
                    <dl class="pd-glance__list">
                        @if($cdCategory)
                            <div>
                                <dt>{{ __('frontend.header.categories') }}</dt>
                                <dd><a href="{{ route('product-lists', $cdCategory->slug) }}">{{ $cdCategory->title }}</a></dd>
                            </div>
                        @endif
                        @if($hasLevels)
                            <div>
                                <dt>{{ __('frontend.course.levels') }}</dt>
                                <dd>{{ $levelCount }}</dd>
                            </div>
                            <div>
                                <dt>{{ __('frontend.course.from') }}</dt>
                                <dd>{{ number_format($minPoints) }} {{ __('frontend.course.credits') }}</dd>
                            </div>
                        @endif
                    </dl>
                    @if($hasLevels)
                        <a href="#cdLevels" class="btn btn--primary btn--block">{{ __('frontend.course.choose') }}</a>
                    @endif
                </aside>
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
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> <span>' + @json(__('frontend.course.adding_now')) + '</span>';

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
