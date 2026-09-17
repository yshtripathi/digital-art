{{--
  ==========================================================================
  Page Banner + Breadcrumb
  Drawn entirely in CSS — no photo, no video. A dot-matrix sheet washed with
  brand light, carrying floating course marks (cap, pencil, book, lesson,
  award, idea) and a level-progress track, with a gradient rule sweeping in
  under the page title.
  Styles: public/css/theme.css — section 16

  Usage:
  @include('frontend.layouts.breadcrumb', [
      'title' => 'Page Title',              // optional: large heading
      'links' => [
          ['name' => 'Home', 'url' => route('home')],
          ['name' => 'Catalog', 'url' => route('product-lists')],
          ['name' => 'Current Page']
      ],
  ])

  Note: any 'image' passed by a caller is ignored — this banner is drawn, not
  photographed.
  ==========================================================================
--}}

<section class="bc {{ empty($title) ? 'bc--compact' : '' }}">

    {{-- Decorative surface --}}
    <span class="bc__canvas" aria-hidden="true">
        <span class="bc__grid"></span>
        <span class="bc__marks">
            <span class="bc__glyph bc__glyph--1"><i class="fas fa-graduation-cap"></i></span>
            <span class="bc__glyph bc__glyph--orchid bc__glyph--2"><i class="fas fa-pencil-alt"></i></span>
            <span class="bc__glyph bc__glyph--bare bc__glyph--3"><i class="fas fa-book-open"></i></span>
            <span class="bc__glyph bc__glyph--4"><i class="fas fa-play"></i></span>
            <span class="bc__glyph bc__glyph--bare bc__glyph--5"><i class="fas fa-award"></i></span>
            <span class="bc__glyph bc__glyph--orchid bc__glyph--6"><i class="fas fa-lightbulb"></i></span>
        </span>
        <span class="bc__track">
            <span></span><span></span><span></span><span></span>
        </span>
    </span>

    <div class="bc__inner">
        <div class="bc__content">
            @if(isset($links) && count($links) > 0)
                <nav aria-label="{{ __('frontend.breadcrumb.label') }}">
                    <ol class="bc__list">
                        @foreach($links as $index => $link)
                            <li class="bc__item">
                                @if(isset($link['url']) && $index < count($links) - 1)
                                    <a href="{{ $link['url'] }}" class="bc__link">{{ $link['name'] }}</a>
                                    <i class="fas fa-chevron-right bc__sep" aria-hidden="true"></i>
                                @else
                                    <span class="bc__current" aria-current="page">{{ $link['name'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif

            @if(!empty($title))
                <h1 class="bc__title">{{ $title }}</h1>
            @endif
        </div>

        <a href="{{ route('product-lists') }}" class="bc__badge">
            <i class="fas fa-graduation-cap" aria-hidden="true"></i>
            {{ __('frontend.breadcrumb.badge') }}
        </a>
    </div>
</section>
