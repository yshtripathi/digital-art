{{-- Main Header --}}
<header class="main-header custom-nav-bar">
    <div class="custom-nav-container">
        {{-- Logo --}}
        <div class="custom-logo-box">
            <a href="{{ route('home') }}" class="custom-logo-link">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="Inkwave Logo" class="custom-logo-img">
                
            </a>
        </div>

        {{-- Main Navigation (Desktop) --}}
        <nav class="main-menu custom-nav-menu d-none d-lg-block">
            <ul class="navigation custom-nav-links list-unstyled mb-0 d-flex align-items-center">
                <li><a href="{{ route('home') }}" class="custom-nav-link {{ Route::is('home') ? 'active' : '' }}">{{ __('inkwave.header_home') }}</a></li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="custom-nav-link" aria-expanded="false">
                        <span>{{ __('inkwave.header_catalog') }}</span><i class="fas fa-chevron-down ms-1 custom-chevron"></i>
                    </a>
                    <ul class="dropdown-menu custom-dropdown-panel shadow-sm">
                        @php
                            $categories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
                        @endphp
                        @forelse($categories as $cat)
                            @php
                                $icon = 'fa-paint-brush';
                                $slug = strtolower($cat->slug);
                                if (str_contains($slug, 'anime') || str_contains($slug, 'manga')) {
                                    $icon = 'fa-dragon';
                                } elseif (str_contains($slug, 'pixel') || str_contains($slug, 'game')) {
                                    $icon = 'fa-gamepad';
                                } elseif (str_contains($slug, 'pop') || str_contains($slug, 'comic')) {
                                    $icon = 'fa-bolt';
                                } elseif (str_contains($slug, 'street') || str_contains($slug, 'graffiti') || str_contains($slug, 'urban')) {
                                    $icon = 'fa-spray-can';
                                } elseif (str_contains($slug, 'ukiyo') || str_contains($slug, 'japanese') || str_contains($slug, 'woodblock')) {
                                    $icon = 'fa-mountain';
                                }
                            @endphp
                            <li>
                                <a class="dropdown-item {{ (isset($category->id) && $category->id == $cat->id) ? 'active' : '' }}" href="{{ route('product-lists', $cat->slug) }}">
                                    <i class="fas {{ $icon }} me-2"></i> {{ $cat->title }}
                                </a>
                            </li>
                        @empty
                            <li>
                                <span class="dropdown-item custom-dropdown-item text-muted text-center py-2">
                                    {{ __('inkwave.header_no_categories') }}
                                </span>
                            </li>
                        @endforelse
                    </ul>
                </li>

                <li><a href="{{ route('about-us') }}" class="custom-nav-link {{ Route::is('about-us') ? 'active' : '' }}">{{ __('inkwave.header_about') }}</a></li>
                <li><a href="{{ route('contact') }}" class="custom-nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('inkwave.header_contact') }}</a></li>
            </ul>
        </nav>

        {{-- Header Actions (Right side) --}}
        <div class="custom-nav-actions d-flex align-items-center">
            {{-- Language Switcher --}}
            <div class="dropdown">
                <a href="javascript:void(0)" class="custom-switcher-btn" aria-expanded="false">
                    @if(session('app_locale') == 'ja' || app()->getLocale() == 'ja')
                        <span>JP</span>
                    @else
                        <span>EN</span>
                    @endif
                    <i class="fas fa-chevron-down custom-chevron"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end custom-dropdown-panel shadow-sm">
                    <li>
                        <a class="dropdown-item {{ (session('app_locale') != 'ja' && app()->getLocale() != 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'en') }}">
                            <i class="fi fi-gb me-2"></i> {{ __('inkwave.header_english') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ (session('app_locale') == 'ja' || app()->getLocale() == 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'ja') }}">
                            <i class="fi fi-jp me-2"></i> {{ __('inkwave.header_japanese') }}
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Currency Switcher --}}
            <div class="dropdown ms-2">
                @php
                    $currentCurrency = session('currency', 'USD');
                    $currencies = Helper::CurrenciesList();
                @endphp
                <a href="javascript:void(0)" class="custom-switcher-btn" aria-expanded="false">
                    <span class="fw-bold">{{ Helper::getCurrencySymbol($currentCurrency) }}</span>
                    <span>{{ $currentCurrency }}</span>
                    <i class="fas fa-chevron-down custom-chevron"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end custom-dropdown-panel shadow-sm" style="max-height: 250px; overflow-y: auto;">
                    @foreach($currencies as $cur)
                        <li>
                            <a class="dropdown-item {{ $currentCurrency == $cur->code ? 'active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                                <i class="fas fa-money-bill-wave me-2"></i> {{ $cur->code }} ({{ Helper::getCurrencySymbol($cur->code) }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            @if(Auth::check())
                {{-- Points balance --}}
                <a href="{{ route('points.topup') }}" class="custom-points-badge d-none d-sm-flex align-items-center ms-3">
                    <i class="fas fa-coins me-1"></i>
                    <span>{{ Auth::user()->points_balance ?? 0 }} CREDS</span>
                </a>

                {{-- User Profile dropdown --}}
                <div class="dropdown ms-3">
                    <a href="javascript:void(0)" class="custom-user-badge" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i>
                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down ms-1 custom-chevron"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end custom-dropdown-panel shadow-sm">
                        <li>
                            <a class="dropdown-item" href="{{ route('user') }}">
                                <i class="fas fa-id-card me-2"></i> {{ __('inkwave.header_account') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider opacity-50 my-1"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">
                                <i class="fas fa-sign-out-alt me-2"></i> {{ __('inkwave.header_logout') }}
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Guest Login & Register --}}
                <div class="custom-auth-buttons d-flex align-items-center ms-3">
                    <a href="{{ route('login.form') }}" class="custom-nav-link d-none d-sm-inline-block">{{ __('inkwave.header_login') }}</a>
                    <a href="{{ route('register.form') }}" class="custom-auth-btn ms-3">{{ __('inkwave.header_register') }}</a>
                </div>
            @endif

            {{-- Cart Toggle --}}
            <div class="custom-cart-wrapper ms-3">
                <button class="custom-cart-toggle bb-cart-toggle ui-btn" aria-label="Toggle Cart">
                    <i class="fas fa-shopping-bag"></i>
                    <span class="custom-cart-count">{{ Helper::totalCartQuantity() }}</span>
                </button>
            </div>

            {{-- Mobile Toggler --}}
            <button class="mobile-nav-toggler d-lg-none custom-mobile-toggle ms-3" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Sidebar Drawer --}}
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box">
            <div class="upper-box d-flex justify-content-between align-items-center p-4">
                <div class="nav-logo">
                    <a href="{{ route('home') }}" class="custom-logo-link">
                        <img src="{{ asset('assets/images/logo.webp') }}" alt="Inkwave Logo" class="custom-logo-img">
                        <span class="custom-logo-text">Inkwave</span>
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('.custom-nav-bar');
        if (header) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 40) {
                    header.classList.add('floating');
                } else {
                    header.classList.remove('floating');
                }
            });
            // Initial check
            if (window.scrollY > 40) {
                header.classList.add('floating');
            }
        }
    });
</script>


{{-- Cart Sidebar --}}
<div class="offcanvas__overlay"></div>
<div class="cartcanvas__info">
    <div class="cart-header d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <h4 class="fw-bold mb-0">{{ __('inkwave.header_shopping_cart') }}</h4>
        <div class="cartcanvas__close fs-4" style="cursor: pointer;"><i class="fas fa-times"></i></div>
    </div>

    <div class="cart-content-wrapper h-100 d-flex flex-column">
        <ul class="cart-list list-unstyled flex-grow-1 overflow-auto pe-2">
            @if(Helper::cartCount())
                @foreach(Helper::getAllProductFromCart() as $cart)
                    @php
                        $isPoints = !$cart->product || $cart->product_id >= 1000;
                        $item_title = __('inkwave.header_points_top_up');
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
                            $item_level = ($level && Lang::has('inkwave.' . $lvl_key)) ? __('inkwave.' . $lvl_key) : ($level ? ucfirst($level->skill_level) : 'N/A');
                        }
                    @endphp
                    @if($isPoints)
                        {{-- Points Item (No Image) --}}
                        <li class="cart-item cart-item-points d-flex align-items-center justify-content-between position-relative">
                            <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item position-absolute top-0 end-0 m-2 text-danger opacity-50">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            <div class="item-details flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-coins" style="color: var(--color-ink); font-size: 1.2rem; flex-shrink: 0;"></i>
                                    <h6 class="mb-0 fw-bold" style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">{{ $item_title }}</h6>
                                </div>
                                <p class="mb-0 small text-muted">
                                    {{ $cart->quantity }} x <span class="fw-bold" style="color: var(--color-ink);">{{ number_format($cart->points) }} {{ __('inkwave.header_credits') }}</span>
                                </p>
                            </div>
                            <div class="text-end ms-3">
                                <p class="mb-0 small text-muted">{{ __('inkwave.header_total') }}:</p>
                                <p class="mb-0 fw-bold" style="color: var(--color-ink); font-size: 1.1rem;">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            </div>
                        </li>
                    @else
                        {{-- Product Item (With Image) --}}
                        <li class="cart-item d-flex align-items-center gap-3 position-relative">
                            <a href="{{ route('cart-delete',$cart->id) }}" class="remove-item position-absolute top-0 end-0 m-2 text-danger opacity-50">
                                <i class="fas fa-times-circle"></i>
                            </a>
                            <div class="item-img" style="width: 70px; height: 70px; flex-shrink: 0;">
                                <img src="{{ asset($item_photo) }}" class="w-100 h-100 object-fit-cover rounded-3" alt="">
                            </div>
                            <div class="item-details flex-grow-1 min-width-0">
                                <h6 class="mb-1 fw-bold" style="word-wrap: break-word; white-space: normal; overflow-wrap: break-word;">{{ $item_title }}</h6>
                                <div class="mb-1">
                                    <span class="badge rounded-2 px-2 py-1" style="background: var(--color-bone); color: var(--color-ink); border: 1px solid var(--color-vellum); font-size: 10px; font-weight: 600;">
                                        <i class="fas fa-palette me-1"></i> {{ $item_level }}
                                    </span>
                                </div>
                                <p class="mb-0 small text-muted">
                                    {{ $cart->quantity }} x <span class="fw-bold" style="color: var(--color-ink);">{{ number_format($cart->points) }} {{ __('inkwave.header_credits') }}</span>
                                </p>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                <li class="text-center py-5" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                    <div class="opacity-25 mb-3"><i class="fas fa-shopping-basket fa-4x"></i></div>
                    <p class="text-muted fw-bold">{{ __('inkwave.header_no_cart_available') }}</p>
                    <a href="{{ route('product-lists') }}" class="btn-sakura-outline" style="width: auto !important; display: inline-flex; padding: 7px 18px !important; font-size: 11px !important;">{{ __('inkwave.header_catalog') }}</a>
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
                <div class="cart-footer-top">
                    <h5 class="fw-bold mb-0">{{ __('inkwave.header_total') }}:</h5>
                    @if($hasPoints && !$hasProducts)
                        <h4 class="fw-bold mb-0">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</h4>
                    @else
                        <h4 class="fw-bold mb-0">{{ number_format($totalPoints) }} {{ __('inkwave.header_credits') }}</h4>
                    @endif
                </div>
                <div class="cart-footer-actions">
                    @if($hasPoints && !$hasProducts)
                        {{-- Points Only: Show View Cart and Checkout --}}
                        <a href="{{ route('cart') }}" class="btn-sakura-outline w-100 justify-content-center">
                            <i class="fas fa-shopping-cart me-1"></i>{{ __('inkwave.header_view_cart') }}
                        </a>
                        <a href="{{ route('checkout') }}" class="btn-sakura w-100 justify-content-center">
                            <i class="fas fa-arrow-right me-1"></i>{{ __('inkwave.header_checkout') }}
                        </a>
                    @elseif($hasProducts && !$hasPoints)
                        {{-- Products Only: Show only View Cart (redeem with purchased points) --}}
                        <a href="{{ route('coursecart') }}" class="btn-sakura w-100 justify-content-center">
                            <i class="fas fa-shopping-cart me-1"></i>{{ __('inkwave.header_view_cart') }}
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
