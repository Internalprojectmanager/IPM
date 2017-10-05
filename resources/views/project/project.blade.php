@extends('layout.app')

@section('title')
    Project
@endsection

@section('content')

    @foreach($projects as $project)
        <p>
            {{$project->name}}
            <a href="#">Details</a>
            <a href="{{route('editproject', $project->name, $project->company_id,$project->description)}}">Edit</a>
            <a href="{{route('deleteproject', $project->name)}}">Delete</a>
        </p>
    @endforeach

    <a href="{{route('addproject')}}">Add project</a>

@endsection