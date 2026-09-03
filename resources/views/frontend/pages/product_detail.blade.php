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
