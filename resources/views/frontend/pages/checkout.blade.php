@extends('frontend.layouts.main')
@section('title', 'Checkout')
@section('main-content')

<x-breadcrumb :title="__('inkwave.checkout_title')" />

<section class="co-section">
    <div class="co-container">
        <form name="frmCheckout" id="frmCheckout" method="POST" action="{{ route('cart.order') }}">
            @csrf
            <div class="co-grid">

                {{-- ===================== FORM COLUMN ===================== --}}
                <div class="co-main">

                    {{-- Billing --}}
                    <div class="co-card">
                        <h3 class="co-card__title"><i class="fas fa-user-circle"></i> {{ __('inkwave.checkout_billing_details') }}</h3>
                        <div class="co-fields">
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_fname') }} *</label>
                                <input type="text" name="first_name" id="first_name" value="" placeholder="{{ __('inkwave.checkout_fname') }}" class="co-input">
                                @error('first_name')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_lname') }} *</label>
                                <input type="text" name="last_name" id="last_name" value="" placeholder="{{ __('inkwave.checkout_lname') }}" class="co-input">
                                @error('last_name')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_email') }} *</label>
                                <input name="email" type="email" id="email" value="{{ auth()->user()->email ?? '' }}" placeholder="{{ __('inkwave.checkout_email') }}" class="co-input">
                                @error('email')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_phone') }} *</label>
                                <input type="tel" name="phone" id="phone" placeholder="{{ __('inkwave.checkout_phone') }}" value="{{ auth()->user()->phone ?? '' }}" class="co-input" pattern="[0-9\-\+\s\(\)]{7,}" inputmode="tel">
                                @error('phone')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field co-field--full">
                                <label class="co-label">{{ __('inkwave.checkout_address') }} *</label>
                                <input type="text" name="address1" id="address" value="{{ auth()->user()->address ?? '' }}" placeholder="{{ __('inkwave.checkout_address') }}" class="co-input">
                                @error('address1')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_city') }} *</label>
                                <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? '' }}" placeholder="{{ __('inkwave.checkout_city') }}" class="co-input">
                                @error('city')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_zip') }} *</label>
                                <input type="text" name="post_code" id="post_code" pattern="[0-9]*" placeholder="{{ __('inkwave.checkout_zip') }}" value="{{ auth()->user()->zip ?? '' }}" class="co-input">
                                @error('post_code')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_state') }} *</label>
                                <input type="text" name="state" id="state" value="{{ auth()->user()->state ?? '' }}" placeholder="{{ __('inkwave.checkout_state') }}" class="co-input">
                                @error('state')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_country') }} *</label>
                                <select name="country" id="country" class="co-input co-select">
                                    <option value="">{{ __('inkwave.checkout_select_country') }}</option>
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
                                @error('country')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Additional info --}}
                    <div class="co-card">
                        <h3 class="co-card__title"><i class="fas fa-clipboard-list"></i> {{ __('inkwave.checkout_add_info') }}</h3>
                        <div class="co-field co-field--full">
                            <label class="co-label">{{ __('inkwave.checkout_notes') }}</label>
                            <textarea name="note" placeholder="{{ __('inkwave.checkout_notes_ph') }}" class="co-input co-textarea"></textarea>
                        </div>
                    </div>

                    {{-- Card details --}}
                    <div class="co-card">
                        <h3 class="co-card__title"><i class="fas fa-credit-card"></i> {{ __('inkwave.checkout_card_details') }}</h3>
                        <div class="co-fields">
                            <div class="co-field co-field--full">
                                <label class="co-label">{{ __('inkwave.checkout_card_name') }}</label>
                                <input type="text" name="name" id="name_on_card" class="co-input" placeholder="{{ __('inkwave.checkout_card_name') }}">
                                @error('name')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field co-field--full">
                                <label class="co-label">{{ __('inkwave.checkout_card_num') }}</label>
                                <input type="text" name="card_number" id="card_number" placeholder="{{ __('inkwave.checkout_card_num_ph') }}" class="co-input cc-number" pattern="[0-9\s]{19}" inputmode="numeric" maxlength="19" autocomplete="cc-number">
                                @error('card_number')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_exp_month') }}</label>
                                <div class="co-expiry">
                                    <input type="text" class="co-input" name="expiry_month" id="expiry_month" placeholder="MM" pattern="[0-9]{2}" inputmode="numeric" maxlength="2">
                                    <span class="co-expiry__sep">/</span>
                                    <input type="text" class="co-input" name="expiry_year" id="expiry_year" placeholder="YYYY" pattern="[0-9]{4}" inputmode="numeric" maxlength="4">
                                </div>
                                @error('expiry_month')<span class="co-error">{{ $message }}</span>@enderror
                                @error('expiry_year')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                            <div class="co-field">
                                <label class="co-label">{{ __('inkwave.checkout_cvv') }}</label>
                                <input id="cvv" name="cvv" type="text" autocomplete="off" placeholder="•••" class="co-input cc-cvc" pattern="[0-9]{3,4}" inputmode="numeric" maxlength="4">
                                @error('cvv')<span class="co-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="co-card">
                        <h3 class="co-card__title"><i class="fas fa-file-signature"></i> {{ __('inkwave.checkout_terms') }}</h3>

                        <div class="co-field co-field--check">
                            <label class="co-check"><input type="checkbox" id="terms" name="terms"><span>{{ __('inkwave.checkout_agree_terms') }} <a href="{{ route('pages', 'terms-conditions') }}" target="_blank">{{ __('inkwave.checkout_terms') }}</a></span></label>
                            @error('terms')<span class="co-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="co-field co-field--check">
                            <label class="co-check"><input type="checkbox" id="privacy" name="privacy"><span>{{ __('inkwave.checkout_agree_privacy') }} <a href="{{ route('pages', 'privacy-policy') }}" target="_blank">{{ __('inkwave.checkout_privacy') }}</a></span></label>
                            @error('privacy')<span class="co-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="co-field co-field--check">
                            <label class="co-check"><input type="checkbox" id="delivery" name="delivery"><span>{{ __('inkwave.checkout_agree_delivery') }} <a href="{{ route('pages', 'delivery-policy') }}" target="_blank">{{ __('inkwave.checkout_delivery') }}</a></span></label>
                            @error('delivery')<span class="co-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="co-field co-field--check">
                            <label class="co-check"><input type="checkbox" id="refund" name="refund"><span>{{ __('inkwave.checkout_agree_refund') }} <a href="{{ route('pages', 'refund-policy') }}" target="_blank">{{ __('inkwave.checkout_refund') }}</a></span></label>
                            @error('refund')<span class="co-error">{{ $message }}</span>@enderror
                        </div>

                        <div class="co-billnote">
                            <p>
                                {{ __('inkwave.checkout_card_bill_desc') }} 
                                <img src="{{ asset('assets/images/dba.webp') }}" alt="Brand Logo" style="height: 1.4em; vertical-align: middle; display: inline-block; margin-left: 6px; margin-bottom: 2px;">
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ===================== SUMMARY COLUMN ===================== --}}
                <aside class="co-aside">
                    <div class="co-card co-summary">
                        <h3 class="co-card__title"><i class="fas fa-shopping-bag"></i> {{ __('inkwave.checkout_your_order') }}</h3>

                        @php
                            $total_amount = Helper::totalCartPrice();
                            if(session()->has('coupon')) {
                                $total_amount -= Session::get('coupon')['value'];
                            }
                        @endphp

                        <div class="co-order">
                            <div class="co-order__head">
                                <span>{{ __('inkwave.checkout_product') }}</span>
                                <span>{{ __('inkwave.checkout_total') }}</span>
                            </div>
                            @if(Helper::getAllProductFromCart())
                                @foreach(Helper::getAllProductFromCart() as $key => $cart)
                                    @php
                                        $user_id = auth()->check() ? auth()->id() : session('guest');
                                        $points = App\Models\Cart::where('user_id', $user_id)->where('order_id', null)->pluck('points')->first();
                                    @endphp
                                    <div class="co-order__item">
                                        <span class="co-order__points"><i class="fas fa-coins"></i> {{ number_format($points, 0, '.', ',') }} {{ __('inkwave.checkout_points') }}</span>
                                        <span class="co-order__price">{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                                    </div>
                                @endforeach
                            @endif
                            <div class="co-order__total">
                                <span class="lbl">{{ __('inkwave.checkout_total') }}:</span>
                                <span class="amt">{{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2, '.', ',') }}</span>
                            </div>
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="co-field co-field--captcha">
                                <label class="co-label">{{ __('inkwave.checkout_sec_code') }} *</label>
                                <div class="co-captcha">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.checkout_fill_captcha') }}" class="co-input">
                                    <div class="co-captcha__img">@captcha</div>
                                </div>
                                @error('captcha')<span class="co-error">{{ __('inkwave.checkout_captcha_error') }}</span>@enderror
                            </div>
                        @endif

                        <button type="submit" class="co-btn co-btn--primary" id="button-confirm"><i class="fas fa-shield-alt"></i> {{ __('inkwave.checkout_place_order') }}</button>
                        <a href="{{ route('home') }}" class="co-btn co-btn--ghost"><i class="fas fa-arrow-left"></i> {{ __('inkwave.checkout_continue') }}</a>

                        <div class="co-pay"><img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods"></div>
                    </div>
                </aside>
            </div>
        </form>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* =========================================================
       CHECKOUT — Structured theme (form + sticky summary)
       ========================================================= */
    .co-section { background-color: var(--color-putty, #c4c3b6); padding: 72px 40px; }
    .co-container { max-width: 1200px; margin: 0 auto; }
    .co-grid { display: grid; grid-template-columns: 1.6fr 1fr; gap: 28px; align-items: start; }

    .co-card {
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 14px; padding: 30px; margin-bottom: 24px;
    }
    .co-main .co-card:last-child { margin-bottom: 0; }
    .co-card__title {
        font-family: var(--font-davinci, serif); font-size: 20px; font-weight: 500;
        color: var(--color-ink, #000); margin: 0 0 22px 0;
        display: flex; align-items: center; gap: 10px;
    }
    .co-card__title i { font-size: 15px; color: var(--color-graphite, #595855); }

    .co-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .co-field { display: flex; flex-direction: column; }
    .co-field--full { grid-column: 1 / -1; }
    .co-label {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.06em; color: var(--color-graphite, #595855); margin-bottom: 8px;
    }
    .co-input {
        width: 100%; box-sizing: border-box;
        background-color: var(--color-bone, #e7e5e4);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 9px; padding: 12px 14px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-ink, #000);
        outline: none; transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .co-input::placeholder { color: #9a9a92; }
    .co-input:focus { border-color: var(--color-ink, #000); box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.08); background-color: var(--color-paper, #fff); }
    .co-select { appearance: none; -webkit-appearance: none; background-image: none; cursor: pointer; }
    .co-textarea { resize: vertical; min-height: 110px; }

    /* Validation state + message (always below the field) */
    .co-input.co-error { border-color: #cf7d7d; box-shadow: 0 0 0 3px rgba(207, 125, 125, 0.18); background-color: var(--color-paper, #fff); }
    .co-error, label.co-error, span.co-error {
        display: block; margin-top: 7px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; line-height: 1.4;
        color: #c0392b; font-weight: 500;
    }

    /* Expiry */
    .co-expiry { display: flex; align-items: center; gap: 10px; }
    .co-expiry .co-input { flex: 1; }
    .co-expiry__sep { color: var(--color-graphite, #595855); font-weight: 600; }

    /* Checkboxes */
    .co-field--check { margin-bottom: 4px; }
    .co-check { display: flex; align-items: flex-start; gap: 10px; cursor: pointer; }
    .co-check input { width: 17px; height: 17px; margin-top: 2px; accent-color: var(--color-ink, #000); flex-shrink: 0; cursor: pointer; }
    .co-check span { font-family: var(--font-helvetica-now, sans-serif); font-size: 13.5px; line-height: 1.5; color: var(--color-ink, #000); }
    .co-check a { color: var(--color-ink, #000); font-weight: 600; text-decoration: underline; }

    .co-billnote { margin-top: 22px; padding-top: 20px; border-top: 1px solid var(--color-vellum, #dfdcd5); text-align: center; }
    .co-billnote p { font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; line-height: 1.6; color: var(--color-graphite, #595855); margin: 0 0 14px 0; }
    .co-billnote img { max-height: 42px; max-width: 100%; object-fit: contain; }

    /* Summary */
    .co-summary { position: sticky; top: 96px; margin-bottom: 0; }
    .co-order { padding-bottom: 8px; margin-bottom: 20px; border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .co-order__head {
        display: flex; justify-content: space-between;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-graphite, #595855);
        padding-bottom: 12px; margin-bottom: 6px; border-bottom: 1px solid var(--color-vellum, #dfdcd5);
    }
    .co-order__item { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .co-order__points { display: flex; align-items: center; gap: 8px; font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; color: var(--color-graphite, #595855); }
    .co-order__points i { color: var(--color-ink, #000); }
    .co-order__price { font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; font-weight: 600; color: var(--color-ink, #000); }
    .co-order__total { display: flex; justify-content: space-between; align-items: baseline; padding-top: 16px; margin-top: 6px; }
    .co-order__total .lbl { font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em; color: var(--color-graphite, #595855); }
    .co-order__total .amt { font-family: var(--font-davinci, serif); font-size: 26px; font-weight: 500; color: var(--color-ink, #000); }

    .co-field--captcha { margin: 8px 0 18px 0; }
    .co-captcha { display: grid; grid-template-columns: 1fr auto; gap: 12px; align-items: center; }
    .co-captcha__img img { height: 46px; width: auto; border-radius: 9px; border: 1px solid var(--color-vellum, #dfdcd5); background: var(--color-paper, #fff); }

    .co-btn {
        display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; box-sizing: border-box;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        border-radius: 28.8px; padding: 15px; text-decoration: none; cursor: pointer; border: 1px solid transparent;
        transition: opacity 0.2s ease, background-color 0.2s ease;
    }
    .co-btn--primary { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); margin-bottom: 12px; }
    .co-btn--primary:hover { opacity: 0.85; color: var(--color-paper, #fff); }
    .co-btn--ghost { background-color: transparent; color: var(--color-ink, #000); border-color: var(--color-vellum, #dfdcd5); }
    .co-btn--ghost:hover { background-color: var(--color-bone, #e7e5e4); color: var(--color-ink, #000); }

    .co-pay { text-align: center; margin-top: 20px; }
    .co-pay img { max-height: 30px; opacity: 1; }

    @media (max-width: 900px) {
        .co-section { padding: 48px 20px; }
        .co-grid { grid-template-columns: 1fr; gap: 20px; }
        .co-summary { position: static; }
    }
    @media (max-width: 520px) {
        .co-card { padding: 22px; }
        .co-fields { grid-template-columns: 1fr; gap: 16px; }
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('assets/js/jquery.payment.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#frmCheckout").validate({
            errorClass: "co-error",
            errorElement: "span",
            // Put every message directly below its field wrapper (handles expiry pair, captcha, checkboxes)
            errorPlacement: function(error, element) {
                var group = element.closest('.co-field');
                if (group.length) { error.appendTo(group); }
                else { error.insertAfter(element); }
            },
            highlight: function(element) { jQuery(element).addClass('co-error'); },
            unhighlight: function(element) { jQuery(element).removeClass('co-error'); },
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
                first_name: "{{ __('inkwave.checkout_err_fname') }}",
                last_name: "{{ __('inkwave.checkout_err_lname') }}",
                email: "{{ __('inkwave.checkout_err_email') }}",
                phone: {
                    required: "{{ __('inkwave.checkout_err_phone') }}",
                    minlength: "{{ __('inkwave.checkout_err_phone_min') }}"
                },
                address1: "{{ __('inkwave.checkout_err_address') }}",
                post_code: "{{ __('inkwave.checkout_err_zip') }}",
                city: "{{ __('inkwave.checkout_err_city') }}",
                state: "{{ __('inkwave.checkout_err_state') }}",
                country: "{{ __('inkwave.checkout_err_country') }}",
                name: "{{ __('inkwave.checkout_err_card_name') }}",
                card_number: "{{ __('inkwave.checkout_err_card_num') }}",
                expiry_month: "{{ __('inkwave.checkout_err_exp_month') }}",
                expiry_year: "{{ __('inkwave.checkout_err_exp_year') }}",
                cvv: "{{ __('inkwave.checkout_err_cvv') }}",
                terms: "{{ __('inkwave.checkout_err_terms') }}",
                privacy: "{{ __('inkwave.checkout_err_privacy') }}",
                delivery: "{{ __('inkwave.checkout_err_delivery') }}",
                refund: "{{ __('inkwave.checkout_err_refund') }}",
                captcha: "{{ __('inkwave.checkout_err_captcha') }}"
            }
        });

        // Card CVC formatting
        jQuery('.cc-cvc').payment('formatCardCVC');

        // Phone — digits, spaces, hyphens, plus, parentheses only
        jQuery('#phone').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9\-\+\s\(\)]/.test(char)) { e.preventDefault(); }
        });

        // Card number — 4-digit groups
        const formatCardNumber = function(input) {
            const digits = input.value.replace(/\D/g, '').substring(0, 16);
            input.value = digits.replace(/(.{4})/g, '$1 ').trim();
        };
        jQuery('#card_number').on('input paste', function() {
            setTimeout(() => formatCardNumber(this), 0);
        }).on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) { e.preventDefault(); }
        });

        // Expiry month — digits, max 12
        jQuery('#expiry_month').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) { e.preventDefault(); }
        }).on('input', function() {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2);
                if (parseInt(value) > 12) { value = '12'; }
            }
            this.value = value;
        });

        // Expiry year — digits
        jQuery('#expiry_year').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) { e.preventDefault(); }
        }).on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4);
        });

        // CVV — digits
        jQuery('#cvv').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) { e.preventDefault(); }
        }).on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4);
        });
    });
</script>
@endpush
