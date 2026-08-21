
@include('frontend.layouts.head')
@include('frontend.layouts.header')
@include('components.alert')
@yield('main-content')
@include('frontend.layouts.footer')
@stack('styles')
@stack('scripts')