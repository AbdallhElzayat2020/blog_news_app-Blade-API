@extends('admin.layouts.master')
@section('title', 'Categories List')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Categories Management</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="#" data-toggle="modal" data-target="#create_category" class="btn btn-primary  float-right">
                    <i class="fas fa-plus"></i> Create
                </a>
            </div>
            @include('admin.categories.filter.filter')
            @include('admin.categories.create')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Posts Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($categories as $index=> $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($category->icon)
                                        <img style="width: 50px; height: 50px; border-radius: 50%" src="{{ asset($category->icon) }}"
                                             alt="{{$category->name}}">
                                    @else
                                        <img style="width: 50px; height: 50px; border-radius: 50%" src="{{ asset('default/defeult.png') }}"
                                             alt="default">
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if ($category->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $category->posts_count }}</td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#delete_category_{{ $category->id }}"
                                       class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#edit_category_{{$category->id}}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#change_status_{{ $category->id }}" class="btn btn-warning">
                                        @if ($category->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('admin.categories.show',$category->id) }}" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            {{-- Delete & changeStatus Popup--}}
                            @include('admin.categories.delete')
                            @include('admin.categories.edit')
                            @include('admin.categories.change_status')
                        @empty
                            <tr>
                                <td colspan="8" class="text-center alert alert-danger">No categories found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
