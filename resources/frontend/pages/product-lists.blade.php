@extends('frontend.layouts.main')
@section('main-content')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', 'All Courses List')
    @section('description', 'All Courses List')
@endif

@section('main-content')
<!-- Start main-content -->
<section class="page-title" style="background-image: url({{url('assets/images/background/page-title.jpg')}});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="title">
             @if(isset($category->title) && $category->title)
                       {{$category->title}}
                        @else
                        {{ __('common.all_courses_text') }}
                     @endif
            </h1>
            <ul class="page-breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('common.home') }}</a></li>
                <li>
                 @if(isset($category->title) && $category->title)
                       {{$category->title}}
                        @else
                        {{ __('common.all_courses_text') }}
                     @endif
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- end main-content -->
<!-- Featured Products -->
<section class="featured-products">
    <span class="bg-shape"></span>
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="shop-sidebar">
                    <div class="sidebar-widget category-widget">
                        <div class="widget-title">
                            <h5 class="widget-title">{{ __('common.categories') }}</h5>
                        </div>
                        <div class="widget-content">
                            <ul class="category-list clearfix">
                         @php
                                        $categories = Helper::productCategoryList("all");
                                        @endphp       
                            @foreach($categories as $cat_info) 
                                <li> <a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>  </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                <!--MixitUp Galery-->
                <div class="mixitup-gallery">
                    <div class="row">
                        <p>Showing {{$products->count()}} {{ __('common.courses') }}</p>
                         @foreach($products as $course)     
                        <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image">
                                        <a href="{{route('product-detail',$course->slug)}}">
                                         <img src="{{url($course->photo)}}" style="height:180px;object-fit:cover;">
                                        </a>
                                    </figure>
                                    <span class="price">{{ $course->getCurrencySymbol() }} {{$course->price}}</span>
                                    <!--<div class="value">Advanced</div>-->
                                </div>
                                <div class="content-box">
                                    <h5 class="title"><a href="{{route('product-detail',$course->slug)}}">{{$course->title}}</a></h5>
                                    
                                    <div class="other-info">
                                <form action="{{route('single-add-to-cart')}}" method="POST">
                                          @csrf
                                          <input type="hidden" name="quant[1]" class="qty-input"  data-min="1" data-max="1000" value="1" id="quantity">
                                          <input type="hidden" name="slug" value="{{$course->slug}}">
                                        
                                        <button name='submit' class="theme-btn btn-style-one bg-theme-color2" style="padding: 10px 28px;">{{ __('common.add_to_cart') }}
                                       
                                        </button>
                                    </form>                               
                                             
                                        
                                        
                                        <div class="rating-box">
                                            
                                            <div class="rating">
                                                  @php
                                                    $rate = ceil($course->getReview->avg('rate'))
                                                @endphp
                                      @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                       <span class="fa fa-star"></span>
                                                        @else 
                                    <!--<span class="fa fa-star"></span>-->
                                                        @endif
                                                    @endfor
                                             
                                            </div>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>
                        </div>
						@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Featured Products -->


@endsection