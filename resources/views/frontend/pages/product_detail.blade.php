@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
<x-breadcrumb :title="$product_detail->title" :parent="__('common.catalog')" :parent-url="route('product-lists')" />

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
                <p class="pd-eyebrow">{{ __('common.digital_art') ?? 'Digital Art' }}</p>
                <h1 class="pd-title">{{ $product_detail->title }}</h1>

                @if($product_detail->description)
                    <div class="pd-overview">
                        <span class="pd-overview__label">{{ __('common.artwork_overview') }}</span>
                        <p class="pd-overview__text">{{ $product_detail->description }}</p>
                    </div>
                @endif

                {{-- Levels / variants --}}
                @if($product_detail->levels && count($product_detail->levels))
                    <div class="pd-levels">
                        <span class="pd-levels__label">{{ __('common.select_level') }}</span>

                        <div class="pd-tabs">
                            @foreach($product_detail->levels as $key => $level)
                                <button type="button" class="pd-tab {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">
                                    {{ ucfirst($level->skill_level) }}
                                </button>
                            @endforeach
                        </div>

                        @foreach($product_detail->levels as $key => $level)
                            <div class="pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" style="display: {{ $key === 0 ? 'block' : 'none' }};">
                                @if($level->purpose)
                                    <div class="pd-level__concept">
                                        <span class="pd-level__concept-label"><i class="fas fa-palette"></i> {{ __('common.design_concept') }}</span>
                                        <p class="pd-level__purpose">{{ $level->purpose }}</p>
                                    </div>
                                @endif

                                <div class="pd-buybar">
                                    <div class="pd-price">
                                        <span class="pd-price__label">{{ __('common.price') }}</span>
                                        <span class="pd-price__amt">{{ number_format($level->price_in_points) }} <small>{{ __('common.credits') }}</small></span>
                                    </div>
                                    <form action="{{ route('single-add-to-cart') }}" method="POST" class="enroll-form pd-buyform">
                                        @csrf
                                        <input type="hidden" name="quant[1]" value="1">
                                        <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                        <input type="hidden" name="price" value="{{ $level->price }}">
                                        <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                        <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                        <input type="hidden" name="level_id" value="{{ $level->id }}">
                                        <button type="submit" class="pd-buy enroll-btn"><span>{{ __('common.buy_now_text') }}</span> <i class="fas fa-arrow-right icon-arrow"></i></button>
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

@push('styles')
<style>
    /* =========================================================
       PRODUCT DETAIL — Structured theme
       ========================================================= */
    .pd-section { background-color: var(--color-putty, #c4c3b6); padding: 72px 0; }
    .pd-container { max-width: 1200px; margin: 0 auto; padding: 0 40px; }
    .pd-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 48px; align-items: start; }

    /* Gallery */
    .pd-gallery__main {
        aspect-ratio: 4 / 5; overflow: hidden;
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 14px; background-color: var(--color-bone, #e7e5e4);
    }
    .pd-gallery__main img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .pd-gallery__thumbs { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 14px; }
    .pd-thumb {
        width: 72px; height: 72px; padding: 0; overflow: hidden; cursor: pointer;
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 9px; background: var(--color-bone, #e7e5e4);
        transition: border-color 0.2s ease;
    }
    .pd-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .pd-thumb.active, .pd-thumb:hover { border-color: var(--color-ink, #000); }

    /* Info */
    .pd-eyebrow {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.18em; color: var(--color-graphite, #595855); margin: 0 0 12px 0;
    }
    .pd-title {
        font-family: var(--font-davinci, serif); font-size: clamp(30px, 4vw, 48px); font-weight: 500;
        line-height: 1.08; letter-spacing: -0.02em; color: var(--color-ink, #000); margin: 0 0 24px 0;
    }
    .pd-overview { padding-bottom: 28px; margin-bottom: 28px; border-bottom: 1px solid var(--color-vellum, #dfdcd5); }
    .pd-overview__label {
        display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-graphite, #595855); margin-bottom: 10px;
    }
    .pd-overview__text { font-family: var(--font-helvetica-now, sans-serif); font-size: 15px; line-height: 1.8; color: var(--color-ink, #000); margin: 0; }

    /* Levels */
    .pd-levels__label {
        display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 11px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-graphite, #595855); margin-bottom: 12px;
    }
    .pd-tabs { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 24px; }
    .pd-tab {
        font-family: var(--font-helvetica-now, sans-serif); font-size: 12px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        color: var(--color-ink, #000); background-color: transparent;
        border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 28.8px;
        padding: 10px 20px; cursor: pointer; transition: all 0.2s ease;
    }
    .pd-tab:hover { background-color: var(--color-bone, #e7e5e4); }
    .pd-tab.active { background-color: var(--color-ink, #000); color: var(--color-paper, #fff); border-color: var(--color-ink, #000); }

    .pd-level__concept { background-color: var(--color-bone, #e7e5e4); border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 10px; padding: 20px 22px; margin-bottom: 22px; }
    .pd-level__concept-label {
        display: inline-flex; align-items: center; gap: 7px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 10px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-graphite, #595855); margin-bottom: 10px;
    }
    .pd-level__concept-label i { color: var(--color-ink, #000); }
    .pd-level__purpose { font-family: var(--font-helvetica-now, sans-serif); font-size: 14px; line-height: 1.7; color: var(--color-ink, #000); margin: 0; }

    .pd-buybar {
        display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;
        padding: 20px 24px; border: 1px solid var(--color-vellum, #dfdcd5); border-radius: 12px; background-color: var(--color-paper, #fff);
    }
    .pd-price__label { display: block; font-family: var(--font-helvetica-now, sans-serif); font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-graphite, #595855); margin-bottom: 4px; }
    .pd-price__amt { font-family: var(--font-davinci, serif); font-size: 30px; font-weight: 500; color: var(--color-ink, #000); line-height: 1; }
    .pd-price__amt small { font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; font-weight: 500; color: var(--color-graphite, #595855); }
    .pd-buyform { flex: 1 1 200px; }
    .pd-buy {
        width: 100%; display: inline-flex; align-items: center; justify-content: center; gap: 10px;
        font-family: var(--font-helvetica-now, sans-serif); font-size: 13px; font-weight: 600;
        text-transform: uppercase; letter-spacing: 0.05em;
        background-color: var(--color-ink, #000); color: var(--color-paper, #fff);
        border: 1px solid var(--color-ink, #000); border-radius: 28.8px;
        padding: 15px 24px; cursor: pointer; transition: opacity 0.2s ease;
    }
    .pd-buy:hover { opacity: 0.85; }
    .pd-buy .icon-arrow { transition: transform 0.3s ease; }
    .pd-buy:hover .icon-arrow { transform: translateX(4px); }

    @media (max-width: 900px) {
        .pd-section { padding: 48px 0; }
        .pd-container { padding: 0 20px; }
        .pd-grid { grid-template-columns: 1fr; gap: 32px; }
    }
</style>
@endpush

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
