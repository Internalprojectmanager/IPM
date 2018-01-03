@extends('layout.app')

@section('title')
    Add document
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

    <form action="{{route('updatedocument', ['document_id' => $document->id,
        'name' => $project->name, 'company_id' => $project->company_id])}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <h3>Document</h3>
        <div class="form-group">
            <label for="document_title">Document title:</label>
            <input type="text" class="form-control" name="document_title" id="document_title" value="{{old('document_title', $document->title)}}">
            <br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description">{{$document->description}}</textarea>
            <br>
            <label for="status">Status:</label><br>
            <select name="status">
                @foreach($status as $s)
                    @if($s->type == 'Progress')
                        @if($s->id == $document->status)
                            <option selected value="{{$s->id}}">{{$s->name}}</option>
                        @else
                            <option value="{{$s->id}}">{{$s->name}}</option>
                        @endif
                    @endif
                @endforeach
            </select>
            <br>

            <label for="category">Category:</label><br>
            <select name="category">
                @foreach($status as $s)
                    @if($s->type == 'Document')
                        @if($s->id == $document->category)
                            <option selected value="{{$s->id}}">{{$s->name}}</option>
                        @else
                            <option value="{{$s->id}}">{{$s->name}}</option>
                        @endif
                    @endif
                @endforeach
            </select>

            <br>

            <label for="release">Release:</label><br>
            <select name="release_id">
                @foreach($release as $r)
                    @if($r->release_uuid == $document->release_id)
                        <option selected value="{{$r->release_uuid}}">{{$r->version}} - {{$r->name}}</option>
                    @else
                        <option value="{{$r->release_uuid}}">{{$r->version}} - {{$r->name}}</option>
                    @endif
                @endforeach
            </select>
            <br><br>

            <label for="upload">Update File</label>
            <input type="file" name="upload" value="{{old('file')}}" />
            <br>
            <div class="uploaded">
                @if(!empty($document->link))
                    <div class="download" id="{{$document->id}}">
                        <span class="project-detail block-value">{{$document->filename}}</span>
                        <a class="pull-right deletefile" href="{{route('deletefile', $document->id)}}"><i class="glyphicon cross-icon"></i></a>
                        <span class="project-detail pull-right block-value">{{round(Storage::size($document->link) / 1000000, 2)}} MB</span>
                    </div>
                @endif
            </div>
            <br>
        <div class="row pull-right">
            <div class="col-md-6">
                <a href="{{route('deletedocument', ['company_id' => $project->company_id,
                'name' => $project->name,'document_id' => $document->id ])}}" class="btn btn-a btn-delete pull-right">Delete</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-save" type="submit">Save</button>
            </div>
        </div>


    </form>







@endsection