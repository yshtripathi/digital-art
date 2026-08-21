@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => $page_data->page_title,
    'links' => [
        ['name' => __('inkwave.menu_home'), 'url' => route('home')],
        ['name' => $page_data->page_title]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme - Dynamic Page Content
------------------------------------------- */
.duo-page-wrapper {
    background-color: var(--color-paper-white, #ffffff);
    padding-bottom: 120px;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
}
.duo-container {
    max-width: 1100px; /* Wider canvas for inline images */
    margin: 64px auto;
    padding: 0 24px;
}
.duo-page-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    padding: 64px;
    box-shadow: 0 12px 0 #e5e5e5;
}
@media (max-width: 768px) {
    .duo-page-card { padding: 32px 24px; }
}

/* =========================================
   RICH TEXT / PROSE STYLING
========================================= */
.duo-prose {
    color: var(--color-charcoal, #4b4b4b);
    font-size: 19px; /* Larger body size for open canvas */
    line-height: 1.6;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
}

/* Clearfix for floated images */
.duo-prose::after {
    content: "";
    display: table;
    clear: both;
}

/* Typography */
.duo-prose h1,
.duo-prose h2,
.duo-prose h3,
.duo-prose h4,
.duo-prose h5,
.duo-prose h6 {
    color: var(--color-charcoal, #4b4b4b);
    font-weight: 700;
    margin-top: 64px;
    margin-bottom: 24px;
    line-height: 1.2;
    clear: both; /* Ensure headings don't wrap awkwardly around tall images */
}
.duo-prose h1:first-child,
.duo-prose h2:first-child,
.duo-prose h3:first-child {
    margin-top: 0;
}

.duo-prose h1 { font-size: 48px; color: var(--color-eager-green, #58cc02); }
.duo-prose h2 { font-size: 40px; }
.duo-prose h3 { font-size: 32px; }
.duo-prose h4 { font-size: 24px; }
.duo-prose h5 { font-size: 20px; }
.duo-prose h6 { font-size: 17px; text-transform: uppercase; letter-spacing: 0.053em; }

.duo-prose p {
    margin-bottom: 24px;
    color: var(--color-pencil-gray, #777777);
    font-weight: 500;
}
.duo-prose p:last-child {
    margin-bottom: 0;
}

/* Links */
.duo-prose a {
    color: var(--color-spark-blue, #1cb0f6);
    font-weight: 700;
    text-decoration: none;
    transition: color 0.1s;
}
.duo-prose a:hover {
    text-decoration: underline;
}

/* Inline text styling */
.duo-prose strong, .duo-prose b {
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
}
.duo-prose em, .duo-prose i {
    font-style: italic;
}
.duo-prose u {
    text-decoration: underline;
    text-decoration-thickness: 2px;
}

/* Lists */
.duo-prose ul, .duo-prose ol {
    margin-bottom: 32px;
    padding-left: 32px;
    color: var(--color-pencil-gray, #777777);
    overflow: hidden; /* clear floats if needed */
}
.duo-prose li {
    margin-bottom: 12px;
    font-size: 19px; /* matches text size */
    font-weight: 500;
}
.duo-prose li::marker {
    font-size: 19px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
}

/* Tables */
.duo-prose table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    margin: 48px 0 !important;
    clear: both !important;
    border: 2px solid #e5e5e5 !important;
    border-radius: 16px !important;
    box-shadow: 0 6px 0 #e5e5e5 !important;
    overflow: hidden !important;
}
.duo-prose th, .duo-prose td {
    padding: 16px 24px !important;
    border-bottom: 2px solid #e5e5e5 !important;
    text-align: left !important;
    border-right: 2px solid #e5e5e5 !important;
}
.duo-prose th:last-child, .duo-prose td:last-child {
    border-right: none !important;
}
.duo-prose th {
    background: #f7f7f7 !important;
    font-weight: 700 !important;
    color: var(--color-charcoal, #4b4b4b) !important;
    text-transform: uppercase !important;
    letter-spacing: 0.053em !important;
    font-size: 15px !important;
}
.duo-prose td {
    color: var(--color-pencil-gray, #777777) !important;
    font-weight: 500 !important;
    font-size: 17px !important;
}
.duo-prose tr:last-child td, .duo-prose tr:last-child th {
    border-bottom: none !important;
}

/* Images - INLINE WITH TEXT */
.duo-prose img {
    max-width: 100%;
    height: auto;
    border-radius: 24px;
    /* No borders */
    /* Remove block display so it can be inline or floated */
    display: inline-block;
    vertical-align: middle;
}
/* If images are explicitly floated by the rich text editor */
.duo-prose img[style*="float: right"], 
.duo-prose img[align="right"],
.duo-prose .alignright {
    float: right;
    margin: 0 0 24px 48px;
}
.duo-prose img[style*="float: left"], 
.duo-prose img[align="left"],
.duo-prose .alignleft {
    float: left;
    margin: 0 48px 24px 0;
}
/* Default spacing for inline images */
.duo-prose img:not([style*="float"]):not([align]) {
    margin: 16px;
}

/* Blockquotes */
.duo-prose blockquote {
    margin: 48px 0;
    padding: 32px;
    background: #f7f7f7;
    border-left: 8px solid var(--color-spark-blue, #1cb0f6);
    border-radius: 0 24px 24px 0;
    font-style: italic;
    font-size: 22px;
    color: var(--color-charcoal, #4b4b4b);
    font-weight: 700;
    clear: both;
}
.duo-prose blockquote p {
    color: inherit;
    font-weight: inherit;
}
.duo-prose blockquote p:last-child {
    margin-bottom: 0;
}

/* Code Blocks */
.duo-prose pre {
    background: var(--color-charcoal, #4b4b4b);
    color: #ffffff;
    padding: 24px;
    border-radius: 16px;
    overflow-x: auto;
    margin-bottom: 32px;
    font-family: monospace;
    font-size: 15px;
    box-shadow: 0 6px 0 rgba(0,0,0,0.1);
    clear: both;
}
.duo-prose code {
    background: #f7f7f7;
    color: #ff4b4b;
    padding: 2px 8px;
    border-radius: 8px;
    font-family: monospace;
    font-size: 15px;
    font-weight: 700;
    border: 2px solid #e5e5e5;
}
.duo-prose pre code {
    background: transparent;
    color: inherit;
    padding: 0;
    font-weight: normal;
    border: none;
}

/* Horizontal Rules */
.duo-prose hr {
    border: none;
    height: 4px;
    background: #e5e5e5;
    margin: 64px 0;
    border-radius: 4px;
    clear: both;
}
</style>

<div class="duo-page-wrapper">
    <div class="duo-container">
        <div class="duo-page-card">
            <article class="duo-prose">
                {!! $page_data->page_desc !!}
            </article>
        </div>
    </div>
</div>

@endsection
