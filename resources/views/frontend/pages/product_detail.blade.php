@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
@php
    $photos = array_values(array_filter(explode(',', (string) $product_detail->photo)));
    $pdCategory = $product_detail->cat_info ?? null;
    $pdLevels = $product_detail->levels ?? collect();
    $hasLevels = $pdLevels && count($pdLevels);
    $levelName = function ($level) {
        $key = 'managenovax.course.skill_' . strtolower((string) $level->skill_level);
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };
    $related = collect($product_detail->rel_prods ?? [])->where('id', '!=', $product_detail->id)->take(3);

    $bcLinks = [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.catalog.title'), 'url' => route('product-lists')],
    ];
    if ($pdCategory) {
        $bcLinks[] = ['name' => $pdCategory->title, 'url' => route('product-lists', $pdCategory->slug)];
    }
    $bcLinks[] = ['name' => $product_detail->title];
    $bcData = ['title' => $product_detail->title, 'links' => $bcLinks];
    if (isset($photos[0])) {
        $bcData['image'] = ltrim($photos[0], '/');
    }
@endphp

@include('frontend.layouts.breadcrumb', $bcData)

<section class="pd">
    <div class="pd__wrap">
        <div class="pd__grid {{ $hasLevels ? '' : 'pd__grid--single' }}">

            {{-- ===================== MAIN COLUMN ===================== --}}
            <div class="pd-main">

                {{-- Gallery --}}
                <div class="pd-gallery">
                    <div class="pd-gallery__main">
                        @if(isset($photos[0]))
                            <img id="pdMainImg" src="{{ asset(ltrim($photos[0], '/')) }}" alt="{{ $product_detail->title }}">
                        @else
                            <span class="pd-gallery__placeholder"><i class="fas fa-graduation-cap"></i></span>
                        @endif
                        @if($hasLevels)
                            <span class="pd-gallery__badge"><i class="fas fa-signal"></i> {{ __('managenovax.course.inc_levels', ['count' => count($pdLevels)]) }}</span>
                        @endif
                    </div>

                    @if(count($photos) > 1)
                        <div class="pd-thumbs">
                            @foreach($photos as $i => $ph)
                                <button type="button" class="pd-thumb {{ $i === 0 ? 'active' : '' }}" data-src="{{ asset(ltrim($ph, '/')) }}" aria-label="{{ $product_detail->title }} {{ $i + 1 }}">
                                    <img src="{{ asset(ltrim($ph, '/')) }}" alt="">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- About --}}
                <div class="pd-card">
                    <div class="pd-about__top">
                        @if($pdCategory)
                            <a href="{{ route('product-lists', $pdCategory->slug) }}" class="pd-pill pd-pill--link">
                                <i class="fas fa-layer-group"></i> {{ $pdCategory->title }}
                            </a>
                        @else
                            <span class="pd-pill"><i class="fas fa-book-open"></i> {{ __('managenovax.course.category') }}</span>
                        @endif
                        @if($hasLevels)
                            <span class="pd-pill pd-pill--soft"><i class="fas fa-coins"></i> {{ __('managenovax.catalog.starting_from') }} {{ number_format($pdLevels->min('price_in_points')) }}</span>
                        @endif
                    </div>
                    <h2 class="pd-card__title">{{ __('managenovax.course.about') }}</h2>
                    @if($product_detail->description)
                        <p class="pd-about__desc">{!! nl2br(e($product_detail->description)) !!}</p>
                    @elseif($product_detail->summary)
                        <p class="pd-about__desc">{{ $product_detail->summary }}</p>
                    @endif
                </div>

                @if($hasLevels)
                    {{-- Level details --}}
                    <div class="pd-card" id="pdLevels">
                        <div class="pd-card__head">
                            <h2 class="pd-card__title">{{ __('managenovax.course.choose_level') }}</h2>
                        </div>

                        <div class="pd-tabs" role="tablist">
                            @foreach($pdLevels as $key => $level)
                                <button type="button" role="tab" class="pd-tab {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" aria-selected="{{ $key === 0 ? 'true' : 'false' }}">
                                    <span class="pd-tab__dot pd-tab__dot--{{ strtolower((string) $level->skill_level) }}"></span>
                                    {{ $levelName($level) }}
                                </button>
                            @endforeach
                        </div>

                        @foreach($pdLevels as $key => $level)
                            <div class="pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" role="tabpanel" @if($key !== 0) hidden @endif>
                                <div class="pd-feats">
                                    @if($level->learn_info)
                                        <div class="pd-feat pd-feat--learn">
                                            <span class="pd-feat__icon"><i class="fas fa-lightbulb"></i></span>
                                            <div>
                                                <h3 class="pd-feat__label">{{ __('managenovax.course.learn_info') }}</h3>
                                                <p class="pd-feat__desc">{{ $level->learn_info }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if($level->purpose)
                                        <div class="pd-feat pd-feat--purpose">
                                            <span class="pd-feat__icon"><i class="fas fa-bullseye"></i></span>
                                            <div>
                                                <h3 class="pd-feat__label">{{ __('managenovax.course.purpose') }}</h3>
                                                <p class="pd-feat__desc">{{ $level->purpose }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if($level->outcome)
                                        <div class="pd-feat pd-feat--outcome">
                                            <span class="pd-feat__icon"><i class="fas fa-trophy"></i></span>
                                            <div>
                                                <h3 class="pd-feat__label">{{ __('managenovax.course.outcome') }}</h3>
                                                <p class="pd-feat__desc">{{ $level->outcome }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Compare levels --}}
                    <div class="pd-card">
                        <h2 class="pd-card__title">{{ __('managenovax.course.compare') }}</h2>
                        <ul class="pd-compare">
                            @foreach($pdLevels as $key => $level)
                                <li>
                                    <button type="button" class="pd-compare__row {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">
                                        <span class="pd-compare__num">{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                        <span class="pd-compare__name">{{ $levelName($level) }}</span>
                                        <span class="pd-compare__price"><i class="fas fa-coins"></i> {{ number_format($level->price_in_points) }} <small>{{ __('managenovax.course.credits') }}</small></span>
                                        <span class="pd-compare__state">{{ __('managenovax.course.selected') }}</span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- ===================== BUY COLUMN ===================== --}}
            @if($hasLevels)
                <aside class="pd-buy">
                    @foreach($pdLevels as $key => $level)
                        <div class="pd-buy__level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" @if($key !== 0) hidden @endif>
                            <span class="pd-buy__label">{{ __('managenovax.course.level') }}</span>
                            <span class="pd-buy__level-name">{{ $levelName($level) }}</span>

                            <div class="pd-buy__price">
                                <span class="pd-buy__price-label">{{ __('managenovax.course.price') }}</span>
                                <strong><i class="fas fa-coins"></i> {{ number_format($level->price_in_points) }}</strong>
                                <small>{{ __('managenovax.course.credits') }}</small>
                            </div>

                            <form action="{{ route('single-add-to-cart') }}" method="POST" class="enroll-form">
                                @csrf
                                <input type="hidden" name="quant[1]" value="1">
                                <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                <input type="hidden" name="price" value="{{ $level->price }}">
                                <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                <input type="hidden" name="level_id" value="{{ $level->id }}">
                                <button type="submit" class="pd-enroll enroll-btn">
                                    <span>{{ __('managenovax.course.enroll_btn') }}</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach

                    <div class="pd-buy__switch" aria-label="{{ __('managenovax.course.select_level') }}">
                        @foreach($pdLevels as $key => $level)
                            <button type="button" class="pd-buy__chip {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">{{ $levelName($level) }}</button>
                        @endforeach
                    </div>

                    <div class="pd-buy__includes">
                        <span class="pd-buy__inc-title">{{ __('managenovax.course.includes') }}</span>
                        <ul>
                            <li><i class="fas fa-signal"></i> {{ __('managenovax.course.inc_levels', ['count' => count($pdLevels)]) }}</li>
                            @if($pdCategory)
                                <li><i class="fas fa-layer-group"></i> {{ __('managenovax.course.inc_category', ['category' => $pdCategory->title]) }}</li>
                            @endif
                            <li><i class="fas fa-coins"></i> {{ __('managenovax.course.inc_credits') }}</li>
                        </ul>
                    </div>

                    <p class="pd-buy__trust"><i class="fas fa-shield-alt"></i> {{ __('managenovax.credits.trust_msg') }}</p>
                </aside>
            @endif
        </div>

        {{-- Related courses --}}
        @if($related->count())
            <div class="pd-related">
                <div class="pd-related__head">
                    <h2 class="pd-related__title">{{ __('managenovax.course.related') }}</h2>
                    @if($pdCategory)
                        <a href="{{ route('product-lists', $pdCategory->slug) }}" class="pd-related__all">{{ __('managenovax.course.view_all') }} <i class="fas fa-arrow-right"></i></a>
                    @endif
                </div>
                <ul class="pl-grid">
                    @foreach($related as $course)
                        @php
                            $rimg = $course->photo ? explode(',', $course->photo)[0] : null;
                            $rLevels = $course->levels;
                            $rMin = $rLevels && $rLevels->count() ? $rLevels->min('price_in_points') : null;
                        @endphp
                        <li class="pl-card-wrap">
                            <a href="{{ route('product-detail', $course->slug) }}" class="pl-card">
                                <div class="pl-card__media">
                                    @if($rimg)
                                        <img src="{{ asset(ltrim($rimg, '/')) }}" alt="{{ $course->title }}" loading="lazy">
                                    @else
                                        <span class="pl-card__placeholder"><i class="fas fa-graduation-cap"></i></span>
                                    @endif
                                    @if($pdCategory)
                                        <span class="pl-card__cat">{{ $pdCategory->title }}</span>
                                    @endif
                                </div>
                                <div class="pl-card__body">
                                    <h3 class="pl-card__title">{{ $course->title }}</h3>
                                    <div class="pl-card__foot">
                                        @if($rMin !== null)
                                            <span class="pl-card__price">
                                                <small>{{ __('managenovax.catalog.starting_from') }}</small>
                                                <strong><i class="fas fa-coins"></i> {{ number_format($rMin) }}</strong>
                                            </span>
                                        @else
                                            <span class="pl-card__price"><strong class="pl-card__free">{{ __('managenovax.catalog.free_label') }}</strong></span>
                                        @endif
                                        <span class="pl-card__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ---- Level selection (tabs, compare rows and buy-box chips stay in sync) ----
    const triggers = document.querySelectorAll('.pd-tab, .pd-compare__row, .pd-buy__chip');
    const panels = document.querySelectorAll('.pd-level, .pd-buy__level');

    function selectLevel(id) {
        triggers.forEach(t => {
            const on = t.getAttribute('data-level-id') === id;
            t.classList.toggle('active', on);
            if (t.classList.contains('pd-tab')) t.setAttribute('aria-selected', on ? 'true' : 'false');
        });
        panels.forEach(p => {
            const on = p.getAttribute('data-level-id') === id;
            p.hidden = !on;
            p.classList.remove('active');
            if (on) setTimeout(() => p.classList.add('active'), 10);
        });
    }
    triggers.forEach(t => t.addEventListener('click', function () { selectLevel(this.getAttribute('data-level-id')); }));

    // ---- Gallery thumbnails ----
    const mainImg = document.getElementById('pdMainImg');
    const thumbs = document.querySelectorAll('.pd-thumb');
    thumbs.forEach(t => {
        t.addEventListener('click', function() {
            const src = this.getAttribute('data-src');
            if (mainImg && src) { mainImg.src = src; }
            thumbs.forEach(x => x.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // ---- Enroll (add to cart) ----
    const enrollForms = document.querySelectorAll('.enroll-form');
    enrollForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('.enroll-btn');
            const originalBtnText = submitBtn.innerHTML;
            const originalBtnState = submitBtn.disabled;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';

            fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                .then(response => new Promise(resolve => setTimeout(() => resolve(response), 500)))
                .then(() => { window.location.reload(); })
                .catch(error => {
                    console.error('Error:', error);
                    submitBtn.disabled = originalBtnState;
                    submitBtn.innerHTML = originalBtnText;
                });
        });
    });
});
</script>
@endpush
