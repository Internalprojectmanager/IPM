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
                <a class="btn btn-warning" href="{{route('editdocument', ['document_id' => $document->id,
                'name' => $project->name, 'company_id' => $project->company_id])}}">
                    <span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')"
                   href="{{route('deletedocument', $document->id)}}"><span class="glyphicon glyphicon-trash"></span></a><br>
                <b>Content:</b> <br> {{$document->description}}<br>
            </div>
        </div>
    </div>
@endsection