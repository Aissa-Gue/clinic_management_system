<style>
    .order-card {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg,#4099ff,#73b4ff);
        background: linear-gradient(45deg,#403fbf,#73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg,#2ed8b6,#59e0c5);
        background: linear-gradient(45deg,#1c8fa7,#59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg,#FFB64D,#ffcb80);
        background: linear-gradient(45deg,#35444a,#3d9cdd);
    }

    .bg-c-pink {
        background: linear-gradient(45deg,#FF5370,#ff869a);
        background: linear-gradient(45deg,#d10505,#ff869a);
    }


    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 12px;
    }

    .order-card i {
        font-size: 26px;
    }
</style>

@extends('layouts.master')

@section('content')
    <div class="index_page mt-1">
        @if(Auth::id() === 1)
            @include('dashboard.managerDashboard')

        @elseif(Auth::id() === 2)
            @include('dashboard.secritaireDashboard')

        @elseif(Auth::id() > 2)
            @include('dashboard.doctorDashboard')
        @endif
    </div>
@stop




