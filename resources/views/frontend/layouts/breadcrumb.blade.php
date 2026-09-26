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
    <div class="bn__box">
        <svg class="bn__chart" viewBox="0 0 480 280" aria-hidden="true" focusable="false">
            <path class="bn__grid" d="M24 60 H468 M24 120 H468 M24 180 H468"/>
            <path class="bn__axis" d="M24 16 V248 H468"/>
            <rect class="bn__bar" x="56" y="190" width="52" height="58" rx="8"/>
            <rect class="bn__bar" x="144" y="150" width="52" height="98" rx="8"/>
            <rect class="bn__bar" x="232" y="112" width="52" height="136" rx="8"/>
            <rect class="bn__bar" x="320" y="70" width="52" height="178" rx="8"/>
            <polyline class="bn__trend" points="32,214 82,168 170,128 258,92 346,50 420,28"/>
            <circle class="bn__ring" cx="420" cy="28" r="12"/>
            <circle class="bn__goal" cx="420" cy="28" r="12"/>
        </svg>

        <div class="bn__inner">
            @if(isset($links) && count($links) > 0)
                <nav class="bn__nav" aria-label="{{ __('frontend.breadcrumb.trail') }}">
                    <ol class="bn__crumbs">
                        @foreach($links as $index => $link)
                            <li class="bn__crumb">
                                @if(isset($link['url']) && $index < count($links) - 1)
                                    <a href="{{ $link['url'] }}" class="bn__link">
                                        @if($index === 0)
                                            <i class="fas fa-home" aria-hidden="true"></i>
                                        @endif
                                        {{ $link['name'] }}
                                    </a>
                                    <i class="fas fa-chevron-right bn__sep" aria-hidden="true"></i>
                                @else
                                    <span class="bn__current" aria-current="page">{{ $link['name'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif

            @if(!empty($title))
                <h1 class="bn__title">{{ $title }}</h1>
            @endif
        </div>
    </div>
</section>
