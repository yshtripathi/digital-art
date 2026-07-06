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
        <a href="#sakura-cookies-policy-customize" class="sakura-cookies__btn sakura-cookies__btn--customize">
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
                        <a href="#sakura-cookies-policy-{{ $category->key() }}" class="sakura-cookies__details">@lang('cookieConsent::cookies.details.more')</a>
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

<script data-cookie-consent>
    {!! file_get_contents(LCC_ROOT . '/dist/script.js') !!}
</script>
