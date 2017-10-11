@extends('layout.app')

@section('title')
    Edit company
@endsection

@section('breadcrumbs', Breadcrumbs::render('editcompany', $companys))

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
    <form action="{{route('updatecompany', $companys->name)}}" method="post">
        {{ csrf_field() }}
        <h3>Company</h3>
        <div class="form-group">
            <input type="hidden" name="name" value="{{$companys->name}}">
            <label for="company_name">Company name:</label>
            <input type="text" class="form-control" name="company_name" id="company_name" value="{{$companys->name}}">
            <br><br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description">{{$companys->description}}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection