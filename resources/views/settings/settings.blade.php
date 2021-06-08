@extends('layouts.master')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#database" type="button" role="tab" aria-controls="database" aria-selected="true">Database</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="database" role="tabpanel">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h4><i class="fas fa-server fs-5"></i> Database Management</h4>
                    <hr>

                    <form method="post" action="/settings/import" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-3">
                            <div class="input-group">
                                <label class="col-md-3">Import backup (SQL)</label>
                                <div class="custom-file col-md-4">
                                    <input type="file" class="form-control" name="db" accept=".sql" id="db" required>
                                </div>
                                <input type="submit" name="importDb" class="btn btn-primary" value="Import">
                            </div>
                        </div>
                    </form>

                    <!-- Third row -->
                    <div class="form-group row mb-3">
                        <label class="col-md-3">Export database</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <a href="/settings/export" class="btn btn-success">Export Database</a>
                            </div>
                        </div>
                    </div>
                    <!-- END Third row -->
                <!-- Forth row -->
                    <div class="form-group row mb-3">
                        <label class="col-md-3">Drop database</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <a href="/settings/drop" class="btn btn-danger" onclick="return confirm('Be careful ! all the data of the database will be deleted permanently !')"> Drop Database </a>
                            </div>
                        </div>
                    </div>
                    <!-- END Forth row -->
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="contact" role="tabpanel">

        </div>
    </div>
@stop
