{{-- ==========================================================================
     Site Header — ACADEMY light theme
     Sticky 72px navigation with credit balance, cart pill and slide-over cart
     (see design/DESIGN.md — sections 2, 3 and 5).
     Styles: public/css/theme.css — section 11
     JS hooks kept: .mobile-nav-toggler, .mobile-menu, .menu-backdrop, .close-btn,
     .ui-btn.bb-cart-toggle, .offcanvas__overlay, .cartcanvas__info, .cartcanvas__close
     ========================================================================== --}}
@php
    $headerCategories = \App\Models\Category::with('child_cat')->where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $currentCurrency  = session('currency', 'USD');
    $currencies       = Helper::CurrenciesList();
    $isJa             = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
    $hdCompany        = $misc['Company Name'] ?? __('frontend.company.name');
    $hdEmail          = $misc['Company Email'] ?? __('frontend.company.email');
    $hdCartQty        = Helper::totalCartQuantity();
    $hdBalance        = Auth::check() ? (Auth::user()->points_balance ?? 0) : 0;
@endphp


{{-- Utility strip: contact, language, currency --}}
<div class="ak-topbar">
    <div class="ak-topbar__inner">
        <a href="mailto:{{ $hdEmail }}" class="ak-topbar__mail">
            <i class="fas fa-envelope" aria-hidden="true"></i>
            <span>{{ $hdEmail }}</span>
        </a>

        <div class="ak-topbar__right">
            {{-- Language --}}
            <div class="ak-dd">
                <button type="button" class="ak-topbar__trigger" aria-haspopup="true" aria-expanded="false">
                    <i class="fi {{ $isJa ? 'fi-jp' : 'fi-gb' }}" aria-hidden="true"></i>
                    <span>{{ $isJa ? '日本語' : 'English' }}</span>
                    <i class="fas fa-chevron-down ak-dd__chev" aria-hidden="true"></i>
                </button>
                <div class="ak-dd__panel ak-dd__panel--end">
                    <div class="ak-menu">
                        <a class="ak-menu__item {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}" @if(!$isJa) aria-current="true" @endif>
                            <i class="fi fi-gb" aria-hidden="true"></i> English
                        </a>
                        <a class="ak-menu__item {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}" @if($isJa) aria-current="true" @endif>
                            <i class="fi fi-jp" aria-hidden="true"></i> 日本語
                        </a>
                    </div>
                </div>
            </div>

            <span class="ak-topbar__rule" aria-hidden="true"></span>

            {{-- Currency --}}
            <div class="ak-dd">
                <button type="button" class="ak-topbar__trigger" aria-haspopup="true" aria-expanded="false">
                    <span class="ak-num">{{ Helper::getCurrencySymbol($currentCurrency) }} {{ $currentCurrency }}</span>
                    <i class="fas fa-chevron-down ak-dd__chev" aria-hidden="true"></i>
                </button>
                <div class="ak-dd__panel ak-dd__panel--end">
                    <div class="ak-menu">
                        @foreach($currencies as $cur)
                            <a class="ak-menu__item {{ $currentCurrency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currentCurrency == $cur->code) aria-current="true" @endif>
                                <span class="ak-menu__sym">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                                <span class="ak-num">{{ $cur->code }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<header class="ak-header">
    <div class="ak-header__inner">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="ak-logo">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $hdCompany }}">
            <span class="ak-logo__dot" aria-hidden="true"></span>
        </a>

        {{-- Desktop navigation --}}
        <nav class="ak-nav" aria-label="{{ __('frontend.header.main_nav') }}">
            <a href="{{ route('home') }}" class="ak-nav__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>
                {{ __('frontend.header.home') }}
            </a>

            <div class="ak-dd">
                <button type="button" class="ak-nav__link ak-nav__link--dd" aria-haspopup="true" aria-expanded="false">
                    {{ __('frontend.header.categories') }}
                    <i class="fas fa-chevron-down ak-dd__chev" aria-hidden="true"></i>
                </button>
                <div class="ak-dd__panel ak-dd__panel--mega">
                    <ul class="ak-cats">
                        @forelse($headerCategories as $cat)
                            <li class="ak-cat {{ (isset($category->id) && $category->id == $cat->id) ? 'is-active' : '' }}">
                                <a class="ak-cat__main" href="{{ route('product-lists', $cat->slug) }}">
                                    <span class="ak-cat__name">{{ $cat->title }}</span>
                                    <i class="fas fa-arrow-right ak-cat__go" aria-hidden="true"></i>
                                </a>
                                @if($cat->child_cat->count())
                                    <ul class="ak-cat__subs">
                                        @foreach($cat->child_cat as $sub)
                                            <li><a class="ak-cat__sub" href="{{ route('product-lists', $sub->slug) }}">{{ $sub->title }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @empty
                            <li><p class="ak-cats__none">{{ __('frontend.header.no_categories') }}</p></li>
                        @endforelse
                    </ul>

                    <div class="ak-cats__foot">
                        <span class="ak-cats__foot-text">{{ __('frontend.header.promo_title') }}</span>
                        <a href="{{ route('product-lists') }}" class="ak-btn ak-btn--primary ak-btn--sm">
                            {{ __('frontend.header.promo_btn') }}
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('product-lists') }}" class="ak-nav__link {{ Route::is('product-lists') ? 'is-active' : '' }}" @if(Route::is('product-lists')) aria-current="page" @endif>
                {{ __('frontend.header.courses') }}
            </a>

            <a href="{{ route('points.topup') }}" class="ak-nav__link {{ Route::is('points.topup') ? 'is-active' : '' }}" @if(Route::is('points.topup')) aria-current="page" @endif>
                {{ __('frontend.header.buy_credits') }}
            </a>

            <a href="{{ route('contact') }}" class="ak-nav__link {{ Route::is('contact') ? 'is-active' : '' }}" @if(Route::is('contact')) aria-current="page" @endif>
                {{ __('frontend.header.contact') }}
            </a>
        </nav>

        {{-- Actions --}}
        <div class="ak-header__actions">

            @if(Auth::check())
                {{-- Credit balance --}}
                <a href="{{ route('points.topup') }}" class="ak-credits ak--desktop" aria-label="{{ number_format($hdBalance) }} {{ __('frontend.header.credits') }}. {{ __('frontend.header.balance') }}">
                    <i class="fas fa-bolt" aria-hidden="true"></i>
                    <span class="ak-num">{{ number_format($hdBalance) }}</span>
                </a>
            @endif

            {{-- Cart toggle (JS: .ui-btn / .bb-cart-toggle) --}}
            <button type="button" class="ak-cart-btn ui-btn bb-cart-toggle" aria-label="{{ __('frontend.header.cart_open') }}">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                <span class="ak-cart-btn__label">{{ __('frontend.header.cart') }}</span>
                @if($hdCartQty)
                    <span class="ak-cart-btn__count ak-num">{{ $hdCartQty }}</span>
                @endif
            </button>

            @if(Auth::check())
                {{-- Account menu --}}
                <div class="ak-dd ak--desktop">
                    <button type="button" class="ak-user" aria-haspopup="true" aria-expanded="false">
                        <span class="ak-avatar" aria-hidden="true">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                        <span class="ak-user__name">{{ explode(' ', Auth::user()->name)[0] }}</span>
                        <i class="fas fa-chevron-down ak-dd__chev" aria-hidden="true"></i>
                    </button>
                    <div class="ak-dd__panel ak-dd__panel--end">
                        <div class="ak-menu">
                            <div class="ak-menu__head">
                                <p class="ak-menu__name">{{ Auth::user()->name }}</p>
                                <p class="ak-menu__balance">
                                    <i class="fas fa-bolt" aria-hidden="true"></i>
                                    <span class="ak-num">{{ number_format($hdBalance) }}</span> {{ __('frontend.header.credits') }}
                                </p>
                            </div>
                            <a class="ak-menu__item" href="{{ route('user') }}"><i class="fas fa-user" aria-hidden="true"></i> {{ __('frontend.header.account') }}</a>
                            <a class="ak-menu__item" href="{{ route('user') }}"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ __('frontend.header.my_courses') }}</a>
                            <a class="ak-menu__item" href="{{ route('points.topup') }}"><i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.header.buy_credits') }}</a>
                            <span class="ak-menu__rule" aria-hidden="true"></span>
                            <a class="ak-menu__item" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> {{ __('frontend.header.logout') }}</a>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login.form') }}" class="ak-btn ak-btn--ghost ak--desktop">{{ __('frontend.header.login') }}</a>
                <a href="{{ route('register.form') }}" class="ak-btn ak-btn--primary ak--desktop">{{ __('frontend.header.register') }}</a>
            @endif

            {{-- Mobile menu toggle (JS: .mobile-nav-toggler) --}}
            <button type="button" class="ak-icon-btn ak--mobile mobile-nav-toggler" aria-label="{{ __('frontend.header.menu') }}">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</header>


{{-- Mobile drawer (JS: .mobile-menu / .menu-backdrop / .close-btn) --}}
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <nav class="menu-box ak-drawer" aria-label="{{ __('frontend.header.mobile_nav') }}">

        <div class="ak-drawer__top">
            <a href="{{ route('home') }}" class="ak-logo">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $hdCompany }}">
                <span class="ak-logo__dot" aria-hidden="true"></span>
            </a>
            <button type="button" class="ak-icon-btn close-btn" aria-label="{{ __('frontend.header.close') }}">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>

        <div class="ak-drawer__body">
            @if(Auth::check())
                <div class="ak-drawer__user">
                    <span class="ak-avatar ak-avatar--lg" aria-hidden="true">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                    <div>
                        <p class="ak-drawer__user-name">{{ Auth::user()->name }}</p>
                        <a href="{{ route('points.topup') }}" class="ak-drawer__user-credits">
                            <i class="fas fa-bolt" aria-hidden="true"></i>
                            <span class="ak-num">{{ number_format($hdBalance) }}</span>
                            {{ __('frontend.header.credits') }}
                        </a>
                    </div>
                </div>
            @endif

            <div class="ak-drawer__nav">
                <a href="{{ route('home') }}" class="ak-drawer__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>
                    {{ __('frontend.header.home') }}
                </a>

                <details class="ak-acc">
                    <summary class="ak-drawer__link ak-drawer__link--acc">
                        {{ __('frontend.header.categories') }}
                        <i class="fas fa-chevron-down ak-acc__chev" aria-hidden="true"></i>
                    </summary>
                    <div class="ak-acc__body">
                        @forelse($headerCategories as $cat)
                            @php $cimg = $cat->photo ? explode(',', $cat->photo)[0] : null; @endphp
                            <a class="ak-catrow" href="{{ route('product-lists', $cat->slug) }}">
                                <span class="ak-catrow__thumb">
                                    @if($cimg)
                                        <img src="{{ asset($cimg) }}" alt="" loading="lazy">
                                    @else
                                        <i class="fas fa-book-open" aria-hidden="true"></i>
                                    @endif
                                </span>
                                <span class="ak-catrow__name">{{ $cat->title }}</span>
                                <i class="fas fa-chevron-right ak-catrow__go" aria-hidden="true"></i>
                            </a>
                        @empty
                            <p class="ak-cats__none">{{ __('frontend.header.no_categories') }}</p>
                        @endforelse
                    </div>
                </details>

                <a href="{{ route('product-lists') }}" class="ak-drawer__link {{ Route::is('product-lists') ? 'is-active' : '' }}" @if(Route::is('product-lists')) aria-current="page" @endif>
                    {{ __('frontend.header.courses') }}
                </a>

                <a href="{{ route('points.topup') }}" class="ak-drawer__link {{ Route::is('points.topup') ? 'is-active' : '' }}" @if(Route::is('points.topup')) aria-current="page" @endif>
                    {{ __('frontend.header.buy_credits') }}
                </a>

                @if(Auth::check())
                    <a href="{{ route('user') }}" class="ak-drawer__link {{ Route::is('user') ? 'is-active' : '' }}" @if(Route::is('user')) aria-current="page" @endif>
                        {{ __('frontend.header.my_courses') }}
                    </a>
                @endif

                <a href="{{ route('contact') }}" class="ak-drawer__link {{ Route::is('contact') ? 'is-active' : '' }}" @if(Route::is('contact')) aria-current="page" @endif>
                    {{ __('frontend.header.contact') }}
                </a>
            </div>

            <div class="ak-drawer__prefs">
                <p class="ak-drawer__label">{{ __('frontend.header.language') }}</p>
                <div class="ak-chips">
                    <a class="chip {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}"><i class="fi fi-gb" aria-hidden="true"></i> English</a>
                    <a class="chip {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}"><i class="fi fi-jp" aria-hidden="true"></i> 日本語</a>
                </div>

                <p class="ak-drawer__label">{{ __('frontend.header.currency') }}</p>
                <div class="ak-chips">
                    @foreach($currencies as $cur)
                        <a class="chip {{ $currentCurrency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                            {{ Helper::getCurrencySymbol($cur->code) }} <span class="ak-num">{{ $cur->code }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="ak-drawer__foot">
            @if(Auth::check())
                <a href="{{ route('user') }}" class="ak-btn ak-btn--primary ak-btn--block">{{ __('frontend.header.account') }}</a>
                <a href="{{ route('user.logout') }}" class="ak-btn ak-btn--ghost ak-btn--block">{{ __('frontend.header.logout') }}</a>
            @else
                <a href="{{ route('register.form') }}" class="ak-btn ak-btn--primary ak-btn--block">{{ __('frontend.header.register') }}</a>
                <a href="{{ route('login.form') }}" class="ak-btn ak-btn--ghost ak-btn--block">{{ __('frontend.header.login') }}</a>
            @endif
        </div>
    </nav>
