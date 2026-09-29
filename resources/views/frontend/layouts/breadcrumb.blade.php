@php
    $bcLinks = isset($links) ? array_values($links) : [];
    $bcLast  = count($bcLinks) - 1;
    $bcFull  = !empty($title);
    $bcImage = $bcFull && file_exists(public_path('assets/images/breadcrumb.webp')) ? asset('assets/images/breadcrumb.webp') : null;
    $bcTools = [
        ['icon' => 'fa-chart-line',     'spot' => 'a'],
        ['icon' => 'fa-dollar-sign',    'spot' => 'b'],
        ['icon' => 'fa-chart-pie',      'spot' => 'c'],
        ['icon' => 'fa-balance-scale',  'spot' => 'd'],
    ];
@endphp

<section class="bc {{ $bcFull ? '' : 'bc--slim' }}">
    <div class="container">
        <div class="bc__card">
            <div class="bc__text">
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
                    <h1 class="bc__title">{{ $title }}</h1>
                @endif
            </div>

            @if($bcFull)
                <div class="bc__art" aria-hidden="true">
                    <div class="bc__frame {{ $bcImage ? '' : 'bc__frame--empty' }}">
                        @if($bcImage)
                            <img src="{{ $bcImage }}" alt="" width="1800" height="675">
                        @endif
                    </div>
                    @foreach($bcTools as $tool)
                        <span class="bc__tool bc__tool--{{ $tool['spot'] }}" style="--i: {{ $loop->index }}"><i class="fas {{ $tool['icon'] }}"></i></span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
