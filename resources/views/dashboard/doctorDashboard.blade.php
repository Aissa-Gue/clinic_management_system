<div class="row justify-content-md-center">
    <!--Start Card -->
    <div class="col-md-4 col-xl-3">
        <div class="card bg-c-blue order-card">
            <div class="card-block">
                <h5 class="mb-3">Medications</h5>
                <h2 class="text-end"><i class="fa fa-tablets float-start"></i><span>{{$total_medications->total_medic}}</span></h2>
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


<div class="row" style="margin-top: -120px">
    <div class="col-md-9">
        <div class="flex-md-fill bd-highlight shadow bg-body rounded p-2">
            <div class="alert alert-success text-center fw-bold" role="alert">
                Today Appointments
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col" class="text-center">App-id</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Time</th>
                    <th scope="col" class="text-center">Consult</th>

                </tr>
                </thead>
                <tbody>
                @foreach($doc_appointments as $doc_app)
                    <tr>
                        <th scope="row" class="text-center">{{$doc_app->id}}</th>
                        <td>{{$doc_app->first_name}}</td>
                        <td>{{$doc_app->last_name}}</td>
                        <td>{{\Carbon\Carbon::parse($doc_app->time)->format('H:i')}}</td>
                        <td class="text-center">
                            <a class="btn btn-outline-success" href="/consultations/add/{{$doc_app->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
