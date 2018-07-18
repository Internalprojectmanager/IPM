@extends('layout.app')

@section('title')
    Edit Requirement
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
    <div class="header-3" id="edit-project">
        <div class="row">
            <div class="col-md-12">
            <form action="{{route('updateRequirement',
                             [$client->path, $project->path, $release->path, $feature->id, $requirement->id])}}" method="post">
                {{ csrf_field() }}
                <h3>Edit Feature Requirement: {{$feature->name}} - {{$requirement->name}}</h3>

                @include('requirement.requirement_form')
                <button class="btn btn-primary" type="submit">Save Requirement</button>
            </form>
        </div>
        </div>
    </div>


@endsection