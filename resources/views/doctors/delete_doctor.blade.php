<div class="modal fade" id="delete{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class=" modal-title " id="exampleModalLongTitle">Delete Patient</h5>

            </div>
            <div class="modal-body">
                <h3 class="text-center">Are you sure?</h3>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a class="btn btn-danger" href="/doctors/delete_doctor/{{$doc->id}}">Yes</a>
            </div>
        </div>
    </div>
</div>
