@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center mb-4" role="alert">
        <h5>Medication Informations</h5>
    </div>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border bg-success">General informations</legend>

        @isset($notification)
            <div class="alert alert-danger text-center fw-bold mb-3" role="alert">
                {{$notification}} <br>
                <form action="{{URL('/medications/delete_medication/'.$medication->id)}}" method="get">
                    <input type="hidden" name="confirm" value="ok">
                    <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">
                        <strong>DELETE ANYWAY !</strong>
                    </button>
                </form>

            </div>
        @endisset

        <div class="row justify-content-md-end">
            <div class="col-md-auto">
                <a href="/medications/update_medication/{{$medication->id}}" class="text-success">
                    <i class="fas fa-edit fs-3"></i><br>
                    <strong>Edit</strong>
                </a>
            </div>
            <div class="col-md-auto">
                <a href="/medications/delete_medication/{{$medication->id}}" class="text-danger" onclick="return confirm('Are you sure?')">
                    <i class="fas fa-times fs-3"></i><br>
                    <strong>Del</strong>
                </a>
            </div>
        </div>

        <dl class="row">
            <dt class="col-md-2">Med id:</dt>
            <dd class="col-md-4">{{$medication->id}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Commercial name:</dt>
            <dd class="col-md-4">{{$medication->commercial_name}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Scientific name:</dt>
            <dd class="col-md-4">{{$medication->scientific_name}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Description:</dt>
            <dd class="col-md-4">{{$medication->description}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Created at:</dt>
            <dd class="col-md-4">{{$medication->created_at}}</dd>
        </dl>

        <dl class="row">
            <dt class="col-md-2">Last update:</dt>
            <dd class="col-md-4">{{$medication->updated_at}}</dd>
        </dl>
    </fieldset>
@stop
