@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

<x-breadcrumb :title="$page_data->page_title" />

<section class="page-section">
    <div class="page-container">
        <div class="page-card">
            <article class="page-prose">
                {!! $page_data->page_desc !!}
            </article>
        </div>
    </div>
</section>

@endsection


