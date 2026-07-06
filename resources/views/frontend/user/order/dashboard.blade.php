@extends('frontend.layouts.main')
@section('main-content')
<style>
    .contact-three__input-title {
        margin-bottom: 0px; margin-top: 10px;
    }
    .btn-style-two{
            padding: 5px 10px;
    }
</style>
<div class="tl-breadcrumb pt-120 pb-120">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">  {{ __('common.my_account') }} </h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="lnr lnr-icon-chevron-right"></i>

</span
                        ><span><a href="#"> {{ __('common.my_account') }} </a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="accunt-info position-relative">         
  <div class="container position-relative pb-0">
    <h2 class="mt-1 mb-5 text-center text-white"> Account Information </h2>
    <!-- Nav Tabs List -->
    
     
        <div class="nav flex-column  nav-vertical product__categories" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <ul class="list-unstyled">        
            <li>
              <a class="nav-link thm-btn show active" id="change-password-tab" data-bs-toggle="pill" href="#change-password" role="tab" aria-controls="change-password" aria-selected="true">
                <span class="product-categories__icon">
                 <i class="fas fa-long-arrow-right"></i>
                </span>{{ __('common.change_password') }}</a>
            </li>
      
            <li>
              <a class="nav-link thm-btn" id="orderhistory-tab" data-bs-toggle="pill" href="#orderhistory" role="tab" aria-controls="orderhistory" aria-selected="false">
                <span class="product-categories__icon">
                 <i class="fas fa-long-arrow-right"></i>
                </span> {{ __('common.order_history') }}</a>
            </li>
            <li>
              <a class="nav-link thm-btn" href="{{ route('user.logout') }}" >
                <span class="product-categories__icon">
               <i class="fas fa-long-arrow-right"></i>
                </span> {{ __('common.logout') }} </a>
            </li>
          </ul>
        </div>     
    
        <!-- Nav Tabs Content -->
        <div class="tab-content accordion-item card_brder mb-5" id="myTabContent">
           <div class="shpebrdertp-left"></div>
                            <div class="shpebrdertp-right"></div>
                            <div class="shpebrderbtm-left"></div>
                            <div class="shpebrderbtm-right"></div>
          <div class="tab-pane" data-aos="fade-in" data-aos-duration="800" id="edit-account" role="tabpanel" aria-labelledby="my-account-tab">
                
          <h2 class="accordion-header d-md-none" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Home</button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#myTabContent">
              <div class="accordion-body">
                
                <div class="text-center mb-5">
                  <h4 class="mb-1">My Account Information</h4>
                 <p class="subtitle">Presonal Information</p>
                </div>
                <form>
                           <div class="row">
                                        <div class="col-xl-8 col-lg-8 offset-lg-2">                                          
                                            <div class="mb-3">
                                                  <label> Full Name</label>
                                                <input type="text" class="form-control"" name="name" class="form-control" placeholder="Jhon Doe" required="" aria-required="true">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6">
                                         
                                             <div class="mb-3">
                                                    <label> Email Address</label>
                                                <input type="email"  class="form-control"" name="email" class="form-control" placeholder="jhon@doman.com" required="" aria-required="true">
                                            </div>
                                        </div>
                                      </div>                                      
                                      
                                            <div class="contact-three__btn-box d-flex">
                                                <button type="submit" class="theme-btn btn-style-one me-auto"><span> Continue </span></button>
                                                      

                                            </div>                                       
                                   
                 
                </form>
              </div>
            </div>
          </div>
          <div class="tab-pane accordion-item show active" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
            <h2 class="accordion-header d-md-none" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Profile</button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse d-md-block" aria-labelledby="headingTwo" data-bs-parent="#myTabContent">
               <div class="accordion-body">
                <!--start change password info-->
                <div class="text-center">
                 <h3> {{ __('common.change_password') }} </h3>
                  
                </div>
                @if (session('success'))
    <div class="text-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="text-danger">
        {{ session('error') }}
    </div>
@endif
               <form method="POST" action="{{route('change.password')}}" id="passwordform">
                 @csrf
                  <div class="row m-0">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">                                          
                                          
                                            <h6 class="contact-three__input-title mb-2">{{ __('common.old_password') }}</h6>
                                            <div class="contact-three__input-box">
                                                <input type="password" name="current_password" id="oldpswrd" class="form-control" />
                                            </div>
