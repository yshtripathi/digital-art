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

<style>
/* ==========================================================================
   Art Courses — Checkout Page (Gallery Theme)
   ========================================================================== */
.ag-checkout-page, .ag-checkout-page *, .ag-checkout-page *::before, .ag-checkout-page *::after {
    box-sizing: border-box;
}
.ag-checkout-page {
    padding: 40px 40px; 
}
.ag-container { 
    max-width: 1300px; 
    margin: 0 auto; 
    padding: 0; 
}

.ag-checkout-grid {
    display: grid; 
    grid-template-columns: 1.5fr 400px; 
    gap: 80px; 
    align-items: start;
}
@media (max-width: 1100px) { .ag-checkout-grid { grid-template-columns: 1fr; gap: 40px; } }

.ag-text-block {
    background-color: #f5f5f5; padding: 48px; margin-bottom: 32px; box-shadow: 0 15px 35px rgba(0,0,0,0.03);
}
.ag-text-block:last-child { margin-bottom: 0; }
@media (max-width: 768px) { .ag-text-block { padding: 32px 24px; } }

.ag-card-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 28px !important; color: #000000 !important; margin-bottom: 32px !important;
    line-height: 1.2 !important; display: flex; align-items: center; gap: 12px;
    border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 16px;
}
.ag-card-title i { color: #bc9c5c; font-size: 24px; }

.ag-field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }
@media (max-width: 768px) { .ag-field-grid { grid-template-columns: 1fr; gap: 20px; } }

