@extends('layout.app')

@section('title')
    Projects
@endsection

@section('content')
    <div>

        {{dd($projects)}}
        @foreach($projects as $p)

        @endforeach
    </div>
@endsection