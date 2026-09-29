@php
    $bcLinks = isset($links) ? array_values($links) : [];
    $bcLast  = count($bcLinks) - 1;
    $bcFull  = !empty($title);
    $bcImage = $bcFull && file_exists(public_path('assets/images/breadcrumb-wireframe.webp')) ? asset('assets/images/breadcrumb-wireframe.webp') : null;
@endphp

<section class="bc {{ $bcFull ? 'bc--full' : 'bc--slim' }}" @if($bcFull) data-bc @endif>
    @if($bcFull)
        <div class="bc__media {{ $bcImage ? '' : 'bc__media--empty' }}" aria-hidden="true" @if($bcImage) style="--bc-img: url('{{ $bcImage }}')" @endif>
            @if($bcImage)
                <span class="bc__img"></span>
                <span class="bc__img bc__img--lit"></span>
            @endif
            <span class="bc__glow"></span>
            <span class="bc__shade"></span>
        </div>
    @endif

    <div class="container bc__inner">
        @if(count($bcLinks))
            <nav aria-label="{{ __('frontend.breadcrumb.label') }}">
                <ol class="bc__trail">
                    @foreach($bcLinks as $index => $link)
                        <li class="bc__step">
                            @if(isset($link['url']) && $index < $bcLast)
                                <a href="{{ $link['url'] }}" class="bc__link">{{ $link['name'] }}</a>
                            @else
                                <span class="bc__here" aria-current="page">{{ $link['name'] }}</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        @if($bcFull)
            <h1 class="bc__title"><span>{{ $title }}</span></h1>
        @endif
    </div>
</section>

@if($bcFull && $bcImage)
<script>
(function () {
    'use strict';

    var band = document.querySelector('[data-bc]');
    if (!band || !window.matchMedia('(hover: hover) and (pointer: fine)').matches) { return; }

    var frame = null;
    band.addEventListener('pointermove', function (event) {
        if (frame) { return; }
        frame = requestAnimationFrame(function () {
            frame = null;
            var box = band.getBoundingClientRect();
            band.style.setProperty('--mx', (event.clientX - box.left) + 'px');
            band.style.setProperty('--my', (event.clientY - box.top) + 'px');
            band.classList.add('is-lit');
        });
    });
    band.addEventListener('pointerleave', function () { band.classList.remove('is-lit'); });
}());
</script>
@endif
