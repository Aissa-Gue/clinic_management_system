@extends('layouts.master')

@section('content')

    @foreach($currentCons as $cons)
        <div class="alert alert-success text-center" role="alert">
            <h5>Certificate Details</h5>
        </div>
        <div class="text-end mb-5">
            <ul class="nav nav-pills">
                <li class="nav-item fw-bold">
                    <a href="/consultations/preview/{{$cons->appointment->id}}" class="nav-link {{Request::is('consultations/preview/'.$cons->appointment->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-file-medical-alt"></i> Consultations</a>
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
                        <span class="input-group-text">Patient </span>
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
            </div>
        </fieldset>

        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-success mb-3">Medical Certificate</legend>
            <p class="fs-5">
                I undersigned <strong> Dr. {{$cons->appointment->doctor->first_name}} {{$cons->appointment->doctor->last_name}}</strong>, certify that: <strong> {{$cons->appointment->patient->first_name}} {{$cons->appointment->patient->last_name}}</strong>  was born on <strong> {{$cons->appointment->patient->birthdate}} </strong> is present on this day for my consultation.
            </p>
            <p class="fs-5">
                His/her state of health requires a <strong>{{$days_nbr}} days</strong> work stoppage, from <strong> {{$certificate['from_date']}}.</strong>
            </p>
            <p class="fs-5">
                this certificate has been issued to the interested party to serve and validate what is right.
            </p>

            <div class="row">
                <div class="col-sm-12 text-end">
                    <a href="{{ url('/consultations/certificates/print/'.$cons->appointment->id) }}" class="btn btn-success px-4">Print</a>
                    <a href="{{ url('/consultations/certificates/print/'.$cons->appointment->id) }}" class="btn btn-primary">Download PDF</a>
                </div>
            </div>
        </fieldset>
    @endforeach
@stop
