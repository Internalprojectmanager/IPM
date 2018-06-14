<nav class="navbar navbar-expand-lg navbar-inverse bg-dark navbar-fixed-top">
    <div class="container-fluid">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">One more separated link</a></li>
                </ul>
            </li>
        </ul>
        @if (Route::has('login'))
            @auth
                <ul class="nav navbar-nav navbar-right user">
                    <li class="dropdown icon-nav normal-dropdown">
                        <a href="#" data-toggle="dropdown" class="sidebar_link dropdown-toggle" aria-haspopup="true"
                           role="button" aria-expanded="false">
                            <i class="fas fa-plus fa-lg "></i>
                            <svg id="dropdown_arrow" width="13px" height="9px" viewBox="0 0 13 9" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                                <title>Dropdown arrow</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Project-Overview" transform="translate(-1221.000000, -31.000000)">
                                        <g id="Top-menu" transform="translate(110.000000, 0.000000)">
                                            <g id="User-Top" transform="translate(989.196850, 23.000000)">
                                                <g id="Dropdown-arrow" transform="translate(116.719048, 0.000000)">
                                                    <polygon id="Shape" class="dropdown-arrow-icon" fill="#FFFFFF"
                                                             fill-rule="nonzero"
                                                             points="7.3922064 8.84 11.9711845 13.42 16.5501625 8.84 17.9567767 10.25 11.9711845 16.25 5.98559223 10.25"></polygon>
                                                    <polygon id="Shape"
                                                             points="0 0 23.9423689 0 23.9423689 24 0 24"></polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <ul class="dropdown-menu center black">
                            <li><a href="{{route('addclient')}}"> New Client</a></li>
                            <li><a href="{{route('addproject')}}"> New Project</a></li>
                            <li><a href="{{route('team.new')}}"> New Team</a></li>


                        </ul>
                    </li>
                    <li class="dropdown icon-nav normal-dropdown">
                        <a href="#" data-toggle="dropdown" class="sidebar_link dropdown-toggle" aria-haspopup="true"
                           role="button" aria-expanded="false">
                            <i class="far fa-building fa-lg "></i>
                            <svg id="dropdown_arrow" width="13px" height="9px" viewBox="0 0 13 9" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                                <title>Dropdown arrow</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Project-Overview" transform="translate(-1221.000000, -31.000000)">
                                        <g id="Top-menu" transform="translate(110.000000, 0.000000)">
                                            <g id="User-Top" transform="translate(989.196850, 23.000000)">
                                                <g id="Dropdown-arrow" transform="translate(116.719048, 0.000000)">
                                                    <polygon id="Shape" class="dropdown-arrow-icon" fill="#FFFFFF"
                                                             fill-rule="nonzero"
                                                             points="7.3922064 8.84 11.9711845 13.42 16.5501625 8.84 17.9567767 10.25 11.9711845 16.25 5.98559223 10.25"></polygon>
                                                    <polygon id="Shape"
                                                             points="0 0 23.9423689 0 23.9423689 24 0 24"></polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <ul class="dropdown-menu center black">
                            @php $i = 0; @endphp
                            @foreach(Auth::user()->teams() as $teams)
                                @if($i == 0)
                                    <li class="black"><i class="far fa-user icon-right-top"></i> User Space</li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{route('team.show', $teams->slug)}}"> {{$teams->name}}</a></li>
                                    <div class="under-details"></div>
                                    <li class=""><i class="far fa-building icon-right-top"></i>Team Space</li>
                                    <li role="separator" class="divider"></li>
                                @else
                                    <li><a href="{{route('team.show', $teams->slug)}}"> {{$teams->name}}</a></li>

                                @endif
                                @php $i++; @endphp
                            @endforeach


                        </ul>
                    </li>
                    <li class="icon-nav"><a href="{{route('dashboard')}}" class="sidebar_link">
                            <i class="fas fa-calendar-check fa-lg"></i>
                            <span class="icon-badge">{{Auth::user()->toDo()}}</span>
                        </a>
                    </li>


                    <li class="dropdown">
                        <a id="username" href="#" class="dropdown-toggle" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}

                            <svg id="dropdown_arrow" width="13px" height="9px" viewBox="0 0 13 9" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                                <title>Dropdown arrow</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Project-Overview" transform="translate(-1221.000000, -31.000000)">
                                        <g id="Top-menu" transform="translate(110.000000, 0.000000)">
                                            <g id="User-Top" transform="translate(989.196850, 23.000000)">
                                                <g id="Dropdown-arrow" transform="translate(116.719048, 0.000000)">
                                                    <polygon id="Shape" class="dropdown-arrow-icon" fill="#FFFFFF"
                                                             fill-rule="nonzero"
                                                             points="7.3922064 8.84 11.9711845 13.42 16.5501625 8.84 17.9567767 10.25 11.9711845 16.25 5.98559223 10.25"></polygon>
                                                    <polygon id="Shape"
                                                             points="0 0 23.9423689 0 23.9423689 24 0 24"></polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <br>
                        </a>
                        <ul class="dropdown-menu">
                            <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                            <li><a href="{{route('profile')}}"><i class="glyphicon icon-right-top settings-icon"></i>
                                    Settings</a></li>
                            <li><a href="{{route('help')}}"><i class=" icon-right-top far fa-question-circle fa-2x"></i>
                                    Help</a></li>

                            <li>
                                <a style="cursor: pointer"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="glyphicon icon-right-top logout-icon"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{url('/logout')}}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                        </ul>
                    </li>
                </ul>

            @endauth
        @endif
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>