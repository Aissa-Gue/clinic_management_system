@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center fw-bold mt-2" role="alert">
        <h5>Doctors List</h5>
    </div>
    <div class="row mb-2">
        <nav class="navbar navbar-dark bg-light">
                <form action="/doctors" method="GET" class="d-flex">
                    <input class="form-control me-1" type="text" name="fname" placeholder="First name" value="{{request()->get('fname')}}">
                    <input class="form-control me-1" type="text" name="lname" placeholder="Last name" value="{{request()->get('lname')}}">
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <div class="d-flex">
                    <a href="/doctors/add_doctor" class="btn btn-success">NEW <i class="fa fa-plus"></i></a>
                </div>
        </nav>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Gender</th>
                <th scope="col">Speciality</th>
                <th scope="col">Birthdate</th>
                <th scope="col" class="text-center">Preview</th>
                <th scope="col" class="text-center">Edit</th>
                <th scope="col" class="text-center">Delete</th>
            </tr>
            </thead>
            <tbody>

            @forelse($doctor as $doc)
            @empty
                <div class="alert alert-danger text-center" role="alert">
                    No results found for:
                    <strong>{{request()->get('fname')}} {{request()->get('lname')}}</strong>
                </div>
            @endforelse

            @foreach($doctor as $doc)
            <tr>
                <th scope="row">{{$doc->id}}</th>
                <td>{{$doc->first_name}}</td>
                <td>{{$doc->last_name}}</td>
                <td>{{$doc->gender}}</td>
                <td>{{$doc->speciality}}</td>
                <td>{{$doc->birthdate}}</td>
                <td class="text-center">
                    <a class="btn btn-outline-success" href="/doctors/preview_doctor/{{$doc->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                        </svg>
                    </a>
                </td>
                <td class="text-center">
                    <a class="btn btn-outline-primary" href="/doctors/update_doctor/{{$doc->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path
                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                        </svg>
                    </a>
                </td>
                <td class="text-center">
                    <a class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteDocModal{{$doc->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path
                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                        </svg>
                    </a>
                </td>
                @include('doctors.delete_doctor')
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
