@if(session('success') || session('error'))

<div class="notes" data-notes>
    @if(session('success'))
        <div class="note note--success" role="status" data-note data-note-auto>
            <span class="note__well" aria-hidden="true">
                <span class="note__pulse"></span>
                <i class="fas fa-check"></i>
            </span>
            <div class="note__body">
                <p class="note__label">{{ __('frontend.notify.ok_label') }}</p>
                <p class="note__msg">{{ session('success') }}</p>
            </div>
            <button type="button" class="note__close" aria-label="{{ __('frontend.notify.dismiss') }}" data-note-close>
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
            <span class="note__timer" aria-hidden="true"></span>
        </div>
    @endif

    @if(session('error'))
        <div class="note note--error" role="alert" data-note>
            <span class="note__well" aria-hidden="true">
                <span class="note__pulse"></span>
                <i class="fas fa-exclamation"></i>
            </span>
            <div class="note__body">
                <p class="note__label">{{ __('frontend.notify.err_label') }}</p>
                <p class="note__msg">{{ session('error') }}</p>
            </div>
            <button type="button" class="note__close" aria-label="{{ __('frontend.notify.dismiss') }}" data-note-close>
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
    @endif
</div>

<script>
(function () {
    'use strict';

    var stack = document.querySelector('[data-notes]');
    var bar = document.querySelector('[data-hd]');

    function place() {
        if (!stack) { return; }
        var edge = 0;
        if (bar) {
            var box = bar.getBoundingClientRect();
            edge = Math.max(box.bottom, 0);
        }
        stack.style.setProperty('--notes-top', Math.round(edge + 16) + 'px');
    }

    place();
    window.addEventListener('scroll', place, { passive: true });
    window.addEventListener('resize', place);

    document.querySelectorAll('[data-note]').forEach(function (note) {
        var timer;
        var left = 5000;
        var began = 0;

        var hide = function () {
            if (note.classList.contains('is-hiding')) { return; }
            clearTimeout(timer);
            note.classList.add('is-hiding');
            setTimeout(function () { note.remove(); }, 320);
        };

        var start = function () {
            clearTimeout(timer);
            note.classList.remove('is-paused');
            began = Date.now();
            timer = setTimeout(hide, left);
        };

        var pause = function () {
            clearTimeout(timer);
            note.classList.add('is-paused');
            left = Math.max(left - (Date.now() - began), 0);
        };

        var close = note.querySelector('[data-note-close]');

        if (close) {
            close.addEventListener('click', hide);
        }

        if (note.hasAttribute('data-note-auto')) {
            start();
            note.addEventListener('mouseenter', pause);
            note.addEventListener('mouseleave', start);
            note.addEventListener('focusin', pause);
            note.addEventListener('focusout', start);
        }
    });
}());
</script>
@endif
