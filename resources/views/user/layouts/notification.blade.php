{{-- ==========================================================================
     Flash Notifications
     Top-centre alert stack, below the sticky header, at --z-toast so nothing
     in the page can cover it. Styles: public/css/app.css — section 12
     ========================================================================== --}}
@if(session('success') || session('error'))

<div class="nt" aria-live="polite">
    @if(session('success'))
        <div class="nt__alert nt__alert--success" role="status">
            <span class="nt__icon" aria-hidden="true"><i class="fas fa-check"></i></span>
            <div class="nt__body">
                <p class="nt__title">{{ __('frontend.notify.success') }}</p>
                <p class="nt__msg">{{ session('success') }}</p>
            </div>
            <button type="button" class="nt__close" aria-label="{{ __('frontend.notify.close') }}">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
            <span class="nt__bar" aria-hidden="true"></span>
        </div>
    @endif

    @if(session('error'))
        <div class="nt__alert nt__alert--error" role="alert">
            <span class="nt__icon" aria-hidden="true"><i class="fas fa-exclamation"></i></span>
            <div class="nt__body">
                <p class="nt__title">{{ __('frontend.notify.error') }}</p>
                <p class="nt__msg">{{ session('error') }}</p>
            </div>
            <button type="button" class="nt__close" aria-label="{{ __('frontend.notify.close') }}">
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hide = (alert) => {
            if (!document.body.contains(alert) || alert.classList.contains('is-hiding')) return;
            alert.classList.add('is-hiding');
            setTimeout(() => alert.remove(), 320);
        };

        document.querySelectorAll('.nt__alert').forEach(alert => {
            alert.querySelector('.nt__close').addEventListener('click', () => hide(alert));

            // Only alerts carrying a countdown bar dismiss themselves; errors
            // stay until the reader closes them.
            if (alert.querySelector('.nt__bar')) {
                setTimeout(() => hide(alert), 5000);
            }
        });
    });
</script>
@endif
