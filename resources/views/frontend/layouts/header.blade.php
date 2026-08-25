{{-- Main Duolingo Theme Header Revamp --}}
<style>
/* -------------------------------------------
   Duolingo Theme Header - Artora
------------------------------------------- */
:root {
  --color-eager-green: #58cc02;
  --color-storybook-green: #d7ffb8;
  --color-spark-blue: #1cb0f6;
  --color-fresh-leaf: #a5ed6e;
  --color-night-ink: #000437;
  --color-paper-white: #ffffff;
  --color-charcoal: #4b4b4b;
  --color-pencil-gray: #777777;
  --color-faded-gray: #afafaf;
}

body {
    background-color: var(--color-paper-white) !important;
    padding-top: 71px !important;
    font-family: 'Nunito', 'Nunito Sans', 'Inter', sans-serif !important;
}

.art-header {
    background: var(--color-paper-white) !important;
    border-bottom: 2px solid #e5e5e5 !important;
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    z-index: 1000 !important;
}

.art-header-container {
    max-width: 1440px !important;
    margin: 0 auto !important;
    padding: 12px 24px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    gap: 20px !important;
}

.art-logo {
    display: flex !important;
    align-items: center !important;
    text-decoration: none !important;
    flex-shrink: 0 !important;
}
.art-logo img {
    height: 45px !important;
}

.art-nav {
    display: flex !important;
    gap: 4px !important;
    align-items: center !important;
    margin: 0 auto !important;
    padding: 0 !important;
    list-style: none !important;
}

.art-nav-item, .art-dropdown-wrapper {
    position: relative !important;
}

.art-nav-link {
    color: var(--color-pencil-gray) !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    text-decoration: none !important;
    padding: 10px 16px !important;
    display: flex !important;
    align-items: center !important;
    gap: 6px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.0530em !important;
    border-radius: 12px !important;
    border: 2px solid transparent !important;
    white-space: nowrap !important;
}

.art-nav-link:hover, .art-nav-link.active {
    background: #f7f7f7 !important;
}

/* Dropdown */
.art-dropdown-menu {
    position: absolute !important;
    top: calc(100% + 12px) !important;
    left: 50% !important;
    transform: translateX(-50%) translateY(10px) !important;
    background: var(--color-paper-white) !important;
    border: 2px solid #e5e5e5 !important;
    border-radius: 16px !important;
    padding: 12px !important;
    min-width: 220px !important;
    opacity: 0 !important;
    visibility: hidden !important;
    box-shadow: 0 6px 0 #e5e5e5 !important;
    z-index: 10000 !important;
    transition: opacity 0.2s, transform 0.2s, visibility 0.2s !important;
}

.art-dropdown-menu::before {
    content: '' !important;
    position: absolute !important;
    top: -12px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    border-left: 10px solid transparent !important;
    border-right: 10px solid transparent !important;
    border-bottom: 10px solid #e5e5e5 !important;
}

.art-dropdown-menu::after {
    content: '' !important;
    position: absolute !important;
    top: -8px !important;
    left: 50% !important;
    transform: translateX(-50%) !important;
    border-left: 8px solid transparent !important;
    border-right: 8px solid transparent !important;
    border-bottom: 8px solid var(--color-paper-white) !important;
}

.art-nav-item:hover .art-dropdown-menu,
.art-dropdown-wrapper:hover .art-dropdown-menu {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateX(-50%) translateY(0) !important;
}

.art-dropdown-item {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 12px 16px !important;
    color: var(--color-charcoal) !important;
    text-decoration: none !important;
    font-size: 15px !important;
    font-weight: 700 !important;
    border-radius: 12px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.0530em !important;
    transition: background 0.1s !important;
}
.art-dropdown-item:hover {
    background: #f7f7f7 !important;
}

