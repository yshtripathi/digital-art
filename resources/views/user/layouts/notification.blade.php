@if(session('success') || session('error'))
@once
<style>
.toasts {
  --t-violet: var(--color-quill-violet, #693edf);
  --t-royal: var(--color-royal-script, #3b0d96);
  --t-wash: var(--color-lavender-wash, #efebfc);
  --t-page: var(--color-lavender-page, #c1b9f4);
  --t-ink: var(--color-ink, #000b0f);
  --t-pencil: var(--color-pencil, #566b76);
  --t-rule: var(--color-page-rule, #e2e8eb);
  --t-paper: var(--color-paper, #ffffff);
  --t-ok: #1f7a4d;
  --t-ok-bg: #e8f5ee;
  --t-bad: #b42318;
  --t-bad-bg: #fdecea;
  position: fixed;
  top: var(--toast-top, 16px);
  left: 50%;
  z-index: 280;
  display: grid;
  gap: 10px;
  width: min(460px, calc(100% - 24px));
  transform: translateX(-50%);
  font-family: var(--font-body, 'Inter', ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif);
  pointer-events: none;
}

.toast {
  --tone: var(--t-ok);
  --tone-bg: var(--t-ok-bg);
  position: relative;
  display: grid;
  grid-template-columns: 40px minmax(0, 1fr) 32px;
  align-items: start;
  gap: 14px;
  padding: 14px 14px 18px;
  overflow: hidden;
  border: 1px solid var(--t-rule);
  border-radius: 4px;
  background-color: var(--t-paper);
  box-shadow: 0 16px 40px rgba(41, 0, 122, 0.16), 0 2px 6px rgba(23, 23, 23, 0.06);
  pointer-events: auto;
  animation: toast-drop 520ms cubic-bezier(0.22, 1, 0.36, 1) both;
}

.toast--error {
  --tone: var(--t-bad);
  --tone-bg: var(--t-bad-bg);
}

.toast::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  width: 18px;
  height: 18px;
  background: linear-gradient(225deg, var(--tone) 0 50%, transparent 50%);
  animation: toast-fold 420ms ease 300ms both;
}

.toast__icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  margin-top: 2px;
  border-radius: 4px;
  background-color: var(--tone-bg);
  color: var(--tone);
  font-size: 16px;
  animation: toast-stamp 520ms cubic-bezier(0.34, 1.56, 0.64, 1) 180ms both;
}

.toast__body {
  min-width: 0;
  padding-top: 2px;
}

.toast__title {
  margin: 0 0 2px;
  font-family: var(--font-heading, 'Space Grotesk', 'Inter', ui-sans-serif, system-ui, sans-serif);
  font-size: 15px;
  font-weight: 600;
  line-height: 1.35;
  color: var(--t-ink);
}

.toast__msg {
  margin: 0;
  font-size: 14px;
  line-height: 1.5;
  color: var(--t-pencil);
  overflow-wrap: anywhere;
}

.toast__close {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  padding: 0;
  border: 1px solid transparent;
  border-radius: 4px;
  background: none;
  color: var(--t-pencil);
  font-size: 14px;
  cursor: pointer;
  transition: background-color 150ms ease, color 150ms ease, border-color 150ms ease;
}

.toast__close i {
  transition: transform 250ms ease;
}

.toast__close:hover {
  border-color: var(--t-page);
  background-color: var(--t-wash);
  color: var(--t-royal);
}

.toast__close:hover i {
  transform: scale(0.8);
}

.toast__close:focus-visible {
  outline: none;
  box-shadow: 0 0 0 2px var(--t-paper), 0 0 0 4px var(--t-violet);
}

.toast__time {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 3px;
  background-color: var(--t-wash);
}

.toast__time::after {
  content: "";
  position: absolute;
  inset: 0;
  background-color: var(--t-violet);
  transform-origin: left center;
  animation: toast-time 5s linear 520ms forwards;
}

.toast.is-paused .toast__time::after {
  animation-play-state: paused;
}

.toast--error .toast__time {
  display: none;
}

.toast.is-hiding {
  animation: toast-lift 380ms cubic-bezier(0.65, 0, 0.35, 1) forwards;
}

@keyframes toast-drop {
  from {
    opacity: 0;
    transform: translateY(-28px) scale(0.96);
  }

  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

@keyframes toast-stamp {
  from {
    opacity: 0;
    transform: scale(0.4) rotate(-18deg);
  }

  to {
    opacity: 1;
    transform: scale(1) rotate(0);
  }
}

@keyframes toast-fold {
  from {
    width: 0;
    height: 0;
  }
}

@keyframes toast-time {
  from {
    transform: scaleX(1);
  }

  to {
    transform: scaleX(0);
  }
}

@keyframes toast-lift {
  to {
    opacity: 0;
    transform: translateY(-20px) scale(0.96);
  }
}

@media (max-width: 560px) {
  .toast {
    grid-template-columns: 34px minmax(0, 1fr) 32px;
    gap: 12px;
  }

  .toast__icon {
    width: 34px;
    height: 34px;
    font-size: 14px;
  }
}

@media (prefers-reduced-motion: reduce) {
  .toast,
  .toast__icon,
  .toast.is-hiding {
    animation-duration: 1ms;
  }
}
</style>

<div class="toasts" data-toasts>
    @if(session('success'))
        <div class="toast toast--success" role="status" data-toast data-toast-auto>
            <span class="toast__icon" aria-hidden="true"><i class="fas fa-check"></i></span>
            <div class="toast__body">
                <p class="toast__title">{{ __('frontend.notify.ok') }}</p>
                <p class="toast__msg">{{ session('success') }}</p>
            </div>
            <button type="button" class="toast__close" aria-label="{{ __('frontend.notify.dismiss') }}" data-toast-close>
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
            <span class="toast__time" aria-hidden="true"></span>
        </div>
    @endif

    @if(session('error'))
        <div class="toast toast--error" role="alert" data-toast>
            <span class="toast__icon" aria-hidden="true"><i class="fas fa-exclamation"></i></span>
            <div class="toast__body">
                <p class="toast__title">{{ __('frontend.notify.fail') }}</p>
                <p class="toast__msg">{{ session('error') }}</p>
            </div>
            <button type="button" class="toast__close" aria-label="{{ __('frontend.notify.dismiss') }}" data-toast-close>
                <i class="fas fa-times" aria-hidden="true"></i>
            </button>
        </div>
    @endif
</div>

<script>
(function () {
    'use strict';

    var stack = document.querySelector('[data-toasts]');
    var mast = document.querySelector('[data-mast]');

    function place() {
        if (!stack) { return; }
        var edge = 0;
        if (mast) {
            edge = Math.max(mast.getBoundingClientRect().bottom, 0);
        }
        stack.style.setProperty('--toast-top', Math.round(edge + 12) + 'px');
    }

    place();
    window.addEventListener('scroll', place, { passive: true });
    window.addEventListener('resize', place);

    document.querySelectorAll('[data-toast]').forEach(function (toast) {
        var hide = function () {
            if (toast.classList.contains('is-hiding')) { return; }
            toast.classList.add('is-hiding');
            setTimeout(function () {
                toast.remove();
                if (stack && !stack.children.length) { stack.remove(); }
            }, 380);
        };

        var close = toast.querySelector('[data-toast-close]');
        if (close) { close.addEventListener('click', hide); }

        if (toast.hasAttribute('data-toast-auto')) {
            var time = toast.querySelector('.toast__time');
            if (time) {
                time.addEventListener('animationend', hide);
            }
            var pause = function () { toast.classList.add('is-paused'); };
            var resume = function () { toast.classList.remove('is-paused'); };
            toast.addEventListener('mouseenter', pause);
            toast.addEventListener('mouseleave', resume);
            toast.addEventListener('focusin', pause);
            toast.addEventListener('focusout', resume);
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') { return; }
        document.querySelectorAll('[data-toast]').forEach(function (toast) {
            var close = toast.querySelector('[data-toast-close]');
            if (close) { close.click(); }
        });
    });
}());
</script>
@endonce
@endif
