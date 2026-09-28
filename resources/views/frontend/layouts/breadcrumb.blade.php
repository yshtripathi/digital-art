@php
    $bnIcons = [
        ['fa-pen-nib',      7,  24, 'writing'],
        ['fa-microphone',   13, 66, 'language'],
        ['fa-book-open',    21, 36, 'writing'],
        ['fa-language',     52, 20, 'language'],
        ['fa-comment-dots', 50, 68, 'writing'],
        ['fa-quote-left',   3,  82, 'language'],
    ];
@endphp

<section class="bn {{ empty($title) ? 'bn--compact' : '' }}">
    <img class="bn__photo" src="{{ asset('assets/images/breadcrumb.webp') }}?v={{ filemtime(public_path('assets/images/breadcrumb.webp')) }}" alt="" width="2400" height="900" fetchpriority="high" decoding="async">
    <span class="bn__shade" aria-hidden="true"></span>

    <div class="bn__icons" aria-hidden="true">
        @foreach($bnIcons as $icon)
            <span class="bn__icon bn__icon--{{ $icon[3] }}" style="--x: {{ $icon[1] }}%; --y: {{ $icon[2] }}%; --i: {{ $loop->index }}"><i class="fas {{ $icon[0] }}"></i></span>
        @endforeach
    </div>

    <div class="bn__inner">
        @if(isset($links) && count($links) > 0)
            <nav class="bn__nav" aria-label="{{ __('frontend.breadcrumb.trail') }}">
                <ol class="bn__crumbs">
                    @foreach($links as $index => $link)
                        <li class="bn__crumb" style="--i: {{ $index }}">
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
            <h1 class="bn__title"><span>{{ $title }}</span></h1>
            <span class="bn__levels" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
        @endif
    </div>
</section>
