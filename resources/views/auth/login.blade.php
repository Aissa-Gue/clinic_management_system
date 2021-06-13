<!DOCTYPE html>
<html lang="en">
<head>
    <title>Clinic Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('includes.requirements')
</head>
<style>
    .login-form-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 1000px;
        height: 550px;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0px 0px 47px 0px rgba(0, 0, 0, 0.47);
        margin-top: 45px;
        background: #fff;

        background-image: url("{{ asset('img/clinic.gif') }}");
        background-size: cover;
        background-repeat: no-repeat;
        object-fit: cover;
    }

    .title {
        text-align: center;
        margin-top: 80px;
        color: #292929;
        line-height: 30px;
        margin-bottom: 30px;
    }

    .form input[type=text],
    .form input[type=password] {
        width: 300px;
        padding: 12px 9px;
        border-radius: 30px;
        border: 1px solid #ddd;
        margin-bottom: 15px;
        outline: none;
        box-shadow: 0px 0px 42px #d4d4d4;
    }

    .form input[type="submit"] {
        display: inline-block;
        border: none;
        width: 170px;
        padding: 10px;
        border-radius: 30px;
        cursor: pointer;
        margin: 20px 0px;
        transition: 0.3s all ease-in-out;
    }

    .form input[type="submit"]:focus {
        outline: none;
    }

    .form input[type="submit"]:hover {
        background: #111;
    }



    /* preview */
    .my_bg {
        background: linear-gradient(
            rgba(255, 255, 255, 0.7),
            rgba(252, 255, 254, 0.7)
        ),
        url("{{ asset('img/preview11.jpg') }}") center / cover no-repeat fixed;
        min-height: 100%;
    }
</style>

<body class="my_bg">

    <div class="login-form-wrap">
        <div class="col-md-6 align-self-end">
            <img src="{{ asset('img/preview55.jpg') }}" class="img-fluid" alt="">
        </div>

        <div class="col-md-5"><br><br><br>
            <div class="title mb-5">

                <h3>Welcome !</h3>
            </div>
            <div class="form text-center">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <input type="text" name="email" class="text-center @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="password" name="password" class="text-center @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="submit" name="login" class="btn btn-success" value="LOGIN">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
