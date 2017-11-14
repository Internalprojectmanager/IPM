@extends('layout.app')

@section('title')
    Project
@endsection

@section('breadcrumbs', Breadcrumbs::render('projects'))

@section('content')
    <a class="btn btn-primary" href="{{route('addproject')}}"><span class="glyphicon glyphicon-plus"></span> Add project</a>
    <h2>All projects ({{$projectcount}})</h2>

    <table class="table table-striped table-hover table-center">
        <thead>
        <th>Name Project<br>
            Name Client</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Users</th>
        <th></th>
        </thead>
        @foreach($projects as $project)
            <tbody>
            <tr>
                <td>{{$project->name}} <br> {{$project->company->name}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="btn btn-success" href="{{route('projectdetails', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                        <span class="glyphicon glyphicon-search"></span> Details</a>
                    <a class="btn btn-warning" href="{{route('updateproject', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit</a>
                    <a class="btn btn-danger" href="{{route('deleteproject', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                        <span class="glyphicon glyphicon-trash"></span> Delete</a>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>



@endsection