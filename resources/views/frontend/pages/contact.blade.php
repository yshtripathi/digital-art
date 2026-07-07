@extends('frontend.layouts.main')
@section('title', __('inkwave.contact_title'))
@section('main-content')

<x-breadcrumb :title="__('inkwave.contact_title')" />

<section class="ct-section">
    <div class="ct-head">
        <p class="ct-eyebrow">{{ __('inkwave.contact_badge') }}</p>
        <h2 class="ct-heading">{{ __('inkwave.contact_header') }}</h2>
    </div>

    <div class="ct-grid">

        {{-- ================= COMPANY INFO (image behind: i9.webp + i1.webp) ================= --}}
        <div class="ct-info">
            <img src="{{ asset('assets/images/i9.webp') }}" alt="" aria-hidden="true" class="ct-info__art ct-info__art--1">

            <div class="ct-info__inner">
                <h3 class="ct-info__title">{{ __('inkwave.contact_info_title') }}</h3>
                <p class="ct-info__sub">{{ __('inkwave.contact_info_sub') }}</p>

                <ul class="ct-info__list">
                    <li>
                        <span class="ct-info__ic"><i class="fas fa-envelope"></i></span>
                        <div>
                            <span class="ct-info__label">{{ __('inkwave.contact_label_email') }}</span>
                            <a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}">{{ $misc['Company Email'] ?? '[Company Email]' }}</a>
                        </div>
                    </li>
                    <li>
                        <span class="ct-info__ic"><i class="fas fa-map-marker-alt"></i></span>
                        <div>
                            <span class="ct-info__label">{{ __('inkwave.contact_label_location') }}</span>
                            <span>{{ $misc['Company Address'] ?? '[Company Address]' }}</span>
                        </div>
                    </li>
                    <li>
                        <span class="ct-info__ic"><i class="fas fa-building"></i></span>
                        <div>
                            <span class="ct-info__label">{{ __('inkwave.contact_label_company') }}</span>
                            <span>{{ $misc['Company Name'] ?? '[Company Name]' }}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        {{-- ================= CONTACT FORM (video behind: form.webm) ================= --}}
        <div class="ct-form">
            <video class="ct-form__video" autoplay muted loop playsinline preload="auto">
                <source src="{{ asset('assets/images/form.webm') }}" type="video/webm">
            </video>
            <span class="ct-form__veil" aria-hidden="true"></span>

            <div class="ct-form__inner">
                <h3 class="ct-form__title">{{ __('inkwave.contact_form_title') }}</h3>

                <form method="POST" action="{{ route('contact.send') }}" id="contactform" onsubmit="return handleSubmit(event)">
                    @csrf

                    <div class="ct-row">
                        <div class="ct-field">
                            <label class="ct-label"><i class="fas fa-user"></i> {{ __('inkwave.form_name') }}</label>
                            <input type="text" name="name" id="name" placeholder="{{ __('inkwave.form_name') }}" class="ct-input @error('name') is-invalid @enderror">
                            @error('name') <span class="ct-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ct-field">
                            <label class="ct-label"><i class="fas fa-envelope"></i> {{ __('inkwave.form_email') }}</label>
                            <input type="email" name="email" id="email" placeholder="{{ __('inkwave.form_email') }}" class="ct-input @error('email') is-invalid @enderror">
                            @error('email') <span class="ct-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="ct-row">
                        <div class="ct-field">
                            <label class="ct-label"><i class="fas fa-phone"></i> {{ __('inkwave.form_phone') }}</label>
                            <input type="text" name="phone" id="phone" placeholder="{{ __('inkwave.form_phone') }}" class="ct-input @error('phone') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            @error('phone') <span class="ct-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                        </div>

                        <div class="ct-field">
                            <label class="ct-label"><i class="fas fa-tag"></i> {{ __('inkwave.form_subject') }}</label>
                            <input type="text" name="subject" id="subject" placeholder="{{ __('inkwave.form_subject') }}" class="ct-input">
                        </div>
                    </div>

                    <div class="ct-field">
                        <label class="ct-label"><i class="fas fa-message"></i> {{ __('inkwave.form_message') }}</label>
                        <textarea name="message" id="message" rows="4" placeholder="{{ __('inkwave.form_message') }}" class="ct-input ct-textarea"></textarea>
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="ct-field ct-field--captcha">
                            <label class="ct-label">{{ __('inkwave.form_captcha') }}</label>
                            <div class="ct-captcha">
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="ct-input @error('captcha') is-invalid @enderror" placeholder="{{ __('inkwave.form_captcha_placeholder') }}">
                                <div class="ct-captcha__img">@captcha</div>
                            </div>
                            @error('captcha') <span class="ct-error"><i class="fas fa-info-circle"></i> {{ __('inkwave.val_captcha_error') }}</span> @enderror
                        </div>
                    @endif

                    <button type="submit" class="ct-submit"><i class="fas fa-paper-plane"></i> {{ __('inkwave.btn_send_message') }}</button>
                </form>
            </div>
        </div>
    </div>
</section>



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
        document.querySelectorAll('.ct-input').forEach(el => el.classList.remove('is-invalid'));

        const errors = [];
        if (!name) errors.push({ field: 'name', message: '{{ __('inkwave.val_name_req') }}' });
        if (!email) errors.push({ field: 'email', message: '{{ __('inkwave.val_email_req') }}' });
        else if (!isValidEmail(email)) errors.push({ field: 'email', message: '{{ __('inkwave.val_email_invalid') }}' });
        if (!phone) errors.push({ field: 'phone', message: '{{ __('inkwave.val_phone_req') }}' });
        if (!subject) errors.push({ field: 'subject', message: '{{ __('inkwave.val_subject_req') }}' });
        if (!message) errors.push({ field: 'message', message: '{{ __('inkwave.val_message_req') }}' });
        if (captchaEl && !captcha) errors.push({ field: 'captcha', message: '{{ __('inkwave.val_captcha_req') }}' });

        if (errors.length) {
            errors.forEach(showFieldError);
            return false;
        }

        document.getElementById('contactform').submit();
    }

    // Append the message directly below the input (inside its .ct-field wrapper)
    function showFieldError(error) {
        const field = document.getElementById(error.field);
        if (!field) return;
        field.classList.add('is-invalid');
        const wrapper = field.closest('.ct-field') || field.parentElement;
        const span = document.createElement('span');
        span.className = 'ct-error custom-error-message';
        span.innerHTML = '<i class="fas fa-info-circle"></i> ' + error.message;
        wrapper.appendChild(span);
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Real-time: clear a field's error once it becomes valid
    function bindClear(id, validator) {
        const el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('input', function () {
            const ok = validator(this.value.trim());
            if (ok) {
                this.classList.remove('is-invalid');
                const wrapper = this.closest('.ct-field');
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
