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
    $logoFile     = file_exists(public_path('assets/images/logo.webp')) ? asset('assets/images/logo.webp') : null;

    $languages = [
        ['code' => 'en', 'flag' => 'fi-gb', 'short' => 'EN', 'label' => 'English', 'on' => !$isJa],
        ['code' => 'ja', 'flag' => 'fi-jp', 'short' => 'JA', 'label' => '日本語', 'on' => $isJa],
    ];
    $activeLanguage = $isJa ? $languages[1] : $languages[0];

    $navLinks = [
        ['route' => 'about-us', 'label' => __('frontend.header.about')],
        ['route' => 'contact',  'label' => __('frontend.header.contact')],
    ];
@endphp

<header class="hdr" data-hdr>
    <div class="hdr-strip">
        <div class="container hdr-strip__row">
            @if($hdMail)
                <a href="mailto:{{ $hdMail }}" class="hdr-strip__mail" aria-label="{{ __('frontend.header.mail') }}: {{ $hdMail }}">
                    <i class="far fa-envelope" aria-hidden="true"></i>
                    <span>{{ $hdMail }}</span>
                </a>
            @endif

            <div class="hdr-strip__prefs">
                <div class="pick" data-pick>
                    <button type="button" class="pick__btn" aria-expanded="false" aria-controls="pick-lang" aria-label="{{ __('frontend.header.language') }}" data-pick-btn>
                        <i class="fi {{ $activeLanguage['flag'] }} pick__flag" aria-hidden="true"></i>
                        <span>{{ $activeLanguage['short'] }}</span>
                        <i class="fas fa-chevron-down pick__chev" aria-hidden="true"></i>
                    </button>
                    <ul class="pick__menu pick__menu--end" id="pick-lang">
                        @foreach($languages as $lang)
                            <li>
                                <a href="{{ route('change.language', $lang['code']) }}" class="pick__opt {{ $lang['on'] ? 'is-active' : '' }}" @if($lang['on']) aria-current="true" @endif>
                                    <i class="fi {{ $lang['flag'] }} pick__flag" aria-hidden="true"></i>
                                    <span>{{ $lang['label'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <span class="hdr-strip__sep" aria-hidden="true"></span>

                <div class="pick" data-pick>
                    <button type="button" class="pick__btn" aria-expanded="false" aria-controls="pick-cur" aria-label="{{ __('frontend.header.currency') }}" data-pick-btn>
                        <span class="pick__sym" aria-hidden="true">{{ Helper::getCurrencySymbol($currency) }}</span>
                        <span>{{ $currency }}</span>
                        <i class="fas fa-chevron-down pick__chev" aria-hidden="true"></i>
                    </button>
                    <ul class="pick__menu pick__menu--end" id="pick-cur">
                        @foreach($currencyList as $cur)
                            <li>
                                <a href="{{ route('change.currency', $cur->code) }}" class="pick__opt {{ $currency == $cur->code ? 'is-active' : '' }}" @if($currency == $cur->code) aria-current="true" @endif>
                                    <span class="pick__sym" aria-hidden="true">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                                    <span>{{ $cur->code }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="hdr-bar">
        <div class="container hdr-bar__row">
            <a href="{{ route('home') }}" class="hdr-logo">
                @if($logoFile)
                    <img src="{{ $logoFile }}" alt="{{ $siteName }}" width="716" height="210">
                @else
                    <span>{{ $siteName }}</span>
                @endif
            </a>

            <div class="hdr-bar__mid">
                <nav class="hdr-nav" aria-label="{{ __('frontend.header.menu_label') }}">
                    <ul class="hdr-nav__list">
                        <li>
                            <a href="{{ route('home') }}" class="hdr-link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>{{ __('frontend.header.home') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('product-lists') }}" class="hdr-link {{ Route::is('product-lists') && !$activeSlug ? 'is-active' : '' }}" @if(Route::is('product-lists') && !$activeSlug) aria-current="page" @endif>{{ __('frontend.header.materials') }}</a>
                        </li>
                        @if($navCats->isNotEmpty())
                            <li class="pick" data-pick data-pick-hover>
                                <button type="button" class="hdr-link {{ $activeSlug ? 'is-active' : '' }}" aria-expanded="false" aria-controls="pick-cats" data-pick-btn>
                                    {{ __('frontend.header.categories') }}
                                    <i class="fas fa-chevron-down pick__chev" aria-hidden="true"></i>
                                </button>
                                <ul class="pick__menu pick__menu--cats" id="pick-cats">
                                    @foreach($navCats as $cat)
                                        <li>
                                            <a href="{{ route('product-lists', $cat->slug) }}" class="pick__cat {{ $activeSlug === $cat->slug ? 'is-active' : '' }}">
                                                <span>{{ $cat->title }}</span>
                                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                            </a>
                                            @if($cat->child_cat && $cat->child_cat->count())
                                                <ul class="pick__subs">
                                                    @foreach($cat->child_cat as $sub)
                                                        <li><a href="{{ route('product-lists', $sub->slug) }}" class="pick__sub {{ $activeSlug === $sub->slug ? 'is-active' : '' }}">{{ $sub->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        @foreach($navLinks as $link)
                            <li>
                                <a href="{{ route($link['route']) }}" class="hdr-link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

            <div class="hdr-bar__end">
                @auth
                    <a href="{{ route('points.topup') }}" class="hdr-credits" title="{{ __('frontend.header.buy_credits') }}">
                        <i class="fas fa-coins" aria-hidden="true"></i>
                        <span>{{ number_format($balance) }}</span>
                        <span class="vh">{{ __('frontend.header.credits') }}</span>
                    </a>

                    <div class="pick hdr-acct" data-pick data-pick-hover>
                        <button type="button" class="hdr-avatar" aria-expanded="false" aria-controls="pick-acct" aria-label="{{ __('frontend.header.account_menu') }}" data-pick-btn>{{ $userInitial }}</button>
                        <div class="pick__menu pick__menu--end pick__menu--acct" id="pick-acct">
                            <p class="pick__who">
                                <span>{{ __('frontend.header.signed_in') }}</span>
                                <strong>{{ $userName }}</strong>
                            </p>
                            <a href="{{ route('user') }}" class="pick__opt"><i class="far fa-user" aria-hidden="true"></i><span>{{ __('frontend.header.account') }}</span></a>
                            <a href="{{ route('user') }}" class="pick__opt"><i class="fas fa-book-open" aria-hidden="true"></i><span>{{ __('frontend.header.library') }}</span></a>
                            <a href="{{ route('points.topup') }}" class="pick__opt"><i class="fas fa-coins" aria-hidden="true"></i><span>{{ __('frontend.header.buy_credits') }}</span></a>
                            <a href="{{ route('user.logout') }}" class="pick__opt pick__opt--out"><i class="fas fa-sign-out-alt" aria-hidden="true"></i><span>{{ __('frontend.header.logout') }}</span></a>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login.form') }}" class="hdr-login">{{ __('frontend.header.login') }}</a>
                    <a href="{{ route('register.form') }}" class="btn btn--ghost hdr-join">{{ __('frontend.header.register') }}</a>
                @endguest

                <button type="button" class="hdr-cart" aria-expanded="false" aria-controls="sheet-cart" data-sheet-open="cart">
                    <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                    @if($cartQty)
                        <span class="hdr-cart__count" aria-hidden="true">{{ $cartQty }}</span>
                    @endif
                    <span class="vh">{{ __('frontend.header.open_cart') }}</span>
                </button>

                <button type="button" class="hdr-burger" aria-expanded="false" aria-controls="sheet-menu" aria-label="{{ __('frontend.header.open_menu') }}" data-sheet-open="menu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </button>
            </div>
        </div>
        <span class="hdr-bar__progress" aria-hidden="true"></span>
    </div>
</header>

<div class="hdr-scrim" data-scrim hidden></div>

<div class="menu-sheet" id="sheet-menu" role="dialog" aria-modal="true" aria-label="{{ __('frontend.header.menu') }}" data-sheet="menu">
    <div class="menu-sheet__top">
        <a href="{{ route('home') }}" class="hdr-logo">
            @if($logoFile)
                <img src="{{ $logoFile }}" alt="{{ $siteName }}" width="716" height="210">
            @else
                <span>{{ $siteName }}</span>
            @endif
        </a>
        <button type="button" class="sheet-close" aria-label="{{ __('frontend.header.close_menu') }}" data-sheet-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <nav class="menu-sheet__nav" aria-label="{{ __('frontend.header.mobile_label') }}">
        <ul class="menu-sheet__list">
            <li style="--i: 0"><a href="{{ route('home') }}" class="menu-sheet__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>{{ __('frontend.header.home') }}</a></li>
            <li style="--i: 1"><a href="{{ route('product-lists') }}" class="menu-sheet__link {{ Route::is('product-lists') && !$activeSlug ? 'is-active' : '' }}">{{ __('frontend.header.materials') }}</a></li>
            @if($navCats->isNotEmpty())
                <li style="--i: 2">
                    <details class="menu-sheet__group" @if($activeSlug) open @endif>
                        <summary class="menu-sheet__link">
                            {{ __('frontend.header.categories') }}
                            <i class="fas fa-chevron-down" aria-hidden="true"></i>
                        </summary>
                        <ul class="menu-sheet__cats">
                            @foreach($navCats as $cat)
                                <li><a href="{{ route('product-lists', $cat->slug) }}" class="{{ $activeSlug === $cat->slug ? 'is-active' : '' }}">{{ $cat->title }}</a></li>
                            @endforeach
                        </ul>
                    </details>
                </li>
            @endif
            @foreach($navLinks as $link)
                <li style="--i: {{ $loop->index + 3 }}"><a href="{{ route($link['route']) }}" class="menu-sheet__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a></li>
            @endforeach
            @auth
                <li style="--i: {{ count($navLinks) + 3 }}"><a href="{{ route('user') }}" class="menu-sheet__link {{ Route::is('user') ? 'is-active' : '' }}">{{ __('frontend.header.library') }}</a></li>
            @endauth
        </ul>
    </nav>

    <div class="menu-sheet__foot">
        @auth
            <a href="{{ route('points.topup') }}" class="btn btn--ghost btn--block">
                <i class="fas fa-coins" aria-hidden="true"></i>{{ number_format($balance) }} {{ __('frontend.header.credits') }}
            </a>
            <a href="{{ route('user.logout') }}" class="menu-sheet__out">{{ __('frontend.header.logout') }}</a>
        @else
            <a href="{{ route('register.form') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.register') }}</a>
            <a href="{{ route('login.form') }}" class="menu-sheet__out">{{ __('frontend.header.login') }}</a>
        @endauth
    </div>
</div>

<aside class="cart-sheet" id="sheet-cart" role="dialog" aria-modal="true" aria-labelledby="cart-sheet-title" data-sheet="cart">
    <div class="cart-sheet__head">
        <h2 class="cart-sheet__title" id="cart-sheet-title">
            {{ __('frontend.header.cart') }}
            <span class="cart-sheet__qty">{{ $cartQty }}</span>
        </h2>
        <button type="button" class="sheet-close sheet-close--light" aria-label="{{ __('frontend.header.close_cart') }}" data-sheet-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="cart-sheet__body">
        @if(Helper::cartCount())
            <ul class="cart-lines">
                @foreach(Helper::getAllProductFromCart() as $line)
                    @php
                        $isCredits = !$line->product || $line->product_id >= 1000;
                        $lineTitle = __('frontend.header.package');
                        $linePhoto = null;
                        $lineLevel = null;

                        if($line->product && $line->product_id < 1000) {
                            $linePhoto = trim(explode(',', $line->product->photo)[0]);
                            $linePhoto = $linePhoto !== '' && file_exists(public_path(ltrim($linePhoto, '/'))) ? $linePhoto : null;
                            $lineTitle = $line->product->title;

                            $level = \App\Models\ProductLevel::where('course_id', $line->product_id)
                                         ->where('price_in_points', $line->points)
                                         ->first();
                            $levelName = $level ? strtolower($level->skill_level) : null;
                            $levelKey  = $level && in_array($levelName, ['beginner', 'intermediate', 'advanced', 'expert'], true) ? 'frontend.header.' . $levelName : null;
                            $lineLevel = $level ? ($levelKey && Lang::has($levelKey) ? __($levelKey) : ucfirst($level->skill_level)) : null;
                        }
                    @endphp

                    <li class="cart-line">
                        <span class="cart-line__thumb {{ $isCredits || !$linePhoto ? 'cart-line__thumb--plain' : '' }}" aria-hidden="true">
                            @if($isCredits)
                                <i class="fas fa-coins"></i>
                            @elseif($linePhoto)
                                <img src="{{ asset($linePhoto) }}" alt="" loading="lazy">
                            @else
                                <i class="fas fa-book-open"></i>
                            @endif
                        </span>

                        <div class="cart-line__info">
                            <p class="cart-line__name">{{ $lineTitle }}</p>
                            <p class="cart-line__meta">
                                @if($lineLevel)
                                    <span class="tag">{{ $lineLevel }}</span>
                                @endif
                                <span>{{ $line->quantity }} × {{ number_format($line->points) }} {{ __('frontend.header.credits') }}</span>
                            </p>
                            @if($isCredits)
                                <p class="cart-line__price">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($line['price'], session('currency')=='JPY' ? 0 : 2) }}</p>
                            @endif
                        </div>

                        <a href="{{ route('cart-delete', $line->id) }}" class="cart-line__drop" aria-label="{{ __('frontend.header.remove') }}">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="cart-empty">
                <span class="cart-empty__icon" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                <p class="cart-empty__title">{{ __('frontend.header.empty_title') }}</p>
                <p class="cart-empty__text">{{ __('frontend.header.empty_text') }}</p>
                <a href="{{ route('product-lists') }}" class="btn btn--primary">{{ __('frontend.header.browse') }}</a>
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
        <div class="cart-sheet__foot">
            @if($hasCourses && Auth::check())
                <p class="cart-sheet__row">
                    <span>{{ __('frontend.header.balance') }}:</span>
                    <span>{{ number_format($balance) }} {{ __('frontend.header.credits') }}</span>
                </p>
            @endif
            <p class="cart-sheet__row cart-sheet__row--total">
                <span>{{ __('frontend.header.total') }}:</span>
                @if($hasCredits && !$hasCourses)
                    <strong>{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</strong>
                @else
                    <strong>{{ number_format($totalPoints) }} <small>{{ __('frontend.header.credits') }}</small></strong>
                @endif
            </p>

            @if($hasCredits && !$hasCourses)
                <a href="{{ route('checkout') }}" class="btn btn--primary btn--block">{{ __('frontend.header.checkout') }}</a>
                <a href="{{ route('cart') }}" class="btn btn--dark btn--block">{{ __('frontend.header.view_cart') }}</a>
            @elseif($hasCourses && !$hasCredits)
                <a href="{{ route('coursecart') }}" class="btn btn--primary btn--block">{{ __('frontend.header.view_cart') }}</a>
            @endif
            <button type="button" class="cart-sheet__back" data-sheet-close>{{ __('frontend.header.keep_browsing') }}</button>
        </div>
    @endif
</aside>

@cookieconsentview

<script>
(function () {
    'use strict';

    var root = document.documentElement;
    var canHover = window.matchMedia('(hover: hover) and (pointer: fine)');
    var picks = Array.prototype.slice.call(document.querySelectorAll('[data-pick]'));

    function setPick(pick, open) {
        var btn = pick.querySelector('[data-pick-btn]');
        pick.classList.toggle('is-open', open);
        if (btn) { btn.setAttribute('aria-expanded', open ? 'true' : 'false'); }
    }

    function closePicks(keep) {
        picks.forEach(function (pick) { if (pick !== keep) { setPick(pick, false); } });
    }

    picks.forEach(function (pick) {
        var btn = pick.querySelector('[data-pick-btn]');
        var timer = null;
        if (!btn) { return; }

        btn.addEventListener('click', function () {
            var open = !pick.classList.contains('is-open');
            closePicks(pick);
            setPick(pick, open);
        });

        if (pick.hasAttribute('data-pick-hover')) {
            pick.addEventListener('mouseenter', function () {
                if (!canHover.matches) { return; }
                clearTimeout(timer);
                closePicks(pick);
                setPick(pick, true);
            });
            pick.addEventListener('mouseleave', function () {
                if (!canHover.matches) { return; }
                clearTimeout(timer);
                timer = setTimeout(function () { setPick(pick, false); }, 180);
            });
        }

        pick.addEventListener('focusout', function (event) {
            if (event.relatedTarget && !pick.contains(event.relatedTarget)) { setPick(pick, false); }
        });
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('[data-pick]')) { closePicks(null); }
    });

    var scrim = document.querySelector('[data-scrim]');
    var sheets = {};
    document.querySelectorAll('[data-sheet]').forEach(function (sheet) {
        sheets[sheet.getAttribute('data-sheet')] = sheet;
    });
    var active = null;

    function focusables(scope) {
        return Array.prototype.filter.call(
            scope.querySelectorAll('a[href], button:not([disabled]), input, select, textarea, summary, [tabindex]:not([tabindex="-1"])'),
            function (el) { return el.offsetParent !== null; }
        );
    }

    function markOpeners(sheet, state) {
        document.querySelectorAll('[data-sheet-open="' + sheet.getAttribute('data-sheet') + '"]').forEach(function (btn) {
            btn.setAttribute('aria-expanded', state);
        });
    }

    function closeSheet() {
        if (!active) { return; }
        var sheet = active.sheet;
        var opener = active.opener;

        sheet.classList.remove('is-open');
        markOpeners(sheet, 'false');
        if (scrim) {
            scrim.classList.remove('is-open');
            setTimeout(function () { if (!active) { scrim.hidden = true; } }, 400);
        }
        root.classList.remove('has-sheet');
        active = null;
        if (opener && opener.offsetParent !== null) { opener.focus(); }
    }

    function openSheet(sheet, opener) {
        closeSheet();
        closePicks(null);

        if (scrim && sheet.getAttribute('data-sheet') === 'cart') {
            scrim.hidden = false;
            requestAnimationFrame(function () { scrim.classList.add('is-open'); });
        }
        sheet.classList.add('is-open');
        markOpeners(sheet, 'true');
        root.classList.add('has-sheet');
        active = { sheet: sheet, opener: opener };

        var close = sheet.querySelector('[data-sheet-close]');
        if (close) { setTimeout(function () { close.focus(); }, 90); }
    }

    document.querySelectorAll('[data-sheet-open]').forEach(function (opener) {
        var sheet = sheets[opener.getAttribute('data-sheet-open')];
        if (!sheet) { return; }
        opener.addEventListener('click', function () {
            if (active && active.sheet === sheet) { closeSheet(); } else { openSheet(sheet, opener); }
        });
    });

    document.querySelectorAll('[data-sheet-close]').forEach(function (btn) {
        btn.addEventListener('click', closeSheet);
    });

    if (scrim) { scrim.addEventListener('click', closeSheet); }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            if (active) { closeSheet(); } else { closePicks(null); }
            return;
        }
        if (event.key !== 'Tab' || !active) { return; }
        var items = focusables(active.sheet);
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

    var hdr = document.querySelector('[data-hdr]');
    var ticking = false;
    function onScroll() {
        ticking = false;
        if (!hdr) { return; }
        var max = document.documentElement.scrollHeight - window.innerHeight;
        hdr.classList.toggle('is-scrolled', window.scrollY > 40);
        hdr.style.setProperty('--hdr-progress', max > 0 ? Math.min(1, window.scrollY / max) : 0);
    }
    window.addEventListener('scroll', function () {
        if (!ticking) { ticking = true; requestAnimationFrame(onScroll); }
    }, { passive: true });
    onScroll();

    var wide = window.matchMedia('(min-width: 1100px)');
    function onResize() {
        closePicks(null);
        if (active && active.sheet.getAttribute('data-sheet') === 'menu' && wide.matches) { closeSheet(); }
    }
    if (wide.addEventListener) { wide.addEventListener('change', onResize); }
}());
</script>
