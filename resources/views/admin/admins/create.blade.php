@extends('admin.layouts.master')
@section('title', 'Create Admin')
@push('css')
    <style>
        /* General Styles */
        .container-fluid {
            padding: 1.5rem;
            background: #fff;
        }

        /* Back Button */
        .back-btn {
            display: inline-flex;
            align-items: center;
            color: #5a5c69;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: color 0.15s ease-in-out;
        }

        .back-btn i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        .back-btn:hover {
            color: #4e73df;
            text-decoration: none;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid #e3e6f0;
            padding-bottom: 1rem;
        }

        .page-header h1 {
            color: #5a5c69;
            font-weight: 600;
            font-size: 1.5rem;
            margin: 0;
        }

        /* Form Card */
        .form-card {
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.5rem;
        }

        .form-card .card-body {
            padding: 1.5rem;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            color: #5a5c69;
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
        }

        .form-group .text-danger {
            font-size: 0.85rem;
            color: #e74a3b;
            margin-top: 0.25rem;
            display: block;
        }

        /* Form Controls */
        .form-control {
            height: 2.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out;
            background-color: #fff;
        }

        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1);
        }

        .form-control::placeholder {
            color: #b7b9cc;
        }

        /* Select Control */
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235a5c69' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 0.875rem;
            padding-right: 2.5rem;
        }

        /* Password Input Group */
        .password-input-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #858796;
            cursor: pointer;
            padding: 0;
            font-size: 1rem;
            transition: color 0.15s ease-in-out;
        }

        .password-toggle:hover {
            color: #4e73df;
        }

        .password-toggle:focus {
            outline: none;
        }

        .password-input-group .form-control {
            padding-right: 2.5rem;
        }

        /* Required Field Indicator */
        .required-field::after {
            content: '*';
            color: #e74a3b;
            margin-left: 0.25rem;
        }

        /* Form Row */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: -0.75rem;
        }

        .form-col {
            padding: 0.75rem;
            flex: 0 0 50%;
            max-width: 50%;
        }

        /* Submit Button */
        .submit-btn {
            padding: 0.75rem 2rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #fff;
            background: #4e73df;
            border: none;
            border-radius: 0.35rem;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 200px;
        }

        .submit-btn:hover {
            background: #2e59d9;
        }

        .submit-btn i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }

            .form-card .card-body {
                padding: 1rem;
            }

            .form-col {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .submit-btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
            Back to Admins
        </a>

        <div class="page-header">
            <h1><i class="fas fa-user-shield mr-2"></i>Create New Admin</h1>
        </div>

        <form action="{{ route('admin.admins.store') }}" method="post">
            @csrf
            <div class="form-card">
                <div class="card-body">
                    <div class="form-row">
                        <!-- Name Field -->
                        <div class="form-col">
                            <div class="form-group">
                                <label for="name" class="required-field">Name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Enter admin name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="form-col">
                            <div class="form-group">
                                <label for="email" class="required-field">Email</label>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       placeholder="Enter email address">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Username Field -->
                        <div class="form-col">
                            <div class="form-group">
                                <label for="username" class="required-field">Username</label>
                                <input type="text"
                                       class="form-control @error('username') is-invalid @enderror"
                                       id="username"
                                       name="username"
                                       value="{{ old('username') }}"
                                       placeholder="Enter username">
                                @error('username')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-col">
                            <div class="form-group">
                                <label for="password" class="required-field">Password</label>
                                <div class="password-input-group">
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="Enter password">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div class="form-col">
                            <div class="form-group">
                                <label for="password_confirmation" class="required-field">Confirm Password</label>
                                <div class="password-input-group">
                                    <input type="password"
                                           class="form-control"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Confirm password">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="form-col">
                            <div class="form-group">
                                <label for="status" class="required-field">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror"
                                        name="status"
                                        id="status">
                                    <option value="">Select Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

{{--                        <div class="form-col">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="role_id" class="required-field">Select Role</label>--}}
{{--                                <select class="form-control @error('role_id') is-invalid @enderror"--}}
{{--                                        name="role_id"--}}
{{--                                        id="role_id">--}}
{{--                                    <option value="">Select Role</option>--}}
{{--                                    @forelse($roles as $role)--}}
{{--                                        <option value="{{$role->id}}">{{$role->role_name}}</option>--}}
{{--                                    @empty--}}
{{--                                        <option value="" disabled selected> No Roles</option>--}}
{{--                                    @endforelse--}}
{{--                                </select>--}}
{{--                                @error('role_id')--}}
{{--                                <span class="text-danger">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

                    </div>

                    <!-- Submit Button -->
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-user-plus"></i>
                            Create Admin
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        // Toggle Password Visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endpush