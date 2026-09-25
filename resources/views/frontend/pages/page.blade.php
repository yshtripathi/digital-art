@extends('frontend.layouts.main')

@php
    $pageTitle = $page_data->page_title ?? '';
    $pgEmail   = e($misc['Company Email'] ?? __('frontend.company.email'));
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
    $isCjk = (bool) preg_match('/[\p{Han}\p{Hiragana}\p{Katakana}]/u', $cleanText);
    $wordCount = $isCjk ? mb_strlen(preg_replace('/\s+/u', '', $cleanText)) : str_word_count($cleanText);
    $readMinutes = max(1, (int) ceil($wordCount / ($isCjk ? 500 : 200)));
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
    <div class="pg__wrap">

        <div class="pg__meta">
            <span class="pg__tag">{{ __('frontend.page.tag') }}</span>
            @if($wordCount > 0)
                <span class="pg__time">
                    <i class="far fa-clock" aria-hidden="true"></i>
                    {{ __('frontend.page.read_min', ['min' => $readMinutes]) }}
                </span>
            @endif
            <span class="pg__tools">
                <button type="button" class="pg__tool" onclick="window.print()" aria-label="{{ __('frontend.page.tool_print') }}" title="{{ __('frontend.page.tool_print') }}">
                    <i class="fas fa-print" aria-hidden="true"></i>
                </button>
                <button type="button" class="pg__tool" data-copy-link data-copied="{{ __('frontend.page.tool_copied') }}" aria-label="{{ __('frontend.page.tool_copy') }}" title="{{ __('frontend.page.tool_copy') }}">
                    <i class="fas fa-link" aria-hidden="true"></i>
                </button>
                <span class="pg__copied" role="status" data-copy-note></span>
            </span>
        </div>

        <article class="pg__prose">
            {!! $rawDesc !!}
        </article>

        <div class="pg__help band--coffee">
            <p class="pg__help-text">{{ __('frontend.page.help_title') }}</p>
            <div class="pg__help-actions">
                <a href="{{ route('contact') }}" class="btn btn--primary">{{ __('frontend.footer.link_contact') }}</a>
                <a href="{{ route('product-lists') }}" class="btn btn--ghost">{{ __('frontend.page.help_browse') }}</a>
            </div>
        </div>

    </div>
</section>

@push('scripts')
<script>
(function () {
    'use strict';

    document.querySelectorAll('.pg__prose table').forEach(function (table) {
        if (table.parentElement.classList.contains('pg__table')) { return; }
        var box = document.createElement('div');
        box.className = 'pg__table';
        table.parentNode.insertBefore(box, table);
        box.appendChild(table);
    });

    var copy = document.querySelector('[data-copy-link]');
    var note = document.querySelector('[data-copy-note]');

    if (copy && note) {
        copy.addEventListener('click', function () {
            var done = function () {
                note.textContent = copy.getAttribute('data-copied');
                copy.classList.add('is-done');
                setTimeout(function () {
                    note.textContent = '';
                    copy.classList.remove('is-done');
                }, 2000);
            };

            if (navigator.clipboard) {
                navigator.clipboard.writeText(window.location.href).then(done, done);
            } else {
                done();
            }
        });
    }
}());
</script>
@endpush

@endsection
