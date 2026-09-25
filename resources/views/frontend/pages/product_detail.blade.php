@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
@php
    $photos = array_values(array_filter(explode(',', (string) $product_detail->photo)));
    $cdCategory = $product_detail->cat_info ?? null;
    $cdLevels = $product_detail->levels ?? collect();
    $hasLevels = $cdLevels && count($cdLevels);
    $levelCount = $hasLevels ? count($cdLevels) : 0;
    $minPoints = $hasLevels ? collect($cdLevels)->min('price_in_points') : 0;
    $levelName = function ($level) {
        $key = 'frontend.course.names.' . strtolower((string) $level->skill_level);
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };

    $bcLinks = [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.course.materials'), 'url' => route('product-lists')],
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
                            <button type="button" class="cd-thumb {{ $i === 0 ? 'is-active' : '' }}" data-src="{{ asset(ltrim($ph, '/')) }}" aria-label="{{ __('frontend.course.image') }} {{ $i + 1 }}" aria-pressed="{{ $i === 0 ? 'true' : 'false' }}">
                                <img src="{{ asset(ltrim($ph, '/')) }}" alt="" loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="cd-info">
                <h2 class="cd-title">{{ $product_detail->title }}</h2>

                <div class="cd-tags">
                    @if($cdCategory)
                        <a href="{{ route('product-lists', $cdCategory->slug) }}" class="cd-tag cd-tag--link">
                            <i class="fas fa-layer-group" aria-hidden="true"></i>
                            {{ $cdCategory->title }}
                        </a>
                    @endif
                    @if($hasLevels)
                        <span class="cd-tag cd-tag--accent">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            {{ trans_choice('frontend.course.levels', $levelCount, ['count' => $levelCount]) }}
                        </span>
                    @endif
                </div>

                @if($product_detail->summary)
                    <p class="cd-lede">{{ $product_detail->summary }}</p>
                @endif

                @if($hasLevels)
                    <div class="cd-start">
                        <span class="cd-start__price">
                            <span class="cd-start__from">{{ __('frontend.catalog.from') }}</span>
                            <i class="fas fa-bolt" aria-hidden="true"></i>
                            <strong>{{ number_format($minPoints) }}</strong>
                            <small>{{ __('frontend.course.credits') }}</small>
                        </span>
                        <a href="#cdLevels" class="btn btn--primary cd-start__cta">
                            <span>{{ __('frontend.course.choose') }}</span>
                            <i class="fas fa-arrow-down" aria-hidden="true"></i>
                        </a>
                    </div>

                    <p class="cd-note">
                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.course.note') }}</span>
                    </p>
                @endif
            </div>
        </div>

        @if($product_detail->description || $product_detail->summary)
            <section class="cd-about" aria-labelledby="cdAboutTitle">
                <h2 id="cdAboutTitle" class="cd-section-title">{{ __('frontend.course.about_material') }}</h2>
                <div class="cd-prose">
                    @if($product_detail->description)
                        {!! nl2br(e($product_detail->description)) !!}
                    @else
                        {{ $product_detail->summary }}
                    @endif
                </div>
            </section>
        @endif

        @if($hasLevels)
            <section id="cdLevels" class="cd-levels" aria-labelledby="cdLevelsTitle">
                <header class="cd-levels__head">
                    <h2 id="cdLevelsTitle" class="cd-section-title">{{ __('frontend.course.choose') }}</h2>
                    <p class="cd-levels__sub">{{ __('frontend.course.unlock') }}</p>
                </header>

                <ul class="cd-track">
                    @foreach($cdLevels as $key => $level)
                        <li class="cd-slide">
                            <article class="cd-level" aria-labelledby="cdLevel{{ $level->id }}">
                                <header class="cd-level__head">
                                    <div class="cd-level__top">
                                        <span class="cd-level__num" aria-hidden="true">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                        <span class="cd-level__bars" aria-hidden="true">
                                            @for($b = 1; $b <= 4; $b++)
                                                <span class="{{ $b <= min($key + 1, 4) ? 'is-on' : '' }}"></span>
                                            @endfor
                                        </span>
                                    </div>
                                    <h3 id="cdLevel{{ $level->id }}" class="cd-level__name">{{ $levelName($level) }}</h3>
                                    <p class="cd-level__price">
                                        <i class="fas fa-bolt" aria-hidden="true"></i>
                                        <strong>{{ number_format($level->price_in_points) }}</strong>
                                        <small>{{ __('frontend.course.credits') }}</small>
                                    </p>
                                </header>

                                <ul class="cd-points">
                                    @if($level->learn_info)
                                        <li class="cd-point">
                                            <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                                            <div class="cd-point__text">
                                                <h4 class="cd-point__label">{{ __('frontend.course.learn') }}</h4>
                                                <p class="cd-point__desc">{{ $level->learn_info }}</p>
                                            </div>
                                        </li>
                                    @endif
                                    @if($level->purpose)
                                        <li class="cd-point">
                                            <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-bullseye"></i></span>
                                            <div class="cd-point__text">
                                                <h4 class="cd-point__label">{{ __('frontend.course.purpose') }}</h4>
                                                <p class="cd-point__desc">{{ $level->purpose }}</p>
                                            </div>
                                        </li>
                                    @endif
                                    @if($level->outcome)
                                        <li class="cd-point">
                                            <span class="cd-point__icon" aria-hidden="true"><i class="fas fa-award"></i></span>
                                            <div class="cd-point__text">
                                                <h4 class="cd-point__label">{{ __('frontend.course.outcome') }}</h4>
                                                <p class="cd-point__desc">{{ $level->outcome }}</p>
                                            </div>
                                        </li>
                                    @endif
                                </ul>

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
                            </article>
                        </li>
                    @endforeach
                </ul>
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

    document.querySelectorAll('.cd-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const btn = form.querySelector('.cd-form__submit');
            const original = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> <span>' + @json(__('frontend.course.loading')) + '</span>';

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
