@extends('frontend.layouts.main')
@section('title', __('frontend.about.page_name'))
@section('description', __('frontend.about.desc'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.about.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.about.page_name')]
    ]
])

@php
    $auGlyphs = [['₿', 8, 18], ['Ξ', 22, 78], ['₮', 46, 10], ['◎', 58, 88], ['Ł', 84, 72], ['Ð', 92, 26], ['₳', 36, 52], ['Ξ', 70, 40]];
    $auPath = [
        ['fa-th-large', 'step1'],
        ['fa-book-open', 'step2'],
        ['fa-layer-group', 'step3'],
        ['fa-coins', 'step4'],
    ];
@endphp

<section class="au" aria-labelledby="auTitle">
    <div class="au__box">
        <span class="au__grid" aria-hidden="true"></span>
        <span class="au__glow" aria-hidden="true"></span>
        <span class="au__dust" aria-hidden="true">
            @foreach($auGlyphs as $g)
                <span style="--x: {{ $g[1] }}%; --y: {{ $g[2] }}%; --d: {{ $loop->index * -1.7 }}s">{{ $g[0] }}</span>
            @endforeach
        </span>

        <div class="au__top">
            <div class="au-copy">
                <span class="au-copy__tag"><i class="fas fa-bolt" aria-hidden="true"></i> {{ __('frontend.about.label') }}</span>
                <h2 id="auTitle" class="au-copy__title">{{ __('frontend.about.title') }}</h2>
                <p class="au-copy__lead">{{ __('frontend.about.lead') }}</p>
                <p class="au-copy__text">{{ __('frontend.about.body') }}</p>

                <ul class="au-chips">
                    <li><i class="fas fa-search" aria-hidden="true"></i> {{ __('frontend.about.point1') }}</li>
                    <li><i class="fas fa-layer-group" aria-hidden="true"></i> {{ __('frontend.about.point2') }}</li>
                    <li><i class="fas fa-coins" aria-hidden="true"></i> {{ __('frontend.about.point3') }}</li>
                </ul>

                <div class="au-copy__acts">
                    <a href="{{ route('product-lists') }}" class="btn btn--primary">
                        <span>{{ __('frontend.about.go_browse') }}</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn--ghost">{{ __('frontend.about.go_contact') }}</a>
                </div>

                <p class="au-copy__note">
                    <i class="fas fa-shield-alt" aria-hidden="true"></i>
                    {{ __('frontend.footer.risk_title') }}
                </p>
            </div>

            <div class="au-orb" aria-hidden="true">
                <span class="au-orb__pulse"></span>
                <span class="au-orb__pulse au-orb__pulse--late"></span>
                <span class="au-orb__ring au-orb__ring--outer">
                    <span class="au-orb__sat" style="--x: 50%; --y: 0%">Ξ</span>
                    <span class="au-orb__sat" style="--x: 93.3%; --y: 75%">₮</span>
                    <span class="au-orb__sat" style="--x: 6.7%; --y: 75%">◎</span>
                </span>
                <span class="au-orb__ring au-orb__ring--inner">
                    <span class="au-orb__sat au-orb__sat--sm" style="--x: 93.3%; --y: 25%">Ł</span>
                    <span class="au-orb__sat au-orb__sat--sm" style="--x: 6.7%; --y: 75%">Ð</span>
                </span>
                <span class="au-orb__core">₿</span>
            </div>
        </div>

        <div class="au-chain">
            <p class="au-chain__title">{{ __('frontend.about.steps') }}</p>
            <ol class="au-chain__list">
                @foreach($auPath as $step)
                    <li class="au-block" style="--i: {{ $loop->index }}">
                        <span class="au-block__top">
                            <span class="au-block__icon" aria-hidden="true"><i class="fas {{ $step[0] }}"></i></span>
                            <span class="au-block__num num" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </span>
                        <strong class="au-block__name">{{ __('frontend.about.' . $step[1]) }}</strong>
                        <span class="au-block__text">{{ __('frontend.about.' . $step[1] . '_text') }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>

@endsection
