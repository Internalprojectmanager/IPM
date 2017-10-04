@extends('layout.app')

@section('title')
    Company details
@endsection

@section('content')

    @foreach($companys as $company)
        <p>
            Company:
            {{$company->name}}
            <br>
            Description:
            {{$company->description}}
        </p>
    @endforeach

@endsection