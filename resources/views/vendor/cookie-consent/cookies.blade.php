<aside id="ck-consent" class="ck" role="region" aria-labelledby="ck-consent-title">
    <div class="ck__bar">
        <span class="ck__icon" aria-hidden="true"><i class="fas fa-cookie-bite"></i></span>

        <div class="ck__text">
            <h2 class="ck__title" id="ck-consent-title">@lang('cookieConsent::cookies.title')</h2>
            <p class="ck__intro">
                @lang('cookieConsent::cookies.intro')
                @if($policy)
                    @lang('cookieConsent::cookies.link', ['url' => $policy])
                @endif
            </p>
        </div>

        <div class="ck__acts">
            <button type="button" class="ck__more" data-ck-toggle="ck-consent-prefs">
                <i class="fas fa-sliders-h" aria-hidden="true"></i>
                <span>@lang('cookieConsent::cookies.customize')</span>
                <i class="fas fa-chevron-down ck__chev" aria-hidden="true"></i>
            </button>

            @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'ck__btn ck__btn--soft'])

            @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'ck__btn ck__btn--main'])
        </div>
    </div>

    <div class="ck__panel" id="ck-consent-prefs">
        <div class="ck__panel-in">
            <form action="{{ route('cookieconsent.accept.configuration') }}" method="post" class="ck__prefs">
                @csrf

                <div class="ck__cats">
                    @foreach($cookies->getCategories() as $category)
                        @php
                            $isEssential = $category->key() === 'essentials';
                            $catCookies  = $category->getCookies();
                        @endphp
                        <div class="ck__cat">
                            <label class="ck__top" for="ck-cat-{{ $category->key() }}">
                                <span class="ck__name">
                                    {{ $category->title }}
                                    @if($isEssential)
                                        <i class="fas fa-lock ck__lock" aria-hidden="true"></i>
                                    @endif
                                </span>
                                @if($isEssential)
                                    <input type="hidden" name="categories[]" value="{{ $category->key() }}">
                                    <input type="checkbox" class="swt" id="ck-cat-{{ $category->key() }}" checked disabled>
                                @else
                                    <input type="checkbox" class="swt" name="categories[]" value="{{ $category->key() }}" id="ck-cat-{{ $category->key() }}">
                                @endif
                            </label>

                            @if($category->description)
                                <p class="ck__info">{{ $category->description }}</p>
                            @endif

                            @if(count($catCookies))
                                <button type="button" class="ck__details" data-ck-toggle="ck-list-{{ $category->key() }}" data-more="@lang('cookieConsent::cookies.details.more')" data-less="@lang('cookieConsent::cookies.details.less')">
                                    <span data-ck-label>@lang('cookieConsent::cookies.details.more')</span>
                                    <i class="fas fa-chevron-down ck__chev" aria-hidden="true"></i>
                                </button>

                                <div class="ck__panel" id="ck-list-{{ $category->key() }}">
                                    <div class="ck__panel-in">
                                        <ul class="ck__list">
                                            @foreach($catCookies as $cookie)
                                                <li class="ck__item">
                                                    <div class="ck__item-top">
                                                        <p class="ck__cookie">{{ $cookie->name }}</p>
                                                        <span class="ck__dur num">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</span>
                                                    </div>
                                                    @if($cookie->description)
                                                        <p class="ck__desc">{{ $cookie->description }}</p>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="ck__save">
                    <button type="submit" class="btn btn--primary">@lang('cookieConsent::cookies.save')</button>
                </div>
            </form>
        </div>
    </div>
</aside>

<script>
(function () {
    'use strict';

    var root = document.getElementById('ck-consent');

    if (!root) {
        return;
    }

    root.querySelectorAll('[data-ck-toggle]').forEach(function (trigger) {
        var panel = document.getElementById(trigger.getAttribute('data-ck-toggle'));

        if (!panel) {
            return;
        }

        var label = trigger.querySelector('[data-ck-label]');
        var more = trigger.getAttribute('data-more');
        var less = trigger.getAttribute('data-less');

        trigger.setAttribute('aria-controls', panel.id);
        trigger.setAttribute('aria-expanded', 'false');

        trigger.addEventListener('click', function () {
            var open = !panel.classList.contains('is-open');

            panel.classList.toggle('is-open', open);
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');

            if (panel.id === 'ck-consent-prefs') {
                root.classList.toggle('is-open', open);
            }

            if (label && more && less) {
                label.textContent = open ? less : more;
            }
        });
    });
}());
</script>
