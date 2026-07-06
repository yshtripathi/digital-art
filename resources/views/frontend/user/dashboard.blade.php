@extends('frontend.layouts.main')
@section('title', __('common.dashboard'))
@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.my_account') }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ __('common.my_account') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="account-section pt-80 pb-80" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%); position: relative; overflow: hidden;">
    
    <div class="container">
        <div class="row g-4" style="padding-top: 60px; padding-bottom: 60px;">
            <!-- Left: Stats Cards -->
            <div class="col-lg-3">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="modern-card stat-card p-4 border-0 overflow-hidden" style="border-radius: 24px; position: relative; background: rgba(255,255,255,0.6); border: 1.5px solid rgba(232, 93, 142, 0.1); box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15);">
                            <div class="position-absolute top-0 end-0 w-50 h-100" style="background: linear-gradient(135deg, rgba(232, 93, 142, 0.1) 0%, transparent 100%); border-radius: 24px;"></div>
                            <div class="position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <i class="fas fa-star fa-2x" style="color: #E85D8E; opacity: 0.9;"></i>
                                    <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-size: 10px; padding: 4px 8px; font-weight: 600;">{{ __('common.balance') }}</span>
                                </div>
                                <p class="text-muted mb-2" style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #999;">{{ __('common.available_points') }}</p>
                                <h3 class="mb-0 fw-800" style="color: #0a0e27; font-size: 28px;">{{ Auth::user()->points_balance ?? 0 }} <span style="font-size: 18px; color: #E85D8E; font-weight: 600;">{{ __('common.credits') }}</span></h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="modern-card stat-card p-4 border-0 overflow-hidden" style="border-radius: 24px; position: relative; background: rgba(255,255,255,0.6); border: 1.5px solid rgba(232, 93, 142, 0.1); box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15);">
                            <div class="position-absolute top-0 end-0 w-50 h-100" style="background: linear-gradient(135deg, rgba(200, 107, 250, 0.1) 0%, transparent 100%); border-radius: 24px;"></div>
                            <div class="position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <i class="fas fa-palette fa-2x" style="color: #C86BFA; opacity: 0.9;"></i>
                                    <span class="badge rounded-2" style="background: rgba(200, 107, 250, 0.15); color: #C86BFA; font-size: 10px; padding: 4px 8px; font-weight: 600;">{{ __('common.artworks') }}</span>
                                </div>
                                <p class="text-muted mb-2" style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #999;">{{ __('common.artworks_enrolled') }}</p>
                                <h3 class="mb-0 fw-800" style="color: #0a0e27; font-size: 28px;">{{ isset($redeemedOrders) ? count($redeemedOrders) : 0 }}</h3>
                            </div>
                        </div>
                    </div>

                    {{--<div class="col-12">
                       
                            <div class="position-absolute top-0 end-0 w-50 h-100" style="background: linear-gradient(135deg, rgba(232, 93, 142, 0.1) 0%, transparent 100%); border-radius: 24px;"></div>
                            <div class="position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <i class="fas fa-check-circle fa-2x" style="color: #E85D8E; opacity: 0.9;"></i>
                                    <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-size: 10px; padding: 4px 8px; font-weight: 600;">{{ __('common.stats') }}</span>
                                </div>
                                <p class="text-muted mb-2" style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #999;">{{ __('common.completed') }}</p>
                                <h3 class="mb-0 fw-800" style="color: #0a0e27; font-size: 28px;">{{ isset($redeemedOrders) ? count($redeemedOrders->where('status', 'Completed')) : 0 }}</h3>
                            </div>
                        </div>
                    </div>--}}

                    <div class="col-12">
                        <div class="modern-card stat-card p-4 border-0 overflow-hidden" style="border-radius: 24px; position: relative; background: rgba(255,255,255,0.6); border: 1.5px solid rgba(232, 93, 142, 0.1); box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15);">
                            <div class="position-absolute top-0 end-0 w-50 h-100" style="background: linear-gradient(135deg, rgba(232, 93, 142, 0.08) 0%, transparent 100%); border-radius: 24px;"></div>
                            <div class="position-relative">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <i class="fas fa-calendar-alt fa-2x" style="color: #E85D8E; opacity: 0.9;"></i>
                                    <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-size: 10px; padding: 4px 8px; font-weight: 600;">{{ __('common.member') }}</span>
                                </div>
                                <p class="text-muted mb-2" style="font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #999;">{{ __('common.member_since') }}</p>
                                <h3 class="mb-0 fw-800" style="color: #0a0e27; font-size: 28px;">{{ Auth::user()->created_at->format('M') }}<span style="font-size: 16px; color: #E85D8E; font-weight: 600;"> {{ Auth::user()->created_at->format('Y') }}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Navigation and Tab Content -->
            <div class="col-lg-9" style="margin: 0 auto; max-width: 800px;">
                <!-- Navigation Tabs -->
                <ul class="nav nav-tabs border-0 shadow-sm p-3 p-md-4 mb-4" id="dashboardTabs" role="tablist" style="border-radius: 24px; background: rgba(255,255,255,0.6); border: 1px solid rgba(232, 93, 142, 0.1);">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold" id="points-purchased-tab" data-bs-toggle="tab" data-bs-target="#points-purchased" type="button" role="tab" aria-controls="points-purchased" aria-selected="true" style="color: #666; font-size: 15px;">
                            <i class="fas fa-gift me-2"></i>{{ __('common.points_purchased') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="points-redeemed-tab" data-bs-toggle="tab" data-bs-target="#points-redeemed" type="button" role="tab" aria-controls="points-redeemed" aria-selected="false" style="color: #666; font-size: 15px;">
                            <i class="fas fa-palette me-2"></i>{{ __('common.points_redeemed') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" aria-selected="false" style="color: #666; font-size: 15px;">
                            <i class="fas fa-lock me-2"></i>{{ __('common.change_password') }}
                        </button>
                    </li>
                    <li class="ms-auto">
                        <a href="{{ route('user.logout') }}" class="nav-link fw-bold" style="font-size: 15px; color: #E85D8E;">
                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('common.logout') }}
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="dashboardContent" style="width: 100%; display: flex; justify-content: center;">
            <!-- Points Purchased Tab -->
            <div class="tab-pane fade show active" id="points-purchased" role="tabpanel" aria-labelledby="points-purchased-tab" style="width: 100%;">
                <div class="modern-card border-0 shadow-lg p-4 p-md-5" style="border-radius: 24px; border: 1.5px solid rgba(232, 93, 142, 0.1); background: rgba(255,255,255,0.6); box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15); max-width: 700px; margin: 0 auto;">
                    <h3 class="mb-4 fw-bold" style="color: #0a0e27;">
                        <i class="fas fa-gift me-2" style="color: #E85D8E;"></i>{{ __('common.points_purchased_wallet') }}
                    </h3>

                    @if(isset($purchasedOrders) && count($purchasedOrders) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead style="background: rgba(232, 93, 142, 0.08); border-bottom: 2px solid rgba(232, 93, 142, 0.2);">
                                    <tr>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.order_number') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.points_bought') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.price_paid') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.payment_status') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.date') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchasedOrders as $order)
                                    <tr>
                                        <td class="fw-bold" style="color: #0a0e27;">{{ $order->order_number }}</td>
                                        <td>
                                            <span class="badge rounded-2" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; font-weight: 600;">
                                                <i class="fas fa-star me-1"></i>{{ number_format($order->cart_info->sum('points')) }} {{ __('common.credits') }}
                                            </span>
                                        </td>
                                        <td style="color: #0a0e27;">{{ Helper::getCurrencySymbol($order->currency) }}{{ number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2) }}</td>
                                        <td>
                                            @if($order->payment_status === 'Completed')
                                                <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-weight: 600;">{{ __('common.paid') }}</span>
                                            @elseif($order->payment_status === 'Failed')
                                                <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; font-weight: 600;">{{ __('common.failed') }}</span>
                                            @else
                                                <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.12); color: #E85D8E; font-weight: 600;">{{ __('common.pending') }}</span>
                                            @endif
                                        </td>
                                        <td style="color: #0a0e27;">{{ $order->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{route('user.order.show', $order->id)}}" class="btn btn-sm" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; border: 1px solid rgba(232, 93, 142, 0.2); border-radius: 10px; font-weight: 600; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                                <i class="fas fa-eye me-1"></i>{{ __('common.view') }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-4x mb-3" style="color: rgba(232, 93, 142, 0.15);"></i>
                            <h5 class="mt-3" style="color: #0a0e27; font-weight: 700;">{{ __('common.no_past_orders') }}</h5>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Points Redeemed Tab -->
            <div class="tab-pane fade" id="points-redeemed" role="tabpanel" aria-labelledby="points-redeemed-tab" style="width: 100%;">
                <div class="modern-card border-0 shadow-lg p-4 p-md-5" style="border-radius: 24px; border: 1.5px solid rgba(232, 93, 142, 0.1); background: rgba(255,255,255,0.6); box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15); max-width: 700px; margin: 0 auto;">
                    <h3 class="mb-4 fw-bold" style="color: #0a0e27;">
                        <i class="fas fa-palette me-2" style="color: #E85D8E;"></i>{{ __('common.points_redeemed_courses') }}
                    </h3>

                    @if(isset($redeemedOrders) && count($redeemedOrders) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead style="background: rgba(232, 93, 142, 0.08); border-bottom: 2px solid rgba(232, 93, 142, 0.2);">
                                    <tr>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.order_number') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.artwork_name') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.level') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.points_used') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.status') }}</th>
                                        <th style="color: #E85D8E; font-weight: 600;">{{ __('common.date') }}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($redeemedOrders as $order)
                                    @php
                                        $cartItem = $order->cart_info->first();
                                        $level = null;
                                        if($cartItem) {
                                            $level = \App\Models\ProductLevel::where('course_id', $cartItem->product_id)
                                                                             ->where('price_in_points', $cartItem->points)
                                                                             ->first();
                                        }
                                    @endphp
                                    <tr>
                                        <td class="fw-bold" style="color: #0a0e27;">{{ $order->order_number }}</td>
                                        <td style="color: #0a0e27;">{{ $cartItem ? $cartItem->product->title : 'N/A' }}</td>
                                        <td>
                                            @if($level)
                                                <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-weight: 600;">{{ $level->skill_level }}</span>
                                            @else
                                                <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.1); color: #999; font-weight: 600;">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge rounded-2" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; font-weight: 600;">
                                                <i class="fas fa-star me-1"></i>{{ number_format($order->cart_info->sum('points')) }} {{ __('common.credits') }}
                                            </span>
                                        </td>
                                        <td>
                                            @if(strtolower($order->status) === 'completed')
                                                <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.15); color: #E85D8E; font-weight: 600;">{{ __('common.redeemed') }}</span>
                                            @else
                                                <span class="badge rounded-2" style="background: rgba(232, 93, 142, 0.12); color: #E85D8E; font-weight: 600;">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td style="color: #0a0e27;">{{ $order->created_at->format('d M Y') }}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-book fa-4x mb-3" style="color: rgba(232, 93, 142, 0.15);"></i>
                            <h5 class="mt-3" style="color: #0a0e27; font-weight: 700;">{{ __('common.no_past_orders') }}</h5>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Change Password Tab -->
            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab" style="width: 100%;">
                <div class="modern-card border-0 shadow-lg p-4 p-md-5" style="border-radius: 24px; border: 1.5px solid rgba(232, 93, 142, 0.1); background: rgba(255,255,255,0.6); box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15); max-width: 700px; margin: 0 auto;">
                    <h3 class="mb-4 fw-bold" style="color: #0a0e27;">
                        <i class="fas fa-lock me-2" style="color: #E85D8E;"></i>{{ __('common.change_password') }}
                    </h3>

                    <form action="{{ route('change.password') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-bold" style="color: #0a0e27; font-size: 15px;">{{ __('common.current_password') }}</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="{{ __('common.current_password_placeholder') }}" style="border-radius: 12px; border: 1.5px solid rgba(232, 93, 142, 0.15); padding: 12px 16px; font-size: 15px; background: rgba(255,255,255,0.8); transition: all 0.3s ease;">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="form-label fw-bold" style="color: #0a0e27; font-size: 15px;">{{ __('common.new_password') }}</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="{{ __('common.new_password_placeholder') }}" style="border-radius: 12px; border: 1.5px solid rgba(232, 93, 142, 0.15); padding: 12px 16px; font-size: 15px; background: rgba(255,255,255,0.8); transition: all 0.3s ease;">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_confirm_password" class="form-label fw-bold" style="color: #0a0e27; font-size: 15px;">{{ __('common.confirm_password') }}</label>
                            <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" id="new_confirm_password" name="new_confirm_password" placeholder="{{ __('common.confirm_password_placeholder') }}" style="border-radius: 12px; border: 1.5px solid rgba(232, 93, 142, 0.15); padding: 12px 16px; font-size: 15px; background: rgba(255,255,255,0.8); transition: all 0.3s ease;">
                            @error('new_confirm_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn fw-bold" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; border-radius: 12px; padding: 12px 32px; font-size: 15px; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); width: 100%; margin-top: 8px;">
                            <i class="fas fa-check me-2"></i>{{ __('common.update_password') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .account-section {
        position: relative;
    }

    .modern-blob {
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        animation: blobAnimation 8s infinite;
        opacity: 0.6;
    }

    .modern-blob-1 {
        animation-delay: 0s;
    }

    .modern-blob-2 {
        animation-delay: 4s;
    }

    @keyframes blobAnimation {
        0%, 100% {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            transform: translate(0, 0);
        }
        33% {
            border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
            transform: translate(20px, -20px);
        }
        66% {
            border-radius: 70% 30% 70% 30% / 30% 70% 70% 30%;
            transform: translate(-20px, 20px);
        }
    }

    .stat-card {
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        animation: slideInUp 0.6s ease-out;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(232, 93, 142, 0.2) !important;
        border-color: rgba(232, 93, 142, 0.2) !important;
    }

    .modern-card {
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 40px rgba(232, 93, 142, 0.2) !important;
    }

    .nav-tabs {
        gap: 8px;
    }

    .nav-tabs .nav-link {
        color: #666;
        border: none;
        border-bottom: 3px solid transparent;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        font-size: 15px;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 12px 12px 0 0;
    }

    .nav-tabs .nav-link:hover {
        color: #E85D8E;
        background-color: rgba(232, 93, 142, 0.05);
        border-bottom-color: rgba(232, 93, 142, 0.3);
    }

    .nav-tabs .nav-link.active {
        color: #E85D8E;
        border-bottom-color: #E85D8E;
        background: rgba(232, 93, 142, 0.05);
    }

    .tab-content {
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    table {
        border-collapse: separate;
        border-spacing: 0;
    }

    table thead th {
        background: rgba(232, 93, 142, 0.08);
        color: #E85D8E;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        padding: 16px 12px;
    }

    table tbody tr {
        border-bottom: 1px solid rgba(232, 93, 142, 0.1);
        transition: all 0.2s ease;
    }

    table tbody tr:hover {
        background-color: rgba(232, 93, 142, 0.04);
    }

    table tbody td {
        padding: 14px 12px;
        vertical-align: middle;
    }

    .badge {
        font-weight: 700;
        padding: 6px 12px;
        font-size: 12px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .btn-sm {
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        padding: 8px 14px;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .btn-sm:hover {
        background-color: #E85D8E !important;
        color: white !important;
        border-color: #E85D8E !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(232, 93, 142, 0.3);
    }

    .text-center h5 {
        font-weight: 700;
        color: #0a0e27;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .stat-card h3 {
            font-size: 24px !important;
        }

        .nav-tabs {
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .nav-tabs .nav-link {
            padding: 10px 16px;
            font-size: 14px;
            white-space: nowrap;
        }
    }
</style>

@endsection

