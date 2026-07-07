<style>
    .modern-toast-container {
        position: fixed;
        top: 90px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 999999;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        pointer-events: none;
    }
    .modern-toast {
        pointer-events: auto;
        min-width: 280px;
        max-width: 450px;
        background: #1a1a1a;
        color: #ffffff;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        padding: 12px 20px 12px 16px;
        display: flex;
        align-items: center;
        gap: 14px;
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
        font-size: 20px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        width: 32px;
        height: 32px;
    }
    .modern-toast-content {
        flex-grow: 1;
        font-family: var(--font-helvetica-now, 'Helvetica Neue', sans-serif);
        font-size: 14px;
        font-weight: 500;
        line-height: 1.4;
        letter-spacing: 0.01em;
    }
    .modern-toast-close {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.5);
        font-size: 18px;
        cursor: pointer;
        padding: 4px;
        transition: color 0.2s ease, transform 0.2s ease;
        line-height: 1;
        display: flex;
        align-items: center;
    }
    .modern-toast-close:hover {
        color: #ffffff;
        transform: scale(1.1);
    }
    
    .toast-success .modern-toast-icon { color: #10B981; }
    .toast-error .modern-toast-icon { color: #EF4444; }
    .toast-warning .modern-toast-icon { color: #F59E0B; }
    .toast-info .modern-toast-icon { color: #3B82F6; }

    @media (max-width: 480px) {
        .modern-toast-container {
            top: 70px;
            width: 90%;
        }
        .modern-toast {
            min-width: 0;
            width: 100%;
            border-radius: 12px; /* Less pill-like on small screens for better text wrapping */
        }
    }
</style>

<div class="modern-toast-container" id="toastContainer">
    @foreach (['success', 'error', 'warning', 'info'] as $msg)
        @if(session($msg))
            <div class="modern-toast toast-{{ $msg }}" role="alert">
                <div class="modern-toast-icon">
                    @if($msg == 'success')
                        <i class="fas fa-check"></i>
                    @elseif($msg == 'error')
                        <i class="fas fa-times"></i>
                    @elseif($msg == 'warning')
                        <i class="fas fa-exclamation"></i>
                    @else
                        <i class="fas fa-info"></i>
                    @endif
                </div>
                <div class="modern-toast-content">
                    {{ session($msg) }}
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
