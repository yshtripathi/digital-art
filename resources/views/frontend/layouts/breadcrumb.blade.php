@php
    $bnCandles = [
        [240, 215, 205, 250], [215, 225, 208, 235], [225, 190, 182, 232], [190, 175, 165, 200],
        [175, 195, 168, 205], [195, 160, 150, 200], [160, 140, 128, 168], [140, 155, 132, 165],
        [155, 115, 105, 160], [115, 100, 88, 125], [100, 118, 92, 126], [118, 75, 62, 122],
    ];
    $bnLine = collect($bnCandles)->map(fn ($c, $i) => (30 + $i * 44) . ',' . $c[1])->implode(' ');
@endphp

<section class="bn {{ empty($title) ? 'bn--compact' : '' }}">
    <div class="bn__bg" aria-hidden="true">
        <span class="bn__glow"></span>
        <span class="bn__dots"></span>
        <svg class="bn__chart" viewBox="0 0 560 300" focusable="false">
            <path class="bn__grid" d="M0 70 H560 M0 140 H560 M0 210 H560"/>
            @foreach($bnCandles as $i => $c)
                <g class="bn__candle {{ $c[1] < $c[0] ? 'is-up' : 'is-down' }}" style="--i: {{ $i }}">
                    <line x1="{{ 30 + $i * 44 }}" y1="{{ $c[2] }}" x2="{{ 30 + $i * 44 }}" y2="{{ $c[3] }}"/>
                    <rect x="{{ 20 + $i * 44 }}" y="{{ min($c[0], $c[1]) }}" width="20" height="{{ abs($c[0] - $c[1]) }}" rx="3"/>
                </g>
            @endforeach
            <polyline class="bn__line" points="{{ $bnLine }}"/>
            <circle class="bn__wave" cx="514" cy="75" r="7"/>
            <circle class="bn__dot" cx="514" cy="75" r="7"/>
        </svg>
    </div>

    <div class="bn__inner">
        @if(!empty($title))
            <h1 class="bn__title">{{ $title }}</h1>
            <span class="bn__bar" aria-hidden="true"></span>
        @endif

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
    </div>
</section>
