@extends('layout.app')

@section('title')
    Add document
@endsection

@section('content')

    <form action="{{route('storedocument')}}" method="post">
        {{ csrf_field() }}
        <h3>Document</h3>
        <div class="form-group">
            <input type="hidden" id="project" name="project_id" value="{{$projects->id}}">
            <input type="hidden" id="company_id" name="company_id" value="{{$companys->name}}">
            <label for="document_title">Document title:</label>
            <input type="text" class="form-control" name="document_title" id="document_title">
            <br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
            <br>
            <label for="Author">Author:</label>
            <input type="text" class="form-control" name="author" id="author">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection