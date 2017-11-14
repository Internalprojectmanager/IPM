@extends('layout.app')

@section('title')
    Company details
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleclient', $clients))

@section('content')
        <p>
            Company:
            {{$clients->name}}
            <br>
            Description:
            {{$clients->description}}
        </p>

@endsection