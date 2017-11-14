@extends('layout.app')

@section('title')
    Edit client
@endsection

@section('breadcrumbs', Breadcrumbs::render('editclient', $clients))

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
    <form action="{{route('updateclient', $clients->name)}}" method="post">
        {{ csrf_field() }}
        <h3>Company</h3>
        <div class="form-group">
            <input type="hidden" name="name" value="{{$clients->name}}">
            <label for="client_name">Company name:</label>
            <input type="text" class="form-control" name="client_name" id="client_name" value="{{$clients->name}}">
            <br><br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description">{{$clients->description}}</textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection