@extends('layout.app')

@section('title')
    {{$project->name}} - {{$release->version}} {{$release->name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{$company->name}} {{$project->name}}: {{$release->name}}</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <b>Version:</b> {{$release->version}}<br>
                <b>Author:</b> {{$release->author}}<br>
                <b>Description:</b><br> {{$release->description}}<br>
            </div>
        </div>
        <h2>Features</h2>
                @foreach($features as $f)
                    <div class="row" id="{{$f->id}}">
                        <div class="col-md-12">
                            <h3>{{$f->id}}: {{$f->name}}</h3>
                            <b>Status:</b><p>{{$f->status}}</p>
                            <b>Description:</b><p>{{$f->description}}</p>
                        </div>
                        @foreach($requirements as $r)

                        @endforeach
                    </div>
                @endforeach



    </div>

@endsection