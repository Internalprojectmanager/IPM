@extends('layout.app')

@section('title')
    Project
@endsection

@section('content')

    @foreach($projects as $project)
        <p>
            {{$project->name}}
            <a href="{{route('projectdetails', ['name' => $project->name, 'company_id' => $project->company_id])}}">Details</a>
            <a href="{{route('editproject', ['name' => $project->name, 'company_id' => $project->company_id])}}">Edit</a>
            <a href="{{route('deleteproject', ['name' => $project->name, 'company_id' => $project->company_id])}}">Delete</a>
        </p>
    @endforeach

    <a href="{{route('addproject')}}">Add project</a>

@endsection