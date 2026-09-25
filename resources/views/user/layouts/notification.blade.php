@if(session('success') || session('error'))

<div class="notes">
    @if(session('success'))
        <div class="note note--success" role="status" data-note data-note-auto>
            <span class="note__badge" aria-hidden="true"><span class="rosette"></span></span>
            <div class="note__body">
                <p class="note__label">{{ __('frontend.notify.ok_label') }}</p>
                <p class="note__msg">{{ session('success') }}</p>
            </div>
            <button type="button" class="note__close" aria-label="{{ __('frontend.notify.dismiss') }}" data-note-close>
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="note note--error" role="alert" data-note>
            <span class="note__badge" aria-hidden="true">!</span>
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

    var stack = document.querySelector('.notes');
    var bars = document.querySelectorAll('[data-hd], [data-nav]');

    function place() {
        if (!stack) { return; }
        var edge = 0;
        bars.forEach(function (bar) {
            var box = bar.getBoundingClientRect();
            if (box.height) { edge = Math.max(edge, box.bottom); }
        });
        stack.style.setProperty('--notes-top', Math.round(Math.max(edge, 0) + 12) + 'px');
    }

    place();
    window.addEventListener('scroll', place, { passive: true });
    window.addEventListener('resize', place);

    document.querySelectorAll('[data-note]').forEach(function (note) {
        var timer;

        var hide = function () {
            if (note.classList.contains('is-hiding')) { return; }
            clearTimeout(timer);
            note.classList.add('is-hiding');
            setTimeout(function () { note.remove(); }, 320);
        };

        var start = function () {
            clearTimeout(timer);
            timer = setTimeout(hide, 5000);
        };

        var close = note.querySelector('[data-note-close]');

        if (close) {
            close.addEventListener('click', hide);
        }

        if (note.hasAttribute('data-note-auto')) {
            start();
            note.addEventListener('mouseenter', function () { clearTimeout(timer); });
            note.addEventListener('mouseleave', start);
            note.addEventListener('focusin', function () { clearTimeout(timer); });
            note.addEventListener('focusout', start);
        }
    });
}());
</script>
@endif
