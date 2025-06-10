@extends('frontend.layouts.master')
@section('title','Setting Page')
@push('header_meta')
    <link rel="canonical" href="{{ url()->full() }}"/>
@endpush
@push('css')
    <style>
        .dashboard {
            display: flex;
            padding: 20px;
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .dashboard-sidebar {
            flex: 0 0 250px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info img {
            border: 3px solid #ff6f61;
        }

        .profile-sidebar-menu .list-group-item {
            border: none;
            padding: 10px 15px;
            margin-bottom: 5px;
            border-radius: 4px;
            transition: all 0.3s;
        }

        .profile-sidebar-menu .list-group-item:hover {
            background-color: #ff6f61;
            color: white;
        }

        .profile-sidebar-menu .list-group-item.active {
            background-color: #ff6f61;
            border-color: #ff6f61;
        }

        .profile-sidebar-menu .list-group-item i {
            margin-right: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #ddd;
            padding: 8px 15px;
        }

        .save-settings-btn,
        .change-password-btn {
            background: #ff6f61;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .save-settings-btn:hover,
        .change-password-btn:hover {
            background: #ff5c4d;
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }

            .dashboard-sidebar {
                flex: 0 0 auto;
                margin-bottom: 20px;
            }
        }
    </style>
@endpush
@section('content')
    <!-- Dashboard Start-->
    <br>
    <br>

    <!-- Dashboard Start-->

    <!-- Settings Content Start -->
    <div class="container mt-4">
        <div class="dashboard">
            <!-- Sidebar -->
            @include('frontend.dashboard._sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <h2>Settings</h2>
                <form class="settings-form" action="{{ route('frontend.dashboard.settings.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input name="name" type="text" id="name" value="{{old('name',$user->name)}}" placeholder="Enter your Name"/>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input name="username" type="text" id="username" value="{{old('username',$user->username)}}"
                               placeholder="Enter your username"/>
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input name="email" type="email" id="email" value="{{old('email',$user->email)}}" placeholder="Enter Your Email"/>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="profile-image">Profile Image:</label>
                        <input name="avatar" type="file" id="profile-image" accept="image/*"/>
                        @error('avatar')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input name="country" type="text" id="country" value="{{old('country',$user->country)}}" placeholder="Enter Your country"/>
                        @error('country')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input name="city" type="text" id="city" value="{{old('city',$user->city)}}" placeholder="Enter your city"/>
                        @error('city')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input name="phone" type="text" id="phone" value="{{old('phone',$user->phone)}}" placeholder="Enter your Phone"/>
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="save-settings-btn">Save Changes</button>
                </form>

                <hr class="my-4"/>

                <form action="{{ route('frontend.dashboard.settings.change-password') }}" method="post" class="change-password-form">
                    @csrf
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <input type="password" name="current_password" id="current-password" placeholder="Enter Current Password"/>
                        @error('current_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input type="password" name="password" id="new-password" placeholder="Enter New Password"/>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input type="password" name="password_confirmation" id="confirm-password" placeholder="Enter Confirm New Password"/>
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="change-password-btn">Change Password</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Settings Content End -->
    <!-- Dashboard End-->

    <br>
    <br>
    <!-- Dashboard End-->
@endsection
