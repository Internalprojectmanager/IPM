@extends('layout.app')

@section('title')
    Project details
@endsection

@section('content')

        <p>
            Project:
            {{$projects->name}}
            <br>
                Company:
                {{$companys->name}}
            <br>
            Description:
            {{$projects->description}}
            <br><br>
            <a href="{{route('addrelease', $projects->name)}}">Add release</a>
        </p>

@endsection