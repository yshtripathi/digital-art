@extends('frontend.layouts.main')
@section('title', __('inkwave.credit_fail_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.credit_fail_title'),
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => __('inkwave.credit_fail_title')]
    ]
])

<style>
/* ==========================================================================
   Art Courses — Order Failed Page
   ========================================================================== */
.ag-page-wrapper, .ag-page-wrapper *, .ag-page-wrapper *::before, .ag-page-wrapper *::after {
    box-sizing: border-box;
}
.ag-page-wrapper {
    padding: 40px 40px;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ag-alert-card {
    background: #ffffff;
    max-width: 600px;
    width: 100%;
    padding: 64px 48px;
    text-align: center;
    box-shadow: 0 30px 60px rgba(0,0,0,0.05);
    border-top: 6px solid #d93025; /* Red warning border */
}
@media (max-width: 768px) {
    .ag-alert-card { padding: 40px 24px; }
}

.ag-alert-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 32px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 32px;
    background: #fce8e6;
    color: #d93025;
}

.ag-alert-title {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 36px;
    color: #000000;
    margin-bottom: 16px;
    line-height: 1.2;
}
.ag-alert-desc {
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 16px;
    color: #555555;
    line-height: 1.6;
    margin-bottom: 40px;
}

/* Help Box */
.ag-alert-help {
    background: #faf8f5;
    border-left: 4px solid #d93025;
    padding: 24px 32px;
    text-align: left;
    margin-bottom: 40px;
}
.ag-alert-help h6 { 
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif); 
    font-size: 20px; 
    margin-bottom: 16px; 
    color: #000000; 
    display: flex;
    align-items: center;
    gap: 8px;
}
.ag-alert-help h6 i { color: #d93025; }
.ag-alert-help ul { list-style: none; padding: 0; margin: 0; }
.ag-alert-help li { 
    font-family: var(--font-arial, Arial, sans-serif); 
    font-size: 14px; 
    margin-bottom: 12px; 
    color: #333333; 
    display: flex; 
    align-items: flex-start; 
    gap: 12px; 
}
.ag-alert-help li i { color: #d93025; margin-top: 4px; font-size: 12px; }

/* Actions */
.ag-alert-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: center;
}
.ag-submit-btn, .ag-ghost-btn {
    padding: 16px 24px;
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1px solid #000000;
}
.ag-submit-btn { background: #000000; color: #ffffff; }
.ag-submit-btn:hover { background: #ffffff; color: #000000; }
.ag-ghost-btn { background: transparent; color: #000000; }
.ag-ghost-btn:hover { background: #f5f5f5; }

/* Footer Note */
.ag-alert-assist {
    margin-top: 40px;
    padding-top: 32px;
    border-top: 1px solid rgba(0,0,0,0.1);
    font-family: var(--font-arial, Arial, sans-serif);
    font-size: 13px;
    color: #888888;
    line-height: 1.6;
}
.ag-alert-assist h6 {
    font-family: var(--font-bodoni-roman, 'Bodoni Moda', serif);
    font-size: 16px;
    color: #000000;
    margin-bottom: 8px;
}
.ag-alert-assist a { 
    color: #bc9c5c; 
    font-weight: bold; 
    text-decoration: underline; 
}
</style>

<div class="ag-page-wrapper">
    <div class="ag-alert-card">
        
        <div class="ag-alert-icon">
            <i class="fas fa-times"></i>
        </div>
        
        <h1 class="ag-alert-title">{{ __('inkwave.credit_fail_heading') }}</h1>
        <p class="ag-alert-desc">{{ __('inkwave.credit_fail_msg') }}</p>

        <div class="ag-alert-help">
            <h6><i class="fas fa-exclamation-triangle"></i> {{ __('inkwave.credit_fail_help_title') }}</h6>
            <ul>
                <li><i class="fas fa-arrow-right"></i> <span>{{ __('inkwave.credit_fail_help_1') }}</span></li>
                <li><i class="fas fa-arrow-right"></i> <span>{{ __('inkwave.credit_fail_help_2') }}</span></li>
                <li><i class="fas fa-arrow-right"></i> <span>{{ __('inkwave.credit_fail_help_3') }}</span></li>
            </ul>
        </div>

        <div class="ag-alert-actions">
            <a href="{{ route('cart') }}" class="ag-submit-btn">
                <i class="fas fa-shopping-cart"></i> {{ __('inkwave.credit_fail_cart') }}
            </a>
            <a href="{{ route('home') }}" class="ag-ghost-btn">
                <i class="fas fa-home"></i> {{ __('inkwave.credit_fail_home') }}
            </a>
        </div>

        <div class="ag-alert-assist">
            <h6>{{ __('inkwave.credit_fail_assist_title') }}</h6>
            <p>
                {{ __('inkwave.credit_fail_assist_msg1') }}
                <a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}">{{ $misc['Company Email'] ?? '[Company Email]' }}</a>
                {{ __('inkwave.credit_fail_assist_msg2') }}
            </p>
        </div>
        
    </div>
</div>

@endsection
