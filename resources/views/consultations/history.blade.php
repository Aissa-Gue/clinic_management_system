@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center" role="alert">
        <h5>Consultations History</h5>
    </div>
    @foreach($currentApp as $app)
        <div class="text-end mb-5">
            <ul class="nav nav-pills">
                <li class="nav-item fw-bold">
                    <a href="/consultations/edit/{{$app->id}}" class="nav-link {{Request::is('consultations/add/'.$app->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-file-medical-alt"></i>  Consultation</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/prescriptions/{{$app->id}}" class="nav-link {{Request::is('consultations/prescriptions/'.$app->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-capsules"></i> Prescription</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/certificates/{{$app->id}}" class="nav-link {{Request::is('consultations/certificates/'.$app->id) ? 'active':''}}" type="button" aria-selected="false"><i class="far fa-file-alt"></i> Certificate</a>
                </li>
                <li class="nav-item fw-bold">
                    <a href="/consultations/history/{{$app->id}}" class="nav-link {{Request::is('consultations/history/'.$app->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-history"></i> History</a>
                </li>
            </ul>
        </div>

        <form action="/consultations/certificates/{{$app->id}}" method="post">
            @csrf
            <fieldset class="scheduler-border">
                <legend class="scheduler-border bg-success">Patient informations</legend>
                <div class="row my-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">Patient name</span>
                            <input type="hidden" name="pat_id" value="{{$app->patient->id}}">
                            <input type="text" name="patient" class="form-control" value="{{$app->patient->first_name}} {{$app->patient->last_name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">Age</span>
                            <input type="text" name="birthdate" class="form-control" value="{{$app->patient->birthdate}} / {{\Carbon\Carbon::parse($app->patient->birthdate)->age}} years old" disabled>
                        </div>
                    </div>
                </div>
            </fieldset>
            @endforeach


            <fieldset class="scheduler-border">
                <legend class="scheduler-border bg-success">Consultations History</legend>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Cons-id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Speciality</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col" class="text-center">Preview</th>
                                    <th scope="col" class="text-center">Edit</th>
                                    <th scope="col" class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($appointments as $app)
                                <tr>
                                    <th scope="row" class="text-center">{{$app->consultation->id}}</th>
                                    <td>{{$app->consultation->created_at}}</td>
                                    <td>{{$app->consultation->created_at}}</td>
                                    <td>{{$app->doctor->speciality}}</td>
                                    <td>Dr. {{$app->doctor->first_name}} {{$app->doctor->last_name}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-success" href="/consultations/preview/{{$app->id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-primary" href="/consultations/edit/{{$app->id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteConsModal{{$app->id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
        </form>

@stop
