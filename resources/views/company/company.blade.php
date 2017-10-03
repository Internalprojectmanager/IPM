@extends('layout.app')

@section('title')
    Company
@endsection

@section('content')

    @foreach($companys as $company)
        <p>
            {{$company->name}}
            <a href="#">Edit</a>
            <a href="{{route('deletecompany')}}">Delete</a>
        </p>
    @endforeach

    <a href="{{route('addcompany')}}">Add company</a>

@endsection