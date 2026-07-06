@extends('frontend.layouts.master')
@section('title','Courses 5 Website')
@section('main-content')

  <!-- Main Slider Start -->
        <section class="main-slider">
            <div class="main-slider__carousel owl-carousel owl-theme">
                <div class="item">
                    <div class="main-slider__bg"
                        style="background-image: url({{url('assets/images/backgrounds/herobanner-1.webp')}});">
                    </div>
                    <div class="container">
                        <div class="main-slider__content">
                            <div class="main-slider__sub-title-box">
                                <div class="main-slider__sub-title-shape"></div>
                                <h5 class="main-slider__sub-title">Anime Creation Unleashed</h5>
                            </div>
                            <h2 class="main-slider__title">Your Journey into Anime Art Begins <br> Sketch, Design & Animate Your Dream Worlds</h2>
                          
                            <div class="main-slider__btn-box">
                                <a href="courses.php" class="thm-btn"><span class="icon-angles-right"></span> Get
                                    Started</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="main-slider__bg"
                        style="background-image: url({{url('assets/images/backgrounds/herobanner-2.webp')}});">
                    </div>
                    <div class="container">
                        <div class="main-slider__content">
                            <div class="main-slider__sub-title-box">
                                <div class="main-slider__sub-title-shape"></div>
                                <h5 class="main-slider__sub-title">From Fan to Creator</h5>
                            </div>
                            <h2 class="main-slider__title">Anime Courses for the Next <br> Generation of Artists
</h2>                           
                            <div class="main-slider__btn-box">
                                <a href="courses.php" class="thm-btn"><span class="icon-angles-right"></span> Join Now </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="main-slider__bg"
                        style="background-image: url({{url('assets/images/backgrounds/herobanner-3.webp')}});">
                    </div>
                    <div class="container">
                        <div class="main-slider__content">
                            <div class="main-slider__sub-title-box">
                                <div class="main-slider__sub-title-shape"></div>
                                <h5 class="main-slider__sub-title">Your Anime Universe Awaits</h5>
                            </div>
                            <h2 class="main-slider__title">Craft Iconic Characters & Worlds</h2>                         
                            <div class="main-slider__btn-box">
                                <a href="courses.php" class="thm-btn"><span class="icon-angles-right"></span>Start Learning</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--Main Slider Start -->
     <!-- Sliding Text One Start-->
        <section class="sliding-text-one">
            <div class="sliding-text-one__wrap">
                <ul class="sliding-text__list list-unstyled marquee_mode">
                    <li>
                        <h2 data-hover="20+ Instructor" class="sliding-text__title">
                            <span class="odometer" data-count="20">00</span>+ Instructor
                            <img src="{{url('assets/images/shapes/sliding-text-shape-1.png')}}" alt="">
                        </h2>
                    </li>
                    <li>
                        <h2 data-hover="500+ Online Courses" class="sliding-text__title">
                            <span class="odometer" data-count="500">00</span>+ Online Courses
                            <img src="{{url('assets/images/shapes/sliding-text-shape-1.png')}}" alt="">
                        </h2>
                    </li>
                    <li>
                        <h2 data-hover="24 Hors Support" class="sliding-text__title">24 Hors Support
                            <img src="{{url('assets/images/shapes/sliding-text-shape-1.png')}}" alt="">
                        </h2>
                    </li>
                    <li>
                        <h2 data-hover="Courses Certificate" class="sliding-text__title">Courses Certificate
                            <img src="{{url('assets/images/shapes/sliding-text-shape-1.png')}}" alt="">
                        </h2>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Sliding Text One End -->

        <!-- Category One Start -->
        <section class="category-one">
            <div class="category-one__bg-shape"
                style="background-image: url(assets/images/shapes/category-one-bg-shape.png);"></div>
            <div class="category-one__shape-1">
                <img src="{{url('assets/images/shapes/category-one-shape-1.png')}}" alt="">
            </div>
            <div class="category-one__shape-2">
                <img src="{{url('assets/images/shapes/category-one-shape-2.png')}}" alt="">
            </div>
            <div class="category-one__shape-3">
                <img src="{{url('assets/images/shapes/category-one-shape-3.png')}}" alt="">
            </div>
            <div class="category-one__social-media">
                <ul class="category-one__social-media-list list-unstyled">
                    <li>
                        <h3>Art & design</h3>
                    </li>
                    <li>
                        <img src="{{url('assets/images/shapes/category-one-social-media-shape-1.png')}}" alt="">
                    </li>
                    <li>
                        <h3>Marketing</h3>
                    </li>
                    <li>
                        <img src="{{url('assets/images/shapes/category-one-social-media-shape-1.png')}}" alt="">
                    </li>
                    <li>
                        <h3>Programming</h3>
                    </li>
                </ul>
            </div>            
            <div class="container">
                 <div class="section-title text-center  sec-title-animation animation-style2">
                                <div class="section-title__tagline-box ">
                                    <div class="section-title__tagline-shape"></div>
                                    <span class="section-title__tagline text-white">Categories</span>
                                </div>
                                <h2 class="section-title__title title-animation text-white">Explore Our Best-In-Class Anime Art & Design Paths <br>
Master Each Skill with Tailored <span> Course Tracks <img src="{{url('assets/images/shapes/section-title-shape-2.png')}}"
                                            alt=""></span></h2>
                                           <p class="categry_text title-animation text-white"> These would visually align under the section heading as clickable or showcased categories: </p>
                            </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-7">
                        <div class="category-one__left">
                            
                            <ul class="category-one__category-list list-unstyled">
                                <li>
                                    <div class="category-one__count-and-arrow">
                                        <div class="category-one__count-box">
                                            <div class="category-one__count"></div>
                                            <div class="category-one__count-content">
                                                <h3><a href="course-details.html">Anime Character Design</a></h3>                                                
                                            </div>
                                        </div>
                                        <div class="category-one__count-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                    <div class="category-one__hover-icon-and-arrow">
                                        <div class="category-one__hover-icon-box">
                                            <div class="category-one__hover-icon">
                                                <img src="{{url('assets/images/icon/category-one-hover-icon-1-1.png')}}" alt="">
                                            </div>
                                            <div class="category-one__hover-content">
                                              
                                                <p>Craft expressive, iconic characters with deep personality, unique styles, and commercial appeal.</p>
                                            </div>
                                        </div>
                                        <div class="category-one__hover-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="category-one__count-and-arrow">
                                        <div class="category-one__count-box">
                                            <div class="category-one__count"></div>
                                            <div class="category-one__count-content">
                                                <h3><a href="course-details.html">Worldbuilding & Environment Design</a></h3>
                                               
                                            </div>
                                        </div>
                                        <div class="category-one__count-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                    <div class="category-one__hover-icon-and-arrow">
                                        <div class="category-one__hover-icon-box">
                                            <div class="category-one__hover-icon">
                                                <img src="{{url('assets/images/icon/category-one-hover-icon-1-1.png')}}" alt="">
                                            </div>
                                            <div class="category-one__hover-content">
                                               
                                                <p>Design immersive anime worlds—futuristic cities, enchanted forests, cozy interiors, and beyond.</p>
                                            </div>
                                        </div>
                                        <div class="category-one__hover-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="category-one__count-and-arrow">
                                        <div class="category-one__count-box">
                                            <div class="category-one__count"></div>
                                            <div class="category-one__count-content">
                                                <h3><a href="course-details.html"> Manga Art & Sequential Design</a></h3>
                                              
                                            </div>
                                        </div>
                                        <div class="category-one__count-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                    <div class="category-one__hover-icon-and-arrow">
                                        <div class="category-one__hover-icon-box">
                                            <div class="category-one__hover-icon">
                                                <img src="{{url('assets/images/icon/category-one-hover-icon-1-1.png')}}" alt="">
                                            </div>
                                            <div class="category-one__hover-content">
                                               
                                                <p>Learn the art of visual storytelling—dynamic panels, expressive FX, and layout for flow and drama.</p>
                                            </div>
                                        </div>
                                        <div class="category-one__hover-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5 wow slideInRight" data-wow-delay="100ms" data-wow-duration="2500ms">
                        <div class="category-one__right">
                              <ul class="category-one__category-list list-unstyled">
                                <li>
                                    <div class="category-one__count-and-arrow">
                                        <div class="category-one__count-box">
                                            <div class="category-one__count"></div>
                                            <div class="category-one__count-content">
                                                <h3><a href="course-details.html">Anime Illustration & Digital Painting</a></h3>
                                                
                                            </div>
                                        </div>
                                        <div class="category-one__count-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                    <div class="category-one__hover-icon-and-arrow">
                                        <div class="category-one__hover-icon-box">
                                            <div class="category-one__hover-icon">
                                                <img src="{{url('assets/images/icon/category-one-hover-icon-1-1.png')}}" alt="">
                                            </div>
                                            <div class="category-one__hover-content">
                                              
                                                <p> Paint striking visuals with cel shading, lighting techniques, and portfolio-ready compositions.</p>
                                            </div>
                                        </div>
                                        <div class="category-one__hover-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="category-one__count-and-arrow">
                                        <div class="category-one__count-box">
                                            <div class="category-one__count"></div>
                                            <div class="category-one__count-content">
                                                <h3><a href="course-details.html">Design for Anime Games & Interactive Media</a></h3>
                                                
                                            </div>
                                        </div>
                                        <div class="category-one__count-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                    <div class="category-one__hover-icon-and-arrow">
                                        <div class="category-one__hover-icon-box">
                                            <div class="category-one__hover-icon">
                                                <img src="{{url('assets/images/icon/category-one-hover-icon-1-1.png')}}" alt="">
                                            </div>
                                            <div class="category-one__hover-content">
                                         
                                                <p>Create characters, sprites, UI/UX, and cutscenes that bring interactive anime stories to life.</p>
                                            </div>
                                        </div>
                                        <div class="category-one__hover-arrow">
                                            <a href="course-details.html"><span
                                                    class="icon-arrow-up-right-2"></span></a>
                                        </div>
                                    </div>
                                </li>
                              
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category One End -->
         <!-- Courses One Start -->
        <section class="courses-one">
            <div class="container">
                <div class="section-title text-center sec-title-animation animation-style1">
                    <div class="section-title__tagline-box">
                        <div class="section-title__tagline-shape"></div>
                        <span class="section-title__tagline">Our Courses</span>
                    </div>
                    <h2 class="section-title__title title-animation"> Not Just Courses: <br>A Gateway Into the World of 
                        <span>Anime Creation <img src="{{url('assets/images/shapes/section-title-shape-1.png')}}" alt=""></span></h2>
                </div>
                <div class="courses-one__carousel owl-theme owl-carousel">
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-1.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>Art & Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>12 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>120h 45min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">Graphic Design
                                        Essentials From Concept to Creation</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">250 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$260.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-2.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>UI/UX Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>4 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>120h 45min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">UI/UX Design Enhancing User
                                        Experience Effectively</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">45 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$150.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-3.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>Web Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>45 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>620h 55min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">Modern Web Design Aesthetic
                                        and Functional Websites</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$240.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-1.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>Art & Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>12 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>120h 45min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">Graphic Design
                                        Essentials From Concept to Creation</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">250 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$260.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-2.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>UI/UX Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>4 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>120h 45min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">UI/UX Design Enhancing User
                                        Experience Effectively</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">45 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$150.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-3.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>Web Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>45 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>620h 55min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">Modern Web Design Aesthetic
                                        and Functional Websites</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$240.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-1.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>Art & Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>12 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>120h 45min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">Graphic Design
                                        Essentials From Concept to Creation</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">250 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$260.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-2.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>UI/UX Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>4 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>120h 45min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">UI/UX Design Enhancing User
                                        Experience Effectively</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">45 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$150.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                    <!--Courses One Single Start-->
                    <div class="item">
                        <div class="courses-one__single">
                            <div class="courses-one__img-box">
                                <div class="courses-one__img">
                                    <img src="{{url('assets/images/resources/courses-1-3.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="courses-one__content">
                                <div class="courses-one__tag-and-meta">
                                    <div class="courses-one__tag">
                                        <span>Web Design</span>
                                    </div>
                                    <ul class="courses-one__meta list-unstyled">
                                        <li>
                                            <div class="icon">
                                                <span class="icon-book"></span>
                                            </div>
                                            <p>45 Lesson</p>
                                        </li>
                                        <li>
                                            <div class="icon">
                                                <span class="icon-clock"></span>
                                            </div>
                                            <p>620h 55min</p>
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="courses-one__title"><a href="course-details.html">Modern Web Design Aesthetic
                                        and Functional Websites</a></h3>
                                <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
                                    <div class="courses-one__heart">
                                        <a href="course-details.html"><span class="icon-heart"></span></a>
                                    </div>
                                </div>
                                <div class="courses-one__btn-and-doller-box">
                                    <div class="courses-one__btn-box">
                                        <a href="course-details.html" class="courses-one__btn thm-btn"><span
                                                class="icon-angles-right"></span>Add To Cart</a>
                                    </div>
                                    <span>$240.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Courses One Single End-->
                </div>
                <div class="course-shpe">
                <img src="{{url('assets/images/course-shape-1.png')}}" alt="course-shape" >
                     </div>
            </div>
         

        </section>
        <!-- Courses One End -->
            <!-- Counter One Start -->
        <section class="counter-one">
            <div class="counter-one__bg" style="background-image: url(assets/images/backgrounds/counter-1.webp);">
                
            </div>
            <div class="counter-one__shape-1"
                style="background-image: url(assets/images/shapes/counter-one-shape-1.png);"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="counter-one__left">
                            <ul class="counter-one__list list-unstyled">
                                <li>
                                    <div class="counter-one__count-hover-img"
                                        style="background-image: url(assets/images/resources/counter-one-single-hover-img.jpg);">
                                    </div>
                                    <div class="counter-one__count count-box">
                                        <h3 class="count-text" data-stop="10" data-speed="1500">00</h3>
                                        <span>k</span>
                                    </div>
                                    <p>Student Trained</p>
                                </li>
                                <li>
                                    <div class="counter-one__count-hover-img"
                                        style="background-image: url(assets/images/resources/counter-one-single-hover-img.jpg);">
                                    </div>
                                    <div class="counter-one__count count-box">
                                        <h3 class="count-text" data-stop="50" data-speed="1500">00</h3>
                                        <span>+</span>
                                    </div>
                                    <p>Recorded Courses</p>
                                </li>
                                <li>
                                    <div class="counter-one__count-hover-img"
                                        style="background-image: url(assets/images/resources/counter-one-single-hover-img.jpg);">
                                    </div>
                                    <div class="counter-one__count count-box">
                                        <h3 class="count-text" data-stop="15" data-speed="1500">00</h3>
                                        <span>M</span>
                                    </div>
                                    <p>Satisfaction Rate</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Counter One End -->
          <!-- Live Class One Start -->
        <section class="live-class-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="live-class-one__left">
                            <div class="section-title text-left sec-title-animation animation-style2">
                                <div class="section-title__tagline-box">
                                    <div class="section-title__tagline-shape"></div>
                                    <span class="section-title__tagline">Stream Creative Excellence</span>
                                </div>
                                <h2 class="section-title__title title-animation">Experience our unique touch of creativity through every 
                                    <span> course.<img src="{{url('assets/images/shapes/section-title-shape-1.png')}}"
                                            alt=""></span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="live-class-one__right">
                            <div class="live-class-one__carousel owl-theme owl-carousel">
                                <!-- Live Class One Single Start -->
                                <div class="item">
                                    <div class="live-class-one__single">
                                        <div class="live-class-one__img">
                                            <img src="{{url('assets/images/resources/live-class-1-1.jpg')}}" alt="">
                                            <div class="live-class-one__btn-box">
                                                <a href="course-details.html" class="thm-btn">$200</a>
                                            </div>
                                        </div>
                                        <div class="live-class-one__content">
                                                                      <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
</div>
                                            <h4 class="live-class-one__title"><a href="course-details.html">Master
                                                    Python Programming for
                                                    Beginners and Beyond</a></h4>                                            
                                    </div>
                                </div>
</div>
                                <!-- Live Class One Single End -->
                                <!-- Live Class One Single Start -->
                                <div class="item">
                                    <div class="live-class-one__single">
                                        <div class="live-class-one__img">
                                            <img src="{{url('assets/images/resources/live-class-1-2.jpg')}}" alt="">
                                            <div class="live-class-one__btn-box">
                                                <a href="course-details.html" class="thm-btn">$100</a>
                                            </div>
                                        </div>
                                        <div class="live-class-one__content">
                                              <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
</div>
                                            <h4 class="live-class-one__title"><a href="course-details.html">AI
                                                    Foundations: Machine
                                                    Learning Networks</a></h4>
                                          </div> 
                                    </div>
                                </div>
                                <!-- Live Class One Single End -->
                                <!-- Live Class One Single Start -->
                                <div class="item">
                                    <div class="live-class-one__single">
                                        <div class="live-class-one__img">
                                            <img src="{{url('assets/images/resources/live-class-1-3.jpg')}}" alt="">
                                            <div class="live-class-one__btn-box">
                                                <a href="javascript:void(0)" class="thm-btn">$60</a>
                                            </div>
                                        </div>
                                        <div class="live-class-one__content">
                                                                      <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
</div>
                                            <h4 class="live-class-one__title"><a href="course-details.html">Front end
                                                    development with
                                                    React js & Next js</a></h4>
                                        </div>  
                                    </div>
                                </div>
                                <!-- Live Class One Single End -->
                                <!-- Live Class One Single Start -->
                                <div class="item">
                                    <div class="live-class-one__single">
                                        <div class="live-class-one__img">
                                            <img src="{{url('assets/images/resources/live-class-1-1.jpg')}}" alt="">
                                            <div class="live-class-one__btn-box">
                                                <a href="javascript:void(0)" class="thm-btn">40</a>
                                            </div>
                                        </div>
                                        <div class="live-class-one__content">
                                                                      <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
</div>
                                            <h4 class="live-class-one__title"><a href="course-details.html">Master
                                                    Python Programming for
                                                    Beginners and Beyond</a></h4>
                                          
                                        </div>
                                    </div>
                                </div>
                                <!-- Live Class One Single End -->
                                <!-- Live Class One Single Start -->
                                <div class="item">
                                    <div class="live-class-one__single">
                                        <div class="live-class-one__img">
                                            <img src="{{url('assets/images/resources/live-class-1-2.jpg')}}" alt="">
                                            <div class="live-class-one__btn-box">
                                                <a href="javascript:void(0)" class="thm-btn">$30</a>
                                            </div>
                                        </div>
                                        <div class="live-class-one__content">
                                                                      <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
