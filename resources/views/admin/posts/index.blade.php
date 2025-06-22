@extends('admin.layouts.master')
@section('title', 'Posts List')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Posts Management</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="#" data-toggle="modal" data-target="#create_post" class="btn btn-primary  float-right">
                    <i class="fas fa-plus"></i> Create
                </a>
            </div>

            {{-- Filter Data --}}
            @include('admin.posts.filter.filter')

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Number Views</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($posts as $index=> $post)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    @if ($post->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->number_of_views }}</td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" title="delete" data-toggle="modal" data-target="#delete_post_{{ $post->id }}"
                                       class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('admin.posts.edit',$post->id) }}" title="edit" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" title="change_status" data-target="#change_status_{{ $post->id }}"
                                       class="btn btn-warning">
                                        @if ($post->status == 'active')
                                            <i class="fas fa-ban"></i>
                                        @else
                                            <i class="fas fa-play"></i>
                                        @endif
                                    </a>
                                    <a href="{{ route('admin.posts.show',$post->id) }}" title="show_post" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            {{-- Delete & changeStatus Popup--}}
                            @include('admin.posts.delete')
                            @include('admin.posts.change_status')

                        @empty
                            <tr>
                                <td colspan="8" class="text-center alert alert-danger">No posts found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
