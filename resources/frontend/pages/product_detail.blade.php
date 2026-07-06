
@extends('frontend.layouts.main')
@section('title', $product_detail->title)
@section('description', $product_detail->summary)
@section('main-content')
  <!-- Start main-content -->
	<section class="page-title" style="background-image: url({{url('assets/images/background/page-title.jpg')}});">
		<div class="auto-container">
			<div class="title-outer">
				<h1 class="title">{{$product_detail->title}}</h1>
				<ul class="page-breadcrumb">
					<li><a href="{{route('home')}}">{{ __('common.home') }}</a></li>
					<li>{{$product_detail->title}}</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- end main-content -->

	<!--Product Details Start-->
	<section class="product-details">
		<div class="container pb-70">
			<div class="row">
				<div class="col-lg-6 col-xl-6">
					<div class="bxslider">
						<div class="slider-content">
                        <figure>
                             @php 
                                $photo = explode(',', $product_detail->photo);
                            @endphp
                            <img src="{{ asset($photo[0]) }}" />   </figure>						
						</div>		
					
					</div>
				</div>
				<div class="col-lg-6 col-xl-6 product-info">
					<div class="product-details__top">
						<h3 class="product-details__title">{{ $product_detail->title }}</h3>
					</div>
					<div class="product-details__reveiw">
					
                          @php
                                                    $rate = ceil($product_detail->getReview->avg('rate'))
                                                @endphp
                 @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                        	<i class="fa fa-star"></i>
                                                        @else 
                           	<!--<i class="fa fa-star"></i>-->
                                                        @endif
                                                    @endfor
						<span>{{$product_detail['getReview']->count()}} {{ __('common.customer_reviews') }}</span>
					</div>
					<div class="product-details__content">
						<p class="product-details__content-text1">{{ $product_detail->summary }}</p>
					
					</div>	
                    <h3>    {{ $product_detail->getCurrencySymbol() }} {{ Helper::getProductPriceByCurrency(session('currency'), $product_detail) }}  </h3>


					<div class="product-details__buttons">
						<div class="product-details__buttons-1">
							<!--<a href="javascript:void(0)" class="theme-btn btn-style-one bg-theme-color2"><span class="btn-title">Add to Cart</span></a>-->
                            
                            <form action="{{route('single-add-to-cart')}}" method="POST">
										@csrf
										<input type="hidden" name="quant[1]" class="qty-input"  data-min="1" data-max="1000" value="1" id="quantity">
										<input type="hidden" name="slug" value="{{$product_detail->slug}}">
										<button type="submit" name="submit" class="theme-btn btn-style-one bg-theme-color2">
                                  {{ __('common.add_to_cart') }}
                                           
                 
                      
                      </button>
									</form>
						</div>
						
					</div>				
				</div>
			</div>
		</div>
	</section>
	<!--Product Details End-->

	<!--Product Description Start-->
	<section class="product-description">
		<div class="container pt-0 pb-90">
			<div class="product-discription">
				<div class="tabs-box">
					<div class="tab-btn-box text-center">
						<ul class="tab-btns tab-buttons clearfix">
							<li class="tab-btn active-btn" data-tab="#tab-1">{{ __('common.description') }}</li>
							<li class="tab-btn" data-tab="#tab-2">{{ __('common.reviews') }}</li>
						</ul>
					</div>
					<div class="tabs-content">
						<div class="tab active-tab" id="tab-1">
							<div class="text">
								<h3 class="product-description__title">{{ __('common.description') }}</h3>
								 {!! ($product_detail->description) !!}
								 {!! ($product_detail->extra_description) !!}
							</div>
						</div>
						<div class="tab" id="tab-2">
							<div class="customer-comment">
								<div class="row clearfix">
                                     @foreach($product_detail['getReview'] as $data)
									<div class="col-lg-6 col-md-6 col-sm-12 comment-column">
										<div class="single-comment-box">
											<div class="inner-box">
												
												<div class="inner">
													<ul class="rating clearfix">
													
                                                        
                                                        @for($i=1; $i<=5; $i++)
    													@if($data->rate>=$i)
                                     <li><i class="fas fa-star"></i></li>
                                        @else 
                                        <!--<i class="icon-star"></i>-->
                                        @endif
                                                        @endfor
													</ul>
													<h5>{{$data->name}}</h5>
													<p>{{$data->review}}</p>
												</div>
											</div>
										</div>
									</div>
                                    @endforeach
									
								</div>
							</div>
							<div class="comment-box">
                                 @auth
								<h3>{{ __('common.add_a_review') }}</h3>
								<form id="contact_form" name="contact_form" class="" action="{{ route('review.store', $product_detail->slug) }}" method="post">
                                    @csrf
<input type="hidden" name="rate" id="rating-value" value="{{ old('rate') }}">
									<div class="mb-3">
								<textarea name="review" id="review" placeholder="{{ __('common.write_message') }}" class="form-control">{{ old('review') }}</textarea>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="mb-3">
											
                                                 <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name ?? '') }}" placeholder="{{ __('common.your_name') }}" class="form-control" >
											</div>
										</div>
										<div class="col-sm-6">
											<div class="mb-3">
												<input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="{{ __('common.email') }}" class="form-control" readonly>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 column">
										<div class="review-box clearfix">
											<p>{{ __('common.rate_this_product') }} ?</p>
											<div class="rating clearfix star-rating">
           <i class="fa fa-star" data-value="1"></i>
            <i class="fa fa-star" data-value="2"></i>
            <i class="fa fa-star" data-value="3"></i>
            <i class="fa fa-star" data-value="4"></i>
            <i class="fa fa-star" data-value="5"></i>
												
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 column">
										<div class="form-group clearfix">
											<div class="custom-controls-stacked">
												<!--
            <label class="custom-control material-checkbox">
													<input type="checkbox" class="material-control-input">
													<span class="material-control-indicator"></span>
													<span class="description">Save my name, email, and website in this browser for the next time I comment.</span>
												</label>
            -->
											</div>
										</div>
									</div>
									<div class="mb-3">
										<input name="form_botcheck" class="form-control" type="hidden" value="" />
										<button type="submit" class="theme-btn btn-style-one" data-loading-text="Please wait..."><span class="btn-title"> {{ __('common.leave_a_review') }}</span></button>
									</div>
								</form>
                                      @else
                     {{ __('common.add_a_review') }} ?   <a href="{{route('login.form')}}">{{ __('common.login') }}</a>
                         @endauth
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Product Description End-->


@push('styles')
<style>
    
    .review-form-one__rate i {
        color: #a6abc9;
    }
    
    .review-form-one__rate i.selected, .selected {
        color: #ffc107;
    }
                                            .star-rating {
                                                list-style: none;
                                                padding: 0;
                                                margin: 0;
                                                display: flex;
                                                gap: 5px;
                                            }

                                            .star-rating span {
                                                color: #ccc;
                                                cursor: pointer;
                                                font-size: 24px;
                                                transition: color 0.2s;
                                            }

                                            .star-rating i.selected, .selected {
                                                color: #ffc107;
                                            }
                                        </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll(".star-rating .fa-star");
            const ratingInput = document.getElementById("rating-value");

            stars.forEach(s => s.classList.remove("selected"));

            stars.forEach(star => {
                star.addEventListener("click", function () { 
                    let value = this.getAttribute("data-value");
                    ratingInput.value = value;

                    stars.forEach(s => s.classList.remove("selected"));

                    for (let i = 0; i < value; i++) {                       
                        stars[i].classList.add("selected");
                    }
                });
            });
        });
    </script>
@endpush

    @endsection