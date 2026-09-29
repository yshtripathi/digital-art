@if(session('success') || session('error'))
@once
<style>
.notes {
  position: fixed;
  right: 20px;
  bottom: 20px;
  z-index: 1100;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 10px;
  width: min(380px, calc(100% - 24px));
  font-family: var(--font-body, 'Manrope', ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, sans-serif);
  pointer-events: none;
}

.note {
  --note-tone: var(--color-success-ink, #1e7a45);
  display: grid;
  grid-template-rows: 1fr;
  width: 100%;
  pointer-events: auto;
  animation: note-in 460ms cubic-bezier(0.22, 1, 0.36, 1) both;
  transition: grid-template-rows 320ms ease, opacity 220ms ease, margin 320ms ease;
}

.note--error {
  --note-tone: var(--color-error-ink, #b42318);
}

.note__card {
  display: grid;
  grid-template-columns: minmax(0, 1fr) 40px;
  align-items: start;
  gap: 12px;
  min-height: 0;
  padding: 18px 16px 18px 20px;
  overflow: hidden;
  border: 1px solid var(--color-chalk-line, #dddddd);
  border-radius: var(--radius-buttons, 20px);
  background-color: var(--color-canvas-white, #ffffff);
  color: var(--color-studio-black, #000000);
}

.note__head {
  display: flex;
  align-items: center;
  gap: 8px;
  margin: 0 0 4px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--note-tone);
}

.note__dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: var(--note-tone);
}

.note__msg {
  margin: 0;
  font-size: 15px;
  font-weight: 500;
  line-height: 1.5;
  overflow-wrap: anywhere;
}

.note__close {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  padding: 0;
  border: 0;
  border-radius: 50%;
  background: none;
  color: var(--color-studio-black, #000000);
  font-size: 13px;
  cursor: pointer;
  transition: background-color 160ms ease;
}

.note__close:hover {
  background-color: var(--color-sketch-paper, #f5f5f5);
}

.note__close:focus-visible {
  outline: none;
  box-shadow: 0 0 0 2px var(--color-studio-black, #000000), 0 0 0 4px var(--color-craft-yellow, #fff050);
}

.note__ring {
  position: absolute;
  inset: 0;
  width: 40px;
  height: 40px;
  transform: rotate(-90deg);
  pointer-events: none;
}

.note__ring circle {
  fill: none;
  stroke-width: 2;
}

.note__ring-base {
  stroke: var(--color-chalk-line, #dddddd);
}

.note__ring-run {
  stroke: var(--color-studio-black, #000000);
  stroke-dasharray: 113.1;
  stroke-dashoffset: 0;
  animation: note-run 5s linear 460ms forwards;
}

.note.is-paused .note__ring-run {
  animation-play-state: paused;
}

.note.is-leaving {
  grid-template-rows: 0fr;
  margin-top: -10px;
  opacity: 0;
}

@keyframes note-in {
  from {
    opacity: 0;
    transform: translateX(40px);
  }

  to {
    opacity: 1;
    transform: none;
  }
}

@keyframes note-run {
  to {
    stroke-dashoffset: 113.1;
  }
}

@media (max-width: 479.98px) {
  .notes {
    right: 12px;
    bottom: 12px;
    left: 12px;
    width: auto;
  }
}

@media (prefers-reduced-motion: reduce) {
  .note {
    animation-duration: 1ms;
    transition-duration: 1ms;
  }
}
</style>

<div class="notes" data-notes>
    @if(session('success'))
        <div class="note note--success" role="status" data-note data-note-auto>
            <div class="note__card">
                <div>
                    <p class="note__head"><span class="note__dot" aria-hidden="true"></span>{{ __('frontend.notify.ok') }}</p>
                    <p class="note__msg">{{ session('success') }}</p>
                </div>
                <button type="button" class="note__close" aria-label="{{ __('frontend.notify.dismiss') }}" data-note-close>
                    <svg class="note__ring" viewBox="0 0 40 40" aria-hidden="true">
                        <circle class="note__ring-base" cx="20" cy="20" r="18"/>
                        <circle class="note__ring-run" cx="20" cy="20" r="18"/>
                    </svg>
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="note note--error" role="alert" data-note>
            <div class="note__card">
                <div>
                    <p class="note__head"><span class="note__dot" aria-hidden="true"></span>{{ __('frontend.notify.fail') }}</p>
                    <p class="note__msg">{{ session('error') }}</p>
                </div>
                <button type="button" class="note__close" aria-label="{{ __('frontend.notify.dismiss') }}" data-note-close>
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    @endif
</div>

<script>
(function () {
    'use strict';

    var stack = document.querySelector('[data-notes]');

    document.querySelectorAll('[data-note]').forEach(function (note) {
        var hide = function () {
            if (note.classList.contains('is-leaving')) { return; }
            note.classList.add('is-leaving');
            setTimeout(function () {
                note.remove();
                if (stack && !stack.children.length) { stack.remove(); }
            }, 340);
        };

        var close = note.querySelector('[data-note-close]');
        if (close) { close.addEventListener('click', hide); }

        if (note.hasAttribute('data-note-auto')) {
            var run = note.querySelector('.note__ring-run');
            if (run) { run.addEventListener('animationend', hide); }
            var pause = function () { note.classList.add('is-paused'); };
            var resume = function () { note.classList.remove('is-paused'); };
            note.addEventListener('mouseenter', pause);
            note.addEventListener('mouseleave', resume);
            note.addEventListener('focusin', pause);
            note.addEventListener('focusout', resume);
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key !== 'Escape') { return; }
        document.querySelectorAll('[data-note-close]').forEach(function (btn) { btn.click(); });
    });
}());
</script>
@endonce
@endif
