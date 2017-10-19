@extends('layout.app')

@section('title')
    Edit document
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('updatedocument', ['project_id' => $documents->project_id, 'document_id' => $documents->id,
                'document_title' => $documents->title])}}" method="post">
        {{ csrf_field() }}
        <h3>Company</h3>
        <div class="form-group">
            <input type="hidden" name="document_id" value="{{$documents->id}}">
            <input type="hidden" name="project_id" value="{{$documents->project_id}}">
            <label for="document_title">Document title:</label>
            <input type="text" class="form-control" name="document_title" id="document_title" value="{{$documents->title}}">
            <br><br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description">{{$documents->description}}</textarea>
            <br><br>
            <label for="author">Author:</label>
            <input type="text" class="form-control" name="author" id="author" value="{{$documents->author}}">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection