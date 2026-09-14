{{-- ==========================================================================
     [Website Name] — Site Header
     Floating pill navigation (see design and content/DESIGN.md).
     Styles: public/css/main.css
     JS hooks kept: .mobile-nav-toggler, .mobile-menu, .menu-backdrop, .close-btn,
     .ui-btn.bb-cart-toggle, .offcanvas__overlay, .cartcanvas__info, .cartcanvas__close
     ========================================================================== --}}
@php
    $headerCategories = \App\Models\Category::where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $currentCurrency  = session('currency', 'USD');
    $currencies       = Helper::CurrenciesList();
    $isJa             = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
@endphp


{{-- Top bar: language + currency --}}
<div class="hd-top">
    <div class="hd-top__inner">
        @php $topEmail = $misc['Company Email'] ?? null; @endphp
        @if($topEmail)
            <a href="mailto:{{ $topEmail }}" class="hd-top__link">
                <i class="fas fa-envelope"></i> {{ $topEmail }}
            </a>
        @else
            <span></span>
        @endif

        <div class="hd-top__right">
            {{-- Language --}}
            <div class="hd__dd">
                <button type="button" class="hd-top__trigger" aria-haspopup="true">
                    <i class="fi {{ $isJa ? 'fi-jp' : 'fi-gb' }}"></i>
                    {{ $isJa ? '日本語' : 'English' }}
                    <i class="fas fa-chevron-down hd__chev"></i>
                </button>
                <div class="hd__panel hd__panel--right">
                    <div class="hd__card">
                        <a class="hd__item {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}"><i class="fi fi-gb"></i> English</a>
                        <a class="hd__item {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}"><i class="fi fi-jp"></i> 日本語</a>
                    </div>
                </div>
            </div>

            <span class="hd-top__sep" aria-hidden="true"></span>

            {{-- Currency --}}
            <div class="hd__dd">
                <button type="button" class="hd-top__trigger" aria-haspopup="true">
                    {{ Helper::getCurrencySymbol($currentCurrency) }} {{ $currentCurrency }}
                    <i class="fas fa-chevron-down hd__chev"></i>
                </button>
                <div class="hd__panel hd__panel--right">
                    <div class="hd__card">
                        @foreach($currencies as $cur)
                            <a class="hd__item {{ $currentCurrency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                                <span class="hd-top__sym">{{ Helper::getCurrencySymbol($cur->code) }}</span> {{ $cur->code }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<header class="hd">
    <div class="hd__pill">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="hd__logo">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="[Website Name]">
        </a>

        {{-- Desktop navigation --}}
        <nav class="hd__nav" aria-label="Main">
            <a href="{{ route('home') }}" class="hd__link {{ Route::is('home') ? 'is-active' : '' }}">{{ __('managenovax.header.home') }}</a>

            <div class="hd__dd">
                <button type="button" class="hd__link" aria-haspopup="true">
                    {{ __('managenovax.header.categories') }}
                    <i class="fas fa-chevron-down hd__chev"></i>
                </button>
                <div class="hd__panel">
                    <div class="hd__card hd__mega">
                        <div class="hd__mega-list">
                            @forelse($headerCategories as $cat)
                                @php $cimg = $cat->photo ? explode(',', $cat->photo)[0] : null; @endphp
                                <a class="hd__item {{ (isset($category->id) && $category->id == $cat->id) ? 'is-active' : '' }}" href="{{ route('product-lists', $cat->slug) }}">
                                    <span class="hd__thumb">
                                        @if($cimg)
                                            <img src="{{ asset($cimg) }}" alt="">
                                        @else
                                            <i class="fas fa-book-open"></i>
                                        @endif
                                    </span>
                                    {{ $cat->title }}
                                </a>
                            @empty
                                <span class="hd__item">{{ __('managenovax.header.no_categories') }}</span>
                            @endforelse
                        </div>
                        <a href="{{ route('product-lists') }}" class="hd__promo">
                            <p class="hd__promo-title">{{ __('managenovax.header.courses') }}</p>
                            <span class="hd__btn hd__btn--lime">{{ __('managenovax.header.courses') }} <i class="fas fa-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('product-lists') }}" class="hd__link {{ Route::is('product-lists') ? 'is-active' : '' }}">{{ __('managenovax.header.courses') }}</a>

            @if(Auth::check())
                <a href="{{ route('user') }}" class="hd__link {{ Route::is('user') ? 'is-active' : '' }}">{{ __('managenovax.header.my_courses') }}</a>
            @endif

            <a href="{{ route('contact') }}" class="hd__link {{ Route::is('contact') ? 'is-active' : '' }}">{{ __('managenovax.header.support') }}</a>
        </nav>

        {{-- Actions --}}
        <div class="hd__actions">

            @if(Auth::check())
                {{-- Credits balance --}}
                <a href="{{ route('points.topup') }}" class="hd__chip hd__chip--credits hd__desktop">
                    <i class="fas fa-coins hd__coin"></i>
                    {{ number_format(Auth::user()->points_balance ?? 0) }}
                </a>

                {{-- User menu --}}
                <div class="hd__dd hd__desktop">
                    <button type="button" class="hd__chip hd__chip--user" aria-haspopup="true">
                        <span class="hd__avatar">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                        {{ explode(' ', Auth::user()->name)[0] }}
                        <i class="fas fa-chevron-down hd__chev"></i>
                    </button>
                    <div class="hd__panel hd__panel--right">
                        <div class="hd__card">
                            <a class="hd__item" href="{{ route('user') }}"><i class="fas fa-user"></i> {{ __('managenovax.header.account') }}</a>
                            <a class="hd__item" href="{{ route('user') }}"><i class="fas fa-graduation-cap"></i> {{ __('managenovax.header.my_courses') }}</a>
                            <a class="hd__item" href="{{ route('points.topup') }}"><i class="fas fa-coins"></i> {{ __('managenovax.header.credits_topup') }}</a>
                            <div class="hd__divider"></div>
                            <a class="hd__item" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i> {{ __('managenovax.header.logout') }}</a>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login.form') }}" class="hd__btn hd__btn--ghost hd__guest">{{ __('managenovax.header.login') }}</a>
                <a href="{{ route('register.form') }}" class="hd__btn hd__btn--dark hd__guest">{{ __('managenovax.header.register') }}</a>
            @endif

            {{-- Cart toggle (JS: .ui-btn / .bb-cart-toggle) --}}
            <button type="button" class="hd__icon-btn ui-btn bb-cart-toggle" aria-label="{{ __('managenovax.header.cart_heading') }}">
                <i class="fas fa-shopping-bag"></i>
                <span class="hd__count">{{ Helper::totalCartQuantity() }}</span>
            </button>

            {{-- Mobile menu toggle (JS: .mobile-nav-toggler) --}}
            <button type="button" class="hd__icon-btn hd__icon-btn--light hd__mobile mobile-nav-toggler" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    {{-- Mobile drawer (JS: .mobile-menu / .menu-backdrop / .close-btn) --}}
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <nav class="menu-box" aria-label="Mobile">
            <div class="hd__drawer-top">
                <a href="{{ route('home') }}" class="hd__logo">
                    <img src="{{ asset('assets/images/logo.webp') }}" alt="[Website Name]">
                </a>
                <button type="button" class="hd__icon-btn close-btn" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>

            <div class="hd__drawer-body">
                @if(Auth::check())
                    <div class="hd__user-card">
                        <span class="hd__avatar">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                        <div>
                            <div class="hd__user-name">{{ Auth::user()->name }}</div>
                            <a href="{{ route('points.topup') }}" class="hd__user-credits">
                                <i class="fas fa-coins"></i> {{ number_format(Auth::user()->points_balance ?? 0) }} {{ __('managenovax.header.credits_label') }}
                            </a>
                        </div>
                    </div>
                @endif

                <div class="hd__drawer-group">
                    <a href="{{ route('home') }}" class="hd__drawer-link {{ Route::is('home') ? 'is-active' : '' }}">{{ __('managenovax.header.home') }}</a>

                    <details class="hd__acc">
                        <summary class="hd__drawer-link">
                            {{ __('managenovax.header.categories') }}
                            <i class="fas fa-chevron-down hd__chev"></i>
                        </summary>
                        <div class="hd__acc-list">
                            @forelse($headerCategories as $cat)
                                @php $cimg = $cat->photo ? explode(',', $cat->photo)[0] : null; @endphp
                                <a class="hd__item" href="{{ route('product-lists', $cat->slug) }}">
                                    <span class="hd__thumb">
                                        @if($cimg)
                                            <img src="{{ asset($cimg) }}" alt="">
                                        @else
                                            <i class="fas fa-book-open"></i>
                                        @endif
                                    </span>
                                    {{ $cat->title }}
                                </a>
                            @empty
                                <span class="hd__item">{{ __('managenovax.header.no_categories') }}</span>
                            @endforelse
                        </div>
                    </details>

                    <a href="{{ route('product-lists') }}" class="hd__drawer-link {{ Route::is('product-lists') ? 'is-active' : '' }}">{{ __('managenovax.header.courses') }} <i class="fas fa-arrow-right"></i></a>

                    @if(Auth::check())
                        <a href="{{ route('user') }}" class="hd__drawer-link {{ Route::is('user') ? 'is-active' : '' }}">{{ __('managenovax.header.my_courses') }} <i class="fas fa-arrow-right"></i></a>
                    @endif

                    <a href="{{ route('contact') }}" class="hd__drawer-link {{ Route::is('contact') ? 'is-active' : '' }}">{{ __('managenovax.header.support') }} <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="hd__drawer-group">
                    <span class="hd__label">Language</span>
                    <div class="hd__pills">
                        <a class="hd__chip {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}"><i class="fi fi-gb"></i> English</a>
                        <a class="hd__chip {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}"><i class="fi fi-jp"></i> 日本語</a>
                    </div>
                    <span class="hd__label">Currency</span>
                    <div class="hd__pills">
                        @foreach($currencies as $cur)
                            <a class="hd__chip {{ $currentCurrency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                                {{ Helper::getCurrencySymbol($cur->code) }} {{ $cur->code }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="hd__drawer-foot">
                @if(Auth::check())
                    <a href="{{ route('user') }}" class="hd__btn hd__btn--lime hd__btn--block">{{ __('managenovax.header.account') }}</a>
                    <a href="{{ route('user.logout') }}" class="hd__btn hd__btn--outline hd__btn--block">{{ __('managenovax.header.logout') }}</a>
                @else
                    <a href="{{ route('register.form') }}" class="hd__btn hd__btn--lime hd__btn--block">{{ __('managenovax.header.register') }}</a>
                    <a href="{{ route('login.form') }}" class="hd__btn hd__btn--outline hd__btn--block">{{ __('managenovax.header.login') }}</a>
                @endif
            </div>
        </nav>
    </div>
</header>


{{-- Cart drawer (JS: .offcanvas__overlay / .cartcanvas__info / .cartcanvas__close) --}}
<div class="offcanvas__overlay"></div>
<aside class="cartcanvas__info" aria-label="{{ __('managenovax.header.cart_heading') }}">
    <div class="hd-cart__top">
        <h4 class="hd-cart__title">
            {{ __('managenovax.header.cart_heading') }}
            @if(Helper::cartCount())
                <span class="hd-cart__qty">{{ Helper::totalCartQuantity() }}</span>
            @endif
        </h4>
        <button type="button" class="hd__icon-btn cartcanvas__close" aria-label="Close"><i class="fas fa-times"></i></button>
    </div>

    <ul class="hd-cart__list">
        @if(Helper::cartCount())
            @foreach(Helper::getAllProductFromCart() as $cart)
                @php
                    $isPoints = !$cart->product || $cart->product_id >= 1000;
                    $item_title = __('managenovax.header.credits_topup');
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

                <li class="hd-cart__item">
                    <a href="{{ route('cart-delete',$cart->id) }}" class="hd-cart__remove" aria-label="Remove"><i class="fas fa-times"></i></a>

                    @if($isPoints)
                        <div class="hd-cart__img hd-cart__img--credits"><i class="fas fa-coins"></i></div>
                        <div class="hd-cart__info">
                            <h6 class="hd-cart__name">{{ $item_title }}</h6>
                            <p class="hd-cart__meta">{{ $cart->quantity }} × <strong>{{ number_format($cart->points) }} {{ __('managenovax.header.credits_label') }}</strong></p>
                            <p class="hd-cart__price">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                        </div>
                    @else
                        <div class="hd-cart__img"><img src="{{ asset($item_photo) }}" alt=""></div>
                        <div class="hd-cart__info">
                            <h6 class="hd-cart__name">{{ $item_title }}</h6>
                            <span class="hd-cart__tag">{{ $item_level }}</span>
                            <p class="hd-cart__meta">{{ $cart->quantity }} × <strong>{{ number_format($cart->points) }} {{ __('managenovax.header.credits_label') }}</strong></p>
                        </div>
                    @endif
                </li>
            @endforeach
        @else
            <li class="hd-cart__empty">
                <span class="hd-cart__empty-icon"><i class="fas fa-shopping-bag"></i></span>
                <p>{{ __('managenovax.header.empty_cart_msg') }}</p>
                <a href="{{ route('product-lists') }}" class="hd__btn hd__btn--dark">{{ __('managenovax.header.courses') }} <i class="fas fa-arrow-right"></i></a>
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
        <div class="hd-cart__foot">
            <div class="hd-cart__total">
                <span class="hd-cart__total-label">{{ __('managenovax.header.total_label') }}</span>
                @if($hasPoints && !$hasProducts)
                    <span class="hd-cart__total-value">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</span>
                @else
                    <span class="hd-cart__total-value">{{ number_format($totalPoints) }} <small>{{ __('managenovax.header.credits_label') }}</small></span>
                @endif
            </div>

            @if($hasPoints && !$hasProducts)
                <a href="{{ route('checkout') }}" class="hd__btn hd__btn--lime hd__btn--block">{{ __('managenovax.header.checkout_btn') }}</a>
                <a href="{{ route('cart') }}" class="hd__btn hd__btn--outline hd__btn--block">{{ __('managenovax.header.view_cart_btn') }}</a>
            @elseif($hasProducts && !$hasPoints)
                <a href="{{ route('coursecart') }}" class="hd__btn hd__btn--lime hd__btn--block">{{ __('managenovax.header.view_cart_btn') }}</a>
            @endif
        </div>
    @endif
</aside>



@cookieconsentview
