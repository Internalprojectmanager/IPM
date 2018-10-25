@php 
    header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate,post-check=0,pre-check=0"); 
    header("Pragma: no-cache"); 
@endphp
<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"
    />
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
        crossorigin="anonymous"></script>

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{asset('/img/favicon/apple-touch-icon-57x57.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('/img/favicon/apple-touch-icon-114x114.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('/img/favicon/apple-touch-icon-72x72.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('/img/favicon/apple-touch-icon-144x144.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{asset('/img/favicon/apple-touch-icon-60x60.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{asset('/img/favicon/apple-touch-icon-120x120.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{asset('/img/favicon/apple-touch-icon-76x76.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('/img/favicon/apple-touch-icon-152x152.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('/img/favicon/favicon-196x196.png')}}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{asset('/img/favicon/favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{asset('/img/favicon/favicon-32x32.png')}}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{asset('/img/favicon/favicon-16x16.png')}}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{asset('/img/favicon/favicon-128.png')}}" sizes="128x128" />
    <meta name="application-name" content="IPM" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{asset('/img/favicon/mstile-144x144.png')}}" />
    <meta name="msapplication-square70x70logo" content="{{asset('/img/favicon/mstile-70x70.png')}}" />
    <meta name="msapplication-square150x150logo" content="{{asset('/img/favicon/mstile-150x150.png')}}" />
    <meta name="msapplication-wide310x150logo" content="{{asset('/img/favicon/mstile-310x150.png')}}" />
    <meta name="msapplication-square310x310logo" content="{{asset('/img/favicon/mstile-310x310.png')}}" /> @if(env('APP_ENV') === 'production')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{env(" GOOGLE_ANALYTICS_ID ")}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', {{env("GOOGLE_ANALYTICS_ID")}}');
    </script>
    @endif

</head>

<body class="{{ \Request::route() ? \Request::route()->getName() : " no-route " }} {{ Auth::guest() ? "guest " : "auth
    " }}">
    @include('layout.nav')

    <div id="loader-container">
        <div class="loader"></div>
    </div>

    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            @yield('breadcrumbs')
        </div>
    @include('flash::message') @yield('content')
    </div>

    <footer class="navbar-fixed-bottom">
        <div class="col-md-12 center col-x">Copyright © {{\Carbon\Carbon::now()->format('Y')}} - Internalprojectmanager (IPM) -
            <?php  echo file_get_contents(public_path('../VERSION'), 'r'); ?>
        </div>
    </footer>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

    <!-- Javascript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                calendarWeeks: true,
                startDate: '{{\Carbon\Carbon::now()}}',
                todayHighlight: true,
                weekStart: 1,
            });
        })
    </script>

</body>

</html>