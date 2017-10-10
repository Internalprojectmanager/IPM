@extends('layout.app')

@section('title')
    Company details
@endsection

@section('breadcrumbs', Breadcrumbs::render('singlecompany', $companys))

@section('content')
        <p>
            Company:
            {{$companys->name}}
            <br>
            Description:
            {{$company->description}}
        </p>

@endsection