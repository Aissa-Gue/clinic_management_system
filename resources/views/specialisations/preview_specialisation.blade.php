<!-- START Modal Edit -->
<div class="modal fade" id="previewSpecModal{{$spec->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Speciality Informations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <strong class="col-md-3">Speciality:</strong>
                    <p class="col-md-auto">{{$spec->speciality}}</p>
                </div>
                <div class="row mb-2">
                    <strong class="col-md-3">Description:</strong>
                    <p class="col-md-auto">{{$spec->description}}</p>
                </div>
                <div class="row mb-2">
                    <strong class="col-md-3">Created at:</strong>
                    <p class="col-md-auto">{{$spec->created_at}}</p>
                </div>
                <div class="row mb-2">
                    <strong class="col-md-3">Updated at:</strong>
                    <p class="col-md-auto">{{$spec->updated_at}}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Edit -->
