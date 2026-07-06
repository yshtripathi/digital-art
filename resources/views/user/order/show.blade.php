@extends('user.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="container-fluid px-4 py-5">
    @include('user.layouts.notification')
    
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-5">
      <h1 class="h3 mb-0 text-dark fw-800" style="font-weight: 800; letter-spacing: -0.5px;">Order Detail</h1>
      <div class="d-flex gap-2">
          <a href="{{route('user')}}" class="btn btn-light shadow-sm border-0 px-4 py-2 rounded-4">
              <i class="fas fa-arrow-left me-2"></i> {{ __('common.back') }}
          </a>
          <a href="{{route('order.pdf',$order->id)}}" class="modern-btn modern-btn-solid px-4 py-2 shadow-sm border-0 rounded-4">
              <i class="fas fa-download me-2"></i> {{ __('common.generate_pdf') }}
          </a>
      </div>
    </div>

    @if($order)
        @php
            $currencySymbol = match($order->currency) {
                'USD' => '$',
                'JPY' => '¥',
                'HKD' => 'HK$',
                default => '$',
            };
            $displayAmount = number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2);
        @endphp

        <!-- Order Summary Cards -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card">
                    <div class="stat-icon bg-soft-primary" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;">
                        <i class="fas fa-hashtag"></i>
                    </div>
                    <div class="stat-val" style="font-size: 20px;">{{$order->order_number}}</div>
                    <div class="stat-label">Order Number</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card">
                    <div class="stat-icon bg-soft-success" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-val" style="font-size: 20px;">{{$order->created_at->format('d M, Y')}}</div>
                    <div class="stat-label">Order Date</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card">
                    <div class="stat-icon bg-soft-warning" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="stat-val" style="font-size: 20px;">{{$currencySymbol}}{{$displayAmount}}</div>
                    <div class="stat-label">Total Amount</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="modern-stat-card">
                    <div class="stat-icon bg-soft-info" style="background: rgba(6, 182, 212, 0.1); color: #06b6d4;">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="stat-val" style="font-size: 20px;">{{ucwords($order->status)}}</div>
                    <div class="stat-label">Status</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Order Detailed Info -->
            <div class="col-xl-7">
                <div class="modern-card p-5 border-0 shadow-sm h-100">
                    <h5 class="fw-bold text-dark mb-4">Detailed Information</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <tbody>
                                <tr class="border-bottom border-light">
                                    <td class="py-3 text-muted">Customer Name</td>
                                    <td class="py-3 fw-bold text-dark text-end">{{$order->first_name}} {{$order->last_name}}</td>
                                </tr>
                                <tr class="border-bottom border-light">
                                    <td class="py-3 text-muted">Email Address</td>
                                    <td class="py-3 fw-bold text-dark text-end">{{$order->email}}</td>
                                </tr>
                                <tr class="border-bottom border-light">
                                    <td class="py-3 text-muted">Payment Method</td>
                                    <td class="py-3 fw-bold text-dark text-end">Credit Card / Points</td>
                                </tr>
                                <tr class="border-bottom border-light">
                                    <td class="py-3 text-muted">Payment Status</td>
                                    <td class="py-3 text-end">
                                        <span class="badge bg-soft-success" style="background: rgba(34, 197, 94, 0.1); color: #22c55e; padding: 8px 15px; border-radius: 10px;">
                                            {{ucwords($order->payment_status)}}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 text-muted">Transaction ID</td>
                                    <td class="py-3 fw-bold text-dark text-end text-break">{{$order->trans_id}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Items Summary -->
            <div class="col-xl-5">
                <div class="modern-card p-5 border-0 shadow-sm h-100 bg-light" style="border: 2px dashed rgba(0,0,0,0.05) !important;">
                    <h5 class="fw-bold text-dark mb-4">Order Total</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Quantity</span>
                        <span class="fw-bold text-dark">{{$order->quantity}} Items</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 pb-4 border-bottom">
                        <span class="text-muted">Currency</span>
                        <span class="fw-bold text-dark">{{$order->currency}}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold text-dark mb-0">Total Amount</h4>
                        <h3 class="fw-800 text-primary mb-0" style="font-weight: 800;">{{$currencySymbol}}{{$displayAmount}}</h3>
                    </div>
                    
                    <div class="mt-5">
                        <div class="alert bg-white border-0 shadow-sm rounded-4 p-4 mb-0">
                            <div class="d-flex gap-3 align-items-center text-primary">
                                <i class="fas fa-shield-alt fs-4"></i>
                                <span class="small fw-bold">Verified & Secured Enrollment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
