<div class="row d-flex bd-highlight">
    <!-- START doctors revenue table -->
    <div class="col-md-6">
        <div class="mx-1 flex-md-fill bd-highlight shadow bg-body rounded p-2">
            <table class="table table-hover caption-top m-0">
                <caption class="alert alert-success text-center fw-bold" role="alert">
                    Today Revenue
                </caption>
                <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Speciality</th>
                    <th scope="col">Revenue</th>
                </tr>
                </thead>
                <tbody>
                @foreach($doctors_revenue as $doc_rev)
                    <tr>
                        <th scope="row">{{$doc_rev->id}}</th>
                        <td>{{$doc_rev->first_name}} {{$doc_rev->last_name}}</td>
                        <td>{{$doc_rev->speciality}}</td>
                        <td class="text-secondary">
                            @if($doc_rev->paid_amount_sum == null)
                                <span class="text-danger fw-bold">0.00</span> DA
                            @else
                                <span class="text-success fw-bold">{{$doc_rev->paid_amount_sum}}.00</span> DA
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div><!-- END doctors revenue table -->
    </div>




    <div class="col-md-6">
        <!-- START Monthly revenue chart -->
        <div class="flex-md-fill bd-highlight shadow bg-body rounded p-2">
            <div class="alert alert-warning text-center fw-bold" role="alert">
                Last 15 Days Revenue
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="py-1 btn-secondary float-end" data-bs-toggle="modal" data-bs-target="#full_charts">
                <i class="fas fa-expand"></i> More Statistics
            </button>
            @include('dashboard.charts_modal')

            <canvas id="revenue_month"></canvas>
            @include('dashboard.charts.revenue_month')
        </div>
        <!-- END Monthly revenue chart -->
    </div>
</div><!-- END d-flex-->



