@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => $page_data->page_title,
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => $page_data->page_title]
    ]
])

<section class="pg">
    <div class="pg__grid" id="pgGrid">

        {{-- Content from the database --}}
        <div class="pg-content">
            <article class="pg-prose" id="pgProse">
                {!! $page_data->page_desc !!}
            </article>

            <a href="#top" class="pg-top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' }); return false;">
                <i class="fas fa-arrow-up" aria-hidden="true"></i> {{ __('frontend.page.to_top') }}
            </a>
        </div>

        {{-- Table of contents (built from the article's h2 headings) + help --}}
        <aside class="pg-side">
            <nav class="pg-toc" id="pgToc" aria-label="{{ __('frontend.page.toc') }}" hidden>
                <div class="pg-toc__head">
                    <p class="pg-toc__title">{{ __('frontend.page.toc') }}</p>
                    <p class="pg-toc__pct"><span id="pgPct">0</span>% {{ __('frontend.page.progress') }}</p>
                </div>
                <div class="pg-toc__bar"><span id="pgBar"></span></div>
                <ol class="pg-toc__list" id="pgTocList"></ol>
            </nav>

            <div class="pg-help">
                <h2 class="pg-help__title">{{ __('frontend.page.help_title') }}</h2>
                <p class="pg-help__msg">{{ __('frontend.page.help_text') }}</p>
                <a href="{{ route('contact') }}" class="pg-help__btn">
                    {{ __('frontend.page.help_btn') }}
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </aside>

    </div>
</section>

@endsection

@push('scripts')
<script>
    (function () {
        var prose = document.getElementById('pgProse');
        var toc = document.getElementById('pgToc');
        var list = document.getElementById('pgTocList');
        var grid = document.getElementById('pgGrid');
        if (!prose) return;

        // Editors save tables with inline colours, widths and legacy attributes
        // baked in. They override the stylesheet and break in dark mode, so the
        // presentational ones are stripped and the theme takes over. Layout
        // hints such as text-align are left alone.
        var DROP_STYLES = [
            'background', 'background-color', 'background-image', 'color',
            'border', 'border-color', 'border-style', 'border-width',
            'font-family', 'font-size', 'width', 'height', 'padding'
        ];
        var DROP_ATTRS = [
            'bgcolor', 'background', 'border', 'cellpadding',
            'cellspacing', 'width', 'height'
        ];

        prose.querySelectorAll('table, table *').forEach(function (el) {
            DROP_STYLES.forEach(function (prop) { el.style.removeProperty(prop); });
            DROP_ATTRS.forEach(function (attr) { el.removeAttribute(attr); });
            if (el.getAttribute('style') === '') el.removeAttribute('style');
        });

        // Wrap tables so wide ones scroll inside the measure
        prose.querySelectorAll('table').forEach(function (table) {
            if (table.parentElement.classList.contains('pg-table')) return;
            var wrap = document.createElement('div');
            wrap.className = 'pg-table';
            table.parentNode.insertBefore(wrap, table);
            wrap.appendChild(table);
        });

        // Build table of contents from h2 headings
        var headings = prose.querySelectorAll('h2');
        if (headings.length < 2) {
            grid.classList.add('pg__grid--no-toc');
            return;
        }

        var used = {};
        headings.forEach(function (h, i) {
            if (!h.id) {
                var base = (h.textContent || 'section').trim().toLowerCase()
                    .replace(/[^\w぀-ヿ一-龯]+/g, '-').replace(/^-+|-+$/g, '') || 'section';
                var id = base, n = 2;
                while (used[id] || document.getElementById(id)) { id = base + '-' + n++; }
                used[id] = true;
                h.id = id;
            }
            var li = document.createElement('li');
            var a = document.createElement('a');
            a.href = '#' + h.id;
            a.className = 'pg-toc__link';
            a.textContent = h.textContent.trim();
            li.appendChild(a);
            list.appendChild(li);
        });
        toc.hidden = false;

        var links = list.querySelectorAll('.pg-toc__link');

        // Highlight the section currently in view
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    links.forEach(function (l) { l.classList.toggle('is-active', l.getAttribute('href') === '#' + entry.target.id); });
                });
            }, { rootMargin: '-120px 0px -65% 0px' });
            headings.forEach(function (h) { observer.observe(h); });
        }

        // Reading progress
        var bar = document.getElementById('pgBar');
        var pct = document.getElementById('pgPct');
        function updateProgress() {
            var rect = prose.getBoundingClientRect();
            var total = rect.height - window.innerHeight * 0.5;
            var done = Math.min(Math.max(-rect.top + window.innerHeight * 0.5, 0), total);
            var value = total > 0 ? Math.round(done / total * 100) : 100;
            bar.style.width = value + '%';
            pct.textContent = value;
        }
        window.addEventListener('scroll', updateProgress, { passive: true });
        window.addEventListener('resize', updateProgress);
        updateProgress();
    })();
</script>
@endpush
