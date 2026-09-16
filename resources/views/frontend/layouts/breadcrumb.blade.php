{{--
  ==========================================================================
  Page Banner + Breadcrumb
  Full-bleed photographic band. On wide screens a solid inverse panel with a
  diagonal edge carries the text, cut to echo the escalator rails in the photo.
  Styles: public/css/app.css — section 8

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
    $bcImage   = $image ?? 'assets/images/breadcrumb-commute.webp';
    $bcDefault = !isset($image);
@endphp


<section class="bc {{ empty($title) ? 'bc--compact' : '' }} {{ $bcDefault ? 'bc--default' : '' }}">

    <div class="bc__media">
        <img
            src="{{ asset($bcImage) }}"
            @if($bcDefault)
                srcset="{{ asset('assets/images/breadcrumb-commute-sm.webp') }} 800w, {{ asset('assets/images/breadcrumb-commute.webp') }} 1600w"
                sizes="100vw"
                width="1600" height="600"
            @endif
            alt=""
            fetchpriority="high"
            decoding="async">
        <span class="bc__veil" aria-hidden="true"></span>
    </div>

    <div class="bc__panel">
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
