@extends('layout.app')

@section('title')
    Project details
@endsection

@section('content')

    @foreach($projects as $project)
        <p>
            Project:
            {{$project->name}}
            <br>
            @foreach($companys as $company)
                Company:
                {{$company->name}}
            @endforeach
            <br>
            Description:
            {{$project->description}}
        </p>
    @endforeach

@endsection