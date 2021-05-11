<!-- START Modal Delete -->
<div class="modal fade" id="deletePlanModal{{$age->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Time</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Are you sure?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                <a class="btn btn-danger" href="/planning/delete_time/{{$age->id}}">Yes</a>
            </div>
        </div>
    </div>
</div>
<!-- END Modal Delete -->
