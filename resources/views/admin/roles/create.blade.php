@extends('admin.layouts.master')
@section('title', 'Create Role')
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

        textarea.form-control {
            height: auto;
            min-height: 100px;
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

        /* Permissions Section */
        .permissions-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e3e6f0;
        }

        .permissions-section h3 {
            color: #5a5c69;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .permissions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .permission-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            background: #f8f9fc;
            border-radius: 0.35rem;
            transition: all 0.15s ease-in-out;
        }

        .permission-item:hover {
            background: #eaecf4;
        }

        .permission-item input[type="checkbox"] {
            margin-right: 0.75rem;
        }

        .permission-item label {
            margin: 0;
            font-size: 0.9rem;
            color: #5a5c69;
            cursor: pointer;
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

        /* Required Field Indicator */
        .required-field::after {
            content: '*';
            color: #e74a3b;
            margin-left: 0.25rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }

            .form-card .card-body {
                padding: 1rem;
            }

            .permissions-grid {
                grid-template-columns: 1fr;
            }

            .submit-btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>

        <div class="page-header">
            <h1><i class="fas fa-user-tag mr-2"></i>Create New Role</h1>
        </div>

        <form action="{{ route('admin.roles.store') }}" method="post">
            @csrf
            <div class="form-card">
                <div class="card-body">
                    <!-- Basic Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role_name" class="required-field">Role Name</label>
                                <input type="text"
                                       required
                                       class="form-control @error('role_name') is-invalid @enderror"
                                       id="role_name"
                                       name="role_name"
                                       value="{{ old('role_name') }}"
                                       placeholder="Enter role name">
                                @error('role_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="required-field">Status</label>
                                <select required class="form-control @error('status') is-invalid @enderror"
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
                    </div>

                    <!-- Permissions Section -->
                    <div class="permissions-section">
                        <h3>Permissions <span class="text-danger">*</span></h3>
                        <div class="permissions-grid">
                            @foreach(config('permissions.permissions') as $key => $value)
                                <div class="permission-item">
                                    {{-- Accessors from Model for json_decode  --}}
                                    <input type="checkbox"
                                           id="permission_{{ $key }}"
                                           name="permissions[]"
                                           value="{{ $key }}"
                                           {{ in_array($key, old('permissions', [])) ? 'checked' : '' }}
                                           class="@error('permissions') is-invalid @enderror">
                                    <label for="permission_{{ $key }}">
                                        {{ $value }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mt-4">
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-save"></i>
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection