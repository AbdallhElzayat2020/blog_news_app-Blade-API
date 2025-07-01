@extends('admin.layouts.master')
@section('title', 'admin List')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">admin Page</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary float-right">Create User</a>
            </div>
            @include('admin.admins.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($admins as $index=> $admin)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->role?->role_name ?? 'No Role' }}</td>
                                <td>
                                    @if ($admin->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $admin->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#delete_admin_{{ $admin->id }}"
                                       class="btn btn-danger mx-1">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#change_status_{{ $admin->id }}" class="btn btn-warning mx-1">
                                        @if ($admin->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('admin.admins.edit',$admin->id) }}" class="btn btn-info mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            {{-- Delete & changeStatus Popup--}}
                            @include('admin.admins.delete')
                            @include('admin.admins.change_status')
                        @empty
                            <tr>
                                <td colspan="8" class="text-center alert alert-danger">No admin found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
