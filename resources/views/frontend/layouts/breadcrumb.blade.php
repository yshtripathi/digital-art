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

<section class="bn {{ empty($title) ? 'bn--compact' : '' }}">
    <div class="bn__art" aria-hidden="true">
        <svg viewBox="0 0 400 400" focusable="false">
            <g class="bn__spin">
                <circle class="bn__dash" cx="200" cy="200" r="192"/>
                <circle class="bn__draw" cx="200" cy="200" r="160" pathLength="1"/>
                <g class="bn__dots">
                    @foreach (range(0, 350, 10) as $angle)
                        <circle cx="200" cy="24" r="2.4" transform="rotate({{ $angle }} 200 200)"/>
                    @endforeach
                </g>
                <g class="bn__petals">
                    @foreach (range(0, 345, 15) as $angle)
                        <ellipse class="bn__draw" cx="200" cy="72" rx="13" ry="34" pathLength="1" transform="rotate({{ $angle }} 200 200)"/>
                    @endforeach
                </g>
                <g class="bn__flames">
                    @foreach (range(0, 330, 30) as $angle)
                        <path class="bn__draw" d="M200 104 Q224 140 200 166 Q176 140 200 104 Z" pathLength="1" transform="rotate({{ $angle }} 200 200)"/>
                    @endforeach
                </g>
                <circle class="bn__draw" cx="200" cy="200" r="30" pathLength="1"/>
                <circle class="bn__sun" cx="200" cy="200" r="14"/>
            </g>
        </svg>
    </div>

    <div class="bn__inner">
        @if(isset($links) && count($links) > 0)
            <nav class="bn__nav" aria-label="{{ __('frontend.breadcrumb.trail') }}">
                <ol class="bn__crumbs">
                    @foreach($links as $index => $link)
                        <li class="bn__crumb">
                            @if(isset($link['url']) && $index < count($links) - 1)
                                <a href="{{ $link['url'] }}" class="bn__link">{{ $link['name'] }}</a>
                                <span class="bn__sep" aria-hidden="true"></span>
                            @else
                                <span class="bn__current" aria-current="page">{{ $link['name'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        @if(!empty($title))
            <h1 class="bn__title">
                <span class="bn__bloom" aria-hidden="true"></span><span>{{ $title }}</span>
            </h1>
        @endif
    </div>
</section>
