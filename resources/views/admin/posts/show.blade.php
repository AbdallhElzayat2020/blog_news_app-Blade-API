@extends('admin.layouts.master')
@section('title', 'Show Post Details')
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        /* General Styles */
        .container-fluid {
            padding: 2rem;
            background: #f8f9fc;
            min-height: 100vh;
        }

        /* Card Styles */
        .post-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 0.75rem;
            overflow: hidden;
            background: #fff;
            margin-bottom: 2rem;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem 0 rgba(58, 59, 69, 0.2);
        }

        /* Header Styles */
        .post-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            padding: 1.5rem;
            color: #fff;
        }

        .post-header h6 {
            color: #fff;
            font-weight: 600;
            margin: 0;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        .post-header h6 i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .post-body {
            padding: 2rem;
        }

        /* Back Button */
        .btn-icon-split {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background: #4e73df;
            color: #fff;
            border: none;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }

        .btn-icon-split:hover {
            background: #224abe;
            transform: translateX(-5px);
            color: #fff;
            text-decoration: none;
        }

        .btn-icon-split .icon {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        /* Author Info Styles */
        .author-info {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: linear-gradient(to right, #f8f9fc, #fff);
            border-radius: 0.75rem;
            border-left: 4px solid #4e73df;
        }

        .author-details h6 {
            margin: 0;
            font-size: 1.1rem;
            color: #5a5c69;
        }

        .author-details .text-primary {
            color: #4e73df !important;
            font-weight: 600;
        }

        .author-details p {
            margin: 0.5rem 0 0;
            color: #858796;
            font-size: 0.9rem;
        }

        /* Post Title */
        .post-title {
            font-size: 2rem;
            color: #2e59d9;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.3;
            border-bottom: 2px solid #eaecf4;
            padding-bottom: 1rem;
        }

        /* Post Meta */
        .post-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 1rem;
            background: #f8f9fc;
            border-radius: 0.5rem;
        }

        .post-meta div {
            display: flex;
            align-items: center;
            color: #5a5c69;
            font-size: 0.95rem;
        }

        .post-meta i {
            width: 24px;
            text-align: center;
            margin-right: 0.5rem;
            color: #4e73df;
            font-size: 1.1rem;
        }

        /* Swiper Styles */
        .swiper {
            width: 100%;
            height: 450px;
            margin-bottom: 2rem;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .swiper-slide {
            text-align: center;
            background: #f8f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #fff;
            background: rgba(78, 115, 223, 0.9);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #224abe;
            transform: scale(1.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.2rem;
        }

        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: #fff;
            opacity: 0.5;
        }

        .swiper-pagination-bullet-active {
            background: #4e73df;
            opacity: 1;
        }

        /* Post Content */
        .post-content {
            color: #5a5c69;
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05);
        }

        .post-content p {
            margin-bottom: 1.5rem;
        }

        .post-content p:last-child {
            margin-bottom: 0;
        }

        /* Post Actions */
        .post-actions {
            border-top: 1px solid #eaecf4;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .post-actions .btn {
            padding: 0.5rem 1.25rem;
            font-size: 0.9rem;
            border-radius: 0.5rem;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .post-actions .btn i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        .post-actions .btn-primary {
            background: #4e73df;
            border-color: #4e73df;
        }

        .post-actions .btn-primary:hover {
            background: #224abe;
            border-color: #224abe;
            transform: translateY(-2px);
        }

        .post-actions .btn-warning {
            background: #f6c23e;
            border-color: #f6c23e;
            color: #fff;
        }

        .post-actions .btn-warning:hover {
            background: #dda20a;
            border-color: #dda20a;
            transform: translateY(-2px);
        }

        .post-actions .btn-danger {
            background: #e74a3b;
            border-color: #e74a3b;
        }

        .post-actions .btn-danger:hover {
            background: #be2617;
            border-color: #be2617;
            transform: translateY(-2px);
        }

        /* Comments Section */
        .comment-section {
            margin-top: 2rem;
        }

        .comment-item {
            padding: 1.5rem;
            border-bottom: 1px solid #eaecf4;
            transition: all 0.3s ease;
        }

        .comment-item:hover {
            background: #f8f9fc;
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .comment-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 1rem;
            object-fit: cover;
            border: 2px solid #4e73df;
        }

        .comment-meta {
            flex: 1;
        }

        .comment-author {
            font-weight: 600;
            color: #4e73df;
            margin: 0;
            font-size: 1rem;
        }

        .comment-date {
            color: #858796;
            font-size: 0.85rem;
            margin: 0.25rem 0 0;
        }

        .comment-content {
            color: #5a5c69;
            margin: 0;
            padding-left: 3.5rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Sidebar Cards */
        .sidebar-card {
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .sidebar-card .post-header {
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .sidebar-card .post-body {
            padding: 1.5rem;
        }

        .sidebar-card .form-group {
            margin-bottom: 1.5rem;
        }

        .sidebar-card .form-group:last-child {
            margin-bottom: 0;
        }

        .sidebar-card label {
            color: #5a5c69;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .sidebar-card .badge {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 0.5rem;
        }

        .sidebar-card .badge-success {
            background: #1cc88a;
        }

        .sidebar-card .badge-danger {
            background: #e74a3b;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }

            .post-body {
                padding: 1.5rem;
            }

            .post-title {
                font-size: 1.5rem;
            }

            .swiper {
                height: 300px;
            }

            .post-actions {
                flex-direction: column;
            }

            .post-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .comment-content {
                padding-left: 0;
                margin-top: 1rem;
            }
        }

        /* Comment Actions Styles */
        .comment-actions {
            margin-left: auto;
        }

        .comment-actions .btn-danger {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
            transition: all 0.3s ease;
        }

        .comment-actions .btn-danger:hover {
            transform: scale(1.1);
        }

        /* Modal Styles */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .modal-backdrop.show {
            opacity: 1;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: none;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            overflow-y: auto;
            outline: 0;
        }

        .modal-dialog {
            position: relative;
            width: auto;
            margin: 1.75rem auto;
            pointer-events: none;
            transform: translate(0, -50px);
            transition: transform 0.3s ease-out;
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            outline: 0;
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            perspective: 1000;
            -webkit-perspective: 1000;
        }

        .modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color: #fff;
            border-radius: 0.75rem 0.75rem 0 0;
            border: none;
        }

        .modal-header .close {
            color: #fff;
            text-shadow: none;
            opacity: 0.8;
        }

        .modal-header .close:hover {
            opacity: 1;
        }

        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1.5rem;
            color: #5a5c69;
        }

        .modal-footer {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            padding: 1rem 1.5rem;
            border-top: 1px solid #eaecf4;
            border-bottom-right-radius: 0.75rem;
            border-bottom-left-radius: 0.75rem;
        }

        .modal-footer .btn {
            padding: 0.5rem 1.25rem;
            font-size: 0.9rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .modal-footer .btn-secondary {
            background: #858796;
            border-color: #858796;
        }

        .modal-footer .btn-secondary:hover {
            background: #6e707e;
            border-color: #6e707e;
        }

        .modal-footer .btn-danger {
            background: #e74a3b;
            border-color: #e74a3b;
        }

        .modal-footer .btn-danger:hover {
            background: #be2617;
            border-color: #be2617;
        }

        /* Modal Animation */
        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal.fade .modal-dialog {
            animation: modalFadeIn 0.3s ease-out;
        }

        /* Fix for iOS Safari */
        @supports (-webkit-touch-callout: none) {
            .modal-backdrop {
                position: absolute;
            }

            .modal {
                position: absolute;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Post Details</h1>
            <a href="{{ url()->previous() }}" class="btn-icon-split">
                <span class="icon">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>

        <div class="row">
            <!-- Post Details Card -->
            <div class="col-lg-8">
                <div class="post-card">
                    <div class="post-header">
                        <h6><i class="fas fa-newspaper"></i>Post Information</h6>
                    </div>
                    <div class="post-body">
                        <!-- Author Info -->
                        <div class="author-info">
                            <div class="author-details">
                                @auth
                                    <h6>Publisher:
                                        <span class="text-primary">
                                            {{$post->user->name ?? $post->admin->name}}
                                        </span>
                                    </h6>
                                @endauth

                                <p>
                                    <i class="fas fa-clock mr-1"></i>Posted
                                    <span class="text-primary">{{ $post->created_at->diffForHumans() }}</span>
                                </p>
                            </div>
                        </div>

                        <!-- Post Title -->
                        <h4 class="post-title">{{ $post->title }}</h4>

                        <!-- Post Meta -->
                        <div class="post-meta">
                            <div><i class="fas fa-folder"></i>Category: {{ $post->category->name }}</div>
                            <div><i class="fas fa-eye"></i>Views: {{ $post->number_of_views }}</div>
                            <div>
                                <i class="fas fa-comments"></i>
                                {{ $post->comments_count > 0 ? $post->comments_count . ' Comments' : 'No Comments Yet' }}
                            </div>
                        </div>

                        <!-- Post Images Slider -->
                        @if ($post->images->count() > 0)
                            <div class="swiper post-images-slider">
                                <div class="swiper-wrapper">
                                    @foreach ($post->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset($image->path) }}" alt="Post Image">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-pagination"></div>
                            </div>
                        @endif

                        <!-- Post Content -->
                        <div class="post-content">
                            {!! $post->content !!}
                        </div>

                        <!-- Post Actions -->
                        <div class="post-actions">
                            @if($post->admin_id != null)
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit Post</span>
                                </a>
                            @endif


                            <a href="#" data-toggle="modal" title="change_status" data-target="#change_status_{{ $post->id }}"
                               class="btn btn-warning">
                                @if ($post->status == 'active')
                                    <i class="fas fa-ban"></i> Block
                                @else
                                    <i class="fas fa-play"></i> Activate
                                @endif
                            </a>

                            <a href="#" data-toggle="modal" data-target="#delete_post_{{ $post->id }}"
                               class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                <span>Delete Post</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                @if ($post->comments->count() > 0)
                    <div class="post-card">
                        <div class="post-header">
                            <h6><i class="fas fa-comments"></i>Comments ({{ $post->comments->count() }})</h6>
                        </div>
                        <div class="post-body">
                            @foreach ($post->comments as $comment)
                                <div class="comment-item">
                                    <div class="comment-header">
                                        <img src="{{ asset($comment->user->image ?? 'assets/img/default-avatar.png') }}"
                                             alt="{{ $comment->user->name }}" class="comment-avatar">
                                        <div class="comment-meta">
                                            <h6 class="comment-author"><a class="text-decoration-none"
                                                                          href="{{ route('admin.users.edit', $comment->user->id) }}">{{ $comment->user->name }}</a>
                                            </h6>
                                            <p class="comment-date">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        @auth('admin')
                                            <div class="comment-actions">
                                                <form action="{{ route('admin.delete.comment',$post->id) }}"
                                                      method="POST" style="display: inline;"
                                                      onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endauth
                                    </div>
                                    <p class="comment-content">{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Post Status Card -->
                <div class="sidebar-card">
                    <div class="post-header">
                        <h6><i class="fas fa-info-circle"></i>Post Status</h6>
                    </div>
                    <div class="post-body">
                        <div class="form-group">
                            <label>Status</label>
                            <div>
                                <span class="badge badge-{{ $post->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Published At</label>
                            <div class="text-primary">{{ $post->created_at->format('F j, Y g:i A') }}</div>
                        </div>
                        <div class="form-group">
                            <label>Last Updated</label>
                            <div class="text-primary">{{ $post->updated_at->format('F j, Y g:i A') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Category Info Card -->
                <div class="sidebar-card">
                    <div class="post-header">
                        <h6><i class="fas fa-folder"></i>Category Information</h6>
                    </div>
                    <div class="post-body">
                        <div class="form-group">
                            <label>Category Name</label>
                            <div class="text-primary">{{ $post->category->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.posts.delete')
    @include('admin.posts.change_status')
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.post-images-slider', {
                loop: {{ $post->images->count() > 1 ? 'true' : 'false' }},
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 20
                    },
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 30
                    },
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 40
                    }
                }
            });
        });
    </script>
@endpush
