{{-- ==========================================================================
     Site Header
     Flat sticky navigation bar (see design/DESIGN.md — "Top navigation").
     Styles: public/css/app.css — section 6
     JS hooks kept: .mobile-nav-toggler, .mobile-menu, .menu-backdrop, .close-btn,
     .ui-btn.bb-cart-toggle, .offcanvas__overlay, .cartcanvas__info, .cartcanvas__close
     ========================================================================== --}}
@php
    $headerCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $currentCurrency  = session('currency', 'USD');
    $currencies       = Helper::CurrenciesList();
    $isJa             = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
    $hdCompany        = $misc['Company Name'] ?? __('frontend.company.name');
    $hdEmail          = $misc['Company Email'] ?? __('frontend.company.email');
    $hdCartQty        = Helper::totalCartQuantity();
@endphp


{{-- Utility strip: contact, language, currency --}}
<div class="hd-top">
    <div class="hd-top__inner">
        <a href="mailto:{{ $hdEmail }}" class="hd-top__mail">
            <i class="fas fa-envelope" aria-hidden="true"></i>
            <span>{{ $hdEmail }}</span>
        </a>

        <div class="hd-top__right">
            {{-- Language --}}
            <div class="hd-dd">
                <button type="button" class="hd-top__trigger" aria-haspopup="true">
                    <i class="fi {{ $isJa ? 'fi-jp' : 'fi-gb' }}" aria-hidden="true"></i>
                    <span>{{ $isJa ? '日本語' : 'English' }}</span>
                    <i class="fas fa-chevron-down hd-dd__chev" aria-hidden="true"></i>
                </button>
                <div class="hd-dd__panel hd-dd__panel--end">
                    <div class="hd-menu">
                        <a class="hd-menu__item {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}" @if(!$isJa) aria-current="true" @endif>
                            <i class="fi fi-gb" aria-hidden="true"></i> English
                        </a>
                        <a class="hd-menu__item {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}" @if($isJa) aria-current="true" @endif>
                            <i class="fi fi-jp" aria-hidden="true"></i> 日本語
                        </a>
                    </div>
                </div>
            </div>

            <span class="hd-top__rule" aria-hidden="true"></span>

            {{-- Currency --}}
            <div class="hd-dd">
                <button type="button" class="hd-top__trigger" aria-haspopup="true">
                    <span class="hd-num">{{ Helper::getCurrencySymbol($currentCurrency) }} {{ $currentCurrency }}</span>
                    <i class="fas fa-chevron-down hd-dd__chev" aria-hidden="true"></i>
                </button>
                <div class="hd-dd__panel hd-dd__panel--end">
                    <div class="hd-menu">
                        @foreach($currencies as $cur)
                            <a class="hd-menu__item {{ $currentCurrency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currentCurrency == $cur->code) aria-current="true" @endif>
                                <span class="hd-menu__sym">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                                <span class="hd-num">{{ $cur->code }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<header class="hd">
    <div class="hd__inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="hd__logo">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $hdCompany }}">
        </a>

        {{-- Desktop navigation --}}
        <nav class="hd__nav" aria-label="{{ __('frontend.header.main_nav') }}">
            <a href="{{ route('home') }}" class="hd__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>
                {{ __('frontend.header.home') }}
            </a>

            <div class="hd-dd">
                <button type="button" class="hd__link hd__link--dd" aria-haspopup="true">
                    {{ __('frontend.header.categories') }}
                    <i class="fas fa-chevron-down hd-dd__chev" aria-hidden="true"></i>
                </button>
                <div class="hd-dd__panel hd-dd__panel--mega">
                    <div class="hd-mega">
                        <div class="hd-mega__list">
                            @forelse($headerCategories as $cat)
                                @php $cimg = $cat->photo ? explode(',', $cat->photo)[0] : null; @endphp
                                <a class="hd-mega__item {{ (isset($category->id) && $category->id == $cat->id) ? 'is-active' : '' }}" href="{{ route('product-lists', $cat->slug) }}">
                                    <span class="hd-mega__thumb">
                                        @if($cimg)
                                            <img src="{{ asset($cimg) }}" alt="" loading="lazy">
                                        @else
                                            <i class="fas fa-book-open" aria-hidden="true"></i>
                                        @endif
                                    </span>
                                    <span class="hd-mega__name">{{ $cat->title }}</span>
                                </a>
                            @empty
                                <p class="hd-mega__none">{{ __('frontend.header.no_categories') }}</p>
                            @endforelse
                        </div>

                        <a href="{{ route('product-lists') }}" class="hd-mega__promo">
                            <span class="hd-mega__promo-text">{{ __('frontend.header.promo_title') }}</span>
                            <span class="hd-btn hd-btn--inverse">
                                {{ __('frontend.header.promo_btn') }}
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('product-lists') }}" class="hd__link {{ Route::is('product-lists') ? 'is-active' : '' }}" @if(Route::is('product-lists')) aria-current="page" @endif>
                {{ __('frontend.header.courses') }}
            </a>

            @if(Auth::check())
                <a href="{{ route('user') }}" class="hd__link {{ Route::is('user') ? 'is-active' : '' }}" @if(Route::is('user')) aria-current="page" @endif>
                    {{ __('frontend.header.my_courses') }}
                </a>
            @endif

            <a href="{{ route('contact') }}" class="hd__link {{ Route::is('contact') ? 'is-active' : '' }}" @if(Route::is('contact')) aria-current="page" @endif>
                {{ __('frontend.header.contact') }}
            </a>
        </nav>

        {{-- Actions --}}
        <div class="hd__actions">

            @if(Auth::check())
                {{-- Credit balance --}}
                <a href="{{ route('points.topup') }}" class="hd-credits hd--desktop" aria-label="{{ number_format(Auth::user()->points_balance ?? 0) }} {{ __('frontend.header.credits') }}. {{ __('frontend.header.balance') }}">
                    <i class="fas fa-coins" aria-hidden="true"></i>
                    <span class="hd-num">{{ number_format(Auth::user()->points_balance ?? 0) }}</span>
                </a>

                {{-- Account menu --}}
                <div class="hd-dd hd--desktop">
                    <button type="button" class="hd-user" aria-haspopup="true">
                        <span class="hd-avatar" aria-hidden="true">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                        <span class="hd-user__name">{{ explode(' ', Auth::user()->name)[0] }}</span>
                        <i class="fas fa-chevron-down hd-dd__chev" aria-hidden="true"></i>
                    </button>
                    <div class="hd-dd__panel hd-dd__panel--end">
                        <div class="hd-menu">
                            <a class="hd-menu__item" href="{{ route('user') }}"><i class="fas fa-user" aria-hidden="true"></i> {{ __('frontend.header.account') }}</a>
                            <a class="hd-menu__item" href="{{ route('user') }}"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ __('frontend.header.my_courses') }}</a>
                            <a class="hd-menu__item" href="{{ route('points.topup') }}"><i class="fas fa-coins" aria-hidden="true"></i> {{ __('frontend.header.buy_credits') }}</a>
                            <span class="hd-menu__rule" aria-hidden="true"></span>
                            <a class="hd-menu__item" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> {{ __('frontend.header.logout') }}</a>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login.form') }}" class="hd-btn hd-btn--ghost hd--desktop">{{ __('frontend.header.login') }}</a>
                <a href="{{ route('register.form') }}" class="hd-btn hd-btn--primary hd--desktop">{{ __('frontend.header.register') }}</a>
            @endif

            {{-- Cart toggle (JS: .ui-btn / .bb-cart-toggle) --}}
            <button type="button" class="hd-icon ui-btn bb-cart-toggle" aria-label="{{ __('frontend.header.cart_open') }}">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                @if($hdCartQty)
                    <span class="hd-icon__count hd-num">{{ $hdCartQty }}</span>
                @endif
            </button>

            {{-- Mobile menu toggle (JS: .mobile-nav-toggler) --}}
            <button type="button" class="hd-icon hd--mobile mobile-nav-toggler" aria-label="{{ __('frontend.header.menu') }}">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</header>


{{-- Mobile drawer (JS: .mobile-menu / .menu-backdrop / .close-btn) --}}
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <nav class="menu-box" aria-label="{{ __('frontend.header.mobile_nav') }}">

        <div class="hd-drawer__top">
            <a href="{{ route('home') }}" class="hd__logo">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $hdCompany }}">
            </a>
            <button type="button" class="hd-icon close-btn" aria-label="{{ __('frontend.header.close') }}">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>

        <div class="hd-drawer__body">
            @if(Auth::check())
                <div class="hd-drawer__user">
                    <span class="hd-avatar hd-avatar--lg" aria-hidden="true">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                    <div>
                        <p class="hd-drawer__user-name">{{ Auth::user()->name }}</p>
                        <a href="{{ route('points.topup') }}" class="hd-drawer__user-credits">
                            <i class="fas fa-coins" aria-hidden="true"></i>
                            <span class="hd-num">{{ number_format(Auth::user()->points_balance ?? 0) }}</span>
                            {{ __('frontend.header.credits') }}
                        </a>
                    </div>
                </div>
            @endif

            <div class="hd-drawer__nav">
                <a href="{{ route('home') }}" class="hd-drawer__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>
                    {{ __('frontend.header.home') }}
                </a>

                <details class="hd-acc">
                    <summary class="hd-drawer__link hd-drawer__link--acc">
                        {{ __('frontend.header.categories') }}
                        <i class="fas fa-chevron-down hd-acc__chev" aria-hidden="true"></i>
                    </summary>
                    <div class="hd-acc__body">
                        @forelse($headerCategories as $cat)
                            @php $cimg = $cat->photo ? explode(',', $cat->photo)[0] : null; @endphp
                            <a class="hd-mega__item" href="{{ route('product-lists', $cat->slug) }}">
                                <span class="hd-mega__thumb">
                                    @if($cimg)
                                        <img src="{{ asset($cimg) }}" alt="" loading="lazy">
                                    @else
                                        <i class="fas fa-book-open" aria-hidden="true"></i>
                                    @endif
                                </span>
                                <span class="hd-mega__name">{{ $cat->title }}</span>
                            </a>
                        @empty
                            <p class="hd-mega__none">{{ __('frontend.header.no_categories') }}</p>
                        @endforelse
                    </div>
                </details>

                <a href="{{ route('product-lists') }}" class="hd-drawer__link {{ Route::is('product-lists') ? 'is-active' : '' }}" @if(Route::is('product-lists')) aria-current="page" @endif>
                    {{ __('frontend.header.courses') }}
                </a>

                @if(Auth::check())
                    <a href="{{ route('user') }}" class="hd-drawer__link {{ Route::is('user') ? 'is-active' : '' }}" @if(Route::is('user')) aria-current="page" @endif>
                        {{ __('frontend.header.my_courses') }}
                    </a>
                @endif

                <a href="{{ route('contact') }}" class="hd-drawer__link {{ Route::is('contact') ? 'is-active' : '' }}" @if(Route::is('contact')) aria-current="page" @endif>
                    {{ __('frontend.header.contact') }}
                </a>
            </div>

            <div class="hd-drawer__prefs">
                <p class="hd-drawer__label">{{ __('frontend.header.language') }}</p>
                <div class="hd-chips">
                    <a class="hd-chip {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}"><i class="fi fi-gb" aria-hidden="true"></i> English</a>
                    <a class="hd-chip {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}"><i class="fi fi-jp" aria-hidden="true"></i> 日本語</a>
                </div>

                <p class="hd-drawer__label">{{ __('frontend.header.currency') }}</p>
                <div class="hd-chips">
                    @foreach($currencies as $cur)
                        <a class="hd-chip {{ $currentCurrency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                            {{ Helper::getCurrencySymbol($cur->code) }} <span class="hd-num">{{ $cur->code }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="hd-drawer__foot">
            @if(Auth::check())
                <a href="{{ route('user') }}" class="hd-btn hd-btn--primary hd-btn--block">{{ __('frontend.header.account') }}</a>
                <a href="{{ route('user.logout') }}" class="hd-btn hd-btn--secondary hd-btn--block">{{ __('frontend.header.logout') }}</a>
            @else
                <a href="{{ route('register.form') }}" class="hd-btn hd-btn--primary hd-btn--block">{{ __('frontend.header.register') }}</a>
                <a href="{{ route('login.form') }}" class="hd-btn hd-btn--secondary hd-btn--block">{{ __('frontend.header.login') }}</a>
            @endif
        </div>
    </nav>
</div>


{{-- Cart drawer (JS: .offcanvas__overlay / .cartcanvas__info / .cartcanvas__close) --}}
<div class="offcanvas__overlay"></div>
<aside class="cartcanvas__info" aria-label="{{ __('frontend.header.cart') }}">

    <div class="hd-cart__top">
        <h2 class="hd-cart__title">
            {{ __('frontend.header.cart') }}
            @if($hdCartQty)
                <span class="hd-cart__qty hd-num">{{ $hdCartQty }}</span>
            @endif
        </h2>
        <button type="button" class="hd-icon cartcanvas__close" aria-label="{{ __('frontend.header.cart_close') }}">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="hd-cart__scroll">
        @if(Helper::cartCount())
            <ul class="hd-cart__list">
                @foreach(Helper::getAllProductFromCart() as $cart)
                    @php
                        $isPoints = !$cart->product || $cart->product_id >= 1000;
                        $item_title = __('frontend.header.cart_credits');
                        $item_photo = null;
                        $item_level = null;

                        if($cart->product && $cart->product_id < 1000) {
                            $photo_arr = explode(',', $cart->product->photo);
                            $item_photo = $photo_arr[0];
                            $item_title = $cart->product->title;

                            $level = \App\Models\ProductLevel::where('course_id', $cart->product_id)
                                         ->where('price_in_points', $cart->points)
                                         ->first();
                            $lvl_key = $level ? 'frontend.header.levels.' . strtolower($level->skill_level) : null;
                            $item_level = $level ? (Lang::has($lvl_key) ? __($lvl_key) : ucfirst($level->skill_level)) : null;
                        }
                    @endphp

                    <li class="hd-cart__item">
                        @if($isPoints)
                            <span class="hd-cart__img hd-cart__img--credits"><i class="fas fa-coins" aria-hidden="true"></i></span>
                        @else
                            <span class="hd-cart__img"><img src="{{ asset($item_photo) }}" alt="" loading="lazy"></span>
                        @endif

                        <div class="hd-cart__info">
                            <p class="hd-cart__name">{{ $item_title }}</p>
                            @if($item_level)
                                <span class="hd-cart__level">{{ $item_level }}</span>
                            @endif
                            <p class="hd-cart__meta">
                                <span class="hd-num">{{ $cart->quantity }}</span> ×
                                <span class="hd-num">{{ number_format($cart->points) }}</span> {{ __('frontend.header.credits') }}
                            </p>
                            @if($isPoints)
                                <p class="hd-cart__price hd-num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            @endif
                        </div>

                        <a href="{{ route('cart-delete',$cart->id) }}" class="hd-cart__remove" aria-label="{{ __('frontend.header.cart_remove') }}">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="hd-cart__empty">
                <span class="hd-cart__empty-icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <p class="hd-cart__empty-text">{{ __('frontend.header.cart_empty') }}</p>
                <a href="{{ route('product-lists') }}" class="hd-btn hd-btn--primary">
                    {{ __('frontend.header.promo_btn') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        @endif
    </div>

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
        <div class="hd-cart__foot">
            <div class="hd-cart__total">
                <span class="hd-cart__total-label">{{ __('frontend.header.cart_total') }}</span>
                @if($hasPoints && !$hasProducts)
                    <span class="hd-cart__total-value hd-num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</span>
                @else
                    <span class="hd-cart__total-value">
                        <span class="hd-num">{{ number_format($totalPoints) }}</span>
                        <small>{{ __('frontend.header.credits') }}</small>
                    </span>
                @endif
            </div>

            @if($hasPoints && !$hasProducts)
                <a href="{{ route('checkout') }}" class="hd-btn hd-btn--primary hd-btn--block">{{ __('frontend.header.checkout') }}</a>
                <a href="{{ route('cart') }}" class="hd-btn hd-btn--secondary hd-btn--block">{{ __('frontend.header.view_cart') }}</a>
            @elseif($hasProducts && !$hasPoints)
                <a href="{{ route('coursecart') }}" class="hd-btn hd-btn--primary hd-btn--block">{{ __('frontend.header.view_cart') }}</a>
            @endif
        </div>
    @endif
</aside>


@cookieconsentview
