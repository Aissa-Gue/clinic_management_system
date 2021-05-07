<!-- START Modal Edit -->
<div class="modal fade" id="editAppModal{{$app->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal form -->
            <form action="/appointments/update_appointment/{{$app->id}}" method="post" class="col-md-9">
                @csrf
                <div class="modal-body">
                    <input type="text" name="patient_name" class="form-control mb-2" value="{{$app->patient->first_name}} {{$app->patient->last_name}}" readonly>

                    <input type="hidden" name="doctor_id" class="form-control mb-2" value="{{$currentDoc->id}}">

                    <input type="date" name="date" class="form-control mb-2" value="{{$app->date}}">

                    <select name="time" class="form-select" id="time" required>
                        <option value="{{$app->time}}">{{\Carbon\Carbon::parse($app->time)->format('H:i')}}</option>
                        @foreach($agenda as $tim)
                            <option value="{{$tim->time}}">
                                {{\Carbon\Carbon::parse($tim->time)->format('H:i')}}
                            </option>
                        @endforeach
                    </select>
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
