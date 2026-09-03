<style>
    .ag-toast-container {
        position: fixed;
        top: 100px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 16px;
        pointer-events: none;
    }
    .ag-toast {
        min-width: 300px;
        max-width: 400px;
        background: #ffffff;
        color: #0a0a0a;
        padding: 16px 20px;
        border-radius: 8px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        border-left: 4px solid #bc9c5c;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        pointer-events: auto;
        animation: agSlideIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        position: relative;
    }
    .ag-toast.success {
        border-left-color: #2e7d32;
    }
    .ag-toast.error {
        border-left-color: #d32f2f;
    }
    .ag-toast-icon {
        font-size: 20px;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .ag-toast.success .ag-toast-icon {
        color: #2e7d32;
    }
    .ag-toast.error .ag-toast-icon {
        color: #d32f2f;
    }
    .ag-toast-content {
        flex: 1;
        font-family: var(--font-arial, Arial, sans-serif);
        font-size: 15px;
        line-height: 1.5;
        font-weight: 500;
    }
    .ag-toast-close {
        background: none;
        border: none;
        font-size: 24px;
        color: #999999;
        cursor: pointer;
        padding: 0;
        line-height: 1;
        transition: color 0.2s;
        margin-top: -2px;
    }
    .ag-toast-close:hover {
        color: #0a0a0a;
    }
    @keyframes agSlideIn {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes agFadeOut {
        from { transform: translateY(0); opacity: 1; }
        to { transform: translateY(-50px); opacity: 0; }
    }
    .ag-toast.hiding {
        animation: agFadeOut 0.3s ease forwards;
    }
</style>

<div class="ag-toast-container">
    @if(session('success'))
        <div class="ag-toast success">
            <i class="fas fa-check-circle ag-toast-icon"></i>
            <div class="ag-toast-content">
                {{ session('success') }}
            </div>
            <button class="ag-toast-close" onclick="this.parentElement.classList.add('hiding'); setTimeout(() => this.parentElement.remove(), 300);">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="ag-toast error">
            <i class="fas fa-exclamation-circle ag-toast-icon"></i>
            <div class="ag-toast-content">
                {{ session('error') }}
            </div>
            <button class="ag-toast-close" onclick="this.parentElement.classList.add('hiding'); setTimeout(() => this.parentElement.remove(), 300);">&times;</button>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toasts = document.querySelectorAll('.ag-toast');
        toasts.forEach(toast => {
            setTimeout(() => {
                if(document.body.contains(toast)) {
                    toast.classList.add('hiding');
                    setTimeout(() => toast.remove(), 300);
                }
            }, 5000);
        });
    });
</script>