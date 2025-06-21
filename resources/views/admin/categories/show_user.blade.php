@extends('admin.layouts.master')
@section('title', 'Show User')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800 border-bottom pb-2">Show User Details</h1>

        <div class="card shadow">
            <div class="card-body">
                <div class="row p-4 bg-white rounded">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="name">Name<span class="text-danger">*</span></label>
                            <input disabled type="text" class="form-control bg-light" id="name" value="{{old('name',$user->name)}}">
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="username">User Name<span class="text-danger">*</span></label>
                            <input disabled type="text" class="form-control bg-light" id="username" value="{{old('username',$user->username)}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="phone">Phone <span class="text-danger">*</span></label>
                            <input disabled type="tel" class="form-control bg-light" id="phone" value="{{old('phone',$user->phone)}}">
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="email">Email <span class="text-danger">*</span></label>
                            <input disabled type="text" class="form-control bg-light" id="email" value="{{old('email',$user->email)}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="status">Status <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light" disabled value="{{$user->status}}">
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="email_verified_at">Email Verified <span
                                        class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light" disabled
                                   value="{{$user->email_verified_at == null ? 'Not Verified' : 'Verified'}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="city">City</label>
                            <input disabled type="text" class="form-control bg-light" id="city" value="{{old('city', $user->city)}}">
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="street">Street</label>
                            <input disabled type="text" class="form-control bg-light" name="street" id="street"
                                   value="{{old('street',$user->street)}}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary" for="country">Country</label>
                            <input disabled type="text" class="form-control bg-light" id="country" value="{{old('country',$user->country)}}">
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-primary">Profile Image</label>
                            <div class="mt-2">
                                <img class="img-thumbnail rounded-circle shadow-sm" style="width: 200px; height: 200px; object-fit: cover"
                                     src="{{asset($user->avatar)}}" alt="{{$user->name}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 border-top pt-4">
                    <a href="#" data-toggle="modal" data-target="#change_status_{{ $user->id }}" class="btn btn-warning">
                        @if ($user->status == 'active')
                            <i class="fas fa-ban"></i> Deactivate
                        @else
                            <i class="fas fa-play"></i> Activate
                        @endif
                    </a>

                    <a href="#" data-toggle="modal" data-target="#delete_user_{{$user->id}}" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Delete</span>
                    </a>
                </div>
            </div>
        </div>
        @include('admin.users.delete')
        @include('admin.users.change_status')
    </div>
@endsection