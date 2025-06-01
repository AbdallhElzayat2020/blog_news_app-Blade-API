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
                    <img src="{{asset($user->avatar)}}" alt="User Image" class="profile-img rounded-circle"
                         style="width: 100px; height: 100px;"/>
                    <span class="username">{{$user->username}}</span>
                </div>
                <br>

                <!-- Add Post Section -->
                <section id="add-post" class="add-post-section mb-5">
                    <h2>Add Post</h2>
                    <div class="post-form p-3 border rounded">
                        <!-- Post Title -->
                        <input type="text" id="postTitle" class="form-control mb-2" placeholder="Post Title"/>

                        <!-- Post Content -->
                        <textarea id="postContent" class="form-control mb-2" rows="3" placeholder="What's on your mind?"></textarea>

                        <!-- Image Upload -->
                        <input type="file" id="postImage" class="form-control mb-2" accept="image/*" multiple/>
                        <div class="tn-slider mb-2">
                            <div id="imagePreview" class="slick-slider"></div>
                        </div>

                        <!-- Category Dropdown -->
                        <select id="postCategory" class="form-select mb-2">
                            <option value="">Select Category</option>
                            <option value="general">General</option>
                            <option value="tech">Tech</option>
                            <option value="life">Life</option>
                        </select>

                        <!-- Enable Comments Checkbox -->
                        <label class="form-check-label ml-3 my-3">
                            <input type="checkbox" class="form-check-input"/> Enable Comments
                        </label><br>

                        <!-- Post Button -->
                        <button class="btn btn-primary post-btn">Post</button>
                    </div>
                </section>

                <!-- Posts Section -->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                        <div class="post-item mb-4 p-3 border rounded">
                            <div class="post-header d-flex align-items-center mb-2">
                                <img src="{{$user->avatar}}" alt="User Image" class="rounded-circle" style="width: 50px; height: 50px;"/>
                                <div class="ms-3">
                                    <h5 class="mb-0">{{$user->name}}</h5>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                            <h4 class="post-title">Post Title Here</h4>
                            <p class="post-content">This is an example post content. The user can share their thoughts, upload images, and more.</p>

                            <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#newsCarousel" data-slide-to="1"></li>
                                    <li data-target="#newsCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item  active">
                                        <img src="" class="d-block w-100" alt="First Slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>dsfdk</h5>
                                            <p>
                                                oookok
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item ">
                                        <img src="" class="d-block w-100" alt="First Slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>dsfdk</h5>
                                            <p>
                                                oookok
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Add more carousel-item blocks for additional slides -->
                                </div>
                                <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <div class="post-actions d-flex justify-content-between">
                                <div class="post-stats">
                                    <!-- View Count -->
                                    <span class="me-3"><i class="fas fa-eye"></i> 123 views</span>
                                </div>

                                <div>
                                    <a href="" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-thumbs-up"></i> Delete
                                    </a>
                                    <button class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-comment"></i> Comments
                                    </button>
                                </div>
                            </div>

                            <!-- Display Comments -->
                            <div class="comments">
                                <div class="comment">
                                    <img src="" alt="User Image" class="comment-img"/>
                                    <div class="comment-content">
                                        <span class="username"></span>
                                        <p class="comment-text">first comment</p>
                                    </div>
                                </div>
                                <!-- Add more comments here for demonstration -->
                            </div>
                        </div>

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
        $(function () {
            $('#postImage').fileinput({
                theme: 'fa5',
                allowFileTypes: ['jpg', 'png', 'jpeg'],
                maxFileCount: 5,
                enableResumableUpload: false,
                showUpload: false,
            });
        });
    </script>
@endpush