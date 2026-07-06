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

<style>
    /* =========================================================
       CONTACT — Structured theme (video-behind-form, image-behind-info)
       ========================================================= */
    .ct-section { background-color: var(--color-putty, #c4c3b6); padding: 84px 40px; }
    .ct-head { text-align: center; max-width: 640px; margin: 0 auto 48px auto; }
    .ct-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.18em; color: var(--color-graphite, #595855); margin: 0 0 10px 0;
    }
    .ct-heading {
        font-family: var(--font-davinci, serif); font-size: clamp(28px, 3.6vw, 44px); font-weight: 500;
        line-height: 1.12; letter-spacing: -0.01em; color: var(--color-ink, #000); margin: 0;
    }

    .ct-grid {
        display: grid; grid-template-columns: 0.85fr 1.15fr;
        max-width: 1160px; margin: 0 auto;
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 16px; overflow: hidden;
        background-color: var(--color-paper, #fff);
    }

    /* ---------- Company info (light, art behind) ---------- */
    .ct-info {
        position: relative; overflow: hidden;
        background-color: var(--color-bone, #e7e5e4);
        padding: 48px 40px;
        display: flex; flex-direction: column;
    }
    .ct-info__art { position: absolute; z-index: 1; pointer-events: none; }
    .ct-info__art--1 {
        top: 50%; left: 50%; transform: translate(-50%, -50%);
        height: 90%; width: auto; opacity: 0.10;   /* centered, faint watermark so text stays readable */
    }
    .ct-info__inner { position: relative; z-index: 2; }
    .ct-info__title {
        font-family: var(--font-davinci, serif); font-size: 26px; font-weight: 500;
        color: var(--color-ink, #000); margin: 0 0 10px 0;
    }
    .ct-info__sub {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; line-height: 1.6;
        color: var(--color-graphite, #595855); margin: 0 0 28px 0; max-width: 300px;
    }
    .ct-info__list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 20px; }
    .ct-info__list li { display: flex; align-items: flex-start; gap: 14px; }
    .ct-info__ic {
        flex-shrink: 0; width: 40px; height: 40px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5);
        color: var(--color-ink, #000); font-size: 14px;
    }
    .ct-info__label {
        display: block; font-family: var(--font-helvetica-now, sans-serif);
        font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em;
        color: var(--color-graphite, #595855); margin-bottom: 3px;
    }
    .ct-info__list a, .ct-info__list div > span:last-child {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px;
        color: var(--color-ink, #000); text-decoration: none; word-break: break-word;
    }
    .ct-info__list a:hover { text-decoration: underline; }

    /* ---------- Form (dark, video behind) ---------- */
    .ct-form { position: relative; overflow: hidden; background-color: var(--color-ink, #000); }
    .ct-form__video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; opacity: 1; filter: grayscale(0.2) contrast(1.02); }
    .ct-form__veil { position: absolute; inset: 0; z-index: 2; background: rgba(0, 0, 0, 0.62); pointer-events: none; }
    .ct-form__inner { position: relative; z-index: 3; padding: 44px 40px; }
    .ct-form__title {
        font-family: var(--font-davinci, serif); font-size: 26px; font-weight: 500;
        color: var(--color-paper, #fff); margin: 0 0 26px 0;
    }

    .ct-row { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .ct-field { margin-bottom: 16px; }
    .ct-label {
        display: flex; align-items: center; gap: 7px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.06em; color: rgba(255, 255, 255, 0.75); margin-bottom: 7px;
    }
    .ct-label i { font-size: 11px; color: rgba(255, 255, 255, 0.55); }
    .ct-input {
        width: 100%; box-sizing: border-box;
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 9px; padding: 12px 14px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-ink, #000);
        outline: none; transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .ct-input::placeholder { color: #9a9a92; }
    .ct-input:focus { border-color: var(--color-ink, #000); box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.25); }
    .ct-input.is-invalid { border-color: #d98a8a; box-shadow: 0 0 0 3px rgba(217, 138, 138, 0.25); }
    .ct-textarea { resize: vertical; min-height: 110px; }

    /* Validation message — always directly below its input */
    .ct-error {
        display: flex; align-items: center; gap: 6px; margin-top: 7px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; line-height: 1.4;
        color: #f0a9a9;
    }
    .ct-error i { font-size: 11px; }

    /* Captcha */
    .ct-captcha { display: grid; grid-template-columns: 1fr auto; gap: 12px; align-items: center; }
    .ct-captcha__img { display: flex; align-items: center; }
    .ct-captcha__img img {
        height: 46px; width: auto; border-radius: 9px;
        border: 1px solid var(--color-vellum, #dfdcd5); background: var(--color-paper, #fff);
    }

    .ct-submit {
        width: 100%; margin-top: 8px;
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        background-color: var(--color-paper, #fff); color: var(--color-ink, #000);
        border: 1px solid var(--color-paper, #fff); border-radius: 28.8px;
        padding: 15px 24px; cursor: pointer; transition: opacity 0.2s ease;
    }
    .ct-submit:hover { opacity: 0.88; }

    @media (max-width: 900px) {
        .ct-section { padding: 60px 20px; }
        .ct-grid { grid-template-columns: 1fr; }
        .ct-info { padding: 40px 28px; }
        .ct-info__art--1 { height: auto; width: 72%; left: 50%; right: auto; top: 50%; transform: translate(-50%, -50%); opacity: 0.08; }
        .ct-form__inner { padding: 36px 28px; }
    }
    @media (max-width: 560px) {
        .ct-row { grid-template-columns: 1fr; gap: 0; }
        .ct-captcha { grid-template-columns: 1fr; }
        .ct-captcha__img { justify-content: flex-start; }
    }
</style>

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
