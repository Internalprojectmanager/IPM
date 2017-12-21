@extends('layout.app')

@section('title')
    Edit project
@endsection

@section('breadcrumbs', Breadcrumbs::render('editproject', $projects))

@section('content')

    <div class="row">
        <div class="header-3" id="edit-project">
            <form action="{{route('updateproject', ['name' => $projects->name, 'company_id' => $projects->company_id])}}"
                  method="post">
                {{ csrf_field() }}
                <div class="form-group col-md-6">
                    <input type="hidden" name="name" value="{{$projects->name}}">

                    <label class="edit-title" for="project_name">Project name</label>
                    <input type="text" class="form-control" name="project_name" id="project_name"
                           value="{{$projects->name}}">

                    <br>

                    <label class="edit-title" for="description">Description</label>
                    <textarea rows="4" cols="50" name="description" class="form-control"
                              id="description">{{$projects->description}}</textarea>

                    <br>

                    <label class="edit-title" for="project_code">Code</label>
                    <input type="text" class="form-control" name="project_code" id="project_code"
                           value="{{$projects->projectcode}}">
                </div>
                <div class="form-group col-md-6">
                    <label class="edit-title" for="company">Select Client</label>
                    <br>
                    <select name="company" id="company">
                        @foreach($companys as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>

                    <span class="or">Or</span>

                    <label class="edit-title" id="add_client" for="new_client">Enter the name of the new Client</label>
                    <input type="text" class="form-control" name="new_client" id="new_client" placeholder="New Client Name">

                    <button class="save-button" id="save-button" type="submit">
                        <svg id="save-logo" width="19px" height="19px" viewBox="0 0 19 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Generator: Sketch 48.1 (47250) - http://www.bohemiancoding.com/sketch -->
                            <title>Save icon</title>
                            <desc>Created with Sketch.</desc>
                            <defs></defs>
                            <g id="Style-Guide" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(-1071.000000, -3131.000000)">
                                <g id="Group-29" transform="translate(1040.000000, 3100.000000)">
                                    <g id="Save-icon" transform="translate(31.000000, 31.000000)">
                                        <path d="M1,0 L1,18 L18,18 L18,0 L19,0 L19,19 L0,19 L0,0 L1,0 Z" id="Combined-Shape" fill="#FFFFFF"></path>
                                        <rect id="Rectangle-9" fill="#FFFFFF" x="10" y="0" width="9" height="1"></rect>
                                        <rect id="Rectangle-9" fill="#FFFFFF" transform="translate(9.500000, 4.500000) rotate(-90.000000) translate(-9.500000, -4.500000) " x="5" y="4" width="9" height="1"></rect>
                                        <path d="M9.5,9.5 L5.96446609,5.96446609" id="Line-2" stroke="#FFFFFF" stroke-linecap="square"></path>
                                        <path d="M13.5,9.5 L9.96446609,5.96446609" id="Line-2-Copy" stroke="#FFFFFF" stroke-linecap="square" transform="translate(11.500000, 7.500000) scale(-1, 1) translate(-11.500000, -7.500000) "></path>
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