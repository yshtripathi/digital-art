@extends('frontend.layouts.main')
@section('title', __('frontend.checkout.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.checkout.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.checkout.cart'), 'url' => route('cart')],
        ['name' => __('frontend.checkout.title')]
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
@endphp

<section class="co">
    <ol class="steps">
        <li class="steps__item is-done">
            <span class="steps__no"><i class="fas fa-check" aria-hidden="true"></i></span>
            <span class="steps__label">{{ __('frontend.cart.step_cart') }}</span>
        </li>
        <li class="steps__line is-done" aria-hidden="true"></li>
        <li class="steps__item is-active" aria-current="step">
            <span class="steps__no num">2</span>
            <span class="steps__label">{{ __('frontend.cart.step_pay') }}</span>
        </li>
        <li class="steps__line" aria-hidden="true"></li>
        <li class="steps__item">
            <span class="steps__no num">3</span>
            <span class="steps__label">{{ __('frontend.cart.step_done') }}</span>
        </li>
    </ol>

    <div class="co__grid">
        <div class="gate__stack gate__stack--wide">
        <form name="frmCheckout" id="frmCheckout" class="gate__card co__main" method="POST" action="{{ route('cart.order') }}" novalidate>
            @csrf

                <div class="co__panel" style="--i: 0">
                    <div class="co__panel-head">
                        <span class="co__num num">01</span>
                        <h2 class="co__panel-title">{{ __('frontend.checkout.billing_title') }}</h2>
                        <i class="fas fa-id-card co__panel-icon" aria-hidden="true"></i>
                    </div>
                    <div class="co__panel-body">
                        <div class="entry">
                            <label class="entry__label" for="first_name">{{ __('frontend.checkout.first_name') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('first_name') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-user"></i></span>
                                <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="entry__input" placeholder="{{ __('frontend.checkout.first_name_placeholder') }}" value="{{ old('first_name') }}">
                            </div>
                            @error('first_name')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="last_name">{{ __('frontend.checkout.last_name') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('last_name') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-user"></i></span>
                                <input type="text" name="last_name" id="last_name" autocomplete="family-name" class="entry__input" placeholder="{{ __('frontend.checkout.last_name_placeholder') }}" value="{{ old('last_name') }}">
                            </div>
                            @error('last_name')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="email">{{ __('frontend.checkout.email') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('email') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" id="email" autocomplete="email" class="entry__input" placeholder="{{ __('frontend.checkout.email_placeholder') }}" value="{{ old('email', auth()->user()->email ?? '') }}">
                            </div>
                            @error('email')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="phone">{{ __('frontend.checkout.phone') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('phone') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-phone-alt"></i></span>
                                <input type="tel" name="phone" id="phone" autocomplete="tel" inputmode="numeric" oninput="this.value = this.value.replace(/\D/g, '')" class="entry__input" placeholder="{{ __('frontend.checkout.phone_placeholder') }}" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                            </div>
                            @error('phone')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="address">{{ __('frontend.checkout.street') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('address1') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" name="address1" id="address" autocomplete="street-address" class="entry__input" placeholder="{{ __('frontend.checkout.street_placeholder') }}" value="{{ old('address1', auth()->user()->address ?? '') }}">
                            </div>
                            @error('address1')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="city">{{ __('frontend.checkout.city') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('city') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-city"></i></span>
                                <input type="text" name="city" id="city" autocomplete="address-level2" class="entry__input" placeholder="{{ __('frontend.checkout.city_placeholder') }}" value="{{ old('city', auth()->user()->city ?? '') }}">
                            </div>
                            @error('city')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="post_code">{{ __('frontend.checkout.postcode') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('post_code') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-mail-bulk"></i></span>
                                <input type="text" name="post_code" id="post_code" autocomplete="postal-code" inputmode="numeric" class="entry__input" placeholder="{{ __('frontend.checkout.postcode_placeholder') }}" value="{{ old('post_code', auth()->user()->zip ?? '') }}">
                            </div>
                            @error('post_code')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="state">{{ __('frontend.checkout.region') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('state') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-map"></i></span>
                                <input type="text" name="state" id="state" autocomplete="address-level1" class="entry__input" placeholder="{{ __('frontend.checkout.region_placeholder') }}" value="{{ old('state', auth()->user()->state ?? '') }}">
                            </div>
                            @error('state')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="country">{{ __('frontend.checkout.country') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('country') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-globe"></i></span>
                                <select name="country" id="country" autocomplete="country" class="entry__input entry__select">
                                <option value="">{{ __('frontend.checkout.country_placeholder') }}</option>
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
                                <i class="fas fa-chevron-down entry__caret" aria-hidden="true"></i>
                            </div>
                            @error('country')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="co__panel" style="--i: 1">
                    <div class="co__panel-head">
                        <span class="co__num num">02</span>
                        <h2 class="co__panel-title">{{ __('frontend.checkout.notes_title') }}</h2>
                        <i class="fas fa-pen co__panel-icon" aria-hidden="true"></i>
                    </div>
                    <div class="co__panel-body">
                        <div class="entry">
                            <label class="entry__label" for="note">{{ __('frontend.checkout.notes') }}</label>
                            <div class="entry__box entry__box--area">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-comment-dots"></i></span>
                                <textarea name="note" id="note" rows="4" class="entry__input entry__area" placeholder="{{ __('frontend.checkout.notes_placeholder') }}">{{ old('note') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="co__panel" style="--i: 2">
                    <div class="co__panel-head">
                        <span class="co__num num">03</span>
                        <h2 class="co__panel-title">{{ __('frontend.checkout.card_title') }}</h2>
                        <i class="fas fa-credit-card co__panel-icon" aria-hidden="true"></i>
                    </div>
                    <div class="co__panel-body">
                        <div class="entry">
                            <label class="entry__label" for="name_on_card">{{ __('frontend.checkout.card_name') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('name') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-user"></i></span>
                                <input type="text" name="name" id="name_on_card" autocomplete="cc-name" class="entry__input" placeholder="{{ __('frontend.checkout.card_name_placeholder') }}" value="{{ old('name') }}">
                            </div>
                            @error('name')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="card_number">{{ __('frontend.checkout.card_number') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('card_number') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-credit-card"></i></span>
                                <input type="text" name="card_number" id="card_number" autocomplete="cc-number" inputmode="numeric" maxlength="19" class="entry__input num cc-number" placeholder="{{ __('frontend.checkout.card_number_placeholder') }}">
                            </div>
                            @error('card_number')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="expiry_month">{{ __('frontend.checkout.expiry_month') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('expiry_month') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" name="expiry_month" id="expiry_month" autocomplete="cc-exp-month" inputmode="numeric" maxlength="2" class="entry__input num" placeholder="{{ __('frontend.checkout.expiry_month_placeholder') }}">
                            </div>
                            @error('expiry_month')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="expiry_year">{{ __('frontend.checkout.expiry_year') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('expiry_year') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-calendar"></i></span>
                                <input type="text" name="expiry_year" id="expiry_year" autocomplete="cc-exp-year" inputmode="numeric" maxlength="4" class="entry__input num" placeholder="{{ __('frontend.checkout.expiry_year_placeholder') }}">
                            </div>
                            @error('expiry_year')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>

                        <div class="entry">
                            <label class="entry__label" for="cvv">{{ __('frontend.checkout.cvv') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                            <div class="entry__box @error('cvv') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-lock"></i></span>
                                <input type="text" name="cvv" id="cvv" autocomplete="off" inputmode="numeric" maxlength="4" class="entry__input num cc-cvc" placeholder="{{ __('frontend.checkout.cvv_placeholder') }}">
                            </div>
                            @error('cvv')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="co__panel" style="--i: 3">
                    <div class="co__panel-head">
                        <span class="co__num num">04</span>
                        <h2 class="co__panel-title">{{ __('frontend.checkout.agree_title') }}</h2>
                        <i class="fas fa-file-signature co__panel-icon" aria-hidden="true"></i>
                    </div>
                    <div class="co__panel-body">
                        <div class="agree">
                        <div>
                            <label class="tick tick--agree" for="terms">
                                <input type="checkbox" id="terms" name="terms" value="1" {{ old('terms') ? 'checked' : '' }}>
                                <span class="tick__box" aria-hidden="true"><i class="fas fa-check"></i></span>
                                <span class="agree__text">{{ __('frontend.checkout.agree_terms') }} <a href="{{ route('pages', 'terms-conditions') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.read_terms') }}</a></span>
                            </label>
                            @error('terms')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="tick tick--agree" for="privacy">
                                <input type="checkbox" id="privacy" name="privacy" value="1" {{ old('privacy') ? 'checked' : '' }}>
                                <span class="tick__box" aria-hidden="true"><i class="fas fa-check"></i></span>
                                <span class="agree__text">{{ __('frontend.checkout.agree_privacy') }} <a href="{{ route('pages', 'privacy-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.read_privacy') }}</a></span>
                            </label>
                            @error('privacy')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="tick tick--agree" for="delivery">
                                <input type="checkbox" id="delivery" name="delivery" value="1" {{ old('delivery') ? 'checked' : '' }}>
                                <span class="tick__box" aria-hidden="true"><i class="fas fa-check"></i></span>
                                <span class="agree__text">{{ __('frontend.checkout.agree_delivery') }} <a href="{{ route('pages', 'delivery-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.read_delivery') }}</a></span>
                            </label>
                            @error('delivery')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="tick tick--agree" for="refund">
                                <input type="checkbox" id="refund" name="refund" value="1" {{ old('refund') ? 'checked' : '' }}>
                                <span class="tick__box" aria-hidden="true"><i class="fas fa-check"></i></span>
                                <span class="agree__text">{{ __('frontend.checkout.agree_refund') }} <a href="{{ route('pages', 'refund-policy') }}" target="_blank" rel="noopener">{{ __('frontend.checkout.read_refund') }}</a></span>
                            </label>
                            @error('refund')<span class="entry__err">{{ $message }}</span>@enderror
                        </div>
                        </div>

                        <div class="co__facts">
                            <p class="co__facts-title">{{ __('frontend.checkout.before_title') }}</p>
                            <ul class="co__facts-list">
                                <li><i class="fas fa-clock" aria-hidden="true"></i><span>{{ __('frontend.checkout.note_delivery') }}</span></li>
                                <li><i class="fas fa-bolt" aria-hidden="true"></i><span>{{ __('frontend.checkout.note_validity') }}</span></li>
                            </ul>
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="entry">
                                <label class="entry__label" for="captcha">{{ __('frontend.checkout.captcha') }} <span class="co__req" aria-label="{{ __('frontend.checkout.required') }}">*</span></label>
                                <div class="entry__cap">
                                    <div class="cap__img">@captcha</div>
                                    <div class="entry__box @error('captcha') is-invalid @enderror">
                                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-shield-alt"></i></span>
                                        <input type="text" id="captcha" name="captcha" autocomplete="off" class="entry__input" placeholder="{{ __('frontend.checkout.captcha_placeholder') }}">
                                    </div>
                                </div>
                                @error('captcha')<span class="entry__err">{{ __('frontend.checkout.captcha_wrong') }}</span>@enderror
                            </div>
                        @endif
                    </div>
                </div>
        </form>
        </div>

        <aside class="co__rail gate__stack gate__stack--wide">
            <div class="gate__card sum">
                <div class="sum__head">
                    <span class="sum__badge" aria-hidden="true"><i class="fas fa-shopping-bag"></i></span>
                    <h2 class="sum__title">{{ __('frontend.checkout.summary_title') }}</h2>
                </div>

                @if($coLines)
                    <ul class="sum__rows">
                        @foreach($coLines as $coLine)
                            <li class="sum__row">
                                <span class="sum__item">
                                    <span class="sum__icon" aria-hidden="true"><i class="fas fa-wallet"></i></span>
                                    <span><span class="num">{{ number_format($coLine->points, 0, '.', ',') }}</span> {{ __('frontend.checkout.credits') }}</span>
                                </span>
                                <span class="sum__price num">{{ $coSymbol }}{{ number_format($coLine['price'], $coDecimals, '.', ',') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="sum__total">
                    <span>{{ __('frontend.checkout.total') }}:</span>
                    <strong class="num">{{ $coSymbol }}{{ number_format($coTotal, $coDecimals, '.', ',') }}</strong>
                </div>

                <p class="co__bill">
                    {{ __('frontend.checkout.billing_notice') }}
                    <img class="co__bill-img" src="{{ asset('assets/images/dba.webp') }}" alt="{{ __('frontend.checkout.billing_alt') }}" width="160" height="37">
                </p>

                <button type="submit" form="frmCheckout" class="btn btn--block gate__submit sum__pay" id="button-confirm">
                    <span><i class="fas fa-lock" aria-hidden="true"></i> {{ __('frontend.checkout.pay') }}</span>
                    <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </button>

                <a href="{{ route('home') }}" class="btn btn--outline btn--block sum__more">{{ __('frontend.checkout.keep_browsing') }}</a>

                <p class="sum__trust">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    <span>{{ __('frontend.checkout.secure') }}</span>
                </p>

                <img class="sum__methods" src="{{ asset('assets/images/payment.webp') }}" alt="{{ __('frontend.checkout.payments_alt') }}" loading="lazy">
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
            errorClass: "entry__err",
            errorElement: "span",
            errorPlacement: function(error, element) {
                var group = element.closest('.entry');
                if (group.length) { error.appendTo(group); return; }

                var agree = element.closest('.agree > div');
                if (agree.length) { error.appendTo(agree); return; }

                error.insertAfter(element);
            },
            highlight: function(element) {
                jQuery(element).closest('.entry__box, .tick').addClass('is-invalid');
            },
            unhighlight: function(element) {
                jQuery(element).closest('.entry__box, .tick').removeClass('is-invalid');
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
                first_name: @json(__('frontend.checkout.first_name_required')),
                last_name: @json(__('frontend.checkout.last_name_required')),
                email: {
                    required: @json(__('frontend.checkout.email_required')),
                    email: @json(__('frontend.checkout.email_invalid'))
                },
                phone: {
                    required: @json(__('frontend.checkout.phone_required')),
                    digits: @json(__('frontend.checkout.phone_digits'))
                },
                address1: @json(__('frontend.checkout.street_required')),
                post_code: @json(__('frontend.checkout.postcode_required')),
                city: @json(__('frontend.checkout.city_required')),
                state: @json(__('frontend.checkout.region_required')),
                country: @json(__('frontend.checkout.country_required')),
                name: @json(__('frontend.checkout.card_name_required')),
                card_number: @json(__('frontend.checkout.card_number_required')),
                expiry_month: @json(__('frontend.checkout.expiry_month_required')),
                expiry_year: @json(__('frontend.checkout.expiry_year_required')),
                cvv: @json(__('frontend.checkout.cvv_required')),
                terms: @json(__('frontend.checkout.terms_required')),
                privacy: @json(__('frontend.checkout.privacy_required')),
                delivery: @json(__('frontend.checkout.delivery_required')),
                refund: @json(__('frontend.checkout.refund_required')),
                captcha: @json(__('frontend.checkout.captcha_required'))
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