</div>


{{-- Cart slide-over (JS: .offcanvas__overlay / .cartcanvas__info / .cartcanvas__close) --}}
<div class="offcanvas__overlay"></div>
<aside class="cartcanvas__info ak-cart" aria-label="{{ __('frontend.header.cart') }}">

    <div class="ak-cart__top">
        <h2 class="ak-cart__title">
            {{ __('frontend.header.cart') }}
            @if($hdCartQty)
                <span class="ak-cart__qty ak-num">{{ $hdCartQty }}</span>
            @endif
        </h2>
        <button type="button" class="ak-icon-btn cartcanvas__close" aria-label="{{ __('frontend.header.cart_close') }}">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="ak-cart__scroll">
        @if(Helper::cartCount())
            <ul class="ak-cart__list">
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

                    <li class="ak-cart__item">
                        @if($isPoints)
                            <span class="ak-cart__img ak-cart__img--credits"><i class="fas fa-bolt" aria-hidden="true"></i></span>
                        @else
                            <span class="ak-cart__img"><img src="{{ asset($item_photo) }}" alt="" loading="lazy"></span>
                        @endif

                        <div class="ak-cart__info">
                            <p class="ak-cart__name">{{ $item_title }}</p>
                            @if($item_level)
                                <span class="badge ak-cart__level">{{ $item_level }}</span>
                            @endif
                            <p class="ak-cart__meta">
                                <span class="ak-num">{{ $cart->quantity }}</span> ×
                                <span class="ak-num">{{ number_format($cart->points) }}</span> {{ __('frontend.header.credits') }}
                            </p>
                            @if($isPoints)
                                <p class="ak-cart__price ak-num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            @endif
                        </div>

                        <a href="{{ route('cart-delete',$cart->id) }}" class="ak-cart__remove" aria-label="{{ __('frontend.header.cart_remove') }}">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="ak-cart__empty">
                <span class="ak-cart__empty-icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <p class="ak-cart__empty-text">{{ __('frontend.header.cart_empty') }}</p>
                <a href="{{ route('product-lists') }}" class="ak-btn ak-btn--primary">
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
        <div class="ak-cart__foot">

            <div class="ak-cart__summary">
                <div class="ak-cart__row">
                    <span class="ak-cart__row-label">{{ __('frontend.header.cart_total') }}:</span>
                    @if($hasPoints && !$hasProducts)
                        <span class="ak-cart__row-value ak-num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</span>
                    @else
                        <span class="ak-cart__row-value">
                            <span class="ak-num">{{ number_format($totalPoints) }}</span>
                            <small>{{ __('frontend.header.credits') }}</small>
                        </span>
                    @endif
                </div>

                @if($hasProducts && Auth::check())
                    <div class="ak-cart__row ak-cart__row--muted">
                        <span class="ak-cart__row-label">{{ __('frontend.header.balance_label') }}:</span>
                        <span class="ak-cart__row-value">
                            <span class="ak-num">{{ number_format($hdBalance) }}</span>
                            <small>{{ __('frontend.header.credits') }}</small>
                        </span>
                    </div>
                @endif
            </div>

            <div class="ak-cart__actions">
                @if($hasPoints && !$hasProducts)
                    <a href="{{ route('checkout') }}" class="ak-btn ak-btn--primary ak-btn--block">{{ __('frontend.header.checkout') }}</a>
                    <a href="{{ route('cart') }}" class="ak-btn ak-btn--ghost ak-btn--block">{{ __('frontend.header.view_cart') }}</a>
                @elseif($hasProducts && !$hasPoints)
                    <a href="{{ route('coursecart') }}" class="ak-btn ak-btn--primary ak-btn--block">{{ __('frontend.header.view_cart') }}</a>
                @endif
                <button type="button" class="ak-btn ak-btn--quiet ak-btn--block cartcanvas__close">{{ __('frontend.header.continue') }}</button>
            </div>
        </div>
    @endif
</aside>


@cookieconsentview
