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
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => '',
    'links' => $bcLinks,
])

<section class="pd">
    <div class="pd-cover">
        <div class="pd-cover__media cd-stage">
            @if(isset($photos[0]))
                <img id="cdStageImg" src="{{ asset(ltrim($photos[0], '/')) }}" alt="{{ $product_detail->title }}" fetchpriority="high" decoding="async">
            @else
                <span class="pd-cover__empty" aria-hidden="true"><i class="fab fa-bitcoin"></i></span>
            @endif
        </div>

        <span class="pd-cover__shade" aria-hidden="true"></span>

        <div class="pd-cover__body">
            @if($cdCategory)
                <a href="{{ route('product-lists', $cdCategory->slug) }}" class="pd-cover__cat">
                    <i class="fas fa-layer-group" aria-hidden="true"></i>
                    {{ $cdCategory->title }}
                </a>
            @endif

            <h1 class="pd-cover__title">{{ $product_detail->title }}</h1>

            @if($product_detail->summary)
                <p class="pd-cover__lede">{{ $product_detail->summary }}</p>
            @endif

            <div class="pd-cover__row">
                <dl class="pd-stats" aria-label="{{ __('frontend.course.glance') }}">
                    @if($hasLevels)
                        <div class="pd-stat">
                            <dt>{{ __('frontend.course.glance_lv') }}</dt>
                            <dd class="num">{{ $levelCount }}</dd>
                        </div>
                        <div class="pd-stat">
                            <dt>{{ __('frontend.course.glance_from') }}</dt>
                            <dd><i class="fas fa-coins" aria-hidden="true"></i> <span class="num">{{ number_format($minPoints) }}</span> <small>{{ __('frontend.course.price_unit') }}</small></dd>
                        </div>
                    @endif
                    @if($cdCategory)
                        <div class="pd-stat">
                            <dt>{{ __('frontend.course.glance_cat') }}</dt>
                            <dd class="pd-stat__text">{{ $cdCategory->title }}</dd>
                        </div>
                    @endif
                </dl>

                @if($hasLevels)
                    <div class="pd-cover__acts">
                        <a href="#cdLevels" class="btn btn--primary pd-cover__go">
                            <span>{{ __('frontend.course.pick') }}</span>
                            <i class="fas fa-arrow-down" aria-hidden="true"></i>
                        </a>
                        @auth
                            <span class="pd-wallet">
                                <i class="fas fa-coins" aria-hidden="true"></i>
                                <span>{{ __('frontend.course.wallet') }}</span>
                                <strong class="num">{{ number_format($cdBalance) }}</strong>
                            </span>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if(count($photos) > 1)
        <div class="pd-thumbs">
            @foreach($photos as $i => $ph)
                <button type="button" class="pd-thumb cd-thumb {{ $i === 0 ? 'is-active' : '' }}" data-src="{{ asset(ltrim($ph, '/')) }}" aria-label="{{ __('frontend.course.photo_show') }} {{ $i + 1 }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
                    <img src="{{ asset(ltrim($ph, '/')) }}" alt="" loading="lazy">
                </button>
            @endforeach
        </div>
    @endif

    @if($product_detail->description || $product_detail->summary || $hasLevels)
        <div class="pd-overview {{ $hasLevels ? '' : 'pd-overview--solo' }}">
            @if($product_detail->description || $product_detail->summary)
                <section class="pd-about" aria-labelledby="cdAboutTitle">
                    <h2 id="cdAboutTitle" class="pd-label">
                        <i class="fas fa-book-reader" aria-hidden="true"></i>
                        {{ __('frontend.course.overview') }}
                    </h2>
                    <div class="pd-prose">
                        @if($product_detail->description)
                            {!! nl2br(e($product_detail->description)) !!}
                        @else
                            {{ $product_detail->summary }}
                        @endif
                    </div>
                </section>
            @endif

            @if($hasLevels)
                <nav class="pd-path" aria-labelledby="pdPathTitle">
                    <h2 id="pdPathTitle" class="pd-label">
                        <i class="fas fa-route" aria-hidden="true"></i>
                        {{ __('frontend.course.path') }}
                    </h2>
                    <ol class="pd-path__list">
                        @foreach($cdLevels as $key => $level)
                            <li>
                                <a href="#lvl-{{ $level->id }}" class="pd-path__item">
                                    <span class="pd-path__dot num">{{ $key + 1 }}</span>
                                    <span class="pd-path__name">{{ $levelName($level) }}</span>
                                    <span class="pd-path__price"><span class="num">{{ number_format($level->price_in_points) }}</span> {{ __('frontend.course.price_unit') }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif
        </div>
    @endif

    @if($hasLevels)
        <section id="cdLevels" class="pd-levels" aria-labelledby="cdLevelsTitle">
            <header class="pd-levels__head">
                <div>
                    <span class="pd-levels__eyebrow">{{ __('frontend.course.each') }}</span>
                    <h2 id="cdLevelsTitle" class="pd-levels__title">{{ __('frontend.course.pick') }}</h2>
                    <p class="pd-levels__hint">{{ __('frontend.course.hint') }}</p>
                </div>
                @auth
                    <span class="pd-wallet pd-wallet--solid">
                        <i class="fas fa-coins" aria-hidden="true"></i>
                        <span>{{ __('frontend.course.wallet') }}</span>
                        <strong class="num">{{ number_format($cdBalance) }}</strong>
                    </span>
                @endauth
            </header>

            <div class="pd-levels__grid">
                @foreach($cdLevels as $key => $level)
                    @php
                        $lvPrice = (int) $level->price_in_points;
                        $lvEnough = $cdBalance >= $lvPrice;
                        $lvCover = $lvPrice > 0 ? min(100, round($cdBalance / $lvPrice * 100)) : 100;
                    @endphp
                    <article class="lvl" id="lvl-{{ $level->id }}" style="--i: {{ $key }}" data-reveal>
                        <div class="lvl__top">
                            <span class="lvl__rank num">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="lvl__head">
                                <span class="lvl__tier">{{ __('frontend.course.level_num', ['num' => $key + 1]) }}</span>
                                <h3 class="lvl__name">{{ $levelName($level) }}</h3>
                            </div>
                        </div>

                        <span class="lvl__meter" aria-hidden="true">
                            @for($s = 1; $s <= $levelCount; $s++)
                                <span class="{{ $s <= $key + 1 ? 'is-on' : '' }}"></span>
                            @endfor
                        </span>

                        <p class="lvl__price">
                            <span class="lvl__coin" aria-hidden="true"><i class="fas fa-coins"></i></span>
                            <strong class="num">{{ number_format($lvPrice) }}</strong>
                            <small>{{ __('frontend.course.price_unit') }}</small>
                        </p>

                        @auth
                            <div class="lvl__bal {{ $lvEnough ? 'is-ok' : 'is-short' }}">
                                <span class="lvl__bar" aria-hidden="true"><span style="width: {{ $lvCover }}%"></span></span>
                                <p>
                                    <i class="fas {{ $lvEnough ? 'fa-check-circle' : 'fa-exclamation-circle' }}" aria-hidden="true"></i>
                                    @if($lvEnough)
                                        {{ __('frontend.course.bal_ok') }}
                                    @else
                                        {{ __('frontend.course.bal_short', ['num' => number_format($lvPrice - $cdBalance)]) }}
                                    @endif
                                </p>
                            </div>
                        @endauth

                        @if($level->learn_info || $level->purpose || $level->outcome)
                            <details class="lvl__more">
                                <summary>
                                    <span>{{ __('frontend.course.more') }}</span>
                                    <i class="fas fa-chevron-down" aria-hidden="true"></i>
                                </summary>
                                <ul class="lvl__points">
                                    @if($level->learn_info)
                                        <li>
                                            <span class="lvl__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                                            <div>
                                                <h4>{{ __('frontend.course.covers') }}</h4>
                                                <p>{{ $level->learn_info }}</p>
                                            </div>
                                        </li>
                                    @endif
                                    @if($level->purpose)
                                        <li>
                                            <span class="lvl__icon" aria-hidden="true"><i class="fas fa-user-check"></i></span>
                                            <div>
                                                <h4>{{ __('frontend.course.suits') }}</h4>
                                                <p>{{ $level->purpose }}</p>
                                            </div>
                                        </li>
                                    @endif
                                    @if($level->outcome)
                                        <li>
                                            <span class="lvl__icon" aria-hidden="true"><i class="fas fa-flag-checkered"></i></span>
                                            <div>
                                                <h4>{{ __('frontend.course.apply') }}</h4>
                                                <p>{{ $level->outcome }}</p>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </details>
                        @endif

                        <div class="lvl__acts">
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
                        </div>
                    </article>
                @endforeach
            </div>

            <p class="pd-levels__note">
                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                <span>{{ __('frontend.course.spend') }}</span>
            </p>
        </section>
    @endif
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
                stage.classList.add('is-swap');
                setTimeout(function () { stage.classList.remove('is-swap'); }, 350);
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

    const cards = document.querySelectorAll('.pd [data-reveal]');
    if ('IntersectionObserver' in window) {
        const watch = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    watch.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        cards.forEach(function (card) { watch.observe(card); });
    } else {
        cards.forEach(function (card) { card.classList.add('is-in'); });
    }

    document.querySelectorAll('.pd-path__item').forEach(function (link) {
        link.addEventListener('click', function () {
            const target = document.querySelector(link.getAttribute('href'));
            if (!target) { return; }
            target.classList.remove('is-flash');
            void target.offsetWidth;
            target.classList.add('is-flash');
            const more = target.querySelector('details');
            if (more) { more.open = true; }
        });
    });

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
