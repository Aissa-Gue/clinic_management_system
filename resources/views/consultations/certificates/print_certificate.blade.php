<?php
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Medical Certificate</title>
    @include('includes.requirements')

</head>

<body>
<div class="row my_A5">
    @foreach($currentCons as $cons)
        <div class="row text-center">
            <div class="col-sm-12 pt-5"><!-- 9 -->
                <h4>IBN-SINA clinic</h4>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-6">
                <h6>DR: {{$cons->appointment->doctor->first_name}} {{$cons->appointment->doctor->last_name}}</h6>
                <h6>Speciality of {{$cons->appointment->doctor->speciality}}</h6>
                <h6><strong>Certificate N°: </strong>{{$certificate['id']}}</h6>
            </div>
            <div class="col-sm-6">
                <h6><strong>Le: </strong>{{Carbon::now()->toDateString()}}</h6>
                <h6><strong>Patient: </strong>{{$cons->appointment->patient->first_name}} {{$cons->appointment->patient->last_name}}</h6>
                <h6><strong>Age: </strong>{{Carbon::parse($cons->appointment->patient->birthdate)->age}} yo</h6>
            </div>
        </div>
    @endforeach


    <div class="row justify-content-center">

        <h5 class="text-center">Medical Certificate</h5>

        <div class="col-sm-11">
            <p class="fs-6">
                I undersigned <strong> Dr. {{$cons->appointment->doctor->first_name}} {{$cons->appointment->doctor->last_name}}</strong>, certify that: <strong> {{$cons->appointment->patient->first_name}} {{$cons->appointment->patient->last_name}}</strong>  was born on <strong> {{$cons->appointment->patient->birthdate}} </strong> is present on this day for my consultation.
            </p>
            <p class="fs-6">
                His/her state of health requires a <strong>{{$days_nbr}} days</strong> work stoppage, from <strong> {{$certificate['from_date']}}.</strong>
            </p>
            <p class="fs-6">
                this certificate has been issued to the interested party to serve and validate what is right.
            </p>
        </div>
    </div>

    <div class="row align-items-end">
        <div class="text-center">
            <h6>________________________________________________________</h6>
            <h6>
                <strong>Phone: </strong>0{{$cons->appointment->doctor->phone}}
                <strong>&nbsp;&nbsp;&nbsp;Email: </strong>{{$cons->appointment->doctor->email}}
            </h6>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
    $(document).ready(function(){
        window.print();
    })
    window.onafterprint = function() {
        history.go(-1);
    };
</script>
