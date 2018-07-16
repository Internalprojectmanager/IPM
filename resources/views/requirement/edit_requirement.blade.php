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
                <div class="form-group">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12">
                            <label>Requirement Name</label>
                            <input type="text" class="form-control input-text-modal requirement_name"
                                   name="requirement_name"
                                   id="" placeholder="" value="{{ old('requirement_name', isset($requirement) ? $requirement->name : '')}}">
                        </div>
                        <div class="col-md-12">
                            <label>Description:</label>
                            <textarea rows="4" cols="50" name="requirement_description"
                                      class="form-control input-text-modal" id="description">{{ old('requirement_name', isset($requirement) ? $requirement->description : '')}}</textarea>

                        </div>
                        <div class="col-md-12 assignee">
                            <label>Assingees:</label>
                            <select class="form-control input-text-modal selectpicker"
                                    name="assignee[]"
                                    multiple>
                                @foreach($user as $u)
                                    <option
                                            value="{{$u->users->id}}">{{$u->users->first_name}} {{$u->users->last_name}} @if(isset($u->users->jobtitles))
                                            (<i>{{$u->users->jobtitles->name}}</i>) @endif</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
        </div>
    </div>


@endsection