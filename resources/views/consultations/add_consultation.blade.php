@extends('layouts.master')

@section('content')
    <div class="alert alert-danger text-center" role="alert">
        <h5>Add New Consultation</h5>
    </div>
    @foreach($currentApp as $app)
        <div class="text-end mb-5">
        <ul class="nav nav-pills">
            <li class="nav-item fw-bold">
                <a href="/consultations/add/{{$app->id}}" class="nav-link {{Request::is('consultations/add/'.$app->id) ? 'active':''}}" type="button" aria-selected="false">Consultations</a>
            </li>
            <li class="nav-item fw-bold">
                <a href="/consultations/prescriptions/add/{{$app->id}}" class="nav-link {{Request::is('consultations/prescriptions/add/'.$app->id) ? 'active':''}}" type="button" aria-selected="false">Prescription</a>
            </li>
            <li class="nav-item fw-bold">
                <a href="/consultations/certificates/add/{{$app->id}}" class="nav-link {{Request::is('consultations/prescriptions/add/'.$app->id) ? 'active':''}}" type="button" aria-selected="false">Certificate</a>
            </li>
        </ul>
    </div>
    <form action="/consultations/add/{{$app->id}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-danger">General informations</legend>
            <div class="row mb-3">
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Patient name</span>
                        <input type="hidden" name="pat_id" value="{{$app->patient->id}}">
                        <input type="text" name="patient" class="form-control" value="{{$app->patient->first_name}} {{$app->patient->last_name}}">
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Age</span>
                        <input type="text" name="birthdate" class="form-control" value="{{$app->patient->birthdate}} / {{\Carbon\Carbon::parse($app->patient->birthdate)->age}} years old">
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        @if(request()->get('blood_type') != "")
                            @php $blood_type = request()->get('blood_type'); @endphp
                        @else
                            @php $blood_type = $app->patient->blood_type; @endphp
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

                <input type="hidden" name="doc_id" value="{{$app->doctor->id}}">

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Doctor</span>
                        <input type="text" name="doctor" class="form-control" value="{{$app->doctor->first_name}} {{$app->doctor->last_name}}">
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        @if(request()->get('blood_pressure') != "")
                            @php $blood_pressure = request()->get('blood_pressure'); @endphp
                        @else
                            @php $blood_pressure = $app->patient->blood_pressure; @endphp
                        @endif
                        <span class="input-group-text">Blood pressure</span>
                        <input type="text" name="blood_pressure" class="form-control" value="{{$blood_pressure}}">
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Date</span>
                        <input type="text" name="date" class="form-control" value="{{$app->date}} | {{\Carbon\Carbon::parse($app->time)->format('H:i')}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        @if(request()->get('diabetes') != "")
                            @php $diabetes = request()->get('diabetes'); @endphp
                        @else
                            @php $diabetes = $app->patient->diabetes; @endphp
                        @endif
                        <span class="input-group-text">Diabetes</span>
                        <input type="text" name="diabetes" class="form-control" value="{{$diabetes}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">Paid amount</span>
                        <input type="text" maxlength="6" name="paid_amount" class="form-control" value="{{request()->get('paid_amount')}}">
                        @if(!empty($messages))
                            @foreach ($messages->get('paid_amount') as $message)
                                <div class="form-text text-danger">{{$message}}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-danger">Consultation</legend>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="weight" class="form-label">Weight (Kg)</label>
                    <input type="text" name="weight" class="form-control" id="weight" value="{{request()->get('weight')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('weight') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="length" class="form-label">Length (Cm)</label>
                    <input type="text" name="length" class="form-control" id="length" value="{{request()->get('length')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('length') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="temperature" class="form-label">Temperature (°C)</label>
                    <input type="text" name="temperature" class="form-control" id="temperature" value="{{request()->get('temperature')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('temperature') as $message)
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
