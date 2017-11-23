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
            <br><br>

            <label for="contact_name">Contact Name:</label>
            <input type="text" class="form-control" name="contact_name" id="contact_name">
            <br><br>

            <label for="contact_number">Contact Phonenumber:</label>
            <input type="text" class="form-control" name="contact_number" id="contact_number">
            <br><br>

            <label for="contact_number">Contact Email:</label>
            <input type="text" class="form-control" name="contact_mail" id="contact_number">
            <br><br>


            <label for="client_status">Client Status:</label>
            <br>
            <select name="status">
                @foreach($status as $s)
                    <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
            </select>
            <br><br>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

@endsection