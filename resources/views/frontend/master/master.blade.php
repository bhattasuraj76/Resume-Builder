@include('frontend.include.header')
@include('frontend.include.navbar')
@include('frontend.include.footer')

@yield('header')
<div class="app">
    <div class="navbar">
        @yield('navbar')
    </div>
    <div class="content">
        @yield('content')
    </div>
</div>
@yield('footer')