@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center" role="alert">
        <h5>Edit Consultation</h5>
    </div>
    @foreach($consultation as $cons)

        <div class="text-end mb-5">
            <ul class="nav nav-pills">
                <li class="nav-item fw-bold">
                    <a href="/consultations/edit/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/edit/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-file-medical-alt"></i> Consultation</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/prescriptions/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/prescriptions/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-capsules"></i> Prescription</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/certificates/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/certificates/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="far fa-file-alt"></i> Certificate</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/history/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/history/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-history"></i> History</a>
                </li>
            </ul>
        </div>

    <form action="/consultations/edit/{{$cons->appointment->id}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-success">Patient informations</legend>
            <div class="row mb-3">
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Patient name</span>
                        <input type="hidden" name="pat_id" value="{{$cons->appointment->patient->id}}">
                        <input type="text" name="patient" class="form-control" value="{{$cons->appointment->patient->first_name}} {{$cons->appointment->patient->last_name}}" disabled>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Age</span>
                        <input type="text" name="birthdate" class="form-control" value="{{$cons->appointment->patient->birthdate}} / {{\Carbon\Carbon::parse($cons->appointment->patient->birthdate)->age}} years old" disabled>
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        @if(request('blood_type') != "")
                            @php $blood_type = request('blood_type'); @endphp
                        @else
                            @php $blood_type = $cons->appointment->patient->blood_type; @endphp
                        @endif
                        <span class="input-group-text">Blood type</span>
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
                        @if(!empty($messages))
                            @foreach ($messages->get('blood_type') as $message)
                                <div class="form-text text-danger">{{$message}}</div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <input type="hidden" name="doc_id" value="{{$cons->appointment->doctor->id}}">

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Doctor</span>
                        <input type="text" name="doctor" class="form-control" value="{{$cons->appointment->doctor->first_name}} {{$cons->appointment->doctor->last_name}}" disabled>
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        @if(request('blood_pressure') != "")
                            @php $blood_pressure = request('blood_pressure'); @endphp
                        @else
                            @php $blood_pressure = $cons->appointment->patient->blood_pressure; @endphp
                        @endif
                        <span class="input-group-text">Blood pressure</span>
                        <select class="form-select" name="blood_pressure">
                            <option value="" selected>Choose...</option>
                            <option value="yes" @if($blood_pressure == 'yes') {{'selected'}} @endif>Yes</option>
                            <option value="no" @if($blood_pressure == 'no') {{'selected'}} @endif>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Date</span>
                        <input type="text" name="date" class="form-control" value="{{$cons->appointment->date}} | {{\Carbon\Carbon::parse($cons->appointment->time)->format('H:i')}}" disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        @if(request('diabetes') != "")
                            @php $diabetes = request('diabetes'); @endphp
                        @else
                            @php $diabetes = $cons->appointment->patient->diabetes; @endphp
                        @endif
                        <span class="input-group-text">Diabetes</span>
                        <select class="form-select" name="diabetes">
                            <option value="" selected>Choose...</option>
                            <option value="yes" @if($diabetes == 'yes') {{'selected'}} @endif>Yes</option>
                            <option value="no" @if($diabetes == 'no') {{'selected'}} @endif>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        @if(request('paid_amount') != "")
                            @php $paid_amount = request('paid_amount'); @endphp
                        @else
                            @php $paid_amount = $cons->paid_amount; @endphp
                        @endif
                        <span class="input-group-text">Paid amount</span>
                        <input type="text" maxlength="6" name="paid_amount" class="form-control" value="{{$paid_amount}}">
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

            <div class="row mb-3">
                <div class="col-md-4">
                    @if(request('weight') != "")
                        @php $weight = request('weight'); @endphp
                    @else
                        @php $weight = $cons->weight; @endphp
                    @endif
                    <label for="weight" class="form-label">Weight (Kg)</label>
                    <input type="text" name="weight" class="form-control" id="weight" value="{{$weight}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('weight') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    @if(request('length') != "")
                        @php $length = request('length'); @endphp
                    @else
                        @php $length = $cons->length; @endphp
                    @endif
                    <label for="length" class="form-label">Length (Cm)</label>
                    <input type="text" name="length" class="form-control" id="length" value="{{$length}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('length') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    @if(request('temperature') != "")
                        @php $temperature = request('temperature'); @endphp
                    @else
                        @php $temperature = $cons->temperature; @endphp
                    @endif
                    <label for="temperature" class="form-label">Temperature (°C)</label>
                    <input type="text" name="temperature" class="form-control" id="temperature" value="{{$temperature}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('temperature') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    @if(request('description') != "")
                        @php $description = request('description'); @endphp
                    @else
                        @php $description = $cons->description; @endphp
                    @endif
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" name="description" class="form-control" id="description" rows="4">{{$description}}</textarea>
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
                    <input type="submit" class="form-control btn btn-success" value="UPDATE">
                </div>
            </div>
        </fieldset>
    </form>
    @endforeach

@stop
