@extends('layout.app')

@section('title')
    {{$letter->title}} - {{$letter->projects->name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$letter->projects->company->name}} {{$letter->projects->name}}: {{$letter->title}}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <b>Title:</b> {{$letter->title}}<br>
                <b>Author:</b>{{$letter->author}}<br>
                <b>Contact person:</b>{{$letter->contact_person}}<br>
                <b>Content:</b> <br> {{$letter->content}}<br>
            </div>
        </div>
@endsection