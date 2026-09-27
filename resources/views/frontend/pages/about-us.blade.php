@extends('frontend.layouts.main')
@section('title', __('frontend.about.page_name'))
@section('description', __('frontend.about.meta'))

@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('frontend.about.page_name'),
    'links' => [
        ['name' => __('frontend.breadcrumb.start'), 'url' => route('home')],
        ['name' => __('frontend.about.page_name')]
    ]
])

<section class="au" aria-labelledby="auTitle">
    <div class="au__grid">
        <div class="au-copy">
            <span class="eyebrow">{{ __('frontend.about.tag') }}</span>
            <h2 id="auTitle" class="au-copy__title">{{ __('frontend.about.heading') }}</h2>
            <p class="au-copy__lead">{{ __('frontend.about.intro1') }}</p>
            <p class="au-copy__text">{{ __('frontend.about.intro2') }}</p>

            <ul class="au-points">
                <li>
                    <span class="au-points__icon" aria-hidden="true"><i class="fas fa-search"></i></span>
                    <span>{{ __('frontend.about.hl1') }}</span>
                </li>
                <li>
                    <span class="au-points__icon" aria-hidden="true"><i class="fas fa-layer-group"></i></span>
                    <span>{{ __('frontend.about.hl2') }}</span>
                </li>
                <li>
                    <span class="au-points__icon" aria-hidden="true"><i class="fas fa-coins"></i></span>
                    <span>{{ __('frontend.about.hl3') }}</span>
                </li>
            </ul>

            <div class="au-flow">
                <p class="au-flow__title">{{ __('frontend.about.path_title') }}</p>
                <ol class="au-flow__steps">
                    @foreach(range(1, 4) as $n)
                        <li class="au-step" style="--i: {{ $n - 1 }}">
                            <span class="au-step__num num" aria-hidden="true">{{ str_pad($n, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="au-step__body">
                                <strong class="au-step__name">{{ __('frontend.about.path' . $n) }}</strong>
                                <span class="au-step__text">{{ __('frontend.about.path' . $n . '_text') }}</span>
                            </span>
                        </li>
                    @endforeach
                </ol>
            </div>

            <div class="au-copy__acts">
                <a href="{{ route('product-lists') }}" class="btn btn--primary">
                    <span>{{ __('frontend.about.cta_browse') }}</span>
                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('contact') }}" class="btn btn--ghost">{{ __('frontend.about.cta_contact') }}</a>
            </div>
        </div>

        <div class="au-visual">
            <figure class="au-shot au-shot--tall">
                <img src="{{ asset('assets/images/about-markets.webp') }}" alt="{{ __('frontend.about.img_desk') }}" width="1100" height="1650" loading="lazy" decoding="async">
            </figure>
            <figure class="au-shot au-shot--wide">
                <img src="{{ asset('assets/images/about-learner.webp') }}" alt="{{ __('frontend.about.img_reader') }}" width="1600" height="1067" loading="lazy" decoding="async">
            </figure>
            <span class="au-chip au-chip--top">
                <i class="fas fa-user-graduate" aria-hidden="true"></i>
                {{ __('frontend.about.chip') }}
            </span>
            <span class="au-chip au-chip--side">
                <i class="fas fa-shield-alt" aria-hidden="true"></i>
                {{ __('frontend.footer.risk_title') }}
            </span>
        </div>
    </div>
</section>

@endsection
