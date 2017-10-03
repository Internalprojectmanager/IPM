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
            <input type="text" name="company_name" id="company_name">
        </div>
        <button type="submit">Submit</button>
    </form>

@endsection