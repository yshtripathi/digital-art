@extends('frontend.layouts.main')
@section('title', __('inkwave.contact_us_page_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.contact_us_page_title'),
    'links' => [
        ['name' => __('inkwave.top_nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.contact_us_page_title')]
    ]
])





<div class="ag-contact-page">
    
    {{-- SECTION 1: Company Details (Grid Layout) --}}
    <section class="ag-section" style="padding-top: 40px;">
        <div class="ag-container">
            <h2 class="ag-title ag-title--center">{{ __('inkwave.contact_us_info_heading') }}</h2>
            
            <div class="ag-grid-4">
                <div class="ag-card" style="padding: 40px 16px;">
                    <i class="fas fa-phone" style="font-size: 32px; color: #bc9c5c; margin-bottom: 24px;"></i>
                    <h4>{{ __('inkwave.contact_us_lbl_phone') }}</h4>
                    <p style="margin-top: 16px;"><a href="tel:{{ $misc['Company Phone'] ?? '[Company Phone]' }}" style="color: #555; text-decoration: none;">{{ $misc['Company Phone'] ?? '[Company Phone]' }}</a></p>
                </div>

                <div class="ag-card" style="padding: 40px 16px;">
                    <i class="fas fa-envelope" style="font-size: 32px; color: #bc9c5c; margin-bottom: 24px;"></i>
                    <h4>{{ __('inkwave.contact_us_lbl_email') }}</h4>
                    <p style="margin-top: 16px;"><a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}">{{ $misc['Company Email'] ?? '[Company Email]' }}</a></p>
                </div>
                
                <div class="ag-card" style="padding: 40px 16px;">
                    <i class="fas fa-map-marker-alt" style="font-size: 32px; color: #bc9c5c; margin-bottom: 24px;"></i>
                    <h4>{{ __('inkwave.contact_us_lbl_location') }}</h4>
                    <p style="margin-top: 16px;">{{ $misc['Company Address'] ?? '[Company Address]' }}</p>
                </div>
                
                <div class="ag-card" style="padding: 40px 16px;">
                    <i class="fas fa-building" style="font-size: 32px; color: #bc9c5c; margin-bottom: 24px;"></i>
                    <h4>{{ __('inkwave.contact_us_lbl_company') }}</h4>
                    <p style="margin-top: 16px;">{{ $misc['Company Name'] ?? '[Company Name]' }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION 2: Contact Form (Split Layout) --}}
    <section class="ag-section">
        <div class="ag-container">
            <div class="ag-split">
                <div class="ag-split__img">
                    <img src="{{ asset('assets/images/contact-bg.webp') }}" alt="Contact Artora Studios">
                </div>
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <h2 class="ag-title">{{ __('inkwave.contact_us_form_heading') }}</h2>
                    <p class="ag-text" style="margin-bottom: 40px !important;">{{ __('inkwave.contact_us_form_desc') }}</p>
                    
                    <form method="POST" action="{{ route('contact.send') }}" id="contactform" onsubmit="return handleSubmit(event)">
                        @csrf
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_us_fld_name') }}</label>
                            <input type="text" name="name" id="name" placeholder="{{ __('inkwave.contact_us_ph_name') }}" class="ag-input @error('name') is-invalid @enderror">
                            @error('name') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_us_fld_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('inkwave.contact_us_ph_email') }}" class="ag-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_us_fld_phone') }}</label>
                            <input type="tel" name="phone" id="phone" placeholder="{{ __('inkwave.contact_us_ph_phone') }}" class="ag-input @error('phone') is-invalid @enderror" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')">
                            @error('phone') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_us_fld_subject') }}</label>
                            <input type="text" name="subject" id="subject" placeholder="{{ __('inkwave.contact_us_ph_subject') }}" class="ag-input">
                        </div>
                        
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_us_fld_msg') }}</label>
                            <textarea name="message" id="message" placeholder="{{ __('inkwave.contact_us_ph_msg') }}" class="ag-input ag-textarea @error('message') is-invalid @enderror"></textarea>
                            @error('message') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.contact_us_fld_captcha') }}</label>
                                <div class="ag-captcha-box @error('captcha') is-invalid @enderror">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.contact_us_ph_captcha') }}">
                                    <div class="ag-captcha-box__img">@captcha</div>
                                </div>
                                @error('captcha') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ __('inkwave.contact_us_err_captcha_inv') }}</span> @enderror
                            </div>
                        @endif

                        <div style="margin-top: 48px;">
                            <button type="submit" class="ag-contact-submit-btn">{{ __('inkwave.contact_us_btn_submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
</div>

@endsection

@push('scripts')
<script>
    function handleSubmit(event) {
        event.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const subject = document.getElementById('subject').value.trim();
        const message = document.getElementById('message').value.trim();
        const captchaEl = document.getElementById('captcha');
        const captcha = captchaEl ? captchaEl.value.trim() : 'ok';

        // Clear previous client-side messages
        document.querySelectorAll('.custom-error-message').forEach(el => el.remove());
        document.querySelectorAll('.ag-input, .ag-captcha-box').forEach(el => el.classList.remove('is-invalid'));

        const errors = [];
        if (!name) errors.push({ field: 'name', message: '{{ __('inkwave.contact_us_err_name') }}' });
        if (!email) errors.push({ field: 'email', message: '{{ __('inkwave.contact_us_err_email_req') }}' });
        else if (!isValidEmail(email)) errors.push({ field: 'email', message: '{{ __('inkwave.contact_us_err_email_inv') }}' });
        if (!phone) errors.push({ field: 'phone', message: '{{ __('inkwave.contact_us_err_phone') }}' });
        if (!subject) errors.push({ field: 'subject', message: '{{ __('inkwave.contact_us_err_subj') }}' });
        if (!message) errors.push({ field: 'message', message: '{{ __('inkwave.contact_us_err_msg') }}' });
        if (captchaEl && !captcha) errors.push({ field: 'captcha', message: '{{ __('inkwave.contact_us_err_captcha_req') }}' });

        if (errors.length) {
            errors.forEach(showFieldError);
            return false;
        }

        document.getElementById('contactform').submit();
    }

    function showFieldError(error) {
        const field = document.getElementById(error.field);
        if (!field) return;
        if(error.field === 'captcha') {
            field.parentElement.classList.add('is-invalid');
        } else {
            field.classList.add('is-invalid');
        }
        const wrapper = field.closest('.ag-field') || field.parentElement;
        const span = document.createElement('span');
        span.className = 'ag-error-msg custom-error-message';
        span.innerHTML = '<i class="fas fa-info-circle"></i> ' + error.message;
        wrapper.appendChild(span);
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function bindClear(id, validator) {
        const el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('input', function () {
            const ok = validator(this.value.trim());
            if (ok) {
                if(this.id === 'captcha') {
                    this.parentElement.classList.remove('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
                const wrapper = this.closest('.ag-field');
                const msg = wrapper && wrapper.querySelector('.custom-error-message');
                if (msg) msg.remove();
            }
        });
    }
    
    bindClear('name', v => !!v);
    bindClear('email', v => v && isValidEmail(v));
    bindClear('phone', v => !!v);
    bindClear('subject', v => !!v);
    bindClear('message', v => !!v);
    bindClear('captcha', v => !!v);
</script>
@endpush
