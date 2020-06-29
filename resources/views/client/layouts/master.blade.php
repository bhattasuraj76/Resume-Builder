@include('client.include.header')
@include('client.include.navbar')
@include('client.include.footer')

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