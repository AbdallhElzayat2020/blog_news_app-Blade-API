<div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Latest Posts</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Comments</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($latest_posts as $post)
                            <tr>
                                <td>
                                    <a href="{{route('admin.posts.show',$post->id)}}">{{$post->title}}</a>
                                </td>

                                <td>{{$post->category->name}}</td>
                                <td>{{$post->comments_count}}</td>
                                <td>
                                    @if($post->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($post->status == 'inactive')
                                        <span class="badge badge-warning">Not Active</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center alert alert-info">No posts available</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>

    <div class="col-lg-6 mb-4">

        <!-- Project Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Latest Comments</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Post Title</th>
                            <th>Comment</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($latest_comments as $comment)
                            <tr>
                                <td>
                                    <a href="{{route('admin.posts.show',$comment->post->id)}}">{{$comment->post->title}}</a>
                                </td>
                                <td>{{\Illuminate\Support\Str::limit($comment->comment,50)}}</td>
                                <td>
                                    @if($comment->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($comment->status == 'inactive')
                                        <span class="badge badge-danger">Not Active</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

</div>