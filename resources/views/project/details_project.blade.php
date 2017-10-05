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
        </p>


@endsection