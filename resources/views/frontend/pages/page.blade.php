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

    $readMin   = app()->getLocale() === 'ja'
        ? max(1, (int) ceil(mb_strlen($cleanText) / 500))
        : max(1, (int) ceil(str_word_count($cleanText) / 200));
    $sectionCount = preg_match_all('/<h2[\s>]/i', $rawDesc);
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
    <div class="pg__doc">
        <div class="pg__tools">
            <ul class="pg__meta">
                <li><i class="far fa-clock" aria-hidden="true"></i> {{ __('frontend.page.read', ['min' => $readMin]) }}</li>
                @if($sectionCount)
                    <li><i class="fas fa-layer-group" aria-hidden="true"></i> {{ trans_choice('frontend.page.sections', $sectionCount, ['count' => $sectionCount]) }}</li>
                @endif
            </ul>

            <div class="pg__acts">
                <button type="button" class="pg__act" data-pg-copy data-done="{{ __('frontend.page.copied') }}">
                    <i class="far fa-copy" aria-hidden="true"></i>
                    <span data-pg-label>{{ __('frontend.page.copy') }}</span>
                </button>
                <button type="button" class="pg__act pg__act--main" data-pg-print>
                    <i class="fas fa-print" aria-hidden="true"></i>
                    <span>{{ __('frontend.page.print') }}</span>
                </button>
            </div>

            <span class="pg__progress" aria-hidden="true" data-progress></span>
        </div>

        <h2 class="pg__print-title">{{ $pageTitle }}</h2>

        <article class="pg__prose" data-prose>
            {!! $rawDesc !!}
        </article>
    </div>
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

    var bar = document.querySelector('[data-progress]');
    var tools = document.querySelector('.pg__tools');
    var head = document.querySelector('[data-hd]');

    function dock() {
        if (!tools) { return; }
        var edge = head ? Math.max(head.getBoundingClientRect().bottom, 0) : 0;
        tools.style.top = Math.round(edge) + 'px';
    }

    window.addEventListener('scroll', dock, { passive: true });
    window.addEventListener('resize', dock);
    dock();

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

    var copy = document.querySelector('[data-pg-copy]');
    if (copy) {
        var label = copy.querySelector('[data-pg-label]');
        var original = label.textContent;

        var done = function () {
            copy.classList.add('is-done');
            label.textContent = copy.dataset.done;
            setTimeout(function () {
                copy.classList.remove('is-done');
                label.textContent = original;
            }, 2000);
        };

        copy.addEventListener('click', function () {
            var text = prose.innerText.replace(/\n{3,}/g, '\n\n').trim();

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(done);
                return;
            }

            var area = document.createElement('textarea');
            area.value = text;
            area.setAttribute('readonly', '');
            area.style.position = 'fixed';
            area.style.opacity = '0';
            document.body.appendChild(area);
            area.select();
            document.execCommand('copy');
            document.body.removeChild(area);
            done();
        });
    }

    var print = document.querySelector('[data-pg-print]');
    if (print) {
        print.addEventListener('click', function () { window.print(); });
    }
}());
</script>
@endpush

@endsection
