@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('inkwave.cat_browse'))
    @section('description', __('inkwave.cat_browse'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('inkwave.cat_browse');
@endphp

@include('frontend.layouts.breadcrumb', [
    'title' => $bcTitle,
    'links' => [
        ['name' => __('inkwave.top_nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.cat_catalog'), 'url' => route('product-lists')],
        ['name' => $bcTitle]
    ]
])



<div class="ag-catalog-page">

    {{-- ================= HEADER ================= --}}
    @php $hasImg = $isCat && $category->photo; @endphp
    <div class="ag-catalog-header">
        @if($isCat)
            <h1>{{ $category->title }}</h1>
            @if($category->summary)
                <p>{{ $category->summary }}</p>
            @endif
        @else
            <h1>{{ __('inkwave.cat_browse') }}</h1>
            <p>{{ __('inkwave.cat_explore_desc') }}</p>
        @endif

        @if($hasImg)
            <img src="{{ $category->photo }}" alt="{{ $category->title }}" class="ag-catalog-header__img">
        @endif
    </div>

    <div class="ag-container">
        
        {{-- ================= PRODUCT GRID ================= --}}
        <h2 class="ag-section-title">{{ $products->count() }} {{ __('inkwave.cat_items') }}</h2>
        
        @if($products->count())
            <div class="ag-product-grid">
                @foreach($products as $course)
                    @php $pimg = $course->photo ? explode(',', $course->photo)[0] : null; @endphp
                    <a href="{{ route('product-detail', $course->slug) }}" class="ag-product-card">
                        <div class="ag-product-card__img">
                            @if($pimg)
                                <img src="{{ url($pimg) }}" alt="{{ $course->title }}" loading="lazy">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        <div class="ag-product-card__body">
                            <h3 class="ag-product-card__title">{{ $course->title }}</h3>
                            
                            @if($course->levels && $course->levels->count() > 0)
                                <p class="ag-product-card__price">
                                    {{ __('inkwave.cat_starting_from') }} 
                                    <strong><i class="fas fa-coins"></i> {{ number_format($course->levels->min('price_in_points')) }}</strong> 
                                    {{ __('inkwave.cat_credits_label') }}
                                </p>
                            @else
                                <p class="ag-product-card__price">
                                    <strong>{{ __('inkwave.cat_free_label') }}</strong>
                                </p>
                            @endif
                            
                            <div class="ag-primary-btn">{{ __('inkwave.cat_view_btn') }}</div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="ag-pagination">
                {{ $products->links() }}
            </div>
        @else
            <div class="ag-empty-state">
                <i class="fas fa-box-open"></i>
                <h3>{{ __('inkwave.cat_no_products') }}</h3>
                <p>{{ __('inkwave.cat_explore_desc') }}</p>
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
            <div style="margin-top: 80px;">
                <h2 class="ag-section-title">{{ __('inkwave.cat_other_cats') }}</h2>
                <div class="ag-categories-grid">
                    @foreach($allCategories as $cat)
                        <a href="{{ route('product-lists', $cat->slug) }}" class="ag-cat-card">
                            <div class="ag-cat-card__icon">
                                @if($cat->photo)
                                    <img src="{{ $cat->photo }}" alt="{{ $cat->title }}" loading="lazy">
                                @else
                                    <i class="fas fa-th-large"></i>
                                @endif
                            </div>
                            <span class="ag-cat-card__title">{{ $cat->title }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
