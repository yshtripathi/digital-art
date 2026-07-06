{{-- Main Header --}}
<header class="main-header navbar-sakura">
    <div class="container-fluid px-lg-5">
        <div class="header-inner d-flex align-items-center justify-content-between">
            {{-- Logo --}}
            <div class="logo-box">
                <a href="{{ route('home') }}">
                    <img src="{{ url('assets/images/logo.webp') }}" alt="Chromatique Art Logo" style="height: 48px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.05));">
                </a>
            </div>

            {{-- Main Navigation --}}
            <nav class="modern-nav-wrapper d-none d-lg-block">
                <ul class="modern-nav list-unstyled mb-0 d-flex align-items-center gap-2">
                    <li><a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">{{ __('common.home') }}</a></li>

                    <li class="dropdown">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle d-flex align-items-center gap-1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('common.catalog') }}
                        </a>
                        <ul class="dropdown-menu animated-dropdown">
                            @php
                                $categories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
                            @endphp
                            @forelse($categories as $cat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('product-lists', $cat->slug) }}">
                                        <i class="fas fa-palette"></i>
                                        {{ $cat->title }}
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item text-muted small"><i class="fas fa-info-circle"></i> {{ __('common.no_categories') }}</span></li>
                            @endforelse
                        </ul>
                    </li>

                    <li><a href="{{ route('about-us') }}" class="nav-link {{ Route::is('about-us') ? 'active' : '' }}">{{ __('common.about') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('common.contact') }}</a></li>
                </ul>
            </nav>

            {{-- Header Actions --}}
            <div class="header-actions d-flex align-items-center gap-3">

                {{-- Language Switcher --}}
                <div class="dropdown d-none d-md-block">
                    <a href="javascript:void(0)" class="btn-sakura-outline dropdown-toggle px-3" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(session('app_locale') == 'ja' || app()->getLocale() == 'ja')
                            <span>JP</span>
                        @else
                            <span>EN</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end animated-dropdown">
                        <li><a class="dropdown-item {{ (session('app_locale') != 'ja' && app()->getLocale() != 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'en') }}"><i class="fi fi-gb"></i> {{ __('common.english') }}</a></li>
                        <li><a class="dropdown-item {{ (session('app_locale') == 'ja' || app()->getLocale() == 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'ja') }}"><i class="fi fi-jp"></i> {{ __('common.japanese') }}</a></li>
                    </ul>
                </div>

                {{-- Currency Switcher --}}
                <div class="dropdown d-none d-lg-block">
                    @php
                        $currentCurrency = session('currency', 'USD');
                        $currencies = Helper::CurrenciesList();
                    @endphp
                    <a href="javascript:void(0)" class="btn-sakura-outline dropdown-toggle px-3" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-bold">{{ Helper::getCurrencySymbol($currentCurrency) }}</span>
                        <span>{{ $currentCurrency }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end animated-dropdown">
                        @foreach($currencies as $cur)
                            @if($cur->code != 'HKD')
                                <li>
                                    <a class="dropdown-item {{ $currentCurrency == $cur->code ? 'active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                                        <i class="fas fa-money-bill-wave"></i>
                                        {{ $cur->code }} ({{ Helper::getCurrencySymbol($cur->code) }})
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                @if(Auth::check())
                    {{-- Points --}}
                    <a href="{{ route('points.topup') }}" class="points-badge d-none d-sm-flex">
                        <i class="fas fa-coins"></i>
                        <span>{{ Auth::user()->points_balance ?? 0 }} CREDS</span>
                    </a>

                    {{-- User --}}
                    <div class="dropdown">
                        <a href="javascript:void(0)" class="btn-sakura dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                            <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end animated-dropdown">
                            <li><a class="dropdown-item" href="{{ route('user') }}">{{ __('common.account') }}</a></li>
                            <li><hr class="dropdown-divider opacity-50"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('user.logout') }}">{{ __('common.logout') }}</a></li>
                        </ul>
                    </div>
                @else
                    <div class="auth-btns d-flex gap-2">
                        <a href="{{ route('login.form') }}" class="btn-sakura-outline d-none d-sm-flex">{{ __('common.login') }}</a>
                        <a href="{{ route('register.form') }}" class="btn-sakura">{{ __('common.register') }}</a>
                    </div>
                @endif

                {{-- Cart Toggle --}}
                <div class="cart-toggle-wrapper position-relative">
                    <a href="javascript:void(0)" class="btn-sakura-outline p-0 border-0 fs-4 bb-cart-toggle ui-btn" style="background: transparent;">
                        <i class="lnr-icon-cart1"></i>
                        <span class="cart-count">{{ Helper::totalCartQuantity() }}</span>
                    </a>
                </div>

                {{-- Mobile Toggle --}}
                <div class="mobile-nav-toggler d-lg-none fs-3 text-primary" style="cursor: pointer;">
                    <span class="icon lnr-icon-bars"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Structure --}}
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box glass-card" style="border-radius: 0 0 28px 28px;">
            <div class="upper-box d-flex justify-content-between p-4">
                <div class="nav-logo"><a href="{{ route('home') }}"><img src="{{ url('assets/images/logo.webp') }}" alt="" style="height: 36px;"></a></div>
                <div class="close-btn fs-4"><i class="icon fa fa-times"></i></div>
            </div>
            <ul class="navigation list-unstyled p-4">
                {{-- JS Populated --}}
            </ul>
        </nav>
    </div>
</header>