.art-actions {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.art-btn-login {
    background: transparent !important;
    color: var(--color-spark-blue) !important;
    padding: 10px 16px !important;
    border-radius: 12px !important;
    font-weight: 700 !important;
    font-size: 15px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.0530em !important;
    text-decoration: none !important;
    border: 2px solid #e5e5e5 !important;
    box-shadow: 0 2px 0 #e5e5e5 !important;
    transition: all 0.1s !important;
    white-space: nowrap !important;
}
.art-btn-login:hover {
    background: #f7f7f7 !important;
    color: var(--color-spark-blue) !important;
}
.art-btn-login:active {
    box-shadow: 0 0 0 #e5e5e5 !important;
    transform: translateY(2px) !important;
}

.art-btn-register {
    background: var(--color-eager-green) !important;
    color: var(--color-paper-white) !important;
    padding: 10px 16px !important;
    border-radius: 12px !important;
    font-weight: 700 !important;
    font-size: 15px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.0530em !important;
    text-decoration: none !important;
    border: none !important;
    box-shadow: 0 4px 0 #46a302 !important;
    transition: all 0.1s !important;
    white-space: nowrap !important;
}
.art-btn-register:hover {
    filter: brightness(1.05) !important;
    color: var(--color-paper-white) !important;
}
.art-btn-register:active {
    box-shadow: 0 0 0 #46a302 !important;
    transform: translateY(4px) !important;
}

.art-cart-btn {
    background: transparent !important;
    border: 2px solid #e5e5e5 !important;
    color: var(--color-pencil-gray) !important;
    width: 44px !important;
    height: 44px !important;
    border-radius: 12px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative !important;
    cursor: pointer !important;
    box-shadow: 0 2px 0 #e5e5e5 !important;
    transition: all 0.1s !important;
}
.art-cart-btn:hover {
    background: #f7f7f7 !important;
}
.art-cart-btn:active {
    box-shadow: 0 0 0 #e5e5e5 !important;
    transform: translateY(2px) !important;
}
.art-cart-count {
    position: absolute !important;
    top: -8px !important;
    right: -8px !important;
    background: #ff4b4b !important;
    color: #fff !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    min-width: 22px !important;
    height: 22px !important;
    border-radius: 11px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border: 2px solid var(--color-paper-white) !important;
}

.art-points-badge {
    background: transparent !important;
    color: var(--color-spark-blue) !important;
    padding: 10px 16px !important;
    border-radius: 12px !important;
    font-weight: 700 !important;
    font-size: 15px !important;
    text-transform: uppercase !important;
    text-decoration: none !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    border: 2px solid #e5e5e5 !important;
    box-shadow: 0 2px 0 #e5e5e5 !important;
    transition: all 0.1s !important;
    white-space: nowrap !important;
}
.art-points-badge:hover {
    background: #f7f7f7 !important;
    color: var(--color-spark-blue) !important;
}
.art-points-badge:active {
    box-shadow: 0 0 0 #e5e5e5 !important;
    transform: translateY(2px) !important;
}

.art-user-btn {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    color: var(--color-pencil-gray) !important;
    font-weight: 700 !important;
    text-decoration: none !important;
    padding: 10px 16px !important;
    border-radius: 12px !important;
    background: transparent !important;
    border: 2px solid #e5e5e5 !important;
    box-shadow: 0 2px 0 #e5e5e5 !important;
    text-transform: uppercase !important;
    font-size: 15px !important;
    letter-spacing: 0.0530em !important;
    transition: all 0.1s !important;
    white-space: nowrap !important;
}
.art-user-btn:hover {
    background: #f7f7f7 !important;
}
.art-user-btn:active {
    box-shadow: 0 0 0 #e5e5e5 !important;
    transform: translateY(2px) !important;
}

/* -------------------------------------------
   Sidebar Cart overlay (Duolingo Style)
------------------------------------------- */
.offcanvas__overlay {
    z-index: 10490 !important; /* Above header (1000) */
}
.cartcanvas__info {
    z-index: 10500 !important; /* Above overlay */
    background: var(--color-paper-white) !important;
    border-left: 2px solid #e5e5e5 !important;
    color: var(--color-charcoal) !important;
    box-shadow: -4px 0 0 rgba(0,0,0,0.05) !important;
}

.cart-header {
    background: var(--color-paper-white) !important;
    border-bottom: 2px solid #e5e5e5 !important;
    padding: 24px !important;
    margin: 0 !important;
}
.cart-header h4 {
    color: var(--color-charcoal) !important;
    font-weight: 700 !important;
    font-size: 24px !important;
    letter-spacing: -0.02em !important;
}
.cartcanvas__close { color: var(--color-faded-gray) !important; transition: all 0.2s ease !important; }
.cartcanvas__close:hover { color: var(--color-charcoal) !important; }

.cart-item {
    background: var(--color-paper-white) !important;
    border: 2px solid #e5e5e5 !important;
    border-radius: 12px !important;
    padding: 16px !important;
    margin-bottom: 12px !important;
    box-shadow: 0 4px 0 #e5e5e5 !important;
}

.cart-item h6 { color: var(--color-charcoal) !important; font-weight: 700 !important; font-size: 17px !important;}
.cart-item p, .cart-item .text-muted { color: var(--color-pencil-gray) !important; font-weight: 500 !important;}
.cart-item .fw-bold { color: var(--color-spark-blue) !important; }

.cart-item .remove-item {
    color: var(--color-faded-gray) !important;
    font-size: 20px !important;
    transition: all 0.2s ease !important;
    cursor: pointer !important;
}
.cart-item .remove-item:hover {
    color: #ff4b4b !important;
}

.cart-footer {
    background: var(--color-paper-white) !important;
    border-top: 2px solid #e5e5e5 !important;
    padding: 24px !important;
}

.cart-footer h5 { color: var(--color-pencil-gray) !important; font-weight: 700 !important; }
.cart-footer h3 { color: var(--color-charcoal) !important; font-weight: 700 !important; }

.art-btn-cart-primary {
    background: var(--color-eager-green) !important;
    color: var(--color-paper-white) !important;
    border: none !important;
    border-radius: 12px !important;
    padding: 14px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.0530em !important;
    box-shadow: 0 4px 0 #46a302 !important;
    text-align: center !important;
    display: block !important;
    width: 100% !important;
    transition: all 0.1s !important;
    text-decoration: none !important;
}
.art-btn-cart-primary:hover {
    filter: brightness(1.05) !important;
    color: var(--color-paper-white) !important;
}
.art-btn-cart-primary:active {
    box-shadow: 0 0 0 #46a302 !important;
    transform: translateY(4px) !important;
}

.art-btn-cart-outline {
    background: transparent !important;
    color: var(--color-spark-blue) !important;
    border: 2px solid #e5e5e5 !important;
    border-radius: 12px !important;
    padding: 14px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.0530em !important;
    box-shadow: 0 4px 0 #e5e5e5 !important;
    text-align: center !important;
    display: block !important;
    width: 100% !important;
    transition: all 0.1s !important;
    text-decoration: none !important;
    margin-bottom: 12px !important;
}
.art-btn-cart-outline:hover {
    background: #f7f7f7 !important;
    color: var(--color-spark-blue) !important;
}
.art-btn-cart-outline:active {
    box-shadow: 0 0 0 #e5e5e5 !important;
    transform: translateY(4px) !important;
}
</style>

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
                        <a class="art-dropdown-item {{ (isset($category->id) && $category->id == $cat->id) ? 'active' : '' }}" href="{{ route('product-lists', $cat->slug) }}" style="display:flex; align-items:center; gap:8px;">
                            @if($cimg)
                                <img src="{{ url($cimg) }}" alt="{{ $cat->title }}" style="width:24px; height:24px; object-fit:cover; border-radius:6px;">
                            @else
                                <div style="width:24px; height:24px; display:flex; align-items:center; justify-content:center; background:#f7f7f7; border-radius:6px; color:#1cb0f6;"><i class="fas fa-image" style="font-size:12px;"></i></div>
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
                <div class="art-dropdown-menu" style="min-width: 150px;">
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
                <div class="art-dropdown-menu" style="min-width: 150px; max-height: 250px; overflow-y: auto;">
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
                    <div class="art-dropdown-menu" style="min-width: 180px; left: auto; right: 0; transform: translateX(0) translateY(10px);">
                        <a class="art-dropdown-item" href="{{ route('user') }}"><i class="fas fa-id-card"></i> {{ __('inkwave.nav_account') }}</a>
                        <a class="art-dropdown-item text-danger" href="{{ route('user.logout') }}" style="color: #ff4b4b !important;"><i class="fas fa-sign-out-alt"></i> {{ __('inkwave.nav_logout') }}</a>
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
            <button class="mobile-nav-toggler d-lg-none border-0 bg-transparent fs-3 ms-2" style="color: var(--color-charcoal);">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Sidebar Drawer --}}
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box" style="background: var(--color-paper-white);">
            <div class="upper-box d-flex justify-content-between align-items-center p-4 border-bottom">
                <div class="nav-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="height: 40px;">
                    </a>
                </div>
                <button class="close-btn fs-4 border-0 bg-transparent p-0" style="color: var(--color-pencil-gray);"><i class="icon fa fa-times"></i></button>
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
        <div class="cartcanvas__close fs-4" style="cursor: pointer;"><i class="fas fa-times"></i></div>
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
                                    <i class="fas fa-coins" style="color: #ffd700; font-size: 1.5rem;"></i>
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
                            <div class="item-img" style="width: 70px; height: 70px; flex-shrink: 0; border-radius: 8px; overflow: hidden; border: 2px solid #e5e5e5;">
                                <img src="{{ asset($item_photo) }}" class="w-100 h-100 object-fit-cover" alt="">
                            </div>
                            <div class="item-details flex-grow-1 min-width-0">
                                <h6 class="mb-1 fw-bold">{{ $item_title }}</h6>
                                <div class="mb-1">
                                    <span class="badge px-2 py-1" style="background: #e5e5e5; color: var(--color-charcoal); border-radius: 6px; font-size: 10px;">
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
                    <div class="mb-3" style="color: #e5e5e5;"><i class="fas fa-shopping-basket fa-4x"></i></div>
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


