@extends('layouts.master')

@section('content')
    <div class="alert alert-info text-center mb-4" role="alert">
        <h5>Patient Informations</h5>
    </div>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border bg-info">Personal informations</legend>
        <div class="row justify-content-md-end">
            <div class="col-md-auto">
                <a href="/patients/update_patient/{{$patient->id}}" class="text-success">
                    <i class="fas fa-user-edit fs-3"></i><br>
                    <strong>Edit</strong>
                </a>
            </div>
            <div class="col-md-auto">
                <a href="/patients/delete_patient/{{$patient->id}}" class="text-danger">
                    <i class="fas fa-times fs-3"></i><br>
                    <strong>Del</strong>
                </a>
            </div>
        </div>

        <dl class="row">
            <dt class="col-md-2">Last name:</dt>
            <dd class="col-md-4">{{$patient->last_name}}</dd>

            <dt class="col-md-2">Address:</dt>
            <dd class="col-md-4">{{$patient->address}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">First name:</dt>
            <dd class="col-md-4">{{$patient->first_name}}</dd>

            <dt class="col-md-2">City:</dt>
            <dd class="col-md-4">{{$patient->city->city}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Birthdate:</dt>
            <dd class="col-md-4">{{$patient->birthdate}}</dd>

            <dt class="col-md-2">Email:</dt>
            <dd class="col-md-4">{{$patient->email}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Age:</dt>
            <dd class="col-md-4">{{\Carbon\Carbon::parse($patient->birthdate)->age}} years old</dd>

            <dt class="col-md-2">Phone:</dt>
            <dd class="col-md-4">0{{$patient->phone}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Gender:</dt>
            <dd class="col-md-4">{{$patient->gender}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">First visit:</dt>
            <dd class="col-md-4">{{$patient->created_at}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Last update:</dt>
            <dd class="col-md-4">{{$patient->updated_at}}</dd>
        </dl>
    </fieldset>
@stop
