{{-- ==========================================================================
     Site header — Academy light theme
     A washed topbar carrying contact, language, currency and (signed out) the
     login and register buttons, above a sticky 72px masthead. Below 992px the
     topbar folds into the drawer, which carries the same choices at full size.
     Styles: public/css/variables.css — sections 2 to 6
     Behaviour: the script at the foot of this file. Hooks are data attributes,
     so no stylistic class carries JS meaning.
     ========================================================================== --}}
@php
    $navCategories   = \App\Models\Category::with('child_cat')->where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $currency        = session('currency', 'USD');
    $currencyList    = Helper::CurrenciesList();
    $isJa            = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
    $company         = $misc['Company Name'] ?? __('frontend.company.name');
    $companyEmail    = $misc['Company Email'] ?? __('frontend.company.email');
    $cartQty         = Helper::totalCartQuantity();
    $balance         = Auth::check() ? (Auth::user()->points_balance ?? 0) : 0;
@endphp


{{-- ==========================================================================
     Topbar — contact, preferences, and the signed-out entry points
     ========================================================================== --}}
<div class="topbar">
    <div class="topbar__inner">

        <a href="mailto:{{ $companyEmail }}" class="topbar__mail">
            <i class="fas fa-envelope" aria-hidden="true"></i>
            <span>{{ $companyEmail }}</span>
        </a>

        <div class="topbar__right">
            <div class="topbar__set">

                {{-- Language --}}
                <div class="pop">
                    <button type="button" class="pop__trigger" aria-expanded="false">
                        <i class="fi {{ $isJa ? 'fi-jp' : 'fi-gb' }}" aria-hidden="true"></i>
                        <span>{{ $isJa ? '日本語' : 'English' }}</span>
                        <i class="fas fa-chevron-down pop__chev" aria-hidden="true"></i>
                    </button>
                    <div class="pop__panel pop__panel--end">
                        <a class="pop__item {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}" @if(!$isJa) aria-current="true" @endif>
                            <span class="pop__sym"><i class="fi fi-gb" aria-hidden="true"></i></span>
                            English
                        </a>
                        <a class="pop__item {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}" @if($isJa) aria-current="true" @endif>
                            <span class="pop__sym"><i class="fi fi-jp" aria-hidden="true"></i></span>
                            日本語
                        </a>
                    </div>
                </div>

                <span class="topbar__rule" aria-hidden="true"></span>

                {{-- Currency --}}
                <div class="pop">
                    <button type="button" class="pop__trigger" aria-expanded="false">
                        <span class="num">{{ Helper::getCurrencySymbol($currency) }} {{ $currency }}</span>
                        <i class="fas fa-chevron-down pop__chev" aria-hidden="true"></i>
                    </button>
                    <div class="pop__panel pop__panel--end">
                        @foreach($currencyList as $cur)
                            <a class="pop__item {{ $currency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currency == $cur->code) aria-current="true" @endif>
                                <span class="pop__sym">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                                <span class="num">{{ $cur->code }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            @guest
                <span class="topbar__rule" aria-hidden="true"></span>
                <div class="topbar__auth">
                    <a href="{{ route('login.form') }}" class="btn btn--ghost btn--sm">{{ __('frontend.header.login') }}</a>
                    <a href="{{ route('register.form') }}" class="btn btn--primary btn--sm">{{ __('frontend.header.register') }}</a>
                </div>
            @endguest
        </div>
    </div>
</div>


{{-- ==========================================================================
     Masthead — logo, navigation, balance, cart, account
     ========================================================================== --}}
<header class="masthead" data-masthead>
    <div class="masthead__inner">

        <a href="{{ route('home') }}" class="masthead__logo">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $company }}">
        </a>

        <nav class="mainnav" aria-label="{{ __('frontend.header.main_nav') }}">
            <a href="{{ route('home') }}" class="mainnav__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>
                {{ __('frontend.header.home') }}
            </a>

            {{-- Categories: one list of parents, each with its children beneath
                 as plain links. No nested flyout to chase with a cursor. --}}
            <div class="pop">
                <button type="button" class="mainnav__link pop__trigger" aria-expanded="false">
                    {{ __('frontend.header.categories') }}
                    <i class="fas fa-chevron-down pop__chev" aria-hidden="true"></i>
                </button>
                <div class="pop__panel pop__panel--wide">
                    <ul class="cats">
                        @forelse($navCategories as $cat)
                            <li>
                                <a class="cats__row" href="{{ route('product-lists', $cat->slug) }}">
                                    <span>{{ $cat->title }}</span>
                                    <i class="fas fa-arrow-right cats__go" aria-hidden="true"></i>
                                </a>
                                @if($cat->child_cat->count())
                                    <ul class="cats__subs">
                                        @foreach($cat->child_cat as $sub)
                                            <li><a class="cats__sub" href="{{ route('product-lists', $sub->slug) }}">{{ $sub->title }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @empty
                            <li><p class="cats__none">{{ __('frontend.header.no_categories') }}</p></li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <a href="{{ route('product-lists') }}" class="mainnav__link {{ Route::is('product-lists') ? 'is-active' : '' }}" @if(Route::is('product-lists')) aria-current="page" @endif>
                {{ __('frontend.header.courses') }}
            </a>

            <a href="{{ route('points.topup') }}" class="mainnav__link {{ Route::is('points.topup') ? 'is-active' : '' }}" @if(Route::is('points.topup')) aria-current="page" @endif>
                {{ __('frontend.header.buy_credits') }}
            </a>

            <a href="{{ route('contact') }}" class="mainnav__link {{ Route::is('contact') ? 'is-active' : '' }}" @if(Route::is('contact')) aria-current="page" @endif>
                {{ __('frontend.header.contact') }}
            </a>
        </nav>

        <div class="masthead__actions">

            @auth
                <a href="{{ route('points.topup') }}" class="credit is-desktop" aria-label="{{ number_format($balance) }} {{ __('frontend.header.credits') }}. {{ __('frontend.header.balance') }}">
                    <i class="fas fa-bolt" aria-hidden="true"></i>
                    <span class="num">{{ number_format($balance) }}</span>
                </a>
            @endauth

            <button type="button" class="cartbtn" aria-expanded="false" aria-label="{{ __('frontend.header.cart_open') }}" data-open="cart">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                @if($cartQty)
                    <span class="cartbtn__count">{{ $cartQty }}</span>
                @endif
            </button>

            @auth
                <div class="pop is-desktop">
                    <button type="button" class="user pop__trigger" aria-expanded="false">
                        <span class="avatar" aria-hidden="true">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                        <span>{{ explode(' ', Auth::user()->name)[0] }}</span>
                        <i class="fas fa-chevron-down pop__chev" aria-hidden="true"></i>
                    </button>
                    <div class="pop__panel pop__panel--end">
                        <div class="pop__head">
                            <p class="pop__name">{{ Auth::user()->name }}</p>
                            <p class="pop__sub">
                                <i class="fas fa-bolt" aria-hidden="true"></i>
                                <span class="num">{{ number_format($balance) }}</span> {{ __('frontend.header.credits') }}
                            </p>
                        </div>
                        <a class="pop__item" href="{{ route('user') }}">
                            <span class="pop__sym"><i class="fas fa-user" aria-hidden="true"></i></span>
                            {{ __('frontend.header.account') }}
                        </a>
                        <a class="pop__item" href="{{ route('user') }}">
                            <span class="pop__sym"><i class="fas fa-graduation-cap" aria-hidden="true"></i></span>
                            {{ __('frontend.header.my_courses') }}
                        </a>
                        <a class="pop__item" href="{{ route('points.topup') }}">
                            <span class="pop__sym"><i class="fas fa-bolt" aria-hidden="true"></i></span>
                            {{ __('frontend.header.buy_credits') }}
                        </a>
                        <span class="pop__rule" aria-hidden="true"></span>
                        <a class="pop__item" href="{{ route('user.logout') }}">
                            <span class="pop__sym"><i class="fas fa-sign-out-alt" aria-hidden="true"></i></span>
                            {{ __('frontend.header.logout') }}
                        </a>
                    </div>
                </div>
            @endauth

            <button type="button" class="iconbtn is-mobile" aria-expanded="false" aria-label="{{ __('frontend.header.menu') }}" data-open="nav">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</header>


{{-- Shared scrim: the drawer and the cart are never open at the same time. --}}
<div class="scrim" data-scrim hidden></div>


{{-- ==========================================================================
     Mobile drawer
     ========================================================================== --}}
<nav class="drawer" data-panel="nav" aria-label="{{ __('frontend.header.mobile_nav') }}">

    <div class="drawer__top">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $company }}">
        </a>
        <button type="button" class="iconbtn" aria-label="{{ __('frontend.header.close') }}" data-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="drawer__body">

        @auth
            <div class="drawer__user">
                <span class="avatar avatar--lg" aria-hidden="true">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                <div>
                    <p class="drawer__user-name">{{ Auth::user()->name }}</p>
                    <a href="{{ route('points.topup') }}" class="drawer__user-credits">
                        <i class="fas fa-bolt" aria-hidden="true"></i>
                        <span class="num">{{ number_format($balance) }}</span>
                        {{ __('frontend.header.credits') }}
                    </a>
                </div>
            </div>
        @endauth

        <div class="drawer__nav">
            <a href="{{ route('home') }}" class="drawer__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>
                {{ __('frontend.header.home') }}
            </a>

            {{-- Native accordion: no script, and the open state survives a
                 reduced-motion preference on its own. --}}
            <details class="acc">
                <summary class="drawer__link">
                    {{ __('frontend.header.categories') }}
                    <i class="fas fa-chevron-down acc__chev" aria-hidden="true"></i>
                </summary>
                <div class="acc__body">
                    @forelse($navCategories as $cat)
                        @php $catPhoto = $cat->photo ? explode(',', $cat->photo)[0] : null; @endphp
                        <a class="catrow" href="{{ route('product-lists', $cat->slug) }}">
                            <span class="catrow__thumb">
                                @if($catPhoto)
                                    <img src="{{ asset($catPhoto) }}" alt="" loading="lazy">
                                @else
                                    <i class="fas fa-book-open" aria-hidden="true"></i>
                                @endif
                            </span>
                            <span>{{ $cat->title }}</span>
                            <i class="fas fa-chevron-right catrow__go" aria-hidden="true"></i>
                        </a>
                    @empty
                        <p class="cats__none">{{ __('frontend.header.no_categories') }}</p>
                    @endforelse
                </div>
            </details>

            <a href="{{ route('product-lists') }}" class="drawer__link {{ Route::is('product-lists') ? 'is-active' : '' }}" @if(Route::is('product-lists')) aria-current="page" @endif>
                {{ __('frontend.header.courses') }}
            </a>

            <a href="{{ route('points.topup') }}" class="drawer__link {{ Route::is('points.topup') ? 'is-active' : '' }}" @if(Route::is('points.topup')) aria-current="page" @endif>
                {{ __('frontend.header.buy_credits') }}
            </a>

            @auth
                <a href="{{ route('user') }}" class="drawer__link {{ Route::is('user') ? 'is-active' : '' }}" @if(Route::is('user')) aria-current="page" @endif>
                    {{ __('frontend.header.my_courses') }}
                </a>
            @endauth

            <a href="{{ route('contact') }}" class="drawer__link {{ Route::is('contact') ? 'is-active' : '' }}" @if(Route::is('contact')) aria-current="page" @endif>
                {{ __('frontend.header.contact') }}
            </a>
        </div>

        {{-- The preferences the topbar holds on desktop. --}}
        <div class="drawer__prefs">
            <p class="drawer__label">{{ __('frontend.header.language') }}</p>
            <div class="drawer__pills">
                <a class="pill {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}">
                    <i class="fi fi-gb" aria-hidden="true"></i> English
                </a>
                <a class="pill {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}">
                    <i class="fi fi-jp" aria-hidden="true"></i> 日本語
                </a>
            </div>

            <p class="drawer__label">{{ __('frontend.header.currency') }}</p>
            <div class="drawer__pills">
                @foreach($currencyList as $cur)
                    <a class="pill {{ $currency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}">
                        {{ Helper::getCurrencySymbol($cur->code) }} <span class="num">{{ $cur->code }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="drawer__foot">
        @auth
            <a href="{{ route('user') }}" class="btn btn--primary btn--block">{{ __('frontend.header.account') }}</a>
            <a href="{{ route('user.logout') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.logout') }}</a>
        @else
            <a href="{{ route('register.form') }}" class="btn btn--primary btn--block">{{ __('frontend.header.register') }}</a>
            <a href="{{ route('login.form') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.login') }}</a>
        @endauth
    </div>
</nav>


{{-- ==========================================================================
     Cart slide-over
     ========================================================================== --}}
<aside class="cart" data-panel="cart" aria-label="{{ __('frontend.header.cart') }}">

    <div class="cart__top">
        <h2 class="cart__title">
            {{ __('frontend.header.cart') }}
            @if($cartQty)
                <span class="cart__qty">{{ $cartQty }}</span>
            @endif
        </h2>
        <button type="button" class="iconbtn" aria-label="{{ __('frontend.header.cart_close') }}" data-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="cart__scroll">
        @if(Helper::cartCount())
            <ul class="cart__list">
                @foreach(Helper::getAllProductFromCart() as $line)
                    @php
                        $isCredits = !$line->product || $line->product_id >= 1000;
                        $lineTitle = __('frontend.header.cart_credits');
                        $linePhoto = null;
                        $lineLevel = null;

                        if($line->product && $line->product_id < 1000) {
                            $linePhoto = explode(',', $line->product->photo)[0];
                            $lineTitle = $line->product->title;

                            $level = \App\Models\ProductLevel::where('course_id', $line->product_id)
                                         ->where('price_in_points', $line->points)
                                         ->first();
                            $levelKey  = $level ? 'frontend.header.levels.' . strtolower($level->skill_level) : null;
                            $lineLevel = $level ? (Lang::has($levelKey) ? __($levelKey) : ucfirst($level->skill_level)) : null;
                        }
                    @endphp

                    <li class="cart__item">
                        @if($isCredits)
                            <span class="cart__img cart__img--credits"><i class="fas fa-bolt" aria-hidden="true"></i></span>
                        @else
                            <span class="cart__img"><img src="{{ asset($linePhoto) }}" alt="" loading="lazy"></span>
                        @endif

                        <div>
                            <p class="cart__name">{{ $lineTitle }}</p>
                            @if($lineLevel)
                                <span class="cart__level">{{ $lineLevel }}</span>
                            @endif
                            <p class="cart__meta">
                                <span class="num">{{ $line->quantity }}</span> ×
                                <span class="num">{{ number_format($line->points) }}</span> {{ __('frontend.header.credits') }}
                            </p>
                            @if($isCredits)
                                <p class="cart__price num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($line['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            @endif
                        </div>

                        <a href="{{ route('cart-delete', $line->id) }}" class="cart__remove" aria-label="{{ __('frontend.header.cart_remove') }}">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="cart__empty">
                <span class="cart__empty-icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <p class="cart__empty-text">{{ __('frontend.header.cart_empty') }}</p>
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    {{ __('frontend.header.promo_btn') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        @endif
    </div>

    @if(Helper::cartCount())
        @php
            $hasCredits  = false;
            $hasCourses  = false;
            $totalPrice  = 0;
            $totalPoints = 0;

            foreach(Helper::getAllProductFromCart() as $line) {
                if(!$line->product || $line->product_id >= 1000) {
                    $hasCredits = true;
                    $totalPrice += $line['price'];
                } else {
                    $hasCourses = true;
                    $totalPoints += ($line->quantity * $line->points);
                }
            }
        @endphp
        <div class="cart__foot">

            <div class="cart__summary">
                <div class="cart__row">
                    <span class="cart__row-label">{{ __('frontend.header.cart_total') }}</span>
                    @if($hasCredits && !$hasCourses)
                        <span class="cart__row-value num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</span>
                    @else
                        <span class="cart__row-value">
                            <span class="num">{{ number_format($totalPoints) }}</span>
                            <small>{{ __('frontend.header.credits') }}</small>
                        </span>
                    @endif
                </div>

                @if($hasCourses && Auth::check())
                    <div class="cart__row cart__row--muted">
                        <span class="cart__row-label">{{ __('frontend.header.balance_label') }}</span>
                        <span class="cart__row-value">
                            <span class="num">{{ number_format($balance) }}</span>
                            <small>{{ __('frontend.header.credits') }}</small>
                        </span>
                    </div>
                @endif
            </div>

            <div class="cart__actions">
                @if($hasCredits && !$hasCourses)
                    <a href="{{ route('checkout') }}" class="btn btn--primary btn--block">{{ __('frontend.header.checkout') }}</a>
                    <a href="{{ route('cart') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.view_cart') }}</a>
                @elseif($hasCourses && !$hasCredits)
                    <a href="{{ route('coursecart') }}" class="btn btn--primary btn--block">{{ __('frontend.header.view_cart') }}</a>
                @endif
                <button type="button" class="btn btn--quiet btn--block" data-close>{{ __('frontend.header.continue') }}</button>
            </div>
        </div>
    @endif
</aside>


@cookieconsentview


{{-- Behaviour sits at the foot of this partial rather than in the scripts
     stack, because that stack renders after </html> in this layout. Every
     element the script touches is declared above it, so no load event is
     needed, and it depends on nothing else. --}}
<script>
/* Header behaviour: popovers, the two slide-overs, and the masthead shadow.
   Plain DOM, no jQuery, and every hook is a data attribute. */
(function () {
    'use strict';

    var body = document.body;

    /* ---- Popovers ------------------------------------------------------ */

    var pops = document.querySelectorAll('.pop');

    function shutPops(keep) {
        pops.forEach(function (pop) {
            if (pop === keep) { return; }
            pop.classList.remove('is-open');
            var trigger = pop.querySelector('.pop__trigger');
            if (trigger) { trigger.setAttribute('aria-expanded', 'false'); }
        });
    }

    pops.forEach(function (pop) {
        var trigger = pop.querySelector('.pop__trigger');
        if (!trigger) { return; }

        trigger.addEventListener('click', function () {
            var isOpen = !pop.classList.contains('is-open');
            shutPops(pop);
            pop.classList.toggle('is-open', isOpen);
            trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    });

    /* ---- Slide-overs --------------------------------------------------- */

    var scrim  = document.querySelector('[data-scrim]');
    var panels = {};
    document.querySelectorAll('[data-panel]').forEach(function (panel) {
        panels[panel.getAttribute('data-panel')] = panel;
    });
    var open = null;

    function shutPanel() {
        if (!open) { return; }

        open.panel.classList.remove('is-open');
        open.opener.setAttribute('aria-expanded', 'false');
        open.opener.focus();

        if (scrim) {
            scrim.classList.remove('is-open');
            scrim.hidden = true;
        }
        body.classList.remove('is-locked');
        open = null;
    }

    function openPanel(panel, opener) {
        shutPanel();
        shutPops(null);

        panel.classList.add('is-open');
        opener.setAttribute('aria-expanded', 'true');

        if (scrim) {
            scrim.hidden = false;
            /* Let the element paint before the class lands, so the fade runs. */
            requestAnimationFrame(function () { scrim.classList.add('is-open'); });
        }
        body.classList.add('is-locked');
        open = { panel: panel, opener: opener };

        var close = panel.querySelector('[data-close]');
        if (close) { close.focus(); }
    }

    document.querySelectorAll('[data-open]').forEach(function (opener) {
        var panel = panels[opener.getAttribute('data-open')];
        if (!panel) { return; }

        opener.addEventListener('click', function () {
            if (open && open.panel === panel) { shutPanel(); } else { openPanel(panel, opener); }
        });
    });

    document.querySelectorAll('[data-close]').forEach(function (button) {
        button.addEventListener('click', shutPanel);
    });

    if (scrim) { scrim.addEventListener('click', shutPanel); }

    /* ---- Dismissal ----------------------------------------------------- */

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.pop')) { shutPops(null); }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') { return; }
        if (open) { shutPanel(); } else { shutPops(null); }
    });

    /* ---- Masthead shadow ----------------------------------------------- */

    var masthead = document.querySelector('[data-masthead]');

    if (masthead) {
        var shade = function () {
            masthead.classList.toggle('is-stuck', window.scrollY > 8);
        };
        window.addEventListener('scroll', shade, { passive: true });
        shade();
    }
}());
</script>
