@extends('layout.app')

@section('title')
    Edit letter
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
    <form action="{{route('updateletter', ['project_id' => $letters->project_id, 'letter_id' => $letters->id,
        'letter_title' => $letters->title, 'name' => $project->name, 'company_id' => $project->company_id])}}" method="post">
        {{ csrf_field() }}
        <h3>Letter</h3>
        <div class="form-group">
            <input type="hidden" name="letter_id" value="{{$letters->id}}">
            <input type="hidden" name="project_id" value="{{$letters->project_id}}">
            <label for="document_title">Letter title:</label>
            <input type="text" class="form-control" name="letter_title" id="letter_title" value="{{$letters->title}}">
            <br><br>
            <label for="content">Content:</label>
            <textarea rows="4" cols="50" name="content" class="form-control" id="content">{{$letters->content}}</textarea>
            <br><br>
            <label for="author">Author:</label>
            <input type="text" class="form-control" name="author" id="author" value="{{$letters->author}}">
            <br><br>
            <label for="author">Client contact person:</label>
            <input type="text" class="form-control" name="contact_person" id="contact_person" value="{{$letters->contact_person}}">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection