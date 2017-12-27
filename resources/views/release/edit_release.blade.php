@extends('layout.app')

@section('title')
    {{$project->name}} - {{$release->version}} {{$release->name}}
@endsection

@section('breadcrumbs', Breadcrumbs::render('showrelease', $project, $company, $release))

@section('content')

    <div class="row">
        <div class="header-3" id="edit-project">
            <form action="#" method="post">
                {{ csrf_field() }}
                <div class="form-group col-md-6">
                    <input type="hidden" name="name" value="{{$release->name}}">

                    <label class="edit-title" for="release_version">Release Version</label>
                    <input type="text" class="form-control" name="release_version" id="release_version"
                           value="{{$release->version}}">

                    <br>

                    <label class="edit-title" for="release_description">Release Description</label>
                    <textarea rows="4" cols="50" name="release_description" class="form-control"
                              id="release_description">{{$release->description}}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <label class="edit-title" for="release_name">Release Name</label>
                    <input type="text" class="form-control" name="release_name" id="release_name"
                           value="{{$release->name}}">

                    <br>

                    <label class="edit-title" for="release_status">Status</label>
                    <br>
                    <select name="release_status" id="release_status">
                        @foreach($status as $s)
                            <option value="{{$s->id}}">{{$s->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

@endsection