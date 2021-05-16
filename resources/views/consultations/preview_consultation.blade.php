@extends('layouts.master')

@section('content')
    <div class="alert alert-danger text-center" role="alert">
        <h5>Consultation Informations</h5>
    </div>
    @foreach($consultation as $cons)
        <div class="text-end mb-5">
            <ul class="nav nav-pills">
                <li class="nav-item fw-bold">
                    <a href="/consultations/preview/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/preview/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false">Consultations</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/prescriptions/preview/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/prescriptions/preview/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false">Prescription</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/certificates/preview/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/prescriptions/preview/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false">Certificate</a>
                </li>
            </ul>
        </div>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border bg-danger">Patient informations</legend>
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
                            <span class="input-group-text">Blood type</span>
                            <input type="text" maxlength="3" name="blood_type" class="form-control" value="{{$blood_type = $cons->appointment->patient->blood_type}}">
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
                            <span class="input-group-text">Blood pressure</span>
                            <input type="text" name="blood_pressure" class="form-control" value="{{$cons->appointment->patient->blood_pressure}}">
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
                            <span class="input-group-text">Diabetes</span>
                            <input type="text" name="diabetes" class="form-control" value="{{$cons->appointment->patient->diabetes}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">Paid amount</span>
                            <input type="text" maxlength="6" name="paid_amount" class="form-control" value="{{$cons->paid_amount}} DA">
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border bg-danger">Consultation</legend>

                <dl class="row">
                    <dt class="col-md-2">Weight (Kg):</dt>
                    <dd class="col-md-4">{{$cons->weight}}</dd>
                </dl>

                <dl class="row">
                    <dt class="col-md-2">Length (Cm):</dt>
                    <dd class="col-md-4">{{$cons->length}}</dd>
                </dl>

                <dl class="row">
                    <dt class="col-md-2">Temperature (°C):</dt>
                    <dd class="col-md-4">{{$cons->temperature}}</dd>
                </dl>

                <dl class="row">
                    <dt class="col-md-2">Description:</dt>
                    <dd class="col-md-10">{{$cons->description}}</dd>
                </dl>
            </fieldset>
    @endforeach

@stop
