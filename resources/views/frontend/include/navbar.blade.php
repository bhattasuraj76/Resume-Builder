@section('navbar')
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="{{asset('public/img/logo.png')}}" width="30" height="30" class="d-inline-block align-top" alt="Logo" loading="lazy">
        Resume Builder
    </a>
    <div class="menu">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Register</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
    </div>
</nav>
@endsection