@extends('frontend.layouts.main')
@section('title', $page_data->page_title)
@section('main-content')

@include('frontend.layouts.breadcrumb', [
    'title' => $page_data->page_title,
    'links' => [
        ['name' => __('frontend.breadcrumb.home'), 'url' => route('home')],
        ['name' => $page_data->page_title]
    ]
])

{{-- ==========================================================================
     Static page
     Raw HTML from the database, nothing else. Every tag the editor saves is
     styled by plain tag rules, so no wrappers or scripts are needed here.
     Styles: public/css/theme.css — section 21
     ========================================================================== --}}
<section class="pg">
    <div class="pg__wrap">
        <div class="pg-sheet">
            <article class="pg-prose">
                {!! $page_data->page_desc !!}
            </article>
        </div>
    </div>
</section>

@endsection
