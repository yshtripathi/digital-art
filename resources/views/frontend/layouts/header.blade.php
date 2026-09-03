{{-- Main Duolingo Theme Header Revamp --}}


<header class="art-header">
    <div class="art-header-container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="art-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
        </a>

        {{-- Main Navigation (Desktop) --}}
        <ul class="art-nav d-none d-lg-flex">
            <li class="art-nav-item">
                <a href="{{ route('home') }}" class="art-nav-link {{ Route::is('home') ? 'active' : '' }}">{{ __('inkwave.nav_home') }}</a>
            </li>

            <li class="art-nav-item">
                <a href="javascript:void(0)" class="art-nav-link">
                    {{ __('inkwave.nav_categories') }} <i class="fas fa-chevron-down"></i>
                </a>
                <div class="art-dropdown-menu">
                    @php
                        $categories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
                    @endphp
                    @forelse($categories as $cat)
                        @php
                            $cimg = $cat->photo ? explode(',', $cat->photo)[0] : null;
                        @endphp
                        <a class="art-dropdown-item {{ (isset($category->id) && $category->id == $cat->id) ? 'active' : '' }}" href="{{ route('product-lists', $cat->slug) }}">
                            @if($cimg)
                                <img src="{{ url($cimg) }}" alt="{{ $cat->title }}">
                            @else
                                <div><i class="fas fa-image"></i></div>
                            @endif
                            {{ $cat->title }}
                        </a>
                    @empty
                        <span class="art-dropdown-item text-muted">{{ __('inkwave.nav_no_categories') }}</span>
                    @endforelse
                </div>
            </li>

            <li class="art-nav-item">
                <a href="{{ route('product-lists') }}" class="art-nav-link {{ Route::is('product-lists') ? 'active' : '' }}">{{ __('inkwave.nav_courses') }}</a>
            </li>

            @if(Auth::check())
            <li class="art-nav-item">
                <a href="{{ route('user') }}" class="art-nav-link">{{ __('inkwave.nav_my_courses') }}</a>
            </li>
            <li class="art-nav-item">
                <a href="{{ route('user') }}" class="art-nav-link">{{ __('inkwave.nav_orders') }}</a>
            </li>
            @endif

            <li class="art-nav-item">
                <a href="{{ route('contact') }}" class="art-nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('inkwave.nav_support') }}</a>
            </li>
        </ul>

        {{-- Actions --}}
        <div class="art-actions">
            
            {{-- Language --}}
            <div class="art-dropdown-wrapper d-none d-xl-block">
                <a href="javascript:void(0)" class="art-user-btn">
                    @if(session('app_locale') == 'ja' || app()->getLocale() == 'ja')
                        <i class="fi fi-jp"></i>
                    @else
                        <i class="fi fi-gb"></i>
                    @endif
                    <i class="fas fa-chevron-down"></i>
                </a>
                <div class="art-dropdown-menu">
                    <a class="art-dropdown-item" href="{{ route('change.language', 'en') }}"><i class="fi fi-gb"></i> EN</a>
                    <a class="art-dropdown-item" href="{{ route('change.language', 'ja') }}"><i class="fi fi-jp"></i> JP</a>
                </div>
            </div>

            {{-- Currency --}}
            <div class="art-dropdown-wrapper d-none d-xl-block">
                @php
                    $currentCurrency = session('currency', 'USD');
                    $currencies = Helper::CurrenciesList();
                @endphp
                <a href="javascript:void(0)" class="art-user-btn">
                    {{ $currentCurrency }} <i class="fas fa-chevron-down"></i>
                </a>
                <div class="art-dropdown-menu">
                    @foreach($currencies as $cur)
                        <a class="art-dropdown-item {{ $currentCurrency == $cur->code ? 'active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                            {{ $cur->code }} ({{ Helper::getCurrencySymbol($cur->code) }})
                        </a>
                    @endforeach
                </div>
            </div>

            @if(Auth::check())
                {{-- Points --}}
                <a href="{{ route('points.topup') }}" class="art-points-badge d-none d-md-flex">
                    <i class="fas fa-coins"></i> {{ Auth::user()->points_balance ?? 0 }}
                </a>

                {{-- User Profile --}}
                <div class="art-dropdown-wrapper">
                    <a href="javascript:void(0)" class="art-user-btn">
                        <i class="fas fa-user"></i> 
                        <span class="d-none d-md-inline">{{ explode(' ', Auth::user()->name)[0] }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="art-dropdown-menu">
                        <a class="art-dropdown-item" href="{{ route('user') }}"><i class="fas fa-id-card"></i> {{ __('inkwave.nav_account') }}</a>
                        <a class="art-dropdown-item text-danger" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i> {{ __('inkwave.nav_logout') }}</a>
                    </div>
                </div>
            @else
                {{-- Guest Auth --}}
                <div class="d-none d-md-flex align-items-center gap-2">
                    <a href="{{ route('login.form') }}" class="art-btn-login">{{ __('inkwave.nav_login') }}</a>
                    <a href="{{ route('register.form') }}" class="art-btn-register">{{ __('inkwave.nav_register') }}</a>
                </div>
            @endif

            {{-- Cart Toggle --}}
            <button class="art-cart-btn bb-cart-toggle ui-btn border-0" aria-label="Toggle Cart">
                <i class="fas fa-shopping-bag"></i>
                <span class="art-cart-count">{{ Helper::totalCartQuantity() }}</span>
            </button>

            {{-- Mobile Toggler --}}
            <button class="mobile-nav-toggler d-lg-none border-0 bg-transparent fs-3 ms-2">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Sidebar Drawer --}}
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box">
            <div class="upper-box d-flex justify-content-between align-items-center p-4 border-bottom">
                <div class="nav-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                    </a>
                </div>
                <button class="close-btn fs-4 border-0 bg-transparent p-0"><i class="icon fa fa-times"></i></button>
            </div>
            <ul class="navigation list-unstyled p-4 m-0">
                {{-- JS Populated --}}
            </ul>
        </nav>
    </div>
</header>


{{-- Cart Sidebar --}}
<div class="offcanvas__overlay"></div>
<div class="cartcanvas__info">
    <div class="cart-header d-flex justify-content-between align-items-center mb-4 pb-3">
        <h4 class="fw-bold mb-0">{{ __('inkwave.nav_cart_heading') }}</h4>
        <div class="cartcanvas__close fs-4"><i class="fas fa-times"></i></div>
    </div>

    <div class="cart-content-wrapper h-100 d-flex flex-column px-4 pt-4">
        <ul class="cart-list list-unstyled flex-grow-1 overflow-auto pe-2">
            @if(Helper::cartCount())
                @foreach(Helper::getAllProductFromCart() as $cart)
                    @php
                        $isPoints = !$cart->product || $cart->product_id >= 1000;
                        $item_title = __('inkwave.nav_credits_topup');
                        $item_photo = null;
                        $item_level = 'N/A';

                        if($cart->product && $cart->product_id < 1000) {
                            $photo_arr = explode(',', $cart->product->photo);
                            $item_photo = $photo_arr[0];
                            $item_title = $cart->product->title;

                            // Look up level
                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                         ->where('price_in_points', $cart->points)
                                         ->first();
                            $lvl_key = $level ? strtolower($level->skill_level) . '_course' : '';
                            $item_level = ($level && Lang::has('inkwave.' . $lvl_key)) ? __('inkwave.' . $lvl_key) : ($level ? ucfirst($level->skill_level) : 'N/A');
                        }
                    @endphp
                    @if($isPoints)
                        {{-- Points Item --}}
                        <li class="cart-item d-flex align-items-center justify-content-between position-relative">
                            <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item position-absolute top-0 end-0 m-2">
                                <i class="fas fa-times"></i>
                            </a>
                            <div class="item-details flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-coins"></i>
                                    <h6 class="mb-0 fw-bold">{{ $item_title }}</h6>
                                </div>
                                <p class="mb-0 small text-muted">
                                    {{ $cart->quantity }} x <span class="fw-bold">{{ number_format($cart->points) }} {{ __('inkwave.nav_credits_label') }}</span>
                                </p>
                            </div>
                            <div class="text-end ms-3">
                                <p class="mb-0 small text-muted">{{ __('inkwave.nav_total_label') }}</p>
                                <p class="mb-0 fw-bold fs-5 text-dark">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            </div>
                        </li>
                    @else
                        {{-- Product Item --}}
                        <li class="cart-item d-flex align-items-center gap-3 position-relative">
                            <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item position-absolute top-0 end-0 m-2">
                                <i class="fas fa-times"></i>
                            </a>
                            <div class="item-img">
                                <img src="{{ asset($item_photo) }}" class="w-100 h-100 object-fit-cover" alt="">
                            </div>
                            <div class="item-details flex-grow-1 min-width-0">
                                <h6 class="mb-1 fw-bold">{{ $item_title }}</h6>
                                <div class="mb-1">
                                    <span class="badge px-2 py-1">
                                        <i class="fas fa-star me-1"></i> {{ $item_level }}
                                    </span>
                                </div>
                                <p class="mb-0 small text-muted">
                                    {{ $cart->quantity }} x <span class="fw-bold">{{ number_format($cart->points) }} {{ __('inkwave.nav_credits_label') }}</span>
                                </p>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                <li class="text-center py-5 d-flex flex-column justify-content-center align-items-center h-100">
                    <div class="mb-3"><i class="fas fa-shopping-basket fa-4x"></i></div>
                    <p class="fw-bold text-muted mb-4">{{ __('inkwave.nav_empty_cart_msg') }}</p>
                    <a href="{{ route('product-lists') }}" class="art-btn-cart-outline">{{ __('inkwave.nav_courses') }}</a>
                </li>
            @endif
        </ul>

        @if(Helper::cartCount())
            @php
                $cartItems = Helper::getAllProductFromCart();
                $hasPoints = false;
                $hasProducts = false;
                $totalPrice = 0;
                $totalPoints = 0;

                foreach($cartItems as $item) {
                    if(!$item->product || $item->product_id >= 1000) {
                        $hasPoints = true;
                        $totalPrice += $item['price'];
                    } else {
                        $hasProducts = true;
                        $totalPoints += ($item->quantity * $item->points);
                    }
                }
            @endphp
            <div class="cart-footer mt-auto mx-n4 px-4 pb-4">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h5 class="fw-bold mb-0">{{ __('inkwave.nav_total_label') }}:</h5>
                    @if($hasPoints && !$hasProducts)
                        <h3 class="fw-bold mb-0">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</h3>
                    @else
                        <h3 class="fw-bold mb-0">{{ number_format($totalPoints) }} <span class="fs-6 text-muted">{{ __('inkwave.nav_credits_label') }}</span></h3>
                    @endif
                </div>
                <div class="d-flex flex-column gap-3">
                    @if($hasPoints && !$hasProducts)
                        <a href="{{ route('cart') }}" class="art-btn-cart-outline w-100">
                            <i class="fas fa-shopping-cart"></i> {{ __('inkwave.nav_view_cart_btn') }}
                        </a>
                        <a href="{{ route('checkout') }}" class="art-btn-cart-primary w-100">
                            {{ __('inkwave.nav_checkout_btn') }} <i class="fas fa-arrow-right"></i>
                        </a>
                    @elseif($hasProducts && !$hasPoints)
                        <a href="{{ route('coursecart') }}" class="art-btn-cart-primary w-100">
                            <i class="fas fa-shopping-cart"></i> {{ __('inkwave.nav_view_cart_btn') }}
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

@cookieconsentview


