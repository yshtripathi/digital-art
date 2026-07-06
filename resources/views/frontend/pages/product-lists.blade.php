@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('common.browse_artworks'))
    @section('description', __('common.browse_artworks'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('common.browse_artworks');
@endphp
<x-breadcrumb :title="$bcTitle" :parent="__('common.catalog')" :parent-url="route('product-lists')" />

{{-- ================= PRODUCTS (+ category image on left for slug view) ================= --}}
<section class="pl-section">
    <div class="pl-container">
        <div class="pl-layout {{ $isCat ? 'pl-layout--split' : '' }}">

            @if($isCat)
                {{-- Category image — hover reveals heading + summary over it --}}
                <aside class="pl-catcol">
                    <figure class="pl-catfig">
                        @if($category->photo)
                            <img src="{{ $category->photo }}" alt="{{ $category->title }}">
                        @else
                            <span class="pl-catfig__ph"><i class="fas fa-palette"></i></span>
                        @endif
                        <figcaption class="pl-catfig__overlay">
                            <h1 class="pl-catfig__title">{{ $category->title }}</h1>
                            @if($category->summary)
                                <p class="pl-catfig__summary">{{ $category->summary }}</p>
                            @endif
                        </figcaption>
                    </figure>
                </aside>
            @endif

            {{-- Products, vertical --}}
            <div class="pl-products">
                <div class="pl-head">
                    <h2 class="pl-head__title">{{ $products->count() }} {{ __('common.artworks') }}</h2>
                    <p class="pl-head__sub">{{ __('common.explore_curated_collection') }}</p>
                </div>

                @if($products->count())
                    <div class="pl-grid">
                        @foreach($products as $course)
                            @php $pimg = $course->photo ? explode(',', $course->photo)[0] : null; @endphp
                            <a href="{{ route('product-detail', $course->slug) }}" class="pl-card">
                                <div class="pl-card__img">
                                    @if($pimg)
                                        <img src="{{ url($pimg) }}" alt="{{ $course->title }}" loading="lazy">
                                    @else
                                        <span class="pl-card__ph"><i class="fas fa-palette"></i></span>
                                    @endif
                                </div>
                                <div class="pl-card__body">
                                    <h3 class="pl-card__title">{{ $course->title }}</h3>
                                    <span class="pl-card__link">{{ __('common.explore') }} <i class="fas fa-arrow-right"></i></span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="pl-pagination">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="pl-empty">
                        <i class="fas fa-palette"></i>
                        <p>{{ __('common.explore_curated_collection') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ================= OTHER CATEGORIES — CAROUSEL ================= --}}
<section class="pl-cats">
    <div class="pl-container">
        <div class="pl-head pl-head--center">
            <p class="pl-eyebrow">{{ __('common.explore_more') }}</p>
            <h2 class="pl-head__title">{{ __('common.other_creative_categories') }}</h2>
            <p class="pl-head__sub">{{ __('common.discover_more_art_categories') }}</p>
        </div>
    </div>

    @php
        $allCategories = \App\Models\Category::where('status','active')
            ->where('is_parent',1)
            ->orderBy('title','ASC')
            ->get();
    @endphp

    <div class="pl-carousel">
        <button class="pl-nav pl-nav--prev" type="button" aria-label="Previous"><i class="fas fa-chevron-left"></i></button>
        <div class="pl-track" id="plCatTrack">
            @forelse($allCategories as $cat)
                <a href="{{ route('product-lists', $cat->slug) }}" class="pl-slide">
                    <div class="pl-slide__img">
                        @if($cat->photo)
                            <img src="{{ $cat->photo }}" alt="{{ $cat->title }}" loading="lazy">
                        @else
                            <span class="pl-slide__ph"><i class="fas fa-palette"></i></span>
                        @endif
                    </div>
                    <h4 class="pl-slide__title">{{ $cat->title }}</h4>
                </a>
            @empty
                <p class="pl-empty__text">{{ __('common.no_categories') }}</p>
            @endforelse
        </div>
        <button class="pl-nav pl-nav--next" type="button" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* =========================================================
       PRODUCT LISTS — Structured theme
       ========================================================= */
    .pl-container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
    .pl-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.18em; color: var(--color-graphite, #595855); margin: 0 0 10px 0;
    }

    .pl-section { background-color: var(--color-putty, #c4c3b6); padding: 80px 0; }
    .pl-layout--split { display: grid; grid-template-columns: 0.82fr 1.18fr; gap: 40px; align-items: stretch; }
    .pl-catcol { position: relative; }

    /* Category image with hover overlay (JS makes it follow the scroll) */
    .pl-catfig {
        position: relative; margin: 0; box-sizing: border-box;
        aspect-ratio: 4 / 5; overflow: hidden;
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 14px;
        background-color: var(--color-bone, #e7e5e4);
    }
    .pl-catfig img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1); }
    .pl-catfig:hover img { transform: scale(1.05); }
    .pl-catfig__ph { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: var(--color-graphite, #595855); opacity: 0.4; font-size: 44px; }
    .pl-catfig__overlay {
        position: absolute; inset: 0; z-index: 2;
        display: flex; flex-direction: column; justify-content: flex-end;
        padding: 28px; text-align: left;
        background: rgba(0, 0, 0, 0.55);
        opacity: 0; transition: opacity 0.4s ease;
    }
    .pl-catfig:hover .pl-catfig__overlay { opacity: 1; }
    .pl-catfig__title {
        font-family: var(--font-davinci, serif); font-size: 30px; font-weight: 500; line-height: 1.1;
        color: var(--color-paper, #fff); margin: 0 0 12px 0;
        transform: translateY(10px); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .pl-catfig__summary {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; line-height: 1.6;
        color: rgba(255, 255, 255, 0.85); margin: 0;
        transform: translateY(10px); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) 0.05s;
    }
    .pl-catfig:hover .pl-catfig__title,
    .pl-catfig:hover .pl-catfig__summary { transform: translateY(0); }
    @media (hover: none) {
        .pl-catfig__overlay { opacity: 1; }
        .pl-catfig__title, .pl-catfig__summary { transform: none; }
    }

    /* Products */
    .pl-head { margin-bottom: 32px; }
    .pl-head--center { text-align: center; max-width: 620px; margin-left: auto; margin-right: auto; margin-bottom: 44px; }
    .pl-head__title {
        font-family: var(--font-davinci, serif); font-size: clamp(24px, 3vw, 38px); font-weight: 500;
        line-height: 1.1; letter-spacing: -0.01em; color: var(--color-ink, #000); margin: 0 0 8px 0;
    }
    .pl-head__sub { font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; color: var(--color-graphite, #595855); margin: 0; }

    .pl-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    .pl-layout--split .pl-grid { grid-template-columns: repeat(2, 1fr); }
    .pl-card {
        display: flex; flex-direction: column; text-decoration: none; overflow: hidden;
        background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 12px;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .pl-card:hover { transform: translateY(-6px); }
    .pl-card__img { position: relative; aspect-ratio: 3 / 4; overflow: hidden; background-color: var(--color-bone, #e7e5e4); }
    .pl-card__img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1); }
    .pl-card:hover .pl-card__img img { transform: scale(1.06); }
    .pl-card__ph { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: var(--color-graphite, #595855); opacity: 0.4; font-size: 34px; }
    .pl-card__body { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 18px 20px; }
    .pl-card__title { font-family: var(--font-davinci, serif); font-size: 17px; font-weight: 500; line-height: 1.3; color: var(--color-ink, #000); margin: 0; }
    .pl-card__link { flex-shrink: 0; display: inline-flex; align-items: center; color: var(--color-ink, #000); font-size: 12px; }
    .pl-card__link i { transition: transform 0.3s ease; }
    .pl-card:hover .pl-card__link i { transform: translateX(4px); }

    .pl-empty { text-align: center; padding: 60px 20px; }
    .pl-empty i { font-size: 42px; color: var(--color-graphite, #595855); opacity: 0.35; margin-bottom: 16px; }
    .pl-empty p, .pl-empty__text { font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; color: var(--color-graphite, #595855); margin: 0; }

    /* Pagination */
    .pl-pagination { margin-top: 44px; display: flex; justify-content: center; }
    .pl-pagination nav > p { display: none; }
    .pl-pagination .pagination { display: flex; flex-wrap: wrap; gap: 6px; list-style: none; padding: 0; margin: 0; }
    .pl-pagination a, .pl-pagination span, .pl-pagination .page-link {
        display: inline-flex; align-items: center; justify-content: center; min-width: 40px; height: 40px; padding: 0 12px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; text-decoration: none;
        color: var(--color-ink, #000); background-color: var(--color-paper, #fff);
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 9px; transition: background-color 0.2s ease;
    }
    .pl-pagination a:hover, .pl-pagination .page-link:hover { background-color: var(--color-bone, #e7e5e4); }
    .pl-pagination .active span, .pl-pagination .active .page-link, .pl-pagination [aria-current] span {
        background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000);
    }
    .pl-pagination .disabled span, .pl-pagination [aria-disabled] span { opacity: 0.45; }
    .pl-pagination svg { width: 16px; height: 16px; }

    /* Other categories — carousel */
    .pl-cats { background-color: var(--color-bone, #e7e5e4); padding: 80px 0; }
    .pl-carousel { position: relative; max-width: 1280px; margin: 0 auto; padding: 0 56px; }
    .pl-track {
        display: flex; gap: 20px; overflow-x: auto;
        scroll-snap-type: x mandatory; scroll-behavior: smooth;
        padding: 4px 4px 10px 4px; scrollbar-width: none; -ms-overflow-style: none;
    }
    .pl-track::-webkit-scrollbar { display: none; }
    .pl-slide { flex: 0 0 auto; width: 240px; scroll-snap-align: start; text-decoration: none; }
    .pl-slide__img {
        position: relative; aspect-ratio: 3 / 4; overflow: hidden;
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 12px; background-color: var(--color-putty, #c4c3b6);
    }
    .pl-slide__img img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1); }
    .pl-slide:hover .pl-slide__img img { transform: scale(1.06); }
    .pl-slide__ph { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: var(--color-graphite, #595855); opacity: 0.4; font-size: 30px; }
    .pl-slide__title { font-family: var(--font-davinci, serif); font-size: 16px; font-weight: 500; color: var(--color-ink, #000); text-align: center; margin: 14px 4px 0 4px; }

    .pl-nav {
        position: absolute; top: 42%; transform: translateY(-50%);
        width: 44px; height: 44px; border-radius: 50%;
        background-color: var(--color-paper, #fff); border: 1px solid var(--color-vellum, #dfdcd5);
        color: var(--color-ink, #000); display: flex; align-items: center; justify-content: center;
        font-size: 14px; cursor: pointer; z-index: 3; transition: background-color 0.2s ease;
    }
    .pl-nav:hover { background-color: var(--color-bone, #e7e5e4); }
    .pl-nav--prev { left: 6px; }
    .pl-nav--next { right: 6px; }

    @media (max-width: 992px) {
        .pl-grid, .pl-layout--split .pl-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .pl-container { padding: 0 20px; }
        .pl-section, .pl-cats { padding: 56px 0; }
        .pl-layout--split { grid-template-columns: 1fr; gap: 28px; }
        .pl-catfig { position: static; aspect-ratio: 16 / 10; }
        .pl-carousel { padding: 0 20px; }
        .pl-slide { width: 180px; }
        .pl-nav { display: none; }
    }
    @media (max-width: 560px) {
        .pl-grid, .pl-layout--split .pl-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@push('scripts')
<script>
    // ---- Categories carousel: loops back to the start (auto-play) ----
    (function () {
        var track = document.getElementById('plCatTrack');
        if (!track || !track.querySelector('.pl-slide')) return;
        var prev = document.querySelector('.pl-nav--prev');
        var next = document.querySelector('.pl-nav--next');
        function step() { var s = track.querySelector('.pl-slide'); return s ? s.offsetWidth + 20 : 260; }
        function atEnd() { return track.scrollLeft + track.clientWidth >= track.scrollWidth - 5; }
        function goNext() { if (atEnd()) { track.scrollTo({ left: 0, behavior: 'smooth' }); } else { track.scrollBy({ left: step(), behavior: 'smooth' }); } }
        function goPrev() { if (track.scrollLeft <= 5) { track.scrollTo({ left: track.scrollWidth, behavior: 'smooth' }); } else { track.scrollBy({ left: -step(), behavior: 'smooth' }); } }
        if (next) next.addEventListener('click', goNext);
        if (prev) prev.addEventListener('click', goPrev);
        var timer = setInterval(goNext, 3500);   // infinite auto-advance, restarts from the first
        track.addEventListener('mouseenter', function () { clearInterval(timer); });
        track.addEventListener('mouseleave', function () { clearInterval(timer); timer = setInterval(goNext, 3500); });
    })();

    // ---- Category image: sticky-follow on scroll (CSS sticky is broken by .page-wrapper overflow) ----
    (function () {
        var fig = document.querySelector('.pl-catfig');
        var col = document.querySelector('.pl-catcol');
        if (!fig || !col) return;
        var TOP = 96;
        function reset() { fig.style.position = ''; fig.style.top = ''; fig.style.left = ''; fig.style.width = ''; fig.style.bottom = ''; }
        function update() {
            if (window.innerWidth <= 768) { reset(); return; }
            var rect = col.getBoundingClientRect();
            var figH = fig.offsetHeight;
            if (rect.top > TOP) {
                reset();                                   // above the section — normal flow
            } else if (rect.bottom - figH - TOP <= 0) {
                fig.style.position = 'absolute'; fig.style.top = 'auto'; fig.style.bottom = '0'; fig.style.left = '0'; fig.style.width = '100%';
            } else {
                fig.style.position = 'fixed'; fig.style.top = TOP + 'px'; fig.style.left = rect.left + 'px'; fig.style.width = col.clientWidth + 'px'; fig.style.bottom = 'auto';
            }
        }
        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', update);
        window.addEventListener('load', update);
        update();
    })();
</script>
@endpush