.ag-field { margin-bottom: 24px; position: relative; }
.ag-field--full { grid-column: 1 / -1; }
.ag-label {
    display: block; font-family: var(--font-arial, Arial, sans-serif); font-size: 12px;
    text-transform: uppercase; letter-spacing: 0.15em; color: #000000; margin-bottom: 12px; font-weight: bold;
}
.ag-input, .ag-select, .ag-textarea {
    width: 100%; border: 1px solid rgba(0,0,0,0.15); background: transparent; padding: 18px 24px;
    font-family: var(--font-arial, Arial, sans-serif); font-size: 15px; color: #000000; border-radius: 0; transition: all 0.3s ease;
}
.ag-select {
    appearance: none; -webkit-appearance: none;
    background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23000000%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.4-12.8z%22%2F%3E%3C%2Fsvg%3E");
    background-repeat: no-repeat; background-position: right 24px top 50%; background-size: 10px auto;
}
.ag-textarea { min-height: 120px; resize: vertical; }
.ag-input:focus, .ag-select:focus, .ag-textarea:focus { outline: none; border-color: #bc9c5c; box-shadow: inset 0 0 0 1px #bc9c5c; }
.ag-input::placeholder, .ag-textarea::placeholder { color: #aaaaaa; }
.ag-error-msg { display: flex; align-items: center; gap: 6px; color: #d93025; font-family: var(--font-arial, Arial, sans-serif); font-size: 13px; margin-top: 8px; }
.ag-input.is-invalid, .ag-select.is-invalid, .ag-textarea.is-invalid, .ag-captcha-box.is-invalid { border-color: #d93025 !important; }

.ag-captcha-box { display: flex; align-items: center; gap: 16px; border: 1px solid rgba(0,0,0,0.15); background: transparent; padding: 8px 16px; margin-bottom: 24px; }
.ag-captcha-box input { border: none; background: transparent; flex: 1; padding: 10px 8px; font-family: var(--font-arial, Arial, sans-serif); font-size: 15px; color: #000; }
.ag-captcha-box input:focus { outline: none; }
.ag-captcha-box__img img { height: 40px; display: block; }

.ag-expiry-box { display: flex; align-items: center; gap: 12px; }
.ag-expiry-box .ag-input { flex: 1; text-align: center; padding: 18px 0; }
.ag-expiry-sep { font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif); font-size: 20px; color: #000000; }

.ag-check-field { margin-bottom: 16px; }
.ag-checkbox-wrap { display: flex; align-items: flex-start; gap: 12px; cursor: pointer; font-family: var(--font-arial, Arial, sans-serif); font-size: 13px; color: #555555; line-height: 1.5; }
.ag-checkbox-wrap a { color: #000000; font-weight: bold; text-decoration: underline; text-underline-offset: 3px; }
.ag-checkbox-wrap a:hover { color: #bc9c5c; }
.ag-checkbox-wrap input { display: none; }
.ag-checkbox-mark { width: 18px; height: 18px; border: 1px solid #000000; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; transition: all 0.2s ease; }
.ag-checkbox-wrap input:checked ~ .ag-checkbox-mark { background-color: #000000; }
.ag-checkbox-wrap input:checked ~ .ag-checkbox-mark::after { content: '\2713'; color: #ffffff; font-size: 12px; }

.ag-order-summary { position: sticky; top: 140px; }
.ag-order-row { display: flex; justify-content: space-between; align-items: center; padding: 16px 0; border-bottom: 1px solid rgba(0,0,0,0.1); font-family: var(--font-arial, Arial, sans-serif); font-size: 14px; color: #555555; }
.ag-order-head { font-weight: bold; color: #000000; text-transform: uppercase; letter-spacing: 0.1em; }
.ag-order-total { border-bottom: none; padding-top: 24px; font-size: 18px; font-weight: bold; color: #000000; }
.ag-points { color: #bc9c5c; font-weight: bold; display: flex; align-items: center; gap: 8px;}

form#frmCheckout button[type="submit"].ag-submit-btn {
    background: #000000 !important; color: #ffffff !important; border: 1px solid #000000 !important; font-family: Arial, sans-serif !important; font-size: 13px !important; font-weight: bold !important; text-transform: uppercase !important; letter-spacing: 0.1em !important; cursor: pointer !important; transition: all 0.3s ease !important; padding: 18px 24px !important; white-space: nowrap !important; display: inline-block !important; text-align: center !important; border-radius: 0 !important; outline: none !important; box-shadow: none !important; width: 100%; margin-top: 24px;
}
form#frmCheckout button[type="submit"].ag-submit-btn:hover { background: #ffffff !important; color: #000000 !important; border-bottom-color: #000000 !important; }

.ag-ghost-btn { display: block; text-align: center; font-family: var(--font-arial, Arial, sans-serif); font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.1em; color: #000000; text-decoration: none; border: 1px solid rgba(0,0,0,0.2); padding: 16px; margin-top: 16px; transition: all 0.3s ease; }
.ag-ghost-btn:hover { border-color: #000000; background: rgba(0,0,0,0.02); }

.ag-payment-methods { margin-top: 32px; text-align: center; }
.ag-payment-methods img { max-width: 100%; height: auto; opacity: 0.8; }
.ag-billnote { font-family: var(--font-arial, Arial, sans-serif); font-size: 12px; color: #888888; margin-top: 24px; line-height: 1.6; display: flex; align-items: center; gap: 16px; }
.ag-billnote img { height: 30px; }
</style>

<div class="ag-checkout-page">
    <div class="ag-container">
        <form name="frmCheckout" id="frmCheckout" method="POST" action="{{ route('cart.order') }}">
            @csrf
            <div class="ag-checkout-grid">

                {{-- ===================== FORM COLUMN ===================== --}}
                <div class="ag-checkout-main">

                    {{-- Billing --}}
                    <div class="ag-text-block">
                        <h3 class="ag-card-title"><i class="fas fa-user-circle"></i> {{ __('inkwave.chk_billing') }}</h3>
                        
                        <div class="ag-field-grid">
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_fname') }} *</label>
                                <input type="text" name="first_name" id="first_name" value="" placeholder="{{ __('inkwave.chk_fname') }}" class="ag-input">
                                @error('first_name')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_lname') }} *</label>
                                <input type="text" name="last_name" id="last_name" value="" placeholder="{{ __('inkwave.chk_lname') }}" class="ag-input">
                                @error('last_name')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_email') }} *</label>
                                <input name="email" type="email" id="email" value="{{ auth()->user()->email ?? '' }}" placeholder="{{ __('inkwave.chk_email') }}" class="ag-input">
                                @error('email')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_phone') }} *</label>
                                <input type="tel" name="phone" id="phone" placeholder="{{ __('inkwave.chk_phone') }}" value="{{ auth()->user()->phone ?? '' }}" class="ag-input" pattern="[\d\+\-\(\)\s]{7,}" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')" inputmode="tel">
                                @error('phone')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field ag-field--full">
                                <label class="ag-label">{{ __('inkwave.chk_address') }} *</label>
                                <input type="text" name="address1" id="address" value="{{ auth()->user()->address ?? '' }}" placeholder="{{ __('inkwave.chk_address') }}" class="ag-input">
                                @error('address1')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_city') }} *</label>
                                <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? '' }}" placeholder="{{ __('inkwave.chk_city') }}" class="ag-input">
                                @error('city')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_zip') }} *</label>
                                <input type="text" name="post_code" id="post_code" pattern="[0-9]*" placeholder="{{ __('inkwave.chk_zip') }}" value="{{ auth()->user()->zip ?? '' }}" class="ag-input">
                                @error('post_code')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_state') }} *</label>
                                <input type="text" name="state" id="state" value="{{ auth()->user()->state ?? '' }}" placeholder="{{ __('inkwave.chk_state') }}" class="ag-input">
                                @error('state')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_country') }} *</label>
                                <select name="country" id="country" class="ag-select">
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
                                @error('country')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Additional info --}}
                    <div class="ag-text-block">
                        <h3 class="ag-card-title"><i class="fas fa-clipboard-list"></i> {{ __('inkwave.chk_add_info') }}</h3>
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.chk_notes') }}</label>
                            <textarea name="note" placeholder="{{ __('inkwave.chk_notes_ph') }}" class="ag-textarea"></textarea>
                        </div>
                    </div>

                    {{-- Card details --}}
                    <div class="ag-text-block">
                        <h3 class="ag-card-title"><i class="fas fa-credit-card"></i> {{ __('inkwave.chk_card_details') }}</h3>
                        
                        <div class="ag-field-grid">
                            <div class="ag-field ag-field--full">
                                <label class="ag-label">{{ __('inkwave.chk_card_name') }}</label>
                                <input type="text" name="name" id="name_on_card" class="ag-input" placeholder="{{ __('inkwave.chk_card_name') }}">
                                @error('name')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field ag-field--full">
                                <label class="ag-label">{{ __('inkwave.chk_card_num') }}</label>
                                <input type="text" name="card_number" id="card_number" placeholder="{{ __('inkwave.chk_card_num_ph') }}" class="ag-input cc-number" pattern="[0-9\s]{19}" inputmode="numeric" maxlength="19" autocomplete="cc-number">
                                @error('card_number')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_exp_month') }}</label>
                                <div class="ag-expiry-box">
                                    <input type="text" class="ag-input" name="expiry_month" id="expiry_month" placeholder="MM" pattern="[0-9]{2}" inputmode="numeric" maxlength="2">
                                    <span class="ag-expiry-sep">/</span>
                                    <input type="text" class="ag-input" name="expiry_year" id="expiry_year" placeholder="YYYY" pattern="[0-9]{4}" inputmode="numeric" maxlength="4">
                                </div>
                                @error('expiry_month')<span class="ag-error-msg">{{ $message }}</span>@enderror
                                @error('expiry_year')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.chk_cvv') }}</label>
                                <input id="cvv" name="cvv" type="text" autocomplete="off" placeholder="   " class="ag-input cc-cvc" pattern="[0-9]{3,4}" inputmode="numeric" maxlength="4">
                                @error('cvv')<span class="ag-error-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="ag-text-block">
                        <h3 class="ag-card-title"><i class="fas fa-file-signature"></i> {{ __('inkwave.chk_terms') }}</h3>

                        <div class="ag-check-field">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" id="terms" name="terms">
                                <span class="ag-checkbox-mark"></span>
                                <span>{{ __('inkwave.chk_agree_terms') }} <a href="{{ route('pages', 'terms-conditions') }}" target="_blank">{{ __('inkwave.chk_terms') }}</a></span>
                            </label>
                            @error('terms')<span class="ag-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="ag-check-field">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" id="privacy" name="privacy">
                                <span class="ag-checkbox-mark"></span>
                                <span>{{ __('inkwave.chk_agree_privacy') }} <a href="{{ route('pages', 'privacy-policy') }}" target="_blank">{{ __('inkwave.chk_privacy') }}</a></span>
                            </label>
                            @error('privacy')<span class="ag-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="ag-check-field">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" id="delivery" name="delivery">
                                <span class="ag-checkbox-mark"></span>
                                <span>{{ __('inkwave.chk_agree_delivery') }} <a href="{{ route('pages', 'delivery-policy') }}" target="_blank">{{ __('inkwave.chk_delivery') }}</a></span>
                            </label>
                            @error('delivery')<span class="ag-error-msg">{{ $message }}</span>@enderror
                        </div>
                        <div class="ag-check-field">
                            <label class="ag-checkbox-wrap">
                                <input type="checkbox" id="refund" name="refund">
                                <span class="ag-checkbox-mark"></span>
                                <span>{{ __('inkwave.chk_agree_refund') }} <a href="{{ route('pages', 'refund-policy') }}" target="_blank">{{ __('inkwave.chk_refund') }}</a></span>
                            </label>
                            @error('refund')<span class="ag-error-msg">{{ $message }}</span>@enderror
                        </div>

                        <div class="ag-billnote">
                            <p>{{ __('inkwave.chk_card_bill_desc') }}</p>
                            <img src="{{ asset('assets/images/dba.webp') }}" alt="Brand Logo">
                        </div>
                    </div>
                </div>

                {{-- ===================== SUMMARY COLUMN ===================== --}}
                <aside class="ag-checkout-aside">
                    <div class="ag-text-block ag-order-summary">
                        <h3 class="ag-card-title"><i class="fas fa-shopping-bag"></i> {{ __('inkwave.chk_your_order') }}</h3>

                        @php
                            $total_amount = Helper::totalCartPrice();
                            if(session()->has('coupon')) {
                                $total_amount -= Session::get('coupon')['value'];
                            }
                        @endphp

                        <div class="ag-order-list">
                            <div class="ag-order-row ag-order-head">
                                <span>{{ __('inkwave.chk_product') }}</span>
                                <span>{{ __('inkwave.chk_total') }}</span>
                            </div>
                            @if(Helper::getAllProductFromCart())
                                @foreach(Helper::getAllProductFromCart() as $key => $cart)
                                    @php
                                        $user_id = auth()->check() ? auth()->id() : session('guest');
                                        $points = App\Models\Cart::where('user_id', $user_id)->where('order_id', null)->pluck('points')->first();
                                    @endphp
                                    <div class="ag-order-row">
                                        <span class="ag-points"><i class="fas fa-coins"></i> {{ number_format($points, 0, '.', ',') }} {{ __('inkwave.chk_points') }}</span>
                                        <span>{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                                    </div>
                                @endforeach
                            @endif
                            <div class="ag-order-row ag-order-total">
                                <span>{{ __('inkwave.chk_total') }} :</span>
                                <span>{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                            </div>
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="ag-field" style="margin-top: 32px;">
                                <label class="ag-label">{{ __('inkwave.chk_sec_code') }} *</label>
                                <style>
                                    .ag-captcha-stretch img {
                                        width: 100% !important;
                                        height: 60px !important;
                                        object-fit: cover !important;
                                        display: block !important;
                                    }
                                </style>
                                <div class="ag-captcha-stretch" style="margin-bottom: 16px; border: 1px solid rgba(0,0,0,0.15);">
                                    @captcha
                                </div>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.chk_fill_captcha') }}" class="ag-input">
                                @error('captcha')<span class="ag-error-msg">{{ __('inkwave.chk_captcha_error') }}</span>@enderror
                            </div>
                        @endif

                        <button type="submit" class="ag-submit-btn" id="button-confirm">{{ __('inkwave.chk_place_order') }}</button>
                        <a href="{{ route('home') }}" class="ag-ghost-btn">{{ __('inkwave.chk_continue') }}</a>
                        
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

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('assets/js/jquery.payment.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#frmCheckout").validate({
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
