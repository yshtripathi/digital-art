@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('inkwave.pl_browse'))
    @section('description', __('inkwave.pl_browse'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('inkwave.pl_browse');
@endphp
@include('frontend.layouts.breadcrumb', [
    'title' => $bcTitle,
    'links' => [
        ['name' => __('inkwave.menu_home'), 'url' => route('home')],
        ['name' => __('inkwave.pl_catalog'), 'url' => route('product-lists')],
        ['name' => $bcTitle]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme Product Lists - Artora
------------------------------------------- */
.duo-pl-wrap {
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    background: #ffffff;
    padding-bottom: 100px;
}
.duo-pl-wrap a,
.duo-pl-wrap a:hover {
    text-decoration: none !important;
}
.duo-pl-container {
    max-width: 1200px;
    margin: 48px auto;
    padding: 0 24px;
}

/* ================= HEADER ================= */
.duo-pl-header {
    background: var(--color-spark-blue, #1cb0f6);
    border: 2px solid #1899d6;
    border-radius: 32px;
    padding: 64px 48px;
    box-shadow: 0 12px 0 #1899d6;
    margin-bottom: 64px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
}
.duo-pl-header__content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 48px;
    position: relative;
    z-index: 2;
}
.duo-pl-header--with-img .duo-pl-header__content {
    justify-content: space-between;
}
.duo-pl-header__text {
    text-align: center;
    flex: 1;
}
.duo-pl-header--with-img .duo-pl-header__text {
    text-align: left;
}
.duo-pl-header h1 {
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 16px;
    letter-spacing: -0.5px;
}
.duo-pl-header p {
    font-size: 20px;
    font-weight: 700;
    opacity: 0.9;
    max-width: 600px;
}
.duo-pl-header--center .duo-pl-header p {
    margin: 0 auto;
}
.duo-pl-header__img {
    width: 320px;
    height: 180px;
    border-radius: 24px;
    border: 4px solid #ffffff;
    box-shadow: 0 8px 0 rgba(0,0,0,0.1);
    overflow: hidden;
    background: #ffffff;
    flex-shrink: 0;
}
.duo-pl-header__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.duo-pl-header__bg {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 200px;
    color: #ffffff;
    opacity: 0.1;
    z-index: 1;
}
@media (max-width: 768px) {
    .duo-pl-header {
        padding: 48px 24px;
    }
    .duo-pl-header__content {
        flex-direction: column-reverse;
        text-align: center;
    }
    .duo-pl-header--with-img .duo-pl-header__text {
        text-align: center;
    }
}

/* ================= PRODUCT GRID ================= */
.duo-pl-title {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 32px;
}

.duo-pl-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 32px;
}

/* Product Card */
.duo-pl-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 8px 0 #e5e5e5;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    transition: transform 0.1s, box-shadow 0.1s;
}
.duo-pl-card:hover {
    transform: translateY(4px);
    box-shadow: 0 4px 0 #e5e5e5;
}
.duo-pl-card:active {
    transform: translateY(8px);
    box-shadow: 0 0 0 #e5e5e5;
}
.duo-pl-card__img {
    height: 220px;
    border-bottom: 2px solid #e5e5e5;
    background: #f7f7f7;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    color: #e5e5e5;
    overflow: hidden;
}
.duo-pl-card__img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.duo-pl-card__body {
    padding: 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.duo-pl-card__title {
    font-size: 22px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 12px;
    line-height: 1.3;
    transition: color 0.2s, text-shadow 0.2s;
}
.duo-pl-card:hover .duo-pl-card__title {
    color: var(--color-spark-blue, #1cb0f6);
    text-shadow: 0 0 8px rgba(28, 176, 246, 0.3);
}
.duo-pl-card__price {
    font-size: 16px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
    margin-top: auto;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.duo-pl-card__price strong {
    color: var(--color-macaw-yellow, #ffc800);
    font-size: 20px;
}
.duo-pl-card__price i {
    color: var(--color-macaw-yellow, #ffc800);
}
.duo-pl-card__btn {
    background: var(--color-eager-green, #58cc02);
    color: #ffffff;
    padding: 14px;
    border-radius: 16px;
    text-align: center;
    font-size: 17px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.053em;
    box-shadow: 0 4px 0 #46a302;
    transition: filter 0.1s;
}
.duo-pl-card:hover .duo-pl-card__btn {
    filter: brightness(1.05);
}

/* Empty State */
.duo-pl-empty {
    text-align: center;
    padding: 64px 24px;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    box-shadow: 0 8px 0 #e5e5e5;
}
.duo-pl-empty i {
    font-size: 80px;
    color: #e5e5e5;
    margin-bottom: 24px;
}
.duo-pl-empty h3 {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 16px;
}
.duo-pl-empty p {
    font-size: 18px;
    font-weight: 700;
    color: var(--color-pencil-gray, #777777);
}

/* ================= CATEGORY GRID ================= */
.duo-pl-cats {
    margin-top: 64px;
    padding-top: 64px;
    border-top: 2px dashed #e5e5e5;
}
.duo-pl-cats-title {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    text-align: center;
    margin-bottom: 48px;
}
.duo-pl-cats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 24px;
}
.duo-pl-cat-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 20px;
    padding: 24px;
    text-align: center;
    text-decoration: none;
    box-shadow: 0 6px 0 #e5e5e5;
    transition: transform 0.1s, box-shadow 0.1s;
    display: block;
}
.duo-pl-cat-card:hover {
    transform: translateY(4px);
    box-shadow: 0 2px 0 #e5e5e5;
}
.duo-pl-cat-card:active {
    transform: translateY(6px);
    box-shadow: 0 0 0 #e5e5e5;
}
.duo-pl-cat-card__icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    background: #f7f7f7;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: var(--color-spark-blue, #1cb0f6);
    overflow: hidden;
}
.duo-pl-cat-card__icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.duo-pl-cat-card__title {
    font-size: 17px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    transition: color 0.2s, text-shadow 0.2s;
}
.duo-pl-cat-card:hover .duo-pl-cat-card__title {
    color: var(--color-spark-blue, #1cb0f6);
    text-shadow: 0 0 8px rgba(28, 176, 246, 0.3);
}

/* ================= PAGINATION ================= */
.duo-pl-pagination {
    margin-top: 48px;
    display: flex;
    justify-content: center;
}
.duo-pl-pagination nav {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    padding: 8px;
    box-shadow: 0 6px 0 #e5e5e5;
}
.duo-pl-pagination nav .pagination {
    display: flex;
    gap: 8px;
    margin: 0;
    padding: 0;
    list-style: none;
}
.duo-pl-pagination nav .page-item .page-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border: 2px solid transparent;
    border-radius: 16px;
    font-size: 18px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    text-decoration: none;
    background: #f7f7f7;
}
.duo-pl-pagination nav .page-item.active .page-link {
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff;
    border-color: #1899d6;
}
.duo-pl-pagination nav .page-item:not(.active) .page-link:hover {
    background: #e5e5e5;
}
</style>

<div class="duo-pl-wrap">
    <div class="duo-pl-container">

        {{-- ================= HEADER ================= --}}
        @php
            $hasImg = $isCat && $category->photo;
        @endphp
        <div class="duo-pl-header {{ $hasImg ? 'duo-pl-header--with-img' : 'duo-pl-header--center' }}">
            <i class="fas fa-palette duo-pl-header__bg"></i>
            <div class="duo-pl-header__content">
                <div class="duo-pl-header__text">
                    <h1>{{ $isCat ? $category->title : __('inkwave.pl_browse') }}</h1>
                    <p>{{ $isCat && $category->summary ? $category->summary : __('inkwave.pl_explore_curated') }}</p>
                </div>
                @if($hasImg)
                    <div class="duo-pl-header__img">
                        <img src="{{ $category->photo }}" alt="{{ $category->title }}">
                    </div>
                @endif
            </div>
        </div>

        {{-- ================= PRODUCT GRID ================= --}}
        <h2 class="duo-pl-title">{{ $products->count() }} {{ __('inkwave.pl_artworks') }}</h2>
        
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
                                    {{ __('inkwave.starting_from') }} 
                                    <strong><i class="fas fa-coins"></i> {{ number_format($course->levels->min('price_in_points')) }}</strong> 
                                    {{ __('inkwave.pd_credits') }}
                                </p>
                            @else
                                <p class="duo-pl-card__price">
                                    <strong>{{ __('inkwave.free') }}</strong>
                                </p>
                            @endif
                            <div class="duo-pl-card__btn">{{ __('inkwave.pl_explore') }}</div>
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
                <h3>{{ __('inkwave.pl_no_products') }}</h3>
                <p>{{ __('inkwave.pl_explore_curated') }}</p>
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
                <h2 class="duo-pl-cats-title">{{ __('inkwave.pl_other_cats') }}</h2>
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
