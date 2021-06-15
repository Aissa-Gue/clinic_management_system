<div class="row justify-content-md-center">
    <div class="col-md-9">
        <div class="mx-1 flex-md-fill bd-highlight shadow bg-body rounded p-2">
            <table class="table table-hover caption-top m-0">
                <caption class="alert alert-success text-center fw-bold" role="alert">
                    Today Appointments
                </caption>
                <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Speciality</th>
                    <th scope="col" class="text-center">Appointments</th>
                </tr>
                </thead>
                <tbody>
                @foreach($active_app as $ac_app)
                    <tr>
                        <th scope="row">{{$ac_app->doc_id}}</th>
                        <td>{{$ac_app->first_name}} {{$ac_app->last_name}}</td>
                        <td>{{$ac_app->speciality}}</td>
                        <td class="text-secondary text-center">
                            <span class="text-danger fw-bold">{{$ac_app->active_app}} / {{$times_count->times_count}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END table -->


    <div class="col-md-4 col-xl-3">
        <!--Start Card -->
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
        <!-- END CARDS row -->
    </div>
</div>




