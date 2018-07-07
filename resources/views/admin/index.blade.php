@extends('layout.app')

@section('title')
    Users - Admin - {{env('APP_NAME')}}
@endsection


@section('content')

    <div class="row block-white">

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
                    <span class="counter">{{$users->count()}}</span>
                    <span class="contenttype">User(s)</span>
            </span>

            <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$projects->count()}}</span>
                    <span class="contenttype">User(s)</span>
            </span>

        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
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
                        <?php if($count == 5) break; ?>
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

        <div class="col-md-4">
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
                            @if($team->name !== $team->owner->fullName())
                                <?php if($count == 5) break; ?>
                                <tr>
                                    <td class="col-md-1"
                                        style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                                    <td colspan=""><img class='team-logo' src="{{\Storage::url($team->logo)}}"> {{$team->name}}</td>
                                    <td colspan="">{{$team->plan()->name}}</td>
                                    <td colspan="">{{$team->project()->count()}}</td>
                                    <td colspan="">{{$team->client()->count()}}</td>
                                    <td colspan="">{{$team->users()->count()}}</td>
                                </tr>
                                <?php $count++; ?>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    <a class="center" href="{{route('admin_users')}}">Show more</a>
                @endif
            </div>
        </div>


        <div class="col-md-4">
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
                            <?php if($count == 5) break; ?>
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
                <a class="center" href="{{route('admin_users')}}">Show more</a>
            </div>
        </div>
    </div>

@endsection