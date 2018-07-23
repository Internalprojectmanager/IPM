@extends('layout.app')

@section('title')
    Users - Admin - {{env('APP_NAME')}}
@endsection


@section('content')

    <div class="row block-white">
        <div class="row under-details">
            <div class="col-md-12 col-xs-12">
            <span class="block-white-title">
                Admin - Dashboard </span>
                <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$teams->count()}}</span>
                    <span class="contenttype">Teams(s)</span>
            </span>

                <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$plans->count()}}</span>
                    <span class="contenttype">Plan(s)</span>
            </span>

                <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$users->count()}}</span>
                    <span class="contenttype">User(s)</span>
            </span>

                <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$projects->count()}}</span>
                    <span class="contenttype">Project(s)</span>
            </span>

                <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$releases}}</span>
                    <span class="contenttype">Release(s)</span>
            </span>

                <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$features}}</span>
                    <span class="contenttype">Feature(s)</span>
            </span>

                <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$requirements}}</span>
                    <span class="contenttype">Requirement(s)</span>
            </span>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 center">
            <span class="block-white-subtitle">
                <span class="contenttype"> {{env('APP_NAME')}} - V{{file_get_contents(public_path('../VERSION'), 'r')}}
                    <span style="margin-left: 10px">
                        @php
                            $internal = file_get_contents(public_path('../VERSION'), 'r');

                            $ch = curl_init("https://gitlab.com/internalprojectmanager/IPM/raw/master/VERSION");
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                'Authorization' => env('AUTH_GITLBAB_KEY')
                            ));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $external = curl_exec($ch);
                            curl_close($ch);

                            $ch = curl_init("https://gitlab.com/api/v4/projects/". env('GITLAB_PROJECT_ID') ."/repository/tags/");
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                'Authorization' => env('AUTH_GITLBAB_KEY'),
                                'sort' => 'ASC'
                            ));
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            $result = curl_exec($ch);
                            curl_close($ch);

                        @endphp
                        @if(strpos($internal, 'RC') === false)
                            @php $external = $internal; @endphp
                            @php $major = $internal; @endphp
                            @if(isset($result) && $result !== null && $result !== "")
                                @foreach(json_decode($result) as $tag)
                                    @if($tag->name == floatval($internal) && version_compare($tag->name, $internal) == true)
                                        @php $external = $tag->name; @endphp
                                    @endif

                                    @if(version_compare($tag->name, $major) > 0 && strpos($tag->name, 'RC') === false)
                                        @php $major = $tag->name @endphp
                                    @endif

                                @endforeach
                            @endif
                        @endif
                        @if(version_compare($external, $internal) == 0)
                            <span class="status-Client white" style="padding: 10px 15px">Latest Version </span>
                        @else
                            <span class="status-Canceled white" style="padding: 10px 15px">Update ASAP - V{{$external}}
                                 </span>
                        @endif
                        @if(isset($major) && version_compare($major, $internal) == true)

                            <span class="status-in white" style="padding: 10px 15px">New Major - V{{$major}}
                                Available</span>
                        @endif
                        </span>
                    </span>

            </span>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="white-back col-md-12">
                <h1 class="center">Users</h1>
                <table class="table table-hover table-center results">
                    <thead>
                    <th></th>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                    </thead>
                    <tbody>
                    <?php $count = 0; ?>
                    @foreach($users as $user)
                        <?php if ($count == 5) break; ?>
                        <tr>
                            <td class="col-md-1"
                                style="background-color: @if($user->active && $user->toc)  #7ED321 @elseif($user->active && !$user->toc) #CECECE  @else #FF3300 @endif ;"></td>
                            <td class="col-md-2">
                                <img class="img-thumbnail img-circle avatar-table" src="{{$user->getAvatar()}}"/>
                            </td>
                            <td colspan="">{{$user->first_name}} {{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{ $user->created_at}}</td>
                        </tr>
                        <?php $count++; ?>
                    @endforeach
                    </tbody>
                </table>
                <a class="center" href="{{route('admin_users')}}">Show more</a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="white-back col-md-12">
                <h1 class="center">Teams</h1>
                @if($teams->count() > 0)
                    <table class="table table-hover table-center results">
                        <thead>
                        <th></th>
                        <th>Name</th>
                        <th>Plan</th>
                        <th>Projects</th>
                        <th>Clients</th>
                        <th>Members</th>

                        </thead>
                        <tbody>

                        <?php $count = 0; ?>
                        @foreach($teams as $team )

                            @if($team->owner !== null)
                                @if($team->name !== $team->owner->fullName())
                                    <?php if ($count == 5) break; ?>
                                    <tr>
                                        <td class="col-md-1"
                                            style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                                        <td colspan=""><img class='team-logo'
                                                            src="{{\Storage::url($team->logo)}}"> {{$team->name}}</td>
                                        @if($team->plan() !== null)
                                            <td colspan="">{{$team->plan()->name}}</td>
                                        @endif
                                        <td colspan="">{{$team->project()->count()}}</td>
                                        <td colspan="">{{$team->client()->count()}}</td>
                                        <td colspan="">{{$team->users()->count()}}</td>
                                    </tr>
                                    <?php $count++; ?>
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <a class="center" href="{{route('admin_teams')}}">Show more</a>
                @endif
            </div>
        </div>
    </div>

    <div class="row margin-top-50">
        <div class="col-md-6">
            <div class="white-back col-md-12">
                <h1 class="center">Projects</h1>
                @if($projects->count() > 0)
                    <table class="table table-hover table-center results">
                        <thead>
                        <th></th>
                        <th>Name</th>
                        <th>Team</th>
                        <th>Releases</th>

                        </thead>
                        <tbody>
                        <?php $count = 0; ?>
                        @foreach($projects as $project)
                            <?php if ($count == 5) break; ?>
                            <tr>
                                <td class="col-md-1"
                                    style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                                <td>{{$project->name}}</td>
                                <td>{{$project->team->name}}</td>
                                <td>{{$project->releases->count()}}</td>
                                <td>{{$project->created_at}}</td>
                            </tr>
                            <?php $count++; ?>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                <a class="center" href="{{route('admin_projects')}}">Show </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="white-back col-md-12">
                <h1 class="center">Plans</h1>
                @if($projects->count() > 0)
                    <table class="table table-hover table-center results">
                        <thead>
                        <th></th>
                        <th>Name</th>
                        <th>Used</th>
                        <th>Price</th>
                        </thead>
                        <tbody>
                        <?php $count = 0; ?>
                        @foreach($plans as $plan)
                            <?php if ($count == 5) break; ?>
                            <tr>
                                <td class="col-md-1"
                                    style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                                <td>{{$plan->name}}</td>
                                <?php $countteams = 0; ?>
                                <td>@foreach($teams as $team)
                                        @if($team->plan() !== null)
                                            @if($plan->name == $team->plan()->name)
                                                <?php $countteams++ ?>
                                            @endif
                                        @endif
                                    @endforeach
                                    {{$countteams}}
                                </td>
                                <td>0.00</td>
                            </tr>
                            <?php $count++; ?>

                        @endforeach
                        </tbody>
                    </table>
                @endif
                <a class="center" href="{{route('admin_plans')}}">Show more
            </div>
        </div>
    </div>

    </div>

@endsection