<style>
    /* ==========================================================================
       Cookie Consent Theme (Structured Putnam Paper Layout)
       ========================================================================== */
    .sakura-cookies {
        position: fixed !important;
        bottom: 24px !important;
        right: 24px !important;
        width: 400px !important;
        max-width: calc(100vw - 48px) !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        border: 1px solid var(--color-ink, #000000) !important;
        border-radius: 4px !important;
        padding: 24px !important;
        z-index: 99999 !important;
        box-shadow: none !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        animation: cookie-fade-in 0.4s cubic-bezier(0.25, 1, 0.5, 1) both !important;
        box-sizing: border-box !important;
    }

    @keyframes cookie-fade-in {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .sakura-cookies__title {
        font-family: var(--font-davinci, serif) !important;
        font-size: 18px !important;
        font-weight: 500 !important;
        color: var(--color-ink, #000000) !important;
        margin: 0 0 12px 0 !important;
        letter-spacing: -0.01em !important;
    }

    .sakura-cookies__intro p {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important;
        line-height: 1.5 !important;
        color: var(--color-graphite, #595855) !important;
        margin: 0 0 12px 0 !important;
    }

    .sakura-cookies__intro p:last-child {
        margin-bottom: 0 !important;
    }

    .sakura-cookies__intro a {
        color: var(--color-ink, #000000) !important;
        text-decoration: underline !important;
        font-weight: 500 !important;
    }

    .sakura-cookies__actions {
        display: flex !important;
        gap: 12px !important;
        margin-top: 16px !important;
    }

    /* Buttons styling */
    .sakura-cookiesBtn {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        font-weight: 500 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        padding: 10px 16px !important;
        border-radius: 4px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
        flex: 1 !important;
        text-decoration: none !important;
        border: 1px solid var(--color-ink, #000000) !important;
        text-align: center !important;
    }

    .sakura-cookiesBtn--accept {
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
    }

    .sakura-cookiesBtn--accept:hover {
        background-color: var(--color-graphite, #595855) !important;
        border-color: var(--color-graphite, #595855) !important;
        color: var(--color-paper, #ffffff) !important;
        text-decoration: none !important;
    }

    .sakura-cookiesBtn--essentials {
        background-color: transparent !important;
        color: var(--color-ink, #000000) !important;
    }

    .sakura-cookiesBtn--essentials:hover {
        background-color: rgba(0, 0, 0, 0.05) !important;
        color: var(--color-ink, #000000) !important;
        text-decoration: none !important;
    }

    /* Customize trigger link */
    .sakura-cookies__btn--customize {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        font-size: 11px !important;
        font-weight: 500 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        color: var(--color-ink, #000000) !important;
        text-decoration: none !important;
        margin-top: 16px !important;
        padding-top: 12px !important;
        border-top: 1px solid var(--color-vellum, #dfdcd5) !important;
        cursor: pointer !important;
    }

    .sakura-cookies__btn--customize:hover {
        opacity: 0.7 !important;
        text-decoration: none !important;
    }

    .sakura-cookies__btn--customize svg {
        transition: transform 0.2s ease !important;
        color: var(--color-graphite, #595855) !important;
        transform: rotate(180deg) !important; /* points down by default */
    }

    .sakura-cookies__btn--customize.is-active svg {
        transform: rotate(0deg) !important; /* points up when open */
    }

    /* Accordion mechanics via JS class toggling */
    .sakura-cookies__expandable {
        display: none !important;
    }

    .sakura-cookies__expandable.is-open {
        display: block !important;
    }

    /* Customize form details */
    .sakura-cookies__customize {
        margin-top: 16px !important;
        background-color: var(--color-paper, #ffffff) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 4px !important;
        padding: 16px !important;
    }

    .sakura-cookies__section {
        margin-bottom: 12px !important;
        padding-bottom: 12px !important;
        border-bottom: 1px solid var(--color-vellum, #dfdcd5) !important;
    }

    .sakura-cookies__section:last-child {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
        border-bottom: none !important;
    }

    .sakura-cookies__category {
        display: block !important;
        cursor: pointer !important;
        margin: 0 !important;
        position: relative !important;
    }

    .sakura-cookies__category input[type="checkbox"] {
        position: absolute !important;
        top: 3px !important;
        left: 0 !important;
        width: 16px !important;
        height: 16px !important;
        accent-color: var(--color-ink, #000000) !important;
        cursor: pointer !important;
    }

    .sakura-cookies__box {
        display: block !important;
        padding-left: 24px !important;
    }

    .sakura-cookies__label {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: var(--color-ink, #000000) !important;
    }

    .sakura-cookies__info {
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        color: var(--color-graphite, #595855) !important;
        margin: 4px 0 0 24px !important;
        line-height: 1.4 !important;
    }

    .sakura-cookies__details {
        display: inline-block !important;
        font-size: 11px !important;
        color: var(--color-graphite, #595855) !important;
        text-decoration: underline !important;
        margin: 6px 0 0 24px !important;
    }

    .sakura-cookies__details:hover {
        color: var(--color-ink, #000000) !important;
    }

    .sakura-cookies__definitions {
        list-style: none !important;
        padding: 12px !important;
        margin: 8px 0 0 24px !important;
        background-color: var(--color-bone, #e7e5e4) !important;
        border: 1px solid var(--color-vellum, #dfdcd5) !important;
        border-radius: 4px !important;
    }

    .sakura-cookies__cookie {
        margin-bottom: 10px !important;
        font-size: 11px !important;
        line-height: 1.4 !important;
    }

    .sakura-cookies__cookie:last-child {
        margin-bottom: 0 !important;
    }

    .sakura-cookies__name {
        font-weight: 600 !important;
        color: var(--color-ink, #000000) !important;
        margin: 0 0 2px 0 !important;
    }

    .sakura-cookies__duration {
        font-style: italic !important;
        color: var(--color-graphite, #595855) !important;
        margin: 0 0 4px 0 !important;
    }

    .sakura-cookies__description {
        color: var(--color-graphite, #595855) !important;
        margin: 0 !important;
    }

    .sakura-cookies__save {
        margin-top: 16px !important;
        text-align: right !important;
    }

    .sakura-cookiesBtn__link {
        background-color: var(--color-ink, #000000) !important;
        color: var(--color-paper, #ffffff) !important;
        font-family: var(--font-helvetica-now, sans-serif) !important;
        font-size: 11px !important;
        font-weight: 500 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        padding: 8px 16px !important;
        border-radius: 4px !important;
        border: 1px solid var(--color-ink, #000000) !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
    }

    .sakura-cookiesBtn__link:hover {
        background-color: var(--color-graphite, #595855) !important;
        border-color: var(--color-graphite, #595855) !important;
    }

    @media (max-width: 480px) {
        .sakura-cookies {
            bottom: 0 !important;
            right: 0 !important;
            left: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            border-left: none !important;
            border-right: none !important;
            border-bottom: none !important;
            border-radius: 0 !important;
            padding: 16px !important;
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
