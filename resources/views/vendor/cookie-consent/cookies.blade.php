<aside id="ck-consent" class="consent" role="region" aria-labelledby="ck-consent-title">
    <div class="consent__head">
        <span class="consent__mark" aria-hidden="true"><span class="rosette"></span></span>
        <h2 class="consent__title" id="ck-consent-title">@lang('cookieConsent::cookies.title')</h2>
    </div>

    <div class="consent__body">
        <div class="consent__intro">
            <p>@lang('cookieConsent::cookies.intro')</p>
            @if($policy)
                <p>@lang('cookieConsent::cookies.link', ['url' => $policy])</p>
            @endif
        </div>

        <div class="consent__panel" id="ck-consent-prefs">
            <div class="consent__panel-in">
                <form action="{{ route('cookieconsent.accept.configuration') }}" method="post" class="prefs">
                    @csrf

                    <div class="prefs__grid">
                        @foreach($cookies->getCategories() as $category)
                            @php
                                $isEssential = $category->key() === 'essentials';
                                $catCookies  = $category->getCookies();
                            @endphp
                            <div class="prefs__row">
                                <label class="prefs__top" for="ck-cat-{{ $category->key() }}">
                                    <span class="prefs__label">
                                        {{ $category->title }}
                                        @if($isEssential)
                                            <i class="fas fa-lock prefs__lock" aria-hidden="true"></i>
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
                                    <p class="prefs__info">{{ $category->description }}</p>
                                @endif

                                @if(count($catCookies))
                                    <button type="button" class="prefs__details" data-ck-toggle="ck-list-{{ $category->key() }}" data-more="@lang('cookieConsent::cookies.details.more')" data-less="@lang('cookieConsent::cookies.details.less')">
                                        <span data-ck-label>@lang('cookieConsent::cookies.details.more')</span>
                                        <i class="fas fa-chevron-down consent__chev" aria-hidden="true"></i>
                                    </button>

                                    <div class="prefs__drop" id="ck-list-{{ $category->key() }}">
                                        <ul class="prefs__list">
                                            @foreach($catCookies as $cookie)
                                                <li class="prefs__item">
                                                    <p class="prefs__name">{{ $cookie->name }}</p>
                                                    <span class="prefs__dur num">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</span>
                                                    @if($cookie->description)
                                                        <p class="prefs__desc">{{ $cookie->description }}</p>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn--primary btn--block">@lang('cookieConsent::cookies.save')</button>
                </form>
            </div>
        </div>
    </div>

    <div class="consent__acts">
        <div class="consent__choice">
            @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'cbtn cbtn--essential'])

            @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'cbtn cbtn--all'])
        </div>

        <button type="button" class="consent__more" data-ck-toggle="ck-consent-prefs">
            <span>@lang('cookieConsent::cookies.customize')</span>
            <i class="fas fa-chevron-down consent__chev" aria-hidden="true"></i>
        </button>
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
        var widens = panel.id === 'ck-consent-prefs';

        trigger.setAttribute('aria-controls', panel.id);
        trigger.setAttribute('aria-expanded', 'false');

        trigger.addEventListener('click', function () {
            var open = !panel.classList.contains('is-open');

            panel.classList.toggle('is-open', open);
            trigger.setAttribute('aria-expanded', open ? 'true' : 'false');

            if (widens) {
                root.classList.toggle('is-wide', open);
            }

            if (label && more && less) {
                label.textContent = open ? less : more;
            }
        });
    });
}());
</script>
