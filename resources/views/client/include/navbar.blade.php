@section('navbar')
<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('public/img/logo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="Logo" loading="lazy">
            Resume Builder
        </a>

        <ul class="navbar-nav flex-row">
            @guest
            <li class="nav-item">
                <a class="nav-link @yield('loginPage')" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item mx-3">
                <a class="nav-link @yield('registerPage')" href="{{ route('register') }}">Register</a>
            </li>
            @else
            <li class="nav-item mx-3">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endguest
    </div>
</nav>
@endsection