@extends('user.layouts.master')

@section('main-content')

  <main>

    <!-- hero-area-start -->
    <div class="hero-arera course-item-height" data-background="{{ asset('assets/img/slider/course-slider.jpg') }}">
          <div class="container">
              <div class="row">
                  <div class="col-xl-12">
                      <div class="hero-course-1-text">
                          <h2>{{ __('common.order_detail') }}</h2>
                      </div>
                      <div class="course-title-breadcrumb">
                          <nav>
                              <ol class="breadcrumb">
                                  <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">{{ __('common.order_detail') }}</li>
                              </ol>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- hero-area-end -->

      <section class="cart-area pt-100 pb-100">
				<div class="container">
					<div class="row">
              <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('user.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Order Lists</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($orders)>0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>{{ __('common.order_number') }}</th>
              <th>{{ __('common.name') }}</th>
              <th>{{ __('common.email') }}</th>
              <th>{{ __('common.quantity') }}</th>
              <th>{{ __('common.charge') }}</th>
              <th>{{ __('common.total_amount') }}</th>
              <th>{{ __('common.status') }}</th>
              <th>{{ __('common.action') }}</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>{{ __('common.order_number') }}</th>
              <th>{{ __('common.name') }}</th>
              <th>{{ __('common.email') }}</th>
              <th>{{ __('common.quantity') }}</th>
              <th>{{ __('common.charge') }}</th>
              <th>{{ __('common.total_amount') }}</th>
              <th>{{ __('common.status') }}</th>
              <th>{{ __('common.action') }}</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>${{$order->shipping->price}}</td>
                    <td>${{number_format($order->total_amount,2)}}</td>
                    <td>
                      {{ ucwords($order->status) }}
                    </td>
                    <td>
                        <a href="{{route('user.order.show',$order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <form method="POST" action="{{route('user.order.delete',[$order->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$orders->links()}}</span>
        @else
          <h6 class="text-center">No orders found!!! Please order some products</h6>
        @endif
      </div>
    </div>
  </div>
          </div>
        </div>
      </section>





  </main>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush
