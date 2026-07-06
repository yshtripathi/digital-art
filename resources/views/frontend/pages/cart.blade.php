@extends('frontend.layouts.main')
@section('title', 'Cart')
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

<section class="cart-section" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); padding: 60px 20px;">
    <div class="container">
        <div class="row g-5">
            <!-- Left: Cart Items -->
            <div class="col-xl-8">
                <div class="modern-card p-4 p-md-5 border-0 shadow-sm" style="background: rgba(255, 255, 255, 0.6); border-radius: 20px; border: 1px solid rgba(232, 93, 142, 0.1);">
                    <h5 class="fw-bold text-dark mb-5 d-flex align-items-center gap-3" style="color: #0a0e27;">
                        <i class="fas fa-shopping-cart" style="color: #E85D8E;"></i>
                        {{ __('common.item_summary') }}
                    </h5>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-uppercase small fw-bold" style="color: #E85D8E; border-bottom: 2px solid rgba(232, 93, 142, 0.2);">
                                    <th class="border-0 pb-4">{{ __('common.product') }}</th>
                                    <th class="border-0 pb-4 text-center">{{ __('common.points') }}</th>
                                    <th class="border-0 pb-4 text-center">{{ __('common.price') }}</th>
                                    <th class="border-0 pb-4 text-end">{{ __('common.remove') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Helper::cartCount())
                                    @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                        @php
                                            $item_title = "Credits Top Up";
                                            $item_link = "#";
                                            if($cart->product) {
                                                $item_title = $cart->product->title;
                                                $item_link = route('product-detail', $cart->product->slug);
                                            }
                                        @endphp
                                        <tr class="border-bottom" style="border-color: rgba(232, 93, 142, 0.1);">
                                            <td class="py-4">
                                                <div class="d-flex flex-column gap-2">
                                                    <a href="{{ $item_link }}" class="fw-bold text-decoration-none" style="color: #0a0e27; font-size: 15px;">{{ $item_title }}</a>
                                                    <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; width: fit-content; font-size: 11px; font-weight: 600;">{{ __('common.art_category') }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 text-center">
                                                <span class="fw-800" style="font-weight: 800; color: #0a0e27;">
                                                    <i class="fas fa-coins me-1" style="color: #E85D8E;"></i> {{ number_format($cart->points) }} {{ __('common.credits') }}
                                                </span>
                                            </td>
                                            <td class="py-4 text-center">
                                                <span class="fw-800" style="font-weight: 800; color: #0a0e27;">
                                                    {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                                                </span>
                                            </td>
                                            <td class="py-4 text-end">
                                                <a href="{{ route('cart-delete',$cart->id) }}" class="btn rounded-2 border-0" style="width: 40px; height: 40px; background: rgba(232, 93, 142, 0.1); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); color: #E85D8E;">
                                                    <i class="fas fa-trash-alt" style="font-size: 16px;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="py-5">
                                                <i class="fas fa-shopping-basket fa-4x mb-4" style="color: rgba(232, 93, 142, 0.2);"></i>
                                                <h4 class="text-dark fw-bold mb-3" style="color: #0a0e27;">{{ __('common.no_cart_available') }}</h4>
                                                <a href="{{route('product-lists')}}" class="modern-btn modern-btn-solid" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 16px; padding: 12px 28px; font-weight: 600; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">{{ __('common.continue_shopping') }}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="col-xl-4">
                <div class="modern-card p-5 border-0 shadow-sm bg-white sticky-top" style="border-radius: 24px; border: 1px solid rgba(232, 93, 142, 0.1); top: 120px; z-index: 10;">
                    <h5 class="fw-bold mb-5" style="color: #0a0e27; font-size: 18px;">{{ __('common.order_summary') }}</h5>

                    @if(Helper::cartCount())
                        @php
                            $total_amount = 0;
                            $cartItems = Helper::getAllProductFromCart();

                            foreach($cartItems as $item) {
                                $total_amount += $item['price'];
                            }

                            if(session()->has('coupon')) {
                                $total_amount -= Session::get('coupon')['value'];
                            }
                        @endphp
                        
                        

                        <div class="mb-5 d-flex justify-content-between align-items-center pt-4 border-top" style="border-color: rgba(232, 93, 142, 0.1) !important;">
                            <h5 class="fw-bold mb-0" style="color: #0a0e27;">{{ __('common.total') }}:</h5>
                            <h4 class="fw-800 mb-0" style="font-weight: 800; color: #E85D8E;">
                                {{ Helper::getCurrencySymbol(session('currency')) }}
                                {{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2) }}
                            </h4>
                        </div>

                        @if(Helper::totalCartPoints() > 0)
                            <a href="{{route('product-lists')}}" class="modern-btn w-100 py-3 text-center mb-3 rounded-3" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; border: 2px solid #E85D8E; font-weight: 600; transition: all 0.3s ease; display: block;">
                                {{ __('common.continue_shopping') }} <i class="fas fa-arrow-left ms-2"></i>
                            </a>
                        @endif

                        <a href="{{ route('checkout') }}" class="modern-btn w-100 py-3 text-center mb-5 rounded-3" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; font-weight: 600; box-shadow: 0 4px 12px rgba(232, 93, 142, 0.3); transition: all 0.3s ease; display: block;">
                            {{ __('common.checkout') }} <i class="fas fa-arrow-right ms-2"></i>
                        </a>

                        <div class="text-center mt-4">
                            <img src="{{ asset('assets/images/payment.webp') }}" alt="Payments" class="img-fluid opacity-50 payment-image" style="max-height: 35px;">
                        </div>
                    @else
                        <div class="border-0 rounded-3 p-4 text-center mb-0" style="background: rgba(232, 93, 142, 0.05); border: 1px solid rgba(232, 93, 142, 0.1);">
                            <p class="mb-0" style="color: #666; font-size: 14px;">{{ __('common.summary_empty') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .hover-primary:hover { color: var(--primary) !important; }
    .bg-soft-primary { background: var(--primary-10); color: var(--primary); }

    /* Cart Page Animations */
    .modern-card {
        animation: slideInUp 0.6s ease-out;
    }

    .cart-section table tbody tr {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .cart-section table tbody tr:hover {
        background: rgba(232, 93, 142, 0.05);
        transform: translateX(5px);
    }

    .sticky-top {
        animation: slideInDown 0.6s ease-out 0.2s both;
    }

    .modern-btn {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .modern-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(232, 93, 142, 0.4) !important;
    }

    .modern-btn:active {
        transform: translateY(-1px);
    }

    .sticky-top:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(232, 93, 142, 0.2) !important;
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

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .table-responsive {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .badge {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .table tbody tr:hover .badge {
        background: rgba(232, 93, 142, 0.2) !important;
    }

    .payment-image {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .payment-image:hover {
        opacity: 1 !important;
        transform: scale(1.05);
    }
</style>
@endpush

