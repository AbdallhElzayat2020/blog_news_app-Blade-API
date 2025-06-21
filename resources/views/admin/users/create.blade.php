@extends('admin.layouts.master')
@section('title', 'Create User')
@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Create User</h1>

        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="row shadow-sm p-3 mb-5 bg-white rounded">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name"
                                   placeholder="Enter name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">User Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" value="{{old('username')}}" name="username"
                                   placeholder="Enter Full Name">
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" value="{{old('phone')}}" name="phone" placeholder="Enter User Phone">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Enter User Email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status">
                                <option value="">-- Select Status --</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Not Active</option>
                            </select>

                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email_verified_at">Email Verified <span class="text-danger">*</span></label>
                            <select class="form-control" name="email_verified_at" id="email_verified_at">
                                <option selected value="">--Select--</option>
                                <option value="active" {{old('email_verified_at') == 'yes' ? 'selected' : ''}}>Yes</option>
                                <option value="inactive" {{old('email_verified_at') == 'no' ? 'selected' : ''}}>No</option>
                            </select>
                            @error('email_verified_at')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" value="{{old('city')}}" name="city" placeholder="Enter City Name">
                            @error('city')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street" value="{{old('street')}}" name="street"
                                   placeholder="Enter Street Name">
                            @error('street')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                   placeholder="Enter Password Confirmation">
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="avatar">Profile Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" value="{{old('country')}}" name="country"
                                   placeholder="Enter Country Name">
                            @error('country')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group ml-2">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection