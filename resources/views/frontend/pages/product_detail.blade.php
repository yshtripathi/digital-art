@extends('frontend.layouts.main')

@section('title', $product_detail->title)
@section('description', $product_detail->summary)

@section('main-content')
@include('frontend.layouts.breadcrumb', [
    'title' => $product_detail->title,
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.cl_catalog'), 'url' => route('product-lists')],
        ['name' => $product_detail->title]
    ]
])

@php $photos = array_values(array_filter(explode(',', $product_detail->photo))); @endphp

<style>
/* ==========================================================================
   Art Courses — Product Details (Gallery Theme)
   ========================================================================== */
.ag-pd-page, .ag-pd-page *, .ag-pd-page *::before, .ag-pd-page *::after {
    box-sizing: border-box;
}
    .ag-pd-page {
    padding: 40px 40px;
    min-height: 80vh;
}
.ag-container {
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 5%;
}

.ag-pd-grid {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 80px;
    align-items: start;
}
@media (max-width: 1024px) {
    .ag-pd-grid { grid-template-columns: 1fr; gap: 64px; }
}

/* Gallery Sidebar */
.ag-pd-gallery {
    position: sticky;
    top: 140px;
}
.ag-pd-main-img {
    width: 100%;
    aspect-ratio: 4/3;
    background: #f5f5f5;
    border: 1px solid rgba(0,0,0,0.05);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.ag-pd-main-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.ag-pd-main-img i {
    font-size: 64px;
    color: #cccccc;
}
.ag-pd-thumbs {
    display: flex;
    gap: 16px;
    overflow-x: auto;
    padding-bottom: 8px; /* For scrollbar breathing room */
}
.ag-pd-thumb {
    width: 100px;
    height: 100px;
    border: 2px solid transparent;
    background: #f5f5f5;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
    outline: none;
    flex-shrink: 0;
}
.ag-pd-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.ag-pd-thumb.active {
    border-color: #bc9c5c;
}
.ag-pd-thumb:hover {
    opacity: 0.8;
}

/* Info Section */
.ag-pd-eyebrow {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: #bc9c5c;
    margin-bottom: 16px;
    font-weight: bold;
}
.ag-pd-eyebrow i { margin-right: 8px; }
.ag-pd-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif) !important;
    font-size: 48px !important;
    color: #000000 !important;
    margin-bottom: 32px !important;
    line-height: 1.1;
}
.ag-pd-desc {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 16px;
    color: #555555;
    line-height: 1.8;
    margin-bottom: 64px;
}

/* Level Tabs */
.ag-pd-tabs-label {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 28px;
    color: #000000;
    margin-bottom: 24px;
    display: block;
}
.ag-pd-tabs {
    display: flex;
    gap: 40px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
    margin-bottom: 48px;
}
.ag-pd-tab {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #888888;
    background: none;
    border: none;
    padding: 16px 0;
    cursor: pointer;
    position: relative;
    font-weight: bold;
    transition: color 0.3s ease;
}
.ag-pd-tab.active {
    color: #000000;
}
.ag-pd-tab.active::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 3px;
    background: #000000;
}
.ag-pd-tab:hover {
    color: #000000;
}

