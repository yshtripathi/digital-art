@if(session('success') || session('error'))
@once
<style>
.notes {
  position: fixed;
  top: 88px;
  left: 50%;
  z-index: 1100;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  width: min(480px, calc(100% - 24px));
  font-family: var(--font-body, 'Inter', 'Noto Sans JP', ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif);
  pointer-events: none;
  transform: translateX(-50%);
}

.note {
  --note-tone: #3ecf8e;
  --note-wash: rgba(62, 207, 142, 0.14);
  display: grid;
  grid-template-rows: 1fr;
  width: 100%;
  pointer-events: auto;
  transition: grid-template-rows 360ms cubic-bezier(0.22, 1, 0.36, 1), margin 360ms cubic-bezier(0.22, 1, 0.36, 1);
}

.note--error {
  --note-tone: #ff7a85;
  --note-wash: rgba(255, 122, 133, 0.14);
}

.note__card {
  position: relative;
  display: grid;
  grid-template-columns: 40px minmax(0, 1fr) 36px;
  align-items: center;
  gap: 14px;
  min-height: 0;
  padding: 14px 12px 14px 20px;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: var(--radius-card, 8px);
  background-color: var(--color-carbon, #111117);
  color: #ffffff;
  clip-path: inset(0 50% 0 50% round 8px);
  animation: note-unfold 520ms cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

.note__strip {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  width: 4px;
  background-color: var(--note-tone);
  transform-origin: center bottom;
}

.note[data-note-auto] .note__strip {
  animation: note-drain 5s linear 520ms forwards;
}

.note.is-paused .note__strip {
  animation-play-state: paused;
}

.note__icon {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: var(--radius-pill, 100px);
  background-color: var(--note-wash);
  color: var(--note-tone);
  font-size: 15px;
  opacity: 0;
  transform: scale(0.4) rotate(-90deg);
  animation: note-icon 480ms cubic-bezier(0.34, 1.56, 0.64, 1) 260ms forwards;
}

.note__body {
  min-width: 0;
  opacity: 0;
  transform: translateY(4px);
  animation: note-body 360ms ease 320ms forwards;
}

.note__head {
  margin: 0 0 2px;
  color: var(--note-tone);
  font-family: var(--font-mono, ui-monospace, 'SFMono-Regular', Menlo, Consolas, monospace);
  font-size: 11px;
  letter-spacing: 0.06em;
  text-transform: uppercase;
}

:lang(ja) .note__head {
  font-family: inherit;
  font-size: 12px;
  font-weight: 500;
  letter-spacing: 0;
  text-transform: none;
}

.note__msg {
  margin: 0;
  color: #ffffff;
  font-size: 15px;
  font-weight: 500;
  line-height: 1.5;
  overflow-wrap: anywhere;
}

.note__close {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  padding: 0;
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: var(--radius-pill, 100px);
  background: none;
  color: var(--color-mist, #a1a1aa);
  font-size: 12px;
  cursor: pointer;
  transition: background-color 250ms ease, color 250ms ease, border-color 250ms ease, transform 350ms cubic-bezier(0.34, 1.56, 0.64, 1);
}

.note__close:hover {
  border-color: #ffffff;
  background-color: #ffffff;
  color: var(--color-obsidian-ink, #010110);
  transform: rotate(90deg);
}

.note__close:focus-visible {
  outline: none;
  box-shadow: 0 0 0 2px var(--color-carbon, #111117), 0 0 0 4px var(--color-iris-pulse, #635bff);
}

.note.is-leaving {
  grid-template-rows: 0fr;
  margin-top: -10px;
}

.note.is-leaving .note__card {
  animation: note-fold 300ms cubic-bezier(0.65, 0, 0.35, 1) forwards;
}

@keyframes note-unfold {
  to {
    clip-path: inset(0 0 0 0 round 8px);
  }
}

@keyframes note-fold {
  from {
    clip-path: inset(0 0 0 0 round 8px);
  }

  to {
    clip-path: inset(0 50% 0 50% round 8px);
  }
}

@keyframes note-icon {
  to {
    opacity: 1;
    transform: none;
  }
}

@keyframes note-body {
  to {
    opacity: 1;
    transform: none;
  }
}

@keyframes note-drain {
  to {
    transform: scaleY(0);
  }
}

@media (max-width: 1099px) {
  .notes {
    top: 76px;
  }
}

@media (max-width: 479px) {
  .note__card {
    grid-template-columns: 36px minmax(0, 1fr) 36px;
    gap: 12px;
    padding: 12px 10px 12px 16px;
  }

  .note__icon {
    width: 36px;
    height: 36px;
    font-size: 13px;
  }

  .note__msg {
    font-size: 14px;
  }
}

@media (prefers-reduced-motion: reduce) {
  .note__card,
  .note__icon,
  .note__body {
    clip-path: none;
    opacity: 1;
    transform: none;
    animation: none;
  }

  .note[data-note-auto] .note__strip {
    animation-duration: 5s !important;
  }
}
</style>

<div class="notes" data-notes>
    @if(session('success'))
        <div class="note note--success" role="status" data-note data-note-auto>
            <div class="note__card">
                <span class="note__strip" aria-hidden="true"></span>
                <span class="note__icon" aria-hidden="true"><i class="fas fa-check"></i></span>
                <div class="note__body">
                    <p class="note__head">{{ __('frontend.notify.ok') }}</p>
                    <p class="note__msg">{{ session('success') }}</p>
                </div>
                <button type="button" class="note__close" aria-label="{{ __('frontend.notify.dismiss') }}" data-note-close>
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="note note--error" role="alert" data-note>
            <div class="note__card">
                <span class="note__strip" aria-hidden="true"></span>
                <span class="note__icon" aria-hidden="true"><i class="fas fa-exclamation"></i></span>
                <div class="note__body">
                    <p class="note__head">{{ __('frontend.notify.fail') }}</p>
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
            }, 380);
        };

        var close = note.querySelector('[data-note-close]');
        if (close) { close.addEventListener('click', hide); }

        if (note.hasAttribute('data-note-auto')) {
            var strip = note.querySelector('.note__strip');
            if (strip) { strip.addEventListener('animationend', hide); }
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
