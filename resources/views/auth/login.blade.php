@extends('layout.app')

@section('title')
    Sign in | {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 center">
            <span class="supertitle">Welcome to IPM</span>
            <p class="undertitle">Hello there! Sign in and start managing your projects</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <h3 class="center">Sign in</h3>
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @include('flash::message')
                </div>
            </div>

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-12 center">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                              </span>
                        @endif
                        <input id="email" type="text" class="form-control form-control-login" name="email"
                               value="{{ old('email') }}" placeholder="Email" required autofocus>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="col-md-12 center">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <input id="password" type="password" class="form-control form-control-login" name="password"
                               placeholder="Password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 center">
                        <button type="submit" class="btn btn-noback">
                            Login
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 center">
                        Forgot Your Password?
                        @if(config('app.secure') == TRUE)
                            <a class="btn-link" href="{{ secure_url('/password/reset') }}">Reset</a>
                        @else
                            <a class="btn-link" href="{{ url('/password/reset') }}">Reset</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        @if($agent->browser() !== "Mozilla" && $agent->platform() !== "iOS" && $agent->platform() !== "Android")
        <div class="col-md-2">
            <h3 class="center">OR</h3>
        </div>
        <div class="col-md-4">
            <h3 class="center">Sign in with</h3>
            <div class="form-group auth-buttons">
                <div class="col-md-12 oauth center">
                    <a href="{{route('authlogin', 'google')}}"><i class="glyphicon g-icon"></i></a>
                    <a href="{{route('authlogin', 'github')}}"><i class="glyphicon github-icon"></i></a>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
l