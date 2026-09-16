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
    $related = collect($product_detail->rel_prods ?? [])->where('id', '!=', $product_detail->id)->take(3);

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

<section class="pd">
    <div class="pd__wrap">

        {{-- ===================== LEAD: 16:9 still + summary ===================== --}}
        <div class="pd-lead">
            <div class="pd-shot">
                <div class="pd-shot__frame">
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
            </div>

            <div class="pd-intro">
                @if($pdCategory)
                    <a href="{{ route('product-lists', $pdCategory->slug) }}" class="pd-intro__cat">{{ $pdCategory->title }}</a>
                @endif

                @if($product_detail->summary)
                    <p class="pd-intro__summary">{{ $product_detail->summary }}</p>
                @endif

                <dl class="pd-facts">
                    @if($hasLevels)
                        <div class="pd-fact">
                            <dt>{{ __('frontend.course.level') }}</dt>
                            <dd>{{ trans_choice('frontend.course.levels', count($pdLevels), ['count' => count($pdLevels)]) }}</dd>
                        </div>
                        <div class="pd-fact">
                            <dt>{{ __('frontend.course.from') }}</dt>
                            <dd class="pd-fact__num">{{ number_format($pdLevels->min('price_in_points')) }} <small>{{ __('frontend.course.credits') }}</small></dd>
                        </div>
                    @endif
                    @if($pdCategory)
                        <div class="pd-fact">
                            <dt>{{ __('frontend.course.category') }}</dt>
                            <dd>{{ $pdCategory->title }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <div class="pd__grid {{ $hasLevels ? '' : 'pd__grid--single' }}">

            {{-- ===================== MAIN COLUMN ===================== --}}
            <div class="pd-main">

                {{-- About --}}
                <section class="pd-block">
                    <h2 class="pd-block__title">{{ __('frontend.course.about') }}</h2>
                    @if($product_detail->description)
                        <div class="pd-prose">{!! nl2br(e($product_detail->description)) !!}</div>
                    @elseif($product_detail->summary)
                        <div class="pd-prose">{{ $product_detail->summary }}</div>
                    @endif
                </section>

                @if($hasLevels)
                    {{-- Levels: one selector for the whole page --}}
                    <section class="pd-block" id="pdLevels">
                        <h2 class="pd-block__title">{{ __('frontend.course.choose') }}</h2>

                        <ul class="pd-levels">
                            @foreach($pdLevels as $key => $level)
                                <li>
                                    <button type="button" class="pd-compare__row {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" aria-pressed="{{ $key === 0 ? 'true' : 'false' }}">
                                        <span class="pd-levels__name">
                                            <span class="pd-levels__dot pd-levels__dot--{{ strtolower((string) $level->skill_level) }}" aria-hidden="true"></span>
                                            {{ $levelName($level) }}
                                        </span>
                                        <span class="pd-levels__price">
                                            <strong>{{ number_format($level->price_in_points) }}</strong>
                                            <small>{{ __('frontend.course.credits') }}</small>
                                        </span>
                                        <span class="pd-levels__state">{{ __('frontend.course.selected') }}</span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        @foreach($pdLevels as $key => $level)
                            <div class="pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" @if($key !== 0) hidden @endif>
                                <dl class="pd-feats">
                                    @if($level->learn_info)
                                        <div class="pd-feat">
                                            <dt class="pd-feat__label">{{ __('frontend.course.learn') }}</dt>
                                            <dd class="pd-feat__desc">{{ $level->learn_info }}</dd>
                                        </div>
                                    @endif
                                    @if($level->purpose)
                                        <div class="pd-feat">
                                            <dt class="pd-feat__label">{{ __('frontend.course.purpose') }}</dt>
                                            <dd class="pd-feat__desc">{{ $level->purpose }}</dd>
                                        </div>
                                    @endif
                                    @if($level->outcome)
                                        <div class="pd-feat">
                                            <dt class="pd-feat__label">{{ __('frontend.course.outcome') }}</dt>
                                            <dd class="pd-feat__desc">{{ $level->outcome }}</dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                        @endforeach
                    </section>
                @endif
            </div>

            {{-- ===================== BUY COLUMN ===================== --}}
            @if($hasLevels)
                <aside class="pd-buy">
                    <div class="pd-buy__card">
                        @foreach($pdLevels as $key => $level)
                            <div class="pd-buy__level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" @if($key !== 0) hidden @endif>
                                <p class="pd-buy__label">{{ __('frontend.course.level') }}</p>
                                <p class="pd-buy__name">{{ $levelName($level) }}</p>

                                <p class="pd-buy__price">
                                    <strong>{{ number_format($level->price_in_points) }}</strong>
                                    <small>{{ __('frontend.course.credits') }}</small>
                                </p>

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
                            <li><i class="fas fa-coins" aria-hidden="true"></i> {{ __('frontend.course.unlock') }}</li>
                        </ul>

                        <p class="pd-buy__trust"><i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.course.note') }}</p>
                    </div>
                </aside>
            @endif
        </div>

        {{-- ===================== RELATED ===================== --}}
        @if($related->count())
            <section class="pd-related">
                <div class="pd-related__head">
                    <h2 class="pd-related__title">{{ __('frontend.course.related') }}</h2>
                    @if($pdCategory)
                        <a href="{{ route('product-lists', $pdCategory->slug) }}" class="pd-related__all">{{ __('frontend.course.view_all') }} <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    @endif
                </div>

                <ul class="pd-rel__grid">
                    @foreach($related as $course)
                        @php
                            $rimg = $course->photo ? explode(',', $course->photo)[0] : null;
                            $rLevels = $course->levels;
                            $rMin = $rLevels && $rLevels->count() ? $rLevels->min('price_in_points') : null;
                        @endphp
                        <li>
                            <a href="{{ route('product-detail', $course->slug) }}" class="pd-rel">
                                <span class="pd-rel__media">
                                    @if($rimg)
                                        <img src="{{ asset(ltrim($rimg, '/')) }}" alt="" loading="lazy" decoding="async">
                                    @else
                                        <span class="pd-rel__placeholder" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                                    @endif
                                </span>
                                <span class="pd-rel__title">{{ $course->title }}</span>
                                <span class="pd-rel__price">
                                    @if($rMin !== null)
                                        {{ __('frontend.course.from') }} <strong>{{ number_format($rMin) }}</strong> {{ __('frontend.course.credits') }}
                                    @else
                                        {{ __('frontend.course.no_levels') }}
                                    @endif
                                </span>
                            </a>
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
