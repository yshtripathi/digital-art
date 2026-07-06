@extends('frontend.layouts.main')
@section('main-content')
<!-- Start main-content -->
	<section class="page-title" style="background-image: url({{url('assets/images/background/page-title.jpg')}});">
		<div class="auto-container">
			<div class="title-outer">
				<h1 class="title">{{ __('common.cart') }}</h1>
				<ul class="page-breadcrumb">
					 <li><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>				
					<li>{{ __('common.cart') }}</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- end main-content -->
  	<!--cart Start-->
  <section>
    <div class="container pb-100">
      <div class="section-content">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
                <form action="{{route('cart.update')}}" method="POST">
			@csrf
              <table class="table table-striped table-bordered tbl-shopping-cart">
                <thead>
                  <tr>
                    <th>{{ __('common.remove') }}</th>
                    <th>{{ __('common.photo') }}</th>
                   <th>{{ __('common.item') }}</th>
                                         <th>{{ __('common.price') }}</th>
                                        <th>{{ __('common.quantity') }}</th>
                                        <th>{{ __('common.subtotal') }}</th>
                  </tr>
                </thead>
                <tbody>
               @if(Helper::cartCount())
@foreach(Helper::getAllProductFromCart() as $key=>$cart)   
                    <tr class="cart_item">
                    <td class="product-remove"><a title="Remove this item" class="remove" href="{{ route('cart-delete',$cart->id) }}">×</a></td>
                    <td class="product-thumbnail">
                         @php
				$photo=explode(',',$cart->product['photo']);
														@endphp
                                             <a href="{{ route('product-detail',$cart->product->slug) }}">
    <img src="{{$photo[0]}}" style="height:70px;width:auto;"></a>
                        </td>
                    <td class="product-name"><a href="{{ route('product-detail',$cart->product->slug) }}">{{$cart->product['title']}}</a>
                     </td>
                    <td class="product-price"><span class="amount"> {{ Helper::getCurrencySymbol(session('currency')) }} {{$cart['price']}}</span></td>
                    <td class="product-quantity">
											<div class="product-details__quantity">
												<div class="quantity-box">
													<button type="button" class="sub"><i class="fa fa-minus"></i></button>
													
                                                         
                                        <input type="number" name="quant[{{$key}}]" value="{{$cart->quantity}}" class="form-control" id="number" >
													<button type="button" class="add"><i class="fa fa-plus"></i></button>
												</div>
											</div>
                    </td>
                    <td class="product-subtotal">
                         <input type="hidden" name="qty_id[]" value="{{$cart->id}}">
				<input type="hidden" name="cart_id[]" value="{{$cart->id}}">
<span class="amount">{{ Helper::getCurrencySymbol(session('currency')) }} {{$cart['amount']}}</span>
                        </td>
                  </tr>
                      @endforeach
										@else
                                    <tr>
				<td colspan="5" class="text-center">													{{ __('common.no_cart_available') }} <a href="{{route('product-lists')}}" style="color:blue;">{{ __('common.continue_shopping') }}</a>
												</td>
											</tr>
										@endif              
                </tbody>
              </table>
            <button class="theme-btn btn-style-one bg-theme-color2 float-end" type="submit" name="update_cart">
               {{ __('common.update') }}
                                        </button> 
                </form>
            </div>
          </div>
          <div class="col-md-12 mt-30">
            <div class="row">         
              <div class="col-md-2">
              </div>
              <div class="col-md-5">
                <h4>Cart Totals</h4>
                  @if(Helper::cartCount())
              
                                         @php
													$total_amount = Helper::totalCartPrice();
													if(session()->has('coupon')) {
														$total_amount -= Session::get('coupon')['value'];
													}
												@endphp
                            
                <table class="table table-bordered cart-total">
                  <tbody>
                    <tr>
                      <td>{{ __('common.subtotal') }}</td>
                      <td>{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format(Helper::totalCartPrice(), 2) }}</td>
                    </tr>
                    
                    <tr>
                      <td>{{ __('common.total') }}</td>
                      <td>{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($total_amount, 2) }}</td>
                    </tr>
                  </tbody>
                </table>
                   @endif
                <a class="theme-btn btn-style-one bg-theme-color5" href="{{ route('checkout') }}"><span class="btn-title">{{ __('common.checkout') }}</span> </a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
	<!--cart Start-->
           
@endsection