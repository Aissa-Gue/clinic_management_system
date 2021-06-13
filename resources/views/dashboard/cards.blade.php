<style>
    .order-card {
        color: #fff;
    }

    .bg-c-blue {
        background: linear-gradient(45deg,#4099ff,#73b4ff);
    }

    .bg-c-green {
        background: linear-gradient(45deg,#2ed8b6,#59e0c5);
    }

    .bg-c-yellow {
        background: linear-gradient(45deg,#FFB64D,#ffcb80);
    }

    .bg-c-pink {
        background: linear-gradient(45deg,#FF5370,#ff869a);
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
<div class="row justify-content-md-center">
    <!--Start Card -->
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h5 class="mb-3">Total Patients</h5>
                <h2 class="text-end"><i class="fa fa-user-injured float-start"></i><span>{{$total_patients->total_patients}}</span></h2>
                <p class="mb-0">This month<span class="float-end">{{$monthly_patients->monthly_patients}}</span></p>
            </div>
        </div>
    </div>
    <!--Start Card -->
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-green order-card">
            <div class="card-block">
                <h5 class="mb-3">Appointments</h5>
                <h2 class="text-end"><i class="fa fa-calendar-alt float-start"></i><span>{{$current_appointments->current_appointments}}</span></h2>
                <p class="mb-0">This month<span class="float-end">{{$monthly_appointments->monthly_appointments}}</span></p>
            </div>
        </div>
    </div>
    <!--Start Card -->
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-yellow order-card">
            <div class="card-block">
                <h5 class="mb-3">Revenue</h5>
                <h2 class="text-end"><i class="fas fa-euro-sign float-start"></i>
                    @if($current_revenue->current_revenue == null)
                        <span>0.00</span>
                    @else
                        <span>{{$current_revenue->current_revenue}}.00</span>
                    @endif
                </h2>
                <p class="mb-0">This month<span class="float-end">{{$monthly_revenue->monthly_revenue}}.00</span></p>
            </div>
        </div>
    </div>
    <!--Start Card -->
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h5 class="mb-3">Consultations</h5>
                <h2 class="text-end"><i class="fa fa-procedures float-start"></i><span>{{$current_consultations->current_consultations}}</span></h2>
                <p class="mb-0">This month<span class="float-end">{{$monthly_consultations->monthly_consultations}}</span></p>
            </div>
        </div>
    </div>
</div>
<!-- END CARDS row -->
