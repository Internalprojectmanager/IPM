@extends('layout.app')

@section('title')
    projects - Admin - {{env('APP_NAME')}}
@endsection


@section('content')

    <div class="row block-white">

        <div class="col-md-12 col-xs-12">
            <span class="block-white-title">
                Admin - projects </span>
            <span class="block-white-subtitle">
                    <span id="count_projects_bar">|</span>
                    <span class="counter">{{$projects->count()}}</span>
                    <span class="contenttype">project(s)</span>
            </span>

        </div>
    </div>

    <div class="row">
        <table class="table table-hover table-center results" id="release-overview">
            <thead>
            <th></th>
            <th>Name</th>
            <th>Description</th>
            <th>Team</th>
            <th>Status</th>
            <th>Assignees</th>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <td class="col-md-1" style="background-color: {{$project->pstatus->color}};"></td>
                    <td colspan="" class="col-md-3">
                        <span class="tabletitle">{{$project->name}}</span><br>
                        <span class="tablesubtitle">{{$project->company->name}}</span>
                    </td>
                    <td class="col-md-3">
                        {{$project->description}}
                    </td>
                    <td class="col-md-2">{{$project->team->name}}</td>
                    <td class="col-md-1">{{$project->pstatus->name}}</td>
                    <td class="col-md-1">{{$project->assignee->count()}}</td>

                    <td class="col-md-2 right">
                        <a class="no-underline"
                           href="{{route('projectdetails', [$project->company->path, $project->path])}}">
                            <span class="btn btn-edit"><span class="glyphicon edit-icon"></span> Edit</span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--<div class="row">--}}
            {{--<div class="center">--}}
                {{--{{ $projects->links() }}--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

@endsection