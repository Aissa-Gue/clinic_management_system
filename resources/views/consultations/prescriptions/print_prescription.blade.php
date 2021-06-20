<?php
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Prescription</title>
    @include('includes.requirements')

</head>

<body>
<div class="row my_A5">
    <div class="row text-center">
        <div class="col-sm-12 pt-5"><!-- 9 -->
            <h4>IBN-SINA clinic</h4>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-6">
            <h6>DR: {{$currentCons->appointment->doctor->first_name}} {{$currentCons->appointment->doctor->last_name}}</h6>
            <h6>Speciality of {{$currentCons->appointment->doctor->speciality}}</h6>
            <h6><strong>Prescription N°: </strong>{{$prescription['pres_id']}}</h6>
        </div>
        <div class="col-sm-6">
            <h6><strong>Le: </strong>{{Carbon::now()->toDateString()}}</h6>
            <h6><strong>Patient: </strong>{{$currentCons->appointment->patient->first_name}} {{$currentCons->appointment->patient->last_name}}</h6>
            <h6><strong>Age: </strong>{{Carbon::parse($currentCons->appointment->patient->birthdate)->age}} yo</h6>
        </div>
    </div>


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
                <strong>Phone: </strong>0{{$currentCons->appointment->doctor->phone}}
                <strong>&nbsp;&nbsp;&nbsp;Email: </strong>{{$currentCons->appointment->doctor->email}}
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
