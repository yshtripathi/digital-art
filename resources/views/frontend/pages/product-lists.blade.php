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

<section class="shop">
    <div class="container">
        @if($isCat)
            @php
                $shIsJa = app()->getLocale() == 'ja';
                $shCatTitle = $shIsJa && filled($category->title_jp ?? null) ? $category->title_jp : $category->title;
                $shCatText = $shIsJa && filled($category->summary_jp ?? null) ? $category->summary_jp : ($category->summary ?? '');
                $shCatRaw = trim((string) ($category->photo ?? ''));
                $shCatImg = $shCatRaw !== '' && file_exists(public_path(ltrim($shCatRaw, '/'))) ? asset(ltrim($shCatRaw, '/')) : null;
                $shTotal = $isPaginator ? $products->total() : $products->count();
                $shStack = collect($isPaginator ? $products->items() : $products)->map(function ($p) {
                    $raw = $p->photo ? trim(explode(',', $p->photo)[0]) : '';
                    return $raw !== '' && file_exists(public_path(ltrim($raw, '/'))) ? asset(ltrim($raw, '/')) : null;
                })->filter()->take(3)->values();
            @endphp
            <header class="shop-cat">
                <span class="shop-cat__media {{ $shCatImg ? '' : 'is-empty' }}">
                    @if($shCatImg)
                        <img src="{{ $shCatImg }}" alt="{{ $shCatTitle }}" width="400" height="400">
                    @else
                        <i class="fas fa-layer-group" aria-hidden="true"></i>
                    @endif
                </span>
                <div class="shop-cat__body">
                    <p class="eyebrow shop-cat__label">{{ __('frontend.header.categories') }}</p>
                    <h2 class="shop-cat__title">{{ $shCatTitle }}</h2>
                    @if(filled($shCatText))
                        <p class="shop-cat__text">{{ $shCatText }}</p>
                    @endif
                    <span class="shop-cat__count"><i class="fas fa-book-open" aria-hidden="true"></i>{{ trans_choice('frontend.catalog.guides', $shTotal, ['count' => number_format($shTotal)]) }}</span>
                </div>
                @if($shStack->isNotEmpty())
                    <div class="shop-cat__stack" aria-hidden="true">
                        @foreach($shStack as $shImg)
                            <span class="shop-cat__card" style="--n: {{ $loop->index }}; --c: {{ $shStack->count() }}"><img src="{{ $shImg }}" alt="" width="300" height="300" decoding="async"></span>
                        @endforeach
                    </div>
                @endif
            </header>
        @elseif($products->count())
            <div class="shop-intro">
                <h2 class="shop-intro__title">{{ __('frontend.catalog.intro_title') }}</h2>
                <p class="shop-intro__text">{{ __('frontend.catalog.intro_text') }}</p>
            </div>
        @endif

        @if($products->count())
            <ul class="shop-grid">
                @foreach($products as $course)
                    @php
                        $rawImg = $course->photo ? trim(explode(',', $course->photo)[0]) : '';
                        $pimg = $rawImg !== '' && file_exists(public_path(ltrim($rawImg, '/'))) ? asset(ltrim($rawImg, '/')) : null;
                        $courseLevels = $course->levels ?? collect();
                        $lvCount = $courseLevels->count();
                        $minPoints = $lvCount ? $courseLevels->min('price_in_points') : 0;
                        $courseTitle = app()->getLocale() == 'ja' && filled($course->title_jp ?? null) ? $course->title_jp : $course->title;
                    @endphp
                    <li class="shop-item" style="--i: {{ $loop->index % 8 }}">
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
                            <span class="shop-item__body">
                                <span class="shop-item__name">{{ $courseTitle }}</span>
                                <span class="shop-item__foot">
                                    @if($minPoints)
                                        <span class="shop-item__price">{{ __('frontend.catalog.from') }} <strong>{{ number_format($minPoints) }}</strong> {{ __('frontend.catalog.credits') }}</span>
                                    @else
                                        <span class="shop-item__price">{{ __('frontend.catalog.no_levels') }}</span>
                                    @endif
                                    <span class="shop-item__go" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>

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
