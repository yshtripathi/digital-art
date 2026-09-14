@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('frontend.catalog.title'))
    @section('description', __('frontend.catalog.description'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('frontend.catalog.title');
    $allCategories = \App\Models\Category::where('status','active')
        ->where('is_parent',1)
        ->orderBy('title','ASC')
        ->get();
    $isPaginator = $products instanceof \Illuminate\Pagination\AbstractPaginator;
    $totalCourses = $isPaginator && method_exists($products, 'total') ? $products->total() : $products->count();
@endphp

@php
    $bcData = [
        'title' => $bcTitle,
        'links' => [
            ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
            ['name' => __('frontend.catalog.title'), 'url' => route('product-lists')],
            ['name' => $bcTitle]
        ],
    ];
    // Category pages show the category photo in the banner
    if ($isCat && !empty($category->photo)) {
        $bcData['image'] = ltrim($category->photo, '/');
    }
@endphp
@include('frontend.layouts.breadcrumb', $bcData)

<section class="pl">
    <div class="pl__wrap">

        {{-- Intro + category navigation --}}
        <div class="pl-intro">
            <div class="pl-intro__text">
                <span class="pl-intro__count"><strong>{{ $totalCourses }}</strong> {{ trans_choice('frontend.catalog.count', $totalCourses) }}</span>
                <p class="pl-intro__desc">{{ $isCat && $category->summary ? $category->summary : __('frontend.catalog.intro') }}</p>
            </div>

            @if($allCategories->count())
                <nav class="pl-cats" aria-label="{{ __('frontend.catalog.cats_label') }}">
                    <a href="{{ route('product-lists') }}" class="pl-cats__pill {{ $isCat ? '' : 'is-active' }}">
                        <i class="fas fa-th-large"></i> {{ __('frontend.catalog.all') }}
                    </a>
                    @foreach($allCategories as $cat)
                        <a href="{{ route('product-lists', $cat->slug) }}" class="pl-cats__pill {{ $isCat && $category->id == $cat->id ? 'is-active' : '' }}">
                            {{ $cat->title }}
                        </a>
                    @endforeach
                </nav>
            @endif
        </div>

        @if($products->count())
            {{-- Toolbar (filters the courses on this page) --}}
            <div class="pl-toolbar">
                <label class="pl-search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search" id="plSearch" placeholder="{{ __('frontend.catalog.search_ph') }}" aria-label="{{ __('frontend.catalog.search_label') }}">
                </label>

                <div class="pl-toolbar__right">
                    <span class="pl-showing" id="plShowing">{{ __('frontend.catalog.showing') }} <strong>{{ $products->count() }}</strong></span>
                    <label class="pl-sort">
                        <span>{{ __('frontend.catalog.sort') }}</span>
                        <select id="plSort">
                            <option value="default">{{ __('frontend.catalog.sort_default') }}</option>
                            <option value="az">{{ __('frontend.catalog.sort_az') }}</option>
                            <option value="low">{{ __('frontend.catalog.sort_low') }}</option>
                            <option value="high">{{ __('frontend.catalog.sort_high') }}</option>
                        </select>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </label>
                </div>
            </div>

            {{-- Course grid --}}
            <ul class="pl-grid" id="plGrid">
                @foreach($products as $index => $course)
                    @php
                        $pimg = $course->photo ? explode(',', $course->photo)[0] : null;
                        $levelCount = $course->levels ? $course->levels->count() : 0;
                        $minPoints = $levelCount ? $course->levels->min('price_in_points') : 0;
                        $catTitle = optional($course->cat_info)->title;
                    @endphp
                    <li class="pl-card-wrap" data-title="{{ \Illuminate\Support\Str::lower($course->title) }}" data-price="{{ (int) $minPoints }}" data-index="{{ $index }}">
                        <a href="{{ route('product-detail', $course->slug) }}" class="pl-card">
                            <div class="pl-card__media">
                                @if($pimg)
                                    <img src="{{ url($pimg) }}" alt="{{ $course->title }}" loading="lazy">
                                @else
                                    <span class="pl-card__placeholder"><i class="fas fa-graduation-cap"></i></span>
                                @endif
                                @if($catTitle)
                                    <span class="pl-card__cat">{{ $catTitle }}</span>
                                @endif
                            </div>

                            <div class="pl-card__body">
                                @if($levelCount)
                                    <span class="pl-card__levels"><i class="fas fa-signal"></i> {{ trans_choice('frontend.catalog.levels', $levelCount, ['count' => $levelCount]) }}</span>
                                @endif
                                <h3 class="pl-card__title">{{ $course->title }}</h3>
                                @if($course->summary)
                                    <p class="pl-card__summary">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 140) }}</p>
                                @endif

                                <div class="pl-card__foot">
                                    @if($levelCount)
                                        <span class="pl-card__price">
                                            <small>{{ __('frontend.catalog.from') }}</small>
                                            <strong><i class="fas fa-coins"></i> {{ number_format($minPoints) }}</strong>
                                            <small>{{ __('frontend.catalog.credits') }}</small>
                                        </span>
                                    @else
                                        <span class="pl-card__price"><strong class="pl-card__free">{{ __('frontend.catalog.no_levels') }}</strong></span>
                                    @endif
                                    <span class="pl-card__go" aria-hidden="true" title="{{ __('frontend.catalog.view') }}"><i class="fas fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="pl-nomatch" id="plNoMatch" hidden>
                <i class="fas fa-search"></i>
                <p>{{ __('frontend.catalog.no_match') }}</p>
                <button type="button" class="pl-btn pl-btn--dark" id="plClear">{{ __('frontend.catalog.clear') }}</button>
            </div>

            {{-- Pagination --}}
            @if($isPaginator && $products->hasPages())
                <nav class="pl-pages" aria-label="{{ __('frontend.catalog.pagination') }}">
                    @if($products->onFirstPage())
                        <span class="pl-pages__btn is-disabled"><i class="fas fa-arrow-left"></i> {{ __('frontend.catalog.prev') }}</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="pl-pages__btn"><i class="fas fa-arrow-left"></i> {{ __('frontend.catalog.prev') }}</a>
                    @endif

                    @if(method_exists($products, 'lastPage'))
                        <div class="pl-pages__nums">
                            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if($page == $products->currentPage())
                                    <span class="pl-pages__num is-current" aria-current="page">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="pl-pages__num">{{ $page }}</a>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="pl-pages__btn">{{ __('frontend.catalog.next') }} <i class="fas fa-arrow-right"></i></a>
                    @else
                        <span class="pl-pages__btn is-disabled">{{ __('frontend.catalog.next') }} <i class="fas fa-arrow-right"></i></span>
                    @endif
                </nav>
            @endif
        @else
            <div class="cp-empty pl-empty">
                <div class="cp-empty__art" aria-hidden="true">
                    <span class="cp-empty__ring"></span>
                    <span class="cp-empty__icon"><i class="fas fa-box-open"></i></span>
                    <span class="cp-empty__dot cp-empty__dot--1"></span>
                    <span class="cp-empty__dot cp-empty__dot--2"></span>
                    <span class="cp-empty__dot cp-empty__dot--3"></span>
                </div>
                <h2 class="cp-empty__title">{{ __('frontend.catalog.empty_title') }}</h2>
                <p class="cp-empty__desc">{{ __('frontend.catalog.empty_desc') }}</p>
                <div class="cp-empty__actions">
                    <a href="{{ route('product-lists') }}" class="cp-btn cp-btn--dark"><i class="fas fa-th-large"></i> {{ __('frontend.catalog.all') }}</a>
                </div>
            </div>
        @endif

        {{-- Category tiles --}}
        @if($allCategories->count())
            <div class="pl-other">
                <h2 class="pl-other__title">{{ __('frontend.catalog.other') }}</h2>
                <ul class="pl-tiles">
                    @foreach($allCategories as $i => $cat)
                        <li>
                            <a href="{{ route('product-lists', $cat->slug) }}" class="pl-tile pl-tile--{{ ($i % 4) + 1 }} {{ $isCat && $category->id == $cat->id ? 'is-active' : '' }}">
                                <span class="pl-tile__icon">
                                    @if($cat->photo)
                                        <img src="{{ asset(ltrim($cat->photo, '/')) }}" alt="" loading="lazy">
                                    @else
                                        <i class="fas fa-layer-group"></i>
                                    @endif
                                </span>
                                <span class="pl-tile__title">{{ $cat->title }}</span>
                                <span class="pl-tile__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
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
    // Search + sort the courses already on this page (no server requests)
    document.addEventListener('DOMContentLoaded', function () {
        var grid = document.getElementById('plGrid');
        if (!grid) return;
        var search = document.getElementById('plSearch');
        var sort = document.getElementById('plSort');
        var showing = document.querySelector('#plShowing strong');
        var noMatch = document.getElementById('plNoMatch');
        var clear = document.getElementById('plClear');
        var items = Array.prototype.slice.call(grid.children);

        function apply() {
            var q = (search.value || '').trim().toLowerCase();
            var visible = 0;
            items.forEach(function (li) {
                var show = !q || li.dataset.title.indexOf(q) !== -1;
                li.hidden = !show;
                if (show) visible++;
            });

            var sorted = items.slice();
            if (sort.value === 'az') sorted.sort(function (a, b) { return a.dataset.title.localeCompare(b.dataset.title); });
            else if (sort.value === 'low') sorted.sort(function (a, b) { return a.dataset.price - b.dataset.price; });
            else if (sort.value === 'high') sorted.sort(function (a, b) { return b.dataset.price - a.dataset.price; });
            else sorted.sort(function (a, b) { return a.dataset.index - b.dataset.index; });
            sorted.forEach(function (li) { grid.appendChild(li); });

            showing.textContent = visible;
            noMatch.hidden = visible !== 0;
            grid.hidden = visible === 0;
        }

        search.addEventListener('input', apply);
        sort.addEventListener('change', apply);
        clear.addEventListener('click', function () { search.value = ''; apply(); search.focus(); });

        // Prefill from the homepage search (?q=...)
        var q = new URLSearchParams(window.location.search).get('q');
        if (q) { search.value = q; apply(); }
    });
</script>
@endpush
