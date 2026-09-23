{{--
  @include('frontend.layouts.breadcrumb', [
      'title' => 'Page Title',
      'links' => [
          ['name' => 'Home', 'url' => route('home')],
          ['name' => 'Catalog', 'url' => route('product-lists')],
          ['name' => 'Current Page'],
      ],
  ])
--}}

<section class="banner {{ empty($title) ? 'banner--compact' : '' }}">
    <span class="banner__media" aria-hidden="true"></span>

    <div class="banner__inner">
        <div class="banner__panel">

            @if(isset($links) && count($links) > 0)
                <nav aria-label="{{ __('frontend.breadcrumb.label') }}">
                    <ol class="banner__crumbs">
                        @foreach($links as $index => $link)
                            <li class="banner__crumb">
                                @if(isset($link['url']) && $index < count($links) - 1)
                                    <a href="{{ $link['url'] }}" class="banner__link">{{ $link['name'] }}</a>
                                    <i class="fas fa-chevron-right banner__sep" aria-hidden="true"></i>
                                @else
                                    <span class="banner__current" aria-current="page">{{ $link['name'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif

            <p class="banner__eyebrow">
                <span class="banner__dot" aria-hidden="true"></span>
                {{ __('frontend.breadcrumb.eyebrow') }}
            </p>

            @if(!empty($title))
                <h1 class="banner__title">{{ $title }}</h1>
            @endif
        </div>
    </div>
</section>
