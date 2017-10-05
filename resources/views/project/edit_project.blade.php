@extends('layout.app')

@section('title')
    Edit project
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

    @foreach($projects as $project)
        <form action="{{route('updateproject', $project->name)}}" method="post">
            {{ csrf_field() }}
            <h3>Project</h3>
            <div class="form-group">
                <input type="hidden" name="name" value="{{$project->name}}">
                <label for="project_name">Project name:</label>
                <input type="text" class="form-control" name="project_name" id="project_name" value="{{$project->name}}">
                <br>
                <select name="company" id="company" >
                    @foreach($companys as $company)
                        <option value="{{$company->name}}">{{$company->name}}</option>
                    @endforeach
                </select>
                <br><br>
                <label for="description">Description:</label>
                <textarea rows="4" cols="50" name="description" class="form-control" id="description">{{$project->description}}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    @endforeach

@endsection