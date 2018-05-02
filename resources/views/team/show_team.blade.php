@extends('layout.app')

@section('title')

@endsection


@section('content')

    <a href="" class="btn-edit" id="project-edit">
        <span class="glyphicon edit-icon"></span> Edit
    </a>
    <div class="row block-white">

        <div class="col-md-4 col-xs-12">
            <span class="block-white-title">Team {{$team->name}}</span>
            <span class="block-white-subtitle">
            <span id="count_projects_bar">|</span>
            <span class="counter">{{$team->users()->count()}}</span>
            <span class="contenttype">Users</span>
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
                        @if($user->jobtitles)
                            {{$user->jobtitles->name}}
                        @endif
                    </td>
                    <td></td>
                    <td class="col-md-2 right">
                        @if(Auth::id() !== $user->id)
                            @if($user->pivot->active ==  true)
                                <a class="no-underline" onclick="return confirm('Are you sure you want to block this User?');"
                                   href="{{route('teammember.block', [$team->name, $user->id])}}">
                                    <span class="btn btn-danger"><i class="fas fa-ban"></i>  Block</span>
                                </a>
                            @else
                                <a class="no-underline" onclick="return confirm('Are you sure you want to block this User?');"
                                   href="{{route('teammember.unblock', [$team->name, $user->id])}}">
                                    <span class="btn btn-success"><i class="far fa-check-circle"></i>  Unblock</span>
                                </a>
                            @endif
                                <a class="no-underline" onclick="return confirm('Are you sure you want to delete this User?');"
                                   href="{{route('teammember.delete', [$team->name, $user->id])}}">
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