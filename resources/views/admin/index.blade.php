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
        <div class="col-md-4 white-back">
            <h1 class="center">Users</h1>
            <table class="table table-hover table-center results" id="release-overview">
                <thead>
                <th></th>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="col-md-1"
                            style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                        <td class="col-md-2">
                            <img class="img-thumbnail img-circle avatar-table" src="{{$user->getAvatar()}}"/>
                        </td>
                        <td colspan="">{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{ $user->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="center" href="{{route('admin_users')}}">Show more</a>
        </div>

        <div class="col-md-4">
            <div class="white-back">
                <h1 class="center">Teams</h1>
                @if($teams->count() > 0)
                    <table class="table table-hover table-center results" id="release-overview">
                        <thead>
                        <th></th>
                        <th>Name</th>
                        <th>Projects</th>
                        <th>Clients</th>
                        </thead>
                        <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <td class="col-md-1"
                                    style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                                <td colspan=""><img class='team-logo' src="{{\Storage::url($team->logo)}}"></td>
                                <td colspan="">{{$team->name}}</td>
                                <td colspan="">{{$team->projects()->count()}}</td>
                                <td colspan="">{{$team->clients()->count()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>


        <div class="col-md-4">
            <div class="white-back">
                <h1 class="center">Projects</h1>
                @if($teams->count() > 0)
                    <table class="table table-hover table-center results" id="release-overview">
                        <thead>
                        <th></th>
                        <th>Name</th>
                        <th>Releases</th>
                        </thead>
                        <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td class="col-md-1"
                                    style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                                <td>{{$project->name}}</td>
                                <td>{{$project->releases->count()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection