@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center" role="alert">
        <h5>Add New Consultation</h5>
    </div>
    @foreach($currentApp as $app)


        <div class="text-end mb-5">
        <ul class="nav nav-pills">
            <li class="nav-item fw-bold">
                <a href="/consultations/add/{{$app->id}}" class="nav-link {{Request::is('consultations/add/'.$app->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-file-medical-alt"></i> Consultation</a>
            </li>
            @if($app->consultations)
                <li class="nav-item fw-bold">
                    <a href="/consultations/prescriptions/{{$app->id}}" class="nav-link {{Request::is('consultations/prescriptions/'.$app->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-capsules"></i> Prescription</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/certificates/{{$app->id}}" class="nav-link {{Request::is('consultations/certificates/'.$app->id) ? 'active':''}}" type="button" aria-selected="false"><i class="far fa-file-alt"></i> Certificate</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/history/{{$app->id}}" class="nav-link {{Request::is('consultations/history/'.$app->patient->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-history"></i> History</a>
                </li>
            @endif
        </ul>
    </div>
    <form action="/consultations/add/{{$app->id}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-success">General informations</legend>
            <div class="row mb-3">
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Patient name</span>
                        <input type="hidden" name="pat_id" value="{{$app->patient->id}}">
                        <input type="text" name="patient" class="form-control" value="{{$app->patient->first_name}} {{$app->patient->last_name}}" disabled>
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Doctor</span>
                        <input type="text" name="doctor" class="form-control" value="{{$app->doctor->first_name}} {{$app->doctor->last_name}}" disabled>
                    </div>
                </div>
                <input type="hidden" name="doc_id" value="{{$app->doctor->id}}">

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Age</span>
                        <input type="text" name="birthdate" class="form-control" value="{{$app->patient->birthdate}} / {{\Carbon\Carbon::parse($app->patient->birthdate)->age}} years old" disabled>
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Date</span>
                        <input type="text" name="date" class="form-control" value="{{$app->date}} | {{\Carbon\Carbon::parse($app->time)->format('H:i')}}" disabled>
                    </div>
                </div>

                <div class="col-md-6 offset-md-6">
                    <div class="input-group">
                        <span class="input-group-text">Paid amount</span>
                        <input type="text" maxlength="6" name="paid_amount" class="form-control" value="{{request()->get('paid_amount')}}">
                    </div>
                    @if(!empty($messages))
                        @foreach ($messages->get('paid_amount') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>
        </fieldset>

        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-success">Consultation</legend>

            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="blood_type" class="form-label">Blood type</label>
                    @if(request()->get('blood_type') != "")
                        @php $blood_type = request()->get('blood_type'); @endphp
                    @else
                        @php $blood_type = $app->patient->blood_type; @endphp
                    @endif
                    <select class="form-select" name="blood_type">
                        <option value="" selected>Choose...</option>
                        <option value="O+" @if($blood_type == 'O+') {{'selected'}} @endif>O+</option>
                        <option value="O-" @if($blood_type == 'O-') {{'selected'}} @endif>O-</option>
                        <option value="A+" @if($blood_type == 'A+') {{'selected'}} @endif>A+</option>
                        <option value="A-" @if($blood_type == 'A-') {{'selected'}} @endif>A-</option>
                        <option value="B+" @if($blood_type == 'B+') {{'selected'}} @endif>B+</option>
                        <option value="B-" @if($blood_type == 'B-') {{'selected'}} @endif>B-</option>
                        <option value="AB+" @if($blood_type == 'AB+') {{'selected'}} @endif>AB+</option>
                        <option value="AB-" @if($blood_type == 'AB-') {{'selected'}} @endif>AB-</option>
                    </select>
                    <!-- <input type="text" maxlength="3" name="blood_type" class="form-control" value="{{$blood_type}}"> -->
                    @if(!empty($messages))
                        @foreach ($messages->get('blood_type') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>

                <div class="col-md-3">
                    <label for="blood_pressure" class="form-label">Blood pressure</label>
                    @if(request()->get('blood_pressure') != "")
                        @php $blood_pressure = request()->get('blood_pressure'); @endphp
                    @else
                        @php $blood_pressure = $app->patient->blood_pressure; @endphp
                    @endif
                    <select class="form-select" name="blood_pressure">
                        <option value="" selected>Choose...</option>
                        <option value="yes" @if($blood_pressure == 'yes') {{'selected'}} @endif>Yes</option>
                        <option value="no" @if($blood_pressure == 'no') {{'selected'}} @endif>No</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    @if(request()->get('diabetes') != "")
                        @php $diabetes = request()->get('diabetes'); @endphp
                    @else
                        @php $diabetes = $app->patient->diabetes; @endphp
                    @endif
                    <label for="diabetes" class="form-label">Diabetes</label>
                    <select class="form-select" name="diabetes">
                        <option value="" selected>Choose...</option>
                        <option value="yes" @if($diabetes == 'yes') {{'selected'}} @endif>Yes</option>
                        <option value="no" @if($diabetes == 'no') {{'selected'}} @endif>No</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="temperature" class="form-label">Temperature (°C)</label>
                    <input type="text" name="temperature" class="form-control" id="temperature" value="{{request()->get('temperature')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('temperature') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="length" class="form-label">Length (Cm)</label>
                    <input type="text" name="length" class="form-control" id="length" value="{{request()->get('length')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('length') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>

                <div class="col-md-3">
                    <label for="weight" class="form-label">Weight (Kg)</label>
                    <input type="text" name="weight" class="form-control" id="weight" value="{{request()->get('weight')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('weight') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="note" class="form-label">Description</label>
                    <textarea type="text" name="description" class="form-control" id="note" rows="4">{{request()->get('description')}}</textarea>
                    @if(!empty($messages))
                        @foreach ($messages->get('description') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                    @if(!empty($messages))
                        @foreach ($messages->get('app_id') as $message)
                            <div class="form-text text-danger">Appointment: {{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="" class="form-label">&puncsp;</label>
                    <input type="submit" class="form-control btn btn-success" value="SAVE">
                </div>
            </div>
        </fieldset>
    </form>
    @endforeach

@stop
