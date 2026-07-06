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
                <li><a href="{{ route('home') }}" class="custom-nav-link {{ Route::is('home') ? 'active' : '' }}">{{ __('common.home') }}</a></li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="custom-nav-link" aria-expanded="false">
                        <span>{{ __('common.catalog') }}</span><i class="fas fa-chevron-down ms-1 custom-chevron"></i>
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
                                    {{ __('common.no_categories') }}
                                </span>
                            </li>
                        @endforelse
                    </ul>
                </li>

                <li><a href="{{ route('about-us') }}" class="custom-nav-link {{ Route::is('about-us') ? 'active' : '' }}">{{ __('common.about') }}</a></li>
                <li><a href="{{ route('contact') }}" class="custom-nav-link {{ Route::is('contact') ? 'active' : '' }}">{{ __('common.contact') }}</a></li>
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
                            <i class="fi fi-gb me-2"></i> {{ __('common.english') }}
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item {{ (session('app_locale') == 'ja' || app()->getLocale() == 'ja') ? 'active' : '' }}" href="{{ route('change.language', 'ja') }}">
                            <i class="fi fi-jp me-2"></i> {{ __('common.japanese') }}
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
                                <i class="fas fa-id-card me-2"></i> {{ __('common.account') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider opacity-50 my-1"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('user.logout') }}">
                                <i class="fas fa-sign-out-alt me-2"></i> {{ __('common.logout') }}
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                {{-- Guest Login & Register --}}
                <div class="custom-auth-buttons d-flex align-items-center ms-3">
                    <a href="{{ route('login.form') }}" class="custom-nav-link d-none d-sm-inline-block">{{ __('common.login') }}</a>
                    <a href="{{ route('register.form') }}" class="custom-auth-btn ms-3">{{ __('common.register') }}</a>
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

<style>
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden !important;
        width: 100% !important;
    }
    .page-wrapper {
        overflow-x: hidden !important;
        width: 100% !important;
        position: relative !important;
    }

    /* ==========================================================================
       Bootstrap utility shims — Bootstrap CSS is no longer loaded in this theme,
       so the layout utilities the header markup relies on are reimplemented here
       (scoped to the header) to restore alignment. No markup or JS changes.
       ========================================================================== */
    .custom-nav-bar .d-flex { display: flex !important; }
    .custom-nav-bar .d-block { display: block !important; }
    .custom-nav-bar .d-none { display: none !important; }
    .custom-nav-bar .align-items-center { align-items: center !important; }
    .custom-nav-bar .justify-content-between { justify-content: space-between !important; }
    .custom-nav-bar .justify-content-center { justify-content: center !important; }
    .custom-nav-bar .ms-1 { margin-left: 4px !important; }
    .custom-nav-bar .ms-2 { margin-left: 8px !important; }
    .custom-nav-bar .ms-3 { margin-left: 16px !important; }
    .custom-nav-bar .me-1 { margin-right: 4px !important; }
    .custom-nav-bar .me-2 { margin-right: 8px !important; }
    .custom-nav-bar .my-1 { margin-top: 4px !important; margin-bottom: 4px !important; }

    @media (min-width: 576px) {
        .custom-nav-bar .d-sm-flex { display: flex !important; }
        .custom-nav-bar .d-sm-inline { display: inline !important; }
        .custom-nav-bar .d-sm-inline-block { display: inline-block !important; }
    }
    @media (min-width: 768px) {
        .custom-nav-bar .d-md-block { display: block !important; }
    }
    @media (min-width: 992px) {
        .custom-nav-bar .d-lg-block { display: block !important; }
        .custom-nav-bar .d-lg-none { display: none !important; }
    }

    /* Right-side actions row — the key alignment fix */
    .custom-nav-actions {
        display: flex !important;
        align-items: center !important;
        flex-shrink: 0 !important;
    }

    /* Design system: flat surfaces only — neutralize any Bootstrap shadow utilities */
    .custom-nav-bar .shadow-sm,
    .custom-nav-bar .shadow { box-shadow: none !important; }

    /* Reset and custom styling for the redesigned premium header */
    .custom-nav-bar {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        z-index: 1030 !important;
        width: 100% !important;
        height: 72px !important;
        background-color: var(--color-putty, #c4c3b6) !important; /* solid putty — flat gallery wall, no blur */
        border-bottom: 1px solid var(--color-vellum) !important; /* Vellum hairline border */
        display: flex !important;
        align-items: center !important;
        box-shadow: none !important;
        padding: 0 20px !important;
        margin: 0 !important;
        transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }

    .custom-nav-bar.floating {
        background-color: var(--color-putty, #c4c3b6) !important;
        height: 56px !important;
        box-shadow: none !important;
        border-bottom: 1px solid var(--color-ink, #000000) !important; /* hairline darkens on scroll — flat, no shadow */
    }

    .custom-nav-container {
        width: 100% !important;
        max-width: 1200px !important;
        margin: 0 auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        height: 100% !important;
        flex-wrap: nowrap !important;
    }

    /* Logo Image and Wordmark */
    .custom-logo-link {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        text-decoration: none !important;
    }
    
    .custom-logo-link:hover {
        text-decoration: none !important;
    }

    .custom-logo-img {
        height: 32px !important;
        width: auto !important;
        object-fit: contain !important;
    }

    .custom-logo-text {
        font-family: var(--font-davinci) !important;
        font-size: 20px !important;
        font-weight: 500 !important;
        color: #000000 !important;
        letter-spacing: -0.5px !important;
    }

    /* Main Navigation Links (Desktop) */
    .custom-nav-links {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 0 !important;
        padding: 0 !important;
        list-style: none !important;
    }

    .custom-nav-link {
        font-family: var(--font-helvetica-now) !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: #000000 !important;
        padding: 8px 12px !important;
        text-decoration: none !important;
        opacity: 0.65 !important;
        transition: opacity 0.25s ease, color 0.25s ease !important;
        display: inline-flex !important;
        align-items: center;
    }

    .custom-nav-link:hover,
    .custom-nav-link.active,
    .custom-nav-menu .dropdown:hover > .custom-nav-link {
        opacity: 1 !important;
        text-decoration: none !important;
        background-color: transparent !important;
        color: #000000 !important;
    }

    /* Animated hairline underline — the gallery hover effect (flat, ink) */
    .custom-nav-link { position: relative !important; }
    .custom-nav-link::after {
        content: "" !important;
        position: absolute !important;
        left: 12px !important;
        right: 12px !important;
        bottom: 2px !important;
        height: 1px !important;
        background-color: var(--color-ink, #000000) !important;
        transform: scaleX(0) !important;
        transform-origin: left center !important;
        transition: transform 0.25s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }
    .custom-nav-link:hover::after,
    .custom-nav-link.active::after {
        transform: scaleX(1) !important;
    }

    .custom-chevron {
        font-size: 9px !important;
        opacity: 0.6 !important;
        transition: transform 0.2s ease !important;
    }

    /* Modern Dropdown Panels (Bone Surface + Hairline border + Shadow) */
    .custom-dropdown-panel {
        display: block !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateY(10px) scale(0.98) !important;
        transition: opacity 0.25s cubic-bezier(0.25, 1, 0.5, 1), transform 0.25s cubic-bezier(0.25, 1, 0.5, 1), visibility 0.25s ease !important;
        pointer-events: none !important; /* Prevent clicks when hidden */
        background-color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum) !important;
        border-radius: 9px !important;
        box-shadow: none !important;
        padding: 8px !important;
        margin-top: 8px !important;
        min-width: 260px !important;
        border-top: 1px solid var(--color-vellum) !important;
        position: absolute !important;
        z-index: 1050 !important;
    }

    .custom-dropdown-panel::after, .custom-dropdown-panel::before {
        display: none !important;
    }

    /* Show dropdown panel on hover (desktop) or when clicked (.show) */
    @media (min-width: 992px) {
        .custom-nav-bar .dropdown:hover .custom-dropdown-panel {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) scale(1) !important;
            pointer-events: auto !important;
        }
        .custom-nav-bar .dropdown:hover .custom-chevron {
            transform: rotate(180deg) !important;
        }
        .custom-nav-menu .dropdown:hover > .custom-nav-link::after {
            transform: scaleX(1) !important;
        }
        /* Hide script.js appended dropdown button on desktop */
        .custom-nav-bar .dropdown-btn {
            display: none !important;
        }
    }

    .dropdown.show .custom-dropdown-panel,
    .dropdown-menu.show {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) scale(1) !important;
        pointer-events: auto !important;
    }
    .dropdown.show .custom-chevron {
        transform: rotate(180deg) !important;
    }

    .custom-dropdown-item {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        padding: 8px 12px !important;
        border-radius: 6px !important;
        background: transparent !important;
        transition: background-color 0.2s ease !important;
        text-decoration: none !important;
    }

    .custom-dropdown-item:hover,
    .custom-dropdown-item.active {
        background-color: var(--color-bone) !important; /* Bone color hover */
        color: #000000 !important;
    }

    .custom-dropdown-icon {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 32px !important;
        height: 32px !important;
        background-color: var(--color-bone) !important; /* Bone */
        border: 1px solid var(--color-vellum) !important; /* Vellum */
        border-radius: 6px !important;
        color: #000000 !important;
        flex-shrink: 0 !important;
        font-size: 13px !important;
    }

    .custom-dropdown-info {
        display: flex !important;
        flex-direction: column !important;
    }

    .custom-dropdown-title {
        font-family: var(--font-helvetica-now) !important;
        font-size: 13.5px !important;
        font-weight: 500 !important;
        color: #000000 !important;
        line-height: 1.2 !important;
    }

    /* ==========================================================================
       Language / Currency Capsule Switcher Buttons
       ========================================================================== */
    .custom-switcher-btn {
        font-family: var(--font-helvetica-now) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        color: var(--color-ink) !important;
        background-color: var(--color-paper) !important;
        border: 1px solid var(--color-vellum) !important;
        padding: 0 12px !important;
        height: 32px !important;
        border-radius: 28.8px !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        transition: all 0.2s ease !important;
        box-sizing: border-box !important;
        cursor: pointer !important;
        white-space: nowrap !important;
    }

    .custom-switcher-btn:hover {
        background-color: var(--color-bone) !important;
        color: var(--color-ink) !important;
        text-decoration: none !important;
    }

    /* ==========================================================================
       Points & User Profile capsule buttons
       ========================================================================== */
    .custom-points-badge {
        background-color: var(--color-bone) !important;
        border: 1px solid var(--color-vellum) !important;
        color: var(--color-ink) !important;
        font-family: var(--font-helvetica-now) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        letter-spacing: 0.03em !important;
        border-radius: 28.8px !important;
        padding: 0 12px !important;
        height: 32px !important;
        display: inline-flex !important;
        align-items: center !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        box-sizing: border-box !important;
        white-space: nowrap !important;
    }
    .custom-points-badge:hover {
        background-color: var(--color-vellum) !important;
        text-decoration: none !important;
        color: var(--color-ink) !important;
    }

    .custom-user-badge {
        background-color: var(--color-paper) !important;
        border: 1px solid var(--color-vellum) !important;
        color: var(--color-ink) !important;
        font-family: var(--font-helvetica-now) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        border-radius: 28.8px !important;
        padding: 0 12px !important;
        height: 32px !important;
        display: inline-flex !important;
        align-items: center !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        box-sizing: border-box !important;
        cursor: pointer !important;
        white-space: nowrap !important;
    }
    .custom-user-badge:hover {
        background-color: var(--color-bone) !important;
        text-decoration: none !important;
        color: var(--color-ink) !important;
    }

    .custom-auth-btn {
        font-family: var(--font-helvetica-now) !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        background-color: var(--color-ink) !important;
        color: var(--color-paper) !important;
        padding: 8px 16px !important;
        border-radius: 28.8px !important;
        border: 1px solid var(--color-ink) !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 32px !important;
        transition: all 0.2s ease !important;
        box-sizing: border-box !important;
    }
    .custom-auth-btn:hover {
        background-color: transparent !important;
        color: var(--color-ink) !important;
        text-decoration: none !important;
    }

    /* ==========================================================================
       Shopping Cart Capsule Button
       ========================================================================== */
    .custom-cart-toggle {
        background-color: var(--color-paper, #ffffff) !important;
        color: var(--color-ink, #000000) !important;
        border: 1px solid var(--color-vellum) !important;
        border-radius: 50% !important;
        width: 32px !important;
        height: 32px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        box-sizing: border-box !important;
        position: relative !important;
    }
    .custom-cart-toggle:hover {
        background-color: var(--color-bone) !important;
        color: var(--color-ink) !important;
    }
    .custom-cart-toggle i {
        font-size: 13px !important;
    }
    .custom-cart-count {
        position: absolute !important;
        top: -6px !important;
        right: -6px !important;
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
        font-size: 9px !important;
        font-weight: 700 !important;
        border-radius: 50% !important;
        width: 16px !important;
        height: 16px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border: 1px solid var(--color-paper, #ffffff) !important;
        transition: all 0.2s ease !important;
    }
    .custom-cart-toggle:hover .custom-cart-count {
        background-color: var(--color-ink) !important;
        color: var(--color-paper) !important;
    }

    /* ==========================================================================
       Dropdown Panel & Item Styling
       ========================================================================== */
    .custom-nav-bar .dropdown {
        position: relative !important;
    }
    .custom-nav-bar .dropdown-menu-end {
        right: 0 !important;
        left: auto !important;
    }
    .custom-dropdown-panel {
        display: block !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateY(12px) scale(0.97) !important;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
        pointer-events: none !important;
        background-color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 9px !important; /* theme card radius */
        padding: 8px !important;
        margin-top: 10px !important;
        min-width: 200px !important;
        box-shadow: none !important; /* flat surfaces — no shadows */
        position: absolute !important;
        z-index: 1050 !important;
        list-style: none !important;
        list-style-type: none !important;
        padding-left: 0 !important;
    }
    .custom-dropdown-panel li {
        list-style: none !important;
        list-style-type: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .custom-dropdown-panel .dropdown-item {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13.5px !important;
        font-weight: 550 !important;
        color: var(--color-ink, #000000) !important;
        padding: 8px 12px !important;
        border-radius: 6px !important;
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        transition: all 0.2s ease !important;
        background-color: transparent !important;
        margin-bottom: 2px !important;
        white-space: nowrap !important;
    }
    .custom-dropdown-panel .dropdown-item:last-child {
        margin-bottom: 0 !important;
    }
    .custom-dropdown-panel .dropdown-item i {
        font-size: 13px !important;
        color: var(--color-ink, #000000) !important;
        transition: all 0.2s ease !important;
        flex-shrink: 0 !important;
    }
    .custom-dropdown-panel .dropdown-item:hover,
    .custom-dropdown-panel .dropdown-item.active {
        background-color: var(--color-bone, #e7e5e4) !important;
        color: var(--color-ink, #000000) !important;
        text-decoration: none !important;
        padding-left: 14px !important;
    }

    /* ==========================================================================
       Mobile Hamburger Toggle
       ========================================================================== */
    .custom-mobile-toggle {
        display: none !important;
        align-items: center !important;
        justify-content: center !important;
        background: transparent !important;
        border: none !important;
        color: #000000 !important;
        font-size: 22px !important;
        padding: 8px !important;
        cursor: pointer !important;
        transition: opacity 0.2s ease !important;
    }

    @media (max-width: 991px) {
        .custom-mobile-toggle {
            display: flex !important;
        }
    }

    .custom-mobile-toggle:hover {
        opacity: 0.7 !important;
    }

    /* Hide default bootstrap dropdown carets globally in the header */
    .custom-nav-bar .dropdown-toggle::after,
    .custom-nav-bar [data-toggle="dropdown"]::after,
    .custom-nav-bar [data-bs-toggle="dropdown"]::after {
        display: none !important;
        content: none !important;
    }

    /* ==========================================================================
       Mobile Sidebar Drawer Styling
       ========================================================================== */
    .mobile-menu {
        position: fixed !important;
        left: 0 !important;
        top: 0 !important;
        width: 320px !important;
        max-width: 100vw !important;
        height: 100vh !important;
        background-color: var(--color-bone) !important;
        border-right: 1px solid var(--color-vellum) !important;
        z-index: 999999 !important;
        transform: translateX(-100%) !important;
        transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1) !important;
        padding: 40px 24px !important;
    }

    .mobile-menu-visible .mobile-menu {
        transform: translateX(0) !important;
    }

    .mobile-menu .menu-backdrop {
        position: fixed !important;
        inset: 0 !important;
        background: rgba(0, 0, 0, 0.4) !important;
        z-index: -1 !important;
        opacity: 0 !important;
        transition: opacity 0.4s ease !important;
        pointer-events: none !important;
    }

    .mobile-menu-visible .mobile-menu .menu-backdrop {
        opacity: 1 !important;
        pointer-events: auto !important;
    }

    .mobile-menu .nav-logo {
        margin-bottom: 40px !important;
        text-align: center !important;
    }

    .mobile-menu .navigation li {
        border-bottom: 1px solid var(--color-vellum) !important;
    }

    .mobile-menu .navigation li a {
        display: block !important;
        padding: 14px 24px !important;
        font-family: var(--font-helvetica-now) !important;
        font-size: 15px !important;
        font-weight: 500 !important;
        color: #000000 !important;
        text-decoration: none !important;
        transition: background-color 0.2s ease !important;
    }

    .mobile-menu .navigation li a:hover {
        background-color: var(--color-putty) !important;
        text-decoration: none !important;
    }

    .mobile-menu .close-btn {
        cursor: pointer !important;
        font-size: 20px !important;
        color: #000000 !important;
        transition: opacity 0.2s ease !important;
    }

    .mobile-menu .close-btn:hover {
        opacity: 0.7 !important;
    }

    /* ==========================================================================
       Sidebar Cart Styling (Self-contained, Structured gallery styling)
       ========================================================================== */
    .cartcanvas__info {
        position: fixed !important;
        top: 0 !important;
        right: 0 !important;
        width: 380px !important;
        max-width: 100vw !important;
        height: 100vh !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        z-index: 1050 !important;
        transform: translateX(100%) !important;
        transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1) !important;
        display: flex !important;
        flex-direction: column !important;
        padding: 24px !important;
        border-left: 1px solid var(--color-vellum, #dfdcd5) !important;
        box-shadow: none !important;
        border-radius: 0 !important; /* Flat surface, no round corners */
        overflow-x: hidden !important;
    }

    .cartcanvas__info.info-open {
        transform: translateX(0) !important;
    }

    .offcanvas__overlay {
        position: fixed !important;
        inset: 0 !important;
        background-color: rgba(0, 0, 0, 0.4) !important;
        z-index: 1040 !important;
        opacity: 0 !important;
        pointer-events: none !important;
        transition: opacity 0.4s ease !important;
    }

    .offcanvas__overlay.overlay-open {
        opacity: 1 !important;
        pointer-events: auto !important;
    }

    .cart-header {
        border-bottom: 1px solid var(--color-vellum, #dfdcd5) !important;
        padding-bottom: 16px !important;
        margin-bottom: 24px !important;
    }

    .cart-header h4 {
        font-family: var(--font-davinci, serif) !important;
        font-size: 20px !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
    }

    .cartcanvas__close {
        cursor: pointer !important;
        font-size: 20px !important;
        color: var(--color-ink, #000000) !important;
        transition: opacity 0.2s ease !important;
        position: relative !important;
        z-index: 10 !important; /* keep close (cross) button in front of cart content */
    }

    .cartcanvas__close:hover {
        opacity: 0.6 !important;
    }

    .cart-list {
        flex-grow: 1 !important;
        overflow-y: auto !important;
        margin: 0 !important;
        padding: 0 !important;
        scrollbar-width: none !important; /* Firefox */
        -ms-overflow-style: none !important;  /* IE and Edge */
    }
    .cart-list::-webkit-scrollbar {
        display: none !important; /* Chrome, Safari, and Opera */
    }

    .cart-item {
        display: flex !important;
        align-items: center !important;
        gap: 16px !important;
        padding: 16px !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        background-color: var(--color-paper, #ffffff) !important;
        border-radius: 9px !important; /* theme card radius */
        margin-bottom: 16px !important;
        position: relative !important;
        box-shadow: none !important;
    }

    .cart-item-points {
        background-color: var(--color-paper, #ffffff) !important;
    }

    .cart-item .remove-item {
        position: absolute !important;
        top: 8px !important;
        right: 8px !important;
        color: var(--color-graphite, #595855) !important;
        font-size: 14px !important;
        transition: color 0.2s ease !important;
        opacity: 0.6 !important;
    }

    .cart-item .remove-item:hover {
        color: var(--color-ink, #000000) !important;
        opacity: 1 !important;
    }

    .cart-item .item-img {
        width: 64px !important;
        height: 64px !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        overflow: hidden !important;
        flex-shrink: 0 !important;
    }

    .cart-item .item-img img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    .cart-item .item-details {
        flex-grow: 1 !important;
        min-width: 0 !important;
    }

    .cart-item .item-details h6 {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        margin: 0 0 6px 0 !important;
    }

    .cart-item .item-details p {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 12px !important;
        color: var(--color-graphite, #595855) !important;
        margin: 0 !important;
    }

    .cart-item .item-details span {
        color: var(--color-ink, #000000) !important;
    }

    .cart-item .badge {
        background-color: var(--color-bone, #e7e5e4) !important;
        color: var(--color-ink, #000000) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 10px !important;
        font-weight: 500 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        border-radius: 2px !important;
        padding: 4px 8px !important;
    }

    .cart-footer {
        border-top: 1px solid var(--color-vellum, #dfdcd5) !important;
        padding-top: 20px !important;
        margin-top: auto !important;
        background-color: var(--color-bone, #e7e5e4) !important;
    }

    .cart-footer h5 {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        color: var(--color-graphite, #595855) !important;
        margin: 0 !important;
    }

    .cart-footer h4 {
        font-family: var(--font-davinci, serif) !important;
        font-size: 20px !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        margin: 0 !important;
    }

    /* Buttons inside Cart Drawer */
    .btn-sakura,
    .btn-sakura-outline {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        padding: 10px 16px !important;
        border-radius: 28.8px !important; /* theme pill radius for action buttons */
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
        cursor: pointer !important;
        border: 1px solid var(--color-ink, #000000) !important;
        width: 100% !important;
    }

    .btn-sakura {
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
    }

    .btn-sakura:hover {
        background-color: var(--color-graphite, #595855) !important;
        border-color: var(--color-graphite, #595855) !important;
        color: var(--color-paper, #ffffff) !important;
        text-decoration: none !important;
    }

    .btn-sakura-outline {
        background-color: transparent !important;
        color: var(--color-ink, #000000) !important;
    }

    .btn-sakura-outline:hover {
        background-color: rgba(0, 0, 0, 0.05) !important;
        color: var(--color-ink, #000000) !important;
        text-decoration: none !important;
    }
</style>

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
                                    {{ $cart->quantity }} x <span class="fw-bold" style="color: var(--color-ink);">{{ number_format($cart->points) }} {{ __('common.credits') }}</span>
                                </p>
                            </div>
                            <div class="text-end ms-3">
                                <p class="mb-0 small text-muted">{{ __('common.total') }}:</p>
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
                                    {{ $cart->quantity }} x <span class="fw-bold" style="color: var(--color-ink);">{{ number_format($cart->points) }} {{ __('common.credits') }}</span>
                                </p>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                <li class="text-center py-5">
                    <div class="opacity-25 mb-3"><i class="fas fa-shopping-basket fa-4x"></i></div>
                    <p class="text-muted fw-bold">{{ __('common.no_cart_available') }}</p>
                    <a href="{{ route('product-lists') }}" class="btn-sakura-outline" style="width: auto !important; display: inline-flex; padding: 7px 18px !important; font-size: 11px !important;">{{ __('common.catalog') }}</a>
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
