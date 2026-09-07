@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => $page_data->page_title,
    'links' => [
        ['name' => __('inkwave.top_nav_home'), 'url' => route('home')],
        ['name' => $page_data->page_title]
    ]
])



<div class="ag-page-wrapper">
    <div class="ag-container">
        
        <h1 class="ag-page-title">{{ $page_data->page_title }}</h1>
        
        <div class="ag-page-card">
            <article class="ag-prose">
                {!! $page_data->page_desc !!}
            </article>
        </div>
        
    </div>
</div>

@endsection
