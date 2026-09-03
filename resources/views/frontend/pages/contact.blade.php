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



<div class="duo-contact-wrapper">
    <div class="duo-container">
        
        {{-- ================= COMPANY INFO ================= --}}
        <div class="duo-contact-info">
            <h3 class="duo-contact-info__title">{{ __('inkwave.contact_inf_heading') }}</h3>
            <p class="duo-contact-info__sub">{{ __('inkwave.contact_inf_desc') }}</p>

            <ul class="duo-info-list">
                <li class="duo-info-item">
                    <span class="duo-info-item__icon"><i class="fas fa-envelope"></i></span>
                    <div class="duo-info-item__text">
                        <span class="duo-info-item__label">{{ __('inkwave.contact_lbl_mail') }}</span>
                        <a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}" class="duo-info-item__value">{{ $misc['Company Email'] ?? '[Company Email]' }}</a>
                    </div>
                </li>
                <li class="duo-info-item">
                    <span class="duo-info-item__icon"><i class="fas fa-map-marker-alt"></i></span>
                    <div class="duo-info-item__text">
                        <span class="duo-info-item__label">{{ __('inkwave.contact_lbl_loc') }}</span>
                        <span class="duo-info-item__value">{{ $misc['Company Address'] ?? '[Company Address]' }}</span>
                    </div>
                </li>
                <li class="duo-info-item">
                    <span class="duo-info-item__icon"><i class="fas fa-building"></i></span>
                    <div class="duo-info-item__text">
                        <span class="duo-info-item__label">{{ __('inkwave.contact_lbl_org') }}</span>
                        <span class="duo-info-item__value">{{ $misc['Company Name'] ?? '[Company Name]' }}</span>
                    </div>
                </li>
            </ul>
        </div>

        {{-- ================= CONTACT FORM ================= --}}
        <div class="duo-contact-form">
            <h3 class="duo-form-title">{{ __('inkwave.contact_frm_heading') }}</h3>

            <form method="POST" action="{{ route('contact.send') }}" id="contactform" onsubmit="return handleSubmit(event)">
                @csrf
                <div class="duo-form-row">
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-user"></i> {{ __('inkwave.contact_fld_name') }}</label>
                        <input type="text" name="name" id="name" placeholder="{{ __('inkwave.contact_fld_name') }}" class="duo-input @error('name') is-invalid @enderror">
                        @error('name') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-envelope"></i> {{ __('inkwave.contact_fld_email') }}</label>
                        <input type="email" name="email" id="email" placeholder="{{ __('inkwave.contact_fld_email') }}" class="duo-input @error('email') is-invalid @enderror">
                        @error('email') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="duo-form-row">
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-phone"></i> {{ __('inkwave.contact_fld_phone') }}</label>
                        <input type="text" name="phone" id="phone" placeholder="{{ __('inkwave.contact_fld_phone') }}" class="duo-input @error('phone') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        @error('phone') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-tag"></i> {{ __('inkwave.contact_fld_subject') }}</label>
                        <input type="text" name="subject" id="subject" placeholder="{{ __('inkwave.contact_fld_subject') }}" class="duo-input">
                    </div>
                </div>

                <div class="duo-field">
                    <label class="duo-label"><i class="fas fa-message"></i> {{ __('inkwave.contact_fld_msg') }}</label>
                    <textarea name="message" id="message" rows="4" placeholder="{{ __('inkwave.contact_fld_msg') }}" class="duo-input duo-textarea"></textarea>
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="duo-field">
                        <label class="duo-label"><i class="fas fa-shield-alt"></i> {{ __('inkwave.contact_fld_sec') }}</label>
                        <div class="duo-captcha-box @error('captcha') is-invalid @enderror">
                            <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('inkwave.contact_sec_ph') }}">
                            <div class="duo-captcha-box__img">@captcha</div>
                        </div>
                        @error('captcha') <span class="duo-error"><i class="fas fa-info-circle"></i> {{ __('inkwave.contact_val_sec_err') }}</span> @enderror
                    </div>
                @endif

                <button type="submit" class="duo-submit"><i class="fas fa-paper-plane"></i> {{ __('inkwave.contact_btn_submit') }}</button>
            </form>
        </div>

    </div>
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

        // Clear previous client-side messages / states
        document.querySelectorAll('.custom-error-message').forEach(el => el.remove());
        document.querySelectorAll('.duo-input, .duo-captcha-box').forEach(el => el.classList.remove('is-invalid'));

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
        const wrapper = field.closest('.duo-field') || field.parentElement;
        const span = document.createElement('span');
        span.className = 'duo-error custom-error-message';
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
                const wrapper = this.closest('.duo-field');
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
