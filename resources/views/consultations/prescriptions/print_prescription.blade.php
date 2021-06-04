<?php
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <!-- bootstrap 5.0.0-beta3 -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- Bootstrap icons
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">-->

    <!--font-awesome-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- MY CSS -->
    <link href="{{URL::asset('css/side-nav-bar.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/print.css')}}" rel="stylesheet">
</head>

<body>
<script type="text/javascript">
    $(document).ready(function(){
        $('.print_btn').printPage();
    });
</script>
<div class="row my_A5">
    @foreach($currentCons as $cons)
        <div class="row text-center">
            <div class="col-sm-12 pt-5"><!-- 9 -->
                <h4>IBN-SINA clinic</h4>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-sm-6">
                <h5>DR: {{$cons->appointment->doctor->first_name}} {{$cons->appointment->doctor->last_name}}</h5>
                <h6>Speciality of {{$cons->appointment->doctor->speciality->speciality}}</h6>
                <h6><strong>Prescription N°: </strong>{{$prescription['id']}}</h6>
            </div>
            <div class="col-sm-6">
                <h6><strong>Le: </strong>{{Carbon::now()->toDateString()}}</h6>
                <h6><strong>Patient: </strong>{{$cons->appointment->patient->first_name}} {{$cons->appointment->patient->last_name}}</h6>
                <h6><strong>Age: </strong>{{Carbon::parse($cons->appointment->patient->birthdate)->age}} yo</h6>
            </div>
        </div>
    @endforeach


    <div class="row justify-content-center">

        <h4 class="text-center">Prescription</h4>

        <div class="col-sm-11 text-center">
            <table class="table">
                <tbody>
                @foreach($pres_medics as $pres_medic)
                    <tr>
                        <td>{{$pres_medic->medication->commercial_name}} ({{$pres_medic->medication->scientific_name}})</td>
                        <td>{{$pres_medic->dosage}}</td>
                        <td>{{$pres_medic->quantity}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
