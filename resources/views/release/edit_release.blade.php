@extends('layout.app')

@section('title')
    {{$project->name}} -  {{$release->name}} {{number_format($release->version, 1)}} | {{env('APP_NAME')}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('editrelease', $project, $release))

@section('content')
    <a class="btn-edit delete-button" id="project-edit"
       href="{{route('deleterelease', [$client->path, $project->path, $release->path, $release->version])}}"
       onclick="return confirm('Are you sure you want to delete this Release?');">
        <i class="far fa-times-circle white"></i>
        <span class="white">Delete</span></a>

    <div class="row">
        <div class="header-3 form-group" id="edit-project">
            <div action="{{route('updaterelease', [$client->path, $project->path, $release->path, $release->version])}}"
                 method="post">
                {{ csrf_field() }}
                    <div class="form-group col-md-6">
                        <label class="edit-title" for="release_name">Release name</label>
                        <input type="text" class="form-control" name="release_name" id="release_name"
                               value="{{$release->name}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="edit-title" for="client">Release Status</label>
                        <br>
                        <select class="form-control input-text-modal" name="status" id="client">
                            @foreach($status as $s)
                                <option @if($s->id == $release->status) selected=""
                                        @endif value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="edit-title" for="release_description">Description</label>
                        <textarea rows="4" cols="50" name="description" class="form-control"
                                  id="release_description">{{$release->description}}</textarea>

                    </div>
                    <div class="form-group col-md-6">
                        <label class="edit-title" for="project_code">Version</label>
                        <input type="text" class="form-control" name="version" id="release_version"
                               value="{{$release->version}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="deadline">Release Deadline: <span class="required">*</span></label>
                        <input type="text" required class="form-control datepicker" autocomplete="off" id="deadline"
                               name="deadline"
                               placeholder="YYYY/MM/DD" value="{{date('Y-m-d', strtotime($release->deadline))}}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="release_document_status">Document Status:</label>
                        <select class="form-control input-text-modal" name="document_status">
                            @foreach($status as $s)
                                <option @if($s->id == $release->document_status) selected=""
                                        @endif value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-md-12">
                        <label for="release_specification">Specification type:</label>
                        <input type="text" class="form-control input-text-modal" name="specification" id=""
                               value="{{$release->specificationtype}}">
                    </div>
                    <div class="form-group col-md-6" align="left">
                        <button type="button" class="btn-cancel"
                                onclick="window.location.assign('{{route('overviewproject')}}')">Close
                        </button>
                    </div>
                    <div class="form-group col-md-6" align="right">
                        <button class="btn btn-primary" type="submit">
                            Save Project <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

@endsection