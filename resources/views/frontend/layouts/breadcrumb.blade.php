@php
    $bnCoins = [
        ['₿', 80, 36, 'lg'],
        ['Ξ', 93, 64, 'md'],
        ['₮', 64, 68, 'md'],
        ['◎', 68, 24, 'sm'],
        ['Ł', 91, 24, 'sm'],
        ['Ð', 55, 36, 'sm'],
        ['₳', 78, 80, 'sm'],
        ['₿', 47, 78, 'xs'],
        ['Ξ', 40, 20, 'xs'],
        ['◎', 55, 88, 'xs'],
    ];
@endphp

<section class="bn {{ empty($title) ? 'bn--compact' : '' }}">
    <div class="bn__box">
        <span class="bn__grid" aria-hidden="true"></span>

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
                                        <span>{{ $link['name'] }}</span>
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
                <span class="bn__bar" aria-hidden="true"></span>
            @endif
        </div>

        <div class="bn__coins" aria-hidden="true">
            @foreach($bnCoins as $coin)
                <span class="bn__coin bn__coin--{{ $coin[3] }}" style="--x: {{ $coin[1] }}%; --y: {{ $coin[2] }}%; --d: {{ $loop->index * -1.3 }}s; --t: {{ 6 + ($loop->index % 4) }}s">{{ $coin[0] }}</span>
            @endforeach
        </div>
    </div>
</section>
