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
    $ctEmail    = filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email');
    $ctAddress  = filled($misc['Company Address'] ?? null) ? $misc['Company Address'] : __('frontend.company.address');
    $ctCompany  = filled($misc['Company Name'] ?? null) ? $misc['Company Name'] : __('frontend.company.name');
    $ctSite     = __('frontend.head.site');
    $ctInitials = collect(preg_split('/\s+/u', trim($ctSite)))->filter()->take(2)->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))->implode('');
@endphp

<section class="reach-us">
    <div class="reach-us__grid">
        <div class="gate__stack gate__stack--wide post-stack">
        <aside class="post">
            <span class="post__stamp" aria-hidden="true">
                <span class="post__mono">{{ $ctInitials }}</span>
                <span class="post__site">{{ $ctSite }}</span>
            </span>

            <p class="post__eyebrow">{{ __('frontend.contact.page_name') }}</p>
            <h2 class="post__title">{{ __('frontend.contact.side_title') }}</h2>
            <p class="post__text">{{ __('frontend.contact.side_text') }}</p>

            <ul class="post__rows">
                <li class="post__row" style="--i: 0">
                    <span class="post__icon" aria-hidden="true"><i class="far fa-envelope"></i></span>
                    <span class="post__meta">
                        <span class="post__label">{{ __('frontend.contact.row_email') }}</span>
                        <a href="mailto:{{ $ctEmail }}" class="post__value">{{ $ctEmail }}</a>
                    </span>
                    <button type="button" class="post__copy" data-copy="{{ $ctEmail }}" data-done="{{ __('frontend.contact.copied') }}">
                        <i class="far fa-copy" aria-hidden="true"></i>
                        <span data-copy-label>{{ __('frontend.contact.copy') }}</span>
                    </button>
                </li>
                <li class="post__row" style="--i: 1">
                    <span class="post__icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></span>
                    <span class="post__meta">
                        <span class="post__label">{{ __('frontend.contact.row_address') }}</span>
                        <span class="post__value">{{ $ctAddress }}</span>
                    </span>
                </li>
                <li class="post__row" style="--i: 2">
                    <span class="post__icon" aria-hidden="true"><i class="far fa-building"></i></span>
                    <span class="post__meta">
                        <span class="post__label">{{ __('frontend.contact.row_company') }}</span>
                        <span class="post__value">{{ $ctCompany }}</span>
                    </span>
                </li>
            </ul>
        </aside>
        </div>

        <div class="gate__stack gate__stack--wide">
        <div class="gate__card note-card">
            <div class="note-card__head">
                <h2 class="note-card__title">{{ __('frontend.contact.title') }}</h2>
                <p class="note-card__lead">{{ __('frontend.contact.intro') }}</p>
            </div>

            <form method="POST" action="{{ route('contact.send') }}" id="contactform" class="gate__form" novalidate>
                @csrf

                <div class="entry">
                    <label class="entry__label" for="name">{{ __('frontend.contact.name_label') }}</label>
                    <div class="entry__box @error('name') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-user"></i></span>
                        <input type="text" name="name" id="name" autocomplete="name" class="entry__input" placeholder="{{ __('frontend.contact.name_hint') }}" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="email">{{ __('frontend.contact.mail_label') }}</label>
                    <div class="entry__box @error('email') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-at"></i></span>
                        <input type="email" name="email" id="email" autocomplete="email" class="entry__input" placeholder="{{ __('frontend.contact.mail_hint') }}" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="phone">{{ __('frontend.contact.phone_field') }}</label>
                    <div class="entry__box @error('phone') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-mobile-alt"></i></span>
                        <input type="tel" name="phone" id="phone" autocomplete="tel" class="entry__input" placeholder="{{ __('frontend.contact.phone_hint') }}" value="{{ old('phone') }}" oninput="this.value = this.value.replace(/[^\d\+\-\(\)\s]/g, '')">
                    </div>
                    @error('phone')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="subject">{{ __('frontend.contact.subject_label') }}</label>
                    <div class="entry__box @error('subject') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="fas fa-heading"></i></span>
                        <input type="text" name="subject" id="subject" class="entry__input" placeholder="{{ __('frontend.contact.subject_hint') }}" value="{{ old('subject') }}">
                    </div>
                    @error('subject')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                <div class="entry">
                    <label class="entry__label" for="message">{{ __('frontend.contact.msg_label') }}</label>
                    <div class="entry__box entry__box--area @error('message') is-invalid @enderror">
                        <span class="entry__icon" aria-hidden="true"><i class="far fa-comment-alt"></i></span>
                        <textarea name="message" id="message" rows="5" class="entry__input entry__area" placeholder="{{ __('frontend.contact.msg_hint') }}">{{ old('message') }}</textarea>
                    </div>
                    @error('message')
                        <span class="entry__err">{{ $message }}</span>
                    @enderror
                </div>

                @if(env('CAPTCHA_ENABLED', true))
                    <div class="entry">
                        <label class="entry__label" for="captcha">{{ __('frontend.contact.code_label') }}</label>
                        <div class="entry__cap">
                            <div class="cap__img">@captcha</div>
                            <div class="entry__box @error('captcha') is-invalid @enderror">
                                <span class="entry__icon" aria-hidden="true"><i class="fas fa-shield-alt"></i></span>
                                <input type="text" id="captcha" name="captcha" autocomplete="off" class="entry__input" placeholder="{{ __('frontend.contact.code_hint') }}">
                            </div>
                        </div>
                        @error('captcha')
                            <span class="entry__err">{{ __('frontend.contact.code_wrong') }}</span>
                        @enderror
                    </div>
                @endif

                <button type="submit" class="btn btn--block gate__submit">
                    <span>{{ __('frontend.contact.submit') }}</span>
                    <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                </button>
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
        var holder = field.closest('.entry');
        var box = field.closest('.entry__box');

        if (box) { box.classList.remove('is-invalid'); }

        if (holder) {
            holder.querySelectorAll('.entry__err').forEach(function (note) { note.remove(); });
        }
    }

    function showError(field, text) {
        var holder = field.closest('.entry');
        var box = field.closest('.entry__box');

        if (box) { box.classList.add('is-invalid'); }
        if (!holder) { return; }

        var note = document.createElement('span');
        note.className = 'entry__err';
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
