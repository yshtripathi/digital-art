{{--
  Reusable Breadcrumb Partial (Duolingo Theme)
  
  Usage Example:
  @include('frontend.layouts.breadcrumb', [
      'title' => 'Page Title', // Optional: Displays a large title above breadcrumbs
      'links' => [
          ['name' => 'Home', 'url' => route('home')],
          ['name' => 'Catalog', 'url' => route('product-lists')],
          ['name' => 'Current Page']
      ]
  ])
--}}



<div class="art-breadcrumb-wrapper">
    <div class="art-breadcrumb-container">
        
        @if(isset($title) && !empty($title))
            <h1 class="art-breadcrumb-title">{{ $title }}</h1>
        @endif
        
        @if(isset($links) && count($links) > 0)
            <ul class="art-breadcrumb-list">
                @foreach($links as $index => $link)
                    <li>
                        @if(isset($link['url']) && $index < count($links) - 1)
                            <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                            <i class="fas fa-chevron-right"></i>
                        @else
                            <span class="active">{{ $link['name'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
        
    </div>
</div>
