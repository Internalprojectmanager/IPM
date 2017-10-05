@extends('layout.app')

@section('title')
    Add project
@endsection

@section('content')

    <form action="{{route('storeproject')}}" method="post">
        {{ csrf_field() }}
        <h3>Project</h3>
        <div class="form-group">
            <label for="project_name">Project name:</label>
            <input type="text" class="form-control" name="project_name" id="project_name">
            <br>
            <select name="company" id="company" >
                @foreach($companys as $company)
                    <option value="{{$company->name}}">{{$company->name}}</option>
                @endforeach
            </select>
            <br><br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection