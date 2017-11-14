@extends('layout.app')

@section('title')
    Project
@endsection

@section('breadcrumbs', Breadcrumbs::render('projects'))

@section('content')
    <button class="btn-primary">
        <a class="black" href="{{route('addproject')}}"> Add project <span class="icon-right glyphicon glyphicon-plus"></span></a>
    </button><h2>All projects ({{$projectcount}})</h2>

    <table class="table table-striped table-hover table-center">
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
                <td style="background-color: {{$project->company->color}};"></td>
                <td><span class="tabletitle">{{$project->name}} </span> <br> <span class="tablesubtitle">{{$project->company->name}}</span></td>
                <td></td>
                <td></td>
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



@endsection