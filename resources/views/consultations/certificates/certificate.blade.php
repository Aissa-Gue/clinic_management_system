@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center" role="alert">
        <h5>Medical Certificate</h5>
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
                <div class="row mb-3">
                    <div class="col-md-6 mb-1">
                        <div class="input-group">
                            <span class="input-group-text">Patient name</span>
                            <input type="hidden" name="pat_id" value="{{$app->patient->id}}">
                            <input type="text" name="patient" class="form-control" value="{{$app->patient->first_name}} {{$app->patient->last_name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <div class="input-group">
                            <span class="input-group-text">Age</span>
                            <input type="text" name="birthdate" class="form-control" value="{{$app->patient->birthdate}} / {{\Carbon\Carbon::parse($app->patient->birthdate)->age}} years old" disabled>
                        </div>
                    </div>

                    <input type="hidden" name="doc_id" value="{{$app->doctor->id}}">

                    <div class="col-md-6 mb-1">
                        <div class="input-group">
                            <span class="input-group-text">Doctor</span>
                            <input type="text" name="doctor" class="form-control" value="{{$app->doctor->first_name}} {{$app->doctor->last_name}}" disabled>
                        </div>
                    </div>

                    <div class="col-md-6 mb-1">
                        <div class="input-group">
                            <span class="input-group-text">Date</span>
                            <input type="text" name="date" class="form-control" value="{{$app->date}} | {{\Carbon\Carbon::parse($app->time)->format('H:i')}}" disabled>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border bg-success">Details</legend>

                <div class="row">
                    <div class="col-md-6">
                        <label for="from_date" class="form-label col-md-5">From date:</label>
                        <label for="to_date" class="form-label">To date: </label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" name="from_date" id="from_date" value="{{$app->consultation->certificate['from_date']}}">
                            <input type="date" class="form-control" name="to_date" id="to_date" value="{{$app->consultation->certificate['to_date']}}">
                            <button class="btn btn-outline-success" type="submit">Save</button>
                        </div>
                    </div>

                    <div class="col-sm-12 text-end">
                        <a href="{{ url('/consultations/certificates/print/'.$app->id) }}" class="btn btn-success px-4">Print</a>
                        <a href="{{ url('/consultations/certificates/print/'.$app->id) }}" class="btn btn-primary">Download PDF</a>
                    </div>
                </div>
            </fieldset>
        </form>
    @endforeach

@stop
