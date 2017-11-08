<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/home') }}">IPM-Tool</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            @if (Route::has('login'))
                @auth
                    <li><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li><a href="{{ route('overviewcompany')}}">Company</a></li>
                    <li><a href="{{route('overviewproject')}}">Project</a></li>

                    <li><a href="#">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a></li>
                @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @endauth
                    @endif
        </ul>
    </div>
    </div>
</nav>