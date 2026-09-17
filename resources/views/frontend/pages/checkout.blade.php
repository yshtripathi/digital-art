@extends('frontend.layouts.main')
@section('title', __('frontend.checkout.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.checkout.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.checkout.cart'), 'url' => route('cart')],
        ['name' => __('frontend.checkout.title')]
    ]
])

{{-- ==========================================================================
     Checkout
     Centred column on the drawn canvas: purchase steps, order summary, then
     numbered form cards on the shared controls, closed by a sticky pay bar.
     Styles: public/css/theme.css — sections 17 and 22
     JS hooks kept: #frmCheckout, .au-field, .au-error, .is-invalid, .co-check,
     .co-captcha, [data-au-captcha], #coCard and the card-preview ids,
     .cc-number, .cc-cvc, #button-confirm
     ========================================================================== --}}
<section class="co">

    @include('frontend.layouts.form-canvas')

    <div class="co__wrap">

        <ol class="bag-steps">
            <li class="bag-step">
                <span class="bag-step__no">1</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_cart') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step is-active">
                <span class="bag-step__no">2</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_pay') }}</span>
            </li>
            <li class="bag-steps__line" aria-hidden="true"></li>
            <li class="bag-step">
                <span class="bag-step__no">3</span>
                <span class="bag-steps__label">{{ __('frontend.cart.step_done') }}</span>
            </li>
        </ol>

        @php
            $total_amount = Helper::totalCartPrice();
            if(session()->has('coupon')) {
                $total_amount -= Session::get('coupon')['value'];
            }
            $coSymbol = Helper::getCurrencySymbol(session('currency'));
            $coDecimals = session('currency') == 'JPY' ? 0 : 2;
        @endphp

        {{-- Order summary --}}
        <div class="co-card">
            <div class="co-card__head">
                <span class="co-card__num"><i class="fas fa-shopping-bag" aria-hidden="true"></i></span>
                <h2 class="co-card__title">{{ __('frontend.checkout.order') }}</h2>
            </div>

            <div class="co-order">
                <div class="co-order__head">
                    <span>{{ __('frontend.checkout.item') }}</span>
                    <span>{{ __('frontend.checkout.total') }}</span>
                </div>
                @if(Helper::getAllProductFromCart())
                    @foreach(Helper::getAllProductFromCart() as $key => $cart)
                        @php
                            $user_id = auth()->check() ? auth()->id() : session('guest');
                            $points = App\Models\Cart::where('user_id', $user_id)->where('order_id', null)->pluck('points')->first();
                        @endphp
                        <div class="co-order__row">
                            <span class="co-order__item">
                                <span class="co-order__icon"><i class="fas fa-bolt" aria-hidden="true"></i></span>
                                {{ number_format($points, 0, '.', ',') }} {{ __('frontend.checkout.credits') }}
                            </span>
                            <span class="co-order__price">{{ $coSymbol }}{{ number_format($cart['price'], $coDecimals, '.', ',') }}</span>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="co-summary__total">
                <span>{{ __('frontend.checkout.total') }}:</span>
                <strong>{{ $coSymbol }}{{ number_format($total_amount, $coDecimals, '.', ',') }}</strong>
            </div>
        </div>

        <form name="frmCheckout" id="frmCheckout" method="POST" action="{{ route('cart.order') }}" novalidate>
            @csrf

            {{-- 1. Billing --}}
            <div class="co-card">
                <div class="co-card__head">
                    <span class="co-card__num">01</span>
                    <h2 class="co-card__title"><i class="fas fa-user-circle"></i> {{ __('frontend.checkout.billing') }}</h2>
                </div>

                <div class="co-fields">
                    <div class="au-field">
                        <label class="au-label" for="first_name">{{ __('frontend.checkout.first_name') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input">
                            <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="first_name" id="first_name" value="" autocomplete="given-name" placeholder="{{ __('frontend.checkout.first_name_ph') }}">
                        </div>
                        @error('first_name')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="au-field">
                        <label class="au-label" for="last_name">{{ __('frontend.checkout.last_name') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input">
                            <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="last_name" id="last_name" value="" autocomplete="family-name" placeholder="{{ __('frontend.checkout.last_name_ph') }}">
                        </div>
                        @error('last_name')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="au-field">
                        <label class="au-label" for="email">{{ __('frontend.checkout.email') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input">
                            <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                            <input name="email" type="email" id="email" value="{{ auth()->user()->email ?? '' }}" autocomplete="email" placeholder="{{ __('frontend.checkout.email_ph') }}">
                        </div>
                        @error('email')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="au-field">
                        <label class="au-label" for="phone">{{ __('frontend.checkout.phone') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input">
                            <i class="fas fa-phone-alt au-input__icon" aria-hidden="true"></i>
                            <input type="tel" name="phone" id="phone" placeholder="{{ __('frontend.checkout.phone_ph') }}" value="{{ auth()->user()->phone ?? '' }}" autocomplete="tel" pattern="[\d\+\-\(\)\s]{7,}" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')" inputmode="tel">
                        </div>
                        @error('phone')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="au-field co-fields__full">
                        <label class="au-label" for="address">{{ __('frontend.checkout.address') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input">
                            <i class="fas fa-map-marker-alt au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="address1" id="address" value="{{ auth()->user()->address ?? '' }}" autocomplete="street-address" placeholder="{{ __('frontend.checkout.address_ph') }}">
                        </div>
                        @error('address1')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="au-field">
                        <label class="au-label" for="city">{{ __('frontend.checkout.city') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input">
                            <i class="fas fa-city au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? '' }}" autocomplete="address-level2" placeholder="{{ __('frontend.checkout.city_ph') }}">
                        </div>
                        @error('city')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="au-field">
                        <label class="au-label" for="post_code">{{ __('frontend.checkout.postcode') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input">
                            <i class="fas fa-mail-bulk au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="post_code" id="post_code" pattern="[0-9]*" autocomplete="postal-code" placeholder="{{ __('frontend.checkout.postcode_ph') }}" value="{{ auth()->user()->zip ?? '' }}">
                        </div>
                        @error('post_code')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="au-field">
                        <label class="au-label" for="state">{{ __('frontend.checkout.state') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input">
                            <i class="fas fa-map au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="state" id="state" value="{{ auth()->user()->state ?? '' }}" autocomplete="address-level1" placeholder="{{ __('frontend.checkout.state_ph') }}">
                        </div>
                        @error('state')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="au-field co-fields__full">
                        <label class="au-label" for="country">{{ __('frontend.checkout.country') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="au-input co-select">
                            <i class="fas fa-globe au-input__icon" aria-hidden="true"></i>
                            <select name="country" id="country" autocomplete="country">
                                <option value="">{{ __('frontend.checkout.country_ph') }}</option>
                                <option value="AF">Afghanistan</option>
                                <option value="AX">Åland Islands</option>
                                <option value="AL">Albania</option>
                                <option value="DZ">Algeria</option>
                                <option value="AS">American Samoa</option>
                                <option value="AD">Andorra</option>
                                <option value="AO">Angola</option>
                                <option value="AI">Anguilla</option>
                                <option value="AQ">Antarctica</option>
                                <option value="AG">Antigua and Barbuda</option>
                                <option value="AR">Argentina</option>
                                <option value="AM">Armenia</option>
                                <option value="AW">Aruba</option>
                                <option value="AU">Australia</option>
                                <option value="AT">Austria</option>
                                <option value="AZ">Azerbaijan</option>
                                <option value="BS">Bahamas</option>
                                <option value="BH">Bahrain</option>
                                <option value="BD">Bangladesh</option>
                                <option value="BB">Barbados</option>
                                <option value="BY">Belarus</option>
                                <option value="BE">Belgium</option>
                                <option value="BZ">Belize</option>
                                <option value="BJ">Benin</option>
                                <option value="BM">Bermuda</option>
                                <option value="BT">Bhutan</option>
                                <option value="BO">Bolivia</option>
                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                <option value="BA">Bosnia and Herzegovina</option>
                                <option value="BW">Botswana</option>
                                <option value="BV">Bouvet Island</option>
                                <option value="BR">Brazil</option>
                                <option value="IO">British Indian Ocean Territory</option>
                                <option value="BN">Brunei Darussalam</option>
                                <option value="BG">Bulgaria</option>
                                <option value="BF">Burkina Faso</option>
                                <option value="BI">Burundi</option>
                                <option value="CV">Cabo Verde</option>
                                <option value="KH">Cambodia</option>
                                <option value="CM">Cameroon</option>
                                <option value="CA">Canada</option>
                                <option value="KY">Cayman Islands</option>
                                <option value="CF">Central African Republic</option>
                                <option value="TD">Chad</option>
                                <option value="CL">Chile</option>
                                <option value="CN">China</option>
                                <option value="CX">Christmas Island</option>
                                <option value="CC">Cocos (Keeling) Islands</option>
                                <option value="CO">Colombia</option>
                                <option value="KM">Comoros</option>
                                <option value="CG">Congo</option>
                                <option value="CD">Congo, Democratic Republic of the</option>
                                <option value="CK">Cook Islands</option>
                                <option value="CR">Costa Rica</option>
                                <option value="CI">Côte d&#039;Ivoire</option>
                                <option value="HR">Croatia</option>
                                <option value="CU">Cuba</option>
                                <option value="CW">Curaçao</option>
                                <option value="CY">Cyprus</option>
                                <option value="CZ">Czech Republic</option>
                                <option value="DK">Denmark</option>
                                <option value="DJ">Djibouti</option>
                                <option value="DM">Dominica</option>
                                <option value="DO">Dominican Republic</option>
                                <option value="EC">Ecuador</option>
                                <option value="EG">Egypt</option>
                                <option value="SV">El Salvador</option>
                                <option value="GQ">Equatorial Guinea</option>
                                <option value="ER">Eritrea</option>
                                <option value="EE">Estonia</option>
                                <option value="SZ">Eswatini</option>
                                <option value="ET">Ethiopia</option>
                                <option value="FK">Falkland Islands (Malvinas)</option>
                                <option value="FO">Faroe Islands</option>
                                <option value="FJ">Fiji</option>
                                <option value="FI">Finland</option>
                                <option value="FR">France</option>
                                <option value="GF">French Guiana</option>
                                <option value="PF">French Polynesia</option>
                                <option value="TF">French Southern Territories</option>
                                <option value="GA">Gabon</option>
                                <option value="GM">Gambia</option>
                                <option value="GE">Georgia</option>
                                <option value="DE">Germany</option>
                                <option value="GH">Ghana</option>
                                <option value="GI">Gibraltar</option>
                                <option value="GR">Greece</option>
                                <option value="GL">Greenland</option>
                                <option value="GD">Grenada</option>
                                <option value="GP">Guadeloupe</option>
                                <option value="GU">Guam</option>
                                <option value="GT">Guatemala</option>
                                <option value="GG">Guernsey</option>
                                <option value="GN">Guinea</option>
                                <option value="GW">Guinea-Bissau</option>
                                <option value="GY">Guyana</option>
                                <option value="HT">Haiti</option>
                                <option value="HM">Heard Island and McDonald Islands</option>
                                <option value="VA">Holy See</option>
                                <option value="HN">Honduras</option>
                                <option value="HK">Hong Kong SAR China</option>
                                <option value="HU">Hungary</option>
                                <option value="IS">Iceland</option>
                                <option value="IN">India</option>
                                <option value="ID">Indonesia</option>
                                <option value="IR">Iran</option>
                                <option value="IQ">Iraq</option>
                                <option value="IE">Ireland</option>
                                <option value="IM">Isle of Man</option>
                                <option value="IL">Israel</option>
                                <option value="IT">Italy</option>
                                <option value="JM">Jamaica</option>
                                <option value="JP">Japan</option>
                                <option value="JE">Jersey</option>
                                <option value="JO">Jordan</option>
                                <option value="KZ">Kazakhstan</option>
                                <option value="KE">Kenya</option>
                                <option value="KI">Kiribati</option>
                                <option value="XK">Kosovo</option>
                                <option value="KW">Kuwait</option>
                                <option value="KG">Kyrgyzstan</option>
                                <option value="LA">Laos</option>
                                <option value="LV">Latvia</option>
                                <option value="LB">Lebanon</option>
                                <option value="LS">Lesotho</option>
                                <option value="LR">Liberia</option>
                                <option value="LY">Libya</option>
                                <option value="LI">Liechtenstein</option>
                                <option value="LT">Lithuania</option>
                                <option value="LU">Luxembourg</option>
                                <option value="MO">Macao SAR China</option>
                                <option value="MG">Madagascar</option>
                                <option value="MW">Malawi</option>
                                <option value="MY">Malaysia</option>
                                <option value="MV">Maldives</option>
                                <option value="ML">Mali</option>
                                <option value="MT">Malta</option>
                                <option value="MH">Marshall Islands</option>
                                <option value="MQ">Martinique</option>
                                <option value="MR">Mauritania</option>
                                <option value="MU">Mauritius</option>
                                <option value="YT">Mayotte</option>
                                <option value="MX">Mexico</option>
                                <option value="FM">Micronesia</option>
                                <option value="MD">Moldova</option>
                                <option value="MC">Monaco</option>
                                <option value="MN">Mongolia</option>
                                <option value="ME">Montenegro</option>
                                <option value="MS">Montserrat</option>
                                <option value="MA">Morocco</option>
                                <option value="MZ">Mozambique</option>
                                <option value="MM">Myanmar</option>
                                <option value="NA">Namibia</option>
                                <option value="NR">Nauru</option>
                                <option value="NP">Nepal</option>
                                <option value="NL">Netherlands</option>
                                <option value="NC">New Caledonia</option>
                                <option value="NZ">New Zealand</option>
                                <option value="NI">Nicaragua</option>
                                <option value="NE">Niger</option>
                                <option value="NG">Nigeria</option>
                                <option value="NU">Niue</option>
                                <option value="NF">Norfolk Island</option>
                                <option value="KP">North Korea</option>
                                <option value="MK">North Macedonia</option>
                                <option value="MP">Northern Mariana Islands</option>
                                <option value="NO">Norway</option>
                                <option value="OM">Oman</option>
                                <option value="PK">Pakistan</option>
                                <option value="PW">Palau</option>
                                <option value="PS">Palestine</option>
                                <option value="PA">Panama</option>
                                <option value="PG">Papua New Guinea</option>
                                <option value="PY">Paraguay</option>
                                <option value="PE">Peru</option>
                                <option value="PH">Philippines</option>
                                <option value="PN">Pitcairn</option>
                                <option value="PL">Poland</option>
                                <option value="PT">Portugal</option>
                                <option value="PR">Puerto Rico</option>
                                <option value="QA">Qatar</option>
                                <option value="RE">Réunion</option>
                                <option value="RO">Romania</option>
                                <option value="RU">Russia</option>
                                <option value="RW">Rwanda</option>
                                <option value="BL">Saint Barthélemy</option>
                                <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                <option value="KN">Saint Kitts and Nevis</option>
                                <option value="LC">Saint Lucia</option>
                                <option value="MF">Saint Martin (French part)</option>
                                <option value="PM">Saint Pierre and Miquelon</option>
                                <option value="VC">Saint Vincent and the Grenadines</option>
                                <option value="WS">Samoa</option>
                                <option value="SM">San Marino</option>
                                <option value="ST">Sao Tome and Principe</option>
                                <option value="SA">Saudi Arabia</option>
                                <option value="SN">Senegal</option>
                                <option value="RS">Serbia</option>
                                <option value="SC">Seychelles</option>
                                <option value="SL">Sierra Leone</option>
                                <option value="SG">Singapore</option>
                                <option value="SX">Sint Maarten (Dutch part)</option>
                                <option value="SK">Slovakia</option>
                                <option value="SI">Slovenia</option>
                                <option value="SB">Solomon Islands</option>
                                <option value="SO">Somalia</option>
                                <option value="ZA">South Africa</option>
                                <option value="GS">South Georgia and the South Sandwich Islands</option>
                                <option value="KR">South Korea</option>
                                <option value="SS">South Sudan</option>
                                <option value="ES">Spain</option>
                                <option value="LK">Sri Lanka</option>
                                <option value="SD">Sudan</option>
                                <option value="SR">Suriname</option>
                                <option value="SJ">Svalbard and Jan Mayen</option>
                                <option value="SE">Sweden</option>
                                <option value="CH">Switzerland</option>
                                <option value="SY">Syria</option>
                                <option value="TW">Taiwan</option>
                                <option value="TJ">Tajikistan</option>
                                <option value="TZ">Tanzania</option>
                                <option value="TH">Thailand</option>
                                <option value="TL">Timor-Leste</option>
                                <option value="TG">Togo</option>
                                <option value="TK">Tokelau</option>
                                <option value="TO">Tonga</option>
                                <option value="TT">Trinidad and Tobago</option>
                                <option value="TN">Tunisia</option>
                                <option value="TR">Turkey</option>
                                <option value="TM">Turkmenistan</option>
                                <option value="TC">Turks and Caicos Islands</option>
                                <option value="TV">Tuvalu</option>
                                <option value="UG">Uganda</option>
                                <option value="UA">Ukraine</option>
                                <option value="AE">United Arab Emirates</option>
                                <option value="UK">United Kingdom</option>
                                <option value="US">United States</option>
                                <option value="UM">United States Minor Outlying Islands</option>
                                <option value="UY">Uruguay</option>
                                <option value="UZ">Uzbekistan</option>
                                <option value="VU">Vanuatu</option>
                                <option value="VE">Venezuela</option>
                                <option value="VN">Vietnam</option>
                                <option value="VG">Virgin Islands (British)</option>
                                <option value="VI">Virgin Islands (U.S.)</option>
                                <option value="WF">Wallis and Futuna</option>
                                <option value="EH">Western Sahara</option>
                                <option value="YE">Yemen</option>
                                <option value="ZM">Zambia</option>
                                <option value="ZW">Zimbabwe</option>
                            </select>
                            <i class="fas fa-chevron-down co-select__chev" aria-hidden="true"></i>
                        </div>
                        @error('country')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- 2. Additional info --}}
            <div class="co-card">
                <div class="co-card__head">
                    <span class="co-card__num">02</span>
                    <h2 class="co-card__title"><i class="fas fa-clipboard-list"></i> {{ __('frontend.checkout.extra') }}</h2>
                </div>
                <div class="au-field">
                    <label class="au-label" for="note">{{ __('frontend.checkout.notes') }}</label>
                    <div class="au-input ct-textarea">
                        <i class="fas fa-comment-dots au-input__icon" aria-hidden="true"></i>
                        <textarea name="note" id="note" rows="4" placeholder="{{ __('frontend.checkout.notes_ph') }}"></textarea>
                    </div>
                </div>
            </div>

            {{-- 3. Card details --}}
            <div class="co-card">
                <div class="co-card__head">
                    <span class="co-card__num">03</span>
                    <h2 class="co-card__title"><i class="fas fa-credit-card"></i> {{ __('frontend.checkout.card') }}</h2>
                </div>

                <div class="co-pay">
                    {{-- Live card preview (display only) --}}
                    <div class="co-cc" id="coCard" aria-hidden="true">
                        <div class="co-cc__inner">
                            <div class="co-cc__face co-cc__front">
                                <div class="co-cc__row">
                                    <span class="co-cc__chip"></span>
                                    <i class="fab fa-cc-visa co-cc__brand" id="coCardBrand" style="opacity:0"></i>
                                </div>
                                <div class="co-cc__number" id="coCardNumber">•••• •••• •••• ••••</div>
                                <div class="co-cc__row">
                                    <div>
                                        <span class="co-cc__label">{{ __('frontend.checkout.card_name') }}</span>
                                        <span class="co-cc__value" id="coCardName">—</span>
                                    </div>
                                    <div class="co-cc__right">
                                        <span class="co-cc__label">{{ __('frontend.checkout.expiry_short') }}</span>
                                        <span class="co-cc__value" id="coCardExp">••/••</span>
                                    </div>
                                </div>
                            </div>
                            <div class="co-cc__face co-cc__back">
                                <span class="co-cc__stripe"></span>
                                <div class="co-cc__sign">
                                    <span class="co-cc__label">{{ __('frontend.checkout.cvv') }}</span>
                                    <span class="co-cc__cvv" id="coCardCvv">•••</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="co-fields co-fields--card">
                        <div class="au-field co-fields__full">
                            <label class="au-label" for="name_on_card">{{ __('frontend.checkout.card_name') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="au-input">
                                <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                                <input type="text" name="name" id="name_on_card" autocomplete="cc-name" placeholder="{{ __('frontend.checkout.card_name_ph') }}">
                            </div>
                            @error('name')<span class="au-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="au-field co-fields__full">
                            <label class="au-label" for="card_number">{{ __('frontend.checkout.card_number') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="au-input">
                                <i class="fas fa-credit-card au-input__icon" aria-hidden="true"></i>
                                <input type="text" name="card_number" id="card_number" placeholder="{{ __('frontend.checkout.card_number_ph') }}" class="cc-number co-mono" pattern="[0-9\s]{19}" inputmode="numeric" maxlength="19" autocomplete="cc-number">
                            </div>
                            @error('card_number')<span class="au-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="au-field">
                            <label class="au-label" for="expiry_month">{{ __('frontend.checkout.expiry') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="co-expiry">
                                <div class="au-input au-input--plain">
                                    <input type="text" name="expiry_month" id="expiry_month" placeholder="{{ __('frontend.checkout.month_ph') }}" pattern="[0-9]{2}" inputmode="numeric" maxlength="2" autocomplete="cc-exp-month">
                                </div>
                                <span class="co-expiry__sep">/</span>
                                <div class="au-input au-input--plain">
                                    <input type="text" name="expiry_year" id="expiry_year" placeholder="{{ __('frontend.checkout.year_ph') }}" pattern="[0-9]{4}" inputmode="numeric" maxlength="4" autocomplete="cc-exp-year">
                                </div>
                            </div>
                            @error('expiry_month')<span class="au-error">{{ $message }}</span>@enderror
                            @error('expiry_year')<span class="au-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="au-field">
                            <label class="au-label" for="cvv">{{ __('frontend.checkout.cvv') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="au-input">
                                <i class="fas fa-lock au-input__icon" aria-hidden="true"></i>
                                <input id="cvv" name="cvv" type="text" autocomplete="off" placeholder="{{ __('frontend.checkout.cvv_ph') }}" class="cc-cvc co-mono" pattern="[0-9]{3,4}" inputmode="numeric" maxlength="4">
                            </div>
                            @error('cvv')<span class="au-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Terms --}}
            <div class="co-card">
                <div class="co-card__head">
                    <span class="co-card__num">04</span>
                    <h2 class="co-card__title"><i class="fas fa-file-signature"></i> {{ __('frontend.checkout.terms_title') }}</h2>
                </div>

                <div class="co-agree">
                    <div class="co-check">
                        <label class="co-check__row">
                            <input type="checkbox" id="terms" name="terms" value="1">
                            <span class="co-check__box"><i class="fas fa-check"></i></span>
                            <span class="co-check__text">{{ __('frontend.checkout.agree_terms') }} <a href="{{ route('pages', 'terms-conditions') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.read_terms') }}</a></span>
                        </label>
                        @error('terms')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="co-check">
                        <label class="co-check__row">
                            <input type="checkbox" id="privacy" name="privacy" value="1">
                            <span class="co-check__box"><i class="fas fa-check"></i></span>
                            <span class="co-check__text">{{ __('frontend.checkout.agree_privacy') }} <a href="{{ route('pages', 'privacy-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.read_privacy') }}</a></span>
                        </label>
                        @error('privacy')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="co-check">
                        <label class="co-check__row">
                            <input type="checkbox" id="delivery" name="delivery" value="1">
                            <span class="co-check__box"><i class="fas fa-check"></i></span>
                            <span class="co-check__text">{{ __('frontend.checkout.agree_delivery') }} <a href="{{ route('pages', 'delivery-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.read_delivery') }}</a></span>
                        </label>
                        @error('delivery')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="co-check">
                        <label class="co-check__row">
                            <input type="checkbox" id="refund" name="refund" value="1">
                            <span class="co-check__box"><i class="fas fa-check"></i></span>
                            <span class="co-check__text">{{ __('frontend.checkout.agree_refund') }} <a href="{{ route('pages', 'refund-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.read_refund') }}</a></span>
                        </label>
                        @error('refund')<span class="au-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="co-billnote">
                    <i class="fas fa-info-circle co-billnote__icon" aria-hidden="true"></i>
                    <p>{{ __('frontend.checkout.billing_note') }} <img src="{{ asset('assets/images/dba.webp') }}" alt="{{ __('frontend.checkout.billing_alt') }}"></p>
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="au-field co-summary__captcha">
                        <label class="au-label" for="captcha">{{ __('frontend.checkout.captcha') }} <span class="co-req" title="{{ __('frontend.checkout.required') }}" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                        <div class="co-captcha">
                            <div class="co-captcha__top">
                                <div class="co-captcha__img">@captcha</div>
                                <button type="button" class="co-captcha__refresh" data-au-captcha aria-label="{{ __('frontend.checkout.refresh') }}"><i class="fas fa-sync-alt"></i></button>
                            </div>
                            <div class="au-input">
                                <i class="fas fa-shield-alt au-input__icon" aria-hidden="true"></i>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('frontend.checkout.captcha_ph') }}">
                            </div>
                        </div>
                        @error('captcha')<span class="au-error">{{ __('frontend.checkout.captcha_bad') }}</span>@enderror
                    </div>
                @endif

                <p class="co-trust"><i class="fas fa-shield-alt" aria-hidden="true"></i> {{ __('frontend.checkout.secure') }}</p>

                <div class="co-pay-methods">
                    <img src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.checkout.payments') }}" loading="lazy">
                </div>
            </div>

            {{-- Sticky pay bar --}}
            <div class="co-bar">
                <div>
                    <span class="co-bar__label">{{ __('frontend.checkout.total') }}</span>
                    <span class="co-bar__total">{{ $coSymbol }}{{ number_format($total_amount, $coDecimals, '.', ',') }}</span>
                </div>

                <div class="co-bar__actions">
                    <a href="{{ route('home') }}" class="co-btn co-btn--secondary">{{ __('frontend.checkout.continue') }}</a>
                    <button type="submit" class="co-btn co-btn--primary" id="button-confirm">
                        <i class="fas fa-lock" aria-hidden="true"></i> {{ __('frontend.checkout.pay') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('assets/js/jquery.payment.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#frmCheckout").validate({
            ignore: ":hidden:not([type=checkbox])",
            errorClass: "au-error",
            errorElement: "span",
            errorPlacement: function(error, element) {
                var group = element.closest('.au-field');
                if (group.length) { error.appendTo(group); }
                else {
                    var check = element.closest('.co-check');
                    if (check.length) { error.appendTo(check); }
                    else { error.insertAfter(element); }
                }
            },
            highlight: function(element) {
                jQuery(element).addClass('is-invalid');
                if(element.id === 'captcha') {
                    jQuery(element).closest('.co-captcha').addClass('is-invalid');
                }
            },
            unhighlight: function(element) {
                jQuery(element).removeClass('is-invalid');
                if(element.id === 'captcha') {
                    jQuery(element).closest('.co-captcha').removeClass('is-invalid');
                }
            },
            rules: {
                first_name: "required",
                last_name: "required",
                email: { required: true, email: true },
                phone: { required: true, minlength: 10 },
                address1: "required",
                post_code: "required",
                city: "required",
                state: "required",
                country: "required",
                name: "required",
                card_number: "required",
                expiry_month: "required",
                expiry_year: "required",
                cvv: "required",
                terms: "required",
                privacy: "required",
                delivery: "required",
                refund: "required",
                @if(env('CAPTCHA_ENABLED', true))
                captcha: "required"
                @endif
            },
            messages: {
                first_name: @json(__('frontend.checkout.first_name_req')),
                last_name: @json(__('frontend.checkout.last_name_req')),
                email: {
                    required: @json(__('frontend.checkout.email_req')),
                    email: @json(__('frontend.checkout.email_valid'))
                },
                phone: {
                    required: @json(__('frontend.checkout.phone_req')),
                    minlength: @json(__('frontend.checkout.phone_min', ['min' => 10]))
                },
                address1: @json(__('frontend.checkout.address_req')),
                post_code: @json(__('frontend.checkout.postcode_req')),
                city: @json(__('frontend.checkout.city_req')),
                state: @json(__('frontend.checkout.state_req')),
                country: @json(__('frontend.checkout.country_req')),
                name: @json(__('frontend.checkout.card_name_req')),
                card_number: @json(__('frontend.checkout.card_number_req')),
                expiry_month: @json(__('frontend.checkout.month_req')),
                expiry_year: @json(__('frontend.checkout.year_req')),
                cvv: @json(__('frontend.checkout.cvv_req')),
                terms: @json(__('frontend.checkout.terms_req')),
                privacy: @json(__('frontend.checkout.privacy_req')),
                delivery: @json(__('frontend.checkout.delivery_req')),
                refund: @json(__('frontend.checkout.refund_req')),
                captcha: @json(__('frontend.checkout.captcha_req'))
            }
        });

        if (jQuery.fn.payment) { jQuery('.cc-cvc').payment('formatCardCVC'); }
    });

    document.addEventListener('DOMContentLoaded', function () {
        function sanitise(id, re, maxLen) {
            var el = document.getElementById(id);
            if (!el) return;
            var clean = function () {
                var v = el.value.replace(re, '');
                if (maxLen) v = v.substring(0, maxLen);
                if (v !== el.value) el.value = v;
            };
            el.addEventListener('input', clean);
            el.addEventListener('paste', function () { setTimeout(clean, 0); });
            el.addEventListener('blur', clean);
        }

        var card = document.getElementById('card_number');
        if (card) {
            var formatCard = function () {
                var digits = card.value.replace(/\D/g, '').substring(0, 16);
                card.value = digits.replace(/(.{4})/g, '$1 ').trim();
            };
            card.addEventListener('input', formatCard);
            card.addEventListener('paste', function () { setTimeout(formatCard, 0); });
        }

        var month = document.getElementById('expiry_month');
        if (month) {
            var fixMonth = function () {
                var v = month.value.replace(/\D/g, '').substring(0, 2);
                if (v.length === 2 && parseInt(v, 10) > 12) v = '12';
                month.value = v;
            };
            month.addEventListener('input', fixMonth);
            month.addEventListener('paste', function () { setTimeout(fixMonth, 0); });
        }

        sanitise('expiry_year', /\D/g, 4);
        sanitise('cvv', /\D/g, 4);
    });
</script>

<script>
    // UI only: live card preview + captcha refresh (does not affect validation or submission)
    document.addEventListener('DOMContentLoaded', function () {
        var preview = document.getElementById('coCard');
        if (preview) {
            var $ = function (id) { return document.getElementById(id); };
            var num = $('card_number'), name = $('name_on_card'), mm = $('expiry_month'), yy = $('expiry_year'), cvv = $('cvv');
            var brands = { '4': 'fa-cc-visa', '5': 'fa-cc-mastercard', '2': 'fa-cc-mastercard', '3': 'fa-cc-amex', '6': 'fa-cc-discover' };

            var render = function () {
                var digits = (num.value || '').replace(/\D/g, '');
                var masked = (digits + '•'.repeat(Math.max(0, 16 - digits.length))).substring(0, 16).replace(/(.{4})/g, '$1 ').trim();
                $('coCardNumber').textContent = masked;
                $('coCardName').textContent = (name.value || '').trim() || '—';
                $('coCardExp').textContent = (mm.value || '••').padEnd(2, '•') + '/' + ((yy.value || '').slice(-2) || '••').padEnd(2, '•');
                $('coCardCvv').textContent = (cvv.value || '').replace(/./g, '•') || '•••';
                var brand = $('coCardBrand');
                var cls = brands[digits.charAt(0)];
                brand.className = 'fab co-cc__brand ' + (cls || 'fa-cc-visa');
                brand.style.opacity = cls ? '1' : '0';
            };

            [num, name, mm, yy, cvv].forEach(function (el) {
                if (!el) return;
                el.addEventListener('input', function () { setTimeout(render, 0); });
            });
            if (cvv) {
                cvv.addEventListener('focus', function () { preview.classList.add('is-flipped'); });
                cvv.addEventListener('blur', function () { preview.classList.remove('is-flipped'); });
            }
            render();
        }

        document.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-au-captcha]');
            if (!btn) return;
            var img = btn.closest('.co-captcha').querySelector('.co-captcha__img img');
            if (img) img.click();
        });
    });
</script>
@endpush
