@extends('layouts.master')

@section('content')
    <div class="alert alert-danger text-center" role="alert">
        <h5>Edit Consultation</h5>
    </div>
    @foreach($consultation as $cons)
        <div class="text-end mb-5">
        <ul class="nav nav-pills">
            <li class="nav-item fw-bold">
                <a href="/consultations/edit/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/edit/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false">Consultations</a>
            </li>
            <li class="nav-item fw-bold">
                <a href="/consultations/prescriptions/edit/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/prescriptions/edit/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false">Prescription</a>
            </li>
            <li class="nav-item fw-bold">
                <a href="/consultations/certificates/edit/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/prescriptions/edit/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false">Certificate</a>
            </li>
        </ul>
    </div>
    <form action="/consultations/edit/{{$cons->appointment->id}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-danger">General informations</legend>
            <div class="row mb-3">
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Patient name</span>
                        <input type="hidden" name="pat_id" value="{{$cons->appointment->patient->id}}">
                        <input type="text" name="patient" class="form-control" value="{{$cons->appointment->patient->first_name}} {{$cons->appointment->patient->last_name}}">
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Age</span>
                        <input type="text" name="birthdate" class="form-control" value="{{$cons->appointment->patient->birthdate}} / {{\Carbon\Carbon::parse($cons->appointment->patient->birthdate)->age}} years old">
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        @if(request()->get('blood_type') != "")
                            @php $blood_type = request()->get('blood_type'); @endphp
                        @else
                            @php $blood_type = $cons->appointment->patient->blood_type; @endphp
                        @endif
                        <span class="input-group-text">Blood type</span>
                        <input type="text" maxlength="3" name="blood_type" class="form-control" value="{{$blood_type}}">
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
                        <input type="text" name="doctor" class="form-control" value="{{$cons->appointment->doctor->first_name}} {{$cons->appointment->doctor->last_name}}">
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        @if(request()->get('blood_pressure') != "")
                            @php $blood_pressure = request()->get('blood_pressure'); @endphp
                        @else
                            @php $blood_pressure = $cons->appointment->patient->blood_pressure; @endphp
                        @endif
                        <span class="input-group-text">Blood pressure</span>
                        <input type="text" name="blood_pressure" class="form-control" value="{{$blood_pressure}}">
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Date</span>
                        <input type="text" name="date" class="form-control" value="{{$cons->appointment->date}} | {{\Carbon\Carbon::parse($cons->appointment->time)->format('H:i')}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        @if(request()->get('diabetes') != "")
                            @php $diabetes = request()->get('diabetes'); @endphp
                        @else
                            @php $diabetes = $cons->appointment->patient->diabetes; @endphp
                        @endif
                        <span class="input-group-text">Diabetes</span>
                        <input type="text" name="diabetes" class="form-control" value="{{$diabetes}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        @if(request()->get('paid_amount') != "")
                            @php $paid_amount = request()->get('paid_amount'); @endphp
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
            <legend class="scheduler-border bg-danger">Consultation</legend>

            <div class="row mb-3">
                <div class="col-md-4">
                    @if(request()->get('weight') != "")
                        @php $weight = request()->get('weight'); @endphp
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
                    @if(request()->get('length') != "")
                        @php $length = request()->get('length'); @endphp
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
                    @if(request()->get('temperature') != "")
                        @php $temperature = request()->get('temperature'); @endphp
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
                    @if(request()->get('description') != "")
                        @php $description = request()->get('description'); @endphp
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
