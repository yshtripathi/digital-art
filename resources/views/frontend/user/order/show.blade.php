@extends('frontend.layouts.main')
@section('title','Order Details')

@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.order_detail') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.order_detail') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

      <section class="order-area pt-80 pb-80" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
        <div class="container">
          <div class="row" style="padding-top: 60px; padding-bottom: 60px;">
            <div class="col-lg-8 mx-auto">
              @if($order)
              <div class="modern-card border-0 shadow-lg p-5" style="border-radius: 24px; border: 1.5px solid rgba(232, 93, 142, 0.1); background: rgba(255,255,255,0.6); box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15);">

                <!-- Header with Actions -->
                <div class="d-flex justify-content-between align-items-center mb-5 pb-4 border-bottom" style="border-color: rgba(232, 93, 142, 0.1);">
                  <h3 class="fw-bold mb-0" style="color: #0a0e27;">{{ __('common.order_detail') }}</h3>
                  <div class="d-flex gap-2">
                    <button onclick="window.history.back();" class="btn btn-sm fw-bold" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; border: 1px solid rgba(232, 93, 142, 0.2); border-radius: 10px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                      <i class="fas fa-arrow-left me-1"></i> {{ __('common.back') }}
                    </button>
                    <a href="{{route('order.pdf',$order->id)}}" class="btn btn-sm fw-bold" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 10px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                      <i class="fas fa-download me-1"></i> {{ __('common.generate_pdf') }}
                    </a>
                  </div>
                </div>

                <!-- Order Summary Table -->
                <div class="mb-5">
                  <h5 class="fw-bold mb-3" style="color: #0a0e27;">{{ __('common.order_summary') }}</h5>
                  <div class="table-responsive">
                    <table class="table table-hover align-middle">
                      <thead style="background: rgba(232, 93, 142, 0.08); border-bottom: 2px solid rgba(232, 93, 142, 0.2);">
                        <tr>
                          <th style="color: #E85D8E; font-weight: 600;">{{ __('common.order_number') }}</th>
                          <th style="color: #E85D8E; font-weight: 600;">{{ __('common.name') }}</th>
                          <th style="color: #E85D8E; font-weight: 600;">{{ __('common.email') }}</th>
                          <th style="color: #E85D8E; font-weight: 600;">{{ __('common.quantity') }}</th>
                          <th style="color: #E85D8E; font-weight: 600;">{{ __('common.total_amount') }}</th>
                          <th style="color: #E85D8E; font-weight: 600;">{{ __('common.status') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="fw-bold" style="color: #0a0e27;">{{$order->order_number}}</td>
                          <td style="color: #0a0e27;">{{$order->first_name}} {{$order->last_name}}</td>
                          <td style="color: #0a0e27;">{{$order->email}}</td>
                          <td style="color: #0a0e27;">{{$order->quantity}}</td>
                          <td>
                            @php
                              $currency = match($order->currency) {
                                  'USD' => '$',
                                  'JPY' => '¥',
                                  'HKD' => 'HK$',
                                  default => '$',
                              };
                            @endphp
                            <span class="badge rounded-2" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; font-weight: 600;">
                              {{ $currency }} {{number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2)}}
                            </span>
                          </td>
                          <td>
                            <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-weight: 600;">{{ ucwords($order->status) }}</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- Order Information -->
                <div class="p-4 rounded-3" style="background: rgba(232, 93, 142, 0.08); border: 1px solid rgba(232, 93, 142, 0.1);">
                  <h5 class="fw-bold mb-4" style="color: #0a0e27;"><i class="fas fa-info-circle me-2" style="color: #E85D8E;"></i>{{ __('common.order_information') }}</h5>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <p class="small fw-bold mb-1" style="color: #E85D8E; text-transform: uppercase;">{{ __('common.order_number') }}</p>
                        <p class="mb-0" style="color: #0a0e27;">{{$order->order_number}}</p>
                      </div>
                      <div class="mb-3">
                        <p class="small fw-bold mb-1" style="color: #E85D8E; text-transform: uppercase;">{{ __('common.order_date') }}</p>
                        <p class="mb-0" style="color: #0a0e27;">{{$order->created_at->format('D d M, Y')}} {{ __('common.at_time') }} {{$order->created_at->format('g : i a')}}</p>
                      </div>
                      <div class="mb-3">
                        <p class="small fw-bold mb-1" style="color: #E85D8E; text-transform: uppercase;">{{ __('common.quantity') }}</p>
                        <p class="mb-0" style="color: #0a0e27;">{{$order->quantity}}</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <p class="small fw-bold mb-1" style="color: #E85D8E; text-transform: uppercase;">{{ __('common.order_status') }}</p>
                        <p class="mb-0"><span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-weight: 600;">{{ ucwords($order->status) }}</span></p>
                      </div>
                      <div class="mb-3">
                        <p class="small fw-bold mb-1" style="color: #E85D8E; text-transform: uppercase;">{{ __('common.total_amount') }}</p>
                        <p class="mb-0" style="color: #0a0e27; font-weight: 600; font-size: 16px;">{{ $currency }} {{number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2)}}</p>
                      </div>
                      <div class="mb-3">
                        <p class="small fw-bold mb-1" style="color: #E85D8E; text-transform: uppercase;">{{ __('common.payment_status') }}</p>
                        <p class="mb-0"><span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-weight: 600;">{{ ucwords($order->payment_status) }}</span></p>
                      </div>
                    </div>
                  </div>
                  <div class="row g-3 mt-2">
                    <div class="col-md-6">
                      <div>
                        <p class="small fw-bold mb-1" style="color: #E85D8E; text-transform: uppercase;">{{ __('common.payment_method') }}</p>
                        <p class="mb-0" style="color: #0a0e27;">{{ __('common.credit_card') }}</p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div>
                        <p class="small fw-bold mb-1" style="color: #E85D8E; text-transform: uppercase;">{{ __('common.transaction_id') }}</p>
                        <p class="mb-0" style="color: #0a0e27;">{{ $order->trans_id }}</p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              @endif
            </div>
          </div>
        </div>
      </section>

@endsection

@push('styles')
<style>
    .order-area {
        min-height: calc(100vh - 400px);
    }

    .modern-card {
        animation: slideInUp 0.6s ease-out;
    }

    .btn {
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 16px rgba(232, 93, 142, 0.2);
    }

    .table tbody tr:hover {
        background-color: rgba(232, 93, 142, 0.05);
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
        .order-area {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        .modern-card {
            padding: 20px !important;
        }

        .d-flex.gap-2 {
            flex-direction: column;
        }

        .btn-sm {
            width: 100%;
        }
    }
</style>
@endpush
