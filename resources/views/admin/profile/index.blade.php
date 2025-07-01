@extends('admin.layouts.master')
@section('title', 'Admin Profile')
@push('css')
    <style>
        .profile-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .profile-card .card-header {
            background: #f8f9fc;
            border-bottom: 2px solid #4e73df;
            padding: 1rem;
        }

        .profile-card .card-header h6 {
            color: #4e73df;
            font-weight: 600;
            margin: 0;
        }

        .profile-card .card-body {
            padding: 1.5rem;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4e73df;
            margin-bottom: 1rem;
        }

        .profile-info {
            margin-bottom: 1.5rem;
        }

        .profile-info label {
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            color: #858796;
            margin-bottom: 0;
        }

        .role-badge {
            background: #4e73df;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .permission-badge {
            background: #1cc88a;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            margin: 0.25rem;
            display: inline-block;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            background-color: #4e73df;
            color: white;
            border: none;
        }

        .btn-save {
            padding: 0.5rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .status-badge.active {
            background: #1cc88a;
            color: white;
        }

        .status-badge.inactive {
            background: #e74a3b;
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profile</h1>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <script>
                setTimeout(function () {
                    $('#successAlert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <script>
                setTimeout(function () {
                    $('#errorAlert').fadeOut('slow');
                }, 3000);
            </script>
        @endif

        <div class="row">
            <!-- Profile Information -->
            <div class="col-lg-4">
                <div class="card profile-card">
                    <div class="card-header">
                        <h6><i class="fas fa-user mr-2"></i>Profile Information</h6>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="mb-2">UserName: {{ auth()->guard('admin')->user()->name }}</h4>
                        <div class="role-badge">
                            {{ auth()->guard('admin')->user()->role->role_name ?? 'No Role Assigned' }}
                        </div>
                    </div>
                </div>

                <!-- Role & Permissions -->
                <div class="card profile-card">
                    <div class="card-header">
                        <h6><i class="fas fa-shield-alt mr-2"></i>Role & Permissions</h6>
                    </div>
                    <div class="card-body">
                        @if(auth()->guard('admin')->user()->role)
                            <div class="profile-info">
                                <label>Role Name</label>
                                <p>{{ auth()->guard('admin')->user()->role->role_name }}</p>
                            </div>
                        @else
                            <p class="text-muted">No role assigned</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Update Profile Form -->
            <div class="col-lg-8">
                <div class="card profile-card">
                    <div class="card-header">
                        <h6><i class="fas fa-edit mr-2"></i>Update Profile</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="post" id="profileForm">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                   id="name" name="name"
                                                   value="{{ old('name', auth()->guard('admin')->user()->name) }}">
                                        </div>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-at"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                                   id="username" name="username"
                                                   value="{{ old('username', auth()->guard('admin')->user()->username) }}">
                                        </div>
                                        @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                   id="email" name="email"
                                                   value="{{ old('email', auth()->guard('admin')->user()->email) }}">
                                        </div>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password"> Password</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            </div>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                   id="password" name="password">
                                        </div>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">


                            <div class="form-group text-left mt-4">
                                <button type="submit" class="btn btn-primary btn-save">
                                    <i class="fas fa-save mr-2"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function () {
                // Show loading state on form submit
                $('#profileForm').on('submit', function () {
                    const submitBtn = $(this).find('button[type="submit"]');
                    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
                });
            });
        </script>
    @endpush
@endsection