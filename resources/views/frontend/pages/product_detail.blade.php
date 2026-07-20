@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
<x-breadcrumb :title="$product_detail->title" :parent="__('inkwave.pl_catalog')" :parent-url="route('product-lists')" />

@php $photos = array_values(array_filter(explode(',', $product_detail->photo))); @endphp

<section class="pd-section">
    <div class="pd-container">
        <div class="pd-grid">

            {{-- ============ GALLERY ============ --}}
            <div class="pd-gallery">
                <div class="pd-gallery__main">
                    <img id="pdMainImg" src="{{ asset($photos[0] ?? '') }}" alt="{{ $product_detail->title }}">
                </div>
                @if(count($photos) > 1)
                    <div class="pd-gallery__thumbs">
                        @foreach($photos as $i => $ph)
                            <button type="button" class="pd-thumb {{ $i === 0 ? 'active' : '' }}" data-src="{{ asset($ph) }}">
                                <img src="{{ asset($ph) }}" alt="{{ $product_detail->title }} {{ $i + 1 }}">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ============ INFO + BUY ============ --}}
            <div class="pd-info">
                <p class="pd-eyebrow">{{ __('inkwave.pd_digital_art') }}</p>
                <h1 class="pd-title">{{ $product_detail->title }}</h1>

                @if($product_detail->description)
                    <div class="pd-overview">
                        <span class="pd-overview__label">{{ __('inkwave.pd_overview') }}</span>
                        <p class="pd-overview__text">{{ $product_detail->description }}</p>
                    </div>
                @endif

                {{-- Levels / variants --}}
                @if($product_detail->levels && count($product_detail->levels))
                    <div class="pd-levels">
                        <span class="pd-levels__label">{{ __('inkwave.pd_select_level') }}</span>

                        <div class="pd-tabs">
                            @foreach($product_detail->levels as $key => $level)
                                <button type="button" class="pd-tab {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">
                                    {{ ucfirst($level->skill_level) }}
                                </button>
                            @endforeach
                        </div>

                        @foreach($product_detail->levels as $key => $level)
                            <div class="pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" style="display: {{ $key === 0 ? 'block' : 'none' }};">
                                @if($level->learn_info || $level->purpose || $level->outcome)
                                    <div class="pd-learn">
                                        @if($level->learn_info)
                                            <div class="pd-learn__row">
                                                <span class="pd-learn__icon"><i class="fas fa-book-open"></i></span>
                                                <div class="pd-learn__body">
                                                    <span class="pd-learn__label">{{ __('inkwave.pd_learn_info') }}</span>
                                                    <p class="pd-learn__text">{{ $level->learn_info }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($level->purpose)
                                            <div class="pd-learn__row">
                                                <span class="pd-learn__icon"><i class="fas fa-bullseye"></i></span>
                                                <div class="pd-learn__body">
                                                    <span class="pd-learn__label">{{ __('inkwave.pd_purpose') }}</span>
                                                    <p class="pd-learn__text">{{ $level->purpose }}</p>
                                                </div>
                                            </div>
                                        @endif

                                        @if($level->outcome)
                                            <div class="pd-learn__row">
                                                <span class="pd-learn__icon"><i class="fas fa-trophy"></i></span>
                                                <div class="pd-learn__body">
                                                    <span class="pd-learn__label">{{ __('inkwave.pd_outcome') }}</span>
                                                    <p class="pd-learn__text">{{ $level->outcome }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <div class="pd-buybar">
                                    <div class="pd-price">
                                        <span class="pd-price__label">{{ __('inkwave.pd_price') }}</span>
                                        <span class="pd-price__amt">{{ number_format($level->price_in_points) }} <small>{{ __('inkwave.pd_credits') }}</small></span>
                                    </div>
                                    <form action="{{ route('single-add-to-cart') }}" method="POST" class="enroll-form pd-buyform">
                                        @csrf
                                        <input type="hidden" name="quant[1]" value="1">
                                        <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                        <input type="hidden" name="price" value="{{ $level->price }}">
                                        <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                        <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                        <input type="hidden" name="level_id" value="{{ $level->id }}">
                                        <button type="submit" class="pd-buy enroll-btn"><span>{{ __('inkwave.pd_buy_now') }}</span> <i class="fas fa-arrow-right icon-arrow"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ---- Level / variant tabs ----
    const tabs = document.querySelectorAll('.pd-tab');
    const levels = document.querySelectorAll('.pd-level');
    tabs.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-level-id');
            tabs.forEach(b => b.classList.remove('active'));
            levels.forEach(l => { l.style.display = 'none'; l.classList.remove('active'); });
            this.classList.add('active');
            const active = document.querySelector('.pd-level[data-level-id="' + id + '"]');
            if (active) { active.style.display = 'block'; active.classList.add('active'); }
        });
    });

    // ---- Gallery thumbnails ----
    const mainImg = document.getElementById('pdMainImg');
    const thumbs = document.querySelectorAll('.pd-thumb');
    thumbs.forEach(t => {
        t.addEventListener('click', function() {
            const src = this.getAttribute('data-src');
            if (mainImg && src) { mainImg.src = src; }
            thumbs.forEach(x => x.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // ---- Enroll (add to cart) — submit without redirect, then reload ----
    const enrollForms = document.querySelectorAll('.enroll-form');
    enrollForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('.enroll-btn');
            const originalBtnText = submitBtn.innerHTML;
            const originalBtnState = submitBtn.disabled;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';

            fetch(form.action, { method: 'POST', body: new FormData(form), redirect: 'manual' })
                .then(response => new Promise(resolve => setTimeout(() => resolve(response), 500)))
                .then(() => { window.location.reload(); })
                .catch(error => {
                    console.error('Error:', error);
                    submitBtn.disabled = originalBtnState;
                    submitBtn.innerHTML = originalBtnText;
                });
        });
    });
});
</script>
@endpush
