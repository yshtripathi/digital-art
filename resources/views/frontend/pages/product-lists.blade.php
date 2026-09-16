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

@include('frontend.layouts.breadcrumb', [
    'title' => $bcTitle,
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.catalog.title'), 'url' => route('product-lists')],
        ['name' => $bcTitle]
    ],
])

<section class="pl">
    <div class="pl__wrap">

        {{-- Category rail --}}
        @if($allCategories->count())
            <nav class="pl-rail" aria-label="{{ __('frontend.catalog.cats_label') }}">
                <a href="{{ route('product-lists') }}" class="pl-rail__item {{ $isCat ? '' : 'is-active' }}" @if(!$isCat) aria-current="page" @endif>
                    {{ __('frontend.catalog.all') }}
                </a>
                @foreach($allCategories as $cat)
                    <a href="{{ route('product-lists', $cat->slug) }}" class="pl-rail__item {{ $isCat && $category->id == $cat->id ? 'is-active' : '' }}" @if($isCat && $category->id == $cat->id) aria-current="page" @endif>
                        {{ $cat->title }}
                    </a>
                @endforeach
            </nav>
        @endif

        {{-- Count, intro and sort. Category pages lead with the category still. --}}
        @php $plCover = $isCat && !empty($category->photo) ? ltrim($category->photo, '/') : null; @endphp
        <div class="pl-head {{ $plCover ? 'pl-head--cover' : '' }}">
            @if($plCover)
                <div class="pl-head__media">
                    <img src="{{ asset($plCover) }}" alt="" fetchpriority="high" decoding="async">
                </div>
            @endif

            <div class="pl-head__text">
                <p class="pl-head__count">
                    <strong id="plShowing">{{ $totalCourses }}</strong>
                    {{ trans_choice('frontend.catalog.count', $totalCourses) }}
                </p>
                <p class="pl-head__desc">{{ $isCat && $category->summary ? $category->summary : __('frontend.catalog.intro') }}</p>
            </div>

            @if($products->count())
                <div class="pl-head__tools">
                    {{-- Shown only when the homepage search sent a ?q= term --}}
                    <p class="pl-filter" id="plFilter" hidden>
                        <span id="plFilterText"></span>
                        <button type="button" id="plClear" class="pl-filter__clear" aria-label="{{ __('frontend.catalog.clear') }}">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                    </p>

                    <label class="pl-sort">
                        <span class="pl-sort__label">{{ __('frontend.catalog.sort') }}</span>
                        <select id="plSort">
                            <option value="default">{{ __('frontend.catalog.sort_default') }}</option>
                            <option value="az">{{ __('frontend.catalog.sort_az') }}</option>
                            <option value="low">{{ __('frontend.catalog.sort_low') }}</option>
                            <option value="high">{{ __('frontend.catalog.sort_high') }}</option>
                        </select>
                        <i class="fas fa-chevron-down" aria-hidden="true"></i>
                    </label>
                </div>
            @endif
        </div>

        @if($products->count())
            {{-- Course index: one ruled row per course, 16:9 still on the lead edge --}}
            <ul class="pl-index" id="plGrid">
                @foreach($products as $index => $course)
                    @php
                        $pimg = $course->photo ? explode(',', $course->photo)[0] : null;
                        $levelCount = $course->levels ? $course->levels->count() : 0;
                        $minPoints = $levelCount ? $course->levels->min('price_in_points') : 0;
                        $catTitle = optional($course->cat_info)->title;
                    @endphp
                    <li class="pl-row" data-title="{{ \Illuminate\Support\Str::lower($course->title) }}" data-price="{{ (int) $minPoints }}" data-index="{{ $index }}">
                        <a href="{{ route('product-detail', $course->slug) }}" class="pl-row__link">
                            <span class="pl-row__media">
                                @if($pimg)
                                    <img src="{{ url($pimg) }}" alt="" loading="lazy" decoding="async">
                                @else
                                    <span class="pl-row__placeholder" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                                @endif
                            </span>

                            <span class="pl-row__body">
                                @if($catTitle)
                                    <span class="pl-row__cat">{{ $catTitle }}</span>
                                @endif

                                <span class="pl-row__title">{{ $course->title }}</span>

                                @if($course->summary)
                                    <span class="pl-row__summary">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 180) }}</span>
                                @endif

                                <span class="pl-row__meta">
                                    @if($levelCount)
                                        <span class="pl-row__levels">
                                            <i class="fas fa-signal" aria-hidden="true"></i>
                                            {{ trans_choice('frontend.catalog.levels', $levelCount, ['count' => $levelCount]) }}
                                        </span>
                                        <span class="pl-row__price">
                                            {{ __('frontend.catalog.from') }}
                                            <strong>{{ number_format($minPoints) }}</strong>
                                            {{ __('frontend.catalog.credits') }}
                                        </span>
                                    @else
                                        <span class="pl-row__price">{{ __('frontend.catalog.no_levels') }}</span>
                                    @endif
                                </span>
                            </span>

                            <span class="pl-row__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Pagination --}}
            @if($isPaginator && $products->hasPages())
                <nav class="pl-pages" aria-label="{{ __('frontend.catalog.pagination') }}">
                    @if($products->onFirstPage())
                        <span class="pl-pages__btn is-disabled"><i class="fas fa-arrow-left" aria-hidden="true"></i> {{ __('frontend.catalog.prev') }}</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="pl-pages__btn"><i class="fas fa-arrow-left" aria-hidden="true"></i> {{ __('frontend.catalog.prev') }}</a>
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
                        <a href="{{ $products->nextPageUrl() }}" class="pl-pages__btn">{{ __('frontend.catalog.next') }} <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    @else
                        <span class="pl-pages__btn is-disabled">{{ __('frontend.catalog.next') }} <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                    @endif
                </nav>
            @endif
        @else
            <div class="pl-empty">
                <span class="pl-empty__icon" aria-hidden="true"><i class="fas fa-box-open"></i></span>
                <h2 class="pl-empty__title">{{ __('frontend.catalog.empty_title') }}</h2>
                <p class="pl-empty__desc">{{ __('frontend.catalog.empty_desc') }}</p>
                <a href="{{ route('product-lists') }}" class="pl-btn pl-btn--primary">{{ __('frontend.catalog.all') }}</a>
            </div>
        @endif

        {{-- Browse other categories — 16:9 stills --}}
        @if($allCategories->count())
            <section class="pl-cats">
                <h2 class="pl-cats__title">{{ __('frontend.catalog.other') }}</h2>
                <ul class="pl-cats__grid">
                    @foreach($allCategories as $cat)
                        <li>
                            <a href="{{ route('product-lists', $cat->slug) }}" class="pl-cat {{ $isCat && $category->id == $cat->id ? 'is-active' : '' }}">
                                <span class="pl-cat__media">
                                    @if($cat->photo)
                                        <img src="{{ asset(ltrim($cat->photo, '/')) }}" alt="" loading="lazy" decoding="async">
                                    @else
                                        <span class="pl-cat__placeholder" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                                    @endif
                                </span>
                                <span class="pl-cat__name">{{ $cat->title }}</span>
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
    // Sorts the courses already on this page. There is no search field here —
    // a ?q= term arriving from the homepage is applied as a removable filter.
    document.addEventListener('DOMContentLoaded', function () {
        var grid = document.getElementById('plGrid');
        if (!grid) return;

        var sort       = document.getElementById('plSort');
        var showing    = document.getElementById('plShowing');
        var filter     = document.getElementById('plFilter');
        var filterText = document.getElementById('plFilterText');
        var clear      = document.getElementById('plClear');
        var items      = Array.prototype.slice.call(grid.children);
        var term       = '';

        function apply() {
            var visible = 0;
            items.forEach(function (li) {
                var show = !term || li.dataset.title.indexOf(term) !== -1;
                li.hidden = !show;
                if (show) visible++;
            });

            var sorted = items.slice();
            if (sort.value === 'az') sorted.sort(function (a, b) { return a.dataset.title.localeCompare(b.dataset.title); });
            else if (sort.value === 'low') sorted.sort(function (a, b) { return a.dataset.price - b.dataset.price; });
            else if (sort.value === 'high') sorted.sort(function (a, b) { return b.dataset.price - a.dataset.price; });
            else sorted.sort(function (a, b) { return a.dataset.index - b.dataset.index; });
            sorted.forEach(function (li) { grid.appendChild(li); });

            if (showing) showing.textContent = visible;
        }

        function clearTerm() {
            term = '';
            filter.hidden = true;
            apply();
        }

        sort.addEventListener('change', apply);
        if (clear) clear.addEventListener('click', clearTerm);

        var q = new URLSearchParams(window.location.search).get('q');
        if (q && q.trim()) {
            term = q.trim().toLowerCase();
            filterText.textContent = q.trim();
            filter.hidden = false;
            apply();
        }
    });
</script>
@endpush
