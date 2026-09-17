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

{{-- ==========================================================================
     Course catalogue
     Category lead, then a card grid on the drawn canvas, closed by the
     category row (see design/DESIGN.md — section 7).
     Styles: public/css/theme.css — section 23
     ========================================================================== --}}
<section class="pl">

    @include('frontend.layouts.form-canvas')

    <div class="pl__wrap">

        {{-- Category lead: cover, count and description --}}
        @php $plCover = $isCat && !empty($category->photo) ? ltrim($category->photo, '/') : null; @endphp
        <div class="pl-head {{ $plCover ? 'pl-head--cover' : '' }}">
            @if($plCover)
                <div class="pl-head__media">
                    <img src="{{ asset($plCover) }}" alt="" fetchpriority="high" decoding="async">
                </div>
            @endif

            <div class="pl-head__text">
                <p class="pl-head__count">
                    <strong>{{ $totalCourses }}</strong>
                    {{ trans_choice('frontend.catalog.count', $totalCourses) }}
                </p>
                <p class="pl-head__desc">{{ $isCat && $category->summary ? $category->summary : __('frontend.catalog.intro') }}</p>
            </div>
        </div>

        @if($products->count())
            {{-- Course cards: 16:9 still, unified badges, credit price --}}
            <ul class="pl-index">
                @foreach($products as $index => $course)
                    @php
                        $pimg = $course->photo ? explode(',', $course->photo)[0] : null;
                        $levelCount = $course->levels ? $course->levels->count() : 0;
                        $minPoints = $levelCount ? $course->levels->min('price_in_points') : 0;
                        $catTitle = optional($course->cat_info)->title;
                    @endphp
                    <li class="pl-card">
                        <a href="{{ route('product-detail', $course->slug) }}" class="pl-card__link">
                            <span class="pl-card__media">
                                @if($pimg)
                                    <img src="{{ url($pimg) }}" alt="" loading="lazy" decoding="async">
                                @else
                                    <span class="pl-card__placeholder" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                                @endif
                            </span>

                            <span class="pl-card__tags">
                                @if($catTitle)
                                    <span class="badge">{{ $catTitle }}</span>
                                @endif
                                @if($levelCount)
                                    <span class="badge badge--brand">
                                        <i class="fas fa-signal" aria-hidden="true"></i>
                                        {{ trans_choice('frontend.catalog.levels', $levelCount, ['count' => $levelCount]) }}
                                    </span>
                                @endif
                            </span>

                            <span class="pl-card__title">{{ $course->title }}</span>

                            @if($course->summary)
                                <span class="pl-card__summary">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 110) }}</span>
                            @endif

                            <span class="pl-card__foot">
                                @if($levelCount)
                                    <span class="pl-card__price">
                                        <i class="fas fa-bolt" aria-hidden="true"></i>
                                        <span class="pl-card__from">{{ __('frontend.catalog.from') }}</span>
                                        <strong>{{ number_format($minPoints) }}</strong>
                                        {{ __('frontend.catalog.credits') }}
                                    </span>
                                @else
                                    <span class="pl-card__price">{{ __('frontend.catalog.no_levels') }}</span>
                                @endif

                                <span class="pl-card__cta">
                                    {{ __('frontend.catalog.view') }}
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </span>
                            </span>
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
