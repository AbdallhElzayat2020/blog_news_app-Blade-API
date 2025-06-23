@extends('admin.layouts.master')
@section('title', 'Create Post')
@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-2 text-gray-800">Create Post</h1>
        </div>
        @if(session()->has('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach(session('errors')->all() as $error)
                        <li class="text-black">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row shadow-sm p-3 mb-5 bg-white rounded">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" value="{{old('title')}}" name="title"
                                   placeholder="Enter title">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description<span class="text-danger">*</span></label>
                            <textarea id="postContent" class="form-control" placeholder="Enter Description" name="description" cols="30"
                                      rows="10">{{ old('description') }}</textarea>

                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Yes</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="meta_description">Meta Description<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="meta_description" value="{{old('meta_description')}}" name="meta_description"
                                   placeholder="Enter meta_description">
                            @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="meta_title">Meta Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="meta_title" value="{{old('meta_title')}}" name="meta_title"
                                   placeholder="Enter meta_title">
                            @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="comment_able">Enable Comments<span class="text-danger">*</span></label>
                            <select class="form-control" name="comment_able" id="comment_able">
                                <option value="yes" {{ old('comment_able') == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ old('comment_able') == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('comment_able')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""><strong>Post Image</strong><span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="images[]" id="postImage" multiple accept="image/*">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group ml-2">
                            <button type="submit" class="btn btn-primary">Create Post</button>
                        </div>
                    </div>

                </div>

            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {

            // Summernote initialization
            $('#postContent').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            // file input initialization
            $('#postImage').fileinput({
                theme: 'fa5',
                allowFileTypes: ['jpg', 'png', 'jpeg'],
                maxFileCount: 4,
                enableResumableUpload: false,
                showUpload: false,
            });

        });
    </script>

    {{--    <script>--}}
    {{--        $(function () {--}}
    {{--            $('#postImage').fileinput({--}}
    {{--                theme: 'fa5',--}}
    {{--                allowFileTypes: ['jpg', 'png', 'jpeg'],--}}
    {{--                maxFileCount: 4,--}}
    {{--                enableResumableUpload: false,--}}
    {{--                showUpload: false,--}}
    {{--            });--}}

    {{--            $('#postContent').summernote({--}}
    {{--                height: 300,--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}

@endpush