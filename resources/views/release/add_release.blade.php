@extends('layout.app')

@section('title')
    Add release
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

    <form action="{{route('storerelease')}}" method="post">
        {{ csrf_field() }}
        <h3>Release</h3>
        <div class="form-group">
            <input type="hidden" id="project" name="project" value="{{$projects->name}}">
            <label for="release_name">Release name:</label>
            <input type="text" class="form-control" name="release_name" id="release_name">
            <br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
            <br>
            <label for="version">Version number:</label>
            <input type="text" class="form-control" id="version" name="version">
            <br>
            <label for="author">Author:</label>
            <input type="text" class="form-control" id="author" name="author">
            <br>
            <label for="specification">Specification type:</label>
            <input type="text" class="form-control" id="specification" name="specification">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection