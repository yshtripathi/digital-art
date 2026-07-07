@extends('frontend.layouts.main')
@section('title', $title ?? 'Error')

@section('main-content')
<style>
    .error-page-wrapper {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--color-canvas, #fdfbf7);
        padding: 60px 20px;
    }
    .error-card {
        max-width: 600px;
        text-align: center;
        background: #ffffff;
        padding: 70px 50px;
        border-radius: 24px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.06);
        border: 1px solid var(--color-vellum, #dfdcd5);
    }
    .error-code {
        font-family: var(--font-davinci, serif);
        font-size: 130px;
        line-height: 1;
        font-weight: 700;
        margin-bottom: 24px;
        background: linear-gradient(135deg, var(--color-ink, #000) 0%, #555 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .error-title {
        font-family: var(--font-davinci, serif);
        font-size: 36px;
        color: var(--color-ink, #000000);
        margin-bottom: 16px;
    }
    .error-desc {
        font-family: var(--font-helvetica-now, sans-serif);
        font-size: 16px;
        color: var(--color-graphite, #595855);
        line-height: 1.6;
        margin-bottom: 40px;
    }
    .error-actions {
        display: flex;
        justify-content: center;
        gap: 16px;
    }
    .btn-error-home {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        background-color: var(--color-ink, #000);
        color: #fff;
        text-decoration: none;
        font-family: var(--font-helvetica-now, sans-serif);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 13px;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .btn-error-home:hover {
        background-color: var(--color-graphite, #595855);
        color: #fff;
        transform: translateY(-2px);
    }
    @media (max-width: 600px) {
        .error-code { font-size: 80px; }
        .error-title { font-size: 26px; }
        .error-card { padding: 40px 20px; }
    }
</style>

<div class="error-page-wrapper">
    <div class="error-card">
        <div class="error-code">@yield('code', 'Error')</div>
        <h2 class="error-title">@yield('message', 'An Error Occurred')</h2>
        <p class="error-desc">@yield('description', 'Something went wrong. Please try again or return to the homepage.')</p>
        <div class="error-actions">
            <a href="{{ route('home') }}" class="btn-error-home"><i class="fas fa-home"></i> Return to Gallery</a>
        </div>
    </div>
</div>
@endsection
