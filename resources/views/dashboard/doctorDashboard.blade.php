<div class="row justify-content-md-center">
    <!--Start Card -->
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h5 class="mb-3">Medications</h5>
                <h2 class="text-end"><i class="fa fa-user-injured float-start"></i><span>{{$total_medications->total_medic}}</span></h2>
                <p class="mb-0">This month<span class="float-end">{{$total_medications->total_medic}}</span></p>
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
        <div class="card bg-c-pink order-card">
            <div class="card-block">
                <h5 class="mb-3">Consultations</h5>
                <h2 class="text-end"><i class="fa fa-procedures float-start"></i><span>{{$current_consultations->current_consultations}}</span></h2>
                <p class="mb-0">This month<span class="float-end">{{$monthly_consultations->monthly_consultations}}</span></p>
            </div>
        </div>
    </div>

    <!--Start Card -->
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h4 class="mb-3"><i class="fas fa-user-circle"></i> Profile</h4>
                <span class="fw-bold">User : </span>
                <h6 class="mb-3">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h6>
                <span class="fw-bold">Email : </span>
                <h6 class="mb-3">{{Auth::user()->email}}</h6>
                <span class="fw-bold">Phone : </span>
                <h6 class="mb-3">0{{Auth::user()->phone}}</h6>
            </div>
        </div>
    </div>
</div>
<!-- END CARDS row -->
