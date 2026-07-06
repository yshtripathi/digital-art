@extends('frontend.layouts.main')
@section('main-content')
@section('title', 'Education and Courses')
@section('description', 'Education and Courses')
<style>
  .home-main-header {
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 999;
}
 .main-menu .main-menu__list > li
 {
    padding-top:47.5px;
    padding-bottom:47.5px;
 }
  .main-footer .container
  {
    padding-top:50px;
  }
    </style>
   <section class="main-slider-one" id="home">
            <div class="main-slider-one__carousel eduhive-owl__carousel eduhive-owl__carousel--basic-nav owl-carousel owl-theme" data-owl-options='{
        "items": 1,
        "margin": 0,
        "animateIn": "fadeIn",
        "animateOut": "fadeOut",
        "loop": true,
        "smartSpeed": 1000,
        "nav": false,
        "dots": false,
        "autoplay": true,
        "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"]
    }'>
                <div class="main-slider-one__item">
                    <div class="container">
                        <div class="row gutter-y-60 align-items-center">
                            <div class="main-slider-one__col-content">
                                <div class="main-slider-one__content">
                                    <img src="assets/images/shapes/main-slider-shape-1-1.png" alt="shape" class="main-slider-one__content__shape slider-image">
                                    <p class="main-slider-one__sub-title">THE FUTURE OF LEARNING</p>
                                    <h2 class="main-slider-one__title">
                                        Learn New <span class="main-slider-one__title__shape">Skills Online</span> <br>
                                        With Top <span class="main-slider-one__title__text">instructors</span>
                                    </h2><!-- /.title -->
                                    <div class="main-slider-one__description">
                                        <p class="main-slider-one__text">Whether you're upskilling, reskilling, or exploring something new — our hands-on programs help you stay ahead in today’s digital world.</p>
                                    </div>
                                    <div class="main-slider-one__button">
                                        <a href="courses.html" class="main-slider-one__btn-1 eduhive-btn">
                                            <span>find course</span>
                                            <span class="eduhive-btn__icon">
                                                <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                                            </span>
                                        </a>
                                        <a href="about.html" class="main-slider-one__btn-2 eduhive-btn eduhive-btn--border">
                                            <span>About us</span>
                                            <span class="eduhive-btn__icon">
                                                <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="main-slider-one__col-image">
                                <div class="main-slider-one__image">
                                    <div class="main-slider-one__image__left">
                                        <div class="main-slider-one__image__one">
                                            <div class="main-slider-one__image__one__inner">
                                                <img src="assets/images/main-slider/main-slider-1-1.jpg" alt="slider image" class="slider-image">
                                            </div>
                                            <div class="total-student">
                                                <div class="total-student__inner">
                                                    <div class="total-student__image">
                                                        <img src="assets/images/main-slider/main-slider-student-1-1.png" alt="student" class="slider-image">
                                                        <img src="assets/images/main-slider/main-slider-student-1-2.png" alt="student" class="slider-image">
                                                    </div>
                                                    <h4 class="total-student__text count-box">
                                                        <span class="count-text" data-stop="200" data-speed="1500">0</span><span>k+ <br> Students</span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-slider-one__image__right">
                                        <div class="main-slider-one__image__two">
                                            <img src="assets/images/main-slider/main-slider-1-2.jpg" alt="slider image" class="slider-image">
                                        </div><!-- /.main-slider-one__image__two -->
                                        <div class="main-slider-one__image__three">
                                            <img src="assets/images/main-slider/main-slider-1-3.jpg" alt="slider image" class="slider-image">
                                        </div><!-- /.main-slider-one__image__three -->
                                    </div><!-- /.main-slider-one__image__right -->
                                    <img src="assets/images/shapes/main-slider-shape-1-3.png" alt="shape" class="main-slider-one__image__shape-one slider-image">
                                    <img src="assets/images/shapes/main-slider-shape-1-4.png" alt="shape" class="main-slider-one__image__shape-two slider-image">
                                    <img src="assets/images/shapes/main-slider-shape-1-5.png" alt="shape" class="main-slider-one__image__shape-three slider-image">
                                    <div class="main-slider-one__image__shape-four"></div><!-- /.main-slider-one__image__shape -->
                                </div><!-- /.main-slider-one__image -->
                            </div><!-- /.main-slider-one__col-image -->
                        </div><!-- /.row gutter-y-60 -->
                    </div>
                    <div class="main-slider-one__shape-one"></div><!-- /.main-slider-one__shape-one -->
                    <div class="main-slider-one__shape-two"></div><!-- /.main-slider-one__shape-two -->
                    <div class="main-slider-one__shape-three"></div><!-- /.main-slider-one__shape-three -->
                    <img src="assets/images/shapes/main-slider-shape-1-2.png" alt="shape" class="main-slider-one__shape-four slider-image">
                </div><!-- /.main-slider-one__item -->
                <div class="main-slider-one__item">
                    <div class="container">
                        <div class="row gutter-y-60 align-items-center">
                            <div class="main-slider-one__col-content">
                                <div class="main-slider-one__content">
                                    <img src="assets/images/shapes/main-slider-shape-1-1.png" alt="shape" class="main-slider-one__content__shape slider-image">
                                    <p class="main-slider-one__sub-title">THE FUTURE OF LEARNING</p><!-- /.sub-title -->
                                    <h2 class="main-slider-one__title">
                                        Learn <span class="main-slider-one__title__shape">Upgrade your Tech Skills </span>
                                     <span class="main-slider-one__title__text">toAccelerate Your Career</span>
                                    </h2><!-- /.title -->
                                    <div class="main-slider-one__description">
                                        <p class="main-slider-one__text">Build expertise in high-demand fields with flexible, job-ready courses taught by experienced professionals.</p><!-- /.text -->
                                    </div><!-- /.description -->
                                    <div class="main-slider-one__button">
                                        <a href="courses.html" class="main-slider-one__btn-1 eduhive-btn">
                                            <span>find course</span>
                                            <span class="eduhive-btn__icon">
                                                <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                                            </span>
                                        </a>
                                        <a href="about.html" class="main-slider-one__btn-2 eduhive-btn eduhive-btn--border">
                                            <span>About us</span>
                                            <span class="eduhive-btn__icon">
                                                <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="main-slider-one__col-image">
                                <div class="main-slider-one__image">
                                    <div class="main-slider-one__image__left">
                                        <div class="main-slider-one__image__one">
                                            <div class="main-slider-one__image__one__inner">
                                                <img src="assets/images/main-slider/main-slider-1-4.jpg" alt="slider image" class="slider-image">
                                            </div>
                                            <div class="total-student">
                                                <div class="total-student__inner">
                                                    <div class="total-student__image">
                                                        <img src="assets/images/main-slider/main-slider-student-1-1.png" alt="student" class="slider-image">
                                                        <img src="assets/images/main-slider/main-slider-student-1-2.png" alt="student" class="slider-image">
                                                    </div>
                                                    <h4 class="total-student__text count-box">
                                                        <span class="count-text" data-stop="200" data-speed="1500">0</span><span>k+ <br> Students</span>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-slider-one__image__right">
                                        <div class="main-slider-one__image__two">
                                            <img src="assets/images/main-slider/main-slider-1-5.jpg" alt="slider image" class="slider-image">
                                        </div><
                                        <div class="main-slider-one__image__three">
                                            <img src="assets/images/main-slider/main-slider-1-6.jpg" alt="slider image" class="slider-image">
                                        </div>
                                    </div>
                                    <img src="assets/images/shapes/main-slider-shape-1-3.png" alt="shape" class="main-slider-one__image__shape-one slider-image">
                                    <img src="assets/images/shapes/main-slider-shape-1-4.png" alt="shape" class="main-slider-one__image__shape-two slider-image">
                                    <img src="assets/images/shapes/main-slider-shape-1-5.png" alt="shape" class="main-slider-one__image__shape-three slider-image">
                                    <div class="main-slider-one__image__shape-four"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-slider-one__shape-one"></div>
                    <div class="main-slider-one__shape-two"></div>
                    <div class="main-slider-one__shape-three"></div>
                    <img src="assets/images/shapes/main-slider-shape-1-2.png" alt="shape" class="main-slider-one__shape-four slider-image">
                </div>
            </div>
        </section>
  <section class="course-category course-category--carousel section-space">
            <img src="assets/images/shapes/course-category-shape-2-1.png" alt="shape" class="course-category__shape">
            <div class="container">
                <div class="course-category__content">
                    <h4 class="course-category__title">our top courses</h4>
                </div>
            </div>
            <div class="container-fluid">
                <div class="course-category__carousel eduhive-owl__carousel owl-carousel owl-theme" data-owl-options='{
            "items": 1,
            "margin": 10,
            "stagePadding": 75,
            "loop": true,
            "smartSpeed": 700,
            "nav": true,
            "dots": false,
            "navContainer": ".course-category__custome-navs",
            "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
            "autoplay": true,
            "responsive": {
                "0": {
                    "items": 1,
                    "margin": 10,
                    "stagePadding": 0
                },
                "576": {
                    "items": 1,
                    "margin": 30,
                    "stagePadding": 130
                },
                "768": {
                    "items": 2,
                    "margin": 30,
                    "stagePadding": 95
                },
                "992": {
                    "items": 3,
                    "margin": 30,
                    "stagePadding": 75
                },
                "1200": {
                    "items": 4,
                    "margin": 30,
                    "stagePadding": 75
                },
                "1400": {
                    "items": 4,
                    "margin": 30,
                    "stagePadding": 90
                },
                "1600": {
                    "items": 5,
                    "margin": 30,
                    "stagePadding": 75
                },
                "1800": {
                    "items": 6,
                    "margin": 30,
                    "stagePadding": 75
                }
            }
        }'>
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="course-category__card course-category__card--1">
                            <div class="course-category__card__inner">
                                <div class="course-category__card__bg" style="background-image: url(assets/images/course-category/course-category-card-bg-1-1.jpg);">
                                </div>
                            </div>
                            <div class="course-category__card__content">
                                <div class="course-category__card__icon-box">
                                    <span class="course-category__card__icon">
                                        <i class="icon-briefcase"></i>
                                    </span>
                                </div>
                                <h4 class="course-category__card__title">Business Management</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="course-category__card course-category__card--2">
                            <div class="course-category__card__inner">
                                <div class="course-category__card__bg" style="background-image: url(assets/images/course-category/course-category-card-bg-1-2.jpg);">
                                </div>
                            </div>
                            <div class="course-category__card__content">
                                <div class="course-category__card__icon-box">
                                    <span class="course-category__card__icon">
                                        <i class="icon-art-studies"></i>
                                    </span>
                                </div>
                                <h4 class="course-category__card__title">Arts & Design</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="course-category__card course-category__card--3">
                            <div class="course-category__card__inner">
                                <div class="course-category__card__bg" style="background-image: url(assets/images/course-category/course-category-card-bg-1-3.jpg);">
                                </div>
                            </div>
                            <div class="course-category__card__content">
                                <div class="course-category__card__icon-box">
                                    <span class="course-category__card__icon">
                                        <i class="icon-self-confidence"></i>
                                    </span>
                                </div>
                                <h4 class="course-category__card__title">Personal Development</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                        <div class="course-category__card course-category__card--4">
                            <div class="course-category__card__inner">
                                <div class="course-category__card__bg" style="background-image: url(assets/images/course-category/course-category-card-bg-1-4.jpg);">
                                </div>
                            </div>
                            <div class="course-category__card__content">
                                <div class="course-category__card__icon-box">
                                    <span class="course-category__card__icon">
                                        <i class="icon-setting"></i>
                                    </span>
                                </div>
                                <h4 class="course-category__card__title">IT & Software</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="course-category__card course-category__card--5">
                            <div class="course-category__card__inner">
                                <div class="course-category__card__bg" style="background-image: url(assets/images/course-category/course-category-card-bg-1-5.jpg);">
                                </div>
                            </div>
                            <div class="course-category__card__content">
                                <div class="course-category__card__icon-box">
                                    <span class="course-category__card__icon">
                                        <i class="icon-healthcare"></i>
                                    </span>
                                </div>
                                <h4 class="course-category__card__title">Health & Fitness</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="course-category__card course-category__card--6">
                            <div class="course-category__card__inner">
                                <div class="course-category__card__bg" style="background-image: url(assets/images/course-category/course-category-card-bg-1-6.jpg);">
                                </div>
                            </div>
                            <div class="course-category__card__content">
                                <div class="course-category__card__icon-box">
                                    <span class="course-category__card__icon">
                                        <i class="icon-coding-1"></i>
                                    </span>
                                </div>
                                <h4 class="course-category__card__title">Computer Science</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="course-category__card course-category__card--7">
                            <div class="course-category__card__inner">
                                <div class="course-category__card__bg" style="background-image: url(assets/images/course-category/course-category-card-bg-1-7.jpg);">
                                </div>
                            </div>
                            <div class="course-category__card__content">
                                <div class="course-category__card__icon-box">
                                    <span class="course-category__card__icon">
                                        <i class="icon-clapperboard"></i>
                                    </span>
                                </div>
                                <h4 class="course-category__card__title">Video & Photography</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                        <div class="course-category__card course-category__card--8">
                            <div class="course-category__card__inner">
                                <div class="course-category__card__bg" style="background-image: url(assets/images/course-category/course-category-card-bg-1-8.jpg);">
                                </div>
                            </div>
                            <div class="course-category__card__content">
                                <div class="course-category__card__icon-box">
                                    <span class="course-category__card__icon">
                                        <i class="icon-megaphone"></i>
                                    </span>
                                </div>
                                <h4 class="course-category__card__title">digital Marketing</h4>
                                
                            </div>
                        </div>
                    </div>
                </div><!-- /.course-category__carousel -->
            </div><!-- /.container-fluid -->
            <div class="container">
                <div class="course-category__custome-navs"></div><!-- /.course-category__custome-navs -->
            </div>
        </section><!-- /.course-category course-category--carousel section-space-top -->
         <!-- start feature section -->

         <!--<section class="ed-features position-relative ">
                        <div class="ed-category__shapes">
                            <img class="ed-category__shape-1 updown-ani" src="assets/images/feature/shape-1.svg" alt="shape-1">
                            <img class="ed-category__shape-2 rotate-ani" src="assets/images/feature/shape-2.svg" alt="shape-2">
                        </div>
                        <div class="container ed-container">
                            <div class="row">
                              
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="ed-features__card wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
                                        <div class="ed-features__icon icon-bg bg-1">
                                            <img src="assets/images/feature/1.svg" alt="icon">
                                        </div>
                                        <div class="ed-features__info">
                                            <h4>Educator Support</h4>
                                            <p>
                                                Excedteur sint occaecat cupidatat non the proident sunt in culpa
                                            </p>
                                        </div>
                                    </div>
                                </div>
                          
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="ed-features__card wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInUp;">
                                        <div class="ed-features__icon icon-bg bg-2">
                                            <img src="assets/images/feature/2.svg" alt="icon">
                                        </div>
                                        <div class="ed-features__info">
                                            <h4>Top Instructor</h4>
                                            <p>
                                                Excedteur sint occaecat cupidatat non the proident sunt in culpa
                                            </p>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="ed-features__card wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.7s; animation-name: fadeInUp;">
                                        <div class="ed-features__icon icon-bg bg-3">
                                            <img src="assets/images/feature/3.svg" alt="icon">
                                        </div>
                                        <div class="ed-features__info">
                                            <h4>Award Wining</h4>
                                            <p>
                                                Excedteur sint occaecat cupidatat non the proident sunt in culpa
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
            end feature section -->
               <section class="ed-why-choose ed-why-choose--style2 section-gap position-relative" style="background-image: url('assets/images/why-choose/section-bg-2.webp')";>
                            <div class="container ed-container position-relative">
                                <div class="ed-w-choose__content">
                                    <div class="row g-0">
                                        <div class="col-lg-6 col-12">                                            

                                         <div class="sec-title sec-title--center wow fadeInUp animated" data-wow-duration="1500ms" data-wow-delay="00ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInUp;">
                    <h6 class="sec-title__tagline">WHY CHOOSE US</h6>
                    <h3 class="sec-title__title"><span>Transform</span> <span class="sec-title__title__shape">Your Career 
 </span> With<span></span> <span class="sec-title__title__text"> Expert-Led Online Courses
</span></h3>
                </div>
                <p>Join thousands of learners and professionals who trust our platform for skill-building in cutting-edge fields like AI, Data Science, Cloud, Cybersecurity, Design, and more. Experience flexible, accessible, and career-focused learning—designed to help you thrive in a digital world.</p>




                                        </div>
                                    </div>

                                    <div class="ed-w-choose__info">
                                        <!-- Single Info  -->
                                        <div class="ed-w-choose__info-single ed-w-choose__info-single--style2 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
                                            <div class="ed-w-choose__info-head">
                                                <div class="ed-w-choose__info-icon bg-1">
                                                    <img src="assets/images/why-choose/icon-1.svg" alt="icon">
                                                </div>
                                                <h5>Online Teaching</h5>
                                            </div>
                                            <div class="ed-w-choose__info-bottom">
                                                <p>
                                                    Our courses are built with practical applications, interactive exercises, and hands-on projects to help you master in-demand skills.
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Single Info  -->
                                        <div class="ed-w-choose__info-single ed-w-choose__info-single--style2 wow fadeInUp" data-wow-delay=".5s" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInUp;">
                                            <div class="ed-w-choose__info-head">
                                                <div class="ed-w-choose__info-icon bg-2">
                                                    <img src="assets/images/why-choose/icon-2.svg" alt="icon">
                                                </div>
                                                <h5>Project-Based Learning</h5>
                                            </div>
                                            <div class="ed-w-choose__info-bottom">
                                                <p>
                                                    Apply what you learn through real-world projects and case studies that simulate actual job challenges, preparing you for real career impact from day one.

                                                </p>
                                            </div>
                                        </div>

                                        <!-- Single Info  -->
                                        <div class="ed-w-choose__info-single ed-w-choose__info-single--style2 wow fadeInUp" data-wow-delay=".7s" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.7s; animation-name: fadeInUp;">
                                            <div class="ed-w-choose__info-head">
                                                <div class="ed-w-choose__info-icon bg-3">
                                                    <img src="assets/images/why-choose/icon-3.svg" alt="icon">
                                                </div>
                                                <h5>Career-Focused Curriculum</h5>
                                            </div>
                                            <div class="ed-w-choose__info-bottom">
                                                <p>
                                                    Every course is designed with your career in mind—aligned with industry standards, certification goals, and the latest tech trends to help you grow professionally.

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ed-w-choose__images ed-w-choose__images--style2 d-none d-md-block">
                                    <!-- Why Choose Image  -->
                                    <div class="ed-w-choose__main-img">
                                        <img src="assets/images/why-choose/why-choose-img.png" alt="why-choose-img">
                                    </div>
                                    <!-- Shapes Elements -->
                                    <div class="ed-w-choose__shapes">
                                        <img class="ed-w-choose__shape-1 updown-ani" src="assets/images/why-choose/shape-1.svg" alt="shape-1">
                                    </div>
                                </div>
                            </div>
                        </section>
     <section class="courses-one section-space-top2" id="courses">
            <div class="container">
                <div class="sec-title sec-title--center wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                    <h6 class="sec-title__tagline">our courses</h6>
                    <h3 class="sec-title__title"><span>Our</span> <span class="sec-title__title__shape">Most</span> <span>Popular</span> <span class="sec-title__title__text">Courses</span></h3>
                </div><!-- /.sec-title -->
            </div>
            <div class="courses-one__container container">
                <div class="courses-one__carousel eduhive-owl__carousel--with-shadow eduhive-owl__carousel eduhive-owl__carousel--basic-nav owl-carousel owl-theme" data-owl-options='{
			"items": 1,
			"margin": 10,
			"loop": true,
			"smartSpeed": 700,
            "rtl": true,
			"nav": true,
			"dots": false,
			"navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
			"autoplay": true,
			"responsive": {
				"0": {
					"items": 1,
					"margin": 10
				},
				"768": {
					"items": 2,
					"margin": 30
				},
				"992": {
					"items": 3,
					"margin": 30
				},
				"1200": {
					"items": 3.3,
					"margin": 30
				},
				"1400": {
					"items": 3.4,
					"margin": 30
				},
				"1536": {
					"items": 3.5,
					"margin": 30
				},
				"1600": {
					"items": 3.7,
					"margin": 30
				},
				"1800": {
					"items": 3.94,
					"margin": 30
				}
			}
		}'>
               @php
                  $products = Helper::getRandomProduct(5);
               @endphp
               @foreach($products as $product) 
                   <div class="item">
                        <div class="course-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='00ms'>
                            <div class="course-card__image">
                                @php 
                $photo=explode(',',$product->photo);
                           @endphp
                                <img src="{{$photo[0]}}" style="height:190px;object-fit:cover;">
                                <div class="course-card__ratings">
                                    <div class="eduhive-ratings">
                                        <span class="eduhive-ratings__icon">
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <span class="eduhive-ratings__icon">
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <span class="eduhive-ratings__icon">
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <span class="eduhive-ratings__icon">
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <span class="eduhive-ratings__icon">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                    <p class="course-card__ratings__text">5 Ratings</p>
                                </div>
                            </div>
                            <div class="course-card__content">
                                <div class="course-card__content__top">
                                    <div class="course-card__category">{{ $product->skill_level }}</div>
                                    <div class="course-card__duration">
                                        <span class="course-card__duration__icon">
                                            <i class="icon-clock"></i>
                                        </span>
                                       {{ $product->duration }} weeks
                                    </div>
                                </div>
                                <h3 class="course-card__title"><a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
                                <div class="course-card__info">
                                    <div class="course-card__lessons">
                                        <span class="course-card__lessons__icon">
                                            <i class="icon-open-book"></i>
                                        </span>
                                        {{ $product->lectures }} lessons
                                    </div>
                                    <div class="course-card__students">
                                        <span class="course-card__students__icon">
                                            <i class="icon-multiple-users-silhouette"></i>
                                        </span>
                                        {{ $product->duration }} weeks
                                    </div>
                                </div>
                                <h4 class="course-card__price">
                                   <!--$<span>69.00</span>-->
                                   {{ $product->getCurrencySymbol() }} {{number_format($product->price,2)}}
                               </h4>
                            </div>
                            <div class="course-card__hover" style="background-image: url(assets/images/shapes/course-card-bg-1-1.png);">
                                <div class="course-card__hover__content">
                                    <div class="course-card__content__top course-card__content__top--hover">
                                        <div class="course-card__category">{{ $product->skill_level }}</div>
                                        <div class="course-card__duration">
                                            <span class="course-card__duration__icon">
                                                <i class="icon-clock"></i>
                                            </span>
                                            {{ $product->duration }} weeks
                                        </div>
                                    </div>
                                    <h3 class="course-card__title course-card__title--hover"><a href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
                                    <p class="course-card__text">{{ Str::words($product->summary,18) }}</p><!-- /.course-card__text -->
                                    <div class="course-card__ratings course-card__ratings--hover">
                                        <div class="eduhive-ratings">
                                            <span class="eduhive-ratings__icon">
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="eduhive-ratings__icon">
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="eduhive-ratings__icon">
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="eduhive-ratings__icon">
                                                <i class="fa fa-star"></i>
                                            </span>
                                            <span class="eduhive-ratings__icon">
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                        <p class="course-card__ratings__text">5 Ratings</p>
                                    </div>
                                <div class="">
                                        <!--<span>Add To Cart q</span>-->
                                    
                                    
                                    <form action="{{route('single-add-to-cart')}}" method="POST">
                                          @csrf
                                          <input type="hidden" name="quant[1]" class="qty-input"  data-min="1" data-max="1000" value="1" id="quantity">
                                          <input type="hidden" name="slug" value="{{$product->slug}}">
                                        
                                        <button name='submit' class="course-card__btn eduhive-btn eduhive-btn--border">{{ __('common.add_to_cart') }}
                                        <span class="eduhive-btn__icon">
                                            <span class="eduhive-btn__icon__inner"><i class="icon-right-arrow"></i></span>
                                        </span>
                                        </button>
                                    </form> 
                                    
                                    
                                        
                                    </div>
                                    <div class="course-card__info course-card__info--hover">
                                        <div class="course-card__lessons">
                                            <span class="course-card__lessons__icon">
                                                <i class="icon-open-book"></i>
                                            </span>
                                            25 lessons
                                        </div>
                                        <div class="course-card__students">
                                            <span class="course-card__students__icon">
                                                <i class="icon-multiple-users-silhouette"></i>
                                            </span>
                                            350 Students
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach 
                </div>
            </div>
            <img src="assets/images/shapes/courses-shape-1-1.png" alt="shape" class="courses-one__shape">
        </section>
       

        <section class="funfact-one section-space funfact-one--home">
            <div class="funfact-one__inner">
                <div class="funfact-one__bg" style="background-image: url(assets/images/shapes/funfact-bg-1-1.png);"></div>
            </div><!-- /.funfact-one__inner -->
            <div class="container">
                <div class="funfact-one__grid">
                    <div class="funfact-one__item funfact-one__item--secondary wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="funfact-one__icon">
                            <span class="funfact-one__icon__inner"><i class="icon-connectibity"></i></span>
                        </div><!-- /.funfact-one__icon -->
                        <h3 class="funfact-one__title count-box">
                            <span class="count-text" data-stop="30" data-speed="1500">0</span>
                            <span>k+</span>
                        </h3><!-- /.funfact-one__title -->
                        <p class="funfact-one__text">Satisfied Student</p><!-- /.funfact-one__text -->
                    </div><!-- /.funfact-one__item -->
                    <div class="funfact-one__item funfact-one__item--primary wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                        <div class="funfact-one__icon">
                            <span class="funfact-one__icon__inner"><i class="icon-batch-assign"></i></span>
                        </div><!-- /.funfact-one__icon -->
                        <h3 class="funfact-one__title count-box">
                            <span class="count-text" data-stop="6500" data-speed="1500">0</span>
                            <span>+</span>
                        </h3><!-- /.funfact-one__title -->
                        <p class="funfact-one__text">Class Completed</p><!-- /.funfact-one__text -->
                    </div><!-- /.funfact-one__item -->
                    <div class="funfact-one__item funfact-one__item--primary wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="funfact-one__icon">
                            <span class="funfact-one__icon__inner"><i class="icon-students"></i></span>
                        </div><!-- /.funfact-one__icon -->
                        <h3 class="funfact-one__title count-box">
                            <span class="count-text" data-stop="6561" data-speed="1500">0</span>
                            <span>+</span>
                        </h3><!-- /.funfact-one__title -->
                        <p class="funfact-one__text">Active Students</p><!-- /.funfact-one__text -->
                    </div><!-- /.funfact-one__item -->
                    <div class="funfact-one__item funfact-one__item--secondary wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                        <div class="funfact-one__icon">
                            <span class="funfact-one__icon__inner"><i class="icon-instructors"></i></span>
                        </div><!-- /.funfact-one__icon -->
                        <h3 class="funfact-one__title count-box">
                            <span class="count-text" data-stop="400" data-speed="1500">0</span>
                            <span>+</span>
                        </h3><!-- /.funfact-one__title -->
                        <p class="funfact-one__text">Experts Instructors</p><!-- /.funfact-one__text -->
                    </div><!-- /.funfact-one__item -->
                </div><!-- /.rfunfact-one__grid -->
            </div>
        </section><!-- /.funfact-one section-space-bottom -->


        
        <section class="testimonials-three section-space2 section-mrgnspace" id="testimonials">
            <div class="testimonials-three__bg" style="background-image: url(assets/images/shapes/testimonials-bg-3-1.png);">
            </div><!-- /.testimonials-three__bg -->
            <div class="container">
               <div class="sec-title sec-title--center wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                    <h6 class="sec-title__tagline">our expert team</h6>
                    <h3 class="sec-title__title">Our <span class="sec-title__title__text">expert</span> <span class="sec-title__title__shape">instructor</span></h3>
                </div><!-- /.sec-title -->

                <div class="testimonials-three__carousel eduhive-owl__carousel eduhive-owl__carousel--basic-nav eduhive-owl__carousel--with-shadow owl-theme owl-carousel" data-owl-options='{
            "items": 3,
            "margin": 30,
            "smartSpeed": 700,
            "loop":true,
            "autoplay": 6000,
            "nav":true,
            "dots":false,
            "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
            "responsive":{
                "0":{
                    "items": 1,
                    "margin": 10
                },
                "768":{
                    "items": 2,
                    "margin": 30
                },
                "1200":{
                    "items": 3,
                    "margin": 30
                }
              }
            }'>
                    @foreach($instructor_data as $instructor)
                    <div class="item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="testimonial-card-three">                           
                            <div class="testimonial-card-three__content">
                                <div class="testimonial-card-three__icon">
                                    <span class="icon-quote"></span>
                                </div>
                                <div class="testimonial-card-three__identity">
                                    <h5 class="testimonial-card-three__name">{{$instructor->instructor_name}}</h5>
                                    <p class="testimonial-card-three__designation">{{$instructor->instructor_designation}}</p>
                                </div>                           
                                
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                </div>
            </div>
            <img src="{{url('assets/images/shapes/testimonial-shape-3-1.png')}}" alt="shape" class="testimonials-three__shape-one">
            <img src="{{url('assets/images/shapes/testimonial-shape-3-2.png')}}" alt="shape" class="testimonials-three__shape-two">
            <img src="{{url('assets/images/shapes/testimonial-shape-3-3.png')}}" alt="shape" class="testimonials-three__shape-three">
            <div class="testimonials-three__shape-box"></div>
        </section>
  <section class="bd-career-area bd-career-overlay">
    <div class="container">
        <div class="row gy-30 justify-content-center">
            <div class="col-xxl-12 col-xl-12 col-lg-12">
                <div class="bd-career-grid">
                    <div class="bd-career-wrapper style-one">
                        <div class="bd-career-item">
                            <div class="bd-career-bg">
                                <img src="assets/images/career-bgtrans.webp" alt=""/>
                            </div>
                            <div class="bd-career-thumb d-none d-md-block">
                                <img src="assets/images/career-cta-thumb-01.webp" alt=""  >
                            </div>
                            <div class="bd-career-content">
                                <span class="bd-career-subtitle">Start Your Journey Today</span>
                                <h4 class="bd-career-title mb-4"><a href="#">Become an Instructor &amp; Share Your Expertise</a></h4>
                                <div class="bd-career-btn"><a class="eduhive-btn" href="javascript:void(0)">Learn More</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="bd-career-wrapper style-one">
                        <div class="bd-career-item">
                            <div class="bd-career-bg">
                                 <img src="assets/images/career-bgtrans1.webp" alt=""/>
                            </div>
                            <div class="bd-career-thumb d-none d-md-block">
                                 <img src="assets/images/career-cta-thumb-02.webp" alt=""  >
                            </div>
                            <div class="bd-career-content">
                                <span class="bd-career-subtitle">Unlock Your Potential</span>
                                <h4 class="bd-career-title mb-4"><a href="#">Enhance Your Skills and Stay Ahead</a></h4>
                                <div class="bd-career-btn"><a class="eduhive-btn" href="javascript:void(0)">Explore Courses</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection