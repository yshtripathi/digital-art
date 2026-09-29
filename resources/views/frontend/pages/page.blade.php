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
    <div class="container doc-grid">
        <aside class="doc-toc" data-toc hidden>
            <details class="doc-toc__box" open data-toc-box>
                <summary class="doc-toc__title">{{ __('frontend.page.toc') }}</summary>
                <ol class="doc-toc__list" data-toc-list></ol>
            </details>
        </aside>

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

    var toc = document.querySelector('[data-toc]');
    var list = document.querySelector('[data-toc-list]');
    var heads = Array.prototype.slice.call(doc.querySelectorAll('h2'));

    if (toc && list && heads.length > 1) {
        var links = [];
        heads.forEach(function (head, i) {
            if (!head.id) { head.id = 'section-' + (i + 1); }
            var item = document.createElement('li');
            var link = document.createElement('a');
            link.href = '#' + head.id;
            link.className = 'doc-toc__link';
            link.textContent = head.textContent.trim();
            item.appendChild(link);
            list.appendChild(item);
            links.push(link);
        });
        toc.hidden = false;

        var box = document.querySelector('[data-toc-box]');
        if (box && window.matchMedia('(max-width: 1023px)').matches) { box.open = false; }

        if ('IntersectionObserver' in window) {
            var watch = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) { return; }
                    links.forEach(function (link) {
                        link.classList.toggle('is-on', link.getAttribute('href') === '#' + entry.target.id);
                    });
                });
            }, { rootMargin: '-90px 0px -65% 0px' });
            heads.forEach(function (head) { watch.observe(head); });
        }
    }
}());
</script>
@endpush

@endsection
