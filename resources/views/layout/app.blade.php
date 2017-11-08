<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{secure_asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{secure_asset('css/custom.css')}}" rel="stylesheet" type="text/css">



</head>
<body>
@include('layout.nav')
<div class="container">
    @yield('breadcrumbs')
    @yield('content')
</div>

<!-- Javascript -->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{secure_asset('js/app.js')}}"></script>
<script src="{{secure_asset('js/custom.js')}}"></script>
</body>
</html>
