@extends('layouts.master')

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#database" type="button" role="tab" aria-controls="database" aria-selected="true">Database</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="database" role="tabpanel">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h4>Database Management</h4>
                    <hr>

                    <form method="post" action="import_db.php" enctype="multipart/form-data">
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

                    <form method="post" action="export_db.php" enctype="multipart/form-data">
                        <!-- Third row -->
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Export database</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="submit" name="export" class="btn btn-success" value="Export Database">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END Third row -->
                    <!-- Forth row -->
                    <form method="post" action="drop_db.php" enctype="multipart/form-data">
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Drop database</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="submit" name="drop" class="btn btn-danger" value=" Drop Database "
                                           onclick="return confirm('Be careful ! all the data of the database will be deleted permanently !')">
                                </div>
                            </div>
                        </div>
                        <!-- END Forth row -->
                    </form>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="profile" role="tabpanel">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h4>Update Account Informations</h4>
                    <hr>
                    <form method="post" action="editAccount.php">
                        <!-- First row -->
                        <div class="row align-items-center mb-2">
                            <div class="col-md-2">
                                <label for="first_name" class="col-form-label">Your Name</label>
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name">
                            </div>
                            <div class="col-auto">
                                <span class="form-text">
                                  Must be 8-20 characters long.
                                </span>
                            </div>
                        </div>
                        <!-- END first row -->

                        <!-- First row -->
                        <div class="row align-items-center mb-2">
                            <div class="col-md-2">
                                <label for="phone" class="col-form-label">Phone number</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone number">
                            </div>
                            <div class="col-auto">
                                <span class="form-text">
                                  Must be 8-20 characters long.
                                </span>
                            </div>
                        </div>
                        <!-- END first row -->

                        <!-- First row -->
                        <div class="row align-items-center mb-2">
                            <div class="col-md-2">
                                <label for="email" class="col-form-label">Email address</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email address">
                            </div>
                            <div class="col-auto">
                                <span class="form-text">
                                  Must be 8-20 characters long.
                                </span>
                            </div>
                        </div>
                        <!-- END first row -->

                        <!-- First row -->
                        <div class="row align-items-center mb-2">
                            <div class="col-md-2">
                                <label for="oldPwd" class="col-form-label">Old password</label>
                            </div>
                            <div class="col-md-3">
                                <input type="password" name="oldPwd" id="oldPwd" class="form-control" placeholder="Enter your old password">
                            </div>
                            <div class="col-auto">
                                <span class="form-text">
                                  Must be 8-20 characters long.
                                </span>
                            </div>
                        </div>
                        <!-- END first row -->

                        <!-- First row -->
                        <div class="row align-items-center mb-2">
                            <div class="col-md-2">
                                <label for="newPwd1" class="col-form-label">New password</label>
                            </div>
                            <div class="col-md-3">
                                <input type="password" name="newPwd1" id="newPwd1" class="form-control" placeholder="Enter the new password">
                            </div>
                            <div class="col-auto">
                                <span class="form-text">
                                  Must be 8-20 characters long.
                                </span>
                            </div>
                        </div>
                        <!-- END first row -->

                        <!-- First row -->
                        <div class="row align-items-center mb-2">
                            <div class="col-md-2">
                                <label for="newPwd2" class="col-form-label">Confirm password</label>
                            </div>
                            <div class="col-md-3">
                                <input type="password" name="newPwd2" id="newPwd2" class="form-control" placeholder="Retype the new password">
                            </div>
                            <div class="col-auto">
                                <span class="form-text">
                                  Must be 8-20 characters long.
                                </span>
                            </div>
                        </div>
                        <!-- END first row -->

                        <div class="form-group row mb-3">
                            <label class="col-md-2"></label>
                            <div class="col-sm-4">
                                <input type="submit" name="editAcc" class="btn btn-success px-4 p-2" value="UPDATE">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="contact" role="tabpanel">

        </div>
    </div>
@stop
