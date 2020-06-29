@extends('client.layouts.master')
@section('loginPage', 'active')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h4 class="card-title mb-4 mt-1 text-center text-info">Sign in</h4>
                <p>
                    <a href="{{  url('/login/gmail')}}" class="btn btn-block btn-outline-info"> <i class="fab fa-twitter"></i>   Login via Gmail</a>
                    <a href="{{ url('/login/facebook') }}" class="btn btn-block btn-outline-primary"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
                </p>
                <hr>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email" id="email">

                        @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter password" id="pwd">
                        @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}> Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <p class="text-center text-info"> Don't have an account yet? </p>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary">Create an account</a>
            </div>
        </div>
    </div>
</div>
@endsection