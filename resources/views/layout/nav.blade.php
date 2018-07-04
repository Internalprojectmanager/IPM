<!-- Sidebar -->
<nav id="sidebar" align="center">
    <a href="{{route('home')}}" style="text-transform: capitalize">
        <img style="margin: 20px 10px 20px 10px; width: 70px" src="{{asset('/img/IPM_WHITE.png')}}"/>
    </a>

    @switch(env('APP_ENV'))
        @case('staging')
        <i class="fas fa-exclamation-circle red"></i> <span style="text-transform: capitalize;"
                                                            class="red">TEST</span>
        @break
        @case('local')
        <span style="text-transform: capitalize;">{{env('APP_ENV')}}</span>
        @break
    @endswitch

    <a href="{{route('overviewproject')}}" class="sidebar_link">
        <div class="sidebar_object <?php $sUrl = $_SERVER['REQUEST_URI']; $sUrl = substr($sUrl, 1, 7); if ($sUrl == 'project') {
            echo 'active';
        } ?>">
            <svg width="32px" height="30px" viewBox="0 0 32 30" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                <title>Work</title>
                <desc>Created with Sketch.</desc>
                <defs>
                    <filter x="-6.4%" y="-0.4%" width="112.7%" height="101.2%" filterUnits="objectBoundingBox"
                            id="filter-1">
                        <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                        <feGaussianBlur stdDeviation="2" in="shadowOffsetOuter1"
                                        result="shadowBlurOuter1"></feGaussianBlur>
                        <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.5 0" type="matrix"
                                       in="shadowBlurOuter1" result="shadowMatrixOuter1"></feColorMatrix>
                        <feMerge>
                            <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Project-Overview" transform="translate(-39.000000, -90.000000)" fill-rule="nonzero"
                       fill="#FFFFFF">
                        <g id="Breadcrumb">
                            <g id="Left-Side-menu">
                                <g filter="url(#filter-1)" id="Work">
                                    <g transform="translate(0.000000, 70.000000)">
                                        <g transform="translate(0.000000, 22.494382)">
                                            <g transform="translate(43.000000, 0.000000)">
                                                <path d="M21.6,4.4070626 L16.8,4.4070626 L16.8,2.2035313 C16.8,0.986080257 15.726,0 14.4,0 L9.6,0 C8.274,0 7.2,0.986080257 7.2,2.2035313 L7.2,4.4070626 L2.4,4.4070626 C1.074,4.4070626 0.012,5.39314286 0.012,6.6105939 L0,18.7300161 C0,19.9474671 1.074,20.9335474 2.4,20.9335474 L21.6,20.9335474 C22.926,20.9335474 24,19.9474671 24,18.7300161 L24,6.6105939 C24,5.39314286 22.926,4.4070626 21.6,4.4070626 Z M14.4,4.4070626 L9.6,4.4070626 L9.6,2.2035313 L14.4,2.2035313 L14.4,4.4070626 Z"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <br>PROJECTS
        </div>
    </a>

    <a href="{{route('overviewclient')}}" class="sidebar_link">
        <div class="sidebar_object <?php $sUrl = $_SERVER['REQUEST_URI']; $sUrl = substr($sUrl, 1, 6); if ($sUrl == 'client') {
            echo 'active';
        } ?>">
            <svg width="32px" height="31px" viewBox="0 0 32 31" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink">
                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                <title>building</title>
                <desc>Created with Sketch.</desc>
                <defs>
                    <filter x="-6.4%" y="-0.4%" width="112.7%" height="101.2%" filterUnits="objectBoundingBox"
                            id="filter-1">
                        <feOffset dx="0" dy="2" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                        <feGaussianBlur stdDeviation="2" in="shadowOffsetOuter1"
                                        result="shadowBlurOuter1"></feGaussianBlur>
                        <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.5 0" type="matrix"
                                       in="shadowBlurOuter1" result="shadowMatrixOuter1"></feColorMatrix>
                        <feMerge>
                            <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Project-Overview" transform="translate(-39.000000, -178.000000)" fill-rule="nonzero"
                       fill="#FFFFFF">
                        <g id="Breadcrumb">
                            <g id="Left-Side-menu">
                                <g filter="url(#filter-1)" id="Clients">
                                    <g transform="translate(0.000000, 161.000000)">
                                        <g transform="translate(0.000000, 19.426966)" id="building">
                                            <g transform="translate(43.000000, 0.000000)">
                                                <path d="M13,22 L1,22 C0.4,22 0,21.6333333 0,21.0833333 L0,0.916666667 C0,0.366666667 0.4,0 1,0 L13,0 C13.6,0 14,0.366666667 14,0.916666667 L14,21.0833333 C14,21.6333333 13.6,22 13,22 Z M2,20.1666667 L12,20.1666667 L12,1.83333333 L2,1.83333333 L2,20.1666667 Z"
                                                      id="Shape"></path>
                                                <path d="M23,21 L13,21 C12.4,21 12,20.6444444 12,20.1111111 L12,5.88888889 C12,5.35555556 12.4,5 13,5 L23,5 C23.6,5 24,5.35555556 24,5.88888889 L24,20.1111111 C24,20.6444444 23.6,21 23,21 Z M14,19.2222222 L22,19.2222222 L22,6.77777778 L14,6.77777778 L14,19.2222222 Z"
                                                      id="Shape"></path>
                                                <path d="M5,15 C4.4,15 4,14.6333333 4,14.0833333 L4,4.91666667 C4,4.36666667 4.4,4 5,4 C5.6,4 6,4.36666667 6,4.91666667 L6,14.0833333 C6,14.6333333 5.6,15 5,15 Z"
                                                      id="Shape"></path>
                                                <path d="M9,15 C8.4,15 8,14.6333333 8,14.0833333 L8,4.91666667 C8,4.36666667 8.4,4 9,4 C9.6,4 10,4.36666667 10,4.91666667 L10,14.0833333 C10,14.6333333 9.6,15 9,15 Z"
                                                      id="Shape"></path>
                                                <path d="M20,21 L16,21 C15.4,21 15,20.6666667 15,20.1666667 L15,16.8333333 C15,16.3333333 15.4,16 16,16 L20,16 C20.6,16 21,16.3333333 21,16.8333333 L21,20.1666667 C21,20.6666667 20.6,21 20,21 Z M17,19.3333333 L19,19.3333333 L19,17.6666667 L17,17.6666667 L17,19.3333333 Z"
                                                      id="Shape"></path>
                                                <path d="M9,21 L5,21 C4.4,21 4,20.6666667 4,20.1666667 L4,16.8333333 C4,16.3333333 4.4,16 5,16 L9,16 C9.6,16 10,16.3333333 10,16.8333333 L10,20.1666667 C10,20.6666667 9.6,21 9,21 Z M6,19.3333333 L8,19.3333333 L8,17.6666667 L6,17.6666667 L6,19.3333333 Z"
                                                      id="Shape"></path>
                                                <path d="M20,15 L16,15 C15.4,15 15,14.6 15,14 C15,13.4 15.4,13 16,13 L20,13 C20.6,13 21,13.4 21,14 C21,14.6 20.6,15 20,15 Z"
                                                      id="Shape"></path>
                                                <path d="M20,11 L16,11 C15.4,11 15,10.6 15,10 C15,9.4 15.4,9 16,9 L20,9 C20.6,9 21,9.4 21,10 C21,10.6 20.6,11 20,11 Z"
                                                      id="Shape"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </g>
            </svg>
            <br>CLIENTS
        </div>
    </a>

</nav>


<nav id="navbar_top">
    <div id="user">
        @if (Route::has('login'))
            @auth
                <ul class="nav navbar-nav navbar-right">
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
                                                    <polygon id="Shape" points="0 0 23.9423689 0 23.9423689 24 0 24"></polygon>
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
                                                    <polygon id="Shape" points="0 0 23.9423689 0 23.9423689 24 0 24"></polygon>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg></a>
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
                            <span id="user_name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>

                            <img class="img-circle img-thumbnail avatar" src="{{Auth::user()->getAvatar()}}">
                            <br>
                            <span id="user_email">{{ Auth::user()->email}}</span>
                        </a>

                        <ul class="dropdown-menu">
                            <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>

                            <li><a href="{{route('profile')}}"><i class="glyphicon icon-right-top settings-icon"></i> Settings</a></li>
                            <li><a href="{{route('help')}}"><i class=" icon-right-top far fa-question-circle fa-2x"></i> Help</a></li>
                            <li>
                                @include('partials.single-post-submit', [
                                    'name'  =>  '<i class="glyphicon icon-right-top logout-icon"></i> Logout',
                                    'route' =>  'logout',
                                    'confirm'   =>  'Are you sure you want to logout?',
                                    'a_class' => ''
                                ])
                            </li>

                        </ul>
                    </li>
                </ul>

            @endauth
        @endif
    </div>
</nav>