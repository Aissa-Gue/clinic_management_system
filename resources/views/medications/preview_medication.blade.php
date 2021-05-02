@extends('layouts.master')

@section('content')
    <div class="alert alert-info text-center mb-4" role="alert">
        <h5>Medication Informations</h5>
    </div>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border bg-info">General informations</legend>
        <div class="row justify-content-md-end">
            <div class="col-md-auto">
                <a href="/medications/update_medication/{{$medication->id}}" class="text-success">
                    <i class="fas fa-user-edit fs-3"></i><br>
                    <strong>Edit</strong>
                </a>
            </div>
            <div class="col-md-auto">
                <a href="/medications/delete_medication/{{$medication->id}}" class="text-danger">
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
