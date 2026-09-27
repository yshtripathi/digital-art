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
    @if($allCategories->count())
        <nav class="cg-rail" aria-labelledby="cgCatsTitle">
            <div class="cg-rail__in">
                <p class="vh" id="cgCatsTitle">{{ __('frontend.catalog.areas') }}</p>
                <ul class="cg-rail__list">
                    <li>
                        <a href="{{ route('product-lists') }}" class="cg-chip {{ !$isCat ? 'is-active' : '' }}" @if(!$isCat) aria-current="page" @endif>
                            <i class="fas fa-th-large" aria-hidden="true"></i>
                            <span>{{ __('frontend.catalog.filter_all') }}</span>
                            <span class="cg-chip__count num">{{ $allTotal }}</span>
                        </a>
                    </li>
                    @foreach($allCategories as $c)
                        @php $on = $isCat && $category->id == $c->id; @endphp
                        <li>
                            <a href="{{ route('product-lists', $c->slug) }}" class="cg-chip {{ $on ? 'is-active' : '' }}" @if($on) aria-current="page" @endif>
                                <span>{{ $c->title }}</span>
                                <span class="cg-chip__count num">{{ $c->products_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    @endif

    <div class="cg__wrap">
        <header class="cg-head">
            <div class="cg-head__text">
                <span class="eyebrow">
                    <span class="num">{{ $totalCourses }}</span> {{ trans_choice('frontend.catalog.count_unit', $totalCourses) }}
                </span>
                <h2 class="cg-head__title">{{ $bcTitle }}</h2>
                @if(!$isCat)
                    <p class="cg-head__lead">{{ __('frontend.catalog.lead') }}</p>
                @endif
            </div>

            <a href="{{ route('points.topup') }}" class="cg-promo">
                <span class="cg-promo__icon" aria-hidden="true"><i class="fas fa-coins"></i></span>
                <span class="cg-promo__text">
                    <strong>{{ __('frontend.catalog.promo_head') }}</strong>
                    <span>{{ __('frontend.catalog.promo_body') }}</span>
                </span>
                <span class="cg-promo__go">
                    {{ __('frontend.catalog.promo_go') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </span>
            </a>
        </header>

        @if($products->count())
            @php $cgFirstPage = !$isPaginator || $products->onFirstPage(); @endphp
            <ul class="cg-grid">
                @foreach($products as $course)
                    @php
                        $pimg = $course->photo ? explode(',', $course->photo)[0] : null;
                        $lvCount = $course->levels ? $course->levels->count() : 0;
                        $minPoints = $lvCount ? $course->levels->min('price_in_points') : 0;
                        $catTitle = optional($course->cat_info)->title;
                        $isLead = $loop->first && $cgFirstPage && $products->count() > 3;
                    @endphp
                    <li class="cg-card {{ $isLead ? 'cg-card--lead' : '' }}" style="--i: {{ $loop->index }}">
                        <a href="{{ route('product-detail', $course->slug) }}" class="cg-card__link">
                            <span class="cg-card__media">
                                @if($pimg)
                                    <img src="{{ asset(ltrim($pimg, '/')) }}" alt="" width="1200" height="896" loading="{{ $loop->index < 4 ? 'eager' : 'lazy' }}" decoding="async">
                                @else
                                    <span class="cg-card__empty" aria-hidden="true"><i class="fas fa-chart-line"></i></span>
                                @endif
                                @if($lvCount)
                                    <span class="cg-card__signal" aria-label="{{ trans_choice('frontend.catalog.level_count', $lvCount, ['count' => $lvCount]) }}">
                                        <span class="cg-card__bars" aria-hidden="true">
                                            @for($b = 1; $b <= 4; $b++)
                                                <span class="{{ $b <= min($lvCount, 4) ? 'is-on' : '' }}"></span>
                                            @endfor
                                        </span>
                                        {{ trans_choice('frontend.catalog.level_count', $lvCount, ['count' => $lvCount]) }}
                                    </span>
                                @endif
                            </span>

                            <span class="cg-card__body">
                                @if($catTitle)
                                    <span class="cg-card__cat">{{ $catTitle }}</span>
                                @endif

                                <span class="cg-card__title">{{ $course->title }}</span>

                                @if($course->summary)
                                    <span class="cg-card__desc">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), $isLead ? 220 : 110) }}</span>
                                @endif

                                <span class="cg-card__foot">
                                    @if($minPoints)
                                        <span class="cg-card__price">
                                            <small>{{ __('frontend.catalog.price_from') }}</small>
                                            <strong><span class="num">{{ number_format($minPoints) }}</span> <em>{{ __('frontend.catalog.price_unit') }}</em></strong>
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
                        <span class="cg-pages__btn is-disabled"><i class="fas fa-arrow-left" aria-hidden="true"></i> <span>{{ __('frontend.catalog.pager_prev') }}</span></span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="cg-pages__btn"><i class="fas fa-arrow-left" aria-hidden="true"></i> <span>{{ __('frontend.catalog.pager_prev') }}</span></a>
                    @endif

                    @if(method_exists($products, 'lastPage'))
                        <span class="cg-pages__nums">
                            @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if($page == $products->currentPage())
                                    <span class="cg-pages__num is-current num" aria-current="page">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="cg-pages__num num">{{ $page }}</a>
                                @endif
                            @endforeach
                        </span>
                    @endif

                    @if($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="cg-pages__btn"><span>{{ __('frontend.catalog.pager_next') }}</span> <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                    @else
                        <span class="cg-pages__btn is-disabled"><span>{{ __('frontend.catalog.pager_next') }}</span> <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                    @endif
                </nav>
            @endif
        @else
            <div class="rs__hero ct__empty cg-empty">
                <div class="ct__orb" aria-hidden="true">
                    <span class="rs__wave"></span>
                    <span class="rs__wave rs__wave--late"></span>
                    <i class="fas fa-chart-line"></i>
                </div>
                <h2 class="rs__title">{{ __('frontend.catalog.empty_head') }}</h2>
                <p class="rs__msg">{{ __('frontend.catalog.empty_text') }}</p>
                <div class="rs__actions">
                    <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.catalog.filter_all') }}</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
