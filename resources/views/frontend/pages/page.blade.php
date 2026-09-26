@extends('frontend.layouts.main')

@php
    $pageTitle = $page_data->page_title ?? '';
    $pageSlug  = $page_data->page_slug ?? '';
    $pgEmail   = e(trim($misc['Company Email'] ?? __('frontend.company.email')));
    $rawDesc   = strtr($page_data->page_desc ?? '', [
        ':company'      => e($misc['Company Name'] ?? __('frontend.company.name')),
        ':email'        => '<a href="mailto:' . $pgEmail . '">' . $pgEmail . '</a>',
        ':address'      => e($misc['Company Address'] ?? __('frontend.company.address')),
        ':delivery_url' => route('pages', 'delivery-policy'),
        ':refund_url'   => route('pages', 'refund-policy'),
        'src="/assets/' => 'src="' . asset('assets') . '/',
    ]);
    $cleanText = trim(preg_replace('/\s+/', ' ', strip_tags($rawDesc)));
    $metaDesc  = !empty($page_data->page_meta) ? $page_data->page_meta : \Illuminate\Support\Str::limit($cleanText, 160);

    $policies = [
        'terms-conditions' => ['label' => __('frontend.footer.link_terms'),   'icon' => 'fa-file-contract'],
        'privacy-policy'   => ['label' => __('frontend.footer.link_privacy'), 'icon' => 'fa-user-shield'],
        'refund-policy'    => ['label' => __('frontend.footer.link_refund'),  'icon' => 'fa-undo-alt'],
        'delivery-policy'  => ['label' => __('frontend.footer.link_access'),  'icon' => 'fa-key'],
    ];
    $related = array_filter($policies, fn ($key) => $key !== $pageSlug, ARRAY_FILTER_USE_KEY);
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

<section class="pg">
    <div class="pg__wrap" data-pg>
        <aside class="pg__side" data-toc-box hidden>
            <nav class="pg__toc" aria-labelledby="pgTocTitle">
                <p class="pg__toc-title" id="pgTocTitle">{{ __('frontend.page.toc') }}</p>
                <ol class="pg__toc-list" data-toc></ol>
            </nav>
        </aside>

        <article class="pg__prose" data-prose>
            {!! $rawDesc !!}
        </article>
    </div>

    @if(count($related))
        <nav class="pg-rel" aria-labelledby="pgRelTitle">
            <h2 class="pg-rel__title" id="pgRelTitle">{{ __('frontend.page.related') }}</h2>
            <ul class="pg-rel__list">
                @foreach($related as $slug => $item)
                    <li>
                        <a href="{{ route('pages', $slug) }}" class="pg-rel__card">
                            <span class="pg-rel__icon" aria-hidden="true"><i class="fas {{ $item['icon'] }}"></i></span>
                            <span class="pg-rel__name">{{ $item['label'] }}</span>
                            <span class="pg-rel__go">
                                {{ __('frontend.page.open') }}
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    @endif
</section>

@push('scripts')
<script>
(function () {
    'use strict';

    var prose = document.querySelector('[data-prose]');
    if (!prose) { return; }

    prose.querySelectorAll('table').forEach(function (table) {
        if (table.parentElement.classList.contains('pg__table')) { return; }
        var box = document.createElement('div');
        box.className = 'pg__table';
        table.parentNode.insertBefore(box, table);
        box.appendChild(table);
    });

    var heads = Array.prototype.slice.call(prose.querySelectorAll('h2'));
    var list = document.querySelector('[data-toc]');
    var box = document.querySelector('[data-toc-box]');
    var wrap = document.querySelector('[data-pg]');

    if (heads.length < 2 || !list || !box) { return; }

    var links = heads.map(function (head, index) {
        if (!head.id) { head.id = 'section-' + (index + 1); }
        var item = document.createElement('li');
        var link = document.createElement('a');
        link.href = '#' + head.id;
        link.textContent = head.textContent.trim();
        item.appendChild(link);
        list.appendChild(item);
        return link;
    });

    box.hidden = false;
    wrap.classList.add('has-toc');

    if ('IntersectionObserver' in window) {
        var seen = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) { return; }
                var at = heads.indexOf(entry.target);
                links.forEach(function (link, i) { link.classList.toggle('is-active', i === at); });
            });
        }, { rootMargin: '-110px 0px -65% 0px' });
        heads.forEach(function (head) { seen.observe(head); });
    }
}());
</script>
@endpush

@endsection
