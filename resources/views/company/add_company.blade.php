@extends('layout.app')

@section('title')
    Add company
@endsection

@section('content')

    <form action="{{route('storecompany')}}" method="post">
        {{ csrf_field() }}
        <h3>Company</h3>
        <div class="form-group">
            <label for="company_name">Company name:</label>
            <input type="text" class="form-control" name="company_name" id="company_name">
            <br><br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection