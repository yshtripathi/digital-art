@php
    $crumbGlyphs = [
        ['A',  6,  18, 'fill'],
        ['あ', 30, 8,  'line'],
        ['Ж',  56, 30, 'line'],
        ['¶',  18, 58, 'line'],
        ['ع',  78, 12, 'fill'],
        ['한', 44, 70, 'fill'],
        ['“',  84, 60, 'line'],
    ];
    $crumbLinks = isset($links) ? array_values($links) : [];
    $crumbLast  = count($crumbLinks) - 1;
@endphp

<section class="crumb {{ empty($title) ? 'crumb--compact' : '' }}">
    <div class="crumb__glyphs" aria-hidden="true">
        @foreach($crumbGlyphs as $glyph)
            <span class="crumb__glyph crumb__glyph--{{ $glyph[3] }}" style="--x: {{ $glyph[1] }}%; --y: {{ $glyph[2] }}%; --i: {{ $loop->index }}">{{ $glyph[0] }}</span>
        @endforeach
    </div>

    <div class="crumb__inner">
        @if(count($crumbLinks))
            <nav class="crumb__nav" aria-label="{{ __('frontend.breadcrumb.label') }}">
                <ol class="crumb__trail">
                    @foreach($crumbLinks as $index => $link)
                        <li class="crumb__step" style="--i: {{ $index }}">
                            @if(isset($link['url']) && $index < $crumbLast)
                                <a href="{{ $link['url'] }}" class="crumb__link">
                                    @if($index === 0)
                                        <i class="fas fa-home crumb__home" aria-hidden="true"></i>
                                    @endif
                                    <span>{{ $link['name'] }}</span>
                                </a>
                                <i class="fas fa-chevron-right crumb__sep" aria-hidden="true"></i>
                            @else
                                <span class="crumb__here" aria-current="page">
                                    <span class="crumb__pin" aria-hidden="true"></span>
                                    {{ $link['name'] }}
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        @if(!empty($title))
            <h1 class="crumb__title"><span class="crumb__words">{{ $title }}</span></h1>
        @endif
    </div>
</section>
