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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    <nav id="navbar_top">
        <a href="{{route('home')}}" style="text-transform: capitalize; margin-left: 15px">
            <svg style="margin: 12px 0px 12px 0px;" width="40px" height="46px" viewBox="0 0 40 46" version="1.1"
                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                <title>Logo-IAV-no_border</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Project-Overview" transform="translate(-35.000000, -12.000000)" fill-rule="nonzero"
                       fill="#FFFFFF">
                        <g id="Left-Side-menu">
                            <g id="Logo-IAV-no_border" transform="translate(35.000000, 12.000000)">
                                <g id="Shape">
                                    <path d="M33.9051236,21.9378715 C30.6994238,22.0281245 28.1481481,24.6193288 28.1481481,27.7849462 C28.1481481,30.9505637 30.6994238,33.5417679 33.9051236,33.632021 L33.9051236,33.632021 C36.0616732,33.6927363 38.08126,32.5917598 39.1776828,30.7576886 C40.2741057,28.9236174 40.2741057,26.6462751 39.1776828,24.8122039 C38.08126,22.9781326 36.0616732,21.8771562 33.9051236,21.9378715 L33.9051236,21.9378715 Z"></path>
                                    <path d="M6.67550074,24.86004 C10.3573759,24.8552422 13.3381858,21.9051405 13.3333274,18.2708019 C13.328469,14.6364634 10.339782,11.694137 6.65790683,11.6989306 C2.97603164,11.7037242 -0.00478172893,14.6538225 7.24221339e-05,18.288161 C-0.0082028875,20.0366382 0.693009424,21.7156125 1.94720594,22.9503539 C3.20140246,24.1850953 4.9041817,24.8728218 6.67550074,24.86004 L6.67550074,24.86004 Z"></path>
                                    <path d="M17.7777353,11.6986881 L17.7777353,11.6986881 C20.1758159,11.6986811 22.3374905,10.2720062 23.2538402,8.0845358 C24.1701898,5.89706538 23.6605479,3.38007921 21.9627796,1.70833077 C20.2650114,0.0365823217 17.7138474,-0.46032789 15.4999929,0.449523136 C13.2861384,1.35937416 11.8460752,3.49660097 11.8519242,5.86369525 C11.8441236,7.41771043 12.4677376,8.90996014 13.5832485,10.0065917 C14.6987593,11.1032232 16.2130623,11.7127075 17.7873708,11.6986881 L17.7777353,11.6986881 Z"></path>
                                    <path d="M22.962963,14.6236559 C20.0992643,14.6236559 17.7777778,16.9151877 17.7777778,19.7419355 C17.7777778,22.5686832 20.0992643,24.8602151 22.962963,24.8602151 L22.962963,24.8602151 C25.8266617,24.8602151 28.1481481,22.5686832 28.1481481,19.7419355 C28.1481481,16.9151877 25.8266617,14.6236559 22.962963,14.6236559 L22.962963,14.6236559 Z"></path>
                                    <path d="M16.8263109,26.3248664 C11.5913822,26.4379717 7.40740741,30.6593432 7.40740741,35.827957 C7.40740741,40.9965708 11.5913822,45.2179423 16.8263109,45.3310475 L16.8263109,45.3310475 C20.3160538,45.4064465 23.5739007,43.6118391 25.3411955,40.6405646 C27.1084904,37.66929 27.1084904,33.986624 25.3411955,31.0153494 C23.5739007,28.0440749 20.3160538,26.2494675 16.8263109,26.3248664 L16.8263109,26.3248664 Z"></path>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
        </a>

    </nav>
    <div class="container_login">
        <div class="row">
            @yield('content')
        </div>
    </div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>