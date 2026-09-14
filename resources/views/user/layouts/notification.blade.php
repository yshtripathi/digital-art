{{-- ==========================================================================
     [Website Name] — Flash Notifications (toasts)
     Dark floating cards, top-right (see design and content/DESIGN.md).
     Styles: public/css/notifications.css (loaded in frontend + user heads)
     ========================================================================== --}}
@if(session('success') || session('error'))

<div class="nt" aria-live="polite">
    @if(session('success'))
        <div class="nt__toast nt__toast--success" role="status">
            <span class="nt__icon" aria-hidden="true"><i class="fas fa-check"></i></span>
            <div class="nt__body">
                <span class="nt__title">Success</span>
                <p class="nt__msg">{{ session('success') }}</p>
            </div>
            <button type="button" class="nt__close" aria-label="Close"><i class="fas fa-times"></i></button>
            <span class="nt__bar" aria-hidden="true"></span>
        </div>
    @endif

    @if(session('error'))
        <div class="nt__toast nt__toast--error" role="alert">
            <span class="nt__icon" aria-hidden="true"><i class="fas fa-exclamation"></i></span>
            <div class="nt__body">
                <span class="nt__title">Error</span>
                <p class="nt__msg">{{ session('error') }}</p>
            </div>
            <button type="button" class="nt__close" aria-label="Close"><i class="fas fa-times"></i></button>
            <span class="nt__bar" aria-hidden="true"></span>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hide = (toast) => {
            if (!document.body.contains(toast) || toast.classList.contains('is-hiding')) return;
            toast.classList.add('is-hiding');
            setTimeout(() => toast.remove(), 300);
        };

        document.querySelectorAll('.nt__toast').forEach(toast => {
            toast.querySelector('.nt__close').addEventListener('click', () => hide(toast));
            setTimeout(() => hide(toast), 5000);
        });
    });
</script>
@endif
