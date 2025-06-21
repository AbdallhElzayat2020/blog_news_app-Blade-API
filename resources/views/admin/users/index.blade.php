@extends('admin.layouts.master')
@section('title', 'Users List')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users Page</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Create User</a>
            </div>
            @include('admin.users.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($users as $index=> $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $user->country }}</td>
                                <td>{{ $user->phone ?? 'No Phone' }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#delete_user_{{ $user->id }}"
                                       class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#change_status_{{ $user->id }}" class="btn btn-warning">
                                        @if ($user->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('admin.users.show',$user->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            {{-- Delete & changeStatus Popup--}}
                            @include('admin.users.delete')
                            @include('admin.users.change_status')
                        @empty
                            <tr>
                                <td colspan="8" class="text-center alert alert-danger">No users found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