</div>
                                            <h4 class="live-class-one__title"><a href="course-details.html">AI
                                                    Foundations: Machine
                                                    Learning Networks</a></h4>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- Live Class One Single End -->
                                <!-- Live Class One Single Start -->
                                <div class="item">
                                    <div class="live-class-one__single">
                                        <div class="live-class-one__img">
                                            <img src="{{url('assets/images/resources/live-class-1-3.jpg')}}" alt="">
                                            <div class="live-class-one__btn-box">
                                                <a href="javascript:void(0)" class="thm-btn">$40</a>
                                            </div>
                                        </div>
                                        <div class="live-class-one__content">
                                                                      <div class="courses-one__ratting-and-heart-box">
                                    <div class="courses-one__ratting-box">
                                        <ul class="courses-one__ratting list-unstyled">
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                            <li>
                                                <span class="icon-star"></span>
                                            </li>
                                        </ul>
                                        <p class="courses-one__ratting-text">32 Reviews</p>
                                    </div>
</div>
                                            <h4 class="live-class-one__title"><a href="course-details.html">Front end
                                                    development with
                                                    React js & Next js</a></h4>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- Live Class One Single End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Live Class One End -->
   <!--Team Carousel Page Start-->
        <section class="team-carousel-page instructor-detal">
             <div class="category-one__bg-shape" style="background-image: url(assets/images/shapes/category-one-bg-shape.png);"></div>
          <div class="category-one__shape-1">
                <img src="{{url('assets/images/shapes/category-one-shape-1.png')}}" alt="">
            </div>
            <div class="category-one__shape-2">
                <img src="{{url('assets/images/shapes/category-one-shape-2.png')}}" alt="">
            </div>
            <div class="category-one__shape-3">
                <img src="{{url('assets/images/shapes/category-one-shape-3.png')}}" alt="">
            </div>
         <div class="why-choose-two__dot-1">
             <img src="{{url('assets/images/shapes/why-choose-two-dot-1.png')}}" alt="">
            </div>
            <div class="why-choose-two__dot-2">
              <img src="{{url('assets/images/shapes/why-choose-two-dot-2.png')}}" alt="">
             </div>
             <div class="banner-two__shape-6 rotate-me">
                <img src="{{url('assets/images/shapes/banner-two-shape-6.png')}}" alt="">
            </div>
             <div class="banner-two__book-icon img-bounce">
                <img src="{{url('assets/images/icon/banner-two-book-icon.png')}}" alt="">
            </div>
            <div class="container">
                      <div class="section-title text-center sec-title-animation animation-style1">
                        <div class="section-title__tagline-box">
                            <div class="section-title__tagline-shape"></div>
                            <span class="section-title__tagline">Crafted by Creators, Taught by Legends</span>
                        </div>
                        
                        <h2 class="section-title__title title-animation"> Our instructors bring global <br> anime expertise to  <span> your screen. <img src="{{url('assets/images/shapes/section-title-shape-1.png')}}" alt=""></span></h2>
                </div>
                <div class="team-carousel-style owl-carousel owl-theme carousel-dot-style mt-5">
                    <!--Team One Single Start-->
                    <div class="item">
                        <div class="team-one__single">
                            <div class="team-one__img-box">
                            
                                <div class="team-one__content">
                                    <div class="team-one__single-bg-shape"
                                        style="background-image: url(assets/images/shapes/team-one-single-bg-shape.png);">
                                    </div>
                                    <div class="team-one__content-shape-1">
                                        <img src="{{url('assets/images/shapes/team-one-content-shape-1.png')}}" alt="">
                                    </div>
                                    <div class="team-one__content-shape-2">
                                        <img src="{{url('assets/images/shapes/team-one-content-shape-2.png')}}" alt="">
                                    </div>                                   
                                    <h3 class="team-one__title"><a href="instructor.php">Aiko Tanaka</a></h3>
                                    <p class="team-one__sub-title">Anime Character Design & Facial Expression Development</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Team One Single End-->
                    <!--Team One Single Start-->
                    <div class="item">
                        <div class="team-one__single">
                            <div class="team-one__img-box">
                              
                                <div class="team-one__content">
                                    <div class="team-one__single-bg-shape"
                                        style="background-image: url(assets/images/shapes/team-one-single-bg-shape.png);">
                                    </div>
                                    <div class="team-one__content-shape-1">
                                        <img src="{{url('assets/images/shapes/team-one-content-shape-1.png')}}" alt="">
                                    </div>
                                    <div class="team-one__content-shape-2">
                                        <img src="{{url('assets/images/shapes/team-one-content-shape-2.png')}}" alt="">
                                    </div>                                 
                                    <h3 class="team-one__title"><a href="instructor.php">Riku Yamashiro</a></h3>
                                    <p class="team-one__sub-title">Manga Panel Flow & Visual Storytelling</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Team One Single End-->
                    <!--Team One Single Start-->
                    <div class="item">
                        <div class="team-one__single">
                            <div class="team-one__img-box">                              
                                <div class="team-one__content">
                                    <div class="team-one__single-bg-shape"
                                        style="background-image: url(assets/images/shapes/team-one-single-bg-shape.png);">
                                    </div>
                                    <div class="team-one__content-shape-1">
                                        <img src="{{url('assets/images/shapes/team-one-content-shape-1.png')}}" alt="">
                                    </div>
                                    <div class="team-one__content-shape-2">
                                        <img src="{{url('assets/images/shapes/team-one-content-shape-2.png')}}" alt="">
                                    </div>                                 
                                    <h3 class="team-one__title"><a href="instructor.php">Haruka Nishimura</a></h3>
                                    <p class="team-one__sub-title">Worldbuilding & Background Art</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Team One Single End-->
                    <!--Team One Single Start-->
                    <div class="item">
                        <div class="team-one__single">
                            <div class="team-one__img-box">                               
                                <div class="team-one__content">
                                    <div class="team-one__single-bg-shape"
                                        style="background-image: url(assets/images/shapes/team-one-single-bg-shape.png);">
                                    </div>
                                    <div class="team-one__content-shape-1">
                                        <img src="{{url('assets/images/shapes/team-one-content-shape-1.png')}}" alt="">
                                    </div>
                                    <div class="team-one__content-shape-2">
                                        <img src="{{url('assets/images/shapes/team-one-content-shape-2.png')}}" alt="">
                                    </div>
                                  
                                    <h3 class="team-one__title"><a href="instructor.php">Ethan Cross</a></h3>
                                    <p class="team-one__sub-title">Anime Game Assets & UI/UX for Interactive Media</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Team One Single End-->
                  
                </div>
            </div>
          <div class="banner-two__shape-6 rotate-me">
                <img src="{{url('assets/images/shapes/banner-two-shape-6.png')}}" alt="">
            </div>
             <div class="banner-two__book-icon img-bounce">
                <img src="{{url('assets/images/icon/banner-two-book-icon.png')}}" alt="">
            </div>
             <div class="sliding-text-five">
                <ul class="sliding-text-five__list list-unstyled marquee_mode-2">
                    <li>
                        <h2 data-hover="Our Professional" class="sliding-text-five__title">Our Professional</h2>
                    </li>
                    <li><img src="{{url('assets/images/shapes/sliding-text-five-shape-1.png')}}" alt=""></li>
                    <li>
                        <h2 data-hover="Our Professional" class="sliding-text-five__title">Our Professional</h2>
                    </li>
                    <li><img src="{{url('assets/images/shapes/sliding-text-five-shape-1.png')}}" alt=""></li>
                </ul>
            </div>      
        </section>
        <!--Team Carousel Page End-->


@endsection
