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
            @foreach($releases as $release)
                <p>
                    <a href="#">{{$release->name}} {{$release->version}}</a>
                </p>
            @endforeach
            <br><br>
            <a href="{{route('addrelease', ['name' => $projects->name, 'company_id' => $projects->company_id])}}">Add release</a>
        </p>

@endsection