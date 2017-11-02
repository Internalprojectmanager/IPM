@extends('layout.app')

@section('title')
    Edit Test Report
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
    <form action="{{route('updatetestreport', $testreport->id)}}" method="post">
        {{ csrf_field() }}
        <h3>Test report</h3>
        <div class="form-group">

            <input type="hidden" id="id" name="id" value="{{$testreport->id}}">

            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$testreport->title}}">
            <br>
            <label for="description">Description:</label>
            <textarea rows="4" cols="50" name="description" class="form-control" id="description">{{$testreport->description}}</textarea>
            <br>
            <label for="version">Version number:</label>
            <input type="text" class="form-control" id="version" name="version" value="{{$testreport->version}}">
            <br>
            <label for="author">Author:</label>
            <input type="text" class="form-control" id="author" name="author" value="{{$testreport->author}}">
            <br>
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" value="{{$testreport->status}}">
        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection