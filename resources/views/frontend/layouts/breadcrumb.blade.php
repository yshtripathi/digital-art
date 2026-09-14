{{--
  ==========================================================================
  [Website Name] — Page Banner + Breadcrumb
  Cobalt color-block panel with a contained photo on the right (see DESIGN.md).
  Styles: public/css/main.css

  Usage:
  @include('frontend.layouts.breadcrumb', [
      'title' => 'Page Title',              // optional: large heading
      'links' => [
          ['name' => 'Home', 'url' => route('home')],
          ['name' => 'Catalog', 'url' => route('product-lists')],
          ['name' => 'Current Page']
      ],
      'image' => 'assets/images/other.webp', // optional: replaces the default photo
  ])
  ==========================================================================
--}}
@php
    $bcImage   = $image ?? 'assets/images/breadcrumb.webp';
    $bcDefault = !isset($image);
@endphp


<section class="bc {{ empty($title) ? 'bc--compact' : '' }}">
    <div class="bc__panel">
        <div class="bc__content">
            @if(isset($links) && count($links) > 0)
                <nav aria-label="Breadcrumb">
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

        <div class="bc__media">
            <img
                src="{{ asset($bcImage) }}"
                @if($bcDefault)
                    srcset="{{ asset('assets/images/breadcrumb-sm.webp') }} 800w, {{ asset('assets/images/breadcrumb.webp') }} 1600w"
                    sizes="(max-width: 991px) 100vw, 45vw"
                    width="1600" height="600"
                @endif
                alt=""
                fetchpriority="high"
                decoding="async">
            <a href="{{ route('product-lists') }}" class="bc__badge"><i class="fas fa-graduation-cap" aria-hidden="true"></i> {{ __('managenovax.header.courses') }}</a>
        </div>
    </div>
</section>
