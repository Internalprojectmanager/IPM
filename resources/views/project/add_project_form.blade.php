@extends('layout.app')

@section('content')
    <div class="header-3" id="edit-project">
        <h1>New Project</h1>
        <form action="{{route('storeproject')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-group">
                    <label>Project: <span class="required">*</span></label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control selectpicker input-text-modal" name="team">
                            @foreach($teams as $u)
                                <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input placeholder="Project Name" type="text" class="form-control input-text-modal"
                               name="project_name" id="client_name" value="{{old('project_name')}}">
                    </div>

                </div>

                <div class="form-group">
                    <label>Client:<span class="required">*</span></label>
                    <select class="form-control input-text-modal" name="company" id="company">
                        <option value="" disabled="" selected="">Select a client</option>
                        @foreach($client as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <span class="or">Or</span>
                    <br>
                    <label class="edit-title" id="" for="new_client">Enter the name of the new Client</label>
                    <input type="text" class="form-control form-control input-text-modal" name="new_client"
                           placeholder="New Client Name" value="{{old('new_client')}}">
                </div>

                <div class="form-group">
                    <label>Description:</label>
                    <textarea rows="4" cols="50" name="description" class="form-control input-text-modal"
                              id="description">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <div class="col-md-6" align="left">
                        <button type="button" class="btn-cancel" onclick="window.location.assign('{{route('overviewproject')}}')">Close</button>
                    </div>
                    <div class="col-md-6" align="right">
                        <button class="btn btn-primary" type="submit">
                            Save Project <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </div>
            </div>


        </form>
    </div>

@endsection