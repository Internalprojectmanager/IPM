@extends('layout.app')

@section('title')
    Edit project | {{env('APP_NAME')}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('editproject', $project))

@section('content')

    <a class="btn btn-edit delete-button" id="project-edit"
       href="{{route('deleteproject', [$project->company->path, $project->path])}}"
       onclick="return confirm('Are you sure you want to delete this Project?');">
        <i class="far fa-times-circle white"></i>
        <span class="white">Delete</span></a></a>

    <div class="row">
        <div class="header-3 row">
            <form action="{{route('updateproject', [$project->company->path, $project->path])}}"
                  method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="form-group col-md-6">
                        <input type="hidden" name="name" value="{{$project->name}}">

                        <label class="edit-title" for="project_name">Project name</label>
                        <input type="text" class="form-control input-text-modal" name="project_name" id="project_name"
                               value="{{$project->name}}">

                        <br>

                        <label class="edit-title" for="description">Description</label>
                        <textarea rows="4" cols="50" name="description" class="form-control input-text-modal"
                                  id="description">{{$project->description}}</textarea>

                    </div>
                    <div class="form-group col-md-6">
                        <label class="edit-title" for="company">Project Status</label>
                        <br>
                        <select name="status" id="company">
                            @foreach($status as $s)
                                <option @if($s->id == $project->status) selected=""
                                        @endif value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="edit-title" for="company">Select Client</label>
                        <br>
                        <select name="company" id="company">
                            @foreach($companys as $company)

                                <option @if($company->id == $project->company_id) selected=""
                                        @endif value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>

                        <span class="or">Or</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="edit-title" id="add_client" for="new_client">Enter the name of the new
                            Client</label>
                        <input type="text" class="form-control input-text-modal" name="new_client" id="new_client"
                               placeholder="New Client Name">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group col-md-6" align="left">
                        <a href="{{route('projectdetails', ['company-id' => $project->company->path, 'name' => $project->path])}}"
                           class="btn btn-edit">
                            <svg width="11px" height="11px" viewBox="0 0 11 11" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <!-- Generator: Sketch 47.1 (45422) - http://www.bohemiancoding.com/sketch -->
                                <title>Cancel icon</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Style-Guide" transform="translate(-423.000000, -3243.000000)"
                                       fill-rule="nonzero"
                                       fill="#D35847">
                                        <g id="Group-20" transform="translate(388.000000, 3209.000000)">
                                            <path d="M45.5795598,34.4207545 C45.0185538,33.8597485 44.1080864,33.8597485 43.5474396,34.4207545 L40.4999775,37.4678573 L37.4528747,34.4211136 C36.8918687,33.8601077 35.9817604,33.8601077 35.4207545,34.4211136 C34.8597485,34.9821196 34.8597485,35.8922279 35.4207545,36.4525155 L38.4682165,39.4996184 L35.4207545,42.5467212 C34.8597485,43.1077272 34.8597485,44.0178355 35.4207545,44.5781231 C35.9817604,45.1391291 36.8918687,45.1391291 37.4528747,44.5781231 L40.4999775,41.5313794 L43.5470804,44.5781231 C44.1080864,45.1391291 45.0181946,45.1391291 45.5792006,44.5781231 C46.1402066,44.0171172 46.1402066,43.1066497 45.5792006,42.5467212 L42.5317386,39.4996184 L45.5792006,36.4525155 C46.1402066,35.8911504 46.1402066,34.9814013 45.5795598,34.4207545 Z"
                                                  id="Cancel-icon"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            Cancel
                        </a></div>
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
                </div>
            </form>

        </div>
    </div>

@endsection