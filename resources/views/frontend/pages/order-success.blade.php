@extends('frontend.layouts.main')
@section('title','Order Success')
@php
use App\Models\Order;
$order = Order::where('trans_id', $transaction_id)->first();
@endphp
@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title"><i class="fas fa-check-circle me-3" style="color: #E85D8E;"></i>{{ __('common.order_success') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.order_success') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="success-section pt-100 pb-100" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-9">
                <div class="modern-success-card p-5 border-0" style="border-radius: 28px; border: 1.5px solid rgba(232, 93, 142, 0.1); background: rgba(255, 255, 255, 0.6); box-shadow: 0 30px 80px rgba(232, 93, 142, 0.2); animation: slideInUp 0.6s ease-out;">
                    <div class="text-center mb-5">
                        <div class="success-icon-container d-inline-block position-relative mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: linear-gradient(135deg, rgba(232, 93, 142, 0.15) 0%, rgba(200, 107, 250, 0.1) 100%); border: 2px solid rgba(232, 93, 142, 0.2);">
                                <i class="fas fa-check-circle" style="font-size: 60px; color: #E85D8E;"></i>
                            </div>
                        </div>

                        <h2 class="fw-bold mb-2" style="font-size: 32px; letter-spacing: -1px; color: #0a0e27;">{{ __('common.order_successful') }}</h2>
                        <p class="text-muted mb-5" style="font-size: 16px; line-height: 1.6; color: #666;">{{ __('common.thank_you_order') }} {{ __('common.enrollment_confirmed') }}</p>
                    </div>

                    @if($order)
                    <div class="order-info-grid mb-5">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3" style="background: rgba(232, 93, 142, 0.08); border: 1px solid rgba(232, 93, 142, 0.1);">
                                    <div class="text-uppercase small fw-bold mb-2" style="color: #E85D8E; letter-spacing: 0.5px;">{{ __('common.order_number') }}</div>
                                    <div class="fw-bold text-dark" style="font-size: 18px; color: #0a0e27;">{{ $order->order_number }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3" style="background: rgba(232, 93, 142, 0.08); border: 1px solid rgba(232, 93, 142, 0.1);">
                                    <div class="text-uppercase small fw-bold mb-2" style="color: #E85D8E; letter-spacing: 0.5px;">{{ __('common.total_amount') }}</div>
                                    <div class="fw-bold text-dark" style="font-size: 18px; color: #0a0e27;">
                                        @php
                                            $currency = match($order->currency) {
                                                'USD' => '$',
                                                'JPY' => 'Â¥',
                                                'HKD' => 'HK$',
                                                default => '$',
                                            };
                                        @endphp
                                        {{ $currency }} {{number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2)}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3" style="background: rgba(232, 93, 142, 0.08); border: 1px solid rgba(232, 93, 142, 0.1);">
                                    <div class="text-uppercase small fw-bold mb-2" style="color: #E85D8E; letter-spacing: 0.5px;">{{ __('common.transaction_id') }}</div>
                                    <div class="fw-bold text-dark" style="font-size: 18px; color: #0a0e27;">{{ $transaction_id }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card p-4 rounded-3" style="background: rgba(232, 93, 142, 0.12); border: 1px solid rgba(232, 93, 142, 0.2);">
                                    <div class="text-uppercase small fw-bold mb-2" style="color: #E85D8E; letter-spacing: 0.5px;">{{ __('common.payment_status') }}</div>
                                    <div class="fw-bold text-dark" style="font-size: 18px;">
                                        <span class="badge rounded-2 px-3 py-2" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; font-weight: 600;">{{ ucwords($order->payment_status) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center mt-5">
                        <a href="{{route('user.order.show',$order->id)}}" class="btn rounded-3 px-5 py-3 fw-bold" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            <i class="fas fa-eye me-2"></i>{{ __('common.view_details') }}
                        </a>
                        <a href="{{route('home')}}" class="btn rounded-3 px-5 py-3 fw-bold" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; border: 2px solid rgba(232, 93, 142, 0.3); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            <i class="fas fa-home me-2"></i>{{ __('common.home') }}
                        </a>
                        @if($order)
                            <a href="{{route('order.pdf',$order->id)}}" class="btn rounded-3 px-5 py-3 fw-bold" style="background: rgba(232, 93, 142, 0.08); color: #E85D8E; border: 1px solid rgba(232, 93, 142, 0.2); transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                <i class="fas fa-download me-2"></i>{{ __('common.download_pdf_invoice') }}
                            </a>
                        @endif
                    </div>

                    @if($email_status=='inactive')
                        <div class="mt-5 pt-4 border-top" style="border-color: rgba(232, 93, 142, 0.1);">
                            <p class="text-muted mb-0" style="font-size: 14px; line-height: 1.6; color: #666;">{{ __('common.high_traffic') }} <a href="{{route('order.pdf',$order->id)}}" class="fw-bold" style="color: #E85D8E; text-decoration: none;">{{ __('common.download_pdf_invoice') }}</a></p>
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
    .success-section {
        background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);
    }

    .modern-success-card {
        animation: slideInUp 0.6s ease-out;
    }

    .success-icon-container i {
        animation: scaleIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
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

    .info-card {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .info-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(232, 93, 142, 0.15);
        border-color: rgba(232, 93, 142, 0.2) !important;
    }

    .btn {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(232, 93, 142, 0.3);
    }

    @media (max-width: 768px) {
        .success-section {
            padding-top: 60px !important;
            padding-bottom: 60px !important;
        }

        .modern-success-card {
            padding: 30px !important;
        }

        .d-flex.flex-md-row {
            flex-direction: column !important;
        }

        .btn {
            width: 100%;
        }
    }
</style>
@endpush