/* Tab Content / Levels */
.ag-pd-level { display: none; }
.ag-pd-level.active { display: block; animation: agFadeInUp 0.5s ease; }
@keyframes agFadeInUp {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Content Card */
.ag-pd-content-card {
    background-color: #f5f5f5;
    padding: 56px 48px;
}
@media (max-width: 768px) { .ag-pd-content-card { padding: 32px 24px; } }

/* Features */
.ag-pd-features { margin-bottom: 48px; }
.ag-pd-feat {
    display: flex;
    gap: 24px;
    margin-bottom: 32px;
}
.ag-pd-feat__icon {
    width: 56px;
    height: 56px;
    background: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 20px;
    color: #bc9c5c;
}
.ag-pd-feat__label {
    display: block;
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 22px;
    color: #000000;
    margin-bottom: 8px;
}
.ag-pd-feat__desc {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 15px;
    color: #555555;
    line-height: 1.6;
}

/* Buy Box */
.ag-pd-buybox {
    background: #ffffff; /* White to pop off the Bone content card */
    padding: 40px;
    border-top: 6px solid #000000;
    box-shadow: 0 20px 40px rgba(0,0,0,0.05);
}
.ag-pd-price__label {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: #888888;
    display: block;
    margin-bottom: 8px;
}
.ag-pd-price__amt {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 48px;
    color: #000000;
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 32px;
    line-height: 1;
}
.ag-pd-price__amt i { color: #bc9c5c; font-size: 32px; }
.ag-pd-price__amt small {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #888888;
    margin-top: 12px;
}
button[type="submit"].ag-submit-btn {
    width: 100%;
    background: #000000 !important;
    color: #ffffff !important;
    border: 1px solid #000000 !important;
    font-family: Arial, sans-serif !important;
    font-size: 14px !important;
    font-weight: bold !important;
    text-transform: uppercase !important;
    letter-spacing: 0.1em !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    padding: 24px !important;
    display: flex !important;
    justify-content: center;
    align-items: center;
    gap: 12px;
}
button[type="submit"].ag-submit-btn:hover {
    background: #ffffff !important;
    color: #000000 !important;
}
</style>

<div class="ag-pd-page">
    <div class="ag-container">
        <div class="ag-pd-grid">

            {{-- ============ GALLERY ============ --}}
            <div>
                <div class="ag-pd-gallery">
                    <div class="ag-pd-main-img">
                        @if(isset($photos[0]))
                            <img id="pdMainImg" src="{{ asset($photos[0]) }}" alt="{{ $product_detail->title }}">
                        @else
                            <i class="fas fa-image"></i>
                        @endif
                    </div>
                    
                    @if(count($photos) > 1)
                        <div class="ag-pd-thumbs">
                            @foreach($photos as $i => $ph)
                                <button type="button" class="ag-pd-thumb {{ $i === 0 ? 'active' : '' }}" data-src="{{ asset($ph) }}">
                                    <img src="{{ asset($ph) }}" alt="{{ $product_detail->title }} Thumbnail {{ $i + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- ============ INFO ============ --}}
            <div class="ag-pd-content-card">
                <p class="ag-pd-eyebrow"><i class="fas fa-book-open"></i> {{ __('inkwave.cd_category') }}</p>
                <h1 class="ag-pd-title">{{ $product_detail->title }}</h1>
                
                @if($product_detail->description)
                    <p class="ag-pd-desc">{!! nl2br(e($product_detail->description)) !!}</p>
                @endif

                @if($product_detail->levels && count($product_detail->levels))
                    <span class="ag-pd-tabs-label">{{ __('inkwave.cd_select_level') }}</span>
                    
                    <div class="ag-pd-tabs">
                        @foreach($product_detail->levels as $key => $level)
                            <button type="button" class="ag-pd-tab {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">
                                {{ ucfirst($level->skill_level) }}
                            </button>
                        @endforeach
                    </div>

                    @foreach($product_detail->levels as $key => $level)
                        <div class="ag-pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">
                            
                            @if($level->learn_info || $level->purpose || $level->outcome)
                                <div class="ag-pd-features">
                                    @if($level->learn_info)
                                        <div class="ag-pd-feat">
                                            <div class="ag-pd-feat__icon"><i class="fas fa-gem"></i></div>
                                            <div class="ag-pd-feat__text">
                                                <span class="ag-pd-feat__label">{{ __('inkwave.cd_learn_info') }}</span>
                                                <p class="ag-pd-feat__desc">{{ $level->learn_info }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($level->purpose)
                                        <div class="ag-pd-feat">
                                            <div class="ag-pd-feat__icon"><i class="fas fa-bullseye"></i></div>
                                            <div class="ag-pd-feat__text">
                                                <span class="ag-pd-feat__label">{{ __('inkwave.cd_purpose') }}</span>
                                                <p class="ag-pd-feat__desc">{{ $level->purpose }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if($level->outcome)
                                        <div class="ag-pd-feat">
                                            <div class="ag-pd-feat__icon"><i class="fas fa-trophy"></i></div>
                                            <div class="ag-pd-feat__text">
                                                <span class="ag-pd-feat__label">{{ __('inkwave.cd_outcome') }}</span>
                                                <p class="ag-pd-feat__desc">{{ $level->outcome }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            {{-- BUY BOX --}}
                            <div class="ag-pd-buybox">
                                <span class="ag-pd-price__label">{{ __('inkwave.cd_price') }}</span>
                                <div class="ag-pd-price__amt">
                                    <i class="fas fa-coins"></i> {{ number_format($level->price_in_points) }} 
                                    <small>{{ __('inkwave.cd_credits') }}</small>
                                </div>

                                <form action="{{ route('single-add-to-cart') }}" method="POST" class="enroll-form">
                                    @csrf
                                    <input type="hidden" name="quant[1]" value="1">
                                    <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                    <input type="hidden" name="price" value="{{ $level->price }}">
                                    <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                    <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                    <input type="hidden" name="level_id" value="{{ $level->id }}">
                                    <button type="submit" class="ag-submit-btn enroll-btn">
                                        <span>ENROLL NOW</span> 
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
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
    const tabs = document.querySelectorAll('.ag-pd-tab');
    const levels = document.querySelectorAll('.ag-pd-level');
    tabs.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-level-id');
            tabs.forEach(b => b.classList.remove('active'));
            levels.forEach(l => { 
                l.style.display = 'none'; 
                l.classList.remove('active'); 
            });
            this.classList.add('active');
            const active = document.querySelector('.ag-pd-level[data-level-id="' + id + '"]');
            if (active) { 
                active.style.display = 'block'; 
                // Slight delay for animation
                setTimeout(() => active.classList.add('active'), 10);
            }
        });
    });

    // ---- Gallery thumbnails ----
    const mainImg = document.getElementById('pdMainImg');
    const thumbs = document.querySelectorAll('.ag-pd-thumb');
    thumbs.forEach(t => {
        t.addEventListener('click', function() {
            const src = this.getAttribute('data-src');
            if (mainImg && src) { mainImg.src = src; }
            thumbs.forEach(x => x.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // ---- Enroll (add to cart) ----
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
