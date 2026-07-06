@extends('frontend.layouts.main') 
@section('title','About us')
@section('main-content')
    <!-- Start main-content -->
	<section class="page-title" style="background-image: url(images/background/page-title.jpg);">
		<div class="auto-container">
			<div class="title-outer">
				<h1 class="title">{{ __('common.about') }}</h1>
				<ul class="page-breadcrumb">
					<li><a href="index.html">{{ __('common.home') }}</a></li>
					<li>{{ __('common.about') }}</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- end main-content -->
     	<!-- About Section -->
	<section class="about-section">
		<div class="anim-icons">
			<span class="icon icon-dotted-map"></span>
		</div>
		<div class="auto-container">
			<div class="row">
				<div class="content-column col-lg-6 col-md-12 order-2 wow fadeInRight" data-wow-delay="600ms">
					<div class="inner-column">
						<div class="sec-title">
							<span class="sub-title">{{__('common.get_to_know_us')}}</span>
							<h2>{{__('common.empower_your_future')}}</h2>
							<div class="text">{{ __('common.at_learnMTX') }}</div>
						</div>

						<ul class="list-style-one two-column">
							 <li><i class="icon fa fa-check"></i> {{ __('common.expert_trainers') }}</li>
								<li><i class="icon fa fa-check"></i> {{ __('common.online_learning') }}</li>
								<li><i class="icon fa fa-check"></i> {{ __('common.lifetime_access') }}</li>
								<li><i class="icon fa fa-check"></i> {{ __('common.great_results') }}</li>
						</ul>

						<div class="btn-box">
							<a href="page-about.html" class="theme-btn btn-style-one"><span class="btn-title">{{ __('common.discover_more') }}</span></a>
						</div>
					</div>
				</div>

				<!-- Image Column -->
				<div class="image-column col-lg-6 col-md-12">
					<div class="anim-icons">
						<span class="icon icon-dotted-map-2"></span>
						<span class="icon icon-paper-plan"></span>
						<span class="icon icon-dotted-line"></span>
					</div>
					<div class="inner-column wow fadeInLeft">
						<figure class="image-1 overlay-anim wow fadeInUp"><img src="images/resource/about-1.png" alt=""></figure>
						<figure class="image-2 overlay-anim wow fadeInRight"><img src="images/resource/about-2.jpg" alt=""></figure>
						<!-- <div class="experience bounce-y"><span class="count">16</span> Years of Experience</div> -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Emd About Section -->
     	<!-- Video Section -->
	<section class="video-section">
		<div class="bg-image" style="background-image: url(images/background/6.jpg)"></div>
		<div class="auto-container">
			<div class="outer-box">
				<div class="title-box">
					<h2 class="title">{{ __('common.your_growth') }}</h2>
					<a href="page-about.html" class="theme-btn btn-style-one bg-theme-color3">{{ __('common.explore_courses') }}</a>
				</div>
				<div class="video-box wow fadeInUp">
					<span class="float-icon icon-arrow-2"></span>
					
				</div>
			</div>
		</div>
	</section>
	<!--End Video Section -->
    	<!-- Features Section Two-->
	<section class="features-section-two">
		<div class="anim-icons">
			<span class="icon icon-shape-1 zoom-one"></span>
			<span class="icon icon-shape-2 zoom-one"></span>
			<span class="icon icon-e zoom-one"></span>
		</div>
		<div class="auto-container">
			<div class="sec-title text-center">
				<span class="sub-title">{{ __('common.our_advantages') }}</span>
				<h2>{{ __('common.you_have_come') }}</h2>
			</div>
			<div class="row">
				<!-- Feature Block -->
				<div class="feature-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
					<div class="inner-box ">
						<figure class="image"><img src="images/resource/feature-1.png" alt=""></figure>
						<h4 class="title"><a href="page-about.html">{{ __('common.80_courses') }}</a></h4>
						<div class="text">{{ __('common.explore_a_diverse_library') }}</div>
					</div>
				</div>

				<!-- Feature Block -->
				<div class="feature-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
					<div class="inner-box ">
						<figure class="image"><img src="images/resource/feature-2.png" alt=""></figure>
						<h4 class="title"><a href="page-about.html">{{ __('common.industry_instructors') }}</a></h4>
						<div class="text">{{__('common.learn_directly_from_seasoned')}}</div>
					</div>
				</div>

				<!-- Feature Block -->
				<div class="feature-block-two col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
					<div class="inner-box ">
						<figure class="image"><img src="images/resource/feature-3.png" alt=""></figure>
						<h4 class="title"><a href="page-about.html">{{__('common.flexible_learning')}}</a></h4>
						<div class="text"> {{__('common.our_platform_adaform')}}</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Features Section Two-->
   
@endsection
