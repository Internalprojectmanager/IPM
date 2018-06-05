@extends('layout.app')

@section('title')

    {{$team->name}} - {{env('APP_NAME')}}

@endsection


@section('content')


    @if($team->name !== Auth::user()->fullName() && $team->owner_id == Auth::id())

        <div class="row above-white">
            <span class="pull-right"><a href="{{route('team.edit', $team->slug)}}" class="btn-edit pull-right" >
                <span class="glyphicon edit-icon"></span> Edit
            </a> </span>
            <span class="col-md-1 pull-right">
                <a href="#" class="btn-edit pull-right">
                <span class="glyphicon edit-icon"></span> Plan</a>

            </span>

        </div>
    @endif

    <div class="row block-white">

        <div class="col-md-12 col-xs-12">
            <span class="block-white-title">
                @if($team->logo !== null)
                    <img class='team-logo' src="{{\Storage::url($team->logo)}}">
                @endif
                @if($team->name !== Auth::user()->fullName())
                    Team {{$team->name}}</span>
                @else
                    My Workspace
                @endif
            <span class="block-white-subtitle">
                @if(!empty($team->plan()))
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$team->plan()->name}}</span>
                @endif
                @if($team->name !== Auth::user()->fullName())
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$team->users()->count()}} / {{$team->plan()->users}}</span>
                    <span class="contenttype">User(s)</span>
                @endif
                    @if($team->project)
                        <span id="count_projects_bar">|</span>
                        <span class="counter">{{$team->project()->count()}} / {{$team->plan()->projects}}</span>
                        <span class="contenttype"> Projects(s)</span>
                    @endif
            </span>

        </div>


    </div>

    <div class="row under-details">
        <a class="black btn btn-primary" href="#" data-toggle="modal" data-target="#addTeamMember">
            Add Teammember <span class="glyphicon glyphicon-plus"></span>
        </a>
    </div>
    <div class="row">
        <table class="table table-hover table-center results" id="release-overview">
            <thead>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Job</th>
            </thead>
            <tbody>
            @foreach($team->users()->get() as $user)
                <tr>
                    <td class="col-md-1" style="background-color: @if($user->pivot->active)#7ED321 @else #CECECE @endif ;"></td>
                    <td colspan="" class="col-md-3">
                        <span class="tabletitle">{{$user->first_name}} {{$user->last_name}} </span>
                        @if($user->id == Auth::id()) <span class="its its-you"> Its You!</span> @endif
                        @if($user->pivot->active == false) <span class="its its-blocked"> Blocked</span> @endif
                    </td>
                    <td class="col-md-3">
                        {{$user->email}}
                    </td>
                    <td class="col-md-2">

                        @if($user->id == $team->owner_id)
                            - Owner <br>
                        @endif
                        @if($user->jobtitles)
                            - {{$user->jobtitles->name}}
                        @endif
                    </td>
                    <td></td>
                    <td class="col-md-3 right">
                        @if(Auth::id() !== $user->id && $team->owner_id == Auth::id())
                            @if($user->pivot->active ==  true)
                                <a class="no-underline" onclick="return confirm('Are you sure you want to block this User?');"
                                   href="{{route('teammember.block', [$team->slug, $user->id])}}">
                                    <span class="btn btn-danger"><i class="fas fa-ban"></i>  Block</span>
                                </a>
                            @else
                                <a class="no-underline" onclick="return confirm('Are you sure you want to block this User?');"
                                   href="{{route('teammember.unblock', [$team->slug, $user->id])}}">
                                    <span class="btn btn-success"><i class="far fa-check-circle"></i>  Unblock</span>
                                </a>
                            @endif
                                <a class="no-underline" onclick="return confirm('Are you sure you want to delete this User?');"
                                   href="{{route('teammember.delete', [$team->slug, $user->id])}}">
                                    <span class="btn btn-danger"><i class="fas fa-trash"></i>  Delete</span>
                                </a>

                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('team.add_member')
@endsection