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
                        <div class="form-forgot-field">
                            <input id="first_name" type="text" class="form-control form-control-login" name="first_name" value="{{ $profile->first_name }}" placeholder="" required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-5 control-label">Surname</label>
                        <div class="form-forgot-field">
                            <input id="last_name" type="text" class="form-control form-control-login" name="last_name" value="{{ $profile->last_name }}" placeholder="" required>

                            @if ($errors->has('last_name'))
                                <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>


                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-5 control-label">Email</label>
                    <div class="form-forgot-field">
                        <input id="email" type="text" class="form-control form-control-login" name="email" value="{{ $profile->email }}" placeholder="" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-5 control-label">Password</label>
                    <div class="form-forgot-field">
                        <input id="password" type="password" class="form-control form-control-login" name="password" placeholder="">
                        @if ($errors->has('password'))
                            <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
                    <div class="form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                        <label for="password_confirm" class="col-md-5 control-label">Confirm Password</label>
                        <div class="form-forgot-field">
                            <input id="password" type="password" class="form-control form-control-login" name="password_confirm" placeholder="">
                            @if ($errors->has('password_confirm'))
                                <span class="help-block">
                        <strong>{{ $errors->first('') }}</strong>
                    </span>
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