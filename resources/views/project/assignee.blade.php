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
        <h3>Assigned Users</h3>
        <div class="form-group">
            <label for="project_name">Project name:</label>
            <label for="assignee">Assignee</label>
            <select name="assignee[]" multiple class="selectpicker">
                @foreach($user as $u)
                    <option value="{{$u->id}}">{{$u->first_name}} {{$u->last_name}}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection