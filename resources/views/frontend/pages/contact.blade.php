@extends('frontend.layouts.main')
@section('title', __('frontend.contact.title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.contact.title'),
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => __('frontend.contact.title')]
    ]
])

@php
    $ctPhone   = $misc['Company Phone'] ?? __('frontend.company.phone');
    $ctEmail   = $misc['Company Email'] ?? __('frontend.company.email');
    $ctAddress = $misc['Company Address'] ?? __('frontend.company.address');
    $ctCompany = $misc['Company Name'] ?? __('frontend.company.name');
@endphp

<section class="fm fm--contact fm--wide">

    @include('frontend.layouts.form-canvas')

    <div class="fm__wrap">

        {{-- Contact details, drawn from the miscs table --}}
        <aside class="ct-info ct-info--top">
            <p class="ct-info__kicker">{{ __('frontend.contact.info_label') }}</p>
            <p class="ct-info__copy">{{ __('frontend.contact.info_title') }}</p>

            <ul class="ct-rows">
                <li class="ct-row">
                    <span class="ct-row__label">{{ __('frontend.contact.phone') }}</span>
                    <a href="tel:{{ $ctPhone }}" class="ct-row__value ct-row__value--link">{{ $ctPhone }}</a>
                </li>
                <li class="ct-row">
                    <span class="ct-row__label">{{ __('frontend.contact.email') }}</span>
                    <a href="mailto:{{ $ctEmail }}" class="ct-row__value ct-row__value--link">{{ $ctEmail }}</a>
                </li>
                <li class="ct-row">
                    <span class="ct-row__label">{{ __('frontend.contact.address') }}</span>
                    <span class="ct-row__value">{{ $ctAddress }}</span>
                </li>
                <li class="ct-row">
                    <span class="ct-row__label">{{ __('frontend.contact.company') }}</span>
                    <span class="ct-row__value">{{ $ctCompany }}</span>
                </li>
            </ul>
        </aside>

        <div class="fm__head">
            <h2 class="au-title">{{ __('frontend.contact.form_title') }}</h2>
            <p class="au-lead">{{ __('frontend.contact.form_desc') }}</p>
        </div>

        {{-- Form --}}
        <div class="au-card">
            <div class="au-card__inner">

                <form method="POST" action="{{ route('contact.send') }}" id="contactform" class="au-form" onsubmit="return handleSubmit(event)" novalidate>
                @csrf

                <div class="au-row">
                    <div class="au-field">
                        <label class="au-label" for="name">{{ __('frontend.contact.name') }}</label>
                        <div class="au-input">
                            <i class="fas fa-user au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name') }}" placeholder="{{ __('frontend.contact.name_ph') }}" class="@error('name') is-invalid @enderror">
                        </div>
                        @error('name') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-field">
                        <label class="au-label" for="email">{{ __('frontend.contact.email_label') }}</label>
                        <div class="au-input">
                            <i class="fas fa-envelope au-input__icon" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" autocomplete="email" value="{{ old('email') }}" placeholder="{{ __('frontend.contact.email_ph') }}" class="@error('email') is-invalid @enderror">
                        </div>
                        @error('email') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="au-row">
                    <div class="au-field">
                        <label class="au-label" for="phone">{{ __('frontend.contact.phone_label') }}</label>
                        <div class="au-input">
                            <i class="fas fa-phone-alt au-input__icon" aria-hidden="true"></i>
                            <input type="tel" name="phone" id="phone" autocomplete="tel" value="{{ old('phone') }}" placeholder="{{ __('frontend.contact.phone_ph') }}" class="@error('phone') is-invalid @enderror" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')">
                        </div>
                        @error('phone') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>

                    <div class="au-field">
                        <label class="au-label" for="subject">{{ __('frontend.contact.subject') }}</label>
                        <div class="au-input">
                            <i class="fas fa-tag au-input__icon" aria-hidden="true"></i>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}" placeholder="{{ __('frontend.contact.subject_ph') }}" class="@error('subject') is-invalid @enderror">
                        </div>
                        @error('subject') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="au-field">
                    <label class="au-label" for="message">{{ __('frontend.contact.message') }}</label>
                    <div class="au-input ct-textarea">
                        <i class="fas fa-comment-dots au-input__icon" aria-hidden="true"></i>
                        <textarea name="message" id="message" rows="5" placeholder="{{ __('frontend.contact.message_ph') }}" class="@error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                    </div>
                    @error('message') <span class="au-error"><i class="fas fa-info-circle"></i> {{ $message }}</span> @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="au-field">
                        <label class="au-label" for="captcha">{{ __('frontend.contact.captcha') }}</label>
                        <div class="au-captcha @error('captcha') is-invalid @enderror">
                            <div class="au-input au-captcha__field">
                                <i class="fas fa-shield-alt au-input__icon" aria-hidden="true"></i>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" placeholder="{{ __('frontend.contact.captcha_ph') }}">
                            </div>
                            <div class="au-captcha__img">@captcha</div>
                            <button type="button" class="au-captcha__refresh" data-au-captcha aria-label="{{ __('frontend.contact.refresh') }}"><i class="fas fa-sync-alt"></i></button>
                        </div>
                        @error('captcha') <span class="au-error"><i class="fas fa-info-circle"></i> {{ __('frontend.contact.captcha_bad') }}</span> @enderror
                    </div>
                @endif

                <button type="submit" class="au-submit">
                    {{ __('frontend.contact.submit') }} <i class="fas fa-paper-plane"></i>
                </button>
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

        // Clear previous client-side messages
        document.querySelectorAll('.custom-error-message').forEach(el => el.remove());
        document.querySelectorAll('#contactform .is-invalid').forEach(el => el.classList.remove('is-invalid'));

        const errors = [];
        if (!name) errors.push({ field: 'name', message: @json(__('frontend.contact.name_req')) });
        if (!email) errors.push({ field: 'email', message: @json(__('frontend.contact.email_req')) });
        else if (!isValidEmail(email)) errors.push({ field: 'email', message: @json(__('frontend.contact.email_valid')) });
        if (!phone) errors.push({ field: 'phone', message: @json(__('frontend.contact.phone_req')) });
        if (!subject) errors.push({ field: 'subject', message: @json(__('frontend.contact.subject_req')) });
        if (!message) errors.push({ field: 'message', message: @json(__('frontend.contact.message_req')) });
        if (captchaEl && !captcha) errors.push({ field: 'captcha', message: @json(__('frontend.contact.captcha_req')) });

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
        span.innerHTML = '<i class="fas fa-info-circle"></i> ';
        span.appendChild(document.createTextNode(error.message));
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
