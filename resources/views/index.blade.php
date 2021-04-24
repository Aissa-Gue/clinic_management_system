@extends('layouts.master')

@section('content')
    <div class="index_page mt-5">

        <div class="row justify-content-md-center">
            <div class="my_card col shadow bg-body rounded">
                <div class="row">
                    <div class="col-md-4 my_card_icon shadow rounded p-3"> <i class="fas fa-user-injured fs-1"></i></div>
                    <div class="col-md-6 fw-bold my_card_title">Clients</div>
                </div>
                <h4 class="text-end">1340</h4>
                <div>
                     <span class="float-start text-muted">
                          <i class="fas fa-sync-alt"></i> Last 24 hours
                     </span>
                </div>
            </div>

            <div class="my_card col shadow bg-body rounded">
                <div class="row">
                    <div class="col-md-4 my_card_icon shadow rounded p-3"> <i class="fas fa-dollar-sign fs-1"></i></div>
                    <div class="col-md-6 fw-bold my_card_title">Revenue</div>
                </div>
                <h4 class="text-end">$3540,00</h4>
                <div>
                     <span class="float-start text-muted">
                          <i class="fas fa-sync-alt"></i> Last 24 hours
                     </span>
                </div>
            </div>

            <div class="my_card col shadow bg-body rounded">
                <div class="row">
                    <div class="col-md-4 my_card_icon shadow rounded p-3"> <i class="fas fa-hospital-user fs-1"></i></div>
                    <div class="col-md-6 fw-bold my_card_title">Clients</div>
                </div>
                <h4 class="text-end">1342</h4>
                <div>
                     <span class="float-start text-muted">
                          <i class="fas fa-calendar-alt"></i> Last Month (March)
                     </span>
                </div>
            </div>

            <div class="my_card col shadow bg-body rounded">
                <div class="row">
                    <div class="col-md-4 my_card_icon shadow rounded p-3">
                        <i class="fas fa-dollar-sign fs-1"></i>
                    </div>
                    <div class="col-md-6 fw-bold my_card_title">Revenue</div>
                </div>
                <h4 class="text-end">$9450,00</h4>
                <div>
                     <span class="float-start text-muted">
                          <i class="fas fa-calendar-alt"></i> Last Month (March)
                     </span>
                </div>
            </div>
    </div>
        <div class="d-flex bd-highlight mt-3">
            <!-- START doctors revenue table -->
            <div class="flex-md-fill col-7 bd-highlight shadow bg-body rounded p-3">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Specialisation</th>
                        <th scope="col">Revenue</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>$145</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>$120</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>$375</td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- END doctors revenue table -->

            <!-- Start appointments status card -->
            <div class="p-2 flex-md-fill bd-highlight">
                <div class="shadow bg-body rounded">
                    <div class="my_card_header rounded p-3">
                        <div class="fw-bold">
                            <i class="fas fa-calendar-alt fs-1"></i>
                            <span class="fs-5"> Appointments</span>
                        </div>
                    </div>
                    <div class="my_card_content p-4">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center">23</h4>
                            </div>
                            <div class="col">
                                <h4 class="text-center">50</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="text-center text-muted">Consulted</h6>
                            </div>
                            <div class="col">
                                <h6 class="text-center text-muted">Active</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END appointments status card -->
        </div><!-- END d-flex-->

        <!-- START d-flex-->
        <div class="d-flex bd-highlight mt-3">
            <!-- START Monthly revenue chart -->
            <div class="flex-md-fill col-md-7 bd-highlight shadow bg-body rounded p-3">
                <canvas id="monthly_revenue"></canvas>
                @include('includes.revenue')
            </div><!-- END Monthly revenue chart -->

            <!-- Start appointments status card -->
            <div class="p-2 flex-md-fill bd-highlight">
                <div class="shadow bg-body rounded">
                    <div class="my_card_header rounded p-3">
                        <div class="fw-bold">
                            <i class="fas fa-calendar-alt fs-1"></i>
                            <span class="fs-5"> Appointments</span>
                        </div>
                    </div>
                    <div class="my_card_content p-4">
                        <div class="row">
                            <div class="col">
                                <h4 class="text-center">23</h4>
                            </div>
                            <div class="col">
                                <h4 class="text-center">50</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="text-center text-muted">Consulted</h6>
                            </div>
                            <div class="col">
                                <h6 class="text-center text-muted">Active</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END appointments status card -->
        </div><!-- END d-flex-->
    </div>
@stop




