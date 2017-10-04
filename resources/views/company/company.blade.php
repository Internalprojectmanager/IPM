@extends('layout.app')

@section('title')
    Company
@endsection

@section('content')

    @foreach($companys as $company)
        <p>
            {{$company->name}}
            <a href="{{route('companydetails', $company->name)}}">Details</a>
            <a href="{{route('editcompany', $company->name, $company->description)}}">Edit</a>
            <a href="{{route('deletecompany', $company->name)}}">Delete</a>
        </p>
    @endforeach

    <a href="{{route('addcompany')}}">Add company</a>

@endsection