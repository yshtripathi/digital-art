@push('styles')
<style>
    /* =========================================================
       ORDER RESULT PAGES — Structured theme (success / failed)
       ========================================================= */
    .ord-section { position: relative; overflow: hidden; background-color: var(--color-putty, #c4c3b6); padding: 84px 40px; }
    .ord-bg {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        width: min(900px, 96%); z-index: 0; opacity: 0.18; pointer-events: none;
        filter: blur(1px);   /* soft colourful backdrop behind the card */
    }
    .ord-card {
        position: relative; z-index: 1;
        max-width: 640px; margin: 0 auto; text-align: center;
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 16px; padding: 52px 44px; box-shadow: none;
        animation: ord-in 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    .ord-badge {
        width: 84px; height: 84px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 32px; margin-bottom: 24px;
        animation: ord-pop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) both;
    }
    .ord-badge--ok { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); }
    .ord-badge--err { background-color: var(--color-bone, #e7e5e4); color: var(--color-ink, #000); border: 1.5px solid var(--color-ink, #000); }

    .ord-title {
        font-family: var(--font-davinci, serif); font-size: clamp(26px, 3.4vw, 38px); font-weight: 500;
        line-height: 1.1; letter-spacing: -0.01em; color: var(--color-ink, #000); margin: 0 0 12px 0;
    }
    .ord-sub {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; line-height: 1.7;
        color: var(--color-graphite, #595855); margin: 0 auto 32px auto; max-width: 460px;
    }

    /* Detail grid (success) */
    .ord-details { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; text-align: left; margin-bottom: 32px; }
    .ord-detail {
        background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 9px; padding: 16px 18px;
    }
    .ord-detail__label {
        display: block; font-family: var(--font-helvetica-now, sans-serif);
        font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em;
        color: var(--color-graphite, #595855); margin-bottom: 6px;
    }
    .ord-detail__value {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; font-weight: 600;
        color: var(--color-ink, #000); word-break: break-word;
    }
    .ord-pill {
        display: inline-block; background-color: var(--color-ink, #000); color: var(--color-paper, #fff);
        padding: 3px 12px; border-radius: 28.8px; font-size: 12px; font-weight: 600;
    }

    /* Help list (failed) */
    .ord-help {
        text-align: left; background-color: var(--color-bone, #e7e5e4);
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 9px;
        padding: 22px 24px; margin-bottom: 28px;
    }
    .ord-help__title {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-ink, #000); margin: 0 0 14px 0;
    }
    .ord-help ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
    .ord-help li {
        display: flex; align-items: flex-start; gap: 10px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13.5px; color: var(--color-graphite, #595855); line-height: 1.5;
    }
    .ord-help li i { color: var(--color-ink, #000); font-size: 11px; margin-top: 3px; flex-shrink: 0; }

    /* Actions */
    .ord-actions { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
    .ord-btn {
        display: inline-flex; align-items: center; gap: 8px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        border-radius: 28.8px; padding: 13px 24px; text-decoration: none;
        transition: opacity 0.2s ease, background-color 0.2s ease;
    }
    .ord-btn--primary { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border: 1px solid var(--color-ink, #000); }
    .ord-btn--primary:hover { opacity: 0.85; color: var(--color-paper, #fff); }
    .ord-btn--ghost { background-color: transparent; color: var(--color-ink, #000); border: 1px solid var(--color-vellum, #dfdcd5); }
    .ord-btn--ghost:hover { background-color: var(--color-bone, #e7e5e4); color: var(--color-ink, #000); }

    /* Footer notes */
    .ord-note, .ord-assist { margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--color-vellum, #dfdcd5); }
    .ord-note {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; line-height: 1.6;
        color: var(--color-graphite, #595855);
    }
    .ord-assist h6 { font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; font-weight: 600; color: var(--color-ink, #000); margin: 0 0 8px 0; }
    .ord-assist p { font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; line-height: 1.6; color: var(--color-graphite, #595855); margin: 0; }
    .ord-note a, .ord-assist a { color: var(--color-ink, #000); font-weight: 600; text-decoration: none; }
    .ord-note a:hover, .ord-assist a:hover { text-decoration: underline; }

    @keyframes ord-in { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes ord-pop { 0% { transform: scale(0); } 100% { transform: scale(1); } }

    @media (max-width: 600px) {
        .ord-section { padding: 56px 20px; }
        .ord-card { padding: 36px 24px; }
        .ord-details { grid-template-columns: 1fr; }
        .ord-btn { width: 100%; justify-content: center; }
    }
    @media (prefers-reduced-motion: reduce) {
        .ord-card, .ord-badge { animation: none; }
    }
</style>
@endpush
