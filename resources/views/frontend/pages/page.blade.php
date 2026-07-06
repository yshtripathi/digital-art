@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

<div class="tl-breadcrumb about-banner pt-60 pb-60">
    <img src="{{ asset('assets/images/breadcrumb.webp') }}" alt="breadcrumb" class="breadcrumb-bg-img">
    <div class="breadcrumb-float-element float-element-1"></div>
    <div class="breadcrumb-float-element float-element-2"></div>
    <div class="breadcrumb-float-element float-element-3"></div>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-6">
                <div class="banner-txt"><h1 class="tl-breadcrumb-title">{{ $page_data->page_title }}</h1></div>
            </div>
            <div class="col-md-6">
                <ul class="tl-breadcrumb-nav d-flex justify-content-md-end">
                    <li><a href="/">{{ __('common.home') }}</a></li>
                    <li class="current-page">
                        <span class="dvdr"><i class="fas fa-chevron-right mx-2"></i></span>
                        <span>{{ $page_data->page_title }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="policy-content-section pt-100 pb-100" style="background: linear-gradient(135deg, #FFF4EE 0%, #FFE5F1 50%, #FFF4EE 100%);">
    <div class="container">
        <div class="row justify-content-center" style="padding-top: 60px; padding-bottom: 60px;">
            <div class="col-xl-10">
                <div class="modern-card p-5 p-md-5 border-0 shadow-lg" style="border-radius: 24px; border: 1.5px solid rgba(232, 93, 142, 0.1); background: rgba(255,255,255,0.6); box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15); animation: slideInUp 0.6s ease-out;">
                    <div class="policy-rich-text">
                        {!! $page_data->page_desc !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .policy-content-section {
        min-height: calc(100vh - 400px);
        position: relative;
        overflow: hidden;
    }

    .policy-content-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, rgba(232, 93, 142, 0.5) 50%, transparent 100%);
        animation: slideRight 1s ease-in-out;
    }

    .policy-content-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, rgba(200, 107, 250, 0.5) 50%, transparent 100%);
        animation: slideLeft 1s ease-in-out;
    }

    .modern-card {
        animation: slideInUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1), float 3s ease-in-out infinite;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        z-index: 1;
    }

    .modern-card:hover {
        box-shadow: 0 40px 100px rgba(232, 93, 142, 0.4) !important;
        border-color: rgba(232, 93, 142, 0.4) !important;
        transform: translateY(-12px);
    }

    .policy-rich-text h1 {
        animation: slideInLeft 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s backwards;
    }

    .policy-rich-text h2, .policy-rich-text h3 {
        animation: fadeInLeft 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.2s backwards;
    }

    .policy-rich-text p {
        animation: fadeIn 0.6s ease-out 0.3s backwards;
    }

    .policy-rich-text {
        font-size: 16px;
        line-height: 1.8;
        color: #666;
    }

    .policy-rich-text h1, .policy-rich-text h2, .policy-rich-text h3 {
        color: #0a0e27;
        font-weight: 800;
        margin-top: 2.5rem;
        margin-bottom: 1.25rem;
        letter-spacing: -0.5px;
    }

    .policy-rich-text h1 {
        border-bottom: 3px solid #E85D8E;
        padding-bottom: 0.75rem;
    }

    .policy-rich-text p {
        margin-bottom: 1.5rem;
    }

    .policy-rich-text ol {
        margin-bottom: 1.5rem !important;
        padding-left: 0 !important;
        list-style: none !important;
        counter-reset: ol-counter !important;
    }

    .policy-rich-text ol > li {
        display: block !important;
        list-style: none !important;
        counter-increment: ol-counter !important;
        margin-bottom: 1.5rem !important;
        color: #666 !important;
    }

    .policy-rich-text ol > li h3 {
        margin-top: 0.5rem !important;
        margin-bottom: 0.75rem !important;
    }

    /* Render the list number as part of the heading so it matches its
       size, weight and color exactly (number was previously tiny). */
    .policy-rich-text ol > li > h3:first-child::before {
        content: counter(ol-counter) ". ";
        color: #0a0e27;
        font-weight: 800;
    }

    .policy-rich-text ul {
        margin: 1rem 0 1.5rem 2rem !important;
        padding-left: 1.5rem !important;
        list-style-type: disc !important;
        list-style-position: outside !important;
    }

    .policy-rich-text ul li {
        display: list-item !important;
        list-style-type: disc !important;
        list-style-position: outside !important;
        margin-bottom: 0.5rem !important;
        color: #666 !important;
    }

    .policy-rich-text ul li::marker {
        color: #E85D8E !important;
    }

    .policy-rich-text li {
        margin-bottom: 0.75rem !important;
        color: #666 !important;
    }

    /* Table Styling */
    .policy-rich-text table {
        width: 100% !important;
        margin: 2.5rem 0 !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border: none !important;
        box-shadow: 0 10px 30px rgba(232, 93, 142, 0.2) !important;
        border-radius: 16px !important;
        overflow: hidden !important;
        background: rgba(255, 255, 255, 0.9) !important;
    }

    .policy-rich-text table thead {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%) !important;
    }

    .policy-rich-text table tr {
        border: none !important;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
    }

    .policy-rich-text table thead tr {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%) !important;
    }

    .policy-rich-text table tbody tr {
        border-bottom: 1px solid rgba(232, 93, 142, 0.1) !important;
    }

    .policy-rich-text table tbody tr:last-child {
        border-bottom: none !important;
    }

    .policy-rich-text table tbody tr:nth-child(odd) {
        background-color: rgba(232, 93, 142, 0.02) !important;
    }

    .policy-rich-text table tbody tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.5) !important;
    }

    .policy-rich-text table tbody tr:hover {
        background-color: rgba(232, 93, 142, 0.1) !important;
        box-shadow: inset 0 0 15px rgba(232, 93, 142, 0.08) !important;
    }

    .policy-rich-text table th {
        background: linear-gradient(135deg, #E85D8E 0%, #C86BFA 100%) !important;
        color: white !important;
        padding: 22px 20px !important;
        font-weight: 700 !important;
        text-align: left !important;
        font-size: 14px !important;
        letter-spacing: 0.5px !important;
        border: none !important;
        text-transform: uppercase !important;
    }

    .policy-rich-text table th:first-child {
        border-radius: 16px 0 0 0 !important;
    }

    .policy-rich-text table th:last-child {
        border-radius: 0 16px 0 0 !important;
    }

    .policy-rich-text table td {
        padding: 24px 20px !important;
        border: none !important;
        color: #0a0e27 !important;
        font-size: 15px !important;
        line-height: 1.6 !important;
    }

    .policy-rich-text table td:first-child {
        font-weight: 600 !important;
        color: #E85D8E !important;
        padding-left: 24px !important;
    }

    .policy-rich-text table strong {
        color: #E85D8E !important;
        font-weight: 700 !important;
        background: rgba(232, 93, 142, 0.1) !important;
        padding: 4px 8px !important;
        border-radius: 6px !important;
    }

    .policy-rich-text table img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 10px !important;
        box-shadow: 0 4px 12px rgba(232, 93, 142, 0.2) !important;
    }

    /* Responsive Table */
    @media (max-width: 768px) {
        .policy-rich-text table {
            font-size: 13px !important;
            margin: 2rem 0 !important;
        }

        .policy-rich-text table th {
            padding: 16px 16px !important;
            font-size: 12px !important;
        }

        .policy-rich-text table td {
            padding: 18px 16px !important;
        }

        .policy-rich-text table td:first-child {
            padding-left: 16px !important;
        }

        .policy-rich-text table {
            display: block !important;
            overflow-x: auto !important;
            white-space: nowrap !important;
        }

        .policy-rich-text table thead {
            display: none !important;
        }

        .policy-rich-text table tbody {
            display: block !important;
        }

        .policy-rich-text table tr {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 1rem !important;
            margin-bottom: 1rem !important;
            padding: 1rem !important;
            border: 1px solid rgba(232, 93, 142, 0.15) !important;
            border-radius: 12px !important;
            background: white !important;
        }

        .policy-rich-text table td {
            display: flex !important;
            flex-direction: column !important;
            border: none !important;
            padding: 0 !important;
        }

        .policy-rich-text table td::before {
            content: attr(data-label) !important;
            font-weight: 700 !important;
            color: #E85D8E !important;
            margin-bottom: 0.5rem !important;
            font-size: 12px !important;
            text-transform: uppercase !important;
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideRight {
        from {
            opacity: 0;
            transform: translateX(-100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideLeft {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
        }
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes glow {
        0%, 100% {
            box-shadow: 0 20px 50px rgba(232, 93, 142, 0.15);
        }
        50% {
            box-shadow: 0 30px 80px rgba(232, 93, 142, 0.35);
        }
    }

    @media (max-width: 768px) {
        .policy-content-section {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

        .modern-card {
            padding: 25px !important;
        }

        .policy-rich-text {
            font-size: 14px;
        }

        .policy-rich-text h1, .policy-rich-text h2, .policy-rich-text h3 {
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            font-size: 18px;
        }

        .policy-rich-text table {
            font-size: 13px !important;
        }

        .policy-rich-text table td {
            padding: 12px 15px !important;
        }

        .policy-rich-text table th {
            padding: 12px 15px !important;
        }
    }
</style>
@endpush


