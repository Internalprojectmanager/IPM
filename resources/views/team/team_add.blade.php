@extends('layout.app')

@section('content')
    <div class="header-3" id="edit-project">
        <h1>New Team</h1>
        <form action="{{route('team.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="form-group">
                    <label>Team: <span class="required">*</span></label>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input placeholder="Team Name" type="text" class="form-control input-text-modal"
                               name="team_name" id="client_name" value="{{old('team_name')}}">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-md-6" align="left">
                        <button type="button" class="btn-cancel" onclick="window.location.assign('{{route('overviewproject')}}')">Close</button>
                    </div>
                    <div class="col-md-6" align="right">
                        <button class="btn btn-primary" type="submit">
                            Save Team <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </div>
            </div>


        </form>
    </div>

@endsection