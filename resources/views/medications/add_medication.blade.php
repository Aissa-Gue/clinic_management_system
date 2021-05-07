@extends('layouts.master')

@section('content')
    <div class="alert alert-info text-center" role="alert">
        <h5>Insert New Medication</h5>
    </div>
    <form action="/medications/add_medication" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-info">Medication informations</legend>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="commercial_name" class="form-label">Commercial name</label>
                    <input type="text" name="commercial_name" class="form-control" id="commercial_name" value="{{request()->get('commercial_name')}}">
                </div>
                @if(!empty($messages))
                    @foreach ($messages->get('commercial_name') as $message)
                        <div class="form-text text-danger">{{$message}}</div>
                    @endforeach
                @endif
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="scientific_name" class="form-label">Scientific name</label>
                    <input type="text" name="scientific_name" class="form-control" id="scientific_name" value="{{request()->get('scientific_name')}}">
                </div>
                @if(!empty($messages))
                    @foreach ($messages->get('scientific_name') as $message)
                        <div class="form-text text-danger">{{$message}}</div>
                    @endforeach
                @endif
            </div>

            <div class="row">
                <div class="col-md-5">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" placeholder="Leave a description here" id="description" style="height: 100px"></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="" class="form-label">&puncsp;</label>
                    <input type="submit" class="form-control btn btn-success" value="SAVE">
                </div>
            </div>
        </fieldset>
    </form>
@stop
