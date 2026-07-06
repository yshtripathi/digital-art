@push('styles')
<style>
    /* =========================================================
       AUTH PAGES — Structured theme split card (brand aside + form)
       ========================================================= */
    .au-section { background-color: var(--color-putty, #c4c3b6); padding: 72px 40px; }
    .au-card {
        display: grid; grid-template-columns: 0.9fr 1.1fr;
        max-width: 1040px; margin: 0 auto;
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 16px; overflow: hidden;
    }

    /* Branding aside (ink room, i9.png art behind) */
    .au-aside {
        position: relative; overflow: hidden;
        background-color: var(--color-ink, #000);
        padding: 48px 40px; display: flex; flex-direction: column; justify-content: center;
    }
    .au-aside__art {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        height: 94%; width: auto; z-index: 1;
        opacity: 0.16; pointer-events: none;
        filter: brightness(0) invert(1);   /* black dragon -> soft white, centered watermark on the ink panel */
    }
    .au-aside__inner { position: relative; z-index: 2; }
    .au-aside__mark {
        display: inline-flex; align-items: center; justify-content: center;
        width: 48px; height: 48px; border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.3); color: var(--color-paper, #fff);
        font-size: 18px; margin-bottom: 22px;
    }
    .au-aside__title {
        font-family: var(--font-davinci, serif); font-size: 30px; font-weight: 500;
        color: var(--color-paper, #fff); line-height: 1.15; margin: 0 0 12px 0;
    }
    .au-aside__sub {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; line-height: 1.6;
        color: rgba(255, 255, 255, 0.65); margin: 0 0 24px 0; max-width: 300px;
    }
    .au-aside__list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
    .au-aside__list li {
        display: flex; align-items: center; gap: 10px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; color: rgba(255, 255, 255, 0.8);
    }
    .au-aside__list li i { color: var(--color-paper, #fff); font-size: 11px; }

    /* Form panel (paper) */
    .au-main { padding: 48px 44px; }
    .au-main__head { margin-bottom: 26px; }
    .au-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.16em; color: var(--color-graphite, #595855); margin: 0 0 8px 0;
    }
    .au-title {
        font-family: var(--font-davinci, serif); font-size: clamp(26px, 3vw, 34px); font-weight: 500;
        color: var(--color-ink, #000); margin: 0; line-height: 1.1;
    }

    .au-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .au-field { margin-bottom: 16px; }
    .au-label {
        display: flex; align-items: center; gap: 7px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.06em; color: var(--color-graphite, #595855); margin-bottom: 7px;
    }
    .au-label i { font-size: 11px; }
    .au-input {
        width: 100%; box-sizing: border-box;
        background-color: var(--color-bone, #e7e5e4);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 9px; padding: 12px 14px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; color: var(--color-ink, #000);
        outline: none; transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .au-input::placeholder { color: #9a9a92; }
    .au-input:focus { border-color: var(--color-ink, #000); box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.08); background-color: var(--color-paper, #fff); }
    .au-input.error, .au-input.is-invalid { border-color: #cf7d7d; box-shadow: 0 0 0 3px rgba(207, 125, 125, 0.18); }

    /* Validation message — always directly below the input (incl. jQuery-validate spans) */
    .au-error, .au-main span.error, .au-main label.error {
        display: block; margin-top: 7px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; line-height: 1.4;
        color: #c0392b; font-weight: 500;
    }
    .au-error i { font-size: 11px; margin-right: 4px; }

    /* Captcha */
    .au-captcha { display: grid; grid-template-columns: 1fr auto; gap: 12px; align-items: center; }
    .au-captcha__img img {
        height: 46px; width: auto; border-radius: 9px;
        border: 1px solid var(--color-vellum, #dfdcd5); background: var(--color-paper, #fff);
    }

    .au-forgot { text-align: right; margin: -4px 0 18px 0; }
    .au-forgot a { font-family: var(--font-helvetica-now, sans-serif); font-size: 12.5px; color: var(--color-ink, #000); text-decoration: none; }
    .au-forgot a:hover { text-decoration: underline; }

    .au-submit {
        width: 100%; margin-top: 6px;
        display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        background-color: var(--color-ink, #000); color: var(--color-paper, #fff);
        border: 1px solid var(--color-ink, #000); border-radius: 28.8px;
        padding: 14px 24px; cursor: pointer; transition: opacity 0.2s ease;
    }
    .au-submit:hover { opacity: 0.88; }

    .au-divider { display: flex; align-items: center; gap: 14px; margin: 24px 0; }
    .au-divider::before, .au-divider::after { content: ""; flex: 1; height: 1px; background: var(--color-vellum, #dfdcd5); }
    .au-divider span { font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-graphite, #595855); }

    .au-alt { text-align: center; font-family: var(--font-helvetica-now, sans-serif); font-size: 13.5px; color: var(--color-graphite, #595855); }
    .au-alt a { color: var(--color-ink, #000); font-weight: 600; text-decoration: none; }
    .au-alt a:hover { text-decoration: underline; }

    @media (max-width: 860px) {
        .au-section { padding: 48px 20px; }
        .au-card { grid-template-columns: 1fr; }
        .au-aside { padding: 40px 28px; }
        .au-aside__art { height: auto; width: 68%; left: 50%; right: auto; top: 50%; transform: translate(-50%, -50%); opacity: 0.12; }
        .au-main { padding: 36px 28px; }
    }
    @media (max-width: 520px) {
        .au-row { grid-template-columns: 1fr; gap: 0; }
        .au-captcha { grid-template-columns: 1fr; }
    }
</style>
@endpush
