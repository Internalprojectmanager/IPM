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
                <a class="btn btn-warning" href="{{route('editletter', ['project_id' => $letter->project_id, 'letter_id' => $letter->id,
                'letter_title' => $letter->title, 'name' => $project->name, 'company_id' => $project->company_id])}}">
                    <span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')"
                   href="{{route('deleteletter', $letter->id)}}"><span class="glyphicon glyphicon-trash"></span></a><br>
                <b>Content:</b> <br> {{$letter->content}}<br>
            </div>
        </div>
    </div>
@endsection