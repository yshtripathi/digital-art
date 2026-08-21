@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
@include('frontend.layouts.breadcrumb', [
    'title' => $product_detail->title,
    'links' => [
        ['name' => __('inkwave.menu_home'), 'url' => route('home')],
        ['name' => __('inkwave.pl_catalog'), 'url' => route('product-lists')],
        ['name' => $product_detail->title]
    ]
])

@php $photos = array_values(array_filter(explode(',', $product_detail->photo))); @endphp

<style>
/* -------------------------------------------
   Duolingo Theme Product Detail - Artora
------------------------------------------- */
.duo-pd-wrap {
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
    background: #ffffff;
    padding-bottom: 100px;
}
.duo-pd-container {
    max-width: 1200px;
    margin: 48px auto;
    padding: 0 24px;
}

.duo-pd-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 48px;
    align-items: start;
}
@media (max-width: 900px) {
    .duo-pd-grid { grid-template-columns: 1fr; gap: 32px; }
}

/* ============ GALLERY ============ */
.duo-pd-gallery-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    padding: 24px;
    box-shadow: 0 12px 0 #e5e5e5;
}
.duo-pd-main-img {
    width: 100%;
    aspect-ratio: 16 / 9;
    height: auto;
    border-radius: 20px;
    border: 2px solid #e5e5e5;
    background: #f7f7f7;
    overflow: hidden;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 64px;
    color: #e5e5e5;
}
.duo-pd-main-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.duo-pd-thumbs {
    display: flex;
    gap: 12px;
    overflow-x: auto;
    padding-bottom: 8px;
}
.duo-pd-thumb {
    width: 120px;
    height: 80px;
    flex-shrink: 0;
    border: 2px solid transparent;
    border-radius: 16px;
    overflow: hidden;
    cursor: pointer;
    background: #f7f7f7;
    transition: all 0.1s;
    padding: 0;
}
.duo-pd-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 14px;
    border: 2px solid #e5e5e5;
    box-shadow: 0 4px 0 #e5e5e5;
    transition: all 0.1s;
}
.duo-pd-thumb:hover img {
    transform: translateY(2px);
    box-shadow: 0 2px 0 #e5e5e5;
}
.duo-pd-thumb.active img {
    border-color: var(--color-spark-blue, #1cb0f6);
    box-shadow: 0 0 0 transparent;
    transform: translateY(4px);
}

/* ============ INFO ============ */
.duo-pd-eyebrow {
    font-size: 15px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--color-spark-blue, #1cb0f6);
    letter-spacing: 0.1em;
    margin-bottom: 12px;
}
.duo-pd-title {
    font-size: 40px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    line-height: 1.2;
    margin-bottom: 24px;
}
.duo-pd-desc {
    font-size: 18px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 40px;
    line-height: 1.6;
}

/* Tabs */
.duo-pd-tabs-label {
    font-size: 18px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 16px;
    display: block;
}
.duo-pd-tabs {
    display: flex;
    gap: 12px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}
.duo-pd-tab {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 16px;
    padding: 12px 24px;
    font-size: 17px;
    font-weight: 800;
    color: var(--color-charcoal, #4b4b4b);
    cursor: pointer;
    box-shadow: 0 4px 0 #e5e5e5;
    transition: all 0.1s;
}
.duo-pd-tab:hover {
    background: #f7f7f7;
}
.duo-pd-tab.active {
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff;
    border-color: #1899d6;
    box-shadow: 0 0 0 transparent;
    transform: translateY(4px);
}

/* Features */
.duo-pd-features {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 48px;
}
.duo-pd-feat {
    background: #f7f7f7;
    border: 2px solid #e5e5e5;
    border-radius: 20px;
    padding: 24px;
    display: flex;
    gap: 20px;
}
.duo-pd-feat__icon {
    width: 48px;
    height: 48px;
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: var(--color-spark-blue, #1cb0f6);
    flex-shrink: 0;
}
.duo-pd-feat__text {
    flex: 1;
}
.duo-pd-feat__label {
    font-size: 15px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 4px;
    display: block;
}
.duo-pd-feat__desc {
    font-size: 16px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    margin: 0;
}

/* Buy Bar */
.duo-pd-buybox {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 8px 0 #e5e5e5;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
}
@media (max-width: 600px) {
    .duo-pd-buybox { flex-direction: column; text-align: center; }
}
.duo-pd-price {
    display: flex;
    flex-direction: column;
}
.duo-pd-price__label {
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--color-pencil-gray, #777777);
    margin-bottom: 4px;
}
.duo-pd-price__amt {
    font-size: 32px;
    font-weight: 800;
    color: var(--color-macaw-yellow, #ffc800);
    display: flex;
    align-items: center;
    gap: 8px;
}
.duo-pd-price__amt i {
    font-size: 24px;
}
.duo-pd-price__amt small {
    font-size: 18px;
    color: var(--color-pencil-gray, #777777);
}
.duo-pd-buybtn {
    background: var(--color-eager-green, #58cc02);
    color: #ffffff;
    border: 2px solid #46a302;
    border-radius: 16px;
    padding: 16px 32px;
    font-size: 19px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    box-shadow: 0 6px 0 #46a302;
    cursor: pointer;
    transition: all 0.1s;
    display: flex;
    align-items: center;
    gap: 12px;
}
.duo-pd-buybtn:hover {
    filter: brightness(1.05);
}
.duo-pd-buybtn:active {
    transform: translateY(6px);
    box-shadow: 0 0 0 transparent;
}
</style>

<div class="duo-pd-wrap">
    <div class="duo-pd-container">
        <div class="duo-pd-grid">

            {{-- ============ GALLERY ============ --}}
            <div class="duo-pd-gallery-card">
                <div class="duo-pd-main-img">
                    @if(isset($photos[0]))
                        <img id="pdMainImg" src="{{ asset($photos[0]) }}" alt="{{ $product_detail->title }}">
                    @else
                        <i class="fas fa-image"></i>
                    @endif
                </div>
                
                @if(count($photos) > 1)
                    <div class="duo-pd-thumbs">
                        @foreach($photos as $i => $ph)
                            <button type="button" class="duo-pd-thumb {{ $i === 0 ? 'active' : '' }}" data-src="{{ asset($ph) }}">
                                <img src="{{ asset($ph) }}" alt="{{ $product_detail->title }} {{ $i + 1 }}">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ============ INFO ============ --}}
            <div>
                <p class="duo-pd-eyebrow"><i class="fas fa-palette"></i> {{ __('inkwave.pd_digital_art') }}</p>
                <h1 class="duo-pd-title">{{ $product_detail->title }}</h1>
                
                @if($product_detail->description)
                    <p class="duo-pd-desc">{{ $product_detail->description }}</p>
                @endif

                @if($product_detail->levels && count($product_detail->levels))
                    <span class="duo-pd-tabs-label">{{ __('inkwave.pd_select_level') }}</span>
                    
                    <div class="duo-pd-tabs">
                        @foreach($product_detail->levels as $key => $level)
                            <button type="button" class="duo-pd-tab {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">
                                {{ ucfirst($level->skill_level) }}
                            </button>
                        @endforeach
                    </div>

                    @foreach($product_detail->levels as $key => $level)
                        <div class="duo-pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}" style="display: {{ $key === 0 ? 'block' : 'none' }};">
                            
                            @if($level->learn_info || $level->purpose || $level->outcome)
                                <div class="duo-pd-features">
                                    @if($level->learn_info)
                                        <div class="duo-pd-feat">
                                            <div class="duo-pd-feat__icon"><i class="fas fa-book-open"></i></div>
                                            <div class="duo-pd-feat__text">
                                                <span class="duo-pd-feat__label">{{ __('inkwave.pd_learn_info') }}</span>
                                                <p class="duo-pd-feat__desc">{{ $level->learn_info }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($level->purpose)
                                        <div class="duo-pd-feat">
                                            <div class="duo-pd-feat__icon"><i class="fas fa-bullseye"></i></div>
                                            <div class="duo-pd-feat__text">
                                                <span class="duo-pd-feat__label">{{ __('inkwave.pd_purpose') }}</span>
                                                <p class="duo-pd-feat__desc">{{ $level->purpose }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if($level->outcome)
                                        <div class="duo-pd-feat">
                                            <div class="duo-pd-feat__icon"><i class="fas fa-trophy"></i></div>
                                            <div class="duo-pd-feat__text">
                                                <span class="duo-pd-feat__label">{{ __('inkwave.pd_outcome') }}</span>
                                                <p class="duo-pd-feat__desc">{{ $level->outcome }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="duo-pd-buybox">
                                <div class="duo-pd-price">
                                    <span class="duo-pd-price__label">{{ __('inkwave.pd_price') }}</span>
                                    <span class="duo-pd-price__amt"><i class="fas fa-coins"></i> {{ number_format($level->price_in_points) }} <small>{{ __('inkwave.pd_credits') }}</small></span>
                                </div>
                                <form action="{{ route('single-add-to-cart') }}" method="POST" class="enroll-form">
                                    @csrf
                                    <input type="hidden" name="quant[1]" value="1">
                                    <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                    <input type="hidden" name="price" value="{{ $level->price }}">
                                    <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                    <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                    <input type="hidden" name="level_id" value="{{ $level->id }}">
                                    <button type="submit" class="duo-pd-buybtn enroll-btn"><span>{{ __('inkwave.pd_buy_now') }}</span> <i class="fas fa-shopping-cart"></i></button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ---- Level / variant tabs ----
    const tabs = document.querySelectorAll('.duo-pd-tab');
    const levels = document.querySelectorAll('.duo-pd-level');
    tabs.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-level-id');
            tabs.forEach(b => b.classList.remove('active'));
            levels.forEach(l => { l.style.display = 'none'; l.classList.remove('active'); });
            this.classList.add('active');
            const active = document.querySelector('.duo-pd-level[data-level-id="' + id + '"]');
            if (active) { active.style.display = 'block'; active.classList.add('active'); }
        });
    });

    // ---- Gallery thumbnails ----
    const mainImg = document.getElementById('pdMainImg');
    const thumbs = document.querySelectorAll('.duo-pd-thumb');
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
