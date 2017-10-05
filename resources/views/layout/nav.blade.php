<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Dashboard</a>
                <a href="{{ route('overviewcompany') }}">Company</a>
                <a href="{{route('overviewproject')}}">Project</a>
                @else

                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                    @endauth
        </div>
    @endif

