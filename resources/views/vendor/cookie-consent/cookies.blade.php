{{-- ==========================================================================
     Cookie Consent
     Floating card anchored bottom-left, with the preferences panel expanding
     inside the card. Full-width bottom sheet on small screens.
     Styles: public/css/theme.css — section 13
     JS hooks kept: .js-cookie-toggle[data-target], .is-open, .is-active
     ========================================================================== --}}

<aside id="ck-policy" class="ck" role="region" aria-labelledby="ck-title" data-text="{{ json_encode(__('cookieConsent::cookies.details')) }}">
    <div class="ck__inner">

        <div class="ck__bar">
            <span class="ck__icon" aria-hidden="true"><i class="fas fa-cookie-bite"></i></span>

            <div class="ck__copy">
                <h2 class="ck__title" id="ck-title">@lang('cookieConsent::cookies.title')</h2>
                <div class="ck__intro">
                    <p>@lang('cookieConsent::cookies.intro')</p>
                    @if($policy)
                        <p>@lang('cookieConsent::cookies.link', ['url' => $policy])</p>
                    @endif
                </div>
            </div>

            <div class="ck__actions">
                @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'ck-btn ck-btn--accept'])

                @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'ck-btn ck-btn--essentials'])

                <a href="javascript:void(0)" class="ck__more js-cookie-toggle" data-target="ck-policy-customize">
                    <span>@lang('cookieConsent::cookies.customize')</span>
                    <svg class="ck__more-chev" width="18" height="18" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M14.7559 11.9782C15.0814 11.6527 15.0814 11.1251 14.7559 10.7996L10.5893 6.63297C10.433 6.47669 10.221 6.3889 10 6.38889C9.77899 6.38889 9.56703 6.47669 9.41075 6.63297L5.24408 10.7996C4.91864 11.1251 4.91864 11.6527 5.24408 11.9782C5.56951 12.3036 6.09715 12.3036 6.42259 11.9782L10 8.40074L13.5774 11.9782C13.9028 12.3036 14.4305 12.3036 14.7559 11.9782Z" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="ck__expandable" id="ck-policy-customize">
            <div class="ck__expandable-in">
                <form action="{{ route('cookieconsent.accept.configuration') }}" method="post" class="ck__customize">
                    @csrf

                    <div class="ck__sections">
                        @foreach($cookies->getCategories() as $category)
                            <div class="ck__section">
                                <label for="ck-policy-check-{{ $category->key() }}" class="ck__category">
                                    <span class="ck__label">{{ $category->title }}</span>
                                    @if ($category->key() === 'essentials')
                                        <input type="hidden" name="categories[]" value="{{ $category->key() }}" />
                                        <input type="checkbox" class="ck__switch" name="categories[]" value="{{ $category->key() }}" id="ck-policy-check-{{ $category->key() }}" checked="checked" disabled="disabled" />
                                    @else
                                        <input type="checkbox" class="ck__switch" name="categories[]" value="{{ $category->key() }}" id="ck-policy-check-{{ $category->key() }}" />
                                    @endif
                                </label>

                                @if($category->description)
                                    <p class="ck__info">{{ $category->description }}</p>
                                @endif

                                <a href="javascript:void(0)" class="ck__details js-cookie-toggle" data-target="ck-policy-{{ $category->key() }}">@lang('cookieConsent::cookies.details.more')</a>

                                <div class="ck__expandable" id="ck-policy-{{ $category->key() }}">
                                    <div class="ck__expandable-in">
                                        <ul class="ck__definitions">
                                            @foreach($category->getCookies() as $cookie)
                                                <li class="ck__cookie">
                                                    <p class="ck__name">{{ $cookie->name }}</p>
                                                    <span class="ck__duration">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</span>
                                                    @if($cookie->description)
                                                        <p class="ck__description">{{ $cookie->description }}</p>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="ck__save">
                        <button type="submit" class="ck__save-btn">@lang('cookieConsent::cookies.save')</button>
                    </div>
                </form>
            </div>
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
                    btn.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
                }
            });
            btn.setAttribute('aria-expanded', 'false');
            btn.setAttribute('role', 'button');
            btn.setAttribute('aria-controls', btn.getAttribute('data-target'));
        });
    });
</script>

<script data-cookie-consent>
    {!! file_get_contents(LCC_ROOT . '/dist/script.js') !!}
</script>
