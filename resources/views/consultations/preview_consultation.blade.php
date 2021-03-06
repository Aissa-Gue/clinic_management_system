@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center" role="alert">
        <h5>Consultation Informations</h5>
    </div>
    @foreach($consultation as $cons)
        <div class="text-end mb-5">
            <ul class="nav nav-pills">
                <li class="nav-item fw-bold">
                    <a href="/consultations/preview/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/preview/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-file-medical-alt"></i> Consultation</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/prescriptions/preview/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/prescriptions/preview/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-capsules"></i> Prescription</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/certificates/preview/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/certificates/preview/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="far fa-file-alt"></i> Certificate</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/history/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/history/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-history"></i> History</a>
                </li>
            </ul>
        </div>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border bg-success">Patient informations</legend>
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
                            <span class="input-group-text">Doctor</span>
                            <input type="text" name="doctor" class="form-control" value="{{$cons->appointment->doctor->first_name}} {{$cons->appointment->doctor->last_name}}">
                        </div>
                    </div>
                    <input type="hidden" name="doc_id" value="{{$cons->appointment->doctor->id}}">


                    <div class="col-md-6 mb-1">
                        <div class="input-group">
                            <span class="input-group-text">Age</span>
                            <input type="text" name="birthdate" class="form-control" value="{{$cons->appointment->patient->birthdate}} / {{\Carbon\Carbon::parse($cons->appointment->patient->birthdate)->age}} years old">
                        </div>
                    </div>

                    <div class="col-md-6 mb-1">
                        <div class="input-group">
                            <span class="input-group-text">Date</span>
                            <input type="text" name="date" class="form-control" value="{{$cons->appointment->date}} | {{\Carbon\Carbon::parse($cons->appointment->time)->format('H:i')}}">
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-6">
                        <div class="input-group">
                            <span class="input-group-text">Paid amount</span>
                            <input type="text" maxlength="6" name="paid_amount" class="form-control" value="{{$cons->paid_amount}} DA">
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border bg-success">Consultation</legend>

                <dl class="row">
                    <dt class="col-md-2">Blood Type:</dt>
                    <dd class="col-md-4">{{$cons->appointment->patient->blood_type}}</dd>

                    <dt class="col-md-2">Blood Pressure</dt>
                    <dd class="col-md-4">{{$cons->appointment->patient->blood_pressure}}</dd>
                </dl>

                <dl class="row">
                    <dt class="col-md-2">Diabetes:</dt>
                    <dd class="col-md-4">{{$cons->appointment->patient->diabetes}}</dd>

                    <dt class="col-md-2">Temperature:</dt>
                    <dd class="col-md-4">{{$cons->temperature}} ??C</dd>
                </dl>

                <dl class="row">
                    <dt class="col-md-2">Length:</dt>
                    <dd class="col-md-4">{{$cons->length}} Cm</dd>

                    <dt class="col-md-2">Weight:</dt>
                    <dd class="col-md-4">{{$cons->weight}} Kg</dd>
                </dl>


                <dl class="row">
                    <dt class="col-md-2">Description:</dt>
                    <dd class="col-md-10">{{$cons->description}}</dd>
                </dl>
            </fieldset>
    @endforeach

@stop
