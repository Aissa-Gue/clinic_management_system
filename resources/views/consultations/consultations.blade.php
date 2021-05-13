@extends('layouts.master')

@section('content')
    <ul class="nav nav-pills mt-2" id="pills-tab" role="tablist">
        <li class="nav-link fw-bold">SPECIALITIES: </li>
        @foreach($doctor as $doc)
            <li class="nav-item fw-bold" role="presentation">
                <a href="/consultations/{{$doc->id}}" class="nav-link {{Request::is('consultations/'.$doc->id) ? 'active':''}}" type="button" aria-selected="false">{{$doc->speciality->speciality}}</a>
            </li>
        @endforeach
    </ul>

    <div class="alert alert-danger text-center fw-bold mt-2" role="alert">
        Dr: {{$currentDoc->first_name}} {{$currentDoc->last_name}}
    </div>


    <div class="row mb-2">
        <nav class="navbar navbar-dark bg-light">
            <form action="/consultations/add" method="post" class="d-flex col-md-4">
                @csrf

                <div class="input-group mb-3">
                    <input list="patients" name="patient" class="form-control" placeholder="Patient name">
                    <datalist id="patients">
                        @foreach($appointment as $app)
                            <option value="{{$app->id}} - {{$app->patient->first_name}} {{$app->patient->last_name}}"></option>
                        @endforeach
                    </datalist>
                    @if(!empty($errors))
                        @foreach ($errors->get('patient_id') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                    <button class="btn btn-success col-md-auto" type="submit">NEW <i class="fa fa-plus"></i></button>
                </div>
            </form>
        </nav>
    </div>


    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr class="text-secondary">
                <th scope="col">Id</th>
                <th scope="col"><i class="fa fa-user-injured"></i> Patient</th>
                <th scope="col" class="text-center"><i class="fa fa-calendar-alt"></i> Birthdate</th>
                <th scope="col" class="text-center"><i class="fa fa-info-circle"></i> Status</th>
                <th scope="col" class="text-center"><i class="fa fa-calendar-alt"></i> Date</th>
                <th scope="col" class="text-center"><i class="fa fa-clock"></i> Time</th>
                <th scope="col" class="text-center">Preview</th>
                <th scope="col" class="text-center">Edit</th>
                <th scope="col" class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($consultation as $cons)
                <tr>
                    <th scope="row">{{$cons->id}}</th>
                    <td>{{$cons->appointment->patient->first_name}} {{$cons->appointment->patient->last_name}}</td>
                    <td class="text-center">{{$cons->appointment->patient->birthdate}}</td>
                    <td class="text-success text-center"><i class="fa fa-check-circle"></i> Done</td>
                    <!--<td class="text-warning"><i class="fa fa-pause-circle"></i> Waiting</td>
                    <td class="text-danger"><i class="fa fa-times-circle"></i> Canceled</td>-->
                    <td class="text-center">{{$cons->appointment->date}}</td>
                    <td class="text-center">{{\Carbon\Carbon::parse($cons->appointment->time)->format('H:i')}}</td>
                    <td class="text-center">
                        <a class="btn btn-outline-success" href="/patients/preview_patient/{{$cons->appointment->patient->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                            </svg>
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editAppModal{{$cons->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                <path
                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteConsModal{{$cons->id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                            </svg>
                        </a>
                    </td>
                    @include('consultations.delete_consultation')
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop



