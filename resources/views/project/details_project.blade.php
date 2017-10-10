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
            <a href="{{route('addrelease', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">Add release</a>
        </p>

@endsection