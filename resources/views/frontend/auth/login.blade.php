@extends('frontend.layouts.master')
@section('title', 'Login')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Login</li>
@endsection

@section('content')
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-header bg-warning text-white text-center rounded-top-3">
                    <h4 class="text-center">Login to Your Account</h4>
                </div>
                <div class="card-body p-4 shadow rounded">
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <a href="{{ route('auth.socialite.redirect','facebook') }}" class="btn btn-primary w-100"
                               style="background:#1877f3;border:none;">
                                <i class="fab fa-facebook-f me-2"></i> Facebook
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('auth.socialite.redirect','google') }}" class="btn btn-outline-danger w-100">
                                <i class="fab fa-google me-2"></i> Google
                            </a>
                        </div>
                    </div>

                    <div class="text-center my-3">
                        <span class="text-muted">or login with email</span>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="login" class="form-label">Email or Username</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="login" name="email"
                                   value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                   required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button type="submit" class="btn btn-warning px-4">Login</button>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                            @endif
                        </div>

                        <div class="text-center">
                            <p class="mb-0">Don't have an account?
                                <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                                    Register here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection