@extends('layout.app')

@section('title')
    Add letter
@endsection

@section('content')

    <form action="{{route('storeletter')}}" method="post">
        {{ csrf_field() }}
        <h3>Letter</h3>
        <div class="form-group">
            <input type="hidden" id="project" name="project" value="{{$projects->name}}">
            <input type="hidden" id="company_id" name="company_id" value="{{$companys->name}}">
            <label for="letter_title">Letter title:</label>
            <input type="text" class="form-control" name="letter_title" id="letter_title">
            <br>
            <label for="letter_content">Letter content:</label>
            <textarea rows="4" cols="50" name="letter_content" class="form-control" id="letter_content"></textarea>
            <br>
            <label for="Author">Author:</label>
            <input type="text" class="form-control" name="author" id="author">
            <br>
            <label for="contact_person">Client contact person:</label>
            <input type="text" class="form-control" name="contact_person" id="contact_person">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection