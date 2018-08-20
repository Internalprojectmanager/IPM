@extends('layout.app')

@section('title')
    Sign in | {{env('APP_NAME')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 center">
                    <span class="supertitle">Sign In</span>
                    <p class="undertitle">Hello there! Sign in and start managing your projects</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
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

                <div class="form-group auth-buttons margin-top-50">
                    <h3 class="center">OR</h3>
                    <div class="col-md-4 col-md-offset-4 google-btn center margin-top-50">
                        <h4>Sign in with</h4>
                        <a href="{{route('authlogin', 'google')}}"><i class="glyphicon g-icon"></i></a>
                        <a href="{{route('authlogin', 'github')}}"><i class="glyphicon github-icon"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
l