@extends('frontend.layouts.master')
@section('title', 'Edit Post')
@section('content')

    <br>
    <div class="dashboard container my-5">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar')
        <!-- Sidebar -->

        <!-- Main Content -->
        <div class="main-content col-md-9">
            {{-- Validation errors--}}
            @if(session()->has('errors'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach(session('errors')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Show/Edit Post Section -->
            <form action="{{ route('frontend.dashboard.profile.post-update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <section id="posts-section" class="posts-section">
                    <h2>{{$post->title}}</h2>
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input type="text" name="title" class="form-control mb-2 post-title" value="{{old('title',$post->title)}}"/>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <input type="hidden" name="post_id" value="{{$post->id}}"/>
                            <!-- Editable Content -->
                            <textarea id="postContent" name="description"
                                      class="form-control mb-2 post-content">{!! $post->description !!}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <!-- Image Upload Input for Editing -->
                            <input id="postImage" type="file" name="images[]" class="form-control mt-2 edit-post-image" accept="image/*"
                                   multiple/>

                            <!-- Editable Category Dropdown -->
                            <select name="category_id" class="form-control mb-2 post-category mt-3">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @selected(old('category_id', $post->category_id) == $category->id)>
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input id="comment_able" class="form-check-input enable-comments" type="checkbox"
                                       name="comment_able" {{$post->comment_able == 'yes' ? 'checked' : ''}}/>
                                <label for="comment_able" class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fas fa-eye"></i> Views ({{$post->number_of_views}})
                                </span>
                            </div>

                            <div class="post-actions mt-2">
                                <button type="submit" class="btn btn-primary edit-post-btn">Save</button>
                                <a href="{{ route('frontend.dashboard.profile') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </section>
            </form>
        </div>
    </div>
    <br>
    <br>

@endsection

@push('scripts')
    <script>
        {{--  for uploading file plugne --}}
        $(function () {
            $('#postImage').fileinput({
                theme: 'fa5',
                allowFileTypes: ['jpg', 'png', 'jpeg'],
                maxFileCount: 5,
                enableResumableUpload: false,
                showUpload: false,
                initialPreviewAsData: true,
                initialPreview: [
                    @if($post->images->count() > 0)
                        @foreach($post->images as $image)
                            "{{asset($image->path)}}",
                        @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                    @if($post->images->count() > 0)
                        @foreach($post->images as $image)
                            {
                                caption: '{{$image->path}}',
                                width: '120px',
                                url: '{{route('frontend.dashboard.post.image.delete',[$image->id , '_token'=>csrf_token()])}}',
                                key: {{$image->id}},
                            },
                        @endforeach
                    @endif

                ]
            });
        });

        {{--  for text editor plugne --}}
        $(function () {
            $('#postContent').summernote({
                height: 300,
            });
        });
    </script>
@endpush