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

<style>
/* -------------------------------------------
   Duolingo Theme Breadcrumbs - Artora
------------------------------------------- */
.art-breadcrumb-wrapper {
    background-color: var(--color-paper-white, #ffffff);
    padding: 40px 24px;
    border-bottom: 2px solid #e5e5e5;
    margin-top: 20px; /* Assumes body padding-top handles header */
}

.art-breadcrumb-container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.art-breadcrumb-title {
    font-size: 48px;
    font-weight: 700;
    color: var(--color-eager-green, #58cc02);
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    margin: 0;
    letter-spacing: -0.02em;
    line-height: 1.2;
}

.art-breadcrumb-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.art-breadcrumb-list li {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 15px;
    font-weight: 700;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    color: var(--color-pencil-gray, #777777);
    text-transform: uppercase;
    letter-spacing: 0.053em;
}

.art-breadcrumb-list li a {
    color: var(--color-spark-blue, #1cb0f6);
    text-decoration: none;
    padding: 4px 12px;
    border: 2px solid transparent;
    border-radius: 12px;
    transition: all 0.1s ease;
    margin-left: -12px; /* Pull left to balance padding */
}

.art-breadcrumb-list li a:hover {
    background: #f7f7f7;
    border-color: #e5e5e5;
    color: var(--color-spark-blue, #1cb0f6);
}

.art-breadcrumb-list li a:active {
    background: #e5e5e5;
}

.art-breadcrumb-list li i {
    font-size: 12px;
    color: #e5e5e5;
    font-weight: 900;
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .art-breadcrumb-title {
        font-size: 32px;
    }
    .art-breadcrumb-wrapper {
        padding: 24px 16px;
    }
}
</style>

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
                            <span class="active" style="color: var(--color-charcoal, #4b4b4b);">{{ $link['name'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
        
    </div>
</div>
