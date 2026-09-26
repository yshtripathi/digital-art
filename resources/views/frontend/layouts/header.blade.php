@php
    $navCategories   = \App\Models\Category::with('child_cat')->where('status','active')->where('is_parent',1)->orderBy('title','ASC')->get();
    $currency        = session('currency', 'USD');
    $currencyList    = Helper::CurrenciesList();
    $isJa            = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
    $siteName        = __('frontend.head.site');
    $cartQty         = Helper::totalCartQuantity();
    $balance         = Auth::check() ? (Auth::user()->points_balance ?? 0) : 0;
    $userName        = Auth::check() ? Auth::user()->name : '';
    $userInitial     = Auth::check() ? mb_strtoupper(mb_substr($userName, 0, 1)) : '';

    $navLinks = [
        ['route' => 'about-us',      'label' => __('frontend.header.nav_about')],
        ['route' => 'contact',       'label' => __('frontend.header.nav_contact')],
    ];
@endphp

<header class="hd" data-hd>
    <div class="hd__inner">
        <a href="{{ route('home') }}" class="brand">
            <img src="{{ asset('assets/images/logo.webp') }}?v={{ filemtime(public_path('assets/images/logo.webp')) }}" alt="{{ $siteName }}" width="1146" height="240">
        </a>

        <nav class="hd__nav is-desktop" aria-label="{{ __('frontend.header.nav_main') }}">
            <ul class="hd__links">
                <li class="drop" data-drop data-drop-hover>
                    <button type="button" class="hd__link" aria-expanded="false" aria-controls="drop-cats" data-drop-trigger>
                        {{ __('frontend.header.nav_topics') }}
                        <i class="fas fa-chevron-down drop__chev" aria-hidden="true"></i>
                    </button>
                    <div class="drop__panel drop__panel--cats" id="drop-cats">
                        <p class="drop__label">{{ __('frontend.header.nav_topics') }}</p>
                        @if($navCategories->count())
                            <ul class="cats">
                                @foreach($navCategories as $cat)
                                    <li>
                                        <a class="cats__link" href="{{ route('product-lists', $cat->slug) }}">
                                            <span>{{ $cat->title }}</span>
                                            <i class="fas fa-arrow-right cats__go" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="cats__none">{{ __('frontend.header.topics_empty') }}</p>
                        @endif
                        <a class="cats__all" href="{{ route('product-lists') }}">
                            {{ __('frontend.header.topics_all') }}
                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </li>
                @foreach($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}" class="hd__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="hd__end">
            <div class="drop is-desktop" data-drop>
                <button type="button" class="hd__pref" aria-expanded="false" aria-controls="drop-prefs" data-drop-trigger>
                    <i class="fi {{ $isJa ? 'fi-jp' : 'fi-gb' }}" aria-hidden="true"></i>
                    <span>{{ $isJa ? 'JA' : 'EN' }}</span>
                    <span class="hd__sep" aria-hidden="true"></span>
                    <span class="num">{{ $currency }}</span>
                    <span class="vh">{{ __('frontend.header.pref_label') }}</span>
                    <i class="fas fa-chevron-down drop__chev" aria-hidden="true"></i>
                </button>
                <div class="drop__panel drop__panel--end" id="drop-prefs">
                    <p class="drop__label">{{ __('frontend.header.pref_language') }}</p>
                    <div class="drop__list">
                        <a class="drop__row {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}" @if(!$isJa) aria-current="true" @endif>
                            <i class="fi fi-gb" aria-hidden="true"></i>
                            <span>English</span>
                            @if(!$isJa)<i class="fas fa-check drop__tick" aria-hidden="true"></i>@endif
                        </a>
                        <a class="drop__row {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}" @if($isJa) aria-current="true" @endif>
                            <i class="fi fi-jp" aria-hidden="true"></i>
                            <span>日本語</span>
                            @if($isJa)<i class="fas fa-check drop__tick" aria-hidden="true"></i>@endif
                        </a>
                    </div>
                    <p class="drop__label">{{ __('frontend.header.pref_currency') }}</p>
                    <div class="drop__chips">
                        @foreach($currencyList as $cur)
                            <a class="drop__chip {{ $currency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currency == $cur->code) aria-current="true" @endif>
                                {{ Helper::getCurrencySymbol($cur->code) }} <span class="num">{{ $cur->code }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            @guest
                <a href="{{ route('login.form') }}" class="hd__signin is-desktop">{{ __('frontend.header.acct_login') }}</a>
                <a href="{{ route('register.form') }}" class="btn btn--primary hd__join is-desktop">{{ __('frontend.header.acct_join') }}</a>
            @endguest

            @auth
                <a href="{{ route('points.topup') }}" class="hd__credits is-desktop" aria-label="{{ number_format($balance) }} {{ __('frontend.header.unit_credits') }}. {{ __('frontend.header.wallet_hint') }}">
                    <i class="fas fa-coins" aria-hidden="true"></i>
                    <span class="num">{{ number_format($balance) }}</span>
                    <span class="hd__unit" aria-hidden="true">{{ __('frontend.header.unit_credits') }}</span>
                </a>

                <div class="drop is-desktop" data-drop>
                    <button type="button" class="hd__me" aria-expanded="false" aria-controls="drop-account" data-drop-trigger>
                        <span class="avatar" aria-hidden="true">{{ $userInitial }}</span>
                        <span class="vh">{{ __('frontend.header.acct_home') }}</span>
                    </button>
                    <div class="drop__panel drop__panel--end drop__panel--account" id="drop-account">
                        <div class="drop__who">
                            <span class="avatar avatar--lg" aria-hidden="true">{{ $userInitial }}</span>
                            <div>
                                <p class="drop__eyebrow">{{ __('frontend.header.acct_signed') }}</p>
                                <p class="drop__name">{{ $userName }}</p>
                            </div>
                        </div>
                        <a class="drop__wallet" href="{{ route('points.topup') }}">
                            <span class="drop__eyebrow">{{ __('frontend.header.cart_wallet') }}</span>
                            <span class="drop__amount"><span class="num">{{ number_format($balance) }}</span> {{ __('frontend.header.unit_credits') }}</span>
                        </a>
                        <div class="drop__list">
                            <a class="drop__row" href="{{ route('user') }}">
                                <i class="fas fa-user drop__icon" aria-hidden="true"></i>
                                <span>{{ __('frontend.header.acct_home') }}</span>
                            </a>
                            <a class="drop__row" href="{{ route('user') }}">
                                <i class="fas fa-book-open drop__icon" aria-hidden="true"></i>
                                <span>{{ __('frontend.header.nav_library') }}</span>
                            </a>
                            <a class="drop__row" href="{{ route('points.topup') }}">
                                <i class="fas fa-coins drop__icon" aria-hidden="true"></i>
                                <span>{{ __('frontend.header.acct_topup') }}</span>
                            </a>
                        </div>
                        <a class="drop__row drop__row--out" href="{{ route('user.logout') }}">
                            <i class="fas fa-sign-out-alt drop__icon" aria-hidden="true"></i>
                            <span>{{ __('frontend.header.acct_logout') }}</span>
                        </a>
                    </div>
                </div>
            @endauth

            <button type="button" class="hd__cart" aria-expanded="false" aria-controls="sheet-cart" data-sheet-open="cart">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                <span class="hd__count num" aria-hidden="true">{{ $cartQty }}</span>
                <span class="vh">{{ __('frontend.header.cart_show') }}</span>
            </button>

            <button type="button" class="hd__burger is-mobile" aria-expanded="false" aria-controls="sheet-menu" aria-label="{{ __('frontend.header.menu_open') }}" data-sheet-open="menu">
                <span class="burger" aria-hidden="true"><span></span><span></span><span></span></span>
            </button>
        </div>
    </div>
</header>

<div class="veil" data-veil hidden></div>

<div class="sheet sheet--menu" id="sheet-menu" role="dialog" aria-modal="true" aria-labelledby="sheet-menu-title" data-sheet="menu">
    <div class="sheet__top">
        <p class="sheet__title" id="sheet-menu-title">{{ __('frontend.header.menu_heading') }}</p>
        <button type="button" class="sheet__close" aria-label="{{ __('frontend.header.menu_close') }}" data-sheet-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="sheet__body">
        @auth
            <div class="menu__user">
                <span class="avatar avatar--lg" aria-hidden="true">{{ $userInitial }}</span>
                <div>
                    <p class="drop__eyebrow">{{ __('frontend.header.acct_signed') }}</p>
                    <p class="menu__name">{{ $userName }}</p>
                    <a href="{{ route('points.topup') }}" class="menu__credits">
                        <i class="fas fa-coins" aria-hidden="true"></i>
                        <span class="num">{{ number_format($balance) }}</span> {{ __('frontend.header.unit_credits') }}
                    </a>
                </div>
            </div>
        @endauth

        <nav aria-label="{{ __('frontend.header.nav_mobile') }}">
            <ul class="menu__list">
                <li>
                    <a href="{{ route('home') }}" class="menu__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>{{ __('frontend.header.nav_home') }}</a>
                </li>
                <li>
                    <details class="menu__acc">
                        <summary class="menu__link">
                            {{ __('frontend.header.nav_topics') }}
                            <i class="fas fa-chevron-down menu__chev" aria-hidden="true"></i>
                        </summary>
                        <ul class="menu__subs">
                            @forelse($navCategories as $cat)
                                <li><a href="{{ route('product-lists', $cat->slug) }}">{{ $cat->title }}</a></li>
                            @empty
                                <li><p class="menu__none">{{ __('frontend.header.topics_empty') }}</p></li>
                            @endforelse
                        </ul>
                    </details>
                </li>
                @foreach($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}" class="menu__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>
                    </li>
                @endforeach
                @auth
                    <li>
                        <a href="{{ route('user') }}" class="menu__link {{ Route::is('user') ? 'is-active' : '' }}" @if(Route::is('user')) aria-current="page" @endif>{{ __('frontend.header.nav_library') }}</a>
                    </li>
                @endauth
            </ul>
        </nav>

        <div class="menu__prefs">
            <p class="drop__label">{{ __('frontend.header.pref_language') }}</p>
            <div class="drop__chips">
                <a class="drop__chip {{ !$isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'en') }}" @if(!$isJa) aria-current="true" @endif>
                    <i class="fi fi-gb" aria-hidden="true"></i> English
                </a>
                <a class="drop__chip {{ $isJa ? 'is-active' : '' }}" href="{{ route('change.language', 'ja') }}" @if($isJa) aria-current="true" @endif>
                    <i class="fi fi-jp" aria-hidden="true"></i> 日本語
                </a>
            </div>
            <p class="drop__label">{{ __('frontend.header.pref_currency') }}</p>
            <div class="drop__chips">
                @foreach($currencyList as $cur)
                    <a class="drop__chip {{ $currency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currency == $cur->code) aria-current="true" @endif>
                        {{ Helper::getCurrencySymbol($cur->code) }} <span class="num">{{ $cur->code }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="sheet__foot">
        @auth
            <a href="{{ route('user') }}" class="btn btn--primary btn--block">{{ __('frontend.header.acct_home') }}</a>
            <a href="{{ route('user.logout') }}" class="btn btn--secondary btn--block">{{ __('frontend.header.acct_logout') }}</a>
        @else
            <a href="{{ route('register.form') }}" class="btn btn--primary btn--block">{{ __('frontend.header.acct_join') }}</a>
            <a href="{{ route('login.form') }}" class="btn btn--secondary btn--block">{{ __('frontend.header.acct_login') }}</a>
        @endauth
    </div>
</div>

<aside class="sheet sheet--cart" id="sheet-cart" role="dialog" aria-modal="true" aria-labelledby="sheet-cart-title" data-sheet="cart">
    <div class="sheet__top">
        <h2 class="sheet__title" id="sheet-cart-title">
            {{ __('frontend.header.cart_heading') }}
            @if($cartQty)
                <span class="sheet__qty num">{{ $cartQty }}</span>
            @endif
        </h2>
        <button type="button" class="sheet__close" aria-label="{{ __('frontend.header.cart_hide') }}" data-sheet-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="sheet__body">
        @if(Helper::cartCount())
            <ul class="bag__list">
                @foreach(Helper::getAllProductFromCart() as $line)
                    @php
                        $isCredits = !$line->product || $line->product_id >= 1000;
                        $lineTitle = __('frontend.header.cart_pack');
                        $linePhoto = null;
                        $lineLevel = null;

                        if($line->product && $line->product_id < 1000) {
                            $linePhoto = explode(',', $line->product->photo)[0];
                            $lineTitle = $line->product->title;

                            $level = \App\Models\ProductLevel::where('course_id', $line->product_id)
                                         ->where('price_in_points', $line->points)
                                         ->first();
                            $levelKey  = $level ? 'frontend.header.level_names.' . strtolower($level->skill_level) : null;
                            $lineLevel = $level ? (Lang::has($levelKey) ? __($levelKey) : ucfirst($level->skill_level)) : null;
                        }
                    @endphp

                    <li class="bag__item">
                        @if($isCredits)
                            <span class="bag__img bag__img--credits" aria-hidden="true"><i class="fas fa-coins"></i></span>
                        @else
                            <span class="bag__img"><img src="{{ asset($linePhoto) }}" alt="" loading="lazy"></span>
                        @endif

                        <div class="bag__info">
                            @if($lineLevel)
                                <span class="badge">{{ $lineLevel }}</span>
                            @endif
                            <p class="bag__name">{{ $lineTitle }}</p>
                            <p class="bag__meta">
                                <span class="num">{{ $line->quantity }}</span> ×
                                <span class="num">{{ number_format($line->points) }}</span> {{ __('frontend.header.unit_credits') }}
                            </p>
                            @if($isCredits)
                                <p class="bag__price num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($line['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            @endif
                        </div>

                        <a href="{{ route('cart-delete', $line->id) }}" class="bag__remove" aria-label="{{ __('frontend.header.cart_drop') }}">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="bag__empty">
                <span class="bag__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <p class="bag__empty-text">{{ __('frontend.header.cart_blank') }}</p>
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    {{ __('frontend.header.cart_browse') }}
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
        <div class="sheet__foot bag__foot">
            <dl class="bag__sum">
                <div class="bag__row">
                    <dt>{{ __('frontend.header.cart_sum') }}</dt>
                    @if($hasCredits && !$hasCourses)
                        <dd class="bag__total num">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</dd>
                    @else
                        <dd class="bag__total"><span class="num">{{ number_format($totalPoints) }}</span> <small>{{ __('frontend.header.unit_credits') }}</small></dd>
                    @endif
                </div>

                @if($hasCourses && Auth::check())
                    <div class="bag__row bag__row--muted">
                        <dt>{{ __('frontend.header.cart_wallet') }}</dt>
                        <dd><span class="num">{{ number_format($balance) }}</span> {{ __('frontend.header.unit_credits') }}</dd>
                    </div>
                @endif
            </dl>

            @if($hasCredits && !$hasCourses)
                <a href="{{ route('checkout') }}" class="btn btn--primary btn--block">{{ __('frontend.header.cart_pay') }}</a>
                <a href="{{ route('cart') }}" class="btn btn--secondary btn--block">{{ __('frontend.header.cart_full') }}</a>
            @elseif($hasCourses && !$hasCredits)
                <a href="{{ route('coursecart') }}" class="btn btn--primary btn--block">{{ __('frontend.header.cart_full') }}</a>
            @endif
            <button type="button" class="bag__continue" data-sheet-close>{{ __('frontend.header.cart_back') }}</button>
        </div>
    @endif
</aside>

@cookieconsentview

<script>
(function () {
    'use strict';

    var body = document.body;
    var canHover = window.matchMedia('(hover: hover) and (pointer: fine)');
    var drops = Array.prototype.slice.call(document.querySelectorAll('[data-drop]'));

    function setDrop(drop, isOpen) {
        var trigger = drop.querySelector('[data-drop-trigger]');
        drop.classList.toggle('is-open', isOpen);
        if (trigger) { trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false'); }
    }

    function shutDrops(keep) {
        drops.forEach(function (drop) {
            if (drop !== keep) { setDrop(drop, false); }
        });
    }

    drops.forEach(function (drop) {
        var trigger = drop.querySelector('[data-drop-trigger]');
        var timer = null;
        if (!trigger) { return; }

        trigger.addEventListener('click', function () {
            var isOpen = !drop.classList.contains('is-open');
            shutDrops(drop);
            setDrop(drop, isOpen);
        });

        if (drop.hasAttribute('data-drop-hover')) {
            drop.addEventListener('mouseenter', function () {
                if (!canHover.matches) { return; }
                clearTimeout(timer);
                shutDrops(drop);
                setDrop(drop, true);
            });
            drop.addEventListener('mouseleave', function () {
                if (!canHover.matches) { return; }
                clearTimeout(timer);
                timer = setTimeout(function () { setDrop(drop, false); }, 180);
            });
        }

        drop.addEventListener('focusout', function (event) {
            if (event.relatedTarget && !drop.contains(event.relatedTarget)) { setDrop(drop, false); }
        });
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('[data-drop]')) { shutDrops(null); }
    });

    var veil = document.querySelector('[data-veil]');
    var sheets = {};
    document.querySelectorAll('[data-sheet]').forEach(function (sheet) {
        sheets[sheet.getAttribute('data-sheet')] = sheet;
    });
    var current = null;

    function focusables(scope) {
        return Array.prototype.filter.call(
            scope.querySelectorAll('a[href], button:not([disabled]), input, select, textarea, summary, [tabindex]:not([tabindex="-1"])'),
            function (el) { return el.offsetParent !== null; }
        );
    }

    function shutSheet() {
        if (!current) { return; }
        var sheet = current.sheet;
        var opener = current.opener;

        sheet.classList.remove('is-open');
        document.querySelectorAll('[data-sheet-open="' + sheet.getAttribute('data-sheet') + '"]').forEach(function (btn) {
            btn.setAttribute('aria-expanded', 'false');
        });
        if (veil) {
            veil.classList.remove('is-open');
            setTimeout(function () { if (!current) { veil.hidden = true; } }, 320);
        }
        body.classList.remove('is-locked');
        current = null;
        if (opener && opener.offsetParent !== null) { opener.focus(); }
    }

    function openSheet(sheet, opener) {
        shutSheet();
        shutDrops(null);

        if (veil) {
            veil.hidden = false;
            requestAnimationFrame(function () { veil.classList.add('is-open'); });
        }
        sheet.classList.add('is-open');
        document.querySelectorAll('[data-sheet-open="' + sheet.getAttribute('data-sheet') + '"]').forEach(function (btn) {
            btn.setAttribute('aria-expanded', 'true');
        });
        body.classList.add('is-locked');
        current = { sheet: sheet, opener: opener };

        var close = sheet.querySelector('[data-sheet-close]');
        if (close) { setTimeout(function () { close.focus(); }, 60); }
    }

    document.querySelectorAll('[data-sheet-open]').forEach(function (opener) {
        var sheet = sheets[opener.getAttribute('data-sheet-open')];
        if (!sheet) { return; }
        opener.addEventListener('click', function () {
            if (current && current.sheet === sheet) { shutSheet(); } else { openSheet(sheet, opener); }
        });
    });

    document.querySelectorAll('[data-sheet-close]').forEach(function (btn) {
        btn.addEventListener('click', shutSheet);
    });

    if (veil) { veil.addEventListener('click', shutSheet); }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            if (current) { shutSheet(); } else { shutDrops(null); }
            return;
        }
        if (event.key !== 'Tab' || !current) { return; }
        var items = focusables(current.sheet);
        if (!items.length) { return; }
        var first = items[0];
        var last = items[items.length - 1];
        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    });

    var bar = document.querySelector('[data-hd]');
    function onScroll() {
        if (bar) { bar.classList.toggle('is-scrolled', window.scrollY > 8); }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    var mobile = window.matchMedia('(max-width: 1199.98px)');
    function onResize() {
        shutDrops(null);
        if (current && current.sheet.getAttribute('data-sheet') === 'menu' && !mobile.matches) { shutSheet(); }
    }
    if (mobile.addEventListener) { mobile.addEventListener('change', onResize); }
}());
</script>
