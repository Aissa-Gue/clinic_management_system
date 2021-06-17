@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center" role="alert">
        <h5>Medical Certificate</h5>
    </div>

    <div class="text-end mb-5">
        <ul class="nav nav-pills">
            <li class="nav-item fw-bold">
                <a href="/consultations/edit/{{$currentApp->id}}" class="nav-link {{Request::is('consultations/add/'.$currentApp->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-file-medical-alt"></i>  Consultation</a>
            </li>
            <li class="nav-item fw-bold">
                <a href="/consultations/prescriptions/{{$currentApp->id}}" class="nav-link {{Request::is('consultations/prescriptions/'.$currentApp->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-capsules"></i> Prescription</a>
            </li>
            <li class="nav-item fw-bold">
                <a href="/consultations/certificates/{{$currentApp->id}}" class="nav-link {{Request::is('consultations/certificates/'.$currentApp->id) ? 'active':''}}" type="button" aria-selected="false"><i class="far fa-file-alt"></i> Certificate</a>
            </li>
            <li class="nav-item fw-bold">
                <a href="/consultations/history/{{$currentApp->id}}" class="nav-link {{Request::is('consultations/history/'.$currentApp->id) ? 'active':''}}" type="button" aria-selected="false"><i class="fas fa-history"></i> History</a>
            </li>
        </ul>
    </div>

    <form action="/consultations/certificates/{{$currentApp->id}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-success">Patient informations</legend>
            <div class="row mb-3">
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Patient name</span>
                        <input type="hidden" name="pat_id" value="{{$currentApp->patient->id}}">
                        <input type="text" name="patient" class="form-control" value="{{$currentApp->patient->first_name}} {{$currentApp->patient->last_name}}" disabled>
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Age</span>
                        <input type="text" name="birthdate" class="form-control" value="{{$currentApp->patient->birthdate}} / {{\Carbon\Carbon::parse($currentApp->patient->birthdate)->age}} years old" disabled>
                    </div>
                </div>

                <input type="hidden" name="doc_id" value="{{$currentApp->doctor->id}}">

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Doctor</span>
                        <input type="text" name="doctor" class="form-control" value="{{$currentApp->doctor->first_name}} {{$currentApp->doctor->last_name}}" disabled>
                    </div>
                </div>

                <div class="col-md-6 mb-1">
                    <div class="input-group">
                        <span class="input-group-text">Date</span>
                        <input type="text" name="date" class="form-control" value="{{$currentApp->date}} | {{\Carbon\Carbon::parse($currentApp->time)->format('H:i')}}" disabled>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-success">Details</legend>

            <div class="row">
                <div class="col-md-6">
                    <label for="from_date" class="form-label col-md-6">From date:</label>
                    <label for="to_date" class="form-label">To date: </label>
                    <div class="input-group mb-3">
                        @if($currentCert['id'] != null)
                            <a href="{{URL('consultations/certificates/delete/'.$currentCert['id'])}}" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        @endif
                        <input type="date" class="form-control" name="from_date" id="from_date" value="{{$currentCert['from_date']}}">
                        <input type="date" class="form-control" name="to_date" id="to_date" value="{{$currentCert['to_date']}}">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                    @if(!empty($messages))
                        @foreach ($messages->get('from_date') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                    @if(!empty($messages))
                        @foreach ($messages->get('to_date') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>

                <div class="col-sm-12 text-end">
                    <a href="{{ url('/consultations/certificates/print/'.$currentApp->id) }}" class="btn btn-success px-4">Print</a>
                    <a href="{{ url('/consultations/certificates/print/'.$currentApp->id) }}" class="btn btn-primary">Download PDF</a>
                </div>
            </div>
        </fieldset>
    </form>
@stop
