<!-- START Modal Edit -->
<div class="modal fade" id="addSpecModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Speciality</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal form -->
            <form action="/specialisations/add_specialisation" method="post" class="col-md-9">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="speciality" class="form-label">Speciality</label>
                        <input type="text" name="speciality" id="speciality" class="form-control mb-2" placeholder="Enter speciality" required>
                    </div>

                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control mb-2" placeholder="Enter description" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
            <!-- END Modal form -->
        </div>
    </div>
</div>
<!-- END Modal Edit -->
