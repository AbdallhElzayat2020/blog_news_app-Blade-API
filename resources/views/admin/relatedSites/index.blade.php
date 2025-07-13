@extends('admin.layouts.master')
@section('title', 'Related Sites Management')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Related Sites Management</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="#" data-toggle="modal" data-target="#create_site" class="btn btn-primary  float-right">
                    <i class="fas fa-plus"></i> Create
                </a>
            </div>

            {{-- Filter Data --}}
            @include('admin.relatedSites.filter.filter')

            {{-- Create Popup --}}
            @include('admin.relatedSites.create')

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>URL</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($relatedSites as $index=> $site)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $site->name }}</td>
                                <td>{{ $site->url }}</td>

                                <td>{{ $site->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#delete_site_{{ $site->id }}"
                                       class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#edit_site_{{$site->id}}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            {{-- Delete & changeStatus & Edit Popup--}}
                            @include('admin.relatedSites.delete')
                            @include('admin.relatedSites.edit')

                        @empty
                            <tr>
                                <td colspan="8" class="text-center alert alert-danger">No related-sites found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $relatedSites->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
