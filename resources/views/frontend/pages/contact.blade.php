@extends('frontend.layouts.main')
@section('title', __('frontend.contact.tab'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.contact.tab'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.contact.tab')]
    ]
])

@php
    $ctEmail   = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $ctAddress = filled($misc['Company Address'] ?? null) ? $misc['Company Address'] : __('frontend.company.address');
    $ctCompany = filled($misc['Company Name'] ?? null) ? $misc['Company Name'] : __('frontend.company.name');
    $ctImage   = file_exists(public_path('assets/images/contact-art.webp')) ? asset('assets/images/contact-art.webp') : null;
    $ctLogo    = file_exists(public_path('assets/images/logo.webp')) ? asset('assets/images/logo.webp') : null;
@endphp

<section class="auth">
    <div class="container">
        <div class="auth__card">
            <div class="auth__art {{ $ctImage ? '' : 'is-empty' }}">
                <a href="{{ route('home') }}" class="auth__logo" aria-label="{{ __('frontend.head.site') }}">
                    @if($ctLogo)
                        <img src="{{ $ctLogo }}" alt="{{ __('frontend.head.site') }}" width="716" height="210">
                    @else
                        <span>{{ __('frontend.head.site') }}</span>
                    @endif
                </a>

                <div class="auth__pic" aria-hidden="true">
                    @if($ctImage)
                        <img src="{{ $ctImage }}" alt="" width="1200" height="1200">
                    @endif
                </div>

                <div class="auth__side">
                    <p class="auth__side-title">{{ __('frontend.contact.aside_title') }}</p>
                    <p class="ct-note">{{ __('frontend.contact.aside_text') }}</p>
                    <dl class="ct-list">
                        <div class="ct-item" style="--i: 0">
                            <dt>{{ __('frontend.contact.detail_email') }}</dt>
                            <dd>
                                <a href="mailto:{{ $ctEmail }}" class="ct-item__mail">{{ $ctEmail }}</a>
                                <button type="button" class="ct-copy" data-copy="{{ $ctEmail }}" data-done="{{ __('frontend.contact.copy_done') }}">
                                    <i class="far fa-copy" aria-hidden="true"></i>
                                    <span data-copy-label>{{ __('frontend.contact.copy_button') }}</span>
                                </button>
                            </dd>
                        </div>
                        <div class="ct-item" style="--i: 1">
                            <dt>{{ __('frontend.contact.detail_address') }}</dt>
                            <dd>{{ $ctAddress }}</dd>
                        </div>
                        <div class="ct-item" style="--i: 2">
                            <dt>{{ __('frontend.contact.detail_company') }}</dt>
                            <dd>{{ $ctCompany }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <div class="auth__body">
                <h2 class="auth__title">{{ __('frontend.contact.heading') }}</h2>
                <p class="auth__lead">{{ __('frontend.contact.text') }}</p>

                <form method="POST" action="{{ route('contact.send') }}" id="contactform" class="auth__form" novalidate>
                    @csrf

                    <div class="auth-field" style="--i: 0">
                        <label for="name">{{ __('frontend.contact.name') }}</label>
                        <input type="text" name="name" id="name" autocomplete="name" class="@error('name') is-invalid @enderror" placeholder="{{ __('frontend.contact.name_placeholder') }}" value="{{ old('name') }}">
                        @error('name')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field" style="--i: 1">
                        <label for="email">{{ __('frontend.contact.email') }}</label>
                        <input type="email" name="email" id="email" autocomplete="email" class="@error('email') is-invalid @enderror" placeholder="{{ __('frontend.contact.email_placeholder') }}" value="{{ old('email') }}">
                        @error('email')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field" style="--i: 2">
                        <label for="phone">{{ __('frontend.contact.phone') }}</label>
                        <input type="tel" name="phone" id="phone" autocomplete="tel" class="@error('phone') is-invalid @enderror" placeholder="{{ __('frontend.contact.phone_placeholder') }}" value="{{ old('phone') }}" inputmode="tel" maxlength="20" oninput="this.value = this.value.replace(/[^0-9+\-()\s]/g, '').replace(/(?!^)\+/g, '')">
                        @error('phone')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field" style="--i: 3">
                        <label for="subject">{{ __('frontend.contact.subject') }}</label>
                        <input type="text" name="subject" id="subject" class="@error('subject') is-invalid @enderror" placeholder="{{ __('frontend.contact.subject_placeholder') }}" value="{{ old('subject') }}">
                        @error('subject')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="auth-field" style="--i: 4">
                        <label for="message">{{ __('frontend.contact.message') }}</label>
                        <textarea name="message" id="message" rows="5" class="@error('message') is-invalid @enderror" placeholder="{{ __('frontend.contact.message_placeholder') }}">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="auth-err">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="auth-field" style="--i: 5">
                            <label for="captcha">{{ __('frontend.contact.captcha') }}</label>
                            <div class="auth-cap">
                                <div class="auth-cap__img cap__img">@captcha</div>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="@error('captcha') is-invalid @enderror" placeholder="{{ __('frontend.contact.captcha_placeholder') }}">
                            </div>
                            @error('captcha')
                                <span class="auth-err">{{ __('frontend.contact.captcha_invalid') }}</span>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" class="btn btn--primary btn--block auth__submit" style="--i: 6">{{ __('frontend.contact.button') }}</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    document.querySelectorAll('[data-copy]').forEach(function (button) {
        var label = button.querySelector('[data-copy-label]');
        var start = label ? label.textContent : '';
        var timer;

        button.addEventListener('click', function () {
            var text = button.getAttribute('data-copy');
            var finish = function () {
                button.classList.add('is-done');
                if (label) { label.textContent = button.getAttribute('data-done'); }
                clearTimeout(timer);
                timer = setTimeout(function () {
                    button.classList.remove('is-done');
                    if (label) { label.textContent = start; }
                }, 2000);
            };

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(finish);
            } else {
                var temp = document.createElement('textarea');
                temp.value = text;
                temp.setAttribute('readonly', '');
                temp.style.position = 'absolute';
                temp.style.left = '-9999px';
                document.body.appendChild(temp);
                temp.select();
                try { document.execCommand('copy'); finish(); } catch (error) {}
                document.body.removeChild(temp);
            }
        });
    });

    var form = document.getElementById('contactform');
    if (!form) { return; }

    var messages = {
        name: @json(__('frontend.contact.name_required')),
        email: @json(__('frontend.contact.email_required')),
        emailValid: @json(__('frontend.contact.email_invalid')),
        phone: @json(__('frontend.contact.phone_required')),
        phoneValid: @json(__('frontend.contact.phone_invalid')),
        subject: @json(__('frontend.contact.subject_required')),
        message: @json(__('frontend.contact.message_required')),
        captcha: @json(__('frontend.contact.captcha_required'))
    };

    function isPhone(value) {
        var digits = value.replace(/\D/g, '');
        return /^\+?[0-9\s\-()]+$/.test(value) && digits.length >= 7 && digits.length <= 15;
    }

    function isEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    function clearError(field) {
        var holder = field.closest('.auth-field');
        field.classList.remove('is-invalid');
        if (holder) {
            holder.querySelectorAll('.auth-err').forEach(function (note) { note.remove(); });
        }
    }

    function showError(field, text) {
        var holder = field.closest('.auth-field');
        field.classList.add('is-invalid');
        if (!holder) { return; }
        var note = document.createElement('span');
        note.className = 'auth-err';
        note.appendChild(document.createTextNode(text));
        holder.appendChild(note);
    }

    function check(field) {
        var value = (field.value || '').trim();
        if (!value) { return messages[field.id] || ''; }
        if (field.id === 'email' && !isEmail(value)) { return messages.emailValid; }
        if (field.id === 'phone' && !isPhone(value)) { return messages.phoneValid; }
        return '';
    }

    var fields = ['name', 'email', 'phone', 'subject', 'message', 'captcha']
        .map(function (id) { return document.getElementById(id); })
        .filter(Boolean);

    fields.forEach(function (field) {
        field.addEventListener('input', function () {
            if (!check(field)) { clearError(field); }
        });
    });

    form.addEventListener('submit', function (event) {
        var failed = null;
        fields.forEach(function (field) {
            clearError(field);
            var problem = check(field);
            if (problem) {
                showError(field, problem);
                failed = failed || field;
            }
        });
        if (failed) {
            event.preventDefault();
            failed.focus();
        }
    });
}());
</script>
@endpush
