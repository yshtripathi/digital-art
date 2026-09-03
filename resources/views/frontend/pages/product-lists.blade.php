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

<style>
/* ==========================================================================
   Art Courses — Product Catalog (Gallery Theme)
   ========================================================================== */
.ag-catalog-page, .ag-catalog-page *, .ag-catalog-page *::before, .ag-catalog-page *::after {
    box-sizing: border-box;
}
.ag-catalog-page {
    padding-bottom: 100px;
}
.ag-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 5%;
}

/* Header */
.ag-catalog-header {
    text-align: center;
    margin-bottom: 80px;
    padding: 80px 24px;
    background-color: #f5f5f5; /* Bone */
    border-bottom: 1px solid rgba(0,0,0,0.1);
}
.ag-catalog-header h1 {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 56px !important;
    color: #000000 !important;
    margin-bottom: 24px !important;
    line-height: 1.2;
}
.ag-catalog-header p {
    font-family: var(--font-arial, Arial, sans-serif);
    color: #555555;
    font-size: 16px;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}
.ag-catalog-header__img {
    margin-top: 48px;
    max-width: 100%;
    width: 900px;
    height: 400px;
    object-fit: cover;
    box-shadow: 0 30px 60px rgba(0,0,0,0.1);
    display: block;
    margin-left: auto;
    margin-right: auto;
}
@media (max-width: 768px) {
    .ag-catalog-header h1 { font-size: 40px !important; }
    .ag-catalog-header__img { height: 250px; }
}

/* Product Grid */
.ag-section-title {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #000000;
    margin-bottom: 32px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding-bottom: 16px;
}

.ag-product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 48px;
    margin-bottom: 80px;
}
@media (max-width: 768px) { .ag-product-grid { gap: 32px; } }

/* Product Card */
.ag-product-card {
    background-color: #ffffff;
    border: 1px solid rgba(0,0,0,0.1);
    transition: all 0.4s ease;
    display: flex;
    flex-direction: column;
    text-decoration: none !important;
}
.ag-product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    border-color: #bc9c5c;
}

.ag-product-card__img {
    width: 100%;
    height: 250px;
    background-color: #f5f5f5;
    overflow: hidden;
    position: relative;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.ag-product-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease;
}
.ag-product-card:hover .ag-product-card__img img {
    transform: scale(1.05);
}
.ag-product-card__img i {
    position: absolute;
    top: 50%; left: 50%; transform: translate(-50%, -50%);
    font-size: 48px;
    color: #cccccc;
}

.ag-product-card__body {
    padding: 32px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.ag-product-card__title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 24px !important;
    color: #000000 !important;
    margin-bottom: 16px !important;
    line-height: 1.3 !important;
}
.ag-product-card__price {
    font-family: var(--font-arial, Arial, sans-serif);
    color: #555555;
    font-size: 14px;
    margin-bottom: 32px;
    margin-top: auto;
}
.ag-product-card__price strong {
    color: #000000;
    font-size: 18px;
}
.ag-product-card__price i {
    color: #bc9c5c;
    margin-right: 4px;
}

.ag-primary-btn {
    background: #000000 !important; color: #ffffff !important; border: 1px solid #000000 !important; font-family: Arial, sans-serif !important; font-size: 13px !important; font-weight: bold !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; transition: all 0.3s ease !important; padding: 16px 24px !important; display: block !important; text-align: center !important; text-decoration: none !important;
}
.ag-product-card:hover .ag-primary-btn {
    background: #ffffff !important; color: #000000 !important;
}

/* Pagination Overrides */
.ag-pagination {
    display: flex;
    justify-content: center;
    margin-top: 64px;
}
.ag-pagination nav { width: 100%; display: flex; justify-content: center; }
.ag-pagination .pagination { display: flex; gap: 8px; list-style: none; padding: 0; margin: 0; }
.ag-pagination .page-item .page-link { 
    display: flex; align-items: center; justify-content: center;
    min-width: 40px; height: 40px; padding: 0 12px;
    font-family: var(--font-arial, Arial, sans-serif); font-size: 14px;
    color: #000000; background: #ffffff; border: 1px solid rgba(0,0,0,0.2);
    text-decoration: none; transition: all 0.3s ease;
}
.ag-pagination .page-item.active .page-link { background: #000000; color: #ffffff; border-color: #000000; }
.ag-pagination .page-item .page-link:hover { border-color: #000000; background: #f5f5f5; }

/* Empty State */
.ag-empty-state { text-align: center; padding: 80px 40px; background: #f5f5f5; margin-bottom: 80px; }
.ag-empty-state i { font-size: 48px; color: #bc9c5c; margin-bottom: 24px; }
.ag-empty-state h3 { font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important; font-size: 32px !important; color: #000000 !important; margin-bottom: 16px !important; }
.ag-empty-state p { font-family: var(--font-arial, Arial, sans-serif); color: #555555; }

/* Categories Grid */
.ag-categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 24px;
}
.ag-cat-card {
    background: #f5f5f5;
    padding: 32px 24px;
    text-align: center;
    text-decoration: none !important;
    border: 1px solid transparent;
    transition: all 0.3s ease;
    display: block;
}
.ag-cat-card:hover {
    background: #ffffff;
    border-color: #000000;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}
.ag-cat-card__icon {
    width: 120px; height: 120px;
    margin: 0 auto 24px;
    border-radius: 0;
    overflow: hidden;
    background: #e0e0e0;
    display: flex; align-items: center; justify-content: center;
    border: 1px solid rgba(0,0,0,0.1);
}
.ag-cat-card__icon img { width: 100%; height: 100%; object-fit: cover; }
.ag-cat-card__icon i { font-size: 24px; color: #888888; }
.ag-cat-card__title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 20px !important;
    color: #000000 !important;
    display: block;
}
</style>

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
            <h1>{{ __('inkwave.cl_browse') }}</h1>
            <p>{{ __('inkwave.cl_explore_desc') }}</p>
        @endif

        @if($hasImg)
            <img src="{{ $category->photo }}" alt="{{ $category->title }}" class="ag-catalog-header__img">
        @endif
    </div>

    <div class="ag-container">
        
        {{-- ================= PRODUCT GRID ================= --}}
        <h2 class="ag-section-title">{{ $products->count() }} {{ __('inkwave.cl_items') }}</h2>
        
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
                                    {{ __('inkwave.cl_starting_from') }} 
                                    <strong><i class="fas fa-coins"></i> {{ number_format($course->levels->min('price_in_points')) }}</strong> 
                                    {{ __('inkwave.cl_credits_label') }}
                                </p>
                            @else
                                <p class="ag-product-card__price">
                                    <strong>{{ __('inkwave.cl_free_label') }}</strong>
                                </p>
                            @endif
                            
                            <div class="ag-primary-btn">{{ __('inkwave.cl_view_btn') }}</div>
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
            <div style="margin-top: 80px;">
                <h2 class="ag-section-title">{{ __('inkwave.cl_other_cats') }}</h2>
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
