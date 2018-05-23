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
            <form action="{{route('updaterelease', [$client->path, $project->path, $release->path, $release->version])}}"
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
                        <button class="save-button" id="save-button" type="submit">
                            <svg id="save-logo" width="19px" height="19px" viewBox="0 0 19 19" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 48.1 (47250) - http://www.bohemiancoding.com/sketch -->
                                <title>Save icon</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                   transform="translate(-1071.000000, -3131.000000)">
                                    <g id="Group-29" transform="translate(1040.000000, 3100.000000)">
                                        <g id="Save-icon" transform="translate(31.000000, 31.000000)">
                                            <path d="M1,0 L1,18 L18,18 L18,0 L19,0 L19,19 L0,19 L0,0 L1,0 Z"
                                                  id="Combined-Shape" fill="#FFFFFF"></path>
                                            <rect id="Rectangle-9" fill="#FFFFFF" x="10" y="0" width="9"
                                                  height="1"></rect>
                                            <rect id="Rectangle-9" fill="#FFFFFF"
                                                  transform="translate(9.500000, 4.500000) rotate(-90.000000) translate(-9.500000, -4.500000) "
                                                  x="5" y="4" width="9" height="1"></rect>
                                            <path d="M9.5,9.5 L5.96446609,5.96446609" id="Line-2" stroke="#FFFFFF"
                                                  stroke-linecap="square"></path>
                                            <path d="M13.5,9.5 L9.96446609,5.96446609" id="Line-2-Copy" stroke="#FFFFFF"
                                                  stroke-linecap="square"
                                                  transform="translate(11.500000, 7.500000) scale(-1, 1) translate(-11.500000, -7.500000) "></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <span class="button-content" id="button-save">Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

@endsection