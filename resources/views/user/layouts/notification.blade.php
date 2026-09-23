@if(session('success') || session('error'))

<div class="toasts">
    @if(session('success'))
        <div class="toast toast--success" role="status" data-toast data-toast-auto>
            <span class="toast__icon" aria-hidden="true"><i class="fas fa-check"></i></span>
            <p class="toast__msg">{{ session('success') }}</p>
            <button type="button" class="toast__close" aria-label="{{ __('frontend.notify.close') }}" data-toast-close>
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
            <span class="toast__bar" aria-hidden="true"></span>
        </div>
    @endif

    @if(session('error'))
        <div class="toast toast--error" role="alert" data-toast>
            <span class="toast__icon" aria-hidden="true"><i class="fas fa-exclamation"></i></span>
            <p class="toast__msg">{{ session('error') }}</p>
            <button type="button" class="toast__close" aria-label="{{ __('frontend.notify.close') }}" data-toast-close>
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
    @endif
</div>

<script>
(function () {
    'use strict';

    document.querySelectorAll('[data-toast]').forEach(function (toast) {
        var timer;

        var hide = function () {
            if (toast.classList.contains('is-hiding')) { return; }
            clearTimeout(timer);
            toast.classList.add('is-hiding');
            setTimeout(function () { toast.remove(); }, 240);
        };

        var close = toast.querySelector('[data-toast-close]');

        if (close) {
            close.addEventListener('click', hide);
        }

        if (toast.hasAttribute('data-toast-auto')) {
            timer = setTimeout(hide, 4500);
        }
    });
}());
</script>
@endif
