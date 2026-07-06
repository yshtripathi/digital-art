@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
<div class="tl-breadcrumb catalog-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ $product_detail->title }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="{{route('home')}}">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ $product_detail->title }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="product-details-section pt-60 pb-80" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="container">
        @php $photo = explode(',', $product_detail->photo); @endphp

        <!-- Title Centered -->
        <div class="row justify-content-center mb-5">
            <div class="col-12 text-center">
                <h1 class="fw-900" style="font-size: 48px; font-weight: 900; color: #0a0e27; line-height: 1.2;">
                    {{ $product_detail->title }}
                </h1>
            </div>
        </div>

        <!-- Image Left, Content Right -->
        <div class="row align-items-start g-5 mb-5">
            <!-- Image on Left (1:1 Aspect Ratio) -->
            <div class="col-lg-6">
                <div class="modern-card p-0 border-0 overflow-hidden position-relative watermark-overlay" style="border-radius: 28px; border: 1.5px solid rgba(232, 93, 142, 0.1); box-shadow: 0 30px 80px rgba(232, 93, 142, 0.2); aspect-ratio: 1/1; animation: slideInUp 0.6s ease-out;">
                    <img src="{{ asset($photo[0]) }}" class="w-100 h-100 object-fit-cover" style="transition: transform 0.5s ease;">
                </div>
            </div>

            <!-- Content on Right -->
            <div class="col-lg-6">
                <!-- Course Overview -->
                <div class="modern-card p-5 border-0 mb-4" style="border-radius: 24px; border: 1px solid rgba(232, 93, 142, 0.1); background: rgba(255, 255, 255, 0.6);">
                    <h4 class="fw-bold mb-3" style="font-size: 18px; color: #0a0e27;">{{ __('common.artwork_overview') }}</h4>
                    
                    <p class="text-muted mb-0" style="font-size: 16px; line-height: 1.8; color: #666;">{{$product_detail->description}}</p>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Levels Selection Section with Different Background -->
<section class="product-levels-section pt-80 pb-80" style="background: linear-gradient(135deg, #ffffff 0%, #FFF4EE 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2 class="fw-900 mb-5 text-center" style="font-size: 32px; font-weight: 900; color: #0a0e27;">{{ __('common.select_level') }}</h2>

                <!-- Level Slider Tabs -->
                <div class="level-slider-wrapper mb-5">
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        @foreach($product_detail->levels as $key => $level)
                            <button type="button" class="level-tab-btn {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" style="padding: 12px 28px; border-radius: 12px; background: rgba(232, 93, 142, 0.1); color: #E85D8E; border: 2px solid transparent; font-weight: 600; cursor: pointer; transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);">
                                <i class="fas fa-star me-2"></i>{{ ucfirst($level->skill_level) }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Level Details Section -->
                <div class="level-content-wrapper">
                    @foreach($product_detail->levels as $key => $level)
                        <div class="level-details-container {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" style="display: {{ $key === 0 ? 'block' : 'none' }}; animation: slideInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);">
                            <div class="concept-card p-5 border-0">
                                <div class="row align-items-center g-4">
                                    <!-- Left Column: Design Concept -->
                                    <div class="col-md-7 col-lg-8 concept-divider">
                                        <div class="pe-md-4">
                                            <span class="badge rounded-2 px-3 py-2 mb-3" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">
                                                <i class="fas fa-palette me-1"></i> {{ __('common.design_concept') }}
                                            </span>
                                            <p class="text-dark mb-0" style="font-size: 16px; line-height: 1.8; color: #2d3748; font-weight: 500;">
                                                {{ $level->purpose }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Right Column: Cost and Button -->
                                    <div class="col-md-5 col-lg-4 text-center text-md-start">
                                        <div class="ps-md-4 d-flex flex-column justify-content-center h-100">
                                            <div class="mb-4">
                                                <span class="text-muted small text-uppercase" style="font-size: 11px; letter-spacing: 1.5px; font-weight: 600; display: block; margin-bottom: 6px;">{{ __('common.price') }}</span>
                                                <h3 class="fw-900 mb-0" style="color: #0a0e27; font-size: 32px; font-weight: 900; line-height: 1;">
                                                    {{ number_format($level->price_in_points) }}
                                                    <span style="font-weight: 600; font-size: 16px; color: #E85D8E; margin-left: 2px;">{{ __('common.credits') }}</span>
                                                </h3>
                                            </div>
                                            
                                            <form action="{{route('single-add-to-cart')}}" method="POST" class="enroll-form w-100">
                                                @csrf
                                                <input type="hidden" name="quant[1]" value="1">
                                                <input type="hidden" name="slug" value="{{$product_detail->slug}}">
                                                <input type="hidden" name="price" value="{{$level->price}}">
                                                <input type="hidden" name="price_jp" value="{{$level->price_jp}}">
                                                <input type="hidden" name="price_hk" value="{{$level->price_hk}}">
                                                <input type="hidden" name="level_id" value="{{$level->id}}">
                                                <button type="submit" class="btn w-100 py-3 fw-bold rounded-4 enroll-btn d-flex align-items-center justify-content-center gap-2" style="background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%); color: white; border: none; font-size: 15px; box-shadow: 0 10px 25px rgba(232, 93, 142, 0.25); transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
                                                    <span>{{ __('common.buy_now_text') }}</span> 
                                                    <i class="fas fa-arrow-right icon-arrow" style="transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);"></i>
                                                </button>
                                            </form>
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
</section>

@endsection

@push('styles')
<style>
    .product-details-section {
        padding-top: 60px !important;
        padding-bottom: 60px !important;
    }

    .product-levels-section {
        padding-top: 80px !important;
        padding-bottom: 80px !important;
    }

    .level-tab-btn {
        color: #E85D8E !important;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        background: rgba(232, 93, 142, 0.1) !important;
        font-weight: 600;
    }

    .level-tab-btn:hover:not(.active) {
        background: rgba(232, 93, 142, 0.15) !important;
        color: #E85D8E !important;
        transform: translateY(-3px);
    }

    .level-tab-btn.active {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%) !important;
        color: white !important;
        box-shadow: 0 12px 32px rgba(232, 93, 142, 0.3) !important;
    }

    .level-details-container {
        animation: slideInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    /* Concept Card Specific Styles */
    .concept-card {
        border-radius: 28px !important;
        border: 1.5px solid rgba(232, 93, 142, 0.1) !important;
        background: rgba(255, 255, 255, 0.75) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 50px rgba(232, 93, 142, 0.08) !important;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    .concept-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 30px 60px rgba(232, 93, 142, 0.14) !important;
        border-color: rgba(232, 93, 142, 0.2) !important;
    }

    .concept-divider {
        border-right: 1px solid rgba(232, 93, 142, 0.15);
    }

    @media (max-width: 767.98px) {
        .concept-divider {
            border-right: none !important;
            border-bottom: 1px solid rgba(232, 93, 142, 0.15);
            padding-bottom: 24px;
            margin-bottom: 24px;
        }
    }

    .enroll-btn {
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .enroll-btn:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 12px 30px rgba(232, 93, 142, 0.4) !important;
    }

    .enroll-btn:hover .icon-arrow {
        transform: translateX(4px);
    }

    .tiny { font-size: 0.75rem; }

    .sticky-top {
        transition: all 0.3s ease;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 992px) {
        .col-xl-7, .col-xl-5 {
            margin-bottom: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const levelTabBtns = document.querySelectorAll('.level-tab-btn');
    const levelDetailsContainers = document.querySelectorAll('.level-details-container');

    levelTabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const levelId = this.getAttribute('data-level-id');

            // Remove active class from all buttons and containers
            levelTabBtns.forEach(b => b.classList.remove('active'));
            levelDetailsContainers.forEach(container => {
                container.style.display = 'none';
                container.classList.remove('active');
            });

            // Add active class to clicked button
            this.classList.add('active');

            // Show corresponding level details
            const activeContainer = document.querySelector(`.level-details-container[data-level-id="${levelId}"]`);
            if (activeContainer) {
                activeContainer.style.display = 'block';
                activeContainer.classList.add('active');
            }
        });
    });

    // Handle enroll form submission without redirect
    const enrollForms = document.querySelectorAll('.enroll-form');
    enrollForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = form.querySelector('.enroll-btn');
            const originalBtnText = submitBtn.innerHTML;
            const originalBtnState = submitBtn.disabled;

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';

            // Fetch the form
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                redirect: 'manual'
            })
            .then(response => {
                // Wait 500ms for cart update to complete
                return new Promise(resolve => {
                    setTimeout(() => {
                        resolve(response);
                    }, 500);
                });
            })
            .then(response => {
                // Reload the page to show success message
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                // Reset button state on error
                submitBtn.disabled = originalBtnState;
                submitBtn.innerHTML = originalBtnText;
            });
        });
    });
});
</script>
@endpush

