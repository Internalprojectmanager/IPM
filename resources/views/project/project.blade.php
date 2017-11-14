@extends('layout.app')

@section('title')
    Project
@endsection

@section('breadcrumbs', Breadcrumbs::render('projects'))

@section('content')
    <h1>Projects</h1>

    <table class="table table-striped table-hover">
        @foreach($projects as $project)
            <tbody>
            <tr>
                <td>
                    <div class="row">
                        <div class="col-lg-9 col-md-8 col-xs-6">
                            {{$project->company->name}} - {{$project->name}}
                        </div>
                        <div class="col-lg-3 col-md-4 col-xs-6">
                            <a class="btn btn-success" href="{{route('projectdetails', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                                <span class="glyphicon glyphicon-search"></span> Details</a>
                            <a class="btn btn-warning" href="{{route('updateproject', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                                <span class="glyphicon glyphicon-edit"></span> Edit</a>
                            <a class="btn btn-danger" href="{{route('deleteproject', ['name' => $project->name, 'company_id' => $project->company_id])}}">
                                <span class="glyphicon glyphicon-trash"></span> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        @endforeach
    </table>

    <a class="btn btn-primary" href="{{route('addproject')}}">Add project</a>

@endsection