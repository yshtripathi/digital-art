@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('common.browse_artworks'))
    @section('description', __('common.browse_artworks'))
@endif

@section('main-content')
@php $bcTitle = (isset($category->title) && $category->title) ? $category->title : __('common.browse_artworks'); @endphp
<x-breadcrumb :title="$bcTitle" :parent="__('common.catalog')" :parent-url="route('product-lists')" />

<!-- CATEGORY HERO SECTION -->
@if(isset($category->title) && $category->title)
<section style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); padding: 80px 20px; position: relative; overflow: hidden;">
    <div class="container">
        <!-- Heading -->
        <div class="row justify-content-center mb-5">
            <div class="col-12 text-center">
                <h1 class="modern-h2" style="font-size: 52px; font-weight: 900; color: #0a0e27; line-height: 1.2; margin-bottom: 20px;">
                    {{ $category->title }}
                </h1>
            </div>
        </div>

        <!-- Image & Content Row -->
        <div class="row align-items-center g-5">
            <!-- 1:1 Image on Left -->
            @if($category->photo)
            <div class="col-lg-6">
                <div class="modern-card p-0 border-0 overflow-hidden " style="border-radius: 28px; box-shadow: 0 30px 80px rgba(232, 93, 142, 0.2); border: 1.5px solid rgba(232, 93, 142, 0.1); aspect-ratio: 1/1; animation: slideInUp 0.6s ease-out;">
                    <img src="{{ $category->photo }}" alt="{{ $category->title }}" class="w-100 h-100 object-fit-cover" style="transition: transform 0.4s ease;">
                </div>
            </div>
            @endif

            <!-- Summary & Description on Right -->
            <div class="col-lg-6">
                @if($category->summary)
                <p class="text-muted" style="font-size: 18px; color: #666; font-weight: 500; line-height: 1.8; margin-bottom: 0;">
                    {{ $category->summary }}
                </p>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<!-- PRODUCTS SECTION -->
<section style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); padding: 80px 20px;">
    <div class="container">
        <!-- Section Header -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="modern-h2 mb-2" style="font-size: 32px; font-weight: 900; color: #0a0e27;">
                    <span style="color: #E85D8E;">{{$products->count()}}</span> {{ __('common.artworks') }}
                </h2>
                <p class="text-muted" style="font-size: 16px;">{{ __('common.explore_curated_collection') }}</p>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row g-5">
            @foreach($products as $course)
                <div class="col-lg-4 col-md-6">
                    <div class="modern-card p-0 border-0 overflow-hidden catalog-card h-100" style="border-radius: 24px; border: 1px solid rgba(232, 93, 142, 0.1); background: rgba(255, 255, 255, 0.7); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); display: flex; flex-direction: column;">
                        <!-- Image Top -->
                        <div class="position-relative watermark-overlay" style="width: 100%; height: 280px; overflow: hidden; background: rgba(232, 93, 142, 0.05);">
                            <a href="{{route('product-detail',$course->slug)}}" class="d-block h-100 w-100">
                                <img src="{{url($course->photo)}}" class="w-100 h-100 object-fit-cover catalog-card-img" style="transition: transform 0.4s ease;">
                            </a>
                        </div>

                        <!-- Content Below -->
                        <div class="flex-grow-1 p-5 d-flex flex-column justify-content-between">
                            <!-- Title & Summary -->
                            <div>
                                <h4 class="fw-bold mb-3" style="font-size: 16px; color: #0a0e27; line-height: 1.4;">
                                    <a href="{{route('product-detail',$course->slug)}}" class="text-decoration-none" style="color: #0a0e27; transition: color 0.3s ease;">
                                        {{$course->title}}
                                    </a>
                                </h4>

                                <p class="text-muted mb-3" style="font-size: 13px; line-height: 1.6; color: #666;">
                                    {{$course->summary}}
                                </p>

                               
                            </div>

                            <!-- Footer -->
                            <div class="mt-4 pt-4 border-top d-flex justify-content-between align-items-center" style="border-color: rgba(232, 93, 142, 0.1);">
                                <a href="{{route('product-detail',$course->slug)}}" class="btn btn-sm px-4" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;">
                                    {{ __('common.explore') }}
                                </a>
                                <i class="fas fa-arrow-right" style="color: #E85D8E; font-size: 18px; transition: transform 0.3s ease;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>

<!-- OTHER CATEGORIES SECTION -->
<section style="background: linear-gradient(135deg, #ffffff 0%, #FFF4EE 100%); padding: 80px 20px;">
    <div class="container">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <span class="modern-badge mb-3" style="font-size: 11px; font-weight: 700; color: #E85D8E; background: rgba(232, 93, 142, 0.12); padding: 8px 16px; border-radius: 8px; text-transform: uppercase; letter-spacing: 0.5px; display: inline-block;">🎨 {{ __('common.explore_more') }}</span>
            <h2 class="modern-h2 mt-3 mb-3" style="font-size: 36px; font-weight: 900; color: #0a0e27;">{{ __('common.other_creative_categories') }}</h2>
            <p class="text-muted mx-auto" style="max-width: 600px; font-size: 16px;">{{ __('common.discover_more_art_categories') }}</p>
        </div>

        <!-- Categories Grid -->
        <div class="row g-4">
            @php
                $allCategories = \App\Models\Category::where('status','active')
                    ->where('is_parent',1)
                    ->orderBy('title','ASC')
                    ->limit(4)
                    ->get();
            @endphp

            @forelse($allCategories as $cat)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('product-lists', $cat->slug) }}" class="text-decoration-none">
                        <div class="modern-card p-0 overflow-hidden border-0 h-100" style="border-radius: 20px; border: 1px solid rgba(232, 93, 142, 0.1); background: rgba(255, 255, 255, 0.6); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            <!-- Image -->
                            <div class = "position-relative watermark-overlay" style="height: 200px; overflow: hidden; background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 100%);">
                                @if($cat->photo)
                                    <img src="{{ $cat->photo }}" alt="{{ $cat->title }}" class="w-100 h-100 object-fit-cover" style="transition: transform 0.4s ease;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-palette fa-4x" style="color: rgba(232, 93, 142, 0.2);"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h5 class="fw-bold mb-2" style="color: #0a0e27; font-size: 16px;">{{ $cat->title }}</h5>
                               
                                <div style="height: 1px; background: rgba(232, 93, 142, 0.1); margin: 12px 0;"></div>
                                <small class="text-muted" style="color: #666;">{!! __('common.explore_category_arrow') !!}</small>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">{{ __('common.no_categories') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .modern-badge {
        transition: all 0.3s ease;
    }

    .modern-card {
        animation: slideInUp 0.6s ease-out;
    }

    .catalog-card {
        position: relative;
    }

    .catalog-card:hover {
        transform: translateY(-8px);
        border-color: rgba(232, 93, 142, 0.25) !important;
        box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15) !important;
        background: rgba(255, 255, 255, 0.9) !important;
    }

    .catalog-card:hover .catalog-card-img {
        transform: scale(1.08);
    }

    .catalog-card:hover i {
        transform: translateX(4px);
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .catalog-card {
            flex-direction: column !important;
        }

        .catalog-card > div:first-child {
            width: 100% !important;
            height: 250px !important;
        }

        .catalog-card:hover {
            transform: translateY(-4px);
        }
    }
    
</style>
@endpush

