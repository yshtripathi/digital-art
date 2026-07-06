@extends('frontend.layouts.main')
@section('title', 'Checkout')
@section('main-content')

    <!-- Page Breadcrumb -->
    <div class="tl-breadcrumb about-banner pt-60 pb-60">
        <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
        <div class="breadcrumb-float-element float-element-1"></div>
        <div class="breadcrumb-float-element float-element-2"></div>
        <div class="breadcrumb-float-element float-element-3"></div>
        <div class="container">
            <div class="row align-items-end">
                <div class="col-md-6">
                    <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ __('common.checkout') }}</h1></div>
                </div>
                <div class="col-md-6">
                    <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                        <li><a href="/">{{ __('common.home') }}</a></li>
                        <li class="current-page">
                            <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                            <span>{{ __('common.checkout') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Section -->
    <section class="kv-checkout-section">
        <div class="container">

            <form name="frmCheckout" id="frmCheckout" method="POST" action="{{route('cart.order')}}">
                @csrf
                <div class="kv-checkout-grid">

                    <!-- Billing Details Column -->
                    <div class="kv-checkout-form">
                        <!-- Billing Information Card -->
                        <div class="kv-checkout-card">
                            <h3 class="kv-checkout-card-title">
                                <i class="fas fa-user-circle"></i>
                                {{ __('common.billing_details')}}
                            </h3>
                            <div class="kv-checkout-form-grid">
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.first_name') }} *</label>
                                    <input type="text" name="first_name" id="first_name" value="" placeholder="{{ __('common.first_name') }}" class="kv-input">
                                    @error('first_name')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.last_name') }} *</label>
                                    <input type="text" name="last_name" id="last_name" value="" placeholder="{{ __('common.last_name') }}" class="kv-input">
                                    @error('last_name')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.email') }} *</label>
                                    <input name="email" type="email" id="email" value="{{ auth()->user()->email ?? '' }}" placeholder="{{ __('common.email') }}" class="kv-input">
                                    @error('email')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.phone') }} *</label>
                                    <input type="tel" name="phone" id="phone" placeholder="{{ __('common.phone') }}" value="{{ auth()->user()->phone ?? '' }}" class="kv-input" pattern="[0-9\-\+\s\(\)]{7,}" inputmode="tel">
                                    @error('phone')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group kv-checkout-form-group-full">
                                    <label class="kv-label">{{ __('common.address') }} *</label>
                                    <input type="text" name="address1" id="address" value="{{ auth()->user()->address ?? '' }}" placeholder="{{ __('common.address') }}" class="kv-input">
                                    @error('address1')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.town_city') }} *</label>
                                    <input type="text" name="city" id="city" value="{{ auth()->user()->city ?? '' }}" placeholder="{{ __('common.town_city') }}" class="kv-input">
                                    @error('city')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.zip_code') }} *</label>
                                    <input type="text" name="post_code" id="post_code" pattern="[0-9]*" placeholder="{{ __('common.zip_code') }}" value="{{ auth()->user()->zip ?? '' }}" class="kv-input">
                                    @error('post_code')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.state') }} *</label>
                                    <input type="text" name="state" id="state" value="{{ auth()->user()->state ?? '' }}" placeholder="{{ __('common.state') }}" class="kv-input">
                                    @error('state')
                                    <span class='kv-error'>{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.country') }} *</label>
                                    <select name="country" id="country" class="kv-input kv-select">
                                        <option value="">{{__('common.select_country_placeholder')}}</option>
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
                                    @error('country')
                                    <span class="kv-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Card -->
                        <div class="kv-checkout-card">
                            <h3 class="kv-checkout-card-title">
                                <i class="fas fa-clipboard-list"></i>
                                {{ __('common.additional_information') }}
                            </h3>
                            <div class="kv-checkout-form-group kv-checkout-form-group-full">
                                <label class="kv-label">{{ __('common.notes') }} *</label>
                                <textarea name="note" placeholder="{{ __('common.notes_about_order') }}" class="kv-input kv-textarea"></textarea>
                            </div>
                        </div>

                        <!-- Payment Card -->
                        <div class="kv-checkout-card">
                            <h3 class="kv-checkout-card-title">
                                <i class="fas fa-credit-card"></i>
                                {{ __('common.card_details') }}
                            </h3>
                            <div class="kv-checkout-form-grid">
                                <div class="kv-checkout-form-group kv-checkout-form-group-full">
                                    <label class="kv-label">{{ __('common.card_holder_name') }}</label>
                                    <input type="text" name="name" id="name_on_card" class="kv-input" placeholder="{{ __('common.card_holder_name') }}">
                                    @error('name')<span class='kv-error'>{{$message}}</span>@enderror
                                </div>
                                <div class="kv-checkout-form-group kv-checkout-form-group-full">
                                    <label class="kv-label">{{ __('common.card_number') }}</label>
                                    <input type="text" name="card_number" id="card_number" placeholder="{{__('common.card_number_placeholder')}}" class="kv-input cc-number" pattern="[0-9\s]{19}" inputmode="numeric" maxlength="19" autocomplete="cc-number" oninput="this.value = this.value.replace(/\D/g, '').substring(0, 16).replace(/(.{4})/g, '$1 ').trim();">
                                    @error('card_number')<span class='kv-error'>{{$message}}</span>@enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.expiry_month') }}</label>
                                    <div class="kv-card-expiry">
                                        <input type="text" class="kv-input" name="expiry_month" id="expiry_month" placeholder="MM" pattern="[0-9]{2}" inputmode="numeric" maxlength="2" min="01" max="12">
                                        <span class="kv-card-separator"> / </span>
                                        <input type="text" class="kv-input" name="expiry_year" id="expiry_year" placeholder="YYYY" pattern="[0-9]{4}" inputmode="numeric" maxlength="4">
                                    </div>
                                    @error('expiry_month')<span class='kv-error'>{{$message}}</span>@enderror
                                    @error('expiry_year')<span class='kv-error'>{{$message}}</span>@enderror
                                </div>
                                <div class="kv-checkout-form-group">
                                    <label class="kv-label">{{ __('common.cvv') }}</label>
                                    <input id="cvv" name="cvv" type="text" autocomplete="off" placeholder="â€¢â€¢â€¢â€¢" class="kv-input cc-cvc" pattern="[0-9]{3,4}" inputmode="numeric" maxlength="4">
                                    @error('cvv')<span class='kv-error'>{{$message}}</span>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="kv-checkout-card kv-checkout-terms">
                            <div class="kv-terms-group">
                                <input type="checkbox" id="terms" name="terms" class="kv-checkbox">
                                <label for="terms">
                                    {{__('common.agree_terms_conditions')}} <a href="{{ route('pages', 'terms-conditions') }}" target='_blank'>{{ __('common.terms_conditions') }}</a>
                                </label>
                                @error('terms')
                                <span class='kv-error'>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="kv-terms-group">
                                <input type="checkbox" id="privacy" name="privacy" class="kv-checkbox">
                                <label for="privacy">
                                    {{__('common.agree_privacy_policy')}} <a href="{{ route('pages', 'privacy-policy') }}" target='_blank'>{{ __('common.privacy_policy') }}</a>
                                </label>
                                @error('privacy')
                                <span class='kv-error'>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="kv-terms-group">
                                <input type="checkbox" id="delivery" name="delivery" class="kv-checkbox">
                                <label for="delivery">
                                    {{__('common.agree_delivery_policy')}} <a href="{{ route('pages', 'delivery-policy') }}" target='_blank'>{{ __('common.delivery_policy') }}</a>
                                </label>
                                @error('delivery')
                                <span class='kv-error'>{{$message}}</span>
                                @enderror
                            </div>
                            <div class="kv-terms-group">
                                <input type="checkbox" id="refund" name="refund" class="kv-checkbox">
                                <label for="refund">
                                    {{__('common.agree_refund_policy')}} <a href="{{ route('pages', 'refund-policy') }}" target='_blank'>{{ __('common.refund_policy') }}</a>
                                </label>
                                @error('refund')
                                <span class='kv-error'>{{$message}}</span>
                                @enderror
                            </div>

                            <div class="kv-payment-description" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(232, 93, 142, 0.2); display: block;">
                                <p style="color: #666; font-size: 0.95rem; margin-bottom: 15px; word-wrap: break-word; overflow-wrap: break-word;">
                                    {{__('common.card_bill_description')}}
                                </p>
                                <div style="text-align: center;">
                                    <img src="{{ asset('assets/images/dba.webp') }}" alt="Brand Logo" class="img-fluid" style="max-height: 45px; max-width: 100%; object-fit: contain;">
                                </div>
                            </div>

                            <!-- Payment Methods -->
                            <div class="kv-payment-methods" style="margin-top: 25px; padding-top: 25px; border-top: 1px solid rgba(232, 93, 142, 0.2); text-align: center;">
                                <img src="{{ asset('assets/images/payment.webp') }}" alt="Payment Methods" class="img-fluid" style="max-height: 40px; opacity: 0.8;">
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Column -->
                    <div class="kv-checkout-summary">
                        <div class="kv-checkout-card kv-checkout-order">
                            <h3 class="kv-checkout-card-title">
                                <i class="fas fa-shopping-bag"></i>
                                {{ __('common.your_order') }}
                            </h3>
                            <div class="kv-checkout-order-table">
                                <div class="kv-checkout-order-header">
                                    <span>{{ __('common.product') }}</span>
                                    <span>{{ __('common.total') }}</span>
                                </div>
                                @php
                                    $total_amount = Helper::totalCartPrice();
                                    if(session()->has('coupon')) {
                                        $total_amount -= Session::get('coupon')['value'];
                                    }
                                @endphp
                                @if(Helper::getAllProductFromCart())
                                @foreach(Helper::getAllProductFromCart() as $key => $cart)
                                @php
                                    $user_id = auth()->check() ? auth()->id() : session('guest');
                                    $points = App\Models\Cart::where('user_id', $user_id)->where('order_id',null)->pluck('points')->first();
                                @endphp
                                <div class="kv-checkout-order-item">
                                    <span class="kv-checkout-order-points">
                                        <i class="fas fa-coins"></i>
                                        {{ number_format($points, 0, '.', ',') }} {{ __('common.points') }}
                                    </span>
                                    <span class="kv-checkout-order-price">
                                        {{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($cart['price'], session('currency')=='JPY' ? 0 : 2, '.', ',') }}
                                    </span>
                                </div>
                                @endforeach
                                @endif
                                <div class="kv-checkout-order-total">
                                    <span>{{ __('common.total') }}:</span>
                                    <span class="kv-checkout-order-total-value">

                                        {{ Helper::getCurrencySymbol(session('currency')) }} {{ number_format($total_amount, session('currency')=='JPY' ? 0 : 2, '.', ',') }}
                                    </span>
                                </div>
                            </div>

                            @if(env('CAPTCHA_ENABLED', true))
                            <!-- Captcha -->
                            <div class="kv-captcha-group">
                                <label class="kv-label">{{ __('common.security_code') }} *</label>
                                <div class="kv-captcha-wrapper">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('common.fill_captcha') }}" class="kv-input">
                                    <div class="kv-captcha-display">
                                        @captcha
                                    </div>
                                </div>
                                @error('captcha')
                                    <span class="kv-error">{{ __('common.captcha_error') }}</span>
                                @enderror
                            </div>
                            @endif

                            <!-- Submit Button -->
                            <button type="submit" class="kv-btn kv-btn-accent kv-btn-lg w-100" id="button-confirm">
                                <i class="fas fa-shield-alt"></i>
                                {{ __('common.place_order') }}
                            </button>

                            <a href="{{ route('home') }}" class="kv-btn kv-btn-outline kv-btn-lg w-100">
                                <i class="fas fa-arrow-left"></i>
                                {{ __('common.continue_shopping') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{url('assets/js/jquery.payment.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#frmCheckout").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    minlength: 10
                },
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
                first_name: "{{ __('common.first_name_required') }}",
                last_name: "{{ __('common.last_name_required') }}",
                email: "{{ __('common.email_required') }}",
                phone: {
                    required: "{{ __('common.phone_required') }}",
                    minlength: "{{ __('common.phone_minlength') }}"
                },
                address1: "{{ __('common.address_required') }}",
                post_code: "{{ __('common.post_code_required') }}",
                city: "{{ __('common.city_required') }}",
                state: "{{ __('common.state_required') }}",
                country: "{{ __('common.country_required') }}",
                name: "{{ __('common.card_name_required') }}",
                card_number: "{{ __('common.card_number_required') }}",
                expiry_month: "{{ __('common.expiry_month_required') }}",
                expiry_year: "{{ __('common.expiry_year_required') }}",
                cvv: "{{ __('common.cvv_required') }}",
                terms: "{{ __('common.accept_terms_conditions') }}",
                privacy: "{{ __('common.accept_privacy_policy') }}",
                delivery: "{{ __('common.accept_delivery_policy') }}",
                refund: "{{ __('common.accept_refund_policy') }}",
                captcha: "{{ __('common.fill_it') }}"
            },
            errorClass: "kv-error",
            errorPlacement: function(error, element) {
                error.css({
                    "font-size": "0.95rem",
                    "color": "#ff4757",
                    "margin-top": "6px",
                    "display": "block",
                    "font-weight": "500"
                });
                error.insertAfter(element);
            }
        });

        // Card CVC formatting
        jQuery('.cc-cvc').payment('formatCardCVC');

        // Phone number input restriction - allow only digits, spaces, hyphens, plus, and parentheses
        jQuery('#phone').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9\-\+\s\(\)]/.test(char)) {
                e.preventDefault();
            }
        });

        // Card number - display as 4111 1111 1111 1111 while typing or pasting
        const formatCardNumber = function(input) {
            const digits = input.value.replace(/\D/g, '').substring(0, 16);
            input.value = digits.replace(/(.{4})/g, '$1 ').trim();
        };

        jQuery('#card_number').on('input paste', function() {
            setTimeout(() => formatCardNumber(this), 0);
        }).on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        });

        // Expiry month - only digits
        jQuery('#expiry_month').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        }).on('input', function() {
            let value = this.value.replace(/[^0-9]/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2);
                if (parseInt(value) > 12) {
                    value = '12';
                }
            }
            this.value = value;
        });

        // Expiry year - only digits
        jQuery('#expiry_year').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        }).on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4);
        });

        // CVV - only digits
        jQuery('#cvv').on('keypress', function(e) {
            const char = String.fromCharCode(e.which);
            if (!/[0-9]/.test(char)) {
                e.preventDefault();
            }
        }).on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 4);
        });
    });
