@extends('layout.app')

@section('title')
    Add release
@endsection

@section('breadcrumbs', Breadcrumbs::render('addrelease', $projects, $companys))

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
    <form action="{{route('storerelease', ['name' => $projects->name, 'company_id' => $projects->company_id] )}}" method="post">
        {{ csrf_field() }}
        <h3>Release</h3>
        <div class="form-group">
            <input type="hidden" id="project" name="project_id" value="{{$projects->id}}">
            <input type="hidden" id="company_id" name="company_id" value="{{$companys->id}}">
            <label for="release_name">Release name:</label>
            <input type="text" class="form-control" name="release_name" id="release_name">
            <br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
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