@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', __('frontend.catalog.summary'))
@else
    @section('title', __('frontend.catalog.page_name'))
    @section('description', __('frontend.catalog.summary'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('frontend.catalog.page_name');
    $allCategories = \App\Models\Category::where('status', 'active')
        ->where('is_parent', 1)
        ->orderBy('title', 'ASC')
        ->withCount('products')
        ->get();
    $isPaginator = $products instanceof \Illuminate\Pagination\AbstractPaginator;
    $totalCourses = $isPaginator && method_exists($products, 'total') ? $products->total() : $products->count();
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => $bcTitle,
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.catalog.page_name'), 'url' => route('product-lists')],
        ['name' => $bcTitle]
    ],
])

<section class="cg">
    <div class="cg__wrap">

        <div class="cg-main">
            <header class="cg-bar">
                <div class="cg-bar__text">
                    <h2 class="cg-bar__title">{{ $bcTitle }}</h2>
                    @if(!$isCat)
                        <p class="cg-bar__desc">{{ __('frontend.catalog.intro') }}</p>
                    @endif
                </div>
                <span class="cg-bar__count">
                    <strong>{{ $totalCourses }}</strong>
                    <span>{{ trans_choice('frontend.catalog.count_unit', $totalCourses) }}</span>
                </span>
            </header>

            @if($allCategories->count())
                <nav class="cg-pills" aria-label="{{ __('frontend.catalog.filter_label') }}">
                    <a href="{{ route('product-lists') }}" class="cg-pill {{ !$isCat ? 'is-active' : '' }}" @if(!$isCat) aria-current="page" @endif>
                        {{ __('frontend.catalog.filter_all') }}
                    </a>
                    @foreach($allCategories as $c)
                        @php $on = $isCat && $category->id == $c->id; @endphp
                        <a href="{{ route('product-lists', $c->slug) }}" class="cg-pill {{ $on ? 'is-active' : '' }}" @if($on) aria-current="page" @endif>
                            {{ $c->title }}
                            <span class="cg-pill__count">{{ $c->products_count }}</span>
                        </a>
                    @endforeach
                </nav>
            @endif

            @if($products->count())
                <ul class="cg-grid">
                    @foreach($products as $course)
                        @php
                            $pimg = $course->photo ? explode(',', $course->photo)[0] : null;
                            $lvCount = $course->levels ? $course->levels->count() : 0;
                            $minPoints = $lvCount ? $course->levels->min('price_in_points') : 0;
                            $catTitle = optional($course->cat_info)->title;
                        @endphp
                        <li class="cg-card">
                            <a href="{{ route('product-detail', $course->slug) }}" class="cg-card__link">
                                <span class="cg-card__media">
                                    @if($pimg)
                                        <img src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="896" loading="lazy" decoding="async">
                                    @else
                                        <span class="cg-card__empty" aria-hidden="true"><i class="fas fa-graduation-cap"></i></span>
                                    @endif
                                </span>

                                <span class="cg-card__body">
                                    <span class="cg-card__meta">
                                        @if($catTitle)
                                            <span class="cg-card__cat">{{ $catTitle }}</span>
                                        @endif
                                        @if($lvCount)
                                            <span class="cg-card__levels">
                                                <i class="fas fa-signal" aria-hidden="true"></i>
                                                {{ trans_choice('frontend.catalog.level_count', $lvCount, ['count' => $lvCount]) }}
                                            </span>
                                        @endif
                                    </span>

                                    <span class="cg-card__title">{{ $course->title }}</span>

                                    @if($course->summary)
                                        <span class="cg-card__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 110) }}</span>
                                    @endif

                                    <span class="cg-card__foot">
                                        @if($minPoints)
                                            <span class="cg-card__price">
                                                <small>{{ __('frontend.catalog.price_from') }}</small>
                                                <strong><i class="fas fa-bolt" aria-hidden="true"></i> {{ number_format($minPoints) }}</strong>
                                                <small>{{ __('frontend.catalog.price_unit') }}</small>
                                            </span>
                                        @else
                                            <span class="cg-card__price"><small>{{ __('frontend.catalog.levels_soon') }}</small></span>
                                        @endif
                                        <span class="cg-card__go">
                                            <span class="cg-card__go-text">{{ __('frontend.catalog.card_open') }}</span>
                                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                @if($isPaginator && $products->hasPages())
                    <nav class="cg-pages" aria-label="{{ __('frontend.catalog.pager_label') }}">
                        @if($products->onFirstPage())
                            <span class="cg-pages__btn is-disabled"><i class="fas fa-arrow-left" aria-hidden="true"></i> {{ __('frontend.catalog.pager_prev') }}</span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="cg-pages__btn"><i class="fas fa-arrow-left" aria-hidden="true"></i> {{ __('frontend.catalog.pager_prev') }}</a>
                        @endif

                        @if(method_exists($products, 'lastPage'))
                            <span class="cg-pages__nums">
                                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                    @if($page == $products->currentPage())
                                        <span class="cg-pages__num is-current" aria-current="page">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="cg-pages__num">{{ $page }}</a>
                                    @endif
                                @endforeach
                            </span>
                        @endif

                        @if($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="cg-pages__btn">{{ __('frontend.catalog.pager_next') }} <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                        @else
                            <span class="cg-pages__btn is-disabled">{{ __('frontend.catalog.pager_next') }} <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                        @endif
                    </nav>
                @endif
            @else
                <div class="cg-empty">
                    <span class="cg-empty__icon" aria-hidden="true"><i class="fas fa-box-open"></i></span>
                    <h2 class="cg-empty__title">{{ __('frontend.catalog.none_title') }}</h2>
                    <p class="cg-empty__desc">{{ __('frontend.catalog.none_text') }}</p>
                    <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.catalog.filter_all') }}</a>
                </div>
            @endif
        </div>

    </div>
</section>
@endsection
