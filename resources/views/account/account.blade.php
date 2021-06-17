@extends('layouts.master')

@section('content')

<div class="row mt-3">
    <div class="row mt-3">
        <div class="col-md-12">
            <h4><i class="fas fa-user-circle fs-4"></i> Account Informations</h4>
            <hr>
            <form method="post" action="{{ URL('account/updateAccount/')}}">
            @csrf
            <!-- First row -->
                <div class="row align-items-center mb-2">
                    <div class="col-md-2">
                        <label for="first_name" class="col-form-label">Your Name</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" value="{{ Auth::user()->first_name }}">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name" value="{{ Auth::user()->last_name }}">
                    </div>
                    @if(!empty($messages))
                        @foreach ($messages->get('first_name') as $message)
                            <div class="col-auto">
                                <span class="form-text text-danger">{{$message}}</span>
                            </div>
                        @endforeach
                    @endif
                    @if(!empty($messages))
                        @foreach ($messages->get('last_name') as $message)
                            <div class="col-auto">
                                <span class="form-text text-danger">{{$message}}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- END first row -->

                <!-- First row -->
                <div class="row align-items-center mb-2">
                    <div class="col-md-2">
                        <label for="phone" class="col-form-label">Phone number</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone number" value="0{{ Auth::user()->phone }}">
                    </div>
                    @if(!empty($messages))
                        @foreach ($messages->get('phone') as $message)
                            <div class="col-auto">
                                <span class="form-text text-danger">{{$message}}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- END first row -->

                <!-- First row -->
                <div class="row align-items-center mb-2">
                    <div class="col-md-2">
                        <label for="email" class="col-form-label">Email address</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter your email address" value="{{ Auth::user()->email }}">
                    </div>
                    @if(!empty($messages))
                        @foreach ($messages->get('email') as $message)
                            <div class="col-auto">
                                <span class="form-text text-danger">{{$message}}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- END first row -->

                <!-- First row -->
                <div class="row align-items-center mb-2">
                    <div class="col-md-2">
                        <label for="oldPwd" class="col-form-label">Old password</label>
                    </div>
                    <div class="col-md-3">
                        <input type="password" name="old_password" id="oldPwd" class="form-control" placeholder="Enter your old password">
                    </div>
                    @if(!empty($old_pwd_err))
                        <div class="col-auto">
                            <span class="form-text text-danger">{{$old_pwd_err}}</span>
                        </div>
                    @endif
                </div>
                <!-- END first row -->

                <!-- First row -->
                <div class="row align-items-center mb-2">
                    <div class="col-md-2">
                        <label for="password" class="col-form-label">New password</label>
                    </div>
                    <div class="col-md-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter the new password">
                    </div>

                    @if(!empty($messages))
                        @foreach ($messages->get('password') as $message)
                            <div class="col-auto">
                                <span class="form-text text-danger">{{$message}}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- END first row -->

                <!-- First row -->
                <div class="row align-items-center mb-2">
                    <div class="col-md-2">
                        <label for="password_confirmation" class="col-form-label">Confirm password</label>
                    </div>
                    <div class="col-md-3">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Retype the new password">
                    </div>
                    @if(!empty($messages))
                        @foreach ($messages->get('password') as $message)
                            <div class="col-auto">
                                <span class="form-text text-danger">{{$message}}</span>
                            </div>
                        @endforeach
                    @endif
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
