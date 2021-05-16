@extends('layouts.master')

@section('content')
    <div class="alert alert-danger text-center" role="alert">
        <h5>Add Prescription</h5>
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
                    <a href="/consultations/certificates/add/{{$app->id}}" class="nav-link {{Request::is('consultations/certificates/add/'.$app->id) ? 'active':''}}" type="button" aria-selected="false">Certificate</a>
                </li>
            </ul>
        </div>
        <form action="/consultations/prescriptions/add/{{$app->id}}" method="post" id="pres_medic_form">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-danger">Patient informations</legend>
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
            </div>
        </fieldset>

        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-danger">Details</legend>

            <div class="row">
                <div class="col-md-4">
                    <label for="medication" class="form-label">Medication</label>
                </div>
                <div class="col-md-6">
                    <label for="dosage" class="form-label">Dosage</label>
                </div>
                <div class="col-md-1">
                    <label for="quantity" class="form-label">Qte</label>
                </div>
            </div>
            @foreach($pres_medics as $pres_medic)
                <div class="row">
                    <div class="col-md-4 mb-1">
                        <input type="text" class="form-control" value="{{$pres_medic->medication['commercial_name']}}">
                    </div>
                    <div class="col-md-6 mb-1">
                        <input type="text" class="form-control" value="{{$pres_medic->dosage}}">
                    </div>
                    <div class="col-md-1 mb-1">
                        <input type="text" class="form-control text-center" value="{{$pres_medic->quantity}}">
                    </div>
                    <div class="col-md-auto pt-1 my_cursor_pointer my_hover_del">
                        <a href="/consultations/prescriptions/deleteMed/{{$pres_medic->pres_id}}/{{$pres_medic->medic_id}}"><i class="fas fa-minus-circle fs-3 text-danger"></i></a>
                    </div>
                </div>
            @endforeach

            <div class="row">
                <div class="col-md-4 mb-1">
                    <input list="medications" name="medication" class="form-control" id="medication" value="{{request()->get('medication')}}">
                    <datalist id="medications">
                        @foreach($medications as $medic)
                            <option value="{{$medic->id}} - {{$medic->commercial_name}}"></option>
                        @endforeach
                    </datalist>
                    @if(!empty($messages))
                        @foreach ($messages->get('medication') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-6 mb-1">
                    <input type="text" name="dosage" class="form-control" id="dosage" value="{{request()->get('dosage')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('dosage') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-1 mb-1">
                    <input type="text" name="quantity" class="form-control text-center" id="quantity" value="{{request()->get('quantity')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('quantity') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>

                <div class="col-md-auto pt-1 my_cursor_pointer my_hover_del" id="addMedication">
                    <a href="javascript:document.getElementById('pres_medic_form').submit();"><i class="fas fa-plus-circle fs-3 text-success"></i></a>
                </div>
            </div>
        </fieldset>
    </form>
    @endforeach

@stop
