<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @include('includes.requirements')
</head>
<body>
@include('includes.navbar')

<div class="container-fluid py-2 my_mt">
    <div class="row">
        <div class="sidebar_width">
            @include('includes.sidebar')
        </div>
        <div class="col-sm-10">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>

