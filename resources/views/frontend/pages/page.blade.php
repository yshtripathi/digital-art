@extends('frontend.layouts.main')

@php
    $pageTitle = $page_data->page_title ?? '';
    $pgEmail   = e(filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email'));
    $pgMail    = '<a href="mailto:' . $pgEmail . '">' . $pgEmail . '</a>';
    $rawDesc   = strtr($page_data->page_desc ?? '', [
        ':company'      => e(filled($misc['Company Name'] ?? null) ? $misc['Company Name'] : __('frontend.company.name')),
        ':email'        => $pgMail,
        ':address'      => e(filled($misc['Company Address'] ?? null) ? $misc['Company Address'] : __('frontend.company.address')),
        ':delivery_url' => route('pages', 'delivery-policy'),
        ':refund_url'   => route('pages', 'refund-policy'),
        'src="/assets/' => 'src="' . asset('assets') . '/',
    ]);
    $cleanText = trim(preg_replace('/\s+/', ' ', strip_tags($rawDesc)));
    $metaDesc  = !empty($page_data->page_meta) && app()->getLocale() !== 'ja' ? $page_data->page_meta : \Illuminate\Support\Str::limit($cleanText, 160);
@endphp

@section('title', $pageTitle)
@section('description', $metaDesc)

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => $pageTitle,
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => $pageTitle]
    ]
])

<section class="doc-wrap">
    <div class="container">
        <article class="doc" data-doc>
            {!! $rawDesc !!}
        </article>
    </div>
</section>

@push('scripts')
<script>
(function () {
    'use strict';

    var doc = document.querySelector('[data-doc]');
    if (!doc) { return; }

    doc.querySelectorAll('table').forEach(function (table) {
        table.removeAttribute('style');
        table.querySelectorAll('[style]').forEach(function (cell) { cell.removeAttribute('style'); });
        var box = document.createElement('div');
        box.className = 'doc__table';
        table.parentNode.insertBefore(box, table);
        box.appendChild(table);
    });
}());
</script>
@endpush

@endsection
