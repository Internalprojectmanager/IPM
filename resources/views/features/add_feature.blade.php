@extends('layout.app')

@section('title')
    Edit company
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

        <form action="{{route('storefeature', ['name' => $project->name, 'company_id' => $project->company_id, 'release_name' => $release->name])}}" method="post">
            {{ csrf_field() }}
            <h3>New Feature</h3>
            <div class="form-group">

                <input type="hidden" name="release_id" value="{{$release->id}}">
                <input type="hidden" name="feature_id" value="{{$release->project_id}}F">

                <label for="featurename">Feature name:</label>
                <input type="text" class="form-control" name="company_name" id="feature_name">
                <br><br>
                <label for="description">Description:</label>
                <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
                <br><br>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>

@endsection