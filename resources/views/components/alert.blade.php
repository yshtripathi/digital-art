<style>
    .modern-toast-container {
        position: fixed;
        top: 90px; /* Just below the header */
        left: 50%;
        transform: translateX(-50%);
        z-index: 999999; /* Super high to overlay everything */
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        pointer-events: none; /* Let clicks pass through container */
    }
    .modern-toast {
        pointer-events: auto; /* Enable clicks on the toast itself */
        min-width: 320px;
        max-width: 420px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-left: 5px solid;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08), 0 5px 15px rgba(0, 0, 0, 0.03);
        padding: 18px 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transform: translateY(-30px);
        opacity: 0;
        transition: transform 0.5s cubic-bezier(0.2, 0.8, 0.2, 1.1), opacity 0.4s ease;
    }
    .modern-toast.show {
        transform: translateY(0);
        opacity: 1;
    }
    .modern-toast.hide {
        transform: translateY(-30px);
        opacity: 0;
    }
    .modern-toast-icon {
        font-size: 22px;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .modern-toast-content {
        flex-grow: 1;
    }
    .modern-toast-title {
        font-family: var(--font-davinci, 'Times New Roman', serif);
        font-size: 17px;
        font-weight: 600;
        color: var(--color-ink, #000000);
        margin-bottom: 5px;
        display: block;
        letter-spacing: 0.02em;
    }
    .modern-toast-message {
        font-family: var(--font-helvetica-now, 'Helvetica Neue', sans-serif);
        font-size: 14px;
        color: var(--color-graphite, #595855);
        line-height: 1.5;
    }
    .modern-toast-close {
        background: transparent;
        border: none;
        color: #a0a0a0;
        font-size: 20px;
        cursor: pointer;
        padding: 0;
        transition: color 0.2s ease, transform 0.2s ease;
        line-height: 1;
        margin-top: -2px;
    }
    .modern-toast-close:hover {
        color: var(--color-ink, #000000);
        transform: scale(1.1);
    }
    
    /* Type variants based on brand colors where possible, falling back to clean semantics */
    .toast-success { border-left-color: #10B981; }
    .toast-success .modern-toast-icon { color: #10B981; }
    
    .toast-error { border-left-color: #EF4444; }
    .toast-error .modern-toast-icon { color: #EF4444; }
    
    .toast-warning { border-left-color: #F59E0B; }
    .toast-warning .modern-toast-icon { color: #F59E0B; }
    
    .toast-info { border-left-color: #3B82F6; }
    .toast-info .modern-toast-icon { color: #3B82F6; }

    @media (max-width: 480px) {
        .modern-toast-container {
            top: 70px;
            width: 90%;
        }
        .modern-toast {
            min-width: 0;
            width: 100%;
        }
    }
</style>

<div class="modern-toast-container" id="toastContainer">
    @foreach (['success', 'error', 'warning', 'info'] as $msg)
        @if(session($msg))
            <div class="modern-toast toast-{{ $msg }}" role="alert">
                <div class="modern-toast-icon">
                    @if($msg == 'success')
                        <i class="fas fa-check-circle"></i>
                    @elseif($msg == 'error')
                        <i class="fas fa-times-circle"></i>
                    @elseif($msg == 'warning')
                        <i class="fas fa-exclamation-triangle"></i>
                    @else
                        <i class="fas fa-info-circle"></i>
                    @endif
                </div>
                <div class="modern-toast-content">
                    <span class="modern-toast-title">
                        @if($msg == 'success')
                            Success
                        @elseif($msg == 'error')
                            Error
                        @elseif($msg == 'warning')
                            Warning
                        @else
                            Information
                        @endif
                    </span>
                    <div class="modern-toast-message">{{ session($msg) }}</div>
                </div>
                <button class="modern-toast-close" onclick="closeToast(this.parentElement)" aria-label="Close">&times;</button>
            </div>
        @endif
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toasts = document.querySelectorAll('.modern-toast');
        toasts.forEach((toast, index) => {
            // Stagger the entrance if there are multiple
            setTimeout(() => {
                toast.classList.add('show');
            }, 100 + (150 * index));
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                if (toast.classList.contains('show')) {
                    closeToast(toast);
                }
            }, 3000 + (150 * index));
        });
    });

    function closeToast(toast) {
        toast.classList.remove('show');
        toast.classList.add('hide');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 500); // Wait for transition
    }
</script>