</script>
@endpush

@push('styles')
<style>
    /* Checkout Section */
    .kv-checkout-section {
        background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);
        padding: 60px 20px;
        min-height: 100vh;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
    }

    .kv-checkout-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 40px;
        margin-top: 40px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .kv-checkout-card {
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(232, 93, 142, 0.2);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .kv-checkout-card:hover {
        border-color: rgba(232, 93, 142, 0.4);
        box-shadow: 0 8px 30px rgba(232, 93, 142, 0.15);
        background: rgba(255, 255, 255, 0.8);
    }

    .kv-checkout-card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0a0e27;
        margin: 0 0 20px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kv-checkout-card-title i {
        color: #E85D8E;
        font-size: 1.4rem;
    }

    .kv-checkout-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .kv-checkout-form-group {
        display: flex;
        flex-direction: column;
    }

    .kv-checkout-form-group-full {
        grid-column: 1 / -1;
    }

    .kv-label {
        font-size: 0.95rem;
        font-weight: 600;
        color: #0a0e27;
        margin-bottom: 8px;
        display: block;
    }

    .kv-input,
    .kv-select,
    .kv-textarea {
        width: 100%;
        padding: 12px 15px;
        background: white;
        border: 1.5px solid rgba(232, 93, 142, 0.2);
        border-radius: 12px;
        color: #0a0e27;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        font-family: inherit;
    }

    .kv-input:focus,
    .kv-select:focus,
    .kv-textarea:focus {
        outline: none;
        background: white;
        border-color: #E85D8E;
        box-shadow: 0 0 15px rgba(232, 93, 142, 0.2);
    }

    .kv-input::placeholder,
    .kv-select option {
        color: rgba(10, 14, 39, 0.5);
    }

    .kv-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .kv-error {
        color: #ff4757;
        font-size: 0.85rem;
        margin-top: 6px;
        display: block;
        font-weight: 500;
    }

    .kv-captcha-input .kv-error {
        grid-column: 1 / -1;
        margin-top: 10px;
    }

    .kv-card-expiry {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .kv-card-expiry .kv-input {
        flex: 1;
    }

    .kv-card-separator {
        color: rgba(10, 14, 39, 0.6);
        font-weight: 600;
    }

    .kv-checkbox {
        width: 18px;
        height: 18px;
        margin-right: 10px;
        cursor: pointer;
        accent-color: #E85D8E;
    }

    .kv-terms-group {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(232, 93, 142, 0.15);
    }

    .kv-terms-group:last-child {
        border-bottom: none;
    }

    .kv-terms-group label {
        color: #0a0e27;
        font-size: 0.95rem;
        cursor: pointer;
        margin: 0;
    }

    .kv-terms-group a {
        color: #E85D8E;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .kv-terms-group a:hover {
        color: #C86BFA;
        text-decoration: underline;
    }

    .kv-checkout-summary {
        position: relative;
        top: auto;
        height: fit-content;
        order: 2;
    }

    .kv-checkout-form {
        order: 1;
    }

    .kv-checkout-order {
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(232, 93, 142, 0.2);
    }

    .kv-checkout-order:hover {
        border-color: rgba(232, 93, 142, 0.4);
        box-shadow: 0 8px 30px rgba(232, 93, 142, 0.15);
    }

    .kv-checkout-order-table {
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(232, 93, 142, 0.15);
    }

    .kv-checkout-order-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(232, 93, 142, 0.1);
        font-weight: 700;
        color: #0a0e27;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .kv-checkout-order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid rgba(232, 93, 142, 0.1);
    }

    .kv-checkout-order-points {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #0a0e27;
        font-size: 0.9rem;
    }

    .kv-checkout-order-points i {
        color: #E85D8E;
    }

    .kv-checkout-order-price {
        color: #0a0e27;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .kv-checkout-order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid rgba(232, 93, 142, 0.15);
    }

    .kv-checkout-order-total span:first-child {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0a0e27;
    }

    .kv-checkout-order-total-value {
        font-size: 1.3rem;
        font-weight: 900;
        color: #E85D8E;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .kv-captcha-group {
        margin-bottom: 20px;
    }

    .kv-captcha-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        align-items: center;
    }

    .kv-captcha-display {
        background: white;
        border: 1px solid rgba(232, 93, 142, 0.2);
        border-radius: 16px;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: auto;
    }

    .kv-captcha-display img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        background: white;
        padding: 4px;
    }

    .kv-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 14px 20px;
        border: none;
        border-radius: 16px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
        margin-bottom: 12px;
    }

    .kv-btn-accent {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%);
        color: white;
    }

    .kv-btn-accent:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(232, 93, 142, 0.3);
    }

    .kv-btn-outline {
        background: transparent;
        color: #0a0e27;
        border: 2px solid rgba(232, 93, 142, 0.3);
    }

    .kv-btn-outline:hover {
        border-color: #E85D8E;
        color: #E85D8E;
        background: rgba(232, 93, 142, 0.05);
    }

    .kv-btn i {
        font-size: 1rem;
    }

    .kv-btn-lg {
        padding: 16px 24px;
        font-size: 1rem;
    }

    .w-100 {
        width: 100%;
    }

    @media (max-width: 1300px) {
        .kv-checkout-grid {
            max-width: 700px;
            gap: 30px;
        }

        .kv-page-title {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 1024px) {
        .kv-checkout-grid {
            max-width: 700px;
        }

        .kv-page-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .kv-checkout-section {
            padding: 40px 16px;
        }

        .kv-page-hero {
            min-height: 250px;
        }

        .kv-page-title {
            font-size: 1.8rem;
        }

        .kv-checkout-form-grid {
            grid-template-columns: 1fr;
        }

        .kv-checkout-card {
            padding: 20px;
        }

        .kv-checkout-card-title {
            font-size: 1.1rem;
        }

        .kv-btn {
            padding: 12px 16px;
            font-size: 0.9rem;
        }

        .kv-captcha-wrapper {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .kv-captcha-display {
            min-height: 45px;
        }
    }

    @media (max-width: 480px) {
        .kv-checkout-section {
            padding: 30px 12px;
        }

        .kv-page-hero {
            min-height: 200px;
        }

        .kv-page-title {
            font-size: 1.5rem;
        }

        .kv-page-breadcrumb {
            font-size: 0.85rem;
        }

        .kv-checkout-card {
            padding: 16px;
            margin-bottom: 20px;
        }

        .kv-checkout-form-grid {
            gap: 12px;
        }
    }

    /* Custom validation error styling */
    label.error,
    .kv-error {
        color: #ff4757;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 6px;
        display: block;
    }

    input.error,
    textarea.error,
    select.error {
        border-color: #ff4757;
        background-color: rgba(255, 71, 87, 0.05);
    }

    input.error:focus,
    textarea.error:focus,
    select.error:focus {
        border-color: #ff4757;
    }
    #expiry_month-error {
    position: absolute;
    padding-top: 100px;
}
#expiry_year-error {
    position: absolute;
    padding-top: 100px;
    padding-left: 200px;
}
label#captcha-error {
    position: absolute;
    padding-top: 70px;
}
#delivery-error {
    position: absolute;
    padding-top: 12px;
}
#refund-error {
    position: absolute;
    padding-top: 12px;
}
#terms-error {
    position: absolute;
    padding-top: 12px;
}
#privacy-error {
    position: absolute;
    padding-top: 12px;
}
#
</style>
@endpush

