<!-- START Modal Edit -->
<div class="modal fade" id="editSpecModal{{$spec->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Speciality</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal form -->
            <form action="/specialisations/update_specialisation/{{$spec->id}}" method="post" class="col-md-9">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="speciality" class="form-label">Speciality</label>
                        <input type="text" name="speciality" class="form-control mb-2" value="{{$spec->speciality}}" placeholder="Enter speciality" required>
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control mb-2" value="{{$spec->description}}" placeholder="Enter description" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
            <!-- END Modal form -->
        </div>
    </div>
</div>
<!-- END Modal Edit -->
