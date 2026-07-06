<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>@yield('title')</title>
<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">
<!-- Stylesheets -->
<link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{url('assets/plugins/revolution/css/settings.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('assets/plugins/revolution/css/layers.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('assets/plugins/revolution/css/navigation.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css2?family=Exo:wght@300;400;500;600;700&amp;display=swap">
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
<link href="{{url('assets/css/style.css')}}" rel="stylesheet">
<link href="{{url('assets/css/responsive.css')}}" rel="stylesheet">

<link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">
<link rel="icon" href="{{url('assets/images/favicon.png')}}" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body>

<div class="page-wrapper">
	<!-- Preloader -->
	<div class="preloader"></div>
	<!-- Main Header-->
	<header class="main-header header-style-two">
		<!-- Header Top -->
		<div class="header-top">
			<div class="auto-container">
				<div class="inner-container">
					<div class="top-left">				
                     <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    @php
                                    if(session('currency') == 'HKD') {
                                        print "HK$ Hong Kong";
                                    }
                                    elseif(session('currency') == 'JPY') {
                                        print "¥ Japanese Yen";
                                    }
                                   else {                                        
                                        print "$ US Dollar";
                                    }
                                @endphp
  </button>
  <ul class="dropdown-menu animated-dropdown">
    <li><a class="dropdown-item" href="{{ route('change.currency', 'USD') }}">$ US Dollar</a></li>
    <li><a class="dropdown-item" href="{{ route('change.currency', 'JPY') }}">¥ Japanese Yen</a></li>
    <li><a class="dropdown-item" href="{{ route('change.currency', 'HKD') }}">HK $ Hong Kong Dollar</a></li>
  </ul>
</div>
</div>
					<div class="top-right">
						<li class="dropdown">
  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          @php
                                if(session('app_locale') == 'ja') {
                  print '<img src="'.url('assets/images/japan.png').'">Japanese';
                                }
                                else {
                  print '<img src="'.url('assets/images/united-kingdom.png').'">English';                            
                                }
                            @endphp 
  </button>
  <ul class="dropdown-menu animated-dropdown">
    
    <li><a class="dropdown-item" href="{{ route('change.language', 'en') }}"><img src="{{url('assets/images/united-kingdom.png')}}"> English</a></li>   
    <li><a class="dropdown-item" href="{{ route('change.language', 'ja') }}"><img src="{{url('assets/images/japan.png')}}"> Japan </a></li>  
  </ul>
</li>
						
					</div>
				</div>
			</div>
		</div>
		<!-- Header Top -->


		<!-- Header Upper -->
		<div class="header-upper">
			<div class="auto-container">
				<div class="inner-container">
					<div class="logo-box">
						<div class="logo"><a href="{{route('home')}}"><img src="{{url('assets/images/logo.png')}}" alt=""></a></div>
					</div>

					<ul class="contact-info-outer">
						<!-- <li> -->
							<!-- Contact Info Box -->
							<!-- <div class="contact-info-box">
								<i class="icon lnr-icon-phone-handset"></i>
								<span class="title">Call Anytime</span>
								<a href="tel:+92880098670" class="text">+ 98 (000) - 9630</a>
							</div> -->
						<!-- </li> -->
						<li>
							<!-- Contact Info Box -->
							<div class="contact-info-box">
								<i class="icon lnr-icon-envelope"></i>
								<span class="title">Send Email</span>
								<a href="mailto:{{ __('common.company_email') }}" class="text"><span>support@learnmtx.com</span></a>
							</div>
						</li>
						<li>
							<!-- Contact Info Box -->
							<div class="contact-info-box">
								<i class="icon lnr-icon-location"></i>
								<span class="title">UNIT 1812, 18/F., CHINAWEAL CENTRE,</span>
								<div class="text">414-424 JAFFE ROAD, CAUSEWAY BAY, HONGKONG</div>
							</div>
						</li>
					</ul>

					<!-- Mobile Nav toggler -->
					   <div class="ui-btn-outer d-md-none d-xl-none d-lg-none">						
						<a href="javascript:void(0)" class="ui-btn"><i class="lnr-icon-shopping-cart"></i>
					    <span class="cart-count"> 2 </span>
					 
					</a>
					</div>
					<div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
				</div>
			</div>
		</div>
		<!-- Header Upper -->


		<!-- Header Lower -->
		<div class="header-lower">
			<div class="auto-container">
				<!-- Main box -->
				<div class="main-box">
					<!--Nav Box-->
					<div class="nav-outer">
						<nav class="nav main-menu">
							<ul class="navigation">
								<li>
                                        <a href="{{route('home')}}"> {{ __('common.home')}}</a> 
                                    </li>	
								<li class="dropdown"><a href="{{route('product-lists')}}">{{ __('common.courses_text')}}</a>
									<ul>
                                         @php
                                  $categories = Helper::productCategoryList("all");
                                    @endphp
                                    @foreach($categories as $cat_info) 
										<li> <a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a></li>
										@endforeach
									</ul>
								</li>
								<li>
                                        <a href="{{route('about-us')}}"> {{ __('common.about')}}</a>
                                    </li>                                  
                                    <li>
                                        <a href="{{route('instructor')}}"> {{ __('common.instructors') }}</a>
                                    </li> 
                                     <li>
                                        <a href="{{route('contact')}}"> {{ __('common.contact') }}</a>
                                    </li>
								<li class="dropdown">
                                    @if(Auth::check() && Auth::user()->role=='user')
                                    <a href="javascript:void(0)">{{Auth::user()->name}}</a>
									<ul>
										<li><a href="{{ route('user') }}">{{ __('common.account') }}</a></li>
										<li><a href="{{ route('user.logout') }}">{{ __('common.logout') }}</a></li>
									</ul>
                                    @else
                                    <a href="javascript:void(0)">{{ __('common.account') }}</a>
									<ul>
										<li><a href="{{ route('login.form') }}">{{ __('common.login') }}</a></li>
										<li><a href="{{ route('register.form') }}">{{ __('common.register') }}</a></li>
									</ul>
                                    @endif
								</li>
								
								  
							</ul>
						</nav>
						<!-- Main Menu End-->

						<div class="outer-box">					
                             
                   <div class="ui-btn-outer">						
						<a href="javascript:void(0)" class="ui-btn"><i class="lnr-icon-shopping-cart"></i>
					  
					 
                            <span class="cart-count">
                                        @if(Helper::getAllProductFromCart())
                    <span >{{ Helper::totalCartQuantity() }}</span>
                                @else
                                <span class="cart-count">0</span>
                                @endif
					</a>
					</div>
							
						</div>
					</div>
				</div>
				<!-- End Main Box -->
			</div>
		</div>
		<!-- Header Lower -->


		<!-- Mobile Menu  -->
		<div class="mobile-menu">
			<div class="menu-backdrop"></div>

			<!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
			<nav class="menu-box">
				<div class="upper-box">
					<div class="nav-logo"><a href="{{route('home')}}"><img src="{{url('assets/images/logo-2.png')}}" alt="" title=""></a></div>
					<div class="close-btn"><i class="icon fa fa-times"></i></div>
				</div>

				<ul class="navigation clearfix">
					<!--Keep This Empty / Menu will come through Javascript-->
				</ul>		
			
			</nav>
		</div><!-- End Mobile Menu -->



		<!-- Sticky Header  -->
		<div class="sticky-header">
			<div class="auto-container">
				<div class="inner-container">
					<!--Logo-->
					<div class="logo">
						<a href="{{route('home')}}" title=""><img src="{{url('assets/images/logo.png')}}" alt="" title=""></a>
					</div>

					<!--Right Col-->
					<div class="nav-outer">
						<!-- Main Menu -->
						<nav class="main-menu">
							<div class="navbar-collapse show collapse clearfix">
								<ul class="navigation clearfix">
									<!--Keep This Empty / Menu will come through Javascript-->
								</ul>
							</div>
						</nav><!-- Main Menu End-->

						<!--Mobile Navigation Toggler-->
						<div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
					</div>
				</div>
			</div>
		</div><!-- End Sticky Menu -->
		  <!-- Offcanvas Area Start -->
        <div class="cartfix-area">
            <div class="cartcanvas__info">
                <div class="offcanvas__wrapper">
                    <div class="cartcanvas__content">
                        <div class="mb-2 d-flex justify-content-between align-items-center border-bottom pb-3">
                          <h5 class="me-auto mb-0"> {{ __('common.shopping_cart') }}</h5>
                            <div class="cartcanvas__close">                                
                                <i class="fas fa-times"></i>                             
                            </div>
                             </div> 
                          <!-- end header title section -->
                            <ul class="cart-list">
                                 @if(Helper::cartCount())
                @foreach(Helper::getAllProductFromCart() as $key=>$cart)
                                  <li class="d-flex position-relative align-items-center"> 
                                   <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item">   <i class="fas fa-times"></i> </a> 
                                        @php
                                    $photo=explode(',', $cart->product['photo']);
                                @endphp 
                                    
                                     <a href="{{ route('product-detail',$cart->product->slug) }}" >
    <img src="{{ url($photo[0]) }}" style="height:65px;width:65px;object-fit:cover;max-width: none;">
                            </a>
    
                                      <div class="cart-info">
                                          <a href="{{ route('product-detail',$cart->product->slug) }}">{{ $cart->product['title'] }}</a>
                                         <p> <span>{{ $cart->quantity }} X {{ Helper::getCurrencySymbol(session('currency')) }} {{number_format($cart['price'])}}
                = </span>
                         <span class="cart-prce">{{ Helper::getCurrencySymbol(session('currency')) }} {{number_format($cart['amount'])}}</span></p>
                                          
                                        </div>      
                                </li>
                                  @endforeach   
                @else
                                     <div class="">
                                        {{ __('common.no_cart_available') }}
                                    </div>
                       @endif                          
                             </ul>
                           <div class="cart-footer border-top mt-3 pt-3 pb-3 d-flex mb-3">
                               <h5 class="me-auto text-dark fw-bold">{{ __('common.total') }} : </h5>
                               
                                @php
                    $total_amount = Helper::totalCartPrice();
                    if(session()->has('coupon')) {
                        $total_amount -= Session::get('coupon')['value'];
                    }
                @endphp
                    
                    <span> {{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($total_amount) }}</span>
                            
                           </div> 
                           <div class="cart-btn d-flex justify-content-center">
                                 @if(Helper::cartCount())
                               <a href="{{ route('cart') }}" class="theme-btn btn-style-one me-3">{{ __('common.view_cart') }}</a>
                                 <a href="{{ route('checkout') }}" class="theme-btn btn-style-one">{{ __('common.checkout') }}</a>
                                 @endif 
                               </div>  
                         
                    </div>
                </div>
            </div>
        </div>
             <!-- Offcanvas Area Start -->
			 <div class="offcanvas__overlay"></div>
	</header>
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
	<!--End Main Header -->