{{-- Cart Sidebar --}}
<div class="offcanvas__overlay"></div>
<div class="cartcanvas__info glass-card" style="border-radius: 28px 0 0 28px;">
    <div class="cart-header d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <h4 class="fw-bold mb-0">{{ __('common.shopping_cart') }}</h4>
        <div class="cartcanvas__close fs-4" style="cursor: pointer;"><i class="fas fa-times"></i></div>
    </div>

    <div class="cart-content-wrapper h-100 d-flex flex-column">
        <ul class="cart-list list-unstyled flex-grow-1 overflow-auto pe-2">
            @if(Helper::cartCount())
                @foreach(Helper::getAllProductFromCart() as $cart)
                    @php
                        $isPoints = !$cart->product || $cart->product_id >= 1000;
                        $item_title = __('common.points_top_up');
                        $item_photo = null;
                        $item_level = 'N/A';

                        if($cart->product && $cart->product_id < 1000) {
                            $photo_arr = explode(',', $cart->product->photo);
                            $item_photo = $photo_arr[0];
                            $item_title = $cart->product->title;

                            // Look up level by matching course_id and price_in_points
                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                         ->where('price_in_points', $cart->points)
                                         ->first();
                            $lvl_key = $level ? $level->skill_level . '_course' : '';
                            $item_level = ($level && Lang::has('common.' . $lvl_key)) ? __('common.' . $lvl_key) : ($level ? ucfirst($level->skill_level) : 'N/A');
                        }
                    @endphp
                    @if($isPoints)
                        {{-- Points Item (No Image) --}}
                        <li class="cart-item cart-item-points d-flex align-items-center justify-content-between mb-4 p-4 rounded-4 bg-white shadow-sm border border-light position-relative">
                            <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item position-absolute top-0 end-0 m-2 text-danger opacity-50">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            <div class="item-details flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-coins" style="color: var(--accent-primary); font-size: 1.2rem; flex-shrink: 0;"></i>
                                    <h6 class="mb-0 fw-bold" style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">{{ $item_title }}</h6>
                                </div>
                                <p class="mb-0 small text-muted">
                                    {{ $cart->quantity }} x <span class="fw-bold" style="color: var(--accent-primary);">{{ number_format($cart->points) }} {{ __('common.credits') }}</span>
                                </p>
                            </div>
                            <div class="text-end ms-3">
                                <p class="mb-0 small text-muted">{{ __('common.total') }}:</p>
                                <p class="mb-0 fw-bold" style="color: var(--accent-primary); font-size: 1.1rem;">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            </div>
                        </li>
                    @else
                        {{-- Product Item (With Image) --}}
                        <li class="cart-item d-flex align-items-center gap-3 mb-4 p-3 rounded-4 bg-white shadow-sm border border-light position-relative">
                            <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item position-absolute top-0 end-0 m-2 text-danger opacity-50">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            <div class="item-img" style="width: 70px; height: 70px; flex-shrink: 0;">
                                <img src="{{ asset($item_photo) }}" class="w-100 h-100 object-fit-cover rounded-3" alt="">
                            </div>
                            <div class="item-details flex-grow-1 min-width-0">
                                <h6 class="mb-1 fw-bold" style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">{{ $item_title }}</h6>
                                <div class="mb-1">
                                    <span class="badge rounded-2 px-2 py-1" style="background: rgba(232, 93, 142, 0.1); color: #E85D8E; font-size: 10px; font-weight: 600;">
                                        <i class="fas fa-palette me-1"></i> {{ $item_level }}
                                    </span>
                                </div>
                                <p class="mb-0 small text-muted">
                                    {{ $cart->quantity }} x <span class="fw-bold" style="color: var(--accent-primary);">{{ number_format($cart->points) }} {{ __('common.credits') }}</span>
                                </p>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                <li class="text-center py-5">
                    <div class="opacity-25 mb-3"><i class="fas fa-shopping-basket fa-4x"></i></div>
                    <p class="text-muted fw-bold">{{ __('common.no_cart_available') }}</p>
                    <a href="{{ route('product-lists') }}" class="btn-sakura-outline small">{{ __('common.catalog') }}</a>
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
            <div class="cart-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">{{ __('common.total') }}:</h5>
                    @if($hasPoints && !$hasProducts)
                        <h4 class="fw-bold mb-0">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</h4>
                    @else
                        <h4 class="fw-bold mb-0">{{ number_format($totalPoints) }} {{ __('common.credits') }}</h4>
                    @endif
                </div>
                <div class="d-grid gap-2">
                    @if($hasPoints && !$hasProducts)
                        {{-- Points Only: Show View Cart and Checkout --}}
                        <a href="{{ route('cart') }}" class="btn-sakura-outline w-100 justify-content-center">
                            <i class="fas fa-shopping-cart me-1"></i>{{ __('common.view_cart') }}
                        </a>
                        <a href="{{ route('checkout') }}" class="btn-sakura w-100 justify-content-center">
                            <i class="fas fa-arrow-right me-1"></i>{{ __('common.checkout') }}
                        </a>
                    @elseif($hasProducts && !$hasPoints)
                        {{-- Products Only: Show only View Cart (redeem with purchased points) --}}
                        <a href="{{ route('coursecart') }}" class="btn-sakura w-100 justify-content-center">
                            <i class="fas fa-shopping-cart me-1"></i>{{ __('common.view_cart') }}
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

@cookieconsentview

{{-- Notification Alerts --}}
@foreach (['success', 'error', 'loginerror'] as $msg)
    @if (session($msg))
        <div class="alert-wrapper">
            <div class="alert alert-dismissible fade show modern-alert modern-alert-{{ $msg == 'success' ? 'success' : 'danger' }}" role="alert">
                <i class="fas fa-{{ $msg == 'success' ? 'check-circle' : 'exclamation-circle' }}"></i>
                <div class="flex-grow-1">{{ session($msg) }}</div>
            </div>
        </div>
    @endif
@endforeach
