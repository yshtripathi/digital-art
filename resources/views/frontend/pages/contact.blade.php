@extends('frontend.layouts.main')
@section('title', __('managenovax.contact.page_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('managenovax.contact.page_title'),
    'links' => [
        ['name' => __('managenovax.header.home'), 'url' => route('home')],
        ['name' => __('managenovax.contact.page_title')]
    ]
])

@php
    $ctPhone   = $misc['Company Phone'] ?? __('managenovax.footer.phone_fallback');
    $ctEmail   = $misc['Company Email'] ?? __('managenovax.footer.email_fallback');
    $ctAddress = $misc['Company Address'] ?? __('managenovax.footer.address_fallback');
    $ctCompany = $misc['Company Name'] ?? __('managenovax.footer.company_fallback');
@endphp

<section class="ct">
    <div class="ct__grid">

        {{-- Contact details (colour block, no image) --}}
        <aside class="ct-info">
            <div>
                <span class="ct-info__eyebrow">{{ __('managenovax.contact.page_title') }}</span>
                <h2 class="ct-info__title">{{ __('managenovax.contact.info_heading') }}</h2>
            </div>

            <ul class="ct-list">
                <li>
                    <a href="tel:{{ $ctPhone }}" class="ct-item">
                        <span class="ct-item__icon"><i class="fas fa-phone-alt"></i></span>
                        <span class="ct-item__body">
                            <span class="ct-item__label">{{ __('managenovax.contact.lbl_phone') }}</span>
                            <span class="ct-item__value">{{ $ctPhone }}</span>
                        </span>
                        <i class="fas fa-arrow-right ct-item__arrow" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a href="mailto:{{ $ctEmail }}" class="ct-item">
                        <span class="ct-item__icon"><i class="fas fa-envelope"></i></span>
                        <span class="ct-item__body">
                            <span class="ct-item__label">{{ __('managenovax.contact.lbl_email') }}</span>
                            <span class="ct-item__value">{{ $ctEmail }}</span>
                        </span>
                        <i class="fas fa-arrow-right ct-item__arrow" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <div class="ct-item">
                        <span class="ct-item__icon"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="ct-item__body">
                            <span class="ct-item__label">{{ __('managenovax.contact.lbl_location') }}</span>
                            <span class="ct-item__value">{{ $ctAddress }}</span>
                        </span>
                    </div>
                </li>
                <li>
                    <div class="ct-item">
                        <span class="ct-item__icon"><i class="fas fa-building"></i></span>
                        <span class="ct-item__body">
                            <span class="ct-item__label">{{ __('managenovax.contact.lbl_company') }}</span>
                            <span class="ct-item__value">{{ $ctCompany }}</span>
                        </span>
                    </div>
                </li>
            </ul>
        </aside>

        {{-- Form --}}
        <div class="ct-card">
            <h2 class="au-title ct-card__title">{{ __('managenovax.contact.form_heading') }}</h2>
            <p class="ct-card__desc">{{ __('managenovax.contact.form_desc') }}</p>

            <form method="POST" action="{{ route('contact.send') }}" id="contactform" class="au-form" onsubmit="return handleSubmit(event)" novalidate>
                @csrf

                <div class="au-row">
                    <div class="au-field">
                        <label class="au-label" for="name">{{ __('managenovax.contact.fld_name') }}</label>
                        <div class="au-input">
                            <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name') }}" placeholder="{{ __('managenovax.contact.ph_name') }}" class="@error('name') is-invalid @enderror">
                        </div>
                        @error('name') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-field">
                        <label class="au-label" for="email">{{ __('managenovax.contact.fld_email') }}</label>
                        <div class="au-input">
                            <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" autocomplete="email" value="{{ old('email') }}" placeholder="{{ __('managenovax.contact.ph_email') }}" class="@error('email') is-invalid @enderror">
                        </div>
                        @error('email') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="au-row">
                    <div class="au-field">
                        <label class="au-label" for="phone">{{ __('managenovax.contact.fld_phone') }}</label>
                        <div class="au-input">
                            <i class="fas fa-phone-alt au-input__icon" aria-hidden="true"></i>
                            <input type="tel" name="phone" id="phone" autocomplete="tel" value="{{ old('phone') }}" placeholder="{{ __('managenovax.contact.ph_phone') }}" class="@error('phone') is-invalid @enderror" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')">
                        </div>
                        @error('phone') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-field">
                        <label class="au-label" for="subject">{{ __('managenovax.contact.fld_subject') }}</label>
                        <div class="au-input">
                            <i class="fas fa-tag au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" placeholder="{{ __('managenovax.contact.ph_subject') }}" class="@error('subject') is-invalid @enderror">
                        </div>
                        @error('subject') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="au-field">
                    <label class="au-label" for="message">{{ __('managenovax.contact.fld_msg') }}</label>
                    <div class="au-input ct-textarea">
                        <i class="fas fa-comment-dots au-input__icon" aria-hidden="true"></i>
                        <textarea name="message" id="message" rows="5" placeholder="{{ __('managenovax.contact.ph_msg') }}" class="@error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                    </div>
                    @error('message') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="au-field">
                        <label class="au-label" for="captcha">{{ __('managenovax.contact.fld_captcha') }}</label>
                        <div class="au-captcha @error('captcha') is-invalid @enderror">
                            <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('managenovax.contact.ph_captcha') }}">
                            <div class="au-captcha__img">@captcha</div>
                            <button type="button" class="au-captcha__refresh" data-au-captcha aria-label="Refresh code"><i class="fas fa-sync-alt"></i></button>
                        </div>
                        @error('captcha') <span class="au-error"><i class="fas fa-info-circle"></i> {{ __('managenovax.contact.err_captcha_inv') }}</span> @enderror
                    </div>
                @endif

                <button type="submit" class="au-submit">
                    {{ __('managenovax.contact.btn_submit') }} <i class="fas fa-paper-plane"></i>
                </button>
            </form>
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

        // Clear previous client-side messages
        document.querySelectorAll('.custom-error-message').forEach(el => el.remove());
        document.querySelectorAll('#contactform .is-invalid').forEach(el => el.classList.remove('is-invalid'));

        const errors = [];
        if (!name) errors.push({ field: 'name', message: '{{ __('managenovax.contact.err_name') }}' });
        if (!email) errors.push({ field: 'email', message: '{{ __('managenovax.contact.err_email_req') }}' });
        else if (!isValidEmail(email)) errors.push({ field: 'email', message: '{{ __('managenovax.contact.err_email_inv') }}' });
        if (!phone) errors.push({ field: 'phone', message: '{{ __('managenovax.contact.err_phone') }}' });
        if (!subject) errors.push({ field: 'subject', message: '{{ __('managenovax.contact.err_subj') }}' });
        if (!message) errors.push({ field: 'message', message: '{{ __('managenovax.contact.err_msg') }}' });
        if (captchaEl && !captcha) errors.push({ field: 'captcha', message: '{{ __('managenovax.contact.err_captcha_req') }}' });

        if (errors.length) {
            errors.forEach(showFieldError);
            document.getElementById(errors[0].field).focus();
            return false;
        }

        document.getElementById('contactform').submit();
    }

    function showFieldError(error) {
        const field = document.getElementById(error.field);
        if (!field) return;
        if (error.field === 'captcha') {
            field.closest('.au-captcha').classList.add('is-invalid');
        } else {
            field.classList.add('is-invalid');
        }
        const wrapper = field.closest('.au-field') || field.parentElement;
        const span = document.createElement('span');
        span.className = 'au-error custom-error-message';
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
            if (!validator(this.value.trim())) return;
            if (this.id === 'captcha') {
                this.closest('.au-captcha').classList.remove('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
            const wrapper = this.closest('.au-field');
            const msg = wrapper && wrapper.querySelector('.custom-error-message');
            if (msg) msg.remove();
        });
    }

    bindClear('name', v => !!v);
    bindClear('email', v => v && isValidEmail(v));
    bindClear('phone', v => !!v);
    bindClear('subject', v => !!v);
    bindClear('message', v => !!v);
    bindClear('captcha', v => !!v);

    // Refresh captcha image
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('[data-au-captcha]');
        if (!btn) return;
        var img = btn.parentElement.querySelector('.au-captcha__img img');
        if (img) img.click();
    });
</script>
@endpush
