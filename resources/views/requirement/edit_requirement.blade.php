@extends('layout.app')

@section('title')
    Edit Requirement
@endsection

@section('breadcrumbs', Breadcrumbs::render('editRequirement'))

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

    <form action="{{route('updateRequirement', $requirements->name)}}" method="post">
        {{ csrf_field() }}
        <h3>Requirement</h3>
        <div class="form-group">
            <label for="Requirement_name">Requirement name:</label>
            <input type="text" class="form-control" name="requirement_name" id="requirement_name">
            <br><br>
            <label for="Requirement_status">Status:</label>
            <input type="text" class="form-control" name="requirement_status" id="requirement_name">
            <br><br>
            <label for="Requirement_author">Author:</label>
            <input type="text" class="form-control" name="requirement_author" id="requirement_name">
            <br><br>
            <label for="userclass">user</label>
            <input type="checkbox" class="userclass" name="developer" id="developer">developer
            <input type="checkbox" class="userclass" name="designer"  id="designer">designer
            <br><br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection