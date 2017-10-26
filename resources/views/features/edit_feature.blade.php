@extends('layout.app')

@section('title')
    Edit {{$feature->releases->version}} {{$feature->releases->name}}: {{$feature->name}}
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

    <form action="{{route('updateFeature', ['name' => $feature->releases->projects->name, 'company_id' => $feature->releases->projects->company->id, 'release_name' => $feature->releases->name,'feature_id' => $feature->id])}}" method="post">
        {{ csrf_field() }}
        <h3>Edit {{$feature->releases->version}} {{$feature->releases->name}}: {{$feature->name}}</h3>
        <div class="form-group">

            <input type="hidden" name="release_id" value="{{$feature->release_id}}">
            <label for="featurename">Feature name:</label>
            <input type="text" class="form-control" name="feature_title" id="feature_name" value="{{$feature->name}}">
            <br><br>
            <label for="description">Feature Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description">{{$feature->description}}</textarea>
            <br><br>
            <label for="featurename">Feature Status: <span class="status status_<?php echo substr($feature->status,0 ,2); ?>">{{$feature->status}}</span></label>
            <select class="form-control" name="status">
                <option value="Open">Open</option>
                <option value="In Progress">In Progress</option>
                <option value="Testing">Testing</option>
                <option value="Closed">Closed</option>
            </select>
            <br><br>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection