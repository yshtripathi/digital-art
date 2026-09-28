@php
    $currency        = session('currency', 'USD');
    $currencyList    = Helper::CurrenciesList();
    $isJa            = session('app_locale') == 'ja' || app()->getLocale() == 'ja';
    $siteName        = __('frontend.head.site');
    $cartQty         = Helper::totalCartQuantity();
    $balance         = Auth::check() ? (Auth::user()->points_balance ?? 0) : 0;
    $userName        = Auth::check() ? Auth::user()->name : '';
    $userInitial     = Auth::check() ? mb_strtoupper(mb_substr($userName, 0, 1)) : '';
    $hdMail          = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');

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

<header class="hd" data-hd>
    <div class="hd__top">
        <div class="hd__top-in">
            <div class="hd__contact">
                @if($hdMail)
                    <a href="mailto:{{ $hdMail }}" class="hd__mail">
                        <i class="far fa-envelope" aria-hidden="true"></i>
                        <span>{{ $hdMail }}</span>
                    </a>
                @endif
            </div>

            <div class="hd__utils">
                <div class="pick" data-drop>
                    <button type="button" class="pick__field" aria-expanded="false" aria-controls="pick-lang" data-drop-trigger>
                        <span class="pick__label">{{ __('frontend.header.pref_language') }}</span>
                        <span class="pick__value">
                            <i class="fi {{ $activeLanguage['flag'] }}" aria-hidden="true"></i>
                            {{ $activeLanguage['label'] }}
                        </span>
                        <i class="fas fa-chevron-down pick__chev" aria-hidden="true"></i>
                    </button>
                    <ul class="pick__menu" id="pick-lang">
                        @foreach($languages as $lang)
                            <li style="--i: {{ $loop->index }}">
                                <a class="pick__opt {{ $lang['on'] ? 'is-active' : '' }}" href="{{ route('change.language', $lang['code']) }}" @if($lang['on']) aria-current="true" @endif>
                                    <i class="fi {{ $lang['flag'] }}" aria-hidden="true"></i>
                                    <span>{{ $lang['label'] }}</span>
                                    <span class="pick__code">{{ $lang['short'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="pick" data-drop>
                    <button type="button" class="pick__field" aria-expanded="false" aria-controls="pick-cur" data-drop-trigger>
                        <span class="pick__label">{{ __('frontend.header.pref_currency') }}</span>
                        <span class="pick__value">
                            <span class="pick__sym">{{ Helper::getCurrencySymbol($currency) }}</span>
                            {{ $currency }}
                        </span>
                        <i class="fas fa-chevron-down pick__chev" aria-hidden="true"></i>
                    </button>
                    <ul class="pick__menu" id="pick-cur">
                        @foreach($currencyList as $cur)
                            <li style="--i: {{ $loop->index }}">
                                <a class="pick__opt {{ $currency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currency == $cur->code) aria-current="true" @endif>
                                    <span class="pick__sym">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                                    <span>{{ $cur->code }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <span class="hd__rule" aria-hidden="true"></span>

                @guest
                    <a href="{{ route('login.form') }}" class="hd__auth">
                        <i class="far fa-user" aria-hidden="true"></i>
                        {{ __('frontend.header.acct_login') }}
                    </a>
                    <a href="{{ route('register.form') }}" class="hd__auth hd__auth--join">{{ __('frontend.header.acct_join') }}</a>
                @endguest

                @auth
                    <a href="{{ route('user') }}" class="hd__auth">
                        <span class="hd__initial" aria-hidden="true">{{ $userInitial }}</span>
                        {{ __('frontend.header.acct_home') }}
                    </a>
                    <a href="{{ route('user.logout') }}" class="hd__auth hd__auth--out">{{ __('frontend.header.acct_logout') }}</a>
                @endauth
            </div>
        </div>
    </div>

    <div class="hd__main">
        <a href="{{ route('home') }}" class="hd__brand">
            <img src="{{ asset('assets/images/logo.webp') }}?v={{ filemtime(public_path('assets/images/logo.webp')) }}" alt="{{ $siteName }}" width="998" height="240">
        </a>

        <nav class="hd__nav" aria-label="{{ __('frontend.header.nav_main') }}">
            <ul class="hd__links">
                <li>
                    <a href="{{ route('home') }}" class="hd__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>{{ __('frontend.header.nav_home') }}</a>
                </li>
                <li>
                    <a href="{{ route('product-lists') }}" class="hd__link {{ Route::is('product-lists') && !request()->route('slug') ? 'is-active' : '' }}">{{ __('frontend.header.nav_materials') }}</a>
                </li>
                @foreach($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}" class="hd__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>
                    </li>
                @endforeach
                @auth
                    <li>
                        <a href="{{ route('user') }}" class="hd__link {{ Route::is('user') ? 'is-active' : '' }}" @if(Route::is('user')) aria-current="page" @endif>{{ __('frontend.header.nav_library') }}</a>
                    </li>
                @endauth
            </ul>
        </nav>

        <div class="hd__actions">
            @auth
                <a href="{{ route('points.topup') }}" class="hd__credits" title="{{ __('frontend.header.acct_topup') }}">
                    <i class="fas fa-wallet" aria-hidden="true"></i>
                    <span>{{ number_format($balance) }}</span>
                    <span class="vh">{{ __('frontend.header.unit_credits') }}</span>
                </a>
            @endauth

            <button type="button" class="hd__cart" aria-expanded="false" aria-controls="sheet-cart" data-sheet-open="cart">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                <span class="hd__cart-label">{{ __('frontend.header.cart_short') }}</span>
                <span class="hd__count {{ $cartQty ? '' : 'is-empty' }}" aria-hidden="true">{{ $cartQty }}</span>
                <span class="vh">{{ __('frontend.header.cart_show') }}</span>
            </button>

            <button type="button" class="hd__burger" aria-expanded="false" aria-controls="sheet-menu" aria-label="{{ __('frontend.header.menu_open') }}" data-sheet-open="menu">
                <span></span><span></span><span></span>
            </button>
        </div>

        <span class="hd__progress" aria-hidden="true"></span>
    </div>
</header>

<div class="veil" data-veil hidden></div>

<div class="sheet sheet--menu" id="sheet-menu" role="dialog" aria-modal="true" aria-labelledby="sheet-menu-title" data-sheet="menu">
    <div class="sheet__top">
        <p class="sheet__title" id="sheet-menu-title">{{ __('frontend.header.menu_heading') }}</p>
        <button type="button" class="sheet__close" aria-label="{{ __('frontend.header.menu_close') }}" data-sheet-close>
            <span></span><span></span>
        </button>
    </div>

    <div class="sheet__body">
        @auth
            <a href="{{ route('points.topup') }}" class="menu__user">
                <span class="hd__initial hd__initial--lg" aria-hidden="true">{{ $userInitial }}</span>
                <span>
                    <span class="menu__name">{{ $userName }}</span>
                    <span class="menu__credits"><i class="fas fa-wallet" aria-hidden="true"></i> {{ number_format($balance) }} {{ __('frontend.header.unit_credits') }}</span>
                </span>
            </a>
        @endauth

        <nav aria-label="{{ __('frontend.header.nav_mobile') }}">
            <ul class="menu__list">
                <li style="--i: 0">
                    <a href="{{ route('home') }}" class="menu__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>{{ __('frontend.header.nav_home') }}</a>
                </li>
                <li style="--i: 1">
                    <a href="{{ route('product-lists') }}" class="menu__link {{ Route::is('product-lists') && !request()->route('slug') ? 'is-active' : '' }}">{{ __('frontend.header.nav_materials') }}</a>
                </li>
                @foreach($navLinks as $link)
                    <li style="--i: {{ $loop->index + 2 }}">
                        <a href="{{ route($link['route']) }}" class="menu__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>
                    </li>
                @endforeach
                @auth
                    <li style="--i: {{ count($navLinks) + 2 }}">
                        <a href="{{ route('user') }}" class="menu__link {{ Route::is('user') ? 'is-active' : '' }}" @if(Route::is('user')) aria-current="page" @endif>{{ __('frontend.header.nav_library') }}</a>
                    </li>
                @endauth
            </ul>
        </nav>

        <div class="menu__prefs">
            <p class="menu__label">{{ __('frontend.header.pref_language') }}</p>
            <div class="menu__chips">
                @foreach($languages as $lang)
                    <a class="menu__chip {{ $lang['on'] ? 'is-active' : '' }}" href="{{ route('change.language', $lang['code']) }}" @if($lang['on']) aria-current="true" @endif>
                        <i class="fi {{ $lang['flag'] }}" aria-hidden="true"></i> {{ $lang['label'] }}
                    </a>
                @endforeach
            </div>
            <p class="menu__label">{{ __('frontend.header.pref_currency') }}</p>
            <div class="menu__chips">
                @foreach($currencyList as $cur)
                    <a class="menu__chip {{ $currency == $cur->code ? 'is-active' : '' }}" href="{{ route('change.currency', $cur->code) }}" @if($currency == $cur->code) aria-current="true" @endif>
                        {{ Helper::getCurrencySymbol($cur->code) }} {{ $cur->code }}
                    </a>
                @endforeach
            </div>
        </div>

        @if($hdMail)
            <a href="mailto:{{ $hdMail }}" class="menu__mail">
                <i class="far fa-envelope" aria-hidden="true"></i>
                {{ $hdMail }}
            </a>
        @endif
    </div>

    <div class="sheet__foot">
        @auth
            <a href="{{ route('user') }}" class="btn btn--block">{{ __('frontend.header.acct_home') }}</a>
            <a href="{{ route('user.logout') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.acct_logout') }}</a>
        @else
            <a href="{{ route('register.form') }}" class="btn btn--block">{{ __('frontend.header.acct_join') }}</a>
            <a href="{{ route('login.form') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.acct_login') }}</a>
        @endauth
    </div>
</div>

<aside class="sheet sheet--cart" id="sheet-cart" role="dialog" aria-modal="true" aria-labelledby="sheet-cart-title" data-sheet="cart">
    <div class="sheet__top">
        <div>
            <p class="sheet__eyebrow">{{ $siteName }}</p>
            <h2 class="sheet__title" id="sheet-cart-title">
                {{ __('frontend.header.cart_heading') }}
                <span class="sheet__qty">{{ $cartQty }}</span>
            </h2>
        </div>
        <button type="button" class="sheet__close" aria-label="{{ __('frontend.header.cart_hide') }}" data-sheet-close>
            <span></span><span></span>
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
                            $levelName = $level ? strtolower($level->skill_level) : null;
                            $levelKey  = $level ? 'frontend.header.level_names.' . $levelName : null;
                            $lineLevel = $level ? (Lang::has($levelKey) ? __($levelKey) : ucfirst($level->skill_level)) : null;
                        }
                    @endphp

                    <li class="bag__item" style="--i: {{ $loop->index }}">
                        @if($isCredits)
                            <span class="bag__img bag__img--credits" aria-hidden="true"><i class="fas fa-wallet"></i></span>
                        @else
                            <span class="bag__img"><img src="{{ asset($linePhoto) }}" alt="" loading="lazy"></span>
                        @endif

                        <div class="bag__info">
                            @if($lineLevel)
                                <span class="bag__level">{{ $lineLevel }}</span>
                            @endif
                            <p class="bag__name">{{ $lineTitle }}</p>
                            <p class="bag__meta">
                                {{ $line->quantity }} × {{ number_format($line->points) }} {{ __('frontend.header.unit_credits') }}
                            </p>
                            @if($isCredits)
                                <p class="bag__price">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($line['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            @endif
                        </div>

                        <a href="{{ route('cart-delete', $line->id) }}" class="bag__remove" aria-label="{{ __('frontend.header.cart_drop') }}">
                            <span></span><span></span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="bag__empty">
                <span class="bag__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <p class="bag__head">{{ __('frontend.header.bag_title') }}</p>
                <p class="bag__text">{{ __('frontend.header.bag_empty') }}</p>
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
        <div class="sheet__foot">
            <dl class="bag__sum">
                @if($hasCourses && Auth::check())
                    <div class="bag__row bag__row--muted">
                        <dt>{{ __('frontend.header.cart_wallet') }}:</dt>
                        <dd>{{ number_format($balance) }} {{ __('frontend.header.unit_credits') }}</dd>
                    </div>
                @endif
                <div class="bag__row">
                    <dt>{{ __('frontend.header.cart_sum') }}:</dt>
                    @if($hasCredits && !$hasCourses)
                        <dd class="bag__total">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</dd>
                    @else
                        <dd class="bag__total">{{ number_format($totalPoints) }} <small>{{ __('frontend.header.unit_credits') }}</small></dd>
                    @endif
                </div>
            </dl>

            @if($hasCredits && !$hasCourses)
                <a href="{{ route('checkout') }}" class="btn btn--block">{{ __('frontend.header.cart_pay') }}</a>
                <a href="{{ route('cart') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.cart_full') }}</a>
            @elseif($hasCourses && !$hasCredits)
                <a href="{{ route('coursecart') }}" class="btn btn--block">{{ __('frontend.header.cart_full') }}</a>
            @endif
            <button type="button" class="bag__continue" data-sheet-close>{{ __('frontend.header.bag_back') }}</button>
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
            setTimeout(function () { if (!current) { veil.hidden = true; } }, 360);
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
        if (!bar) { return; }
        var y = window.scrollY;
        var room = document.documentElement.scrollHeight - window.innerHeight;
        bar.classList.toggle('is-scrolled', y > 40);
        bar.style.setProperty('--hd-progress', room > 0 ? Math.min(y / room, 1) : 0);
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
