<style>
/* -------------------------------------------
   Duolingo Theme Alerts / Notifications
------------------------------------------- */
.duo-toast-container {
    position: fixed;
    top: 90px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 999999;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    pointer-events: none;
}
.duo-toast {
    pointer-events: auto;
    min-width: 320px;
    max-width: 500px;
    border-radius: 24px;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    transform: translateY(-50px);
    opacity: 0;
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s ease;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    color: #ffffff;
}
.duo-toast.show {
    transform: translateY(0);
    opacity: 1;
}
.duo-toast.hide {
    transform: translateY(-30px);
    opacity: 0;
}
.duo-toast-icon {
    font-size: 24px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.25);
    border-radius: 16px;
    width: 48px;
    height: 48px;
    box-shadow: 0 4px 0 rgba(0,0,0,0.1);
}
.duo-toast-content {
    flex-grow: 1;
    font-size: 17px;
    font-weight: 700;
    line-height: 1.4;
}
.duo-toast-close {
    background: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.7);
    font-size: 28px;
    cursor: pointer;
    padding: 4px;
    transition: all 0.1s ease;
    line-height: 1;
    display: flex;
    align-items: center;
    border-radius: 50%;
}
.duo-toast-close:hover {
    color: #ffffff;
    transform: scale(1.1);
}
.duo-toast-close:active {
    transform: scale(0.9);
}

/* SUCCESS (Eager Green) */
.toast-success { 
    background: var(--color-eager-green, #58cc02);
    border: 2px solid #46a302;
    box-shadow: 0 8px 0 #46a302;
}
/* ERROR (Rose Red) */
.toast-error { 
    background: #ff4b4b;
    border: 2px solid #d13a3a;
    box-shadow: 0 8px 0 #d13a3a;
}
/* WARNING (Yellow) */
.toast-warning { 
    background: #ffc800;
    border: 2px solid #cc9900;
    box-shadow: 0 8px 0 #cc9900;
    color: var(--color-charcoal, #4b4b4b);
}
.toast-warning .duo-toast-icon { background: rgba(0, 0, 0, 0.1); color: #4b4b4b; }
.toast-warning .duo-toast-close { color: rgba(0, 0, 0, 0.5); }
.toast-warning .duo-toast-close:hover { color: #4b4b4b; }
/* INFO (Spark Blue) */
.toast-info { 
    background: var(--color-spark-blue, #1cb0f6);
    border: 2px solid #1899d6;
    box-shadow: 0 8px 0 #1899d6;
}

@media (max-width: 480px) {
    .duo-toast-container {
        top: 70px;
        width: 92%;
    }
    .duo-toast {
        min-width: 0;
        width: 100%;
        padding: 16px;
    }
}
</style>

<div class="duo-toast-container" id="toastContainer">
    @foreach (['success', 'error', 'warning', 'info'] as $msg)
        @if(session($msg))
            <div class="duo-toast toast-{{ $msg }}" role="alert">
                <div class="duo-toast-icon">
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
                <div class="duo-toast-content">
                    {{ session($msg) }}
                </div>
                <button class="duo-toast-close" onclick="closeToast(this.parentElement)" aria-label="Close">&times;</button>
            </div>
        @endif
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toasts = document.querySelectorAll('.duo-toast');
        toasts.forEach((toast, index) => {
            // Stagger the entrance if there are multiple
            setTimeout(() => {
                toast.classList.add('show');
            }, 100 + (150 * index));
            
            // Auto-hide after 4 seconds
            setTimeout(() => {
                if (toast.classList.contains('show')) {
                    closeToast(toast);
                }
            }, 4000 + (150 * index));
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
