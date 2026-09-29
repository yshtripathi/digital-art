@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', __('frontend.catalog.description'))
@else
    @section('title', __('frontend.catalog.title'))
    @section('description', __('frontend.catalog.description'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('frontend.catalog.title');
    $isPaginator = $products instanceof \Illuminate\Pagination\AbstractPaginator;
    $totalCourses = $isPaginator && method_exists($products, 'total') ? $products->total() : $products->count();
    $activeSlug = $isCat ? $category->slug : null;
    $shelf = \App\Models\Category::getAllParentWithChild();
    $shelfCounts = \App\Models\Product::where('status', 'active')->selectRaw('cat_id, count(*) as total')->groupBy('cat_id')->pluck('total', 'cat_id');
    $shelfAll = $shelfCounts->sum();
    $sorts = [
        'default' => __('frontend.catalog.sort_recommended'),
        'az'      => __('frontend.catalog.sort_title'),
        'low'     => __('frontend.catalog.sort_low_high'),
        'high'    => __('frontend.catalog.sort_high_low'),
    ];
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => $bcTitle,
    'links' => $isCat
        ? [
            ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
            ['name' => __('frontend.catalog.title'), 'url' => route('product-lists')],
            ['name' => $bcTitle]
        ]
        : [
            ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
            ['name' => $bcTitle]
        ],
])

