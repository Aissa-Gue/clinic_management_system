@extends('layouts.master')

@section('content')
    <div class="alert alert-danger text-center fw-bold mt-2" role="alert">
        <h5>Time Planning</h5>
    </div>

    <div class="row mb-2">
        <nav class="navbar navbar-dark bg-light">
            <form action="/planning/add_time" method="post" class="d-flex">
                @csrf
                <div class="input-group mb-3">
                    <input type="time" name="time" class="form-control" placeholder="add time">
                    <button class="btn btn-success" type="submit">NEW <i class="fa fa-plus"></i></button>
                </div>
            </form>
        </nav>
    </div>

    <div class="row">
        @foreach($agenda as $age)
            <div class="col-md-3 mb-2">
                <form action="/planning/update_time/{{$age->id}}" method="post" class="d-flex">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="time" class="form-control" name="time" value="{{$age->time}}">
                        <button type="submit" class="btn btn-outline-success" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a data-bs-toggle="modal" data-bs-target="#deletePlanModal{{$age->id}}" class="btn btn-outline-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        @include('planning.delete_planning')
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@stop