</div>
                                       <div class="col-xl-6 col-lg-6 col-md-6 col-12"> 
                                            <h6 class="contact-three__input-title mb-2">{{ __('common.new_password') }} </h6>
                                            <div class="contact-three__input-box">
                                               <input id="new_password" type="password" name="new_password" class="form-control"  />
                                            </div>
                                             </div> 
                                          </div>  
                                      <div class="row m-0 align-items-center">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">       
                                          <h6 class="contact-three__input-title mb-2">{{ __('common.confirm_password') }}  </h6>
                                            <div class="contact-three__input-box">
                                                 <input id="cnfrm_pswrd" type="password" name="new_confirm_password" class="form-control" />
                                            </div>
                                           </div>
                                           <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                             <div class="contact-three__btn-box d-flex mt-5 mb-3 float-end">
                                                <button type="submit" class="theme-btn btn-style-one me-auto"><span>{{ __('common.change_password') }}</span></button>
                                             </div>
                                            </div>  
                                         </div>

                </form>
                <!-- end change password -->
              </div>
            </div>
          </div>   
       
          <div class="tab-pane accordion-item" id="orderhistory" role="tabpanel" aria-labelledby="orderhistory-tab">
            <h2 class="accordion-header d-md-none" id="headingfour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">{{ __('common.order_history') }}</button>
            </h2>
            <div id="collapsefive" class="accordion-collapse collapse d-md-block" aria-labelledby="headingfive" data-bs-parent="#myTabContent">
             <div class="accordion-body">
                <!-- start order list -->
                <h2 class="text-center mb-4">{{ __('common.orders') }}</h2>
                <div class="order-list">
                  <div class="table-responsive">
                     @if(count($orders)>0)
                    <table class="table table-bordered table-hover table-striped">
                      <tr>
                        <th>S.N.</th>
              <th>{{ __('common.order_number') }}</th>
              <th>{{ __('common.name') }}</th>
             
              <th>{{ __('common.total_amount') }}</th>
              <th>{{ __('common.status') }}</th>
              <th>{{ __('common.action') }}</th>
                      </tr>
                        @foreach($orders as $order)
                      <tr>
                        <td>{{$loop->iteration}}</td>
                       <td>{{$order->order_number}}<br> <span class='text-secondary'>Date: {{$order->created_at->format('d-M-y')}}</span> </td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                        <td>{{$order->currency}}
  {{number_format($order->total_amount, $order->currency=='JPY' ? 0 : 2)}}                            
                            </td>
                        <td>
                      {{ ucwords($order->status) }}
                    </td>
                        <td class="product-select">
                      <a href="{{route('user.order.show',$order->id)}}"  data-toggle="tooltip" title="view" data-placement="bottom" class="theme-btn btn-style-two"><span class="icon-angles-right"></span> {{ __('common.view_details') }}</a>
                          
                          
                                            <!--<a class="thm-btn wishlist-page__btn" href="javascript:void(0)"> <span class="icon-angles-right"></span> View</a>-->

                         </td>              
                         
                      </tr>
                        @endforeach
                    </table>
                    
                      @else
          <h6 class="text-center">{{ __('common.no_orders_found') }}</h6>
        @endif  
                  </div>
                   <div class="contact-three__btn-box d-flex mt-3">
                                                
      <a href="{{route('user')}}" class="btn btn-primary"> <span> {{ __('common.back') }} </span> </a>

                                            </div>
                </div>
                <!-- end Order List  -->
              </div>
            </div>
          </div>
          <!--end order list tab -->
          <div class="tab-pane accordion-item" id="transactions" role="tabpanel" aria-labelledby="transactions-tab">
            <h2 class="accordion-header d-md-none" id="headingfour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">Transaction</button>
            </h2>
            <div id="collapsesix" class="accordion-collapse collapse d-md-block" aria-labelledby="headingsix" data-bs-parent="#myTabContent">
              <div class="accordion-body ">
                <!-- start order list -->
                <h3 class="text-center mb-4">Your Transactions</h3>
                <div class="order-list">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                      <tr>
                        <th scope="col"> Date Added </th>
                        <th scope="col" style="width:400px"> Description </th>
                        <th scope="col"> Amount (USD) </th>
                      </tr>
                      <tr>
                        <td> March 12, 2024 </td>
                        <td> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at fermentum augue, id porttitor nulla </td>
                        <td> $321 </td>
                      </tr>
                      <tr>
                        <td> March 12, 2024 </td>
                        <td> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at fermentum augue, id porttitor nulla </td>
                        <td> $321 </td>
                      </tr>
                      <tr>
                        <td> March 12, 2024 </td>
                        <td> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at fermentum augue, id porttitor nulla </td>
                        <td> $321 </td>
                      </tr>
                    </table>
                  </div>
                  <div class="contact-three__btn-box d-flex mt-3">
                                                <button type="submit" class="theme-btn btn-style-one me-auto"><span> Continue </span></button>
                                                   

                                            </div>
                </div>
                <!-- end Transaction List  -->
              </div>
            </div>
          </div>
          <!--end transaction tab -->
        </div>
      </div>
    </div>  
  </div>


@endsection
@push('styles')
<style>
    
    .error {color:#EF802E !important;}
</style>
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#passwordform").validate({
            rules: {
               current_password: "required",               
              new_password: {
                    required: true,
                    minlength: 6
                },
              new_confirm_password: {
                    required: true,
                    minlength: 6,
                 equalTo: "#new_password"
                }
            },
            messages: {                
                current_password: {
					required: "{{ __('common.password_required') }}",
					minlength: "{{ __('common.password_min') }}"
				},
              new_password: {
					required: "{{ __('common.password_confirmation_required') }}",
					minlength: "{{ __('common.password_confirmation_min') }}"
				},
               new_confirm_password: {
					required: "{{ __('common.password_confirmation_required') }}",
					minlength: "{{ __('common.password_confirmation_min') }}",
               equalTo: "Passwords do not match."
               },
            }
            
        });
    });
</script>

@endpush