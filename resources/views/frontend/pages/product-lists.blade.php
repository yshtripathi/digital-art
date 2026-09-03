@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('inkwave.cl_browse'))
    @section('description', __('inkwave.cl_browse'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('inkwave.cl_browse');
@endphp
@include('frontend.layouts.breadcrumb', [
    'title' => $bcTitle,
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.cl_catalog'), 'url' => route('product-lists')],
        ['name' => $bcTitle]
    ]
])



<div class="duo-pl-wrap">
    <div class="duo-pl-container">

        {{-- ================= HEADER ================= --}}
        @php
            $hasImg = $isCat && $category->photo;
        @endphp
        <div class="duo-pl-header {{ $hasImg ? 'duo-pl-header--with-img' : 'duo-pl-header--center' }}">
            <i class="fas fa-book-open duo-pl-header__bg"></i>
            <div class="duo-pl-header__content">
                <div class="duo-pl-header__text">
                    @if($isCat)
                        <h1>{{ $category->title }}</h1>
                        @if($category->summary)
                            <p>{{ $category->summary }}</p>
                        @endif
                    @else
                        <h2 class="duo-pl-quote">"{{ __('inkwave.cl_explore_desc') }}"</h2>
                    @endif
                </div>
                @if($hasImg)
                    <div class="duo-pl-header__img">
                        <img src="{{ $category->photo }}" alt="{{ $category->title }}">
                    </div>
                @endif
            </div>
        </div>

        {{-- ================= PRODUCT GRID ================= --}}
        <h2 class="duo-pl-title">{{ $products->count() }} {{ __('inkwave.cl_items') }}</h2>
        
        @if($products->count())
            <div class="duo-pl-grid">
                @foreach($products as $course)
                    @php $pimg = $course->photo ? explode(',', $course->photo)[0] : null; @endphp
                    <a href="{{ route('product-detail', $course->slug) }}" class="duo-pl-card">
                        <div class="duo-pl-card__img">
                            @if($pimg)
                                <img src="{{ url($pimg) }}" alt="{{ $course->title }}" loading="lazy">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        <div class="duo-pl-card__body">
                            <h3 class="duo-pl-card__title">{{ $course->title }}</h3>
                            @if($course->levels && $course->levels->count() > 0)
                                <p class="duo-pl-card__price">
                                    {{ __('inkwave.cl_starting_from') }} 
                                    <strong><i class="fas fa-coins"></i> {{ number_format($course->levels->min('price_in_points')) }}</strong> 
                                    {{ __('inkwave.cl_credits_label') }}
                                </p>
                            @else
                                <p class="duo-pl-card__price">
                                    <strong>{{ __('inkwave.cl_free_label') }}</strong>
                                </p>
                            @endif
                            <div class="duo-pl-card__btn">{{ __('inkwave.cl_view_btn') }}</div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="duo-pl-pagination">
                {{ $products->links() }}
            </div>
        @else
            <div class="duo-pl-empty">
                <i class="fas fa-box-open"></i>
                <h3>{{ __('inkwave.cl_no_products') }}</h3>
                <p>{{ __('inkwave.cl_explore_desc') }}</p>
            </div>
        @endif

        {{-- ================= OTHER CATEGORIES GRID ================= --}}
        @php
            $allCategories = \App\Models\Category::where('status','active')
                ->where('is_parent',1)
                ->orderBy('title','ASC')
                ->get();
        @endphp

        @if($allCategories->count())
            <div class="duo-pl-cats">
                <h2 class="duo-pl-cats-title">{{ __('inkwave.cl_other_cats') }}</h2>
                <div class="duo-pl-cats-grid">
                    @foreach($allCategories as $cat)
                        <a href="{{ route('product-lists', $cat->slug) }}" class="duo-pl-cat-card">
                            <div class="duo-pl-cat-card__icon">
                                @if($cat->photo)
                                    <img src="{{ $cat->photo }}" alt="{{ $cat->title }}" loading="lazy">
                                @else
                                    <i class="fas fa-th-large"></i>
                                @endif
                            </div>
                            <span class="duo-pl-cat-card__title">{{ $cat->title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
