@extends('layout.app')

@section('title')
    Project
@endsection

@section('breadcrumbs', Breadcrumbs::render('projects'))

@section('content')
    <div class="row">
        <button class="btn-primary">
            <a class="black" href="{{route('addproject')}}"> Add project <span class="icon-right glyphicon glyphicon-plus"></span></a>
        </button>

    </div>

    <div class="row block-white">
        <span class="block-white-title">All projects</span> <span class="block-white-subtitle"> | {{$projectcount}} Projects</span>
    </div>

    <div class="row">
        <table class="table table-hover table-center">
            <thead>
            <th></th>
            <th>Project + Client</th>
            <th>Description</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Users</th>
            </thead>
            <tbody>
            @foreach($projects as $project)

                <tr>
                    <td class="status-@if(!isset($project->status))draft @elseif($project->status == "In Progress")in @else{{$project->status}} @endif"></td>
                    <td><span class="tabletitle">{{$project->name}} </span> <br> <span class="tablesubtitle">@if(isset($project->company)){{$project->company->name}}@endif</span></td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->status}}</td>
                    <td></td>
                    <td></td>
                    <td>
                        <a class="btn btn-success" href="{{route('projectdetails', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                            <span class="glyphicon glyphicon-search"></span></a>
                        <a class="btn btn-warning" href="{{route('updateproject', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                            <span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-danger" href="{{route('deleteproject', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                            <span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>


@endsection