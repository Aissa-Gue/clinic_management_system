@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center fw-bold mt-2" role="alert">
        Dr: {{$currentDoc->first_name}} {{$currentDoc->last_name}}
    </div>

    <div class="row mb-2">
        <nav class="navbar navbar-dark bg-light">
            <form action="/medical_records/{{$currentDoc->id}}" method="GET" class="d-flex">
                <input class="form-control me-1" type="text" name="fname" placeholder="First name" value="{{request()->get('fname')}}">
                <input class="form-control me-1" type="text" name="lname" placeholder="Last name" value="{{request()->get('lname')}}">
                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </nav>
    </div>


    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr class="text-secondary">
                <th scope="col" class="text-center">Pat-id</th>
                <th scope="col"><i class="fa fa-user-injured"></i> Patient</th>
                <th scope="col" class="text-center"><i class="fa fa-calendar-alt"></i> Birthdate</th>
                <th scope="col" class="text-center"><i class="fa fa-calendar-alt"></i> Latest Consultation</th>
                <th scope="col" class="text-center"><i class="fa fa-user-md"></i> Total Consultations</th>
                <th scope="col" class="text-center">Preview</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cons_records as $rec)
            @empty
                <div class="alert alert-danger text-center" role="alert">
                    No results found for:
                    <strong>{{request()->get('fname')}} {{request()->get('lname')}}</strong>
                </div>
            @endforelse
            @foreach($cons_records as $rec)
                <tr>
                    <th scope="row" class="text-center">{{$rec->pat_id}}</th>
                    <td>{{$rec->first_name}} {{$rec->last_name}}</td>
                    <td class="text-center">{{$rec->birthdate}}</td>
                    <td class="text-center">{{$rec->date}}</td>
                    <td class="text-center text-danger fw-bold">{{$rec->cons_nbr}}</td>
                    <td class="text-center">
                        <a class="btn btn-outline-success" href="/medical_records/patient_History/{{$rec->app_id}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop



