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
    $allTotal = $allCategories->sum('products_count');
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

        <aside class="cg-side">
            @if($allCategories->count())
                <nav class="cg-cats" aria-labelledby="cgCatsTitle">
                    <p class="cg-cats__title" id="cgCatsTitle">{{ __('frontend.catalog.side_title') }}</p>
                    <ul class="cg-cats__list">
                        <li>
                            <a href="{{ route('product-lists') }}" class="cg-cat {{ !$isCat ? 'is-active' : '' }}" @if(!$isCat) aria-current="page" @endif>
                                <span class="cg-cat__name">{{ __('frontend.catalog.filter_all') }}</span>
                                <span class="cg-cat__count num">{{ $allTotal }}</span>
                            </a>
                        </li>
                        @foreach($allCategories as $c)
                            @php $on = $isCat && $category->id == $c->id; @endphp
                            <li>
                                <a href="{{ route('product-lists', $c->slug) }}" class="cg-cat {{ $on ? 'is-active' : '' }}" @if($on) aria-current="page" @endif>
                                    <span class="cg-cat__name">{{ $c->title }}</span>
                                    <span class="cg-cat__count num">{{ $c->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endif

            <div class="cg-promo">
                <span class="cg-promo__icon" aria-hidden="true"><i class="fas fa-coins"></i></span>
                <p class="cg-promo__title">{{ __('frontend.catalog.promo_title') }}</p>
                <p class="cg-promo__text">{{ __('frontend.catalog.promo_text') }}</p>
                <a href="{{ route('points.topup') }}" class="btn btn--primary btn--block">
                    <span>{{ __('frontend.catalog.promo_go') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </aside>

        <div class="cg-main">
            <header class="cg-bar">
                <div>
                    <p class="eyebrow">
                        <span class="num">{{ $totalCourses }}</span> {{ trans_choice('frontend.catalog.count_unit', $totalCourses) }}
                    </p>
                    <h2 class="cg-bar__title">{{ $bcTitle }}</h2>
                </div>
                @if(!$isCat)
                    <p class="cg-bar__desc">{{ __('frontend.catalog.intro') }}</p>
                @endif
            </header>

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
                                            <span class="cg-card__levels" aria-label="{{ trans_choice('frontend.catalog.level_count', $lvCount, ['count' => $lvCount]) }}">
                                                <span class="cg-card__bars" aria-hidden="true">
                                                    @for($b = 1; $b <= 4; $b++)
                                                        <span class="{{ $b <= min($lvCount, 4) ? 'is-on' : '' }}"></span>
                                                    @endfor
                                                </span>
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
                                                <strong class="num">{{ number_format($minPoints) }} <em>{{ __('frontend.catalog.price_unit') }}</em></strong>
                                            </span>
                                        @else
                                            <span class="cg-card__price"><small>{{ __('frontend.catalog.levels_soon') }}</small></span>
                                        @endif
                                        <span class="cg-card__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                        <span class="vh">{{ __('frontend.catalog.card_open') }}</span>
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
