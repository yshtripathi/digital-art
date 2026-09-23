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
     Modern horizontal layout: category lead, filter pills,
     horizontal course cards (16:9 thumbnail beside content), clean pagination,
     and category showcase. No search bar.
     Styles: public/css/variables.css — Section 19
     ========================================================================== --}}
<section class="pl">
    <div class="pl__wrap">

        {{-- Category Lead / Overview Card with Category Image --}}
        @php
            $catImg = $isCat && !empty($category->photo) ? ltrim($category->photo, '/') : null;
        @endphp
        <header class="pl-lead {{ $catImg ? 'pl-lead--with-img' : '' }}">
            <div class="pl-lead__info">
                <div class="pl-lead__meta">
                    <span class="pl-lead__count">
                        <strong>{{ $totalCourses }}</strong>
                        <span>{{ trans_choice('frontend.catalog.count', $totalCourses) }}</span>
                    </span>
                    @if($isCat)
                        <span class="badge badge--brand">{{ $category->title }}</span>
                    @endif
                </div>
                <h1 class="pl-lead__title">{{ $bcTitle }}</h1>
                <p class="pl-lead__desc">{{ $isCat && $category->summary ? $category->summary : __('frontend.catalog.intro') }}</p>
            </div>
            @if($catImg)
                <div class="pl-lead__media">
                    <img src="{{ asset($catImg) }}" alt="{{ $bcTitle }}" fetchpriority="high">
                </div>
            @endif
        </header>

        {{-- Category Quick Filter Pills with Category Thumbnails (No search bar) --}}
        @if($allCategories->count())
            <nav class="pl-filters" aria-label="{{ __('frontend.catalog.categories') ?? 'Categories' }}">
                <a href="{{ route('product-lists') }}" class="pl-pill pl-pill--all {{ !$isCat ? 'is-active' : '' }}">
                    <i class="fas fa-th-large" aria-hidden="true"></i>
                    <span>{{ __('frontend.catalog.all') }}</span>
                </a>
                @foreach($allCategories as $c)
                    <a href="{{ route('product-lists', $c->slug) }}" class="pl-pill {{ $isCat && $category->id == $c->id ? 'is-active' : '' }}">
                        @if($c->photo)
                            <span class="pl-pill__media">
                                <img src="{{ asset(ltrim($c->photo, '/')) }}" alt="{{ $c->title }}" loading="lazy">
                            </span>
                        @endif
                        <span>{{ $c->title }}</span>
                    </a>
                @endforeach
            </nav>
        @endif

        {{-- 2-in-a-Row Course Cards Grid --}}
        @if($products->count())
            <ul class="pl-index">
                @foreach($products as $course)
                    @php
                        $pimg = $course->photo ? explode(',', $course->photo)[0] : null;
                        $minPoints = $course->levels ? $course->levels->min('price_in_points') : 0;
                        $catTitle = optional($course->cat_info)->title;
                    @endphp
                    <li class="pl-card">
                        <a href="{{ route('product-detail', $course->slug) }}" class="pl-card__link">
                            
                            {{-- Horizontal 16:9 Thumbnail --}}
                            <div class="pl-card__media">
                                @if($pimg)
                                    <img src="{{ asset(ltrim($pimg, '/')) }}" alt="{{ $course->title }}" loading="lazy" decoding="async">
                                @else
                                    <span class="pl-card__placeholder" aria-hidden="true">
                                        <i class="fas fa-graduation-cap"></i>
                                    </span>
                                @endif
                            </div>

                            {{-- Details Body --}}
                            <div class="pl-card__body">
                                <div class="pl-card__head">
                                    @if($catTitle)
                                        <div class="pl-card__tags">
                                            <span class="badge">{{ $catTitle }}</span>
                                        </div>
                                    @endif

                                    <h2 class="pl-card__title">{{ $course->title }}</h2>

                                    @if($course->summary)
                                        <p class="pl-card__summary">{{ \Illuminate\Support\Str::limit(strip_tags($course->summary), 130) }}</p>
                                    @endif
                                </div>

                                <div class="pl-card__foot">
                                    @if($minPoints)
                                        <span class="pl-card__price">
                                            <i class="fas fa-bolt" aria-hidden="true"></i>
                                            <span class="pl-card__from">{{ __('frontend.catalog.from') }}</span>
                                            <strong>{{ number_format($minPoints) }}</strong>
                                            <span>{{ __('frontend.catalog.credits') }}</span>
                                        </span>
                                    @else
                                        <span class="pl-card__price">{{ __('frontend.catalog.no_levels') }}</span>
                                    @endif

                                    <span class="pl-card__cta">
                                        <span>{{ __('frontend.catalog.view') }}</span>
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>

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
            {{-- Empty State --}}
            <div class="pl-empty">
                <span class="pl-empty__icon" aria-hidden="true"><i class="fas fa-box-open"></i></span>
                <h2 class="pl-empty__title">{{ __('frontend.catalog.empty_title') }}</h2>
                <p class="pl-empty__desc">{{ __('frontend.catalog.empty_desc') }}</p>
                <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.catalog.all') }}</a>
            </div>
        @endif

    </div>
</section>

@endsection
