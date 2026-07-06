@extends('frontend.layouts.main')
@section('title', __('common.artworks_in_cart'))
@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.cart') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.cart') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@auth
<section class="cart-section" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); padding: 60px 20px;">
    <div class="container">
        @php
            $user = auth()->user();
            $points = $user->points_balance ?? 0;
        @endphp

        <!-- Available Points Banner -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="modern-card p-4 border-0 shadow-sm bg-white" style="border-radius: 24px; border: 1px solid rgba(232, 93, 142, 0.1); background: linear-gradient(135deg, rgba(232, 93, 142, 0.05) 0%, rgba(200, 107, 250, 0.05) 100%);">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-star" style="font-size: 24px; color: #E85D8E;"></i>
                        <div>
                            <span class="text-muted" style="font-size: 14px;">{{ __('common.available_credits') }}</span>
                            <h4 class="mb-0 fw-800" style="font-weight: 800; color: #0a0e27;">{{ number_format($points) }} <span style="color: #E85D8E; font-size: 18px;">{{ __('common.credits') }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- Left: Cart Items -->
            <div class="col-xl-8">
                <div class="modern-card p-4 p-md-5 border-0 shadow-sm bg-white" style="border-radius: 24px; border: 1px solid rgba(232, 93, 142, 0.1); background: rgba(255, 255, 255, 0.6);">
                    <h5 class="fw-bold text-dark mb-5 d-flex align-items-center gap-3" style="color: #0a0e27;">
                        <i class="fas fa-palette" style="color: #E85D8E;"></i>
                        {{ __('common.artworks_in_cart') }}
                    </h5>

                    @if(Helper::cartCount())
                        <div class="row g-3">
                            @foreach(Helper::getAllProductFromCart()->where('order_id', null) as $key=>$cart)
                                @php
                                    $item_title = "Points Top Up";
                                    $item_image = asset('images/placeholder.jpg');
                                    $item_link = "#";
                                    $is_course = false;
                                    $level = null;

                                    if($cart->product) {
                                        $item_title = $cart->product->title;
                                        $item_link = route('product-detail', $cart->product->slug);
                                        $item_image = asset($cart->product->photo ?? 'images/placeholder.jpg');

                                        // Check if this is a course (product_id < 1000)
                                        if($cart->product_id < 1000) {
                                            $is_course = true;
                                            // Look up level by matching course_id and price_in_points
                                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                                         ->where('price_in_points', $cart->points)
                                                         ->first();
                                        }
                                    }
                                @endphp

                                <div class="col-md-6">
                                    <div class="course-card-item h-100 p-4 border rounded-3" style="border-color: rgba(232, 93, 142, 0.15); transition: all 0.3s ease;">
                                        <!-- Course Image -->
                                        <div class="position-relative mb-4 overflow-hidden rounded-3 position-relative watermark-overlay" style="height: 200px; background: rgba(232, 93, 142, 0.05);">
                                            <img src="{{ $item_image }}" alt="{{ $item_title }}" class="w-100 h-100 object-fit-cover">
                                            <a href="{{ route('cart-delete', $cart->id) }}" class="position-absolute top-0 end-0 m-3 btn btn-sm rounded-circle" style="width: 40px; height: 40px; background: rgba(232, 93, 142, 0.9); border: none; z-index: 10; padding: 0; display: flex; align-items: center; justify-content: center;" title="Remove from cart">
                                                <i class="fas fa-trash-alt text-white" style="font-size: 14px;"></i>
                                            </a>
                                        </div>

                                        <!-- Course Title -->
                                        <a href="{{ $item_link }}" class="fw-bold text-decoration-none d-block mb-3" style="color: #0a0e27; font-size: 16px; line-height: 1.4;">
                                            {{ $item_title }}
                                        </a>

                                        <!-- Level Badge (for courses only) -->
                                        @if($is_course)
                                            <div class="mb-3 d-flex align-items-center gap-2">
                                                <span class="badge rounded-2 px-3 py-2" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; font-size: 12px; font-weight: 600;">
                                                    <i class="fas fa-star me-1"></i> {{ __('common.skill_level_text') }}: <strong>{{ $level ? $level->skill_level : 'N/A' }}</strong>
                                                </span>
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <span class="badge rounded-2 px-3 py-2" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; font-size: 12px; font-weight: 600;">
                                                    <i class="fas fa-gift me-1"></i> {{ __('common.points_top_up') }}
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Cost Display -->
                                        <div class="mt-4 pt-3 border-top" style="border-color: rgba(232, 93, 142, 0.1);">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="text-muted" style="font-size: 13px;">{{ $is_course ? __('common.points_cost') : __('common.price') }}</span>
                                                <span class="fw-800" style="font-weight: 800; color: #E85D8E; font-size: 18px;">
                                                    @if($is_course)
                                                        <i class="fas fa-star me-1"></i>{{ number_format($cart->points) }} {{ __('common.credits') }}
                                                    @else
                                                        {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                        <div style="color: #E85D8E; font-size: 12px; font-weight: 600; margin-top: 4px;">({{ number_format($cart->points) }} {{ __('common.credits') }})</div>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-basket fa-4x mb-4" style="color: rgba(232, 93, 142, 0.2);"></i>
                            <h4 class="text-dark fw-bold mb-3" style="color: #0a0e27;">{{ __('common.no_cart_available') }}</h4>
                            <p class="text-muted mb-4">{{ __('common.empty_cart_message') }}</p>
                            <a href="{{ route('product-lists') }}" class="modern-btn modern-btn-solid" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 16px; padding: 12px 28px; font-weight: 600; display: inline-block; text-decoration: none;">
                                <i class="fas fa-arrow-left me-2"></i>{{ __('common.continue_shopping') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="col-xl-4">
                <div class="modern-card p-5 border-0 shadow-sm bg-white sticky-top" style="border-radius: 24px; border: 1px solid rgba(232, 93, 142, 0.1); background: rgba(255, 255, 255, 0.6); top: 120px; z-index: 10;">
                    <h5 class="fw-bold mb-5" style="color: #0a0e27; font-size: 18px;">
                        <i class="fas fa-shopping-cart me-2" style="color: #E85D8E;"></i>{{ __('common.order_summary') }}
                    </h5>

                    @if(Helper::cartCount() && Helper::getAllProductFromCart()->where('order_id', null)->count() > 0)
                        @php
                            $total_points = Helper::totalCartPoints();
                        @endphp

                        <!-- Cart Items Count -->
                        <div class="mb-4 pb-4 border-bottom" style="border-color: rgba(232, 93, 142, 0.1) !important;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted" style="font-size: 14px;">{{ __('common.item_count') }}</span>
                                <span class="fw-bold" style="color: #0a0e27;">{{ Helper::getAllProductFromCart()->where('order_id', null)->count() }}</span>
                            </div>
                        </div>

                        <!-- Total Points -->
                        <div class="mb-5 d-flex justify-content-between align-items-center pb-4 border-bottom" style="border-color: rgba(232, 93, 142, 0.1) !important;">
                            <h5 class="fw-bold mb-0" style="color: #0a0e27;">{{ __('common.total') }}:</h5>
                            <h4 class="fw-800 mb-0" style="font-weight: 800; color: #E85D8E;">
                               {{ number_format($total_points) }} <span style="font-size: 14px;">{{ __('common.credits') }}</span>
                            </h4>
                        </div>

                        <!-- Redeem Points Button -->
                        <form id="redeemPointsForm" action="{{ route('points.redeem') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                        <button type="button" onclick="document.getElementById('redeemPointsForm').submit();" class="modern-btn w-100 py-3 text-center mb-4 rounded-3 text-decoration-none" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; font-weight: 600; box-shadow: 0 4px 12px rgba(232, 93, 142, 0.3); transition: all 0.3s ease; cursor: pointer;">
                            <i class="fas fa-lock me-2"></i>{{ __('common.redeem_points') ?? 'Redeem Points' }}
                        </button>

                        <!-- Continue Shopping -->
                        <a href="{{ route('product-lists') }}" class="modern-btn w-100 py-3 text-center rounded-3 d-block text-decoration-none" style="background: transparent; color: #E85D8E; border: 2px solid rgba(232, 93, 142, 0.3); font-weight: 600; transition: all 0.3s ease;">
                            <i class="fas fa-plus me-2"></i>{{ __('common.continue_shopping') }}
                        </a>

                    
                    @else
                        <div class="border-0 rounded-3 p-4 text-center mb-0" style="background: rgba(232, 93, 142, 0.05); border: 1px solid rgba(232, 93, 142, 0.1);">
                            <i class="fas fa-info-circle mb-3" style="font-size: 24px; color: rgba(232, 93, 142, 0.3);"></i>
                            <p class="mb-0" style="color: #666; font-size: 14px;">{{ __('common.summary_empty') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@else
<section class="cart-section" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width: 600px;">
                <div class="modern-card p-5 border-0 shadow-sm bg-white text-center" style="border-radius: 24px; border: 1px solid rgba(232, 93, 142, 0.1); min-height: 300px; display: flex; flex-direction: column; justify-content: center; align-items: center; background: rgba(255, 255, 255, 0.6);">
                    <i class="fas fa-lock fa-4x mb-4" style="color: rgba(232, 93, 142, 0.2);"></i>
                    <h3 class="fw-bold mb-3" style="color: #0a0e27;">{{ __('common.sign_in_required') }}</h3>
                    <p class="text-muted mb-4" style="font-size: 15px; max-width: 400px;">{{ __('common.sign_in_message') }}</p>
                    <a href="{{ route('login.form') }}" class="modern-btn modern-btn-solid" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 16px; padding: 12px 32px; font-weight: 600; text-decoration: none; display: inline-block;">
                        <i class="fas fa-sign-in-alt me-2"></i>{{ __('common.sign_in') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endauth

@endsection

@push('styles')
<style>
    .modern-card {
        animation: slideInUp 0.6s ease-out;
    }

    .course-card-item {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        background: #fff;
    }

    .course-card-item:hover {
        transform: translateY(-4px);
        border-color: rgba(232, 93, 142, 0.3) !important;
        box-shadow: 0 12px 30px rgba(232, 93, 142, 0.15);
        background: rgba(255, 255, 255, 0.8);
    }

    .modern-btn {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .modern-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(232, 93, 142, 0.3) !important;
    }

    .modern-btn:active {
        transform: translateY(-1px);
    }

    .modern-btn.disabled {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
    }

    .object-fit-cover {
        object-fit: cover;
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
        .course-card-item {
            margin-bottom: 16px;
        }

        .cart-section {
            padding: 40px 15px !important;
        }
    }
</style>
@endpush


