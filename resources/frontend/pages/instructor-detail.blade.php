@extends('frontend.layouts.main')
@section('title','New Courses|| Instructor')
@section('main-content')

<section class="page-header">
  <div class="container">
    <div class="page-header__content">
      <ul class="eduhive-breadcrumb list-unstyled">
        <li>
          <span class="eduhive-breadcrumb__icon">
            <i class="icon-home"></i>
          </span>
          <a href="{{ route('home') }}">{{ __('common.home') }}</a>
        </li>
        <li>
          <span>{{ __('common.instructors') }} </span>
        </li>
      </ul>
      <h2 class="page-header__title">{{ $instructor_data->instructor_name }}</h2>
    </div>
  </div>
<img src="{{url('assets/images/shapes/page-header-shape-1.png')}}" alt="shape" class="page-header__shape-one">
<img src="{{url('assets/images/shapes/page-header-shape-2.png')}}" alt="shape" class="page-header__shape-two">
  <div class="page-header__shape-three"></div>
  <div class="page-header__shape-four"></div>
</section>

 
      <!-- course-detailes-area-start -->
      <div class="course-details-area pt-120 pb-100">
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3">
                  <div class="course-instructors-img mb-30">
                     <!--<img class="mb-20" src="{{ $instructor_data->instructor_pic }}" alt="instructors-img">-->
                     <div class="course-details-tittle mb-30">
                        <h3>{{ $instructor_data->instructor_name }}</h3>
                        <span class="d-block mb-15">{{ $instructor_data->instructor_designation }}</span>
                     </div>
                  </div>
               </div>
               <div class="col-xl-8 col-lg-9">
                  <div class="course-details-wrapper">
                     <div class="course-bio-text pt-45 pb-20">
                        <p>{!! $instructor_data->instructor_desc !!}</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- course-detailes-area- end -->



@endsection
