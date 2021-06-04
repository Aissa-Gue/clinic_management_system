@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center mb-4" role="alert">
        <h5>Doctor Informations</h5>
    </div>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border bg-success">Personal informations</legend>
        <div class="row justify-content-md-end">
            <div class="col-md-auto">
                <a href="/doctors/update_doctor/{{$doctor->id}}" class="text-success">
                    <i class="fas fa-user-edit fs-3"></i><br>
                    <strong>Edit</strong>
                </a>
            </div>
            <div class="col-md-auto">
                <a href="/doctors/delete_doctor/{{$doctor->id}}" class="text-danger" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-times fs-3"></i><br>
                    <strong>Del</strong>
                </a>
            </div>
        </div>

        <dl class="row">
            <dt class="col-md-2">Last name:</dt>
            <dd class="col-md-4">{{$doctor->last_name}}</dd>

            <dt class="col-md-2">Speciality:</dt>
            <dd class="col-md-4">{{$doctor->speciality->speciality}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">First name:</dt>
            <dd class="col-md-4">{{$doctor->first_name}}</dd>

            <dt class="col-md-2">Address:</dt>
            <dd class="col-md-4">{{$doctor->address}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Birthdate:</dt>
            <dd class="col-md-4">{{$doctor->birthdate}}</dd>


            <dt class="col-md-2">City:</dt>
            <dd class="col-md-4">{{$doctor->city->city}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Age:</dt>
            <dd class="col-md-4">{{\Carbon\Carbon::parse($doctor->birthdate)->age}} years old</dd>


            <dt class="col-md-2">Email:</dt>
            <dd class="col-md-4">{{$doctor->email}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Gender:</dt>
            <dd class="col-md-4">{{$doctor->gender}}</dd>

            <dt class="col-md-2">Phone:</dt>
            <dd class="col-md-4">0{{$doctor->phone}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Created at:</dt>
            <dd class="col-md-4">{{$doctor->created_at}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Last update:</dt>
            <dd class="col-md-4">{{$doctor->updated_at}}</dd>
        </dl>
    </fieldset>
@stop
