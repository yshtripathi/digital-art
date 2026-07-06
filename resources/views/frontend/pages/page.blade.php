@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

<x-breadcrumb :title="$page_data->page_title" />

<section class="page-section">
    <div class="page-container">
        <div class="page-card">
            <article class="page-prose">
                {!! $page_data->page_desc !!}
            </article>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* =========================================================
       CMS PAGE — Structured theme + rich-text ("prose") styling
       Works for EN & JA content coming raw from the database.
       ========================================================= */
    .page-section { background-color: var(--color-putty, #c4c3b6); padding: 72px 40px; }
    .page-container { max-width: 920px; margin: 0 auto; }
    .page-card {
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5);
        border-radius: 14px; padding: 52px 56px; box-shadow: none;
    }

    /* ---------- Base text ---------- */
    .page-prose {
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 15.5px; line-height: 1.85; color: #2c2c29;
    }
    .page-prose > *:first-child { margin-top: 0 !important; }
    .page-prose > *:last-child { margin-bottom: 0 !important; }

    /* ---------- Headings (serif) ---------- */
    .page-prose h1, .page-prose h2, .page-prose h3,
    .page-prose h4, .page-prose h5, .page-prose h6 {
        font-family: var(--font-davinci, serif);
        color: var(--color-ink, #000); font-weight: 500;
        line-height: 1.2; letter-spacing: -0.01em;
        margin: 2.4rem 0 1rem 0;
    }
    .page-prose h1 { font-size: clamp(28px, 3.4vw, 36px); padding-bottom: 0.7rem; border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .page-prose h2 { font-size: 26px; }
    .page-prose h3 { font-size: 21px; }
    .page-prose h4 { font-size: 18px; font-family: var(--font-helvetica-now, sans-serif); font-weight: 700; }
    .page-prose h5, .page-prose h6 { font-size: 15px; font-family: var(--font-helvetica-now, sans-serif); font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--color-graphite, #595855); }

    /* ---------- Paragraphs & inline ---------- */
    .page-prose p { margin: 0 0 1.3rem 0; }
    .page-prose a { color: var(--color-ink, #000); text-decoration: underline; text-underline-offset: 2px; }
    .page-prose a:hover { color: var(--color-graphite, #595855); }
    .page-prose strong, .page-prose b { color: var(--color-ink, #000); font-weight: 700; }
    .page-prose em, .page-prose i { font-style: italic; }
    .page-prose small { font-size: 0.85em; color: var(--color-graphite, #595855); }
    .page-prose mark { background-color: var(--color-bone, #e7e5e4); color: var(--color-ink, #000); padding: 1px 4px; border-radius: 3px; }

    /* ---------- Lists ---------- */
    .page-prose ul, .page-prose ol { margin: 0 0 1.4rem 0; padding-left: 1.6rem; }
    .page-prose ul { list-style: disc; }
    .page-prose ol { list-style: decimal; }
    .page-prose li { margin-bottom: 0.55rem; padding-left: 0.25rem; }
    .page-prose li::marker { color: var(--color-graphite, #595855); }

    /* Numbered sections (ol > li > h3): render the number INSIDE the heading so the
       number's size/weight/font exactly match the heading (e.g. "3. Cookies and Tracking…") */
    .page-prose ol:has(> li > h3) { list-style: none; padding-left: 0; counter-reset: sec; }
    .page-prose ol:has(> li > h3) > li { counter-increment: sec; padding-left: 0; }
    .page-prose ol:has(> li > h3) > li > h3:first-child::before { content: counter(sec) ". "; }
    .page-prose ul ul, .page-prose ol ol, .page-prose ul ol, .page-prose ol ul { margin: 0.5rem 0 0.5rem 0; }
    .page-prose li > p { margin-bottom: 0.5rem; }
    .page-prose li > h2, .page-prose li > h3, .page-prose li > h4 { margin-top: 0.4rem; }

    /* ---------- Blockquote ---------- */
    .page-prose blockquote {
        margin: 1.6rem 0; padding: 8px 0 8px 22px;
        border-left: 3px solid var(--color-ink, #000);
        color: var(--color-graphite, #595855); font-style: italic;
    }
    .page-prose blockquote p:last-child { margin-bottom: 0; }

    /* ---------- Horizontal rule ---------- */
    .page-prose hr { border: none; border-top: 1px solid var(--color-vellum, #dfdcd5); margin: 2.2rem 0; }

    /* ---------- Images ---------- */
    .page-prose img { max-width: 100%; height: auto; border-radius: 10px; border: 1px solid var(--color-vellum, #dfdcd5); margin: 1.2rem 0; }
    /* inline logo (e.g. billing descriptor) that flows within a sentence */
    .page-prose img.dba-inline { display: inline; height: 26px; width: auto; vertical-align: middle; margin: 0 5px; border: none; border-radius: 3px; }

    /* ---------- Code ---------- */
    .page-prose code { font-family: ui-monospace, "SF Mono", Menlo, Consolas, monospace; font-size: 0.88em; background-color: var(--color-bone, #e7e5e4); padding: 2px 6px; border-radius: 5px; color: var(--color-ink, #000); }
    .page-prose pre { background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 9px; padding: 16px 18px; overflow-x: auto; margin: 1.4rem 0; }
    .page-prose pre code { background: none; padding: 0; }

    /* ---------- Tables (flat, hairline) ---------- */
    .page-prose table {
        width: 100%; border-collapse: collapse; margin: 2rem 0;
        border: 1px solid var(--color-vellum, #dfdcd5);
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px;
    }
    .page-prose thead, .page-prose table th { background-color: var(--color-bone, #e7e5e4); }
    .page-prose th {
        text-align: left; padding: 14px 16px;
        font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;
        color: var(--color-ink, #000); border: 1px solid var(--color-vellum, #dfdcd5); white-space: nowrap;
    }
    .page-prose td { padding: 13px 16px; border: 1px solid var(--color-vellum, #dfdcd5); color: var(--color-ink, #000); line-height: 1.6; vertical-align: top; }
    .page-prose tbody tr:nth-child(even) { background-color: rgba(0, 0, 0, 0.02); }
    .page-prose table strong { background: none; padding: 0; }

    /* ---------- Responsive ---------- */
    @media (max-width: 768px) {
        .page-section { padding: 48px 20px; }
        .page-card { padding: 32px 24px; }
        .page-prose { font-size: 14.5px; }
        .page-prose h1 { font-size: 26px; }
        .page-prose h2 { font-size: 22px; }
        .page-prose h3 { font-size: 19px; }
    }
    @media (max-width: 640px) {
        /* let wide tables scroll horizontally instead of breaking the layout */
        .page-prose table { display: block; overflow-x: auto; white-space: nowrap; }
    }
</style>
@endpush
