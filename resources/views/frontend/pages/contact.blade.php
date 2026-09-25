@extends('frontend.layouts.main')
@section('title', __('frontend.contact.page_name'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.contact.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.contact.page_name')]
    ]
])

@php
    $ctEmail   = $misc['Company Email'] ?? __('frontend.company.email');
    $ctAddress = $misc['Company Address'] ?? __('frontend.company.address');
    $ctCompany = $misc['Company Name'] ?? __('frontend.company.name');
@endphp

<section class="contact">
    <div class="contact__wrap">
        <aside class="contact__info band--coffee">
            <p class="auth__badge">{{ __('frontend.contact.tag') }}</p>
            <h2 class="auth__title">{{ __('frontend.contact.title_main') }}</h2>
            <p class="auth__lead">{{ __('frontend.contact.intro') }}</p>

            <ul class="contact__rows">
                <li class="contact__row">
                    <span class="contact__icon" aria-hidden="true"><i class="fas fa-envelope"></i></span>
                    <span class="contact__text">
                        <span class="contact__label">{{ __('frontend.contact.row_email') }}</span>
                        <a href="mailto:{{ $ctEmail }}" class="contact__value">{{ $ctEmail }}</a>
                    </span>
                </li>
                <li class="contact__row">
                    <span class="contact__icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                    <span class="contact__text">
                        <span class="contact__label">{{ __('frontend.contact.row_address') }}</span>
                        <span class="contact__value">{{ $ctAddress }}</span>
                    </span>
                </li>
                <li class="contact__row">
                    <span class="contact__icon" aria-hidden="true"><i class="fas fa-building"></i></span>
                    <span class="contact__text">
                        <span class="contact__label">{{ __('frontend.contact.row_company') }}</span>
                        <span class="contact__value">{{ $ctCompany }}</span>
                    </span>
                </li>
            </ul>

            <div class="contact__reasons">
                <p class="contact__reasons-title">{{ __('frontend.contact.topics_title') }}</p>
                <ul class="contact__reasons-list">
                    @foreach(__('frontend.contact.topics') as $topic)
                        <li>{{ $topic }}</li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <div class="contact__form">
            <form method="POST" action="{{ route('contact.send') }}" id="contactform" novalidate>
                @csrf

                <div class="auth__fields">

                    <div class="fld">
                        <label class="fld__label" for="name">{{ __('frontend.contact.name_label') }}</label>
                        <div class="fld__box">
                            <i class="fas fa-user fld__icon" aria-hidden="true"></i>
                            <input type="text" name="name" id="name" autocomplete="name" class="fld__input @error('name') is-invalid @enderror" placeholder="{{ __('frontend.contact.name_hint') }}" value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="fld">
                        <label class="fld__label" for="email">{{ __('frontend.contact.mail_label') }}</label>
                        <div class="fld__box">
                            <i class="fas fa-envelope fld__icon" aria-hidden="true"></i>
                            <input type="email" name="email" id="email" autocomplete="email" class="fld__input @error('email') is-invalid @enderror" placeholder="{{ __('frontend.contact.mail_hint') }}" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="fld">
                        <label class="fld__label" for="phone">{{ __('frontend.contact.phone_field') }}</label>
                        <div class="fld__box">
                            <i class="fas fa-phone-alt fld__icon" aria-hidden="true"></i>
                            <input type="tel" name="phone" id="phone" autocomplete="tel" class="fld__input @error('phone') is-invalid @enderror" placeholder="{{ __('frontend.contact.phone_hint') }}" value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')">
                        </div>
                        @error('phone')
                            <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="fld">
                        <label class="fld__label" for="subject">{{ __('frontend.contact.subject_label') }}</label>
                        <div class="fld__box">
                            <i class="fas fa-tag fld__icon" aria-hidden="true"></i>
                            <input type="text" name="subject" id="subject" class="fld__input @error('subject') is-invalid @enderror" placeholder="{{ __('frontend.contact.subject_hint') }}" value="{{ old('subject') }}">
                        </div>
                        @error('subject')
                            <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="fld">
                        <label class="fld__label" for="message">{{ __('frontend.contact.msg_label') }}</label>
                        <div class="fld__box fld__box--area">
                            <i class="fas fa-comment-dots fld__icon" aria-hidden="true"></i>
                            <textarea name="message" id="message" rows="5" class="fld__input fld__area @error('message') is-invalid @enderror" placeholder="{{ __('frontend.contact.msg_hint') }}">{{ old('message') }}</textarea>
                        </div>
                        @error('message')
                            <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ $message }}</span>
                        @enderror
                    </div>

                    @if(env('CAPTCHA_ENABLED', true))
                        <div class="fld">
                            <label class="fld__label" for="captcha">{{ __('frontend.contact.code_label') }}</label>
                            <div class="cap @error('captcha') is-invalid @enderror">
                                <div class="fld__box">
                                    <i class="fas fa-shield-alt fld__icon" aria-hidden="true"></i>
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" class="fld__input" placeholder="{{ __('frontend.contact.code_hint') }}">
                                </div>
                                <div class="cap__img">@captcha</div>
                            </div>
                            @error('captcha')
                                <span class="fld__err"><i class="fas fa-info-circle" aria-hidden="true"></i> {{ __('frontend.contact.code_wrong') }}</span>
                            @enderror
                        </div>
                    @endif

                    <button type="submit" class="btn btn--primary btn--block">
                        {{ __('frontend.contact.send') }}
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
        name: @json(__('frontend.contact.name_empty')),
        email: @json(__('frontend.contact.mail_empty')),
        emailValid: @json(__('frontend.contact.mail_wrong')),
        phone: @json(__('frontend.contact.phone_empty')),
        subject: @json(__('frontend.contact.subject_empty')),
        message: @json(__('frontend.contact.msg_empty')),
        captcha: @json(__('frontend.contact.code_empty'))
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
}());
</script>
@endpush
