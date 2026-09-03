<header class="ag-header">
    <div class="ag-header-inner">
        
        <!-- Left Side: Logo -->
        <div class="ag-header-left">
            <a href="{{ route('home') }}" class="ag-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="[Website Name]" style="height: 40px; width: auto; object-fit: contain;">
            </a>
        </div>

        <!-- Center: Main Navigation (Desktop) -->
        <div class="ag-header-center ag-desktop-only">
            <nav class="ag-nav">
                <a href="{{ route('home') }}" class="ag-nav-link {{ Route::is('home') ? 'active' : '' }}">{{ __('inkwave.nav_home') }}</a>

                <div class="ag-nav-dropdown">
                    <a href="javascript:void(0)" class="ag-nav-link" style="display:flex; align-items:center; gap:4px;">
                        {{ __('inkwave.nav_categories') }}
                        <i class="fas fa-chevron-down" style="font-size:10px;"></i>
                    </a>
                    <div class="ag-dropdown-menu">
                        @php
                            $categories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
                        @endphp
                        @forelse($categories as $cat)
                            @php
                                $cimg = $cat->photo ? explode(',', $cat->photo)[0] : null;
                            @endphp
                            <a class="ag-dropdown-item {{ (isset($category->id) && $category->id == $cat->id) ? 'active' : '' }}" href="{{ route('product-lists', $cat->slug) }}">
                                @if($cimg)
                                    <img src="{{ asset($cimg) }}" alt="{{ $cat->title }}">
                                @endif
                                {{ $cat->title }}
                            </a>
                        @empty
                            <span class="ag-dropdown-item text-muted">{{ __('inkwave.nav_no_categories') }}</span>
                        @endforelse
                    </div>
                </div>

                <a href="{{ route('product-lists') }}" class="ag-nav-link {{ Route::is('product-lists') ? 'active' : '' }}">{{ __('inkwave.nav_courses') }}</a>

                @if(Auth::check())
                    <a href="{{ route('user') }}" class="ag-nav-link">{{ __('inkwave.nav_my_courses') }}</a>
                    <a href="{{ route('user') }}" class="ag-nav-link">{{ __('inkwave.nav_orders') }}</a>
                @endif

                <a href="{{ route('contact') }}" class="ag-nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('inkwave.nav_support') }}</a>
            </nav>
        </div>

        <!-- Right Side: Actions -->
        <div class="ag-header-right">
            
            <!-- Language Dropdown -->
            <div class="ag-nav-dropdown ag-desktop-only">
                <button class="ag-action-btn" style="display:flex; align-items:center; gap:6px;">
                    @if(session('app_locale') == 'ja' || app()->getLocale() == 'ja')
                        <i class="fi fi-jp"></i> JA
                    @else
                        <i class="fi fi-gb"></i> EN
                    @endif
                    <i class="fas fa-chevron-down" style="font-size:10px;"></i>
                </button>
                <div class="ag-dropdown-menu" style="min-width: 140px;">
                    <a class="ag-dropdown-item" href="{{ route('change.language', 'en') }}"><i class="fi fi-gb"></i> EN â€” English</a>
                    <a class="ag-dropdown-item" href="{{ route('change.language', 'ja') }}"><i class="fi fi-jp"></i> JA â€” æ—¥æœ¬èªž</a>
                </div>
            </div>

            <!-- Currency Dropdown -->
            <div class="ag-nav-dropdown ag-desktop-only">
                @php
                    $currentCurrency = session('currency', 'USD');
                    $currencies = Helper::CurrenciesList();
                @endphp
                <button class="ag-action-btn" style="display:flex; align-items:center; gap:4px;">
                    {{ $currentCurrency }}
                    <i class="fas fa-chevron-down" style="font-size:10px;"></i>
                </button>
                <div class="ag-dropdown-menu" style="min-width: 120px;">
                    @foreach($currencies as $cur)
                        <a class="ag-dropdown-item {{ $currentCurrency == $cur->code ? 'active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                            {{ $cur->code }} ({{ Helper::getCurrencySymbol($cur->code) }})
                        </a>
                    @endforeach
                </div>
            </div>

            @if(Auth::check())
                <!-- Points -->
                <a href="{{ route('points.topup') }}" class="ag-action-btn ag-desktop-only" style="display:flex; align-items:center; gap:6px;">
                    <i class="fas fa-coins" style="color:#bc9c5c;"></i> {{ Auth::user()->points_balance ?? 0 }}
                </a>

                <!-- User Profile -->
                <div class="ag-nav-dropdown">
                    <button class="ag-action-btn" style="display:flex; align-items:center; gap:4px;">
                        {{ explode(' ', Auth::user()->name)[0] }}
                        <i class="fas fa-chevron-down" style="font-size:10px;"></i>
                    </button>
                    <div class="ag-dropdown-menu" style="min-width: 180px;">
                        <a class="ag-dropdown-item" href="{{ route('user') }}">{{ __('inkwave.nav_account') }}</a>
                        <a class="ag-dropdown-item" href="{{ route('user.logout') }}">{{ __('inkwave.nav_logout') }}</a>
                    </div>
                </div>
            @else
                <!-- Guest Auth -->
                <div class="ag-auth-group">
                    <a href="{{ route('login.form') }}" class="ag-action-btn">{{ __('inkwave.nav_login') }}</a>
                    <a href="{{ route('register.form') }}" class="ag-action-btn" style="background:#000; color:#fff !important; padding:8px 16px; border-radius:6px;">{{ __('inkwave.nav_register') }}</a>
                </div>
            @endif

            <!-- Cart Toggle (JS Class preserved) -->
            <button class="ag-action-btn ui-btn bb-cart-toggle" aria-label="Toggle Cart" style="position:relative; display:flex; align-items:center; justify-content:center; width:44px; height:44px; font-size:18px; border: 1px solid rgba(0,0,0,0.1) !important; border-radius:50%; background:transparent; transition: all 0.3s ease;">
                <i class="fas fa-shopping-bag"></i> 
                <span class="ag-cart-count" style="position:absolute; top:-4px; right:-4px; background:#bc9c5c; color:#fff; border-radius:50%; width:18px; height:18px; display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:bold; margin:0;">{{ Helper::totalCartQuantity() }}</span>
            </button>

            <!-- Mobile Toggler (JS Class preserved) -->
            <button class="ag-action-btn mobile-nav-toggler ag-mobile-only" aria-label="Menu" style="font-size:18px;">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Sidebar Drawer (JS Classes preserved) -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box" style="border-left: 1px solid #000;">
            <div class="ag-flex ag-justify-between ag-align-center ag-p-4" style="border-bottom: 1px solid rgba(0,0,0,0.1);">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" style="height: 32px;">
                </a>
                <button class="close-btn ag-action-btn" style="font-size:20px;"><i class="fas fa-times"></i></button>
            </div>
            <ul class="navigation ag-list-unstyled ag-p-4" style="font-family: 'Bodoni Moda', serif;">
                <!-- JS Populated -->
            </ul>
        </nav>
    </div>
