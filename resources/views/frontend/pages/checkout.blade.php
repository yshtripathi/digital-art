@extends('frontend.layouts.main')
@section('title', 'Checkout')
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.chk_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.chk_title')]
    ]
])



<section class="duo-co-wrap">
    <div class="duo-co-container">
        <form name="frmCheckout" id="frmCheckout" method="POST" action="{{ route('cart.order') }}">
            @csrf
            <div class="duo-co-grid">

                {{-- ===================== FORM COLUMN ===================== --}}
                <div class="duo-co-main">

                    {{-- Billing --}}
                    <div class="duo-co-card">
                        <h3 class="duo-co-card__title"><i class="fas fa-user-circle"></i> {{ __('inkwave.chk_billing') }}</h3>
                        <div class="duo-co-fields">
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_fname') }} *</label>
                                <input type="text" name="first_name" id="first_name" value="" placeholder="{{ __('inkwave.chk_fname') }}" class="duo-co-input">
                                @error('first_name')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_lname') }} *</label>
                                <input type="text" name="last_name" id="last_name" value="" placeholder="{{ __('inkwave.chk_lname') }}" class="duo-co-input">
                                @error('last_name')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_email') }} *</label>
                                <input name="email" type="email" id="email" value="{{ auth()->user()->email ?? '' }}" placeholder="{{ __('inkwave.chk_email') }}" class="duo-co-input">
                                @error('email')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_phone') }} *</label>
                                <input type="tel" name="phone" id="phone" placeholder="{{ __('inkwave.chk_phone') }}" value="{{ auth()->user()->phone ?? '' }}" class="duo-co-input" pattern="[0-9\-\+\s\(\)]{7,}" inputmode="tel">
                                @error('phone')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field duo-co-field--full">
                                <label class="duo-co-label">{{ __('inkwave.chk_address') }} *</label>
                                <input type="text" name="address1" id="address" value="{{ auth()->user()->address ?? '' }}" placeholder="{{ __('inkwave.chk_address') }}" class="duo-co-input">
                                @error('address1')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_city') }} *</label>
                                <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? '' }}" placeholder="{{ __('inkwave.chk_city') }}" class="duo-co-input">
                                @error('city')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_zip') }} *</label>
                                <input type="text" name="post_code" id="post_code" pattern="[0-9]*" placeholder="{{ __('inkwave.chk_zip') }}" value="{{ auth()->user()->zip ?? '' }}" class="duo-co-input">
                                @error('post_code')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_state') }} *</label>
                                <input type="text" name="state" id="state" value="{{ auth()->user()->state ?? '' }}" placeholder="{{ __('inkwave.chk_state') }}" class="duo-co-input">
                                @error('state')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_country') }} *</label>
                                <select name="country" id="country" class="duo-co-input duo-co-select">
                                    <option value="">{{ __('inkwave.chk_select_country') }}</option>
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
                                @error('country')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Additional info --}}
                    <div class="duo-co-card">
                        <h3 class="duo-co-card__title"><i class="fas fa-clipboard-list"></i> {{ __('inkwave.chk_add_info') }}</h3>
                        <div class="duo-co-field duo-co-field--full">
                            <label class="duo-co-label">{{ __('inkwave.chk_notes') }}</label>
                            <textarea name="note" placeholder="{{ __('inkwave.chk_notes_ph') }}" class="duo-co-input duo-co-textarea"></textarea>
                        </div>
                    </div>

                    {{-- Card details --}}
                    <div class="duo-co-card">
                        <h3 class="duo-co-card__title"><i class="fas fa-credit-card"></i> {{ __('inkwave.chk_card_details') }}</h3>
                        <div class="duo-co-fields">
                            <div class="duo-co-field duo-co-field--full">
                                <label class="duo-co-label">{{ __('inkwave.chk_card_name') }}</label>
                                <input type="text" name="name" id="name_on_card" class="duo-co-input" placeholder="{{ __('inkwave.chk_card_name') }}">
                                @error('name')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field duo-co-field--full">
                                <label class="duo-co-label">{{ __('inkwave.chk_card_num') }}</label>
                                <input type="text" name="card_number" id="card_number" placeholder="{{ __('inkwave.chk_card_num_ph') }}" class="duo-co-input cc-number" pattern="[0-9\s]{19}" inputmode="numeric" maxlength="19" autocomplete="cc-number">
                                @error('card_number')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_exp_month') }}</label>
                                <div class="duo-co-expiry">
                                    <input type="text" class="duo-co-input" name="expiry_month" id="expiry_month" placeholder="MM" pattern="[0-9]{2}" inputmode="numeric" maxlength="2">
                                    <span class="duo-co-expiry__sep">/</span>
                                    <input type="text" class="duo-co-input" name="expiry_year" id="expiry_year" placeholder="YYYY" pattern="[0-9]{4}" inputmode="numeric" maxlength="4">
                                </div>
                                @error('expiry_month')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                                @error('expiry_year')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_cvv') }}</label>
                                <input id="cvv" name="cvv" type="text" autocomplete="off" placeholder="•••" class="duo-co-input cc-cvc" pattern="[0-9]{3,4}" inputmode="numeric" maxlength="4">
                                @error('cvv')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="duo-co-card">
                        <h3 class="duo-co-card__title"><i class="fas fa-file-signature"></i> {{ __('inkwave.chk_terms') }}</h3>

                        <div class="duo-co-field duo-co-field--check">
                            <label class="duo-co-check"><input type="checkbox" id="terms" name="terms"><span>{{ __('inkwave.chk_agree_terms') }} <a href="{{ route('pages', 'terms-conditions') }}" target="_blank">{{ __('inkwave.chk_terms') }}</a></span></label>
                            @error('terms')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="duo-co-field duo-co-field--check">
                            <label class="duo-co-check"><input type="checkbox" id="privacy" name="privacy"><span>{{ __('inkwave.chk_agree_privacy') }} <a href="{{ route('pages', 'privacy-policy') }}" target="_blank">{{ __('inkwave.chk_privacy') }}</a></span></label>
                            @error('privacy')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="duo-co-field duo-co-field--check">
                            <label class="duo-co-check"><input type="checkbox" id="delivery" name="delivery"><span>{{ __('inkwave.chk_agree_delivery') }} <a href="{{ route('pages', 'delivery-policy') }}" target="_blank">{{ __('inkwave.chk_delivery') }}</a></span></label>
                            @error('delivery')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="duo-co-field duo-co-field--check">
                            <label class="duo-co-check"><input type="checkbox" id="refund" name="refund"><span>{{ __('inkwave.chk_agree_refund') }} <a href="{{ route('pages', 'refund-policy') }}" target="_blank">{{ __('inkwave.chk_refund') }}</a></span></label>
                            @error('refund')<span class="duo-co-error-msg">{{ $message }}</span>@enderror
                        </div>

                        <div class="duo-co-billnote">
                            <p>
                                {{ __('inkwave.chk_card_bill_desc') }}
                                <img src="{{ asset('assets/images/dba.webp') }}" alt="Brand Logo">
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ===================== SUMMARY COLUMN ===================== --}}
                <aside class="duo-co-aside">
                    <div class="duo-co-card duo-co-summary">
                        <h3 class="duo-co-card__title"><i class="fas fa-shopping-bag"></i> {{ __('inkwave.chk_your_order') }}</h3>

                        @php
                            $total_amount = Helper::totalCartPrice();
                            if(session()->has('coupon')) {
                                $total_amount -= Session::get('coupon')['value'];
                            }
                        @endphp

                        <div class="duo-co-order">
                            <div class="duo-co-order__head">
                                <span>{{ __('inkwave.chk_product') }}</span>
                                <span>{{ __('inkwave.chk_total') }}</span>
                            </div>
                            @if(Helper::getAllProductFromCart())
                                @foreach(Helper::getAllProductFromCart() as $key => $cart)
                                    @php
                                        $user_id = auth()->check() ? auth()->id() : session('guest');
                                        $points = App\Models\Cart::where('user_id', $user_id)->where('order_id', null)->pluck('points')->first();
                                    @endphp
                                    <div class="duo-co-order__item">
                                        <span class="duo-co-order__points"><i class="fas fa-coins"></i> {{ number_format($points, 0, '.', ',') }} {{ __('inkwave.chk_points') }}</span>
                                        <span class="duo-co-order__price">{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                                    </div>
                                @endforeach
                            @endif
                            <div class="duo-co-order__total">
                                <span class="lbl">{{ __('inkwave.chk_total') }} :</span>
                                <span class="amt">{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                            </div>
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="duo-co-field">
                                <label class="duo-co-label">{{ __('inkwave.chk_sec_code') }} *</label>
                                <div class="duo-co-captcha-box">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.chk_fill_captcha') }}">
                                    <div class="duo-co-captcha-box__img">@captcha</div>
                                </div>
                                @error('captcha')<span class="duo-co-error-msg">{{ __('inkwave.chk_captcha_error') }}</span>@enderror
                            </div>
                        @endif

                        <button type="submit" class="duo-co-btn duo-co-btn--primary" id="button-confirm"><i class="fas fa-shield-alt"></i> {{ __('inkwave.chk_place_order') }}</button>
                        <a href="{{ route('home') }}" class="duo-co-btn duo-co-btn--ghost"><i class="fas fa-arrow-left"></i> {{ __('inkwave.chk_continue') }}</a>
                        
                        <div class="duo-co-pay">
                            <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods">
                        </div>
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
            errorClass: "duo-co-error-msg",
            errorElement: "span",
            // Put every message directly below its field wrapper (handles expiry pair, captcha, checkboxes)
            errorPlacement: function(error, element) {
                var group = element.closest('.duo-co-field');
                if (group.length) { error.appendTo(group); }
                else { error.insertAfter(element); }
            },
            highlight: function(element) { 
                jQuery(element).addClass('duo-co-error-input'); 
                if(element.id === 'captcha') {
                    jQuery(element).closest('.duo-co-captcha-box').addClass('duo-co-error-input');
                }
            },
            unhighlight: function(element) { 
                jQuery(element).removeClass('duo-co-error-input'); 
                if(element.id === 'captcha') {
                    jQuery(element).closest('.duo-co-captcha-box').removeClass('duo-co-error-input');
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
                first_name: "{{ __('inkwave.chk_err_fname') }}",
                last_name: "{{ __('inkwave.chk_err_lname') }}",
                email: "{{ __('inkwave.chk_err_email') }}",
                phone: {
                    required: "{{ __('inkwave.chk_err_phone') }}",
                    minlength: "{{ __('inkwave.chk_err_phone_min') }}"
                },
                address1: "{{ __('inkwave.chk_err_address') }}",
                post_code: "{{ __('inkwave.chk_err_zip') }}",
                city: "{{ __('inkwave.chk_err_city') }}",
                state: "{{ __('inkwave.chk_err_state') }}",
                country: "{{ __('inkwave.chk_err_country') }}",
                name: "{{ __('inkwave.chk_err_card_name') }}",
                card_number: "{{ __('inkwave.chk_err_card_num') }}",
                expiry_month: "{{ __('inkwave.chk_err_exp_month') }}",
                expiry_year: "{{ __('inkwave.chk_err_exp_year') }}",
                cvv: "{{ __('inkwave.chk_err_cvv') }}",
                terms: "{{ __('inkwave.chk_err_terms') }}",
                privacy: "{{ __('inkwave.chk_err_privacy') }}",
                delivery: "{{ __('inkwave.chk_err_delivery') }}",
                refund: "{{ __('inkwave.chk_err_refund') }}",
                captcha: "{{ __('inkwave.chk_err_captcha') }}"
            }
        });

        // Card CVC formatting (only if jquery.payment loaded)
        if (jQuery.fn.payment) { jQuery('.cc-cvc').payment('formatCardCVC'); }
    });

    // --- Input sanitising (vanilla JS, runs even if jQuery/CDN fails to load) ---
    document.addEventListener('DOMContentLoaded', function () {
        // Strip characters matching `re` from an input, on typing, paste and autofill.
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

        // Phone — remove letters only; digits & special characters allowed
        sanitise('phone', /[a-zA-Z]/g);

        // Card number — digits only, grouped into blocks of 4 (max 16 digits)
        var card = document.getElementById('card_number');
        if (card) {
            var formatCard = function () {
                var digits = card.value.replace(/\D/g, '').substring(0, 16);
                card.value = digits.replace(/(.{4})/g, '$1 ').trim();
            };
            card.addEventListener('input', formatCard);
            card.addEventListener('paste', function () { setTimeout(formatCard, 0); });
        }

        // Expiry month — digits only, max 2, capped at 12
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

        // Expiry year — digits only, max 4
        sanitise('expiry_year', /\D/g, 4);

        // CVV — digits only, max 4
        sanitise('cvv', /\D/g, 4);
    });
</script>
@endpush
