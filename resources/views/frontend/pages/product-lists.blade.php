@extends('frontend.layouts.main')

@if(isset($category->title) && $category->title)
    @section('title', $category->title)
    @section('description', $category->summary)
@else
    @section('title', __('inkwave.pl_browse'))
    @section('description', __('inkwave.pl_browse'))
@endif

@section('main-content')
@php
    $isCat = isset($category->title) && $category->title;
    $bcTitle = $isCat ? $category->title : __('inkwave.pl_browse');
@endphp
<x-breadcrumb :title="$bcTitle" :parent="__('inkwave.pl_catalog')" :parent-url="route('product-lists')" />

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
                    <h2 class="pl-head__title">{{ $products->count() }} {{ __('inkwave.pl_artworks') }}</h2>
                    <p class="pl-head__sub">{{ __('inkwave.pl_explore_curated') }}</p>
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
                                    <span class="pl-card__link">{{ __('inkwave.pl_explore') }} <i class="fas fa-arrow-right"></i></span>
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
                        <p>{{ __('inkwave.pl_explore_curated') }}</p>
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
            <p class="pl-eyebrow">{{ __('inkwave.pl_explore_more') }}</p>
            <h2 class="pl-head__title">{{ __('inkwave.pl_other_cats') }}</h2>
            <p class="pl-head__sub">{{ __('inkwave.pl_discover_more') }}</p>
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
                <p class="pl-empty__text">{{ __('inkwave.pl_no_cats') }}</p>
            @endforelse
        </div>
        <button class="pl-nav pl-nav--next" type="button" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
    </div>
</section>

@endsection



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
