@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', __('frontend.catalog.meta'))
@else
    @section('title', __('frontend.catalog.page_name'))
    @section('description', __('frontend.catalog.meta'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('frontend.catalog.page_name');
    $isPaginator = $products instanceof \Illuminate\Pagination\AbstractPaginator;
    $totalCourses = $isPaginator && method_exists($products, 'total') ? $products->total() : $products->count();
    $sorts = [
        'default' => __('frontend.catalog.sort_default'),
        'az'      => __('frontend.catalog.sort_az'),
        'low'     => __('frontend.catalog.sort_low'),
        'high'    => __('frontend.catalog.sort_high'),
    ];
    $libTone = function ($cat, $index) {
        $name = mb_strtolower($cat->title . ' ' . $cat->slug);
        if (str_contains($name, 'writ')) { return 'writing'; }
        if (str_contains($name, 'lang')) { return 'language'; }
        return $index % 2 === 0 ? 'writing' : 'language';
    };
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => $bcTitle,
    'links' => $isCat
        ? [
            ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
            ['name' => __('frontend.catalog.page_name'), 'url' => route('product-lists')],
            ['name' => $bcTitle]
        ]
        : [
            ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
            ['name' => $bcTitle]
        ],
])

<section class="lib" data-lib>
    <div class="lib__wrap">
        @if($products->count())
            <div class="lib__bar" data-lib-bar>
                <label class="lib__search" for="lib-q">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <span class="vh">{{ __('frontend.catalog.search_label') }}</span>
                    <input type="search" id="lib-q" class="lib__q" placeholder="{{ __('frontend.catalog.search_hint') }}" autocomplete="off" data-lib-q>
                </label>

                <div class="lib__drop" data-lib-drop>
                    <button type="button" class="lib__tool" aria-expanded="false" aria-controls="lib-sort" data-lib-trigger>
                        <i class="fas fa-sort-amount-down" aria-hidden="true"></i>
                        <span data-lib-sort-label>{{ $sorts['default'] }}</span>
                        <i class="fas fa-chevron-down lib__chev" aria-hidden="true"></i>
                    </button>
                    <div class="lib__menu" id="lib-sort" role="listbox" aria-label="{{ __('frontend.catalog.sort_label') }}">
                        @foreach($sorts as $key => $label)
                            <button type="button" class="lib__opt {{ $key === 'default' ? 'is-active' : '' }}" role="option" aria-selected="{{ $key === 'default' ? 'true' : 'false' }}" data-lib-sort="{{ $key }}" style="--i: {{ $loop->index }}">
                                <span>{{ $label }}</span>
                                <i class="fas fa-check lib__tick" aria-hidden="true"></i>
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="lib__views" role="group" aria-label="{{ __('frontend.catalog.view_label') }}">
                    <button type="button" class="lib__view is-active" aria-pressed="true" aria-label="{{ __('frontend.catalog.view_grid') }}" data-lib-view="grid"><i class="fas fa-th-large" aria-hidden="true"></i></button>
                    <button type="button" class="lib__view" aria-pressed="false" aria-label="{{ __('frontend.catalog.view_list') }}" data-lib-view="list"><i class="fas fa-list" aria-hidden="true"></i></button>
                </div>
            </div>

            <ul class="lib__grid" data-lib-grid>
                @foreach($products as $course)
                    @php
                        $pimg = $course->photo ? explode(',', $course->photo)[0] : null;
                        $lvCount = $course->levels ? $course->levels->count() : 0;
                        $minPoints = $lvCount ? $course->levels->min('price_in_points') : 0;
                        $catInfo = $course->cat_info;
                        $catTitle = optional($catInfo)->title;
                        $tone = $catInfo ? $libTone($catInfo, 0) : 'writing';
                    @endphp
                    <li class="mat mat--{{ $tone }}" data-lib-item data-title="{{ \Illuminate\Support\Str::lower($course->title) }}" data-price="{{ $minPoints ?: 0 }}" data-order="{{ $loop->index }}" style="--i: {{ $loop->index % 9 }}">
                        <a href="{{ route('product-detail', $course->slug) }}" class="mat__link">
                            <span class="mat__media">
                                @if($pimg)
                                    <img src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="896" loading="{{ $loop->index < 3 ? 'eager' : 'lazy' }}" decoding="async">
                                @else
                                    <span class="mat__empty" aria-hidden="true"><i class="fas fa-book-open"></i></span>
                                @endif
                                @if($catTitle)
                                    <span class="mat__cat">{{ $catTitle }}</span>
                                @endif
                            </span>

                            <span class="mat__body">
                                <span class="mat__title">{{ $course->title }}</span>

                                @if($course->summary)
                                    <span class="mat__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 120) }}</span>
                                @endif

                                @if($lvCount)
                                    <span class="mat__levels">
                                        <span class="mat__meter" aria-hidden="true">
                                            @for($b = 1; $b <= min($lvCount, 6); $b++)
                                                <span style="--b: {{ $b }}"></span>
                                            @endfor
                                        </span>
                                        <span class="mat__lv">{{ trans_choice('frontend.catalog.level_count', $lvCount, ['count' => $lvCount]) }}</span>
                                    </span>
                                @endif

                                <span class="mat__foot">
                                    @if($minPoints)
                                        <span class="mat__price">
                                            <small>{{ __('frontend.catalog.price_from') }}</small>
                                            <strong>{{ number_format($minPoints) }} <em>{{ __('frontend.catalog.price_unit') }}</em></strong>
                                        </span>
                                    @else
                                        <span class="mat__price"><small>{{ __('frontend.catalog.levels_soon') }}</small></span>
                                    @endif
                                    <span class="mat__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                    <span class="vh">{{ __('frontend.catalog.card_open') }}</span>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="lib__none" hidden data-lib-none>
                <span class="lib__none-icon" aria-hidden="true"><i class="fas fa-search"></i></span>
                <p>{{ __('frontend.catalog.no_match') }}</p>
            </div>

            @if($isPaginator && $products->hasPages())
                <nav class="lib__pages" aria-label="{{ __('frontend.catalog.pager_label') }}">
                    @if($products->onFirstPage())
                        <span class="lib__page is-off" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="lib__page" aria-label="{{ __('frontend.catalog.pager_prev') }}"><i class="fas fa-chevron-left" aria-hidden="true"></i></a>
                    @endif

                    @if(method_exists($products, 'lastPage'))
                        @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            @if($page == $products->currentPage())
                                <span class="lib__page is-current" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="lib__page">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="lib__page" aria-label="{{ __('frontend.catalog.pager_next') }}"><i class="fas fa-chevron-right" aria-hidden="true"></i></a>
                    @else
                        <span class="lib__page is-off" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                    @endif
                </nav>
            @endif
        @else
            <div class="ct__empty">
                <span class="ct__empty-icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                <h2 class="ct__empty-title">{{ __('frontend.catalog.empty_head') }}</h2>
                <p class="ct__empty-text">{{ __('frontend.catalog.empty_text') }}</p>
                <div class="ct__empty-acts">
                    <a href="{{ route('product-lists') }}" class="btn">{{ __('frontend.catalog.filter_all') }}</a>
                </div>
            </div>
        @endif

        <a href="{{ route('points.topup') }}" class="lib__promo">
            <span class="lib__promo-tiles" aria-hidden="true">
                <span><i class="fas fa-wallet"></i></span>
                <span><i class="fas fa-pen-nib"></i></span>
                <span><i class="fas fa-microphone"></i></span>
            </span>
            <span class="lib__promo-text">
                <strong>{{ __('frontend.catalog.promo_head') }}</strong>
                <span>{{ __('frontend.catalog.promo_body') }}</span>
            </span>
            <span class="lib__promo-go">
                {{ __('frontend.catalog.promo_go') }}
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </span>
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var root = document.querySelector('[data-lib]');
    if (!root) { return; }

    var drops = Array.prototype.slice.call(root.querySelectorAll('[data-lib-drop]'));

    function setDrop(drop, open) {
        drop.classList.toggle('is-open', open);
        var trigger = drop.querySelector('[data-lib-trigger]');
        if (trigger) { trigger.setAttribute('aria-expanded', open ? 'true' : 'false'); }
    }

    drops.forEach(function (drop) {
        var trigger = drop.querySelector('[data-lib-trigger]');
        trigger.addEventListener('click', function (event) {
            event.stopPropagation();
            var open = !drop.classList.contains('is-open');
            drops.forEach(function (other) { setDrop(other, false); });
            setDrop(drop, open);
        });
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('[data-lib-drop]')) {
            drops.forEach(function (drop) { setDrop(drop, false); });
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') { drops.forEach(function (drop) { setDrop(drop, false); }); }
    });

    var grid = root.querySelector('[data-lib-grid]');
    if (!grid) { return; }

    var bar = root.querySelector('[data-lib-bar]');
    var head = document.querySelector('[data-hd]');
    function dock() {
        if (!bar) { return; }
        var edge = head ? Math.max(head.getBoundingClientRect().bottom, 0) : 0;
        bar.style.top = Math.round(edge) + 'px';
    }
    window.addEventListener('scroll', dock, { passive: true });
    window.addEventListener('resize', dock);
    dock();

    var items = Array.prototype.slice.call(grid.querySelectorAll('[data-lib-item]'));
    var query = root.querySelector('[data-lib-q]');
    var shown = root.querySelector('[data-lib-shown]');
    var none = root.querySelector('[data-lib-none]');
    var sortLabel = root.querySelector('[data-lib-sort-label]');

    function filter() {
        var term = (query.value || '').trim().toLowerCase();
        var count = 0;
        items.forEach(function (item) {
            var match = !term || item.dataset.title.indexOf(term) !== -1;
            item.hidden = !match;
            if (match) { count++; }
        });
        if (shown) { shown.textContent = count; }
        none.hidden = count !== 0;
    }

    query.addEventListener('input', filter);

    root.querySelectorAll('[data-lib-sort]').forEach(function (option) {
        option.addEventListener('click', function () {
            var key = option.dataset.libSort;
            var sorted = items.slice().sort(function (a, b) {
                var pa = parseFloat(a.dataset.price) || Infinity;
                var pb = parseFloat(b.dataset.price) || Infinity;
                if (key === 'az') { return a.dataset.title.localeCompare(b.dataset.title); }
                if (key === 'low') { return pa - pb; }
                if (key === 'high') { return (pb === Infinity ? -1 : pb) - (pa === Infinity ? -1 : pa); }
                return a.dataset.order - b.dataset.order;
            });
            sorted.forEach(function (item) { grid.appendChild(item); });
            root.querySelectorAll('[data-lib-sort]').forEach(function (other) {
                var on = other === option;
                other.classList.toggle('is-active', on);
                other.setAttribute('aria-selected', on ? 'true' : 'false');
            });
            sortLabel.textContent = option.textContent.trim();
            drops.forEach(function (drop) { setDrop(drop, false); });
        });
    });

    root.querySelectorAll('[data-lib-view]').forEach(function (button) {
        button.addEventListener('click', function () {
            var list = button.dataset.libView === 'list';
            grid.classList.toggle('is-list', list);
            root.querySelectorAll('[data-lib-view]').forEach(function (other) {
                var on = other === button;
                other.classList.toggle('is-active', on);
                other.setAttribute('aria-pressed', on ? 'true' : 'false');
            });
        });
    });
}());
</script>
@endpush
