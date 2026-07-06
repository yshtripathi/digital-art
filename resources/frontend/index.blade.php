@extends('frontend.layouts.main')
@section('main-content')
@section('title', 'Animated Education and Courses')
@section('description', 'Education and Courses')
  
  	<!--Main Slider-->
<!--Main Slider-->
	<section class="main-slider">
		<div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_one_wrapper" data-source="gallery">
			<div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
				<ul>
					<!-- Slide 1 -->
					<li data-index="rs-1" data-transition="zoomout">
						<!-- MAIN IMAGE -->
						

						<div class="tp-caption"
						data-paddingbottom="[15,15,15,15]"
						data-paddingleft="[15,15,15,15]"
						data-paddingright="[0,0,0,0]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text" data-height="none"
						data-width="['750','750','750','750']"
						data-whitespace="normal"
						data-hoffset="['0','0','0','0']"
						data-voffset="['-205','-190','-210','-220']"
						data-x="['left','left','left','left']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
							<span class="title">{{ __('common.start_new_journey') }}</span>
						</div>

						<div class="tp-caption"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[15,15,15,15]"
						data-paddingright="[15,15,15,15]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text" data-height="none"
						data-width="['750','750','750','450']"
						data-whitespace="normal"
						data-hoffset="['0','0','0','0']"
						data-voffset="['-55','-50','-50','-90']"
						data-x="['left','left','left','left']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
							<!-- <h1>{{ __('common.best_online_courses') }}</h1> -->
						</div>

						<div class="tp-caption"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[15,15,15,15]"
						data-paddingright="[0,0,0,0]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text" data-height="none"
						data-width="['750','750','750','450']"
						data-whitespace="normal"
						data-hoffset="['0','0','0','0']"
						data-voffset="['110','90','100','65']"
						data-x="['left','left','left','left']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
							<div class="text">{{ __('common.world_class_training') }}</div>
						</div>


						<div class="tp-caption" data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[15,15,15,15]"
						data-paddingright="[15,15,15,15]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text" data-height="none"
						data-width="['700','750','700','450']"
						data-whitespace="normal"
						data-hoffset="['0','0','0','0']"
						data-voffset="['200','185','200','185']"
						data-x="['left','left','left','left']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
							<a href="{{route('product-lists')}}" class="theme-btn btn-style-one">{{ __('common.find_course') }}</a>
						</div>
					</li>

				</ul>
			</div>
		</div>
	</section>
	<!-- End Main Slider-->
	<!-- End Main Slider-->
     	<!-- About Section Three -->
	<section class="about-section-three pt-5 pb-5">
		<div class="auto-container">
			<div class="row">
				<div class="content-column col-lg-6 col-md-12 order-2 wow fadeInRight" data-wow-delay="600ms">
					<div class="inner-column">
						<div class="anim-icons">
							<span class="icon icon-dots-5 bounce-x"></span>
							<span class="icon icon-dots-3 bounce-y"></span>
							<span class="icon icon-star-2 spin-one"></span>
						</div>

						<div class="sec-title">
							<span class="sub-title">{{ __('common.about_the_company') }}</span>
							<h2>{{ __('common.shaping_digital_futures') }}</h2>
							<div class="text">{{ __('common.accessible_high_impact_courses') }}</div>
						</div>

						<ul class="list-style-two">
							<li><i class="icon fa fa-book"></i> {{ __('common.flexible_self_paced_learning') }}</li>
							<li><i class="icon fa fa-book"></i> {{ __('common.industry_certified_instructors') }}</li>
							<li><i class="icon fa fa-book"></i> {{ __('common.downloadable_content_anytime') }}</li>
						</ul>

						<div class="btn-box" >
							<!-- <div class="info-box"  >
								<div class="icon-box">
									<i class="icon flaticon-cup-1"></i>
									<div class="count-box">+<span class="count-text" data-speed="5000" data-stop="29">75</span></div>
								</div>
								<h6 class="counter-title">Real-world IT Courses </h6>
							</div> -->
							<a href="{{route('about-us')}}" class="theme-btn btn-style-one"><span class="btn-title">{{ __('common.discover_more') }}</span></a>
							<span class="float-icon icon-arrow"></span>
						</div>
					</div>
				</div>

				<!-- Image Column -->
				<div class="image-column col-lg-6 col-md-12">
					<div class="inner-column wow fadeInLeft">
						<div class="anim-icons">
							<span class="icon icon-percent bounce-y"></span>
							<span class="icon icon-star-1 spin-one"></span>
							<span class="icon icon-dots-4 bounce-x"></span>
							<span class="icon icon-wave"></span>
							<span class="icon icon-idea bounce-y"></span>
						</div>
						<figure class="image overlay-anim wow fadeInUp"><img src="images/resource/about-4.png" alt=""></figure>
						<div class="author-info bounce-x">
							<h3 class="name">Aleesha brown</h3>
							<span class="designation">Maths teacher</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Emd About Section Three -->
     	<!-- Categories Section -->
	<section class="categories-section-current">
		<div class="auto-container">
			<div class="anim-icons">
				<span class="icon icon-group-1 bounce-y"></span>
				<span class="icon icon-group-2 bounce-y"></span>
			</div>

			<div class="sec-title text-center">
				<span class="sub-title">{{ __('common.checkout_our_categories') }}</span>
				<h2>{{ __('common.top_categories_popular_courses') }}</h2>
			</div>

			<div class="row justify-content-center">
				                        @php
                                        $categories = Helper::productCategoryList("all");
										$icons = [
											'flaticon-student-2',
											'flaticon-stationary',
											'flaticon-online-learning',
											'flaticon-study',
											'flaticon-pie-chart',
											'flaticon-web-2',
											];
                                        @endphp
										
				     @foreach($categories->take(6) as $cat_info)   
				<div class="category-block-current col-xl-2 col-lg-3 col-md-4 col-sm-6">
					<div class="inner-box">
						<div class="icon-box">
							<i class="icon {{ $icons[$loop->index]}}"></i>
						</div>
						<h6 class="title"><a href="{{route('product-cat',$cat_info->slug)}}">  {{$cat_info->title}}</a></h6>
					</div>
				</div>
  @endforeach   
				
			</div>
		</div>
	</section>
	<!-- End Product Categories -->

     	<!-- Features Section -->
	<section class="features-section">
		<div class="auto-container">
			<div class="row">
				<!-- Feature Block -->
				<div class="feature-block col-lg-3 col-md-6 col-sm-6 wow fadeInUp">
					<div class="inner-box ">
						<i class="icon flaticon-online-learning"></i>
						<h5 class="title">{{ __('common.self_paced_learning') }}</h5>
					</div>
				</div>

				<!-- Feature Block -->
				<div class="feature-block col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="400ms">
					<div class="inner-box ">
						<i class="icon flaticon-elearning"></i>
						<h5 class="title">{{ __('common.top_instructors') }}</h5>
					</div>
				</div>

				<!-- Feature Block -->
				<div class="feature-block col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="800ms">
					<div class="inner-box ">
						<i class="icon flaticon-web-2"></i>
						<h5 class="title">{{ __('common.unlimited_online_courses') }}</h5>
					</div>
				</div>

				<!-- Feature Block -->
				<div class="feature-block col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="1200ms">
					<div class="inner-box ">
						<i class="icon flaticon-users"></i>
						<h5 class="title">{{ __('common.experienced_members') }}</h5>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Features Section-->
     
     	<!-- Courses Section -->
	<section class="courses-section">
		<div class="auto-container">
			<div class="anim-icons">
				<span class="icon icon-e wow zoomIn"></span>
			</div>

			<div class="sec-title">
				<span class="sub-title">{{ __('common.popular_courses') }}</span>
				<h2>{{ __('common.pick_a_course') }}</h2>
			</div>

			<div class="carousel-outer">
				<!-- Courses Carousel -->
				<div class="courses-carousel owl-carousel owl-theme default-nav">
					   @php
                  $products = Helper::getRandomProduct(10);
               @endphp
               @foreach($products as $product) 

					<div class="course-block">
						<div class="inner-box">
							<div class="image-box">
								<figure class="image"><a href="{{ route('product-detail', $product->slug) }}">
									
								 @php 
                $photo=explode(',',$product->photo);
                           @endphp
                                    <img src="{{$photo[0]}}" style="height:190px;object-fit:cover;"></a>
								</figure>
								<span class="price">{{ $product->getCurrencySymbol() }} {{ session('currency') == 'JPY' ? $product->price : number_format($product->price,2) }} </span>
								<!-- <div class="value">{{ $product->skill_level }}</div> -->
								<!-- <div class="value text-center" style="">add to cart</div> -->

								      <form action="{{route('single-add-to-cart')}}" method="POST">
                                          @csrf
                                          <input type="hidden" name="quant[1]" class="qty-input"  data-min="1" data-max="1000" value="1" id="quantity">
                                          <input type="hidden" name="slug" value="{{$product->slug}}">
                                   
                                        <button name='submit' class="value text-center"><span>{{ __('common.add_to_cart') }}
                                            </span>
                                        </button>
                                    </form>
							</div>
							<div class="content-box">
								<ul class="course-info">
									<li><i class="fa fa-book"></i> {{ $product->lectures }} {{ __('common.lessons') }}</li>
									<li><i class="fa fa-users"></i> {{ $product->duration }} {{ __('common.hours') }}</li>
								</ul>
								<h5 class="title"><a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a></h5>
								<div class="other-info">
									<div class="rating-box">
										<!-- <span class="text">(4.9 /8 Rating)</span> -->
										<div class="rating">
											    @php
                                                    $rate = ceil($product->getReview->avg('rate'))
                                                @endphp
                 @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                        <span class="fa fa-star"></span>
                                                        @else 
                                    <span class="fa fa-star"></span>
                                                        @endif
                                                    @endfor
											
											
										</div>
									</div>
									<div class="duration"><i class="fa fa-clock"></i> {{ $product->duration }} {{ __('common.weeks') }}</div>
								</div>
							</div>
						</div>
					</div>
    @endforeach
				</div>
			</div>
			
		</div>
	</section>
	<!-- End Courses Section-->
	 <section class="instrtr-cntnt">
		<div class="container pt-0 pb-0">
			 	<div class="sec-title text-center">
				<span class="sub-title">{{ __('common.top_rating_instructors') }}</span>
				<h2>{{ __('common.discover_perfect_program') }}</h2>
			</div>

			  <div class="clients-carousel owl-carousel owl-theme">
				<div>
					  <div class="testimonial-block mb-md-30">
						<div class="inner-box">
							<div class="content-box">
								<div class="info-box">									
									<h4 class="name">{{ __('common.certified_subject_experts') }}</h4>
									<span class="designation">{{ __('common.experts_real_world_experience') }}</span>
								</div>
							</div>
						</div>
		            </div>
