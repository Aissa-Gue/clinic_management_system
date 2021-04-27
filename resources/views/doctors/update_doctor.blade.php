@extends('layouts.master')

@section('content')
    <div class="alert alert-info text-center mb-4" role="alert">
        <h5>Update Doctor</h5>
    </div>
    <form action="/update_doctor/{{$doctor->id}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-info">Personal informations</legend>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="first_name" class="form-label">First name</label>
                    <input type="hidden" name="pat_id" class="form-control" id="pat_id" value="{{$doctor->id}}">
                    <input type="text" name="first_name" class="form-control" id="first_name" value="{{$doctor->first_name}}">
                </div>
                <div class="col-md-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" value="{{$doctor->last_name}}">
                </div>
                <div class="col-md-2">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select" id="gender" required>
                        <option disabled selected>- select gender -</option>
                        <option value="Male" @if($doctor->gender == 'Male') {{'selected'}} @endif>Male</option>
                        <option value="Female" @if($doctor->gender == 'Female') {{'selected'}} @endif>Female</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" name="birthdate" class="form-control" id="birthdate" value="{{$doctor->birthdate}}">
                </div>
                <div class="col-md-3">
                    <label for="speciality" class="form-label">speciality</label>
                    <select name="speciality" class="form-select" id="speciality" required>
                        <option disabled selected>- select Speciality -</option>
                        @foreach($speciality as $spec)
                            <option value="{{$spec}}" @if($doctor->speciality == $spec) {{'selected'}} @endif>
                                {{$spec}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{$doctor->address}}">
                </div>
                <div class="col-md-3">
                    <label for="city" class="form-label">City</label>
                    <select name="city" class="form-select" id="city" required>
                        <option disabled selected>- select city -</option>
                        @foreach($city as $cit)
                        <option value="{{$cit->id}}" @if($doctor->city_id == $cit->id) {{'selected'}} @endif>
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
                    <input type="email" name="email" class="form-control" id="email" value="{{$doctor->email}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" pattern="\d*" maxlength="10" name="phone" class="form-control" id="phone" value="{{$doctor->phone}}">
                </div>
                <div class="col-md-2">
                    <label for="" class="form-label">&puncsp;</label>
                    <input type="submit" class="form-control btn btn-success" value="SAVE">
                </div>
            </div>
        </fieldset>
    </form>
@stop
