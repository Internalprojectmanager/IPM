@extends('layout.app')

@section('title')
    {{$document->title}} - {{$document->projects->name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$document->projects->company->name}} {{$document->projects->name}}: {{$document->title}}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
@endsection