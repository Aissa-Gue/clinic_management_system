@extends('layouts.master')

@section('content')
    <div class="alert alert-danger text-center" role="alert">
        <h5>Update Medication</h5>
    </div>
    <form action="/medications/update_medication/{{$medication->id}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-danger">Medication informations</legend>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="commercial_name" class="form-label">Commercial name</label>
                    <input type="text" name="commercial_name" class="form-control" id="commercial_name" value="{{$medication->commercial_name}}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="scientific_name" class="form-label">Scientific name</label>
                    <input type="text" name="scientific_name" class="form-control" id="scientific_name" value="{{$medication->scientific_name}}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" placeholder="Leave a description here" id="description" style="height: 100px">{{$medication->description}}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="" class="form-label">&puncsp;</label>
                    <input type="submit" class="form-control btn btn-success" value="SAVE" onclick="return confirm('Are you sure?')">
                </div>
            </div>
        </fieldset>
    </form>
@stop
