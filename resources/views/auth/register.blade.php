@extends('client.layouts.master')
@section('registerPage', 'active')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h4 class="card-title mb-4 mt-1 text-center text-info">Sign Up</h4>
                <p>
                    <a href="{{ url('/login/gmail') }}" class="btn btn-block btn-outline-info"> <i class="fab fa-twitter"></i>   Signup via Gmail</a>
                    <a href="{{ url('/login/facebook') }}" class="btn btn-block btn-outline-primary"> <i class="fab fa-facebook-f"></i>   Signup via facebook</a>
                </p>
                <hr>
                <form action="{{ route('register') }}" method="POST">
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
                    <div class="form-group">
                        <label for="confirm_pwd">Password:</label>
                        <input type="password" class="form-control" name="password_confirmation" required placeholder="Re-enter password" id="confirm_pwd">
                        @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <p class="text-center text-info"> Already have an account? </p>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Sign In</a>
            </div>
        </div>
    </div>
</div>
@endsection