<div class="modal fade" id="delete_site_{{ $site->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.related-sites.destroy', $site->id) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <div class="">
                        <h5 class="modal-title" id="exampleModalLabel"> delete this <span
                                    class="text-danger">{{ $site->name }}</span>
                        </h5>
                    </div>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>
