<!-- START Modal Edit -->
<div class="modal fade" id="editAppModal{{$app->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal form -->
            <form action="/appointments/update_appointment/{{$app->id}}" method="get" class="col-md-9">
                @csrf
                <div class="modal-body">
                    <input type="text" name="patient_name" class="form-control mb-2" value="{{$app->patient->first_name}} {{$app->patient->last_name}}" readonly>

                    <input type="hidden" name="app_id" class="form-control mb-2" value="{{$app->id}}">
                    <input type="hidden" name="doc_id" class="form-control mb-2" value="{{$currentDoc->id}}">
                    <input type="hidden" name="app_time" class="form-control mb-2" value="{{$app->time}}">

                    <input type="date" name="app_date" class="form-control mb-2" value="{{$app->date}}">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Available Times</button>
                </div>
            </form>
            <!-- END Modal form -->
        </div>
    </div>
</div>
<!-- END Modal Edit -->
