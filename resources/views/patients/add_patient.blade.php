@extends('layouts.master')

@section('content')
    <div class="alert alert-danger text-center" role="alert">
        <h5>Add New Patient</h5>
    </div>

    <form action="/patients/add_patient" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-danger">Patient informations</legend>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="first_name" class="form-label">First name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" value="{{request()->get('first_name')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('first_name') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" value="{{request()->get('last_name')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('last_name') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" name="birthdate" class="form-control" id="birthdate" value="{{request()->get('birthdate')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('birthdate') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-auto">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select" id="gender" required>
                        <option disabled selected>- select gender -</option>
                        <option value="Male" @if(request()->get('gender') == 'Male') {{'selected'}} @endif >Male</option>
                        <option value="Female" @if(request()->get('gender') == 'Female') {{'selected'}} @endif>Female</option>
                    </select>
                    @if(!empty($messages))
                        @foreach ($messages->get('gender') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{request()->get('address')}}">
                </div>
                <div class="col-md-3">
                    <label for="city" class="form-label">City</label>
                    <select name="city" class="form-select" id="city" required>
                        <option disabled selected>- select city -</option>
                        @foreach($city as $cit)
                        <option value="{{$cit->id}}" @if(request()->get('city') == $cit->id) {{'selected'}} @endif>
                            @if($cit->id < 10)
                                0{{$cit->id}}- {{$cit->city}}
                            @else
                                {{$cit->id}}- {{$cit->city}}
                            @endif
                        </option>
                        @endforeach
                    </select>
                    @if(!empty($messages))
                        @foreach ($messages->get('city') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{request()->get('email')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('email') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" maxlength="10" name="phone" class="form-control" id="phone" value="{{request()->get('phone')}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('phone') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="" class="form-label">&puncsp;</label>
                    <input type="submit" class="form-control btn btn-success" value="SAVE">
                </div>
            </div>
        </fieldset>
    </form>
@stop
