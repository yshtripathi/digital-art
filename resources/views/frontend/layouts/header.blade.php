@php
    $currency     = session('currency', 'USD');
    $currencyList = Helper::CurrenciesList();
    $isJa         = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
    $siteName     = __('frontend.head.site');
    $cartQty      = Helper::totalCartQuantity();
    $balance      = Auth::check() ? (Auth::user()->points_balance ?? 0) : 0;
    $userName     = Auth::check() ? Auth::user()->name : '';
    $userInitial  = Auth::check() ? mb_strtoupper(mb_substr($userName, 0, 1)) : '';
    $hdMail       = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $navCats      = (isset($category) && $category instanceof \Illuminate\Support\Collection ? $category : \App\Models\Category::getAllParentWithChild());
    $activeSlug   = Route::is('product-lists') ? request()->route('slug') : null;

    $languages = [
        ['code' => 'en', 'flag' => 'fi-gb', 'short' => 'EN', 'label' => 'English', 'on' => !$isJa],
        ['code' => 'ja', 'flag' => 'fi-jp', 'short' => 'JA', 'label' => '日本語', 'on' => $isJa],
    ];
    $activeLanguage = $isJa ? $languages[1] : $languages[0];

    $navLinks = [
        ['route' => 'about-us', 'label' => __('frontend.header.nav_about')],
        ['route' => 'contact',  'label' => __('frontend.header.nav_contact')],
    ];
@endphp

<header class="mast" data-mast>
    <div class="mast__shell">
        <a href="{{ route('home') }}" class="mast__brand">
            <img src="{{ asset('assets/images/logo.webp') }}" alt="{{ $siteName }}" width="869" height="144">
        </a>

        <nav class="mast__nav" aria-label="{{ __('frontend.header.nav_main') }}">
            <ul class="mast__links">
                <li>
                    <a href="{{ route('home') }}" class="mast__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>{{ __('frontend.header.nav_home') }}</a>
                </li>
                <li>
                    <a href="{{ route('product-lists') }}" class="mast__link {{ Route::is('product-lists') && !$activeSlug ? 'is-active' : '' }}" @if(Route::is('product-lists') && !$activeSlug) aria-current="page" @endif>{{ __('frontend.header.nav_materials') }}</a>
                </li>
                @if($navCats->isNotEmpty())
                    <li class="drop drop--mega" data-drop data-drop-hover>
                        <button type="button" class="mast__link mast__link--drop {{ $activeSlug ? 'is-active' : '' }}" aria-expanded="false" aria-controls="drop-cats" data-drop-trigger>
                            {{ __('frontend.header.nav_categories') }}
                            <i class="fas fa-chevron-down mast__chev" aria-hidden="true"></i>
                        </button>
                        <div class="drop__panel mega" id="drop-cats">
                            <ul class="mega__grid">
                                @foreach($navCats as $cat)
                                    <li class="mega__item" style="--i: {{ $loop->index }}">
                                        <a href="{{ route('product-lists', $cat->slug) }}" class="mega__cat {{ $activeSlug === $cat->slug ? 'is-active' : '' }}">
                                            <span class="mega__mark" aria-hidden="true"></span>
                                            <span class="mega__text">
                                                <span class="mega__name">{{ $cat->title }}</span>
                                                @if(filled($cat->summary))
                                                    <span class="mega__sum">{{ \Illuminate\Support\Str::limit(trim(strip_tags($cat->summary)), 90) }}</span>
                                                @endif
                                            </span>
                                            <i class="fas fa-arrow-right mega__go" aria-hidden="true"></i>
                                        </a>
                                        @if($cat->child_cat && $cat->child_cat->count())
                                            <ul class="mega__subs">
                                                @foreach($cat->child_cat as $sub)
                                                    <li><a href="{{ route('product-lists', $sub->slug) }}" class="mega__sub">{{ $sub->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mega__aside">
                                <p class="mega__eyebrow">{{ __('frontend.head.topic') }}</p>
                                <p class="mega__title">{{ __('frontend.header.mega_title') }}</p>
                                <p class="mega__line">{{ __('frontend.header.mega_line') }}</p>
                                <a href="{{ route('product-lists') }}" class="btn btn--light btn--sm">
                                    {{ __('frontend.header.cart_browse') }}
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </a>
                                @if($hdMail)
                                    <a href="mailto:{{ $hdMail }}" class="mega__mail">
                                        <span>{{ __('frontend.header.mega_help') }}</span>
                                        <strong>{{ $hdMail }}</strong>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>
                @endif
                @foreach($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}" class="mast__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="mast__tools">
            <div class="drop drop--end mast__pref" data-drop data-drop-hover>
                <button type="button" class="tool tool--pref" aria-expanded="false" aria-controls="drop-prefs" aria-label="{{ __('frontend.header.pref_title') }}" data-drop-trigger>
                    <i class="fi {{ $activeLanguage['flag'] }} tool__flag" aria-hidden="true"></i>
                    <span class="tool__text">{{ $activeLanguage['short'] }}</span>
                    <span class="tool__sep" aria-hidden="true"></span>
                    <span class="tool__sym" aria-hidden="true">{{ Helper::getCurrencySymbol($currency) }}</span>
                    <span class="tool__text">{{ $currency }}</span>
                    <i class="fas fa-chevron-down mast__chev" aria-hidden="true"></i>
                </button>
                <div class="drop__panel prefs" id="drop-prefs">
                    <p class="drop__label">{{ __('frontend.header.pref_language') }}</p>
                    <ul class="prefs__langs">
                        @foreach($languages as $lang)
                            <li>
                                <a class="prefs__lang {{ $lang['on'] ? 'is-active' : '' }}" href="{{ route('change.language', $lang['code']) }}" @if($lang['on']) aria-current="true" @endif>
                                    <i class="fi {{ $lang['flag'] }}" aria-hidden="true"></i>
                                    <span>{{ $lang['label'] }}</span>
                                    <i class="fas fa-check prefs__tick" aria-hidden="true"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <p class="drop__label">{{ __('frontend.header.pref_currency') }}</p>
                    <ul class="prefs__curs">
                        @foreach($currencyList as $cur)
                            <li>
                                <a class="prefs__cur {{ $currency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currency == $cur->code) aria-current="true" @endif>
                                    <span class="prefs__sym">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                                    {{ $cur->code }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            @auth
                <a href="{{ route('points.topup') }}" class="tool tool--credits" title="{{ __('frontend.header.acct_topup') }}">
                    <i class="fas fa-coins" aria-hidden="true"></i>
                    <span class="tool__text">{{ number_format($balance) }}</span>
                    <span class="vh">{{ __('frontend.header.unit_credits') }}</span>
                </a>

                <div class="drop drop--end mast__acct" data-drop data-drop-hover>
                    <button type="button" class="tool tool--avatar" aria-expanded="false" aria-controls="drop-acct" aria-label="{{ __('frontend.header.acct_menu') }}" data-drop-trigger>
                        <span class="avatar" aria-hidden="true">{{ $userInitial }}</span>
                        <i class="fas fa-chevron-down mast__chev" aria-hidden="true"></i>
                    </button>
                    <div class="drop__panel acct" id="drop-acct">
                        <div class="acct__head">
                            <span class="avatar avatar--lg" aria-hidden="true">{{ $userInitial }}</span>
                            <span>
                                <span class="acct__hint">{{ __('frontend.header.acct_signed') }}</span>
                                <span class="acct__name">{{ $userName }}</span>
                            </span>
                        </div>
                        <ul class="acct__list">
                            <li><a href="{{ route('user') }}" class="acct__link"><i class="far fa-user" aria-hidden="true"></i>{{ __('frontend.header.acct_home') }}</a></li>
                            <li><a href="{{ route('user') }}" class="acct__link"><i class="fas fa-book-open" aria-hidden="true"></i>{{ __('frontend.header.nav_library') }}</a></li>
                            <li>
                                <a href="{{ route('points.topup') }}" class="acct__link">
                                    <i class="fas fa-coins" aria-hidden="true"></i>{{ __('frontend.header.acct_topup') }}
                                    <span class="acct__bal">{{ number_format($balance) }}</span>
                                </a>
                            </li>
                        </ul>
                        <a href="{{ route('user.logout') }}" class="acct__out"><i class="fas fa-sign-out-alt" aria-hidden="true"></i>{{ __('frontend.header.acct_logout') }}</a>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login.form') }}" class="mast__login">{{ __('frontend.header.acct_login') }}</a>
                <a href="{{ route('register.form') }}" class="btn btn--sm mast__join">{{ __('frontend.header.acct_join') }}</a>
            @endguest

            <button type="button" class="tool tool--cart" aria-expanded="false" aria-controls="drawer-cart" data-drawer-open="cart">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                <span class="tool__count {{ $cartQty ? '' : 'is-empty' }}" aria-hidden="true">{{ $cartQty }}</span>
                <span class="vh">{{ __('frontend.header.cart_show') }}</span>
            </button>

            <button type="button" class="tool tool--burger" aria-expanded="false" aria-controls="drawer-menu" aria-label="{{ __('frontend.header.menu_open') }}" data-drawer-open="menu">
                <span class="burger" aria-hidden="true"><span></span><span></span><span></span></span>
            </button>
        </div>
    </div>
</header>

<div class="veil" data-veil hidden></div>

<div class="drawer drawer--menu" id="drawer-menu" role="dialog" aria-modal="true" aria-labelledby="drawer-menu-title" data-drawer="menu">
    <div class="drawer__head">
        <p class="drawer__title" id="drawer-menu-title">{{ __('frontend.header.menu_heading') }}</p>
        <button type="button" class="drawer__close" aria-label="{{ __('frontend.header.menu_close') }}" data-drawer-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="drawer__body">
        @auth
            <a href="{{ route('user') }}" class="mnav__user">
                <span class="avatar avatar--lg" aria-hidden="true">{{ $userInitial }}</span>
                <span>
                    <span class="acct__name">{{ $userName }}</span>
                    <span class="mnav__credits"><i class="fas fa-coins" aria-hidden="true"></i> {{ number_format($balance) }} {{ __('frontend.header.unit_credits') }}</span>
                </span>
                <i class="fas fa-arrow-right mnav__go" aria-hidden="true"></i>
            </a>
        @endauth

        <nav aria-label="{{ __('frontend.header.nav_mobile') }}">
            <ul class="mnav">
                <li style="--i: 0">
                    <a href="{{ route('home') }}" class="mnav__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>
                        {{ __('frontend.header.nav_home') }}<i class="fas fa-arrow-right mnav__go" aria-hidden="true"></i>
                    </a>
                </li>
                <li style="--i: 1">
                    <a href="{{ route('product-lists') }}" class="mnav__link {{ Route::is('product-lists') && !$activeSlug ? 'is-active' : '' }}">
                        {{ __('frontend.header.nav_materials') }}<i class="fas fa-arrow-right mnav__go" aria-hidden="true"></i>
                    </a>
                </li>
                @if($navCats->isNotEmpty())
                    <li style="--i: 2">
                        <details class="mnav__group" @if($activeSlug) open @endif>
                            <summary class="mnav__link">
                                {{ __('frontend.header.nav_categories') }}<i class="fas fa-plus mnav__plus" aria-hidden="true"></i>
                            </summary>
                            <ul class="mnav__cats">
                                @foreach($navCats as $cat)
                                    <li>
                                        <a href="{{ route('product-lists', $cat->slug) }}" class="mnav__cat {{ $activeSlug === $cat->slug ? 'is-active' : '' }}">
                                            <span class="mega__mark" aria-hidden="true"></span>{{ $cat->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </details>
                    </li>
                @endif
                @foreach($navLinks as $link)
                    <li style="--i: {{ $loop->index + 3 }}">
                        <a href="{{ route($link['route']) }}" class="mnav__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>
                            {{ $link['label'] }}<i class="fas fa-arrow-right mnav__go" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
                @auth
                    <li style="--i: {{ count($navLinks) + 3 }}">
                        <a href="{{ route('user') }}" class="mnav__link {{ Route::is('user') ? 'is-active' : '' }}" @if(Route::is('user')) aria-current="page" @endif>
                            {{ __('frontend.header.nav_library') }}<i class="fas fa-arrow-right mnav__go" aria-hidden="true"></i>
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>

        <div class="mnav__prefs">
            <p class="drop__label">{{ __('frontend.header.pref_language') }}</p>
            <div class="seg">
                @foreach($languages as $lang)
                    <a class="seg__opt {{ $lang['on'] ? 'is-active' : '' }}" href="{{ route('change.language', $lang['code']) }}" @if($lang['on']) aria-current="true" @endif>
                        <i class="fi {{ $lang['flag'] }}" aria-hidden="true"></i>{{ $lang['label'] }}
                    </a>
                @endforeach
            </div>
            <p class="drop__label">{{ __('frontend.header.pref_currency') }}</p>
            <ul class="prefs__curs">
                @foreach($currencyList as $cur)
                    <li>
                        <a class="prefs__cur {{ $currency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currency == $cur->code) aria-current="true" @endif>
                            <span class="prefs__sym">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                            {{ $cur->code }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        @if($hdMail)
            <a href="mailto:{{ $hdMail }}" class="mnav__mail">
                <i class="far fa-envelope" aria-hidden="true"></i>
                <span>{{ $hdMail }}</span>
            </a>
        @endif
    </div>

    <div class="drawer__foot">
        @auth
            <a href="{{ route('points.topup') }}" class="btn btn--block">{{ __('frontend.header.acct_topup') }}</a>
            <a href="{{ route('user.logout') }}" class="btn btn--outline btn--block">{{ __('frontend.header.acct_logout') }}</a>
        @else
            <a href="{{ route('register.form') }}" class="btn btn--block">{{ __('frontend.header.acct_join') }}</a>
            <a href="{{ route('login.form') }}" class="btn btn--outline btn--block">{{ __('frontend.header.acct_login') }}</a>
        @endauth
    </div>
</div>

<aside class="drawer drawer--cart" id="drawer-cart" role="dialog" aria-modal="true" aria-labelledby="drawer-cart-title" data-drawer="cart">
    <div class="drawer__head drawer__head--band">
        <div>
            <p class="drawer__eyebrow">{{ $siteName }}</p>
            <h2 class="drawer__title" id="drawer-cart-title">
                {{ __('frontend.header.cart_heading') }}
                <span class="drawer__qty">{{ $cartQty }}</span>
            </h2>
        </div>
        <button type="button" class="drawer__close" aria-label="{{ __('frontend.header.cart_hide') }}" data-drawer-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="drawer__body">
        @if(Helper::cartCount())
            <ul class="lines">
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
                            $levelName = $level ? strtolower($level->skill_level) : null;
                            $levelKey  = $level ? 'frontend.header.level_names.' . $levelName : null;
                            $lineLevel = $level ? (Lang::has($levelKey) ? __($levelKey) : ucfirst($level->skill_level)) : null;
                        }
                    @endphp

                    <li class="line" style="--i: {{ $loop->index }}">
                        @if($isCredits)
                            <span class="line__thumb line__thumb--credits" aria-hidden="true"><i class="fas fa-coins"></i></span>
                        @else
                            <span class="line__thumb"><img src="{{ asset($linePhoto) }}" alt="" loading="lazy"></span>
                        @endif

                        <div class="line__info">
                            @if($lineLevel)
                                <span class="badge badge--neutral line__level">{{ $lineLevel }}</span>
                            @endif
                            <p class="line__name">{{ $lineTitle }}</p>
                            <p class="line__meta">{{ $line->quantity }} × {{ number_format($line->points) }} {{ __('frontend.header.unit_credits') }}</p>
                            @if($isCredits)
                                <p class="line__price">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($line['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            @endif
                        </div>

                        <a href="{{ route('cart-delete', $line->id) }}" class="line__drop" aria-label="{{ __('frontend.header.cart_drop') }}">
                            <i class="far fa-trash-alt" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="void">
                <span class="void__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <p class="void__title">{{ __('frontend.header.bag_title') }}</p>
                <p class="void__text">{{ __('frontend.header.bag_empty') }}</p>
                <a href="{{ route('product-lists') }}" class="btn">
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
        <div class="drawer__foot">
            <dl class="tally">
                @if($hasCourses && Auth::check())
                    <div class="tally__row">
                        <dt>{{ __('frontend.header.cart_wallet') }}:</dt>
                        <dd>{{ number_format($balance) }} {{ __('frontend.header.unit_credits') }}</dd>
                    </div>
                @endif
                <div class="tally__row tally__row--total">
                    <dt>{{ __('frontend.header.cart_sum') }}:</dt>
                    @if($hasCredits && !$hasCourses)
                        <dd>{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</dd>
                    @else
                        <dd>{{ number_format($totalPoints) }} <small>{{ __('frontend.header.unit_credits') }}</small></dd>
                    @endif
                </div>
            </dl>

            @if($hasCredits && !$hasCourses)
                <a href="{{ route('checkout') }}" class="btn btn--block">{{ __('frontend.header.cart_pay') }}</a>
                <a href="{{ route('cart') }}" class="btn btn--outline btn--block">{{ __('frontend.header.cart_full') }}</a>
            @elseif($hasCourses && !$hasCredits)
                <a href="{{ route('coursecart') }}" class="btn btn--block">{{ __('frontend.header.cart_full') }}</a>
            @endif
            <button type="button" class="drawer__back" data-drawer-close>
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                {{ __('frontend.header.bag_back') }}
            </button>
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
                timer = setTimeout(function () { setDrop(drop, false); }, 200);
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
    var drawers = {};
    document.querySelectorAll('[data-drawer]').forEach(function (drawer) {
        drawers[drawer.getAttribute('data-drawer')] = drawer;
    });
    var current = null;

    function focusables(scope) {
        return Array.prototype.filter.call(
            scope.querySelectorAll('a[href], button:not([disabled]), input, select, textarea, summary, [tabindex]:not([tabindex="-1"])'),
            function (el) { return el.offsetParent !== null; }
        );
    }

    function toggleOpeners(drawer, state) {
        document.querySelectorAll('[data-drawer-open="' + drawer.getAttribute('data-drawer') + '"]').forEach(function (btn) {
            btn.setAttribute('aria-expanded', state);
        });
    }

    function shutDrawer() {
        if (!current) { return; }
        var drawer = current.drawer;
        var opener = current.opener;

        drawer.classList.remove('is-open');
        toggleOpeners(drawer, 'false');
        if (veil) {
            veil.classList.remove('is-open');
            setTimeout(function () { if (!current) { veil.hidden = true; } }, 380);
        }
        body.classList.remove('is-locked');
        current = null;
        if (opener && opener.offsetParent !== null) { opener.focus(); }
    }

    function openDrawer(drawer, opener) {
        shutDrawer();
        shutDrops(null);

        if (veil) {
            veil.hidden = false;
            requestAnimationFrame(function () { veil.classList.add('is-open'); });
        }
        drawer.classList.add('is-open');
        toggleOpeners(drawer, 'true');
        body.classList.add('is-locked');
        current = { drawer: drawer, opener: opener };

        var close = drawer.querySelector('[data-drawer-close]');
        if (close) { setTimeout(function () { close.focus(); }, 80); }
    }

    document.querySelectorAll('[data-drawer-open]').forEach(function (opener) {
        var drawer = drawers[opener.getAttribute('data-drawer-open')];
        if (!drawer) { return; }
        opener.addEventListener('click', function () {
            if (current && current.drawer === drawer) { shutDrawer(); } else { openDrawer(drawer, opener); }
        });
    });

    document.querySelectorAll('[data-drawer-close]').forEach(function (btn) {
        btn.addEventListener('click', shutDrawer);
    });

    if (veil) { veil.addEventListener('click', shutDrawer); }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            if (current) { shutDrawer(); } else { shutDrops(null); }
            return;
        }
        if (event.key !== 'Tab' || !current) { return; }
        var items = focusables(current.drawer);
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

    var mast = document.querySelector('[data-mast]');
    function onScroll() {
        if (mast) { mast.classList.toggle('is-scrolled', window.scrollY > 24); }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    var compact = window.matchMedia('(max-width: 1099.98px)');
    function onResize() {
        shutDrops(null);
        if (current && current.drawer.getAttribute('data-drawer') === 'menu' && !compact.matches) { shutDrawer(); }
    }
    if (compact.addEventListener) { compact.addEventListener('change', onResize); }
}());
</script>
