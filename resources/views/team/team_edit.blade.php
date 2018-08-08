@extends('layout.app')

@section('content')
    <div class="header-3" id="edit-project">
        <h1>Edit {{$team->name}}</h1>
        <form action="{{route('team.update', $team->slug)}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Team: <span class="required">*</span></label>
            </div>
            <div class="form-group">
                <input placeholder="Team Name" type="text" class="form-control input-text-modal"
                       name="team_name" id="client_name" value="{{old('team_name', $team->name)}}">
            </div>
            <div class="form-group">
                <label>Slogan: <span class="required">*</span></label>
            </div>
            <div class="form-group">
                <textarea placeholder="Team Name" class="form-control input-text-modal"
                          name="team_slogan" id="client_name">{{old('team_slogan', $team->slogan)}} </textarea>
            </div>

            <div class="form-group">
                <label>Current Logo:</label>
            </div>

            <div class="form-group">
                @if(!empty($team->logo))
                    <div class="download row" id="{{$team->id}}">
                        <div class="col-md-12">
                            <img class="img-thumbnail width25" src="{{\Storage::url($team->logo)}}"/>
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label>New Logo:</label>
                <div class="col-md-12">
                    <input type="file" name="upload" value="{{old('file')}}" accept=".jpg, .jpeg, .png"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6" align="left">
                    <button type="button" class="btn-cancel"
                            onclick="window.location.assign('{{route('overviewproject')}}')">Close
                    </button>
                </div>
                <div class="col-md-6" align="right">
                    <button class="btn btn-primary" type="submit">
                        Save Team <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>
            </div>


        </form>
    </div>

@endsection