@include('front.include.header')
@include('front.include.navbar')
@include('front.include.footer')

@yield('header')
<div class="app">
    <div class="navbar__content">
        @yield('navbar')
    </div>
    <div class="main__content">
        @yield('content')
    </div>
</div>
@yield('footer')