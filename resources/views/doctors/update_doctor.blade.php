@extends('layouts.master')

@section('content')
    <div class="alert alert-success text-center mb-4" role="alert">
        <h5>Update Doctor</h5>
    </div>
    <form action="/doctors/update_doctor/{{$doctor->id}}" method="post">
        @csrf
        <fieldset class="scheduler-border">
            <legend class="scheduler-border bg-success">Personal informations</legend>
            <div class="row mb-3">
                <div class="col-md-3">
                    @php
                        if(request('first_name') != ""){
                           $first_name = request('first_name');
                        }else{
                            $first_name = $doctor->first_name;
                        }
                    @endphp
                    <label for="first_name" class="form-label">First name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" value="{{$first_name}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('first_name') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-3">
                    @php
                        if(request('last_name') != ""){
                           $last_name = request('last_name');
                        }else{
                            $last_name = $doctor->last_name;
                        }
                    @endphp
                    <label for="last_name" class="form-label">Last name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" value="{{$last_name}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('last_name') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" class="form-select" id="gender" required>
                        <option disabled selected>- select gender -</option>
                        <option value="Male" @if($doctor->gender == 'Male') {{'selected'}} @endif>Male</option>
                        <option value="Female" @if($doctor->gender == 'Female') {{'selected'}} @endif>Female</option>
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
                    @php
                        if(request('birthdate') != ""){
                           $birthdate = request('birthdate');
                        }else{
                            $birthdate = $doctor->birthdate;
                        }
                    @endphp
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" name="birthdate" class="form-control" id="birthdate" value="{{$birthdate}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('birthdate') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-3">
                    <label for="speciality" class="form-label">speciality</label>
                    <select name="speciality" class="form-select" id="speciality" required>
                        <option disabled selected>- select Speciality -</option>
                        <option value="Orthopedic" @if($doctor->speciality == 'Orthopedic') {{'selected'}} @endif>Orthopedic</option>
                        <option value="Skin" @if($doctor->speciality == 'Skin') {{'selected'}} @endif>Skin</option>
                        <option value="Generalist" @if($doctor->speciality == 'Generalist') {{'selected'}} @endif>Generalist</option>
                        <option value="Dentist" @if($doctor->speciality == 'Dentist') {{'selected'}} @endif>Dentist</option>
                        <option value="Optometrist" @if($doctor->speciality == 'Optometrist') {{'selected'}} @endif>Optometrist</option>
                    </select>
                    @if(!empty($messages))
                        @foreach ($messages->get('speciality') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{$doctor->address}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('address') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
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
                    @if(!empty($messages))
                        @foreach ($messages->get('city') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    @php
                        if(request('email') != ""){
                           $email = request('email');
                        }else{
                            $email = $doctor->email;
                        }
                    @endphp
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{$email}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('email') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    @php
                        if(request('phone') != ""){
                           $phone = request('phone');
                        }else{
                            $phone = '0'. $doctor->phone;
                        }
                    @endphp
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" pattern="\d*" maxlength="10" name="phone" class="form-control" id="phone" value="{{$phone}}">
                    @if(!empty($messages))
                        @foreach ($messages->get('phone') as $message)
                            <div class="form-text text-danger">{{$message}}</div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-2">
                    <label for="" class="form-label">&puncsp;</label>
                    <input type="submit" class="form-control btn btn-success" value="SAVE" onclick="return confirm('Are you sure?')">
                </div>
            </div>
        </fieldset>
    </form>
@stop
