@extends('frontend.layouts.main')

@php
    $pageTitle = $page_data->page_title ?? '';
    $rawDesc   = $page_data->page_desc ?? '';
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
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => $pageTitle]
    ]
])

{{-- ==========================================================================
     Static Content Page
     Renders raw CMS HTML within an editorial reading sheet designed around
     variables.css design tokens. Supports floated images, rich headings,
     definition lists, code blocks, callouts, and responsive data tables.
     Styles: public/css/variables.css — Section 17
     ========================================================================== --}}
<section class="pg">
    <div class="pg__wrap">
        <div class="pg-sheet">

            {{-- Editorial Meta & Quick Actions Bar --}}
            <header class="pg-header">
                <div class="pg-meta">
                    <span class="pg-meta__item">
                        <i class="fas fa-file-alt" aria-hidden="true"></i>
                        <span>{{ __('frontend.page.doc_label') }}</span>
                    </span>
                    @if($wordCount > 0)
                        <span class="pg-meta__item">
                            <i class="far fa-clock" aria-hidden="true"></i>
                            <span>{{ __('frontend.page.read_time', ['min' => $readMinutes]) }}</span>
                        </span>
                    @endif
                </div>

                <div class="pg-tools">
                    <button type="button" class="pg-tool-btn" onclick="window.print()" title="{{ __('frontend.page.print') }}">
                        <i class="fas fa-print" aria-hidden="true"></i>
                        <span>{{ __('frontend.page.print') }}</span>
                    </button>
                    <button type="button" class="pg-tool-btn js-copy-page-link" data-copied="{{ __('frontend.page.link_copied') }}" title="{{ __('frontend.page.copy_link') }}">
                        <i class="fas fa-link" aria-hidden="true"></i>
                        <span class="js-copy-label">{{ __('frontend.page.copy_link') }}</span>
                    </button>
                </div>
            </header>

            {{-- Rich HTML Prose Article --}}
            <article class="pg-prose">
                {!! $rawDesc !!}
            </article>

            {{-- Reading Footer & Navigation --}}
            <footer class="pg-footer">
                <div class="pg-footer__links">
                    <a href="{{ route('home') }}" class="pg-footer__btn">
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        <span>{{ __('frontend.page.back_home') }}</span>
                    </a>
                    <a href="{{ route('product-lists') }}" class="pg-footer__btn pg-footer__btn--primary">
                        <i class="fas fa-th-large" aria-hidden="true"></i>
                        <span>{{ __('frontend.page.browse') }}</span>
                    </a>
                </div>

                <div class="pg-footer__links">
                    <a href="{{ route('contact') }}" class="pg-footer__btn">
                        <i class="far fa-comment-dots" aria-hidden="true"></i>
                        <span>{{ __('frontend.page.need_help') }}</span>
                    </a>
                    <a href="#" class="pg-footer__btn js-scroll-top">
                        <i class="fas fa-arrow-up" aria-hidden="true"></i>
                        <span>{{ __('frontend.page.back_to_top') }}</span>
                    </a>
                </div>
            </footer>

        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Copy link helper
    var copyBtn = document.querySelector('.js-copy-page-link');
    if (copyBtn) {
        copyBtn.addEventListener('click', function () {
            var label = copyBtn.querySelector('.js-copy-label');
            var origText = label ? label.textContent : '';
            var copiedText = copyBtn.getAttribute('data-copied');

            navigator.clipboard.writeText(window.location.href).then(function () {
                if (label) label.textContent = copiedText;
                setTimeout(function () {
                    if (label) label.textContent = origText;
                }, 2000);
            }).catch(function () {
                // Fallback
                if (label) label.textContent = copiedText;
                setTimeout(function () {
                    if (label) label.textContent = origText;
                }, 2000);
            });
        });
    }

    // Scroll to top button inside footer
    var topBtn = document.querySelector('.js-scroll-top');
    if (topBtn) {
        topBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
</script>
@endpush

@endsection
