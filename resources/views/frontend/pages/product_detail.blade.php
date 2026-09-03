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
                <p class="duo-pd-eyebrow"><i class="fas fa-book"></i> {{ __('inkwave.cd_category') }}</p>
                <h1 class="duo-pd-title">{{ $product_detail->title }}</h1>
                
                @if($product_detail->description)
                    <p class="duo-pd-desc">{{ $product_detail->description }}</p>
                @endif

                @if($product_detail->levels && count($product_detail->levels))
                    <span class="duo-pd-tabs-label">{{ __('inkwave.cd_select_level') }}</span>
                    
                    <div class="duo-pd-tabs">
                        @foreach($product_detail->levels as $key => $level)
                            <button type="button" class="duo-pd-tab {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">
                                {{ ucfirst($level->skill_level) }}
                            </button>
                        @endforeach
                    </div>

                    @foreach($product_detail->levels as $key => $level)
                        <div class="duo-pd-level {{ $key === 0 ? 'active' : '' }}" data-level-id="{{ $level->id }}">
                            
                            @if($level->learn_info || $level->purpose || $level->outcome)
                                <div class="duo-pd-features">
                                    @if($level->learn_info)
                                        <div class="duo-pd-feat">
                                            <div class="duo-pd-feat__icon"><i class="fas fa-book-open"></i></div>
                                            <div class="duo-pd-feat__text">
                                                <span class="duo-pd-feat__label">{{ __('inkwave.cd_learn_info') }}</span>
                                                <p class="duo-pd-feat__desc">{{ $level->learn_info }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($level->purpose)
                                        <div class="duo-pd-feat">
                                            <div class="duo-pd-feat__icon"><i class="fas fa-bullseye"></i></div>
                                            <div class="duo-pd-feat__text">
                                                <span class="duo-pd-feat__label">{{ __('inkwave.cd_purpose') }}</span>
                                                <p class="duo-pd-feat__desc">{{ $level->purpose }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    @if($level->outcome)
                                        <div class="duo-pd-feat">
                                            <div class="duo-pd-feat__icon"><i class="fas fa-trophy"></i></div>
                                            <div class="duo-pd-feat__text">
                                                <span class="duo-pd-feat__label">{{ __('inkwave.cd_outcome') }}</span>
                                                <p class="duo-pd-feat__desc">{{ $level->outcome }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="duo-pd-buybox">
                                <div class="duo-pd-price">
                                    <span class="duo-pd-price__label">{{ __('inkwave.cd_price') }}</span>
                                    <span class="duo-pd-price__amt"><i class="fas fa-coins"></i> {{ number_format($level->price_in_points) }} <small>{{ __('inkwave.cd_credits') }}</small></span>
                                </div>
                                <form action="{{ route('single-add-to-cart') }}" method="POST" class="enroll-form">
                                    @csrf
                                    <input type="hidden" name="quant[1]" value="1">
                                    <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                    <input type="hidden" name="price" value="{{ $level->price }}">
                                    <input type="hidden" name="price_jp" value="{{ $level->price_jp }}">
                                    <input type="hidden" name="price_hk" value="{{ $level->price_hk }}">
                                    <input type="hidden" name="level_id" value="{{ $level->id }}">
                                    <button type="submit" class="duo-pd-buybtn enroll-btn"><span>{{ __('inkwave.cd_buy_now') }}</span> <i class="fas fa-shopping-cart"></i></button>
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
