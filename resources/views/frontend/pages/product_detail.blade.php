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
        $key = 'frontend.course.names.' . strtolower((string) $level->skill_level);
        return Lang::has($key) ? __($key) : ucfirst((string) $level->skill_level);
    };

    $bcLinks = [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.course.courses'), 'url' => route('product-lists')],
    ];
    if ($pdCategory) {
        $bcLinks[] = ['name' => $pdCategory->title, 'url' => route('product-lists', $pdCategory->slug)];
    }
    $bcLinks[] = ['name' => $product_detail->title];
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => $product_detail->title,
    'links' => $bcLinks,
])

{{-- ==========================================================================
     Course detail
     The course (image, summary and the picked level's detail) beside one
     unlock card that both picks the level and buys it, with the course
     description underneath (see design/DESIGN.md — section 8).
     Styles: public/css/theme.css — section 24
     JS hooks kept: #pdMainImg, .pd-thumb[data-src], .pd-compare__row,
     .pd-level / .pd-buy__level [data-level-id], .enroll-form, .enroll-btn
     ========================================================================== --}}
<section class="pd">
    <div class="pd__wrap">

        <div class="pd-top">

            {{-- The course --}}
            <div class="pd-lead">
                <div class="pd-shot">
                    @if(isset($photos[0]))
                        <img id="pdMainImg" src="{{ asset(ltrim($photos[0], '/')) }}" alt="{{ $product_detail->title }}" fetchpriority="high" decoding="async">
                    @else
                        <span class="pd-shot__placeholder" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                    @endif
                </div>

                @if(count($photos) > 1)
                    <div class="pd-thumbs">
                        @foreach($photos as $i => $ph)
                            <button type="button" class="pd-thumb {{ $i === 0 ? 'active' : '' }}" data-src="{{ asset(ltrim($ph, '/')) }}" aria-label="{{ __('frontend.course.image') }} {{ $i + 1 }}">
                                <img src="{{ asset(ltrim($ph, '/')) }}" alt="" loading="lazy">
                            </button>
                        @endforeach
                    </div>
                @endif

                <div class="pd-intro">
                    @if($pdCategory)
                        <a href="{{ route('product-lists', $pdCategory->slug) }}" class="badge">{{ $pdCategory->title }}</a>
                    @endif
                    @if($hasLevels)
                        <span class="badge badge--brand">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            {{ trans_choice('frontend.course.levels', count($pdLevels), ['count' => count($pdLevels)]) }}
                        </span>
                    @endif
                </div>

                @if($product_detail->summary)
                    <p class="pd-summary">{{ $product_detail->summary }}</p>
                @endif

                {{-- What the level you picked covers — updates with the choice --}}
                @if($hasLevels)
                    <div class="pd-what">
                        <h2 class="pd-what__title">{{ __('frontend.course.about_level') }}</h2>

                        @foreach($pdLevels as $key => $level)
                            <div class="pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" @if($key !== 0) hidden @endif>
                                <p class="pd-what__for">{{ $levelName($level) }}</p>
                                <ul class="pd-feats">
                                    @if($level->learn_info)
                                        <li class="pd-feat">
                                            <span class="pd-feat__icon" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                                            <span class="pd-feat__body">
                                                <span class="pd-feat__label">{{ __('frontend.course.learn') }}</span>
                                                <span class="pd-feat__desc">{{ $level->learn_info }}</span>
                                            </span>
                                        </li>
                                    @endif
                                    @if($level->purpose)
                                        <li class="pd-feat">
                                            <span class="pd-feat__icon" aria-hidden="true"><i class="fas fa-bullseye"></i></span>
                                            <span class="pd-feat__body">
                                                <span class="pd-feat__label">{{ __('frontend.course.purpose') }}</span>
                                                <span class="pd-feat__desc">{{ $level->purpose }}</span>
                                            </span>
                                        </li>
                                    @endif
                                    @if($level->outcome)
                                        <li class="pd-feat">
                                            <span class="pd-feat__icon" aria-hidden="true"><i class="fas fa-award"></i></span>
                                            <span class="pd-feat__body">
                                                <span class="pd-feat__label">{{ __('frontend.course.outcome') }}</span>
                                                <span class="pd-feat__desc">{{ $level->outcome }}</span>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Pick a level and unlock it — the only place either happens --}}
            @if($hasLevels)
                <aside class="pd-buy">
                    <p class="pd-buy__title">{{ __('frontend.course.choose') }}</p>

                    <ul class="pd-levels">
                        @foreach($pdLevels as $key => $level)
                            <li>
                                <button type="button" class="pd-compare__row {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" aria-pressed="{{ $key === 0 ? 'true' : 'false' }}">
                                    <span class="pd-levels__tick" aria-hidden="true"><i class="fas fa-check"></i></span>
                                    <span class="pd-levels__name">{{ $levelName($level) }}</span>
                                    <span class="pd-levels__price">
                                        <strong>{{ number_format($level->price_in_points) }}</strong>
                                        <small>{{ __('frontend.course.credits') }}</small>
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    @foreach($pdLevels as $key => $level)
                        <div class="pd-buy__level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" @if($key !== 0) hidden @endif>
                            <div class="pd-buy__cost">
                                <span class="pd-buy__label">{{ __('frontend.course.level') }}: {{ $levelName($level) }}</span>
                                <span class="pd-buy__price">
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                    <strong>{{ number_format($level->price_in_points) }}</strong>
                                    <small>{{ __('frontend.course.credits') }}</small>
                                </span>
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
                                    <span>{{ __('frontend.course.add') }}</span>
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach

                    <ul class="pd-buy__includes">
                        <li><i class="fas fa-signal" aria-hidden="true"></i> {{ trans_choice('frontend.course.levels', count($pdLevels), ['count' => count($pdLevels)]) }}</li>
                        @if($pdCategory)
                            <li><i class="fas fa-layer-group" aria-hidden="true"></i> {{ __('frontend.course.category_label') }} {{ $pdCategory->title }}</li>
                        @endif
                        <li><i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.course.unlock') }}</li>
                    </ul>

                    <p class="pd-buy__trust"><i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.course.note') }}</p>
                </aside>
            @endif
        </div>

        {{-- About the course --}}
        @if($product_detail->description || $product_detail->summary)
            <section class="pd-block">
                <h2 class="pd-block__title">{{ __('frontend.course.about') }}</h2>
                <div class="pd-prose">
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
document.addEventListener('DOMContentLoaded', function() {
    // ---- Level selection (the level list and the buy box stay in sync) ----
    const triggers = document.querySelectorAll('.pd-compare__row');
    const panels = document.querySelectorAll('.pd-level, .pd-buy__level');

    function selectLevel(id) {
        triggers.forEach(t => {
            const on = t.getAttribute('data-level-id') === id;
            t.classList.toggle('active', on);
            t.setAttribute('aria-pressed', on ? 'true' : 'false');
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
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + @json(__('frontend.course.loading'));

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
