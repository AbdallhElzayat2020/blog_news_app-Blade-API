@extends('frontend.layouts.master')
@section('title', 'Search Posts')
@section('content')
    <div class="main-news pt-4">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images->first()->path }}"
                                         alt="{{ $post->images->first()->alt_text }}"/>
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show',$post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="alert alert-warning">
                                    <strong>Warning!</strong> No posts found for your search query.
                                </div>
                            </div>
                        @endforelse
                        {{ $posts->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection