@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => $page_data->page_title,
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => $page_data->page_title]
    ]
])

<style>
/* ==========================================================================
   Art Courses — Dynamic Content Page (Prose Theme)
   ========================================================================== */
.ag-page-wrapper, .ag-page-wrapper *, .ag-page-wrapper *::before, .ag-page-wrapper *::after {
    box-sizing: border-box;
}
.ag-page-wrapper { /* Bone background for contrast */
    padding: 40px 40px;
    min-height: 80vh;
}
.ag-container {
    max-width: 1000px; /* Slightly wider for comfortable reading */
    margin: 0 auto;
    padding: 0 5%;
}

.ag-page-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 48px !important;
    color: #000000 !important;
    text-align: center;
    margin-bottom: 64px !important;
}

.ag-page-card {
    background-color: #ffffff;
    padding: 80px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.05);
    border-top: 8px solid #000000;
}
@media (max-width: 768px) {
    .ag-page-wrapper { padding: 40px 0; }
    .ag-page-card { padding: 40px 24px; }
    .ag-page-title { font-size: 36px !important; margin-bottom: 40px !important; }
}

/* ==========================================================================
   Rich Text / Prose Styling (User-Generated Content from DB)
   ========================================================================== */
.ag-prose {
    font-family: var(--font-arial, Arial, sans-serif);
    color: #333333;
    line-height: 1.8;
    font-size: 15px; /* REDUCED BASE FONT SIZE */
}

/* Headings */
.ag-prose h1, .ag-prose h2, .ag-prose h3, 
.ag-prose h4, .ag-prose h5, .ag-prose h6 {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    color: #000000;
    margin-top: 48px;
    margin-bottom: 24px;
    font-weight: bold;
    font-size: 24px; /* Theme Heading Size */
    line-height: 1.4;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    padding-bottom: 12px;
}
.ag-prose h1:first-child, 
.ag-prose h2:first-child { 
    margin-top: 0; 
}

/* Paragraphs */
.ag-prose p {
    margin-bottom: 24px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px; /* REDUCED */
}
.ag-prose p:last-child {
    margin-bottom: 0;
}

/* Lists & Bullets */
.ag-prose ul, .ag-prose ol {
    margin-bottom: 32px;
    padding-left: 32px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px; /* REDUCED */
}
.ag-prose li {
    margin-bottom: 12px;
    padding-left: 8px;
}
.ag-prose ul {
    list-style-type: disc; /* Enforced solid bullets */
}
.ag-prose ul ul {
    list-style-type: circle; /* Nested bullets */
    margin-top: 12px;
}
.ag-prose ol {
    list-style-type: decimal; /* Enforced numbering */
}

/* Images (Inline with text, no border) */
.ag-prose img {
    display: inline;
    border: none !important;
    box-shadow: none !important;
    max-width: 100%;
    height: auto;
    margin: 0 8px;
    vertical-align: middle;
}

/* Links */
.ag-prose a {
    color: #bc9c5c;
    text-decoration: underline;
    transition: color 0.3s ease;
}
.ag-prose a:hover {
    color: #000000;
}

/* Tables */
.ag-prose table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 32px;
    margin-bottom: 32px;
    font-size: 16px; /* Slightly smaller for dense data readability */
}
.ag-prose th, .ag-prose td {
    padding: 16px;
    border: 1px solid rgba(0,0,0,0.15);
    text-align: left;
    vertical-align: middle;
}
.ag-prose th {
    background-color: #f5f5f5;
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-weight: bold;
    color: #000000;
    text-transform: uppercase;
    font-size: 16px;
    letter-spacing: 0.05em;
}
.ag-prose tr:nth-child(even) td {
    background-color: #fafafa;
}

/* Blockquotes */
.ag-prose blockquote {
    margin: 32px 0;
    padding: 24px 32px;
    background: #f9f9f9;
    border-left: 4px solid #bc9c5c;
    font-style: italic;
    color: #555555;
}
</style>

<div class="ag-page-wrapper">
    <div class="ag-container">
        
        <h1 class="ag-page-title">{{ $page_data->page_title }}</h1>
        
        <div class="ag-page-card">
            <article class="ag-prose">
                {!! $page_data->page_desc !!}
            </article>
        </div>
        
    </div>
</div>

@endsection
