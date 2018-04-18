@extends('layout.app')

@section('title')
    {{$project->name}} New Document | {{env('APP_NAME')}}
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


    <form action="{{route('storedocument', [$client->path, $project->path])}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <h3>Document</h3>
        <div class="form-group">
            <input type="hidden" id="project" name="project_id" value="{{$project->id}}">
            <input type="hidden" id="company_id" name="company_id" value="{{$client->name}}">
            <label for="document_title">Document title: <span class="required">*</span></label>
            <input type="text" class="form-control" required name="document_title" id="document_title" value="{{old('document_title')}}">
            <br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description">{{old('description')}}</textarea>
            <br>
            <label for="status">Status: <span class="required">*</span></label>

            <select name="status" required>
                @foreach($status as $s)
                    @if($s->type == 'Progress')
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endif
                @endforeach
            </select>
            <br>

            <label for="category">Category: <span class="required">*</span></label>

            <select name="category" required>
                @foreach($status as $s)
                    @if($s->type == 'Document')
                    <option value="{{$s->id}}">{{$s->name}}</option>
                    @endif
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
            <input type="file" name="upload" value="{{old('file')}}" />
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection