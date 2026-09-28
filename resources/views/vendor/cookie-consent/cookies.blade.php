<aside id="consent" class="consent" role="region" aria-labelledby="consent-title">
    <div class="consent__head">
        <span class="consent__icon" aria-hidden="true"><i class="fas fa-cookie-bite"></i></span>
        <div class="consent__copy">
            <h2 class="consent__title" id="consent-title">@lang('cookieConsent::cookies.title')</h2>
            <p class="consent__intro">
                @lang('cookieConsent::cookies.intro')
                @if($policy)
                    @lang('cookieConsent::cookies.link', ['url' => $policy])
                @endif
            </p>
        </div>
    </div>

    <div class="consent__fold" id="consent-prefs">
        <div class="consent__fold-in">
            <form action="{{ route('cookieconsent.accept.configuration') }}" method="post" class="consent__prefs">
                @csrf

                <ul class="consent__cats">
                    @foreach($cookies->getCategories() as $category)
                        @php
                            $isEssential = $category->key() === 'essentials';
                            $catCookies  = $category->getCookies();
                        @endphp
                        <li class="consent__cat" style="--i: {{ $loop->index }}">
                            <label class="consent__row" for="consent-cat-{{ $category->key() }}">
                                <span class="consent__name">
                                    {{ $category->title }}
                                    @if($isEssential)
                                        <i class="fas fa-lock consent__lock" aria-hidden="true"></i>
                                    @endif
                                </span>
                                @if($isEssential)
                                    <input type="hidden" name="categories[]" value="{{ $category->key() }}">
                                    <input type="checkbox" class="toggle" id="consent-cat-{{ $category->key() }}" checked disabled>
                                @else
                                    <input type="checkbox" class="toggle" name="categories[]" value="{{ $category->key() }}" id="consent-cat-{{ $category->key() }}">
                                @endif
                            </label>

                            @if($category->description)
                                <p class="consent__info">{{ $category->description }}</p>
                            @endif

                            @if(count($catCookies))
                                <button type="button" class="consent__peek" data-consent-toggle="consent-list-{{ $category->key() }}" data-more="@lang('cookieConsent::cookies.details.more')" data-less="@lang('cookieConsent::cookies.details.less')">
                                    <span data-consent-label>@lang('cookieConsent::cookies.details.more')</span>
                                    <i class="fas fa-chevron-down consent__caret" aria-hidden="true"></i>
                                </button>

                                <div class="consent__fold" id="consent-list-{{ $category->key() }}">
                                    <div class="consent__fold-in">
                                        <ul class="consent__list">
                                            @foreach($catCookies as $cookie)
                                                <li class="consent__item">
                                                    <div class="consent__item-top">
                                                        <p class="consent__cookie">{{ $cookie->name }}</p>
                                                        <span class="consent__dur">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</span>
                                                    </div>
                                                    @if($cookie->description)
                                                        <p class="consent__desc">{{ $cookie->description }}</p>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>

                <button type="submit" class="btn btn--dark btn--block consent__save">@lang('cookieConsent::cookies.save')</button>
            </form>
        </div>
    </div>

    <div class="consent__acts">
        @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'consent__btn consent__btn--main'])

        @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'consent__btn consent__btn--soft'])

        <button type="button" class="consent__more" data-consent-toggle="consent-prefs">
            <i class="fas fa-sliders-h" aria-hidden="true"></i>
            <span>@lang('cookieConsent::cookies.customize')</span>
            <i class="fas fa-chevron-down consent__caret" aria-hidden="true"></i>
        </button>
    </div>
</aside>

<script>
(function () {
    'use strict';

    var root = document.getElementById('consent');

    if (!root) {
        return;
    }

    root.querySelectorAll('[data-consent-toggle]').forEach(function (trigger) {
        var panel = document.getElementById(trigger.getAttribute('data-consent-toggle'));

        if (!panel) {
            return;
        }

        var label = trigger.querySelector('[data-consent-label]');
        var more = trigger.getAttribute('data-more');
        var less = trigger.getAttribute('data-less');

        trigger.setAttribute('aria-controls', panel.id);
        trigger.setAttribute('aria-expanded', 'false');

        trigger.addEventListener('click', function () {
            var open = !panel.classList.contains('is-open');

            panel.classList.toggle('is-open', open);
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');

            if (panel.id === 'consent-prefs') {
                root.classList.toggle('is-open', open);
            }

            if (label && more && less) {
                label.textContent = open ? less : more;
            }
        });
    });
}());
</script>
