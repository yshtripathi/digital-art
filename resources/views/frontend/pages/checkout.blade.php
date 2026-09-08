@extends('frontend.layouts.main')
@section('title', 'Checkout')
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.checkout.title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.checkout.title')]
    ]
])



<div class="ag-checkout-page">
    <div class="ag-container">
        <form name="frmCheckout" id="frmCheckout" method="POST" action="{{ route('cart.order') }}">
            @csrf
            <div class="ag-checkout-grid">

                {{-- ===================== FORM COLUMN ===================== --}}
                <div class="ag-checkout-main">

                    {{-- Billing --}}
                    <div class="ag-text-block">
                        <h3 class="ag-card-title"><i class="fas fa-user-circle"></i> {{ __('managenovax.checkout.billing') }}</h3>
                        
                        <div class="ag-field-grid">
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_fname') }} *</label>
                                <input type="text" name="first_name" id="first_name" value="" placeholder="{{ __('managenovax.checkout.ph_fname') }}" class="ag-input">
                                @error('first_name')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_lname') }} *</label>
                                <input type="text" name="last_name" id="last_name" value="" placeholder="{{ __('managenovax.checkout.ph_lname') }}" class="ag-input">
                                @error('last_name')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_email') }} *</label>
                                <input name="email" type="email" id="email" value="{{ auth()->user()->email ?? '' }}" placeholder="{{ __('managenovax.checkout.ph_email') }}" class="ag-input">
                                @error('email')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_phone') }} *</label>
                                <input type="tel" name="phone" id="phone" placeholder="{{ __('managenovax.checkout.ph_phone') }}" value="{{ auth()->user()->phone ?? '' }}" class="ag-input" pattern="[\d\+\-\(\)\s]{7,}" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')" inputmode="tel">
                                @error('phone')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field ag-field--full">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_address') }} *</label>
                                <input type="text" name="address1" id="address" value="{{ auth()->user()->address ?? '' }}" placeholder="{{ __('managenovax.checkout.ph_address') }}" class="ag-input">
                                @error('address1')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_city') }} *</label>
                                <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? '' }}" placeholder="{{ __('managenovax.checkout.ph_city') }}" class="ag-input">
                                @error('city')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_zip') }} *</label>
                                <input type="text" name="post_code" id="post_code" pattern="[0-9]*" placeholder="{{ __('managenovax.checkout.ph_zip') }}" value="{{ auth()->user()->zip ?? '' }}" class="ag-input">
                                @error('post_code')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_state') }} *</label>
                                <input type="text" name="state" id="state" value="{{ auth()->user()->state ?? '' }}" placeholder="{{ __('managenovax.checkout.ph_state') }}" class="ag-input">
                                @error('state')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_country') }} *</label>
                                <select name="country" id="country" class="ag-select">
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
                                @error('country')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Additional info --}}
                    <div class="ag-text-block">
                        <h3 class="ag-card-title"><i class="fas fa-clipboard-list"></i> {{ __('managenovax.checkout.add_info') }}</h3>
                        <div class="ag-field">
                            <label class="ag-label">{{ __('managenovax.checkout.lbl_notes') }}</label>
                            <textarea name="note" placeholder="{{ __('managenovax.checkout.ph_notes') }}" class="ag-textarea"></textarea>
                        </div>
                    </div>

                    {{-- Card details --}}
                    <div class="ag-text-block">
                        <h3 class="ag-card-title"><i class="fas fa-credit-card"></i> {{ __('managenovax.checkout.card_details') }}</h3>
                        
                        <div class="ag-field-grid">
                            <div class="ag-field ag-field--full">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_card_name') }}</label>
                                <input type="text" name="name" id="name_on_card" class="ag-input" placeholder="{{ __('managenovax.checkout.ph_card_name') }}">
                                @error('name')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field ag-field--full">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_card_num') }}</label>
                                <input type="text" name="card_number" id="card_number" placeholder="{{ __('managenovax.checkout.ph_card_num') }}" class="ag-input cc-number" pattern="[0-9\s]{19}" inputmode="numeric" maxlength="19" autocomplete="cc-number">
                                @error('card_number')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_exp_month') }}</label>
                                <div class="ag-expiry-box">
                                    <input type="text" class="ag-input" name="expiry_month" id="expiry_month" placeholder="{{ __('managenovax.checkout.ph_exp_month') }}" pattern="[0-9]{2}" inputmode="numeric" maxlength="2">
                                    <span class="ag-expiry-sep">/</span>
                                    <input type="text" class="ag-input" name="expiry_year" id="expiry_year" placeholder="{{ __('managenovax.checkout.ph_exp_year') }}" pattern="[0-9]{4}" inputmode="numeric" maxlength="4">
                                </div>
                                @error('expiry_month')<span class="ag-error-msg">{{ $message }}</span>@enderror
                                @error('expiry_year')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_cvv') }}</label>
                                <input id="cvv" name="cvv" type="text" autocomplete="off" placeholder="{{ __('managenovax.checkout.ph_cvv') }}" class="ag-input cc-cvc" pattern="[0-9]{3,4}" inputmode="numeric" maxlength="4">
                                @error('cvv')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="ag-text-block">
                        <h3 class="ag-card-title"><i class="fas fa-file-signature"></i> {{ __('managenovax.checkout.terms') }}</h3>

                        <div class="ag-check-field">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" id="terms" name="terms" value="1">
                                <span class="ag-checkbox-mark"></span>
                                <span>{{ __('managenovax.checkout.agree_terms') }} <a href="{{ route('pages', 'terms-conditions') }}" target="_blank">{{ __('managenovax.checkout.link_terms') }}</a></span>
                            </label>
                            @error('terms')<span class="ag-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="ag-check-field">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" id="privacy" name="privacy" value="1">
                                <span class="ag-checkbox-mark"></span>
                                <span>{{ __('managenovax.checkout.agree_privacy') }} <a href="{{ route('pages', 'privacy-policy') }}" target="_blank">{{ __('managenovax.checkout.link_privacy') }}</a></span>
                            </label>
                            @error('privacy')<span class="ag-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="ag-check-field">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" id="delivery" name="delivery" value="1">
                                <span class="ag-checkbox-mark"></span>
                                <span>{{ __('managenovax.checkout.agree_delivery') }} <a href="{{ route('pages', 'delivery-policy') }}" target="_blank">{{ __('managenovax.checkout.link_delivery') }}</a></span>
                            </label>
                            @error('delivery')<span class="ag-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="ag-check-field">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" id="refund" name="refund" value="1">
                                <span class="ag-checkbox-mark"></span>
                                <span>{{ __('managenovax.checkout.agree_refund') }} <a href="{{ route('pages', 'refund-policy') }}" target="_blank">{{ __('managenovax.checkout.link_refund') }}</a></span>
                            </label>
                            @error('refund')<span class="ag-error-msg">{{ $message }}</span>@enderror
                        </div>

                        <div class="ag-billnote">
                            <p>{{ __('managenovax.checkout.card_bill_desc') }}</p>
                            <img src="{{ asset('assets/images/dba.webp') }}" alt="{{ __('managenovax.checkout.brand_logo') }}">
                        </div>
                    </div>
                </div>

                {{-- ===================== SUMMARY COLUMN ===================== --}}
                <aside class="ag-checkout-aside">
                    <div class="ag-text-block ag-order-summary">
                        <h3 class="ag-card-title"><i class="fas fa-shopping-bag"></i> {{ __('managenovax.checkout.your_order') }}</h3>

                        @php
                            $total_amount = Helper::totalCartPrice();
                            if(session()->has('coupon')) {
                                $total_amount -= Session::get('coupon')['value'];
                            }
                        @endphp

                        <div class="ag-order-list">
                            <div class="ag-order-row ag-order-head">
                                <span>{{ __('managenovax.checkout.product') }}</span>
                                <span>{{ __('managenovax.checkout.total') }}</span>
                            </div>
                            @if(Helper::getAllProductFromCart())
                                @foreach(Helper::getAllProductFromCart() as $key => $cart)
                                    @php
                                        $user_id = auth()->check() ? auth()->id() : session('guest');
                                        $points = App\Models\Cart::where('user_id', $user_id)->where('order_id', null)->pluck('points')->first();
                                    @endphp
                                    <div class="ag-order-row">
                                        <span class="ag-points"><i class="fas fa-coins"></i> {{ number_format($points, 0, '.', ',') }} {{ __('managenovax.checkout.points') }}</span>
                                        <span>{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                                    </div>
                                @endforeach
                            @endif
                            <div class="ag-order-row ag-order-total">
                                <span>{{ __('managenovax.checkout.total') }} :</span>
                                <span>{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                            </div>
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="ag-field" style="margin-top: 32px;">
                                <label class="ag-label">{{ __('managenovax.checkout.lbl_sec') }} *</label>
                                
                                <div class="ag-captcha-stretch" style="margin-bottom: 16px; border: 1px solid rgba(0,0,0,0.15);">
                                    @captcha
                                </div>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('managenovax.checkout.ph_sec') }}" class="ag-input">
                                @error('captcha')<span class="ag-error-msg">{{ __('managenovax.checkout.err_captcha') }}</span>@enderror
                            </div>
                        @endif

                        <button type="submit" class="ag-submit-btn" id="button-confirm">{{ __('managenovax.checkout.btn_place') }}</button>
                        <a href="{{ route('home') }}" class="ag-ghost-btn">{{ __('managenovax.checkout.btn_continue') }}</a>
                        
                        <div class="ag-payment-methods">
                            <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods">
                        </div>
                    </div>
                </aside>
            </div>
        </form>
    </div>
</div>

@endsection

<style>
    .ag-checkbox-wrap input.is-invalid ~ .ag-checkbox-mark { border-color: #d93025 !important; }
</style>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('assets/js/jquery.payment.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#frmCheckout").validate({
            ignore: ":hidden:not([type=checkbox])",
            errorClass: "ag-error-msg",
            errorElement: "span",
            errorPlacement: function(error, element) {
                var group = element.closest('.ag-field');
                if (group.length) { error.appendTo(group); }
                else { 
                    var check = element.closest('.ag-check-field');
                    if (check.length) { error.appendTo(check); }
                    else { error.insertAfter(element); }
                }
            },
            highlight: function(element) { 
                jQuery(element).addClass('is-invalid'); 
                if(element.id === 'captcha') {
                    jQuery(element).closest('.ag-captcha-box').addClass('is-invalid');
                }
            },
            unhighlight: function(element) { 
                jQuery(element).removeClass('is-invalid'); 
                if(element.id === 'captcha') {
                    jQuery(element).closest('.ag-captcha-box').removeClass('is-invalid');
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
@endpush
