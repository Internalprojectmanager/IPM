@extends('layout.app')

@section('title')
    Add document
@endsection

@section('content')

    <form action="{{route('storedocument')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
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
            <label for="status">Status:</label>

            <select name="status">
                @foreach($status as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
            </select>
            <br>

            <label for="release">Release:</label>

            <select name="release_id">
                @foreach($release as $r)
                    <option value="{{$r->release_uuid}}">{{$r->version}} - {{$r->name}}</option>
                @endforeach
            </select>
            <br><br>

            <label for="upload">Upload File</label>
            <input type="file" name="upload" />
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection