@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center" role="alert">
        <h5>Edit Appointment</h5>
    </div>


    <form action="/appointments/update_appointment/{{$app_id}}" method="post" class="col-md-9">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-success">Appointment informations</legend>

            <input type="hidden" name="doc_id" class="form-control mb-2" value="{{$doc_id}}">
            <input type="hidden" name="app_id" class="form-control mb-2" value="{{$app_id}}">

            <div class="col-md-5 mb-3 mt-5">
                <label for="patient" class="form-label">Patient</label>
                <input type="text" name="patient_name" class="form-control" value="{{$patient_name}}" readonly>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="patient" class="form-label">Date</label>
                    <input type="date" name="app_date" class="form-control" value="{{$app_date}}" readonly>
                </div>

                <div class="col-md-3 mb-4">
                    <label for="patient" class="form-label">Times</label>
                    <select name="app_time" class="form-select" id="time" required>
                        @foreach($agenda as $tim)
                            <option value="{{$tim->time}}">
                                {{\Carbon\Carbon::parse($tim->time)->format('H:i')}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <a href="{{URL('/appointments/'.$doc_id)}}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Save changes</button>
        </fieldset>
    </form>
@stop
