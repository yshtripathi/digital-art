@extends('frontend.layouts.main')
@section('title', __('managenovax.checkout.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.checkout.title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.cart.title'), 'url' => route('cart')],
        ['name' => __('managenovax.checkout.title')]
    ]
])

<section class="co">
    <div class="co__wrap">

        {{-- Progress --}}
        <ol class="co-steps" aria-label="Checkout progress">
            <li class="co-steps__item is-done"><span class="co-steps__dot"><i class="fas fa-check"></i></span> {{ __('managenovax.cart.title') }}</li>
            <li class="co-steps__item is-current"><span class="co-steps__dot">2</span> {{ __('managenovax.checkout.billing') }}</li>
            <li class="co-steps__item is-current"><span class="co-steps__dot">3</span> {{ __('managenovax.checkout.card_details') }}</li>
            <li class="co-steps__item"><span class="co-steps__dot">4</span> {{ __('managenovax.checkout.btn_place') }}</li>
        </ol>

        <form name="frmCheckout" id="frmCheckout" method="POST" action="{{ route('cart.order') }}" novalidate>
            @csrf
            <div class="co__grid">

                {{-- ===================== FORM COLUMN ===================== --}}
                <div class="co-main">

                    {{-- 1. Billing --}}
                    <div class="co-card">
                        <div class="co-card__head">
                            <span class="co-card__num">01</span>
                            <h2 class="co-card__title"><i class="fas fa-user-circle"></i> {{ __('managenovax.checkout.billing') }}</h2>
                        </div>

                        <div class="co-fields">
                            <div class="au-field">
                                <label class="au-label" for="first_name">{{ __('managenovax.checkout.lbl_fname') }} <span class="co-req">*</span></label>
                                <div class="au-input">
                                    <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                                    <input type="text" name="first_name" id="first_name" value="" autocomplete="given-name" placeholder="{{ __('managenovax.checkout.ph_fname') }}">
                                </div>
                                @error('first_name')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="au-field">
                                <label class="au-label" for="last_name">{{ __('managenovax.checkout.lbl_lname') }} <span class="co-req">*</span></label>
                                <div class="au-input">
                                    <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                                    <input type="text" name="last_name" id="last_name" value="" autocomplete="family-name" placeholder="{{ __('managenovax.checkout.ph_lname') }}">
                                </div>
                                @error('last_name')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="au-field">
                                <label class="au-label" for="email">{{ __('managenovax.checkout.lbl_email') }} <span class="co-req">*</span></label>
                                <div class="au-input">
                                    <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                                    <input name="email" type="email" id="email" value="{{ auth()->user()->email ?? '' }}" autocomplete="email" placeholder="{{ __('managenovax.checkout.ph_email') }}">
                                </div>
                                @error('email')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="au-field">
                                <label class="au-label" for="phone">{{ __('managenovax.checkout.lbl_phone') }} <span class="co-req">*</span></label>
                                <div class="au-input">
                                    <i class="fas fa-phone-alt au-input__icon" aria-hidden="true"></i>
                                    <input type="tel" name="phone" id="phone" placeholder="{{ __('managenovax.checkout.ph_phone') }}" value="{{ auth()->user()->phone ?? '' }}" autocomplete="tel" pattern="[\d\+\-\(\)\s]{7,}" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')" inputmode="tel">
                                </div>
                                @error('phone')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="au-field co-fields__full">
                                <label class="au-label" for="address">{{ __('managenovax.checkout.lbl_address') }} <span class="co-req">*</span></label>
                                <div class="au-input">
                                    <i class="fas fa-map-marker-alt au-input__icon" aria-hidden="true"></i>
                                    <input type="text" name="address1" id="address" value="{{ auth()->user()->address ?? '' }}" autocomplete="street-address" placeholder="{{ __('managenovax.checkout.ph_address') }}">
                                </div>
                                @error('address1')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="au-field">
                                <label class="au-label" for="city">{{ __('managenovax.checkout.lbl_city') }} <span class="co-req">*</span></label>
                                <div class="au-input">
                                    <i class="fas fa-city au-input__icon" aria-hidden="true"></i>
                                    <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? '' }}" autocomplete="address-level2" placeholder="{{ __('managenovax.checkout.ph_city') }}">
                                </div>
                                @error('city')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="au-field">
                                <label class="au-label" for="post_code">{{ __('managenovax.checkout.lbl_zip') }} <span class="co-req">*</span></label>
                                <div class="au-input">
                                    <i class="fas fa-mail-bulk au-input__icon" aria-hidden="true"></i>
                                    <input type="text" name="post_code" id="post_code" pattern="[0-9]*" autocomplete="postal-code" placeholder="{{ __('managenovax.checkout.ph_zip') }}" value="{{ auth()->user()->zip ?? '' }}">
                                </div>
                                @error('post_code')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="au-field">
                                <label class="au-label" for="state">{{ __('managenovax.checkout.lbl_state') }} <span class="co-req">*</span></label>
                                <div class="au-input">
                                    <i class="fas fa-map au-input__icon" aria-hidden="true"></i>
                                    <input type="text" name="state" id="state" value="{{ auth()->user()->state ?? '' }}" autocomplete="address-level1" placeholder="{{ __('managenovax.checkout.ph_state') }}">
                                </div>
                                @error('state')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="au-field">
                                <label class="au-label" for="country">{{ __('managenovax.checkout.lbl_country') }} <span class="co-req">*</span></label>
                                <div class="au-input co-select">
                                    <i class="fas fa-globe au-input__icon" aria-hidden="true"></i>
                                    <select name="country" id="country" autocomplete="country">
                                        <option value="">{{ __('managenovax.checkout.ph_country') }}</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BR">Brazil</option>
                                        <option value="CA">Canada</option>
                                        <option value="CN">China</option>
                                        <option value="CO">Colombia</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="EG">Egypt</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GR">Greece</option>
                                        <option value="HK">Hong Kong SAR China</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="JP">Japan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KR">South Korea</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MX">Mexico</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NO">Norway</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="RU">Russia</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SG">Singapore</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="ES">Spain</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TR">Turkey</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="US">United States</option>
                                        <option value="VN">Vietnam</option>
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
                            <h2 class="co-card__title"><i class="fas fa-clipboard-list"></i> {{ __('managenovax.checkout.add_info') }}</h2>
                        </div>
                        <div class="au-field">
                            <label class="au-label" for="note">{{ __('managenovax.checkout.lbl_notes') }}</label>
                            <div class="au-input ct-textarea">
                                <i class="fas fa-comment-dots au-input__icon" aria-hidden="true"></i>
                                <textarea name="note" id="note" rows="4" placeholder="{{ __('managenovax.checkout.ph_notes') }}"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Card details --}}
                    <div class="co-card">
                        <div class="co-card__head">
                            <span class="co-card__num">03</span>
                            <h2 class="co-card__title"><i class="fas fa-credit-card"></i> {{ __('managenovax.checkout.card_details') }}</h2>
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
                                                <span class="co-cc__label">{{ __('managenovax.checkout.lbl_card_name') }}</span>
                                                <span class="co-cc__value" id="coCardName">—</span>
                                            </div>
                                            <div class="co-cc__right">
                                                <span class="co-cc__label">MM/YY</span>
                                                <span class="co-cc__value" id="coCardExp">••/••</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="co-cc__face co-cc__back">
                                        <span class="co-cc__stripe"></span>
                                        <div class="co-cc__sign">
                                            <span class="co-cc__label">{{ __('managenovax.checkout.lbl_cvv') }}</span>
                                            <span class="co-cc__cvv" id="coCardCvv">•••</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="co-fields co-fields--card">
                                <div class="au-field co-fields__full">
                                    <label class="au-label" for="name_on_card">{{ __('managenovax.checkout.lbl_card_name') }} <span class="co-req">*</span></label>
                                    <div class="au-input">
                                        <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                                        <input type="text" name="name" id="name_on_card" autocomplete="cc-name" placeholder="{{ __('managenovax.checkout.ph_card_name') }}">
                                    </div>
                                    @error('name')<span class="au-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="au-field co-fields__full">
                                    <label class="au-label" for="card_number">{{ __('managenovax.checkout.lbl_card_num') }} <span class="co-req">*</span></label>
                                    <div class="au-input">
                                        <i class="fas fa-credit-card au-input__icon" aria-hidden="true"></i>
                                        <input type="text" name="card_number" id="card_number" placeholder="{{ __('managenovax.checkout.ph_card_num') }}" class="cc-number co-mono" pattern="[0-9\s]{19}" inputmode="numeric" maxlength="19" autocomplete="cc-number">
                                    </div>
                                    @error('card_number')<span class="au-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="au-field">
                                    <label class="au-label" for="expiry_month">{{ __('managenovax.checkout.lbl_exp_month') }} <span class="co-req">*</span></label>
                                    <div class="co-expiry">
                                        <div class="au-input au-input--plain">
                                            <input type="text" name="expiry_month" id="expiry_month" placeholder="{{ __('managenovax.checkout.ph_exp_month') }}" pattern="[0-9]{2}" inputmode="numeric" maxlength="2" autocomplete="cc-exp-month">
                                        </div>
                                        <span class="co-expiry__sep">/</span>
                                        <div class="au-input au-input--plain">
                                            <input type="text" name="expiry_year" id="expiry_year" placeholder="{{ __('managenovax.checkout.ph_exp_year') }}" pattern="[0-9]{4}" inputmode="numeric" maxlength="4" autocomplete="cc-exp-year">
                                        </div>
                                    </div>
                                    @error('expiry_month')<span class="au-error">{{ $message }}</span>@enderror
                                    @error('expiry_year')<span class="au-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="au-field">
                                    <label class="au-label" for="cvv">{{ __('managenovax.checkout.lbl_cvv') }} <span class="co-req">*</span></label>
                                    <div class="au-input">
                                        <i class="fas fa-lock au-input__icon" aria-hidden="true"></i>
                                        <input id="cvv" name="cvv" type="text" autocomplete="off" placeholder="{{ __('managenovax.checkout.ph_cvv') }}" class="cc-cvc co-mono" pattern="[0-9]{3,4}" inputmode="numeric" maxlength="4">
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
                            <h2 class="co-card__title"><i class="fas fa-file-signature"></i> {{ __('managenovax.checkout.terms') }}</h2>
                        </div>

                        <div class="co-agree">
                            <div class="co-check">
                                <label class="co-check__row">
                                    <input type="checkbox" id="terms" name="terms" value="1">
                                    <span class="co-check__box"><i class="fas fa-check"></i></span>
                                    <span class="co-check__text">{{ __('managenovax.checkout.agree_terms') }} <a href="{{ route('pages', 'terms-conditions') }}" target="_blank">{{ __('managenovax.checkout.link_terms') }}</a></span>
                                </label>
                                @error('terms')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-check">
                                <label class="co-check__row">
                                    <input type="checkbox" id="privacy" name="privacy" value="1">
                                    <span class="co-check__box"><i class="fas fa-check"></i></span>
                                    <span class="co-check__text">{{ __('managenovax.checkout.agree_privacy') }} <a href="{{ route('pages', 'privacy-policy') }}" target="_blank">{{ __('managenovax.checkout.link_privacy') }}</a></span>
                                </label>
                                @error('privacy')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-check">
                                <label class="co-check__row">
                                    <input type="checkbox" id="delivery" name="delivery" value="1">
                                    <span class="co-check__box"><i class="fas fa-check"></i></span>
                                    <span class="co-check__text">{{ __('managenovax.checkout.agree_delivery') }} <a href="{{ route('pages', 'delivery-policy') }}" target="_blank">{{ __('managenovax.checkout.link_delivery') }}</a></span>
                                </label>
                                @error('delivery')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-check">
                                <label class="co-check__row">
                                    <input type="checkbox" id="refund" name="refund" value="1">
                                    <span class="co-check__box"><i class="fas fa-check"></i></span>
                                    <span class="co-check__text">{{ __('managenovax.checkout.agree_refund') }} <a href="{{ route('pages', 'refund-policy') }}" target="_blank">{{ __('managenovax.checkout.link_refund') }}</a></span>
                                </label>
                                @error('refund')<span class="au-error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="co-billnote">
                            <i class="fas fa-info-circle co-billnote__icon" aria-hidden="true"></i>
                            <p>{{ __('managenovax.checkout.card_bill_desc') }} <img src="{{ asset('assets/images/dba.webp') }}" alt="{{ __('managenovax.checkout.brand_logo') }}"></p>
                        </div>
                    </div>
                </div>

                {{-- ===================== SUMMARY COLUMN ===================== --}}
                <aside class="co-summary">
                    <h2 class="co-summary__title"><i class="fas fa-shopping-bag"></i> {{ __('managenovax.checkout.your_order') }}</h2>

                    @php
                        $total_amount = Helper::totalCartPrice();
                        if(session()->has('coupon')) {
                            $total_amount -= Session::get('coupon')['value'];
                        }
                    @endphp

                    <div class="co-order">
                        <div class="co-order__head">
                            <span>{{ __('managenovax.checkout.product') }}</span>
                            <span>{{ __('managenovax.checkout.total') }}</span>
                        </div>
                        @if(Helper::getAllProductFromCart())
                            @foreach(Helper::getAllProductFromCart() as $key => $cart)
                                @php
                                    $user_id = auth()->check() ? auth()->id() : session('guest');
                                    $points = App\Models\Cart::where('user_id', $user_id)->where('order_id', null)->pluck('points')->first();
                                @endphp
                                <div class="co-order__row">
                                    <span class="co-order__item">
                                        <span class="co-order__icon"><i class="fas fa-coins"></i></span>
                                        {{ number_format($points, 0, '.', ',') }} {{ __('managenovax.checkout.points') }}
                                    </span>
                                    <span class="co-order__price">{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="co-summary__total">
                        <span>{{ __('managenovax.checkout.total') }}</span>
                        <strong>{{ Helper::getCurrencySymbol(session('currency')) }}{{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2, '.', ',') }}</strong>
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="au-field co-summary__captcha">
                            <label class="au-label" for="captcha">{{ __('managenovax.checkout.lbl_sec') }} <span class="co-req">*</span></label>
                            <div class="co-captcha">
                                <div class="co-captcha__top">
                                    <div class="co-captcha__img">@captcha</div>
                                    <button type="button" class="co-captcha__refresh" data-au-captcha aria-label="Refresh code"><i class="fas fa-sync-alt"></i></button>
                                </div>
                                <div class="au-input">
                                    <i class="fas fa-shield-alt au-input__icon" aria-hidden="true"></i>
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('managenovax.checkout.ph_sec') }}">
                                </div>
                            </div>
                            @error('captcha')<span class="au-error">{{ __('managenovax.checkout.err_captcha') }}</span>@enderror
                        </div>
                    @endif

                    <button type="submit" class="co-btn co-btn--lime" id="button-confirm">
                        <i class="fas fa-lock"></i> {{ __('managenovax.checkout.btn_place') }}
                    </button>
                    <a href="{{ route('home') }}" class="co-btn co-btn--outline">{{ __('managenovax.checkout.btn_continue') }}</a>

                    <p class="co-summary__trust"><i class="fas fa-shield-alt"></i> {{ __('managenovax.credits.trust_msg') }}</p>

                    <div class="co-summary__pay">
                        <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods">
                    </div>
                </aside>
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
                first_name: "{{ __('managenovax.checkout.err_fname') }}",
                last_name: "{{ __('managenovax.checkout.err_lname') }}",
                email: "{{ __('managenovax.checkout.err_email') }}",
                phone: {
                    required: "{{ __('managenovax.checkout.err_phone') }}",
                    minlength: "{{ __('managenovax.checkout.err_phone_min') }}"
                },
                address1: "{{ __('managenovax.checkout.err_address') }}",
                post_code: "{{ __('managenovax.checkout.err_zip') }}",
                city: "{{ __('managenovax.checkout.err_city') }}",
                state: "{{ __('managenovax.checkout.err_state') }}",
                country: "{{ __('managenovax.checkout.err_country') }}",
                name: "{{ __('managenovax.checkout.err_card_name') }}",
                card_number: "{{ __('managenovax.checkout.err_card_num') }}",
                expiry_month: "{{ __('managenovax.checkout.err_exp_month') }}",
                expiry_year: "{{ __('managenovax.checkout.err_exp_year') }}",
                cvv: "{{ __('managenovax.checkout.err_cvv') }}",
                terms: "{{ __('managenovax.checkout.err_terms') }}",
                privacy: "{{ __('managenovax.checkout.err_privacy') }}",
                delivery: "{{ __('managenovax.checkout.err_delivery') }}",
                refund: "{{ __('managenovax.checkout.err_refund') }}",
                captcha: "{{ __('managenovax.checkout.err_captcha') }}"
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
