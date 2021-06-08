@extends('layouts.master')

@section('content')

<div class="row mt-3">
    <div class="row mt-3">
        <div class="col-md-12">
            <h4><i class="fas fa-user-circle fs-4"></i> Account Informations</h4>
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
@stop
