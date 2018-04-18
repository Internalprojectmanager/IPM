@extends('layout.app')

@section('title')
    Requirement details
@endsection

@section('breadcrumbs', Breadcrumbs::render('singleRequirement', $requirements))

@section('content')
    <p>
        Requirement:
        {{$requirements->name}}
        <br>
        Status:
        {{$requirements->status}}
        <br>
        Author:
        {{$requirements->author}}
        <br>
        Users:
        {{$requirements->users}}
        <br>
        Description:
        {{$requirements->description}}
    </p>

@endsection