@extends('frontend.layouts.main')
@section('title', __('inkwave.contact_pg_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.contact_pg_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.contact_pg_title')]
    ]
])



<style>
/* ==========================================================================
   Art Courses — Contact Page (Gallery Theme)
   ========================================================================== */

/* Reusable Layout Wrappers */
.ag-section {
    padding: 40px 40px; /* Keep elegant spacing between sections */
}

/* Colored Text Blocks */
.ag-text-block {
    padding: 64px 80px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.05);
}
.ag-bg-bone {
    background-color: #f5f5f5;
}

.ag-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 5%;
}

/* Split Layout (Hero & Philosophy) */
.ag-split {
    display: flex;
    align-items: center;
    gap: 80px;
}
.ag-split--reverse {
    flex-direction: row-reverse;
}
.ag-split__img {
    flex: 1;
    position: relative;
}
.ag-split__img::after {
    content: '';
    position: absolute;
    top: 24px;
    left: 24px;
    right: -24px;
    bottom: -24px;
    border: 1px solid #bc9c5c;
    z-index: 0;
}
.ag-split__img img {
    width: 100%;
    max-height: 800px;
    object-fit: cover;
    display: block;
    position: relative;
    z-index: 1;
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}
.ag-split__content {
    flex: 1.2; /* Slightly wider text block to accommodate padding */
}

/* Typography */
.ag-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 48px !important;
    color: #000000 !important;
    margin-bottom: 32px !important;
    line-height: 1.2 !important;
    letter-spacing: 0.02em !important;
}
.ag-title--center { text-align: center !important; margin-bottom: 80px !important; }

.ag-text {
    font-family: var(--font-arial, Arial, sans-serif) !important;
    font-size: 16px !important;
    color: #444444 !important;
    line-height: 1.9 !important;
    margin-bottom: 24px !important;
    letter-spacing: 0.01em;
}

/* 4-Column Grid */
.ag-grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
}
.ag-card {
    text-align: center;
    background: #ffffff;
    padding-bottom: 32px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.03);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}
.ag-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}
.ag-card h4 {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 24px !important;
    margin-bottom: 16px !important;
    color: #000000 !important;
    padding: 0 24px;
}
.ag-card p, .ag-card a {
    font-family: var(--font-arial, Arial, sans-serif) !important;
    font-size: 15px !important;
    color: #666666 !important;
    line-height: 1.7 !important;
    padding: 0 24px;
    margin: 0;
    text-decoration: none;
}
.ag-card a:hover {
    color: #bc9c5c !important;
}

/* Form styling */
.ag-field {
    margin-bottom: 24px;
    position: relative;
}
.ag-label {
    display: block;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #000000;
    margin-bottom: 12px;
    font-weight: bold;
}
.ag-input {
    width: 100%;
    border: 1px solid rgba(0,0,0,0.15);
    background: transparent;
    padding: 18px 24px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px;
    color: #000000;
    border-radius: 0;
    transition: all 0.3s ease;
}
.ag-input:focus {
    outline: none;
    border-color: #bc9c5c;
    box-shadow: inset 0 0 0 1px #bc9c5c;
}
.ag-input::placeholder {
    color: #aaaaaa;
}
.ag-textarea {
    resize: vertical;
    min-height: 180px;
}
.ag-error-msg {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #d93025;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    margin-top: 8px;
}
.ag-input.is-invalid, .ag-captcha-box.is-invalid {
    border-color: #d93025 !important;
}

/* Captcha styling */
.ag-captcha-box {
    display: flex;
    align-items: center;
    gap: 16px;
    border: 1px solid rgba(0,0,0,0.15);
    background: transparent;
    padding: 8px 16px;
}
.ag-captcha-box input {
    border: none;
    background: transparent;
    flex: 1;
    padding: 10px 8px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px;
    color: #000;
}
.ag-captcha-box input:focus {
    outline: none;
}
.ag-captcha-box__img img {
    height: 40px;
    display: block;
}

/* Custom Submit Button Styling */
form#contactform button[type="submit"].ag-contact-submit-btn {
    background: #000000 !important;
    color: #ffffff !important;
    border: 1px solid #000000 !important;
    font-family: Arial, sans-serif !important;
    font-size: 13px !important;
    font-weight: bold !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    padding: 12px 24px !important;
    white-space: nowrap !important;
    display: inline-block !important;
    text-align: center !important;
    border-radius: 0 !important;
    outline: none !important;
    box-shadow: none !important;
}
form#contactform button[type="submit"].ag-contact-submit-btn:hover {
    background: #ffffff !important;
    color: #000000 !important;
    border-bottom-color: #000000 !important;
}

@media (max-width: 992px) {
    .ag-split { flex-direction: column; gap: 64px; }
    .ag-title { font-size: 36px !important; }
    .ag-grid-4 { grid-template-columns: repeat(2, 1fr); }
    .ag-text-block { padding: 40px 24px; }
}
@media (max-width: 576px) {
    .ag-grid-4 { grid-template-columns: 1fr; }
}
</style>

<div class="ag-contact-page">
    
    {{-- SECTION 1: Company Details (Grid Layout) --}}
    <section class="ag-section" style="padding-top: 40px;">
        <div class="ag-container">
            <h2 class="ag-title ag-title--center">{{ __('inkwave.contact_inf_heading') }}</h2>
            
            <div class="ag-grid-4">
                <div class="ag-card" style="padding: 40px 16px;">
                    <i class="fas fa-phone" style="font-size: 32px; color: #bc9c5c; margin-bottom: 24px;"></i>
                    <h4>{{ __('inkwave.contact_lbl_phone') ?? 'Phone' }}</h4>
                    <p style="margin-top: 16px;"><a href="tel:{{ $misc['Company Phone'] ?? '[Company Phone]' }}" style="color: #555; text-decoration: none;">{{ $misc['Company Phone'] ?? '[Company Phone]' }}</a></p>
                </div>

                <div class="ag-card" style="padding: 40px 16px;">
                    <i class="fas fa-envelope" style="font-size: 32px; color: #bc9c5c; margin-bottom: 24px;"></i>
                    <h4>{{ __('inkwave.contact_lbl_mail') }}</h4>
                    <p style="margin-top: 16px;"><a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}">{{ $misc['Company Email'] ?? '[Company Email]' }}</a></p>
                </div>
                
                <div class="ag-card" style="padding: 40px 16px;">
                    <i class="fas fa-map-marker-alt" style="font-size: 32px; color: #bc9c5c; margin-bottom: 24px;"></i>
                    <h4>{{ __('inkwave.contact_lbl_loc') }}</h4>
                    <p style="margin-top: 16px;">{{ $misc['Company Address'] ?? '[Company Address]' }}</p>
                </div>
                
                <div class="ag-card" style="padding: 40px 16px;">
                    <i class="fas fa-building" style="font-size: 32px; color: #bc9c5c; margin-bottom: 24px;"></i>
                    <h4>{{ __('inkwave.contact_lbl_org') }}</h4>
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
                    <img src="{{ asset('assets/images/i6.jpg') }}" alt="Contact Artora Studios">
                </div>
                <div class="ag-split__content ag-text-block ag-bg-bone">
                    <h2 class="ag-title">{{ __('inkwave.contact_frm_heading') }}</h2>
                    <p class="ag-text" style="margin-bottom: 40px !important;">We would love to hear from you. Fill out the form below and our curation team will be in touch shortly.</p>
                    
                    <form method="POST" action="{{ route('contact.send') }}" id="contactform" onsubmit="return handleSubmit(event)">
                        @csrf
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_fld_name') }}</label>
                            <input type="text" name="name" id="name" placeholder="{{ __('inkwave.contact_fld_name') }}" class="ag-input @error('name') is-invalid @enderror">
                            @error('name') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_fld_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('inkwave.contact_fld_email') }}" class="ag-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_fld_phone') }}</label>
                            <input type="tel" name="phone" id="phone" placeholder="{{ __('inkwave.contact_fld_phone') }}" class="ag-input @error('phone') is-invalid @enderror" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')">
                            @error('phone') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                        
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_fld_subject') }}</label>
                            <input type="text" name="subject" id="subject" placeholder="{{ __('inkwave.contact_fld_subject') }}" class="ag-input">
                        </div>
                        
                        <div class="ag-field">
                            <label class="ag-label">{{ __('inkwave.contact_fld_msg') }}</label>
                            <textarea name="message" id="message" placeholder="{{ __('inkwave.contact_fld_msg') }}" class="ag-input ag-textarea @error('message') is-invalid @enderror"></textarea>
                            @error('message') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        @if(env('CAPTCHA_ENABLED', true))
                            <div class="ag-field">
                                <label class="ag-label">{{ __('inkwave.contact_fld_sec') }}</label>
                                <div class="ag-captcha-box @error('captcha') is-invalid @enderror">
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.contact_sec_ph') }}">
                                    <div class="ag-captcha-box__img">@captcha</div>
                                </div>
                                @error('captcha') <span class="ag-error-msg"><i class="fas fa-info-circle"></i> {{ __('inkwave.contact_val_sec_err') }}</span> @enderror
                            </div>
                        @endif

                        <div style="margin-top: 48px;">
                            <button type="submit" class="ag-contact-submit-btn">{{ __('inkwave.contact_btn_submit') }}</button>
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
        if (!name) errors.push({ field: 'name', message: '{{ __('inkwave.contact_req_name') }}' });
        if (!email) errors.push({ field: 'email', message: '{{ __('inkwave.contact_req_email') }}' });
        else if (!isValidEmail(email)) errors.push({ field: 'email', message: '{{ __('inkwave.contact_inv_email') }}' });
        if (!phone) errors.push({ field: 'phone', message: '{{ __('inkwave.contact_req_phone') }}' });
        if (!subject) errors.push({ field: 'subject', message: '{{ __('inkwave.contact_req_subj') }}' });
        if (!message) errors.push({ field: 'message', message: '{{ __('inkwave.contact_req_msg') }}' });
        if (captchaEl && !captcha) errors.push({ field: 'captcha', message: '{{ __('inkwave.contact_req_sec') }}' });

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
