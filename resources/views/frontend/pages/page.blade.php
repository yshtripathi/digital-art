@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => $page_data->page_title,
    'links' => [
        ['name' => __('inkwave.nav_home'), 'url' => route('home')],
        ['name' => $page_data->page_title]
    ]
])



<div class="duo-page-wrapper">
    <div class="duo-container">
        <div class="duo-page-card">
            <article class="duo-prose">
                {!! $page_data->page_desc !!}
            </article>
        </div>
    </div>
</div>

@endsection
