@extends('layout.app')

@section('title')
    Add project
@endsection

@section('breadcrumbs', Breadcrumbs::render('addproject'))

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

    <form action="{{route('storeproject')}}" method="post">
        {{ csrf_field() }}
        <h3>Project</h3>
        <div class="form-group">
            <label for="project_name">Project name:</label>
            <input type="text" class="form-control" name="project_name" id="project_name">
            <br>
            <label for="company">Client:</label><br>
            <select name="company" id="company" >
                @foreach($companys as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                @endforeach
            </select>
            <br><br>
            <label for="project_name">Project Status:</label>
            <br>
            <select name="status">
                @foreach($status as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
            </select>
            <br><br>
            <label for="project_name">Deadline:</label>
            <input type="text" class="form-control" name="deadline" id="deadline" placeholder="YYYY/MM/DD">
            <br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>

            <label for="assignee">Assignee</label>
            <select name="assignee[]" multiple>
                @foreach($user as $u)
                    <option value="{{$u->id}}">{{$u->first_name}} {{$u->last_name}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection