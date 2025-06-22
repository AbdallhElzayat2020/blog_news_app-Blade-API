<div class="modal fade" id="edit_post_{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.categories.update',$post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create post</h5>

                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">post Icon</label>
                        <input type="file" class="form-control mb-3" id="icon" name="icon">
                        <img style="width: 50px; height: 50px; border-radius: 50%" src="{{ asset($post->icon) }}"
                             alt="{{$post->name}}">

                        @error('icon')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">post Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter post Name"
                               value="{{ old('name',$post->name) }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">post Description</label>
                        <textarea style="height: 200px" type="text" class="form-control" id="name" name="description"
                                  placeholder="Enter post description">{{old('description',$post->description)}}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" @selected(old('status', $post->status) =='active' )>Active</option>
                            <option value="inactive" @selected(old('status', $post->status) =='inactive' )>Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>