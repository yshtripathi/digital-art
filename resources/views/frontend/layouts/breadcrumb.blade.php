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
    <span class="bn__media" aria-hidden="true"></span>

    <span class="bn__fx" aria-hidden="true">
        <span class="bn-shoot bn-shoot--1"></span>
        <span class="bn-shoot bn-shoot--2"></span>
        <span class="bn-shoot bn-shoot--3"></span>
        <span class="bn-shoot bn-shoot--4"></span>

        <span class="bn-spark bn-spark--1"><i class="fas fa-star"></i></span>
        <span class="bn-spark bn-spark--2"><i class="fas fa-star"></i></span>
        <span class="bn-spark bn-spark--3"><i class="fas fa-star"></i></span>

        <span class="bn-icon bn-icon--1"><i class="fas fa-heart"></i></span>
        <span class="bn-icon bn-icon--2 bn-icon--fill"><i class="fab fa-instagram"></i></span>
        <span class="bn-icon bn-icon--3"><i class="fas fa-play"></i></span>
        <span class="bn-icon bn-icon--4"><i class="fab fa-tiktok"></i></span>
        <span class="bn-icon bn-icon--5 bn-icon--fill"><i class="fas fa-thumbs-up"></i></span>
        <span class="bn-icon bn-icon--6"><i class="fas fa-comment-dots"></i></span>
        <span class="bn-icon bn-icon--7"><i class="fab fa-youtube"></i></span>
        <span class="bn-icon bn-icon--8 bn-icon--fill"><i class="fas fa-camera-retro"></i></span>
    </span>

    <div class="bn__inner">
        <div class="bn__panel">
            @if(isset($links) && count($links) > 0)
                <nav aria-label="{{ __('frontend.breadcrumb.label') }}">
                    <ol class="bn__crumbs">
                        @foreach($links as $index => $link)
                            <li class="bn__crumb">
                                @if(isset($link['url']) && $index < count($links) - 1)
                                    @if($index === 0)
                                        <i class="fas fa-home bn__home" aria-hidden="true"></i>
                                    @endif
                                    <a href="{{ $link['url'] }}" class="bn__link">{{ $link['name'] }}</a>
                                    <i class="fas fa-chevron-right bn__sep" aria-hidden="true"></i>
                                @else
                                    <span class="bn__current" aria-current="page">{{ $link['name'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif

            <p class="bn__eyebrow">
                <span class="bn__eyebrow-icon" aria-hidden="true"><i class="fas fa-magic"></i></span>
                {{ __('frontend.breadcrumb.tag') }}
            </p>

            @if(!empty($title))
                <h1 class="bn__title"><span class="bn__mark">{{ $title }}</span></h1>
            @endif
        </div>
    </div>
</section>