</header>


<!-- Cart Sidebar (JS Classes preserved) -->
<div class="offcanvas__overlay"></div>
<div class="cartcanvas__info">
    <div class="ag-cart-header ag-flex ag-justify-between ag-align-center">
        <h4 class="ag-fw-bold" style="margin:0;">{{ __('inkwave.nav_cart_heading') }}</h4>
        <div class="cartcanvas__close ag-action-btn" style="cursor:pointer; font-size:20px;"><i class="fas fa-times"></i></div>
    </div>

    <div class="ag-h-100 ag-flex ag-flex-col">
        <ul class="ag-cart-body ag-list-unstyled ag-flex-grow-1 ag-overflow-auto">
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

                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                         ->where('price_in_points', $cart->points)
                                         ->first();
                            $lvl_key = $level ? strtolower($level->skill_level) . '_course' : '';
                            $item_level = ($level && Lang::has('inkwave.' . $lvl_key)) ? __('inkwave.' . $lvl_key) : ($level ? ucfirst($level->skill_level) : 'N/A');
                        }
                    @endphp
                    @if($isPoints)
                        <!-- Points Item -->
                        <li class="ag-cart-item ag-position-relative">
                            <a href="{{ route('cart-delete',$cart->id) }}" class="ag-position-absolute ag-top-0 ag-end-0 text-dark" style="color:#000; text-decoration:none; margin-top:24px;">
                                <i class="fas fa-times"></i>
                            </a>
                            <h6 class="ag-mb-2"><i class="fas fa-coins" style="color:#bc9c5c;"></i> {{ $item_title }}</h6>
                            <p class="ag-mb-2" style="font-family: Arial, sans-serif; font-size: 12px; margin:0;">
                                {{ $cart->quantity }} x <strong class="ag-fw-bold">{{ number_format($cart->points) }} {{ __('inkwave.nav_credits_label') }}</strong>
                            </p>
                            <p style="font-family: Arial, sans-serif; font-weight: bold; font-size: 14px; margin:0; color:#bc9c5c;">
                                {{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}
                            </p>
                        </li>
                    @else
                        <!-- Product Item -->
                        <li class="ag-cart-item ag-flex ag-gap-3 ag-position-relative">
                            <a href="{{ route('cart-delete',$cart->id) }}" class="ag-position-absolute ag-top-0 ag-end-0 text-dark" style="color:#000; text-decoration:none; margin-top:24px;">
                                <i class="fas fa-times"></i>
                            </a>
                            <div class="ag-img-wrap" style="width: 80px; height: 80px; flex-shrink: 0; border-radius:4px; overflow:hidden;">
                                <img src="{{ asset($item_photo) }}" style="width:100%; height:100%; object-fit:cover;" alt="">
                            </div>
                            <div class="ag-flex-grow-1" style="min-width:0; padding-right:24px;">
                                <h6 style="margin:0 0 8px 0; line-height:1.4;">{{ $item_title }}</h6>
                                <div class="ag-mb-2">
                                    <span class="badge" style="padding:4px 8px; font-size:10px; background:transparent; border:1px solid #bc9c5c; color:#bc9c5c; border-radius:4px; font-weight:normal;">{{ $item_level }}</span>
                                </div>
                                <p style="font-family: Arial, sans-serif; font-size: 12px; margin:0; color:#666;">
                                    {{ $cart->quantity }} x <strong class="ag-fw-bold" style="color:#000;">{{ number_format($cart->points) }} {{ __('inkwave.nav_credits_label') }}</strong>
                                </p>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                <li class="ag-text-center ag-py-5 ag-flex ag-flex-col ag-align-center ag-h-100" style="justify-content:center;">
                    <div style="width:64px; height:64px; border-radius:50%; background:#f6f6f6; display:flex; align-items:center; justify-content:center; margin-bottom:16px;">
                        <i class="fas fa-shopping-bag" style="font-size:24px; color:#cccccc;"></i>
                    </div>
                    <p style="font-family: 'Bodoni Moda', serif; font-size: 18px; font-style: italic; color:#666;">{{ __('inkwave.nav_empty_cart_msg') }}</p>
                    <a href="{{ route('product-lists') }}" class="ag-action-btn ag-w-100" style="justify-content:center; border:1px solid #000; padding:12px; margin-top:24px; border-radius:6px;">
                        {{ __('inkwave.nav_courses') }}
                    </a>
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
            <div class="ag-cart-footer ag-mt-auto">
                <div class="ag-flex ag-justify-between ag-align-end ag-mb-4" style="font-family: Arial, sans-serif;">
                    <span class="ag-fw-bold" style="font-size:14px; text-transform:uppercase; letter-spacing:0.1em; color:#666;">{{ __('inkwave.nav_total_label') }}:</span>
                    @if($hasPoints && !$hasProducts)
                        <span class="ag-fw-bold" style="font-size:24px;">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</span>
                    @else
                        <span class="ag-fw-bold" style="font-size:24px;">{{ number_format($totalPoints) }} <span style="font-size:14px; color:#bc9c5c;">{{ __('inkwave.nav_credits_label') }}</span></span>
                    @endif
                </div>
                <div class="ag-flex ag-flex-col ag-gap-2">
                    @if($hasPoints && !$hasProducts)
                        <a href="{{ route('checkout') }}" class="ag-action-btn ag-w-100" style="justify-content:center; background:#000; color:#fff !important; padding:16px; border-radius:6px;">{{ __('inkwave.nav_checkout_btn') }}</a>
                        <a href="{{ route('cart') }}" class="ag-action-btn ag-w-100" style="justify-content:center; border:1px solid rgba(0,0,0,0.1); padding:16px; border-radius:6px;">{{ __('inkwave.nav_view_cart_btn') }}</a>
                    @elseif($hasProducts && !$hasPoints)
                        <a href="{{ route('coursecart') }}" class="ag-action-btn ag-w-100" style="justify-content:center; background:#000; color:#fff !important; padding:16px; border-radius:6px;">{{ __('inkwave.nav_view_cart_btn') }}</a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

@cookieconsentview

