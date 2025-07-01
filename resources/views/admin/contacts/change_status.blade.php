<div class="modal fade" id="change_status_{{ $contact->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.contact.change-status', $contact->id) }}" method="post">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h5 class="modal-title">
                        Are you want to change Status for This Category
                        <span class="text-danger">{{ $contact->name }}</span>
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Yes Change</button>
                </div>
            </form>
        </div>
    </div>
</div>
