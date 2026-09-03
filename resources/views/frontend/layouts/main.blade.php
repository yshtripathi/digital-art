
@include('frontend.layouts.head')
@include('frontend.layouts.header')
@include('user.layouts.notification')
@yield('main-content')
@include('frontend.layouts.footer')
@stack('styles')
@stack('scripts')