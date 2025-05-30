@extends('frontend.layouts.master')
@section('title', 'Categories')
@section('content')
    <!-- Main News Start-->
    <div class="main-news mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images->first()->path }}"
                                         alt="{{ $post->images->first()->alt_text }}" />
                                    <div class="mn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    No posts available in this category.
                                </div>
                            </div>
                        @endforelse
                        {{ $posts->links() }}
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Other Categories</h2>
                        <ul>
                            @foreach ($read_more_posts as $post)
                                <li><a title="{{ $post->title }}" href="">{{ $post->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection