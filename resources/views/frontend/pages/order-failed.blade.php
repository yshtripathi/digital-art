@extends('frontend.layouts.main')
@section('title', __('inkwave.order_fail_title'))
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => __('inkwave.order_fail_title'),
    'links' => [
        ['name' => __('inkwave.menu_home'), 'url' => route('home')],
        ['name' => __('inkwave.order_fail_title')]
    ]
])

<style>
/* -------------------------------------------
   Duolingo Theme Order Pages
------------------------------------------- */
.duo-order-wrapper {
    background-color: var(--color-paper-white, #ffffff);
    padding-bottom: 100px;
    font-family: 'Nunito', 'Nunito Sans', sans-serif;
}
.duo-container {
    max-width: 600px;
    margin: 64px auto;
    padding: 0 24px;
}
.duo-order-card {
    background: #ffffff;
    border: 2px solid #e5e5e5;
    border-radius: 32px;
    padding: 48px;
    box-shadow: 0 12px 0 #e5e5e5;
    text-align: center;
}
.duo-order-badge {
    width: 96px;
    height: 96px;
    border-radius: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    margin: 0 auto 32px;
    color: #ffffff;
}
.duo-order-badge--err {
    background: #ff4b4b;
    border: 2px solid #d13a3a;
    box-shadow: 0 6px 0 #d13a3a;
}
.duo-order-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin: 0 0 16px 0;
}
.duo-order-sub {
    font-size: 19px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    margin: 0 0 32px 0;
    line-height: 1.5;
}
/* Error help section */
.duo-order-help {
    background: #fff5f5;
    border: 2px solid #ff4b4b;
    border-radius: 24px;
    padding: 24px;
    margin-bottom: 32px;
    text-align: left;
}
.duo-order-help__title {
    font-size: 17px;
    font-weight: 700;
    color: #d13a3a;
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}
.duo-order-help ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.duo-order-help li {
    font-size: 15px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin-bottom: 12px;
    display: flex;
    align-items: flex-start;
    gap: 8px;
}
.duo-order-help li:last-child {
    margin-bottom: 0;
}
.duo-order-help li i {
    color: #ff4b4b;
    margin-top: 4px;
}
/* Actions */
.duo-order-actions {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.duo-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    padding: 20px;
    border-radius: 16px;
    font-size: 19px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.053em;
    cursor: pointer;
    transition: all 0.1s;
    text-decoration: none;
}
.duo-btn--primary {
    background: var(--color-spark-blue, #1cb0f6);
    color: #ffffff;
    border: 2px solid #1899d6;
    box-shadow: 0 6px 0 #1899d6;
}
.duo-btn--primary:active {
    transform: translateY(6px);
    box-shadow: 0 0 0 #1899d6;
}
.duo-btn--ghost {
    background: #ffffff;
    color: var(--color-charcoal, #4b4b4b);
    border: 2px solid #e5e5e5;
    box-shadow: 0 6px 0 #e5e5e5;
}
.duo-btn--ghost:hover {
    background: #f7f7f7;
}
.duo-btn--ghost:active {
    transform: translateY(6px);
    box-shadow: 0 0 0 #e5e5e5;
}
/* Assist */
.duo-order-assist {
    margin-top: 32px;
    padding-top: 32px;
    border-top: 2px solid #e5e5e5;
    text-align: center;
}
.duo-order-assist h6 {
    font-size: 17px;
    font-weight: 700;
    color: var(--color-charcoal, #4b4b4b);
    margin: 0 0 8px 0;
}
.duo-order-assist p {
    font-size: 15px;
    font-weight: 500;
    color: var(--color-pencil-gray, #777777);
    margin: 0;
}
.duo-order-assist a {
    color: var(--color-spark-blue, #1cb0f6);
    font-weight: 700;
    text-decoration: none;
}
</style>

<div class="duo-order-wrapper">
    <div class="duo-container">
        <div class="duo-order-card">
            
            <div class="duo-order-badge duo-order-badge--err">
                <i class="fas fa-times"></i>
            </div>
            
            <h1 class="duo-order-title">{{ __('inkwave.order_fail_heading') }}</h1>
            <p class="duo-order-sub">{{ __('inkwave.order_fail_msg') }}</p>

            <div class="duo-order-help">
                <h6 class="duo-order-help__title"><i class="fas fa-lightbulb"></i> {{ __('inkwave.order_fail_help_title') }}</h6>
                <ul>
                    <li><i class="fas fa-check"></i> <span>{{ __('inkwave.order_fail_help_1') }}</span></li>
                    <li><i class="fas fa-check"></i> <span>{{ __('inkwave.order_fail_help_2') }}</span></li>
                    <li><i class="fas fa-check"></i> <span>{{ __('inkwave.order_fail_help_3') }}</span></li>
                </ul>
            </div>

            <div class="duo-order-actions">
                <a href="{{ route('cart') }}" class="duo-btn duo-btn--primary"><i class="fas fa-shopping-cart"></i> {{ __('inkwave.order_fail_cart') }}</a>
                <a href="{{ route('home') }}" class="duo-btn duo-btn--ghost"><i class="fas fa-home"></i> {{ __('inkwave.order_fail_home') }}</a>
            </div>

            <div class="duo-order-assist">
                <h6>{{ __('inkwave.order_fail_assist_title') }}</h6>
                <p>
                    {{ __('inkwave.order_fail_assist_msg1') }}
                    <a href="mailto:{{ $misc['Company Email'] ?? '[Company Email]' }}">{{ $misc['Company Email'] ?? '[Company Email]' }}</a>
                    {{ __('inkwave.order_fail_assist_msg2') }}
                </p>
            </div>
            
        </div>
    </div>
</div>

@endsection
