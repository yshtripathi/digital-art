@extends('user.layouts.master')

@section('main-content')
<div class="container-fluid px-4 py-5">
    @include('user.layouts.notification')
    
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-5">
      <h1 class="h3 mb-0 text-dark fw-800" style="font-weight: 800; letter-spacing: -0.5px;">User Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row g-4 mb-5">
      <!-- Total Orders -->
      <div class="col-xl-4 col-md-6">
        <div class="modern-stat-card">
          <div class="stat-icon bg-soft-primary" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="stat-val">{{\App\Models\Order::where('user_id', auth()->user()->id)->count()}}</div>
          <div class="stat-label">Total Orders</div>
        </div>
      </div>

      <!-- Pending Reviews -->
      <div class="col-xl-4 col-md-6">
        <div class="modern-stat-card">
          <div class="stat-icon bg-soft-success" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
            <i class="fas fa-star"></i>
          </div>
          <div class="stat-val">{{\App\Models\ProductReview::where('user_id', auth()->user()->id)->count()}}</div>
          <div class="stat-label">My Reviews</div>
        </div>
      </div>

      <!-- User Points -->
      <div class="col-xl-4 col-md-6">
        <div class="modern-stat-card">
          <div class="stat-icon bg-soft-warning" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
            <i class="fas fa-coins"></i>
          </div>
          <div class="stat-val">{{number_format(auth()->user()->points_balance ?? 0)}}</div>
          <div class="stat-label">Points Balance</div>
        </div>
      </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="row">
      @php
          $orders = DB::table('orders')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
      @endphp
      
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-white border-0 py-4 px-4">
            <h5 class="mb-0 fw-bold text-dark">Recent Orders</h5>
          </div>
          <div class="table-responsive">
            <table class="table align-middle table-hover" id="order-dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Order No.</th>
                  <th>Quantity</th>
                  <th>Total Amount</th>
                  <th>Status</th>
                  <th class="text-end">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(count($orders)>0)
                  @foreach($orders as $order)   
                    <tr>
                        <td><span class="text-muted fw-500">#{{$order->id}}</span></td>
                        <td><span class="fw-bold text-dark">{{$order->order_number}}</span></td>
                        <td>{{$order->quantity}}</td>
                        <td><span class="fw-bold text-dark">${{number_format($order->total_amount,2)}}</span></td>
                        <td>
                            @if($order->status=='new')
                              <span class="badge bg-soft-primary" style="background: rgba(99, 102, 241, 0.1); color: #6366f1;">New</span>
                            @elseif($order->status=='process')
                              <span class="badge bg-soft-warning" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">Processing</span>
                            @elseif($order->status=='delivered')
                              <span class="badge bg-soft-success" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">Delivered</span>
                            @else
                              <span class="badge bg-soft-danger" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">{{$order->status}}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{route('user.order.show',$order->id)}}" class="btn btn-light btn-sm border-0 rounded-circle" style="width: 35px; height: 35px; line-height: 23px;" data-toggle="tooltip" title="View"><i class="fas fa-eye small text-primary"></i></a>
                            
                            <form method="POST" action="{{route('user.order.delete',[$order->id])}}" class="d-inline">
                              @csrf 
                              @method('delete')
                              <button class="btn btn-light btn-sm border-0 rounded-circle dltBtn" data-id={{$order->id}} style="width: 35px; height: 35px; line-height: 23px;" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt small text-danger"></i></button>
                            </form>
                        </td>
                    </tr>  
                  @endforeach
                @else
                  <tr>
                    <td colspan="6" class="text-center py-5">
                      <div class="py-4">
                        <i class="fas fa-shopping-cart fa-3x text-light mb-3"></i>
                        <h4 class="text-dark opacity-50">No orders found yet</h4>
                        <p class="text-muted">Explore our courses and start learning today!</p>
                        <a href="{{route('product-lists')}}" class="modern-btn modern-btn-solid mt-3">Browse Courses</a>
                      </div>
                    </td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="card-footer bg-white border-0 py-4 px-4 d-flex justify-content-center">
            {{$orders->links()}}
          </div>
        </div>
      </div>
    </div>
</div>
@endsection