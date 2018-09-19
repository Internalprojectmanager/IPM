<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('home')}}">
                    <img alt="Brand" src="{{asset('/img/IPM_WHITE.png')}}"/>
            </a>
        </div>
        @auth
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="{{ Request::is('projects *') ? 'active' : '' }}" href="{{route('overviewproject')}}">Projects</a>
                    <!--<a href="{{route('overviewproject')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                    -->
                </li>
                <li><a class="{{ Request::is('clients*') ? 'active' : '' }}" href="{{route('overviewclient')}}">Clients</a></li>
                @if(Auth::user()->teams()->count() > 0)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle {{ Request::is('team*') ? 'active' : '' }}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Teams <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach(Auth::user()->teams() as $teams)
                                <li><a href="{{route('team.show', $teams->slug)}}"> {{$teams->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endif

                @if(Auth::id() == 1 )<li><a href="{{route('admin_dashboard')}}"><i style="width: 2em;" class="fa fa-cogs fa-lg"></i></a></li>@endif
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-plus fa-lg"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(isset($project))
                            <li class="dropdown-header">This Project</li>
                            <li><a href="">New Release</a></li>
                            <li><a href="">New Feature</a></li>
                            <li><a href="">New Requirement</a></li>


                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">IPM</li>
                        @endif


                        <li><a href="{{route('addclient')}}"> New Client</a></li>
                        <li><a href="{{route('addproject')}}"> New Project</a></li>
                        <li><a href="{{route('team.new')}}"> New Team</a></li>
                    </ul>
                </li>

                <li><a href="{{route('dashboard')}}"><i class="fa fa-calendar-check fa-lg"></i></a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle username {{ Request::is('profile*') ? 'active' : '' }}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('profile')}}"><i class="fas fa-cog icon-right-top fa-2x"></i>
                                Settings</a></li>
                        <li><a href="{{route('help')}}"><i class=" icon-right-top far fa-question-circle fa-2x"></i>
                                Help</a></li>
                        <li>
                            @include('partials.single-post-submit', [
                                'name'  =>  '<i class=" icon-right-top fas fa-sign-out-alt fa-2x"></i> Logout',
                                'route' =>  'logout',
                                'confirm'   =>  'Are you sure you want to logout?',
                                'a_class' => ''
                            ])
                        </li>
                    </ul>
                </li>
                <li class="avatar-profile"><a href="{{route('profile')}}"><img alt='' class="img-circle img-thumbnail avatar" src="{{Auth::user()->getAvatar()}}"></a> </li>
            </ul>
        </div><!-- /.navbar-collapse -->
        @endauth
    </div><!-- /.container-fluid -->
</nav>