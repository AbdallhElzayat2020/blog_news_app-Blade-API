@extends('frontend.layouts.master')
@section('title', $mainPost->title)
@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">News</a></li>
                <li class="breadcrumb-item active">{{$mainPost->title}}</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach($mainPost->images as $image)
                                <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                                    <img style="width:730px; height: 450px; " src="{{asset($image->path)}}" class="d-block w-100" alt="First Slide">
                                    <div class="carousel-caption d-none d-md-block">
                                    </div>
                                </div>
                            @endforeach
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
                    <div class="sn-content">
                        <h3 style="word-wrap: break-word; word-break: break-all; overflow-wrap: break-word;">
                            {!! $mainPost->title !!}
                        </h3>
                        <div style="word-wrap: break-word; word-break: break-all; overflow-wrap: break-word;">
                            {!! substr($mainPost->description ,0,80) !!}
                        </div>
                    </div>

                    <!-- Comment Section -->
                    @if($mainPost->comment_able == 'yes')
                        <div class="comment-section">
                            <!-- Comment Input -->
                            <form method="post" id="commentForm">
                                @csrf
                                <div class="comment-input">
                                    <input type="text" name="comment" value="{{old('comment')}}" placeholder="Add a comment..." id="commentBox"/>
                                    @auth
                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                    @endauth
                                    <input type="hidden" name="post_id" value="{{$mainPost->id}}">

                                    <button type="submit" id="addCommentBtn">Post</button>
                                </div>
                            </form>

                            <div style="display: none" id="error_msg" class="alert alert-danger">

                            </div>
                            <!-- Display Comments -->
                            <div class="comments">
                                @foreach($mainPost->comments as $comment)
                                    <div class="comment">
                                        <img src="{{asset($comment->user->avatar)}}" alt="User Image" class="comment-img"/>
                                        <div class="comment-content">
                                            <span class="username">{{$comment->user->name}}</span>
                                            <p class="comment-text">{{$comment->comment}}</p>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Add more comments here for demonstration -->
                            </div>

                            <!-- Show More Button -->
                            @if($mainPost->comments->count() > 2)
                                <button id="showMoreBtn" class="show-more-btn">Show more</button>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info">
                            <a href="{{ route('login') }}">Login</a> to access comments
                        </div>
                    @endif

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach($related_posts as $post)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img style="width: 270px; height: 150px" src="{{asset(@$post->images->first()->path)}}"
                                             alt="{{@$post->images->first()->alt_text}}"/>

                                        <div class="nl-title">
                                            <a href="{{ route('frontend.post.show',$post->slug) }}" title="{{$post->title}}">
                                                {{$post->title}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- in this category section --}}
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach($related_posts as $post)

                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img style="width: 270px; height: 150px" src="{{asset(@$post->images->first()->path)}}"
                                                 alt="{{@$post->images->first()->alt_text}}"/>
                                        </div>
                                        <div class="nl-title">
                                            <a href="{{ route('frontend.post.show',$post->slug) }}" title="{{$post->title}}">
                                                {{$post->title}}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>


                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item active">
                                        <a class="nav-link active" data-toggle="pill" href="#popular">Latest Posts</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest">Popular Posts</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    {{-- latest post --}}
                                    <div id="popular" class="container tab-pane fade">
                                        @foreach($latest_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img style="width: 270px; height: 150px" src="{{asset(@$post->images->first()->path)}}"
                                                         alt="{{$post->images->first()->alt_text}}"/>
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show',$post->slug) }}" title="{{$post->title}}">
                                                        {{$post->title}}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div id="latest" class="container tab-pane fade">
                                        @foreach($popular_posts as $post)

                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img style="width: 270px; height: 150px" src="{{asset(@$post->images->first()->path)}}"
                                                         alt="{{@$post->images->first()->alt_text}}"/>
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show',$post->slug) }}" title="{{$post->title}}">
                                                        {{$post->title}}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach($categories as $category)

                                        <li><a title="{{$post->title}}" href="{{ route('frontend.post.show',$post->slug) }}">
                                                {{$category->name}}</a><span>({{$category->posts->count()}})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->

@endsection


@push('scripts')
    <script>

        // show more comments
        $(document).on('click', '#showMoreBtn', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{route('frontend.post.comments', $mainPost->slug)}}",
                type: "GET",
                success: function (data) {
                    $('.comments').empty();
                    $.each(data, function (key, comment) {
                        $('.comments').append(`
                            <div class="comment">
                                <img src="${comment.user.avatar}" alt="${comment.user.name}" class="comment-img"/>
                                <div class="comment-content">
                                    <span class="username">${comment.user.name}</span>
                                    <p class="comment-text">${comment.comment}</p>
                                </div>
                            </div>
                        `);
                        $('#showMoreBtn').hide()
                    });
                },
                error: function (error) {
                    console.log(error)
                }
            });
        });


        // Add comment
        $(document).on('submit', '#commentForm', function (e) {
            e.preventDefault();
            let formDta = new FormData($(this)[0]);

            $.ajax({
                url: "{{route('frontend.post.comments.store')}}",
                type: "POST",
                data: formDta,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('.comments').prepend(`
                        <div class="comment">
                            <img src="${data.comment.user.avatar}" alt="${data.comment.user.name}" class="comment-img"/>
                            <div class="comment-content">
                                <span class="username">${data.comment.user.name}</span>
                                <p class="comment-text">${data.comment.comment}</p>
                            </div>
                        </div>
                    `);
                    $('#commentBox').val('');
                },
                error: function (error) {
                    let response = $.parseJSON(error.responseText);
                    $('#error_msg').show();
                    $('#error_msg').text(response.message);
                    setTimeout(function () {
                        $('#error_msg').hide();
                    }, 3000);
                }
            });
        })

    </script>
@endpush