@extends('layout.app')

@section('title')
    Add client
@endsection

@section('breadcrumbs', Breadcrumbs::render('addclient'))

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

    <form action="{{route('storeclient')}}" method="post">
        {{ csrf_field() }}
        <h3>Company</h3>
        <div class="form-group">
            <label for="client_name">Company name:</label>
            <input type="text" class="form-control" name="client_name" id="client_name">
            <br><br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection