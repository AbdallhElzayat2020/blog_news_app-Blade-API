@extends('frontend.layouts.master')
@section('title', 'Profile')
@section('content')

    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{ asset($user->avatar) }}" alt="User Image" class="profile-img rounded-circle"
                         style="width: 100px; height: 100px;"/>
                    <span class="username">{{ $user->name }}</span>
                </div>
                <br>

                @if(session()->has('errors'))
                    @foreach(session('errors')->all() as $error)
                        <div class="alert error_alert alert-danger alert-dismissible fade show" role="alert">
                            <li>{{ $error }}</li>
                            <script>
                                setTimeout(function () {
                                    $('.error_alert').alert('close');
                                }, 10000);
                            </script>
                        </div>
                    @endforeach
                @endif
                <!-- Add Post Section -->
                <form action="{{ route('frontend.dashboard.post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">
                            <!-- Post Title -->
                            <input type="text" name="title" value="{{ old('title') }}" id="postTitle"
                                   class="form-control mb-2" placeholder="Post Title"/>


                            <!-- Post Content -->
                            <textarea id="postContent" name="description" class="form-control mb-2" rows="3"
                                      placeholder="Description for the post">{{ old('description') }}</textarea>

                            <!-- Image Upload -->
                            <input type="file" name="images[]" id="postImage" class="form-control mb-2" accept="image/*"
                                   multiple/>

                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select id="postCategory" name="category_id" class="form-select mb-2">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Enable Comments Checkbox -->
                            <label class="form-check-label ml-4" style="margin: 10px 0;">
                                <input type="checkbox" {{old('comment_able', 'off') == 'on' ? 'checked' : ''}} name="comment_able"
                                       class="form-check-input"/> Enable Comments
                            </label><br>

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Save</button>
                        </div>
                    </section>
                </form>

                <!-- Posts Section -->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                        @forelse($posts as $post)
                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="{{ asset($post->user->avatar) }}" alt="User Image" class="rounded-circle"
                                         style="width: 50px; height: 50px;"/>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $post->user->username }}</h5>
                                    </div>
                                </div>
                                <h4 class="post-title">{{$post->title}}</h4>
                                <p>
                                    {{ chunk_split($post->description , 50) }}
                                </p>

                                @if($post->images->count() > 0)
                                    <div id="carousel-{{$post->id}}" class="carousel slide" data-ride="carousel">

                                        <ol class="carousel-indicators">
                                            @foreach($post->images as $key => $image)
                                                <li data-target="#carousel-{{$post->id}}" data-slide-to="{{$key}}"
                                                    class="{{ $key == 0 ? 'active' : '' }}">
                                                </li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach($post->images as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset($image->path) }}" class="d-block w-100" alt="Post Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carousel-{{$post->id}}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-{{$post->id}}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>

                                    </div>
                                @endif

                                <div class="post-actions d-flex justify-content-between">
                                    <div class="post-stats">
                                        <!-- View Count -->
                                        <span class="me-3">
                                        <i class="fas fa-eye"></i> {{ $post->number_of_views }} views
                                    </span>
                                    </div>

                                    <div>
                                        <a title="editBtn" href="{{ route('frontend.dashboard.profile.edit',$post->slug) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <a title="deleteBtn" onclick="if (confirm('Are you sure to delete this post?')) {
                                                 document.getElementById('deleteForm_{{$post->id}}').submit();
                                            } return false;"
                                           href="javascript:void(0)" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>

                                        <button title="ShowCommentsBtn" id="commentbtn_{{$post->id}}" post-id="{{$post->id}}"
                                                class="btn getComments btn-sm btn-outline-secondary">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>

                                        <button title="hideCommentBtn" style="display: none" id="hideCommentId_{{$post->id}}"
                                                class="btn hideComments btn-sm btn-outline-danger"
                                                post-id="{{$post->id}}">
                                            <i class="fas fa-comment"></i> Hide Comments
                                        </button>

                                        <form id="deleteForm_{{$post->id}}" action="{{ route('frontend.dashboard.profile.delete',$post->id) }}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div class="comments">
                                    @forelse($post->comments as $comment)
                                        <div class="comment">
                                            <img src="{{ asset($comment->user->avatar) }}" alt="User Image" class="comment-img"/>
                                            <div class="comment-content">
                                                <span class="username">{{ $comment->user->username }}</span>
                                                <p class="comment-text">{{ $comment->content }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">No comments yet</p>
                                    @endforelse
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-danger">
                                No posts
                            </div>
                        @endforelse


                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->

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
