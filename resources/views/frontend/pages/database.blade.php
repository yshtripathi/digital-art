
@extends('frontend.layouts.main')
@section('main-content')

<div class="tl-breadcrumb catalog-banner pt-120 pb-120">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.catalog') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.catalog') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="catalog-section pt-120 pb-120 bg-light">
  <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-md-6">
                <h4 class="fw-bold text-dark mb-0">
                    <span class="text-primary">{{ __('common.catalog') }}</span> {{ __('common.products') }}
                </h4>
            </div>
        </div>

        <div class="row g-4">
            @php
                $products = Helper::getRandomProduct(320);
            @endphp

            @if(count($products))
                @foreach($products as $product)
                    @php
                        $photo = explode(',', $product->photo);
                    @endphp
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="modern-card h-100 border-0 shadow-sm bg-white overflow-hidden" style="border-radius: 24px; transition: transform 0.3s ease;">
                            <div class="position-relative">
                                <a href="{{route('product-detail', $product->slug)}}" class="d-block overflow-hidden">
                                    <img src="{{ asset($photo[0]) }}" class="w-100 object-fit-cover catalog-card-img" style="height:280px; transition: transform 0.5s ease;">
                                </a>
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-blur px-3 py-2 text-white" style="backdrop-filter: blur(10px); background: rgba(0,0,0,0.3); border-radius: 10px;">
                                        {{ __('common.professional') }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 p-xl-5">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <i class="fas fa-layer-group text-primary small"></i>
                                    <span class="text-uppercase small fw-bold opacity-50 letter-spacing-1">{{ __('common.digital_art') }}</span>
                                </div>
                                <h5 class="fw-bold text-dark mb-4 line-clamp-2" style="min-height: 3rem;">
                                    <a href="{{route('product-detail', $product->slug)}}" class="text-dark text-decoration-none hover-primary">
                                        {{$product->title}}
                                    </a>
                                </h5>

                                <p class="text-muted small mb-4">{{ Str::limit($product->summary, 80) }}</p>

                                <div class="pt-4 border-top d-flex align-items-center justify-content-between">
                                    <span class="fw-bold text-primary">{{ $product->getCurrencySymbol() }}{{ number_format($product->price, 2) }}</span>
                                    <form action="{{route('single-add-to-cart')}}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="quant[1]" value="1">
                                        <input type="hidden" name="slug" value="{{$product->slug}}">
                                        <button type="submit" class="btn btn-light rounded-circle shadow-sm border-0 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                            <i class="fas fa-arrow-right text-primary"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="opacity-20 mb-3"><i class="fas fa-inbox fa-4x"></i></div>
                    <h4 class="text-muted fw-bold">{{ __('common.no_products') }}</h4>
                </div>
            @endif
        </div>
    </div>
</section>


@endsection

