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
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary float-right">Create User</a>
            </div>
            @include('admin.roles.filter.filter')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Permissions</th>
                            <th>Related Admins</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($roles as $index=> $role)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $role->role_name }}</td>
                                <td>
                                    @if ($role->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    {{--  from Accessors in Model  --}}
                                    @foreach($role->permissions as $key => $value)
                                        <span class="badge badge-info">{{ $value }}</span>
                                    @endforeach
                                </td>
                                <td>{{$role->admins->count()}}</td>
                                <td>{{ $role->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#delete_role_{{ $role->id }}"
                                       class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('admin.roles.edit',$role->id) }}"
                                            class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#change_status_{{ $role->id }}" class="btn btn-warning">
                                        @if ($role->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            {{-- Delete & changeStatus Popup--}}
                            @include('admin.roles.delete')
                            @include('admin.roles.change_status')
                        @empty
                            <tr>
                                <td colspan="6" class="text-center alert alert-danger">No Roles found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
