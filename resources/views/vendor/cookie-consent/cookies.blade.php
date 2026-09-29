<aside id="consent" class="cc" role="region" aria-labelledby="cc-title">
    <div class="cc__fold" id="cc-prefs">
        <div class="cc__fold-in">
            <form action="{{ route('cookieconsent.accept.configuration') }}" method="post" class="cc__prefs">
                @csrf

                <ul class="cc__cats">
                    @foreach($cookies->getCategories() as $category)
                        @php
                            $isEssential = $category->key() === 'essentials';
                            $catCookies  = $category->getCookies();
                        @endphp
                        <li class="cc__cat">
                            <label class="cc__row" for="cc-cat-{{ $category->key() }}">
                                <span class="cc__name">{{ $category->title }}</span>
                                @if($isEssential)
                                    <input type="hidden" name="categories[]" value="{{ $category->key() }}">
                                    <input type="checkbox" class="cc__switch" id="cc-cat-{{ $category->key() }}" checked disabled>
                                @else
                                    <input type="checkbox" class="cc__switch" name="categories[]" value="{{ $category->key() }}" id="cc-cat-{{ $category->key() }}">
                                @endif
                            </label>

                            @if($category->description)
                                <p class="cc__info">{{ $category->description }}</p>
                            @endif

                            @if(count($catCookies))
                                <button type="button" class="cc__peek" data-cc-toggle="cc-list-{{ $category->key() }}" data-more="@lang('cookieConsent::cookies.details.more')" data-less="@lang('cookieConsent::cookies.details.less')">
                                    <span data-cc-label>@lang('cookieConsent::cookies.details.more')</span>
                                    <i class="fas fa-plus cc__caret" aria-hidden="true"></i>
                                </button>

                                <div class="cc__fold" id="cc-list-{{ $category->key() }}">
                                    <div class="cc__fold-in">
                                        <ul class="cc__list">
                                            @foreach($catCookies as $cookie)
                                                <li class="cc__item">
                                                    <span class="cc__cookie">{{ $cookie->name }}</span>
                                                    <span class="cc__dur">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</span>
                                                    @if($cookie->description)
                                                        <span class="cc__desc">{{ $cookie->description }}</span>
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

                <div class="cc__save">
                    <button type="submit" class="cc__save-btn">@lang('cookieConsent::cookies.save')</button>
                </div>
            </form>
        </div>
    </div>

    <div class="cc__bar">
        <span class="cc__badge" aria-hidden="true"><i class="fas fa-cookie-bite"></i></span>

        <div class="cc__main">
            <p class="cc__title" id="cc-title">@lang('cookieConsent::cookies.title')</p>
            <p class="cc__intro">
                @lang('cookieConsent::cookies.intro')
                @if($policy)
                    @lang('cookieConsent::cookies.link', ['url' => $policy])
                @endif
            </p>
        </div>

        <div class="cc__acts">
            <button type="button" class="cc__more" data-cc-toggle="cc-prefs" data-more="@lang('cookieConsent::cookies.customize')" data-less="@lang('cookieConsent::cookies.customize')">
                <i class="fas fa-sliders-h cc__gear" aria-hidden="true"></i>
                <span data-cc-label>@lang('cookieConsent::cookies.customize')</span>
            </button>

            @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'cc-act cc-act--soft'])

            @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'cc-act cc-act--main'])
        </div>
    </div>
</aside>

<script>
(function () {
    'use strict';

    var root = document.getElementById('consent');
    if (!root) { return; }

    root.querySelectorAll('[data-cc-toggle]').forEach(function (trigger) {
        var panel = document.getElementById(trigger.getAttribute('data-cc-toggle'));
        if (!panel) { return; }

        var label = trigger.querySelector('[data-cc-label]');
        var more = trigger.getAttribute('data-more');
        var less = trigger.getAttribute('data-less');

        trigger.setAttribute('aria-controls', panel.id);
        trigger.setAttribute('aria-expanded', 'false');

        trigger.addEventListener('click', function () {
            var open = !panel.classList.contains('is-open');
            panel.classList.toggle('is-open', open);
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (panel.id === 'cc-prefs') { root.classList.toggle('is-open', open); }
            if (label && more && less) { label.textContent = open ? less : more; }
        });
    });
}());
</script>
