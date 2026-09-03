<style>
    /* ==========================================================================
       Art Courses — Cookie Consent (Gallery Style - Flat Bottom Banner)
       ========================================================================== */
    .sakura-cookies {
        position: fixed !important;
        bottom: 32px !important; /* Space from bottom */
        left: 50% !important; /* Center horizontally */
        transform: translateX(-50%) !important;
        width: calc(100% - 64px) !important; /* 32px space on left and right */
        max-width: 1200px !important;
        background-color: #ffffff !important;
        border: 1px solid rgba(0,0,0,0.08) !important;
        border-radius: 8px !important; /* Rounded corners for floating island */
        padding: 40px 48px !important; 
        z-index: 999999 !important;
        box-shadow: 0 20px 60px rgba(0,0,0,0.08) !important; /* Soft floating shadow */
        font-family: Arial, sans-serif !important;
        animation: agFadeUpCenter 0.6s cubic-bezier(0.16, 1, 0.3, 1) both !important;
        box-sizing: border-box !important;
    }

    @keyframes agFadeUpCenter {
        from { opacity: 0; transform: translate(-50%, 20px); }
        to { opacity: 1; transform: translate(-50%, 0); }
    }

    .sakura-cookies__alert {
        max-width: 1600px !important;
        margin: 0 auto !important;
        width: 100% !important;
    }

    .sakura-cookies__wrapper {
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        gap: 48px !important;
        flex-wrap: wrap !important;
    }

    .sakura-cookies__content {
        flex: 1 !important;
        min-width: 320px !important;
    }

    .sakura-cookies__title {
        font-family: 'Bodoni Moda', serif !important;
        font-size: 28px !important;
        font-weight: 400 !important;
        color: #000000 !important;
        margin: 0 0 12px 0 !important;
        letter-spacing: 0.03em !important;
    }

    .sakura-cookies__intro p {
        font-family: Arial, sans-serif !important;
        font-size: 14px !important;
        line-height: 1.7 !important;
        color: #555555 !important;
        margin: 0 !important;
    }

    .sakura-cookies__intro a {
        color: #bc9c5c !important;
        text-decoration: none !important;
        border-bottom: 1px solid #bc9c5c !important;
        transition: opacity 0.3s ease !important;
    }
    .sakura-cookies__intro a:hover {
        opacity: 0.7 !important;
    }

    .sakura-cookies__actions {
        display: flex !important;
        gap: 16px !important;
        align-items: center !important;
        margin-top: 0 !important;
        flex-shrink: 0 !important;
    }

    /* High-end Gallery Buttons */
    .sakura-cookiesBtn {
        font-family: 'Bodoni Moda', serif !important; /* Match theme typography */
        font-size: 12px !important;
        font-weight: 500 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.15em !important;
        padding: 16px 32px !important;
        border-radius: 0 !important; /* Sharp corners for editorial look */
        text-align: center !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
        min-width: 180px !important;
    }
    
    /* Force inner elements to inherit font */
    .sakura-cookiesBtn * {
        font-family: 'Bodoni Moda', serif !important;
        letter-spacing: 0.15em !important;
    }

    .sakura-cookiesBtn--accept {
        background-color: #000000 !important;
        color: #ffffff !important;
        border: 1px solid #000000 !important;
    }
    .sakura-cookiesBtn--accept *, .sakura-cookiesBtn--accept span, .sakura-cookiesBtn--accept a {
        color: #ffffff !important; 
    }
    .sakura-cookiesBtn--accept:hover {
        background-color: #bc9c5c !important;
        border-color: #bc9c5c !important;
        color: #ffffff !important;
    }

    .sakura-cookiesBtn--essentials {
        background-color: transparent !important;
        color: #000000 !important;
        border: 1px solid #000000 !important;
    }
    .sakura-cookiesBtn--essentials *, .sakura-cookiesBtn--essentials span, .sakura-cookiesBtn--essentials a {
        color: #000000 !important;
    }
    .sakura-cookiesBtn--essentials:hover {
        background-color: rgba(0,0,0,0.04) !important;
    }

    /* Customize link */
    .sakura-cookies__btn--customize {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        font-family: Arial, sans-serif !important;
        font-size: 11px !important;
        font-weight: bold !important;
        text-transform: uppercase !important;
        letter-spacing: 0.15em !important;
        color: #999999 !important;
        text-decoration: none !important;
        margin-top: 24px !important;
        padding-top: 0 !important;
        border-top: none !important;
        transition: color 0.3s ease !important;
        width: 100% !important;
    }
    .sakura-cookies__btn--customize:hover {
        color: #000000 !important;
    }
    .sakura-cookies__btn--customize svg {
        transition: transform 0.3s ease !important;
        color: inherit !important;
        transform: rotate(180deg) !important;
    }
    .sakura-cookies__btn--customize.is-active svg {
        transform: rotate(0deg) !important;
    }

    .sakura-cookies__expandable { display: none !important; }
    .sakura-cookies__expandable.is-open { display: block !important; }

    /* Custom form */
    .sakura-cookies__customize {
        margin-top: 24px !important;
        background-color: #fcfcfc !important;
        border: 1px solid rgba(0,0,0,0.05) !important;
        border-radius: 8px !important;
        padding: 24px !important;
        max-height: 40vh !important;
        overflow-y: auto !important;
    }

    .sakura-cookies__section {
        margin-bottom: 16px !important;
        padding-bottom: 16px !important;
        border-bottom: 1px solid rgba(0,0,0,0.05) !important;
    }
    .sakura-cookies__section:last-child {
        margin-bottom: 0 !important; border-bottom: none !important; padding-bottom: 0 !important;
    }
    .sakura-cookies__category {
        display: block !important; cursor: pointer !important; position: relative !important; margin: 0 !important;
    }
    .sakura-cookies__category input {
        position: absolute !important; top: 2px !important; left: 0 !important; accent-color: #bc9c5c !important;
    }
    .sakura-cookies__box { padding-left: 28px !important; display: block !important; }
    .sakura-cookies__label { font-size: 13px !important; font-weight: bold !important; color: #000000 !important; }
    
    .sakura-cookies__info { font-size: 12px !important; color: #666666 !important; margin: 4px 0 0 28px !important; line-height: 1.5 !important; }
    
    .sakura-cookies__details {
        display: inline-block !important; font-size: 11px !important; color: #bc9c5c !important; margin: 8px 0 0 28px !important; text-decoration: none !important; border-bottom: 1px solid transparent !important; transition: border-color 0.3s ease !important;
    }
    .sakura-cookies__details:hover { border-color: #bc9c5c !important; }

    .sakura-cookies__definitions {
        list-style: none !important; padding: 16px !important; margin: 12px 0 0 28px !important;
        background-color: #ffffff !important; border: 1px solid rgba(0,0,0,0.05) !important; border-radius: 6px !important;
    }
    .sakura-cookies__cookie { margin-bottom: 12px !important; font-size: 12px !important; line-height: 1.5 !important; }
    .sakura-cookies__cookie:last-child { margin-bottom: 0 !important; }
    .sakura-cookies__name { font-weight: bold !important; color: #000000 !important; margin: 0 0 2px 0 !important; }
    .sakura-cookies__duration { font-style: italic !important; font-size: 11px !important; color: #999999 !important; margin: 0 0 4px 0 !important; }
    
    .sakura-cookies__save { margin-top: 16px !important; text-align: right !important; }
    .sakura-cookiesBtn__link {
        background-color: #000000 !important; color: #ffffff !important; border: none !important; border-radius: 6px !important;
        font-family: Arial, sans-serif !important; font-size: 11px !important; font-weight: bold !important;
        text-transform: uppercase !important; letter-spacing: 0.1em !important; padding: 12px 24px !important; cursor: pointer !important; transition: background-color 0.3s ease !important;
    }
    .sakura-cookiesBtn__link:hover { background-color: #bc9c5c !important; }

    @media (max-width: 768px) {
        .sakura-cookies {
            bottom: 16px !important;
            width: calc(100% - 32px) !important;
            padding: 24px 20px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            border-radius: 8px !important;
        }
        .sakura-cookies__wrapper {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 16px !important;
        }
        .sakura-cookies__actions {
            width: 100% !important;
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 8px !important;
        }
        .sakura-cookiesBtn {
            width: 100% !important;
        }
    }
</style>

<aside id="sakura-cookies-policy" class="sakura-cookies" data-text="{{ json_encode(__('cookieConsent::cookies.details')) }}">
    <div class="sakura-cookies__alert">
        <div class="sakura-cookies__container">
            <div class="sakura-cookies__wrapper">
                <div class="sakura-cookies__content">
                    <h6 class="sakura-cookies__title">@lang('cookieConsent::cookies.title')</h6>
                    <div class="sakura-cookies__intro">
                        <p>@lang('cookieConsent::cookies.intro')</p>
                        @if($policy)
                            <p>@lang('cookieConsent::cookies.link', ['url' => $policy])</p>
                        @endif
                    </div>
                </div>
                <div class="sakura-cookies__actions">
                    @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'sakura-cookiesBtn sakura-cookiesBtn--essentials'])
                    
                    @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'sakura-cookiesBtn sakura-cookiesBtn--accept'])
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="sakura-cookies__btn sakura-cookies__btn--customize js-cookie-toggle" data-target="sakura-cookies-policy-customize">
            <span>@lang('cookieConsent::cookies.customize')</span>
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M14.7559 11.9782C15.0814 11.6527 15.0814 11.1251 14.7559 10.7996L10.5893 6.63297C10.433 6.47669 10.221 6.3889 10 6.38889C9.77899 6.38889 9.56703 6.47669 9.41075 6.63297L5.24408 10.7996C4.91864 11.1251 4.91864 11.6527 5.24408 11.9782C5.56951 12.3036 6.09715 12.3036 6.42259 11.9782L10 8.40074L13.5774 11.9782C13.9028 12.3036 14.4305 12.3036 14.7559 11.9782Z" fill="currentColor"/>
            </svg>
        </a>
        <div class="sakura-cookies__expandable sakura-cookies__expandable--custom" id="sakura-cookies-policy-customize">
            <form action="{{ route('cookieconsent.accept.configuration') }}" method="post" class="sakura-cookies__customize">
                @csrf
                <div class="sakura-cookies__sections">
                    @foreach($cookies->getCategories() as $category)
                    <div class="sakura-cookies__section">
                        <label for="sakura-cookies-policy-check-{{ $category->key() }}" class="sakura-cookies__category">
                            @if ($category->key() === 'essentials')
                                <input type="hidden" name="categories[]" value="{{ $category->key() }}" />
                                <input type="checkbox" name="categories[]" value="{{ $category->key() }}" id="sakura-cookies-policy-check-{{ $category->key() }}" checked="checked" disabled="disabled" />
                            @else
                                <input type="checkbox" name="categories[]" value="{{ $category->key() }}" id="sakura-cookies-policy-check-{{ $category->key() }}" />
                            @endif
                            <span class="sakura-cookies__box">
                                <strong class="sakura-cookies__label">{{ $category->title }}</strong>
                            </span>
                            @if($category->description)
                                <p class="sakura-cookies__info">{{ $category->description }}</p>
                            @endif
                        </label>

                        <div class="sakura-cookies__expandable" id="sakura-cookies-policy-{{ $category->key() }}">
                            <ul class="sakura-cookies__definitions">
                                @foreach($category->getCookies() as $cookie)
                                <li class="sakura-cookies__cookie">
                                    <p class="sakura-cookies__name">{{ $cookie->name }}</p>
                                    <p class="sakura-cookies__duration">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</p>
                                    @if($cookie->description)
                                        <p class="sakura-cookies__description">{{ $cookie->description }}</p>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="javascript:void(0)" class="sakura-cookies__details js-cookie-toggle" data-target="sakura-cookies-policy-{{ $category->key() }}">@lang('cookieConsent::cookies.details.more')</a>
                    </div>
                    @endforeach
                </div>
                <div class="sakura-cookies__save">
                    <button type="submit" class="sakura-cookiesBtn__link">@lang('cookieConsent::cookies.save')</button>
                </div>
            </form>
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.js-cookie-toggle').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const targetId = btn.getAttribute('data-target');
                const targetEl = document.getElementById(targetId);
                if (targetEl) {
                    const isOpen = targetEl.classList.contains('is-open');
                    
                    // Toggle targeted element
                    if (isOpen) {
                        targetEl.classList.remove('is-open');
                        btn.classList.remove('is-active');
                    } else {
                        targetEl.classList.add('is-open');
                        btn.classList.add('is-active');
                    }
                }
            });
        });
    });
</script>

<script data-cookie-consent>
    {!! file_get_contents(LCC_ROOT . '/dist/script.js') !!}
</script>
