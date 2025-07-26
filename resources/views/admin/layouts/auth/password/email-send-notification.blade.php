@extends('admin.layouts.auth.master')
@section('title', 'Password Reset Notification')

@section('content')
    <div class="row justify-content-center align-items-center" style="min-height: 100vh!important;">

        <div class="col-xl-6 col-lg-6 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Enter Verification Code OTP</h1>
                                </div>
                                <form class="user" method="post" action="{{ route('admin.password.verify-otp-form') }}">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <input hidden type="email" name="email" value="{{ $email }}"
                                            class="form-control form-control-user" id="exampleInputEmail"
                                            aria-describedby="emailHelp">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="otp" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter OTP From your email...">
                                        @error('otp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Send
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('admin.password.forgot-password') }}">Forgot
                                        Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
