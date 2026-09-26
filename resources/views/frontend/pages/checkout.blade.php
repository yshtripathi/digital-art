@extends('frontend.layouts.main')
@section('title', __('frontend.checkout.page_name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.checkout.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.checkout.crumb_cart'), 'url' => route('cart')],
        ['name' => __('frontend.checkout.page_name')]
    ]
])

@php
    $coTotal    = Helper::totalCartPrice();
    if(session()->has('coupon')) {
        $coTotal -= Session::get('coupon')['value'];
    }
    $coSymbol   = Helper::getCurrencySymbol(session('currency'));
    $coDecimals = session('currency') == 'JPY' ? 0 : 2;
    $coLines    = Helper::getAllProductFromCart();
    $coUserId   = auth()->check() ? auth()->id() : session('guest');
    $coPoints   = App\Models\Cart::where('user_id', $coUserId)->where('order_id', null)->pluck('points')->first();
@endphp

<section class="co">
    <div class="co__grid">

        <div class="co__main">

            <ol class="steps">
                <li class="steps__item is-done">
                    <span class="steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>
                    <span class="steps__label">{{ __('frontend.cart.st_cart') }}</span>
                </li>
                <li class="steps__line is-done" aria-hidden="true"></li>
                <li class="steps__item is-active" aria-current="step">
                    <span class="steps__no">2</span>
                    <span class="steps__label">{{ __('frontend.cart.st_pay') }}</span>
                </li>
                <li class="steps__line" aria-hidden="true"></li>
                <li class="steps__item">
                    <span class="steps__no">3</span>
                    <span class="steps__label">{{ __('frontend.cart.st_done') }}</span>
                </li>
            </ol>

            <form name="frmCheckout" id="frmCheckout" method="POST" action="{{ route('cart.order') }}" novalidate>
                @csrf

                <div class="co__panels">

                    <div class="panel">
                        <div class="panel__head">
                            <span class="panel__num">01</span>
                            <h2 class="panel__title">{{ __('frontend.checkout.sec_billing') }}</h2>
                        </div>
                        <div class="panel__body">
                            <div class="co__fields">

                                <div class="fld">
                                    <label class="fld__label" for="first_name">{{ __('frontend.checkout.first_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-user fld__icon" aria-hidden="true"></i>
                                        <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="fld__input" placeholder="{{ __('frontend.checkout.first_hint') }}" value="{{ old('first_name') }}">
                                    </div>
                                    @error('first_name')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="fld">
                                    <label class="fld__label" for="last_name">{{ __('frontend.checkout.last_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-user fld__icon" aria-hidden="true"></i>
                                        <input type="text" name="last_name" id="last_name" autocomplete="family-name" class="fld__input" placeholder="{{ __('frontend.checkout.last_hint') }}" value="{{ old('last_name') }}">
                                    </div>
                                    @error('last_name')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="fld">
                                    <label class="fld__label" for="email">{{ __('frontend.checkout.mail_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-envelope fld__icon" aria-hidden="true"></i>
                                        <input type="email" name="email" id="email" autocomplete="email" class="fld__input" placeholder="{{ __('frontend.checkout.mail_hint') }}" value="{{ old('email', auth()->user()->email ?? '') }}">
                                    </div>
                                    @error('email')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="fld">
                                    <label class="fld__label" for="phone">{{ __('frontend.checkout.phone_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-phone-alt fld__icon" aria-hidden="true"></i>
                                        <input type="tel" name="phone" id="phone" autocomplete="tel" inputmode="numeric" class="fld__input" placeholder="{{ __('frontend.checkout.phone_hint') }}" value="{{ old('phone', auth()->user()->phone ?? '') }}" oninput="this.value = this.value.replace(/\D/g, '')">
                                    </div>
                                    @error('phone')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="fld">
                                    <label class="fld__label" for="address">{{ __('frontend.checkout.street_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-map-marker-alt fld__icon" aria-hidden="true"></i>
                                        <input type="text" name="address1" id="address" autocomplete="street-address" class="fld__input" placeholder="{{ __('frontend.checkout.street_hint') }}" value="{{ old('address1', auth()->user()->address ?? '') }}">
                                    </div>
                                    @error('address1')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="fld">
                                    <label class="fld__label" for="city">{{ __('frontend.checkout.city_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-city fld__icon" aria-hidden="true"></i>
                                        <input type="text" name="city" id="city" autocomplete="address-level2" class="fld__input" placeholder="{{ __('frontend.checkout.city_hint') }}" value="{{ old('city', auth()->user()->city ?? '') }}">
                                    </div>
                                    @error('city')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="fld">
                                    <label class="fld__label" for="post_code">{{ __('frontend.checkout.zip_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-mail-bulk fld__icon" aria-hidden="true"></i>
                                        <input type="text" name="post_code" id="post_code" autocomplete="postal-code" inputmode="numeric" class="fld__input" placeholder="{{ __('frontend.checkout.zip_hint') }}" value="{{ old('post_code', auth()->user()->zip ?? '') }}">
                                    </div>
                                    @error('post_code')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="fld">
                                    <label class="fld__label" for="state">{{ __('frontend.checkout.region_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-map fld__icon" aria-hidden="true"></i>
                                        <input type="text" name="state" id="state" autocomplete="address-level1" class="fld__input" placeholder="{{ __('frontend.checkout.region_hint') }}" value="{{ old('state', auth()->user()->state ?? '') }}">
                                    </div>
                                    @error('state')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div class="fld">
                                    <label class="fld__label" for="country">{{ __('frontend.checkout.nation_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="fld__box">
                                        <i class="fas fa-globe fld__icon" aria-hidden="true"></i>
                                        <select name="country" id="country" autocomplete="country" class="fld__input fld__select">
                                    <option value="">{{ __('frontend.checkout.nation_hint') }}</option>
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
                                        <i class="fas fa-chevron-down fld__caret" aria-hidden="true"></i>
                                    </div>
                                    @error('country')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel__head">
                            <span class="panel__num">02</span>
                            <h2 class="panel__title">{{ __('frontend.checkout.sec_extra') }}</h2>
                        </div>
                        <div class="panel__body">
                            <div class="fld">
                                <label class="fld__label" for="note">{{ __('frontend.checkout.notes_label') }}</label>
                                <div class="fld__box fld__box--area">
                                    <i class="fas fa-comment-dots fld__icon" aria-hidden="true"></i>
                                    <textarea name="note" id="note" rows="4" class="fld__input fld__area" placeholder="{{ __('frontend.checkout.notes_hint') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel__head">
                            <span class="panel__num">03</span>
                            <h2 class="panel__title">{{ __('frontend.checkout.sec_card') }}</h2>
                        </div>
                        <div class="panel__body">
                            <div class="co__pay">
                                <div class="co__fields">
                                    <div class="fld">
                                        <label class="fld__label" for="name_on_card">{{ __('frontend.checkout.holder_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                        <div class="fld__box">
                                            <i class="fas fa-user fld__icon" aria-hidden="true"></i>
                                            <input type="text" name="name" id="name_on_card" autocomplete="cc-name" class="fld__input" placeholder="{{ __('frontend.checkout.holder_hint') }}" value="{{ old('name') }}">
                                        </div>
                                        @error('name')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                    </div>

                                    <div class="fld">
                                        <label class="fld__label" for="card_number">{{ __('frontend.checkout.number_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                        <div class="fld__box">
                                            <i class="fas fa-credit-card fld__icon" aria-hidden="true"></i>
                                            <input type="text" name="card_number" id="card_number" autocomplete="cc-number" inputmode="numeric" maxlength="19" pattern="[0-9\s]{19}" class="fld__input num cc-number" placeholder="{{ __('frontend.checkout.number_hint') }}">
                                        </div>
                                        @error('card_number')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                    </div>

                                    <div class="fld">
                                        <label class="fld__label" for="expiry_month">{{ __('frontend.checkout.expiry_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                        <div class="expiry">
                                            <input type="text" name="expiry_month" id="expiry_month" autocomplete="cc-exp-month" inputmode="numeric" maxlength="2" pattern="[0-9]{2}" class="fld__input num" placeholder="{{ __('frontend.checkout.month_hint') }}">
                                            <span class="expiry__sep" aria-hidden="true">/</span>
                                            <input type="text" name="expiry_year" id="expiry_year" autocomplete="cc-exp-year" inputmode="numeric" maxlength="4" pattern="[0-9]{4}" class="fld__input num" placeholder="{{ __('frontend.checkout.year_hint') }}">
                                        </div>
                                        @error('expiry_month')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                        @error('expiry_year')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                    </div>

                                    <div class="fld">
                                        <label class="fld__label" for="cvv">{{ __('frontend.checkout.cvv_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                        <div class="fld__box">
                                            <i class="fas fa-lock fld__icon" aria-hidden="true"></i>
                                            <input type="text" name="cvv" id="cvv" autocomplete="off" inputmode="numeric" maxlength="4" pattern="[0-9]{3,4}" class="fld__input num cc-cvc" placeholder="{{ __('frontend.checkout.cvv_hint') }}">
                                        </div>
                                        @error('cvv')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel__head">
                            <span class="panel__num">04</span>
                            <h2 class="panel__title">{{ __('frontend.checkout.sec_terms') }}</h2>
                        </div>
                        <div class="panel__body">

                            <div class="agree">
                                <div>
                                    <label class="agree__row">
                                        <span class="tick">
                                            <input type="checkbox" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
                                            <i class="fas fa-check" aria-hidden="true"></i>
                                        </span>
                                        <span class="agree__text">{{ __('frontend.checkout.ok_terms') }} <a href="{{ route('pages', 'terms-conditions') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.see_terms') }}</a></span>
                                    </label>
                                    @error('terms')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div>
                                    <label class="agree__row">
                                        <span class="tick">
                                            <input type="checkbox" id="privacy" name="privacy" value="1" {{ old('privacy') ? 'checked' : '' }}>
                                            <i class="fas fa-check" aria-hidden="true"></i>
                                        </span>
                                        <span class="agree__text">{{ __('frontend.checkout.ok_privacy') }} <a href="{{ route('pages', 'privacy-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.see_privacy') }}</a></span>
                                    </label>
                                    @error('privacy')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div>
                                    <label class="agree__row">
                                        <span class="tick">
                                            <input type="checkbox" id="delivery" name="delivery" value="1" {{ old('delivery') ? 'checked' : '' }}>
                                            <i class="fas fa-check" aria-hidden="true"></i>
                                        </span>
                                        <span class="agree__text">{{ __('frontend.checkout.ok_access') }} <a href="{{ route('pages', 'delivery-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.see_access') }}</a></span>
                                    </label>
                                    @error('delivery')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>

                                <div>
                                    <label class="agree__row">
                                        <span class="tick">
                                            <input type="checkbox" id="refund" name="refund" value="1" {{ old('refund') ? 'checked' : '' }}>
                                            <i class="fas fa-check" aria-hidden="true"></i>
                                        </span>
                                        <span class="agree__text">{{ __('frontend.checkout.ok_refund') }} <a href="{{ route('pages', 'refund-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.see_refund') }}</a></span>
                                    </label>
                                    @error('refund')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="co__facts">
                                <p class="co__facts-title">{{ __('frontend.checkout.facts_head') }}</p>
                                <ul class="co__facts-list">
                                    <li><i class="fas fa-clock" aria-hidden="true"></i><span>{{ __('frontend.checkout.fact_delivery') }}</span></li>
                                    <li><i class="fas fa-bolt" aria-hidden="true"></i><span>{{ __('frontend.checkout.fact_validity') }}</span></li>
                                </ul>
                            </div>

                            <div class="dba">
                                <i class="fas fa-info-circle" aria-hidden="true"></i>
                                <p>{{ __('frontend.checkout.dba_text') }} <img class="dba__img" src="{{ asset('assets/images/dba.webp') }}" alt="{{ __('frontend.checkout.dba_alt') }}" width="83" height="33"></p>
                            </div>

                            @if(env('CAPTCHA_ENABLED', true))
                                <div class="fld co__captcha">
                                    <label class="fld__label" for="captcha">{{ __('frontend.checkout.code_label') }} <span class="co__req" aria-label="{{ __('frontend.checkout.req_mark') }}">*</span></label>
                                    <div class="cap @error('captcha') is-invalid @enderror">
                                        <div class="fld__box">
                                            <i class="fas fa-shield-alt fld__icon" aria-hidden="true"></i>
                                            <input type="text" id="captcha" name="captcha" autocomplete="off" class="fld__input" placeholder="{{ __('frontend.checkout.code_hint') }}">
                                        </div>
                                        <div class="cap__img">@captcha</div>
                                    </div>
                                    @error('captcha')<span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ __('frontend.checkout.code_wrong') }}</span>@enderror
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <aside class="co__rail">
            <div class="sum">
                <div class="sum__head">
                    <span class="panel__num"><i class="fas fa-shopping-bag" aria-hidden="true"></i></span>
                    <h2 class="sum__title">{{ __('frontend.checkout.sum_title') }}</h2>
                </div>

                <div class="sum__body">
                    @if($coLines)
                        <ul class="sum__rows">
                            @foreach($coLines as $coLine)
                                <li class="sum__row">
                                    <span class="sum__item">
                                        <span class="sum__icon"><i class="fas fa-bolt" aria-hidden="true"></i></span>
                                        <span>{{ number_format($coPoints, 0, '.', ',') }} {{ __('frontend.checkout.unit_credits') }}</span>
                                    </span>
                                    <span class="sum__price">{{ $coSymbol }}{{ number_format($coLine['price'], $coDecimals, '.', ',') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="sum__total">
                        <span>{{ __('frontend.checkout.sum_total') }}</span>
                        <strong>{{ $coSymbol }}{{ number_format($coTotal, $coDecimals, '.', ',') }}</strong>
                    </div>
                </div>

                <div class="sum__foot">
                    <button type="submit" form="frmCheckout" class="btn btn--primary btn--block sum__pay" id="button-confirm">
                        <i class="fas fa-lock" aria-hidden="true"></i>
                        {{ __('frontend.checkout.go_pay') }}
                    </button>

                    <a href="{{ route('home') }}" class="btn btn--ghost btn--block">{{ __('frontend.checkout.go_back') }}</a>

                    <p class="sum__trust">
                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.checkout.secure_note') }}</span>
                    </p>

                    <img class="sum__methods" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.checkout.pay_alt') }}" loading="lazy">
                </div>
            </div>
        </aside>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ url('assets/js/jquery.payment.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#frmCheckout").validate({
            ignore: ":hidden:not([type=checkbox])",
            errorClass: "fld__err",
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.prepend('<i class="fas fa-info-circle" aria-hidden="true"></i> ');

                var group = element.closest('.fld');
                if (group.length) { error.appendTo(group); return; }

                var agree = element.closest('.agree > div');
                if (agree.length) { error.appendTo(agree); return; }

                error.insertAfter(element);
            },
            highlight: function(element) {
                jQuery(element).addClass('is-invalid');
                if (element.id === 'captcha') {
                    jQuery(element).closest('.cap').addClass('is-invalid');
                }
            },
            unhighlight: function(element) {
                jQuery(element).removeClass('is-invalid');
                if (element.id === 'captcha') {
                    jQuery(element).closest('.cap').removeClass('is-invalid');
                }
            },
            rules: {
                first_name: "required",
                last_name: "required",
                email: { required: true, email: true },
                phone: { required: true, digits: true },
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
                first_name: @json(__('frontend.checkout.first_empty')),
                last_name: @json(__('frontend.checkout.last_empty')),
                email: {
                    required: @json(__('frontend.checkout.mail_empty')),
                    email: @json(__('frontend.checkout.mail_wrong'))
                },
                phone: {
                    required: @json(__('frontend.checkout.phone_empty')),
                    digits: @json(__('frontend.checkout.phone_digits'))
                },
                address1: @json(__('frontend.checkout.street_empty')),
                post_code: @json(__('frontend.checkout.zip_empty')),
                city: @json(__('frontend.checkout.city_empty')),
                state: @json(__('frontend.checkout.region_empty')),
                country: @json(__('frontend.checkout.nation_empty')),
                name: @json(__('frontend.checkout.holder_empty')),
                card_number: @json(__('frontend.checkout.number_empty')),
                expiry_month: @json(__('frontend.checkout.month_empty')),
                expiry_year: @json(__('frontend.checkout.year_empty')),
                cvv: @json(__('frontend.checkout.cvv_empty')),
                terms: @json(__('frontend.checkout.terms_empty')),
                privacy: @json(__('frontend.checkout.privacy_empty')),
                delivery: @json(__('frontend.checkout.access_empty')),
                refund: @json(__('frontend.checkout.refund_empty')),
                captcha: @json(__('frontend.checkout.code_empty'))
            }
        });

        if (jQuery.fn.payment) { jQuery('.cc-cvc').payment('formatCardCVC'); }
    });
</script>

<script>
(function () {
    'use strict';

    var byId = function (id) { return document.getElementById(id); };

    var number = byId('card_number');
    var month  = byId('expiry_month');
    var year   = byId('expiry_year');
    var cvv    = byId('cvv');
    var country = byId('country');

    if (country && @json(old('country', ''))) {
        country.value = @json(old('country', ''));
    }

    function digitsOnly(field, max) {
        if (!field) { return; }

        var clean = function () {
            var value = field.value.replace(/\D/g, '').substring(0, max);
            if (value !== field.value) { field.value = value; }
        };

        field.addEventListener('input', clean);
        field.addEventListener('blur', clean);
        field.addEventListener('paste', function () { setTimeout(clean, 0); });
    }

    if (number) {
        var group = function () {
            number.value = number.value.replace(/\D/g, '').substring(0, 16).replace(/(.{4})/g, '$1 ').trim();
        };
        number.addEventListener('input', group);
        number.addEventListener('paste', function () { setTimeout(group, 0); });
    }

    if (month) {
        var cap = function () {
            var value = month.value.replace(/\D/g, '').substring(0, 2);
            if (value.length === 2 && parseInt(value, 10) > 12) { value = '12'; }
            month.value = value;
        };
        month.addEventListener('input', cap);
        month.addEventListener('paste', function () { setTimeout(cap, 0); });
    }

    digitsOnly(year, 4);
    digitsOnly(cvv, 4);
}());
</script>
@endpush
