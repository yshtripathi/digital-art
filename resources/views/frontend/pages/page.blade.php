@extends('frontend.layouts.main')

@php
    $pageTitle = $page_data->page_title ?? '';
    $pageSlug  = $page_data->page_slug ?? '';
    $pgEmail   = e(filled($misc['Company Email'] ?? null) ? trim($misc['Company Email']) : __('frontend.company.email'));
    $rawDesc   = strtr($page_data->page_desc ?? '', [
        ':company'      => e(filled($misc['Company Name'] ?? null) ? $misc['Company Name'] : __('frontend.company.name')),
        ':email'        => '<a href="mailto:' . $pgEmail . '">' . $pgEmail . '</a>',
        ':address'      => e(filled($misc['Company Address'] ?? null) ? $misc['Company Address'] : __('frontend.company.address')),
        ':delivery_url' => route('pages', 'delivery-policy'),
        ':refund_url'   => route('pages', 'refund-policy'),
        'src="/assets/' => 'src="' . asset('assets') . '/',
    ]);
    $cleanText = trim(preg_replace('/\s+/', ' ', strip_tags($rawDesc)));
    $metaDesc  = !empty($page_data->page_meta) && app()->getLocale() !== 'ja' ? $page_data->page_meta : \Illuminate\Support\Str::limit($cleanText, 160);

    $readMin   = app()->getLocale() === 'ja'
        ? max(1, (int) ceil(mb_strlen($cleanText) / 500))
        : max(1, (int) ceil(str_word_count($cleanText) / 200));
    $sectionCount = preg_match_all('/<h2[\s>]/i', $rawDesc);

    $pgPolicies = [
        'terms-conditions' => ['fa-file-contract', 'frontend.footer.link_terms'],
        'privacy-policy'   => ['fa-user-shield', 'frontend.footer.link_privacy'],
        'refund-policy'    => ['fa-undo-alt', 'frontend.footer.link_refund'],
        'delivery-policy'  => ['fa-paper-plane', 'frontend.footer.link_access'],
    ];
    $pgRelated = array_filter($pgPolicies, fn ($item, $slug) => $slug !== $pageSlug, ARRAY_FILTER_USE_BOTH);
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
    <ul class="pg__meta">
        <li><i class="fas fa-clock" aria-hidden="true"></i> {{ __('frontend.page.read', ['min' => $readMin]) }}</li>
        @if($sectionCount)
            <li><i class="fas fa-layer-group" aria-hidden="true"></i> {{ trans_choice('frontend.page.sections', $sectionCount, ['count' => $sectionCount]) }}</li>
        @endif
    </ul>

    <nav class="pg__bar" aria-labelledby="pgTocTitle" data-toc-box hidden>
        <div class="pg__bar-in">
            <p class="pg__bar-title" id="pgTocTitle">
                <i class="fas fa-list-ul" aria-hidden="true"></i>
                <span>{{ __('frontend.page.toc') }}</span>
            </p>
            <ol class="pg__chips" data-toc></ol>
        </div>
        <span class="pg__progress" aria-hidden="true" data-progress></span>
    </nav>

    <article class="pg__prose" data-prose>
        {!! $rawDesc !!}
    </article>

    @if(count($pgRelated))
        <aside class="pg__more" aria-labelledby="pgMoreTitle">
            <h2 class="pg__more-title" id="pgMoreTitle">{{ __('frontend.page.more') }}</h2>
            <ul class="pg__cards">
                @foreach($pgRelated as $slug => $item)
                    <li>
                        <a href="{{ route('pages', $slug) }}" class="pg__card">
                            <span class="pg__card-icon" aria-hidden="true"><i class="fas {{ $item[0] }}"></i></span>
                            <span class="pg__card-name">{{ __($item[1]) }}</span>
                            <i class="fas fa-arrow-right pg__card-go" aria-hidden="true"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>
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
    var bar = document.querySelector('[data-progress]');

    function progress() {
        if (!bar) { return; }
        var rect = prose.getBoundingClientRect();
        var room = rect.height - window.innerHeight * 0.5;
        var done = room > 0 ? Math.min(Math.max(-rect.top + 140, 0) / room, 1) : 1;
        bar.style.transform = 'scaleX(' + done.toFixed(3) + ')';
    }

    window.addEventListener('scroll', progress, { passive: true });
    window.addEventListener('resize', progress);
    progress();

    if (heads.length < 2 || !list || !box) { return; }

    var links = heads.map(function (head, index) {
        if (!head.id) { head.id = 'section-' + (index + 1); }
        var item = document.createElement('li');
        var link = document.createElement('a');
        link.href = '#' + head.id;
        link.className = 'pg__chip';
        link.textContent = head.textContent.trim();
        item.appendChild(link);
        list.appendChild(item);
        return link;
    });

    box.hidden = false;

    function mark(at) {
        links.forEach(function (link, i) {
            var on = i === at;
            link.classList.toggle('is-active', on);
            if (on) {
                list.scrollTo({ left: link.offsetLeft - list.offsetLeft - 16, behavior: 'smooth' });
            }
        });
    }

    if ('IntersectionObserver' in window) {
        var seen = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) { return; }
                mark(heads.indexOf(entry.target));
            });
        }, { rootMargin: '-160px 0px -60% 0px' });
        heads.forEach(function (head) { seen.observe(head); });
    }
}());
</script>
@endpush

@endsection
