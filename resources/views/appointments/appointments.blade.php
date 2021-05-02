@extends('layouts.master')

@section('content')
    <ul class="nav nav-pills mt-2" id="pills-tab" role="tablist">
        <li class="nav-link fw-bold">DOCTORS: </li>
        @foreach($doctor as $doc)
            <li class="nav-item fw-bold" role="presentation">
                <a href="/appointments/{{$doc->id}}" class="nav-link {{Request::is('appointments/'.$doc->id) ? 'active':''}}" type="button" aria-selected="false">{{$doc->first_name}} {{$doc->last_name}} {{$doc->spec_id}}</a>
            </li>
        @endforeach
    </ul>

    <div class="row mb-2">
        <nav class="navbar navbar-dark bg-light mt-3">
            <form action="/add_appointment" method="post" class="d-flex col-md-9">
                @csrf
                <input list="patients" name="patient_name" class="form-control me-1" placeholder="Patient name">
                <datalist id="patients">
                    @foreach($patient as $pat)
                        <option value="{{$pat->id}} - {{$pat->first_name}} {{$pat->last_name}}"></option>
                    @endforeach
                </datalist>

                <input type="hidden" name="doctor_id" class="form-control me-1" value="{{$currentDocId->id}}">

                <input type="date" name="date" class="form-control me-1">
                <select name="time" class="form-select" id="time" required>

                    <option disabled selected>- select time -</option>
                    @foreach($agenda as $tim)
                        <option value="{{$tim->time}}">
                            {{\Carbon\Carbon::parse($tim->time)->format('H:i')}}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
            </form>
        </nav>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Patient</th>
                <th scope="col">Birthdate</th>
                <th scope="col">Doctor</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col" class="text-center">Preview</th>
                <th scope="col" class="text-center">Edit</th>
                <th scope="col" class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($appointment as $app)
                <tr>
                    <th scope="row">{{$app->id}}</th>
                    <td>{{$app->patient->first_name}} {{$app->patient->last_name}}</td>
                    <td>{{$app->patient->birthdate}}</td>
                    <td>{{$app->doctor->first_name}} {{$app->doctor->last_name}}</td>
                    <td>{{$app->date}}</td>
                    <td>{{$app->time}}</td>
                    <td class="text-center">
                        <a class="btn btn-outline-success" href="/preview_appointment/{{$app->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                            </svg>
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-outline-primary" href="/update_appointment/{{$app->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-outline-danger" href="/delete_appointment/{{$app->id}}">
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
@stop