<section class="shelf" data-shelf>
    <div class="shelf__wrap">
        @if($shelf->isNotEmpty())
            <nav class="rail" aria-label="{{ __('frontend.catalog.categories') }}">
                <a href="{{ route('product-lists') }}" class="rail__item {{ $activeSlug ? '' : 'is-current' }}" @unless($activeSlug) aria-current="page" @endunless>
                    <span class="rail__mark rail__mark--all" aria-hidden="true"><i class="fas fa-border-all"></i></span>
                    <span class="rail__name">{{ __('frontend.catalog.show_all') }}</span>
                    <span class="rail__count">{{ $shelfAll }}</span>
                </a>
                @foreach($shelf as $cat)
                    <a href="{{ route('product-lists', $cat->slug) }}" class="rail__item cat-n{{ $loop->index % 5 }} {{ $activeSlug === $cat->slug ? 'is-current' : '' }}" @if($activeSlug === $cat->slug) aria-current="page" @endif>
                        <span class="rail__mark" aria-hidden="true"></span>
                        <span class="rail__name">{{ $cat->title }}</span>
                        <span class="rail__count">{{ $shelfCounts[$cat->id] ?? 0 }}</span>
                    </a>
                @endforeach
            </nav>
        @endif

        @if($products->count())
            <div class="finder" data-finder>
                <div class="finder__row">
                    <label class="finder__search" for="shelf-q">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <span class="vh">{{ __('frontend.catalog.search') }}</span>
                        <input type="search" id="shelf-q" class="finder__q" placeholder="{{ __('frontend.catalog.search_placeholder') }}" autocomplete="off" data-shelf-q>
                        <kbd class="finder__key" aria-hidden="true">/</kbd>
                    </label>

                    <div class="finder__sort" role="radiogroup" aria-label="{{ __('frontend.catalog.sort') }}">
                        @foreach($sorts as $key => $label)
                            <button type="button" class="finder__opt {{ $key === 'default' ? 'is-on' : '' }}" role="radio" aria-checked="{{ $key === 'default' ? 'true' : 'false' }}" data-shelf-sort="{{ $key }}">{{ $label }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="finder__row finder__row--sub">
                    <p class="finder__count" aria-live="polite">
                        <span data-shelf-count data-template="{{ __('frontend.catalog.count') }}">{{ __('frontend.catalog.count', ['shown' => $products->count(), 'total' => $products->count()]) }}</span>
                        <button type="button" class="finder__reset" hidden data-shelf-reset>
                            <i class="fas fa-undo-alt" aria-hidden="true"></i>{{ __('frontend.catalog.clear') }}
                        </button>
                    </p>
                </div>
            </div>

            <ul class="books" data-shelf-grid>
                @foreach($products as $course)
                    @php
                        $pimg = $course->photo ? explode(',', $course->photo)[0] : null;
                        $courseLevels = $course->levels ?? collect();
                        $lvCount = $courseLevels->count();
                        $minPoints = $lvCount ? $courseLevels->min('price_in_points') : 0;
                        $catInfo = $course->cat_info;
                        $catTitle = optional($catInfo)->title;
                        $catIndex = $catInfo ? $shelf->search(fn ($c) => $c->id === $catInfo->id) : false;
                    @endphp
                    <li class="book {{ $catIndex !== false ? 'cat-n' . ($catIndex % 5) : '' }}" data-shelf-item data-title="{{ \Illuminate\Support\Str::lower($course->title) }}" data-price="{{ $minPoints ?: 0 }}" data-order="{{ $loop->index }}" style="--i: {{ $loop->index % 9 }}">
                        <a href="{{ route('product-detail', $course->slug) }}" class="book__link">
                            <span class="book__media">
                                @if($pimg)
                                    <img src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="750" loading="{{ $loop->index < 3 ? 'eager' : 'lazy' }}" decoding="async">
                                @else
                                    <span class="book__blank" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                                @endif
                                @if($lvCount)
                                    <span class="book__count">{{ trans_choice('frontend.catalog.levels', $lvCount, ['count' => $lvCount]) }}</span>
                                @endif
                            </span>

                            <span class="book__body">
                                @if($catTitle)
                                    <span class="book__cat"><span class="book__mark" aria-hidden="true"></span>{{ $catTitle }}</span>
                                @endif
                                <span class="book__title">{{ $course->title }}</span>

                                @if($course->summary)
                                    <span class="book__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 140) }}</span>
                                @endif


                                <span class="book__foot">
                                    @if($minPoints)
                                        <span class="book__price">
                                            <small>{{ __('frontend.catalog.from') }}</small>
                                            <strong>{{ number_format($minPoints) }}</strong>
                                            <em>{{ __('frontend.catalog.credits') }}</em>
                                        </span>
                                    @else
                                        <span class="book__price book__price--soon"><small>{{ __('frontend.catalog.no_levels') }}</small></span>
                                    @endif
                                    <span class="book__go" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
                                    <span class="vh">{{ __('frontend.catalog.open') }}</span>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="nomatch" hidden data-shelf-none>
                <span class="nomatch__icon" aria-hidden="true"><i class="fas fa-filter"></i></span>
                <p class="nomatch__text">{{ __('frontend.catalog.no_results') }}</p>
                <button type="button" class="btn btn--outline btn--sm" data-shelf-reset>
                    <i class="fas fa-undo-alt" aria-hidden="true"></i>{{ __('frontend.catalog.clear') }}
                </button>
            </div>

            @if($isPaginator && $products->hasPages())
                <nav class="pager" aria-label="{{ __('frontend.catalog.pages') }}">
                    @if($products->onFirstPage())
                        <span class="pager__step is-off" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i> {{ __('frontend.catalog.prev') }}</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="pager__step"><i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i> {{ __('frontend.catalog.prev') }}</a>
                    @endif

                    @if(method_exists($products, 'lastPage'))
                        <span class="pager__nums">
                            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if($page == $products->currentPage())
                                    <span class="pager__num is-current" aria-current="page">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="pager__num">{{ $page }}</a>
                                @endif
                            @endforeach
                        </span>
                    @endif

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="pager__step">{{ __('frontend.catalog.next') }} <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i></a>
                    @else
                        <span class="pager__step is-off" aria-hidden="true">{{ __('frontend.catalog.next') }} <i class="fas fa-long-arrow-alt-right"></i></span>
                    @endif
                </nav>
            @endif
        @else
            <div class="nomatch nomatch--page">
                <span class="nomatch__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                <h2 class="nomatch__title">{{ __('frontend.catalog.empty_title') }}</h2>
                <p class="nomatch__text">{{ __('frontend.catalog.empty_text') }}</p>
                <a href="{{ route('product-lists') }}" class="btn">{{ __('frontend.catalog.browse_all') }}</a>
            </div>
        @endif

        <aside class="boost">
            <div class="boost__copy">
                <p class="boost__title">{{ __('frontend.catalog.credits_title') }}</p>
                <p class="boost__text">{{ __('frontend.catalog.credits_text') }}</p>
            </div>
            <ul class="boost__tiers" aria-hidden="true">
                <li>x1</li>
                <li>x2</li>
                <li>x2.5</li>
                <li>x3</li>
            </ul>
            <a href="{{ route('points.topup') }}" class="btn btn--light boost__go">
                <i class="fas fa-coins" aria-hidden="true"></i>
                {{ __('frontend.catalog.credits_btn') }}
            </a>
        </aside>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var root = document.querySelector('[data-shelf]');
    var grid = root ? root.querySelector('[data-shelf-grid]') : null;
    if (!grid) { return; }

    var items = Array.prototype.slice.call(grid.querySelectorAll('[data-shelf-item]'));
    var query = root.querySelector('[data-shelf-q]');
    var count = root.querySelector('[data-shelf-count]');
    var none = root.querySelector('[data-shelf-none]');
    var resets = root.querySelectorAll('[data-shelf-reset]');
    var sorts = Array.prototype.slice.call(root.querySelectorAll('[data-shelf-sort]'));
    var template = count ? count.dataset.template : '';

    function apply() {
        var term = (query.value || '').trim().toLowerCase();
        var shown = 0;
        items.forEach(function (item) {
            item.hidden = !(!term || item.dataset.title.indexOf(term) !== -1);
            if (!item.hidden) { shown++; }
        });
        if (count) {
            count.textContent = template.replace(':shown', shown).replace(':total', items.length);
        }
        none.hidden = shown !== 0;
        var dirty = !!term;
        resets.forEach(function (btn) { if (btn.closest('.finder')) { btn.hidden = !dirty; } });
    }

    query.addEventListener('input', apply);

    sorts.forEach(function (option) {
        option.addEventListener('click', function () {
            var key = option.dataset.shelfSort;
            var sorted = items.slice().sort(function (a, b) {
                var pa = parseFloat(a.dataset.price) || Infinity;
                var pb = parseFloat(b.dataset.price) || Infinity;
                if (key === 'az') { return a.dataset.title.localeCompare(b.dataset.title); }
                if (key === 'low') { return pa - pb; }
                if (key === 'high') { return (pb === Infinity ? -1 : pb) - (pa === Infinity ? -1 : pa); }
                return a.dataset.order - b.dataset.order;
            });
            grid.classList.add('is-shuffling');
            sorted.forEach(function (item) { grid.appendChild(item); });
            setTimeout(function () { grid.classList.remove('is-shuffling'); }, 400);
            sorts.forEach(function (other) {
                var on = other === option;
                other.classList.toggle('is-on', on);
                other.setAttribute('aria-checked', on ? 'true' : 'false');
            });
        });
    });

    resets.forEach(function (btn) {
        btn.addEventListener('click', function () {
            query.value = '';
            apply();
            query.focus();
        });
    });

    document.addEventListener('keydown', function (event) {
        var tag = (event.target.tagName || '').toLowerCase();
        if (event.key === '/' && tag !== 'input' && tag !== 'textarea' && !event.target.isContentEditable) {
            event.preventDefault();
            query.focus();
        }
    });

    apply();
}());
</script>
@endpush