</div>
<!-- end grid section -->
 <div>
					  <div class="testimonial-block mb-md-30">
						<div class="inner-box">
							<div class="content-box">
								<div class="info-box">									
									<h4 class="name">{{ __('common.high_teaching_approach') }}</h4>
									<span class="designation">{{ __('common.project_based_learning') }}</span>
								</div>
							</div>
						</div>
		            </div>
</div>
<!-- end grid section -->
 <div>
					  <div class="testimonial-block mb-md-30">
						<div class="inner-box">
							<div class="content-box">
								<div class="info-box">									
									<h4 class="name">{{ __('common.up_to_date_tech_trends') }}</h4>
									<span class="designation">{{ __('common.updated_skills_evolving_industries') }}</span>
								</div>
							</div>
						</div>
		            </div>
</div>
<!-- end grid section -->
 <div>
					  <div class="testimonial-block mb-md-30">
						<div class="inner-box">
							<div class="content-box">
								<div class="info-box">									
									<h4 class="name">{{ __('common.mentorship_career_guidance') }}</h4>
									<span class="designation">{{ __('common.beyond_teaching_support') }}</span>
								</div>
							</div>
						</div>
		            </div>
</div>
<!-- end grid section -->
</div>
</div>
</section>
<!-- end instructor list -->


     	<!-- Call To Action Two -->
	<section class="call-to-action" style="background-image: url({{url('assets/images/background/1.jpg')}})">
		<div class="anim-icons">
			<span class="icon icon-calculator zoom-one"></span>
			<span class="icon icon-pin-clip zoom-one"></span>
			<span class="icon icon-dots"></span>
		</div>

		<div class="auto-container">
			<div class="row">
				<div class="title-column col-lg-8 col-md-12">
					<div class="inner-column">
						<div class="sec-title light">
							<span class="style-font">{{ __('common.get_your_quality') }}</span>
							<h1>{{ __('common.skills_certificate_from_edulerns') }}</h1>
							<a href="{{route('product-lists')}}" class="theme-btn btn-style-one"><span class="btn-title">{{ __('common.get_started_now') }}</span></a>
						</div>
					</div>
				</div>

				<div class="image-column col-lg-4 col-md-12">
					<figure class="image"><img src="{{url('assets/images/resource/cta.png')}} " alt=""></figure>
				</div>
			</div>
		</div>
	</section>
	<!--End Call To Action Two -->

@endsection