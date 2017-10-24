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
                <a href="{{route('editletter', ['project_id' => $letter->project_id, 'letter_if' => $letter->id,
                'letter_title' => $letter->title])}}">Edit</a>
                <a href="{{route('deleteletter', $letter->id)}}">Delete</a><br>
                <b>Content:</b> <br> {{$letter->content}}<br>
            </div>
        </div>
@endsection