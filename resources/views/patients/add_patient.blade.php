@extends('layouts.master')

@section('content')
    <div class="alert alert-info text-center" role="alert">
        <h5>Insert New Patient</h5>
    </div>
    <form action="/patients/add_patient" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-info">Patient informations</legend>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="first_name" class="form-label">First name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name">
                </div>
                <div class="col-md-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" name="birthdate" class="form-control" id="birthdate">
                </div>
                <div class="col-md-2">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select" id="gender" required>
                        <option disabled selected>- select gender -</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address">
                </div>
                <div class="col-md-3">
                    <label for="city" class="form-label">City</label>
                    <select name="city" class="form-select" id="city" required>
                        <option disabled selected>- select city -</option>
                        @foreach($city as $cit)
                        <option value="{{$cit->id}}">
                            @if($cit->id < 10)
                                0{{$cit->id}}- {{$cit->city}}
                            @else
                                {{$cit->id}}- {{$cit->city}}
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" pattern="\d*" maxlength="10" name="phone" class="form-control" id="phone">
                </div>
                <div class="col-md-2">
                    <label for="" class="form-label">&puncsp;</label>
                    <input type="submit" class="form-control btn btn-success" value="SAVE">
                </div>
            </div>
        </fieldset>
    </form>
@stop
