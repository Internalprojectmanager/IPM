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

                    <button class="save-button" id="save-button" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection