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
            <th>Status</th>
            </thead>
            <tbody>
            @foreach($team->users()->get() as $user)
                <tr>
                    <td style="background-color: @if($user->active)#7ED321 @else #CECECE @endif ;"></td>
                    <td>
                        <span class="tabletitle">{{$user->first_name}} {{$user->last_name}}</span>
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        {{$user->jobtitles->name}}
                    </td>
                    <td>{{$user->active}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('team.add_member')
@endsection