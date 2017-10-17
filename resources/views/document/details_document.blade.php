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
                <b>Title:</b> {{$document->title}}<br>
                <b>Author:</b>{{$document->author}}<br>
                <b>Content:</b> <br> {{$document->description}}<br>
            </div>
        </div>
@endsection