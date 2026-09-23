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

<section class="contact">
    <div class="contact__split">

        <aside class="contact__aside">
            <div>
                <p class="contact__kicker">{{ __('frontend.contact.info_label') }}</p>
                <p class="contact__lead">{{ __('frontend.contact.info_title') }}</p>
            </div>

            <div class="contact__card">
                <ul class="contact__rows">
                    <li class="contact__row">
                        <span class="contact__tile"><i class="fas fa-phone-alt" aria-hidden="true"></i></span>
                        <span>
                            <span class="contact__label">{{ __('frontend.contact.phone') }}</span>
                            <a href="tel:{{ $ctPhone }}" class="contact__value">{{ $ctPhone }}</a>
                        </span>
                    </li>
                    <li class="contact__row">
                        <span class="contact__tile"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                        <span>
                            <span class="contact__label">{{ __('frontend.contact.email') }}</span>
                            <a href="mailto:{{ $ctEmail }}" class="contact__value">{{ $ctEmail }}</a>
                        </span>
                    </li>
                    <li class="contact__row">
                        <span class="contact__tile"><i class="fas fa-map-marker-alt" aria-hidden="true"></i></span>
                        <span>
                            <span class="contact__label">{{ __('frontend.contact.address') }}</span>
                            <span class="contact__value">{{ $ctAddress }}</span>
                        </span>
                    </li>
                    <li class="contact__row">
                        <span class="contact__tile"><i class="fas fa-building" aria-hidden="true"></i></span>
                        <span>
                            <span class="contact__label">{{ __('frontend.contact.company') }}</span>
                            <span class="contact__value">{{ $ctCompany }}</span>
                        </span>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="contact__form">
            <h2 class="contact__title">{{ __('frontend.contact.form_title') }}</h2>
            <p class="contact__desc">{{ __('frontend.contact.form_desc') }}</p>

            <form method="POST" action="{{ route('contact.send') }}" id="contactform" novalidate>
                @csrf

                <div class="contact__fields">

                    <div class="contact__pair">
                        <div class="fld">
                            <label class="fld__label" for="name">{{ __('frontend.contact.name') }}</label>
                            <div class="fld__box">
                                <i class="fas fa-user fld__icon" aria-hidden="true"></i>
                                <input type="text" name="name" id="name" autocomplete="name" class="fld__input @error('name') is-invalid @enderror" placeholder="{{ __('frontend.contact.name_ph') }}" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="fld">
                            <label class="fld__label" for="email">{{ __('frontend.contact.email_label') }}</label>
                            <div class="fld__box">
                                <i class="fas fa-envelope fld__icon" aria-hidden="true"></i>
                                <input type="email" name="email" id="email" autocomplete="email" class="fld__input @error('email') is-invalid @enderror" placeholder="{{ __('frontend.contact.email_ph') }}" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="contact__pair">
                        <div class="fld">
                            <label class="fld__label" for="phone">{{ __('frontend.contact.phone_label') }}</label>
                            <div class="fld__box">
                                <i class="fas fa-phone-alt fld__icon" aria-hidden="true"></i>
                                <input type="tel" name="phone" id="phone" autocomplete="tel" class="fld__input @error('phone') is-invalid @enderror" placeholder="{{ __('frontend.contact.phone_ph') }}" value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')">
                            </div>
                            @error('phone')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="fld">
                            <label class="fld__label" for="subject">{{ __('frontend.contact.subject') }}</label>
                            <div class="fld__box">
                                <i class="fas fa-tag fld__icon" aria-hidden="true"></i>
                                <input type="text" name="subject" id="subject" class="fld__input @error('subject') is-invalid @enderror" placeholder="{{ __('frontend.contact.subject_ph') }}" value="{{ old('subject') }}">
                            </div>
                            @error('subject')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="fld">
                        <label class="fld__label" for="message">{{ __('frontend.contact.message') }}</label>
                        <div class="fld__box fld__box--area">
                            <i class="fas fa-comment-dots fld__icon" aria-hidden="true"></i>
                            <textarea name="message" id="message" rows="5" class="fld__input fld__area @error('message') is-invalid @enderror" placeholder="{{ __('frontend.contact.message_ph') }}">{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                            <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="fld">
                            <label class="fld__label" for="captcha">{{ __('frontend.contact.captcha') }}</label>
                            <div class="cap @error('captcha') is-invalid @enderror">
                                <div class="fld__box">
                                    <i class="fas fa-shield-alt fld__icon" aria-hidden="true"></i>
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" class="fld__input" placeholder="{{ __('frontend.contact.captcha_ph') }}">
                                </div>
                                <div class="cap__img">@captcha</div>
                                <button type="button" class="cap__refresh" data-captcha-refresh aria-label="{{ __('frontend.contact.refresh') }}">
                                    <i class="fas fa-sync-alt" aria-hidden="true"></i>
                                </button>
                            </div>
                            @error('captcha')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ __('frontend.contact.captcha_bad') }}</span>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" class="btn btn--primary contact__submit">
                        {{ __('frontend.contact.submit') }}
                        <i class="fas fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    var form = document.getElementById('contactform');

    if (!form) {
        return;
    }

    var messages = {
        name: @json(__('frontend.contact.name_req')),
        email: @json(__('frontend.contact.email_req')),
        emailValid: @json(__('frontend.contact.email_valid')),
        phone: @json(__('frontend.contact.phone_req')),
        subject: @json(__('frontend.contact.subject_req')),
        message: @json(__('frontend.contact.message_req')),
        captcha: @json(__('frontend.contact.captcha_req'))
    };

    function isEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    function clearError(field) {
        var holder = field.closest('.fld');

        field.classList.remove('is-invalid');

        if (field.id === 'captcha') {
            field.closest('.cap').classList.remove('is-invalid');
        }

        if (holder) {
            var note = holder.querySelector('[data-live-error]');

            if (note) {
                note.remove();
            }
        }
    }

    function showError(field, text) {
        var holder = field.closest('.fld');

        if (field.id === 'captcha') {
            field.closest('.cap').classList.add('is-invalid');
        } else {
            field.classList.add('is-invalid');
        }

        if (!holder) {
            return;
        }

        var note = document.createElement('span');
        note.className = 'fld__err';
        note.setAttribute('data-live-error', '');
        note.innerHTML = '<i class="fas fa-info-circle" aria-hidden="true"></i> ';
        note.appendChild(document.createTextNode(text));
        holder.appendChild(note);
    }

    function check(field) {
        var value = (field.value || '').trim();

        if (!value) {
            return messages[field.id] || '';
        }

        if (field.id === 'email' && !isEmail(value)) {
            return messages.emailValid;
        }

        return '';
    }

    var fields = ['name', 'email', 'phone', 'subject', 'message', 'captcha']
        .map(function (id) { return document.getElementById(id); })
        .filter(Boolean);

    fields.forEach(function (field) {
        field.addEventListener('input', function () {
            if (!check(field)) {
                clearError(field);
            }
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

    document.addEventListener('click', function (event) {
        var refresh = event.target.closest('[data-captcha-refresh]');

        if (!refresh) {
            return;
        }

        var image = refresh.parentElement.querySelector('.cap__img img');

        if (image) {
            image.click();
        }
    });
}());
</script>
@endpush
