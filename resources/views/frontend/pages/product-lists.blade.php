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

<section class="shop" data-shop>
    <div class="container">
        @if($products->count())
            <div class="shop-intro">
                <h2 class="shop-intro__title">{{ __('frontend.catalog.intro_title') }}</h2>
                <p class="shop-intro__text">{{ __('frontend.catalog.intro_text') }}</p>
            </div>

            <div class="shop-search">
                <label class="shop-search__icon" for="shop-q">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <span class="vh">{{ __('frontend.catalog.search') }}</span>
                </label>
                <input type="search" id="shop-q" class="shop-search__input" placeholder="{{ __('frontend.catalog.search_placeholder') }}" autocomplete="off" data-shop-q>
                <button type="button" class="shop-search__clear" aria-label="{{ __('frontend.catalog.clear') }}" hidden data-shop-x>
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
                <span class="shop-search__count" aria-live="polite" data-shop-count data-template="{{ __('frontend.catalog.count') }}">{{ __('frontend.catalog.count', ['shown' => $products->count(), 'total' => $products->count()]) }}</span>
            </div>

            <ul class="shop-grid" data-shop-grid>
                @foreach($products as $course)
                    @php
                        $rawImg = $course->photo ? trim(explode(',', $course->photo)[0]) : '';
                        $pimg = $rawImg !== '' && file_exists(public_path(ltrim($rawImg, '/'))) ? asset(ltrim($rawImg, '/')) : null;
                        $courseLevels = $course->levels ?? collect();
                        $lvCount = $courseLevels->count();
                        $minPoints = $lvCount ? $courseLevels->min('price_in_points') : 0;
                    @endphp
                    <li class="shop-item" data-shop-item data-title="{{ \Illuminate\Support\Str::lower($course->title) }}" style="--i: {{ $loop->index % 8 }}">
                        <a href="{{ route('product-detail', $course->slug) }}" class="shop-item__link">
                            <span class="shop-item__media media-frame {{ $pimg ? '' : 'is-empty' }}">
                                @if($pimg)
                                    <img src="{{ $pimg }}" alt="" width="800" height="800" loading="{{ $loop->index < 4 ? 'eager' : 'lazy' }}" decoding="async">
                                @else
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @endif
                                @if($lvCount)
                                    <span class="shop-item__levels"><i class="fas fa-layer-group" aria-hidden="true"></i>{{ trans_choice('frontend.catalog.levels', $lvCount, ['count' => $lvCount]) }}</span>
                                @endif
                            </span>
                            <span class="shop-item__name">{{ $course->title }}</span>
                            @if($minPoints)
                                <span class="shop-item__price">{{ __('frontend.catalog.from') }} <strong>{{ number_format($minPoints) }}</strong> {{ __('frontend.catalog.credits') }}</span>
                            @else
                                <span class="shop-item__price">{{ __('frontend.catalog.no_levels') }}</span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="shop-none" hidden data-shop-none>
                <p>{{ __('frontend.catalog.no_results') }}</p>
                <button type="button" class="btn btn--dark" data-shop-reset>{{ __('frontend.catalog.clear') }}</button>
            </div>

            @if($isPaginator && $products->hasPages())
                <nav class="shop-pager" aria-label="{{ __('frontend.catalog.pages') }}">
                    @if($products->onFirstPage())
                        <span class="shop-pager__step is-off" aria-hidden="true">{{ __('frontend.catalog.prev') }}</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="shop-pager__step">{{ __('frontend.catalog.prev') }}</a>
                    @endif

                    @if(method_exists($products, 'lastPage'))
                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if($page == $products->currentPage())
                                <span class="shop-pager__num is-current" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="shop-pager__num">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="shop-pager__step">{{ __('frontend.catalog.next') }}</a>
                    @else
                        <span class="shop-pager__step is-off" aria-hidden="true">{{ __('frontend.catalog.next') }}</span>
                    @endif
                </nav>
            @endif
        @else
            <div class="bag-empty">
                <span class="bag-empty__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                <h2 class="bag-empty__title">{{ __('frontend.catalog.empty_title') }}</h2>
                <p class="bag-empty__text">{{ __('frontend.catalog.empty_text') }}</p>
                <div class="bag-empty__acts">
                    <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.catalog.browse_all') }}</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var root = document.querySelector('[data-shop]');
    var grid = root ? root.querySelector('[data-shop-grid]') : null;
    if (!grid) { return; }

    var items = Array.prototype.slice.call(grid.querySelectorAll('[data-shop-item]'));
    var query = root.querySelector('[data-shop-q]');
    var none = root.querySelector('[data-shop-none]');
    var reset = root.querySelector('[data-shop-reset]');
    var clear = root.querySelector('[data-shop-x]');
    var count = root.querySelector('[data-shop-count]');
    var template = count ? count.dataset.template : '';

    function apply() {
        var term = (query.value || '').trim().toLowerCase();
        var shown = 0;
        items.forEach(function (item) {
            item.hidden = !(!term || item.dataset.title.indexOf(term) !== -1);
            if (!item.hidden) { shown++; }
        });
        none.hidden = shown !== 0;
        if (clear) { clear.hidden = !query.value; }
        if (count) { count.textContent = template.replace(':shown', shown).replace(':total', items.length); }
    }

    function wipe() {
        query.value = '';
        apply();
        query.focus();
    }

    query.addEventListener('input', apply);
    if (reset) { reset.addEventListener('click', wipe); }
    if (clear) { clear.addEventListener('click', wipe); }
    apply();
}());
</script>
@endpush
