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
                <b>Author:</b> {{$document->author}}<br>
                <a href="{{route('editdocument', ['project_id' => $document->project_id, 'document_id' => $document->id,
                'document_title' => $document->title])}}">Edit</a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')"
                   href="{{route('deletedocument', $document->id)}}"><span class="glyphicon glyphicon-trash"></span></a><br>
                <b>Content:</b> <br> {{$document->description}}<br>
            </div>
        </div>
@endsection