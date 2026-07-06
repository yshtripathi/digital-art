@extends('frontend.layouts.main')
@section('main-content')
@section('title', $page_data->page_title)

<div class="tl-breadcrumb pt-60 pb-60">
	<!-- Video Background -->
	<video autoplay muted loop playsinline>
		<source src="{{ asset('images/breadcrumb.mp4') }}" type="video/mp4">
	</video>
	<!-- Animated bubble elements -->
	<div class="breadcrumb-float-element float-element-1"></div>
	<div class="breadcrumb-float-element float-element-2"></div>
	<div class="breadcrumb-float-element float-element-3"></div>

	<div class="container">
		<div class="row align-items-end">
			<div class="col-md-6">
				<div class="banner-txt">~
					<h1 class="tl-breadcrumb-title">{{ $page_data->page_title }}</h1>
				</div>
			</div>~
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

<section class="term-cntnt section-space" style="position: relative; overflow: hidden;">
	<!-- Decorative Blobs -->
	<div class="modern-blob modern-blob-1" style="top: -100px; left: -100px; width: 400px; height: 400px; background: rgba(21, 145, 220, 0.08);"></div>
	<div class="modern-blob modern-blob-2" style="bottom: -100px; right: -100px; width: 400px; height: 400px; background: rgba(75, 184, 250, 0.08);"></div>

	<div class="container position-relative">
		<div class="row justify-content-center">
			<div class="col-xl-8 col-lg-10">
				<div class="modern-card shadow-xl overflow-hidden" style="background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-radius: 20px; border: 1px solid rgba(0, 0, 0, 0.05);">
					<!-- Header Section -->
					<div class="p-5 text-center" style="background: linear-gradient(135deg, rgba(21, 145, 220, 0.1) 0%, rgba(75, 184, 250, 0.05) 100%); border-bottom: 1px solid rgba(21, 145, 220, 0.1);">
						<h2 class="fw-bold mb-0" style="font-size: 28px; color: var(--primary);">{{ $page_data->page_title }}</h2>
					</div>

					<!-- Content Section -->
					<div class="page-cntnt p-5" style="line-height: 1.8; color: #555;">
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
	.modern-card {
		transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
		animation: slideInUp 0.6s ease-out;
	}

	.modern-card:hover {
		transform: translateY(-8px);
		box-shadow: 0 20px 60px rgba(21, 145, 220, 0.15) !important;
	}

	.page-cntnt {
		font-size: 15px;
	}

	.page-cntnt h1,
	.page-cntnt h2,
	.page-cntnt h3,
	.page-cntnt h4,
	.page-cntnt h5,
	.page-cntnt h6 {
		color: var(--text-dark);
		font-weight: 700;
		margin-top: 24px;
		margin-bottom: 16px;
	}

	.page-cntnt h1 {
		font-size: 32px;
	}

	.page-cntnt h2 {
		font-size: 28px;
	}

	.page-cntnt h3 {
		font-size: 24px;
	}

	.page-cntnt h4 {
		font-size: 20px;
	}

	.page-cntnt p {
		margin-bottom: 16px;
	}

	.page-cntnt ul,
	.page-cntnt ol {
		margin-bottom: 16px;
		padding-left: 24px;
	}

	.page-cntnt li {
		margin-bottom: 8px;
	}

	.page-cntnt a {
		color: var(--primary);
		text-decoration: none;
		font-weight: 500;
		transition: all 300ms ease;
	}

	.page-cntnt a:hover {
		text-decoration: underline;
		color: var(--primary-dark);
	}

	.page-cntnt strong {
		font-weight: 700;
		color: var(--text-dark);
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

	.modern-blob {
		border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
		animation: blob-animation 7s infinite;
	}

	@keyframes blob-animation {
		0%, 100% { transform: translate(0, 0) scale(1); }
		33% { transform: translate(30px, -50px) scale(1.1); }
		66% { transform: translate(-20px, 20px) scale(0.9); }
	}

	/* Mobile Responsive */
	@media (max-width: 768px) {
		.modern-card {
			border-radius: 16px;
		}

		.page-cntnt {
			padding: 24px !important;
		}

		.page-cntnt h1 {
			font-size: 24px;
		}

		.page-cntnt h2 {
			font-size: 22px;
		}

		.page-cntnt h3 {
			font-size: 20px;
		}

		.page-cntnt h4 {
			font-size: 18px;
		}

		.page-cntnt {
			font-size: 14px;
		}
	}
</style>
@endpush
