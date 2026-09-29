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

    $catIcons = [
        'software-development-engineering'     => 'fa-code',
        'data-automation-ai'                   => 'fa-brain',
        'it-infrastructure-cloud-security'     => 'fa-server',
        'product-design-ux-digital-experience' => 'fa-pencil-ruler',
        'devops-agile-technology-leadership'   => 'fa-infinity',
    ];

    $catTitle = function ($cat) use ($isJa) {
        return $isJa && filled($cat->title_jp ?? null) ? $cat->title_jp : $cat->title;
    };
    $catText = function ($cat) use ($isJa) {
        $text = $isJa && filled($cat->summary_jp ?? null) ? $cat->summary_jp : ($cat->summary ?? '');
        return \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8')))), 90, '…');
    };

    $languages = [
        ['code' => 'en', 'flag' => 'fi-gb', 'short' => 'EN', 'label' => 'English', 'on' => !$isJa],
        ['code' => 'ja', 'flag' => 'fi-jp', 'short' => 'JA', 'label' => '日本語', 'on' => $isJa],
    ];
    $activeLanguage = $isJa ? $languages[1] : $languages[0];

    $curName = function ($code, $fallback = null) {
        $key = 'frontend.header.cur_' . $code;
        return Lang::has($key) ? __($key) : ($fallback ?: $code);
    };

    $navLinks = [
        ['route' => 'about-us', 'label' => __('frontend.header.about')],
        ['route' => 'contact',  'label' => __('frontend.header.contact')],
    ];
@endphp

<header class="hdr" data-hdr>
    <div class="container hdr__row">
        <a href="{{ route('home') }}" class="brand" aria-label="{{ $siteName }}">
            @if($logoFile)
                <img src="{{ $logoFile }}" alt="{{ $siteName }}" width="716" height="210" class="brand__logo">
            @else
                <span class="brand__name">{{ $siteName }}</span>
            @endif
        </a>

        <nav class="hdr__nav" aria-label="{{ __('frontend.header.menu_label') }}" data-spot-nav>
            <span class="hdr__spot" aria-hidden="true" data-spot></span>
            <ul class="hdr__list">
                <li>
                    <a href="{{ route('home') }}" class="hdr__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>{{ __('frontend.header.home') }}</a>
                </li>
                <li>
                    <a href="{{ route('product-lists') }}" class="hdr__link {{ Route::is('product-lists') && !$activeSlug ? 'is-active' : '' }}" @if(Route::is('product-lists') && !$activeSlug) aria-current="page" @endif>{{ __('frontend.header.materials') }}</a>
                </li>
                @if($navCats->isNotEmpty())
                    <li class="pick hdr__cats" data-pick data-pick-hover>
                        <button type="button" class="hdr__link {{ $activeSlug ? 'is-active' : '' }}" aria-expanded="false" aria-controls="pick-cats" data-pick-btn>
                            {{ __('frontend.header.categories') }}
                            <i class="fas fa-chevron-down pick__chev" aria-hidden="true"></i>
                        </button>
                        <div class="mega" id="pick-cats">
                            <div class="mega__grid">
                                <ul class="mega__list">
                                    @foreach($navCats as $cat)
                                        <li>
                                            <a href="{{ route('product-lists', $cat->slug) }}" class="mega__cat {{ $activeSlug === $cat->slug ? 'is-active' : '' }}" @if($activeSlug === $cat->slug) aria-current="page" @endif>
                                                <span class="mega__icon" aria-hidden="true"><i class="fas {{ $catIcons[$cat->slug] ?? 'fa-layer-group' }}"></i></span>
                                                <span class="mega__body">
                                                    <span class="mega__title">{{ $catTitle($cat) }}</span>
                                                    @if($catText($cat) !== '')
                                                        <span class="mega__text">{{ $catText($cat) }}</span>
                                                    @endif
                                                </span>
                                                <i class="fas fa-arrow-right mega__go" aria-hidden="true"></i>
                                            </a>
                                            @if($cat->child_cat && $cat->child_cat->count())
                                                <ul class="mega__subs">
                                                    @foreach($cat->child_cat as $sub)
                                                        <li><a href="{{ route('product-lists', $sub->slug) }}" class="{{ $activeSlug === $sub->slug ? 'is-active' : '' }}">{{ $catTitle($sub) }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="mega__aside">
                                    <p class="eyebrow">{{ __('frontend.header.categories') }}</p>
                                    <p class="mega__count">{{ $navCats->count() }}</p>
                                    <a href="{{ route('product-lists') }}" class="btn btn--primary btn--sm">{{ __('frontend.header.browse') }} <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                                    @if($hdMail)
                                        <a href="mailto:{{ $hdMail }}" class="mega__mail" aria-label="{{ __('frontend.header.mail') }}: {{ $hdMail }}">
                                            <i class="far fa-envelope" aria-hidden="true"></i>
                                            <span>{{ $hdMail }}</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endif
                @foreach($navLinks as $link)
                    <li>
                        <a href="{{ route($link['route']) }}" class="hdr__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="hdr__end">
            <div class="pick hdr__prefs" data-pick>
                <button type="button" class="hdr__prefs-btn" aria-expanded="false" aria-controls="pick-prefs" aria-label="{{ __('frontend.header.language') }} / {{ __('frontend.header.currency') }}" data-pick-btn>
                    <i class="fi {{ $activeLanguage['flag'] }} hdr__flag" aria-hidden="true"></i>
                    <span>{{ $activeLanguage['short'] }}</span>
                    <span class="hdr__prefs-sep" aria-hidden="true"></span>
                    <span class="hdr__cur-sym" aria-hidden="true">{{ Helper::getCurrencySymbol($currency) }}</span>
                    <span>{{ $currency }}</span>
                    <i class="fas fa-chevron-down pick__chev" aria-hidden="true"></i>
                </button>
                <div class="pick__menu pick__menu--end pick__menu--prefs" id="pick-prefs">
                    <p class="pick__label">{{ __('frontend.header.language') }}</p>
                    <div class="seg">
                        @foreach($languages as $lang)
                            <a href="{{ route('change.language', $lang['code']) }}" class="seg__opt {{ $lang['on'] ? 'is-active' : '' }}" @if($lang['on']) aria-current="true" @endif>
                                <i class="fi {{ $lang['flag'] }} seg__flag" aria-hidden="true"></i>
                                <span>{{ $lang['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                    <p class="pick__label">{{ __('frontend.header.currency') }}</p>
                    <div class="curs">
                        @foreach($currencyList as $cur)
                            <a href="{{ route('change.currency', $cur->code) }}" class="curs__opt {{ $currency == $cur->code ? 'is-active' : '' }}" @if($currency == $cur->code) aria-current="true" @endif>
                                <span class="curs__sym" aria-hidden="true">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                                <span class="curs__name">{{ $curName($cur->code, $cur->name ?? null) }}</span>
                                <span class="curs__code">{{ $cur->code }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <button type="button" class="hdr__icon hdr__cart" aria-expanded="false" aria-controls="drawer-cart" data-sheet-open="cart">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                @if($cartQty)
                    <span class="hdr__badge" aria-hidden="true">{{ $cartQty }}</span>
                @endif
                <span class="vh">{{ __('frontend.header.open_cart') }}</span>
            </button>

            @auth
                <a href="{{ route('points.topup') }}" class="hdr__credits" title="{{ __('frontend.header.buy_credits') }}">
                    <i class="fas fa-coins" aria-hidden="true"></i>
                    <span>{{ number_format($balance) }}</span>
                    <span class="vh">{{ __('frontend.header.credits') }}</span>
                </a>

                <div class="pick hdr__acct" data-pick data-pick-hover>
                    <button type="button" class="hdr__avatar" aria-expanded="false" aria-controls="pick-acct" aria-label="{{ __('frontend.header.account_menu') }}" data-pick-btn>{{ $userInitial }}</button>
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
                <div class="hdr__guest">
                    <a href="{{ route('login.form') }}" class="hdr__login">{{ __('frontend.header.login') }}</a>
                    <a href="{{ route('register.form') }}" class="btn btn--primary btn--sm hdr__join">{{ __('frontend.header.register') }}</a>
                </div>
            @endguest

            <button type="button" class="hdr__icon hdr__burger" aria-expanded="false" aria-controls="drawer-menu" aria-label="{{ __('frontend.header.open_menu') }}" data-sheet-open="menu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>
        </div>
    </div>
</header>

<div class="scrim" data-scrim hidden></div>

<div class="drawer drawer--menu" id="drawer-menu" role="dialog" aria-modal="true" aria-label="{{ __('frontend.header.menu') }}" data-sheet="menu">
    <div class="drawer__head">
        <a href="{{ route('home') }}" class="brand" aria-label="{{ $siteName }}">
            @if($logoFile)
                <img src="{{ $logoFile }}" alt="{{ $siteName }}" width="716" height="210" class="brand__logo">
            @else
                <span class="brand__name">{{ $siteName }}</span>
            @endif
        </a>
        <button type="button" class="hdr__icon" aria-label="{{ __('frontend.header.close_menu') }}" data-sheet-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="drawer__body">
        <nav aria-label="{{ __('frontend.header.mobile_label') }}">
            <ul class="mnav">
                <li><a href="{{ route('home') }}" class="mnav__link {{ Route::is('home') ? 'is-active' : '' }}" @if(Route::is('home')) aria-current="page" @endif>{{ __('frontend.header.home') }}</a></li>
                <li><a href="{{ route('product-lists') }}" class="mnav__link {{ Route::is('product-lists') && !$activeSlug ? 'is-active' : '' }}">{{ __('frontend.header.materials') }}</a></li>
                @if($navCats->isNotEmpty())
                    <li>
                        <details class="mnav__group" @if($activeSlug) open @endif>
                            <summary class="mnav__link">
                                {{ __('frontend.header.categories') }}
                                <i class="fas fa-chevron-down" aria-hidden="true"></i>
                            </summary>
                            <ul class="mnav__cats">
                                @foreach($navCats as $cat)
                                    <li>
                                        <a href="{{ route('product-lists', $cat->slug) }}" class="{{ $activeSlug === $cat->slug ? 'is-active' : '' }}">
                                            <i class="fas {{ $catIcons[$cat->slug] ?? 'fa-layer-group' }}" aria-hidden="true"></i>
                                            <span>{{ $catTitle($cat) }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </details>
                    </li>
                @endif
                @foreach($navLinks as $link)
                    <li><a href="{{ route($link['route']) }}" class="mnav__link {{ Route::is($link['route']) ? 'is-active' : '' }}" @if(Route::is($link['route'])) aria-current="page" @endif>{{ $link['label'] }}</a></li>
                @endforeach
                @auth
                    <li><a href="{{ route('user') }}" class="mnav__link {{ Route::is('user') ? 'is-active' : '' }}">{{ __('frontend.header.library') }}</a></li>
                @endauth
            </ul>
        </nav>

        <div class="drawer__prefs">
            <p class="pick__label">{{ __('frontend.header.language') }}</p>
            <div class="seg">
                @foreach($languages as $lang)
                    <a href="{{ route('change.language', $lang['code']) }}" class="seg__opt {{ $lang['on'] ? 'is-active' : '' }}" @if($lang['on']) aria-current="true" @endif>
                        <i class="fi {{ $lang['flag'] }} seg__flag" aria-hidden="true"></i>
                        <span>{{ $lang['label'] }}</span>
                    </a>
                @endforeach
            </div>
            <p class="pick__label">{{ __('frontend.header.currency') }}</p>
            <div class="curs">
                @foreach($currencyList as $cur)
                    <a href="{{ route('change.currency', $cur->code) }}" class="curs__opt {{ $currency == $cur->code ? 'is-active' : '' }}" @if($currency == $cur->code) aria-current="true" @endif>
                        <span class="curs__sym" aria-hidden="true">{{ Helper::getCurrencySymbol($cur->code) }}</span>
                        <span class="curs__name">{{ $curName($cur->code, $cur->name ?? null) }}</span>
                        <span class="curs__code">{{ $cur->code }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="drawer__foot">
        @auth
            <a href="{{ route('points.topup') }}" class="btn btn--primary btn--block">
                <i class="fas fa-coins" aria-hidden="true"></i>{{ number_format($balance) }} {{ __('frontend.header.credits') }}
            </a>
            <a href="{{ route('user.logout') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.logout') }}</a>
        @else
            <a href="{{ route('register.form') }}" class="btn btn--primary btn--block">{{ __('frontend.header.register') }}</a>
            <a href="{{ route('login.form') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.login') }}</a>
        @endauth
        @if($hdMail)
            <a href="mailto:{{ $hdMail }}" class="drawer__mail" aria-label="{{ __('frontend.header.mail') }}: {{ $hdMail }}">
                <i class="far fa-envelope" aria-hidden="true"></i>
                <span>{{ $hdMail }}</span>
            </a>
        @endif
    </div>
</div>

<aside class="drawer drawer--cart" id="drawer-cart" role="dialog" aria-modal="true" aria-labelledby="cart-drawer-title" data-sheet="cart">
    <div class="drawer__head">
        <h2 class="drawer__title" id="cart-drawer-title">
            {{ __('frontend.header.cart') }}
            <span class="tag">{{ $cartQty }}</span>
        </h2>
        <button type="button" class="hdr__icon" aria-label="{{ __('frontend.header.close_cart') }}" data-sheet-close>
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>

    <div class="drawer__body">
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
                            $lineTitle = $isJa && filled($line->product->title_jp ?? null) ? $line->product->title_jp : $line->product->title;

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
        <div class="drawer__foot">
            @if($hasCourses && Auth::check())
                <p class="drawer__row">
                    <span>{{ __('frontend.header.balance') }}</span>
                    <span>{{ number_format($balance) }} {{ __('frontend.header.credits') }}</span>
                </p>
            @endif
            <p class="drawer__row drawer__row--total">
                <span>{{ __('frontend.header.total') }}</span>
                @if($hasCredits && !$hasCourses)
                    <strong>{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($totalPrice, session('currency')=='JPY' ? 0 : 2) }}</strong>
                @else
                    <strong>{{ number_format($totalPoints) }} <small>{{ __('frontend.header.credits') }}</small></strong>
                @endif
            </p>

            @if($hasCredits && !$hasCourses)
                <a href="{{ route('checkout') }}" class="btn btn--primary btn--block">{{ __('frontend.header.checkout') }}</a>
                <a href="{{ route('cart') }}" class="btn btn--ghost btn--block">{{ __('frontend.header.view_cart') }}</a>
            @elseif($hasCourses && !$hasCredits)
                <a href="{{ route('coursecart') }}" class="btn btn--primary btn--block">{{ __('frontend.header.view_cart') }}</a>
            @endif
            <button type="button" class="drawer__back" data-sheet-close>{{ __('frontend.header.keep_browsing') }}</button>
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

    var spotNav = document.querySelector('[data-spot-nav]');
    var spot = spotNav ? spotNav.querySelector('[data-spot]') : null;
    if (spotNav && spot) {
        var spotLinks = spotNav.querySelectorAll('.hdr__list > li > .hdr__link');
        var placeSpot = function (link) {
            Array.prototype.forEach.call(spotLinks, function (item) { item.classList.toggle('is-spot', item === link); });
            if (!link) { spot.classList.remove('is-on'); return; }
            var holder = spot.offsetParent || spotNav;
            var holderBox = holder.getBoundingClientRect();
            var box = link.getBoundingClientRect();
            if (!spot.classList.contains('is-on')) { spot.style.transition = 'none'; }
            spot.style.width = box.width + 'px';
            spot.style.transform = 'translateX(' + (box.left - holderBox.left - holder.clientLeft) + 'px)';
            spot.offsetWidth;
            spot.style.transition = '';
            spot.classList.add('is-on');
        };
        Array.prototype.forEach.call(spotLinks, function (link) {
            link.addEventListener('mouseenter', function () { placeSpot(link); });
            link.addEventListener('focus', function () { placeSpot(link); });
        });
        spotNav.addEventListener('mouseleave', function () { placeSpot(null); });
        spotNav.addEventListener('focusout', function (event) {
            if (!event.relatedTarget || !spotNav.contains(event.relatedTarget)) { placeSpot(null); }
        });
    }

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
            setTimeout(function () { if (!active) { scrim.hidden = true; } }, 350);
        }
        root.classList.remove('has-sheet');
        active = null;
        if (opener && opener.offsetParent !== null) { opener.focus(); }
    }

    function openSheet(sheet, opener) {
        closeSheet();
        closePicks(null);

        if (scrim) {
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
        if (hdr) { hdr.classList.toggle('is-scrolled', window.scrollY > 24); }
    }
    window.addEventListener('scroll', function () {
        if (!ticking) { ticking = true; requestAnimationFrame(onScroll); }
    }, { passive: true });
    onScroll();

    var wide = window.matchMedia('(min-width: 1100px)');
    function onResize() {
        closePicks(null);
        if (spot) { spot.classList.remove('is-on'); }
        if (active && active.sheet.getAttribute('data-sheet') === 'menu' && wide.matches) { closeSheet(); }
    }
    if (wide.addEventListener) { wide.addEventListener('change', onResize); }
}());
</script>
