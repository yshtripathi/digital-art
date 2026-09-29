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
    $pgSlug    = request()->route('slug');

    $pgPolicies = [
        ['slug' => 'terms-conditions', 'label' => __('frontend.footer.terms'),   'icon' => 'fa-file-contract'],
        ['slug' => 'privacy-policy',   'label' => __('frontend.footer.privacy'), 'icon' => 'fa-user-shield'],
        ['slug' => 'refund-policy',    'label' => __('frontend.footer.refund'),  'icon' => 'fa-undo-alt'],
        ['slug' => 'delivery-policy',  'label' => __('frontend.footer.delivery'),  'icon' => 'fa-envelope-open-text'],
    ];
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

<section class="policy" data-policy>
    <aside class="policy__side">
        <details class="toc" data-toc hidden>
            <summary class="toc__head">
                <span><i class="fas fa-stream" aria-hidden="true"></i>{{ __('frontend.page.contents') }}</span>
                <i class="fas fa-chevron-down toc__caret" aria-hidden="true"></i>
            </summary>
            <ol class="toc__list" data-toc-list></ol>
        </details>

        <div class="policy__box">
            <p class="policy__label" id="pg-size">{{ __('frontend.page.text_size') }}</p>
            <div class="sizer" role="group" aria-labelledby="pg-size">
                <button type="button" class="sizer__btn" data-size="-1" aria-label="{{ __('frontend.page.text_smaller') }}">A<sup>−</sup></button>
                <span class="sizer__dots" aria-hidden="true"><span></span><span></span><span></span></span>
                <button type="button" class="sizer__btn sizer__btn--lg" data-size="1" aria-label="{{ __('frontend.page.text_larger') }}">A<sup>+</sup></button>
            </div>
        </div>

        <nav class="policy__box" aria-labelledby="pg-others">
            <p class="policy__label" id="pg-others">{{ __('frontend.page.more') }}</p>
            <ul class="docs">
                @foreach($pgPolicies as $doc)
                    <li>
                        <a href="{{ route('pages', $doc['slug']) }}" class="docs__link {{ $pgSlug === $doc['slug'] ? 'is-current' : '' }}" @if($pgSlug === $doc['slug']) aria-current="page" @endif>
                            <span class="docs__icon" aria-hidden="true"><i class="fas {{ $doc['icon'] }}"></i></span>
                            <span>{{ $doc['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="policy__help">
            <p class="policy__help-title">{{ __('frontend.page.help_title') }}</p>
            <p class="policy__help-text">{{ __('frontend.page.help_line') }}</p>
            <a href="mailto:{{ $pgEmail }}" class="policy__help-mail"><i class="far fa-envelope" aria-hidden="true"></i>{!! $pgEmail !!}</a>
        </div>
    </aside>

    <article class="doc" data-doc>
        {!! $rawDesc !!}
    </article>
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

    var heads = Array.prototype.slice.call(doc.querySelectorAll('h2'));
    var toc = document.querySelector('[data-toc]');
    var list = document.querySelector('[data-toc-list]');
    var links = [];

    heads.forEach(function (head, index) {
        var text = head.textContent.trim();
        var match = text.match(/^(\d+)[.)]?\s+(.*)$/);
        var number = match ? match[1] : String(index + 1);
        var label = match ? match[2] : text;

        head.id = head.id || 'section-' + (index + 1);
        head.textContent = '';
        var tag = document.createElement('span');
        tag.className = 'doc__no';
        tag.textContent = number.length < 2 ? '0' + number : number;
        tag.setAttribute('aria-hidden', 'true');
        head.appendChild(tag);
        head.appendChild(document.createTextNode(label));

        if (list) {
            var item = document.createElement('li');
            var link = document.createElement('a');
            link.href = '#' + head.id;
            link.className = 'toc__link';
            link.innerHTML = '<span class="toc__no"></span><span class="toc__text"></span>';
            link.querySelector('.toc__no').textContent = tag.textContent;
            link.querySelector('.toc__text').textContent = label;
            item.appendChild(link);
            list.appendChild(item);
            links.push(link);
        }
    });

    if (toc && links.length) {
        toc.hidden = false;
        toc.open = window.matchMedia('(min-width: 1025px)').matches;

        links.forEach(function (link) {
            link.addEventListener('click', function () {
                if (!window.matchMedia('(min-width: 1025px)').matches) { toc.open = false; }
            });
        });

        var spy = function () {
            var active = null;
            heads.forEach(function (head) {
                if (head.getBoundingClientRect().top < window.innerHeight * 0.35) { active = head; }
            });
            links.forEach(function (link) {
                var on = !!active && link.getAttribute('href') === '#' + active.id;
                link.classList.toggle('is-active', on);
                if (on) { link.setAttribute('aria-current', 'location'); } else { link.removeAttribute('aria-current'); }
            });
        };
        window.addEventListener('scroll', spy, { passive: true });
        spy();
    }

    var sizes = ['is-sm', '', 'is-lg'];
    var step = 1;
    try {
        var saved = parseInt(localStorage.getItem('policy-size'), 10);
        if (saved >= 0 && saved <= 2) { step = saved; }
    } catch (error) {}

    var dots = document.querySelectorAll('.sizer__dots span');
    var buttons = document.querySelectorAll('[data-size]');

    function applySize() {
        doc.classList.remove('is-sm', 'is-lg');
        if (sizes[step]) { doc.classList.add(sizes[step]); }
        dots.forEach(function (dot, i) { dot.classList.toggle('is-on', i <= step); });
        buttons.forEach(function (btn) {
            var dir = parseInt(btn.dataset.size, 10);
            btn.disabled = (dir < 0 && step === 0) || (dir > 0 && step === 2);
        });
        try { localStorage.setItem('policy-size', String(step)); } catch (error) {}
    }

    buttons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            step = Math.min(2, Math.max(0, step + parseInt(btn.dataset.size, 10)));
            applySize();
        });
    });
    applySize();
}());
</script>
@endpush

@endsection
