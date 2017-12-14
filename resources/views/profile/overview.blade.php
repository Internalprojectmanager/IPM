@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 center">
                    <span class="supertitle">Settings</span>
                    <p class="undertitle">Personal Information</p>
                    @if(session('status'))
                        <div class="success center">{{session('status')}}</div>
                    @endif
                </div>
            </div>

            <form class="form-horizontal" role="form" method="POST"
                  @if(config('app.secure') == TRUE)
                  action="{{ secure_url('/profile') }}">
                @else
                    action="{{ url('/profile') }}">
                @endif
                {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-5 control-label">Name</label>
                        <div class="form-settings-field">
                            <input id="first_name" type="text" class="form-control form-settings-field" name="first_name" value="{{ $profile->first_name }}" placeholder="" autofocus>

                            @if ($errors->has('first_name'))
                                <i class="error-icon"></i>
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @else
                                <i class="check-icon"></i>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-5 control-label">Surname</label>
                        <div class="form-settings-field">
                            <input id="last_name" type="text" class="form-control form-settings-field" name="last_name" value="{{ $profile->last_name }}" placeholder="" >

                            @if ($errors->has('last_name'))
                                <i class="error-icon"></i>
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @else
                                <i class="check-icon"></i>
                            @endif
                        </div>
                    </div>


                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-5 control-label">Email</label>
                    <div class="form-settings-field">
                        <input id="email" type="text" class="form-control form-settings-field" name="email" value="{{ $profile->email }}" placeholder="">

                        @if ($errors->has('email'))
                            <i class="error-icon"></i>
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @else
                            <i class="check-icon"></i>
                        @endif
                    </div>
                </div>

                    <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                        <label for="job_title" class="col-md-5 control-label">Job Title</label>
                        <div class="form-settings-field">
                            <select name="job_title" class="dropdown-settings">
                                <option @if($profile->job_title == '' && $profile->job_title == NULL)selected="" @endif disabled>Select a Job Title</option>
                                @foreach($status as $s)
                                    @if($s->id === $profile->job_title)
                                        <option selected="" value="{{$s->id}}">{{$s->name}}</option>
                                    @else
                                        <option value="{{$s->id}}">{{$s->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('job_title') || $profile->job_title == '' && $profile->job_title == NULL)
                                <i class="error-icon"></i>
                                <span class="help-block">
                                <strong>{{ $errors->first('job_title') }}</strong>
                            </span>
                            @else
                                <i class="check-icon"></i>
                            @endif
                        </div>
                    </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-5 control-label">Password</label>
                    <div class="form-settings-field">
                        <input id="password" type="password" class="form-control form-settings-field" name="password" placeholder="">
                        @if ($errors->has('password'))
                            <i class="error-icon"></i>
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @else
                            <i class="check-icon"></i>
                        @endif
                    </div>
                </div>
                    <div class="form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                        <label for="password_confirm" class="col-md-5 control-label">Confirm Password</label>
                        <div class="form-settings-field">
                            <input id="password" type="password" class="form-control form-settings-field" name="password_confirm" placeholder="">
                            @if ($errors->has('password_confirm'))
                                <i class="error-icon"></i>
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirm') }}</strong>
                                </span>
                            @else
                                <i class="check-icon"></i>
                            @endif
                            <a href="{{route('home')}}" class="pull-left btn btn-cancel">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-save pull-right">
                                Save
                            </button>
                        </div>
                    </div>
                <div class="form-group margin-top-50">
                    <div class="col-md-12 center">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection